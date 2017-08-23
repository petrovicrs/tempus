<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportingQuestionsAndAnswersRepository")
 * @ORM\Table(name="reporting_questions_and_answers")
 */
class ReportingQuestionsAndAnswers extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Questions", mappedBy="reportingQuestions", cascade={"persist"})
     */
    protected $reportingQuestionsAndAnswers;

    /**
     * @var string $answer
     * @Assert\Type("string")
     * @ORM\Column(name="answer", type="string", length=255)
     */
    protected $answer;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Reporting",
     *      inversedBy="reportingBy"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reporting;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
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
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return mixed
     */
    public function getReportingQuestionsAndAnswers()
    {
        return $this->reportingQuestionsAndAnswers;
    }

    /**
     * @param mixed $reportingQuestionsAndAnswers
     */
    public function setReportingQuestionsAndAnswers($reportingQuestionsAndAnswers)
    {
        $this->reportingQuestionsAndAnswers = $reportingQuestionsAndAnswers;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getReporting()
    {
        return $this->reporting;
    }

    /**
     * @param mixed $reporting
     */
    public function setReporting($reporting)
    {
        $this->reporting = $reporting;
    }
}