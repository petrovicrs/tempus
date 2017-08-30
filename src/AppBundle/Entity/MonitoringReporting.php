<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 15:47
 */

namespace AppBundle\Entity;


use AppBundle\Entity\AbstractAuditable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MonitoringReportingRepository")
 * @ORM\Table(name="monitoring_reporting")
 */
class MonitoringReporting extends AbstractAuditable
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
     * @ORM\ManyToOne(targetEntity="ReportingType")
     */
    protected $monitoringType;

    /**
     * @ORM\Column(name="monitoring_date", type="datetime", nullable=true)
     */
    protected $monitoringDate;

    /**
     * @ORM\ManyToOne(targetEntity="CommentType")
     */
    protected $commentType;

    /**
     * @ORM\Column(name="comment", type="text", nullable=true)
     * @Assert\Type("string")
     */
    protected $comment;

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
    public function getMonitoringType()
    {
        return $this->monitoringType;
    }

    /**
     * @param mixed $monitoringType
     */
    public function setMonitoringType($monitoringType)
    {
        $this->monitoringType = $monitoringType;
    }

    /**
     * @return mixed
     */
    public function getMonitoringDate()
    {
        return $this->monitoringDate;
    }

    /**
     * @param mixed $monitoringDate
     */
    public function setMonitoringDate($monitoringDate)
    {
        $this->monitoringDate = $monitoringDate;
    }

    /**
     * @return mixed
     */
    public function getCommentType()
    {
        return $this->commentType;
    }

    /**
     * @param mixed $commentType
     */
    public function setCommentType($commentType)
    {
        $this->commentType = $commentType;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
}