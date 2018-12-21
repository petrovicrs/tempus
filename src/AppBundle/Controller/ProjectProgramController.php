<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Form\ProjectProgramForm\ProgramForm;
use AppBundle\Repository\ProjectProgram;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DataTableType\ProjectsProgramDataTableType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class ProjectProgramController
 *
 * @package AppBundle\Controller
 */
class ProjectProgramController extends AbstractController {

    /**
     * @Route("/{locale}/admin/project-programs/list", name="project_programs_list", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $this->setPageTitle($this->translate('page.project.program.title'));
        $table = $this->createDataTableFromType(ProjectsProgramDataTableType::class, [], [
            'searching' => false
        ]);
        $table->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('list/list.html.twig', [
            'datatable' => $table,
            'datatable_link' => $this->generateUrl('project_programs_create', ['locale' => $request->getLocale()]),
            'datatable_link_title' => $this->translate('page.project.add_program.title'),
        ]);
    }

    /**
     * @Route("/{locale}/admin/project-programs/create", name="project_programs_create", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAction(Request $request) {
        $this->setPageTitle($this->translate('page.project.add_program.title'));
        $program = new ProjectProgramme();
        $form = $this->createForm(ProgramForm::class, $program, [
            'action' => $this->generateUrl('project_programs_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getProgramRepo()->save($program);
            $this->setInfoMessage(
                $this->translate('page.project.add_program.success', [
                    '%name%' => $program->getName($request->getLocale())
                ]), true
            );
            return $this->redirectToRoute('project_programs_list');
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'form_classes' => 'form project-programs-list',
            'back_link' => $this->generateUrl('project_programs_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/project-programs/edit/{programId}", name="project_programs_edit", requirements={"programId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_APP_SUPER_ADMIN')")
     * @param Request $request
     * @param int $programId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction(Request $request, int $programId) {
        $this->setPageTitle($this->translate('page.project.edit_program.title'));
        /** @var ProjectProgramme $program */
        $program = $this->getDoctrine()->getRepository(ProjectProgramme::class)->find($programId);
        $form = $this->createForm(ProgramForm::class, $program, [
            'action' => $this->generateUrl('project_programs_edit', ['programId' => $programId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getProgramRepo()->save($program);
            $this->setInfoMessage(
                $this->translate('page.project.edit_program.success', [
                    '%name%' => $program->getName($request->getLocale())
                ]),
                true
            );
            return $this->redirectToRoute('project_programs_list');
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'form_classes' => 'form project-programs-list',
            'back_link' => $this->generateUrl('project_programs_list')
        ]);

    }

    /**
     * @Route("/{locale}/admin/project-programs/view/{programId}", name="project_programs_view", requirements={"programId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_APP_SUPER_ADMIN')")
     * @param Request $request
     * @param int $programId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, int $programId) {
        $this->setPageTitle($this->translate('page.project.view_program.title'));
        /** @var ProjectProgramme $program */
        $program = $this->getDoctrine()->getRepository(ProjectProgramme::class)->find($programId);
        $form = $this->createForm(ProgramForm::class, $program, [
            'locale' => $request->getLocale(),
            'disabled' => true,
        ]);
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'form_classes' => 'form project-programs-list',
            'back_link' => $this->generateUrl('project_programs_list')
        ]);
    }

    /**
     * @return ProjectProgram
     */
    protected function getProgramRepo() {
        /** @var ProjectProgram  $repo */
        $repo = $this->get('doctrine_entity_repository.project_programs');
        return $repo;
    }

}