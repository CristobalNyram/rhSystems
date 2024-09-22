<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Di;
use Phalcon\Mvc\Model\Query;

require "mpdf/index.php";

class VacanteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Vacante');
        parent::initialize();
    }

    public function altaAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(5,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $arv_validacion =Categoriavac::findFirstByctv_id(1);
        $arv_validacion->ctv_tipovalidacion = $arv_validacion->ctv_tipovalidacion;
        $this->view->arv_validacion = $arv_validacion;
        $this->view->arv = $arv_validacion;

        $data_bit=[
            'bit_descripcion'=>"Consultó la vista de alta vacante",
            'bit_tablaid'=>0,
            'bit_modulo'=>"Vacante",
            'vac_id'=>0,
            'bit_accion'=>4,
        ];
        $this->bitacora_registro($data_bit,$auth);
    }

    public function nuevoAction()
    {
        $this->db->begin();
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(5,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        

        try {
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al registrar los datos de la vacante',
                'titular' => 'Error',
            ];
            $mensaje_extra = '';
            $data_aes = '';
            $mensaje_extra_bitacora = '';
            $this->view->disable();
            
            if ($this->request->isAjax()) {

                $vacante_obj=new Vacante();
                $obj_arv=new Archivovac();
                $data = $this->request->getPost();
                $data_arv = isset($_FILES["arv"]) && $_FILES["arv"]["error"] === UPLOAD_ERR_OK ? $_FILES["arv"] : null;
                $respuesta_modelo_vac=$vacante_obj->NuevoGeneral($data,$auth);

                // Validar si ocurrió un error al subir al guardar la vacante
                if ($respuesta_modelo_vac["estado"] == -1) {
                    error_log("no guardo no guardo datos de la vacante");
                    $this->db->rollback();
                    $answer = [
                        'estado' => -1,
                        'mensaje' => $respuesta_modelo_vac["mensaje"],
                        'titular' => 'AVISO',
                    ];
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                else if ($respuesta_modelo_vac["estado"] == -2) {
                    $this->db->rollback();
                    $answer = [
                        'estado' => -1,
                        'mensaje' =>"ERROR LA VACANTE",
                        'titular' => 'AVISO',
                    ];
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }


                 //VALIDAMOS EL ARCHIVO INCIO
                 if ($data_arv != null) {
                    $respuesta_modelo_arv = $obj_arv->NuevaCotizacion($data_arv, $auth, $respuesta_modelo_vac["vac_id"]);
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
                    else if ($respuesta_modelo_arv["estado"] == -2) {
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
                
                $data_bit=[
                    'bit_descripcion'=>'Se dió de alta una vacante '.$mensaje_extra_bitacora,
                    'bit_tablaid'=>$respuesta_modelo_vac['vac_id'],
                    'bit_modulo'=>"Alta vacante",
                    'vac_id'=>$respuesta_modelo_vac['vac_id'],
                    'bit_accion'=>1,
                ];

            
                $this->bitacora_registro($data_bit,$auth);
                $this->db->commit();
                $answer['estado'] = 2;
                $answer['mensaje'] = 'Se registraron los datos de la vacante con ID '.$respuesta_modelo_vac['vac_id'];
                $answer['titular'] = 'Éxito';
                
            } 
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {    
                // El error es una Notice
                $this->db->rollback();
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
                error_log("ERROR EN VACANTE nuevoAction: ".$e->getMessage());
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
           
        }
    }

    public function relacionvacante_indexAction(){
        $this->tag->setTitle('Relación vacante');
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(28,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
    }

    
    public function relacionvacante_tablaAction(){
        $this->view->registros=[];
        $rol = new Rol();
        $tienePermiso=0;
        $auth = $this->session->get('auth');

        if(!$rol->verificar(38,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
 
        try {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
  
        $vacantes = new Builder();
        $vacantes = $vacantes
            ->columns(array('
                vac.vac_actualizacion, vac.vac_observaciones,
                vac.vac_fechasolicitud, vac.vac_fecharegistro,
                vac.vac_experiencia, vac.vac_funcionprincipal,
                vac.vac_estatus,
                vac.vac_habilidad, vac.vac_conceptotecnico,
                vac.vac_id,
                vac.vac_numero,
                vac.eje_id,
                emp.emp_nombre,
                emp.emp_alias,
                emp.emp_id,
                est.est_nombre,
                mun.mun_nombre,
                CONCAT(eje.usu_nombre, " ", eje.usu_primerapellido, " ", eje.usu_segundoapellido) as eje_nombre,
                cav.cav_nombre
            '))
            ->addFrom('Vacante', 'vac')
            ->leftjoin('Empresa', 'emp.emp_id=vac.emp_id', 'emp')
            ->leftjoin('Estado', 'est.est_id=vac.est_id', 'est')
            ->leftjoin('Municipio', 'mun.mun_id=vac.mun_id', 'mun')
            ->leftjoin('Usuario', 'eje.usu_id=vac.eje_id', 'eje')
            ->leftjoin('Catvacante', 'cav.cav_id=vac.cav_id', 'cav')
            ->leftJoin('Relvacanteejecutivo', 'rel.vac_id = vac.vac_id AND rel.rve_estatus = 2', 'rel')
            ->groupBy('vac.vac_id');

        $estatus_vac = [1, 2, 4, 5];
        $ejecutivos = Usuario::query()
            ->columns('CONCAT(Usuario.usu_nombre, " ", Usuario.usu_primerapellido, " ", Usuario.usu_segundoapellido) as ejecutivo, Usuario.usu_id as eje_id, 
                        (SELECT COUNT(*)
                        FROM Vacante AS vac
                        WHERE vac.eje_id = Usuario.usu_id
                        AND vac.vac_estatus IN (' . implode(",", $estatus_vac) . ')) as cantidad_vacante,
                        (SELECT COUNT(*) 
                        FROM Relvacanteejecutivo AS rel 
                        WHERE rel.eje_id = Usuario.usu_id 
                        AND rel.rve_estatus = 2) as cantidad_vac_compartidos')
            ->where('Usuario.usu_estatus = 2')
            ->andWhere('(
                (SELECT COUNT(*) FROM Vacante AS vac WHERE vac.eje_id = Usuario.usu_id AND vac.vac_estatus IN (' . implode(",", $estatus_vac) . ')) > 0 
                OR 
                (SELECT COUNT(*) FROM Relvacanteejecutivo AS rel WHERE rel.eje_id = Usuario.usu_id AND rel.rve_estatus = 2) > 0
            )');

            //validacion para mostrar asignados o no
            $condicion_sql_vac="vac.vac_estatus >= 0 AND vac.vac_estatus!=3 ";
            if($rol->verificar(61,$auth['rol_id'])) {//solo asignados 
                $condicion_sql_vac .= " AND (vac.eje_id=" . $auth['id'] . " OR rel.eje_id = " . $auth['id'] . ")";
                $tienePermiso=1;
                $ejecutivos=$ejecutivos->andWhere('Usuario.usu_id = ' . $auth["id"]);

            }elseif ($rol->verificar(62,$auth['rol_id'])) {//todos
                $tienePermiso=1;
            }

            if ($tienePermiso==1) {
                $vacantes = $vacantes->where($condicion_sql_vac);
                $reg = $vacantes->getQuery()->execute();
                $ejecutivos = $ejecutivos->execute();
            }else {
                $reg = [];
                $ejecutivos=[];
            }
      
            $data_bit=[
                'bit_descripcion'=>'Consultó relacionvacantes',
                'bit_tablaid'=>0,
                'bit_modulo'=>'Vacante',
                'vac_id'=>0,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);
            $this->view->registros=$reg;
            $this->view->vac_obj=new Vacante();
            $this->view->rel_vac_eje_obj=new Relvacanteejecutivo();

            $this->view->vac_numero=count($reg);
            $this->view->ejecutivos=$ejecutivos;

          

        } catch (\Exception $e) {
            error_log('No cargo la tabla '.$e->getMessage());
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'ERROR TABLA RELACIÓN VACANTE : '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }

    }
    public function ajax_get_detalleAction($vac_id=0){
        $rol = new Rol();
        $answer = array();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $this->view->disable();
        $obj_vac=new Vacante();
        try {
            if ($this->request->isAjax() && $vac_id > 0) {
                $registro = Vacante::query()
                ->columns('
                        Vacante.vac_id,
                        Vacante.tip_id,
                        Vacante.cav_id,
                        Vacante.vac_numero,
                        Vacante.emp_id,
                        Vacante.est_id,
                        Vacante.mun_id,
                        Vacante.gen_id,
                        Vacante.esc_id,
                        Vacante.gra_id,
                        Vacante.eje_id,
                        Vacante.sex_id,
                        Vacante.vac_edadmin,
                        Vacante.vac_edadmax,
                        Vacante.vac_sueldomax,
                        Vacante.vac_sueldomin,
                        Vacante.vac_idioma,
                        Vacante.vac_nivelidioma,
                        Vacante.vac_otroidioma,
                        Vacante.vac_horario,
                        Vacante.vac_conceptotecnico,
                        Vacante.vac_habilidad,
                        Vacante.vac_funcionprincipal,
                        Vacante.vac_experiencia,
                        Vacante.vac_observaciones,
                        Vacante.usu_ultimomodifico,
                        Vacante.vac_estatus,
                        Vacante.vac_escolaridadespecificar,
                        Vacante.vac_id,
                        emp.emp_nombre,
                        Vacante.cen_id,
                        Vacante.cne_id,
                        Vacante.tie_id,
                        Vacante.vac_privacidad,
                        Vacante.pre_id,
                        Vacante.vac_numero,
                        Vacante.vac_garantia,

                        Vacante.vac_tiempomeses,
                        Vacante.tpg_id,
                        tpg.tpg_nombre,
                        sex.sex_nombre,
                        est.est_nombre,
                        mun.mun_nombre,
                        gen.gen_nombre,
                        CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                        tie.tie_nombre,
                        esc.esc_nombre,
                        gra.gra_nombre,
                        eje.usu_nombre,
                        pre.pre_nombre,
                        cen.cen_nombre,

                        cne.cne_nombre,
                        CONCAT(cne.cne_nombre," ", cne.cne_primerapellido," ",cne.cne_segundoapellido) as cne_nombre_completo,
                        cne.cne_puesto,
                        cne.cne_tel,
                        cne.cne_correo,
                        cne.cne_celular,

                        tip.tip_nombre,
                        cav.cav_nombre
                    ')
                    ->where('vac_id=' . $vac_id)
                    ->leftjoin('Empresa','emp.emp_id=Vacante.emp_id','emp')
                    ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
                    ->leftjoin('Tipovacante','tip.tip_id=Vacante.tip_id','tip')
                   // ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
                    ->leftjoin('Estado','est.est_id=Vacante.est_id','est')
                    ->leftjoin('Municipio','mun.mun_id=Vacante.mun_id','mun')
                    ->leftjoin('Generacion','gen.gen_id=Vacante.gen_id','gen')
                    ->leftjoin('Tipoempleo','tie.tie_id=Vacante.tie_id','tie')
                    ->leftjoin('Estadocivil','esc.esc_id=Vacante.esc_id','esc')
                    ->leftjoin('Gradoescolar','gra.gra_id=Vacante.gra_id','gra')
                    ->leftjoin('Usuario','eje.usu_id=Vacante.eje_id','eje')
                    ->leftjoin('Prestacion','pre.pre_id=Vacante.pre_id','pre')
                    ->leftjoin('Centrocosto','cen.cen_id=Vacante.cen_id','cen')
                    ->leftjoin('Contactoemp','cne.cne_id=Vacante.cne_id','cne')
                    ->leftjoin('Tipopago','tpg.tpg_id=Vacante.tpg_id','tpg')
                    ->leftjoin('Catvacante','cav.cav_id=Vacante.cav_id','cav')
                    ->execute();
        
                if (count($registro)>0) {
                    $answer['analiticas']['vac_exc_fat'] =$obj_vac->getExpedientesRelacionadosVacanteFacturados($vac_id);
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
            $data_bit = [
                'bit_descripcion'=>'ERROR OBTENER DETALLES DE GET DETALLE VACANTE : '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
            error_log("ERROR EN OBTENER DETALLES DE GET DETALLE VACANTE: ".$e->getMessage());

        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();

    }

    public function actualizarAction($vac_id=0)
    {  
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(31,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
           
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al actualizar los datos de la vacante',
            'titular' => 'Error',
        ];
        $mensaje_extra_bitacora = '';
        $mensaje_extra_json = '';
        $this->db->begin();
        try {
            $this->view->disable();
            
            if ($this->request->isAjax()) {

               // $vacante_id = $this->request->getPost('vacante_id');
                $vacante_id =$vac_id;
                $vacante_obj = Vacante::findFirstByvac_id($vacante_id);
                
                if ($vacante_obj) {
                    $data = $this->request->getPost();
                    ///VALIDACION FIN

                    if(isset($data["vac_numero"])){
                        $respuesta_modelo_vac_validacion_min_numero = $vacante_obj->ValidarLimiteFacturacionVacNumero($data, $auth);
                        if($respuesta_modelo_vac_validacion_min_numero["estado"]!=2){
                            $this->db->rollback();
                            $this->response->setJsonContent($respuesta_modelo_vac_validacion_min_numero);
                            $this->response->send();
                            return;
                        }
                    }

                    //2-validar que usuario/ejecutivo en cuestion no tenga la vacante compartida ---INICIO
                    $eje_tiene_vac_compartida=null;
                    $rel_eje_vac_compartido_obj=new Relvacanteejecutivo();
                    $respuesta_modelo_rel_eje_vac_tiene=$rel_eje_vac_compartido_obj->getEjecutivoTieneVacCompartida($vac_id,$data["eje_id"]);
                    $eje_tiene_vac_compartida= $respuesta_modelo_rel_eje_vac_tiene["tiene_vac_rel"];
                    if($respuesta_modelo_rel_eje_vac_tiene["tiene_vac_rel"]){
                        $this->db->rollback();
                        $answer['estado'] = -1;
                        $answer['mensaje'] = 'No puedes asignar a un ejecutivo que tiene compartida la vacante actual';
                        $answer['titular'] = 'AVISO';
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                       
                    }
                    //2-validar que usuario/ejecutivo en cuestion no tenga la vacante compartida ---FIN

                    ///VALIDACION FIN
                    $permiso_54=$rol->verificar(54,$auth['rol_id']); //el número en la funcion es el correspondiente a la bdd
                    $permiso_58=$rol->verificar(58,$auth['rol_id']); //el número en la funcion es el correspondiente a la bdd

                    //error_log($permiso_54);
                    $respuesta_modelo_vac = $vacante_obj->ActualizarGeneral($data, $auth,$permiso_54,$permiso_58,$eje_tiene_vac_compartida);
                    if( $respuesta_modelo_vac["estado"]!=2)
                        throw new Exception("Error al actualizar datos, detalles ".print_r($respuesta_modelo_vac));
                    else
                        $mensaje_extra_bitacora.= $respuesta_modelo_vac["mensaje_extra_bitacora"];

                    

                    $data_bit=[
                        'bit_descripcion'=>'Se actualizó una vacante con folio '.$respuesta_modelo_vac['vac_id'].''.$mensaje_extra_bitacora,
                        'bit_tablaid'=>$respuesta_modelo_vac['vac_id'],
                        'bit_modulo'=>"Vacante",
                        'vac_id'=>$respuesta_modelo_vac['vac_id'],
                        'bit_accion'=>2,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    
                    $this->db->commit();
                    $answer['estado'] = 2;
                    $answer['mensaje'] = 'Se actualizaron los datos de la vacante con folio interno '.$vac_id.''.$respuesta_modelo_vac["mensaje_extra_json"];
                    $answer['titular'] = 'Éxito';
                } else {
                    $answer['estado'] = -1;
                    $answer['mensaje'] = 'La vacante no fue encontrada';
                    $answer['titular'] = 'Error';
                }
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {
            $this->db->rollback();
             $answer['detalle'] =$e->getMessage();     
             $data_bit = [
                 'bit_descripcion'=>'ERROR EDITAR VACANTE : '.$answer["detalle"],
                 'bit_tablaid' => $vac_id,
                 'bit_modulo' => "ERROR",
                 'vac_id' => 0,
                 'bit_accion' => 2,
             ];

            $this->bitacora_registro_ERROR($data_bit,$e);
            error_log("ERROR EN Vacante actualizarAction ".$e->getMessage());
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

    public function referencias_indexAction(){
        $this->tag->setTitle('Referencias');
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(26,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
    }

    
    public function referencias_tablaAction(){
        $this->view->registros=[];
        $condicion_sql="exc.exc_estatus='2'";
        $auth = $this->session->get('auth');
        $tienePermiso=0;
        $rol = new Rol();
        try {

            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
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

            if($rol->verificar(65,$auth['rol_id'])) {//solo asignados 
                $condicion_sql.=" AND exc.eje_idprincipal=".$auth['id'];
                $tienePermiso=1;

            }elseif ($rol->verificar(66,$auth['rol_id'])) {//todos
            $tienePermiso=1;

            }elseif ($rol->verificar(67,$auth['rol_id'])) {//auxiliar
            $condicion_sql.=" AND sel.sel_necesitoauxiliar=1  AND sel.usu_idauxiliar=".$auth['id']." ";
            $tienePermiso=1;

            }
            
            if ($tienePermiso==1) {
                $vacantes = $vacantes->where($condicion_sql);    
                $reg = $vacantes->getQuery()->execute();
            }else{
                $reg =[];

            }
            // Resto del código
       
            $data_bit=[
                'bit_descripcion'=>'Consultó referencias',
                'bit_tablaid'=>0,
                'bit_modulo'=>'Vacante',
                'vac_id'=>0,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);
            $this->view->registros=$reg;
            $this->view->vac_obj=new Vacante();
            $this->view->obj_exc = new Expedientecan();
        } catch (\Exception $e) {
            error_log('no cargo la tabla '.$e->getMessage());
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'DETALLES CONSULTÓ REF VAC ERROR '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);

        }

    }


    public function autorizacion_indexAction(){
        $this->tag->setTitle('Autorización');
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(45,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
    }

    
    public function autorizacion_tablaAction(){
        $condicion_sql = "Expedientecan.exc_estatus='5' ";
        $tienePermiso=0;
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
        $rol = new Rol();
        try {
          
            $cita = Expedientecan::query()
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
                    Expedientecan.exc_id,
                    Expedientecan.exc_estatus,
                    Expedientecan.vac_id,
                    Expedientecan.exc_autorizado,
                    Expedientecan.eje_idprincipal,
                    cit.cit_observaciones,
                    emp.emp_nombre,
                    emp.emp_alias,
                    emp.emp_id,
                    cav.cav_nombre,
                    est.est_nombre,
                    mun.mun_nombre,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    vac.vac_fecharegistro,
                    Expedientecan.exc_fechaautorizo

                '))
               // ->leftjoin('Expedientecan','exc.exc_id=Expedientecan.exc_id','exc')//join mas importante
                ->leftjoin('Cita','cit.exc_id=Expedientecan.exc_id','cit')
                ->leftjoin('Medio','med.med_id=cit.med_id','med')
                ->leftjoin('Tipocita','tic.tic_id=cit.tic_id','tic')
                ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Usuario','exc_eje.usu_id=Expedientecan.eje_idprincipal','exc_eje')
                ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can');
            
            if($rol->verificar(70,$auth['rol_id'])) {//solo asignados 
                $condicion_sql.=" AND Expedientecan.eje_idprincipal=".$auth['id'];
                $tienePermiso=1;
            }elseif ($rol->verificar(71,$auth['rol_id'])) {//todos
                $tienePermiso=1;
            }

            if ($tienePermiso=1) {
                $reg = $cita->where($condicion_sql)->orderBy('Expedientecan.exc_id DESC')->execute();
            }else{
                $reg=[];
            }

            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general autorización",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Autorización",
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
            error_log('Autorización tabla ERROR '.$e->getMessage());
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'DETALLES CONSULTÓ REFERENCIAS VACANTE ERROR '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);     
        }
    }


    public function entrevista_indexAction(){
        $this->tag->setTitle('Entrevista');
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(46,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
    }

    
    public function entrevista_tablaAction(){
        $condicion_sql = "exc.exc_estatus='4' ";
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
        $rol = new Rol();
        $tienePermiso=0;
        try {
          
            $cita = Entrevista::query()
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
                    Entrevista.ent_fecharegistro,
                    Entrevista.ent_fecha,
                    Entrevista.ent_hora,
                    Entrevista.ent_id,
                    Entrevista.ent_sueldo,
                    Entrevista.ent_seleccionado,
                    Entrevista.ent_observacion,
                    Entrevista.ent_motivo,
                    CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre

                '))
                ->leftjoin('Expedientecan','exc.exc_id=Entrevista.exc_id','exc')//join mas importante
                ->leftjoin('Cita','cit.exc_id=exc.exc_id','cit')
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
            
            if($rol->verificar(72,$auth['rol_id'])) {//solo asignados 
                $condicion_sql.=" AND exc.eje_idprincipal=".$auth['id'];
                $tienePermiso=1;
            }elseif ($rol->verificar(73,$auth['rol_id'])) {//todos
                $tienePermiso=1;
            }
            
            if($tienePermiso==1){
                $reg = $cita->where($condicion_sql)->orderBy('exc.exc_id DESC')->execute();

            }else{
                $reg = [];

            }
            $data_bit=[
                'bit_descripcion'=>"Consultó la tabla general entrevista",
                'bit_tablaid'=>0,
                'bit_modulo'=>"Autorización",
                'vac_id'=>0,
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);

            $this->view->registros = $reg;
            $this->view->obj_cita = new Cita();
            $this->view->obj_ent = new Entrevista();
            $this->view->obj_exc = new Expedientecan();
            $date = new DateTime();
            $hoy = $date->format('Y-m-d');
            $this->view->hoy = $hoy;
        } catch (\Exception $e) {
            $this->view->registros = [];
            error_log($e->getMessage());
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'ERROR TABLA ENTREVISTA : '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
           
        }
    }

    public function actualizar_no_vac_disponiblesAction($vac_id=0)
    {   
       
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(58,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');
        
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al actualizar los datos de la vacante',
            'titular' => 'Error',
        ];
        $mensaje_extra = '';
        $mensaje_extra_json = '';

       $this->db->begin();

        try {
           
            $this->view->disable(); 
            if ($this->request->isAjax()) {

               // $vacante_id = $this->request->getPost('vacante_id');
                $vacante_id =$vac_id;
                $vacante_obj = Vacante::findFirstByvac_id($vacante_id);
                
                if ($vacante_obj) {
                    $data = $this->request->getPost();

                    $respuesta_modelo_vac_validacion_min_numero = $vacante_obj->ValidarLimiteFacturacionVacNumero($data, $auth);
                    if($respuesta_modelo_vac_validacion_min_numero["estado"]!=2){
                        $this->response->setJsonContent($respuesta_modelo_vac_validacion_min_numero);
                        $this->response->send();
                        return;
                    }
                    $respuesta_modelo_vac = $vacante_obj->ActualizarVacNoGeneral($data, $auth);
                    $mensaje_extra.=$respuesta_modelo_vac["mensaje"];

                    if($respuesta_modelo_vac["estado"]==-2){
                        throw new Exception("Error al actualizar los datos de la vacante");
                    }

                    $data_bit=[
                        'bit_descripcion'=>'Se actualizó una vacante con folio '.$respuesta_modelo_vac['vac_id'].$mensaje_extra,
                        'bit_tablaid'=>$respuesta_modelo_vac['vac_id'],
                        'bit_modulo'=>"Vacante",
                        'vac_id'=>$respuesta_modelo_vac['vac_id'],
                        'bit_accion'=>2,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $this->db->commit();
                    $answer['estado'] = 2;
                    $answer['mensaje'] = 'Se actualizó el número de vacantes, antes eran '.$respuesta_modelo_vac["vac_numero_anterior"].', ahora son  '.$respuesta_modelo_vac["vac_numero"];
                    $answer['titular'] = 'Éxito';
                } else {
                    $answer['estado'] = -1;
                    $answer['mensaje'] = 'La vacante no fue encontrada';
                    $answer['titular'] = 'Error';
                }
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {
             $this->db->rollback();
             $answer['detalle'] =$e->getMessage();     
             $data_bit = [
                 'bit_descripcion'=>'ERROR EDITAR VACANTE : '.$answer["detalle"],
                 'bit_tablaid' => $vac_id,
                 'bit_modulo' => "ERROR ",
                 'vac_id' => 0,
                 'bit_accion' => 2,
             ];
            error_log("ERROR EN Vacante actualizar_no_vac_disponiblesAction ".$e->getMessage());
            $this->bitacora_registro_ERROR($data_bit,$e);
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }


    public function ajax_get_detalle_vac_numeroAction($vac_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $answer = array();
        $this->view->disable();
        $obj_vac=new Vacante();
        $answer['vac_id']=$vac_id;
        try {
            if ($this->request->isAjax() && $vac_id > 0) {
                $registro = Vacante::query()
                    ->columns('
                        Vacante.vac_id,
                        Vacante.vac_numero,
                        sex.sex_nombre,
                        est.est_nombre,
                        mun.mun_nombre,
                        gen.gen_nombre,
                        CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                        tie.tie_nombre,
                        esc.esc_nombre,
                        gra.gra_nombre,
                        eje.usu_nombre,
                        pre.pre_nombre,
                        cen.cen_nombre,
                        cne.cne_nombre,
                        CONCAT(cne.cne_nombre," ", cne.cne_primerapellido," ",cne.cne_segundoapellido) as cne_nombre_completo,
                        tip.tip_nombre,
                        cav.cav_nombre,
                        emp.emp_nombre,
                        Vacante.vac_estatus
                        
                    ')
                    ->where('vac_id=' . $vac_id)
                    ->leftjoin('Empresa','emp.emp_id=Vacante.emp_id','emp')
                    ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
                    ->leftjoin('Tipovacante','tip.tip_id=Vacante.tip_id','tip')
                   // ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
                    ->leftjoin('Estado','est.est_id=Vacante.est_id','est')
                    ->leftjoin('Municipio','mun.mun_id=Vacante.mun_id','mun')
                    ->leftjoin('Generacion','gen.gen_id=Vacante.gen_id','gen')
                    ->leftjoin('Tipoempleo','tie.tie_id=Vacante.tie_id','tie')
                    ->leftjoin('Estadocivil','esc.esc_id=Vacante.esc_id','esc')
                    ->leftjoin('Gradoescolar','gra.gra_id=Vacante.gra_id','gra')
                    ->leftjoin('Usuario','eje.usu_id=Vacante.eje_id','eje')
                    ->leftjoin('Prestacion','pre.pre_id=Vacante.pre_id','pre')
                    ->leftjoin('Centrocosto','cen.cen_id=Vacante.cen_id','cen')
                    ->leftjoin('Contactoemp','cne.cne_id=Vacante.cne_id','cne')
                    ->leftjoin('Catvacante','cav.cav_id=Vacante.cav_id','cav')
                    ->execute();
        
                if (count($registro)>0) {

                    $answer['analiticas']['vac_exc_gar'] =$obj_vac->getExpedientesRelacionadosVacanteGarantia($vac_id);
                    $answer['analiticas']['vac_exc_general'] =$obj_vac->getExpedientesRelacionadosVacante($vac_id);
                    $answer['analiticas']['vac_exc_fat'] =$obj_vac->getExpedientesRelacionadosVacanteFacturados($vac_id);
                    $answer['analiticas']['vac_exc_cancelados'] =$obj_vac->getExpedientesEstatusCancelado($vac_id);

                  //  error_log(print_r($answer['analiticas']['vac_exc_cancelados'],true));
                    $answer['analiticas']['vac_numero'] =$registro[0]->vac_numero;
                 
                    //validacion
                    if ($answer['analiticas']['vac_numero'] != 0) {
                        $answer['analiticas']['porcentaje_progreso'] = ($answer['analiticas']['vac_exc_fat'] / $answer['analiticas']['vac_numero']) * 100;
                        $answer['analiticas']['porcentaje_garantia_permitidas'] = ($answer['analiticas']['vac_exc_gar'] / $answer['analiticas']['vac_numero']) * 100;
                        $answer['analiticas']['porcentaje_fat'] = ( $answer['analiticas']['vac_exc_gar'] /  $answer['analiticas']['vac_numero']) * 100;

                    } else {
                        // Manejo de error o valor predeterminado cuando el divisor es cero
                        $answer['analiticas']['porcentaje_progreso'] = 0; // O cualquier otro valor adecuado
                        $answer['analiticas']['porcentaje_garantia_permitidas'] = 0; // O cualquier otro valor adecuado
                        $answer['analiticas']['porcentaje_fat'] =0;

                    }
                    $answer['analiticas']['porcentaje_fat'] =number_format($answer['analiticas']['porcentaje_fat'],2);
                    $answer['analiticas']['porcentaje_garantia_permitidas'] =number_format($answer['analiticas']['porcentaje_garantia_permitidas'],2);
                    $answer['analiticas']['porcentaje_progreso'] =number_format($answer['analiticas']['porcentaje_progreso'],2);
                    $answer['analiticas']['porcentaje_progreso_faltante'] =number_format(100-$answer['analiticas']['porcentaje_progreso'],2);
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
            $answer['detalle'] =$e->getMessage();   
            error_log($answer['detalle']);  
            $data_bit = [
                'bit_descripcion'=>'ERROR ANALÍTICAS  DE VACANTE : '.$answer["detalle"],
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
    public function ajax_get_detalle_vac_cancelarAction($vac_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer['estado']=-2;
        $obj_vac=new Vacante();
        $answer['vac_id']=$vac_id;
        $condicion_sql='';
        try {
            if ($this->request->isAjax() && $vac_id > 0) {
                $condicion_sql='exc.vac_id = '.$vac_id.' AND exc.exc_estatus  IN (1, 2, 3, 4, 5) ';
                $condicion_sql_fat='exc.vac_id = '.$vac_id.' AND exc.exc_estatus= 6';
        
                $regs = new Builder();
                $regs=$regs->columns(array('
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
                            cav.cav_nombre,
                            emp.emp_nombre,
                            vac.vac_estatus
                    '))
                     ->addFrom('Expedientecan',"exc")
                     ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                     ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                     ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                     ->leftjoin('Estado','est.est_id=vac.est_id','est')
                     ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                     ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                     ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav');
                $regs_exc=$regs;
                $regs_exc_fat=$regs;
                $regs_exc=$regs_exc->where($condicion_sql)->getQuery()->execute();
                $data_exc_fat=$regs_exc_fat->where($condicion_sql_fat)->getQuery()->execute();

                $answer["data_exc"]=$regs_exc;
                $answer["data_exc_count"]=$regs_exc->count();

                $answer["data_exc_fat"]=$data_exc_fat;
                $answer["data_exc_fat_count"]=$data_exc_fat->count();

                $answer["estado"]= 2;
                $answer["titular"]= "OK";
                $answer["mensaje"]= "OK";

                
            }else{
                $answer["estado"] = -2;
            }
        } catch (\Exception $e) {
            $answer["estado"] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $answer['detalle'] =$e->getMessage();     
            $data_bit = [
                'bit_descripcion'=>'ERROR ANALÍTICAS  DE VACANTE : '.$answer["detalle"],
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
            error_log("ERROR EN Vacante ajax_get_detalle_vac_cancelarAction ".$e->getMessage());

        }
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function cancelar_vacanteAction($vac_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $answer['titular']='ERROR';
        $answer['estado']=-2;
        $obj_com=new Comentariovac();
        $fecha_y_hora = date("Y-m-d H:i:s");
        $answer['vac_id']=$vac_id;
        $condicion_sql='';
        $mensaje_extra='';
        $this->db->begin();

        try {
            if ($this->request->isAjax() && $vac_id > 0) {
                $data = $this->request->getPost();
                $vacante_obj = Vacante::findFirstByvac_id($vac_id);
                if (!$vacante_obj) 
                  throw new Exception("No se encontró la vacante");

                if($data["vac_comentario"]==""){
                    $this->db->rollback();
                    $answer['estado']=-1;
                    $answer['titular']='AVISO';
                    $answer['mensaje']='FALTA COMENTARIO';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }

                $data_com=[];
                $data_com["cmv_comentario"]="SE CANCELÓ  LA VACANTE: ".$data["vac_comentario"];
                $data_com["cmv_vista"]= "general,cancelar";
                $data_com["vac_id"]= $vac_id;
                $data_com["vac_estatus"]= $vacante_obj->vac_estatus;

                $respuesta_modelo_comentario_vac=$obj_com->NuevoRegistro($data_com,$auth);
                if($respuesta_modelo_comentario_vac["estado"]!=2)
                    throw new Exception("ERROR AL CARGAR EL COMENTARIO");
                

                 $regs = new Builder();
                 $regs_exc=$regs
                 ->addFrom('Expedientecan',"exc")
                 ->where("exc.exc_estatus IN (1, 2, 3, 4, 5)")
                 ->getQuery()
                 ->execute();
              
                //OBTENERMOS LA CONF
                $container = Di::getDefault();
                // Consulta de actualización
                $updateQuery = "UPDATE `expedientecan` 
                SET `exc_estatusprevio` = `exc_estatus`, 
                    `exc_estatus` = '-1', 
                    `exc_fechacancelacion` = '$fecha_y_hora' 
                WHERE `expedientecan`.`vac_id` = $vac_id 
                AND `expedientecan`.`exc_estatus` IN (1, 2, 3, 4, 5);";
                // Ejecutar la consulta de actualización
                $affectedRows = $container->getShared('db')->execute($updateQuery);

                if ($affectedRows == false) 
                      throw new Exception("ERROR AL ACTUALIZAR LA VACANTE");

                $respuesta_modelo_cancelar_vac=$vacante_obj->CancelarVacante($auth);
                if($respuesta_modelo_cancelar_vac["estado"]==2)
                    $mensaje_extra.=$respuesta_modelo_cancelar_vac["mensaje_estatus"];
                else
                    throw new Exception("ERROR AL ACTUALIZAR LA VACANTE");
                
                $data_bit=[
                    'bit_descripcion'=>"Canceló la vacante No. ".$vac_id." ".$mensaje_extra.' expedientes cancelados: '. $regs_exc->count(),
                    'bit_tablaid'=>0,
                    'bit_modulo'=>"Vacante",
                    'vac_id'=>$vac_id,
                    'bit_accion'=>2,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->db->commit();
                $answer["estado"]= 2;
                $answer["titular"]="OK";
                $answer["mensaje"]="Se canceló la vacante No.  ".$vac_id." ".$mensaje_extra.' expedientes cancelados: '. $regs_exc->count();    
            }else{
                $answer["estado"] = -2;
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $answer["estado"] = -2;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $answer['detalle'] =$e->getMessage();     
            error_log($answer['detalle']);
            $data_bit = [
                'bit_descripcion'=>'ERROR CANCELAR  VACANTE : '.$answer["detalle"],
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


    public function ajax_get_detalle_arc_cotAction($vac_id=0){
                $rol = new Rol();
                $answer = array();
                $auth = $this->session->get('auth');
                $answer['mensaje']='ERROR';
                $this->view->disable();
                $obj_vac=new Vacante();
                try {
                    if ($this->request->isAjax() && $vac_id > 0) {

                        $obj_arc_vac=new Archivovac();
                        //VERIFICAMOS QUE EXISTA EL ARCHIVO  INICIO
                        $respuesta_modelo_verificar_cotizacion_vac=$obj_arc_vac->getVerificarSiEstaElArchivoCotizacion($vac_id);
                        if($respuesta_modelo_verificar_cotizacion_vac["estado"]==2){
                            $answer["estado"]=2;
                            $answer["titular"]="OK";
                            $answer["mensaje"]="OK";
                            $answer["data"]=1;

                        }else if($respuesta_modelo_verificar_cotizacion_vac["estado"]==-1){
                            $answer["estado"]=-1;
                            $answer["mensaje"]="AVISO";
                            $answer["titular"]="NO HAY INFORMACIÓN DE LA COTIZACIÓN DE LA VACANTE";

                            $answer["data"]=[];
                        }else{
                            throw new Exception("ERROR EN VERIFICAR ARCHIVOS");
                        }
                        //VERIFICAMOS QUE EXISTA EL ARCHIVO FIN

                       
                    } else {
                        $answer[0] = -1;
                    }
                } catch (\Exception $e) {
                    $answer[0] = -1;
                    $answer['mensaje'] = 'Error: ' . $e->getMessage();
                    $data_bit = [
                        'bit_descripcion'=>'ERROR OBTENER DETALLES DE GET DETALLE VACANTE ARCHIVOS  : '.$answer["detalle"],
                        'bit_tablaid' => 0,
                        'bit_modulo' => "ERROR ",
                        'vac_id' => 0,
                        'bit_accion' => 4,
                    ];
                    error_log("ERROR EN Vacante ajax_get_detalle_arc_cotAction ".$e->getMessage());
                    $this->bitacora_registro_ERROR($data_bit,$e);
                }
                
        $this->response->setJsonContent($answer);
        $this->response->send();

    }

    public function mandar_garantiaAction($vac_id=0){
      
            $rol = new Rol();
            $auth = $this->session->get('auth');
            if(!$rol->verificar(31,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                $this->response->redirect('errors/errorpermiso');
               
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al mandar a garantía la vacante',
                'titular' => 'Error',
            ];
            $mensaje_extra_bitacora = '';
            $mensaje_extra_json = '';
            $this->db->begin();
            try {
                $this->view->disable();
                
                if ($this->request->isAjax()) {
                    $vacante_id =$vac_id;
                    $vacante_obj = Vacante::findFirstByvac_id($vacante_id);
                    $comentario_obj =new Comentariovac();

                    if ($vacante_obj) {
                        $data = $this->request->getPost();
    
                        //VALIDACIONES -INICIO
                        if ($vacante_obj->vac_estatus==5) 
                            throw new Exception("ERROR EN ESTATUS VACANTE...");
                        
                        //if ($vacante_obj->getExpedientesRelacionadosVacanteGarantia()>=$vacante_obj->vac_garantia) 
                        //    throw new Exception("LÍMITE SUPERADO EN GARANTÍAS PERMITIDAS...");
                        //VALIDACIONES -FIN

                        
                        //COMENTARIO -INICIO
                        $data_com=$data;
                        $data_com["cmv_vista"]="general";
                        $data_com["vac_estatus"]=$vacante_obj->vac_estatus;
                        $data_com["cmv_comentario"]="MANDO A GARANTÍA: ".$data["cmv_comentario"];
                        $respuesta_modelo_comentario = $comentario_obj->NuevoRegistro($data_com,$auth);
                            if( $respuesta_modelo_comentario["estado"]!=2)
                                throw new Exception("Error al registrar comentario ".print_r($respuesta_modelo_comentario));
                            else
                                $mensaje_extra_bitacora.= $respuesta_modelo_comentario["mensaje_extra_bitacora"];
                               
                        //COMENTARIO -FIN

                        //MANDAR A GARANTIA -INICIO
                        $respuesta_modelo__mandar_gar_vac = $vacante_obj->MandarGarantia($auth);
                            if( $respuesta_modelo__mandar_gar_vac["estado"]!=2)
                                throw new Exception("Error al mandar a garantía ".print_r($respuesta_modelo__mandar_gar_vac));
                            else
                                $mensaje_extra_bitacora.= $respuesta_modelo__mandar_gar_vac["mensaje_extra_bitacora"];
                        //MANDAR A GARANTIA -FIN
                        
                        $data_bit=[
                            'bit_descripcion'=>'Se mandó garantía una vacante con folio '.$vac_id.''.$mensaje_extra_bitacora,
                            'bit_tablaid'=>$vac_id,
                            'bit_modulo'=>"Vacante",
                            'vac_id'=>$vac_id,
                            'bit_accion'=>2,
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        $this->db->commit();
                        $answer['estado'] = 2;
                        $answer['mensaje'] = 'Se mandó a garantía una vacante '.$respuesta_modelo__mandar_gar_vac["mensaje_extra_json"];
                        $answer['titular'] = 'Éxito';
                    } else {
                        $answer['estado'] = -1;
                        $answer['mensaje'] = 'La vacante no fue encontrada';
                        $answer['titular'] = 'Error';
                    }
                }
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            } catch (Exception $e) {
                $this->db->rollback();
                 $answer['detalle'] =$e->getMessage();     
                 $data_bit = [
                     'bit_descripcion'=>'ERROR MANDAR GARANTÍA : '.$answer["detalle"],
                     'bit_tablaid' => $vac_id,
                     'bit_modulo' => "ERROR",
                     'vac_id' => $vac_id,
                     'bit_accion' => 2,
                 ];
                $this->bitacora_registro_ERROR($data_bit,$e);
                error_log("ERROR EN Vacante mandar_garantiaAction ".$e->getMessage());
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            }
    }


    public function compartir_vacanteAction($vac_id=0){
            $rol = new Rol();
            $auth = $this->session->get('auth');
           // if(!$rol->verificar(96,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
             //   $this->responderError('errors/errorpermiso');
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al compartir la vacante',
                'titular' => 'Error',
            ];
            $mensaje_extra_bitacora = '';
            $mensaje_extra_json = '';
            $this->db->begin();
            try {
                $this->view->disable();
                
                if ($this->request->isAjax()) {
                    $data = $this->request->getPost();
                    $vacante_id =$vac_id;
                    $relvaceje=new Relvacanteejecutivo();
                    $vacante_obj = Vacante::findFirstByvac_id($vacante_id);
                        if (!$vacante_obj) 
                        throw new Exception("Vacante no encontrada");

                        $eje_id=$data["eje_id"];
                        $data["vac_estatus"]=$vacante_obj->vac_estatus;
                        //COMPARTIR VACANTE -INICIO
                        $respuesta_modelo_compartir_vacante = $relvaceje->compartirVacante($vac_id,$eje_id,$data,$auth);
                            if( $respuesta_modelo_compartir_vacante["estado"]!=2)
                                throw new Exception("Error al compartir vacante ".print_r($respuesta_modelo_compartir_vacante));
                            else
                                $mensaje_extra_bitacora.= $respuesta_modelo_compartir_vacante["mensaje_extra_bitacora"];
                        //COMPARTIR VACANTE -FIN
                        
                        $mensaje_descripcion='Se compartió una vacante con folio  '.$vac_id.' '.$mensaje_extra_bitacora;
                        //BITACORA INI
                        $data_bit=[
                            'bit_descripcion'=>$mensaje_descripcion,
                            'bit_tablaid'=>$vac_id,
                            'bit_modulo'=>"Vacante",
                            'vac_id'=>$vac_id,
                            'bit_accion'=>2,
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        //BITACORA FIN
                        
                        $this->db->commit();
                        $answer["estado"]=2;
                        $answer["titular"]="OK";
                        $answer["mensaje"]=$mensaje_descripcion;
                        $answer["data"]=$data;
                        $answer["vac_id"]=$vac_id;
                        $answer["eje_id"]=$eje_id;
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                }
                
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            } catch (Exception $e) {
                $this->db->rollback();
                $answer['detalle'] =$e->getMessage();     
                $data_bit = [
                    'bit_descripcion'=>'ERROR COMPARTIR VACANTE  : '.$answer["detalle"],
                    'bit_tablaid' => $vac_id,
                    'bit_modulo' => "ERROR",
                    'vac_id' => $vac_id,
                    'bit_accion' => 2,
                ];
                error_log("ERROR EN Vacante compartir_vacanteAction ".$e->getMessage());
                $this->bitacora_registro_ERROR($data_bit,$e);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            }


    }

    public function regresar_vacante_finAction($vac_id=0){
            $rol = new Rol();
            $auth = $this->session->get('auth');
            if(!$rol->verificar(31,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                $this->response->redirect('errors/errorpermiso');
            
            $answer = array();
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error cambiar estatus de la vacante',
                'titular' => 'Error',
            ];
            $mensaje_extra_bitacora = '';
            $mensaje_extra_json = '';
            $this->db->begin();
            try {
                $this->view->disable();
                
                if ($this->request->isAjax()) {
                    $vacante_id =$vac_id;
                    $vacante_obj = Vacante::findFirstByvac_id($vacante_id);
                    $comentario_obj =new Comentariovac();

                    if ($vacante_obj) {
                        $data = $this->request->getPost();

                        //VALIDACIONES -INICIO
                         if ($vacante_obj->vac_estatus==5 ||$vacante_obj->vac_estatus==5 || $vacante_obj->vac_estatus!=$data["vac_estatus_actual"] ) 
                           throw new Exception("ERROR EN ESTATUS VACANTE...");
                        
                        //if ($vacante_obj->getExpedientesRelacionadosVacanteGarantia()>=$vacante_obj->vac_garantia) 
                        //    throw new Exception("LÍMITE SUPERADO EN GARANTÍAS PERMITIDAS...");
                        //VALIDACIONES -FIN
                        
                        //COMENTARIO -INICIO
                        $data_com=$data;
                        $data_com["cmv_vista"]="general";
                        $data_com["vac_estatus"]=$vacante_obj->vac_estatus;
                        $data_com["cmv_comentario"]=strtoupper("MANDO A ".$vacante_obj->getEstatusTexto($data["vac_estatus"]).": ".$data["cmv_comentario"]);
                        $respuesta_modelo_comentario = $comentario_obj->NuevoRegistro($data_com,$auth);
                            if( $respuesta_modelo_comentario["estado"]!=2)
                                throw new Exception("Error al registrar comentario ".print_r($respuesta_modelo_comentario));
                            else
                                $mensaje_extra_bitacora.= $respuesta_modelo_comentario["mensaje_extra_bitacora"];
                            
                        //COMENTARIO -FIN
                        
                        //CAMBIAR ESTATUS DE VACANTE INCIO ------------------------------INICIO
                        switch ($data["vac_estatus"]) {
                            case 2:
                                 //MANDAR A PROCESO -INICIO
                                 $respuesta_modelo__mandar_proceso_vac = $vacante_obj->MandarProceso($auth);
                                 if( $respuesta_modelo__mandar_proceso_vac["estado"]!=2)
                                     throw new Exception("Error al mandar a proceso ".print_r($respuesta_modelo__mandar_proceso_vac));
                                 else
                                     $mensaje_extra_bitacora.= $respuesta_modelo__mandar_proceso_vac["mensaje_extra_bitacora"];
                                 //MANDAR A PROCESO -FIN
                                break;
                            case 5:
                                 //MANDAR A GARANTIA -INICIO
                                    $respuesta_modelo__mandar_gar_vac = $vacante_obj->MandarGarantia($auth);
                                    if( $respuesta_modelo__mandar_gar_vac["estado"]!=2)
                                        throw new Exception("Error al mandar a garantía ".print_r($respuesta_modelo__mandar_gar_vac));
                                    else
                                        $mensaje_extra_bitacora.= $respuesta_modelo__mandar_gar_vac["mensaje_extra_bitacora"];
                                //MANDAR A GARANTIA -FIN                    
                            break;
                            default:
                                 throw new Exception("Error al seleccionar el estatus ");
                            break;
                        }

            
                        //CAMBIAR ESTATUS DE VACANTE FIN ------------------------------FIN
                        $data_bit=[
                            'bit_descripcion'=>'Se mandó una vacante a '.$vacante_obj->getEstatusTexto($data["vac_estatus"]).' con folio '.$vac_id.''.$mensaje_extra_bitacora,
                            'bit_tablaid'=>$vac_id,
                            'bit_modulo'=>"Vacante",
                            'vac_id'=>$vac_id,
                            'bit_accion'=>2,
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        $this->db->commit();
                        $answer['estado'] = 2;
                        $answer['mensaje'] = 'Se mandó a '.$vacante_obj->getEstatusTexto($data["vac_estatus"]).' una vacante ';
                        $answer['titular'] = 'Éxito';
                    } else {
                        $answer['estado'] = -1;
                        $answer['mensaje'] = 'La vacante no fue encontrada';
                        $answer['titular'] = 'Error';
                    }
                }
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            } catch (Exception $e) {
                $this->db->rollback();
                $answer['detalle'] =$e->getMessage();     
                $data_bit = [
                    'bit_descripcion'=>'ERROR MANDAR CAMBIAR ESTATUS  : '.$answer["detalle"],
                    'bit_tablaid' => $vac_id,
                    'bit_modulo' => "ERROR",
                    'vac_id' => $vac_id,
                    'bit_accion' => 2,
                ];
                $this->bitacora_registro_ERROR($data_bit,$e);
                error_log("ERROR EN Vacante regresar_vacante_finAction ".$e->getMessage());
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            }
    }



  

    
}