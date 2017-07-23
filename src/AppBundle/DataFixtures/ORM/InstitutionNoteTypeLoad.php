<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 4:27 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\InstitutionNoteType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InstitutionNoteTypeLoad implements  FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new InstitutionNoteType();
        $object->setNameEn('Draft');
        $object->setNameSr('Нацрт');
        $manager->persist($object);

        $object = new InstitutionNoteType();
        $object->setNameEn('type 2');
        $object->setNameSr('тип 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}