<?php
namespace AppBundle\Controller;
use AppBundle\AppBundle;
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
        $observationsBird = null ;
        //liste de choix des oiseaux
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();
        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel, ['birdList' => $birds]);
        //validation du choix
        $resultsForm->handleRequest($request);
        if ($request->isMethod('POST') && $resultsForm->isSubmitted() && $resultsForm->isValid()) {
           return $this->redirectToRoute('results_list', ['birdId' => $resultsModel->birdId]);
            $try = $this->getBirdsResultsAction(40);
            dump($try);
            $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($resultsModel->bird);


                'birdChoisi' => $birdChoisi
        }
        return $this->render('Results/results.html.twig', [
            'birds' => $birds,
            'form' => $resultsForm
                ->createView()]);
    }
    /**
     * @Route("/bird/json/{id}", name="bird", requirements={"id": "\d+"})
     */
    public function getBirdsResultsAction($id)
    {
        return new Response ($this->get('data_to_geojson')->getGeoJson($this->getDoctrine()
            ->getRepository('AppBundle:Observation')->getObservationInfoWithMailleByBird($id)));
    }

    /**
     * @Route("/bird/{id}", name="bird", requirements={"id": "\d+"})
     */
    public function getBirdsResultsAction($id)
    {
        return new JsonResponse($this->getDoctrine()->getRepository('AppBundle:Observation')->getMailleGeoJsonByBird($id));
    }


}
