<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserInstitutionRepository")
 * @ORM\Table(name="user_institutions")
 */
class UserInstitution extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $institution;

    /**
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Roles"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $roles;

    /**
     * @ORM\Column(name="institution_view", type="boolean")
     */
    protected $institutionView;

    /**
     * @ORM\Column(name="institution_edit", type="boolean")
     */
    protected $institutionEdit;

    /**
     * @ORM\Column(name="institution_delete", type="boolean")
     */
    protected $institutionDelete;

    /**
     * @ORM\Column(name="institution_export", type="boolean")
     */
    protected $institutionExport;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * @param mixed $institution
     */
    public function setRole($institution)
    {
        $this->institution = $institution;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getInstitutionView()
    {
        return $this->institutionView;
    }

    /**
     * @param mixed $institutionView
     */
    public function setInstitutionView($institutionView)
    {
        $this->institutionView = $institutionView;
    }

    /**
     * @return mixed
     */
    public function getInstitutionEdit()
    {
        return $this->institutionEdit;
    }

    /**
     * @param mixed $institutionEdit
     */
    public function setInstitutionEdit($institutionEdit)
    {
        $this->institutionEdit = $institutionEdit;
    }

    /**
     * @return mixed
     */
    public function getInstitutionDelete()
    {
        return $this->institutionDelete;
    }

    /**
     * @param mixed $institutionDelete
     */
    public function setInstitutionDelete($institutionDelete)
    {
        $this->institutionDelete = $institutionDelete;
    }

    /**
     * @return mixed
     */
    public function getInstitutionExport()
    {
        return $this->institutionExport;
    }

    /**
     * @param mixed $institutionExport
     */
    public function setInstitutionExport($institutionExport)
    {
        $this->institutionExport = $institutionExport;
    }

}