<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 13:23
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActionDetailsRepository")
 * @ORM\Table(name="action_details")
 */
class ActionDetails extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Activity",
     *      inversedBy="actionDetails"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $activity;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Person"
     * )
     */
    protected $person;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution"
     * )
     */
    protected $institution;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Country"
     * )
     */
    protected $originCountry;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Country"
     * )
     */
    protected $destinationCountry;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="city", type="string", length=128)
     */
    protected $city;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="distance", type="decimal")
     */
    protected $distance;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="start_date", type="datetime")
     */
    protected $startDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="end_date", type="datetime")
     */
    protected $endDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="travel_days", type="integer")
     */
    protected $travelDays;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="days_without_travel", type="integer")
     */
    protected $daysWithoutTravel;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="total_days", type="integer")
     */
    protected $totalDays;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="has_special_needs", type="boolean")
     */
    protected $hasSpecialNeeds;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="has_fewer_options", type="boolean")
     */
    protected $hasFewerOptions;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="is_accompanying_person", type="boolean")
     */
    protected $isAccompanyingPerson;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="is_long_term", type="boolean")
     */
    protected $isLongTerm;

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
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param mixed $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
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
    public function getDestinationCountry()
    {
        return $this->destinationCountry;
    }

    /**
     * @param mixed $destinationCountry
     */
    public function setDestinationCountry($destinationCountry)
    {
        $this->destinationCountry = $destinationCountry;
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
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getTravelDays()
    {
        return $this->travelDays;
    }

    /**
     * @param mixed $travelDays
     */
    public function setTravelDays($travelDays)
    {
        $this->travelDays = $travelDays;
    }

    /**
     * @return mixed
     */
    public function getDaysWithoutTravel()
    {
        return $this->daysWithoutTravel;
    }

    /**
     * @param mixed $daysWithoutTravel
     */
    public function setDaysWithoutTravel($daysWithoutTravel)
    {
        $this->daysWithoutTravel = $daysWithoutTravel;
    }

    /**
     * @return mixed
     */
    public function getTotalDays()
    {
        return $this->totalDays;
    }

    /**
     * @param mixed $totalDays
     */
    public function setTotalDays($totalDays)
    {
        $this->totalDays = $totalDays;
    }

    /**
     * @return mixed
     */
    public function getHasSpecialNeeds()
    {
        return $this->hasSpecialNeeds;
    }

    /**
     * @param mixed $hasSpecialNeeds
     */
    public function setHasSpecialNeeds($hasSpecialNeeds)
    {
        $this->hasSpecialNeeds = $hasSpecialNeeds;
    }

    /**
     * @return mixed
     */
    public function getHasFewerOptions()
    {
        return $this->hasFewerOptions;
    }

    /**
     * @param mixed $hasFewerOptions
     */
    public function setHasFewerOptions($hasFewerOptions)
    {
        $this->hasFewerOptions = $hasFewerOptions;
    }

    /**
     * @return mixed
     */
    public function getIsAccompanyingPerson()
    {
        return $this->isAccompanyingPerson;
    }

    /**
     * @param mixed $isAccompanyingPerson
     */
    public function setIsAccompanyingPerson($isAccompanyingPerson)
    {
        $this->isAccompanyingPerson = $isAccompanyingPerson;
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
}