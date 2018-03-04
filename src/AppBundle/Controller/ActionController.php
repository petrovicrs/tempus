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
//            dump($mobFlows->getActivities());die;
            /*  @var  Activity $activity */
            foreach($mobFlows->getActivities() as $activity){

                /* @var ActionDetails $actionDetail */
                foreach ($activity->getActionDetails() as $actionDetail) {
                    $actionDetail->setActivity($activity);
//                    $this->getActionDetailsRepository()->save($actionDetail);
                }

                $activity->setProjectMobilityFlows($mobFlows);
                $this->getActivityRepository()->save($activity);
            }

            $mobFlows->setProject($project);
            $this->getProjectMobilityFlowsRepository()->save($mobFlows);

            return $this->redirectToRoute('resources_create');
        }

        return $this->render('action/create.twig', [
            'my_form' => $mobFlowsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectAction' => $project->getActions()->getNameSr(),
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

        $originalActivities = new ArrayCollection();
        $originalActionDetails = new ArrayCollection();

//        $originalActionDetails = [];

        foreach ($mobFlows->getActivities() as $activity) {
            $originalActivities->add($activity);
//            $originalActionDetails[$activity->getId()] = new ArrayCollection();

//
//            if (count($activity->getActionDetails())) {
//                foreach ($activity->getActionDetails() as $actionDetail) {
//                    $originalActionDetails[$activity->getId()]->add($actionDetail);
//                }
//            }

            foreach ($activity->getActionDetails() as $action) {
                $originalActionDetails->add($action);
            }
        }

        $mobFlowsForm->handleRequest($request);

        if ($mobFlowsForm->isSubmitted() && $mobFlowsForm->isValid()) {

            $em = $this->getDoctrine()->getManager();


            foreach ($originalActivities as $activity) {
                if (false === $mobFlows->getActivities()->contains($activity)) {
                    $em->remove($activity);
                }

//                if (count($activity->getActionDetails())) {
//                    foreach ($originalActionDetails[$activity->getId()] as $originalActionDetail) {
//                        if (false === $activity->getActionDetails()->contains($originalActionDetail)) {
//                            $em->remove($originalActionDetail);
//                        }
//                    }
//                }

                foreach ($originalActionDetails as $action) {
                    if (false === $activity->getActionDetails()->contains($action)) {
                        $em->remove($action);
                    }
                }
            }

            /** @var ProjectMobilityFlows $mobFlows*/
            foreach ($mobFlows->getActivities() as $activity) {
                if (false === $originalActivities->contains($activity)) {
                    /** @var Activity $activity */
                    $activity->setProjectMobilityFlows($mobFlows);
                    $this->getActivityRepository()->save($activity);
                }

                /** @var Activity $activity */
                foreach ($activity->getActionDetails() as $actionDetail) {
                    if (false === $originalActionDetails->contains($actionDetail)) {
                        /** @var ActionDetails $actionDetail */
                        $actionDetail->setActivity($activity);
                        $this->getActionDetailsRepository()->save($actionDetail);
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
            'keyAction' => $project->getKeyActions()->getName($request->getLocale()),
            'projectAction' => $project->getActions()->getName($request->getLocale()),
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
        $activities = null;

        if($mobFlows) {
            $activities = $mobFlows->getActivities();
        }
//        $actionDetails = $this->get('doctrine_entity_repository.action_details')->findBy(['activity' => $projectId]);
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);
        $activityTotals = $this->getTotals($activities, $project->getActions()->getNameSr());

        return $this->render('action/view.twig', [
            'activities' => $activities,
            'totals'     => $activityTotals,
            'keyAction'  => $project->getKeyActions()->getNameSr(),
            'projectAction' => strtolower($project->getActions()->getNameSr()),
            'projectId'  => $project->getId(),
        ]);
    }

    private function getTotals($activities, $type) {

        $totals = [];

        if(!$activities) return $totals;

        foreach ($activities as $index => $activity) {

            $activityTotal = [
                'daysWithoutTravel'      => 0,
                'travelDays'             => 0,
                'totalDays'              => 0,
                'withSpecialNeeds'       => 0,
                'withFewerOpportunities' => 0,
                'accompanyingPersons'    => 0,
                'distance'               => 0,
                'durationMonths'         => 0,
                'durationExtraDays'      => 0,
                'groupLeader'            => 0

            ];

            /** @var ActionDetails $actionDetail */
            foreach ($activity->getActionDetails() as $actionDetail) {

                $activityTotal['daysWithoutTravel'] += $actionDetail->getDaysWithoutTravel();
                $activityTotal['travelDays'] += $actionDetail->getTravelDays();
                $activityTotal['totalDays'] += $actionDetail->getTotalDays();

                if($actionDetail->getHasSpecialNeeds()) {
                   $activityTotal['withSpecialNeeds'] += 1;
                }
                if($actionDetail->getHasFewerOptions()) {
                    $activityTotal['withFewerOpportunities'] += 1;
                }
                if($actionDetail->getIsAccompanyingPerson()) {
                    $activityTotal['accompanyingPersons'] += 1;
                }
                if($actionDetail->getDurationMonths()) {
                    $activityTotal['durationMonths'] += 1;
                }
                if($actionDetail->getDurationExtraDays()) {
                    $activityTotal['durationExtraDays'] += 1;
                }
                if($actionDetail->getGroupLeader()) {
                    $activityTotal['groupLeader'] += 1;
                }

                array_push($totals, $activityTotal);
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