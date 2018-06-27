<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 10:55
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultsRepository")
 * @ORM\Table(name="results")
 */
class Results extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectResults", inversedBy="results")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectResults;

    /**
     * @ORM\ManyToOne(targetEntity="ResultType")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $resultType;

    /**
     * @ORM\ManyToOne(targetEntity="ResultStatus")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $resultStatus;

    /**
     * @ORM\Column(name="is_public", type="boolean")
     */
    protected $isPublic;

    /**
     * @ORM\Column(name="show_description", type="boolean")
     */
    protected $showDescription;

    /**
     * @ORM\Column(name="title_sr", type="string", nullable=true)
     */
    protected $titleSr;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="title_en", type="string")
     */
    protected $titleEn;

    /**
     * @ORM\Column(name="description_sr", type="string", nullable=true)
     */
    protected $descriptionSr;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="description_en", type="string")
     */
    protected $descriptionEn;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="notes", type="text")
     */
    protected $notes;

    //TODO Add attachment entity
    //protected $atachments;

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
    public function getProjectResults()
    {
        return $this->projectResults;
    }

    /**
     * @param mixed $projectResults
     */
    public function setProjectResults($projectResults)
    {
        $this->projectResults = $projectResults;
    }

    /**
     * @return mixed
     */
    public function getResultType()
    {
        return $this->resultType;
    }

    /**
     * @param mixed $resultType
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;
    }

    /**
     * @return mixed
     */
    public function getResultStatus()
    {
        return $this->resultStatus;
    }

    /**
     * @param mixed $resultStatus
     */
    public function setResultStatus($resultStatus)
    {
        $this->resultStatus = $resultStatus;
    }

    /**
     * @return mixed
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * @param mixed $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return mixed
     */
    public function getShowDescription()
    {
        return $this->showDescription;
    }

    /**
     * @param mixed $showDescription
     */
    public function setShowDescription($showDescription)
    {
        $this->showDescription = $showDescription;
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
    public function getDescriptionSr()
    {
        return $this->descriptionSr;
    }

    /**
     * @param mixed $descriptionSr
     */
    public function setDescriptionSr($descriptionSr)
    {
        $this->descriptionSr = $descriptionSr;
    }

    /**
     * @return mixed
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param mixed $descriptionEn
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getTitle($locale)
    {
        if($locale == 'sr') {
            return $this->titleSr;
        }
        else {
            return $this->titleEn;
        }
    }

    public function getDescription($locale)
    {
        if($locale == 'sr') {
            return $this->descriptionSr;
        }
        else {
            return $this->descriptionEn;
        }
    }
}