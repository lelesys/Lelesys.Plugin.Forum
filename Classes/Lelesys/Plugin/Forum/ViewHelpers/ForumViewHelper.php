<?php

namespace Lelesys\Plugin\Forum\ViewHelpers;

/*                                                                        *
 * This script belongs to the Flow package "Lelesys.Plugin.Forum".        *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A view helper for returning forums
 *
 * @Flow\scope("prototype")
 */
class ForumViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Returns forums in the supplied node
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $documentNode The document node object
	 * @return array
	 * @api
	 */
	public function render(\TYPO3\TYPO3CR\Domain\Model\NodeInterface $documentNode) {
		if($documentNode->hasChildNodes('Lelesys.Plugin.Forum:Forum')) {
			$forums = $documentNode->getChildNodes('Lelesys.Plugin.Forum:Forum');
			return $forums;
		}
	}

}

?>