<?php

namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

class ContactNotification{


    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderr;

    public function __construct(\Swift_Mailer $mailer, Environment $renderr)
    {
        $this->mailer = $mailer;
        $this->renderr = $renderr;
    }

    public function notify(Contact $contact){
        $message = (new \Swift_Message('Agence : ' .$contact->getProperty()->getTitle()))
            ->setFrom('noreply@agence.fr')
            ->setTo('contact@agence.fr')
            ->setBody($this->renderr->render('emails/contact.html.twig', [
                'contact' => $contact
            ]),'text/html');
        $this->mailer->send($message);
    }
}