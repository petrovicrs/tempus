<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 02:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 * @ORM\Table(name="activity")
 */
class Activity extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="ActivityType")
     */
    protected $activityType;

    /**
     * @ORM\OneToMany(targetEntity="ActionDetails", mappedBy="activity", cascade={"persist"})
     */
    protected $actionDetails;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="is_long_term", type="boolean")
     */
    protected $isLongTerm;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="is_validated", type="boolean")
     */
    protected $isValidated;

    /**
     * @ORM\ManyToOne(targetEntity="ValidationType")
     */
    protected $validationType;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\ProjectMobilityFlows", inversedBy="activities", cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectMobilityFlows;


    public function __construct()
    {
        parent::__construct();
        $this->actionDetails = new ArrayCollection();
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
    public function getActivityType()
    {
        return $this->activityType;
    }

    /**
     * @param mixed $activityType
     */
    public function setActivityType($activityType)
    {
        $this->activityType = $activityType;
    }

    /**
     * @return mixed
     */
    public function getActionDetails()
    {
        return $this->actionDetails;
    }

    /**
     * @param mixed
     */
    public function setActionDetails($actionDetails)
    {
        $this->actionDetails = $actionDetails;
    }

    /**
     * @return mixed
     */
    public function getisLongTerm()
    {
        return $this->isLongTerm;
    }

    /**
     * @param mixed $isLongTerm
     */
    public function setIsLongTerm($isLongTerm)
    {
        $this->isLongTerm = $isLongTerm;
    }

    /**
     * @return mixed
     */
    public function getisValidated()
    {
        return $this->isValidated;
    }

    /**
     * @param mixed $isValidated
     */
    public function setIsValidated($isValidated)
    {
        $this->isValidated = $isValidated;
    }

    /**
     * @return mixed
     */
    public function getValidationType()
    {
        return $this->validationType;
    }

    /**
     * @param mixed $validationType
     */
    public function setValidationType($validationType)
    {
        $this->validationType = $validationType;
    }

    /**
     * @return mixed
     */
    public function getProjectMobilityFlows()
    {
        return $this->projectMobilityFlows;
    }

    /**
     * @param mixed $projectMobilityFlows
     */
    public function setProjectMobilityFlows($projectMobilityFlows)
    {
        $this->projectMobilityFlows = $projectMobilityFlows;
    }

    public function __toString() {
        return "";
    }
}