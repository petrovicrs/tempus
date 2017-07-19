<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonInstitutionRelationshipRepository")
 * @ORM\Table(name="person_institution_relationship")
 */
class PersonInstitutionRelationship extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Person",
     *      inversedBy="addresses"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $person;


    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution",
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;


    /**
     * @ORM\ManyToOne(targetEntity="PersonInstitutionRelationshipType")
     */
    protected $personInstitutionRelationshipType;

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
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
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
    public function getPersonInstitutionRelationshipType()
    {
        return $this->personInstitutionRelationshipType;
    }

    /**
     * @param mixed $personInstitutionRelationshipType
     */
    public function setPersonInstitutionRelationshipType($personInstitutionRelationshipType)
    {
        $this->personInstitutionRelationshipType = $personInstitutionRelationshipType;
    }



}


