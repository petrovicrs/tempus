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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntelectualOutputsRepository")
 * @ORM\Table(name="intelectual_outputs")
 */
class IntelectualOutputs extends AbstractAuditable
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
     * @ORM\ManyToOne(targetEntity="IntelectualOutputsType")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="IntelectualOutputsStatus")
     */
    protected $status;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="due_date", type="datetime")
     */
    protected $dueDate;

    /**
     * @ORM\Column(name="is_public", type="boolean")
     */
    protected $isPublic;

    /**
     * @ORM\Column(name="e_link_available", type="boolean")
     */
    protected $eLinkAvailable;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="title_sr", type="string")
     */
    protected $titleSr;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="title_en", type="string")
     */
    protected $titleEn;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="description_sr", type="string")
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
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
    public function getELinkAvailable()
    {
        return $this->eLinkAvailable;
    }

    /**
     * @param mixed $eLinkAvailable
     */
    public function setELinkAvailable($eLinkAvailable)
    {
        $this->eLinkAvailable = $eLinkAvailable;
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