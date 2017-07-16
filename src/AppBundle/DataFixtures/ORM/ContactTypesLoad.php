<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ContactType;

class ContactTypesLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $contactType = new ContactType();
        $contactType->setTypeEn('Phone');
        $contactType->setTypeSr('Телефон');
        $manager->persist($contactType);

        $contactType = new ContactType();
        $contactType->setTypeEn('Mobile');
        $contactType->setTypeSr('Мобилни телефон');
        $manager->persist($contactType);

        $contactType = new ContactType();
        $contactType->setTypeEn('Fax');
        $contactType->setTypeSr('Факс');
        $manager->persist($contactType);

        $contactType = new ContactType();
        $contactType->setTypeEn('E-mail');
        $contactType->setTypeSr('Е-пошта');
        $manager->persist($contactType);

        $contactType = new ContactType();
        $contactType->setTypeEn('Web page');
        $contactType->setTypeSr('Интернет страница');
        $manager->persist($contactType);

        $contactType = new ContactType();
        $contactType->setTypeEn('Facebook');
        $contactType->setTypeSr('');
        $manager->persist($contactType);

        // the queries aren't done until now
        $manager->flush();
    }
}