<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 20:42
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportingRepository")
 * @ORM\Table(name="reporting")
 */
class Reporting extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="ReportingType")
     */
    protected $type;

    /**
     * @ORM\Column(name="reporting_date", type="datetime", nullable=true)
     */
    protected $reportingDate;

    /**
     * @ORM\OneToMany(targetEntity="ReportingQuestionsAndAnswers", mappedBy="reporting", cascade={"persist"})
     */
    protected $questionsAndAnswers;

    /**
     * @ORM\OneToMany(targetEntity="Person", mappedBy="reporting", cascade={"persist"})
     */
    protected $reportingBy;

    /**
     * @ORM\Column(name="comments_and_suggestions", type="text")
     */
    protected $commentsAndSuggestions;

    public function __construct()
    {
        parent::__construct();
        $this->reportingBy = new ArrayCollection();
        $this->questionsAndAnswers = new ArrayCollection();
    }

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getReportingDate()
    {
        return $this->reportingDate;
    }

    /**
     * @param mixed $reportingDate
     */
    public function setReportingDate($reportingDate)
    {
        $this->reportingDate = $reportingDate;
    }

    /**
     * @return mixed
     */
    public function getQuestionsAndAnswers()
    {
        return $this->questionsAndAnswers;
    }

    /**
     * @param mixed $questionsAndAnswers
     */
    public function setQuestionsAndAnswers($questionsAndAnswers)
    {
        $this->questionsAndAnswers = $questionsAndAnswers;
    }

    /**
     * @return mixed
     */
    public function getReportingBy()
    {
        return $this->reportingBy;
    }

    /**
     * @param mixed $reportingBy
     */
    public function setReportingBy($reportingBy)
    {
        $this->reportingBy = $reportingBy;
    }

    /**
     * @return mixed
     */
    public function getCommentsAndSuggestions()
    {
        return $this->commentsAndSuggestions;
    }

    /**
     * @param mixed $commentsAndSuggestions
     */
    public function setCommentsAndSuggestions($commentsAndSuggestions)
    {
        $this->commentsAndSuggestions = $commentsAndSuggestions;
    }
}