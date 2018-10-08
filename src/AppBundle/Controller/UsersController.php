<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 08.08.17
 * Time: 22:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\ProjectRepository;

class UsersController extends AbstractController
{
    /**
     * @Route("/{locale}/users/list", name="user_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $results = $this->getResultsRepository()->findAll();

        return $this->render('results/list.twig', ['results' => $results]);
    }

    /**
     * @Route("/{locale}/users/create", name="user_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $results = new Results();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $resultsForm = $this->createForm(ResultsForm::class, $results, [
            'action' => $this->generateUrl('results_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resultsForm->handleRequest($request);

        if ($resultsForm->isSubmitted() && $resultsForm->isValid()) {

            $results->setProject($project);
            $this->getResultsRepository()->save($results);

            return $this->redirectToRoute('reporting_start');
        }

        return $this->render('results/create.twig', ['my_form' => $resultsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted()]);
    }

    /**
     * @Route("/{locale}/users/edit/{projectId}", name="user_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Results $result */
        $result = $this->getResultsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $resultForm = $this->createForm(ResultsForm::class, $result, [
            'action' => $this->generateUrl('result_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resultForm->handleRequest($request);

        if ($resultForm->isSubmitted() && $resultForm->isValid()) {
            $this->getResultsRepository()->save($result);

            if (!$result->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('reporting_start');
            }

        }

        return $this->render('results/edit.twig', ['my_form' => $resultForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'isCompleted' => $project->getIsCompleted()]);
    }

    /**
     * @Route("/{locale}/users/view/{resultId}", name="user_view", requirements={"resultId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($resultId)
    {
        $result = $this->getResultsRepository()->findOneBy(['id' => $resultId]);

        return $this->render('results/view.twig', ['result' => $result]);
    }

    private function getResultsRepository()
    {
        return $this->get('doctrine_entity_repository.results');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}