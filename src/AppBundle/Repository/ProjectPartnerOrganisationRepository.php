<?php

namespace AppBundle\Repository;

/**
 * Class ProjectPartnerOrganisationRepository
 * @package AppBundle\Repository
 */
class ProjectPartnerOrganisationRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
