<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\NamedTrait;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OptionFieldOptionRepository")
 * @ORM\Table(name="option_field_option")
 */
class OptionFieldOption extends AbstractAuditable {

    use NamedTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OptionField", inversedBy="options")
     * @ORM\JoinColumn(name="option_field_id", referencedColumnName="id")
     * @var OptionField
     */
    protected $optionField;

    /**
     * @ORM\Column(type="string", nullable=true, unique=false)
     * @var string
     */
    protected $code;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean
     */
    protected $isActive = false;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return OptionField
     */
    public function getOptionField(): OptionField {
        return $this->optionField;
    }

    /**
     * @param OptionField $optionField
     */
    public function setOptionField(OptionField $optionField) {
        $this->optionField = $optionField;
    }

    /**
     * @return string
     */
    public function getCode(): ?string {
        return $this->code;
    }

    /**
     * @param string $code
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

}