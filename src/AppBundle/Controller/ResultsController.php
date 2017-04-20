<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ResultsController extends Controller
{
    /**
     * @Route("/results", name="results")
     */
    public function resultsAction()
    {
        return $this->render('Results/results.html.twig');
    }
}