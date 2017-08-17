<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:21
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Reporting;
use AppBundle\Form\ReportingForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReportingController extends AbstractController
{
    /**
     * @Route("/{locale}/reporting/list", name="reporting_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $reporting = $this->getReportingRepository()->findAll();
        return $this->render('reporting/list.twig', ['reporting' => $reporting]);
    }

    /**
     * @Route("/{locale}/reporting/create", name="reporting_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $reporting = new Reporting();

        $reportingForm = $this->createForm(ReportingForm::class, $reporting, [
            'action' => $this->generateUrl('reporting_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $reportingForm->handleRequest($request);

        if ($reportingForm->isSubmitted() && $reportingForm->isValid()) {

            $reporting->setProject($this->getLastProjectForCurrentUser());
            $this->getReportingRepository()->save($reporting);


            foreach($reporting->getQuestionAndAnswers() as $qa){
                $qa->setReporting($reporting);
                $this->getQuestionAndAnswersRepository()->save($qa);
            }

            foreach($reporting->getReportingBy() as $person){
                $person->setReportingBy($reporting);
                $this->getPersonRepository()->save($person);
            }

            return $this->redirectToRoute('reporting_list');
        }

        return $this->render('reporting/create.twig', ['my_form' => $reportingForm->createView()]);
    }

    private function getReportingRepository()
    {
        return $this->get('doctrine_entity_repository.reporting');
    }

    private function getQuestionAndAnswersRepository()
    {
        return $this->get('doctrine_entity_repository.reporting_questions_and_answers');
    }

    private function getPersonRepository()
    {
        return $this->get('doctrine_entity_repository.person');
    }
}