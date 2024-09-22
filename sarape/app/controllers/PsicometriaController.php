<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;


use Intervention\Image\ImageManager;

class PsicometriaController extends ControllerBase
{
     
    public function general_indexAction()
    {
        $this->tag->setTitle('Psicometría');
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
        
    }
    public function general_tablaAction()
    {
        $condicion_sql = "exc.exc_estatus='3' ";
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
        $rol = new Rol();
        $tienePermiso=0;
        try {
            $cita = Psicometria::query()
                ->columns(array('
                    cit.cit_id,
                    cit.cit_estatus,

                    cit.cit_registro,
                    cit.cit_fecha,
                    cit.cit_hora ,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    can.can_correo,
                    can.can_id,
                    can.can_telefono,
                    can.can_celular,
                    med.med_nombre,
                    tic.tic_nombre,
                    exc.exc_id,
                    exc.exc_estatus,
                    exc.vac_id,
                    exc.eje_idprincipal,

                    cit.cit_observaciones,
                    emp.emp_nombre,
                    emp.emp_alias,
                    emp.emp_id,
                    cav.cav_nombre,
                    est.est_nombre,
                    mun.mun_nombre,
                    Psicometria.psi_id,
                    Psicometria.psi_calificacion,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    vac_fecharegistro
                '))
                ->leftjoin('Expedientecan','exc.exc_id=Psicometria.exc_id','exc')//join mas importante
                ->leftjoin('Cita','cit.exc_id=Psicometria.exc_id','cit')
                ->leftjoin('Medio','med.med_id=cit.med_id','med')
                ->leftjoin('Tipocita','tic.tic_id=cit.tic_id','tic')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Usuario','exc_eje.usu_id=exc.eje_idprincipal','exc_eje')
                ->leftjoin('Candidato','can.can_id=exc.can_id','can');
           
            if($rol->verificar(68,$auth['rol_id'])) {//solo asignados 
                $condicion_sql.=" AND exc.eje_idprincipal=".$auth['id'];
                $tienePermiso=1;

            }elseif ($rol->verificar(69,$auth['rol_id'])) {//todos
                $tienePermiso=1;

            }

            if($tienePermiso==1){
                $reg = $cita->where($condicion_sql)->orderBy('Psicometria.psi_id DESC')->execute();
            }else{
                $reg = [];
            }

            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general psicometría",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Psicometría",
                'vac_id'=>0,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);

            $this->view->registros = $reg;
            $this->view->obj_cita = new Cita();
            $this->view->obj_exc = new Expedientecan();
            $date = new DateTime();
            $hoy = $date->format('Y-m-d');
            $this->view->hoy = $hoy;
        } catch (\Exception $e) {
            $this->view->registros = [];
            error_log($e->getMessage());
        
        }
    }
 
    
    public function actualizar_generalAction($exc_id=0)
    {   
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al actualizar los datos de psicometría',
            'titular' => 'Error',
        ];
        $mensaje_extra = '';
        $data_aes = '';
        $mensaje_extra_json = '';
        $this->db->begin();

        try {
            $this->view->disable(); 
            if ($this->request->isAjax()) {
               // $vacante_id = $this->request->getPost('vacante_id');
               $expedientecan_exc_id =$exc_id;
               $psicometria_obj = Psicometria::findFirstByexc_id($expedientecan_exc_id);
                
                if ($psicometria_obj) {
                    $data = $this->request->getPost();
                    $respuesta_modelo_psi = $psicometria_obj->ActualizarGeneral($data, $auth);
                    
                    if( $respuesta_modelo_psi["estado"]==2){
                        $data_bit=[
                            'bit_descripcion'=>'Se actualizó datos de piscometría con folio '.$respuesta_modelo_psi['psi_id']." del expediente candidato ".$expedientecan_exc_id,
                            'bit_tablaid'=>$respuesta_modelo_psi['psi_id'],
                            'bit_modulo'=>"Psicometría",
                            'vac_id'=>0,
                            'bit_accion'=>2,
                        ];
        
                        $this->bitacora_registro($data_bit,$auth);                
                        $this->db->commit();
                        $answer['estado'] = 2;
                        $answer['mensaje'] = 'Se actualizaron los datos de psicometría';
                        $answer['titular'] = 'Éxito';
                    }else
                        throw new \Exception("ERROR AL ACTUALIZAR LOS DATOS ESTATUS -2");
                    
                
                } else {
                    $answer['estado'] = -1;
                    $answer['mensaje'] = 'La registro no fue encontrado';
                    $answer['titular'] = 'Error';
                }
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {
            $answer['detalle'] = $e;
             $answer['detalle'] =$e->getMessage();
             $data_bit = [
                 'bit_descripcion'=>'ERROR EDITAR PSICOMETRÍA : '.$answer["detalle"],
                 'bit_tablaid' => $vac_id,
                 'bit_modulo' => "ERROR ",
                 'vac_id' => 0,
                 'bit_accion' => 2,
             ];
            $this->bitacora_registro_ERROR($data_bit,$e);
            $this->db->rollback();
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        
        }
    }
    public function ajax_get_detalleAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $this->view->disable();        
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
               //error_log("consulta psi");
                $registro = Psicometria::query()
                    ->columns('
                        Psicometria.psi_calificacion,
                        Psicometria.psi_observacion,
                        Psicometria.psi_estatus,
                        Psicometria.psi_actualizacion,
                        Psicometria.psi_fecharegistro,
                        exc.exc_estatus,
                        exc.exc_id,
                        vac.vac_estatus,
                        cav.cav_nombre,
                        CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                        vac.vac_id,
                        emp.emp_nombre
                        
                    ')
                    ->leftjoin('Expedientecan','exc.exc_id=Psicometria.exc_id','exc')
                    ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                    ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                    ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                    ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                    ->where('Psicometria.exc_id=' . $exc_id)
                    ->execute();
               // error_log("llego a la consulta");
                if (count($registro)>0) {
                    $answer[0] = 1;
                    $answer['data'] = $registro[0];
                    $answer['mensaje']='OK';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                } else {
                    $answer[0] = -1;
                    $answer['mensaje']='NO HAY REGISTRO';

                }
            } else {
                $answer[0] = -1;
                $answer['mensaje']='ERROR EXC_ID';
            }
        } catch (\Exception $e) {
            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $answer['detalle'] = 'Error: ' . $e->getMessage();
        }
        $this->response->setJsonContent($answer);
        $this->response->send();
        return;

    }

}