<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 30.08.17
 * Time: 23:49
 */

namespace AppBundle\Repository;


use AppBundle\Entity\UserInstitution;

class UserInstitutionRepository extends AbstractRepository
{
    public function isUserInstitution($institution, $user)
    {
        $userInstitutions = $this->findBy(['user' => $user, 'isActive' => 1]);

        /** @var UserInstitution $userInstitution */
        foreach ($userInstitutions as $userInstitution) {
            if ($userInstitution->getInstitution()->getId() === $institution->getId()) {
                return true;
            }
        }

        return false;
    }
}