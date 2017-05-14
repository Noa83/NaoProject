<?php

namespace AppBundle\Controller;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class FicheBirdController extends Controller
{
    /**
     * @Route("/oiseau/fiche/{id}/{idObs}", name="fiche_bird_obs", requirements={"id" = "\d+", "idObs" = "\d+"})
     */
    public function ficheObsAction($id, $idObs)
    {
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($id);
        $observation = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('id'=>$idObs));

        return $this->render('Results/ficheBird.html.twig', [
            'birdChoisi' => $birdChoisi,
            'observation' => $observation]);
    }

    /**
     * @Route("/oiseau/fiche/{id}/", name="fiche_bird", requirements={"id" = "\d+"})
     */
    public function ficheBirdAction($id)
    {
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($id);

        return $this->render('Results/ficheBirdSansObservations.html.twig', [
            'birdChoisi' => $birdChoisi]);
    }

    /**
     * @Route("/bird/json/{id}/{obsId}", name="fiche_json", requirements={"id": "\d+", "obsId": "\d+"})
     */
    public function getOneMailleForOneObservationChoicedAction($id, $obsId)
    {
        return new Response($this->get('data_to_geojson')->getGeoJson($this->getDoctrine()
            ->getRepository('AppBundle:Observation')->getOneMailleGeoJsonByBird($id, $obsId)));
    }
}