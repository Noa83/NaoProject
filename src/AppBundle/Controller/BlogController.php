<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/03/2017
 * Time: 16:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Picture;
use AppBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class BlogController extends Controller
{
    const NBRE_PAR_PAGE = 3;

    /**
     * @Route("/blog/{page}", name="blog", defaults={"page" = 1}, requirements={"page" = "\d+"})
     */
    public function BlogAction($page)
    {
        //pas de page 0 et négative
        if ($page < 1)
        {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
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

    /**
     * @Route("/ecriture_article", name="ecriture_article")
     */
    public function ecriture_articleAction(Request $request)
    {
        $article = new Article();
        $form = $this->get('form.factory')->create(ArticleType::class, $article);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->handleImage($article);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('blog');
        }
        return $this->render('Blog/ecriture_article.html.twig', array('form' => $form->createView()));
    }

    private function handleImage(Article $article)
    {
        $image   = new Picture();
        $recuperationImage = $article->getPicture();
        $file = $recuperationImage->getUrl();
        $filename = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->getParameter('pictures_directory'),$filename);
        $image->setUrl($filename);
        $image->setAlt($article->getTitle());
        $article->setPicture($image);
    }
}