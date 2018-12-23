<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProgramAccess;
use AppBundle\Entity\UserProjectAccess;
use AppBundle\Form\UserForm\UserChangePasswordForm;
use AppBundle\Form\UserForm\UserForm;
use AppBundle\Form\UserForm\UserPermissionForm;
use AppBundle\Repository\UserRepository;
use AppBundle\DataTableType\UserDataTableType;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class UsersController
 *
 * @package AppBundle\Controller
 */
class UsersController extends AbstractController {

    /**
     * @Route("/{locale}/admin/users/list", name="user_list", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $accessibleUserIds = $this->getUserAcl()->getAccessibleUserIds($this->getUser());
        $this->setPageTitle($this->translate('page.users.title'));
        $table = $this->createDataTableFromType(UserDataTableType::class,
            ['accessibleUserIds' => $accessibleUserIds], ['searching' => true]
        );
        $table->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('list/list.html.twig', [
            'datatable' => $table,
            'datatable_link' => $this->generateUrl('user_create', ['locale' => $request->getLocale()]),
            'datatable_link_title' => $this->translate('page.users.add_user.title'),
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/create", name="user_create", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $this->setPageTitle($this->translate('page.users.add_user.title'));
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
            'new_user' => true,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user);
            $this->setInfoMessage($this->translate('page.users.add_user.success', ['%email%' => $user->getEmail()]), true);
            return $this->redirectToRoute('user_edit_permissions', ['userId' => $user->getId()]);
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'form_classes' => 'user-form user-create-form',
            'back_link' => $this->generateUrl('user_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/edit/{userId}", name="user_edit", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, int $userId) {
        if (!$this->getUserAcl()->isAccessible($userId, $this->getUser())) {
            throw new AccessDeniedException();
        }
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        if (!$user) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.users.edit_user.title', ['%email%' => $user->getEmail()]));
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('user_edit', ['userId' => $userId]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->setInfoMessage($this->translate('page.users.edit_user.success', ['%email%' => $user->getEmail()]), true);
            return $this->redirectToRoute('user_edit_permissions', ['userId' => $userId]);
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'sub_menu' => 'user_menu',
            'back_link' => $this->generateUrl('user_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/edit-password/{userId}", name="user_edit_password", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editPasswordAction(Request $request, int $userId) {
        if (!$this->getUserAcl()->isAccessible($userId, $this->getUser())) {
            throw new AccessDeniedException();
        }
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        if (!$user) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.users.edit_user_password.title', ['%email%' => $user->getEmail()]));
        $form = $this->createForm(UserChangePasswordForm::class, $user, [
            'action' => $this->generateUrl('user_edit_password', ['userId' => $userId]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updatePassword($user);
            $userManager->updateUser($user);
            $this->setInfoMessage($this->translate('page.users.edit_user_password.success', ['%email%' => $user->getEmail()]));
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'sub_menu' => 'user_menu',
            'back_link' => $this->generateUrl('user_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/view/{userId}", name="user_view", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, int $userId) {
        if (!$this->getUserAcl()->isAccessible($userId, $this->getUser())) {
            throw new AccessDeniedException();
        }
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        if (!$user) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.users.view_user.title', ['%email%' => $user->getEmail()]));
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('user_view', ['userId' => $userId]),
            'method' => 'POST',
            'disabled' => true,
        ]);
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('user_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/edit-user-permissions/{userId}", name="user_edit_permissions", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_APP_SUPER_ADMIN')")
     *
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editUserPermissionAction(Request $request, int $userId) {
        if (!$this->getUserAcl()->isAccessible($userId, $this->getUser())) {
            throw new AccessDeniedException();
        }
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        if (!$user) {
            throw new NotFoundHttpException();
        }
        $programs = $this->getUserProgramAccessRepository()
            ->createQueryBuilder('p')
            ->where('p.user = :userId')
            ->getQuery()->execute([':userId' => $userId]);
        $projects = $this->getUserProjectAccessRepository()
            ->createQueryBuilder('p')
            ->where('p.user = :userId')
            ->getQuery()->execute([':userId' => $userId]);
        $user->setProgramsAccess(new ArrayCollection($programs));
        $user->setProjectsAccess(new ArrayCollection($projects));
        $this->setPageTitle($this->translate('page.users.user_edit_permissions.title', ['%email%' => $user->getEmail()]));
        $form = $this->createForm(UserPermissionForm::class, $user, [
            'action' => $this->generateUrl('user_edit_permissions', ['userId' => $userId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'entityManager' => $this->getDoctrine()->getManager()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $programs = $this->getUserProgramAccessRepository()
                ->createQueryBuilder('p')
                ->where('p.user = :userId')
                ->getQuery()->execute([':userId' => $userId]);
            foreach ($programs as $program) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($program);
                $em->flush();
            }
            $projects = $this->getUserProjectAccessRepository()
                ->createQueryBuilder('p')
                ->where('p.user = :userId')
                ->getQuery()->execute([':userId' => $userId]);
            foreach ($projects as $project) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($project);
                $em->flush();
            }
            /** @var UserProgramAccess $programsAccess */
            foreach ($user->getProgramsAccess() as $programsAccess) {
                $programsAccess->setUser($user);
                $this->getUserProgramAccessRepository()->save($programsAccess);
            }
            /** @var UserProjectAccess $projectsAccess */
            foreach ($user->getProjectsAccess() as $projectsAccess) {
                $projectsAccess->setUser($user);
                $this->getUserProjectAccessRepository()->save($projectsAccess);
            }
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->setInfoMessage($this->translate('page.users.user_edit_permissions.success', ['%email%' => $user->getEmail()]));
        }
        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
            'sub_menu' => 'user_menu',
            'back_link' => $this->generateUrl('user_list')
        ]);
    }

    /**
     * @return UserRepository
     */
    private function getUserProgramAccessRepository() {
        /** @var UserRepository $repo */
        $repo = $this->container->get('doctrine_entity_repository.user_program_access');
        return $repo;
    }

    /**
     * @return UserRepository
     */
    private function getUserProjectAccessRepository() {
        /** @var UserRepository $repo */
        $repo = $this->container->get('doctrine_entity_repository.user_project_access');
        return $repo;
    }

}