<?php

namespace AppBundle\Entity;

/**
 * Projects
 */
class Projects
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $projectId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $goals;

    /**
     * @var string
     */
    private $nameOriginalLetter;

    /**
     * @var string
     */
    private $acronym;

    /**
     * @var int
     */
    private $programId;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $scope;

    /**
     * @var \DateTime
     */
    private $applicationYear;

    /**
     * @var string
     */
    private $referenceNumber;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var \DateTime
     */
    private $endDatetime;

    /**
     * @var \DateTime
     */
    private $startDatetime;

    /**
     * @var \DateTime
     */
    private $extendedTime;

    /**
     * @var string
     */
    private $grantAmount;

    /**
     * @var string
     */
    private $coFinancingAmount;

    /**
     * @var string
     */
    private $totalProjectValue;

    /**
     * @var int
     */
    private $mark;

    /**
     * @var string
     */
    private $markExplanation;


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
     * Set projectId
     *
     * @param integer $projectId
     *
     * @return Projects
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
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

