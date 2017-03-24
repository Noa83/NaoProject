<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ResultsController extends Controller
{
    public function resultsAction()
    {
        return $this->render('Results/results.html.twig');
    }
}