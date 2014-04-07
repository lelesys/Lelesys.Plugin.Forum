<?php

namespace Lelesys\Plugin\Forum\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * Watcher repository for the Lelesys.Plugin.Forum package
 *
 * @Flow\Scope("singleton")
 */
class WatcherRepository extends Repository {

	/**
	 * Checks if user has already watch the post
	 *
	 * @param \Lelesys\App\NewMusicAcademy\Domain\Model\User $user the user
	 * @param string $identifier the node identifier
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function checkIfUserAlreadyWatchThePost(\Lelesys\App\NewMusicAcademy\Domain\Model\User $user, $identifier) {
		$query = $this->createQuery();
		$query->matching(
				$query->logicalAnd(
						$query->equals('user', $user),
						$query->like('objectIdentifier', $identifier)
				)
		);
		return $query->execute()->count();
	}

	/**
	 * Return all the watchers for the post
	 *
	 * @param string $forum Forum identifier
	 * @param string $post Post identifier
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findAllWatchersForThePost($forum, $post = NULL) {
		$query = $this->createQuery();
		$query->matching(
				$query->logicalOr(
						$query->equals('objectIdentifier', $forum),
						$query->equals('objectIdentifier', $post)
				)
		);
		return $query->execute();
	}

}

?>