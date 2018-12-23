<?php

namespace AppBundle\Lib\Project\Provider;

use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use AppBundle\Repository\UserProjectRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Lib\Project\Provider\Providers\UserGroupProvider;
use AppBundle\Lib\Project\Provider\Providers\ProviderInterface;
use AppBundle\Lib\Project\Provider\Providers\ProjectAccessProvider;
use AppBundle\Lib\Project\Provider\Providers\ProgramsAccessProvider;

/**
 * Class UserProjectAcl
 *
 * @package AppBundle\Lib\Project\Provider
 */
class UserProjectAcl {

    /** @var ProviderInterface[]  */
    private $providers;

    /** @var ContainerInterface */
    protected $container;

    /**
     * KernelListener constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->providers = $this->getProjectIdProviders();
    }

    /**
     * Check if project is accessible to user
     *
     * @param int $projectId
     * @param User $user
     *
     * @return bool
     */
    public function isAccessible(int $projectId, User $user) {
        $accessibleIds = $this->getAccessibleProjectIds($user);
        $accessible = in_array($projectId, $accessibleIds);
        return $accessible;
    }


    /**
     * Get users accessible project ids
     *
     * @param User $user
     * @return int[]
     */
    public function getAccessibleProjectIds(User $user) {
        if ($this->isGrantedRole(User::ROLE_SUPER_ADMIN)
            || $this->isGrantedRole(User::ROLE_APP_SUPER_ADMIN)
        ) { // all are accessible
            $result = [];
            /** @var Project[] $projects */
            $projects = $this->getProjectRepository()->findAll();
            foreach ($projects as $project) {
                $result[] = $project->getID();
            }
        } else { // check accessibility
            $result = $accessibleIds = $inaccessibleIds = [];
            foreach ($this->providers as $provider) {
                $userAccess = $provider->getUserAccessEntity($user);
                foreach ($userAccess->getAccessibleProjectIds() as $accessibleId) {
                    $accessibleIds[] = $accessibleId;
                }
                foreach ($userAccess->getInAccessibleProjectIds() as $inaccessibleId) {
                    $inaccessibleIds[] = $inaccessibleId;
                }
            }
            foreach ($accessibleIds as $accessibleId) {
                if (!in_array($accessibleId, $inaccessibleIds)) {
                    $result[] = $accessibleId;
                }
            }
        }
        return array_unique($result);
    }

    /**
     * @return ProviderInterface[]
     */
    private function getProjectIdProviders() {
        $providers = [];
        $providers[] = new ProjectAccessProvider($this->container);
        $providers[] = new ProgramsAccessProvider($this->container);
        $providers[] = new UserGroupProvider($this->container);
        return $providers;
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    private function isGrantedRole(string $role) {
        return $this->container->get('security.authorization_checker')->isGranted($role);
    }

    /**
     * @return UserProjectRepository
     */
    private function getProjectRepository() {
        /** @var UserProjectRepository $repo */
        $repo = $this->container->get('doctrine_entity_repository.project');
        return $repo;
    }

}