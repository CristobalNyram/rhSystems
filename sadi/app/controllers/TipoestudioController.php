<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TipoestudioController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Tipo de estudio');
        parent::initialize();
    }

    public function indexAction()
    {

        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(19,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
           return;   
        }
        

    }
    
    public function guardarAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            
            if(($data['tipoestudio_transportemin']==$data['tipoestudio_transportemax']) || ($data['tipoestudio_transportemin']>=$data['tipoestudio_transportemax']))
            {
                $answer[0]=1;
                $answer['titular']='ERROR EN FECHAS';
                $answer['mensaje']='DATOS INCORRECTOS';

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
            else
            {
                $NuevoTipoEstuido = new Tipoestudio();

                $NuevoTipoEstuido->tip_nombre=$data['tipoestudio_nombre'];
                $NuevoTipoEstuido->tip_descripcion=$data['tipoestudio_descripcion'];
                $NuevoTipoEstuido->tip_honorario=$data['tipoestudio_honorario'];
                $NuevoTipoEstuido->tip_transportemin=$data['tipoestudio_transportemin'];
                $NuevoTipoEstuido->tip_transportemax=$data['tipoestudio_transportemax'];
                $NuevoTipoEstuido->tip_estatus=2;


                if( $NuevoTipoEstuido->save()===true)
                {
                    
                    $formularios=Formulario::find(array(
                        "for_estatus=2"
                        ));
                    $total =count($formularios);
              
                    $formulario_tipo_estudio= new formulariotipoest();

                    for ($i=0; $i < $total; $i++) { 
                        $formulario_tipo_estudio->tip_id=$NuevoTipoEstuido->tip_id;
                        $formulario_tipo_estudio->ftp_estatus= 2;
                        $formulario_tipo_estudio->for_id=$formularios[$i]->for_id;
                        $formulario_tipo_estudio->save();

                    }

                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Agregó un nuevo tipo de estudio: con ID '.$NuevoTipoEstuido->tip_id.' interno del sistema,el tipo de estudio tine por nombre "'.$NuevoTipoEstuido->tip_nombre.'"';
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$NuevoTipoEstuido->tip_id;
                    $databit['bit_modulo']="Tipo estudio";
                    $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                    
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se guardaron los datos correctamente';

                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;

           
                }
                else
                {
                    $answer[0]=1;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='Datos incorrectos';

                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;

                }
    
                


            }
         

            
        }
        else
        {
            $answer[0]=1;
            $answer['titular']='ERROR';
            $answer['mensaje']='Datos incorrectos';

            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }

    }

    public function tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(19,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
           return;   
        }
        

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $lista_tipo_estudio = Tipoestudio::find(array(
            "tip_estatus=2"
            ));
        
        $this->view->tips=$lista_tipo_estudio;

    }

    public function ajax_tiposestudiosAction()
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];

        $subs = Tipoestudio::find(array(
            "tip_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

}