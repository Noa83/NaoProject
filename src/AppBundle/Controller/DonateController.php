<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DonateController extends Controller
{

    /**
     * @Route("/donate", name="donate")
     */
    public function donateAction()
    {
        return $this->render('Assoc/donate.html.twig');
    }
}