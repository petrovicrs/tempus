<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:51 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectTopicType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectTopicTypeLoad implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $object = new ProjectTopicType();
        $object->setNameEn('Test project topic type 1');
        $object->setNameSr('Тест project topic type 1');
        $manager->persist($object);

        $object = new ProjectTopicType();
        $object->setNameEn('Test project topic type 2');
        $object->setNameSr('Тест project topic type 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}
