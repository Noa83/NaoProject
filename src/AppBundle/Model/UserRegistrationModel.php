<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 *
 */
class UserRegistrationModel {

    /**
     *
     * @Assert\NotBlank()
     */
    public $username;

    /**
     *
     * @Assert\Length(max=4096)
     */
    public $plainPassword;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

}