<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserModelCompleteType;
use AppBundle\Model\UserAccountModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccountProfilController extends Controller
{
    /**
     * @Route("/account", name="account")
     */
    public function accountAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userAccountModel = $this->get('appbundle.user_service')->userToUserModel($user);
        $form = $this->createForm(UserModelCompleteType::class, $userAccountModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->get('appbundle.user_service')->modifyUser($user, $userAccountModel);
            $this->addFlash(
                'success',
                'Changements sauvegardés'
            );

        }

        return $this->render('Account/accountProfil.html.twig', array('formProfil' => $form->createView()));
    }

}