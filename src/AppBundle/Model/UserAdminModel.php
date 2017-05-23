<?php

namespace AppBundle\Model;


use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
class UserAdminModel {

    /**
     * @Assert\NotBlank()
     */
    public $username;

    /**
     *
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Votre mot de passe doit faire {{ limit }} caracteres minimum")
     */
    public $plainPassword;

    /**
     *
     * @Assert\NotBlank()
     * @Assert\Email(message = "Adresse non valide")
     */
    public $email;

    /**
     * @Assert\NotBlank()
     */
    public $role;

}
