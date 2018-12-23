<?php

namespace AppBundle\Repository;

/**
 * Class OptionFieldRepository
 *
 * @package AppBundle\Repository
 */
class OptionFieldRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $optionField
     *
     */
    public function save($optionField) {
        $this->_em->persist($optionField);
        $this->_em->flush();
    }

}