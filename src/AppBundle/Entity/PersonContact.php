<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonContactRepository")
 * @ORM\Table(name="person_contact")
 */
class PersonContact extends AbstractAuditable
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
     *      inversedBy="contacts"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="ContactType")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $contactType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="contact_value", type="string")
     */
    protected $contactValue;

    /**
     * @ORM\Column(name="note", type="string", nullable=true)
     */
    protected $note;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="is_public", type="boolean")
     */
    protected $isPublic;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="is_primary", type="boolean")
     */
    protected $isPrimary;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set person
     *
     * @param $person
     *
     * @return PersonContact
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return integer
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return mixed
     */
    public function getContactType()
    {
        return $this->contactType;
    }

    /**
     * @param mixed $contactType
     */
    public function setContactType($contactType)
    {
        $this->contactType = $contactType;
    }



    /**
     * Set contactValue
     *
     * @param integer $contactValue
     *
     * @return PersonContact
     */
    public function setContactValue($contactValue)
    {
        $this->contactValue = $contactValue;

        return $this;
    }

    /**
     * Get contactValue
     *
     * @return integer
     */
    public function getContactValue()
    {
        return $this->contactValue;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
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
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * @param mixed $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }


    public function __toString() {
        return "";
    }

}

