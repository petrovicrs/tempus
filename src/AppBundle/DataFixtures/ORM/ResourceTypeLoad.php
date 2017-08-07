<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 22:55
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ResourceType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ResourceTypeLoad implements FixtureInterface
{
    private $types = ['Promotion Material', 'Book'];
    private $types_sr = ['Promotivni materijal', 'Knjiga'];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->types); $i++) {

            $reourceType = new ResourceType();

            $reourceType->setNameEn($this->types[$i]);
            $reourceType->setNameSr($this->types_sr[$i]);

            $manager->persist($reourceType);
        }

        $manager->flush();
    }
}