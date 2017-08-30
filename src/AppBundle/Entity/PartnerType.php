<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 29.08.17
 * Time: 23:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerTypeRepository")
 * @ORM\Table(name="partner_type")
 */
class PartnerType
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name_en", type="string", length=255)
     */
    protected $nameEn;

    /**
     * @ORM\Column(name="name_sr", type="string", length=255)
     */
    protected $nameSr;

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

    public function getName($locale)
    {
        if($locale == 'sr') {
            return $this->nameSr;
        }

        return $this->nameEn;
    }
}