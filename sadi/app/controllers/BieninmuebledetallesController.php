<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class BieninmuebledetallesController extends ControllerBase
{
    public function crearAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $bid= new Bieninmuebledetalles() ;
         
            $respuesta_modelo= $bid->NuevoRegistro($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró un bien inmueble la clave interna del registro '.$respuesta_modelo['bid_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['bid_id'];
                $databit['bit_modulo']="Bien inmueble detalles";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['bid_id']=$respuesta_modelo['bid_id'];
                $answer['bie_id']=$respuesta_modelo['bie_id'];


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
                $bid_id=$data['bid_id_editar'];
                $buscar_bid=Bieninmuebledetalles::findFirstBybid_id($bid_id);

                if($buscar_bid->bid_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_bid->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó un bien inmueble con la clave interna del registro'.$respuesta_modelo['bid_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['bid_id'];
                                    $databit['bit_modulo']="Bien inmueble detalles";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['bid_id']=$respuesta_modelo['bid_id'];
                                    $answer['bie_id']=$respuesta_modelo['bie_id'];


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

    public function crear_formatotruperAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $bid= new Bieninmuebledetalles() ;
         
            $respuesta_modelo= $bid->NuevoRegistroFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró un bien inmueble la clave interna del registro '.$respuesta_modelo['bid_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['bid_id'];
                $databit['bit_modulo']="Bien inmueble detalles";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['bid_id']=$respuesta_modelo['bid_id'];
                $answer['bie_id']=$respuesta_modelo['bie_id'];


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
    public function actualizar_formatotruperAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $bid_id=$data['bid_id_editar'];
                $buscar_bid=Bieninmuebledetalles::findFirstBybid_id($bid_id);

                if($buscar_bid->bid_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_bid->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó un bien inmueble con la clave interna del registro'.$respuesta_modelo['bid_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['bid_id'];
                                    $databit['bit_modulo']="Bien inmueble detalles";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['bid_id']=$respuesta_modelo['bid_id'];
                                    $answer['bie_id']=$respuesta_modelo['bie_id'];


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
    
    public function eliminarAction($bid_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $bid_id!=0 and is_numeric($bid_id))
        {
            $buscar_bid=Bieninmuebledetalles::findFirst($bid_id);
            if($buscar_bid->bid_estatus==2)
            {
                $buscar_bid->bid_estatus=-2;

                    if($buscar_bid->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó un bien inmueble que tenía por clave interna: '.$buscar_bid->bid_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_bid->bid_id;
                        $databit['bit_modulo']="Bien inmueble detalles.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_bid->bid_id;
                        $answer['bid_id']= $buscar_bid->bid_id;
                        $answer['bie_id']= $buscar_bid->bie_id;
                 
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
            $bieninmuebledetalles=new Builder();
            $bieninmuebledetalles=$bieninmuebledetalles
            ->addFrom('Bieninmuebledetalles','bid')
            ->where('bid_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $bieninmuebledetalles=new Builder();
                $bieninmuebledetalles=$bieninmuebledetalles
                ->addFrom('Bieninmuebledetalles','sei')
                ->where('bie_id='.$id.' and bid_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de bienes inmuebles que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Bien inmueble detalles;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$bieninmuebledetalles;
        
    }
    public function ajax_get_detalleAction($bid_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($bid_id!=0 && is_numeric($bid_id)) {
            $subs = Bieninmuebledetalles::findFirst(array(
                'bid_id='.$bid_id,
                'bid_estatus=2'));

                if ($subs->bid_estatus==2) {
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
    

    public function tabla_truperAction($id){
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $bieninmuebledetalles=new Builder();
            $bieninmuebledetalles=$bieninmuebledetalles
            ->addFrom('Bieninmuebledetalles','bid')
            ->where('bid_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $bieninmuebledetalles=new Builder();
                $bieninmuebledetalles=$bieninmuebledetalles
                ->addFrom('Bieninmuebledetalles','sei')
                ->where('bie_id='.$id.' and bid_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de bienes inmuebles que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Bien inmueble detalles;";
        $bitacora->NuevoRegistro($databit);

            
        $this->view->obj_bieninmueble=new Bieninmuebledetalles();
        $this->view->page=$bieninmuebledetalles;
    }
}