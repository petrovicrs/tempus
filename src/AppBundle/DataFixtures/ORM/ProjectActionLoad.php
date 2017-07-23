<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:43 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectAction;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectActionLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new ProjectAction();
        $object->setNameEn('Test project action 1');
        $object->setNameSr('Тест акција 1');
        $manager->persist($object);

        $object = new ProjectAction();
        $object->setNameEn('Test project action 2');
        $object->setNameSr('Тест акција 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }

}