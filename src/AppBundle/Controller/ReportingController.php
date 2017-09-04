<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:21
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Reporting;
use AppBundle\Entity\ReportingQuestionsAndAnswers;
use AppBundle\Form\ReportingForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

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
        $questions = $this->getQuestionsRepository()->findAll();


        $reportingForm = $this->createForm(ReportingForm::class, $reporting, [
            'action' => $this->generateUrl('reporting_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $reportingForm->handleRequest($request);

        if ($reportingForm->isSubmitted() && $reportingForm->isValid()) {

            // Save questions and answers to ReportingQuestionsAndAnswers
            foreach ($questions as $index => $qa) {
                $reportingQuestionsAndAnswers = new ReportingQuestionsAndAnswers();

                $answer = $request->request->get('appbundle_project')['questionsAndAnswers'][$index];
                $dynamicFunction = 'setAnswer' . ucfirst($request->getLocale());
                $reportingQuestionsAndAnswers->$dynamicFunction($answer['answer'.ucfirst($request->getLocale())]);

                $reportingQuestionsAndAnswers->setQuestions($qa);
                $reportingQuestionsAndAnswers->setReporting($reporting);

                $this->getQuestionAndAnswersRepository()->save($reportingQuestionsAndAnswers);
            }

            $reporting->setProject($this->getLastProjectForCurrentUser());
            $this->getReportingRepository()->save($reporting);

            foreach($reporting->getReportingBy() as $reportingPerson){
                $reportingPerson->setReportingBy($reporting);
                $this->getReportingPersonRepository()->save($reportingPerson);
            }

            return $this->redirectToRoute('reporting_list');
        }

        return $this->render(
            'reporting/create.twig',
            ['my_form' => $reportingForm->createView(), 'questions' => $questions]);
    }

    /**
     * @Route("/{locale}/reporting/edit/{id}", name="reporting_edit", requirements={"locale": "%app.locales%", "id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $reporting = $this->getReportingRepository()->findOneBy('id', $id);

        $reportingForm = $this->createForm(ReportingForm::class, $reporting, [
            'action' => $this->generateUrl('reporting_edit', ['id' => $id]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $reportingBy = new ArrayCollection();
        $questionAndAnswers = new ArrayCollection();

        foreach ($reporting->getReportingBy() as $reportingPerson) {
            $reportingBy->add($reportingPerson);
        }

        foreach ($reporting->getQuestionAndAnswers() as $qa) {
            $questionAndAnswers->add($qa);
        }

        $reportingForm->handleRequest($request);

        if ($reportingForm->isSubmitted() && $reportingForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($reportingBy as $reportingPerson) {
                if (false === $reporting->getReportingBy()->contains($reportingPerson)) {
                    $em->remove($reportingPerson);
                }
            }

            foreach ($questionAndAnswers as $qa) {
                if (false === $reporting->getQuestionAndAnswers()->contains($qa)) {
                    $em->remove($qa);
                }
            }

            $this->getReportingRepository()->save($reporting);

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

    private function getQuestionsRepository()
    {
        return $this->get('doctrine_entity_repository.questions');
    }

    private function getReportingPersonRepository()
    {
        return $this->get('doctrine_entity_repository.reporting_person');
    }
}