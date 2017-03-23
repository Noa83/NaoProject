<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BackController extends Controller
{
    public function observationAction()
    {
        return $this->render('Back/observation.html.twig');
    }

    public function accountAction()
    {
        return $this->render('Back/account.html.twig');
    }

    public function adminAccountAction()
    {
        return $this->render('Back/adminAccount.html.twig');
    }

    public function adminDashboardAction()
    {
        return $this->render('Back/adminDashboard.html.twig');
    }

    public function createAccountAction()
    {
        return $this->render('Back/createAccount.html.twig');
    }

    public function joinAction()
    {
        return $this->render('Back/join.html.twig');
    }
}