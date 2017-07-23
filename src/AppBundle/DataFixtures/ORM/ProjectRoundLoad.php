<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:46 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectRound;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectRoundLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new ProjectRound();
        $object->setNameEn('Test project round 1');
        $object->setNameSr('Тест project round 1');
        $manager->persist($object);

        $object = new ProjectRound();
        $object->setNameEn('Test project round 2');
        $object->setNameSr('Тест project round 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}