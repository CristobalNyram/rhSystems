<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class ReferenciapersonalController extends ControllerBase
{
    public function crearAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $rep= new Referenciapersonal() ;
         
            $respuesta_modelo= $rep->NuevoRegistro($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia personal con la clave interna del registro '.$respuesta_modelo['rep_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['rep_id'];
                $databit['bit_modulo']="Referencia personal";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sep_id']=$respuesta_modelo['sep_id'];
                $answer['rep_id']=$respuesta_modelo['rep_id'];


                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
        }

    }
    public function actualizarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $rep_id=$data['rep_id_editar'];
                $buscar_rep=Referenciapersonal::findFirst($rep_id);

                if($buscar_rep->rep_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_rep->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia personal con la clave interna del registro '.$respuesta_modelo['rep_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['rep_id'];
                                    $databit['bit_modulo']="Referencia personal";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['rep_id']=$respuesta_modelo['rep_id'];
                                    $answer['sep_id']=$respuesta_modelo['sep_id'];


                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    
                                }
                                else
                                {
                                    $answer[0]=-2;
                                    $answer['titular']='ERROR';
                                    $answer['mensaje']='No se procesaron los datos correctamente';
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    

                                }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
        
    }
    public function eliminarAction($rep_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $rep_id!=0 and is_numeric($rep_id))
        {
            $buscar_rep=Referenciapersonal::findFirst($rep_id);
            if($buscar_rep->rep_estatus==2)
            {
                $buscar_rep->rep_estatus=-2;

                    if($buscar_rep->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó una referencia personal que tenía por clave interna: '.$buscar_rep->rep_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_rep->rep_id;
                        $databit['bit_modulo']="Referenica personal.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_rep->rep_id;
                        $answer['rep_id']= $buscar_rep->rep_id;
                        $answer['sep_id']= $buscar_rep->sep_id;
                 
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;  

                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='No se pudieron procesar los datos.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;    
                        
                    }
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            
        }
        
    }
    public function tablaAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referenciapersonal=new Builder();
            $referenciapersonal=$referenciapersonal
            ->addFrom('Referenciapersonal','rep')
            ->where('rep_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referenciapersonal=new Builder();
                $referenciapersonal=$referenciapersonal
                ->addFrom('Referenciapersonal','rep')
                ->where('sep_id='.$id.' and rep_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias personales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia personal;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$referenciapersonal;
        
    }
    public function ajax_get_detalleAction($rep=0){
        $this->view->disable();
        $answer=array();

        if ($rep!=0 && is_numeric($rep)) {
            $subs = Referenciapersonal::findFirst(array(
                'rep_id='.$rep,
                'rep_estatus=2'));

                if ($subs->rep_estatus==2) {
                    $answer[0]=2;
                    $answer['data']= $result = $subs->toArray();
                    $answer['titular']='OK';
                    $answer['mensaje']='OK';
                   
                }
                else{
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                    return;    
                }
                
            
        }
        else{
            
            $answer[0]=-2;
            $answer['titular']='NO DISPONIBLE';
            $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
            return;    
        }
       
        return $this->response->setJsonContent($answer);
    }

    
    public function tablagabtubosAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referenciapersonal=new Builder();
            $referenciapersonal=$referenciapersonal
            ->addFrom('Referenciapersonal','rep')
            ->where('rep_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referenciapersonal=new Builder();
                $referenciapersonal=$referenciapersonal
                ->addFrom('Referenciapersonal','rep')
                ->where('sep_id='.$id.' and rep_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias personales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia personal;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$referenciapersonal;
        
    }

    public function tabla_truperAction($id=0){
            
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referenciapersonal=new Builder();
            $referenciapersonal=$referenciapersonal
            ->addFrom('Referenciapersonal','rep')
            ->where('rep_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referenciapersonal=new Builder();
                $referenciapersonal=$referenciapersonal
                ->addFrom('Referenciapersonal','rep')
                ->where('sep_id='.$id.' and rep_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias personales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia personal;";
        $bitacora->NuevoRegistro($databit);

            
        $this->view->obj_seccion_personal =new Seccionpersonal();

        $this->view->page=$referenciapersonal;

    }

    public function crear_formato_truperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $rep= new Referenciapersonal() ;
         
            $respuesta_modelo= $rep->NuevoRegistroFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia personal con la clave interna del registro '.$respuesta_modelo['rep_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['rep_id'];
                $databit['bit_modulo']="Referencia personal";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sep_id']=$respuesta_modelo['sep_id'];
                $answer['rep_id']=$respuesta_modelo['rep_id'];


                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
        }

    }

    public function actualizar_formato_truperAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $rep_id=$data['rep_id'];
                $buscar_rep=Referenciapersonal::findFirst($rep_id);

                if($buscar_rep->rep_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_rep->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia personal con la clave interna del registro '.$respuesta_modelo['rep_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['rep_id'];
                                    $databit['bit_modulo']="Referencia personal";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['rep_id']=$respuesta_modelo['rep_id'];
                                    $answer['sep_id']=$respuesta_modelo['sep_id'];


                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    
                                }
                                else
                                {
                                    $answer[0]=-2;
                                    $answer['titular']='ERROR';
                                    $answer['mensaje']='No se procesaron los datos correctamente';
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    

                                }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
        
    }
}