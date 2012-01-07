<?php

namespace Ez\ToolsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller {

	/**
	 * Shortcut for getDoctrine()->getRepository()
	 * 
	 * @arg String	entityName	Entity name to load repo for
	 * @arg String	bundleName	Optional bundle name if the entity isn't the app's
	 *
	 * @return	EntityRepository
	 * @error	Will throw an exception on any error
	 */
	protected function getRepo($entityName, $bundleName = null) {
		$bundleName or $bundleName = implode(array_slice(explode('\\', get_class($this)), 0, 2));
		$repo = $this->getDoctrine()->getRepository($bundleName . ':' . $entityName);
		return $repo;
	}

	/**
	 * Shortcut for saving an entity with the default EntityManager
	 * 
	 * @arg Entity	entity	The entity object of any kind
	 * @arg Bool	flush	Whether you want the entity to be saved immediately
	 *						Pass FALSE here if you're in a batch and flush() once later
	 *
	 * @return	EntityManager
	 * @error	Will throw an exception on any error
	 */
	protected function saveEntity($entity, $flush = true) {
		$em = $this->getDoctrine()->getEntityManager();

		$em->persist($entity);

		if ( $flush ) {
			$em->flush();
		}

		// To flush later in the Controller
		return $em;
	}

}
