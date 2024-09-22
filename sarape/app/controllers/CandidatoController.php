<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class CandidatoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Candidato');
        parent::initialize();
    }

    //busca coincidencias en base al nombre completo 
    public function ajax_get_coincidencias_by_nombre_completoAction(){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al consultar los datos del expediente ',
            'titular' => 'Error',
        ];
   

        try {
            $data = $this->request->getPost();
            if ($this->request->isAjax()) {
                $can_nombre = $data['can_nombre'];
                $can_primerapellido = trim($data['can_primerapellido']);
                $can_segundoapellido = trim($data['can_segundoapellido']);
                if ($can_nombre === null || trim($can_nombre) === '' ||
                    $can_primerapellido === null || trim($can_primerapellido) === '' ||
                    $can_segundoapellido === null || trim($can_segundoapellido) === '') {
                    $answer['titular'] = 'AVISO';
                    $answer['estado'] = 1;
                    $answer['mensaje'] = "Uno o más campos están nulos o vacíos";
                    $answer['data'] = null;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }

                $nombreCompleto = $can_nombre . ' ' . $can_primerapellido . ' ' . $can_segundoapellido;
                $condicion_sql_vac = 'TRIM(CONCAT(TRIM(can.can_nombre), " ", TRIM(can.can_primerapellido), " ", TRIM(can.can_segundoapellido))) LIKE "%' . $nombreCompleto . '%"';
                $regs = new Builder();
                $regs = $regs
                ->columns(array(
                    'vac.vac_id',
                    'exc.exc_id',
                    'can.can_id',
                    'CONCAT(can.can_nombre, " ", can.can_primerapellido, " ", can.can_segundoapellido) AS can_nombre_completo'
                    ))
                ->addFrom('Candidato', 'can')
                ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac');

                $regs = $regs->where($condicion_sql_vac);
                $reg = $regs->getQuery()->execute();
                
                if(count($reg)>0){
                    $answer['titular'] = 'Éxito';
                    $answer['estado'] =2;
                    $answer['mensaje'] ="OK";
                }else{
                    $answer['titular'] = 'OK';
                    $answer['estado'] =1;
                    $answer['mensaje'] ="NO DATA";
                }

                $answer['data'] =$reg;
            } 
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {    
                // El error es una Notice
               // $this->db->rollback();
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $authF['id'] = 0;
                $answer['detalle'] = $mensaje;
                $data_bit = [
                    'bit_descripcion' => 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea,
                    'bit_tablaid' => 0,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 1,
                ];
                $this->bitacora_registro($data_bit, $authF);        
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
           
        }
    }
    //busca coincidencias en base a la curp
    public function ajax_get_coincidencias_by_curpAction(){
        
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al consultar los datos del expediente ',
            'titular' => 'Error',
        ];
        $mensaje_extra = '';
        $mensaje_extra_bitacora = '';
        $condicion_sql_vac='';
        try {
            $data = $this->request->getPost();
            if ($this->request->isAjax()) {

                $can_curp = trim($data['can_curp']);
                if ($can_curp === null || trim($can_curp) === '') {
                    $answer['titular'] = 'AVISO';
                    $answer['estado'] = 1;
                    $answer['mensaje'] = "El valor de can_curp es nulo o vacío";
                    $answer['data'] = null; 
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                $condicion_sql_vac = "TRIM(can.can_curp) = '$can_curp'";
                $regs = new Builder();
                $regs = $regs
                ->columns(array(
                    'vac.vac_id',
                    'exc.exc_id',
                    'can.can_id',
                    'CONCAT(can.can_nombre, " ", can.can_primerapellido, " ", can.can_segundoapellido) AS can_nombre_completo'
                ))
                ->addFrom('Candidato', 'can')
                ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac');

                $regs = $regs->where($condicion_sql_vac);
                $reg = $regs->getQuery()->execute();
                
                if(count($reg)>0){
                    $answer['titular'] = 'Éxito';
                    $answer['estado'] =2;
                    $answer['mensaje'] ="OK";
                }else{
                    $answer['titular'] = 'OK';
                    $answer['estado'] =1;
                    $answer['mensaje'] ="NO DATA";
                }

                $answer['data'] =$reg;
            } 
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {    
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $authF['id'] = 0;
                $answer['detalle'] = $mensaje;
                $data_bit = [
                    'bit_descripcion' => 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea,
                    'bit_tablaid' => 0,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 1,
                ];
                $this->bitacora_registro($data_bit, $authF);        
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        }

    }


    public function ajax_get_detalle_completoAction($can_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        try {
            if ($this->request->isAjax() && $can_id > 0) {
                $exc_obj=new Expedientecan();
                $vac_obj=new Vacante();

               ///DATOS CANDIDATO INICIO -------------------------------------------INICIO 
                $registro =Candidato::query()
                ->columns(array('
                    Candidato.can_celular,
                    Candidato.can_actualizo,
                    Candidato.can_correo,
                    Candidato.can_curp,
                    Candidato.can_id,
                    Candidato.can_nosegsocial,
                    Candidato.can_telefono,
                    Candidato.can_valido,
                    Candidato.can_registro,
                    CONCAT(Candidato.can_nombre," ", Candidato.can_primerapellido," ",Candidato.can_segundoapellido) as can_nombre,
                    CONCAT(can_usu_alta.usu_nombre," ", can_usu_alta.usu_primerapellido," ",can_usu_alta.usu_segundoapellido) as can_usu_alta_nombre
                '))
                ->leftjoin('Usuario','can_usu_alta.usu_id=Candidato.usu_idalta','can_usu_alta')
                ->where('Candidato.can_id='.$can_id)
                ->execute();
                ///DATOS CANDIDATO FIN -------------------------------------------FIN 

                //DATOS VACANTE EXPEDIENTE  CANDIDATO INI----------------------------INI 
                $condicion_sql_vac_exc="can.can_id=".$can_id;
                $regs_vacs_exc = new Builder();
                $regs_vacs_exc = $regs_vacs_exc
                ->columns(array(
                    'vac.vac_id',
                    'vac.vac_fecharegistro',
                    'vac.vac_actualizacion',
                    'vac.vac_estatus',
                    'vac.vac_estatus',
                    'exc.exc_id',
                    'emp.emp_nombre',
                    'cav.cav_nombre',
                    'vac.cav_id',
                    'can.can_id'

                ))
                ->addFrom('Candidato', 'can')
                ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp');
                $regs_vacs_exc = $regs_vacs_exc->where($condicion_sql_vac_exc);
                $regs_vacs_exc = $regs_vacs_exc->getQuery()->execute();
                $regs_vacs_exc= $regs_vacs_exc->toArray();
           
              // error_log(gettype($regs_vacs_exc[0]));
               
                //DATOS VACANTE EXPEDIENTE  CANDIDATO FIN----------------------------FIN 

                //DATOS  EXPEDIENTE  CANDIDATO INI----------------------------INI 
                $condicion_sql_exc_can="exc.can_id=".$can_id;
                $regs_exc_can = new Builder();
                $regs_exc_can = $regs_exc_can
                 ->columns(array(
                     'exc.vac_id',
                     'exc.exc_id',
                     'exc.exc_registro',
                     'exc.exc_estatus',
                     'exc.exc_actualizo',
                     'can.can_id',
                 ))
                 ->addFrom('Candidato', 'can')
                 ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc');
                 $regs_exc_can = $regs_exc_can->where($condicion_sql_exc_can);
                 $regs_exc_can = $regs_exc_can->getQuery()->execute();
                //DATOS  EXPEDIENTE  CANDIDATO FIN----------------------------FIN 

                //METRICAS -ANALISTICAS INI----------------------------INI 
                    //expedientes facturados normal ini
                     $condicion_sql_exc_can_fat="exc.can_id=".$can_id." AND exc.exc_estatus IN (" . implode(",", $exc_obj->estatus_facturado) . ") AND fat.vac_estatus=".$vac_obj->estatus_proceso;   
                     $regs_exc_can_fat = new Builder();
                     $regs_exc_can_fat = $regs_exc_can_fat
                      ->columns(array(
                          'exc.vac_id',
                          'exc.exc_id',
                          'can.can_id',
                      ))
                      ->addFrom('Candidato', 'can')
                      ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc')
                      ->leftjoin('Facturacion','fat.exc_id=exc.exc_id AND fat.fat_estatus=2','fat');
                      $regs_exc_can_fat = $regs_exc_can_fat->where($condicion_sql_exc_can_fat);
                      $regs_exc_can_fat = $regs_exc_can_fat->getQuery()->execute();
                      $regs_exc_can_fat = $regs_exc_can_fat->count();
                    //expedientes facturados normal fin

                    //expedientes facturados garantia vacante ini
                    $condicion_sql_exc_can_fat_garantia_vac="exc.can_id=".$can_id." AND exc.exc_estatus IN (" . implode(",", $exc_obj->estatus_facturado) . ") AND fat.vac_estatus=".$vac_obj->estatus_garantia;   
                    $regs_exc_can_fat_garantia_vac = new Builder();
                    $regs_exc_can_fat_garantia_vac = $regs_exc_can_fat_garantia_vac
                    ->columns(array(
                    'exc.vac_id',
                    'exc.exc_id',
                    'can.can_id',
                    ))
                    ->addFrom('Candidato', 'can')
                    ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc')
                    ->leftjoin('Facturacion','fat.exc_id=exc.exc_id AND fat.fat_estatus=2','fat');
                    $regs_exc_can_fat_garantia_vac = $regs_exc_can_fat_garantia_vac->where($condicion_sql_exc_can_fat_garantia_vac);
                    $regs_exc_can_fat_garantia_vac = $regs_exc_can_fat_garantia_vac->getQuery()->execute();
                    $regs_exc_can_fat_garantia_vac = $regs_exc_can_fat_garantia_vac->count();
                    //expedientes facturados garantia vacante fin

                    //expedientes no aceptados-ini
                    $condicion_sql_exc_can_no_aceptados="exc.can_id=".$can_id." AND exc.exc_estatus IN (" . implode(",", $exc_obj->estatus_cancelados) . ")";
                     $regs_exc_can_no_aceptados= new Builder();
                     $regs_exc_can_no_aceptados = $regs_exc_can_no_aceptados
                      ->columns(array(
                          'exc.vac_id',
                          'exc.exc_id',
                          'can.can_id',
                      ))
                      ->addFrom('Candidato', 'can')
                      ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc');
                      $regs_exc_can_no_aceptados = $regs_exc_can_no_aceptados->where($condicion_sql_exc_can_no_aceptados);
                      $regs_exc_can_no_aceptados = $regs_exc_can_no_aceptados->getQuery()->execute();
                      $regs_exc_can_no_aceptados = $regs_exc_can_no_aceptados->count();
                    //expedientes no aceptados-fin

                    //expedientes en proceso-ini
                    $condicion_sql_exc_can_proceso="exc.can_id=".$can_id." AND exc.exc_estatus  IN (" . implode(",", $exc_obj->estatus_proceso) . ")";
                         $regs_exc_can_proceso = new Builder();
                         $regs_exc_can_proceso = $regs_exc_can_proceso
                          ->columns(array(
                              'exc.vac_id',
                              'exc.exc_id',
                              'can.can_id',
                          ))
                          ->addFrom('Candidato', 'can')
                          ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc');
                          $regs_exc_can_proceso = $regs_exc_can_proceso->where($condicion_sql_exc_can_proceso);
                          $regs_exc_can_proceso = $regs_exc_can_proceso->getQuery()->execute();
                          $regs_exc_can_proceso = $regs_exc_can_proceso->count();

                    //expedientes en proceso-fin

                 //METRICAS -ANALISTICAS FIN----------------------------FIN 
 
                if (count($registro)>0) {
                    $answer['estado'] = 2;
                    $answer['data_can'] = $registro[0];
                    $answer['can_id'] = $can_id;
                    $answer['data_can_vac'] = $regs_vacs_exc;
                    $answer['data_can_exc'] = $regs_exc_can;
                    $answer['metricas']['exc_cancelados'] = $regs_exc_can_no_aceptados;
                    $answer['metricas']['exc_proceso'] = $regs_exc_can_proceso;
                    $answer['metricas']['exc_facturados_normal'] = $regs_exc_can_fat;
                    $answer['metricas']['exc_facturados_garantia'] = $regs_exc_can_fat_garantia_vac;
                    $answer['mensaje']='OK';
                    $answer['titular']='OK';
                } else {
                    $answer['estado'] = -1;
                }
            } else {
                $answer['estado'] = -1;
            }
        } catch (\Exception $e) {
            $answer['estado'] = -1;
            $answer['mensaje']='ERROR';
            $answer['titular']='ERROR';
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            error_log($answer['mensaje']);
            $data_bit = [
                'bit_descripcion'=>'ERROR OBTENER DETALLES DE GET EN CANDIDATO : '.$answer["mensaje"],
                'bit_tablaid' => $can_id,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();

    }


    public function enviar_agradecimiento_correoAction($can_id=0,$vac_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer['estado'] = -2;
        $condicion_sql="";
        $this->db->begin();

        try {

                if (!$this->request->isAjax() || !$can_id > 0) {throw new Exception("Formato no adecuado de solicitud...");}

                $candidato= Candidato::findFirst($can_id);

                if(!$candidato){throw new Exception("Candidato no encontradó...");}
                
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
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    can.can_id,
                    CONCAT(aux.usu_nombre," ", aux.usu_primerapellido," ",aux.usu_segundoapellido) as aux_nombre,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    sel.usu_idauxiliar AS aux_id,
                    exc.exc_id,
                    exc.eje_idprincipal,
                    exc.exc_estatus
    
                '))
                ->addFrom('Expedientecan','exc')
                ->leftjoin('Cita','cit.exc_id=exc.exc_id','cit')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Seccionlaboral','sel.exc_id=exc.exc_id','sel')
                ->leftjoin('Usuario','aux.usu_id=sel.usu_idauxiliar','aux')
                ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                ->leftjoin('Usuario','exc_eje.usu_id=exc.eje_idprincipal','exc_eje')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav');
                $condicion_sql.="vac.vac_id=".$vac_id;
                $vacante = $vacantes->where($condicion_sql);    
                $vacante = $vacante->getQuery()->execute();
                if(count($vacante)==0){throw new Exception("Vacante no encontrada...");}


                $ejecutivo= Usuario::findFirst($vacante[0]->eje_idprincipal);
                if(!$ejecutivo){throw new Exception("Ejecutivo no encontradó...");}
                if(trim($ejecutivo->usu_correo)==""){throw new Exception("Ejecutivo no tiene cargado un correo...");}

                // $obj_correo=new Configcorreo();
                $obj_correo=new ServicioCorreo();
                $respuesta_modelo_contruir_correo=$obj_correo->contruirMaquetaCorreoAgradecimientoCandidato($vacante,$candidato,$ejecutivo);
                if($respuesta_modelo_contruir_correo['estado']!=2){
                    $this->db->rollback();
                    $answer['titular']=$respuesta_modelo_contruir_correo['titular'];
                    $answer['estado']=$respuesta_modelo_contruir_correo['estado'];
                    $answer['mensaje']=$respuesta_modelo_contruir_correo['mensaje'];
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }

               

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
                $asunto=$respuesta_modelo_contruir_correo['asunto'];
                $template=$respuesta_modelo_contruir_correo['template'];
                $destinatario=$respuesta_modelo_contruir_correo['destinatario'];
                $ccDestinatario=$respuesta_modelo_contruir_correo['ccDestinatario'];
                $coc_id=1;

                $configuracion_obj=new Configuracion();
                $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
                if($enviar_correo_estatus==1){ 
                    
                    $respuesta_modelo=$obj_correo->enviar_correo($destinatario,$ccDestinatario,$template,$asunto,$template,$coc_id);
                    if( $respuesta_modelo["estado"]==2){
                        $answer['mensaje']='Correo enviado';
                        $answer['titular']='OK';
                        $answer['estado']=2;
                    }elseif ($respuesta_modelo["estado"]==-2) {
                        $answer['titular']='ERROR';
                        $answer['mensaje']='Correo no se pudo enviar';
                        throw new Exception("Error en el modelo para enviar correo...");

                    }
                    $data_bit=[
                        'bit_descripcion'=>"Utilizó correo para mensaje de agradecimiento para el candidato con folio. ".$can_id,
                        'bit_tablaid'=>$can_id,
                        'bit_modulo'=>"Correo agradecimiento",
                        'vac_id'=>$vac_id,
                        'bit_accion'=>1,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                
                }else{
                    $this->db->rollback();
                    $answer['titular']='AVISO';
                    $answer['estado']=-1;
                    $answer['mensaje']='El envío de correos esta desactivado. Comuníquese con un administrador.';
                    $this->response->setJsonContent($answer);
                    $this->response->send();            
                    return;
                }
        
                $this->db->commit();    
                $this->response->setJsonContent($answer);
                $this->response->send();            
                return;

              
        } catch (\Exception $e) {
            $this->db->rollback();
            $answer['mensaje']='ERROR';
            $answer['titular']='ERROR AL  ENVIAR CORREO DE AGRADECIMIENTO';
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            error_log($answer['mensaje']);
            $data_bit = [
                'bit_descripcion'=>'ERROR AL ENVIAR CORREO DE AGRADECIMIENTO : '.$answer["mensaje"],
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

    public function enviar_agradecimiento_whatsAction($can_id=0,$vac_id=0){
        $this->view->disable();
        $auth = $this->session->get('auth');
        $rol = new Rol();
        $answer = array();
        $answer['mensaje']='ERROR';
        $mensaje_extra="";
        $condicion_sql="";

        $this->db->begin();
        try {
            if ($this->request->isAjax() && $can_id > 0) {
                $configuracion= Configuracion::findFirst(11);
                if(!$configuracion){
                    throw new Exception("Configuración no encontrada...");
                }
                $candidato= Candidato::findFirst($can_id);
                if(!$candidato){
                    throw new Exception("Candidato no encontradó...");
                }

                $vacantes = new Builder();
                $vacantes = $vacantes
                ->columns(array('
                    vac.vac_actualizacion,vac.vac_observaciones,
                    vac.vac_fechasolicitud,vac.vac_fecharegistro,
                    vac.vac_experiencia,vac.vac_funcionprincipal,
                    vac.vac_estatus,
                    vac.vac_habilidad,vac.vac_conceptotecnico,
                    vac.vac_id,
                    emp.emp_nombre,
                    emp.emp_id,
                    emp.emp_alias,
                    est.est_nombre,
                    mun.mun_nombre,
                    cav.cav_nombre,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    can.can_id,
                    CONCAT(aux.usu_nombre," ", aux.usu_primerapellido," ",aux.usu_segundoapellido) as aux_nombre,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    sel.usu_idauxiliar AS aux_id,
                    exc.exc_id,
                    exc.eje_idprincipal,
                    exc.exc_estatus
    
                '))
                ->addFrom('Expedientecan','exc')
                ->leftjoin('Cita','cit.exc_id=exc.exc_id','cit')
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Seccionlaboral','sel.exc_id=exc.exc_id','sel')
                ->leftjoin('Usuario','aux.usu_id=sel.usu_idauxiliar','aux')
                ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                ->leftjoin('Usuario','exc_eje.usu_id=exc.eje_idprincipal','exc_eje')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav');
                $condicion_sql.="vac.vac_id=".$vac_id;
                $vacante = $vacantes->where($condicion_sql);    
                $vacante = $vacante->getQuery()->execute();


                $mensaje_whatsapp=$configuracion->cof_valor;
                $mensaje_whatsapp=str_replace("#nombre_candidato#", $candidato->can_nombre, $mensaje_whatsapp);
                $mensaje_whatsapp=str_replace("#nombre_vacante#", $vacante[0]->cav_nombre, $mensaje_whatsapp);


                
                $answer['titular']='LINK DE WHATSAPP';
                $answer['estado']=2;
                $answer['can_id']=$can_id;
                $answer['mensaje']="LINK";
                $answer['mensaje_link']=$mensaje_whatsapp;
                $prefijo_default="+52";
                $answer['numero_telefono']="";
                if(trim($candidato->can_celular)!=""){
                    $answer['numero_telefono']=$candidato->can_celular;      
                }else{
                    $answer['numero_telefono']=$candidato->can_telefono;      
                } 
                if (!(strpos($answer['numero_telefono'], $prefijo_default) === 0)) {
                    $answer['numero_telefono']=$prefijo_default.$answer['numero_telefono'];
                } 
                $data_bit=[
                    'bit_descripcion'=>"Utilizó link de WhatsApp para mensaje de agradecimiento para el candidato con folio. ".$can_id,
                    'bit_tablaid'=>$can_id,
                    'bit_modulo'=>"Link WhatsApp",
                    'vac_id'=>$vac_id,
                    'bit_accion'=>1,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->db->commit();    
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            } else {
                throw new Exception("Error en formato de solicitud...");
            }

        } catch (\Exception $e) {
            $this->db->rollback();
            $answer['estado'] = -1;
            $answer['mensaje']='ERROR';
            $answer['titular']='ERROR';
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            error_log($answer['mensaje']);
            $data_bit = [
                'bit_descripcion'=>'ERROR AL ENVIAR WHATSAPP DE AGRADECIMIENTO : '.$answer["mensaje"],
                'bit_tablaid' => $can_id,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    
}