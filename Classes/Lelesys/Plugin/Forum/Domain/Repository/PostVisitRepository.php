<?php

namespace Lelesys\Plugin\Forum\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * Post visit repository for the Lelesys.Plugun.Form package
 *
 * @Flow\Scope("singleton")
 */
class PostVisitRepository extends Repository {

	/**
	 * Check if user has already visited the post
	 *
	 * @param string $sessionId The session id
	 * @param string $ipAddress The ip address
	 * @param string $nodeIdentifier The node identifier
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function checkIfUserAlreadyVisitedPost($sessionId, $ipAddress, $nodeIdentifier) {
		$query = $this->createQuery();
		$query->matching(
				$query->logicalAnd(
						$query->equals('sessionIdentifier', $sessionId), $query->equals('ipAddress', $ipAddress), $query->equals('postNodeIdentifier', $nodeIdentifier)
				)
		);
		return $query->execute()->count();
	}

	/**
	 * Find views for the post by identifier
	 *
	 * @param string $postIdentifier The search string
	 * @return \TYPO3\Flow\Persistence\QueryInterface The query result
	 */
	public function findViewsByPostIdentifier($postIdentifier) {
		$query = $this->createQuery();
		return $query->matching(
						$query->logicalOr(
								$query->equals('postNodeIdentifier', $postIdentifier)
						)
				)->execute()->count();
	}

}

?>