<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminDashboardController extends Controller
{
    public function adminDashboardAction()
    {
        return $this->render('AdminAccount/adminDashboard.html.twig');
    }
}