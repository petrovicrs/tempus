<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Projects
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $description;

    /**
     * @var string $goals
     *
     * @ORM\Column(name="goals", type="string", length=255)
     */
    protected $goals;

    /**
     * @var string $nameOriginalLetter
     *
     * @ORM\Column(name="nameOriginalLetter", type="string", length=255)
     */
    protected $nameOriginalLetter;

    /**
     * @var string $acronym
     *
     * @ORM\Column(name="acronym", type="string", length=255)
     */
    protected $acronym;

    /**
     * @var integer $programId
     *
     * @Column(type="integer", name="programId", options={"unsigned":true})
     */
    protected $programId;

    /**
     * @var int $status
     *
     * @Column(type="integer", name="status", options={"unsigned":true})
     */
    protected $status;

    /**
     * @var int $scope
     *
     * @Column(type="integer", name="scope", options={"unsigned":true})
     */
    protected $scope;

    /**
     * @var \DateTime $applicationYear
     */
    protected $applicationYear;

    /**
     * @var string $referenceNumber
     *
     * @ORM\Column(name="referenceNumber", type="string", length=255)
     */
    protected $referenceNumber;

    /**
     * @var integer $duration
     *
     * @Column(type="integer", name="duration", options={"unsigned":true})
     */
    protected $duration;

    /**
     * @var \DateTime $endDatetime
     */
    protected $endDatetime;

    /**
     * @var \DateTime $startDatetime
     */
    protected $startDatetime;

    /**
     * @var \DateTime $extendedTime
     */
    protected $extendedTime;

    /**
     * @var string $grantAmount
     *
     * @ORM\Column(name="grantAmount", type="string", length=255)
     */
    protected $grantAmount;

    /**
     * @var string $coFinancingAmount
     *
     * @ORM\Column(name="coFinancingAmount", type="string", length=255)
     */
    protected $coFinancingAmount;

    /**
     * @var string $totalProjectValue
     *
     * @ORM\Column(name="totalProjectValue", type="string", length=255)
     */
    protected $totalProjectValue;

    /**
     * @var integer $mark
     *
     * @Column(type="integer", name="mark")
     */
    protected $mark;

    /**
     * @var string $markExplanation
     *
     * @ORM\Column(name="markExplanation", type="string", length=255)
     */
    protected $markExplanation;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Projects
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Projects
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set goals
     *
     * @param string $goals
     *
     * @return Projects
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;

        return $this;
    }

    /**
     * Get goals
     *
     * @return string
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set nameOriginalLetter
     *
     * @param string $nameOriginalLetter
     *
     * @return Projects
     */
    public function setNameOriginalLetter($nameOriginalLetter)
    {
        $this->nameOriginalLetter = $nameOriginalLetter;

        return $this;
    }

    /**
     * Get nameOriginalLetter
     *
     * @return string
     */
    public function getNameOriginalLetter()
    {
        return $this->nameOriginalLetter;
    }

    /**
     * Set acronym
     *
     * @param string $acronym
     *
     * @return Projects
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get acronym
     *
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set programId
     *
     * @param integer $programId
     *
     * @return Projects
     */
    public function setProgramId($programId)
    {
        $this->programId = $programId;

        return $this;
    }

    /**
     * Get programId
     *
     * @return int
     */
    public function getProgramId()
    {
        return $this->programId;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Projects
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set scope
     *
     * @param integer $scope
     *
     * @return Projects
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return int
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set applicationYear
     *
     * @param \DateTime $applicationYear
     *
     * @return Projects
     */
    public function setApplicationYear($applicationYear)
    {
        $this->applicationYear = $applicationYear;

        return $this;
    }

    /**
     * Get applicationYear
     *
     * @return \DateTime
     */
    public function getApplicationYear()
    {
        return $this->applicationYear;
    }

    /**
     * Set referenceNumber
     *
     * @param string $referenceNumber
     *
     * @return Projects
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    /**
     * Get referenceNumber
     *
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Projects
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set endDatetime
     *
     * @param \DateTime $endDatetime
     *
     * @return Projects
     */
    public function setEndDatetime($endDatetime)
    {
        $this->endDatetime = $endDatetime;

        return $this;
    }

    /**
     * Get endDatetime
     *
     * @return \DateTime
     */
    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

    /**
     * Set startDatetime
     *
     * @param \DateTime $startDatetime
     *
     * @return Projects
     */
    public function setStartDatetime($startDatetime)
    {
        $this->startDatetime = $startDatetime;

        return $this;
    }

    /**
     * Get startDatetime
     *
     * @return \DateTime
     */
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    /**
     * Set extendedTime
     *
     * @param \DateTime $extendedTime
     *
     * @return Projects
     */
    public function setExtendedTime($extendedTime)
    {
        $this->extendedTime = $extendedTime;

        return $this;
    }

    /**
     * Get extendedTime
     *
     * @return \DateTime
     */
    public function getExtendedTime()
    {
        return $this->extendedTime;
    }

    /**
     * Set grantAmount
     *
     * @param string $grantAmount
     *
     * @return Projects
     */
    public function setGrantAmount($grantAmount)
    {
        $this->grantAmount = $grantAmount;

        return $this;
    }

    /**
     * Get grantAmount
     *
     * @return string
     */
    public function getGrantAmount()
    {
        return $this->grantAmount;
    }

    /**
     * Set coFinancingAmount
     *
     * @param string $coFinancingAmount
     *
     * @return Projects
     */
    public function setCoFinancingAmount($coFinancingAmount)
    {
        $this->coFinancingAmount = $coFinancingAmount;

        return $this;
    }

    /**
     * Get coFinancingAmount
     *
     * @return string
     */
    public function getCoFinancingAmount()
    {
        return $this->coFinancingAmount;
    }

    /**
     * Set totalProjectValue
     *
     * @param string $totalProjectValue
     *
     * @return Projects
     */
    public function setTotalProjectValue($totalProjectValue)
    {
        $this->totalProjectValue = $totalProjectValue;

        return $this;
    }

    /**
     * Get totalProjectValue
     *
     * @return string
     */
    public function getTotalProjectValue()
    {
        return $this->totalProjectValue;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     *
     * @return Projects
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return int
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set markExplanation
     *
     * @param string $markExplanation
     *
     * @return Projects
     */
    public function setMarkExplanation($markExplanation)
    {
        $this->markExplanation = $markExplanation;

        return $this;
    }

    /**
     * Get markExplanation
     *
     * @return string
     */
    public function getMarkExplanation()
    {
        return $this->markExplanation;
    }
}

