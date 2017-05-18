<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\User;
use AppBundle\Model\UserRegistrationModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailConstraintValidator extends ConstraintValidator
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

        if ($user->getEmail() !== $value->email){

            $requeteEmail = $this->manager->getRepository('AppBundle:User')->findOneBy(array('email' => $value->email));

            if (null !== $requeteEmail){
                $this->context->buildViolation($constraint->message)
                    ->atPath('email')
                    ->addViolation();
            }
        }
    }
}