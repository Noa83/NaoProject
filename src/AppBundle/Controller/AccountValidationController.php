<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccountValidationController extends Controller
{
    /**
     * @Route("/profil/validation", name="account_validation")
     */
    public function validationAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $observationAModerer = $this->getDoctrine()->getRepository('AppBundle:Observation')->findBy(array('validated' => false));

        return $this->render('Account/accountValidation.html.twig', array(
            'observationAModerer' => $observationAModerer));
    }

}