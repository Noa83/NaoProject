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
     * @Assert\NotBlank()
     */
    public $role;

}
