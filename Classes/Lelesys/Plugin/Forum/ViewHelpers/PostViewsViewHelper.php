<?php

namespace Lelesys\Plugin\Forum\ViewHelpers;

/*                                                                        *
 * This script belongs to the Flow package "Lelesys.Plugin.Forum".        *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A view helper for returning post views
 *
 * @Flow\scope("prototype")
 */
class PostViewsViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Injects post visit service
	 *
	 * @Flow\Inject
	 * @var \Lelesys\Plugin\Forum\Domain\Service\PostVisitService
	 */
	protected $posttVisitService;

	/**
	 * Returns post views in the supplied node
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $documentNode The document node object
	 * @return integer
	 * @api
	 */
	public function render(\TYPO3\TYPO3CR\Domain\Model\NodeInterface $documentNode) {
		if ($documentNode->getNodeType()->getName() === 'Lelesys.Plugin.Forum:Post') {
			$identifier = $documentNode->getIdentifier();
			return $this->posttVisitService->getCountOfViewsForPost($identifier);
		}
	}

}

?>