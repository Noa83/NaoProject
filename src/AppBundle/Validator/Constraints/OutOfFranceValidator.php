<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Model\ObservationModel;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OutOfFranceValidator extends ConstraintValidator
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var ObservationModel $value
         */
        $maille = $value->maille;

        if (empty($maille))
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('lat')
                ->addViolation();
        }
    }
}