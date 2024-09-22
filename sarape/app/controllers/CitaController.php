<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;


use Intervention\Image\ImageManager;

class CitaController extends ControllerBase
{
     /**
     * [vac_cit_tablaAction Muestra los registros  en estatus 1
     * a un vac_id de la tabla cita]
     * @param  int [$vac_id]
     * @return array [array de cada uno de los registros]   
     */
    public function vac_exc_cit_tablaAction($vac_id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $tienePermiso=0;

        if($vac_id!=0 && is_numeric($vac_id)){
            $condicion_sql="exc.vac_id='$vac_id' AND Cita.cit_estatus='1' ";
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
                   $cita = Cita::query()
                    ->columns(array('
                        Cita.cit_id,
                        Cita.cit_registro,
                        Cita.cit_fecha,
                        Cita.cit_hora ,
                        CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,

                        can.can_correo,
                        can.can_telefono,
                        can.can_celular,
                        med.med_nombre,
                        tic.tic_nombre,
                        exc.exc_id,
                        exc.vac_id,
                        exc.exc_estatus,
                        Cita.cit_observaciones
                    '))
                    ->leftjoin('Medio','med.med_id=Cita.med_id','med')
                    ->leftjoin('Tipocita','tic.tic_id=Cita.tic_id','tic')
                    ->leftjoin('Expedientecan','exc.exc_id=Cita.exc_id','exc')//join mas importante
                    ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                    ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                    ->leftjoin('Candidato','can.can_id=exc.can_id','can');

            if($rol->verificar(63,$auth['rol_id'])) {//solo asignados 
                 $condicion_sql.=" AND vac.eje_id=".$auth['id'];
                 $tienePermiso=1;

            }elseif ($rol->verificar(64,$auth['rol_id'])) {//todos
                $tienePermiso=1;

            }        

            if ($tienePermiso==1) {
                $reg=$cita->where($condicion_sql)->orderBy('exc.exc_id DESC')->execute();
            }else{
                $reg=[];

            }
            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general citas #modal",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Cita",
                'vac_id'=>$vac_id,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);
            $this->view->registros=$reg;
            $this->view->obj_cita=new Cita();
            $date= new DateTime();
            $hoy=$date->format('Y-m-d');
            $this->view->hoy=$hoy;

        }else
            $this->view->registros='ERROR';

       
    }

    public function crear_generalAction($vac_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(29,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
        }

        $this->db->begin();
        try {
            $can_id = 0;

            $authF['id'] = 0;
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al registrar los datos de la vacante',
                'titular' => 'Error',
                'can_id' => 0,
                'data_con_exc' => [],//data coincidencias con expediente candidato
                'count_con_exc'=>0,//contador de coincidencias de exc
            ];
            $mensaje_extra = '';
            $data_aes = '';
            $mensaje_extra_json = '';
            $this->view->disable();
            
            if ($this->request->isAjax()) {

                //objetos para guardar datos -incio
                $candidato_obj=new Candidato();
                $vacante_obj=new Vacante();
                $archivo_obj=new Archivo();
                $cita_obj=new Cita();
                $expediente_can_obj=new Expedientecan();
                //objetos para guardar datos -fin

                $data = $this->request->getPost();
                $data["can"]["can_curp"] = $data["can_curp_crear"];
               //error_log( $data["can"]["can_curp"]);

               //llenado de arrays de data para las funciones modelos -inicio
                $data_can = $data["can"];
                $data_cit = $data["cit"];
                $data_arc = isset($_FILES["arc"]) && $_FILES["arc"]["error"] === UPLOAD_ERR_OK ? $_FILES["arc"] : null;
               //llenado de arrays de data para las funciones modelos -fin

        
                ///------NOTAS IMPORTANTES INICIO---------------////
                //pasos a realizar
                //1.-crear candidato(validamos si existe y si existe validamos si tiene cita)
                //2.-crear expediente candidato
                //3.-crear cita
                //4.-creamos archivo
                // inicio de guardado de datos
                ///------NOTAS IMPORTANTES FIN---------------////

                //validamos si ingreso una curp
                $respuesta_modelo_vac_verificar_primer_expcit_cambiar_estatus=$vacante_obj->CambiarEstatusPorPrimerCitaCandidato($vac_id);
                
                if( $respuesta_modelo_vac_verificar_primer_expcit_cambiar_estatus["estado"]==2){
                    $mensaje_extra.=", ".$respuesta_modelo_vac_verificar_primer_expcit_cambiar_estatus["descripcion"];

                }
                
                //validamos si la curp es vacia
                if (!empty(trim($data_can["can_curp"]))) {
                    
                    //validamos si el candidato ya ah sido registrado
                    $respuesta_modelo_buscar_can =$candidato_obj->buscarCandidatoActivoByCurp($data_can["can_curp"]);
                    if($respuesta_modelo_buscar_can["estado"]){
                        $can_id=$respuesta_modelo_buscar_can["can_id"];
                        ///buscamos el numero de coincidencias en base al ID del candidato
                        $respuesta_modelo_exc_relacion_can=$candidato_obj->buscarCoincidenciasCandidatoExpediente($can_id);
                        $answer["data_con_exc"]=$respuesta_modelo_exc_relacion_can["data_exc"];
                        $answer["count_con_exc"]=$respuesta_modelo_exc_relacion_can["count_exc"];

                        //validamos si el candidato ya tiene una cita
                        $respuesta_modelo_buscar_can_expediente_cita =$candidato_obj->candidatoTieneCitaAsignada($can_id,$vac_id);
                        if($respuesta_modelo_buscar_can_expediente_cita["estado"]){
                            $this->db->rollback();
                            $answer['estado'] = -1;
                            $answer['mensaje'] = $respuesta_modelo_buscar_can_expediente_cita["mensaje"];
                            $answer['titular'] = 'ADVERTENCIA';
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                    }
                    

                }else{
                    //si esta vacia  la curp de candidato
                }
               
                if($can_id==0){
                    $respuesta_modelo_can=$candidato_obj->NuevoGeneral($data_can,$auth);

                    //validamos que guardo los datos se guardaran
                    if($respuesta_modelo_can["estado"]==-2){
                        $this->db->rollback();

                        $data_bit = [
                            'bit_descripcion' => "Error en alguno de los modelos de guardar [candidato]",
                            'bit_tablaid' => 0,
                            'bit_modulo' => "ERROR",
                            'vac_id' => 0,
                            'bit_accion' => 1,
                        ];
                        $this->bitacora_registro($data_bit, $authF);
                        $answer['mensaje'] = "ERROR GENERAL EN ALGUN MODELO-FUNCION   #CAN";
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                    $data_cit["can_id"]=$respuesta_modelo_can["can_id"];
                    $data_exc["can_id"]=$respuesta_modelo_can["can_id"];
                    $can_id=$respuesta_modelo_can["can_id"];

                }else{
                    $data_cit["can_id"]=$can_id;
                    $data_exc["can_id"]=$can_id;
                    //$mensaje_extra_json.=", la información coincidió con el candidato con ID ".$can_id."";                        
                    $answer['can_id'] = $can_id;


                }
                
             


                $data_cit["vac_id"]=$data["vac_id"];
                $data_exc["vac_id"]=$vac_id;
                $respuesta_modelo_exc=$expediente_can_obj->NuevoRegistro($data_exc,$auth);

                $data_cit["exc_id"]=$respuesta_modelo_exc["exc_id"];

                $respuesta_modelo_cita=$cita_obj->NuevoGeneral($data_cit,$auth);

                $exc_id=$respuesta_modelo_exc["exc_id"];
                //VALIDAMOS EL ARCHIVO INCIO
                if ($data_arc != null) {
                    $respuesta_modelo_arc = $archivo_obj->NuevoCVCandidato($data_arc, $auth, $exc_id);
    
                    // Validar si ocurrió un error al subir el archivo
                    if ($respuesta_modelo_arc["estado"] == -1) {
                        error_log("no guardo no guardo el archivo");

                        $this->db->rollback();
                        $answer = [
                            'estado' => -1,
                            'mensaje' => $respuesta_modelo_arc[2],
                            'titular' => 'AVISO',
                        ];
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                    if ($respuesta_modelo_arc["estado"] == -2) {
                      

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
                        $mensaje_extra.=", subió un archivo CV con id ".$respuesta_modelo_arc["arc_id"];
                    }
                    
                }
                //VALIDAMOS EL ARCHIVO FIN
                // fin de guardado de datos

                //valdiacion de errores inicio
                if($respuesta_modelo_cita["estado"]==-2  || $respuesta_modelo_exc["estado"]==-2){
                   
                    $this->db->rollback();

                    $data_bit = [
                        'bit_descripcion' => "Error en alguno de los modelos de guardar [cita,expediente]",
                        'bit_tablaid' => 0,
                        'bit_modulo' => "ERROR",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($data_bit, $authF);
                    $answer['mensaje'] = "ERROR GENERAL EN ALGUN MODELO-FUNCION   #CIT #EXC";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                //valdiacion de errores fin

                if($respuesta_modelo_cita["estado"]==2 && $respuesta_modelo_exc["estado"]==2 ){

                    //llenamos bitacora -inicio
                    $data_bit=[
                        'bit_descripcion'=>'Se dió de alta una cita con No. '.$respuesta_modelo_cita["cit_id"]." con expediente de candidato No. ".$respuesta_modelo_exc["exc_id"]." con el ID de candidato No. ".$can_id." ".$mensaje_extra,
                        'bit_tablaid'=>$respuesta_modelo_cita['cit_id'],
                        'bit_accion'=>1,
                        'bit_modulo'=>"Cita",
                        'vac_id' => 0,
                    ];
                    //llenamos bitacora -fin
                    //llenado de bitacora y mensaje de exito incio
                    $this->bitacora_registro($data_bit,$auth);
                    $this->db->commit();
                    $answer['estado'] = 2;
                    $answer['mensaje'] = 'Se registraron los datos de la cita con ID '.$respuesta_modelo_cita['cit_id'].''.$mensaje_extra_json;
                    $answer['titular'] = 'Éxito';
                    $answer['vac_id'] = $data["vac_id"];
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                    //llenado de bitacora y mensaje de exito fin
                }else{
                   
                    $answer['mensaje'] = "ERROR GENERAL AL VALIDAR EL GUARDADO  #exc #can";
                    $this->db->rollback();
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }

                
            } 
            
            
        
        } catch (Exception $e) {
                // El error es una Notice
                $this->db->rollback();
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $answer['detalle'] = $mensaje;
                error_log($mensaje);
                $answer['detalle_mas'] = 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea;
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
    public function ajax_get_detalle_cit_exc_canAction($cit_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';


        $answer = array();
        $this->view->disable();
        
        try {
            if ($this->request->isAjax() && $cit_id > 0) {
                $registro = Cita::query()
                    ->columns('
                        Cita.cit_id,
                        Cita.cit_observaciones,
                        Cita.cit_fecha,
                        Cita.cit_hora,
                        
                        Cita.cit_registro,
                        Cita.med_id,
                        Cita.tic_id,
                        Cita.exc_id,
                        can.can_nombre,
                        can.can_primerapellido,
                        can.can_segundoapellido,
                        CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre_completo,
                        can.can_correo,
                        can.can_telefono,
                        can.can_celular,
                        vac.vac_id,
                        exc.exc_id,
                        exc.exc_estatus,

                        exc.exc_comentario,
                        exc.exc_comentario,
                        can.can_id,
                        can.can_curp,
                        can.can_nosegsocial,

                        cav.cav_nombre,
                        emp.emp_nombre,
                        vac.vac_estatus,

                        Cita.cit_puestosimilar,
                        Cita.cit_estabilidalaboral,
                        Cita.cit_responsabilidad,
                        Cita.cit_concimientostec,
                        Cita.cit_acordeasueldoofrecido,
                        Cita.cit_presentacionapariencia,
                        Cita.cit_disponibilidad,
                        Cita.cit_proactivo,
                        Cita.cit_puntualidad,
                        med.med_nombre,
                        tic.tic_nombre

                    ')
                    ->leftjoin('Expedientecan','exc.exc_id=Cita.exc_id','exc')//join mas importante
                    ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                    ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                    ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                    ->leftjoin('Medio','med.med_id=Cita.med_id','med')
                    ->leftjoin('Tipocita','tic.tic_id=Cita.tic_id','tic')

                    ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                    ->where('cit_id=' . $cit_id)
                    ->execute();
        
                if ($registro) {
                    $answer[0] = 2;
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
            $answer["estado"] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $answer['detalle'] =$e->getMessage();     
            error_log($answer['detalle']);
            $data_bit = [
                'bit_descripcion'=>'ERROR DETALLE EXPEDIENTE CITA: '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();

    }

    public function reprogramar_generalAction($cit_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(28,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');

        $this->db->begin();
        try {
            $cit_id = 0;

            $authF['id'] = 0;
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al reprogramar la cita',
                'titular' => 'Error',
            ];
            $mensaje_extra = '';
            
            $mensaje_extra_json = '';
            $this->view->disable();
            
            if ($this->request->isAjax()) {

                $data = $this->request->getPost();
                $answer["data"]=$data;
                $cit_id=$data["cit_id"];
               //objetos de cita
                $cita_obj = Cita::findFirst($cit_id);
                
                if(!$cita_obj){//validamos que exista el registro
                    $answer['mensaje'] = "NO SE ENCONTRÓ LA CITA";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }else{
                    
                    $cita_obj->cit_fecha= $data['cit_fecha_re'];
                    $cita_obj->cit_hora= $data['cit_hora_re'];
                    $cita_obj->tic_id= $data['tic_id_re'];

                    if($cita_obj->save())
                    {
                        $data_bit=[
                            'bit_descripcion'=>'Se reprogramo la cita con el ID '.$cit_id,
                            'bit_tablaid'=>$cit_id,
                            'bit_accion'=>2,
                            'bit_modulo'=>"Cita",
                            'vac_id' => 0,
                        ];

                        $this->bitacora_registro($data_bit,$auth);

                        $this->db->commit();
                        $answer['estado'] = 2;
                        $answer['mensaje'] = 'Se reprogramo la cita correctamente';
                        $answer['titular'] = 'Éxito';
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }else{
                        $this->db->rollback();
                        $answer['estado'] = -2;
                        $answer['mensaje'] = "SE PRODUJO UN ERROR AL REPROGRAMAR LA CITA";
                        $answer['titular'] = 'Error'; 
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }

                }   
            }         
           
            
        } catch (Exception $e) {
    
                $this->db->rollback();
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $answer['detalle'] = $mensaje;
                $answer['detalle_mas'] = 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea;
                $data_bit = [
                    'bit_descripcion' => "Error al editar cita:".$answer['detalle_mas'],
                    'bit_tablaid' => $cit_id,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 2,
                ];
                $this->bitacora_registro($data_bit, $authF);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        }
    }

    public function editar_generalAction($cit_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(28,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bd
            $this->response->redirect('errors/errorpermiso');
    

        $this->db->begin();
        try {
            $cit_id = 0;
            $can_id = 0;
            $can_se_actualiza = 0;

            $authF['id'] = 0;
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al registrar los datos de la cita',
                'titular' => 'Error',
            ];
            $mensaje_extra = '';
            $data_aes = '';
            $mensaje_extra_json = '';
            $this->view->disable();
            
            if ($this->request->isAjax()) {

                $data = $this->request->getPost();
                $expedientecan= Expedientecan::findFirst($data["exc_id"]);

                $data["can"]["can_curp"] = $data["can_curp_edit"];
                $answer["data"]=$data;
                //llenado de arrays de data para las funciones modelos -inicio
                 $data_can= $data["can"];
                 $data_can["can_id"]=$data["can_id"];
                // error_log($data_can["can_curp"]);

                 $data_cit = $data["cit"];
                 $data_cit["cit_id"]=$data["cit_id"];
                 $data_cit["exc_id"]=$data["exc_id"];

                //datos de los comentarios 
                $data_com=$data["com"];
                $data_com["exc_id"]=$data["exc_id"];
                $data_com["exc_estatus"]=$expedientecan->exc_estatus;
                $comentario_ori=$data_com["com_comentario"];
                $data_com["com_comentario"]="EDITÓ UN CITA: ".".".$comentario_ori;

                //llenado de arrays de data para las funciones modelos -fin
                
                //objetos para guardar datos -incio
                $candidato_obj = Candidato::findFirst($data_can['can_id']);
                $cita_obj=new Cita();
                $obj_com= new Comentarioexc();
                $expediente_can_obj=new Expedientecan();
                //objetos para guardar datos -fin

          


               //actualizacion incio
                if(!$candidato_obj){//validamos que exista el registro
                    $answer['mensaje'] = "NO SE ENCONTRO EL CANDIDATO";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                
                //VALIDACION DEL LA CURP OBLIGATORIA EN ESTATUS VIGENTES --INICIO
                    $estatus_no_obligatorios_de_curp=[1,11,12,13];
                    if (in_array($expedientecan->exc_estatus, $estatus_no_obligatorios_de_curp)) {
                        // Si el estatus está en la lista de estatus no obligatorios de CURP.
                    } else {
                        $candidato_buscar_validar_curp = Candidato::findFirst($expedientecan->exc_id);
                        if (trim($candidato_buscar_validar_curp->can_curp)=="") {
                            $this->db->rollback();
                            $answer = [
                                'estado' => -1,
                                'mensaje' => 'LA CURP ES OBLIGATORIA',
                                'titular' => 'AVISO',
                            ];
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                        // Si llegas a este punto, significa que la CURP no está vacía y puedes continuar con el código.
                    }
                //VALIDACION DEL LA CURP OBLIGATORIA EN ESTATUS VIGENTES --FIN
               if ($candidato_obj->can_valido == 0) {//validamos si la informacion del candidato ya esta validada no podemos hacer actualizaciones
                           
                          

                            $respuesta_modelo_actualizar_can = $candidato_obj->ActualizarGeneral_NOVALIDADO($data_can,$auth);

                            $respuesta_modelo_buscar_can = $candidato_obj->buscarCandidatoActivoByCurp($data_can["can_curp"]);
                            
                            //si el candidato fue encontrado por su curp y si el candidato entrado no condice con el el que se mando la peticion
                            if ($respuesta_modelo_buscar_can["estado"] && ($respuesta_modelo_buscar_can["can_id"] != $candidato_obj->can_id)) {
                              
                                //actualiza el el campo can_id del registro de la tabla expediente can
                                $respuesta_modelo_exc= $expediente_can_obj->ActualizarCandidatoEncontrado($data["can_id"],$data["exc_id"],$auth);

                               if($respuesta_modelo_exc["estado"]==-2){
                                $answer['mensaje'] = "ERROR AL HACER CAMBIS DE IDS EXP CAN";
                                $this->response->setJsonContent($answer);
                                $this->response->send();
                                return;
                                }else{
                                    $mensaje_extra.=" , condicidieron los datos de la CURP y se actualizó cambio de id de candidato";
                                }

                            }elseif ($candidato_obj->can_valido==1) {
                          
                                $respuesta_modelo_can = $candidato_obj->ActualizarGeneral($data_can, $auth);

                                if($respuesta_modelo_can["estado"]==-2){
                                    $answer['mensaje'] = "ERROR AL ACTUALIZAR LA INFO DE  CAN";
                                    $this->response->setJsonContent($answer);
                                    $this->response->send();
                                    return;
                                }else{
                                    $mensaje_extra.=" , se actualizaron los datos del candidato";

                                }

                            }
                        

                }
                $respuesta_modelo_cit=$cita_obj->ActualizarGeneral($data_cit,$auth);

                if(trim($comentario_ori)!=""){
                    $respuesta_modelo_com=$obj_com->NuevoRegistro($data_com,$auth);
                    if($respuesta_modelo_cit["estado"]!=2)
                        throw new Exception("Erro al registrar el comentario ");
                    

                }

                
               if($respuesta_modelo_cit["estado"]==2){
                 //llenamos bitacora -inicio
                $data_bit=[
                    'bit_descripcion'=>'Se editó una cita con No. '.$respuesta_modelo_cit["cit_id"]." con expediente de candidato No. ".$data["exc_id"]." ".$mensaje_extra,
                    'bit_tablaid'=>$respuesta_modelo_cit['cit_id'],
                    'bit_accion'=>2,
                    'bit_modulo'=>"Cita",
                    'vac_id' => 0,
                ];
                //llenamos bitacora -fin

                //llenado de bitacora y mensaje de exito incio
                $this->bitacora_registro($data_bit,$auth);
                $this->db->commit();
                $answer['estado'] = 2;
                $answer['mensaje'] = 'Se actualizaron los datos de la cita con ID '.$respuesta_modelo_cit['cit_id'];
                $answer['titular'] = 'Éxito';
                $answer['vac_id'] = $data["vac_id"];
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
              
                
               }else{

                $this->db->rollback();
                $data_bit = [
                    'bit_descripcion' => "Error al actualizar la cita: #error enl  modelo cita",
                    'bit_tablaid' => 0,
                    'bit_modulo' => "Cita",
                    'vac_id' => 0,
                    'bit_accion' => 2,
                ];
                $this->bitacora_registro($data_bit, $auth);
                $answer['mensaje'] = "ERROR AL ACTUALIZAR LA INFO DE  CIT";
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;

               }
    
            } 
            
            
            
        } catch (Exception $e) {
    
                // El error es una Notice
                $this->db->rollback();
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $answer['detalle'] = $mensaje;
                $answer['detalle_mas'] = 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea;
                $data_bit = [
                    'bit_descripcion' => "Error en el editar cita:".$answer['detalle_mas'],
                    'bit_tablaid' => $cit_id,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 2,
                ];
                $this->bitacora_registro($data_bit, $authF);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        
        }

    }


    public function general_indexAction()
    {
        $this->tag->setTitle('Citas');
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(27,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
                
    }
    public function general_tablaAction()
    {
        $condicion_sql = "exc.exc_estatus='1' ";
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
        $rol = new Rol();
        $tienePermiso=0;

        try {
          
            $cita = Cita::query()
                ->columns(array('
                    Cita.cit_id,
                    Cita.cit_estatus,
                    Cita.cit_registro,
                    Cita.cit_fecha,
                    Cita.cit_hora ,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    can.can_correo,
                    can.can_telefono,
                    can.can_celular,
                    med.med_nombre,
                    tic.tic_nombre,
                    exc.exc_id,
                    exc.vac_id,
                    exc.exc_estatus,
                    exc.eje_idprincipal,
                    Cita.cit_observaciones,
                    emp.emp_nombre,
                    emp.emp_id,
                    emp.emp_alias,
                    cav.cav_nombre,
                    est.est_nombre,
                    mun.mun_nombre,
                    vac.eje_id,
                    can.can_id,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    CONCAT(can_usu_alta.usu_nombre," ", can_usu_alta.usu_primerapellido," ",can_usu_alta.usu_segundoapellido) as can_usu_alta_nombre
                '))
                ->leftjoin('Medio','med.med_id=Cita.med_id','med')
                ->leftjoin('Tipocita','tic.tic_id=Cita.tic_id','tic')
                ->leftjoin('Expedientecan','exc.exc_id=Cita.exc_id','exc')//join mas importante
                ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Usuario','exc_eje.usu_id=exc.eje_idprincipal','exc_eje')
                ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                ->leftjoin('Usuario','can_usu_alta.usu_id=can.usu_idalta','can_usu_alta');
    
            if($rol->verificar(63,$auth['rol_id'])) {//solo asignados 
                    $condicion_sql.=" AND exc.eje_idprincipal=".$auth['id'];
                    $tienePermiso=1;

            }elseif ($rol->verificar(64,$auth['rol_id'])) {//todos
                    $tienePermiso=1;
            }
              
            if($tienePermiso==1){
                $reg = $cita->where($condicion_sql)->orderBy('Cita.cit_id DESC')->execute();
            }else{
                $reg =[];

            }
    
            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general citas ",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Cita",
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
            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $data_bit = [
                'bit_descripcion'=>'ERROR TABLA GENERAL CITA : '.$answer["mensaje"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
           
        }
    }
    

}