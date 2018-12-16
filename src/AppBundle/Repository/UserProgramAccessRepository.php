<?php

namespace AppBundle\Repository;

/**
 * Class UserProgramAccessRepository
 *
 * @package AppBundle\Repository
 */
class UserProgramAccessRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $programAccess
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($programAccess) {
        $this->_em->persist($programAccess);
        $this->_em->flush();
    }

}