<?php

namespace AppBundle\Lib\Project\Provider\Providers;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\User;
use AppBundle\Entity\UserProgramAccess;
use AppBundle\Lib\Project\Provider\Entity\UserAccessEntity;
use AppBundle\Repository\ProjectProgrammeRepository;
use AppBundle\Repository\UserProgramAccessRepository;

/**
 * Class ProgramsAccessProvider
 *
 * @package AppBundle\Lib\Project\Provider\Providers
 */
class ProgramsAccessProvider extends AbstractProvider {

    /**
     * Get user project accessibility entity
     *
     * @param User $user
     *
     * @return UserAccessEntity
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserAccessEntity(User $user) {
        $entity = new UserAccessEntity();
        /** @var UserProgramAccess[] $programs */
        $programs = $this->getUserProgramAccessRepository()
            ->createQueryBuilder('p')
            ->where('p.user = :userId')
            ->getQuery()->execute([':userId' => $user->getId()]);
        foreach ($programs as $programAccess) {
            /** @var ProjectProgramme $program */
            $program = $programAccess->getProgram();
            if ($program) {
                $projectIds = [];
                $this->fetchProgramProjectIds($program, $projectIds);
                if ($programAccess->getHasAccess()) {
                    $entity->addAccessibleProjectIds($projectIds);
                } else {
                    $entity->addInAccessibleProjectIds($projectIds);
                }
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
    
    /**
     * @return ProjectProgrammeRepository
     */
    private function getProgramRepository() {
        /** @var ProjectProgrammeRepository $repo */
        $repo = $this->get('doctrine_entity_repository.project_programs');
        return $repo;
    }

    /**
     * @return UserProgramAccessRepository
     */
    private function getUserProgramAccessRepository() {
        /** @var UserProgramAccessRepository $repo */
        $repo = $this->get('doctrine_entity_repository.user_program_access');
        return $repo;
    }

}