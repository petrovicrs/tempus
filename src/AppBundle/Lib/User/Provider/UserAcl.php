<?php

namespace AppBundle\Lib\User\Provider;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleHierarchy;

/**
 * Class UserAcl
 *
 * @package AppBundle\Lib\User\Provider
 */
class UserAcl {

    /** @var ContainerInterface */
    protected $container;

    /**
     * KernelListener constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * Check if project is accessible to user
     *
     * @param int $userId
     * @param User $user
     *
     * @return bool
     */
    public function isAccessible(int $userId, User $user) {
        $accessibleIds = $this->getAccessibleUserIds($user);
        $accessible = in_array($userId, $accessibleIds);
        return $accessible;
    }

    /**
     * Get users accessible user ids
     *
     * @param User $user
     * @return int[]
     */
    public function getAccessibleUserIds(User $user) {
        $roleHierarchy = $this->getRoleHierarchy();
        /** @var Role[] $reachableRoles */
        $reachableRoles = $roleHierarchy->getReachableRoles([new Role($user->getRole())]);
        $roleIds = [];
        foreach ($reachableRoles as $role) {
            $roleIds[] = $role->getRole();
        }
        $userIds = [];
        $queryBuilder = $this->getUserRepository()->createQueryBuilder('u');
        $queryBuilder->where($queryBuilder->expr()->in('u.role', $roleIds));
        if (in_array($user->getRole(), [User::ROLE_SUPER_ADMIN, User::ROLE_APP_SUPER_ADMIN])) {
            $queryBuilder->orWhere('u.role IS NULL');
            $queryBuilder->orWhere("u.role = ''");
        }
        /** @var User[] $users */
        $users = $queryBuilder->getQuery()->getResult();
        foreach ($users as $user) {
            $userIds[] = $user->getId();
        }
        return $userIds;
    }

    /**
     * @return RoleHierarchy
     */
    private function getRoleHierarchy() {
        /** @var RoleHierarchy $roleHierarchy */
        $roleHierarchy = $this->container->get('security.role_hierarchy');
        return $roleHierarchy;
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