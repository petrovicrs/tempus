<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 * @ORM\Table(name="project")
 */
class Project extends AbstractAuditable
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
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="name_eng", type="string", length=255)
     */
    protected $nameEng;

    /**
     * @var string $name
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="name_srb", type="string", length=255)
     */
    protected $nameSrb;

    /**
     * @var string $description
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $description;

    /**
     * @var string $goals
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="goals", type="string", length=255)
     */
    protected $goals;

    /**
     * @var string $nameOriginalLetter
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="name_original_letter", type="string", length=255)
     */
    protected $nameOriginalLetter;

    /**
     * @var string $acronym
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="acronym", type="string", length=255)
     */
    protected $acronym;


    /**
     * @ORM\ManyToOne(
     *      targetEntity="Program",
     *      inversedBy="projects"
     * )
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id")
     */
    protected $program;


    /**
     * @var integer $status
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @Column(type="integer", name="status", options={"unsigned":true})
     */
    protected $status;

    /**
     * @var integer $scope
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @Column(type="integer", name="scope", options={"unsigned":true})
     */
    protected $scope;

    /**
     * @Assert\NotBlank()
     * @Column(type="integer", name="application_year")
     * @var integer $applicationYear
     */
    protected $applicationYear;

    /**
     * @var string $referenceNumber
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="reference_number", type="string", length=255)
     */
    protected $referenceNumber;

    /**
     * @var integer $duration
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @Column(type="integer", name="duration", options={"unsigned":true})
     */
    protected $duration;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="end_datetime", type="datetime")
     */
    protected $endDatetime;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="start_datetime", type="datetime")
     */
    protected $startDatetime;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="extended_time", type="datetime")
     */
    protected $extendedTime;

    /**
     * @var string $grantAmount
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @ORM\Column(name="grant_amount", type="string", length=255)
     */
    protected $grantAmount;

    /**
     * @var string $coFinancingAmount
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @ORM\Column(name="co_financing_amount", type="string", length=255)
     */
    protected $coFinancingAmount;

    /**
     * @var string $totalProjectValue
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @ORM\Column(name="total_project_value", type="string", length=255)
     */
    protected $totalProjectValue;

    /**
     * @var integer $mark
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @Column(type="integer", name="mark")
     */
    protected $mark;

    /**
     * @var string $markExplanation
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="mark_explanation", type="string", length=255)
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
     * @return string
     */
    public function getNameEng()
    {
        return $this->nameEng;
    }

    /**
     * @param string $nameEng
     */
    public function setNameEng($nameEng)
    {
        $this->nameEng = $nameEng;
    }

    /**
     * @return string
     */
    public function getNameSrb()
    {
        return $this->nameSrb;
    }

    /**
     * @param string $nameSrb
     */
    public function setNameSrb($nameSrb)
    {
        $this->nameSrb = $nameSrb;
    }



    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * Set program
     *
     * @param Program $program
     *
     * @return Project
     */
    public function setProgram($program)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * Get program
     *
     * @return Program
     */
    public function getProgram()
    {
        return $this->program;
    }


    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Project
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
     * @return Project
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
     * @param integer $applicationYear
     *
     * @return Project
     */
    public function setApplicationYear($applicationYear)
    {
        $this->applicationYear = $applicationYear;

        return $this;
    }

    /**
     * Get applicationYear
     *
     * @return integer
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
     * @return Project
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
     * @return Project
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @param integer $grantAmount
     *
     * @return Project
     */
    public function setGrantAmount($grantAmount)
    {
        $this->grantAmount = $grantAmount;

        return $this;
    }

    /**
     * Get grantAmount
     *
     * @return int
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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

