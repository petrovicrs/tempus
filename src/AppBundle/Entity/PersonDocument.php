<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonDocumentRepository")
 * @ORM\Table(name="person_document")
 */
class PersonDocument extends AbstractAuditable
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
     *      inversedBy="documents"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="PersonDocumentType")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $personDocumentType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="value", type="string")
     */
    protected $value;

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
    public function getPersonDocumentType()
    {
        return $this->personDocumentType;
    }

    /**
     * @param mixed $personDocumentType
     */
    public function setPersonDocumentType($personDocumentType)
    {
        $this->personDocumentType = $personDocumentType;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }



}