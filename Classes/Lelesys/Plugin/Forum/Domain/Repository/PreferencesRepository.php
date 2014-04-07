<?php

namespace Lelesys\Plugin\Forum\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * Preferences repository for the Lelesys.Plugin.Forum package
 *
 * @Flow\Scope("singleton")
 */
class PreferencesRepository extends Repository {

	/**
	 * Return user if notified for the post
	 *
	 * @param string $post Post identifier
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function checkIfUserNotifiedForThePost($post) {
		$query = $this->createQuery();
		$query->matching(
				$query->logicalOr(
						$query->equals('objectIdentifier', $post)
				)
		);
		return $query->execute();
	}

}

?>