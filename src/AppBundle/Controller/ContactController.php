<?php

namespace AppBundle\Controller;


use AppBundle\Model\ContactModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\ContactType;


class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $formulaireContact = new ContactModel();

        $form = $this->get('form.factory')->create(ContactType::class, $formulaireContact);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->get('mail')->sendContactMail($formulaireContact);
            return $this->redirectToRoute('contact');
        }

        return $this->render('Contact/contact.html.twig', array('form' => $form->createView()));
    }
}
