<?php

namespace AppBundle\Controller;


use AppBundle\Form\UserResetPasswordType;
use AppBundle\Model\UserPasswordResetModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PasswordManagerController extends Controller
{
    /**
     * @Route("/ask-reset-pass", name="ask_reset_password")
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
     * @Route("/email-reset", name="email_reset_password")
     */
    public function emailResetAction()
    {

        $username = $_POST['_username'];
        $email = $_POST['_email'];

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

            $lien = "http://nosamislesoiseaux.eg2.fr/reseting-password/".$token;
            $this->get('mail')->sendResetMail($lien, $email);

            return $this->redirectToRoute('home_page');
        }
    }

    /**
     * @Route("/reseting-password/{token}", name="reset_password", requirements={"token" = "\w+"})
     */
    public function resetAction(Request $request)
    {
        $token = $request->attributes->get("token");
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('token' => $token));
        $userModel = new UserPasswordResetModel();
        $form = $this->createForm(UserResetPasswordType::class, $userModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->get('appbundle.user_service')->modifyUserPass($user, $userModel);
            return $this->redirectToRoute('login');
        }

        return $this->render(':Account:newPassword.html.twig', array('form' => $form->createView()));
    }

}