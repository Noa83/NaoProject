<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/03/2017
 * Time: 16:18
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BlogController extends Controller
{
    public function BlogAction($page)
    {
        //pas de page 0 et négative
        if ($page < 1)
        {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        //Fixe le nbre d'article à 3 par page
        //Il faut remplacer par un paramétre et y accéder $this->container->getParameter('nb_par_page')
        $nbreParPage = 3;

        //On récupère l'objet Paginator
        $articles = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticles($page, $nbreParPage);

        //On récupère tous les articles qui nous serviront pour l'affichage des articles récents
        $articlesTotal = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticlesTotal();

        //On calcul le nombre total de pages grâce au count($articles) qui retourne le nombre total d'articles
        $nbPages = ceil(count($articles) / $nbreParPage);

        //Si la page n'existe pas, on retourne une erreur
        if ($page > $nbPages)
        {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        return $this->render('Blog/blog.html.twig', array(
            'articles' => $articles,
            'articlesTotal' =>$articlesTotal,
            'nbPages' => $nbPages,
            'page' => $page,));
    }

    public function articleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère  l'article
        $article = $em->getRepository('AppBundle:Article')->find($id);

        //On récupère tous les articles qui nous serviront pour l'affichage des articles récents
        $articlesTotal = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticlesTotal();

        return $this->render('Blog/article.html.twig', array(
            'article' => $article,
            'articlesTotal' =>$articlesTotal));
    }
}