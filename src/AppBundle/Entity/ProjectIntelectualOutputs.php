<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.10.17
 * Time: 23:29
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectIntelectualOutputsRepository")
 * @ORM\Table(name="project_intelectual_outputs")
 */
class ProjectIntelectualOutputs extends AbstractAuditable
{
    /**
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\IntelectualOutputs", mappedBy="projectIntelectualOutputs", cascade={"persist"})
     */
    protected $intelectualOutputs;

    /**
     * ProjectIntelectualOutputs constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->intelectualOutputs = new ArrayCollection();
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
    public function getIntelectualOutputs()
    {
        return $this->intelectualOutputs;
    }

    /**
     * @param mixed
     */
    public function setIntelectualOutputs($intelectualOutputs)
    {
        $this->intelectualOutputs = $intelectualOutputs;
    }
}