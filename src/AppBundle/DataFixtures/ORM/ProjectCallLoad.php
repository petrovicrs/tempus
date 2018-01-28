<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:45 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectCall;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectCallLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new ProjectCall();
        $object->setNameEn('Test project call 1');
        $object->setNameSr('Тест project call 1');
        $manager->persist($object);

        $object = new ProjectCall();
        $object->setNameEn('Test project call 2');
        $object->setNameSr('Тест project call 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}