<?php

namespace UsersBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 *  
 */
class Mailer extends Controller {

    private $mailer;
    private $templating;
    private $subject;
    private $body;
    private $from;
    private $to;
    private $url;

    public function __construct($mailer, EngineInterface $templating) {
        $this->mailer = $mailer;
        $this->templating = $templating;
        //$this->router=$router;
    }

    //var_dump($user); die;
    public function userMailConfirm($user, $password) {

        //$url = $this->generateUrl('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), UrlGeneratorInterface::ABSOLUTE_URL);
        $this->subject = sprintf('Bienvenu(e) %s', $user->getNom());
        $this->from = array('pgpadmin@perequaci.com' => 'ADMINISTRATEUR PgP');
        $this->to = $user->getEmail();
        $this->doTemplate('UsersBundle:Mail:userMailConfirm.html.twig', array(
            'user' => $user,
            'password' => $password,
        ));

        $this->send();
        //die;
    }

    private function doTemplate($template, array $options) {
        $this->body = $this->templating->render($template, $options);
    }

    public function send() {

        $message = \Swift_Message::newInstance()
                ->setSubject($this->subject)
                ->setFrom($this->from)
                ->setTo($this->to)
                ->setBody($this->body, 'text/html')
        ;
        $this->mailer->send($message);
    }

}
