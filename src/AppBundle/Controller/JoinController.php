<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class JoinController extends Controller
{
    /**
     * @Route("/join", name="join")
     */
    public function joinAction()
    {
        return $this->render('Assoc/join.html.twig');
    }
}