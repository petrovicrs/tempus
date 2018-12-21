<?php

namespace AppBundle\Entity\Traits;

use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Trait NamedTrait
 *
 * @package AppBundle\Entity\Traits
 */
trait NamedTrait {

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    protected $nameEn = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    protected $nameSr = null;

    /**
     * @return null|string
     */
    public function getNameEn(): ?string {
        return $this->nameEn;
    }

    /**
     * @param null|string $nameEn
     */
    public function setNameEn(string $nameEn) {
        $this->nameEn = $nameEn;
    }

    /**
     * @return null|string
     */
    public function getNameSr(): ?string {
        return $this->nameSr;
    }

    /**
     * @param null|string $nameSr
     */
    public function setNameSr(string $nameSr) {
        $this->nameSr = $nameSr;
    }

    /**
     * @return null|string
     */
    public function getNameLat(): ?string {
        return $this->getNameSr();
    }

    /**
     * @param null|string $nameLat
     */
    public function setNameLat(string $nameLat) {
        $this->nameSr = $this->getNameSr();
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getName(string $locale) {
        $result = '';
        $methodName = 'getName' . ucfirst($locale);
        if (method_exists($this, $methodName)) {
            $result = $this->{$methodName}();
        }
        return $result;
    }

}