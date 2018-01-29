<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 00:25
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Action;
use AppBundle\Entity\ActionDetails;
use AppBundle\Entity\Activity;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectMobilityFlows;
use AppBundle\Form\ActionDetailsForm;
use AppBundle\Form\ProjectMobilityFlowsForm;
use AppBundle\Form\ActivityForm;
use AppBundle\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use PhpOption\Tests\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ActionController extends AbstractController
{
    /**
     * @Route("/{locale}/action/list", name="action_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $mobFlows = $this->getProjectMobilityFlowsRepository()->findAll();
        $totals = [];

        foreach ($mobFlows as $flow) {
            $totals[$flow->getId()] = $this->getTotals($flow->getActivities());
        }

        return $this->render('action/list.twig', ['activities' => $mobFlows, 'totals' => $totals]);
    }

    /**
     * @Route("/{locale}/action/create", name="action_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $mobFlows = new ProjectMobilityFlows();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $mobFlowsForm = $this->createForm(ProjectMobilityFlowsForm::class, $mobFlows, [
            'action' => $this->generateUrl('action_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $mobFlowsForm->handleRequest($request);

        if ($mobFlowsForm->isSubmitted() && $mobFlowsForm->isValid()) {

            $mobFlows->setProject($project);
            $this->getProjectMobilityFlowsRepository()->save($mobFlows);

            /*  @var  Activity $activity */
            foreach($mobFlows->getActivities() as $activity){
                $activity->setProjectMobilityFlows($mobFlows);

                /* @var ActionDetails $actionDetail */
                foreach ($activity->getActionDetails() as $actionDetail) {
                    $actionDetail->setActivity($activity);
                    $this->getActionDetailsRepository()->save($actionDetail);
                }
            }

            return $this->redirectToRoute('resources_create');
        }

        return $this->render('action/create.twig', [
            'my_form' => $mobFlowsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
        ]);
    }

    /**
     * @Route("/{locale}/action/edit/{projectId}", name="action_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        $mobFlows = $this->getProjectMobilityFlowsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $mobFlowsForm = $this->createForm(ProjectMobilityFlowsForm::class, $mobFlows, [
            'action' => $this->generateUrl('action_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $activities = new ArrayCollection();
        $actionDetails = new ArrayCollection();

        foreach ($mobFlows->getActivities() as $activity) {
            $activities->add($activity);

            foreach ($activity->getActionDetails() as $action) {
                $actionDetails->add($action);
            }
        }

        $mobFlowsForm->handleRequest($request);

        if ($mobFlowsForm->isSubmitted() && $mobFlowsForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($activities as $activity) {
                if (false === $mobFlows->getActivities()->contains($activity)) {
                    $em->remove($activity);
                }

                foreach ($actionDetails as $action) {
                    if (false === $activity->getActionDetails()->contains($action)) {
                        $em->remove($action);
                    }
                }
            }


            $this->getProjectMobilityFlowsRepository()->save($mobFlows);

            if (!$project->getIsCompleted()) {
                return $this->redirectToRoute('resources_create');
            }
        }

        return $this->render('action/edit.twig', [
            'my_form' => $mobFlowsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted()
        ]);
    }

    /**
     * @Route("/{locale}/action/view/{projectId}", name="action_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        $mobFlows = $this->getProjectMobilityFlowsRepository()->findOneBy(['project' => $projectId]);
        $activities = $mobFlows->getActivities();
//        $actionDetails = $this->get('doctrine_entity_repository.action_details')->findBy(['activity' => $projectId]);
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $activityTotals = $this->getTotals($activities);
//        $contacts = $this->get('doctrine_entity_repository.activity_contact')->findBy(['activity' => $projectId]);

        return $this->render('action/view.twig', [
            'activities' => $activities,
            'totals' => $activityTotals,
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
        ]);
    }

    private function getTotals($activities) {
        $totals = [
            'daysWithoutTravel'      => 0,
            'travelDays'             => 0,
            'totalDays'              => 0,
            'withSpecialNeeds'       => 0,
            'withFewerOpportunities' => 0,
            'accompanyingPersons'    => 0
        ];

        foreach ($activities as $index => $activity) {

            for($i = 0; $i < count($activity->getActionDetails()); $i++) {
                $actionDetails = $activity->getActionDetails()[$i];

                $totals['daysWithoutTravel'] += $actionDetails->getDaysWithoutTravel();
                $totals['travelDays'] += $actionDetails->getTravelDays();
                $totals['totalDays'] += $actionDetails->getTotalDays();

                if($actionDetails->getHasSpecialNeeds()) {
                   $totals['withSpecialNeeds'] += 1;
                }
                if($actionDetails->getHasFewerOptions()) {
                    $totals['withFewerOpportunities'] += 1;
                }
                if($actionDetails->getIsAccompanyingPerson()) {
                    $totals['accompanyingPersons'] += 1;
                }
            }
        }

        return $totals;
    }

    /**
     * @return ProjectActivityRepository
     */
    private function getProjectMobilityFlowsRepository() {

        return $this->get('doctrine_entity_repository.project_mobility_flows');
    }

    /**
     * @return ActivityRepository
     */
    private function getActivityRepository() {

        return $this->get('doctrine_entity_repository.activity');
    }

    /**
     * @return ActivityRepository
     */
    private function getActionDetailsRepository() {

        return $this->get('doctrine_entity_repository.action_details');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}