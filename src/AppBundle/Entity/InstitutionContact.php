<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionContactRepository")
 * @ORM\Table(name="institution_contacts")
 */
class InstitutionContact extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution",
     *      inversedBy="contacts"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ContactType"
     * )
     */
    protected $contactType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="contact_value", type="string")
     */
    protected $contactValue;

    /**
     * @ORM\Column(name="is_public", type="boolean")
     */
    protected $isPublic;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="note", type="string")
     */
    protected $note;

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
     * @return mixed
     */
    public function getContactValue()
    {
        return $this->contactValue;
    }

    /**
     * @param mixed $contactValue
     */
    public function setContactValue($contactValue)
    {
        $this->contactValue = $contactValue;
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

}

