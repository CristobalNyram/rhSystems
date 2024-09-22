<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class DatoescolarController extends ControllerBase
{
    public function ajax_get_detalleAction($id=0)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        // if($this->request->isAjax())
        // {
            $data = $this->request->getPost();
            $subs = Datoescolar::find(array(
                    'ese_id='.$id,
                    'dae_estatus=2'));
            // $categoria = Datoescolar::findFirstByese_id($id);
            if(count($subs)>0)
            {  
                $answer[0]=1;
                $answer[1]=$subs[0];
            }
            else
                $answer[0]=0;
        // }
        // else
        //     $answer[0]=0;
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
            if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $permisocalificacion=1;  
            }
            
            $data['ese_id']=$id_ese;
            $reg=new Datoescolar();
            $id=$reg->GuardarInformacion($data, $auth['id'],$permisocalificacion);
        

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó datos escolares al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['ese_id']=$id_ese;
                $databit['bit_modulo']="Datos escolares";
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                // $answer[1]=$id;
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
    
    public function guardar_formato_gabtubosAction($id_ese){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $rol = new Rol();
            $permisocalificacion=0;
            if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $permisocalificacion=1;  
            }
            
            $data['ese_id']=$id_ese;
            $reg=new Datoescolar();
            $id=$reg->GuardarInformacion($data, $auth['id'],$permisocalificacion);
        

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó datos escolares al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['ese_id']=$id_ese;

                $databit['bit_modulo']="Datos escolares";
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                // $answer[1]=$id;
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

    public function ajax_get_data_selects_documentorecibidosAction(){
        $this->view->disable();
        $answer=[];
        if($this->request->isAjax()){
                                $modelo= new Datoescolar();
                                $answer['docrecibidos_data']=$modelo->docrecibidos_select_values;           
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
        }     
        else{
            return http_response_code(400);
        } 
    }

    public function guardar_formato_truperAction($id_ese){
        
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $rol = new Rol();
            $permisocalificacion=0;
            if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $permisocalificacion=1;  
            }
            
            $data['ese_id']=$id_ese;
            $reg=new Datoescolar();
            $id=$reg->GuardarInformacionFormatoTruper($data, $auth['id'],$permisocalificacion);
        

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó datos escolares al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['ese_id']=$id_ese;
                $databit['bit_modulo']="Datos escolares";
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                // $answer[1]=$id;
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
