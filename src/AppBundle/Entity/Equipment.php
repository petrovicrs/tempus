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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipmentRepository")
 * @ORM\Table(name="equipment")
 */
class Equipment extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="Institution")
     */
    protected $institution;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="model", type="text")
     */
    protected $model;

    /**
     * @ORM\ManyToOne(targetEntity="EquipmentType")
     */
    protected $equipmentType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="quantity", type="text")
     */
    protected $quantity;

    /**
     * @ORM\Column(name="purchase_date", type="datetime")
     */
    protected $purchaseDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="inventoryNumber", type="text")
     */
    protected $inventoryNumber;

    /**
     * @ORM\Column(name="title_sr", type="string")
     */
    protected $titleSr;

    /**
     * @ORM\Column(name="title_en", type="string")
     */
    protected $titleEn;

    /**
     * @ORM\Column(name="description_sr", type="text")
     */
    protected $descriptionSr;

    /**
     * @ORM\Column(name="description_en", type="text")
     */
    protected $descriptionEn;

    /**
     * @ORM\Column(name="location_sr", type="string")
     */
    protected $locationSr;

    /**
     * @ORM\Column(name="location_en", type="string")
     */
    protected $locationEn;

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
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * @param mixed $institution
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;
    }


    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getEquipmentType()
    {
        return $this->equipmentType;
    }

    /**
     * @param mixed $equipmentType
     */
    public function setEquipmentType($equipmentType)
    {
        $this->equipmentType = $equipmentType;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @param mixed $purchaseDate
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }

    /**
     * @return mixed
     */
    public function getInventoryNumber()
    {
        return $this->inventoryNumber;
    }

    /**
     * @param mixed $inventoryNumber
     */
    public function setInventoryNumber($inventoryNumber)
    {
        $this->inventoryNumber = $inventoryNumber;
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
    public function getLocationSr()
    {
        return $this->locationSr;
    }

    /**
     * @param mixed $locationSr
     */
    public function setLocationSr($locationSr)
    {
        $this->locationSr = $locationSr;
    }

    /**
     * @return mixed
     */
    public function getLocationEn()
    {
        return $this->locationEn;
    }

    /**
     * @param mixed $locationEn
     */
    public function setLocationEn($locationEn)
    {
        $this->locationEn = $locationEn;
    }
}