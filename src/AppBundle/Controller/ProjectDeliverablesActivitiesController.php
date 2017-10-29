<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 15.10.17
 * Time: 10:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ProjectActivity;
use AppBundle\Entity\ProjectDeliverable;
use AppBundle\Entity\ProjectDeliverablesActivities;
use AppBundle\Form\ProjectDeliverablesActivitiesForm;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProjectDeliverablesActivitiesController extends AbstractController
{
    /**
     * @Route("/{locale}/deliverables-activities/list", name="deliverables_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $projectDeliverableActivities = $this->getDeliverablesActivitiesRepository()->findAll();

        return $this->render('deliverables-activities/list.twig', [
            'deliverablesActivities' => $projectDeliverableActivities,
        ]);
    }

    /**
     * @Route("/{locale}/deliverables-activities/create", name="deliverables_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectDeliverableActivities = new ProjectDeliverablesActivities();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectDeliverableActivitiesForm = $this->createForm(ProjectDeliverablesActivitiesForm::class, $projectDeliverableActivities, [
            'action' => $this->generateUrl('deliverables_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectDeliverableActivitiesForm->handleRequest($request);

        if ($projectDeliverableActivitiesForm->isSubmitted() && $projectDeliverableActivitiesForm->isValid()) {

            $projectDeliverableActivities->setProject($project);

            /** @var ProjectActivity $activity */
            foreach ($projectDeliverableActivities->getActivities() as $activity) {
                $activity->setProjectDeliverablesActivities($projectDeliverableActivities);
            }

            /** @var ProjectDeliverable $deliverable */
            foreach ($projectDeliverableActivities->getDeliverables() as $deliverable) {
                $deliverable->setProjectDeliverablesActivities($projectDeliverableActivities);
            }

            $this->getDeliverablesActivitiesRepository()->save($projectDeliverableActivities);

            return $this->redirectToRoute('monitoring_create');
        }

        return $this->render(
            'deliverables-activities/create.twig',
            [
                'my_form' => $projectDeliverableActivitiesForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
            ]
        );
    }

    /**
     * @Route("/{locale}/deliverables-activities/edit/{projectId}", name="deliverables_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectDeliverablesActivities $projectDeliverableActivities */
        $projectDeliverableActivities = $this->getDeliverablesActivitiesRepository()->findOneBy(
            ['project' => $projectId],
            ['id' => 'DESC']
        );

        /** @var Project $project */
        $project = $projectDeliverableActivities->getProject();


        $projectDeliverableActivitiesForm = $this->createForm(ProjectDeliverablesActivitiesForm::class, $projectDeliverableActivities, [
            'action' => $this->generateUrl('deliverables_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $deliverables = new ArrayCollection();
        $activities = new ArrayCollection();

        foreach ($projectDeliverableActivities->getDeliverables() as $deliverable) {
            $deliverables->add($deliverable);
        }

        foreach ($projectDeliverableActivities->getActivities() as $activity) {
            $activities->add($activity);
        }

        $projectDeliverableActivitiesForm->handleRequest($request);

        if ($projectDeliverableActivitiesForm->isSubmitted() && $projectDeliverableActivitiesForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($deliverables as $deliverable) {
                if(false === $projectDeliverableActivities->getDeliverables()->contains($deliverable)) {
                    $em->remove($deliverable);
                }
            }

            foreach ($activities as $activity) {
                if(false === $projectDeliverableActivities->getActivities()->contains($activity)) {
                    $em->remove($activity);
                }
            }

            $this->getDeliverablesActivitiesRepository()->save($projectDeliverableActivities);

            if (!$projectDeliverableActivities->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('monitoring_create');
            }
        }

        return $this->render(
            'deliverables-activities/edit.twig',
            [
                'my_form' => $projectDeliverableActivitiesForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
            ]
        );
    }

    /**
     * @Route("/{locale}/deliverables-activities/view/{projectId}", name="deliverables_view", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function viewAction(Request $request, $projectId)
    {
        $projectDeliverableActivities = $this->getDeliverablesActivitiesRepository()->findOneBy([
            'project' => $projectId
        ]);

        return $this->render('deliverables-activities/view.twig', [
            'deliverablesActivities' => $projectDeliverableActivities,
            'projectId' => $projectId,
            'keyAction' => $projectDeliverableActivities->getProject()->getKeyActions()->getNameSr()
        ]);
    }

    private function getDeliverablesActivitiesRepository()
    {
        return $this->get('doctrine_entity_repository.project_deliverables_activities');
    }
}