<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ResultsListController extends Controller
{
    /**
     * @Route("/results/{birdId}", name="results_list", requirements={"birdId": "\d+"})
     */
    public function getBirdsObservationsResultsAction($birdId)
    {
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($birdId);
        $observationsBird = $this->getDoctrine()->getRepository('AppBundle:Observation')->find10ByBird($birdId);

        return $this->render('Results/resultsList.html.twig', [
            'birdChoisi' => $birdChoisi,
            'observationsBird' => $observationsBird
        ]);
    }
}