<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TrayectorialaboralController extends ControllerBase
{

    public function tabla_truperAction($id=0){

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $trayectorialaboral=new Builder();
            $trayectorialaboral=$trayectorialaboral
            ->addFrom('Trayectorialaboral','tyl')
            ->where('tyl_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $trayectorialaboral=new Builder();
                $trayectorialaboral=$trayectorialaboral
                ->addFrom('Trayectorialaboral','trd')
                ->where('sel_id='.$id.' and tyl_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de Trayectoria laboral que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Trayectoria laboral ;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$trayectorialaboral;
       


    }

    public function crear_formato_truperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $modelo= new Trayectorialaboral() ;
            $auth = $this->session->get('auth');
       
            
       
            $respuesta_modelo= $modelo->NuevoRegistroFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una trayectoria laboral con la clave interna del registro '.$respuesta_modelo['tyl_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['tyl_id'];
                $databit['bit_modulo']="Trayectoria laboral";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sel_id']=$respuesta_modelo['sel_id'];
                $answer['tyl_id']=$respuesta_modelo['tyl_id'];


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

    public function ajax_get_detalleAction($tyl_id){
        $this->view->disable();
        $answer=array();
        $condicion='tyl_id='.$tyl_id.' and tyl_estatus=2';
        $result['estado']  = -2;

        if ($tyl_id!=0 && is_numeric($tyl_id)) {
                $query=Trayectorialaboral::query()
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


    public function actualizar_formato_truperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $tyl_id=$data['tyl_id'];
                $buscar_tyl=Trayectorialaboral::findFirst($tyl_id);

                if($buscar_tyl->tyl_estatus!=-2)
                {
                    $auth = $this->session->get('auth');
                
                    $respuesta_modelo = $buscar_tyl->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una trayectoria laboral con la clave interna del registro '.$respuesta_modelo['tyl_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['tyl_id'];
                                    $databit['bit_modulo']="Trayectoria laboral";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['tyl_id']=$respuesta_modelo['tyl_id'];
                                    $answer['sel_id']=$respuesta_modelo['sel_id'];


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

    public function eliminarAction($id){
        $this->view->disable();
        $answer=array();

        if($this->request->isAjax() and $id!=0 and is_numeric($id))
        {
            $buscar_tyl=Trayectorialaboral::findFirst($id);
            if($buscar_tyl->tyl_estatus==2)
            {
                $buscar_tyl->tyl_estatus=-2;

                    if($buscar_tyl->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó un registro de trayectoria laboral que tenía por clave interna: '.$buscar_tyl->tyl_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_tyl->tyl_id;
                        $databit['bit_modulo']="Referncia laboral.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_tyl->tyl_id;
                        $answer['id']= $buscar_tyl->tyl_id;
                        $answer['sel_id']= $buscar_tyl->sel_id;
                 
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
}