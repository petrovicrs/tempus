<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 30.08.17
 * Time: 23:49
 */

namespace AppBundle\Repository;


use AppBundle\Entity\UserProject;

class UserProjectRepository extends AbstractRepository
{
    public function isUserProject($project, $user)
    {
        $userProjects = $this->findBy(['user' => $user, 'isActive' => 1]);

        /** @var UserProject $userProject */
        foreach ($userProjects as $userProject) {
            if ($userProject->getProject()->getId() === $project->getId()) {
                return true;
            }
        }

        return false;
    }
}