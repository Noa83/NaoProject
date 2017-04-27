<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RechercheController extends Controller
{
    /**
     *@Route("/resultat", name="resultat")
     */
    public function formResultatAction(Request $request)
    {
        $motRecherche = $request->query->get('motRecherche');
        
        if (isset($motRecherche) AND ($motRecherche != ""))
        {
            $fiche = $this->getDoctrine()->getManager()->getRepository('AppBundle:Birds')->findOneBy(array('nomVern' => $motRecherche));
            dump($fiche);
            if ($fiche == null)
            {
                $arrayOiseau = $this->getDoctrine()->getManager()->getRepository('AppBundle:Birds')->findBirds($motRecherche);
                $arrayArticle = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->findArticle($motRecherche);
                $array = array_merge($arrayOiseau, $arrayArticle);
                return $this->render('Recherche/resultatRecherche.html.twig', array('tab' => $array));
            }
            else
            {
                return $this->render('Recherche/resultatRecherche.html.twig', array('nom' => $fiche));
            }
        }
        else
        {
            return $this->render('Recherche/resultatRecherche.html.twig', array('tab' => 'Aucun résultat'));
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