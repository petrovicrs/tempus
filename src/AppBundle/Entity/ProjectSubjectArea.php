<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectSubjectAreaRepository")
 * @ORM\Table(name="project_subject_areas")
 */
class ProjectSubjectArea extends AbstractAuditable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectSubjectAreaType"
     * )
     */
    protected $areaType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project",
     *      inversedBy="subjectAreas"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAreaType()
    {
        return $this->areaType;
    }

    /**
     * @param mixed $areaType
     */
    public function setAreaType($areaType)
    {
        $this->areaType = $areaType;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    public function getName($locale) {
        if ($locale == "sr"){
            return $this->firstNameSr;
        }
        return $this->firstNameEn;
    }
}

