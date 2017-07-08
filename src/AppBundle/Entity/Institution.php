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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionRepository")
 * @ORM\Table(name="institution")
 */
class Institution extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="parent_institution", type="string")
     */
    protected $parentInstitution;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="nameEn", type="string")
     */
    protected $nameEn;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="nameSr", type="string")
     */
    protected $nameSr;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="acronym", type="string")
     */
    protected $acronym;

//    /**
//     * @ORM\Column(name="founder", type="string")
//     */
//    protected $founder;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="name_original_letter", type="string")
     */
    protected $nameOriginalLetter;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="founder_original_letter", type="string")
     */
    protected $founderOriginalLetter;
//
//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="legal_representative", type="string")
//     */
//    protected $legalRepresentative;

//    /**
//     * @ORM\OneToOne(targetEntity="Person", inversedBy="person")
//     * @ORM\JoinColumn(name="contact_person", referencedColumnName="id")
//     */
//    protected $contactPerson;
//
    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="pic_number", type="string")
     */
    protected $picNumber;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="national_registration_number", type="string")
     */
    protected $nationalRegistrationNumber;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="vat_number", type="string")
     */
    protected $vatNumber;

//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="hierarchy_level", type="string")
//     */
//    protected $hierarchyLevel;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="institution_type", type="string")
     */
    protected $institutionType;

//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="country", type="string")
//     */
//    protected $country;

//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="founder_type", type="string")
//     */
//    protected $founderType;

//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="founder_country", type="string")
//     */
//    protected $founderCountry;
//
//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="address", type="string")
//     */
//    protected $address;
//
//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="postal_code", type="string")
//     */
//    protected $postalCode;
//
//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="city", type="string")
//     */
//    protected $city;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="web_site", type="string")
     */
    protected $webSite;

//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="belonging_to_group", type="string")
//     */
//    protected $belongingToGroup;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="note", type="string")
     */
    protected $note;

//    /**
//     * @Assert\NotBlank()
//     * @ORM\Column(name="accreditation", type="string")
//     */
//    protected $accreditation;
//
//    /**
//     * @ORM\Column(name="accreditation_valid_from", type="datetime", nullable=true)
//     */
//    protected $accreditationValidFrom;
//
//    /**
//     * @ORM\Column(name="accreditation_valid_to", type="datetime", nullable=true)
//     */
//    protected $accreditationValidTo;
//
//    /**@Assert\NotBlank()
//     * @ORM\Column(name="accreditor", type="string")
//     */
//    protected $accreditor;

    /**
     * @ORM\OneToMany(targetEntity="PicNumber", mappedBy="institution")
     */
    protected $picNumbers;

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

//
//    /**
//     * @return mixed
//     */
//    public function getFounder()
//    {
//        return $this->founder;
//    }
//
//    /**
//     * @param mixed $founder
//     */
//    public function setFounder($founder)
//    {
//        $this->founder = $founder;
//    }

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

//    /**
//     * @return mixed
//     */
//    public function getLegalRepresentative()
//    {
//        return $this->legalRepresentative;
//    }
//
//    /**
//     * @param mixed $legalRepresentative
//     */
//    public function setLegalRepresentative($legalRepresentative)
//    {
//        $this->legalRepresentative = $legalRepresentative;
//    }

//    /**
//     * @return mixed
//     */
//    public function getContactPerson()
//    {
//        return $this->contactPerson;
//    }
//
//    /**
//     * @param mixed $contactPerson
//     */
//    public function setContactPerson($contactPerson)
//    {
//        $this->contactPerson = $contactPerson;
//    }
//
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
    public function getNationalRegistrationNumber()
    {
        return $this->nationalRegistrationNumber;
    }

    /**
     * @param mixed $registrationNumber
     */
    public function setNationalRegistrationNumber($nationalRegistrationNumber)
    {
        $this->nationalRegistrationNumber = $nationalRegistrationNumber;
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
//
//    /**
//     * @return mixed
//     */
//    public function getHierarchyLevel()
//    {
//        return $this->hierarchyLevel;
//    }
//
//    /**
//     * @param mixed $hierarchyLevel
//     */
//    public function setHierarchyLevel($hierarchyLevel)
//    {
//        $this->hierarchyLevel = $hierarchyLevel;
//    }

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
//
//    /**
//     * @return mixed
//     */
//    public function getCountry()
//    {
//        return $this->country;
//    }
//
//    /**
//     * @param mixed $country
//     */
//    public function setCountry($country)
//    {
//        $this->country = $country;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getFounderType()
//    {
//        return $this->founderType;
//    }
//
//    /**
//     * @param mixed $founderType
//     */
//    public function setFounderType($founderType)
//    {
//        $this->founderType = $founderType;
//    }

//    /**
//     * @return mixed
//     */
//    public function getFounderCountry()
//    {
//        return $this->founderCountry;
//    }
//
//    /**
//     * @param mixed $founderCountry
//     */
//    public function setFounderCountry($founderCountry)
//    {
//        $this->founderCountry = $founderCountry;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getAddress()
//    {
//        return $this->address;
//    }
//
//    /**
//     * @param mixed $address
//     */
//    public function setAddress($address)
//    {
//        $this->address = $address;
//    }

//    /**
//     * @return mixed
//     */
//    public function getPostalCode()
//    {
//        return $this->postalCode;
//    }
//
//    /**
//     * @param mixed $postalCode
//     */
//    public function setPostalCode($postalCode)
//    {
//        $this->postalCode = $postalCode;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getCity()
//    {
//        return $this->city;
//    }
//
//    /**
//     * @param mixed $city
//     */
//    public function setCity($city)
//    {
//        $this->city = $city;
//    }

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

//    /**
//     * @return mixed
//     */
//    public function getBelongingToGroup()
//    {
//        return $this->belongingToGroup;
//    }
//
//    /**
//     * @param mixed $belongingToGroup
//     */
//    public function setBelongingToGroup($belongingToGroup)
//    {
//        $this->belongingToGroup = $belongingToGroup;
//    }

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
//
//    /**
//     * @return mixed
//     */
//    public function getAccreditation()
//    {
//        return $this->accreditation;
//    }
//
//    /**
//     * @param mixed $accreditation
//     */
//    public function setAccreditation($accreditation)
//    {
//        $this->accreditation = $accreditation;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getAccreditationValidFrom()
//    {
//        return $this->accreditationValidFrom;
//    }
//
//    /**
//     * @param mixed $accreditationValidFrom
//     */
//    public function setAccreditationValidFrom($accreditationValidFrom)
//    {
//        $this->accreditationValidFrom = $accreditationValidFrom;
//    }

//    /**
//     * @return mixed
//     */
//    public function getAccreditationValidTo()
//    {
//        return $this->accreditationValidTo;
//    }
//
//    /**
//     * @param mixed $accreditationValidTo
//     */
//    public function setAccreditationValidTo($accreditationValidTo)
//    {
//        $this->accreditationValidTo = $accreditationValidTo;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getAccreditor()
//    {
//        return $this->accreditor;
//    }
//
//    /**
//     * @param mixed $accreditor
//     */
//    public function setAccreditor($accreditor)
//    {
//        $this->accreditor = $accreditor;
//    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param mixed $nameEn
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * @return mixed
     */
    public function getNameSr()
    {
        return $this->nameSr;
    }

    /**
     * @param mixed $nameSr
     */
    public function setNameSr($nameSr)
    {
        $this->nameSr = $nameSr;
    }

    /**
     * @return mixed
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * @param mixed $acronym
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;
    }

    public function getPicNumbers()
    {
        return $this->picNumbers;
    }

    public function setPicNumbers(ArrayCollection $picNumbers)
    {
        $this->picNumbers = $picNumbers;
    }


    public function getName($locale) {
        if ($locale == "sr"){
            return $this->nameSr;
        }
        return $this->nameEn;
    }
}