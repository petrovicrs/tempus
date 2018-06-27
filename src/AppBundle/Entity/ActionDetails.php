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
     *      inversedBy="actionDetails",
     *      cascade={"persist"}
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
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\IncomingOutgoing"
     * )
     */
    protected $incomingOutgoing;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\TrainingShip"
     * )
     */
    protected $trainingShip;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="venue", type="string", length=128, nullable=true)
     */
    protected $venue;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="distance", type="string", nullable=true)
     */
    protected $distance;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    protected $startDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    protected $endDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="travel_days", type="integer", nullable=true)
     */
    protected $travelDays;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="days_without_travel", type="integer", nullable=true)
     */
    protected $daysWithoutTravel;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="total_days", type="integer", nullable=true)
     */
    protected $totalDays;

    /**
     * @ORM\Column(name="duration_months", type="integer", nullable=true)
     */
    protected $durationMonths;

    /**
     * @ORM\Column(name="duration_extra_days", type="integer", nullable=true)
     */
    protected $durationExtraDays;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="has_special_needs", type="boolean")
     */
    protected $hasSpecialNeeds;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="student", type="boolean", nullable=true)
     */
    protected $student;

    /**
     * @ORM\Column(name="apprentice", type="boolean", nullable=true)
     */
    protected $apprentice;

    /**
     * @ORM\Column(name="group_leader", type="boolean", nullable=true)
     */
    protected $groupLeader;

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
     * @ORM\Column(name="non_teaching_stuff", type="boolean", nullable=true)
     */
    protected $nonTeachingStuff;

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
    public function getIncomingOutgoing()
    {
        return $this->incomingOutgoing;
    }

    /**
     * @param mixed $incomingOutgoing
     */
    public function setIncomingOutgoing($incomingOutgoing)
    {
        $this->incomingOutgoing = $incomingOutgoing;
    }

    /**
     * @return mixed
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * @param mixed $venue
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;
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
    public function getDurationMonths()
    {
        return $this->durationMonths;
    }

    /**
     * @param mixed $durationMonths
     */
    public function setDurationMonths($durationMonths)
    {
        $this->durationMonths = $durationMonths;
    }

    /**
     * @return mixed
     */
    public function getDurationExtraDays()
    {
        return $this->durationExtraDays;
    }

    /**
     * @param mixed $durationExtraDays
     */
    public function setDurationExtraDays($durationExtraDays)
    {
        $this->durationExtraDays = $durationExtraDays;
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
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return mixed
     */
    public function getApprentice()
    {
        return $this->apprentice;
    }

    /**
     * @param mixed $apprentice
     */
    public function setApprentice($apprentice)
    {
        $this->apprentice = $apprentice;
    }

    /**
     * @return mixed
     */
    public function getGroupLeader()
    {
        return $this->groupLeader;
    }

    /**
     * @param mixed $groupLeader
     */
    public function setGroupLeader($groupLeader)
    {
        $this->groupLeader = $groupLeader;
    }

    /**
     * @return mixed
     */
    public function getTrainingShip()
    {
        return $this->trainingShip;
    }

    /**
     * @param mixed $trainingShip
     */
    public function setTrainingShip($trainingShip)
    {
        $this->trainingShip = $trainingShip;
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
    public function getisAccompanyingPerson()
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
    public function getNonTeachingStuff()
    {
        return $this->nonTeachingStuff;
    }

    /**
     * @param mixed $nonTeachingStuff
     */
    public function setNonTeachingStuff($nonTeachingStuff)
    {
        $this->nonTeachingStuff = $nonTeachingStuff;
    }
}