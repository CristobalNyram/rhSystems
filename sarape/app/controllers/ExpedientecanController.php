<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class ExpedientecanController extends ControllerBase
{
    public function initialize()
    {

    }

    public function ajax_get_detalle_estatus_cambioAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $this->view->disable();
        $this->db->begin();

        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $obj_exc=new Expedientecan();
                $registro = Expedientecan::query()
                    ->columns('
                    
                        Expedientecan.exc_autorizado,
                        Expedientecan.exc_id,
                        Expedientecan.can_id,
                        Expedientecan.exc_estatus,
                        can.can_curp 
                    ')
                    ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can')
                    ->where('Expedientecan.exc_id=' . $exc_id)
                    ->execute();
        
                if (count($registro)>0) {
                    $respuesta_modelo_estatus_mostrar=$obj_exc->getEstatusSiNoMostrar($registro[0]->exc_estatus);
                    $answer[0] = 1;
                    $answer['data'] = $registro[0];
                    $answer['mensaje']='OK';
                    $answer['opciones']=$respuesta_modelo_estatus_mostrar;
                    $this->db->commit();

                } else {
                    throw new Exception("Sin registros");

                }
            } else {
                throw new Exception("No tiene el formato adecuado");
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $error_msg = "Excepción en ajax_get_detalle_estatus_cambioAction: " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");


            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function ajax_get_detalleAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $answer = array();
        $this->view->disable();
        
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $registro = Expedientecan::query()
                    ->columns('
                        Expedientecan.exc_id,
                        Expedientecan.can_id,
                        Expedientecan.vac_id,
                        Expedientecan.exc_estatus,
                        Expedientecan.exc_autorizado,
                        Expedientecan.exc_estatusprevio,
                        Expedientecan.eje_idprincipal,
                        vac.vac_estatus,
                        cav.cav_nombre,
                        can.can_curp,
                        can.can_correo,
                        can.can_telefono,
                        can.can_celular,
                        can.can_registro,
                        can.can_valido,
                        can.can_nosegsocial,
                        CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                        usualta.usu_id AS usu_idalta,
                        CONCAT(usualta.usu_nombre," ", usualta.usu_primerapellido," ",usualta.usu_segundoapellido) as usu_nombrealta,
                        CONCAT(eje_exc.usu_nombre," ", eje_exc.usu_primerapellido," ",eje_exc.usu_segundoapellido) as eje_exc_nombre,
                        emp.emp_nombre
                        ')
                    ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
                    ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                    ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                    ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can')
                    ->leftjoin('Usuario','usualta.usu_id=can.usu_idalta','usualta')
                    ->leftjoin('Usuario','eje_exc.usu_id=Expedientecan.eje_idprincipal','eje_exc')
                    ->where('exc_id=' . $exc_id)
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
            $error_msg = "Excepción en ajax_get_detalleAction: " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function cambiar_estatusAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $answer["estado"] = -2;
        $answer["estado"] = -2;

        $mensaje_extra_bitacora="";
        // $mensaje_final_correo_fat="";
        $answer = array();
        $this->view->disable();
        $data = $this->request->getPost();
        $data_arv = isset($_FILES["arv"]) && $_FILES["arv"]["error"] === UPLOAD_ERR_OK ? $_FILES["arv"] : null;

        $this->db->begin();

        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $expedientecan= Expedientecan::findFirst($exc_id);
                $vac_id= $expedientecan->vac_id;

                $obj_com= new Comentarioexc();
                $obj_ent= new Entrevista();
                $obj_vac= new Vacante();
                $obj_arv = new Archivovac();
                $obj_fat= new Facturacion();
                $obj_helper= new Helper();

            

                if($expedientecan){
                    
                $answer["vac_id"] = $expedientecan->vac_id;

                //VALIDACION DEL LA CURP OBLIGATORIA EN ESTATUS VIGENTES --INICIO
                $respuesta_modelo_estatus_no_obligatorio_curp=$expedientecan->buscaValorEnArrayCitaNoSigue($data["exc_estatus"]);
                $candidato_encontrado = Candidato::findFirst($expedientecan->can_id);
                $candidato_continua=false;
                if ($respuesta_modelo_estatus_no_obligatorio_curp) {
                    // Si el estatus está en la lista de estatus no obligatorios de CURP.
                } else {
                    $candidato_buscar_validar_curp = Candidato::findFirst($expedientecan->can_id);
                
                    if ($candidato_buscar_validar_curp->can_curp=="") {
                        $this->db->rollback();
                        $answer = [
                            'estado' => -1,
                            'mensaje' => 'NO SE HA CARGADO LA CURP AL CANDIDATO, ES NECESARIO CARGAR LA CURP',
                            'titular' => 'AVISO',
                            'vac_id' => $expedientecan->vac_id,
                        ];
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                    // Si llegas a este punto, significa que la CURP no está vacía y puedes continuar con el código.
                    // Agrega cualquier otra lógica que necesites después de la validación de CURP.
                }
                //VALIDACION DEL LA CURP OBLIGATORIA EN ESTATUS VIGENTES --FIN


                //VALIDACION DE LA CURP OBLIGATORIA EN ESTATUS VIGENTES

                //VALIDAMOS EL ARCHIVO INCIO
                if ($data_arv != null) {
                    $respuesta_modelo_arv = $obj_arv->NuevaCotizacion($data_arv, $auth, $vac_id);
                    // Validar si ocurrió un error al subir el archivo
                    if ($respuesta_modelo_arv["estado"] == -1) {
                        error_log("no guardo no guardo el archivo");
                        $this->db->rollback();
                        $answer = [
                            'estado' => -1,
                            'mensaje' => $respuesta_modelo_arv[2],
                            'titular' => 'AVISO',
                        ];
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                    if ($respuesta_modelo_arv["estado"] == -2) {
                        $this->db->rollback();
                        $answer = [
                            'estado' => -1,
                            'mensaje' =>"ERROR AL SUBIR EL ARCHIVO",
                            'titular' => 'AVISO',
                        ];
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }else{
                        $mensaje_extra_bitacora.=", subió un archivo archivo de cotización con id ".$respuesta_modelo_arv["arv_id"];
                    }
                    
                }
                //VALIDAMOS EL ARCHIVO FIN


                    // validación de estatus actual si es ---inicio
                    $respuesta_modelo_validar_estatus_actual= $expedientecan->validarSiConcidenEstatusFrontBack($expedientecan->exc_estatus,$data['exc_estatus_actual']);
                        if($respuesta_modelo_validar_estatus_actual["estado"]!=2){
                            if($respuesta_modelo_validar_estatus_actual["estado"]==-1){//el estatus no es valido para cambiar estatus y se manda aviso
                                $this->db->rollback();
                                $answer["estado"] =$respuesta_modelo_validar_estatus_actual["estado"];
                                $answer["mensaje"] = $respuesta_modelo_validar_estatus_actual["mensaje"];
                                $this->response->setJsonContent($answer);
                                $this->response->send();
                                return;
                            }
                         
                        }
                    // validación de estatus actual si es ---fin
                    
                    // validar si no esta en estatus de vacante---inicio
                    $respuesta_modelo_validar_estatus_vac= $obj_vac->validarEstatusVacante($expedientecan->vac_id,$data['exc_estatus']);
                    if($respuesta_modelo_validar_estatus_vac["estado"]!=2){
                        if($respuesta_modelo_validar_estatus_vac["estado"]==-1){//el estatus no es valido para cambiar estatus y se manda aviso
                            $this->db->rollback();
                            $answer["estado"] =$respuesta_modelo_validar_estatus_vac["estado"];
                            $answer["mensaje"] = $respuesta_modelo_validar_estatus_vac["mensaje"];
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                     
                    }
                    // validar si no esta en estatus de vacante ----- fin

                    $data_crear_encontrar_cambio=[];
                    $data_crear_encontrar_cambio["comentario"]=$data["com"]["com_comentario"];
                    $data_com=$data["com"];
                    $data_com["exc_id"]=$exc_id;
                    $vac_id=$expedientecan->vac_id;
                    $data_com["exc_estatus"]=$expedientecan->exc_estatus;
                    $comentario_ori=$data_com["com_comentario"];
                    
                    //validamos si continua si o no 
                    if (!in_array($data['exc_estatus'], $expedientecan->estatus_no_sigue)) {
                        $candidato_continua = true;
                    }
                    //validamos si continua si o no 

                    //validamos antes hacer procesos----- inicio
                    if($data["exc_estatus"]==6){
                    
                        $respuesta_modelo_disponible_facturacion= $obj_vac->validarDisponibilidadFacturacion($vac_id);
                       // error_log(print_r($respuesta_modelo_disponible_facturacion));
                        if($respuesta_modelo_disponible_facturacion["estado"]==-2){
                            $this->db->rollback();
                            //throw new Exception("Ya no se puede mandar a facturación, los espacios an sido cubiertos");
                            $answer["estado"] = -1;
                            $answer["mensaje"] = $respuesta_modelo_disponible_facturacion["mensaje"];
                            $answer["titular"] = $respuesta_modelo_disponible_facturacion["titular"];
                            $answer["vac_id"] = $expedientecan->vac_id;
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                    }
                    //validamos antes hacer procesos------- fin

                    $data_com["com_comentario"]="CAMBIÓ A ".$expedientecan->getEstatusTexto($data["exc_estatus"]).". ".$comentario_ori;
                    $data_com["com_seguimiento"]=1;
                        
                    $respuesta_modelo_helper_secciones_exc= $obj_helper->CrearEncontrarRegistroSeccionCambioEstatusExc($data["exc_estatus"],$exc_id,$auth,$data_crear_encontrar_cambio);
                   
                   if($respuesta_modelo_helper_secciones_exc["estado"]==-2){
                        //$this->db->rollback();
                        throw new Exception("Error al crear/encontrar los registros. Detalles".print_r($respuesta_modelo_helper_secciones_exc));
                    }
                    elseif($respuesta_modelo_helper_secciones_exc["estado"]==2)
                            $mensaje_extra_bitacora.=", ".$respuesta_modelo_helper_secciones_exc["mensaje"];
                    
                   $respuesta_modelo_exc= $expedientecan->cambiarEstatus($data,$auth);

                   //validamos si mando a facturacion inicio
                   if($data["exc_estatus"]==6){
                        
                        ///VALIDAMOS ESTATUS PARA MANDAR A FACTURACION
                        $respuesta_modelo_vac_validar_estatus_fat= $obj_vac->validarEstatusVacante_MandaFacturacion($vac_id);
                        if($respuesta_modelo_vac_validar_estatus_fat["estado"]==-2){
                            $this->db->rollback();
                            $answer["estado"] = -1;
                            $answer["vac_id"] = $expedientecan->vac_id;
                            $answer["mensaje"] =$respuesta_modelo_vac_validar_estatus_fat["mensaje"] ;
                            $answer["titular"] =$respuesta_modelo_vac_validar_estatus_fat["titular"];
                            $answer["no_cotinua_mostrar_agradecimiento"]=$candidato_continua;
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                        ///VALIDAMOS ESTATUS PARA MANDAR A FACTURACION

                        
                        //ACTUALIZAMOS O CREAMOS DATOS DE FACTURACION----inicio
                        $data_fat=$data["fat"];
                        $respuesta_modelo_fat= $obj_fat->setUpdateOrCreateData($exc_id,$data_fat,$auth);
                        if($respuesta_modelo_fat["estado"]==-2){
                            //$this->db->rollback();
                            throw new Exception("Error al actualizar/crear facturación . Detalles".print_r($respuesta_modelo_fat));
                        }
                        elseif($respuesta_modelo_fat["estado"]==2)
                            $mensaje_extra_bitacora.=", ".$respuesta_modelo_fat["mensaje"];
                        //ACTUALIZACION O CREAMOS DATOS DE FACTURACION----fin


                        //VALIDAMOS SI ESTA DISPONIBLE PARA FACTURAC ---inicio
                        $respuesta_modelo_vac_mandar_fat= $obj_vac->mandarAFacturacionSiSuperoLimite($vac_id,$auth);
                        if($respuesta_modelo_vac_mandar_fat["estado"]==-2){
                            $this->db->rollback();
                            //throw new Exception("Error al intentar analizar el cambio de estatus vacante [MANDAR FACTURACION] ".print_r($respuesta_modelo_vac_mandar_fat));
                            $answer["estado"] = -1;
                            $answer["mensaje"] = $respuesta_modelo_vac_mandar_fat["mensaje"];
                            $answer["titular"] = $respuesta_modelo_vac_mandar_fat["titular"];
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                        elseif($respuesta_modelo_vac_mandar_fat["estado"]==2){
                            $mensaje_extra_bitacora.=", ".$respuesta_modelo_vac_mandar_fat["mensaje"];                            

                        }
                        //VALIDAMOS SI ESTA DISPONIBLE PARA FACTURAC ---fin


                   }
                    //validamos si mando a facturacion---------fin

                   $respuesta_modelo_com=$obj_com->NuevoRegistroCambioEstatus($data_com,$auth);
                   if($respuesta_modelo_exc["estado"]==2 && $respuesta_modelo_com["estado"]==2){

                        $answer['mensaje']='Se realizó el cambio de estatus del expediente No. '.$exc_id.' a el estatus '.$expedientecan->getEstatusTexto($expedientecan->exc_estatus)."  ";
                        $answer["estado"] = 2;
                        $answer["vac_id"] = $expedientecan->vac_id;
                        $answer["exc_estatus"] = $expedientecan->exc_estatus;
                        error_log($expedientecan->exc_estatus);
                        $answer["candidato"]=$candidato_encontrado;
                        $answer["no_cotinua_mostrar_agradecimiento"]=$candidato_continua;
                        $data_bit=[
                            'bit_descripcion'=>'Se cambió de estatus el expediente del candidato al estatus '.' '.$expedientecan->getEstatusTexto($expedientecan->exc_estatus). ' tenía estatus '.$expedientecan->getEstatusTexto($expedientecan->exc_estatusprevio).' '.$mensaje_extra_bitacora,
                            'bit_tablaid'=>$respuesta_modelo_exc['exc_id'],
                            'bit_modulo'=>"Cambiar estatus",
                            'vac_id'=>$respuesta_modelo_exc['vac_id'],
                            'bit_accion'=>1,
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        $this->db->commit();

                   }else{
                    throw new Exception("Error al acutalizar los datos");
                   }

                }else{
                    throw new Exception("No existe el registro.");
                }

            }else{
                 throw new Exception("No existe el registro, datos incorrectos");
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $data_bit = [
                'bit_descripcion'=>'ERROR CAMBIAR ESTATUS EXPEDIENTE : '.$answer["mensaje"],
                'bit_tablaid' => $exc_id,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function autorizarAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $answer["estado"] = -2;
        $mensaje_extra_bitacora="";
        $answer = array();
        $this->view->disable();
        $data = $this->request->getPost();
        $this->db->begin();
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $expedientecan= Expedientecan::findFirst($exc_id);
                $obj_com= new Comentarioexc();
                $obj_helper= new Helper();

                if($expedientecan){
                    $data_com=$data["com"];
                    $data_com["exc_id"]=$exc_id;
                    $data_com["exc_estatus"]=$expedientecan->exc_estatus;

                    $comentario_ori=$data_com["com_comentario"];
                    $data_com["com_comentario"]=$obj_helper->autorizo_text($data["exc_autorizado"])."  ".$comentario_ori;

                   $respuesta_modelo_exc= $expedientecan->autorizar_o_no($data,$auth);
                    if($respuesta_modelo_exc["estado"]==-2)
                        throw new Exception("Error al autorizar/sino los registros. Detalles".print_r($respuesta_modelo_exc));
                    elseif($respuesta_modelo_exc["estado"]==2)
                            $mensaje_extra_bitacora.=$respuesta_modelo_exc["mensaje"];
                    

                   
                   $respuesta_modelo_com=$obj_com->NuevoRegistro($data_com,$auth);
                   if($respuesta_modelo_exc["estado"]==2 && $respuesta_modelo_com["estado"]==2){

                        $answer['mensaje']=$obj_helper->autorizo_text($data["exc_autorizado"]).'  expediente No. '.$exc_id;
                        $answer["estado"] = 2;
                        $data_bit=[
                            'bit_descripcion'=>$obj_helper->autorizo_text($data["exc_autorizado"]).' expediente del candidato ',
                            'bit_tablaid'=>$respuesta_modelo_exc['exc_id'],
                            'bit_modulo'=>"Autorizar expediente",
                            'vac_id'=>$respuesta_modelo_exc['vac_id'],
                            'bit_accion'=>2,
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        $this->db->commit();

                   }else{
                    throw new Exception("Error al acutalizar los datos");
                   }

                }else{
                    throw new Exception("No existe el registro.");
                }

            }else{
                 throw new Exception("No existe el registro, datos incorrectos");
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $error_msg = "Excepción en autorizarAction: " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $data_bit = [
                'bit_descripcion'=>'ERROR AUTORIZAR EXPEDIENTE  : '.$answer["mensaje"],
                'bit_tablaid' => $exc_id,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();

    }

    
    

    public function rel_vac_tablaAction($vac_id=0)
    {
        $rol = new Rol();

        $condicion_sql = "Expedientecan.exc_estatus>=0 ";
        if($vac_id!=0)
            $condicion_sql.="AND Expedientecan.vac_id=$vac_id ";
        
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
        try {
            $tienePermiso=0;


            if($rol->verificar(64,$auth['rol_id'])) {//todos
                $tienePermiso=1;
            }elseif ($rol->verificar(63,$auth['rol_id'])) {//solo asignados
                $condicion_sql.=" AND Expedientecan.eje_idprincipal=".$auth['id'];
                $tienePermiso=1;
            }else{

            }
          
            $registros = Expedientecan::query()
                ->columns(array('
                    cit.cit_id,
                    cit.cit_estatus,
                    cit.cit_registro,
                    cit.cit_actualizo,
                    cit.cit_fecha,
                    cit.cit_hora ,
                    vac.vac_estatus,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    can.can_correo,
                    can.can_id,
                    can.can_telefono,
                    can.can_celular,
                    med.med_nombre,
                    tic.tic_nombre,
                    Expedientecan.exc_id,
                    Expedientecan.exc_estatus,
                    Expedientecan.exc_registro,
                    Expedientecan.exc_fechaautorizo,
                    Expedientecan.exc_fechafacturacion,
                    Expedientecan.eje_idprincipal,
                    Expedientecan.vac_id,
                    cit.cit_observaciones,
                    emp.emp_nombre,
                    cav.cav_nombre,
                    est.est_nombre,
                    mun.mun_nombre,
                    psi.psi_id,
                    psi.psi_calificacion,
                    psi.psi_fecharegistro,
                    sel.sel_registro,
                    ent.ent_fecharegistro,
                    ent.ent_fecha,
                    fat.vac_estatus AS fat_vac_esatus,
                    fat.fat_id,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre                '))
                //->from(array('exc' => 'Expedientecan'))  // Aplicando el alias a la tabla
                ->leftjoin('Psicometria','psi.exc_id=Expedientecan.exc_id','psi')//join mas importante
                ->leftjoin('Cita','cit.exc_id=Expedientecan.exc_id','cit')
                ->leftjoin('Medio','med.med_id=cit.med_id','med')
                ->leftjoin('Tipocita','tic.tic_id=cit.tic_id','tic')
                ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','exc_eje.usu_id=Expedientecan.eje_idprincipal','exc_eje')
                ->leftjoin('Seccionlaboral','sel.exc_id=Expedientecan.exc_id','sel')
                ->leftjoin('Entrevista','ent.exc_id=Expedientecan.exc_id','ent')
                ->leftjoin('Facturacion','fat.exc_id=Expedientecan.exc_id AND fat.fat_estatus=2','fat')
                ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can');
                
            $registros = $registros->where($condicion_sql)->orderBy('Expedientecan.exc_estatus DESC')->execute();
            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general expedientes ",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Expedientecan",
                'vac_id'=>$vac_id,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);
            if($tienePermiso==1){
                $this->view->registros = $registros;
            }else{
                $this->view->registros=[];
            }
            $this->view->obj_cita = new Cita();
            $this->view->rol_id = $auth["rol_id"];
            $this->view->obj_exc = new Expedientecan();
            $this->view->obj_vac = new Vacante();

            $date = new DateTime();
            $hoy = $date->format('Y-m-d');
            $this->view->hoy = $hoy;
        } catch (\Exception $e) {
            
            $error_msg = "Excepción en rel_vac_tablaAction: " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");

            $this->view->registros = [];
            error_log($e->getMessage());
        }
    }



    public function mandar_garantiaAction($exc_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer["estado"] = -2;
        $answer['estatus_callback_tabla_principal']=-2;
        $data_cam_exc=[
            "exc_estatus"=>7
        ];
        $mensaje_extra_bitacora="";
        $this->view->disable();
        $data = $this->request->getPost();
        $this->db->begin();
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $expedientecan= Expedientecan::findFirst($exc_id);                
                $obj_com= new Comentarioexc();
                $obj_gar= new Garantia();
                $obj_vac= new Vacante();
                $obj_fat= new Facturacion();

                if($expedientecan){
                    $vac_id=$expedientecan->vac_id;
                    // Nota:cada objecto/función realiza acciones diferentes, todos con el fin de modularizar y poder replicar las cosas de manera fácil
                    ///validamos que el limite de garantia no se supere y asi mandar a garantia
                     $respuesta_modelo_capacidad_maxima_gar=$obj_gar->verificarLimiteGarantia($exc_id,$vac_id);
                            if($respuesta_modelo_capacidad_maxima_gar["estado"]==-2)
                                throw new Exception("Error al validar espacios en garantía. Detalles".print_r($respuesta_modelo_capacidad_maxima_gar));
                
                    ///cambiamos a estatus el expediente 
                     $respuesta_modelo_cambiar_a_garantia=$expedientecan->cambiarEstatus($data_cam_exc,$auth);
                            if($respuesta_modelo_cambiar_a_garantia["estado"]!=2)
                                throw new Exception("Error al cambiar estatus Detalles ".print_r($respuesta_modelo_cambiar_a_garantia));
                    
                    ///creamos un registro de garantia-
                    $respuesta_modelo_crearencontra_garantia=$obj_gar->NuevoRegistro($data,$auth);
                            if($respuesta_modelo_crearencontra_garantia["estado"]!=2)
                                throw new Exception("Error al crear registro. Detalles ".print_r($respuesta_modelo_crearencontra_garantia));

                    ///actualizamos la vacante 
                    $respuesta_modelo_actualizar_vac=$obj_vac->ActualizarSiEsEstatusFin($vac_id,$auth,$mandar_garantia=1);
                            if($respuesta_modelo_actualizar_vac["estado"]!=2)
                                    throw new Exception("Error al actualizar la vacante. Detalles ".print_r($respuesta_modelo_actualizar_vac));           

                    //buscamos el registro de facturacion activo
                    $respuesta_modelo_actualizar__fat=$obj_fat->ActualizarFatMandoAGar($expedientecan->exc_id,$auth);
                            if($respuesta_modelo_actualizar__fat["estado"]!=2)
                                    throw new Exception("Error al actualizar la faturación. Detalles ".print_r($respuesta_modelo_actualizar__fat)); 

                    $data_bit=[
                         'bit_descripcion'=>"Mando a garantía el expediente con folio ".$expedientecan->exc_id." de la vacante ".$vac_id." el número de la garantía que se registró es ",
                         'bit_tablaid'=>$expedientecan->exc_id,
                         'bit_modulo'=>"Mandar garantía expediente",
                         'vac_id'=>$vac_id,
                         'bit_accion'=>2,
                    ];
                     $this->bitacora_registro($data_bit,$auth);
                     $this->db->commit();      
                     $answer['estado'] = 2;
                     $answer['titular'] = "Éxito";
                     $answer['mensaje'] = "Se mandó de manera correcta a garantía el expediente ".$exc_id;
                     $answer['vac_id'] = $vac_id;
                     $answer['estatus_callback_tabla_principal'] = $respuesta_modelo_actualizar_vac["estado"];

                }else{
                    throw new Exception("No existe el registro.");
                }

            }else{
                 throw new Exception("No existe el registro, datos incorrectos");
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $error_msg = "Excepción en mandar_garantiaAction: " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function metricasAction() {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $this->view->disable();

        if (!$rol->verificar(47, $auth['rol_id'])) 
            $this->response->redirect('errors/errorpermiso');
        

        try {
            $result = [];
            $subs = Expedientecan::find(array(
                "exc_estatus > 0"
            ));
            if ($subs) {
                $result = $subs->toArray();
            }

            $this->response->setJsonContent($result);
            $this->response->send(); 
            return;
        } catch (\Exception $e) {
            error_log("Error al consultar los registros de Expediente candidato: " . $e->getMessage());
            $this->response->setJsonContent(["error" => "Ha ocurrido un error en la consulta"]);
            $this->response->send();
            return;
        }
    }


    public function reactivarAction($exc_id=0){
        $rol = new Rol();
        $this->view->disable();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer["estado"] = -2;
        $mensaje_extra_bitacora="";
        $data = $this->request->getPost();
        $this->db->begin();
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $expedientecan= Expedientecan::findFirst($exc_id);                
                $obj_com= new Comentarioexc();
                $vac_obj= Vacante::findFirst($data["vac_id"]);                
               
                if($expedientecan){
                    $data_com=[
                        "com_comentario"=>"REACTIVO EL EXPEDIENTE CANDIDATO POR: ".$data["exc_comentario"],
                        "exc_id"=>$exc_id,
                        "com_seguimiento"=>1,
                        "exc_estatus"=>$expedientecan->exc_estatus,  
                    ];


                    //validamos que la vacante este en un estatus idoneo---inicio
                    $respuesta_modelo_estatus_vac= $vac_obj->validarEstatusVacanteExpReactivar();
                    if($respuesta_modelo_estatus_vac["estado"]!=2){
                        $this->db->rollback();

                        if($respuesta_modelo_estatus_vac["estado"]==-1){//el estatus no es valido para cambiar estatus y se manda aviso
                            $answer["estado"] =$respuesta_modelo_estatus_vac["estado"];
                            $answer["mensaje"] = $respuesta_modelo_estatus_vac["mensaje"];
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                    
                    }
                    //validamos que la vacante este en un estatus idoneo---fin

                    //validamos que la expediente este en un estatus idoneo---inicio
                    $respuesta_modelo_estatus_exc= $expedientecan->validarEstatusParaReactivarExc();
                        if($respuesta_modelo_estatus_exc["estado"]!=2){
                            $this->db->rollback();

                            if($respuesta_modelo_estatus_exc["estado"]==-1){//el estatus no es valido para cambiar estatus y se manda aviso
                                    $answer["estado"] =$respuesta_modelo_estatus_exc["estado"];
                                    $answer["mensaje"] = $respuesta_modelo_estatus_exc["mensaje"];
                                    $this->response->setJsonContent($answer);
                                    $this->response->send();
                                    return;
                            }
                            
                        }
                    //validamos que la expediente este en un estatus idoneo---fin


                    //creamoos el comentario --inicio
                    $respuesta_modelo_com_nuevo= $obj_com->NuevoRegistroCambioEstatus($data_com,$auth);
                            if($respuesta_modelo_com_nuevo["estado"]!=2)
                                throw new Exception("No se pudo registrar el comentario.");
                    //creamoos el comentario --fin


                    //cambiamos estatus expediente --inicio
                    $respuesta_modelo_exc_reactivar= $expedientecan->reactivarRegistro($auth);
                            if($respuesta_modelo_exc_reactivar["estado"]!=2)
                                throw new Exception("No se pudo realizar la activación del expediente.");
                    //cambiamos estatus expediente --fin
                  
                    $data_bit=[
                         'bit_descripcion'=>"Se reactivó un expediente que estaba en estatus ".$respuesta_modelo_exc_reactivar["estatus_anterior_text"].", se mandó al estatus ".$respuesta_modelo_exc_reactivar["estatus_actual_text"]." y se le agregó un comentario a dicha activación con ID ".$respuesta_modelo_com_nuevo["com_id"],
                         'bit_tablaid'=>$expedientecan->exc_id,
                         'bit_modulo'=>"Mandar garantia expediente",
                         'vac_id'=>$expedientecan->vac_id,
                         'bit_accion'=>2,
                    ];
                     $this->bitacora_registro($data_bit,$auth);
                     $this->db->commit();      
                     $answer['estado'] = 2;
                     $answer['titular'] = "Éxito";
                     $respuesta_modelo_com_nuevo= $obj_com->NuevoRegistroCambioEstatus($data_com,$auth);
                     $respuesta_modelo_com_nuevo= $obj_com->NuevoRegistroCambioEstatus($data_com,$auth);
                     $answer['mensaje'] = "Se reactivó un expediente que estaba en estatus ".$respuesta_modelo_exc_reactivar["estatus_anterior_text"].", se mandó al estatus ".$respuesta_modelo_exc_reactivar["estatus_actual_text"]." y se le agregó un comentario a dicha activación con ID ".$respuesta_modelo_com_nuevo["com_id"];
                     $answer['exc_id'] = $exc_id;
                     $answer['vac_id'] = $vac_obj->vac_id;


                }else{
                    throw new Exception("No existe el registro.");
                }

            }else{
                 throw new Exception("No existe el registro, datos incorrectos");
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $error_msg = "Excepción en mandar reactivar expediente candidato: " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }


    public function regresar_facturacionAction($exc_id=0){
        $rol = new Rol();
        $this->view->disable();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer["estado"] = -2;
        $mensaje_extra_bitacora="";
        $data = $this->request->getPost();
        $this->db->begin();
        try {

            if (!$this->request->isAjax() || !(is_numeric($exc_id) && $exc_id > 0) || empty($data)) 
                throw new Exception("Formato incorrecto de la request.");
            
            $expedientecan= Expedientecan::findFirst($exc_id);                
            $obj_com= new Comentarioexc();
            $fat_obj= new Facturacion();
            $comexc_obj= new Comentarioexc();

            $vac_obj= Vacante::findFirst($data["vac_id"]);   

            if($expedientecan==false || $vac_obj==false  )
                throw new Exception("Registros vacantes-expediente candidato NO ENCONTRADOS.");
            
            /****************************************
            *PASO A REALIZAR 
            *1-Cambiar el estatus del registro de facturacion a -2
            *2.-Cambiar estatuus de la vacante
            *2.1-En caso de la vacante este en fin, se pasar al estatus proceeso
            *2.2-en caso de que la vacante este  en fin pero era garantía regresa a garantía
            *3.-se cambia el estatus del expediente
            *******************************************/


            ///comentario
            $data_com=[];
            $data_com["exc_id"]=$exc_id;
            $data_com["exc_estatus"]=$expedientecan->exc_estatus;
            $comentario_ori=$data["fat_comentario"];
            $data_com["com_comentario"]="REGRESÓ FACTURACIÓN POR: ".$comentario_ori;
            $respuesta_cometario_exc=$comexc_obj->NuevoRegistro($data_com,$auth);
            if($respuesta_cometario_exc["estado"]==-2)
                throw new Exception("Error comentario agregar:".$respuesta_cometario_exc["mensaje"]);
                   
                        
            //desactivar facturacion
            $respuesta_modelo_buscar_exc_fact_activo_desactivar=$fat_obj->desactivarFatAsociadaByExcId($exc_id,$auth);
            if($respuesta_modelo_buscar_exc_fact_activo_desactivar["estado"]==-2)
                throw new Exception("Deactivar facturación: ".$respuesta_modelo_buscar_exc_fact_activo_desactivar["mensaje"]);
            elseif ($respuesta_modelo_buscar_exc_fact_activo_desactivar["estado"]==2) 
                $mensaje_extra_bitacora.=', '.$respuesta_modelo_buscar_exc_fact_activo_desactivar["mensaje"];

            //desactivar facturacion
            $respuesta_modelo_cambiar_estatus_vacante=$vac_obj->cambiarEstatusPrevioFacturacion($auth);
            if($respuesta_modelo_cambiar_estatus_vacante["estado"]==-2)
                throw new Exception("Cambiar estatus previo vac: ".$respuesta_modelo_cambiar_estatus_vacante["mensaje"]);
            elseif ($respuesta_modelo_buscar_exc_fact_activo_desactivar["estado"]==2) 
                $mensaje_extra_bitacora.=', '.$respuesta_modelo_cambiar_estatus_vacante["mensaje"];
            
            $respuesta_modelo_cambiar_estatus_expediente=$expedientecan->cambiarEstatusRegresarFacturacion($auth);
            if($respuesta_modelo_cambiar_estatus_expediente["estado"]==-2)
                throw new Exception("Cambiar estatus previo expediente candidato:".$respuesta_modelo_cambiar_estatus_expediente["mensaje"]);
           
            
            $data_bit=[
                    'bit_descripcion'=>"Se regresó una facturación, el expediente de candidato con ID ".$exc_id." de la vacante ".$expedientecan->vac_id." el registro de facturación tiene el folio ".$respuesta_modelo_buscar_exc_fact_activo_desactivar["fat_id"],
                    'bit_tablaid'=>$respuesta_modelo_buscar_exc_fact_activo_desactivar["fat_id"],
                    'bit_modulo'=>"Regresar facturación",
                    'vac_id'=>$expedientecan->vac_id,
                    'exc_id'=>$expedientecan->exc_id,
                    'bit_accion'=>2,
            ];
            $this->bitacora_registro($data_bit,$auth);
            $this->db->commit();      
            
            $answer['estado'] = 2;
            $answer['titular'] = "Éxito";
            $answer['mensaje'] = "Se regresó una facturación, el expediente de candidato con ID ".$exc_id." de la vacante ".$expedientecan->vac_id." el registro de facturación tiene el folio ".$respuesta_modelo_buscar_exc_fact_activo_desactivar["fat_id"];
            $answer['exc_id'] = $exc_id;
            $answer['vac_id'] = $vac_obj->vac_id;


        } catch (\Exception $e) {
            $this->db->rollback();
            $error_msg = "Excepción en regresar facturación : " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'ERROR regresar facturación : '.$answer["detalle"],
                'bit_tablaid' => $exc_id,
                'bit_modulo' => "ERROR",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }



    
    public function cambiar_ejecutivoAction($exc_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $data = $this->request->getPost();
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer["estado"] = -2;
        $mensaje_extra_bitacora="";
        $this->db->begin();
        try {
                if (!$this->request->isAjax() && !$exc_id > 0) 
                    throw new Exception("No existe el registro, datos incorrectos");

                $expedientecan= Expedientecan::findFirst($exc_id);

                if(!$expedientecan)
                    throw new Exception("No existe el registro.");

                $obj_com=new Comentarioexc();
                /*Pasos a realizar
                *1.-Crear comentario
                *2.-cambiar de ejecutivo
                */
                $respuesta_modelo_cambiar_eje=$expedientecan->cambiarEjecutivoPropietario($data,$auth);
                if($respuesta_modelo_cambiar_eje['estado']==-2)
                    throw new Exception("Error al cambiar de ejecutivo.");

                $data_com=[];
                $data_com['com_comentario']='CAMBIÓ DE EJECUTIVO: '.$data["com_comentario"];
                $data_com['exc_estatus']=$expedientecan->exc_estatus;
                $data_com['exc_id']=$exc_id;
                $respuesta_modelo_comentario=$obj_com->NuevoRegistro($data_com,$auth);
                if($respuesta_modelo_comentario['estado']==-2)
                    throw new Exception("Error al agregar el comentario.");
 
                $data_bit=[
                        'bit_descripcion'=>'Se cambió el expediente de ejecutivo. El ejecutivo que tenía asignado tenía el ID '.$respuesta_modelo_cambiar_eje['eje_idanterior'].', y el ejecutivo al que se asignó tiene el ID '.$respuesta_modelo_cambiar_eje['eje_idprincipal'],
                        'bit_tablaid'=>$exc_id,
                        'bit_modulo'=>'Cambiar ejecutivo expediente',
                        'vac_id'=>$respuesta_modelo_cambiar_eje['vac_id'],
                        'exc_id'=>$respuesta_modelo_cambiar_eje['exc_id'],
                        'bit_accion'=>2,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->db->commit();    

                $answer['estado'] = 2;
                $answer['titular'] = "Éxito";
                $answer['mensaje'] = "Se cambió de ejecutivo el expediente";
                $answer['exc_id'] = $respuesta_modelo_cambiar_eje['exc_id'];
                $answer['vac_id'] = $respuesta_modelo_cambiar_eje['vac_id'];
            }catch (\Exception $e) {
                $this->db->rollback();
                $error_msg = "Excepción en cambiar ejecutivo : " . $e->getMessage();
                $error_line = __LINE__;
                error_log("Error en línea $error_line: $error_msg");
                $answer['estado'] = -2;
                $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    
    
}