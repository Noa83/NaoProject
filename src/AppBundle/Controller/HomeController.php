<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{
    /**
    * @Route("/", name="home_page")
    */
    public function indexAction()
    {
        $articlesTotal = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')->getArticlesForHomePage();

        return $this->render('Home/index.html.twig', array(
            'articlesTotal' =>$articlesTotal
        ));
    }


}