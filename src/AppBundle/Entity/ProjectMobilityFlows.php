<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/16/17
 * Time: 2:44 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectMobilityFlowsRepository")
 * @ORM\Table(name="project_mobility_flows")
 */
class ProjectMobilityFlows extends AbstractAuditable
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Activity", mappedBy="projectMobilityFlows", cascade={"persist"})
     */
    protected $activities;


    public function __construct()
    {
        parent::__construct();
        $this->activities = new ArrayCollection();
    }

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
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param mixed $activities
     */
    public function setActivities($activities)
    {
        $this->activities = $activities;
    }

    public function __toString() {
        return "";
    }
}