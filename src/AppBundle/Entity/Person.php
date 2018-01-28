<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 * @ORM\Table(name="person")
 */
class Person extends AbstractAuditable
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="first_name_en", type="string", length=255)
     */
    protected $firstNameEn;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="first_name_sr", type="string", length=255)
     */
    protected $firstNameSr;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="first_name_original_letter", type="string", length=255)
     */
    protected $firstNameOriginalLetter;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="last_name_en", type="string", length=255)
     */
    protected $lastNameEn;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="last_name_sr", type="string", length=255)
     */
    protected $lastNameSr;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="last_name_original_letter", type="string", length=255)
     */
    protected $lastNameOriginalLetter;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="initials", type="string", length=255)
     */
    protected $initials;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="title_prefix", type="string", length=255)
     */
    protected $titlePrefix;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="title_suffix", type="string", length=255)
     */
    protected $titleSuffix;

    /**
     * @ORM\ManyToOne(targetEntity="Gender")
     */
    protected $gender;

    /**
     * @ORM\Column(name="has_disability", type="boolean")
     */
    protected $hasDisability;

    /**
     * @ORM\Column(name="has_fewer_opportunities", type="boolean")
     */
    protected $hasFewerOpportunities;

    /**
     * @ORM\OneToMany(targetEntity="PersonContact", mappedBy="person", cascade={"persist"})
     */
    protected $contacts;

    /**
     * @ORM\OneToMany(targetEntity="PersonAddress", mappedBy="person", cascade={"persist"})
     */
    protected $addresses;

    /**
     * @ORM\OneToMany(targetEntity="PersonNote", mappedBy="person", cascade={"persist"})
     *
     */
    protected $personNotes;

    /**
     * @ORM\OneToMany(targetEntity="PersonDocument", mappedBy="person", cascade={"persist"})
     *
     */
    protected $personDocuments;

    /**
     * @ORM\OneToMany(targetEntity="PersonInstitutionRelationship", mappedBy="person", cascade={"persist"})
     *
     */
    protected $personInstitutionRelationships;

    /**
     * @ORM\ManyToOne(targetEntity="FieldOfExpertise")
     *
     */
    protected $fieldOfExpertise;

    /**
     * @ORM\OneToMany(targetEntity="PersonFacingSituation", mappedBy="person", cascade={"persist"})
     *
     */
    protected $personFacingSituations;

    public function __construct()
    {
        parent::__construct();
        $this->contacts = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->personNotes = new ArrayCollection();
        $this->personDocuments = new ArrayCollection();
        $this->personInstitutionRelationships = new ArrayCollection();
        $this->personFacingSituations = new ArrayCollection();
    }

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
    public function getFirstNameEn()
    {
        return $this->firstNameEn;
    }

    /**
     * @param mixed $firstNameEn
     */
    public function setFirstNameEn($firstNameEn)
    {
        $this->firstNameEn = $firstNameEn;
    }

    /**
     * @return mixed
     */
    public function getFirstNameSr()
    {
        return $this->firstNameSr;
    }

    /**
     * @param mixed $firstNameSr
     */
    public function setFirstNameSr($firstNameSr)
    {
        $this->firstNameSr = $firstNameSr;
    }

    /**
     * @return mixed
     */
    public function getFirstNameOriginalLetter()
    {
        return $this->firstNameOriginalLetter;
    }

    /**
     * @param mixed $firstNameOriginalLetter
     */
    public function setFirstNameOriginalLetter($firstNameOriginalLetter)
    {
        $this->firstNameOriginalLetter = $firstNameOriginalLetter;
    }

    /**
     * @return mixed
     */
    public function getLastNameEn()
    {
        return $this->lastNameEn;
    }

    /**
     * @param mixed $lastNameEn
     */
    public function setLastNameEn($lastNameEn)
    {
        $this->lastNameEn = $lastNameEn;
    }

    /**
     * @return mixed
     */
    public function getLastNameSr()
    {
        return $this->lastNameSr;
    }

    /**
     * @param mixed $lastNameSr
     */
    public function setLastNameSr($lastNameSr)
    {
        $this->lastNameSr = $lastNameSr;
    }

    /**
     * @return mixed
     */
    public function getLastNameOriginalLetter()
    {
        return $this->lastNameOriginalLetter;
    }

    /**
     * @param mixed $lastNameOriginalLetter
     */
    public function setLastNameOriginalLetter($lastNameOriginalLetter)
    {
        $this->lastNameOriginalLetter = $lastNameOriginalLetter;
    }

    /**
     * @return mixed
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * @param mixed $initials
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;
    }

    /**
     * @return mixed
     */
    public function getTitlePrefix()
    {
        return $this->titlePrefix;
    }

    /**
     * @param mixed $titlePrefix
     */
    public function setTitlePrefix($titlePrefix)
    {
        $this->titlePrefix = $titlePrefix;
    }

    /**
     * @return mixed
     */
    public function getTitleSuffix()
    {
        return $this->titleSuffix;
    }

    /**
     * @param mixed $titleSuffix
     */
    public function setTitleSuffix($titleSuffix)
    {
        $this->titleSuffix = $titleSuffix;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getHasDisability()
    {
        return $this->hasDisability;
    }

    /**
     * @param mixed $hasDisability
     */
    public function setHasDisability($hasDisability)
    {
        $this->hasDisability = $hasDisability;
    }

    /**
     * @return mixed
     */
    public function getHasFewerOpportunities()
    {
        return $this->hasFewerOpportunities;
    }

    /**
     * @param mixed $hasFewerOpportunities
     */
    public function setHasFewerOpportunities($hasFewerOpportunities)
    {
        $this->hasFewerOpportunities = $hasFewerOpportunities;
    }

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param mixed $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return mixed
     */
    public function getLastAddress($locale)
    {
        $addresses = $this->getAddresses();

        if (count($addresses) === 0) {
            return '';
        }

        /** @var PersonAddress $one */
        foreach ($addresses as $one) {
            return ', ' . $one->getCountry()->getName($locale);
        }
    }
    /**
     * @return mixed
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param mixed $addresses
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @return mixed
     */
    public function getPersonNotes()
    {
        return $this->personNotes;
    }

    /**
     * @param mixed $personNotes
     */
    public function setPersonNotes($personNotes)
    {
        $this->personNotes = $personNotes;
    }

    public function getFirstName($locale) {
        if ($locale == "sr"){
            return $this->firstNameSr;
        }
        return $this->firstNameEn;
    }

    public function getLastName($locale) {
        if ($locale == "sr"){
            return $this->lastNameSr;
        }
        return $this->lastNameEn;
    }

    public function getName($locale) {
        if ($locale == "sr"){
            return $this->firstNameSr . ' ' . $this->lastNameSr;
        }
        return $this->firstNameEn . ' ' . $this->lastNameEn;
    }

    public function addContact(PersonContact $personContact)
    {
        $this->contacts->add($personContact);
    }

    public function removeContact(PersonContact $personContact)
    {
        $this->contacts->removeElement($personContact);
    }

    public function addAddress(PersonAddress $personAddress)
    {
        $this->addresses->add($personAddress);
    }

    public function removeAddress(PersonAddress $personAddress)
    {
        $this->addresses->removeElement($personAddress);
    }

    public function addPersonNote(PersonNote $personNote)
    {
        $this->personNotes->add($personNote);
    }

    public function removePersonNote(PersonNote $personNote)
    {
        $this->personNotes->removeElement($personNote);
    }

    /**
     * @return mixed
     */
    public function getPersonDocuments()
    {
        return $this->personDocuments;
    }

    /**
     * @param mixed $personDocuments
     */
    public function setPersonDocuments($personDocuments)
    {
        $this->personDocuments = $personDocuments;
    }

    public function addPersonDocument(PersonDocument $personDocument)
    {
        $this->personDocuments->add($personDocument);
    }

    public function removePersonDocument(PersonDocument $personDocument)
    {
        $this->personDocuments->removeElement($personDocument);
    }

    /**
     * @return mixed
     */
    public function getPersonInstitutionRelationships()
    {
        return $this->personInstitutionRelationships;
    }

    /**
     * @param mixed $personInstitutionRelationships
     */
    public function setPersonInstitutionRelationships($personInstitutionRelationships)
    {
        $this->personInstitutionRelationships = $personInstitutionRelationships;
    }


    public function addPersonInstitutionRelationship(PersonInstitutionRelationship $personInstitutionRelationship)
    {
        $this->personInstitutionRelationships->add($personInstitutionRelationship);
    }

    public function removePersonInstitutionRelationship(PersonInstitutionRelationship $personInstitutionRelationship)
    {
        $this->personInstitutionRelationships->removeElement($personInstitutionRelationship);
    }

    /**
     * @return mixed
     */
    public function getFieldOfExpertise()
    {
        return $this->fieldOfExpertise;
    }

    /**
     * @param mixed $fieldOfExpertise
     */
    public function setFieldOfExpertise($fieldOfExpertise)
    {
        $this->fieldOfExpertise = $fieldOfExpertise;
    }

    /**
     * @return mixed
     */
    public function getPersonFacingSituations()
    {
        return $this->personFacingSituations;
    }

    /**
     * @param mixed $personFacingSituations
     */
    public function setPersonFacingSituations($personFacingSituations)
    {
        $this->personFacingSituations = $personFacingSituations;
    }

    public function addPersonFacingSituation(PersonFacingSituation $personFacingSituation)
    {
        $this->personFacingSituations->add($personFacingSituation);
    }

    public function removePersonFacingSituation(PersonFacingSituation $personFacingSituation)
    {
        $this->personFacingSituations->removeElement($personFacingSituation);
    }
}