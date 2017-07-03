<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadEvents implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('user@email.com');
        $user1->setPlainPassword('user');
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('admin@email.com');
        $user2->setPlainPassword('admin');
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        // the queries aren't done until now
        $manager->flush();
    }
}