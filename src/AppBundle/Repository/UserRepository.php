<?php

namespace AppBundle\Repository;

/**
 * Class UserRepository
 *
 * @package AppBundle\Repository
 */
class UserRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $user
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($user) {
        $this->_em->persist($user);
        $this->_em->flush();
    }

}