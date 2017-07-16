<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionNoteRepository")
 * @ORM\Table(name="institution_notes")
 */
class InstitutionNote extends AbstractAuditable
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
     *      inversedBy="notes"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="InstitutionNoteType"
     * )
     */
    protected $institutionNoteType;

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
    public function getInstitutionNoteType()
    {
        return $this->institutionNoteType;
    }

    /**
     * @param mixed $institutionNoteType
     */
    public function setInstitutionNoteType($institutionNoteType)
    {
        $this->institutionNoteType = $institutionNoteType;
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

