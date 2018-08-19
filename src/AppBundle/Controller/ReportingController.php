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
    const PITANJE_1 = '1. Da li je Evropski razvojni plan usvojen na nivou organizacije?';
    const PITANJE_2 = '2. Da li je projekat doprineo realizaciji Evropskog razvojnog plana?';
    const PITANJE_2_1 = '2.1. Ukoliko jeste na koji nacin?';
    const PITANJE_3 = '3. Da li se sprovode aktivnosti diseminacije rezultata u skladu sa projektnom prijavom?';
    const PITANJE_3_1 = '3.1 Ukoliko ne, navesti uzroke, prepreke i preporuke.';
    const PITANJE_4 = '4. Da li se postuju zahtevi vidljivosti (koriscenje E+ logoa)?';
    const PITANJE_5 = '5. Da li je proces izbora ucesnika mobilnosti bio transparentan?';
    const PITANJE_6 = '6. Da li su definisani kriterijumi selekcije ucesika mobilnosti?';
    const PITANJE_7 = '7. Da li su ispostovani kriterijumi selekcije ucesnika mobilnosti?';
    const PITANJE_8 = '8. U kojoj meri je priprema ucesnika bila u skladu sa aplikacijom? (Orijentacioni kursevi i jezicke pripreme)';
    const PITANJE_9 = '9. Da li se redovno koristi Mobility Tool, u rokovima koje propisuje Ugovor?';
    const PITANJE_10 = '10. Odnos planiranih i ostvarenih mobilnosti.';
    const PITANJE_11 = '11. Da li je profil ucesnika mobilnosti u skladu sa aplikacijom?';
    const PITANJE_12 = '12. Ukoliko postoji negativan uticaj izmene profila ucesnika na ishode projekta objasniti:';
    const PITANJE_13 = '13. Da li projektna prijava predvidja ukljucivanje ucesnika sa hendikepom?';
    const PITANJE_14 = '14. Da li su procesi i sihodi ucenja prepoznati upotrebom alata Europasa ili relevantnih alata?';
    const PITANJE_15_1 = '15.1 Ostvarenost i kvalitet diseminacionih aktivnosti';
    const PITANJE_15_2 = '15.2 Sprovodjenje u skladu sa ugovorom';
    const PITANJE_15_3 = '15.3. Ostvarenost ciljeva projekta (sekcija H)';
    const PITANJE_15_4 = '15.4 Kvalitet saradnje sa partnerima na projektu';
    const PITANJE_15_5_1 = '15.5.1 Ostvarenost mobilnosti u svrhu: ucenja';
    const PITANJE_15_5_2 = '15.5.2 Ostvarenost mobilnosti u svrhu: obuka';
    const PITANJE_15_5_3 = '15.5.3 Ostvarenost mobilnosti u svrhu: praksi';
    const PITANJE_15_5_4 = '15.5.4 Ostvarenost mobilnosti u svrhu: posmatranja na poslu';
    const PITANJE_16 = '16. Ukupna ocena projekta';
    const PITANJE_17_1 = '17.1 Ostvarenost i kvalitet diseminacionih aktivnosti';
    const PITANJE_17_2 = '17.2 Sprovodjenje u skladu sa ugovorom';
    const PITANJE_17_3 = '17.3. Ostvarenost ciljeva projekta (sekcija H)';
    const PITANJE_17_4 = '17.4 Kvalitet saradnje sa partnerima na projektu';
    const PITANJE_17_5_1 = '17.5.1 Ostvarenost mobilnosti u svrhu: ucenja';
    const PITANJE_17_5_2 = '17.5.2 Ostvarenost mobilnosti u svrhu: obuka';
    const PITANJE_17_5_3 = '17.5.3 Ostvarenost mobilnosti u svrhu: praksi';
    const PITANJE_17_5_4 = '17.5.4 Ostvarenost mobilnosti u svrhu: posmatranja na poslu';
    const PITANJE_18 = '18. Da li se rezultati vezani za projekat mogu uzeti kao promeri dobre prakse?';
    const PITANJE_19 = '19. Ukupna ocena projekta';
    const PITANJE_20 = '20. Dodatni komentari (za internu upotrebu)';
    const PITANJE_21 = '21. Ukratko sumirati rezultate projekta:';
    const PITANJE_22 = '22. Preporuke na osnovu sprovedene evaluacije:';
//    /**
//     * @Route("/{locale}/reporting/list", name="reporting_list", requirements={"locale": "%app.locales%"})
//     */
//    public function listAction()
//    {
//        $projectReporting = $this->getProjectReportingRepository()->findAll();
//        return $this->render('reporting/list.twig', ['projectReporting' => $projectReporting]);
//    }
//
//    /**
//     * @Route("/{locale}/reporting/create", name="reporting_create", requirements={"locale": "%app.locales%"})
//     */
//    public function createAction(Request $request)
//    {
//        $projectReporting = new ProjectReporting();
//        $questions = $this->getQuestionsRepository()->findAll();
//
//        /** @var Project $project */
//        $project = $this->getLastProjectForCurrentUser();
//
//        $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
//            'action' => $this->generateUrl('reporting_create'),
//            'method' => 'POST',
//            'locale' => $request->getLocale()
//        ]);
//
//        $projectReportingForm->handleRequest($request);
//
//        $keyAction = $project->getKeyActions()->getNameSr();
//
//        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {
//
//            /** @var Reporting $reporting */
//            foreach ($projectReporting->getReporting() as $reporting) {
//
//                foreach($reporting->getReportingBy() as $reportingPerson){
//                    $reportingPerson->setReportingBy($reporting);
//                    $this->getReportingPersonRepository()->save($reportingPerson);
//                }
//
//                // Save questions and answers to ReportingQuestionsAndAnswers
//                foreach ($questions as $index => $qa) {
//
//                    $reportingQuestionsAndAnswers = new ReportingQuestionsAndAnswers();
//
//                    $answer = $request->request->get('appbundle_project')['questionsAndAnswers'][$index];
//                    $dynamicFunction = 'setAnswer' . ucfirst($request->getLocale());
//                    $reportingQuestionsAndAnswers->$dynamicFunction($answer['answer'.ucfirst($request->getLocale())]);
//
//                    $reportingQuestionsAndAnswers->setQuestions($qa);
//                    $reportingQuestionsAndAnswers->setReporting($reporting);
//
//                    $this->getQuestionAndAnswersRepository()->save($reportingQuestionsAndAnswers);
//                }
//
//                $reporting->setProjectReporting($projectReporting);
//                $this->getReportingRepository()->save($reporting);
//            }
//
//            $projectReporting->setProject($project);
//            $this->getProjectReportingRepository()->save($projectReporting);
//
//            if ($keyAction == 'ka1') {
//                return $this->redirectToRoute('attachments_create');
//            } else {
//                return $this->redirectToRoute('equipment_create');
//            }
//        }
//
//        return $this->render(
//            'reporting/create.twig',
//            ['my_form' => $projectReportingForm->createView(), 'questions' => $questions,
//                'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId(),
//                'actionTab' => $this->showActionTab($project),
//                'isCompleted' => $project->getIsCompleted()]);
//    }
//
    /**
     * @Route("/{locale}/reporting/edit/{projectId}", name="reporting_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectReporting $projectReporting */
        $projectReporting = $this->getProjectReportingRepository()->findOneBy(
            ['project' => $projectId],
            ['id' => 'DESC']
        );

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (count($projectReporting) === 0) {
            $projectReporting = new ProjectReporting();
            $projectReporting->setProject($project);
            $this->getProjectReportingRepository()->save($projectReporting);
        }

        $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
            'action' => $this->generateUrl('reporting_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction == 'ka1') {
                return $this->redirectToRoute('attachments_create');
            } else {
                return $this->redirectToRoute('equipment_create');
            }
        }

        return $this->render('reporting/edit.twig', [
            'my_form' => $projectReportingForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $this->showActionTab($project),
        ]);
    }
//
//    /**
//     * @Route("/{locale}/reporting/view/{projectId}", name="reporting_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
//     */
//    public function viewAction($projectId)
//    {
//        /** @var ProjectReporting $projectReporting */
//        $projectReporting = $this->getProjectReportingRepository()->findOneBy(['project' => $projectId]);
//
//        $questions = $this->getQuestionsRepository()->findAll();
//
//        /** @var Project $project */
//        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);
//
//        return $this->render(
//            'reporting/view.twig',
//            [
//                'reports' => $projectReporting ? $projectReporting->getReporting() : null,
//                'projectId' => $projectId,
//                'questions' => $questions,
//                'keyAction' => $project->getKeyActions()->getNameSr(),
//                'actionTab' => $this->showActionTab($project)
//            ]
//        );
//    }
    /**
    * @Route("/{locale}/reporting/create", name="reporting_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectReporting = new ProjectReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
            'action' => $this->generateUrl('reporting_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction == 'ka1') {
                return $this->redirectToRoute('attachments_create');
            } else {
                return $this->redirectToRoute('equipment_create');
            }
        }

        return $this->render(
            'reporting/create.twig',
            [
                'my_form' => $projectReportingForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'actionTab' => $this->showActionTab($project),
                'isCompleted' => $project->getIsCompleted()
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