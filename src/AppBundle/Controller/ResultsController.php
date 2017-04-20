<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ResultsModel;
use AppBundle\Form\Type\ResultsType;
use Symfony\Component\HttpFoundation\Request;


class ResultsController extends Controller
{
    /**
     * @Route("/results", name="results")
     */
    public function resultsAction()
    {
        //liste de choix des oiseaux
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();

        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel, ['birdList' => $birds]);

        //période concernée?

        //validation du choix
        if ($request->isMethod('POST') && $resultsForm->handleRequest($request)->isValid()){
            dump($resultsModel);

            $listResults = $this->getDoctrine()->getRepository('AppBundle:Observation')->getMailleGeoJsonByBird($resultsModel->bird);
            //$listResults2 = $this->getDoctrine()->getRepository('AppBundle:Observation')->getObservationsInfosWithBirdInfo($resultsModel->bird);

            dump($listResults);
            //dump($listResults2);
            //return $listResults;
        }






        return $this->render('Results/results.html.twig', [
            'birds' => $birds,
            'form' => $resultsForm
                ->createView()]);
    }
}