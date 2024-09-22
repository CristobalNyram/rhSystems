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
    public function getimssinfoAction($id){
        $this->view->disable();
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();

        if(!$rol->verificar(58,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $configuracion=Configuracion::findFirstBycof_id(16);
        if($configuracion->cof_valor!=1){
            $answer[0]=-1;
            $answer[1]="El módulo de consulta de semanas cotizadas no esta disponible por el momento. Espere o consulte con un administrador.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $estudio=Estudio::findFirstByese_id($id);

        if($estudio->ese_apiimss!=0){
            $answer[0]=-1;
            $answer[1]="Las semanas cotizadas de este estudio ya fueron consultadas previamente.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $curp = mb_strtoupper($estudio->ese_curp, "UTF-8");
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

        $nss = mb_strtoupper($estudio->ese_nss, "UTF-8");
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
                    "url": "https://sadisips.com/sadi/apnubarcons/apnubarimsscons",
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
            $registro->ese_id=$id;
            $registro->usu_id=$auth['id'];
            $registro->save();

            $estudio->ese_apiimss=1;
            $estudio->save();
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Solicitó la descarga de las semanas cotizadas del estudio con id: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Semanas cotizadas";
            $databit['ese_id']= $id;
            $bitacora->NuevoRegistro($databit);

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

    public function leerjsonAction()
    {
        // $respuesta='{"document": "https://consultaunica.mx/static/pdf/imss/SC_22169388794.pdf", "quotedWeeksInfo": {"quotedWeeksRecords": [{"employerName": "SIPS ESPECIALISTAS EN RECURSOS HUMANOS", "employerRegistry": "Y463388210", "startDate": "2020-01-02", "endDate": null, "salary": "565.22", "employerEntity": "PUEBLA"}], "quotedWeeks": 164}}';
        
        $respuesta='{"message": "Solo puede consultar 2 veces al día sus semanas cotizadas"}';    
        
        $resultado= json_decode($respuesta);
         echo $resultado->message;
        // echo $resultado->document;
    }

    public function pdftoimgAction(){
        // $im = new Imagick();
        // $im->setResolution(300, 300);     //set the resolution of the resulting jpg
        // $im->readImage($_SERVER['DOCUMENT_ROOT'] .'/sips/sadi/public/archivos/2022-09-12-16-36-19-datatablesexample-fileexport.pdf[0]');    //[0] for the first page
        
        // // $im=$im->flattenImages();
        // $im->writeImages('prueba.jpg');
        // $im->setImageFormat('jpg');
        // header('Content-Type: image/jpg');
        // echo $im;

        //         $imagick = new Imagick();

        // $imagick->readImage($_SERVER['DOCUMENT_ROOT'] .'/sips/sadi/public/archivos/2022-09-12-16-36-19-datatablesexample-fileexport.pdf[0]');

        // $imagick->writeImage('page_one.jpg');

        // $pdf=$_SERVER['DOCUMENT_ROOT'] .'/sips/sadi/public/archivos/2022-09-12-16-36-19-datatablesexample-fileexport.pdf';
        // $imagen= "imagen.jpg";

        // exec('/usr/local/bin/convert "'.$pdf.'" -colorspace RGB -res);

        // echo $response ? "PDF con" : "PDF error";


        
        // $img->setImageFormat('jpg');
        // $img->writeImage($savepath);
        // echo "<img src='temp/$filename.jpg' />";

        // exec("convert ". $_SERVER['DOCUMENT_ROOT'].'/sips/sadi/public/archivos/2022-09-12-16-36-19-datatablesexample-fileexport.pdf'. $_SERVER['DOCUMENT_ROOT'].'/sips/sadi/public/archivos/'."image.jpg");
        // echo 'image-0.jpg';

        // $pdf = 'archivos/2022-09-12-16-36-19-datatablesexample-fileexport.pdf';

        // $img = 'archivos/2022-09-12-16-36-19-datatablesexample-fileexport';
        // $info = pathinfo($pdf);
        // $file_name =  basename($pdf,'.'.$info['extension']);
        // echo $info['extension'];
        // // $pdf = "filename.pdf[0]";
        // exec("convert $pdf $img.jpg"); 

        $sh= shell_exec('/usr/local/bin/gs \
        -o /repaired_pdf/' .  $new_file_name . '\
        -sDEVICE=pdfwrite \
        -dPDFSETTINGS=/prepress \
        ' . $file_to_read);
    }

    public function getimssinfoCONSULTAUNICAAction($id){ //FUNCIÓN QUE SE OCUPABA CON CONSULTA UNICA
        $this->view->disable();
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();

        if(!$rol->verificar(58,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $estudio=Estudio::findFirstByese_id($id);

        if($estudio->ese_apiimss!=0){
            $answer[0]=-1;
            $answer[1]="Las semanas cotizadas de este estudio ya fueron consultadas previamente.";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $curp = mb_strtoupper($estudio->ese_curp, "UTF-8");
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

        $nss = mb_strtoupper($estudio->ese_nss, "UTF-8");
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

        if(array_key_exists('document', $json)){
            $file_name = basename($json['document']);
            $date= new DateTime();
            if (file_put_contents('archivos/'.$date->format('Y-m-d-H-i-s').'-'.$file_name, file_get_contents($json['document'])))
            {
                $documento= new Archivo();
                // echo "File downloaded successfully";
                $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
                $data1['arc_estatus']=2;
                $data1['ese_id']=$id;
                $data1['cat_id']=15;
                    // $data['pol_archivo']=$a;
                if($documento->NuevoRegistro($data1)==true)
                {   
                    $estudio->ese_apiimss=1;
                    $estudio->save();
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Descargó las semanas cotizadas. Archivo: ".$data1['arc_nombre']." al estudio con clave ".$id;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$id;
                    $databit['bit_modulo']="Semanas cotizadas";
                    $databit['ese_id']= $id;
                    $bitacora->NuevoRegistro($databit);

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