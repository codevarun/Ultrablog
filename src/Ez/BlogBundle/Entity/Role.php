<?php

namespace Ez\BlogBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;

use Ez\BlogBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="Ez\BlogBundle\Repository\RoleRepository")
 */
class Role implements RoleInterface {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length="255", name="name", unique=true)
	 */
	protected $name;

	/**
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	protected $createdAt;

	/**
	 * @ORM\ManyToMany(targetEntity="User", mappedBy="userRoles")
	 */
	protected $users;

	public function __construct() {
		$this->users = new ArrayCollection();
		$this->createdAt = new \DateTime();
	}

	public function __tostring() {
		return $this->getName();
	}
	
	public function getRole() {
		return $this->name;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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
     * Add users
     *
     * @param Ez\BlogBundle\Entity\User $users
     */
    public function addUser(\Ez\BlogBundle\Entity\User $users)
    {
        $this->users[] = $users;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}