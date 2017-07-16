<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/6/17
 * Time: 10:30 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\DBAL\Types\BooleanType;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PicNumberRepository")
 * @ORM\Table(name="pic_numbers")
 */
class PicNumber extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="number", type="string")
     */
    protected $number;

    /**
     * @ORM\Column(name="validated", type="boolean")
     */
    protected $validated;

    /**
     * @ORM\Column(name="primary", type="boolean")
     */
    protected $primary;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution",
     *      inversedBy="picNumbers"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * @return mixed
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param mixed $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }


}