<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
class RelvacanteejecutivoController extends ControllerBase
{
    public function ajax_get_detalle_relacionAction($vac_id=0){
        $rol = new Rol();
        $answer = array();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $answer['estado']=-2;
        $answer['data_rve']=[];
        $answer['data_usu']=[];
        $this->view->disable();
        $obj_vac=new Vacante();
        try {
            if ($this->request->isAjax() && $vac_id > 0) {
              $vacante_obj =$obj_vac->getAllDetalleVac($vac_id);
              if (!$vacante_obj) 
              throw new Exception("Vacante no encontrada");

               $condicion_sql='vac_id = '.$vac_id.' AND rve_estatus =2';
               $builder = new Builder();
               $builder->addFrom('Relvacanteejecutivo')
                       ->where($condicion_sql);
               $data_rve = $builder->getQuery()->execute();
               $condicion_sql_usu='usu_estatus=2 AND usu_id <> '.$vacante_obj->eje_id;
               $builder_usu = new Builder();
               $builder_usu->addFrom('Usuario')
                       ->where($condicion_sql_usu);
               $data_users = $builder_usu->getQuery()->execute();
               $answer["estado"] = 2;
               $answer["mensaje"] = "OK";
               $answer["titular"] = "OK";
               $answer["data_rve"] = $data_rve;
               $answer["data_usu"] = $data_users;
               $answer["data_vac"] = $vacante_obj;
            } else {
                $answer["estado"] = -1;
            }
        } catch (\Exception $e) {
            $answer["estado"] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $data_bit = [
                'bit_descripcion'=>'ERROR OBTENER DETALLES DE GET DETALLE VACANTE : '.$answer["mensaje"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        $this->response->setJsonContent($answer);
        $this->response->send();
    }


    public function general_tablaAction($vac_id=0){
        $this->view->registros=[];
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $condicion_sql_vac="";
        try {
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $condicion_sql_vac.="rve.rve_estatus=2 ";

            if($vac_id!=0){
                $condicion_sql_vac.=" AND rve.vac_id=".$vac_id;
            }
            $vac_eje = new Builder();
            $vac_eje = $vac_eje
            ->columns(array('
                rve.rve_id
                ,rve.eje_id
                ,rve.vac_id
                ,rve.rve_estatus
                ,rve.vac_estatus
                ,eje_vac.usu_nombre
                ,CONCAT(eje_vac.usu_nombre," ", eje_vac.usu_primerapellido," ",eje_vac.usu_segundoapellido) as eje_nombre

            '))
            ->addFrom('Relvacanteejecutivo', 'rve')
            ->leftjoin('Usuario','eje_vac.usu_id=rve.eje_id','eje_vac');
            $vac_eje = $vac_eje->where($condicion_sql_vac);
            $reg = $vac_eje->getQuery()->execute();
                $data_bit=[
                    'bit_descripcion'=>'Consultó la tabla de relación ejecutivo vacante - vacantes compartidas',
                    'bit_tablaid'=>0,
                    'bit_modulo'=>'Vacante',
                    'vac_id'=>0,
                    'bit_accion'=>4,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->view->registros=$reg;
   
        } catch (\Exception $e) {
            error_log('No cargo la tabla '.$e->getMessage());
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'ERROR TABLA RELACIÓN VAC EJECUTIVO  : '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
    }

    
    public function eliminarAction($id)
    {
        try {
            $rol = new Rol();
            $auth = $this->session->get('auth');
            $answer = array();
            $answer["estado"] = -2;
            $answer["titular"] = "error";
            $answer["mensaje"] = "error borrar la relación de la vacante";
            $fecha_y_hora = date("Y-m-d H:i:s");
            $this->view->disable();
            $rve = Relvacanteejecutivo::findFirst($id);
                if (!$rve) 
                    throw new Exception("No fue encontrado el registro");
                $rve->rve_estatus = -2;
                $rve->rve_fechaactualizo = $fecha_y_hora;
                $rve->usu_idactualizo = $auth["id"];
                if ($rve->update()){
        
                    $auth = $this->session->get('auth');
                    $data_bit=[
                        'bit_descripcion'=>"Eliminó el registro de compartido que tiene el folio ".$id,
                        'bit_tablaid'=>$id,
                        'usu_id'=>$auth['id'],
                        'bit_modulo'=>'Relación vacante ejecutivo',
                        'bit_accion'=>3,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $answer["estado"] = 2;
                    $answer["vac_id"] = $rve->vac_id;
                    $answer["eje_id"] = $rve->eje_id;
                    $answer["titular"] = "OK";
                    $answer["mensaje"] = "Se dejo de compartír la vacante con el usuario con folio ".$rve->eje_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (\Exception $e) {
            $answer["detalle"]= "Se produjo una excepción: " . $e->getMessage();
            error_log("Se produjo una excepción: " . $e->getMessage());
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'ERROR AL ELIMINAR VACANTE COMPARTIDA  : '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }       
    }

}