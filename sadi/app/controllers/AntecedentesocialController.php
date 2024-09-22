<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class AntecedentesocialController extends ControllerBase
{
    public function ajax_get_detalleAction($id=0)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        // if($this->request->isAjax())
        // {
            $data = $this->request->getPost();
            $subs = Antecedentesocial::find(array(
                    'ese_id='.$id,
                    'ans_estatus=2'));
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
            $reg=new Antecedentesocial();
            $id=$reg->GuardarInformacion($data, $auth['id'],$permisocalificacion);
        

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó antecedente social al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Antecedente social";
                $databit['ese_id']= $id;
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


    public function guardar_formato_truperAction($ese_id){

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
            

            // return json_encode($data);
            $data['ese_id']=$ese_id;
            $reg=new Antecedentesocial();
            $respuesta_modelo=$reg->GuardarInformacionBieneInmuebles_FormatoTruper($data, $auth['id'],$permisocalificacion,$ese_id);
        

            if($respuesta_modelo['estado']==2)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó antecedente social al estudio con folio interno: ".$ese_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['ans_id'];
                $databit['bit_modulo']="Antecedente social";
                $databit['ese_id']= $ese_id;
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

    public function ajax_get_detalle_formato_truperAction($ese_id){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {

            $modelo_bie=new Bieninmueble();
            $modelo_ans=new Antecedentesocial();
    
            $respuesta_modelo_bie=$modelo_bie->crearAutomaticoOTraerExistente($ese_id);
            $respuesta_modelo_ans=$modelo_ans->econtrar_o_crear($ese_id);
            

            $answer['data_ans']=$respuesta_modelo_ans;
            $answer['data_bie']=$respuesta_modelo_bie;


            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }

    }
}
