<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\Km10;
use AppBundle\Repository\Km10Repository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ResultsModel;
use AppBundle\Form\Type\ResultsType;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;


class FicheBirdController extends Controller
{
    /**
     * @Route("/bird/fiche/{id}", name="fiche_bird", requirements={"id" = "\d+"})
     */
    public function ficheAction($id)
    {

        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($id);

        return $this->render('Results/ficheBird.html.twig', [
            'birdChoisi' => $birdChoisi ]);
    }

    /**
     * @Route("/bird/{id}", name="bird", requirements={"id": "\d+"})
     */
    public function getBirdsResultsAction($id)
    {
        return new Response ($this->get('data_to_geojson')->getGeoJson($this->getDoctrine()
            ->getRepository('AppBundle:Observation')->getMailleGeoJsonByBird($id)));
    }


}