<?php

namespace NAOSecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NAOSecurityController extends Controller
{
    public function indexAction()
    {
        return $this->render('NAOSecurityBundle:Default:index.html.twig');
    }
}
