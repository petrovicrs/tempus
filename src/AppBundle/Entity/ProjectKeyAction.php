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

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectKeyActionRepository")
 * @ORM\Table(name="project_key_actions")
 */
class ProjectKeyAction extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name_en", type="string")
     */
    protected $nameEn;

    /**
     * @ORM\Column(name="name_sr", type="string")
     */
    protected $nameSr;

    /**
     * @ORM\OneToMany(targetEntity="ProjectAction", mappedBy="keyAction", cascade={"persist"})
     */
    protected $keyActions;

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
     * @param mixed $nameSr
     */
    public function setNameSr($nameSr)
    {
        $this->nameSr = $nameSr;
    }

    /**
     * @return mixed
     */
    public function getKeyActions()
    {
        return $this->keyActions;
    }

    /**
     * @param mixed $keyActions
     */
    public function setKeyActions($keyActions)
    {
        $this->keyActions = $keyActions;
    }


    public function getName($locale) {
        if ($locale == "sr"){
            return $this->nameSr;
        }
        return $this->nameEn;
    }
}