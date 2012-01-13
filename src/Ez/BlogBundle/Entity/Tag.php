<?php

namespace Ez\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ez\BlogBundle\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;

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
	protected $id;

	/**
	 * @ORM\Column(type="string", length="255", name="title")
	 */
	protected $title;

	/**
	 * @ORM\Column(type="string", length="255", name="title_slug")
	 */
	protected $titleSlug;

	/**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags", cascade={"persist"})
     */
	protected $posts;

	public function __construct() {
		$this->posts = new ArrayCollection();
	}


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleSlug
     *
     * @param string $titleSlug
     */
    public function setTitleSlug($titleSlug)
    {
        $this->titleSlug = $titleSlug;
    }

    /**
     * Get titleSlug
     *
     * @return string
     */
    public function getTitleSlug()
    {
        return $this->titleSlug;
    }

    /**
     * Add posts
     *
     * @param Ez\BlogBundle\Entity\Post $posts
     */
    public function addPost(\Ez\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

	public function __toString() {
		return $this->title;
	}

}