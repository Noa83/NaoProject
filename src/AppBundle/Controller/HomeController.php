<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{
    const NBRE_PAR_PAGE = 3;

    /**
    * @Route("/{page}", name="home_page", requirements={"page": "\d+"})
    */
    public function indexAction($page = 1)
    {
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
            'page' => $page,));
    }
}