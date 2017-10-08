<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 08.08.17
 * Time: 22:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectResults;
use AppBundle\Entity\Results;
use AppBundle\Form\ProjectResultsForm;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\ProjectRepository;

class ResultsController extends AbstractController
{
    /**
     * @Route("/{locale}/results/list", name="results_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $results = $this->getResultsRepository()->findAll();

        return $this->render('results/list.twig', ['results' => $results]);
    }

    /**
     * @Route("/{locale}/results/create", name="results_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectResults = new ProjectResults();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectResultsForm = $this->createForm(ProjectResultsForm::class, $projectResults, [
            'action' => $this->generateUrl('results_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectResultsForm->handleRequest($request);

        if ($projectResultsForm->isSubmitted() && $projectResultsForm->isValid()) {

            foreach($projectResults->getResults() as $result) {
                $result->setProjectResults($projectResults);
            }
            $projectResults->setProject($project);
            $this->getProjectResultsRepository()->save($projectResults);

            return $this->redirectToRoute('reporting_create');
        }

        return $this->render('results/create.twig', ['my_form' => $projectResultsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/results/edit/{projectId}", name="result_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectResults $projectResult */
        $projectResult = $this->getProjectResultsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectResultForm = $this->createForm(ProjectResultsForm::class, $projectResult, [
            'action' => $this->generateUrl('result_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $results = new ArrayCollection();

        foreach ($projectResult->getResults() as $result) {
            $results->add($result);
        }

        $projectResultForm->handleRequest($request);

        if ($projectResultForm->isSubmitted() && $projectResultForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($results as $result) {
                if (false === $projectResult->getResults()->contains($result)) {
                    $em->remove($result);
                }

                $this->getResultsRepository()->save($result);
            }

            $this->getProjectResultsRepository()->save($projectResult);

            if (!$projectResult->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('reporting_create');
            }
        }

        return $this->render('results/edit.twig', ['my_form' => $projectResultForm->createView(), 'keyAction' => $project->getKeyActions()->getNameSr()]);
    }

    /**
     * @Route("/{locale}/results/view/{resultId}", name="result_view", requirements={"resultId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($resultId)
    {
        $result = $this->getResultsRepository()->findOneBy(['id' => $resultId]);

        return $this->render(
            'results/view.twig',
            [
                'result' => $result,
                'keyAction' => $result->getProjectResults()->getProject()->getKeyActions()->getNameSr()
            ]
        );
    }

    private function getProjectResultsRepository()
    {
        return $this->get('doctrine_entity_repository.project_results');
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