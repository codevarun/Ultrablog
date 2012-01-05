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
	public $id;

	/**
	 * ORM\Column(type="string", length="255", name="username", unique=true)
	 */
	//public $username;

	/**
	 * @ORM\Column(type="string", length="255", name="password")
	 */
	public $password;

	/**
	 * @ORM\Column(type="string", length="255", name="salt")
	 */
	public $salt;

	/**
	 * @ORM\Column(type="string", length="255", name="email", unique=true)
	 */
	public $email;

	/**
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	public $createdAt;

	/**
	 * @ORM\ManyToMany(targetEntity="Role")
	 */
	protected $userRoles;

	/**
	 * @ORM\Column(type="string", name="full_name")
	 */
	public $fullName;

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

	public function getUsername() {
		return $this->email;
	}

	public function getSalt() {
		return $this->salt;
	}

	public function getPassword() {
		return $this->password;
	}

	public function eraseCredentials() {
	}

	public function equals(UserInterface $user)
	{
		return md5($this->email) == md5($user->email);
	}

}
