<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AccountController extends Controller
{
    public function accountAction()
    {
        return $this->render('Account/account.html.twig');
    }
}