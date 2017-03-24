<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController extends Controller
{
    public function contactAction()
    {
        return $this->render('Contact/contact.html.twig');
    }
}