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
use AppBundle\Entity\Project;
use AppBundle\Form\GroupCalendarForm;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class GroupCalendarController extends AbstractController
{
    /**
     * @Route("/{locale}/group-calendar/list", name="group_calendar_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $events = $this->getCalendarRepository()->findBy(
            ['project' => $this->getLastProjectForCurrentUser()],
            ['id' => 'DESC']
        );

        return $this->render('group-calendar/list.twig', ['events' => $events]);
    }

    /**
     * @Route("/{locale}/group-calendar/create", name="group_calendar_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $calendar = new GroupCalendar();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $calendarForm = $this->createForm(GroupCalendarForm::class, $calendar, [
            'action' => $this->generateUrl('group_calendar_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $calendarForm->handleRequest($request);

        if ($calendarForm->isSubmitted() && $calendarForm->isValid()) {

            /** @var Project $project */
            $project = $this->getLastProjectForCurrentUser();
            $project->setIsCompleted(1);

            $calendar->setProject($project);
            $this->getCalendarRepository()->save($calendar);

            /* @var EventReminder $reminder */
            foreach ($calendar->getEventReminder() as $reminder) {

                $reminder->setGroupCalendar($calendar);
                $this->getEventReminderRepository()->save($reminder);
            }

            $this->getProjectRepository()->saveProject($project);

            return $this->redirectToRoute('project_list');
        }

        return $this->render('group-calendar/create.twig', ['my_form' => $calendarForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()
        ]);
    }

    /**
     * @Route("/{locale}/group-calendar/edit/{projectId}", name="group_calendar_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);
        /** @var GroupCalendar $calendar*/
        $calendar = $this->getCalendarRepository()->findOneBy(['project' => $projectId]);

        $calendarForm = $this->createForm(GroupCalendarForm::class, $calendar, [
            'action' => $this->generateUrl('group_calendar_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $eventReminder = new ArrayCollection();

        /** @var EventReminder $reminder */
        foreach ($calendar->getEventReminder() as $reminder) {
            $eventReminder->add($reminder);
        }

        $calendarForm->handleRequest($request);

        if ($calendarForm->isSubmitted() && $calendarForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var EventReminder $reminder */
            foreach ($eventReminder as $reminder) {
                if (false === $calendar->getEventReminder()->contains($reminder)) {
                    $em->remove($reminder);
                }
                $this->getEventReminderRepository()->save($reminder);
            }

            $this->getCalendarRepository()->save($calendar);

            return $this->redirectToRoute('project_list');
        }

        return $this->render('group-calendar/edit.twig', ['my_form' => $calendarForm->createView()]);
    }

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

    private function getEventReminderRepository()
    {
        return $this->get('doctrine_entity_repository.event_reminder');
    }

    private function getProjectRepository()
    {

        return $this->get('doctrine_entity_repository.project');
    }
}