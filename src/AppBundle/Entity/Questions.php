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
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\ReportingQuestionsAndAnswers",
     *      inversedBy="questions"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
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

    public function getQuestion($locale) {
        if ($locale == "sr"){
            return $this->questionSr;
        }
        return $this->questionEn;
    }
}