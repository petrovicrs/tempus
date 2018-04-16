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
     * @ORM\ManyToOne(targetEntity="ProjectPartners", inversedBy="partners")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectPartners;

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
     * @ORM\Column(name="without_team", type="boolean")
     */
    protected $withoutTeam;

    /**
     * @ORM\Column(name="budget", type="string", length=64)
     */
    protected $budget;

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

    public function __construct()
    {
        parent::__construct();
        $this->teamMembers = new ArrayCollection();
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
    public function getProjectPartners()
    {
        return $this->projectPartners;
    }

    /**
     * @param mixed $projectPartners
     */
    public function setProjectPartners($projectPartners)
    {
        $this->projectPartners = $projectPartners;
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
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getIsWithoutTeam()
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

    public function __toString() {
        return "";
    }

    /**
     * @return mixed
     */
    public function getWithoutTeam()
    {
        return $this->withoutTeam;
    }

    /**
     * @param mixed $withoutTeam
     */
    public function setWithoutTeam($withoutTeam)
    {
        $this->withoutTeam = $withoutTeam;
    }

}