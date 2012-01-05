<?php

namespace Ez\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ez\BlogBundle\Entity\Post;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="Ez\BlogBundle\Repository\TagRepository")
 */
class Tag {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;

	/**
	 * @ORM\Column(type="string", length="255", name="title")
	 */
	public $title;

	/**
	 * @ORM\Column(type="string", length="255", name="title_slug")
	 */
	public $titleSlug;

	/**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
	public $posts;	

	public function getPosts() {
		return $this->posts->toArray();
	}

	public function __construct() {
	}

}
