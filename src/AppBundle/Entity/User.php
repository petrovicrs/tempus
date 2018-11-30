<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $surname;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="UserPermission",
     *      inversedBy="user"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $permission;

    /**
     * @ORM\Column(type="integer")
     */
    protected $loginCount = 0;

    /**
     * @ORM\Column(type="integer")
     */
    protected $isLocked = 0;

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname) {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getPermission() {
        return $this->permission;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission) {
        $this->permission = $permission;
    }

    public function getFullName() {
        return $this->getName() . ' ' . $this->getSurname();
    }

    /**
     * @return mixed
     */
    public function getLoginCount() {
        return $this->loginCount;
    }

    /**
     * @param mixed $loginCount
     */
    public function setLoginCount($loginCount) {
        $this->loginCount = $loginCount;
    }

    /**
     * @return mixed
     */
    public function getIsLocked() {
        return $this->isLocked;
    }

    /**
     * @param mixed $isLocked
     */
    public function setIsLocked($isLocked) {
        $this->isLocked = $isLocked;
    }

}