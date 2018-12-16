<?php
//namespace AppBundle\Entity;
//
//use Symfony\Component\Security\Core\Role\Role;
//use Symfony\Component\Security\Core\User\UserInterface;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRoleRepository")
// * @ORM\Table(name="user_roles")
// */
//class UserRole extends AbstractAuditable
//{
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     * @ORM\Column(type="integer")
//     */
//    private $id;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="User",
//     *      inversedBy="roles"
//     * )
//     * @ORM\JoinColumn(onDelete="CASCADE")
//     */
//    private $user;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="Roles"
//     * )
//     * @ORM\JoinColumn(onDelete="CASCADE")
//     */
//    private $role;
//
//    /**
//     * @ORM\Column(name="isActive", type="boolean", nullable=true)
//     */
//    private $isActive;
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
//    public function getUser()
//    {
//        return $this->user;
//    }
//
//    /**
//     * @param mixed $user
//     */
//    public function setUser($user)
//    {
//        $this->user = $user;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getRole()
//    {
//        return $this->role;
//    }
//
//    /**
//     * @param mixed $role
//     */
//    public function setRole($role)
//    {
//        $this->role = $role;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getIsActive()
//    {
//        return $this->isActive;
//    }
//
//    /**
//     * @param mixed $isActive
//     */
//    public function setIsActive($isActive)
//    {
//        $this->isActive = $isActive;
//    }
//
//
//}