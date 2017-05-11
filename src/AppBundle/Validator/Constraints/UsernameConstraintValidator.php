<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Model\UserRegistrationModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsernameConstraintValidator extends ConstraintValidator
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

        $requeteUsername = $this->manager->getRepository('AppBundle:User')->findOneBy(array('username' => $value->username));

        if (null !== $requeteUsername){
            $this->context->buildViolation($constraint->message)
                ->atPath('username')
                ->addViolation();
        }
    }
}