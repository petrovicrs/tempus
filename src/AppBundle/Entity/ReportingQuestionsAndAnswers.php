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
     * @ORM\ManyToOne(targetEntity="Questions", inversedBy="reportingQuestionsAndAnswers", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $questions;

    /**
     * @var string $answer
     * @Assert\Type("string")
     * @ORM\Column(name="answer_en", type="string", length=255, nullable=true)
     */
    protected $answerEn;

    /**
     * @var string $answer
     * @Assert\Type("string")
     * @ORM\Column(name="answer_sr", type="string", length=255, nullable=true)
     */
    protected $answerSr;

    /**
     * @ORM\ManyToOne(targetEntity="Reporting", inversedBy="questionsAndAnswers", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reporting;

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
    public function getAnswerEn()
    {
        return $this->answerEn;
    }

    /**
     * @param mixed $answerEn
     */
    public function setAnswerEn($answerEn)
    {
        $this->answerEn = $answerEn;
    }

    /**
     * @return string
     */
    public function getAnswerSr()
    {
        return $this->answerSr;
    }

    /**
     * @param string $answerSr
     */
    public function setAnswerSr($answerSr)
    {
        $this->answerSr = $answerSr;
    }

    public function getAnswer($locale) {
        if ($locale == "sr"){
            return $this->answerSr;
        }
        return $this->answerEn;
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