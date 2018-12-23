<?php

namespace AppBundle\Lib\Project\Provider\Providers;

use AppBundle\Entity\User;
use AppBundle\Lib\Project\Provider\Entity\UserAccessEntity;

/**
 * Interface ProviderInterface
 *
 * @package AppBundle\Lib\Project\Provider\Providers
 */
interface ProviderInterface {

    /**
     * Get user project accessibility entity
     *
     * @param User $user
     *
     * @return UserAccessEntity
     */
    public function getUserAccessEntity(User $user);


}