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

    /**
     * @Route("/profil/ficheBeforeValidation/{id}/{idObs}", name="fiche_bird_before_obs", requirements={"id" = "\d+", "idObs" = "\d+"})
     */
    public function ficheBeforeValidation($id, $idObs)
    {
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($id);
        $observation = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('id'=>$idObs));

        return $this->render('Results/ficheBird.html.twig', [
            'birdChoisi' => $birdChoisi,
            'observation' => $observation]);
    }
}