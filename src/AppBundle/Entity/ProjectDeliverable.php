<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectDeliverableRepository")
 * @ORM\Table(name="project_deliverables")
 */
class ProjectDeliverable extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Column(name="project_id", type="string")
     */
    protected $projectId;


    /**
     * @ORM\Column(name="title_sr", type="string")
     */
    protected $titleSr;

    /**
     * @ORM\Column(name="title_en", type="string")
     */
    protected $titleEn;

    /**
     * @ORM\Column(name="desc_en", type="string")
     */
    protected $descEn;

    /**
     * @ORM\Column(name="desc_sr", type="string")
     */
    protected $descSr;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectDeliverableType"
     * )
     */
    protected $deliverableType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectDeliverableStatus"
     * )
     */
    protected $deliverableStatus;

    /**
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    protected $date;

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
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @return mixed
     */
    public function getTitleSr()
    {
        return $this->titleSr;
    }

    /**
     * @param mixed $titleSr
     */
    public function setTitleSr($titleSr)
    {
        $this->titleSr = $titleSr;
    }

    /**
     * @return mixed
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * @param mixed $titleEn
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;
    }

    /**
     * @return mixed
     */
    public function getDescEn()
    {
        return $this->descEn;
    }

    /**
     * @param mixed $descEn
     */
    public function setDescEn($descEn)
    {
        $this->descEn = $descEn;
    }

    /**
     * @return mixed
     */
    public function getDescSr()
    {
        return $this->descSr;
    }

    /**
     * @param mixed $descSr
     */
    public function setDescSr($descSr)
    {
        $this->descSr = $descSr;
    }

    /**
     * @return mixed
     */
    public function getDeliverableType()
    {
        return $this->deliverableType;
    }

    /**
     * @param mixed $deliverableType
     */
    public function setDeliverableType($deliverableType)
    {
        $this->deliverableType = $deliverableType;
    }

    /**
     * @return mixed
     */
    public function getDeliverableStatus()
    {
        return $this->deliverableStatus;
    }

    /**
     * @param mixed $deliverableStatus
     */
    public function setDeliverableStatus($deliverableStatus)
    {
        $this->deliverableStatus = $deliverableStatus;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}