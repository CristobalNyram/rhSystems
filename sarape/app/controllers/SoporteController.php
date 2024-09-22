<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Query;
use Phalcon\Di;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class SoporteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Soporte');
        parent::initialize();
    }

    private function __getTipoSesionRedireccionarCerrarSesion(){


        $auth = $this->session->get('auth');

        if(array_key_exists('autoestudio',$auth)){

          return  $this->url->get('autoestudio/index');
        }else{
          return  $this->url->get('');

        }
    }

    public function verificasesionAction()
    {
        
        $this->view->disable();
        $answer=array();
        $auth = $this->session->get('auth');
        // $answer['url_actual']=$this->request->getURI();

        if($auth){
            $answer['estado']=1;

        }else{
            $answer['estado']=0;

        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

   
    
    public function limpiarcachevoltAction(){


        $auth = $this->session->get('auth');
        if(!$rol->verificar(83,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }
        $this->setCacheLimipia();
        ///bitacora inicio
           $auth = $this->session->get('auth');
           $bitacora= new Bitacora();
           $databit['bit_descripcion']= 'Limpio cache de todo el sistema';
           $databit['usu_id']=$auth['id'];
           $databit['bit_tablaid']=0;
           $databit['bit_modulo']="Limpiar cache (Soporte)";
           $bitacora->NuevoRegistro($databit);
        //bitacora fin
    }
}