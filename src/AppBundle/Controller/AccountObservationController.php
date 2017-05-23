<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Model\UserAccountModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccountObservationController extends Controller
{
    /**
     * @Route("/profil/observation", name="account_observation")
     */
    public function observationAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $observationsUser = $this->getDoctrine()->getRepository('AppBundle:Observation')->findObsByUser($user);
        return $this->render('Account/accountObservation.html.twig', array(
            'observationsUser' => $observationsUser));
    }

    /**
     * @Route("/profil/ficheMyObservation/{id}/{idObs}", name="fiche_bird_my_obs", requirements={"id" = "\d+", "idObs" = "\d+"})
     */
    public function ficheMyObservationAction($id, $idObs)
    {
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($id);
        $observation = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('id'=>$idObs));

        return $this->render('Results/ficheMyObservation.html.twig', [
            'birdChoisi' => $birdChoisi,
            'observation' => $observation]);
    }
}