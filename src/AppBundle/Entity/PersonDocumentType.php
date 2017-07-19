<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/10/17
 * Time: 9:22 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonDocumentTypeRepository")
 * @ORM\Table(name="person_document_type")
 */
class PersonDocumentType extends AbstractAuditable
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    protected $typeEn;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    protected $typeSr;

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
    public function getTypeEn()
    {
        return $this->typeEn;
    }

    /**
     * @param mixed $typeEn
     */
    public function setTypeEn($typeEn)
    {
        $this->typeEn = $typeEn;
    }

    /**
     * @return mixed
     */
    public function getTypeSr()
    {
        return $this->typeSr;
    }

    /**
     * @param mixed $typeSr
     */
    public function setTypeSr($typeSr)
    {
        $this->typeSr = $typeSr;
    }


    /**
     * @param $locale
     * @return String
     */
    public function getType($locale) {
        if ($locale == "sr"){
            return $this->typeSr;
        }
        return $this->typeEn;
    }

}