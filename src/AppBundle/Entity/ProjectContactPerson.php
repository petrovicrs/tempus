<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\ProjectKeyAction;
use AppBundle\Entity\ProjectAction;
use AppBundle\Entity\ProjectCall;
use AppBundle\Entity\ProjectRound;
use AppBundle\Entity\ProjectNoteType;
use AppBundle\Entity\ProjectTypeOfLimitation;
use AppBundle\Entity\ProjectTopic;
use AppBundle\Entity\ProjectSubjectArea;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectContactPersonRepository")
 * @ORM\Table(name="project_contact_persons")
 */
class ProjectContactPerson extends AbstractAuditable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Person"
     * )
     */
    protected $person;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project"
     * )
     */
    protected $project;

    /**
     * @return int
     */
    public function getId(): int
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

}

