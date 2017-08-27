<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 15:50
 */

namespace AppBundle\Repository;

/**
 * Class MonitoringReportingRepository
 */
class MonitoringReportingRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($mp) {
        $this->_em->persist($mp);
        $this->_em->flush();
    }
}