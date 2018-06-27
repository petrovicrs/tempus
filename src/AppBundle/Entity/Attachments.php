<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 30.08.17
 * Time: 23:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttachmentsRepository")
 * @ORM\Table(name="attachments")
 * @ORM\HasLifecycleCallbacks
 */
class Attachments extends AbstractAuditable
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @ORM\OneToMany(targetEntity="AttachmentsDmsDocuments", mappedBy="attachments", cascade={"persist", "merge"})
     */
    protected $dmsDocuments;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $dmsNotes;

    /**
     * @ORM\OneToMany(targetEntity="AttachmentsManuallyUploaded", mappedBy="attachments", cascade={"persist"})
     */
    protected $manuallyUploadedFiles;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $uploadedFilesNotes;

    public function __construct()
    {
        parent::__construct();

        $this->dmsDocuments = new ArrayCollection();
        $this->manuallyUploadedFiles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getDmsDocuments()
    {
        return $this->dmsDocuments;
    }

    /**
     * @param mixed $dmsDocuments
     */
    public function setDmsDocuments($dmsDocuments)
    {
        $this->dmsDocuments = $dmsDocuments;
    }

    /**
     * @param AttachmentsDmsDocuments $dmsDocument
     */
    public function addDmsDocuments(AttachmentsDmsDocuments $dmsDocument)
    {
        $this->dmsDocuments->add($dmsDocument);
    }

    /**
     * @param AttachmentsDmsDocuments $dmsDocument
     */
    public function removeDmsDocuments(AttachmentsDmsDocuments $dmsDocument)
    {
        $this->dmsDocuments->remove($dmsDocument);
    }

    /**
     * @return mixed
     */
    public function getDmsNotes()
    {
        return $this->dmsNotes;
    }

    /**
     * @param mixed $dmsNotes
     */
    public function setDmsNotes($dmsNotes)
    {
        $this->dmsNotes = $dmsNotes;
    }

    /**
     * @return mixed
     */
    public function getManuallyUploadedFiles()
    {
        return $this->manuallyUploadedFiles;
    }

    /**
     * @param $manuallyUploadedFiles
     * @return $this
     */
    public function setManuallyUploadedFiles($manuallyUploadedFiles)
    {
        $this->manuallyUploadedFiles = $manuallyUploadedFiles;
    }

    /**
     * @return mixed
     */
    public function getUploadedFilesNotes()
    {
        return $this->uploadedFilesNotes;
    }

    /**
     * @param mixed $uploadedFilesNotes
     */
    public function setUploadedFilesNotes($uploadedFilesNotes)
    {
        $this->uploadedFilesNotes = $uploadedFilesNotes;
    }
}