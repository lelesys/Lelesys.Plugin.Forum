<?php

namespace Lelesys\Plugin\Forum\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\TYPO3CR\Domain\Model\NodeTemplate;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Post controller for the Lelesys.Plugin.Forum package
 *
 * @Flow\Scope("singleton")
 */
class PostController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * Injects forum service
	 *
	 * @Flow\Inject
	 * @var \Lelesys\Plugin\Forum\Domain\Service\PostService
	 */
	protected $postService;

	/**
	 * Injects post visit service
	 *
	 * @Flow\Inject
	 * @var \Lelesys\Plugin\Forum\Domain\Service\PostVisitService
	 */
	protected $postVisitService;


	/**
	 * Action to create new post
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $forum The forun node
	 * @return void
	 */
	public function newAction(NodeInterface $forum) {
		$this->view->assign('forum', $forum);
	}

	/**
	 * Creates new post for forum
	 *
	 * @Flow\Validate(type="\Lelesys\Captcha\Validators\CaptchaValidator", value="$captcha")
	 * @Flow\Validate(type="NotEmpty", value="$captcha")
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $forum The forum
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeTemplate<Lelesys.Plugin.Forum:Post> $newPost The new post
	 * @param string $captcha The captcha
	 * @return void
	 */
	public function createAction(NodeInterface $forum, NodeTemplate $newPost, $captcha) {
			// Workaround until we can validate node templates properly:
		if (strlen($newPost->getProperty('title')) < 2) {
			$this->addFlashMessage('Your post was NOT created - Title was too short. ', '', \TYPO3\Flow\Error\Message::SEVERITY_ERROR);
			$this->redirect('new', 'Post', 'Lelesys.Plugin.Forum', array('forum' => $forum));
		}

		if (strlen($newPost->getProperty('description')) < 5) {
			$this->addFlashMessage('Your post was NOT created - Description was too short. ', '', \TYPO3\Flow\Error\Message::SEVERITY_ERROR);
			$this->redirect('new', 'Post', 'Lelesys.Plugin.Forum', array('forum' => $forum));
		}

		$this->postService->createNewPost($forum, $newPost);
		$this->redirectToUri($forum->getName() . '.html');
	}

	/**
	 * Show post detail page
	 *
	 * @Flow\Session(autoStart=TRUE)
	 * @return void
	 */
	public function showAction() {
		$postNode = $this->request->getInternalArgument('__documentNode');
		if ($postNode->getNodeType()->isOfType('Lelesys.Plugin.Forum:Post')) {
			$this->postVisitService->addViewForPost($postNode);
			$this->view->assign('post', $postNode);
			$this->view->assign('forum', $postNode->getParent());
		}
	}

	/**
	 * Action to create new comment
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $post PostNode The post
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $forum Forum Node The forum
	 * @return void
	 */
	public function replyAction(NodeInterface $post, NodeInterface $forum) {
		$this->view->assign('post', $post);
		$this->view->assign('forum', $forum);
	}

	/**
	 * Creates new comment for post
	 *
	 * @Flow\Validate(type="\Lelesys\Captcha\Validators\CaptchaValidator", value="$captcha")
	 * @Flow\Validate(type="NotEmpty", value="$captcha")
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $post The post
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeTemplate<Lelesys.Plugin.Forum:Post> $newComment The new comment
	 * @param string $captcha The captcha
	 * @return void
	 */
	public function createCommentAction(NodeInterface $post, NodeTemplate $newComment, $captcha) {
		if (strlen($newComment->getProperty('description')) < 5) {
			$this->addFlashMessage('Your comment was NOT created - Comment was too short. ', '', \TYPO3\Flow\Error\Message::SEVERITY_ERROR);
			$this->redirect('reply', 'Post', 'Lelesys.Plugin.Forum', array('post' => $post, 'forum' => $post->getParent()));
		}
		$currentPage = $this->request->getHttpRequest()->getArgument('currentPage');
		$this->postService->createNewComment($post, $newComment);
		$this->redirect('show', 'Post');
	}

	/**
	 * Override getErrorFlashMessage to present nice flash error messages.
	 *
	 * @return \TYPO3\Flow\Error\Message
	 */
	protected function getErrorFlashMessage() {
		return FALSE;
	}

}

?>