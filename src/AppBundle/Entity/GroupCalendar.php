<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 02.09.17
 * Time: 15:24
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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupCalendarRepository")
 * @ORM\Table(name="group_calendar")
 */
class GroupCalendar extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @Column(name="event_date", type="datetime", nullable=true)
     */
    protected $eventDate;

    /**
     * @ORM\ManyToOne(targetEntity="GroupCalendarEventType")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $eventType;

    /**
     * @Column(name="event_description", type="string", length=255, nullable=true)
     */
    protected $eventDescription;

    /**
     * @ORM\OneToMany(targetEntity="EventReminder", mappedBy="groupCalendar", cascade={"persist"})
     */
    protected $eventReminder;

    public function __construct()
    {
        parent::__construct();
        $this->eventReminder = new ArrayCollection();
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
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param mixed $eventDate
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param mixed $eventType
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * @param mixed $eventDescription
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;
    }

    /**
     * @return mixed
     */
    public function getEventReminder()
    {
        return $this->eventReminder;
    }

    /**
     * @param mixed $eventReminder
     */
    public function setEventReminder($eventReminder)
    {
        $this->eventReminder = $eventReminder;
    }
}