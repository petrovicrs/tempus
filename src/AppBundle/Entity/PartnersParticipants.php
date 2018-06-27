<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 29.08.17
 * Time: 23:12
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnersParticipantsRepository")
 * @ORM\Table(name="partners_participants")
 */
class PartnersParticipants
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="PartnersParticipantType")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participantType;

    /**
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participant;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectPartners", inversedBy="participants")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectPartners;

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
    public function getParticipantType()
    {
        return $this->participantType;
    }

    /**
     * @param mixed $participantType
     */
    public function setParticipantType($participantType)
    {
        $this->participantType = $participantType;
    }

    /**
     * @return mixed
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
    }

    /**
     * @return mixed
     */
    public function getProjectPartners()
    {
        return $this->projectPartners;
    }

    /**
     * @param mixed $projectPartners
     */
    public function setProjectPartners($projectPartners)
    {
        $this->projectPartners = $projectPartners;
    }
}