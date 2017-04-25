<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ResultsModel;
use AppBundle\Form\Type\ResultsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ResultsController extends Controller
{
    /**
     * @Route("/results", name="results")
     */
    public function resultsAction(Request $request)
    {
        $birdChoisi = '';
        $observationsBird = null ;
        $mailleCountsForChoicedBirdList= '';

        //liste de choix des oiseaux
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();

        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel, ['birdList' => $birds]);

        //validation du choix
        if ($request->isMethod('POST') && $resultsForm->handleRequest($request)->isValid()) {

            $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($resultsModel->bird);
            $observationsBird = $this->getDoctrine()->getRepository('AppBundle:Observation')->find10ByBird($resultsModel->bird);

            $mailleCountsForChoicedBirdList = $this->get('data_to_array_maille_nb_birds')->GetArrayMailleNameAndNumberOfBirds(
                $this->getDoctrine()->getRepository('AppBundle:Km10')->getMaillesWithBird($resultsModel->bird));
        }

        return $this->render('Results/results.html.twig', [
            'birds' => $birds,
            'birdChoisi' => $birdChoisi,
            'observationsBird' => $observationsBird,
            'mailleCountForBird' => $mailleCountsForChoicedBirdList,
            'form' => $resultsForm
                ->createView()]);
    }

    /**
     * @Route("/bird/{id}", name="bird", requirements={"id": "\d+"})
     */
    public function getBirdsResultsAction($id)
    {
        return new Response ($this->get('data_to_geojson')->getGeoJson($this->getDoctrine()
            ->getRepository('AppBundle:Observation')->getObservationInfoWithMailleByBird($id)));
    }
}