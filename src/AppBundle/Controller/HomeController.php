<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\RechercheModel;
use AppBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    const NBRE_PAR_PAGE = 3;


    public function indexAction($page, Request $request)
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



        //On récupère l'objet Paginator
        $articles = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->findAllArticles($page, self::NBRE_PAR_PAGE);

        //On récupère tous les articles qui nous serviront pour l'affichage des articles récents
        $articlesTotal = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticlesRecents();

        //On calcul le nombre total de pages grâce au count($articles) qui retourne le nombre total d'articles
        $nbPages = ceil(count($articles) / self::NBRE_PAR_PAGE);

        //Si la page n'existe pas, on retourne une erreur
        if ($page > $nbPages)
        {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        return $this->render('Home/index.html.twig', array(
            'articles' => $articles,
            'articlesTotal' =>$articlesTotal,
            'nbPages' => $nbPages,
            'page' => $page,
            'form' => $form->createView()));
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