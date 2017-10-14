<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExistingProjectPermissionRepository")
 * @ORM\Table(name="existing_project_permission")
 */
class ExistingProjectPermission extends AbstractAuditable
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
     */
    protected $user;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Project"
     * )
     */
    protected $project;

    /**
     * @ORM\Column(name="existing_project_view", type="boolean", nullable=true)
     */
    protected $existingProjectView;

    /**
     * @ORM\Column(name="existing_project_edit", type="boolean", nullable=true)
     */
    protected $existingProjectEdit;

    /**
     * @ORM\Column(name="existing_project_delete", type="boolean", nullable=true)
     */
    protected $existingProjectDelete;

    /**
     * @ORM\Column(name="existing_project_export", type="boolean", nullable=true)
     */
    protected $existingProjectExport;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="UserPermission",
     *      inversedBy="existingProjectPermission"
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
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getExistingProjectView()
    {
        return $this->existingProjectView;
    }

    /**
     * @param mixed $existingProjectView
     */
    public function setExistingProjectView($existingProjectView)
    {
        $this->existingProjectView = $existingProjectView;
    }

    /**
     * @return mixed
     */
    public function getExistingProjectEdit()
    {
        return $this->existingProjectEdit;
    }

    /**
     * @param mixed $existingProjectEdit
     */
    public function setExistingProjectEdit($existingProjectEdit)
    {
        $this->existingProjectEdit = $existingProjectEdit;
    }

    /**
     * @return mixed
     */
    public function getExistingProjectDelete()
    {
        return $this->existingProjectDelete;
    }

    /**
     * @param mixed $existingProjectDelete
     */
    public function setExistingProjectDelete($existingProjectDelete)
    {
        $this->existingProjectDelete = $existingProjectDelete;
    }

    /**
     * @return mixed
     */
    public function getExistingProjectExport()
    {
        return $this->existingProjectExport;
    }

    /**
     * @param mixed $existingProjectExport
     */
    public function setExistingProjectExport($existingProjectExport)
    {
        $this->existingProjectExport = $existingProjectExport;
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

