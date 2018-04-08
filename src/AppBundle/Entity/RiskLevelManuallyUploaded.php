<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 30.08.17
 * Time: 23:28
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RiskLevelManuallyUploadedRepository")
 * @ORM\Table(name="risk_level_manually_uploaded")
 */
class RiskLevelManuallyUploaded extends AbstractAuditable
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="file", type="string", length=255, unique=true)
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $originalFileName;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="InstitutionRiskLevel", inversedBy="manuallyUploadedFiles")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institutionRiskLevel;

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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getOriginalFileName()
    {
        return $this->originalFileName;
    }

    /**
     * @param mixed $originalFileName
     */
    public function setOriginalFileName($originalFileName)
    {
        $this->originalFileName = $originalFileName;
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
    public function getInstitutionRiskLevel()
    {
        return $this->institutionRiskLevel;
    }

    /**
     * @param mixed $institutionRiskLevel
     */
    public function setInstitutionRiskLevel($institutionRiskLevel)
    {
        $this->institutionRiskLevel = $institutionRiskLevel;
    }
}