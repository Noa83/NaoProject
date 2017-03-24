<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CreateAccountController extends Controller
{
    public function createAccountAction()
    {
        return $this->render('Account/createAccount.html.twig');
    }
}