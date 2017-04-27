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
        //liste de choix des oiseaux
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();
        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel, ['birdList' => $birds]);
        //validation du choix
        $resultsForm->handleRequest($request);
        if ($request->isMethod('GET') && $resultsForm->isSubmitted() && $resultsForm->isValid()) {

//            $birdId = $resultsModel->bird;
//            $this->redirectToRoute('results_route', $birdId);
            $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($resultsModel->bird);
            $observationsBird = $this->getDoctrine()->getRepository('AppBundle:Observation')->find10ByBird($resultsModel->bird);
        }
        return $this->render('Results/results.html.twig', [
            'birds' => $birds,
            'birdChoisi' => $birdChoisi,
            'observationsBird' => $observationsBird,
            'form' => $resultsForm
                ->createView()]);
    }

    /**
     * @Route("/results/{birdId}", name="results_route", requirements={"birdId": "\d+"})
     */
    public function getBirdsObservationsResultsAction($birdId)
    {
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($birdId);
        $observationsBird = $this->getDoctrine()->getRepository('AppBundle:Observation')->find10ByBird($birdId);

        return $this->render('Results/results.html.twig', [
            'birdChoisi' => $birdChoisi,
            'observationsBird' => $observationsBird
                ]);
    }



    /**
     * @Route("/bird/json/{id}", name="bird", requirements={"id": "\d+"})
     */
    public function getBirdsResultsAction($id)
    {
        return new Response ($this->get('data_to_geojson')->getGeoJson($this->getDoctrine()
            ->getRepository('AppBundle:Observation')->getObservationInfoWithMailleByBird($id)));
    }
}