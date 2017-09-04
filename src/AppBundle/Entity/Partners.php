<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 22:42
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnersRepository")
 * @ORM\Table(name="partners")
 */
class Partners extends AbstractAuditable
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Institution")
     */
    protected $institution;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PartnerType")
     */
    protected $partnerType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person")
     */
    protected $projectCoordinator;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person")
     */
    protected $legalRepresentative;

    /**
     * @ORM\Column(name="is_associated_partner", type="boolean")
     */
    protected $isAssociatedPartner;

    /**
     * @ORM\Column(name="is_without_team", type="boolean")
     */
    protected $isWithoutTeam;

    /**
     * @ORM\OneToMany(targetEntity="PartnersTeamMembers", mappedBy="partners", cascade={"persist"})
     */
    protected $teamMembers;

    /**
     * @ORM\Column(name="all_departments", type="boolean")
     */
    protected $allDepartments;

    /**
     * @ORM\OneToMany(targetEntity="PartnersTeamDepartments", mappedBy="partners")
     */
    protected $teamDepartments;

    /**
     * @ORM\OneToMany(targetEntity="PartnersParticipants", mappedBy="partners", cascade={"persist"})
     */
    protected $participants;

    public function __construct()
    {
        parent::__construct();
        $this->teamMembers = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

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
    public function getPartnerType()
    {
        return $this->partnerType;
    }

    /**
     * @param mixed $partnerType
     */
    public function setPartnerType($partnerType)
    {
        $this->partnerType = $partnerType;
    }

    /**
     * @return mixed
     */
    public function getProjectCoordinator()
    {
        return $this->projectCoordinator;
    }

    /**
     * @param mixed $projectCoordinator
     */
    public function setProjectCoordinator($projectCoordinator)
    {
        $this->projectCoordinator = $projectCoordinator;
    }

    /**
     * @return mixed
     */
    public function getLegalRepresentative()
    {
        return $this->legalRepresentative;
    }

    /**
     * @param mixed $legalRepresentative
     */
    public function setLegalRepresentative($legalRepresentative)
    {
        $this->legalRepresentative = $legalRepresentative;
    }

    /**
     * @return mixed
     */
    public function getisAssociatedPartner()
    {
        return $this->isAssociatedPartner;
    }

    /**
     * @param mixed $isAssociatedPartner
     */
    public function setIsAssociatedPartner($isAssociatedPartner)
    {
        $this->isAssociatedPartner = $isAssociatedPartner;
    }

    /**
     * @return mixed
     */
    public function getisWithoutTeam()
    {
        return $this->isWithoutTeam;
    }

    /**
     * @param mixed $isWithoutTeam
     */
    public function setIsWithoutTeam($isWithoutTeam)
    {
        $this->isWithoutTeam = $isWithoutTeam;
    }

    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        return $this->teamMembers;
    }

    /**
     * @param mixed $teamMembers
     */
    public function setTeamMembers($teamMembers)
    {
        $this->teamMembers = $teamMembers;
    }

    public function addTeamMembers(PartnersTeamMembers $teamMember)
    {
        $this->teamMembers->add($teamMember);
    }

    public function removeTeamMembers(PartnersTeamMembers $teamMember)
    {
        $this->teamMembers->removeElement($teamMember);
    }

    /**
     * @return mixed
     */
    public function getAllDepartments()
    {
        return $this->allDepartments;
    }

    /**
     * @param mixed $allDepartments
     */
    public function setAllDepartments($allDepartments)
    {
        $this->allDepartments = $allDepartments;
    }

    /**
     * @return mixed
     */
    public function getTeamDepartments()
    {
        return $this->teamDepartments;
    }

    /**
     * @param mixed $teamDepartments
     */
    public function setTeamDepartments($teamDepartments)
    {
        $this->teamDepartments = $teamDepartments;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    public function addParticipants(PartnersParticipants $participant)
    {
        $this->participants->add($participant);
    }

    public function removeParticipants(PartnersParticipants $participant)
    {
        $this->participants->removeElement($participant);
    }

    public function __toString() {
        return "";
    }
}