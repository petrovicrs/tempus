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
use AppBundle\Entity\ProjectReportingProveraDokumentacije;
use AppBundle\Entity\Reporting;
use AppBundle\Entity\ReportingQuestionsAndAnswers;
use AppBundle\Form\ProjectReportingForm;
use AppBundle\Form\ProjectReportingProveraDokumentacijeForm;
use AppBundle\Form\ProjectReportingStepOne105Form;
use AppBundle\Form\ProjectReportingStepThree101Form;
use AppBundle\Form\ProjectReportingStepThree102Form;
use AppBundle\Form\ProjectReportingStepThree105Form;
use AppBundle\Form\ProjectReportingStepFiveForm;
use AppBundle\Form\ReportingEditStartForm;
use AppBundle\Form\ReportingStartForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Repository\ProjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ReportingController extends AbstractController
{
    //Izvestaj o napretku/Srednjorocni izvestaj 101, 102, 104
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

    //Izvestaj o napretku/Srednjorocni izvestaj 105

    const PITANJE_105_1 = '1. Da li su mere sigurnosti i bezbednosti adekvatne?';
    const PITANJE_105_1_1 = '1.1. Ukoliko nisu, opisati sta je problem.';
    const PITANJE_105_2 = '2. Da li se sprovode aktivnosti diseminacije rezultata u skladu sa projektnom prijavom?';
    const PITANJE_105_2_1 = '2.1. Ukoliko ne, navesti uzroke, prepreke i preporuke.';
    const PITANJE_105_3 = '3. Da li se postuju zahtevi vidljivosti (koriscenje E+ logoa)?';
    const PITANJE_105_4 = '4. U slucaju da je naknadno vrsen proces izbora ucesnika mobilnosti, da li je taj proces bio transparentan?';
    const PITANJE_105_5 = '5. Da li su definisani kriterijumi selekcije ucesika mobilnosti?';
    const PITANJE_105_6 = '6. Da li su ispostovani kriterijumi selekcije ucesnika mobilnosti?';
    const PITANJE_105_7 = '7. U kojoj meri je priprema ucesnika bila u skladu sa aplikacijom? (Orijentacioni kursevi i jezicke pripreme)';
    const PITANJE_105_8 = '8. Da li se redovno koristi Mobility Tool, u rokovima koje propisuje Ugovor?';
    const PITANJE_105_9 = '9. Odnos planiranih i ostvarenih mobilnosti.';
    const PITANJE_105_10 = '10. Da li je profil ucesnika mobilnosti u skladu sa aplikacijom?';
    const PITANJE_105_11 = '11. Ukoliko postoji negativan uticaj izmene profila ucesnika na ishode projekta objasniti:';
    const PITANJE_105_12 = '12. Da li projektna prijava predvidja ukljucivanje ucesnika sa hendikepom?';
    const PITANJE_105_13 = '13. Da li broj omladinskih lidera/ekserata/trenera odgovara aktivnostima navedenim u odobrenom projektnom predlogu?';
    const PITANJE_105_14 = '14. Da li su procesi i ishodi ucenja prepoznati upotrebom alata YouthPass?';
    const PITANJE_105_15 = '15. Na osnovu sprovedenih mobilnosti i ciljeva projekta oceniti u kojoj meri su ostvareni ishodi projekta u odnosu na projektnu prijavu.';
    const PITANJE_105_15_1 = '15.1. Ostvarenost i kvalitet diseminacionih aktivnosti';
    const PITANJE_105_15_2 = '15.2. Sprovodjenje u skladu sa ugovorom';
    const PITANJE_105_15_3 = '15.3. Ostavrenost ciljeva projekta (sekcija H)';
    const PITANJE_105_15_4 = '15.4. Kvalitet saradnje sa partnerima na projektu';
    const PITANJE_105_15_5_1 = '15.5.1. Ostvarenost i mobilnost u svrhu: omladinskih razmena';
    const PITANJE_105_15_5_2 = '15.5.2. Ostvarenost i mobilnost u svrhu: EVSa';
    const PITANJE_105_15_5_3 = '15.5.3. Ostvarenost i mobilnost u svrhu: obuka omladinskih radnika';
    const PITANJE_105_19 = '19. Ukupna ocena projekta:';
    const PITANJE_105_20 = '20. Dodatni komentari (za internu upotrebu)';
    const PITANJE_105_21 = '21. Ukratko sumirati rezultate projekta:';
    const PITANJE_105_22 = '22. Preporuke na osnovu sprovedene evaluacije:';

    /**
     * @Route("/{locale}/reporting/create-report", name="reporting_start", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER_CREATE') or is_granted('ROLE_USER_PROJECT_CREATE') or is_granted('ROLE_ADMIN')")
     *
     */
    public function createReportAction(Request $request)
    {
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        /** @var Reporting $reporting */
        $reporting = new Reporting();

        $reportingStartForm = $this->createForm(ReportingStartForm::class, $reporting, [
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $actionTab = $project->getKeyActions()->getNameSr();
        $isCompleted = $project->getIsCompleted();

        $reportingStartForm->handleRequest($request);

        /** @var ProjectReporting $projectReporting */
        $projectReporting = $this->getProjectReportingRepository()->findBy(
            ['project' => $project->getId()],
            ['id' => 'DESC']
        );

        if ($reportingStartForm->isSubmitted() && $reportingStartForm->isValid())
        {
            $reporting->setProject($project);
            $this->getReportingRepository()->save($reporting);

            $reportingType = $reporting->getType()->getName($request->getLocale());

            if ($reportingType === 'Srednjerocni izvestaj') {
                return $this->redirectToRoute('reporting_create_type_one', ['active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Zavrsni izvestaj') {
                return $this->redirectToRoute('reporting_create_type_two', ['active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Provera dokumentacije na licu mesta') {
                return $this->redirectToRoute('reporting_create_type_three', ['active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Obrazac za proveru finansijskog dela izvestaja') {
                return $this->redirectToRoute('reporting_create_type_four', ['active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Obrazac za prveru formalne prihvatljivosti finalnog izvestaja') {
                return $this->redirectToRoute('reporting_create_type_five', ['active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
        }

        $data = [
            'my_form' => $reportingStartForm->createView(),
            'keyAction' => $actionTab,
            'isCompleted' => $isCompleted,
            'actionTab' => $this->showActionTab($project),
            'projectId' => $project->getId(),
            'projectReporting' => $projectReporting
        ];

        return $this->render('reporting/create-report.twig', $data);
    }

    /**
     * @Route("/{locale}/reporting/create-report-type-one", name="reporting_create_type_one", requirements={"locale": "%app.locales%"})
     */
    public function createReportTypeOneAction(Request $request)
    {
        $projectReporting = new ProjectReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        if ($project->getActions()->getNameSr() === 'KA105') {
            $projectReportingForm = $this->createForm(ProjectReportingStepOne105Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_one'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        } else {
            $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_one'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Srednjerocni izvestaj']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction === 'ka1') {
                return $this->redirectToRoute('attachments_create');
            }

            return $this->redirectToRoute('equipment_create');
        }

        return $this->render(
            'reporting/create-report-type-one.twig',
            [
                'my_form' => $projectReportingForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'actionTab' => $this->showActionTab($project),
                'isCompleted' => $project->getIsCompleted(),
                'action' => $project->getActions()->getNameSr()
            ]
        );
    }

    /**
     * @Route("/{locale}/reporting/create-report-type-two", name="reporting_create_type_two", requirements={"locale": "%app.locales%"})
     */
    public function createReportTypeTwoAction(Request $request)
    {
        $projectReporting = new ProjectReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        if ($project->getActions()->getNameSr() === 'KA105') {
            $projectReportingForm = $this->createForm(ProjectReportingStepOne105Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_two'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        } else {
            $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_two'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Zavrsni izvestaj']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction === 'ka1') {
                return $this->redirectToRoute('attachments_create');
            }

            return $this->redirectToRoute('equipment_create');

        }

        return $this->render(
            'reporting/create-report-type-two.twig',
            [
                'my_form' => $projectReportingForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'actionTab' => $this->showActionTab($project),
                'isCompleted' => $project->getIsCompleted(),
                'action' => $project->getActions()->getNameSr()
            ]
        );
    }

    /**
     * @Route("/{locale}/reporting/create-report-type-three", name="reporting_create_type_three", requirements={"locale": "%app.locales%"})
     */
    public function createReportTypeThreeAction(Request $request)
    {
        $projectReporting = new ProjectReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectAction = $project->getActions()->getNameSr();

        if ($projectAction === 'KA101' || $projectAction === 'KA104') {
            $projectReportingForm = $this->createForm(ProjectReportingStepThree101Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_three'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        } elseif ($projectAction === 'KA102') {
            $projectReportingForm = $this->createForm(ProjectReportingStepThree102Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_three'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        } elseif ($projectAction === 'KA105') {
            $projectReportingForm = $this->createForm(ProjectReportingStepThree105Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_three'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Provera dokumentacije na licu mesta']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction === 'ka1') {
                return $this->redirectToRoute('attachments_create');
            }

            return $this->redirectToRoute('equipment_create');

        }

        return $this->render(
            'reporting/create-report-type-three.twig',
            [
                'my_form' => $projectReportingForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'actionTab' => $this->showActionTab($project),
                'isCompleted' => $project->getIsCompleted(),
                'action' => $project->getActions()->getNameSr()
            ]
        );
    }

    /**
     * @Route("/{locale}/reporting/create-report-type-four", name="reporting_create_type_four", requirements={"locale": "%app.locales%"})
     */
    public function createReportTypeFourAction(Request $request)
    {
        $projectReporting = new ProjectReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectAction = $project->getActions()->getNameSr();

        if ($projectAction === 'KA101' || $projectAction === 'KA104') {
            $projectReportingForm = $this->createForm(ProjectReportingStepThree101Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_three'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        } elseif ($projectAction === 'KA102') {
            $projectReportingForm = $this->createForm(ProjectReportingStepThree102Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_three'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        } elseif ($projectAction === 'KA105') {
            $projectReportingForm = $this->createForm(ProjectReportingStepThree105Form::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_create_type_three'),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Obrazac za proveru finansijskog dela izvestaja']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction == 'ka1') {
                return $this->redirectToRoute('attachments_create');
            } else {
                return $this->redirectToRoute('equipment_create');
            }
        }

        return $this->render(
            'reporting/create-report-type-four.twig',
            [
                'my_form' => $projectReportingForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'actionTab' => $this->showActionTab($project),
                'isCompleted' => $project->getIsCompleted(),
                'action' => $project->getActions()->getNameSr()
            ]
        );
    }

    /**
     * @Route("/{locale}/reporting/create-report-type-five", name="reporting_create_type_five", requirements={"locale": "%app.locales%"})
     */
    public function createReportTypeFiveAction(Request $request)
    {
        $projectReporting = new ProjectReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectReportingForm = $this->createForm(ProjectReportingStepFiveForm::class, $projectReporting, [
            'action' => $this->generateUrl('reporting_create_type_five'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Obrazac za prveru formalne prihvatljivosti finalnog izvestaja']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if ($keyAction == 'ka1') {
                return $this->redirectToRoute('attachments_create');
            } else {
                return $this->redirectToRoute('equipment_create');
            }
        }

        return $this->render(
            'reporting/create-report-type-five.twig',
            [
                'my_form' => $projectReportingForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'actionTab' => $this->showActionTab($project),
                'isCompleted' => $project->getIsCompleted(),
                'action' => $project->getActions()->getNameSr()
            ]
        );
    }

    /**
     * @Route("/{locale}/reporting/edit/{projectId}", name="reporting_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        /** @var Reporting $reporting */
        $reporting = new Reporting();

        $reportingStartForm = $this->createForm(ReportingEditStartForm::class, $reporting, [
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $actionTab = $project->getKeyActions()->getNameSr();
        $isCompleted = $project->getIsCompleted();

        $reportingStartForm->handleRequest($request);

        /** @var ProjectReporting $projectReporting */
        $projectReporting = $this->getProjectReportingRepository()->findBy(
            ['project' => $projectId],
            ['id' => 'DESC']
        );


        if ($reportingStartForm->isSubmitted() && $reportingStartForm->isValid())
        {
            $reportingType = $reporting->getType()->getName($request->getLocale());

            if ($reportingType === 'Srednjerocni izvestaj') {
                return $this->redirectToRoute('reporting_edit_type_one', ['projectId' => $projectId, 'active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Zavrsni izvestaj') {
                return $this->redirectToRoute('reporting_edit_type_two', ['projectId' => $projectId, 'active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Provera dokumentacije na licu mesta') {
                return $this->redirectToRoute('reporting_edit_type_three', ['projectId' => $projectId, 'active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Obrazac za proveru finansijskog dela izvestaja') {
                return $this->redirectToRoute('reporting_edit_type_four', ['projectId' => $projectId, 'active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
            if ($reportingType === 'Obrazac za prveru formalne prihvatljivosti finalnog izvestaja') {
                return $this->redirectToRoute('reporting_edit_type_five', ['projectId' => $projectId, 'active' => 'reporting', 'actionTab' => $actionTab, 'isCompleted' => $isCompleted]);
            }
        }

        $data = [
            'my_form' => $reportingStartForm->createView(),
            'keyAction' => $actionTab,
            'isCompleted' => $isCompleted,
            'actionTab' => $this->showActionTab($project),
            'projectId' => $project->getId(),
            'projectReporting' => $projectReporting ?: null
        ];

        return $this->render('reporting/edit-report.twig', $data);
    }

    /**
     * @Route("/{locale}/reporting/edit-report-type-one/{projectId}/report/{reportId}", name="reporting_edit_type_one",
     *      defaults={"reportId": null}, requirements={"locale": "%app.locales%", "reportId": "\d+$|^$", "projectId": "\d+"})
     */
    public function reportingEditTypeOneAction(Request $request, $reportId = null, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if ($reportId !== null) {
            /** @var ProjectReporting $projectReporting */
            $projectReporting = $this->getProjectReportingRepository()->findOneBy(
                ['id' => $reportId]
            );

            if ($project->getActions()->getNameSr() === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepOne105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_one', ['reportId' => $reportId, 'projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            } else {
                $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_one', ['reportId' => $reportId, 'projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            }
        } else {
            $projectReporting = new ProjectReporting();
            $projectReporting->setProject($project);

            if ($project->getActions()->getNameSr() === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepOne105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_one', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            } else {
                $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_one', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            }
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Srednjerocni izvestaj']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if (!$project->getIsCompleted()) {
                if ($keyAction === 'ka1') {
                    return $this->redirectToRoute('attachments_create');
                }

                return $this->redirectToRoute('equipment_create');

            }
        }

        return $this->render('reporting/edit.twig', [
            'my_form' => $projectReportingForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $this->showActionTab($project),
            'action' => $project->getActions()->getNameSr()
        ]);
    }

    /**
     * @Route("/{locale}/reporting/edit-report-type-two/{projectId}/report/{reportId}", name="reporting_edit_type_two",
     *      defaults={"reportId": null}, requirements={"locale": "%app.locales%", "reportId": "\d+$|^$", "projectId": "\d+"})
     */
    public function reportingEditTypeTwoAction(Request $request, $reportId = null, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if ($reportId !== null) {
            /** @var ProjectReporting $projectReporting */
            $projectReporting = $this->getProjectReportingRepository()->findOneBy(
                ['id' => $reportId]
            );

            if ($project->getActions()->getNameSr() === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepOne105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_two', ['reportId' => $reportId, 'projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            } else {
                $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_two', ['reportId' => $reportId, 'projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            }
        } else {
            $projectReporting = new ProjectReporting();
            $projectReporting->setProject($project);

            if ($project->getActions()->getNameSr() === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepOne105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_two', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            } else {
                $projectReportingForm = $this->createForm(ProjectReportingForm::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_two', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                    'isCompleted' => $project->getIsCompleted(),
                ]);
            }
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Zavrsni izvestaj']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if (!$project->getIsCompleted()) {
                if ($keyAction === 'ka1') {
                    return $this->redirectToRoute('attachments_create');
                }

                return $this->redirectToRoute('equipment_create');

            }
        }

        return $this->render('reporting/edit-report-type-two.twig', [
            'my_form' => $projectReportingForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $this->showActionTab($project),
            'action' => $project->getActions()->getNameSr()
        ]);
    }

    /**
     * @Route("/{locale}/reporting/edit-report-type-three/{projectId}/report/{reportId}", name="reporting_edit_type_three",
     *      defaults={"reportId": null}, requirements={"locale": "%app.locales%", "reportId": "\d+$|^$", "projectId": "\d+"})
     */
    public function reportingEditTypeThreeAction(Request $request, $reportId = null, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectAction = $project->getActions()->getNameSr();
        if ($reportId !== null) {
            /** @var ProjectReporting $projectReporting */
            $projectReporting = $this->getProjectReportingRepository()->findOneBy(
                ['id' => $reportId]
            );

            if ($projectAction === 'KA101' || $projectAction === 'KA104') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree101Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_three', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                ]);
            } elseif ($projectAction === 'KA102') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree102Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_three', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            } elseif ($projectAction === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_three', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            }
        } else {
            $projectReporting = new ProjectReporting();
            $projectReporting->setProject($project);

            if ($projectAction === 'KA101' || $projectAction === 'KA104') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree101Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_three', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            } elseif ($projectAction === 'KA102') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree102Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_three', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            } elseif ($projectAction === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_three', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            }
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Provera dokumentacije na licu mesta']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            return $this->redirectToRoute('reporting_edit');
        }

        return $this->render('reporting/edit-report-type-three.twig', [
            'my_form' => $projectReportingForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $this->showActionTab($project),
            'action' => $project->getActions()->getNameSr(),
        ]);
    }

    /**
     * @Route("/{locale}/reporting/edit-report-type-four/{projectId}/report/{reportId}", name="reporting_edit_type_four",
     *      defaults={"reportId": null}, requirements={"locale": "%app.locales%", "reportId": "\d+$|^$", "projectId": "\d+"})
     */
    public function reportingEditTypeFourAction(Request $request, $reportId = null, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectAction = $project->getActions()->getNameSr();
        if ($reportId !== null) {
            /** @var ProjectReporting $projectReporting */
            $projectReporting = $this->getProjectReportingRepository()->findOneBy(
                ['id' => $reportId]
            );

            if ($projectAction === 'KA101' || $projectAction === 'KA104') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree101Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_four', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale(),
                ]);
            } elseif ($projectAction === 'KA102') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree102Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_four', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            } elseif ($projectAction === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_four', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            }
        } else {
            $projectReporting = new ProjectReporting();
            $projectReporting->setProject($project);

            if ($projectAction === 'KA101' || $projectAction === 'KA104') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree101Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_four', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            } elseif ($projectAction === 'KA102') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree102Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_four', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            } elseif ($projectAction === 'KA105') {
                $projectReportingForm = $this->createForm(ProjectReportingStepThree105Form::class, $projectReporting, [
                    'action' => $this->generateUrl('reporting_edit_type_four', ['projectId' => $projectId]),
                    'method' => 'POST',
                    'locale' => $request->getLocale()
                ]);
            }
        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Obrazac za proveru finansijskog dela izvestaja']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if (!$project->getIsCompleted()) {
                if ($keyAction === 'ka1') {
                    return $this->redirectToRoute('attachments_create');
                }

                return $this->redirectToRoute('equipment_create');

            }
        }

        return $this->render('reporting/edit-report-type-four.twig', [
            'my_form' => $projectReportingForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $this->showActionTab($project),
            'action' => $project->getActions()->getNameSr(),
        ]);
    }

    /**
     * @Route("/{locale}/reporting/edit-report-type-five/{projectId}/report/{reportId}", name="reporting_edit_type_five",
     *      defaults={"reportId": null}, requirements={"locale": "%app.locales%", "reportId": "\d+$|^$", "projectId": "\d+"})
     */
    public function reportingEditTypeFiveAction(Request $request, $reportId = null, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if ($reportId !== null) {
            /** @var ProjectReporting $projectReporting */
            $projectReporting = $this->getProjectReportingRepository()->findOneBy(
                ['id' => $reportId]
            );
            $projectReportingForm = $this->createForm(ProjectReportingStepFiveForm::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_edit_type_five', ['projectId' => $projectId]),
                'method' => 'POST',
                'locale' => $request->getLocale(),
            ]);
        } else {
            $projectReporting = new ProjectReporting();
            $projectReporting->setProject($project);

            $projectReportingForm = $this->createForm(ProjectReportingStepFiveForm::class, $projectReporting, [
                'action' => $this->generateUrl('reporting_edit_type_five', ['projectId' => $projectId]),
                'method' => 'POST',
                'locale' => $request->getLocale()
            ]);

        }

        $keyAction = $project->getKeyActions()->getNameSr();

        $projectReportingForm->handleRequest($request);

        if ($projectReportingForm->isSubmitted() && $projectReportingForm->isValid()) {

            $projectReporting->setProject($project);

            $reportingType = $this->getReportingTypeRepository()->findOneBy(
                ['nameSr' => 'Obrazac za prveru formalne prihvatljivosti finalnog izvestaja']
            );

            $projectReporting->setReportingType($reportingType);

            $this->getProjectReportingRepository()->save($projectReporting);

            if (!$project->getIsCompleted()) {
                if ($keyAction === 'ka1') {
                    return $this->redirectToRoute('attachments_create');
                }

                return $this->redirectToRoute('equipment_create');

            }
        }

        return $this->render('reporting/edit-report-type-five.twig', [
            'my_form' => $projectReportingForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $this->showActionTab($project),
            'action' => $project->getActions()->getNameSr(),
        ]);
    }

    /**
     * @Route("/{locale}/reporting/view/{projectId}", name="reporting_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        /** @var ProjectReporting $projectReporting */
        $projectReporting = $this->getProjectReportingRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        return $this->render(
            'reporting/view.twig',
            [
                'reports' => $projectReporting ?: null,
                'projectId' => $projectId,
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'actionTab' => $this->showActionTab($project),
                'action' => $project->getActions()->getNameSr()
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

    private function getReportingTypeRepository()
    {
        return $this->get('doctrine_entity_repository.reporting_type');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}