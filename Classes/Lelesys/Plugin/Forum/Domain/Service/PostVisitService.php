<?php

namespace Lelesys\Plugin\Forum\Domain\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Post Visit service for the Lelesys.Plugin.Forum package
 *
 * @Flow\Scope("singleton")
 */
class PostVisitService {

	/**
	 * Injects seesion Interface
	 *
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Session\SessionInterface
	 */
	protected $session;

	/**
	 * Injects seesion Manager
	 *
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Session\SessionManager
	 */
	protected $sessionManager;

	/**
	 * Injects post visit repository
	 *
	 * @Flow\Inject
	 * @var \Lelesys\Plugin\Forum\Domain\Repository\PostVisitRepository
	 */
	protected $posttVisitRepository;

	/**
	 * Injects persistance manager
	 *
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\Doctrine\PersistenceManager
	 */
	protected $persistenceManager;

	/**
	 * Adds post info to repository when user visits a post
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $post
	 * @return void
	 */
	public function addViewForPost(\TYPO3\TYPO3CR\Domain\Model\NodeInterface $post) {
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$sessionIdentifier = $this->session->getId();
		$postNodeIdentifier = $post->getIdentifier();
		$result = $this->posttVisitRepository->checkIfUserAlreadyVisitedPost($sessionIdentifier, $ipAddress, $postNodeIdentifier);
		if ($result === 0) {
			$postVisit = new \Lelesys\Plugin\Forum\Domain\Model\PostVisit();
			$postVisit->setIpAddress($ipAddress);
			$postVisit->setSessionIdentifier($sessionIdentifier);
			$postVisit->setPostNodeIdentifier($postNodeIdentifier);
			$this->posttVisitRepository->add($postVisit);
			$this->persistenceManager->persistAll();
		}
	}

	/**
	 * Returns count of view for given post
	 *
	 * @param string $postIdentifier The post identifier
	 * @return intiger
	 */
	public function getCountOfViewsForPost($postIdentifier) {
		return $this->posttVisitRepository->findViewsByPostIdentifier($postIdentifier);
	}
}

?>