<?php

namespace Ez\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ez\BlogBundle\Entity\Tag;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Ez\BlogBundle\Repository\PostRepository")
 */
class Post {

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
	 * @ORM\ManyToMany(targetEntity="Tag")
     */
	public $tags;

	/**
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	public $createdAt;

	

	public function getTags() {
		return $this->tags->toArray();
	}

	public function __construct() {
		$this->createdAt = new \DateTime();
	}

}
