<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('Account/login.html.twig');
    }
}