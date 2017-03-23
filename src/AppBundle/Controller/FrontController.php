<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('Front/index.html.twig');
    }

    public function resultsAction()
    {
        return $this->render('Front/results.html.twig');
    }

    public function contactAction()
    {
        return $this->render('Front/contact.html.twig');
    }

    public function donateAction()
    {
        return $this->render('Front/donate.html.twig');
    }

    public function legalAction()
    {
        return $this->render('Front/legal.html.twig');
    }
}