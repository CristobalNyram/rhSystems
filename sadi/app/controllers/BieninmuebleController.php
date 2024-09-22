<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class BieninmuebleController extends ControllerBase
{
    public function crear_automaticoAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && is_numeric($ese_id))
        {
            $buscarEseId=Bieninmueble::findFirst(array(
                "ese_id = '$ese_id'",
                'bie_estatus=2'
            ));

            if($buscarEseId==false)
            {
                $nuevo_bie= new Bieninmueble();
                $nuevo_bie->bie_estatus=2;
                $nuevo_bie->ese_id=$ese_id;

                if($nuevo_bie->save())
                {
                    $answer[0]=2;
                    $answer['ese_id']=$ese_id;
                    $answer['bie_id']=$nuevo_bie->bie_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;   
                }
                else
                {
                    $answer[0]=0;
                    $answer['titulo']='ERROR';
                    $answer['mensaje']='Error al generar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;   

                }
            }
            else
            {
                $answer[0]=0;
                $answer['titulo']='ERROR';
                $answer['mensaje']='Error al generar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
           
        }

    }
    public function ajax_get_detalleAction($ese_id=0)
    {
        $this->view->disable();
        $result = [];

         if ($ese_id!=0 && is_numeric($ese_id)) {
                 $subs = Bieninmueble::findFirst(array(
                     'ese_id='.$ese_id,
                     'bie_estatus=2'));

                 if ($subs) {
                    $result = $subs->toArray();
                 }
         }
        
        return $this->response->setJsonContent($result);
    }
    public function ajax_set_updateAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
        {
            $data = $this->request->getPost();
           

            $bie_registro= Bieninmueble::findFirst(array(
                "ese_id = '$ese_id'",
                'bie_estatus=2',
            ));

                if($bie_registro)
                {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion=0;
                    if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisocalificacion=1;  
                    }
               
                   
                    $respuesta_modelo= $bie_registro->ActualizarRegistro($data,$permisocalificacion);


                            if( $respuesta_modelo['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de bienes inmuebles del registro con clave interna:'.$respuesta_modelo['bie_id'].' del estudio No. '.$respuesta_modelo['ese_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['bie_id'];
                                $databit['ese_id']=$respuesta_modelo['ese_id'];
                                $databit['bit_modulo']="Bienes inmuebles";
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$respuesta_modelo['ese_id'];
                                $answer['bie_id']=$respuesta_modelo['bie_id'];
                              
                               
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }
                            else
                            {
                                
                                $answer[0]=-2;
                                $answer['titular']='Error';
                                $answer['mensaje']='No se procesaron los datos correctamente.';
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }

                }
                else
                {
                    
                }
        }

        
    }
}