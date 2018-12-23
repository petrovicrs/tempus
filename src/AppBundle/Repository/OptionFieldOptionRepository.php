<?php

namespace AppBundle\Repository;

/**
 * Class OptionFieldOptionRepository
 *
 * @package AppBundle\Repository
 */
class OptionFieldOptionRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $optionFieldOption
     *
     */
    public function save($optionFieldOption) {
        $this->_em->persist($optionFieldOption);
        $this->_em->flush();
    }

}