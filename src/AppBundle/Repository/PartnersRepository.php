<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 15:50
 */

namespace AppBundle\Repository;

/**
 * Class PartnersRepository
 */
class PartnersRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($c) {
        $this->_em->persist($c);
        $this->_em->flush();
    }
}