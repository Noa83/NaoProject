<?php

namespace AppBundle\Controller;


use AppBundle\Form\UserModelType;
use AppBundle\Entity\User;
use AppBundle\Model\UserAccountModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CreateAccountController extends Controller
{
    public function createAccountAction(Request $request) {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            // 1) Création du formulaire
            $model = new UserAccountModel();
            $form = $this->createForm(UserModelType::class, $model);

            // 2) Si le formulaire est valide et Requete POST encodage du mot de passe puis sauvegarde des données
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $user = $this->get('appbundle.user_service')->createUser($model);

                //Creation du token pour le login automatique apres inscription.
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));

                return $this->redirectToRoute('account');
            }

            return $this->render('Account/createAccount.html.twig',
                array('form' => $form->createView())
            );
        }
    }
}