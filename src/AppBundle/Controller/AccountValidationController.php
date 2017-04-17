<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserModelCompleteType;
use AppBundle\Model\UserAccountModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccountValidationController extends Controller
{
    public function validationAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $obsModerer = $this->getDoctrine()->getRepository('AppBundle:Observation')->findBy(array('validated' => false));

        return $this->render('Account/accountValidation.html.twig', array(
            'obsModerer' => $obsModerer));
    }

}