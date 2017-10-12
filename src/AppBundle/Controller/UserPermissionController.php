<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 08.08.17
 * Time: 22:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\UserPermission;
use AppBundle\Entity\Results;
use AppBundle\Form\ProjectResultsForm;
use AppBundle\Form\UserPermissionForm;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\ProjectRepository;

class UserPermissionController extends AbstractController
{
//    /**
//     * @Route("/{locale}/user-permission/list", name="results_list", requirements={"locale": "%app.locales%"})
//     */
//    public function listAction(Request $request)
//    {
//        $results = $this->getResultsRepository()->findAll();
//
//        return $this->render('user-permission/list.twig', ['results' => $results]);
//    }
//
    /**
     * @Route("/{locale}/user-permission/create", name="user_permission_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $userPermission = new UserPermission();

        $userPermissionForm = $this->createForm(UserPermissionForm::class, $userPermission, [
            'action' => $this->generateUrl('user_permission_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $userPermissionForm->handleRequest($request);

        if ($userPermissionForm->isSubmitted() && $userPermissionForm->isValid()) {

//            foreach($userPermission->getUser() as $result) {
//                $result->setProjectResults($projectResults);
//            }
            //$userPermission->setUser(1);
            $this->getUserPermissionRepository()->save($userPermission);

            return $this->redirectToRoute('project_list');
        }

        return $this->render('user-permission/create.twig', ['my_form' => $userPermissionForm->createView()]);
    }
//
//    /**
//     * @Route("/{locale}/results/edit/{projectId}", name="result_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
//     *
//     */
//    public function editAction(Request $request, $projectId)
//    {
//        /** @var ProjectResults $projectResult */
//        $projectResult = $this->getProjectResultsRepository()->findOneBy(['project' => $projectId]);
//
//        /** @var Project $project */
//        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);
//
//        $projectResultForm = $this->createForm(ProjectResultsForm::class, $projectResult, [
//            'action' => $this->generateUrl('result_edit', ['projectId' => $projectId]),
//            'method' => 'POST',
//            'locale' => $request->getLocale()
//        ]);
//
//        $results = new ArrayCollection();
//
//        foreach ($projectResult->getResults() as $result) {
//            $results->add($result);
//        }
//
//        $projectResultForm->handleRequest($request);
//
//        if ($projectResultForm->isSubmitted() && $projectResultForm->isValid()) {
//
//            $em = $this->getDoctrine()->getManager();
//
//            foreach ($results as $result) {
//                if (false === $projectResult->getResults()->contains($result)) {
//                    $em->remove($result);
//                }
//
//                $this->getResultsRepository()->save($result);
//            }
//
//            $this->getProjectResultsRepository()->save($projectResult);
//
//            if (!$projectResult->getProject()->getIsCompleted()) {
//                return $this->redirectToRoute('reporting_create');
//            }
//        }
//
//        return $this->render('user-permission/edit.twig', ['my_form' => $projectResultForm->createView(), 'keyAction' => $project->getKeyActions()->getNameSr()]);
//    }
//
//    /**
//     * @Route("/{locale}/results/view/{resultId}", name="result_view", requirements={"resultId": "\d+", "locale": "%app.locales%"})
//     */
//    public function viewAction($resultId)
//    {
//        $result = $this->getResultsRepository()->findOneBy(['id' => $resultId]);
//
//        return $this->render(
//            'user-permission/view.twig',
//            [
//                'result' => $result,
//                'keyAction' => $result->getProjectResults()->getProject()->getKeyActions()->getNameSr()
//            ]
//        );
//    }
//
    private function getUserPermissionRepository()
    {
        return $this->get('doctrine_entity_repository.user_permission');
    }

    private function getUserProjectPermissionRepository()
    {
        return $this->get('doctrine_entity_repository.user_project_permission');
    }

    private function getUserInstitutionPermissionRepository() {

        return $this->get('doctrine_entity_repository.user_institution_permission');
    }
}