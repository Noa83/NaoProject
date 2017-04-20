<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RechercheController extends Controller
{
    /**
     *@Route("/resultat", name="resultat")
     */
    public function resultatAction()
    {
        return $this->render('Recherche/resultatRecherche.html.twig');
    }
}