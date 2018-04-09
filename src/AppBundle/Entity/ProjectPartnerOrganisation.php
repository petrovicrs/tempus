<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectPartnerOrganisationRepository")
 * @ORM\Table(name="project_partner_organisations")
 */
class ProjectPartnerOrganisation extends AbstractAuditable
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
     */
    protected $organisation;

    /**
     * @ORM\Column(name="associated_partner", type="boolean", nullable=true)
     */
    protected $associatedPartner;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project",
     *      inversedBy="partnerOrganisations"
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

    /**
     * @return mixed
     */
    public function getAssociatedPartner()
    {
        return $this->associatedPartner;
    }

    /**
     * @param mixed $associatedPartner
     */
    public function setAssociatedPartner($associatedPartner)
    {
        $this->associatedPartner = $associatedPartner;
    }

}