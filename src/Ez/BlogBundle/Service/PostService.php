<?php
namespace Ez\BlogBundle\Service;

use Ez\BlogBundle\Entity\Tag;

class PostService {

	protected $doctrine;

	public function __construct($doctrine) {
		$this->doctrine = $doctrine;
	}

	public function getNewOrExistingTagWithTitle($title) {
		$repo = $this->doctrine->getRepository('EzBlogBundle:Tag');

		$tag = $repo->findOneByTitle($title);

		if ( !$tag ) {
			$tag = new Tag;
			$tag->setTitle($title);
			$tag->setTitleSlug($title);
		}

		return $tag;
	}

	public function getNewOrExistingTags($tags) {
		$objects = array();

		foreach ( $tags AS $tag ) {
			$objects[] = $this->getNewOrExistingTagWithTitle($tag);
		}

		return $objects;
	}

}
