<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 02.09.17
 * Time: 16:02
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventReminderRepository")
 * @ORM\Table(name="event_reminder")
 */
class EventReminder extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="EventReminderType")
     */
    protected $remindType;

    /**
     * @Column(name="days_ahead", type="integer")
     */
    protected $daysAhead;

    /**
     * @ORM\ManyToOne(targetEntity="GroupCalendarEvent", inversedBy="eventReminder")
     */
    protected $groupCalendarEvent;

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
    public function getRemindType()
    {
        return $this->remindType;
    }

    /**
     * @param mixed $remindType
     */
    public function setRemindType($remindType)
    {
        $this->remindType = $remindType;
    }

    /**
     * @return mixed
     */
    public function getDaysAhead()
    {
        return $this->daysAhead;
    }

    /**
     * @param mixed $daysAhead
     */
    public function setDaysAhead($daysAhead)
    {
        $this->daysAhead = $daysAhead;
    }

    /**
     * @return mixed
     */
    public function getGroupCalendarEvent()
    {
        return $this->groupCalendarEvent;
    }

    /**
     * @param mixed $groupCalendarEvent
     */
    public function setGroupCalendarEvent($groupCalendarEvent)
    {
        $this->groupCalendarEvent = $groupCalendarEvent;
    }
}