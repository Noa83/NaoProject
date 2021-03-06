<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/03/2017
 * Time: 16:18
 */

namespace AppBundle\Controller;

use AppBundle\Form\ArticleModifType;
use AppBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class ArticleController extends Controller
{

    /**
     * @Route("/article/{id}", name="article")
     */
    public function articleAction(Article $article)
    {
        $articlesTotal = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticlesRecents();

        return $this->render('Blog/article.html.twig', array(
            'article' => $article,
            'articlesTotal' =>$articlesTotal));
    }

    /**
     * @Route("/admin/article/ecriture", name="ecriture_article")
     */
    public function ecriture_articleAction(Request $request)
    {
        $article = new Article();
        $form = $this->get('form.factory')->create(ArticleType::class, $article);

        if ($request->get('submitAction') == 'Publier') {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
            {
                $article->setPublish(true);
                $this->handleImage($article);
                $article->setDate(new \DateTime);
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('blog');
            }
        }
        elseif ($request->get('submitAction') == 'Enregistrer')
        {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
            {

                $this->handleImage($article);
                $article->setDate(new \DateTime);
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('admin_article');
            }
        }
            return $this->render('Blog/ecriture_article.html.twig', array('form' => $form->createView()));
    }

    private function handleImage(Article $article)
    {
        $file = $article->getImageUrl();
        $filename = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->getParameter('pictures_directory'),$filename);
        $fileUrl = 'images/articlesImages/' . $filename;
        $article->setImageUrl($fileUrl);

    }

    /**
     * @Route("/admin/article/edit/{id}", name="article_edit", requirements={"id": "\d+"})
     */
    public function articleEditAction(Request $request, $id){

        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->findOneBy(array('id' => $id));
        $imageBackUp = $article->getImageUrl();
        $form = $this->get('form.factory')->create(ArticleModifType::class, $article);

        if ($request->get('submitAction') == 'Depublier') {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
            {
                $article->setPublish(false);
                if (null !== $article->getImageUrl()){
                    $this->handleImage($article);
                } else {
                    $article->setImageUrl($imageBackUp);
                }
                $article->setDate(new \DateTime);
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('blog');
            }
        }

        if ($request->get('submitAction') == 'Publier') {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
            {
                $article->setPublish(true);
                if (null !== $article->getImageUrl()){
                    $this->handleImage($article);
                } else {
                    $article->setImageUrl($imageBackUp);
                }
                $article->setDate(new \DateTime);
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('blog');
            }
        }

        if ($request->get('submitAction') == 'Enregistrer')
        {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
            {

                if (null !== $article->getImageUrl()){
                    $this->handleImage($article);
                } else {
                    $article->setImageUrl($imageBackUp);
                }
                $article->setDate(new \DateTime);
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('admin_article');
            }
        }
        return $this->render('Blog/article_edit.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/admin/article/remove/{id}", name="article_remove", requirements={"id": "\d+"})
     */
    public function articleRemoveAction(Article $article){

        $webPath = $this->webRoot = realpath($this->get('kernel')->getRootDir() . '/../web');
        unlink($webPath."/".$article->getImageUrl());

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('admin_article');
    }

}