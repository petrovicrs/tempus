<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 02.09.17
 * Time: 15:48
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupCalendarEventRepository")
 * @ORM\Table(name="group_calendar_event")
 */
class GroupCalendarEvent extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(name="event_date", type="datetime")
     */
    protected $eventDate;

    /**
     * @ORM\ManyToOne(targetEntity="GroupCalendarEventType")
     */
    protected $eventType;

    /**
     * @Column(name="event_description", type="string", length=255)
     */
    protected $eventDescription;

    /**
     * @ORM\OneToMany(targetEntity="EventReminder", mappedBy="groupCalendarEvent", cascade={"persist"})
     */
    protected $eventReminder;

    /**
     * @ORM\ManyToOne(targetEntity="GroupCalendar", inversedBy="event")
     */
    protected $groupCalendar;

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

    /**
     * @return mixed
     */
    public function getGroupCalendar()
    {
        return $this->groupCalendar;
    }

    /**
     * @param mixed $groupCalendar
     */
    public function setGroupCalendar($groupCalendar)
    {
        $this->groupCalendar = $groupCalendar;
    }
}