<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class DatofinalController extends ControllerBase
{
    public function ajax_get_detalleAction($id=0)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $data = $this->request->getPost();
        $subs = Datofinal::find(array(
                'ese_id='.$id,
                'daf_estatus=2'));
        $answer[2] = Estudio::findFirstByese_id($id);
        if(count($subs)>0)
        {  
            $answer[0]=1;
            $answer[1]=$subs[0];
        }
        else
            $answer[0]=0;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function guardarAction($id_ese){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $rol = new Rol();
            $permisocalificacion=0;

            if(!$rol->verificar(44,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            
            $data['ese_id']=$id_ese;
            $reg=new Datofinal();
            $id=$reg->GuardarInformacion($data, $auth['id']);

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó datos finales al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['ese_id']=$id_ese;
                $databit['bit_modulo']="Datos finales";
                $bitacora->NuevoRegistro($databit);
                $answer[0]=1;
            }
            else
                $answer[0]=0;
            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }


    public function guardar_formatotruperAction($id_ese){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $rol = new Rol();
            $permisocalificacion=0;

            if(!$rol->verificar(44,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            
            $data['ese_id']=$id_ese;
            $reg=new Datofinal();
            $id=$reg->GuardarInformacionFormatoTruper($data, $auth['id']);

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó datos finales al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['ese_id']=$id_ese;
                $databit['bit_modulo']="Datos finales";
                $bitacora->NuevoRegistro($databit);
                $answer[0]=1;
            }
            else
                $answer[0]=0;
            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
}
