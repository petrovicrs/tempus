<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 02.09.17
 * Time: 17:34
 */

namespace AppBundle\Repository;


class EventReminderRepository extends AbstractRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}