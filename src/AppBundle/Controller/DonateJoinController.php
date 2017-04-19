<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DonateJoinController extends Controller
{
    public function donateJoinAction()
    {
        return $this->render('Assoc/donate_join.html.twig');
    }
}