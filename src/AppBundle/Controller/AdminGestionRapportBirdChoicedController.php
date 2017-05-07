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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminGestionRapportBirdChoicedController extends Controller
{
    /**
     * @Route("/admin/rapport/{birdId}", name="admin_rapport_bird", requirements={"birdId": "\d+"})
     */
    public function adminGestionRapportBirdAction($birdId)
    {
        $mailleCountsForChoicedBirdList = $this->get('data_to_array_maille_nb_birds')->GetArrayMailleNameAndNumberOfBirds(
                $this->getDoctrine()->getRepository('AppBundle:Km10')->getMaillesWithBird($birdId));
        $birdChoisi = $this->getDoctrine()->getRepository('AppBundle:Birds')->find($birdId);
        $dateDerniereObs = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('bird' => $birdId),array('date' => 'DESC','id' => 'DESC'));

        return $this->render('AdminAccount/adminGestionRapportBird.html.twig', [
            'mailleCountForBird' => $mailleCountsForChoicedBirdList,
            'birdChoisi' => $birdChoisi,
            'derniereObs' => $dateDerniereObs]);
    }

    /**
     * @Route("/admin/json/{birdId}", name="admin_json", requirements={"birdId": "\d+"})
     */
    public function getArrayDataForChartsPieRepresentation($birdId)
    {
        return new JsonResponse($this->get('data_to_array_maille_nb_birds')->getJsonMailleNameAndNumberOfBirds(
            $this->getDoctrine()->getRepository('AppBundle:Km10')->getMaillesWithBird($birdId)));
    }

}