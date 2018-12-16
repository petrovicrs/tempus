<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectProgrammeRepository")
 * @ORM\Table(name="project_programmes")
 */
class ProjectProgramme extends AbstractAuditable {

    const TYPE_PROGRAM = 1;
    const TYPE_SUBPROGRAM = 2;
    const TYPE_PROJECT_TYPE = 3;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name_en", type="string")
     */
    protected $nameEn;

    /**
     * @ORM\Column(name="name_sr", type="string")
     */
    protected $nameSr;

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
        parent::__construct();
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
    public function setParent(ProjectProgramme $parent) {
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
    public function getNameEn() {
        return $this->nameEn;
    }

    /**
     * @param mixed $nameEn
     */
    public function setNameEn($nameEn) {
        $this->nameEn = $nameEn;
    }

    /**
     * @return mixed
     */
    public function getNameSr() {
        return $this->nameSr;
    }

    /**
     * @param mixed $nameSr
     */
    public function setNameSr($nameSr) {
        $this->nameSr = $nameSr;
    }

    public function getName($locale) {
        if ($locale == "sr") {
            return $this->nameSr;
        }
        return $this->nameEn;
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