<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectContactRepository")
 * @ORM\Table(name="project_contacts")
 */
class ProjectContact extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project",
     *      inversedBy="contacts"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ContactType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
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

}

