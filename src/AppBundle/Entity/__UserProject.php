<?php
//namespace AppBundle\Entity;
//
//use Symfony\Component\Security\Core\Role\Role;
//use Symfony\Component\Security\Core\User\UserInterface;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity(repositoryClass="AppBundle\Repository\UserProjectRepository")
// * @ORM\Table(name="user_projects")
// */
//class UserProject extends AbstractAuditable
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
//     *      targetEntity="User"
//     * )
//     * @ORM\JoinColumn(onDelete="CASCADE")
//     */
//    private $user;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="Project"
//     * )
//     * @ORM\JoinColumn(onDelete="CASCADE")
//     */
//    private $project;
//
//    /**
//     * @ORM\Column(name="isActive", type="boolean", nullable=true)
//     */
//    private $isActive;
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
//     * @ORM\Column(name="project_view", type="boolean")
//     */
//    protected $projectView;
//
//    /**
//     * @ORM\Column(name="project_edit", type="boolean")
//     */
//    protected $projectEdit;
//
//    /**
//     * @ORM\Column(name="project_delete", type="boolean")
//     */
//    protected $projectDelete;
//
//    /**
//     * @ORM\Column(name="project_export", type="boolean")
//     */
//    protected $projectExport;
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
//    public function getProject()
//    {
//        return $this->project;
//    }
//
//    /**
//     * @param mixed $project
//     */
//    public function setProject($project)
//    {
//        $this->project = $project;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getIsActive()
//    {
//        return $this->isActive;
//    }
//    /**
//     * @param mixed $isActive
//     */
//    public function setIsActive($isActive)
//    {
//        $this->isActive = $isActive;
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
//    public function getProjectView()
//    {
//        return $this->projectView;
//    }
//
//    /**
//     * @param mixed $projectView
//     */
//    public function setProjectView($projectView)
//    {
//        $this->projectView = $projectView;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getProjectEdit()
//    {
//        return $this->projectEdit;
//    }
//
//    /**
//     * @param mixed $projectEdit
//     */
//    public function setProjectEdit($projectEdit)
//    {
//        $this->projectEdit = $projectEdit;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getProjectDelete()
//    {
//        return $this->projectDelete;
//    }
//
//    /**
//     * @param mixed $projectDelete
//     */
//    public function setProjectDelete($projectDelete)
//    {
//        $this->projectDelete = $projectDelete;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getProjectExport()
//    {
//        return $this->projectExport;
//    }
//
//    /**
//     * @param mixed $projectExport
//     */
//    public function setProjectExport($projectExport)
//    {
//        $this->projectExport = $projectExport;
//    }
//
//}