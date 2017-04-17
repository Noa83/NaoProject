<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserModelCompleteType;
use AppBundle\Model\UserAccountModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccountObservationController extends Controller
{
    public function observationAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $observations = $this->getDoctrine()->getRepository('AppBundle:Observation')->findBy(array('user' => $user->getId()));

        return $this->render('Account/accountObservation.html.twig', array(
            'observations' => $observations));
    }

}