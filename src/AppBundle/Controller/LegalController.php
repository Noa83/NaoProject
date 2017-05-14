<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LegalController extends Controller
{
    /**
     * @Route("/mentions_legales", name="legal_notice")
     */
    public function legalAction()
    {
        return $this->render('Legal/legal.html.twig');
    }
}