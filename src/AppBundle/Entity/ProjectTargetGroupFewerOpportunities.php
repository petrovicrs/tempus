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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectTargetGroupFewerOpportunitiesRepository")
 * @ORM\Table(name="project_target_group_fewer_opportunities")
 */
class ProjectTargetGroupFewerOpportunities extends AbstractAuditable
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
     *      targetEntity="ProjectTargetGroupType"
     * )
     */
    protected $targetGroup;

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
    public function getTargetGroup()
    {
        return $this->targetGroup;
    }

    /**
     * @param mixed $targetGroup
     */
    public function setTargetGroup($targetGroup)
    {
        $this->targetGroup = $targetGroup;
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

