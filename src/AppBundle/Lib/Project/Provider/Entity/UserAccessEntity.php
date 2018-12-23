<?php

namespace AppBundle\Lib\Project\Provider\Entity;

/**
 * Class UserAccessEntity
 *
 * @package AppBundle\Lib\Project\Provider\Entity
 */
class UserAccessEntity {

    /** @var int[] */
    private $accessibleProjectIds = [];

    /** @var int[] */
    private $inAccessibleProjectIds = [];

    /**
     * @return int[]
     */
    public function getAccessibleProjectIds(): array {
        return $this->accessibleProjectIds;
    }

    /**
     * @param int[] $accessibleProjectIds
     */
    public function setAccessibleProjectIds(array $accessibleProjectIds) {
        $this->accessibleProjectIds = $accessibleProjectIds;
    }

    /**
     * @param array $accessibleProjectIds
     */
    public function addAccessibleProjectIds(array $accessibleProjectIds) {
        foreach ($accessibleProjectIds as $accessibleProjectId) {
            $this->accessibleProjectIds[] = $accessibleProjectId;
        }
    }

    /**
     * @param int $accessibleProjectId
     */
    public function addAccessibleProjectId(int $accessibleProjectId) {
        $this->accessibleProjectIds[] = $accessibleProjectId;
    }

    /**
     * @return int[]
     */
    public function getInAccessibleProjectIds(): array {
        return $this->inAccessibleProjectIds;
    }

    /**
     * @param int[] $inAccessibleProjectIds
     */
    public function setInAccessibleProjectIds(array $inAccessibleProjectIds) {
        $this->inAccessibleProjectIds = $inAccessibleProjectIds;
    }

    /**
     * @param array $inAccessibleProjectIds
     */
    public function addInAccessibleProjectIds(array $inAccessibleProjectIds) {
        foreach ($inAccessibleProjectIds as $inAccessibleProjectId) {
            $this->inAccessibleProjectIds[] = $inAccessibleProjectId;
        }
    }

    /**
     * @param int $inAccessibleProjectId
     */
    public function addInAccessibleProjectId(int $inAccessibleProjectId) {
        $this->inAccessibleProjectIds[] = $inAccessibleProjectId;
    }

}