<?php

namespace AppBundle\Controller;


use AppBundle\Form\UserModelType;
use AppBundle\Entity\User;
use AppBundle\Model\UserModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreateAccountController extends Controller
{
    public function createAccountAction(Request $request) {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            // 1) Création du formulaire
            $model = new UserModel();
            $form = $this->createForm(UserModelType::class, $model);

            // 2) Si le formulaire est valide et Requete POST encodage du mot de passe puis sauvegarde des données
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $this->get('appbundle.user_service')->createUser($model);

                return $this->redirectToRoute('login');
            }

            return $this->render('Account/createAccount.html.twig',
                array('form' => $form->createView())
            );
        }
    }
}