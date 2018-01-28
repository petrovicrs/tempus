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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserInstitutionPermissionRepository")
 * @ORM\Table(name="user_institution_permissions")
 */
class UserInstitutionPermission extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\OneToMany(targetEntity="UserPermission", mappedBy="userInstitutionPermission", cascade={"persist"})
     */
    protected $institutionPermission;

    public function __construct()
    {
        parent::__construct();
        $this->institutionPermission = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getInstitutionPermission()
    {
        return $this->institutionPermission;
    }

    /**
     * @param mixed $institutionPermission
     */
    public function setInstitutionPermission($institutionPermission)
    {
        $this->institutionPermission = $institutionPermission;
    }

}