<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\NamedTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OptionFieldRepository")
 * @ORM\Table(name="option_field")
 * @UniqueEntity("identifier")
 */
class OptionField extends AbstractAuditable {

    use NamedTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @var string
     */
    protected $identifier;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OptionFieldOption", mappedBy="optionField")
     * @var ArrayCollection
     */
    protected $options;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    protected $acronym;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    protected $code;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean
     */
    protected $isActive = false;

    /**
     * OptionField constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->options = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdentifier(): ?string {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier) {
        $this->identifier = $identifier;
    }

    /**
     * @return string|null
     */
    public function getAcronym(): ?string {
        return $this->acronym;
    }

    /**
     * @param string|null $acronym
     */
    public function setAcronym(string $acronym) {
        $this->acronym = $acronym;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(string $code) {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function isActive(): bool {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive) {
        $this->isActive = $isActive;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param Collection $options
     */
    public function setOptions(Collection $options) {
        $this->options = $options;
    }

}