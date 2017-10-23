<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectReporting;
use AppBundle\Entity\Reporting;
use AppBundle\Entity\ReportingQuestionsAndAnswers;
use AppBundle\Form\ProjectReportingForm;
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
        $projectReporting = $this->getProjectReportingRepository()->findAll();
        return $this->render('reporting/list.twig', ['projectReporting' => $projectReporting]);
    }

    /**
     * @Route("/{locale}/reporting/create", name="reporting_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectReporting = new ProjectReporting();
        $questions = $this->getQuestionsRepository()->findAll();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
            'action' => $this->generateUrl('reporting_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            /** @var Reporting $reporting */
            foreach ($projectReporting->getReporting() as $reporting) {

                foreach($reporting->getReportingBy() as $reportingPerson){
                    $reportingPerson->setReportingBy($reporting);
                    $this->getReportingPersonRepository()->save($reportingPerson);
                }

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

                $reporting->setProjectReporting($projectReporting);
                $this->getReportingRepository()->save($reporting);
            }

            $projectReporting->setProject($project);
            $this->getProjectReportingRepository()->save($projectReporting);

            return $this->redirectToRoute('attachments_create');
        }

        return $this->render(
            'reporting/create.twig',
            ['my_form' => $projectReportingForm->createView(), 'questions' => $questions,
                'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/reporting/edit/{projectId}", name="reporting_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        $questions = $this->getQuestionsRepository()->findAll();

        /** @var Reporting $reporting */
        $projectReporting = $this->getProjectReportingRepository()->findOneBy(
            ['project' => $projectId],
            ['id' => 'DESC']
        );

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
            'action' => $this->generateUrl('reporting_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $reporting = new ArrayCollection();
        $reportingBy = new ArrayCollection();
        $questionAndAnswers = new ArrayCollection();

        /** @var Reporting $report */
        foreach ($projectReporting->getReporting() as $report) {

            $reporting->add($report);

            foreach ($report->getReportingBy() as $reportingPerson) {
                $reportingBy->add($reportingPerson);
            }

            foreach ($report->getQuestionsAndAnswers() as $qa) {
                $questionAndAnswers->add($qa);
            }
        }

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($reporting as $report) {
                if(false === $projectReporting->getReporting()->contains($report)) {
                    $em->remove($report);
                }
            }

            foreach ($reportingBy as $reportingPerson) {
                foreach ($projectReporting->getReporting() as $reporting) {
                    if (false === $reporting->getReportingBy()->contains($reportingPerson)) {
                        $em->remove($reportingPerson);
                    }
                }
            }

            foreach ($questionAndAnswers as $qa) {
                foreach ($projectReporting->getReporting() as $reporting) {
                    if (false === $reporting->getQuestionsAndAnswers()->contains($qa)) {
                        $em->remove($qa);
                    }
                }
            }

            foreach ($projectReporting->getReporting() as $reporting) {
                $this->getReportingRepository()->save($reporting);
            }

            $this->getProjectReportingRepository()->save($projectReporting);

            if (!$projectReporting->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('attachments_create');
            }
        }

        return $this->render('reporting/edit.twig', [
            'my_form' => $projectReportingForm->createView(),
            'questions' => $questions,
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
        ]);
    }

    /**
     * @Route("/{locale}/reporting/view/{Id}", name="reporting_view", requirements={"Id": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($id)
    {
        $reporting = $this->getReportingRepository()->findOneBy(['id' => $id]);

        return $this->render(
            'reporting/view.twig',
            [
                'reporting' => $reporting,
                'keyAction' => $reporting->getProjectReporting()->getProject()->getKeyActions()->getNameSr()
            ]
        );
    }

    private function getProjectReportingRepository()
    {
        return $this->get('doctrine_entity_repository.project_reporting');
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