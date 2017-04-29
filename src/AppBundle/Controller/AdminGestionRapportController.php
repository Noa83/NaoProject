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


class AdminGestionRapportController extends Controller
{
    /**
     * @Route("/admin/rapport", name="admin_rapport")
     */
    public function adminGestionRapportAction(Request $request)
    {
        $observationsBird = null ;
        $mailleCountsForChoicedBirdList= '';
        $dateDerniereObs = '';

        //liste de choix des oiseaux
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();

        $resultsModel = new ResultsModel();
        $resultsForm = $this->get('form.factory')->create(ResultsType::class,
            $resultsModel, ['birdList' => $birds]);

        //validation du choix
        if ($request->isMethod('POST') && $resultsForm->handleRequest($request)->isValid()) {

            $mailleCountsForChoicedBirdList = $this->get('data_to_array_maille_nb_birds')->GetArrayMailleNameAndNumberOfBirds(
                $this->getDoctrine()->getRepository('AppBundle:Km10')->getMaillesWithBird($resultsModel->birdId));

            $dateDerniereObs = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('bird' => $resultsModel->birdId),array('date' => 'DESC','id' => 'DESC'));
        }

        return $this->render('AdminAccount/adminGestionRapport.html.twig', [
            'birds' => $birds,
            'mailleCountForBird' => $mailleCountsForChoicedBirdList,
            'derniereObs' => $dateDerniereObs,
            'form' => $resultsForm
                ->createView()]);
    }
}