<?php
///**
// * Created by PhpStorm.
// * User: nemtish
// * Date: 08.08.17
// * Time: 22:27
// */
//
//namespace AppBundle\Controller;
//
//use AppBundle\Entity\ExistingInstitutionPermission;
//use AppBundle\Entity\ExistingProjectPermission;
//use AppBundle\Entity\Project;
//use AppBundle\Entity\UserPermission;
//use AppBundle\Entity\Results;
//use AppBundle\Entity\UserProject;
//use AppBundle\Entity\UserProjectPermission;
//use AppBundle\Entity\UserRole;
//use AppBundle\Form\ChooseUserForm;
//use AppBundle\Form\ProjectResultsForm;
//use AppBundle\Form\UserForm\UserPermissionForm;
//use AppBundle\Repository\RolesRepository;
//use AppBundle\Repository\UserInstitutionRepository;
//use AppBundle\Repository\UserProjectRepository;
//use AppBundle\Repository\UserRepository;
//use AppBundle\Repository\UserRoleRepository;
//use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Component\HttpFoundation\Request;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use AppBundle\Repository\ProjectRepository;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
//
//class UserPermissionController extends AbstractController
//{
//    /**
//     * @Route("/{locale}/admin/user-permission/choose-user", name="choose_user", requirements={"locale": "%app.locales%"})
//     */
//    public function chooseUserAction(Request $request)
//    {
//        $chooseUserForm = $this->createForm(ChooseUserForm::class, null, [
//            'action' => $this->generateUrl('choose_user'),
//            'method' => 'POST',
//            'locale' => $request->getLocale(),
//        ]);
//
//        $chooseUserForm->handleRequest($request);
//
//        if ($chooseUserForm->isSubmitted() && $chooseUserForm->isValid())
//        {
//            $data = $chooseUserForm->getData();
//
//            $user = $data['user'];
//
//            return $this->redirectToRoute('permission_edit', ['userId' => $user->getId()]);
//        }
//
//        $data = [
//            'my_form' => $chooseUserForm->createView()
//        ];
//
//        return $this->render('user-permission/choose-user.twig', $data);
//    }
//
//    /**
//     * @Route("/{locale}/admin/user-permission/edit/{userId}", name="permission_edit", requirements={"userId": "\d+", "locale": "%app.locales%"})
//     *
//     */
//    public function editAction(Request $request, $userId)
//    {
//        $user = $this->getUserRepository()->findOneBy(['id' => $userId]);
//
//        $userPermissions = $this->getUserRoleRepository()->findBy(['user' => $user, 'isActive' => 1]);
//
//        $projectPermissions = $this->getUserProjectRepository()->findBy(['user' => $user, 'isActive' => 1]);
//
//        $institutionPermissions = $this->getUserInstitutionRepository()->findBy(['user' => $user, 'isActive' => 1]);
//
//        $create = $edit = $delete = $view = $projectCreate = $projectViewAll = $projectEditAll = $projectDeleteAll =
//            $institutionCreate = $institutionViewAll = $institutionEditAll = $institutionDeleteAll = false;
//
//        $permissionArray = [];
//
//        /** @var UserRole $permission */
//        foreach ($userPermissions as $permission) {
//            switch ($permission->getRole()->getName()) {
//                case 'ROLE_USER_CREATE':
//                    {
//                        $permissionArray[] = 'ROLE_USER_CREATE';
//                        $create = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_EDIT':
//                    {
//                        $permissionArray[] = 'ROLE_USER_EDIT';
//                        $edit = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_DELETE':
//                    {
//                        $permissionArray[] = 'ROLE_USER_DELETE';
//                        $delete = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_VIEW':
//                    {
//                        $permissionArray[] = 'ROLE_USER_VIEW';
//                        $view = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_PROJECT_CREATE':
//                    {
//                        $permissionArray[] = 'ROLE_USER_PROJECT_CREATE';
//                        $projectCreate = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_PROJECT_VIEW_ALL':
//                    {
//                        $permissionArray[] = 'ROLE_USER_PROJECT_VIEW_ALL';
//                        $projectViewAll = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_PROJECT_EDIT_ALL':
//                    {
//                        $permissionArray[] = 'ROLE_USER_PROJECT_EDIT_ALL';
//                        $projectEditAll = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_PROJECT_DELETE_ALL':
//                    {
//                        $permissionArray[] = 'ROLE_USER_PROJECT_DELETE_ALL';
//                        $projectDeleteAll = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_INSTITUTION_CREATE':
//                    {
//                        $permissionArray[] = 'ROLE_USER_INSTITUTION_CREATE';
//                        $institutionCreate = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_INSTITUTION_VIEW_ALL':
//                    {
//                        $permissionArray[] = 'ROLE_USER_INSTITUTION_VIEW_ALL';
//                        $institutionViewAll = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_INSTITUTION_EDIT_ALL':
//                    {
//                        $permissionArray[] = 'ROLE_USER_INSTITUTION_EDIT_ALL';
//                        $institutionEditAll = 'checked';
//                        break;
//                    }
//                case 'ROLE_USER_INSTITUTION_DELETE_ALL':
//                    {
//                        $permissionArray[] = 'ROLE_USER_INSTITUTION_DELETE_ALL';
//                        $institutionDeleteAll = 'checked';
//                        break;
//                    }
//                default: break;
//            }
//        }
//
//        $userPermissionForm = $this->createForm(UserPermissionForm::class, null, [
//            'action' => $this->generateUrl('permission_edit', ['userId' => $user->getId()]),
//            'method' => 'POST',
//            'locale' => $request->getLocale(),
//            'create' => $create,
//            'edit' => $edit,
//            'delete' => $delete,
//            'view' => $view,
//            'projectCreate' => $projectCreate,
//            'projectViewAll' => $projectViewAll,
//            'projectEditAll' => $projectEditAll,
//            'projectDeleteAll' => $projectDeleteAll,
//            'institutionCreate' => $institutionCreate,
//            'institutionViewAll' => $institutionViewAll,
//            'institutionEditAll' => $institutionEditAll,
//            'institutionDeleteAll' => $institutionDeleteAll,
//        ]);
//
//        $userPermissionForm->get('existingProjectPermission')->setData($projectPermissions);
//        $userPermissionForm->get('existingInstitutionPermission')->setData($institutionPermissions);
//
//        $userPermissionForm->handleRequest($request);
//
//        if ($userPermissionForm->isSubmitted() && $userPermissionForm->isValid()) {
//
//            $formData = $userPermissionForm->getData();
//            $postPermissionArray = [];
//            $postProjectPermissions = [];
//            $postInstitutionPermissions = [];
//
//            foreach ($formData as $key => $value) {
//                if ($value){
//                    switch ($key) {
//                        case 'create':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_CREATE';
//                                break;
//                            }
//                        case 'edit':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_EDIT';
//                                break;
//                            }
//                        case 'delete':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_DELETE';
//                                break;
//                            }
//                        case 'view':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_VIEW';
//                                break;
//                            }
//                        case 'projectCreate':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_PROJECT_CREATE';
//                                break;
//                            }
//                        case 'projectViewAll':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_PROJECT_VIEW_ALL';
//                                break;
//                            }
//                        case 'projectEditAll':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_PROJECT_EDIT_ALL';
//                                break;
//                            }
//                        case 'projectDeleteAll':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_PROJECT_DELETE_ALL';
//                                break;
//                            }
//                        case 'institutionCreate':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_INSTITUTION_CREATE';
//                                break;
//                            }
//                        case 'institutionViewAll':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_INSTITUTION_VIEW_ALL';
//                                break;
//                            }
//                        case 'institutionEditAll':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_INSTITUTION_EDIT_ALL';
//                                break;
//                            }
//                        case 'institutionDeleteAll':
//                            {
//                                $postPermissionArray[] = 'ROLE_USER_INSTITUTION_DELETE_ALL';
//                                break;
//                            }
//                        case 'existingProjectPermission':
//                            {
//                                $postProjectPermissions = $value;
//                            }
//                        case 'existingInstitutionPermission':
//                            {
//                                $postInstitutionPermissions = $value;
//                            }
//                        default: break;
//                    }
//                }
//            }
//
//            $newPermissions = array_diff($postPermissionArray, $permissionArray);
//            foreach ($newPermissions as $newPermission) {
//                $role = $this->getRolesRepository()->findOneBy(['name' => $newPermission]);
//                $userRole = new UserRole();
//                $userRole->setUser($user);
//                $userRole->setRole($role);
//                $userRole->setIsActive(1);
//                $this->getUserRoleRepository()->save($userRole);
//
//            }
//
//            $permissionsForRemoval = array_diff($permissionArray, $postPermissionArray);
//            foreach ($permissionsForRemoval as $permissionForRemoval) {
//                $role = $this->getRolesRepository()->findOneBy(['name' => $permissionForRemoval]);
//
//                $userRole = $this->getUserRoleRepository()->findOneBy(['user' => $user, 'isActive' => 1, 'role' => $role]);
//                $em = $this->getDoctrine()->getManager();
//                $em->remove($userRole);
//                $em->flush();
//            }
//
//            $newPermissions = array_diff($postProjectPermissions, $projectPermissions);
//
////            /** @var UserProject $postProjectPermission */
////            foreach ($postProjectPermissions as $postProjectPermission) {
////
////            }
////
////            foreach ($postInstitutionPermissions as $postInstitutionPermission) {
////
////            }
//
//            return $this->redirectToRoute('permission_edit', ['userId' => $user->getId()]);
//
//        }
//
//        return $this->render('user-permission/edit.twig', ['my_form' => $userPermissionForm->createView(), 'user' => $user]);
//    }
//
//    private function getUserPermissionRepository()
//    {
//        return $this->get('doctrine_entity_repository.user_permission');
//    }
//
//    private function getExistingProjectPermissionRepository()
//    {
//        return $this->get('doctrine_entity_repository.existing_project_permission');
//    }
//
//    private function getExistingInstitutionPermissionRepository()
//    {
//        return $this->get('doctrine_entity_repository.existing_institution_permission');
//    }
//
//    /**
//     * @return UserRepository
//     */
//    private function getUserRepository()
//    {
//        return $this->get('doctrine_entity_repository.user');
//    }
//
//    /**
//     * @return UserRoleRepository
//     */
//    private function getUserRoleRepository()
//    {
//        return $this->get('doctrine_entity_repository.user_role');
//    }
//
//    /**
//     * @return RolesRepository
//     */
//    private function getRolesRepository()
//    {
//        return $this->get('doctrine_entity_repository.roles');
//    }
//
//    /**
//     * @return UserProjectRepository
//     */
//    private function getUserProjectRepository()
//    {
//        return $this->get('doctrine_entity_repository.user_project');
//    }
//
//    /**
//     * @return UserInstitutionRepository
//     */
//    private function getUserInstitutionRepository()
//    {
//        return $this->get('doctrine_entity_repository.user_institution');
//    }
//}