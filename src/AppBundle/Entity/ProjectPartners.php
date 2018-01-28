<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.10.17
 * Time: 23:48
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectPartnersRepository")
 * @ORM\Table(name="project_partners")
 */
class ProjectPartners extends AbstractAuditable
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
     * @ORM\OneToMany(targetEntity="Partners", mappedBy="projectPartners", cascade={"persist"})
     */
    protected $partners;

    /**
     * @ORM\OneToMany(targetEntity="PartnersParticipants", mappedBy="projectPartners", cascade={"persist"})
     */
    protected $participants;

    public function __construct()
    {
        parent::__construct();
        $this->partners = new ArrayCollection();
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
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * @param mixed $partners
     */
    public function setPartners($partners)
    {
        $this->partners = $partners;
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
}