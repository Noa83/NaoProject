<?php

namespace AppBundle\Controller;


use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreateAccountController extends Controller
{
    public function createAccountAction(Request $request) {

        // 1) Création du formulaire
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) Si le formulaire est valide et Requete POST encodage du mot de passe puis sauvegarde des données
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encodage du mot de passe et definition du role USER par défaut.
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setIsActive(true);
            $user->setRoles(array('ROLE_USER'));

            // 4) Sauvegarde de l'utilisateur
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render('Account/createAccount.html.twig',
            array('form' => $form->createView())
        );
    }
}