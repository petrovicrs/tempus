<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @TODO remove -> unused
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExistingInstitutionPermissionRepository")
 * @ORM\Table(name="existing_institution_permission")
 */
class ExistingInstitutionPermission extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Institution"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;

    /**
     * @ORM\Column(name="existing_institution_view", type="boolean", nullable=true)
     */
    protected $existingInstitutionView;

    /**
     * @ORM\Column(name="existing_institution_edit", type="boolean", nullable=true)
     */
    protected $existingInstitutionEdit;

    /**
     * @ORM\Column(name="existing_institution_delete", type="boolean", nullable=true)
     */
    protected $existingInstitutionDelete;

    /**
     * @ORM\Column(name="existing_institution_export", type="boolean", nullable=true)
     */
    protected $existingInstitutionExport;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="UserPermission",
     *      inversedBy="existingInstitutionPermission"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $permission;

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
    public function setInstitution($institution)
    {
        $this->institution = $institution;
    }

    /**
     * @return mixed
     */
    public function getExistingInstitutionView()
    {
        return $this->existingInstitutionView;
    }

    /**
     * @param mixed $existingInstitutionView
     */
    public function setExistingInstitutionView($existingInstitutionView)
    {
        $this->existingInstitutionView = $existingInstitutionView;
    }

    /**
     * @return mixed
     */
    public function getExistingInstitutionEdit()
    {
        return $this->existingInstitutionEdit;
    }

    /**
     * @param mixed $existingInstitutionEdit
     */
    public function setExistingInstitutionEdit($existingInstitutionEdit)
    {
        $this->existingInstitutionEdit = $existingInstitutionEdit;
    }

    /**
     * @return mixed
     */
    public function getExistingInstitutionDelete()
    {
        return $this->existingInstitutionDelete;
    }

    /**
     * @param mixed $existingInstitutionDelete
     */
    public function setExistingInstitutionDelete($existingInstitutionDelete)
    {
        $this->existingInstitutionDelete = $existingInstitutionDelete;
    }

    /**
     * @return mixed
     */
    public function getExistingInstitutionExport()
    {
        return $this->existingInstitutionExport;
    }

    /**
     * @param mixed $existingInstitutionExport
     */
    public function setExistingInstitutionExport($existingInstitutionExport)
    {
        $this->existingInstitutionExport = $existingInstitutionExport;
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
    }

}

