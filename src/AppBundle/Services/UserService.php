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

        $user->setUsername($model->username);
        $user->setEmail($model->email);

        // Encodage du mot de passe.
        $password = $this->encoder
            ->encodePassword($user, $model->plainPassword);
        $user->setPassword($password);

        // 4) Sauvegarde de l'utilisateur
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function createUserModel(User $user){

        $userModel = new UserModel();

        $userModel->username = $user->getUsername();
        $userModel->email = $user->getEmail();
        $userModel->plainPassword = "";
        $userModel->ville = $user->getVille();
        $userModel->dateNaissance = $user->getDateNaissance();
        $userModel->prenom = $user->getPrenom();

        return $userModel;
    }

    public function modifyUser(User $user, UserModel $model){

        $user->setUsername($model->username);
        $user->setEmail($model->email);
        $user->setPrenom($model->prenom);
        $user->setDateNaissance($model->dateNaissance);
        $user->setVille($model->ville);

        // 4) Sauvegarde de l'utilisateur
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}