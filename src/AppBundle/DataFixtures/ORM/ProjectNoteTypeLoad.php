<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:48 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectNoteType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectNoteTypeLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new ProjectNoteType();
        $object->setNameEn('Test project note type 1');
        $object->setNameSr('Тест project note type 1');
        $manager->persist($object);

        $object = new ProjectNoteType();
        $object->setNameEn('Test project note type 2');
        $object->setNameSr('Тест project note type 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}