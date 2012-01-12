<?php

namespace Ez\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Ez\BlogBundle\Entity\Tag;
use Gedmo\Mapping\Annotation as Gedmo;

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
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
	 * @ORM\JoinColumn(name="author_user_id", referencedColumnName="id")
	 */
	protected $author;

	/**
	 * @ORM\Column(type="string", length="255", name="title")
	 * @Assert\NotBlank()
	 */
	protected $title;

	/**
	 * @Gedmo\Slug(fields={"title"})
	 * @ORM\Column(type="string", length="255", name="title_slug")
	 */
	protected $titleSlug;

	/**
	 * @ORM\Column(type="text", name="content")
	 * @Assert\NotBlank()
	 */
	protected $content;

	/**
	 * @ORM\ManyToMany(targetEntity="Tag")
     */
	protected $tags;

	/**
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	protected $createdAt;

	public function __construct() {
		$this->tags = new ArrayCollection();
		$this->createdAt = new \DateTime();
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
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set author
     *
     * @param Ez\BlogBundle\Entity\User $author
     */
    public function setAuthor(\Ez\BlogBundle\Entity\User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return Ez\BlogBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add tags
     *
     * @param Ez\BlogBundle\Entity\Tag $tags
     */
    public function addTag(\Ez\BlogBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

	public function getTagsString() {
print_r($this);
		return implode(' ', $this->getTags()->toArray());
	}

}