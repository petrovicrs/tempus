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
     * @var string $question
     * @Assert\Type("string")
     * @ORM\Column(name="question_en", type="string", length=255)
     */
    protected $questionEn;

    /**
     * @var string $question
     * @Assert\Type("string")
     * @ORM\Column(name="question_sr", type="string", length=255)
     */
    protected $questionSr;

    /**
     * @var string $answer
     * @Assert\Type("string")
     * @ORM\Column(name="answer_en", type="string", length=255)
     */
    protected $answerEn;

    /**
     * @var string $answer
     * @Assert\Type("string")
     * @ORM\Column(name="answer_sr", type="string", length=255)
     */
    protected $answerSr;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Reporting",
     *      inversedBy="reportingBy"
     * )
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
     * @return string
     */
    public function getQuestionEn(): string
    {
        return $this->questionEn;
    }

    /**
     * @param string $questionEn
     */
    public function setQuestionEn(string $questionEn)
    {
        $this->questionEn = $questionEn;
    }

    /**
     * @return string
     */
    public function getQuestionSr(): string
    {
        return $this->questionSr;
    }

    /**
     * @param string $questionSr
     */
    public function setQuestionSr(string $questionSr)
    {
        $this->questionSr = $questionSr;
    }

    /**
     * @return string
     */
    public function getAnswerEn(): string
    {
        return $this->answerEn;
    }

    /**
     * @param string $answerEn
     */
    public function setAnswerEn(string $answerEn)
    {
        $this->answerEn = $answerEn;
    }

    /**
     * @return string
     */
    public function getAnswerSr(): string
    {
        return $this->answerSr;
    }

    /**
     * @param string $answerSr
     */
    public function setAnswerSr(string $answerSr)
    {
        $this->answerSr = $answerSr;
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