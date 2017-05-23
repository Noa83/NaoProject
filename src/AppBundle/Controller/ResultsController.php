<?php
namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ResultsModel;
use AppBundle\Form\Type\ResultsType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class ResultsController extends Controller
{
    /**
     * @Route("/consultation", name="results")
     */
    public function resultsAction(Request $request)
    {
        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel);

        $resultsForm->handleRequest($request);
        if ($request->isMethod('POST') && $resultsForm->isSubmitted() && $resultsForm->isValid()) {
            return $this->redirectToRoute('results_list', ['birdId' => $resultsModel->birdId]);
        }

        return $this->render('Results/results.html.twig', [
            'form' => $resultsForm
                ->createView()]);
    }

    /**
     * @Route("/bird/autocomp", name="bird_list")
     */
    public function getAutoCompBirdsListAction()
    {
        return new JsonResponse($this->get('data_to_array_for_autocomplete_consultation')
            ->getBirdsListForAutoComplete($this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList()));
    }

}
