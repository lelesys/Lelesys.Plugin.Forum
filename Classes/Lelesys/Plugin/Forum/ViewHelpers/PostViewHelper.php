<?php

namespace Lelesys\Plugin\Forum\ViewHelpers;

/*                                                                        *
 * This script belongs to the Flow package "Lelesys.Plugin.Forum".        *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A view helper for returning posts
 *
 * @Flow\scope("prototype")
 */
class PostViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Returns posts in the supplied node
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $documentNode The document node object
	 * @return array
	 * @api
	 */
	public function render(\TYPO3\TYPO3CR\Domain\Model\NodeInterface $documentNode) {
		if($documentNode->hasChildNodes('Lelesys.Plugin.Forum:Post')) {
			$posts = $documentNode->getChildNodes('Lelesys.Plugin.Forum:Post');
			return $posts;
		}
	}

}

?>