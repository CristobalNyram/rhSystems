<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class ReferenciavecinalController extends ControllerBase
{
    public function crearAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $rev= new Referenciavecinal() ;
         
            $respuesta_modelo= $rev->NuevoRegistro($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia vecinal la clave interna del registro '.$respuesta_modelo['rev_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['rev_id'];
                $databit['bit_modulo']="Referencia vecinal";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['rev_id']=$respuesta_modelo['rev_id'];
                $answer['sep_id']=$respuesta_modelo['sep_id'];


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
                $rev_id=$data['rev_id_editar'];
                $buscar_rev=Referenciavecinal::findFirst($rev_id);

                if($buscar_rev->rev_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_rev->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia vecinal con la clave interna del registro '.$respuesta_modelo['rev_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['rev_id'];
                                    $databit['bit_modulo']="Referencia vecinal";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['rev_id']=$respuesta_modelo['rev_id'];
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
    public function eliminarAction($rev_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $rev_id!=0 and is_numeric($rev_id))
        {
            $buscar_rev=Referenciavecinal::findFirst($rev_id);
            if($buscar_rev->rev_estatus==2)
            {
                $buscar_rev->rev_estatus=-2;

                    if($buscar_rev->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó una referencia vecinal que tenía por clave interna: '.$buscar_rev->rev_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_rev->rev_id;
                        $databit['bit_modulo']="Referencia vecinal.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_rev->rev_id;
                        $answer['rev_id']= $buscar_rev->rev_id;
                        $answer['sep_id']= $buscar_rev->sep_id;
                 
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
            $referenciavecinal=new Builder();
            $referenciavecinal=$referenciavecinal
            ->addFrom('Referenciavecinal','rev')
            ->where('rev_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referenciavecinal=new Builder();
                $referenciavecinal=$referenciavecinal
                ->addFrom('Referenciavecinal','rev')
                // ->join('estadocivil','rev.esc_id=esc.esc_id and esc.esc_estatus=2','esc')
                ->where('sep_id='.$id.' and rev_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias vecinales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia vecinal";
        $bitacora->NuevoRegistro($databit);


            
        $this->view->objectReferenciavecinal=new Referenciavecinal();
        $this->view->objectEstadoCivil=new Estadocivil();

        $this->view->page=$referenciavecinal;
        
    }
    public function ajax_get_detalleAction($rev_id=0){
        $this->view->disable();
        $answer=array();

        if ($rev_id!=0 && is_numeric($rev_id)) {
            $subs = Referenciavecinal::findFirst(array(
                'rev_id='.$rev_id,
                'rev_estatus=2'));

                if ($subs->rev_estatus==2) {
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


    public function tabla_truperAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referenciavecinal=new Builder();
            $referenciavecinal=$referenciavecinal
            ->addFrom('Referenciavecinal','rev')
            ->where('rev_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referenciavecinal=new Builder();
                $referenciavecinal=$referenciavecinal
                ->addFrom('Referenciavecinal','rev')
                // ->join('estadocivil','rev.esc_id=esc.esc_id and esc.esc_estatus=2','esc')
                ->where('sep_id='.$id.' and rev_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias vecinales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia vecinal";
        $bitacora->NuevoRegistro($databit);


            
        $this->view->objectReferenciavecinal=new Referenciavecinal();
        $this->view->objectEstadoCivil=new Estadocivil();
        $this->view->obj_seccion_personal =new Seccionpersonal();

        $this->view->page=$referenciavecinal;

    }


    public function crear_formato_truperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $rev= new Referenciavecinal() ;
         
            $respuesta_modelo= $rev->NuevoRegistroFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia vecinal la clave interna del registro '.$respuesta_modelo['rev_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['rev_id'];
                $databit['bit_modulo']="Referencia vecinal";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['rev_id']=$respuesta_modelo['rev_id'];
                $answer['sep_id']=$respuesta_modelo['sep_id'];


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
                $rev_id=$data['rev_id'];
                $buscar_rev=Referenciavecinal::findFirst($rev_id);

                if($buscar_rev->rev_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_rev->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia vecinal con la clave interna del registro'.$respuesta_modelo['rev_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['rev_id'];
                                    $databit['bit_modulo']="Referencia vecinal";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['rev_id']=$respuesta_modelo['rev_id'];
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