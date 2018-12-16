<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserProjectAccessRepository")
 * @ORM\Table(name="user_project_access")
 */
class UserProjectAccess extends AbstractAuditable {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="projectsAccess")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     */
    protected $project;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasAccess;

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getProject() {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project) {
        $this->project = $project;
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