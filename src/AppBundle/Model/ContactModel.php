<?php

namespace AppBundle\Model;
use Symfony\Component\Validator\Constraints as Assert;


class ContactModel
{
    /**
     * @Assert\Length(min=3, minMessage="Le nom doit faire au moins {{ limit }} caractères.")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffres.")
     */
    public $lastName;

    /**
     * @Assert\Length(min=3, minMessage="Le prénom doit faire au moins {{ limit }} caractères.")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prénom ne peut pas contenir de chiffres.")
     */
    public $firstName;

    /**
     * @Assert\Email()
     */
    public $mail;

    /**
     * @Assert\Length(min=25, minMessage="Le message doit faire au moins {{ limit }} caractères.")
     */
    public $message;
}