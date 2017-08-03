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
use AppBundle\Entity\PicNumber;
use AppBundle\Entity\InstitutionContact;
use AppBundle\Entity\InstitutionAddress;
use AppBundle\Entity\InstitutionAccreditation;
use AppBundle\Entity\InstitutionLegalRepresentative;
use AppBundle\Entity\InstitutionNote;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionRepository")
 * @ORM\Table(name="institutions")
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
     * @ORM\ManyToOne(
     *      targetEntity="Institution"
     * )
     */
    protected $parentInstitution;

    /**
     *  
     * @ORM\Column(name="name_en", type="string")
     */
    protected $nameEn;

    /**
     *  
     * @ORM\Column(name="name_sr", type="string")
     */
    protected $nameSr;

    /**
     *  
     * @ORM\Column(name="name_original_letter", type="string")
     */
    protected $nameOriginalLetter;

    /**
     *  
     * @ORM\Column(name="founder_original_letter_en", type="string")
     */
    protected $founderOriginalLetterEn;

    /**
     *  
     * @ORM\Column(name="founder_original_letter_sr", type="string")
     */
    protected $founderOriginalLetterSr;

    /**
     *  
     * @ORM\Column(name="founder_original_letter", type="string")
     */
    protected $founderOriginalLetter;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="InstitutionFounderType"
     * )
     */
    protected $institutionFounderType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="InstitutionLevel"
     * )
     */
    protected $institutionLevel;

    /**
     *  
     * @ORM\Column(name="national_registration_number", type="string")
     */
    protected $nationalRegistrationNumber;

    /**
     *  
     * @ORM\Column(name="vat_number", type="string")
     */
    protected $vatNumber;

    /**
     * @ORM\OneToMany(targetEntity="PicNumber", mappedBy="institution", cascade={"persist"})
     */
    protected $picNumber;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="InstitutionType"
     * )
     */
    protected $institutionType;

    /**
     *  
     * @ORM\Column(name="public_body", type="boolean")
     */
    protected $publicBody;

    /**
     *  
     * @ORM\Column(name="non_profit", type="boolean")
     */
    protected $nonProfit;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Country"
     * )
     */
    protected $country;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Country"
     * )
     */
    protected $originCountry;

    /**
     *  
     * @ORM\Column(name="web_site", type="string")
     */
    protected $webSite;

    /**
     * @ORM\OneToMany(targetEntity="InstitutionContact", mappedBy="institution", cascade={"persist"})
     */
    protected $contacts;

    /**
     * @ORM\OneToMany(targetEntity="InstitutionNote", mappedBy="institution", cascade={"persist"})
     */
    protected $notes;

    /**
     * @ORM\OneToMany(targetEntity="InstitutionLegalRepresentative", mappedBy="institution", cascade={"persist"})
     */
    protected $legalRepresentatives;

    /**
     * @ORM\OneToMany(targetEntity="InstitutionAccreditation", mappedBy="institution", cascade={"persist"})
     */
    protected $accreditations;

    /**
     * @ORM\OneToMany(targetEntity="InstitutionAddress", mappedBy="institution", cascade={"persist"})
     */
    protected $addresses;

    public function __construct()
    {
        parent::__construct();
        $this->contacts = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->legalRepresentatives = new ArrayCollection();
        $this->accreditations = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->picNumber = new ArrayCollection();
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
    public function getFounderOriginalLetterEn()
    {
        return $this->founderOriginalLetterEn;
    }

    /**
     * @param mixed $founderOriginalLetterEn
     */
    public function setFounderOriginalLetterEn($founderOriginalLetterEn)
    {
        $this->founderOriginalLetterEn = $founderOriginalLetterEn;
    }

    /**
     * @return mixed
     */
    public function getFounderOriginalLetterSr()
    {
        return $this->founderOriginalLetterSr;
    }

    /**
     * @param mixed $founderOriginalLetterSr
     */
    public function setFounderOriginalLetterSr($founderOriginalLetterSr)
    {
        $this->founderOriginalLetterSr = $founderOriginalLetterSr;
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
    public function getInstitutionFounderType()
    {
        return $this->institutionFounderType;
    }

    /**
     * @param mixed $institutionFounderType
     */
    public function setInstitutionFounderType($institutionFounderType)
    {
        $this->institutionFounderType = $institutionFounderType;
    }

    /**
     * @return mixed
     */
    public function getInstitutionLevel()
    {
        return $this->institutionLevel;
    }

    /**
     * @param mixed $institutionLevel
     */
    public function setInstitutionLevel($institutionLevel)
    {
        $this->institutionLevel = $institutionLevel;
    }

    /**
     * @return mixed
     */
    public function getNationalRegistrationNumber()
    {
        return $this->nationalRegistrationNumber;
    }

    /**
     * @param mixed $nationalRegistrationNumber
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
    public function getPublicBody()
    {
        return $this->publicBody;
    }

    /**
     * @param mixed $publicBody
     */
    public function setPublicBody($publicBody)
    {
        $this->publicBody = $publicBody;
    }

    /**
     * @return mixed
     */
    public function getNonProfit()
    {
        return $this->nonProfit;
    }

    /**
     * @param mixed $nonProfit
     */
    public function setNonProfit($nonProfit)
    {
        $this->nonProfit = $nonProfit;
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
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * @param mixed $originCountry
     */
    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;
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

    public function getContacts()
    {
        return $this->contacts;
    }

    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    public function addContacts(InstitutionContact $contact)
    {
        $this->contacts->add($contact);
    }

    public function removeContacts(InstitutionContact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function addNotes(InstitutionNote $notes)
    {
        $this->notes->add($notes);
    }

    public function removeNotes(InstitutionNote $notes)
    {
        $this->notes->removeElement($notes);
    }

    /**
     * @return mixed
     */
    public function getLegalRepresentatives()
    {
        return $this->legalRepresentatives;
    }

    /**
     * @param mixed $legalRepresentatives
     */
    public function setLegalRepresentatives($legalRepresentatives)
    {
        $this->legalRepresentatives = $legalRepresentatives;
    }

    public function addLegalRepresentatives(InstitutionLegalRepresentative $legalRepresentatives)
    {
        $this->legalRepresentatives->add($legalRepresentatives);
    }

    public function removeLegalRepresentatives(InstitutionLegalRepresentative $legalRepresentatives)
    {
        $this->legalRepresentatives->removeElement($legalRepresentatives);
    }

    /**
     * @return mixed
     */
    public function getAccreditations()
    {
        return $this->accreditations;
    }

    /**
     * @param mixed $accreditations
     */
    public function setAccreditations($accreditations)
    {
        $this->accreditations = $accreditations;
    }

    public function addAccreditations(InstitutionAccreditation $accreditation)
    {
        $this->accreditations->add($accreditation);
    }

    public function removeAccreditations(InstitutionAccreditation $accreditation)
    {
        $this->accreditations->removeElement($accreditation);
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

    public function addAddresses(InstitutionAddress $address)
    {
        $this->addresses->add($address);
    }

    public function removeAddresses(InstitutionAddress $address)
    {
        $this->addresses->removeElement($address);
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

    public function addPicNumber(PicNumber $picNumber)
    {
        $this->picNumber->add($picNumber);
    }

    public function removePicNumber(PicNumber $picNumber)
    {
        $this->picNumber->removeElement($picNumber);
    }

    public function getName($locale) {
        if ($locale == "sr"){
            return $this->nameSr;
        }
        return $this->nameEn;
    }
}