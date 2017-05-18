<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\User;
use AppBundle\Model\UserRegistrationModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsernameConstraintValidator extends ConstraintValidator
{
    private $manager;
    private $security;

    public function __construct($manager, $security)
    {
        $this->manager = $manager;
        $this->security = $security;
    }

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var UserRegistrationModel $value
         */

        $user= $this->security->getToken()->getUser();

        if ($user == "anon."){
            $user = new User();
        }

        if ($user->getUsername() !== $value->username){

            $requeteUsername = $this->manager->getRepository('AppBundle:User')->findOneBy(array('username' => $value->username));

            if (null !== $requeteUsername){
                $this->context->buildViolation($constraint->message)
                    ->atPath('username')
                    ->addViolation();
            }
        }
    }
}