<?php

namespace AppBundle\Repository;

/**
 * Class UserGroupRepository
 *
 * @package AppBundle\Repository
 */
class UserGroupRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $group
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($group) {
        $this->_em->persist($group);
        $this->_em->flush();
    }

}