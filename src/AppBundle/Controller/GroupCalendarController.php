<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 02.09.17
 * Time: 16:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\EventReminder;
use AppBundle\Entity\GroupCalendar;
use AppBundle\Entity\GroupCalendarEvent;
use AppBundle\Form\GroupCalendarForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class GroupCalendarController extends AbstractController
{
    /**
     * @Route("/{locale}/group-calendar/list", name="group_calendar_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $calendar = $this->getCalendarRepository()->findOneBy(
            ['project' => $this->getLastProjectForCurrentUser()],
            ['id' => 'DESC']
        );
        return $this->render('group-calendar/list.twig', ['calendar' => $calendar]);
    }

    /**
     * @Route("/{locale}/group-calendar/create", name="group_calendar_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $calendar = new GroupCalendar();

        $calendarForm = $this->createForm(GroupCalendarForm::class, $calendar, [
            'action' => $this->generateUrl('group_calendar_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $calendarForm->handleRequest($request);

        if ($calendarForm->isSubmitted() && $calendarForm->isValid()) {

            $calendar->setProject($this->getLastProjectForCurrentUser());
            $this->getCalendarRepository()->save($calendar);

            /* @var GroupCalendarEvent $event */
            foreach ($calendar->getEvent() as $event) {
                $event->setGroupCalendar($calendar);

                /* @var EventReminder $reminder */
                foreach ($event->getEventReminder() as $reminder) {
                    $reminder->setGroupCalendarEvent($event);
                    $this->getEventReminderRepository()->save($reminder);
                }

                $this->getCalendarEventRepository()->save($event);
            }

            return $this->redirectToRoute('group_calendar_list');
        }

        return $this->render('group-calendar/create.twig', ['my_form' => $calendarForm->createView()]);
    }

//    /**
//     * @Route("/{locale}/group-calendar/edit/{id}", name="group_calendar_edit", requirements={"locale": "%app.locales%"}, "id": "\d+")
//     */
//    public function editAction(Request $request, $id)
//    {
//
//    }

    /**
     * @Route("/{locale}/group-calendar/view/{id}", name="group_calendar_view", requirements={"locale": "%app.locales%", "id": "\d+"})
     */
    public function viewAction(Request $request, $id)
    {

    }

    private function getCalendarRepository()
    {
        return $this->get('doctrine_entity_repository.group_calendar');
    }

    private function getCalendarEventRepository()
    {
        return $this->get('doctrine_entity_repository.group_calendar_event');
    }

    private function getEventReminderRepository()
    {
        return $this->get('doctrine_entity_repository.event_reminder');
    }
}