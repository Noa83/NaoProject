<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DonateController extends Controller
{
    public function donateAction()
    {
        return $this->render('Assoc/donate.html.twig');
    }
}