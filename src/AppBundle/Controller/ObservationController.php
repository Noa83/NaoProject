<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ObservationController extends Controller
{
    public function observationAction()
    {
        return $this->render('Observation/observation.html.twig');
    }
}