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
	public $id;

	/**
	 * @ORM\Column(type="string", length="255", name="name", unique=true)
	 */
	public $name;

	/**
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	public $createdAt;

	/**
	 * @ORM\ManyToMany(targetEntity="User", mappedBy="userRoles")
	 */
	public $users;

	public function __construct() {
		$this->createdAt = new \DateTime();
	}

	public function getRole() {
		return $this->getName();
	}

	public function __tostring() {
		return $this->getName();
	}

}
