<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/10/17
 * Time: 9:32 PM
 */
namespace AppBundle\Repository;

/**
 * ContactTypeRepository
 */
class ContactTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}