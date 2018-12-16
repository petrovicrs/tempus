<?php

namespace AppBundle\Repository;

/**
 * @TODO remove => unused
 *
 * Class UserProjectPermissionRepository
 *
 * @package AppBundle\Repository
 */
class UserProjectPermissionRepository extends AbstractRepository {

    /**
     * @param $permission
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($permission) {
        $this->_em->persist($permission);
        $this->_em->flush();
    }
}