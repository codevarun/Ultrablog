<?php
namespace Ez\BlogBundle\Controller;

use Ez\ToolsBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Ez\BlogBundle\Entity\Post;
use Ez\BlogBundle\Form\PostForm;

/**
* @Route("/posts")
*/
class PostsController extends BaseController {

	/**
	 * @Route("/", name="posts")
	 * @Template()
	 */
	public function indexAction() {
		$posts = $this->getRepo('Post')->findBy(array(), array('id' => 'DESC'));
		return get_defined_vars();
	}

	/**
	 * @Route("/{post}", name="view_post", requirements={"post" = "\d+"})
	 * @Template()
	 */
	public function viewAction( $post ) {
		$post = $this->getRepo('Post')->find($post);
		return get_defined_vars();
	}

	/**
	 * @Route("/add", name="add_post")
	 * @Template()
	 */
	public function addAction( Request $request ) {
		$post = new Post;
		$form = $this->createForm(new PostForm(), $post);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				$postService = $this->get('post_service');
				$post->setTags($postService->getNewOrExistingTags($post->getTagStrings()));

				$post->setAuthor($this->getRepo('User')->find(1));
				$post->setTitleSlug('');

				$this->saveEntity($post);

				return $this->redirect($this->generateUrl('posts'));
			}
		}

		$form = $form->createView();
		return get_defined_vars();
	}

	/**
	 * @Route("/{post}/edit", name="edit_post")
	 * @Template()
	 */
	public function editAction( Request $request, $post ) {
		$post = $this->getRepo('Post')->find($post);
		$form = $this->createForm(new PostForm(), $post);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				$postService = $this->get('post_service');
				$post->setTags($postService->getNewOrExistingTags($post->getTagStrings()));

				$this->saveEntity($post);

				return $this->redirect($this->generateUrl('posts'));
			}
		}

		$form = $form->createView();
		return get_defined_vars();
	}
}
