<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';
require "mpdf/index.php";
// require 'guzzle/src/Client.php';
// use GuzzleHttp\Client;
class ApiController extends ControllerBase
{
    public function getimssinfoAction($can_id,$exc_id=0,$vac_id=0){
        $this->view->disable();
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();

        if(!$rol->verificar(15,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $configuracion=Configuracion::findFirstBycof_id(13);
        if($configuracion->cof_valor!=1){
            $answer[0]=-1;
            $answer[1]="El módulo de consulta de semanas cotizadas no esta disponible por el momento. Espere o consulte con un administrador.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $candidato=Candidato::findFirstBycan_id($can_id);
        $expedientecan=Expedientecan::findFirstByexc_id($exc_id);

        if($expedientecan->exc_apiimss!=0){
            $answer[0]=-1;
            $answer[1]="Las semanas cotizadas de este expediente ya fueron consultadas previamente.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $curp = mb_strtoupper($candidato->can_curp, "UTF-8");
        $pattern = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
        $validacionRegex = preg_match($pattern, $curp);
        if ($validacionRegex === 0) {
            $valida="El CURP ({$curp}) no cumple con la estructura válida. Revise el CURP e intente nuevamente.";
            $answer[0]=-1;
            $answer[1]=$valida;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $nss = mb_strtoupper($candidato->can_nosegsocial, "UTF-8");
        $patternnss = "/^(\d{2})(\d{2})(\d{2})\d{5}$/";
        $validacionRegexnss = preg_match($patternnss, $nss);
        if ($validacionRegexnss === 0) {
            $validanss="El número de seguro social {$nss} (NSS) no cumple con la estructura válida. Revise el NSS e intente nuevamente.";
            $answer[0]=-1;
            $answer[1]=$validanss;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $opciones = array(
            'http'=>array(
                'method'  => 'POST',
                'header'  => "Content-type: application/json\r\n" .
                            "Authorization: Basic c2lwc3JoOm05LlE4al8yNg==\r\n",
                'content' => '{
                    "curp": "'.$curp.'",
                    "nss": "'.$nss.'",
                    "url": "https://sadisips.com/sarape/apnubarcons/apnubarimsscons",
                    "documento": true
                }',
                'ignore_errors' => true
            )
          );
          
        $contexto = stream_context_create($opciones);
        // Abre el fichero usando las cabeceras HTTP establecidas arriba
        $fichero = file_get_contents('https://api.nubarium.com/imss/wh/v1/obtener_historial', true, $contexto);
        $json = json_decode($fichero,true);


        if(array_key_exists('codigoValidacion', $json)){
            $registro = new Imssapi();
            $registro->ims_estatus=2;
            $registro->ims_codigoValidacion=$json['codigoValidacion'];
            $registro->exc_id=$exc_id;
            $registro->vac_id=$vac_id;
            $registro->usu_id=$auth['id'];
            $registro->save();

            $expedientecan->exc_apiimss=1;
            $expedientecan->update();
            $auth = $this->session->get('auth');
            $data_bit=[
                'bit_descripcion'=>"Solicitó la descarga de las semanas cotizadas al expediente con clave: ".$exc_id,
                'bit_tablaid'=>$exc_id,
                'bit_modulo'=>"Semanas cotizadas",
                'vac_id'=>$vac_id,
                'bit_accion'=>1,
            ];
            $this->bitacora_registro($data_bit,$auth);

            $answer[0]=1;
            $answer[1]="Su petición esta siendo procesada. En caso de error se cargará un mensaje en comentarios del estudio.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $answer[0]=-1;
        $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (endea)";
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
        
    }

    public function pruebadescargaAction()
    {
        $url = 
        'https://consultaunica.mx/static/pdf/imss/SC_22169388794.pdf';
        
        // Use basename() function to return the base name of file
        $file_name = basename($url);
        
        // Use file_get_contents() function to get the file
        // from url and use file_put_contents() function to
        // save the file by using base name
        if (file_put_contents('archivos/'.$file_name, file_get_contents($url)))
        {
            echo "File downloaded successfully";
        }
        else
        {
            echo "File downloading failed.";
        }
    }

    public function getimssinfoCONSULTAUNICAAction($can_id,$exc_id=0,$vac_id=0){
        $this->view->disable();
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();

        if(!$rol->verificar(15,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $candidato=Candidato::findFirstBycan_id($can_id);
        $expedientecan=Expedientecan::findFirstByexc_id($exc_id);

        if($expedientecan->exc_apiimss!=0){
            $answer[0]=-1;
            $answer[1]="Las semanas cotizadas de este estudio ya fueron consultadas previamente.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $curp = mb_strtoupper($candidato->can_curp, "UTF-8");
        $pattern = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
        $validacionRegex = preg_match($pattern, $curp);
        if ($validacionRegex === 0) {
            $valida="El CURP ({$curp}) no cumple con la estructura válida. Revise el CURP e intente nuevamente.";
            $answer[0]=-1;
            $answer[1]=$valida;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $nss = mb_strtoupper($candidato->can_nosegsocial, "UTF-8");
        $patternnss = "/^(\d{2})(\d{2})(\d{2})\d{5}$/";
        $validacionRegexnss = preg_match($patternnss, $nss);
        if ($validacionRegexnss === 0) {
            $validanss="El número de seguro social {$nss} (NSS) no cumple con la estructura válida. Revise el NSS e intente nuevamente.";
            $answer[0]=-1;
            $answer[1]=$validanss;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $opciones = array(
            'http'=>array(
                'method'  => 'POST',
                'header'  => "Content-type: application/json\r\n" .
                            "X-API-KEY: 0f60ef412edf50195a130ace7a3472878a0eceaac00295a9\r\n",
                'content' => '{
                    "type": "sc",
                    "vdSc": {
                        "curp": "'.$curp.'",
                        "nss": "'.$nss.'"
                    },
                    "userEmail": "jesus@sips.mx"
                }',
                'ignore_errors' => true
            )
          );
          
        $contexto = stream_context_create($opciones);
        // Abre el fichero usando las cabeceras HTTP establecidas arriba
        $fichero = file_get_contents('https://consultaunica.mx/api/v2/imss?_v=2', true, $contexto);
        $json = json_decode($fichero,true);
        // echo $curp." ".$nss;
        // var_dump($json);
        // return false;


        if(array_key_exists('message', $json)){
            $answer[0]=-1;
            $answer[1]=json_encode($json['message']);
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $ruta = 'archivosexc/'.$exc_id.'/'; 
         // Validar si la carpeta no existe y luego crearla
         if (!file_exists($ruta)) {
            if (!mkdir($ruta, 0777, true)) {
                error_log("No se pudo crear la ruta de archivo");
            } 
        }

        if(array_key_exists('document', $json)){
            $file_name = basename($json['document']);
            $date= new DateTime();
            if (file_put_contents($ruta.$date->format('Y-m-d-H-i-s').'-'.$file_name, file_get_contents($json['document'])))
            {
                $documento= new Archivo();
                // echo "File downloaded successfully";
                $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
                $data1['arc_estatus']=2;
                $data1['exc_id']=$exc_id;
                $data1['cat_id']=4;
                    // $data['pol_archivo']=$a;
                if($documento->NuevoRegistro($data1)==true)
                {   
                    $expedientecan->exc_apiimss=1;
                    $expedientecan->update();

                    $auth = $this->session->get('auth');
                    $data_bit=[
                        'bit_descripcion'=>"Descargó las semanas cotizadas. Archivo: ".$data1['arc_nombre']." al expediente con clave ".$exc_id,
                        'bit_tablaid'=>$exc_id,
                        'bit_modulo'=>"Semanas cotizadas",
                        'vac_id'=>$vac_id,
                        'bit_accion'=>1,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $answer[0]=1;
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
            }
            else
            {
                $answer[0]=-1;
                $answer[1]="Ocurrió un error inesperado al descargar el archivo de semanas cotizadas.";
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
            $answer[0]=-1;
            $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (nofnd)";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $answer[0]=-1;
        $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (endea)";
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
        
    }   
}