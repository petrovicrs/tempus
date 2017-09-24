<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Reporting;
use AppBundle\Entity\ReportingQuestionsAndAnswers;
use AppBundle\Form\ReportingForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Repository\ProjectRepository;

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

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

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

            $reporting->setProject($project);
            $this->getReportingRepository()->save($reporting);

            foreach($reporting->getReportingBy() as $reportingPerson){
                $reportingPerson->setReportingBy($reporting);
                $this->getReportingPersonRepository()->save($reportingPerson);
            }

            return $this->redirectToRoute('attachments_create');
        }

        return $this->render(
            'reporting/create.twig',
            ['my_form' => $reportingForm->createView(), 'questions' => $questions,
                'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/reporting/edit/{projectId}", name="reporting_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Reporting $reporting */
        $reporting = $this->getReportingRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $reportingForm = $this->createForm(ReportingForm::class, $reporting, [
            'action' => $this->generateUrl('reporting_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $reportingBy = new ArrayCollection();
        $questionAndAnswers = new ArrayCollection();

        foreach ($reporting->getReportingBy() as $reportingPerson) {
            $reportingBy->add($reportingPerson);
        }

        foreach ($reporting->getQuestionsAndAnswers() as $qa) {
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
                if (false === $reporting->getQuestionsAndAnswers()->contains($qa)) {
                    $em->remove($qa);
                }
            }

            $this->getReportingRepository()->save($reporting);

            if (!$reporting->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('attachments_create');
            }
        }

        return $this->render('reporting/edit.twig', ['my_form' => $reportingForm->createView(), 'keyAction' => $project->getKeyActions()->getNameSr()]);
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

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}