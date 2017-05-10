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
            //clé privée
            $secret = "6Ld8nR8UAAAAAHm5kF4EO5Or1TjpUyjX1khWHPPK";
            //Paramètre renvoyé par le recaptcha
            $response = $_POST['g-recaptcha-response'];
            //On récupère l'IP de l'utilisateur
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret
                . "&response=" . $response
                . "&remoteip=" . $remoteip ;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == true)
            {
                // C'est un humain
                $this->get('mail')->sendContactMail($formulaireContact);
                $request->getSession()->getFlashBag()->add('info', 'Votre mail a bien été envoyé.');
                return $this->redirectToRoute('contact');
            }
            else
            {
                // C'est un robot ou le code de vérification est incorrecte
                $request->getSession()->getFlashBag()->add('info', 'Votre mail n\' a pas été envoyé. Pensez bien à cocher la case je ne suis pas un robot.');
                return $this->redirectToRoute('contact');
            }
        }
        return $this->render('Contact/contact.html.twig', array('form' => $form->createView()));
    }
}
