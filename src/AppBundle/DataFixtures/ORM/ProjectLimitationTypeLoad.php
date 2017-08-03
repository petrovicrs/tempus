<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:49 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectLimitationType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectLimitationTypeLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object = new ProjectLimitationType();
        $object->setNameEn('Test project limitation type 1');
        $object->setNameSr('Тест project limitation type 1');
        $manager->persist($object);

        $object = new ProjectLimitationType();
        $object->setNameEn('Test project limitation type 2');
        $object->setNameSr('Тест project limitation type 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}