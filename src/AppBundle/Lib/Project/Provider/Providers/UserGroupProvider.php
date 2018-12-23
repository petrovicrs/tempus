<?php

namespace AppBundle\Lib\Project\Provider\Providers;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\User;
use AppBundle\Repository\UserGroupRepository;
use AppBundle\Lib\Project\Provider\Entity\UserAccessEntity;

/**
 * Class UserGroupProvider
 *
 * @package AppBundle\Lib\Project\Provider\Providers
 */
class UserGroupProvider extends AbstractProvider {

    /**
     * Get user project accessibility entity
     *
     * @param User $user
     *
     * @return UserAccessEntity
     */
    public function getUserAccessEntity(User $user) {
        $entity = new UserAccessEntity();
        $userGroup = $user->getUserGroup();
        if ($userGroup) {
            $program = $userGroup->getProgram();
            if ($program) {
                $projectIds = [];
                $this->fetchProgramProjectIds($program, $projectIds);
                $entity->addAccessibleProjectIds($projectIds);
            }
        }
        return $entity;
    }

    /**
     * @param ProjectProgramme $program
     * @param array $projectIds
     */
    private function fetchProgramProjectIds(ProjectProgramme $program, array &$projectIds) {
        $this->getProgramProjectIds($program, $projectIds);
        foreach ($program->getChildren() as $child) {
            $this->fetchProgramProjectIds($child, $projectIds);
        }
    }

    private function getProgramProjectIds(ProjectProgramme $program, array &$projectIds) {
        /** @var Project[] $projects */
        $projects = $this->getDoctrine()->getRepository(Project::class)->findBy(['programmes' => $program->getId()]);
        foreach ($projects as $project) {
            $projectIds[] = $project->getId();
        }
    }
}