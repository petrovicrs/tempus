<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectActivityRepository")
 * @ORM\Table(name="project_activities")
 */
class ProjectActivity extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     *      targetEntity="ProjectActivityType"
     * )
     */
    protected $activityType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectActivityStatus"
     * )
     */
    protected $activityStatus;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution"
     * )
     */
    protected $activityFrom;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\Institution"
     * )
     */
    protected $activityTo;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\ProjectDeliverablesActivities", inversedBy="activities"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectDeliverablesActivities;

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
    public function getActivityType()
    {
        return $this->activityType;
    }

    /**
     * @param mixed $activityType
     */
    public function setActivityType($activityType)
    {
        $this->activityType = $activityType;
    }

    /**
     * @return mixed
     */
    public function getActivityStatus()
    {
        return $this->activityStatus;
    }

    /**
     * @param mixed $activityStatus
     */
    public function setActivityStatus($activityStatus)
    {
        $this->activityStatus = $activityStatus;
    }

    /**
     * @return mixed
     */
    public function getActivityFrom()
    {
        return $this->activityFrom;
    }

    /**
     * @param mixed $activityFrom
     */
    public function setActivityFrom($activityFrom)
    {
        $this->activityFrom = $activityFrom;
    }

    /**
     * @return mixed
     */
    public function getActivityTo()
    {
        return $this->activityTo;
    }

    /**
     * @param mixed $activityTo
     */
    public function setActivityTo($activityTo)
    {
        $this->activityTo = $activityTo;
    }

    /**
     * @return mixed
     */
    public function getProjectDeliverablesActivities()
    {
        return $this->projectDeliverablesActivities;
    }

    /**
     * @param mixed $projectDeliverablesActivities
     */
    public function setProjectDeliverablesActivities($projectDeliverablesActivities)
    {
        $this->projectDeliverablesActivities = $projectDeliverablesActivities;
    }

    /**
     * @param $locale
     * @return String
     */
    public function getTitle($locale) {
        if ($locale == "sr"){
            return $this->titleSr;
        }
        return $this->titleEn;
    }

    /**
     * @param $locale
     * @return String
     */
    public function getDesc($locale) {
        if ($locale == "sr"){
            return $this->descSr;
        }
        return $this->descEn;
    }
}