<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class JoinController extends Controller
{
    public function joinAction()
    {
        return $this->render('Assoc/join.html.twig');
    }
}