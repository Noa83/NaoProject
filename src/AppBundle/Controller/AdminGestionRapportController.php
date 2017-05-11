<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\Type\ResultsType;
use AppBundle\Form\UserAdminDashboardType;
use AppBundle\Form\UserSearchType;
use AppBundle\Model\ResultsModel;
use AppBundle\Model\UserAccountModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class AdminGestionRapportController extends Controller
{
    /**
     * @Route("/admin/rapport", name="admin_rapport")
     */
    public function adminGestionRapportAction(Request $request)
    {
        $observationsBird = null ;
        $dateDerniereObs = '';

        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel);

        $resultsForm->handleRequest($request);
        if ($request->isMethod('POST') && $resultsForm->isSubmitted() && $resultsForm->isValid()) {
            return $this->redirectToRoute('admin_rapport_bird', ['birdId' => $resultsModel->birdId]);
        }

        return $this->render('AdminAccount/adminGestionRapport.html.twig', [
            'derniereObs' => $dateDerniereObs,
            'form' => $resultsForm
                ->createView()]);
    }
}