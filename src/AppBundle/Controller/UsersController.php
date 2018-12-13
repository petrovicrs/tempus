<?php

namespace AppBundle\Controller;

use AppBundle\Form\User\UserForm;
use AppBundle\Repository\UserRepository;
use AppBundle\DataTableType\UserDataTableType;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UsersController
 *
 * @package AppBundle\Controller
 */
class UsersController extends AbstractController {

    /**
     * @Route("/{locale}/admin/users/list", name="user_list", requirements={"locale": "%app.locales%"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $this->setPageTitle($this->translate('page.users.title'));
        $table = $this->createDataTableFromType(UserDataTableType::class, [], [
            'searching' => true
        ]);
        $table->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('list/list.html.twig', [
            'datatable' => $table,
            'datatable_link_title' => $this->translate('page.add_user.title'),
            'datatable_link' => $this->generateUrl('user_create', ['locale' => $request->getLocale()]),
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/create", name="user_create", requirements={"locale": "%app.locales%"})
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
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user);
            $this->setInfoMessage('User crated');
        }
        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
            'form_classes' => 'user-form user-create-form'
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/edit/{userId}", name="user_edit", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction(Request $request, int $userId) {
        $this->setPageTitle($this->translate('page.users.edit_user.title'));
        $user = $this->getUserRepository()->find($userId);
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('user_edit', ['userId' => $userId]),
            'method' => 'POST',
            'with_password_field' => false
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getUserRepository()->save($user);
            $this->setInfoMessage('User updated');
        }
        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/edit-password/{userId}", name="user_edit_password", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editPasswordAction(Request $request, int $userId) {
        $this->setPageTitle($this->translate('page.users.edit_user_password.title'));
        $user = $this->getUserRepository()->find($userId);
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('user_edit', ['userId' => $userId]),
            'method' => 'POST',
            'with_password_field' => true
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getUserRepository()->save($user);
            $this->setInfoMessage('User updated');
        }
        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{locale}/admin/users/view/{userId}", name="user_view", requirements={"userId": "\d+", "locale": "%app.locales%"})
     * @param Request $request
     * @param int $userId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, int $userId) {
        $this->setPageTitle($this->translate('page.users.view_user_title'));
        $user = $this->getUserRepository()->find($userId);
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('user_view', ['userId' => $userId]),
            'method' => 'POST',
            'disabled' => true,
        ]);
        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository() {
        /** @var UserRepository $repo */
        $repo = $this->container->get('doctrine_entity_repository.user');
        return $repo;
    }

}