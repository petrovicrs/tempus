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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectApplicantOrganisationRepository")
 * @ORM\Table(name="project_applicant_organisations")
 */
class ProjectApplicantOrganisation extends AbstractAuditable
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
     *      targetEntity="Institution"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $organisation;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project",
     *      inversedBy="applicationOrganisations"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
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
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * @param mixed $organisation
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;
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

