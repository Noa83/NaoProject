<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ResultsModel;
use AppBundle\Form\Type\ResultsType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ResultsController extends Controller
{
    /**
     * @Route("/results", name="results")
     */
public function resultsAction(Request $request)
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

            $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($resultsModel->bird);
            return new JsonResponse($listResults);


            return $this->render('Results/results.html.twig', [
                'birds' => $birds,
                'birdChoisi' => $birdChoisi
                    ]);
        }
        return $this->render('Results/results.html.twig', [
            'birds' => $birds,
            'form' => $resultsForm
                ->createView()]);
    }

    public function getBirdsResultsAction($birdId)
    {

    }

    /**
     * @Route("/bird/{id}", name="bird", requirements={"id": "\d+"})
     */
    public function getBirdsResultsAction($id)
    {
        return new JsonResponse($this->getDoctrine()->getRepository('AppBundle:Observation')->getMailleGeoJsonByBird($id));
    }


}