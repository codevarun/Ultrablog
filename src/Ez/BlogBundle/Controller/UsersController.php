<?php

namespace Ez\BlogBundle\Controller;

use Ez\ToolsBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Ez\BlogBundle\Entity\User;
use Ez\BlogBundle\Form\UserForm;

/**
* @Route("/users")
*/
class UsersController extends BaseController {

	/**
	 * @Route("/{user}", name="view_user")
	 * @Template()
	 */
	public function viewAction( $user ) {
		$user = $this->getRepo('User')->find($user);

		return get_defined_vars();
	}

	/**
	 * @Route("/", name="users")
	 * @Template()
	 */
	public function indexAction() {
		$users = $this->getRepo('User')->findBy(array(), array('id' => 'DESC'));

		return get_defined_vars();
	}

	/**
	 * @Route("/add", name="add_user")
	 * @Template()
	 */
	public function addAction( Request $request ) {
		$user = new User;
		$form = $this->createForm(new UserForm(), $user);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				//$user->titleSlug = '';

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();

				return $this->redirect($this->generateUrl('users'));
			}
		}

		$form = $form->createView();

		return get_defined_vars();
	}
}
