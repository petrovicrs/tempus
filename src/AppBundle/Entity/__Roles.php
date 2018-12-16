<?php
//namespace AppBundle\Entity;
//
//use Symfony\Component\Security\Core\Role\Role;
//use Symfony\Component\Security\Core\User\UserInterface;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity(repositoryClass="AppBundle\Repository\RolesRepository")
// * @ORM\Table(name="roles")
// */
//class Roles extends AbstractAuditable
//{
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     * @ORM\Column(type="integer")
//     */
//    private $id;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $name;
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name)
//    {
//        $this->name = $name;
//    }
//
//}