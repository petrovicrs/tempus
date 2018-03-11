<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountyRepository")
 * @ORM\Table(name="county")
 */
class County extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="nameEn", type="string")
     */
    protected $nameEn;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="nameSr", type="string")
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
     * @param String $locale
     * @return String
     */
    public function getName($locale){
        if ($locale == "sr"){
            return $this->nameSr;
        }
        return $this->nameEn;
    }
}