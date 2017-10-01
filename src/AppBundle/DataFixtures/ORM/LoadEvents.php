<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\InstitutionFounderType;
use AppBundle\Entity\InstitutionType;
use AppBundle\Entity\InstitutionLevel;

class LoadEvents implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setName('Pera');
        $user1->setSurname('Peric');
        $user1->setEmail('user@email.com');
        $user1->setPlainPassword('user');
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setName('Mika');
        $user2->setSurname('Mikic');
        $user2->setEmail('admin@email.com');
        $user2->setPlainPassword('admin');
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $founderType1 = new InstitutionFounderType();
        $founderType1->setNameEn('State');
        $founderType1->setNameSr('Drzavni');
        $manager->persist($founderType1);

        $founderType2 = new InstitutionFounderType();
        $founderType2->setNameEn('Private');
        $founderType2->setNameSr('Privatni');
        $manager->persist($founderType2);

        $InstitutionType1 = new InstitutionType();
        $InstitutionType1->setNameEn('Faculty');
        $InstitutionType1->setNameSr('Fakultet');
        $manager->persist($InstitutionType1);

        $InstitutionType2 = new InstitutionType();
        $InstitutionType2->setNameEn('Primary School');
        $InstitutionType2->setNameSr('Osnovna Skola');
        $manager->persist($InstitutionType2);

        $institutionLevel1 = new InstitutionLevel();
        $institutionLevel1->setNameEn('Unit');
        $institutionLevel1->setNameSr('Odsek');
        $manager->persist($institutionLevel1);

        $institutionLevel2 = new InstitutionLevel();
        $institutionLevel2->setNameEn('Department');
        $institutionLevel2->setNameSr('Odeljenje');
        $manager->persist($institutionLevel2);

        // the queries aren't done until now
        $manager->flush();
    }
}