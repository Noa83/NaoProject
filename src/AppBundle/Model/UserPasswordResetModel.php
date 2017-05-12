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
class UserPasswordResetModel {

    /**
     * @Assert\NotBlank()
     */
    public $username;

    /**
     *
     * @Assert\Length(max=4096)
     */
    public $plainPassword;

}
