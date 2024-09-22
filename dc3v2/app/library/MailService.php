<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;
require "sendgrid-php/sendgrid-php.php";

/**
 *
 * Sends e-mails based on pre-defined templates
 */
class MailService extends Component
{
    /**
     * @param $name
     * @param $params
     * @param $mail
     * @return string
     */
    private $sendgrid;
    
    public $nombrecorreo='';

    function __construct() 
    {
        // $this->sendgrid = new SendGrid('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');
    }

    public function getTemplate()
    {
        //así podemos embeber una imagen en el email
      //  $mail->AddEmbeddedImage("img/logo.jpg", "logo", "logo.jpg");
        /*$parameters = array_merge(array(
            'publicUrl' => $this->config->application->publicUrl
            ), $params);
        return $this->view->getRender($this->config->email->templatesDir, $name, $parameters, function ($view) {
            $view->setRenderLevel(View::LEVEL_LAYOUT);
        });*/
        return $this->view->getRender('index','index');
        //return $view->getContent();
    }

    /**
     * [envia el correo electronico]
     * @param  [type] $to      [destinatario]
     * @param  [type] $subject [Asunto]
     * @param  [type] $text    [mensaje]
     * @return [type]          [description]
     */
    public function send($to,$subject,$text)
    {
        //obtenemos la instancia de PHPMAILER
        $email = new SendGrid\Email();             
        $email
        ->addTo($to)
        ->setFrom('@com.mx')
        ->setSubject($subject)
        ->setText("")
        ->setHtml($text);
        $this->sendgrid->send($email);
    }
}