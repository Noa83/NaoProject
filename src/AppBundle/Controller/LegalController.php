<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LegalController extends Controller
{
    public function legalAction()
    {
        return $this->render('Legal/legal.html.twig');
    }
}