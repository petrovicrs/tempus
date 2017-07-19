<?php

namespace AppBundle\Repository;

/**
 * Class PersonNoteTypeRepository
 * @package AppBundle\Repository
 */
class PersonNoteTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
