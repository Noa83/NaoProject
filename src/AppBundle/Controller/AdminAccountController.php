<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminAccountController extends Controller
{
    public function adminAccountAction()
    {
        return $this->render('AdminAccount/adminAccount.html.twig');
    }
}