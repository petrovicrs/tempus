<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionAccreditationRepository")
 * @ORM\Table(name="institution_accreditations")
 */
class InstitutionAccreditation extends AbstractAuditable
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
     *      inversedBy="accreditations"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="InstitutionAccreditationType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $accreditationType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="accreditation_reference", type="string")
     */
    protected $accreditationReference;

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
    public function getAccreditationType()
    {
        return $this->accreditationType;
    }

    /**
     * @param mixed $accreditationType
     */
    public function setAccreditationType($accreditationType)
    {
        $this->accreditationType = $accreditationType;
    }

    /**
     * @return mixed
     */
    public function getAccreditationReference()
    {
        return $this->accreditationReference;
    }

    /**
     * @param mixed $accreditationReference
     */
    public function setAccreditationReference($accreditationReference)
    {
        $this->accreditationReference = $accreditationReference;
    }

}

