<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:15
 */

namespace AppBundle\Repository;

/**
 * Class ReportingRepository
 * @package AppBundle\Repository
 */
class ReportingRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($reporting) {

        $this->_em->persist($reporting);
        $this->_em->flush();
    }
}