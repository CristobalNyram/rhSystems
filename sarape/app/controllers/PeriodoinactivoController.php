<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class PeriodoinactivoController extends ControllerBase
{
    public function crearAction()
    {
        $this->view->disable();
        $answer = [
            'estado' => -2,
            'mensaje' =>"ERROR GENERAL",
            'titular' => 'ERROR',
        ];
        $auth = $this->session->get('auth');

        try {
       
            if ($this->request->isAjax()) {
                $data = $this->request->getPost();
                $per = new Periodoinactivo();
                $this->db->begin();
    
                $respuesta_modelo = $per->NuevoRegistro($data);
    
                if ($respuesta_modelo['estado'] == 2) {
    
                    $databit = array(
                        'bit_descripcion' => 'Registró un periodo de inactividad con clave interna: ' . $respuesta_modelo['per_id'],
                        'bit_tablaid' => $respuesta_modelo['per_id'],
                        'bit_modulo' => 'Periodo de inactivo',
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    );
                    $this->bitacora_registro($databit,$auth);
                    $answer['estado'] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se guardaron los datos correctamente.';
                    $answer['per_id'] = $respuesta_modelo['per_id'];
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
    
                    $this->response->setJsonContent($answer);
                    $this->db->commit();
                    $this->response->send();
                    return;
                } else {
                    $answer['estado'] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se pudieron procesar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->db->rollback();
                    $this->response->send();
                    return;
                }
            }else{

            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }
    
    public function actualizarAction()
    {
        $this->view->disable();
        $answer = [
            'estado' => -2,
            'mensaje' => 'ERROR GENERAL',
            'titular' => 'ERROR',
        ];
        $auth = $this->session->get('auth');
    
        try {
            $this->db->begin();

            if ($this->request->isAjax()) {
                $data = $this->request->getPost();
                $per_id = $data['per_id_editar'];
                $buscar_per = Periodoinactivo::findFirst($per_id);
                if(!$buscar_per){
                    $answer['estado'] = -1;
                    throw new \Exception('El registro no existe');
                }

                if ($buscar_per->per_estatus != -2) {
    

                    $respuesta_modelo = $buscar_per->ActualizarRegistro($data);
    
                    if ($respuesta_modelo['estado'] == 2) {
    
                    
                        $data_bit = [
                            'bit_descripcion' => 'Editó un periodo de inactividad con clave interna del registro ' . $respuesta_modelo['per_id'],
                            'bit_tablaid' => $respuesta_modelo['per_id'],
                            'bit_modulo' => 'Periodo de inactivo',
                            'vac_id' => 0,
                            'bit_accion' => 2,
                        ];
                       // $this->bitacora_registro($data_bit, $auth);
                        $answer['estado'] = 2;
                        $answer['titular'] = 'Éxito';
                        $answer['mensaje'] = 'Se actualizaron los datos correctamente.';
                        $answer['per_id'] = $respuesta_modelo['per_id'];
                        $answer['sel_id'] = $respuesta_modelo['sel_id'];
    
                        $this->response->setJsonContent($answer);
                        $this->db->commit();
                        $this->response->send();
                        return;
                    } else {
                        $answer['estado'] = -2;
                        throw new \Exception('No se pudieron procesar los datos correctamente.');

                    }
                } else {
                    $answer['estado'] = -2;
                    throw new \Exception('NO ESTÁ DISPONIBLE ESTE REGISTRO.');
                }
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $answer['mensaje'] = '#'.$e->getMessage();
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }
    
    public function eliminarAction($per_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $per_id!=0 and is_numeric($per_id))
        {
            $buscar_per=Periodoinactivo::findFirst($per_id);
            if($buscar_per->per_estatus==2)
            {
                $buscar_per->per_estatus=-2;

                    if($buscar_per->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó un perido inactivo que tenía por clave interna: '.$buscar_per->per_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_per->per_id;
                        $databit['bit_modulo']="Periodo inactivo.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_per->per_id;
                        $answer['per_id']= $buscar_per->per_id;
                        $answer['sel_id']= $buscar_per->sel_id;
                 
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
    public function tablagabencognvAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $periodoinactivo=new Builder();
            $periodoinactivo=$periodoinactivo
            ->addFrom('Periodoinactivo','per')
            ->where('per_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','sei')
                ->where('sel_id='.$id.' and per_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de periodo inactivo que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Periodo inactivo";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$periodoinactivo;
        
    }
    public function tablagabtubosAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $periodoinactivo=new Builder();
            $periodoinactivo=$periodoinactivo
            ->addFrom('Periodoinactivo','per')
            ->where('per_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','sei')
                ->where('sel_id='.$id.' and per_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de periodo inactivo que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Periodo inactivo";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$periodoinactivo;
        
    }
    public function tablaAction($id = 0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
    
        try {
            $condicion_sql = ($id == 0) ? 'per_estatus = 2' : 'sel_id = ' . $id . ' AND per_estatus = 2';
    
            $periodoinactivo = new Builder();
            $periodoinactivo = $periodoinactivo->addFrom('Periodoinactivo', 'per')
                ->where($condicion_sql)
                ->getQuery()
                ->execute();
    
            $databit = [
                'bit_descripcion' => "Consultó los detalles de periodo inactivo que tiene por clave interna: " . $id,
                'bit_accion' =>4,
                'bit_tablaid' => $id,
                'vac_id' => 0,
                'bit_modulo' => "Periodo inactivo"
            ];
            $this->bitacora_registro($databit,$auth);
    
            $this->view->page = $periodoinactivo;
        } catch (\Exception $e) {
            $this->view->page = array();
        }
    }
    
   
    public function ajax_get_detalleAction($per_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($per_id!=0 && is_numeric($per_id)) {
            $subs = Periodoinactivo::findFirst(array(
                'per_id='.$per_id,
                'per_estatus=2'));

                if ($subs->per_estatus==2) {
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


}