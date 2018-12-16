<?php

namespace AppBundle\Repository;

/**
 * Class UserRepository
 *
 * @package AppBundle\Repository
 */
class UserProjectAccessRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $projectAccess
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($projectAccess) {
        $this->_em->persist($projectAccess);
        $this->_em->flush();
    }

}