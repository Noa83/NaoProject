<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Model\ResultsModel;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoObservationsFoundValidator extends ConstraintValidator
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var ResultsModel $value
         */
        $birdId = $value->birdId;
        try{
            $this->manager->getRepository('AppBundle:Observation')->find10ByBird($birdId);
        }
        catch(\Exception $e)
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('birdId')
                ->addViolation();
        }
    }
}