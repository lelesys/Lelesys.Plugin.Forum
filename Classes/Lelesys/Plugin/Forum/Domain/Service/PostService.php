<?php
namespace Lelesys\Plugin\Forum\Domain\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\TYPO3CR\Domain\Model\NodeTemplate;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Post service for the Lelesys.Plugin.Forum package
 *
 * @Flow\Scope("singleton")
 */
class PostService {

	/**
	 * Creates new post for forum
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $forum The forum
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeTemplate<Lelesys.Plugin.Forum:Post> $newPost The new post
	 * @return void
	 */
	public function createNewPost(NodeInterface $forum, NodeTemplate $newPost) {
		$newPostNodeName = \TYPO3\TYPO3CR\Utility::renderValidNodeName($newPost->getProperty('title'));
		$forum->createNodeFromTemplate($newPost, $newPostNodeName);
		$forum->setProperty('numberOfReplies', (intval($forum->getProperty('numberOfReplies')) +	1));
		$lastMessageDate = new \DateTime();
		$forum->setProperty('lastMessageDate', $lastMessageDate);
	}

	/**
	 * Creates new comment for post
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $post The post
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeTemplate<Lelesys.Plugin.Forum:Post> $newComment The new comment
	 * @return void
	 */
	public function createNewComment(NodeInterface $post, NodeTemplate $newComment) {
		$postTitle = $post->getProperty('title');
		$newCommentNodeName = \TYPO3\TYPO3CR\Utility::renderValidNodeName(uniqid('comment-') . $postTitle);
		$newComment = $post->createNodeFromTemplate($newComment, $newCommentNodeName);
		$forum = $post->getParent();
		$date = new \DateTime();
		$forum->setProperty('numberOfReplies', (intval($forum->getProperty('numberOfReplies')) + 1));
		$forum->setProperty('lastMessageDate', $date);
		$post->setProperty('lastMessageDate', $date);
		$newComment->setProperty('title', $postTitle);
		$newComment->setProperty('createdDate', $date);
	}
}

?>