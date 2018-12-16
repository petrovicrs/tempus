<?php

namespace AppBundle\Entity;

use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class AbstractAuditable {

    /**
     * Hook blameable behavior
     * updates createdBy, updatedBy fields
     */
    use BlameableEntity;

    /**
     * Hook timestampable behavior
     * updates createdOn, updatedOn fields
     */
    use TimestampableEntity;

    /**
     * AbstractAuditable constructor.
     */
    public function __construct() {}

}