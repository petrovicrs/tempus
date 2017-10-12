<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.10.17
 * Time: 11:49
 */

namespace AppBundle\Entity;

use AppBundle\Entity\AbstractAuditable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectMonitoringReportingRepository")
 * @ORM\Table(name="project_monitoring_reporting")
 */
class ProjectMonitoringReporting extends AbstractAuditable
{
    /**
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MonitoringReporting", mappedBy="projectMonitoringReporting", cascade={"persist"})
     */
    protected $monitoringReporting;

    public function __construct()
    {
        parent::__construct();
        $this->monitoringReporting = new ArrayCollection();
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
    public function getMonitoringReporting()
    {
        return $this->monitoringReporting;
    }

    /**
     * @param mixed $monitoringReporting
     */
    public function setMonitoringReporting($monitoringReporting)
    {
        $this->monitoringReporting = $monitoringReporting;
    }
}