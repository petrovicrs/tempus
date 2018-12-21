<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\NamedTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserGroupRepository")
 * @ORM\Table(name="user_group")
 */
class UserGroup extends AbstractAuditable {

    use NamedTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    protected $isActive = true;

    /**
     * @ORM\OneToOne(targetEntity="ProjectProgramme")
     * @var ProjectProgramme
     */
    protected $program;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive) {
        $this->isActive = $isActive;
    }

    /**
     * @return ProjectProgramme
     */
    public function getProgram(): ?ProjectProgramme {
        return $this->program;
    }

    /**
     * @param ProjectProgramme $program
     */
    public function setProgram(ProjectProgramme $program) {
        $this->program = $program;
    }

}