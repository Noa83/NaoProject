<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\RechercheModel;
use AppBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\JsonResponse;

class RechercheController extends Controller
{
    /**
     *@Route("/recherche", name="recherche")
     */
    public function formRechercheAction(Request $request)
    {
        $recherche = new RechercheModel();
        $form = $this->get('form.factory')->create(RechercheType::class, $recherche);
        return $this->render('Recherche/formRecherche.html.twig', array('form' => $form->createView()));
    }

    /**
     *@Route("/resultat", name="resultat")
     */
    public function formResultatAction(Request $request)
    {
        $recherche = new RechercheModel();
        $form = $this->get('form.factory')->create(RechercheType::class, $recherche);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $motRecherche = $recherche->recherche;
            $fiche = $this->getDoctrine()->getManager()->getRepository('AppBundle:Birds')->findOneBy(array('nomVern' => $motRecherche));

            if ($fiche == null)
            {
                $arrayOiseau = $this->getDoctrine()->getManager()->getRepository('AppBundle:Birds')->findBirds($motRecherche);
                $arrayArticle = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->findArticle($motRecherche);
                $array = array_merge($arrayOiseau, $arrayArticle);
                return $this->render('Recherche/resultatRecherche.html.twig', array('tab' => $array, 'form' => $form->createView()));
            }
            else
            {
                return $this->render('Recherche/resultatRecherche.html.twig', array('nom' => $fiche, 'form' => $form->createView()));
            }
        }
    }

    /**
     * @Route("/data", name="ajax")
     */
    public function ajaxAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $term = $request->get('nomVern');
            $array1= $this->getDoctrine()->getManager()->getRepository('AppBundle:Birds')->findBirds($term);
            $array2= $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->findArticle($term);
            $array = array_merge($array1, $array2);
            return new JsonResponse($array);
        }
    }
}