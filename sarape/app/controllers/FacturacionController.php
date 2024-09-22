<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class FacturacionController extends ControllerBase
{
    public function ajax_get_detalleAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer['data']=[];

        $this->view->disable();
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $registro = Facturacion::query()
                ->columns('
                    Facturacion.*,
                    vac.vac_estatus
                ')
                ->leftjoin('Expedientecan', 'exc.exc_id=Facturacion.exc_id', 'exc')
                ->leftjoin('Vacante', 'vac.vac_id=exc.vac_id', 'vac')
                ->leftjoin('Empresa', 'emp.emp_id=vac.emp_id', 'emp')
                ->leftjoin('Catvacante', 'cav.cav_id=vac.cav_id', 'cav')
                ->leftjoin('Candidato', 'can.can_id=exc.can_id', 'can')
                ->where('exc.exc_id=' . $exc_id)
                ->andWhere('Facturacion.fat_estatus=2')
                ->execute();

                if (count($registro)>0) {
                    $answer["estado"] = 2;
                    $answer['data'] = $registro[0];
                    $answer['mensaje']='OK';

                } else {
                    $answer["estado"] = -1;
                    $answer['mensaje']='no data';

                }
            } else {
                $answer["estado"] = -2;
            }
        } catch (\Exception $e) {
            $answer["estado"] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            error_log($answer['mensaje']);
        }

        $this->response->setJsonContent($answer);
        $this->response->send();


    }

    public function enviar_correo_fatu_autoAction($can_id=0,$exc_id=0,$vac_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer['estado'] = -2;
        $condicion_sql="";
        $this->db->begin();

        try {
                if (!$this->request->isAjax() || !$can_id > 0  ||  !$exc_id > 0  ||  !$vac_id > 0) {throw new Exception("Formato no adecuado de solicitud...");}

                $candidato= Candidato::findFirst($can_id);
                if(!$candidato){throw new Exception("Candidato no encontradó...");}

                $configuracion_obj=new Configuracion();
                $vacantes = new Builder();
                $vacantes = $vacantes
                ->columns(array('
                    vac.vac_actualizacion,vac.vac_observaciones,
                    vac.vac_fechasolicitud,vac.vac_fecharegistro,
                    vac.vac_experiencia,vac.vac_funcionprincipal,
                    vac.vac_estatus,
                    vac.eje_id,
                    vac.vac_habilidad,vac.vac_conceptotecnico,
                    vac.vac_id,
                    emp.emp_nombre,
                    emp.emp_id,
                    emp.emp_alias,
                    est.est_nombre,
                    mun.mun_nombre,
                    cav.cav_nombre,
                    cav.cav_id,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    can.can_id,
                    CONCAT(aux.usu_nombre," ", aux.usu_primerapellido," ",aux.usu_segundoapellido) as aux_nombre,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    CONCAT(cne.cne_nombre," ", cne.cne_primerapellido," ",cne.cne_segundoapellido) as cne_nombre,
                    cne.cne_correo,
                    cne.cne_tel,

                    sel.usu_idauxiliar AS aux_id,
                    exc.exc_id,
                    exc.eje_idprincipal,
                    exc.exc_estatus,

                    fat.fat_id,
                    fat.fat_registro,
                    fat.fat_observacion,
                    fat.fat_factor,
                    fat.fat_sueldo,
                    fat.fat_montofacturar,
                    fat.fat_reqfactura,
                    fat.fat_fechaingreso,
                    fat.vac_estatus as fat_vac_estatus

                '))
                ->addFrom('Expedientecan','exc')
                ->leftjoin('Cita','cit.exc_id=exc.exc_id','cit')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                ->leftjoin('Contactoemp','cne.cne_id=vac.cne_id','cne')
                ->leftjoin('Centrocosto','cen.cen_id=vac.cen_id','cen')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Seccionlaboral','sel.exc_id=exc.exc_id','sel')
                ->leftjoin('Usuario','aux.usu_id=sel.usu_idauxiliar','aux')
                ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                ->leftjoin('Usuario','exc_eje.usu_id=exc.eje_idprincipal','exc_eje')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Facturacion','fat.exc_id=exc.exc_id AND fat.fat_estatus=2','fat');

                $condicion_sql.="vac.vac_id=".$vac_id." AND exc.exc_id=".$exc_id;
                $vacante = $vacantes->where($condicion_sql);
                $vacante = $vacante->getQuery()->execute();

                if(count($vacante)==0){throw new Exception("Expediente no encontrado...");}

                $ejecutivo= Usuario::findFirst($vacante[0]->eje_idprincipal);
                if(!$ejecutivo){throw new Exception("Ejecutivo no encontradó...");}
                if(trim($ejecutivo->usu_correo)==""){throw new Exception("Ejecutivo no tiene cargado un correo...");}

                if ($this->numerovalidoInputValido($vacante[0]->fat_id)!=true){throw new Exception("No existe el registro de facturación..."); }
                if (empty($vacante[0]->fat_registro) || is_null($vacante[0]->fat_registro)) {throw new Exception("La fecha de facturación no puede ser vacía.");}

                $fecha_datetime_fat_registro = $vacante[0]->fat_registro;
                $fecha_formateada_fat_registro = date("d/m/Y", strtotime($fecha_datetime_fat_registro));

                // $obj_correo=new Configcorreo();
                $obj_correo=new ServicioCorreo();
                $respuesta_modelo_contruir_correo=$obj_correo->contruirMaquetaCorreoFacturacionExp($vacante,$fecha_formateada_fat_registro,$ejecutivo,$vac_id);
                if($respuesta_modelo_contruir_correo['estado']!=2){
                    $this->db->rollback();
                    $answer['titular']=$respuesta_modelo_contruir_correo['titular'];
                    $answer['estado']=$respuesta_modelo_contruir_correo['estado'];
                    $answer['mensaje']=$respuesta_modelo_contruir_correo['mensaje'];
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }

                $asunto=$respuesta_modelo_contruir_correo['asunto'];
                $template=$respuesta_modelo_contruir_correo['template'];
                $destinatario=$respuesta_modelo_contruir_correo['destinatario'];
                $ccDestinatario=$respuesta_modelo_contruir_correo['ccDestinatario'];
                $coc_id=$respuesta_modelo_contruir_correo['coc_id'];
                $archivos_adjuntos=$respuesta_modelo_contruir_correo['archivos_adjuntos'];


                if (!isset(
                    $respuesta_modelo_contruir_correo['asunto'],
                    $respuesta_modelo_contruir_correo['template'],
                    $respuesta_modelo_contruir_correo['destinatario']
                )|| empty($respuesta_modelo_contruir_correo['asunto']) ||
                    empty($respuesta_modelo_contruir_correo['template']) ||
                    empty($respuesta_modelo_contruir_correo['destinatario'])) {
                    $this->db->rollback();
                    $answer['titular']="AVISO";
                    $answer['mensaje'] = "Faltan algunas claves en el array de respuesta.";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                
                $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
                if($enviar_correo_estatus!=1){
                    $this->db->rollback();
                    $answer['titular']='AVISO';
                    $answer['estado']=-1;
                    $answer['mensaje']='El envío de correos esta desactivado. Comuníquese con un administrador.';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }


                $respuesta_modelo=$obj_correo->enviar_correo($destinatario,$ccDestinatario,$template,$asunto,$mensajeCorreo="",$coc_id,$requiere_iconos_pie=0,$copiaOculta="",$archivos_adjuntos);
                if( $respuesta_modelo["estado"]==2){
                    $answer['mensaje']='Correo enviado';
                    $answer['titular']='OK';
                    $answer['estado']=2;

                }elseif ($respuesta_modelo["estado"]==-2) {
                    $answer['titular']='ERROR';
                    $answer['mensaje']='El correo no se pudo enviar';
                    throw new Exception("Error en el modelo para enviar correo…");

                }
                $data_bit=[
                    'bit_descripcion'=>"Utilizó correo para el envío de facturación del candidato con folio ".$can_id,
                    'bit_tablaid'=>$can_id,
                    'bit_modulo'=>"Correo facturación",
                    'vac_id'=>$vac_id,
                    'bit_accion'=>1,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->db->commit();
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;


        } catch (\Exception $e) {
            $this->db->rollback();
            $answer['mensaje']='ERROR';
            $answer['titular']='ERROR ENVIAR CORREO';
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            error_log($answer['mensaje']);
            $data_bit = [
                'bit_descripcion'=>'ERROR AL ENVIAR CORREO DE FACTURACIÓN : '.$answer["mensaje"],
                'bit_tablaid' => $can_id,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
            die();
        }

    }
}