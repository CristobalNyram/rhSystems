<?php

use Phalcon\Mvc\User\Component,Phalcon\Mvc\View;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
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
 
    public $notificacion_candidato='
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body style="font-family:sans-serif; margin: 0; padding-top: 60px; padding-bottom: 60px; background-color: #f2f2f2;">
        <table  align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-collapse: collapse; width: 80%; max-width: 600px; margin: auto;background:#0c3164">
            <tr style="background:#0c3164 ;">
                <td style="color: #666; font-size: 14px; background:#0c3164 ; line-height: 20px; text-align: center; padding: 10px;">
                    <img src="cid:logo" alt="SIPS RH - SARAPE " style="max-width: 20%;">
                </td>
            </tr>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-collapse: collapse; width: 80%; max-width: 600px; margin: auto;">
            <tr>
                <td style="color: #00094d; font-size: 18px; line-height: 24px; padding: 30px; text-align: justify;">
                    <p style="font-size: 22px; color: #00094d; line-height: 30px; margin-bottom: 30px;">Buen día #nombre_candidato#</p>
                    <p style="color: #00094d;">Esperamos que te encuentres bien. Queremos expresar nuestro agradecimiento por haber participado en nuestro proceso de selección para la vacante de <b>#nombre_vacante#</b>, y por el interés que mostraste.</p>
                    <p style="color: #00094d;">Te informamos que no has quedado seleccionado para esta vacante.</p>
                    <p style="color: #00094d;">Queremos que sepas que esta elección no es un reflejo de tus habilidades o méritos personales. Valoramos enormemente el tiempo y esfuerzo que has invertido. Reconocemos tu potencial, por lo que nos gustaría mantener tu información en nuestro sistema para futuras ofertas laborales que puedan surgir con otros clientes.</p>
                    <p style="color: #00094d;" >Quedamos a tu disposición, saludos.</p>
                    <p style="color: #00094d ;">Número de autorización y registro: STPS-ACT-SER-21-00099</p>
                </td>
            </tr>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-collapse: collapse; width: 80%; max-width: 600px; margin: auto; margin-bottom:20px;padding-bottom:20px;  border-top: 2px solid #fed27b;">
        <tr>
                        <td style="width: 50%; padding-right: 10px; color: #00094d;  font-size:9px; padding-left:15px; padding-top:5px; font-family: \'Montserrat\', sans-serif;">
                             <b style="font-weight: normal;font-family: \'Montserrat\', sans-serif; font-weight: bold;">Oficinas administrativas</b><br>
                           
                           

                            <a href="https://maps.app.goo.gl/oVBJKEyTFB8Shxgk6" style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;">  Piaxtla #6, 2do, piso esq. Zacapoaxtla
                            <br>
                            Col. La Paz C.P. 72160 Puebla</a>
                        </td>
                        <td style="text-align: right; width: 50%; padding-left: 10px; color: #00094d; font-size:9px; padding-right:15px; padding-top:5px; font-family: \'Montserrat\', sans-serif;">

                            <a href="https://facebook.com/SIPSRH" style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;font-weight: bold;" >  <img  width="10" height="10"  src="cid:logoFacebook" alt="Facebook"> SIPSRH </a>
                            <a href="https://twitter.com/rh_sips"  style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;font-weight: bold;"  ><img width="10" height="10"  src="cid:logoTwiter" alt="Twitter X ">SIPS</a>
                            <a href="https://www.linkedin.com/company/sips"  style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;font-weight: bold;" > <img  width="10" height="10"  src="cid:logoLinkedIn"  alt="LinkedIn">@rh_sips </a>
                                <br>
                                <a href="tel:+5222966585" style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;">Tel 22 22 96 65 85 </a>

                                |
                                <a href="mailto:informes@sips.mx" style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;">informes@sips.mx</a>
                                | <a href="http://www.sips.mx" style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;">www.sips.mx</a>
                        </td>
        </tr>
        </table>
        
     
    </body>
    </html>
    ';

    public $notificacion_facturacion = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body style="font-family:sans-serif; margin: 0; padding-top: 60px; padding-bottom: 60px; background-color: #f2f2f2;">
        <table  align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-collapse: collapse; width: 80%; max-width: 600px; margin: auto;background:#0c3164">
            <tr style="background:#0c3164 ;">
                <td style="color: #666; font-size: 14px; background:#0c3164 ; line-height: 20px; text-align: center; padding: 10px;">
                    <img src="cid:logo" alt="SIPS RH - SARAPE " style="max-width: 20%;">
                </td>
            </tr>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-collapse: collapse; width: 80%; max-width: 600px; margin: auto;">
            <tr>
                <td style="color: #00094d; font-size: 18px; line-height: 24px; padding: 30px;font-family: \'Montserrat\', sans-serif;">
                
                    <p style="font-family: \'Montserrat\', sans-serif;font-size: 22px; color: #00094d; line-height: 30px; margin-bottom: 30px;">
                    Confirmación de ingreso de vacante
                    </p>
                    <p style=" text-align: justify;font-family: \'Montserrat\', sans-serif;color: #00094d;">
                    Confirmo ingreso de la vacante ID #vac_id# para el puesto de #vac_nombre#, 
                    cubierta por el/la candidato(a) #can_nombre# (ID #exc_id#)#garantia_mensaje_inicial#.
                    </p>
                    <ul style="text-align: justify; font-family: \'Montserrat\', sans-serif;color: #00094d;">
                        <li style="text-align: justify;">Empresa: #emp_nombre#</li>
                        <li style="text-align: justify;">Datos fiscales: #datos_fiscales#</li>
                        <li style="text-align: justify;">Concepto de factura: #concepto_factura#</li>
                        <li style="text-align: justify;">Fecha: #fecha_facturacion#</li>
                        <li style="text-align: justify;">Sueldo: $#sueldo#</li>
                        <li style="text-align: justify;">Factor: #factor# %</li>
                        <li style="text-align: justify;">Costo del servicio: $#total_servicio# #costo_iva#</li>
                        <li style="text-align: justify;">Total de la factura: $#total_factura_pago#</li>
                    </ul>
                    <p style="font-size: 15px;  color: #00094d;"> <b style="font-weight: normal;font-family: \'Montserrat\', sans-serif; font-weight: bold;">Correo de la empresa</b><br>
                        <a href="mailto:#emp_correo#" style="color: #00094d; text-decoration: none;font-family: \'Montserrat\', sans-serif;">
                            #emp_correo#
                        </a>
                    </p>
                    <p style="text-align: justify;font-size: 15px; color: #00094d;"> <b style="font-weight: normal;font-family: \'Montserrat\', sans-serif; font-weight: bold;">
                        <b style="text-align: justify;font-weight: normal;font-family: \'Montserrat\', sans-serif; font-weight: bold;">Datos de contacto</b><br>
                        #emp_nombre_contacto#<br>
                        Teléfono:   #emp_telefono_contacto#
                    </p>
    
                </td>
            </tr>
    
    
            
        </table>
    </body>
    </html>';
    


    public function enviar_correo($destinatario="",$ccDestinatario=0, $contenido, $asunto, $mensaje, $config_id = 1,$logos_pie=1,$ccDestinatarioOculta="",$archivos_adjuntos=[])
    {


            $answer["estado"] = -2;
            $answer["mensaje"] = "error en enviar correo a " . $destinatario;

            try {
                $mail = new PHPMailer(true);
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $registro = Configcorreo::findFirstBycoc_id($config_id);
                
                if (trim($destinatario)=="") { $destinatario=$registro->coc_username; }
                if (trim($ccDestinatario)=="") { $ccDestinatario=$registro->coc_copia; }
                if (trim($ccDestinatarioOculta)=="") { $ccDestinatarioOculta=$registro->coc_copiaoculta; }
                
            
                $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER Enable verbose debug output 
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = $registro->coc_host; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = $registro->coc_username; // SMTP username
                $mail->Password = $registro->coc_password; // SMTP password
                $mail->SMTPSecure = $registro->coc_encriptacion; //  PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port = $registro->coc_puerto; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above , 587
                // Recipients
                $mail->setFrom($registro->coc_username, $registro->coc_nombreremitente);

                // $mail->addAddress($destinatario); // Add a recipien
                $destinatarios = array_map('trim', explode(',', $destinatario));
                foreach ($destinatarios as $dest) {
                    $mail->addAddress($dest);
                }
                $ccAddresses = array_map('trim', explode(',', $ccDestinatario));
                    if (count($ccAddresses) > 1) {
                        foreach ($ccAddresses as $ccAddress) {
                            $mail->addCC($ccAddress); 
                        }
                        
                    } else {
                        if (!empty($ccDestinatario)) {
                            $mail->addCC($ccDestinatario); 
                        }
                    }
               # $mail->addCC($ccDestinatario); // Copia normal (CC)
                 $ccAddresses = array_map('trim', explode(',', $ccDestinatario));
                    if (count($ccAddresses) > 1) {
                        foreach ($ccAddresses as $ccAddress) {
                            $mail->addCC($ccAddress); 
                        }
                        
                    } else {
                        if (!empty($ccDestinatario)) {
                            $mail->addCC($ccDestinatario); 
                        }
                    }

                $ccDestinatarioOcultaFinal = array_map('trim', explode(',', $ccDestinatarioOculta));

             
                if (count($ccAddresses) > 1) {
                    foreach ($ccDestinatarioOcultaFinal as $ccAddress) {
                        $mail->addBCC($ccAddress); 
                    }
                    
                } else {
                    if(!empty($ccDestinatarioOculta) && trim($ccDestinatarioOculta)!="") {
                        $mail->addBCC($ccDestinatarioOculta);
                    }
                }

                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $asunto;
                $mail->AddEmbeddedImage(realpath("assets/images/sistema/logo-w.png"), "logo");

                if (!empty($archivos_adjuntos)) {
                    foreach ($archivos_adjuntos as $archivo) {
                        $mail->addAttachment($archivo);
                    }
                }
           


                if ($logos_pie==1) {
                    $mail->AddEmbeddedImage(realpath("assets/images/sistema/logos/fb_logo_b.png"), "logoFacebook");
                    $mail->AddEmbeddedImage(realpath("assets/images/sistema/logos/tw_logo_b.png"), "logoTwiter");
                    $mail->AddEmbeddedImage(realpath("assets/images/sistema/logos/lknd_logo_b.png"), "logoLinkedIn");
                }
            

                // $mail->AddEmbeddedImage(realpath("assets/images/sistema/footerv8.jpg"), "footer");

                $mail->Body = $contenido;
                $mail->AltBody = $contenido;
                $mail->CharSet = 'UTF-8';
                $mail->Timeout = 600;
                $enviado = 0;
                if ($enviado == 0) {
                    if ($mail->send()) {
                        $answer["estado"] = 2;
                        $answer["mensaje"] = "OK";
                        $enviado++;
                    } else {
                        throw new Exception('Error en el envío del correo: ' . $mail->ErrorInfo);
                    }
                }
            } catch (Exception $e) {
                
                error_log('Exception caught send email : ' . $e->getMessage());
                $answer["estado"] = -2;
                $answer["mensaje"] = "Error en el envío del correo. Detalles: " . $e->getMessage();
            }

            return $answer;
    }

    public function contruirMaquetaCorreoFacturacionExp($vacante=[],$fecha_formateada_fat_registro,$ejecutivo,$vac_id){
        $answer=array();
        $archivos_adjuntos = array();
        $template="";
        $coc_id=2;
        $answer['titular']='AVISO';
        $answer['estado']=-2;
        $answer['mensaje']='Error al contruir elementos del correo.';
        $answer['template']='';
        $answer['archivos_adjuntos']='';
        $texto_iva="";
        $monto_iva=0;
        $total_factura_pago=00.00;
        $asunto="";
        $ccDestinatario = '';
        $garantia_mensaje_inicial = '';

        // error_log($vacante[0]->fat_id);
        $template=$this->notificacion_facturacion;

        switch ($vacante[0]->fat_vac_estatus) {
            case 5:
                $asunto="FACTURACIÓN GARANTÍA INGRESO ".trim($vacante[0]->emp_nombre);
                $garantia_mensaje_inicial =", que está cubriendo una GARANTÍA";

                break;
            default:
                $asunto="FACTURACIÓN INGRESO ".trim($vacante[0]->emp_nombre);

                break;
        }
        

        $template=str_replace("#vac_nombre#", $vacante[0]->cav_nombre, $template);
        $template=str_replace("#vac_id#", $vacante[0]->vac_id, $template);
        $template=str_replace("#garantia_mensaje_inicial#", trim($garantia_mensaje_inicial), $template);

        $template=str_replace("#exc_id#", $vacante[0]->exc_id, $template);
        $template=str_replace("#can_nombre#", $vacante[0]->can_nombre, $template);
        $template=str_replace("#concepto_factura#", 'Reclutamiento "'.$vacante[0]->cav_nombre.'"', $template);

        // error_log($vacante[0]->vac_id."-".$vacante[0]->cav_id);
        // die();
        $total_factura_pago= $vacante[0]->fat_montofacturar;

        if( $vacante[0]->fat_reqfactura==1){
            $monto_iva=$vacante[0]->fat_montofacturar * 0.16;
            $cantidad_iva = number_format($monto_iva, 2, '.', ',');
            $texto_iva="+ IVA ($".$cantidad_iva.")";

            $total_factura_pago= $total_factura_pago+$monto_iva;

        }else{
            $texto_iva="";
        }
        $total_factura_pago=number_format($total_factura_pago,2, '.', ',');
        $fat_sueldo= trim(number_format($vacante[0]->fat_sueldo,2, '.', ','));
        // error_log($total_factura_pago);
        // die();

        

        $template=str_replace("#costo_iva#", trim($texto_iva), $template);
        $template=str_replace("#emp_nombre#", trim($vacante[0]->emp_alias), $template);
        $template=str_replace("#sueldo#", $fat_sueldo, $template);
        $template=str_replace("#factor#", trim(number_format($vacante[0]->fat_factor,2)), $template);
        $template=str_replace("#fecha_facturacion#", trim($fecha_formateada_fat_registro), $template);
        $template=str_replace("#total_factor#", number_format($vacante[0]->fat_factor,2, '.', ','), $template);
        $template=str_replace("#total_servicio#", trim(number_format($vacante[0]->fat_montofacturar,2, '.', ',')), $template);
        $template=str_replace("#emp_correo#", trim($vacante[0]->cne_correo) , $template);
        $template=str_replace("#emp_telefono_contacto#", trim($vacante[0]->cne_tel), $template);
        $template=str_replace("#emp_nombre_contacto#", trim($vacante[0]->cne_nombre), $template);
        $template=str_replace("#total_factura_pago#",trim($total_factura_pago), $template);
        $template=str_replace("#datos_fiscales#",trim($vacante[0]->emp_nombre), $template);


          // $template = str_replace("#logo#", "assets/images/sistema/logo positivo.png", $header);
          // $asunto="FAT ".$vacante[0]->cav_nombre;

          //produccion
          $coc_registro = Configcorreo::findFirstBycoc_id($coc_id);
            if(!$coc_registro){
                $answer['titular']='AVISO';
                $answer['estado']=-1;
                $answer['mensaje']="Configuración del correo no fue encontrada...";
            return $answer; 
            }
          
          $destinatario= $coc_registro->coc_destinatario;
          // producción inicio



          if (isset($ejecutivo->usu_correo) && trim($ejecutivo->usu_correo) !== '') {
              $ccDestinatario .= $ejecutivo->usu_correo;
          }
          
          if (isset($coc_registro->coc_username) && trim($coc_registro->coc_username) !== '') {
              if ($ccDestinatario !== '') {
                  $ccDestinatario .= ',';
              }
              $ccDestinatario .= $coc_registro->coc_username;
          }
          
          if (isset($coc_registro->coc_copia) && trim($coc_registro->coc_copia) !== '') {
              if ($ccDestinatario !== '') {
                  $ccDestinatario .= ',';
              }
              $ccDestinatario .= $coc_registro->coc_copia;
          }
          //local inicio
             # $destinatario="marrinmarrin23@gmail.com";
              #$ccDestinatario="cristobal@sips.mx";
          //local fin

          // error_log($vac_id."-".$exc_id."-".$can_id);
          // die();
          // if ($destinatario == null && trim($destinatario) == '') { throw new Exception("El correo es vacio");}
          // if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)){throw new Exception("El correo del destinatario no cumple con el formato requerido de correo:".$destinatario."..."); }


          // VALIDACION DE ARCHIVO DE COTIZACION INICIO 
          $archivo_cotizacion = Archivovac::findFirst([
              'vac_id = :vac_id: AND arv_estatus=2 AND ctv_id = :ctv_id:',
              'bind' => [
                  'vac_id' => $vac_id,
                  'ctv_id' => 1,
              ]
          ]);
          
          if ($archivo_cotizacion instanceof Archivovac) {
              $archivo_cotizacion_nombre_url = "archivosvac/{$vac_id}/{$archivo_cotizacion->arv_nombre}";
          } else {
              $archivo_cotizacion_nombre_url = "archivosvac/no_disponible";
          }
                     
         if (!$archivo_cotizacion || !file_exists($archivo_cotizacion_nombre_url)) {
        //   $this->db->rollback();
          $answer['titular']='AVISO';
          $answer['estado']=-1;
          $answer['mensaje']='El archivo de cotización no está cargado.';
          return $answer;
         }


          $archivos_adjuntos = [
              realpath($archivo_cotizacion_nombre_url),
          ];
          // VALIDACION DE ARCHIVO DE COTIZACION FIN 
         
          $answer['template']=$template;
          $answer['archivos_adjuntos']=$archivos_adjuntos;
          $answer['destinatario']=$destinatario;
          $answer['ccDestinatario']=$ccDestinatario;
          $answer['asunto']=$asunto;

          $answer['coc_id']=$coc_id;
          $answer['titular']='OK';
          $answer['estado']=2;
          $answer['mensaje']='OK.';

        return $answer;
    }
    public function contruirMaquetaCorreoAgradecimientoCandidato($vacante,$candidato,$ejecutivo){
        $answer=array();
        $template="";
        $answer['titular']='AVISO';
        $answer['estado']=-2;
        $answer['mensaje']='Error al contruir elementos del correo.';
        $answer['template']='';
        $asunto="";
        $ccDestinatario = '';

        $template=$this->notificacion_candidato;
        $template=str_replace("#nombre_candidato#", $candidato->can_nombre, $template);
        $template=str_replace("#nombre_vacante#", $vacante[0]->cav_nombre, $template);
        // $template = str_replace("#logo#", "assets/images/sistema/logo positivo.png", $header);    

        $asunto="Seguimiento a tu proceso ".$vacante[0]->cav_nombre;

        //local
        #$destinatario="marrinmarrin23@gmail.com";
       # $ccDestinatario="cristobal@sips.mx";

        //produccion
        $destinatario=trim($candidato->can_correo);
        $ccDestinatario=trim($ejecutivo->usu_correo);

        if ($destinatario == null && trim($destinatario) == ''){
             $answer['titular']='AVISO';
             $answer['estado']=-1;
             $answer['mensaje']="El correo es vacio";
             return $answer;   
        }
    
        if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)){
             $answer['titular']='AVISO';
             $answer['estado']=-2;
             $answer['mensaje']="El correo del destinatario no cumple con el formato requerido de correo:".$destinatario."...";
             return $answer;   
        }
    
        $answer['template']=$template;
        $answer['destinatario']=$destinatario;
        $answer['ccDestinatario']=$ccDestinatario;
        $answer['asunto']=$asunto;
        $answer['titular']='OK';
        $answer['estado']=2;
        $answer['mensaje']='OK.';
        return $answer;
    }
   


   
}