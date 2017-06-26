<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/25/17
 * Time: 8:59 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

class AbstractAuditable
{

    /**
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    protected $dateCreated;

    /**
     * @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    protected $dateUpdated;


    public function __construct() {

        if ($this->dateCreated) {
            $this->dateUpdated = new \DateTime();
        } else {
            $this->dateCreated = new \DateTime();
        }
    }

    /**
     * Set date_created
     *
     * @param string $dateCreated
     *
     * @return AbstractAuditable
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get date_created
     *
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param string $dateUpdated
     *
     * @return AbstractAuditable
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return string
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}