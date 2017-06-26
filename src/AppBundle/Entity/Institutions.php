<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/21/17
 * Time: 7:45 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionsRepository")
 * @ORM\Table(name="institutions")
 */
class Institutions extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="parent_institution", type="integer")
     */
    protected $parentInstitution;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="founder", type="string")
     */
    protected $founder;

    /**
     * @ORM\Column(name="name_original_letter", type="string")
     */
    protected $nameOriginalLetter;

    /**
     * @ORM\Column(name="founder_original_letter", type="string")
     */
    protected $founderOriginalLetter;

    /**
     * @ORM\Column(name="legal_representative", type="string")
     */
    protected $legalRepresentative;

    /**
     * @ORM\Column(name="contact_person", type="string")
     */
    protected $contactPerson;

    /**
     * @ORM\Column(name="pic_number", type="string")
     */
    protected $picNumber;

    /**
     * @ORM\Column(name="registration_number", type="string")
     */
    protected $registrationNumber;

    /**
     * @ORM\Column(name="vat_number", type="string")
     */
    protected $vatNumber;

    /**
     * @ORM\Column(name="hierarchy_level", type="string")
     */
    protected $hierarchyLevel;

    /**
     * @ORM\Column(name="institution_type", type="integer")
     */
    protected $institutionType;

    /**
     * @ORM\Column(name="country", type="integer")
     */
    protected $country;

    /**
     * @ORM\Column(name="founder_type", type="integer")
     */
    protected $founderType;

    /**
     * @ORM\Column(name="founder_country", type="integer")
     */
    protected $founderCountry;

    /**
     * @ORM\Column(name="address", type="string")
     */
    protected $address;

    /**
     * @ORM\Column(name="postal_code", type="string")
     */
    protected $postalCode;

    /**
     * @ORM\Column(name="city", type="integer")
     */
    protected $city;

    /**
     * @ORM\Column(name="web_site", type="string")
     */
    protected $webSite;

    /**
     * @ORM\Column(name="belonging_to_group", type="string")
     */
    protected $belongingToGroup;

    /**
     * @ORM\Column(name="note", type="string")
     */
    protected $note;

    /**
     * @ORM\Column(name="accreditation", type="string")
     */
    protected $accreditation;

    /**
     * @ORM\Column(name="accreditation_valid_from", type="datetime")
     */
    protected $accreditationValidFrom;

    /**
     * @ORM\Column(name="accreditation_valid_to", type="datetime")
     */
    protected $accreditationValidTo;

    /**
     * @ORM\Column(name="accreditor", type="string")
     */
    protected $accreditor;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getParentInstitution()
    {
        return $this->parentInstitution;
    }

    /**
     * @param mixed $parentInstitution
     */
    public function setParentInstitution($parentInstitution)
    {
        $this->parentInstitution = $parentInstitution;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFounder()
    {
        return $this->founder;
    }

    /**
     * @param mixed $founder
     */
    public function setFounder($founder)
    {
        $this->founder = $founder;
    }

    /**
     * @return mixed
     */
    public function getNameOriginalLetter()
    {
        return $this->nameOriginalLetter;
    }

    /**
     * @param mixed $nameOriginalLetter
     */
    public function setNameOriginalLetter($nameOriginalLetter)
    {
        $this->nameOriginalLetter = $nameOriginalLetter;
    }

    /**
     * @return mixed
     */
    public function getFounderOriginalLetter()
    {
        return $this->founderOriginalLetter;
    }

    /**
     * @param mixed $founderOriginalLetter
     */
    public function setFounderOriginalLetter($founderOriginalLetter)
    {
        $this->founderOriginalLetter = $founderOriginalLetter;
    }

    /**
     * @return mixed
     */
    public function getLegalRepresentative()
    {
        return $this->legalRepresentative;
    }

    /**
     * @param mixed $legalRepresentative
     */
    public function setLegalRepresentative($legalRepresentative)
    {
        $this->legalRepresentative = $legalRepresentative;
    }

    /**
     * @return mixed
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param mixed $contactPerson
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return mixed
     */
    public function getPicNumber()
    {
        return $this->picNumber;
    }

    /**
     * @param mixed $picNumber
     */
    public function setPicNumber($picNumber)
    {
        $this->picNumber = $picNumber;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param mixed $registrationNumber
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @return mixed
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @param mixed $vatNumber
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @return mixed
     */
    public function getHierarchyLevel()
    {
        return $this->hierarchyLevel;
    }

    /**
     * @param mixed $hierarchyLevel
     */
    public function setHierarchyLevel($hierarchyLevel)
    {
        $this->hierarchyLevel = $hierarchyLevel;
    }

    /**
     * @return mixed
     */
    public function getInstitutionType()
    {
        return $this->institutionType;
    }

    /**
     * @param mixed $institutionType
     */
    public function setInstitutionType($institutionType)
    {
        $this->institutionType = $institutionType;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getFounderType()
    {
        return $this->founderType;
    }

    /**
     * @param mixed $founderType
     */
    public function setFounderType($founderType)
    {
        $this->founderType = $founderType;
    }

    /**
     * @return mixed
     */
    public function getFounderCountry()
    {
        return $this->founderCountry;
    }

    /**
     * @param mixed $founderCountry
     */
    public function setFounderCountry($founderCountry)
    {
        $this->founderCountry = $founderCountry;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

    /**
     * @param mixed $webSite
     */
    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;
    }

    /**
     * @return mixed
     */
    public function getBelongingToGroup()
    {
        return $this->belongingToGroup;
    }

    /**
     * @param mixed $belongingToGroup
     */
    public function setBelongingToGroup($belongingToGroup)
    {
        $this->belongingToGroup = $belongingToGroup;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getAccreditation()
    {
        return $this->accreditation;
    }

    /**
     * @param mixed $accreditation
     */
    public function setAccreditation($accreditation)
    {
        $this->accreditation = $accreditation;
    }

    /**
     * @return mixed
     */
    public function getAccreditationValidFrom()
    {
        return $this->accreditationValidFrom;
    }

    /**
     * @param mixed $accreditationValidFrom
     */
    public function setAccreditationValidFrom($accreditationValidFrom)
    {
        $this->accreditationValidFrom = $accreditationValidFrom;
    }

    /**
     * @return mixed
     */
    public function getAccreditationValidTo()
    {
        return $this->accreditationValidTo;
    }

    /**
     * @param mixed $accreditationValidTo
     */
    public function setAccreditationValidTo($accreditationValidTo)
    {
        $this->accreditationValidTo = $accreditationValidTo;
    }

    /**
     * @return mixed
     */
    public function getAccreditor()
    {
        return $this->accreditor;
    }

    /**
     * @param mixed $accreditor
     */
    public function setAccreditor($accreditor)
    {
        $this->accreditor = $accreditor;
    }


}