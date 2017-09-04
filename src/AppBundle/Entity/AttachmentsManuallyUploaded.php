<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 30.08.17
 * Time: 23:28
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttachmentsManuallyUploadedRepository")
 * @ORM\Table(name="attachments_manually_uploaded")
 */
class AttachmentsManuallyUploaded
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="file", type="string", length=255, unique=true)
     *
     * @Assert\File(
     *      maxSize = "10M",
     *      mimeTypes = {"image/jpeg", "application/octet-stream"},
     *      maxSizeMessage = "The maxmimum allowed file size is 5MB."
     * )
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="Attachments", inversedBy="manuallyUploadedFiles")
     */
    protected $attachments;

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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param mixed $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }
}