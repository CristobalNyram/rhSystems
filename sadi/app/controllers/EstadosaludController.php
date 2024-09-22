<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class EstadosaludController extends ControllerBase
{
    public function ajax_get_detalleAction($id=0)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        if($this->request->isAjax())
        // {
            $data = $this->request->getPost();
            $subs = Estadosalud::find(array(
                    'ese_id='.$id,
                    'ess_estatus=2'));
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
            $reg=new Estadosalud();
            $id=$reg->GuardarInformacion($data, $auth['id'],$permisocalificacion);
        

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó estado de salud al estudio con folio interno: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['ese_id']=$id_ese;
                $databit['bit_modulo']="Estado salud";
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

    public function ajax_get_detalle_ans_ess_formato_truperAction($ese_id){
        $answer=array();
        $answer[0]=0;
        $condicion='ese_id='.$ese_id.' and ess_estatus=2';
        $answer['estado']=-2;

        $this->view->disable();
 

        $modelo_estado_general_salud=new Estadosalud();
        $respues_modelo_ess=$modelo_estado_general_salud->econtrar_o_crear($ese_id);

        if($respues_modelo_ess['estado']==2)
        $answer['data_ess']=$respues_modelo_ess['data'];

  
        $modelo_antecedente_social=new Antecedentesocial();
        $respuesta_ans=$modelo_antecedente_social->econtrar_o_crear($ese_id);

            if($respuesta_ans['estado']==2)
            $answer['data_ans']=$respuesta_ans['data'];
            
        if($respuesta_ans['estado']==2 && $respues_modelo_ess['estado']==2){
            $answer['estado']=2;

        }
           
        $this->response->setJsonContent($answer);
        $this->response->send();

    }

    public function guardar_ess_anssAction($ese_id){
        $answer=array();
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
            
            $data['ese_id']=$ese_id;

            $reg=new Estadosalud();
            $respuesta_modelo_ess=$reg->GuardarInformacionFormatoTruper($data, $auth['id'],$permisocalificacion,$ese_id);

            $reg_ans=new Antecedentesocial();
            // $respuesta_modelo_ans=$reg_ans->econtrar_o_crear($ese_id);
            $data_ans=$data['ans'];
            $respuesta_modelo_ans=$reg_ans->GuardarInformacionFormatoTruper($data_ans, $auth['id'],$permisocalificacion,$ese_id);

            if($respuesta_modelo_ess['estado']==2 ){

                $answer['estado']='2';
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron correctamente los datos.';
                $answer['ese_id']=$ese_id;

                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó estado de salud al estudio con folio interno: ".$ese_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo_ess['ess_id'];
                $databit['ese_id']=$ese_id;
                $databit['bit_modulo']="Estado salud";
                $bitacora->NuevoRegistro($databit);

            }else{
                $answer['estado']='-2';
                $answer['titular']='Error';
                $answer['mensaje']='Error al procesar los datos.';
            }

           // $reg_anss=new Antecedentesocial();
           // $respuesta_modelo_anss=$reg_anss->GuardarInformacionFormatoTruper($data, $auth['id'],$permisocalificacion);
        



        }

        $this->response->setJsonContent($answer);
        $this->response->send();
        return;
        
      
    }

        
    
}
