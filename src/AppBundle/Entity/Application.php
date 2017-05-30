<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email_address", type="string", length=255)
     */
    private $emailAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="cover_letter", type="blob", nullable=true)
     */
    private $coverLetter;

    /**
     * @var string
     *
     * @ORM\Column(name="uniqness", type="blob", nullable=true)
     */
    private $uniqness;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @var string
     *
     * @ORM\Column(name="portfolio", type="string", length=255, nullable=true)
     */
    private $portfolio;


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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Application
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Application
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return Application
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set coverLetter
     *
     * @param string $coverLetter
     *
     * @return Application
     */
    public function setCoverLetter($coverLetter)
    {
        $this->coverLetter = $coverLetter;

        return $this;
    }

    /**
     * Get coverLetter
     *
     * @return string
     */
    public function getCoverLetter()
    {
        return $this->coverLetter;
    }

    /**
     * Set uniqness
     *
     * @param string $uniqness
     *
     * @return Application
     */
    public function setUniqness($uniqness)
    {
        $this->uniqness = $uniqness;

        return $this;
    }

    /**
     * Get uniqness
     *
     * @return string
     */
    public function getUniqness()
    {
        return $this->uniqness;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return Application
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set portfolio
     *
     * @param string $portfolio
     *
     * @return Application
     */
    public function setPortfolio($portfolio)
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    /**
     * Get portfolio
     *
     * @return string
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }
}

