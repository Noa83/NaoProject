<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserAdminDashboardType;
use AppBundle\Form\UserSearchType;
use AppBundle\Model\UserAccountModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminGestionArticleController extends Controller
{
    public function adminGestionArticleAction()
    {
        return $this->render('AdminAccount/adminGestionArticle.html.twig');
    }
}