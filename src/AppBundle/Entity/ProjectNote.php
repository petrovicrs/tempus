<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectNoteRepository")
 * @ORM\Table(name="project_notes")
 */
class ProjectNote extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="project"
     * )
     */
    protected $project;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="projectNoteType"
     * )
     */
    protected $noteType;

    /**
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
    public function getNoteType()
    {
        return $this->noteType;
    }

    /**
     * @param mixed $noteType
     */
    public function setNoteType($noteType)
    {
        $this->noteType = $noteType;
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

