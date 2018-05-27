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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DifficultiesParticipantsAreFacingRepository")
 * @ORM\Table(name="difficulties_participants_facing")
 */
class DifficultiesParticipantsAreFacing extends AbstractAuditable
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
     *      targetEntity="DifficultyType"
     * )
     */
    protected $difficultyType;

    /**
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project",
     *      inversedBy="projectTargetGroup"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @return int
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
    public function getDifficultyType()
    {
        return $this->difficultyType;
    }

    /**
     * @param mixed $difficultyType
     */
    public function setDifficultyType($difficultyType)
    {
        $this->difficultyType = $difficultyType;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}

