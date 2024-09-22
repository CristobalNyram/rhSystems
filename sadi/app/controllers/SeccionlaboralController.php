<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class SeccionlaboralController extends ControllerBase
{
    public function crear_automaticoAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && is_numeric($ese_id))
        {
            $buscarEseId=Seccionlaboral::findFirst(array(
                "ese_id = '$ese_id'",
                'sel_estatus=2'
            ));

            if($buscarEseId==false)
            {
                $nuevo_seclab= new Seccionlaboral();
                $nuevo_seclab->sel_estatus=2;
                $nuevo_seclab->ese_id=$ese_id;

                if($nuevo_seclab->save())
                {
                    $answer[0]=2;
                    $answer['ese_id']=$ese_id;
                    $answer['sel_id']=$nuevo_seclab->sel_id;
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
                 $subs = Seccionlaboral::findFirst(array(
                     'ese_id='.$ese_id,
                     'sel_estatus=2'));

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
           

            $sel_registro= Seccionlaboral::findFirst(array(
                "ese_id = '$ese_id'",
                'sel_estatus=2',
            ));

                if($sel_registro)
                {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion=0;
                    if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisocalificacion=1;  
                    }

                    $permiso_71=0;
                    if($rol->verificar(71,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permiso_71=1;  
                    }
                    $permiso_80=0;
                    if($rol->verificar(80,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permiso_80=1;  
                    }
               
                   
                    $respuesta_modelo= $sel_registro->ActualizarRegistro($data,$permisocalificacion,$permiso_71,$permiso_80);


                            if( $respuesta_modelo['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de sección laboral del registro con clave interna:'.$respuesta_modelo['sel_id'].' del estudio No. '.$respuesta_modelo['ese_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['sel_id'];
                                $databit['ese_id']= $sel_registro->ese_id;
                                $databit['bit_modulo']="Sección laboral";
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$respuesta_modelo['ese_id'];
                                $answer['sel_id']=$respuesta_modelo['sel_id'];
                              
                               
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
           
        }

        
    }

    public function ajax_set_update_formato_truperAction($sel_id){
       
       
        $this->view->disable();
        $answer=array();
        if($sel_id!=0 && is_numeric($sel_id) && $this->request->isAjax())
        {
            $data = $this->request->getPost();
           

            $sel_registro= Seccionlaboral::findFirst(array(
                                "sel_id = '$sel_id'",
                                'sel_estatus=2',
                              ));

             $trl_registro =Trayectorialaboralregistrado::findFirstBysel_id($sel_id);

                if($trl_registro)
                {
                    $auth = $this->session->get('auth');
                 
                    $respuesta_modelo= $trl_registro->ActualizarRegistroFormatoTruper($data);


                            if( $respuesta_modelo['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de sección de referencias laborales del registro con clave interna:'.$respuesta_modelo['sel_id'].' del estudio No. '. $sel_registro->ese_id;
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['sel_id'];
                                $databit['bit_modulo']="Sección laboral";
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$sel_registro->ese_id;
                                $answer['sel_id']=$respuesta_modelo['sel_id'];
                              
                               
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
            
        }

    }
}