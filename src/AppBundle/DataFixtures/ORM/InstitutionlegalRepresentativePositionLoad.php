<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 4:32 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\InstitutionLegalRepresentativePosition;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InstitutionlegalRepresentativePositionLoad implements  FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new InstitutionLegalRepresentativePosition();
        $object->setNameEn('type 1');
        $object->setNameSr('тип 1');
        $manager->persist($object);

        $object = new InstitutionLegalRepresentativePosition();
        $object->setNameEn('type 2');
        $object->setNameSr('тип 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}