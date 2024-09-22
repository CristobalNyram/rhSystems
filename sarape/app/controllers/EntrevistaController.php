<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class EntrevistaController extends ControllerBase
{
    public function general_indexAction()
    {
        $this->tag->setTitle('Psicometría');

        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
        }
        
    }
    public function general_tablaAction()
    {
        $condicion_sql = "exc.exc_estatus='3' ";
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');

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
                    can.can_telefono,
                    can.can_celular,
                    med.med_nombre,
                    tic.tic_nombre,
                    exc.exc_id,
                    exc.exc_estatus,
                    exc.vac_id,
                    cit.cit_observaciones,
                    emp.emp_nombre,
                    cav.cav_nombre,
                    est.est_nombre,
                    mun.mun_nombre,
                    Psicometria.psi_id,
                    Psicometria.psi_calificacion,


                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre

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
                ->leftjoin('Candidato','can.can_id=exc.can_id','can');
    
            $cita = $cita->where($condicion_sql)->orderBy('Psicometria.psi_id DESC')->execute();
            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general psicometría",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Psicometría",
                'vac_id'=>0,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);

            $this->view->registros = $cita;
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
            'mensaje' => 'Se produjo un error al actualizar los datos de entrevista',
            'titular' => 'Error',
        ];
        $mensaje_extra_bitacora = '';
        $data_aes = '';
        $mensaje_extra_json = '';

        $this->db->begin();
        try {
            $this->view->disable();
            if ($this->request->isAjax()) {

               // $vacante_id = $this->request->getPost('vacante_id');
                $expedientecan_exc_id =$exc_id;
                $obj_com= new Comentarioexc();
                $obj_helper= new Helper();
                $ent_obj = Entrevista::findFirstByexc_id($expedientecan_exc_id);
                $expedientecan= Expedientecan::findFirst($exc_id);

                if ($ent_obj) {
                    $data = $this->request->getPost();
                    $data_com=$data["com"];
                    //$data_exc=$data["exc"];
                    $data_ent=$data["ent"];

                    $respuesta_modelo_ent = $ent_obj->ActualizarGeneral($data_ent, $auth);
                    if($respuesta_modelo_ent["estado"]!=2){
                        $this->db->rollback();
                        $this->response->setJsonContent($respuesta_modelo_ent);
                        $this->response->send();
                        return;

                    }

                    if( $respuesta_modelo_ent["estado"]==2){
                        $data_bit=[
                            'bit_descripcion'=>'Se actualizaron datos de entrevista con folio '.$respuesta_modelo_ent['ent_id']." del expediente candidato ".$expedientecan_exc_id,
                            'bit_tablaid'=>$respuesta_modelo_ent['ent_id'],
                            'bit_modulo'=>"Entrevista",
                            'vac_id'=>0,
                            'bit_accion'=>2,
                        ];
        
                    
                        $this->bitacora_registro($data_bit,$auth);
                        
                        $this->db->commit();
                        $answer['estado'] = 2;
                        $answer['mensaje'] = 'Se actualizaron los datos de entrevista';
                        $answer['titular'] = 'Éxito';
                    }else{
                        throw new \Exception("ERROR AL ACTUALIZAR LOS DATOS ESTATUS -2");
                    }
                
                } else {
                    throw new \Exception("REGISTRO NO DISPONIBLE");

                }
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {
            $answer['detalle'] = $e;
            
             $answer['detalle'] =$e->getMessage();
     
             $data_bit = [
                 'bit_descripcion'=>'ERROR EDITAR ENTREVISTA : '.$answer["detalle"],
                 'bit_tablaid' => $exc_id,
                 'bit_modulo' => "ERROR",
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
        $answer['mensaje']='ERROR';



        $answer = array();
        $this->view->disable();
        
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $registro = Entrevista::query()
                    ->columns('
                        Entrevista.exc_id,
                        Entrevista.ent_fecha,
                        Entrevista.ent_motivo,
                        Entrevista.ent_estatus,
                        Entrevista.ent_fecha,
                        Entrevista.ent_hora,
                        Entrevista.ent_sueldo,
                        Entrevista.ent_seleccionado,
                        Entrevista.ent_observacion,
                        Entrevista.ent_fechaingreso,
                        Entrevista.ent_montofacturar,

                        exc.exc_estatus,
                        exc.exc_id,
                        vac.vac_estatus,
                        CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                        emp.emp_nombre,
                        cav.cav_nombre
                        
                    ')
                    ->leftjoin('Expedientecan','exc.exc_id=Entrevista.exc_id','exc')
                    ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                    ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                    ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                    ->leftjoin('Candidato','can.can_id=exc.can_id','can')

                    ->where('exc.exc_id=' . $exc_id)
                    ->execute();
        
                if (count($registro)>0) {
                    $answer[0] = 1;
                    $answer['data'] = $registro[0];
                    $answer['mensaje']='OK';

                } else {
                    $answer[0] = -1;
                }
            } else {
                $answer[0] = -1;
            }
        } catch (\Exception $e) {
            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();


    }
}