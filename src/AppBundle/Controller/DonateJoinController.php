<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DonateJoinController extends Controller
{
    /**
     * @Route("/contribution", name="donate_join")
     */
    public function donateJoinAction()
    {
        return $this->render('Assoc/donate_join.html.twig');
    }
}