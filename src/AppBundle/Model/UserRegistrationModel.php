<?php

namespace AppBundle\Model;

use AppBundle\Validator\Constraints\EmailConstraint;
use AppBundle\Validator\Constraints\UsernameConstraint;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @UsernameConstraint()
 * @EmailConstraint()
 */
class UserRegistrationModel {

    /**
     * @Assert\NotBlank()
     */
    public $username;

    /**
     *
     * @Assert\Length(max=4096)
     */
    public $plainPassword;

    /**
     *
     * @Assert\NotBlank()
     * @Assert\Email(message = "Adresse non valide")
     */
    public $email;

}
