<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 10/04/2017
 * Time: 09:25
 */

namespace AppBundle\Services;
use Symfony\Component\Templating\EngineInterface;


class ContactService
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating; //Pour pouvoir utiliser le render
    }

    public function sendContactMail($form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Demande d\'informations')
            ->setFrom($form->mail)
            ->setTo('contact@nosamislesoiseaux.eg2.fr')
            ->setContentType('text/html') //évite d'avoir du code html ds le mail

            ->setBody(
                $this->templating->render('Contact\mail.html.twig', array('formulaire' => $form))
            );

        $this->mailer->send($message);
    }

    public function sendResetMail($lien, $email)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Récupération de mot de passe Nos amis les oiseaux')
            ->setFrom('contact@nosamislesoiseaux.eg2.fr')
            ->setTo($email)
            ->setContentType('text/html')

            ->setBody('Vous avez demandé la modification de votre mot de passe. Pour reinitialiser votre mot de passe veuillez suivre 
            ce lien : '. '<a href="'.$lien.'">'.$lien.'</a>'. '<br/>Si vous n\'êtes pas à l\'origine de cette manipulation ignorez ce mail votre mot de passe restera 
            inchangé.');

        $this->mailer->send($message);
    }
}