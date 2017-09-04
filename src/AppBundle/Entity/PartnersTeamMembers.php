<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 28.08.17
 * Time: 23:28
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnersTeamMembersRepository")
 * @ORM\Table(name="partners_team_members")
 */
class PartnersTeamMembers extends AbstractAuditable
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="TeamMemberPositions")
     */
    protected $memberPosition;

    /**
     * @ORM\ManyToOne(targetEntity="Person")
     */
    protected $member;

    /**
     * @ORM\Column(name="budget", type="string", length=64)
     */
    protected $budget;

    /**
     * @ORM\ManyToOne(targetEntity="Partners", inversedBy="teamMembers")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $partners;

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
    public function getMemberPosition()
    {
        return $this->memberPosition;
    }

    /**
     * @param mixed $memberPosition
     */
    public function setMemberPosition($memberPosition)
    {
        $this->memberPosition = $memberPosition;
    }

    /**
     * @return mixed
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param mixed $member
     */
    public function setMember($member)
    {
        $this->member = $member;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * @param mixed $partners
     */
    public function setPartners($partners)
    {
        $this->partners = $partners;
    }
}