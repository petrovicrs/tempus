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

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionsRepository")
 * @ORM\Table(name="questions")
 */
class Questions extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $answer
     * @Assert\Type("string")
     * @ORM\Column(name="questions_en", type="string", length=255)
     */
    protected $questionsEn;

    /**
     * @var string $questions
     * @Assert\Type("string")
     * @ORM\Column(name="questions_sr", type="string", length=255)
     */
    protected $questionsSr;

    /**
     * @ORM\OneToMany(targetEntity="ReportingQuestionsAndAnswers", mappedBy="questions")
     */
    protected $reportingQuestionsAndAnswers;

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
    public function getQuestionsEn(): string
    {
        return $this->questionsEn;
    }

    /**
     * @param string $questionEn
     */
    public function setQuestionsEn(string $questionEn)
    {
        $this->questionsEn = $questionEn;
    }

    /**
     * @return string
     */
    public function getQuestionsSr(): string
    {
        return $this->questionsSr;
    }

    /**
     * @param string $questionSr
     */
    public function setQuestionsSr(string $questionSr)
    {
        $this->questionsSr = $questionSr;
    }

    public function getQuestions($locale) {
        if ($locale == "sr"){
            return $this->questionsSr;
        }
        return $this->questionsEn;
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
}