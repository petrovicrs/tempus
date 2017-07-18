<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonNoteRepository")
 * @ORM\Table(name="person_note")
 */
class PersonNote extends AbstractAuditable
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
     *      inversedBy="personNotes"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="PersonNoteType")
     */
    protected $personNoteType;


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
    public function getPersonNoteType()
    {
        return $this->personNoteType;
    }

    /**
     * @param mixed $personNoteType
     */
    public function setPersonNoteType($personNoteType)
    {
        $this->personNoteType = $personNoteType;
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