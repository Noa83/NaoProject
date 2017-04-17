<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserModelCompleteType;
use AppBundle\Model\UserAccountModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccountController extends Controller
{
    public function accountAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userAccountModel = $this->get('appbundle.user_service')->userToUserModel($user);
        $form = $this->createForm(UserModelCompleteType::class, $userAccountModel);

        $observations = $this->getDoctrine()->getRepository('AppBundle:Observation')->findBy(array('user' => $user->getId()));

        $obsModerer = $this->getDoctrine()->getRepository('AppBundle:Observation')->findBy(array('validated' => false));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->get('appbundle.user_service')->modifyUser($user, $userAccountModel);
            $this->addFlash(
                'notice',
                'Changements sauvegardés'
            );

        }

        return $this->render('Account/account.html.twig', array('formProfil' => $form->createView(),
            'observations' => $observations, 'obsModerer' => $obsModerer));
    }

}