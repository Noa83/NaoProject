<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoObservationsFound extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    public $message = 'Aucune observation n\'a encore été enregistrée pour cet oiseau';
}