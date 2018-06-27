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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectDeliverablesActivitiesRepository")
 * @ORM\Table(name="project_deliverables_activities")
 */
class ProjectDeliverablesActivities extends AbstractAuditable
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
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @ORM\OneToMany(targetEntity="ProjectDeliverable", mappedBy="projectDeliverablesActivities", cascade={"persist"})
     */
    protected $deliverables;

    /**
     * @ORM\OneToMany(targetEntity="ProjectActivity", mappedBy="projectDeliverablesActivities", cascade={"persist"})
     */
    protected $activities;

    public function __construct()
    {
        parent::__construct();
        $this->deliverables = new ArrayCollection();
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
    public function getDeliverables()
    {
        return $this->deliverables;
    }

    /**
     * @param mixed $deliverables
     */
    public function setDeliverables($deliverables)
    {
        $this->deliverables = $deliverables;
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
}