<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\NamedTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectProgrammeRepository")
 * @ORM\Table(name="project_programmes")
 */
class ProjectProgramme extends AbstractAuditable {

    const TYPE_UNKNOWN = 0;
    const TYPE_PROGRAM = 1;
    const TYPE_SUBPROGRAM = 2;
    const TYPE_PROJECT_TYPE = 3;

    use NamedTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ProjectProgramme", mappedBy="parent")
     * @var ArrayCollection
     */
    protected $children;

    /**
     * , inversedBy="children"
     *
     * @ORM\ManyToOne(targetEntity="ProjectProgramme")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\Column(name="program_type", type="integer")
     */
    protected $programType = self::TYPE_PROGRAM;

    /**
     *@Column(type="boolean")
     */
    protected $isActive = true;

    /**
     * ProjectProgramme constructor.
     */
    public function __construct() {
        $this->children = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param ProjectProgramme $child
     */
    public function addChild(ProjectProgramme $child) {
        $this->children[] = $child;
        $child->setParent($this);
    }

    /**
     * @param ProjectProgramme $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProgramType() {
        return $this->programType;
    }

    /**
     * @param mixed $programType
     */
    public function setProgramType($programType) {
        $this->programType = $programType;
    }

    /**
     * @return mixed
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

}