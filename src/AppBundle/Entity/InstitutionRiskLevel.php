<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 08.10.17
 * Time: 00:38
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionRiskLevelRepository")
 * @ORM\Table(name="institution_risk_level")
 */
class InstitutionRiskLevel extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution",
     *      inversedBy="riskLevel"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;

    /**
     * @ORM\ManyToOne(targetEntity="InstitutionRiskLevelType")
     */
    protected $riskLevelType;

    /**
     * @ORM\OneToMany(targetEntity="RiskLevelManuallyUploaded", mappedBy="institutionRiskLevel", cascade={"persist"})
     */
    protected $manuallyUploadedFiles;

    public function __construct()
    {
        parent::__construct();
        $this->riskLevelType = new ArrayCollection();
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
    public function getRiskLevelType()
    {
        return $this->riskLevelType;
    }

    /**
     * @param mixed $riskLevelType
     */
    public function setRiskLevelType($riskLevelType)
    {
        $this->riskLevelType = $riskLevelType;
    }

    /**
     * @return mixed
     */
    public function getManuallyUploadedFiles()
    {
        return $this->manuallyUploadedFiles;
    }

    /**
     * @param mixed $manuallyUploadedFiles
     */
    public function setManuallyUploadedFiles($manuallyUploadedFiles)
    {
        $this->manuallyUploadedFiles = $manuallyUploadedFiles;
    }
}