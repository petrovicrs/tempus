<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectEvaluatorGradeRepository")
 * @ORM\Table(name="project_evaluator_grades")
 */
class ProjectEvaluatorGrade extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project",
     *      inversedBy="contacts"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectGradeType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $gradeType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="remark", type="string")
     */
    protected $remark;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getGradeType()
    {
        return $this->gradeType;
    }

    /**
     * @param mixed $gradeType
     */
    public function setGradeType($gradeType)
    {
        $this->gradeType = $gradeType;
    }

    /**
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param mixed $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

}

