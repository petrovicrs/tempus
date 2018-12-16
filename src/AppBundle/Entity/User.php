<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $surname = null;

    /**
     * @ORM\Column(type="integer")
     */
    protected $loginCount = 0;

    /**
     * @ORM\Column(type="integer")
     */
    protected $isLocked = 0;

    /**
     * @var ArrayCollection
     */
    protected $programsAccess;

    /**
     * @var ArrayCollection
     */
    protected $projectsAccess;

    /**
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->projectsAccess = new ArrayCollection();
        $this->programsAccess = new ArrayCollection();
    }

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

    /**
     * @return ArrayCollection
     */
    public function getProgramsAccess(): ArrayCollection {
        return $this->programsAccess;
    }

    /**
     * @param ArrayCollection $programsAccess
     */
    public function setProgramsAccess(ArrayCollection $programsAccess) {
        $this->programsAccess = $programsAccess;
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectsAccess(): ArrayCollection {
        return $this->projectsAccess;
    }

    /**
     * @param ArrayCollection $projectsAccess
     */
    public function setProjectsAccess(ArrayCollection $projectsAccess) {
        $this->projectsAccess = $projectsAccess;
    }

}