<?php

namespace AppBundle\Controller;

use AppBundle\DataTableType\UserGroupDataTableType;
use AppBundle\Entity\UserGroup;
use AppBundle\Form\UserForm\UserGroupForm;
use AppBundle\Repository\UserGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class UsersGroupController
 *
 * @package AppBundle\Controller
 */
class UsersGroupController extends AbstractController {

    /**
     * @Route("/{locale}/admin/user-group/list", name="user_group_list", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $this->setPageTitle($this->translate('page.users.user_group.title'));
        $table = $this->createDataTableFromType(UserGroupDataTableType::class, [], [
            'searching' => true
        ]);
        $table->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('list/list.html.twig', [
            'datatable' => $table,
            'datatable_link' => $this->generateUrl('user_group_create', ['locale' => $request->getLocale()]),
            'datatable_link_title' => $this->translate('page.users.add_user_group.title'),
        ]);
    }

    /**
     * @Route("/{locale}/admin/user-group/create", name="user_group_create", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAction(Request $request) {
        $this->setPageTitle($this->translate('page.users.add_user_group.title'));
        $group = new UserGroup();
        $form = $this->createForm(UserGroupForm::class, $group, [
            'action' => $this->generateUrl('user_group_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'entityManager' => $this->getDoctrine()->getManager()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getGroupRepository()->save($group);
            $this->setInfoMessage($this->translate('page.users.add_user_group.success', [
                '%name%' => $group->getName($request->getLocale())
            ]), true);
            return $this->redirectToRoute('user_group_list');
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'form_classes' => 'user-form user-group-create-form',
            'back_link' => $this->generateUrl('user_group_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/user-group/edit/{groupId}", name="user_group_edit", requirements={"groupId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     * @param int $groupId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction(Request $request, int $groupId) {
        /** @var UserGroup $group */
        $group = $this->getDoctrine()->getRepository(UserGroup::class)->find($groupId);
        if (!$group) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.users.edit_user_group.title', [
            '%name%' => $group->getName($request->getLocale())
        ]));
        $form = $this->createForm(UserGroupForm::class, $group, [
            'action' => $this->generateUrl('user_group_edit', ['groupId' => $groupId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'entityManager' => $this->getDoctrine()->getManager()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getGroupRepository()->save($group);
            $this->setInfoMessage($this->translate('page.users.edit_user_group.success', [
                '%name%' => $group->getName($request->getLocale())
            ]), true);
            return $this->redirectToRoute('user_group_list');
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('user_group_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/user-group/view/{groupId}", name="user_group_view", requirements={"groupId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     * @param int $groupId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, int $groupId) {
        /** @var UserGroup $group */
        $group = $this->getDoctrine()->getRepository(UserGroup::class)->find($groupId);
        if (!$group) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.users.view_user_group.title', [
            '%name%' => $group->getName($request->getLocale())
        ]));
        $form = $this->createForm(UserGroupForm::class, $group, [
            'locale' => $request->getLocale(),
            'disabled' => true
        ]);
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('user_group_list')
        ]);
    }

    /**
     * @return UserGroupRepository
     */
    private function getGroupRepository() {
        /** @var UserGroupRepository $repo */
        $repo = $this->container->get('doctrine_entity_repository.user_group');
        return $repo;
    }

}