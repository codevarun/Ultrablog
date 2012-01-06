<?php

namespace Ez\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

use Ez\BlogBundle\Entity\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Ez\BlogBundle\Repository\UserRepository")
 */
class User implements UserInterface {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length="255", name="password")
	 */
	protected $password;

	/**
	 * @ORM\Column(type="string", length="255", name="salt")
	 */
	protected $salt;

	/**
	 * @ORM\Column(type="string", length="255", name="email", unique=true)
	 */
	protected $email;

	/**
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	protected $createdAt;

	/**
	 * @ORM\ManyToMany(targetEntity="Role")
	 */
	protected $userRoles;

	/**
	 * @ORM\Column(type="string", name="full_name")
	 */
	protected $fullName;

	/**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     */
	public $posts;

	public function getRoles() {
		return $this->getUserRoles()->toArray();
	}

	public function __construct() {
		$this->userRoles = new ArrayCollection();
		$this->createdAt = new \DateTime();
	}

	public function eraseCredentials() {
	}

	public function equals(UserInterface $user)
	{
		return md5($this->email) == md5($user->email);
	}

	public function getUserName() {
		return $this->email;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function getSalt() {
		return $this->salt;
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
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set fullName
     *
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Add userRoles
     *
     * @param Ez\BlogBundle\Entity\Role $userRoles
     */
    public function addRole(\Ez\BlogBundle\Entity\Role $userRoles)
    {
        $this->userRoles[] = $userRoles;
    }

    /**
     * Get userRoles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUserRoles()
    {
        return $this->userRoles;
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
}