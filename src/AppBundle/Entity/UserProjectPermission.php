<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 20:42
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserProjectPermissionRepository")
 * @ORM\Table(name="user_project_permissions")
 */
class UserProjectPermission extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="project_view", type="boolean")
     */
    protected $projectView;

    /**
     * @ORM\Column(name="project_edit", type="boolean")
     */
    protected $projectEdit;

    /**
     * @ORM\Column(name="project_delete", type="boolean")
     */
    protected $projectDelete;

    /**
     * @ORM\Column(name="project_export", type="boolean")
     */
    protected $projectExport;

    /**
     * @ORM\OneToMany(targetEntity="UserPermission", mappedBy="userProjectPermission", cascade={"persist"})
     */
    protected $projectPermission;

    public function __construct()
    {
        parent::__construct();
        $this->projectPermission = new ArrayCollection();
    }

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
    public function getProjectView()
    {
        return $this->projectView;
    }

    /**
     * @param mixed $projectView
     */
    public function setProjectView($projectView)
    {
        $this->projectView = $projectView;
    }

    /**
     * @return mixed
     */
    public function getProjectEdit()
    {
        return $this->projectEdit;
    }

    /**
     * @param mixed $projectEdit
     */
    public function setProjectEdit($projectEdit)
    {
        $this->projectEdit = $projectEdit;
    }

    /**
     * @return mixed
     */
    public function getProjectDelete()
    {
        return $this->projectDelete;
    }

    /**
     * @param mixed $projectDelete
     */
    public function setProjectDelete($projectDelete)
    {
        $this->projectDelete = $projectDelete;
    }

    /**
     * @return mixed
     */
    public function getProjectExport()
    {
        return $this->projectExport;
    }

    /**
     * @param mixed $projectExport
     */
    public function setProjectExport($projectExport)
    {
        $this->projectExport = $projectExport;
    }

    /**
     * @return mixed
     */
    public function getProjectPermission()
    {
        return $this->projectPermission;
    }

    /**
     * @param mixed $projectPermission
     */
    public function setProjectPermission($projectPermission)
    {
        $this->projectPermission = $projectPermission;
    }



}