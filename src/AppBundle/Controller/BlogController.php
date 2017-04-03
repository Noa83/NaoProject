<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/03/2017
 * Time: 16:18
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;

class BlogController extends Controller
{
    const NBRE_PAR_PAGE = 3;

    /**
     * @Route("/blog/{page}", name="blog", defaults={"page" = 1}, requirements={"page" = "\d+"})
     */
    public function BlogAction($page)
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

        return $this->render('Blog/blog.html.twig', array(
            'articles' => $articles,
            'articlesTotal' =>$articlesTotal,
            'nbPages' => $nbPages,
            'page' => $page,));
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function articleAction(Article $article) //mettre param converter Article article pour supprimer les deux premières lignes
    {
        //On récupère tous les articles qui nous serviront pour l'affichage des articles récents
        $articlesTotal = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticlesRecents();

        return $this->render('Blog/article.html.twig', array(
            'article' => $article,
            'articlesTotal' =>$articlesTotal));
    }
}