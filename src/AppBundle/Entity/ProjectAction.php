<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/16/17
 * Time: 2:44 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectActionRepository")
 * @ORM\Table(name="project_actions")
 */
class ProjectAction extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"main"})
     */
    public $id;

    /**
     * @ORM\Column(name="name_en", type="string")
     * @Groups({"main"})
     */
    public $nameEn;

    /**
     * @ORM\Column(name="name_sr", type="string")
     * @Groups({"main"})
     */
    public $nameSr;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectKeyAction"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $keyAction;

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
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param mixed $nameEn
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * @return mixed
     */
    public function getNameSr()
    {
        return $this->nameSr;
    }

    /**
     * @return mixed
     */
    public function getKeyAction()
    {
        return $this->keyAction;
    }

    /**
     * @param mixed $keyAction
     */
    public function setKeyAction($keyAction)
    {
        $this->keyAction = $keyAction;
    }

    /**
     * @param mixed $nameSr
     */
    public function setNameSr($nameSr)
    {
        $this->nameSr = $nameSr;
    }

    public function getName($locale) {
        if ($locale == "sr"){
            return $this->nameSr;
        }
        return $this->nameEn;
    }
}