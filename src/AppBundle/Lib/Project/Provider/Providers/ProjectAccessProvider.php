<?php

namespace AppBundle\Lib\Project\Provider\Providers;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProjectAccess;
use AppBundle\Repository\UserProjectAccessRepository;
use AppBundle\Lib\Project\Provider\Entity\UserAccessEntity;

/**
 * Class ProjectAccessProvider
 *
 * @package AppBundle\Lib\Project\Provider\Providers
 */
class ProjectAccessProvider extends AbstractProvider {

    /**
     * Get user project accessibility entity
     *
     * @param User $user
     *
     * @return UserAccessEntity
     */
    public function getUserAccessEntity(User $user) {
        $entity = new UserAccessEntity();
        /** @var UserProjectAccess[] $projects */
        $projects = $this->getUserProjectRepository()
            ->createQueryBuilder('p')
            ->where('p.user = :userId')
            ->getQuery()->execute([':userId' => $user->getId()]);
        foreach ($projects as $user2projectAccess) {
            $projectId = $user2projectAccess->getProject()->getID();
            if ($user2projectAccess->getHasAccess()) {
                $entity->addAccessibleProjectId($projectId);
            } else {
                $entity->addInAccessibleProjectId($projectId);
            }
        }
        return $entity;
    }

    /**
     * @return UserProjectAccessRepository
     */
    private function getUserProjectRepository() {
        /** @var UserProjectAccessRepository $repo */
        $repo = $this->get('doctrine_entity_repository.user_project_access');
        return $repo;
    }

}