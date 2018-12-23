<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserProgramAccessRepository")
 * @ORM\Table(name="user_program_access")
 */
class UserProgramAccess extends AbstractAuditable {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="programsAccess")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectProgramme")
     * @var ProjectProgramme
     */
    protected $program;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasAccess;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @return ProjectProgramme
     */
    public function getProgram() {
        return $this->program;
    }

    /**
     * @param mixed $program
     */
    public function setProgram($program) {
        $this->program = $program;
    }

    /**
     * @return mixed
     */
    public function getHasAccess() {
        return $this->hasAccess;
    }

    /**
     * @param mixed $hasAccess
     */
    public function setHasAccess($hasAccess) {
        $this->hasAccess = $hasAccess;
    }

}