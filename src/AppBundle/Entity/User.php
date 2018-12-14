<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Column;
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