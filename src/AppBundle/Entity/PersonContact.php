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
     * @Assert\NotBlank()
     * @Assert\Type("numeric")
     * @ORM\Column(name="contact_type", type="integer")
     */
    protected $contactType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="contact_value", type="string")
     */
    protected $contactValue;


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
     * Set contactType
     *
     * @param integer $contactType
     *
     * @return PersonContact
     */
    public function setContactType($contactType)
    {
        $this->contactType = $contactType;

        return $this;
    }

    /**
     * Get contactType
     *
     * @return integer
     */
    public function getContactType()
    {
        return $this->contactType;
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
}

