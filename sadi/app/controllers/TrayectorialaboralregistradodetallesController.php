<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TrayectorialaboralregistradodetallesController extends ControllerBase
{


    public function tabla_truperAction($id=0){

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $trayectorialaboralregistradodetalles=new Builder();
            $trayectorialaboralregistradodetalles=$trayectorialaboralregistradodetalles
            ->addFrom('Trayectorialaboralregistradodetalles','trd')
            ->where('trd_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $trayectorialaboralregistradodetalles=new Builder();
                $trayectorialaboralregistradodetalles=$trayectorialaboralregistradodetalles
                ->addFrom('Trayectorialaboralregistradodetalles','trd')
                ->where('tlr_id='.$id.' and trd_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de Trayectoria laboral registrado detalles que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Trayectoria laboral registrado detalles;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$trayectorialaboralregistradodetalles;
        $this->view->objt_trd=new Trayectorialaboralregistradodetalles();



    }


    public function eliminarAction($id){
        $this->view->disable();
        $answer=array();

        if($this->request->isAjax() and $id!=0 and is_numeric($id))
        {
            $buscar_trd=Trayectorialaboralregistradodetalles::findFirst($id);

     
            if($buscar_trd->trd_estatus==2)
            {
                $buscar_trd->trd_estatus=-2;

                    if($buscar_trd->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó un registro de trayectoria laboral registrada detalles que tenía por clave interna: '.$buscar_trd->trd_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_trd->trd_id;
                        $databit['bit_modulo']="Referncia laboral.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_trd->trd_id;
                        $answer['id']= $buscar_trd->trd_id;
                        $answer['tlr_id']= $buscar_trd->tlr_id;
                 
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


    public function crear_formato_truperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $modelo= new Trayectorialaboralregistradodetalles() ;
            $auth = $this->session->get('auth');
       
            
       
            $respuesta_modelo= $modelo->NuevoRegistroFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una trayectoria laboral registrada detalles con la clave interna  del registro '.$respuesta_modelo['trd_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['trd_id'];
                $databit['bit_modulo']="Trayectoria laboral registrada detalles";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['trd_id']=$respuesta_modelo['trd_id'];
                $answer['tlr_id']=$respuesta_modelo['tlr_id'];


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

    public function editar_formato_truperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $trd_id=$data['trd_id'];
                $buscar_trd=Trayectorialaboralregistradodetalles::findFirst($trd_id);

                if($buscar_trd->trd_estatus!=-2)
                {
                    $auth = $this->session->get('auth');
                
                    $respuesta_modelo = $buscar_trd->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una trayectoria laboral registrada detalles con la clave interna del registro '.$respuesta_modelo['trd_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['trd_id'];
                                    $databit['bit_modulo']="Trayectoria laboral registrado detalles";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['trd_id']=$respuesta_modelo['trd_id'];
                                    $answer['tlr_id']=$respuesta_modelo['tlr_id'];


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


    public function ajax_get_detalleAction($id){
        $this->view->disable();
        $answer=array();
        $condicion='trd_id='.$id.' and trd_estatus=2';
        $result['estado']  = -2;

        if ($id!=0 && is_numeric($id)) {
                $query=Trayectorialaboralregistradodetalles::query()
                ->where($condicion)
                ->limit(1)
                ->execute();

                if(count($query)>0){
                    $result['estado']  = 2;
                    $result['data'] = $query[0]->toArray();

                }
            
        } 
        return $this->response->setJsonContent($result);
    }
    
}