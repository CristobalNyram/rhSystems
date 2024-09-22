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
    public $notificaasiginves='
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            </head>
            <body style="font-family: Source Sans Pro, sans-serif;margin: 0; padding-top:60px; padding-bottom:60px" bgcolor="#f2f2f2">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#FFFFFF" style="border-collapse: collapse;">
                    <tr>
                        <td style="color: #666; font-family: Source Sans Pro, sans-serif; font-size: 30px; line-height: 34px;padding:50px; align:center">
                            <p style="font-size:16px;color:#777777; line-height: 23px">Envio de la información para realizar la investigación ID SADI: #id#</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >NOMBRE DEL CANDIDATO: </b>#nombre#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >EMPRESA: </b>#empresa#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px"><b >DIRECCIÓN. </b></p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >ESTADO: </b>#estado#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >MUNICIPIO: </b>#municipio#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >COLONIA: </b>#colonia#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >CALLE: </b>#calle#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b >NÚMERO: </b>#numero#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b>TELÉFONO: </b>#telefono#.</p>
                            <p style="font-size:16px;color:#777777; line-height: 23px; margin: 0px"><b>CELULAR: </b>#celular#.</p>
                            <br>
                            <p style="font-size:16px;color:#777777; line-height: 23px; text-align:justify; margin: 0px"><b style="font-size: 12px;"> FAVOR DE REVISAR EL PORTAL SADI PARA MAYOR INFORMACIÓN O CONTACTAR CON ALMA REYES Y/0 AURORA COYOPOL PARA MAYOR DETALLE DE LA INVESTIGACIÓN.</b></p>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
    ';
    public function enviarprueba($destinatario,$asunto,$mensaje)
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
            $registro=Configcorreo::findFirstBycoc_id(1);
            $mail->SMTPDebug = 4;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $registro->coc_host;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $registro->coc_username;                     // SMTP username
            $mail->Password   = $registro->coc_password;                               // SMTP password
            $mail->SMTPSecure = $registro->coc_encriptacion;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $registro->coc_puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587
            
            //Recipients
            $mail->setFrom($registro->coc_username, $registro->coc_nombreremitente);
            $mail->addAddress($destinatario);     // Add a recipient
            // $mail->addBCC($this->username);

            $contenido=$mensaje;
            // $contenido=str_replace("#mensaje#",nl2br($mensaje),$contenido);
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $contenido;
            $mail->AltBody = $contenido;
            $mail->CharSet = 'UTF-8';
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }
            

            // $correo= new Correo();
            // $data['cor_asunto']= $asunto;
            // $data['cor_mensaje']= $mensaje;
            // $data['cor_remitente']=$this->username;
            // $data['cor_destinatario']=$consulta[0]->cli_correo;
            // $data['usu_id']=$usu_id;
            // $correo->NuevoRegistro($data);
            return 1;
            // echo 'Correo enviado';
        } catch (Exception $e) {
            // return 0;
            echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }

    public function enviarhonorario($archivo,$asunto,$mensaje,$nombre_destinatario, $correo_destinatario,$usu_id)
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
            $registro=Configcorreo::findFirstBycoc_id(1);
            $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $registro->coc_host;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $registro->coc_username;                     // SMTP username
            $mail->Password   = $registro->coc_password;                               // SMTP password
            $mail->SMTPSecure = $registro->coc_encriptacion;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $registro->coc_puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587
            
            //Recipients
            $mail->setFrom($registro->coc_username, $registro->coc_nombreremitente);
            $mail->addAttachment(realpath("reporte/honorarios/".$archivo)); 
            
            //Recipients
            $mail->addAddress($correo_destinatario, $nombre_destinatario);     // Add a recipient
            $mail->addCC($registro->coc_username);


            $contenido=$mensaje;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $contenido;
            $mail->AltBody = $contenido;
            $mail->CharSet = 'UTF-8';
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }
            
            return 1;
            // echo 'Correo enviado';
        } catch (Exception $e) {
            return 0;
            // echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }
    
    public function notificarasignacioninv($nombre_destinatario, $correo_destinatario, $mensaje)
    {
        $asunto='Notificación de asignación SADI';
        $contenido='Se le ha asignado un estudio.';

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
            $registro=Configcorreo::findFirstBycoc_id(2);
            $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $registro->coc_host;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $registro->coc_username;                     // SMTP username
            $mail->Password   = $registro->coc_password;                               // SMTP password
            $mail->SMTPSecure = $registro->coc_encriptacion;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $registro->coc_puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587
            
            //Recipients
            $mail->setFrom($registro->coc_username, $registro->coc_nombreremitente);
            
            //Recipients
            $mail->addAddress($correo_destinatario, $nombre_destinatario);     // Add a recipient
            $mail->addCC($registro->coc_username);

            $contenido=$mensaje;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $contenido;
            $mail->AltBody = $contenido;
            $mail->CharSet = 'UTF-8';
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }
            
            return 1;
            // echo 'Correo enviado';
        } catch (Exception $e) {
            return 0;
            // echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }

    public function enviarformatoese($nombre_destinatario, $correo_destinatario, $archivo, $nombrecandidato,$correo_destinatario_copias)
    {
        $asunto='ESTUDIO '. $nombrecandidato;
        $contenido='Buenas tardes.
        <br>
        <br>
        <br>
        Por medio del presente comparto el estudio solicitado. 
        <br>
        <br>
        Quedo atenta a cualquier duda o comentario.
        <br>
        Saludos.
        <br>
        <br>
        <br>
        <img alt="firma" src="cid:firmacorreo">
        ';

        if(trim($correo_destinatario_copias)!=''){
            $copias= explode(";", $correo_destinatario_copias);
        }
        else{
            $copias=[];
        }
        

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
            $registro=Configcorreo::findFirstBycoc_id(3);
            $mail->SMTPDebug = 0;                      //SMTP::DEBUG_SERVER Enable verbose debug output 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $registro->coc_host;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $registro->coc_username;                     // SMTP username
            $mail->Password   = $registro->coc_password;                               // SMTP password
            $mail->SMTPSecure = $registro->coc_encriptacion;          //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $registro->coc_puerto;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587
            
            //Recipients
            $mail->setFrom($registro->coc_username, $registro->coc_nombreremitente);
            
            //Recipients
            $mail->addAddress($correo_destinatario, $nombre_destinatario);     // Add a recipient
            $mail->addBCC($registro->coc_username);
            $mail->addAttachment(realpath("reporte/estudios/".$archivo));
            for($i=0; $i<count($copias);$i++){
                $mail->addCC($copias[$i]);
            }

            if(trim($registro->coc_copia)!=''){
                $copiasadm= explode(";", $registro->coc_copia);
            }
            else{
                $copiasadm=[];
            }
            for($i=0; $i<count($copiasadm);$i++){
                $mail->addCC($copiasadm[$i]);
            }

            // $contenido=$mensaje;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->AddEmbeddedImage(realpath("assets/images/small/firma.jpg"), "firmacorreo");
            $mail->Body    = $contenido;
            $mail->AltBody = $contenido;
            $mail->CharSet = 'UTF-8';
            $enviado=0;
            if ($enviado==0) {
                $mail->send();
                $enviado++;
            }
            
            return 1;
            // echo 'Correo enviado';
        } catch (Exception $e) {
            $bitacora= new Bitacora();
            $databit['bit_descripcion']=$mail->ErrorInfo;
            $databit['usu_id']=0;
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Error correo";
            $bitacora->NuevoRegistro($databit);
            return 0;
            // echo "Correo no enviado: {$mail->ErrorInfo}";
        }
    }
}