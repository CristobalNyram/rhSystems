<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class SeccionpersonalController extends ControllerBase
{
    public function crear_automaticoAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && is_numeric($ese_id))
        {
            $buscarEseId=Seccionpersonal::findFirst(array(
                "ese_id = '$ese_id'",
                'sep_estatus=2'
            ));

            if($buscarEseId==false)
            {
                $nuevo_sep= new Seccionpersonal();
                $nuevo_sep->sep_estatus=2;
                $nuevo_sep->ese_id=$ese_id;

                if($nuevo_sep->save())
                {
                    $answer[0]=2;
                    $answer['ese_id']=$ese_id;
                    $answer['sep_id']=$nuevo_sep->sep_id;
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
                 $subs = Seccionpersonal::findFirst(array(
                     'ese_id='.$ese_id,
                     'sep_estatus=2'));

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
           

            $sep_registro= Seccionpersonal::findFirst(array(
                "ese_id = '$ese_id'",
                'sep_estatus=2',
            ));

                if($sep_registro)
                {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion=0;
                    if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisocalificacion=1;  
                    }
               
                   
                    $respuesta_modelo= $sep_registro->ActualizarRegistro($data,$permisocalificacion);


                            if( $respuesta_modelo['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de sección personal  del registro con clave interna:'.$respuesta_modelo['sep_id'].' del estudio No. '.$respuesta_modelo['ese_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['sep_id'];
                                $databit['ese_id']= $sep_registro->ese_id;
                                $databit['bit_modulo']="Sección personal";
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$respuesta_modelo['ese_id'];
                                $answer['sep_id']=$respuesta_modelo['sep_id'];
                              
                               
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

    public function ajax_get_create_detalleAction($ese_id){

        
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {

            $modelo=new Seccionpersonal();
    
            $respuesta_modelo=$modelo->encontrar_o_crear($ese_id);
        
            $answer['data']=$respuesta_modelo;
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }
}