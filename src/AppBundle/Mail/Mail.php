<?php
namespace AppBundle\Mail;

use Symfony\Component\Templating\EngineInterface;

class Mail
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating; //Pour pouvoir utiliser le render
    }

    public function mail($form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Demande d\'informations')
            ->setFrom('gont.bruno@gmail.com')
            ->setTo('gont.bruno@gmail.com')
            ->setContentType('text/html') //évite d'avoir du code html ds le mail

            ->setBody(
                $this->templating->render('Contact\mail.html.twig', array('formulaire' => $form))
            );

        $this->mailer->send($message);
    }
}