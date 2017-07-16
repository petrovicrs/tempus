<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonAddressRepository")
 * @ORM\Table(name="person_address")
 */
class PersonAddress extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Person",
     *      inversedBy="addresses"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $person;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="street_and_number", type="string")
     */
    protected $streetAndNumber;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="town", type="string")
     */
    protected $town;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="postal_code", type="string")
     */
    protected $postalCode;


    /**
     * @ORM\ManyToOne(targetEntity="Country")
     */
    protected $country;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="different_from_mailing_address", type="boolean")
     */
    protected $differentMailingAddress;

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
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return mixed
     */
    public function getStreetAndNumber()
    {
        return $this->streetAndNumber;
    }

    /**
     * @param mixed $streetAndNumber
     */
    public function setStreetAndNumber($streetAndNumber)
    {
        $this->streetAndNumber = $streetAndNumber;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getDifferentMailingAddress()
    {
        return $this->differentMailingAddress;
    }

    /**
     * @param mixed $differentMailingAddress
     */
    public function setDifferentMailingAddress($differentMailingAddress)
    {
        $this->differentMailingAddress = $differentMailingAddress;
    }

}