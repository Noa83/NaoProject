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
class UserModel {

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

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 60,
     *      minMessage = "Votre prenom doit contenir au moins {{ limit }} characteres",
     *      maxMessage = "Votre prenom doit contenir au maximum {{ limit }} characteres"
     * )
     */
    public $prenom;

    /**
     * @Assert\Date()
     */
    public $dateNaissance;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "Votre prenom doit contenir au moins {{ limit }} characteres",
     *      maxMessage = "Votre prenom doit contenir au maximum {{ limit }} characteres"
     * )
     */
    public $ville;
}
