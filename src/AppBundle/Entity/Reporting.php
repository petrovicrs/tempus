<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 20:42
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportingRepository")
 * @ORM\Table(name="reporting")
 */
class Reporting extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectReporting",
//     *      inversedBy="reporting",
//     *      cascade={"persist"}
//     * )
//     * @ORM\JoinColumn(onDelete="CASCADE")
//     */
//    protected $projectReporting;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectReportingProveraDokumentacije",
//     *      inversedBy="reporting",
//     *      cascade={"persist"}
//     * )
//     * @ORM\JoinColumn(onDelete="CASCADE")
//     */
//    protected $projectReportingProveraDokumentacije;


    /**
     * @ORM\ManyToOne(targetEntity="ReportingType")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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