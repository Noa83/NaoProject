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
        $latlong = $value->getLongLat();
        try{
           $this->manager->getRepository('AppBundle:Km10')
                ->getMailleNativeSql($latlong);
        }
        catch(\Exception $e)
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('long')
                ->addViolation();
        }
    }
}