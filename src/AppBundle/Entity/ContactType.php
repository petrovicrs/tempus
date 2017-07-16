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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactTypeRepository")
 * @ORM\Table(name="contact_type")
 */
class ContactType extends AbstractAuditable
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
     * Get id
     *
     * @return int
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

}