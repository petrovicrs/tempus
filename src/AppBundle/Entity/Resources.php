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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResourcesRepository")
 * @ORM\Table(name="resources")
 */
class Resources extends AbstractAuditable
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
     * @ORM\ManyToOne(targetEntity="ResourceType")
     */
    protected $resourceType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="keywords", type="string")
     */
    protected $keywords;

    /**
     * @ORM\Column(name="is_public", type="boolean")
     */
    protected $isPublic;

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
     * @ORM\Column(name="abstract", type="text")
     */
    protected $abstract;

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
    public function getResourceType()
    {
        return $this->resourceType;
    }

    /**
     * @param mixed $resourceType
     */
    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
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
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param mixed $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
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
}