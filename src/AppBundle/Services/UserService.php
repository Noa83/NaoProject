<?php

namespace AppBundle\Services;

use AppBundle\Model\UserModel;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService {

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function createUser(UserModel $model){

        $user = new User();

        $user->setUsername($model->getUsername());
        $user->setEmail($model->getEmail());

        // Encodage du mot de passe.
        $password = $this->encoder
            ->encodePassword($user, $model->getPlainPassword());
        $user->setPassword($password);

        // 4) Sauvegarde de l'utilisateur
        $this->em->persist($user);
        $this->em->flush();
    }
}