<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 08.08.17
 * Time: 22:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Results;
use AppBundle\Form\ResultsForm;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
        $results = new Results();

        $resultsForm = $this->createForm(ResultsForm::class, $results, [
            'action' => $this->generateUrl('results_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resultsForm->handleRequest($request);

        if ($resultsForm->isSubmitted() && $resultsForm->isValid()) {
            $this->getResultsRepository()->save($results);

            return $this->redirectToRoute('results_list');
        }

        return $this->render('results/create.twig', ['my_form' => $resultsForm->createView()]);
    }

    /**
     * @Route("/{locale}/results/edit/{resultId}", name="result_edit", requirements={"resultId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $resultId)
    {
        $result = $this->getResultsRepository()->findOneBy(['id' => $resultId]);

        $resultForm = $this->createForm(ResultsForm::class, $result, [
            'action' => $this->generateUrl('result_edit', ['resultId' => $resultId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resultForm->handleRequest($request);

        if ($resultForm->isSubmitted() && $resultForm->isValid()) {
            $this->getResultsRepository()->save($result);

            return $this->redirectToRoute('results_list');
        }

        return $this->render('results/edit.twig', ['my_form' => $resultForm->createView()]);
    }

    /**
     * @Route("/{locale}/results/view/{resultId}", name="result_view", requirements={"resultId": "\d+", "locale": "%app.locales%"})
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
}