<?php

namespace AppBundle\Controller;


use AppBundle\Form\UserResetPasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PasswordManagerController extends Controller
{
    /**
     * @Route("/reinitialiser_mdp", name="ask_reset_password")
     */
    public function askResetAction(Request $request)
    {

        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('account');
        }

        return $this->render('Account/resetPass.html.twig');

    }

    /**
     * @Route("/reinitialiser_email", name="email_reset_password")
     */
    public function emailResetAction(Request $request)
    {
        $username = $request->request->get('_username');
        $email = $request->request->get('_email');

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('email' => $email, 'username' => $username));

        if (!isset($user)){
            $this->addFlash(
                'warning',
                'Erreur de saisie. Votre pseudo et votre email ne correspondent pas.'
            );

            return $this->redirectToRoute('ask_reset_password');
        } else {
            $token = sha1(random_bytes(15));
            $user->setToken($token);
            $this->getDoctrine()->getManager()->flush();

            $lien = "http://nosamislesoiseaux.eg2.fr/changement_mdp/".$token;
            $this->get('mail')->sendResetMail($lien, $email);

            $this->addFlash(
                'success',
                'Email de reinitialisation envoyé.'
            );

            return $this->redirectToRoute('home_page');
        }
    }

    /**
     * @Route("/changement_mdp/{token}", name="reset_password", requirements={"token" = "\w+"})
     */
    public function resetAction(Request $request)
    {
        $token = $request->attributes->get("token");
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('token' => $token));
        $userModel = $this->get('appbundle.user_service')->userToUserAdminModel($user);
        $form = $this->createForm(UserResetPasswordType::class, $userModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->get('appbundle.user_service')->modifyPassword($user, $userModel);
            return $this->redirectToRoute('login');
        }

        return $this->render(':Account:newPassword.html.twig', array('form' => $form->createView()));
    }

}