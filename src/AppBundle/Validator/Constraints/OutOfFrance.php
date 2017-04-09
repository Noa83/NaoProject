<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OutOfFrance extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    public $message = 'Les coordonnées saisies ne se situent pas sur le territoire métropolitain Français.';
}