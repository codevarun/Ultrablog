<?php

namespace Ez\ToolsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller {

	protected function getRepo($entityName, $bundleName = null) {
		$bundleName or $bundleName = implode(array_slice(explode('\\', get_class($this)), 0, 2));
		$repo = $this->getDoctrine()->getRepository($bundleName . ':' . $entityName);
		return $repo;
	}

}
