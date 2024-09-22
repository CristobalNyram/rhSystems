<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;
// require "sendgrid-php/sendgrid-php.php";
require "PHPMailer/PHPMailer/src/PHPMailer.php";
require "PHPMailer/PHPMailer/src/SMTP.php";
require "PHPMailer/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 *
 * Sends e-mails based on pre-defined templates
 */
class ServicioCorreo extends Component
{
    /**
     * @param $name
     * @param $params
     * @param $mail
     * @return string
     */
    // private $sendgrid;
    // private $host='secure.emailsrvr.com'; 

    // private $activarcopia=0; //si variable en 0 no mandar copia, si variable en 1 enviar copia
    // private $username='rh.administrativos@sercomex.com.mx';
    // private $password='4dm1n#6yhggFF+';
   private $host='sips.mx'; 

    private $activarcopia=0; //si variable en 0 no mandar copia, si variable en 1 enviar copia
    private $username='prueba@sips.mx';
    private $password='pMU1jI2I';

    // private $host=''; 

    // private $activarcopia=0; //si variable en 0 no mandar copia, si variable en 1 enviar copia
    // private $username='';
    // private $password='';
    // private $correocopia='';
    // private $nombrecopia='Luis Alfonso Manzanilla Dierdorf';

    // private $activarcopia=1; //si variable en 0 no mandar copia, si variable en 1 enviar copia
    
    // private $hostsoporte='';
    // private $usernamesoporte='';
    // private $passwordsoporte='';
    // private $nombreremitentesoporte='Soporte SIPSCAP';

    // private $username='';
    // private $password='';
    // private $correocopia='luismanzanilla@sips.mx';
    // private $nombrecopia='Luis Alfonso Manzanilla Dierdorf';
    // private $correocopia2='seguros@sips.mx';
    // private $nombrecopia2='Majo Manzanilla Bello';
    private $correocopia3='jesus@sips.mx';
    private $nombrecopia3='Jesús Javier Velásquez Aguilar';

    private $secure= PHPMailer::ENCRYPTION_STARTTLS;
    private $puerto= 587;
    private $nombreremitente='DEMO';

    
    public $nombrecorreo='';

    public $invitacion='
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
         <title>NOM 035</title>
        </head>
        <body style="font-family: Source Sans Pro, sans-serif; font-weight:300;margin: 0; padding-top:20px; padding-bottom:60px" bgcolor="#f2f2f2">
         <table align="center" border="0" cellpadding="0" cellspacing="0" width="750" bgcolor="#FFFFFF" style="border-collapse: collapse;">
          <tr>
           <td style="color: #666; font-family: Source Sans Pro, sans-serif; font-size: 18px; padding:15px 35px 7px;">
            <div style="text-align: justify; text-justify: inter-word;">
             <p>
              Buenas tardes:
              </p>
              <p>
              Por medio del presente agradecemos tu participación en contestar la Encuesta de Clima Laboral para conocer:
              </p>
              <p>La percepción de los colaboradores acerca de la empresa, del trabajo en ella, y de las relaciones internas.
              </p>
                <p>
                A identificar competencias laborales que representan un área de oportunidad para la empresa.
                </p>
                <p>
                Y proporcionar información precisa respecto la empresa para la planeación de la estrategia organizacional en SIPS.
                </p>
                <p>
                La encuesta se tratará con la total confidencialidad, por lo que siéntete con la confianza de responderlo de manera honesta. 
                </p>
                <p>
                Es importante responder la encuesta en un lugar tranquilo, evitando tener distractores. Por lo que te sugerimos responderlo en un espacio de tiempo que agendes con tu Jefe Inmediato. 
                </p>
              <p>
              La fecha límite para contestar la encuesta es el lunes 18 de Marzo.
              </p>
              <p>
              Para comenzar la encuesta, ingresa en la siguiente liga https://develop.sipscap.com/demonorma/principal/index y coloca tu número de folio.
             </p>
             <p>
              <b>Tu folio para poder contestar es: #folio#</b>
             </p>
             <br>
             <p>
              Atentamente
             </p>
             <p>
              <b>SIPS</b>
             </p>
             
             
            </div>
           </td>
          </tr>
         </table>
        </body>
    </html>
    ';
    
    // function __construct() 
    // {
    //     $this->sendgrid = new SendGrid('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');
    // }

    // public function getTemplate()
    // {
    //     //así podemos embeber una imagen en el email
    //   //  $mail->AddEmbeddedImage("img/logo.jpg", "logo", "logo.jpg");
    //     $parameters = array_merge(array(
    //         'publicUrl' => $this->config->application->publicUrl
    //         ), $params);
    //     return $this->view->getRender($this->config->email->templatesDir, $name, $parameters, function ($view) {
    //         $view->setRenderLevel(View::LEVEL_LAYOUT);
    //     });
    //     return $this->view->getRender('index','index');
    //     //return $view->getContent();
    // }

    /**
     * [envia el correo electronico]
     * @param  [type] $to      [destinatario]
     * @param  [type] $subject [Asunto]
     * @param  [type] $text    [mensaje]
     * @return [type]          [description]
     */
    public function enviarinvitacion($folio, $correo_destinatario, $correo_nombre)
    {
        $mail = new PHPMailer(true);

        $mail->SMTPOptions = array(
			'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			)
		);
		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = $this->host;               // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = $this->username;                     // SMTP username
		    $mail->Password   = $this->password;                               // SMTP password
		    $mail->SMTPSecure = $this->secure;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = $this->puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587

		    


		    // $adjuntos=Archivopol::query()
	     //        ->columns("arc_estatus, arc_adjuntar, arc_nombre")
	     //        ->where("pol_id=".$pol_id.' and arc_adjuntar=1 and arc_estatus=2')
      //       	->execute();

      //       for ($i=0; $i < count($adjuntos); $i++)
      //       {
      //       	$mail->addAttachment(realpath("polizas/".$adjuntos[$i]->arc_nombre)); 
      //       }


            // $consulta=Recibo::query()
            // ->columns("Recibo.rec_estatus, Recibo.rec_id, DATE_FORMAT(rec_fechapago,'%d/%m/%Y') as rec_fechapago, ase.ase_nombre, pol_num, rec_serierecibo, rec_serietotal, pol_endoso, rec_fechavigenciainicial, DATE_FORMAT(rec_fechavigenciainicial, '%Y') as vigencia_anio, DATE_FORMAT(rec_fechavigenciainicial, '%m') as vigencia_mes, DATE_FORMAT(rec_fechavigenciainicial, '%d') as vigencia_dia, DATE_FORMAT(rec_fechavigenciafinal,'%d/%m/%Y') as rec_fechavigenciafinal, CONCAT(cli_nombre, ' ', cli_primerapellido, ' ',cli_segundoapellido) as cli_nombre, cli_correo, rec_primaneta, rec_total, pol_descripcion, ase.ase_id, ase.ase_inicialgracia, m.mon_nombre")
            // ->join('Poliza','p.pol_id=Recibo.pol_id','p')
            // ->join('Aseguradora','ase.ase_id=p.ase_id','ase')
            // ->join('Cliente','c.cli_id=p.cli_id','c')
            // ->join('Moneda','m.mon_id=p.mon_id','m')
            // // ->join('Agente','age.age_id=p.age_id','age')
            // ->where("Recibo.rec_serierecibo=1 and Recibo.rec_estatus>0 and p.pol_id=".$pol_id)
            // ->execute();

            // $adjuntosrec=Archivorec::query()
            //     ->columns("arr_estatus, arr_adjuntar, arr_nombre")
            //     ->where("rec_id=".$consulta[0]->rec_id.' and arr_adjuntar=1 and arr_estatus=2')
            //     ->execute();

            // for ($i=0; $i < count($adjuntosrec); $i++)
            // {
            //     $mail->addAttachment(realpath("recibos/".$adjuntosrec[$i]->arr_nombre)); 
            // }

			// $limite=$this->sumDias($consulta[0]->rec_fechavigenciainicial,$consulta[0]->ase_inicialgracia);
			// $fecha= new Fecha();
	  //       $vigencia=utf8_decode($consulta[0]->vigencia_dia.' de '.$fecha->getMes($consulta[0]->vigencia_mes).' del '.$consulta[0]->vigencia_anio.".");
	  //       $dt= new DateTime($limite);
	  //       $limitetexto=utf8_decode($dt->format('d').' de '.$fecha->getMes($dt->format('m')).' del '.$dt->format('Y').".");
		    // Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    // Content
            // $serie=$consulta[0]->rec_serierecibo.'-'.$consulta[0]->rec_serietotal;

		    $mensaje=$this->invitacion;
	        // $mensaje=str_replace("#cliente#",$consulta[0]->cli_nombre,$mensaje);
         //    $mensaje=str_replace("#primaalcobro#",number_format($consulta[0]->rec_total, 2, '.', ',').' '.$consulta[0]->mon_nombre,$mensaje);
         //    $mensaje=str_replace("#vigencia#",$vigencia,$mensaje);
	        // $mensaje=str_replace("#fechalimite#",$limitetexto,$mensaje);
         //    $mensaje=str_replace("#serie#",$serie,$mensaje);
            $mensaje=str_replace("#folio#",$folio,$mensaje);
	        
	        //Recipients
		    $mail->setFrom($this->username, $this->nombreremitente);
		    $mail->addAddress($correo_destinatario, $correo_nombre);     // Add a recipient
		    $mail->addBCC($this->username);

		    //copia oculta
		    // if($this->activarcopia==1){
		    // 	$mail->addCC($this->correocopia,$this->nombrecopia);
      //           $mail->addCC($this->correocopia2,$this->nombrecopia2);
		    // }

            $asunto= 'CUESTIONARIO Clima Laboral';

		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $asunto;
		    // $mail->AddEmbeddedImage(realpath("images/recursos/firmacorreo.png"), "firmacorreo");
		    $mail->Body    = $mensaje;
		    $mail->AltBody = $mensaje;
		    $mail->CharSet = 'UTF-8';
		    // $mail->send();
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
                return 1;
            }

		    

		    // echo 'Correo enviado';
		} catch (Exception $e) {
		    echo "Correo no enviado: {$mail->ErrorInfo}";
		}
    }

    public function enviarrecibo($rec_id,$usu_id)
    {
        $mail = new PHPMailer(true);

        $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
        );
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $this->host;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $this->username;                     // SMTP username
            $mail->Password   = $this->password;                               // SMTP password
            $mail->SMTPSecure = $this->secure;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $this->puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587

            


            $adjuntos=Archivorec::query()
                ->columns("arr_estatus, arr_adjuntar, arr_nombre")
                ->where("rec_id=".$rec_id.' and arr_adjuntar=1 and arr_estatus=2')
                ->execute();

            for ($i=0; $i < count($adjuntos); $i++)
            {
                $mail->addAttachment(realpath("recibos/".$adjuntos[$i]->arr_nombre)); 
            }


            $consulta=Recibo::query()
            ->columns("Recibo.rec_estatus, Recibo.rec_id, DATE_FORMAT(rec_fechapago,'%d/%m/%Y') as rec_fechapago, ase.ase_nombre, pol_num, rec_serierecibo, rec_serietotal, pol_endoso, rec_fechavigenciainicial, DATE_FORMAT(rec_fechavigenciainicial, '%Y') as vigencia_anio, DATE_FORMAT(rec_fechavigenciainicial, '%m') as vigencia_mes, DATE_FORMAT(rec_fechavigenciainicial, '%d') as vigencia_dia, DATE_FORMAT(rec_fechavigenciafinal,'%d/%m/%Y') as rec_fechavigenciafinal, CONCAT(cli_nombre, ' ', cli_primerapellido, ' ',cli_segundoapellido) as cli_nombre, cli_correo, rec_primaneta, rec_total, pol_descripcion, ase.ase_id, ase.ase_inicialgracia, ase.ase_subgracia, p.med_id, m.mon_nombre,p.pol_id, Recibo.rec_fechalimitepago")
            ->join('Poliza','p.pol_id=Recibo.pol_id','p')
            ->join('Aseguradora','ase.ase_id=p.ase_id','ase')
            ->join('Cliente','c.cli_id=p.cli_id','c')
            ->join('Moneda','m.mon_id=p.mon_id','m')
            // ->join('Agente','age.age_id=p.age_id','age')
            ->where("Recibo.rec_estatus>0 and Recibo.rec_id=".$rec_id)
            ->execute();

            $mensaje=$this->recibo;

            $limitetexto='';
            $limite='';
            if($consulta[0]->med_id==1) //si domiciliada
            {
                if($consulta[0]->rec_serierecibo==1){
                    $mensaje=str_replace("#detallemedio#","Anexo encontrará su póliza y su recibo de primas del documento en mención para su revisión y para su control personal.",$mensaje);
                    $limite=$this->sumDias($consulta[0]->rec_fechavigenciainicial,$consulta[0]->ase_inicialgracia);
                }else{
                    $mensaje=str_replace("#detallemedio#","Anexo encontrará recibo subsecuente de la póliza en mención para su control personal.",$mensaje);
                    $limite=$this->sumDias($consulta[0]->rec_fechavigenciainicial,$consulta[0]->ase_subgracia);
                }
            }
            if($consulta[0]->med_id==2) //si agente
            {
                if($consulta[0]->rec_serierecibo==1){
                    $mensaje=str_replace("#detallemedio#","Anexo encontrará su póliza y su recibo de primas del documento en mención para su revisión y pago en el banco de su preferencia.",$mensaje);
                    $limite=$this->sumDias($consulta[0]->rec_fechavigenciainicial,$consulta[0]->ase_inicialgracia);
                }else{
                    $mensaje=str_replace("#detallemedio#","Anexo encontrará recibo subsecuente de la póliza en mención para pago en el banco de su preferencia.",$mensaje);
                    $limite=$this->sumDias($consulta[0]->rec_fechavigenciainicial,$consulta[0]->ase_subgracia);
                }
                
                
            }

            // $limite=$this->sumDias($consulta[0]->rec_fechavigenciainicial,$consulta[0]->ase_inicialgracia);
            // $limite=$consulta[0]->rec_fechalimitepago;
            $fecha= new Fecha();
            $vigencia=utf8_decode($consulta[0]->vigencia_dia.' de '.$fecha->getMes($consulta[0]->vigencia_mes).' del '.$consulta[0]->vigencia_anio.".");
            $dt= new DateTime($limite);
            $limitetexto="<b> Fecha límite de pago: ".utf8_decode($dt->format('d').' de '.$fecha->getMes($dt->format('m')).' del '.$dt->format('Y').".</b>");
            
            if($consulta[0]->rec_serierecibo==1){
                $adjuntospol=Archivopol::query()
                ->columns("arc_estatus, arc_adjuntar, arc_nombre")
                ->where("pol_id=".$consulta[0]->pol_id.' and arc_adjuntar=1 and arc_estatus=2')
                ->execute();

                for ($i=0; $i < count($adjuntospol); $i++)
                {
                    $mail->addAttachment(realpath("polizas/".$adjuntospol[$i]->arc_nombre)); 
                }
            }
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content


            $serie=$consulta[0]->rec_serierecibo.'-'.$consulta[0]->rec_serietotal;
            $mensaje=str_replace("#cliente#",$consulta[0]->cli_nombre,$mensaje);
            $mensaje=str_replace("#primaalcobro#",number_format($consulta[0]->rec_total, 2, '.', ',').' '.$consulta[0]->mon_nombre,$mensaje);
            $mensaje=str_replace("#vigencia#",$vigencia,$mensaje);
            $mensaje=str_replace("#fechalimite#",$limitetexto,$mensaje);
            $mensaje=str_replace("#serie#",$serie,$mensaje);
            $mensaje=str_replace("#descripcion#",$consulta[0]->pol_descripcion,$mensaje);
            
            //Recipients
            $mail->setFrom($this->username, $this->nombreremitente);
            $mail->addAddress($consulta[0]->cli_correo, $consulta[0]->cli_nombre);     // Add a recipient
            $mail->addBCC($this->username);

            //copia oculta
            if($this->activarcopia==1){
                $mail->addCC($this->correocopia,$this->nombrecopia);
                $mail->addCC($this->correocopia2,$this->nombrecopia2);
            }

            $asunto='';
            if($consulta[0]->rec_serierecibo==1){
                $asunto = 'PÓLIZA '.$consulta[0]->pol_num.' '.$consulta[0]->cli_nombre.' '.$consulta[0]->pol_descripcion.' '.$serie;
            }
            else
            {
                $asunto= 'RECIBO SUBSECUENTE '.$consulta[0]->pol_num.' '.$consulta[0]->cli_nombre.' '.$consulta[0]->pol_descripcion.' '.$serie;
            }
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->AddEmbeddedImage(realpath("images/recursos/firmacorreo.png"), "firmacorreo");
            $mail->Body    = $mensaje;
            $mail->AltBody = $mensaje;
            $mail->CharSet = 'UTF-8';
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }
            

            $correo= new Correo();
            $data['cor_asunto']= $asunto;
            $data['cor_remitente']=$this->username;
            $data['cor_destinatario']=$consulta[0]->cli_correo;
            $data['usu_id']=$usu_id;
            $correo->NuevoRegistro($data);
            return 1;
            // echo 'Correo enviado';
        } catch (Exception $e) {
            return 0;
            echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }

    public function porcobrar($mens,$bandera)
    {
        $mail = new PHPMailer(true);

        $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
        );
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $this->hostsoporte;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $this->usernamesoporte;                     // SMTP username
            $mail->Password   = $this->passwordsoporte;                               // SMTP password
            $mail->SMTPSecure = $this->secure;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $this->puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587

            

            $mensaje=$mens;            
            //Recipients
            $mail->setFrom($this->usernamesoporte, $this->nombreremitentesoporte);
            $mail->addAddress($this->username, $this->nombreremitente);     // Add a recipient
            // $mail->addAddress($this->correocopia3, $this->nombrecopia3);
            $mail->addBCC($this->correocopia3,$this->nombrecopia3);

            //copia oculta
            if($this->activarcopia==1){
                $mail->addCC($this->correocopia,$this->nombrecopia);
                $mail->addCC($this->correocopia2,$this->nombrecopia2);
            }

            $asunto= "Aviso de cobranza";

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            // $mail->AddEmbeddedImage(realpath("images/recursos/firmacorreo.png"), "firmacorreo");
            $mail->Body    = $mensaje;
            $mail->AltBody = $mensaje;
            $mail->CharSet = 'UTF-8';
            // $mail->send();
            if($bandera==1){
                $mail->addAttachment(realpath("reporte/cobranzapendiente.xlsx"));
            }
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }

            
        } catch (Exception $e) {
            echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }

    public function enviaraviso($rec_id,$asunto,$mensaje,$adjuntar=0,$usu_id)
    {
        $mail = new PHPMailer(true);

        $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
        );
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $this->host;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $this->username;                     // SMTP username
            $mail->Password   = $this->password;                               // SMTP password
            $mail->SMTPSecure = $this->secure;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $this->puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587

            

            if ($adjuntar!=0)
            {
                $mail->addAttachment(realpath("contrarecibo/contrarecibo".$rec_id.".pdf")); 
            }


            $consulta=Recibo::query()
            ->columns("CONCAT(cli_nombre, ' ', cli_primerapellido, ' ',cli_segundoapellido) as cli_nombre, cli_correo ")
            ->join('Poliza','p.pol_id=Recibo.pol_id','p')
            ->join('Cliente','c.cli_id=p.cli_id','c')
            ->where("Recibo.rec_id=".$rec_id)
            ->execute();

            // $mensaje=$contenido;
            
            //Recipients
            $mail->setFrom($this->username, $this->nombreremitente);
            $mail->addAddress($consulta[0]->cli_correo, $consulta[0]->cli_nombre);     // Add a recipient
            $mail->addBCC($this->username);

            //copia oculta
            if($this->activarcopia==1){
                $mail->addCC($this->correocopia,$this->nombrecopia);
                $mail->addCC($this->correocopia2,$this->nombrecopia2);
                // $mail->addCC($this->correocopia3,$this->nombrecopia3);
            }

            $contenido=$this->aviso;
            $contenido=str_replace("#mensaje#",nl2br($mensaje),$contenido);
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->AddEmbeddedImage(realpath("images/recursos/firmacorreo.png"), "firmacorreo");
            $mail->Body    = $contenido;
            $mail->AltBody = $contenido;
            $mail->CharSet = 'UTF-8';
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }
            

            $correo= new Correo();
            $data['cor_asunto']= $asunto;
            $data['cor_mensaje']= $mensaje;
            $data['cor_remitente']=$this->username;
            $data['cor_destinatario']=$consulta[0]->cli_correo;
            $data['usu_id']=$usu_id;
            $correo->NuevoRegistro($data);
            return 1;
            // echo 'Correo enviado';
        } catch (Exception $e) {
            return 0;
            echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }
}