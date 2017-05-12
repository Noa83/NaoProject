<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Model\UserRegistrationModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailConstraintValidator extends ConstraintValidator
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var UserRegistrationModel $value
         */

        $requeteEmail = $this->manager->getRepository('AppBundle:User')->findOneBy(array('email' => $value->email));

        if (null !== $requeteEmail){
            $this->context->buildViolation($constraint->message)
                ->atPath('email')
                ->addViolation();
        }
    }
}