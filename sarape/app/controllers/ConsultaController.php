<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class ConsultaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Consulta');
        parent::initialize();
        $this->view->ocultaredicionarchivo = 1;

    }

    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(76,$auth['rol_id']))
            $this->response->redirect('errors/errorpermiso');

        $indexeje=-1;
        $indexinv=-1;
        $indexest=-1;
        $indexemp=-1;
        $indexcan=-1;
        $this->ejecutivo = new Usuario();
        $exc_obj = new Expedientecan();
        $vac_obj = new Vacante();

        $this->empresa = new Empresa();
        $ejecutivoselect=$this->ejecutivo->getlistausuario();//ejecutivoselect
        $empresaselect=Empresa::find("emp_estatus=2");
        $estadoselect=Estado::find("est_estatus=2");
        $sexselect = Sexo::find("sex_estatus=2");
        $tpgselect = Tipopago::find("tpg_estatus=2");
        $escselect = Estadocivil::find("esc_estatus=2");
        $graselect = Gradoescolar::find("gra_estatus=2");
        $tieselect = Tipoempleo::find("tie_estatus=2");
        $preselect = Prestacion::find("pre_estatus=2");
        $tipselect = Tipovacante::find("tip_estatus=2");
        $ticselect = Tipocita::find("tic_estatus=2");
        $medselect = Medio::find("med_estatus=2");
        $selselect = Seccionlaboral::find("sel_calificacion >= 1");
        $ususelect = $this->ejecutivo->getlistausuario();//usuarioreactivoproceso
        $vacselect = Vacante::find("vac_estatus >= 1");
        $data_bit = [
            'bit_descripcion'=>'Ingresó a módulo de Consulta',
            'bit_tablaid' => 0,
            'bit_modulo' => "Consulta",
            'usu_id' => $auth['id'],
            'vac_id' => 0,
            'bit_accion' => 4,
        ];
        $this->bitacora_registro($data_bit,$auth);
        $this->view->indexeje=$indexeje;
        $this->view->indexinv=$indexinv;
        $this->view->indexest=$indexest;
        $this->view->indexemp=$indexemp;
        $this->view->indexcan=$indexcan;
        $this->view->estadoselect=$estadoselect;
        $this->view->ejecutivoselect=$ejecutivoselect;
        $this->view->empresaselect=$empresaselect;
        $this->view->sexselect=$sexselect;
        $this->view->tpgselect=$tpgselect;
        $this->view->escselect=$escselect;
        $this->view->graselect=$graselect;
        $this->view->tieselect=$tieselect;
        $this->view->preselect=$preselect;
        $this->view->tipselect=$tipselect;
        $this->view->ticselect=$ticselect;
        $this->view->medselect=$medselect;
        $this->view->selselect=$selselect;
        $this->view->ususelect=$ususelect;
        $this->view->vacselect=$vacselect;
        $this->view->ejecutivo = $this->ejecutivo;
        $this->view->empresa = $this->empresa;
        $this->view->exc_estatus=$exc_obj->getTodosEstatusExc();
        $this->view->vacselect_estatus=$vac_obj->estatusTextoArray;
    }

    /**
     * [tablaAction Muestra los registros de la tabla de    ]
     * @param        []
     * @return []    []
     * Notas:la forma de validar los select(catalogos) es validar que no vengan con valor -1
     * la forma de validar que los inputs no vengan vacios es validar que no sean ==""
     *
     */

    public function tablaAction()
    {
        $data = $this->request->getPost();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $array_cabeceras_th=[];
        $array_cabeceras_td_col=[];
        $array_cabeceras_td_col_extra=[];


        if(!$rol->verificar(76,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $datos=[];
        if($this->request->isPost())
        {
        	$date= new DateTime();
	        $hoy=$date->format('Y-m-d');
            $columna_cal=0;
            $data = $this->request->getPost();
            $condicion="";
            $array= [];
            $indexeje=$data["eje_idprincipal"];
            $indexest=$data["exc_estatus"];
            $indexemp=$data["emp_id"];
            $descripcion="Realizó una búsqueda en consulta";
            $usuario= new Usuario();


            if (isset($data["eje_idprincipal"]) && $data["eje_idprincipal"] != -1) {

                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.eje_idprincipal=".$data["eje_idprincipal"] : $condicion.=" and Expedientecan.eje_idprincipal=".$data["eje_idprincipal"];
                $descripcion.=", filtro de ejecutivo de expediente: ".$usuario->getNombre($data["eje_idprincipal"]);
                array_push($array,'Ejecutivo');
            }

            if (isset($data["filtro_vac_id"]) && is_numeric($data["filtro_vac_id"]) && $data["filtro_vac_id"] > 0) {
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.vac_id=".$data["filtro_vac_id"] : $condicion.=" and Expedientecan.vac_id=".$data["filtro_vac_id"];
                $descripcion.=", filtro de vacante ID: ".$data["vac_id"];
                array_push($array,'VacanteID');

            }
            /*info ejecutivos fin */

            if (isset($data["exc_estatus"]) && $data["exc_estatus"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_estatus=".$data["exc_estatus"] :  $condicion.=" and Expedientecan.exc_estatus=".$data["exc_estatus"];
                $filtro= new Expedientecan();
                $estatus=$filtro->getEstatusTexto($data["exc_estatus"]);
                $descripcion.=", filtro de estatus: ".$estatus;
                array_push($array,'Estatus');
            }
            if (isset($data["emp_id"]) && $data["emp_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" emp.emp_id=".$data["emp_id"] :    $condicion.=" and emp.emp_id=".$data["emp_id"];
                $filtro=Empresa::find("emp_id=".$data["emp_id"]);
                $descripcion.=", filtro de empresa: ".$filtro[0]->emp_nombre;
                array_push($array,'Empresa');
            }
            if (isset($data["cne_id"]) && $data["cne_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" vac.cne_id=".$data["cne_id"] :  $condicion.=" and vac.cne_id=".$data["cne_id"];
                $filtro=Contactoemp::find("cne_id=".$data["cne_id"]);
                $descripcion.=", filtro de quien solicito : ".$filtro[0]->cne_nombre.' '.$filtro[0]->cne_primerapellido.' '.$filtro[0]->cne_segundoapellido;
                array_push($array,'Quien solicita');
            }
            if (isset($data["cen_id"]) && $data["cen_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.='  vac.cen_id = '.$data["cen_id"]  : $condicion.=' and  vac.cen_id = '.$data["cen_id"] ;
                $filtro=Centrocosto::find("cen_id=".$data["cen_id"]);
                $descripcion.=", filtro de centro de costo : ".$filtro[0]->cen_nombre.' '.$filtro[0]->cen_correo.' '.$filtro[0]->cen_tel;
                array_push($array,'Centro  de costo');
            }

            if (isset($data["est_id"]) && $data["est_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" vac.est_id=".$data["est_id"] :  $condicion.=" and vac.est_id=".$data["est_id"];
                $filtro=Estado::find("est_id=".$data["est_id"]);
                $descripcion.=", filtro de estado: ".$filtro[0]->est_nombre;
                array_push($array,'Estado');
            }
            if (isset($data["mun_id"]) && $data["mun_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" vac.mun_id=".$data["mun_id"] : $condicion.=" and vac.mun_id=".$data["mun_id"];
                $filtro=Municipio::find("mun_id=".$data["mun_id"]);
                $descripcion.=", filtro de municipio: ".$filtro[0]->mun_nombre;
                array_push($array,'Municipio');
            }

            if (($data["filtro_exc_id"] != '' || $data["filtro_exc_id"] != 0 || $data["filtro_exc_id"] != "0") && !empty($data["filtro_exc_id"])) {
                $data["filtro_exc_id"] = preg_replace("/[^0-9]/", "", $data["filtro_exc_id"]);
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_id = '".$data["filtro_exc_id"]."' " : $condicion.=" and Expedientecan.exc_id = '".$data["filtro_exc_id"]."' ";
                $descripcion.=", filtro de candidato con ID EXPEDIENTE: ".$data["filtro_exc_id"] ;
                array_push($array,'ID EXPEDIENTE');
            }


            if($data["can_curp"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" can.can_curp LIKE '%".$data["can_curp"]."%' " : $condicion.=" and can.can_curp LIKE '%".$data["can_curp"]."%' ";
                $descripcion.=", filtro de candidato con CURP : ".$data["can_curp"] ;
                array_push($array,'CURP');
            }

            $nombre_candidato=0;
            if($data["can_nombre"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" can.can_nombre LIKE '%".$data["can_nombre"]."%' " : $condicion.=" and can.can_nombre LIKE '%".$data["can_nombre"]."%' ";
                $descripcion.=", filtro de candidato con nombre  : ".$data["can_nombre"];
                $nombre_candidato=1;

            }

            if($data["can_primerapellido"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" can.can_primerapellido LIKE '%".$data["can_primerapellido"]."%' " : $condicion.=" and can.can_primerapellido LIKE '%".$data["can_primerapellido"]."%' ";
                $descripcion.=", filtro de candidato con primer apellido  : ".$data["can_primerapellido"] ;
                $nombre_candidato=1;

            }
            if($data["can_segundoapellido"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" can.can_segundoapellido LIKE '%".$data["can_segundoapellido"]."%' " : $condicion.=" and can.can_segundoapellido LIKE '%".$data["can_segundoapellido"]."%' ";
                $descripcion.=", filtro de candidato con segundo apellido  : ".$data["can_segundoapellido"] ;
                $nombre_candidato=1;

            }

            if($nombre_candidato==1){
                array_push($array,'Nombre candidato');
                //array_push($array_cabeceras_td_col,'nombre_completo_candidato');
                //array_push($array_cabeceras_th,'Nombre candidato');
            }


            // filtros anidados incio
            //---------Vacante inicio -----------------------------------------///
            //filtro alta
            $alta=0;
            if($data["exc_registro_fechainicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_registro>='".$data["exc_registro_fechainicial"]."'" : $condicion.=" and exc_registro>='".$data["exc_registro_fechainicial"]."'";
                $descripcion.=", filtro de fecha inicial de alta de Expediente: ".$data["exc_registro_fechainicial"];
                $alta=1;
            }
            if($data["exc_registro_fechafinal"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_registro<='".$data["exc_registro_fechafinal"]." 23:59:59'" :$condicion.=" and exc_registro<='".$data["exc_registro_fechafinal"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de alta de Expediente: ".$data["exc_registro_fechafinal"];
                $alta=1;
            }
            if($alta==1){
                array_push($array,'Fecha de alta');
                array_push($array_cabeceras_td_col,'exc_registro');
                array_push($array_cabeceras_th,'F. de alta');
            }

            //filtro fecha fin
             $fechafin=0;
            if($data["vac_fechavacfin_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_fechafin >='".$data["vac_fechavacfin_f_inicial"]."'" : $condicion.=" and vac_fechafin>='".$data["vac_fechavacfin_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de Vacante: ".$data["vac_fechavacfin_f_inicial"];
                $fechafin=1;
            }
            if($data["vac_fechavacfin_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_fechafin <='".$data["vac_fechavacfin_f_final"]." 23:59:59'" :$condicion.=" and vac_fechafin<='".$data["vac_fechavacfin_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de Vacante: ".$data["vac_fechavacfin_f_final"];
                $fechafin=1;
            }
            if($fechafin==1){
                array_push($array,'Fecha fin de vacante');
                array_push($array_cabeceras_td_col,'vac_fechafin');
                array_push($array_cabeceras_th,'F. fin de vacante');
            }

            //filtro fecha de actualización de vacante
            $fechavac_actualizacion=0;
            if($data["vac_actualizacion_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_actualizacion >='".$data["vac_actualizacion_f_inicial"]."'" : $condicion.=" and vac_fechafin>='".$data["vac_actualizacion_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de actualización de Vacante: ".$data["vac_actualizacion_f_inicial"];
                $fechavac_actualizacion=1;
            }
            if($data["vac_actualizacion_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_actualizacion <='".$data["vac_actualizacion_f_final"]." 23:59:59'" :$condicion.=" and vac_actualizacion<='".$data["vac_actualizacion_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de actualización de Vacante: ".$data["vac_actualizacion_f_final"];
                $fechavac_actualizacion=1;
            }
            if($fechavac_actualizacion==1){
                array_push($array,'Fecha de actualización de vacante');
                array_push($array_cabeceras_td_col,'vac_actualizacion');
                array_push($array_cabeceras_th,'F. de actualización de vacante');

            }

            //filtro fecha de reactivación de proceso
            $fechavac_fechareactivoproceso=0;
            if($data["vac_reactivoproceso_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_fechareactivoproceso >='".$data["vac_reactivoproceso_f_inicial"]."'" : $condicion.=" and vac_fechafin>='".$data["vac_reactivoproceso_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de reactivación de proceso en Vacante: ".$data["vac_reactivoproceso_f_inicial"];
                $fechavac_fechareactivoproceso=1;
            }
            if($data["vac_reactivoproceso_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_fechareactivoproceso <='".$data["vac_reactivoproceso_f_final"]." 23:59:59'" :$condicion.=" and vac_fechareactivoproceso<='".$data["vac_reactivoproceso_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de reactivación de proceso en Vacante: ".$data["vac_reactivoproceso_f_final"];
                $fechavac_fechareactivoproceso=1;
            }
            if($fechavac_fechareactivoproceso==1){
                array_push($array,'Fecha de reactivación de proceso en Vacante');
                array_push($array_cabeceras_td_col,'vac_fechareactivoproceso');
                array_push($array_cabeceras_th,'F. de reactivación de proceso en Vacante');
            }

            //filtro de tipo de sexo en vacante
            if (isset($data["sex_id"]) && $data["sex_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" vac.sex_id=".$data["sex_id"] :  $condicion.=" and vac.sex_id=".$data["sex_id"];
                $filtro=Sexo::find("sex_id=".$data["sex_id"]);
                $descripcion.=", filtro de tipo de sexo: ".$filtro[0]->sex_nombre;
                array_push($array,'Tipo de sexo');
                array_push($array_cabeceras_td_col,'sex_nombre');
                array_push($array_cabeceras_th,'Tipo de sexo');
            }

            //filtro de tipo de pago - pagos aun no esta relacionado a ninguna tabla en la base
            if (isset($data["tpg_id"]) && $data["tpg_id"] != -1) {
                $condicion = ($condicion == '') ? $condicion.=" vac.tpg_id=".$data["tpg_id"] :  $condicion.=" and vac.tpg_id=".$data["tpg_id"];
                $filtro=Tipopago::find("tpg_id=".$data["tpg_id"]);
                $descripcion.=", filtro de tipo de pago: ".$filtro[0]->tpg_nombre;
                array_push($array,'Tipo de pago');
                array_push($array_cabeceras_td_col,'tpg_nombre');
                array_push($array_cabeceras_th,'Tipo de pago');
            }

            //filtro de estado civil
            if($data["esc_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.esc_id=".$data["esc_id"] :  $condicion.=" and vac.esc_id=".$data["esc_id"];
                $filtro=Estadocivil::find("esc_id=".$data["esc_id"]);
                $descripcion.=", filtro de estado civil: ".$filtro[0]->esc_nombre;
                array_push($array,'Estado civil');
                array_push($array_cabeceras_td_col,'esc_nombre');
                array_push($array_cabeceras_th,'Estado civil');
            }

            //filtro de grado escolar
            if($data["gra_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.gra_id=".$data["gra_id"] :  $condicion.=" and vac.gra_id=".$data["gra_id"];
                $filtro=Gradoescolar::find("gra_id=".$data["gra_id"]);
                $descripcion.=", filtro de grado escolar: ".$filtro[0]->gra_nombre;
                array_push($array,'Grado escolar');
                array_push($array_cabeceras_td_col,'gra_nombre');
                array_push($array_cabeceras_th,'Grado escolar');
            }

            //filtro de tipo empleo
            if($data["tie_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.tie_id=".$data["tie_id"] :  $condicion.=" and vac.tie_id=".$data["tie_id"];
                $filtro=Tipoempleo::find("tie_id=".$data["gra_id"]);
                $descripcion.=", filtro de tipo empleo: ".$filtro[0]->tie_nombre;
                array_push($array,'Tipo empleo');
                array_push($array_cabeceras_td_col,'tie_nombre');
                array_push($array_cabeceras_th,'Tipo empleo');
            }

            //filtro de prestación
            if($data["pre_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.pre_id=".$data["pre_id"] :  $condicion.=" and vac.pre_id=".$data["pre_id"];
                $filtro=Prestacion::find("pre_id=".$data["pre_id"]);
                $descripcion.=", filtro de prestación: ".$filtro[0]->pre_nombre;
                array_push($array,'Prestación');
                array_push($array_cabeceras_td_col,'pre_nombre');
                array_push($array_cabeceras_th,'Prestación');
            }

            //filtro de tipo vacante
            if($data["tip_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.tip_id=".$data["tip_id"] :  $condicion.=" and vac.tip_id=".$data["tip_id"];
                $filtro=Tipovacante::find("tip_id=".$data["tip_id"]);
                $descripcion.=", filtro de tipo vacante: ".$filtro[0]->tip_nombre;
                array_push($array,'Tipo vacante');


            }

            //filtro de usuarios que reactivaron proceso
            if($data["usu_idreactivoproceso"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.usu_idreactivoproceso=".$data["usu_idreactivoproceso"] :  $condicion.=" and vac.usu_idreactivoproceso=".$data["usu_idreactivoproceso"];
                $descripcion.=", filtro de usuario que reactivo proceso: ".$usuario->getNombre($data['usu_idreactivoproceso']);
                array_push($array,'Usuario que reactivo proceso');
            }

            //filtro de estatus vacante
            if($data["vac_estatus"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" vac.vac_estatus=".$data["vac_estatus"] :  $condicion.=" and vac.vac_estatus=".$data["vac_estatus"];
                $filtro=Vacante::find("vac_estatus=".$data["vac_estatus"]);
                $descripcion.=", filtro de estatus vacante";
                array_push($array,' Estatus vacante');
            }
            //---------Vacante fin--------------------------------------------///

            //---------Candito inicio -----------------------------------------///
            if($data["can_valido"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" can.can_valido=".$data["can_valido"] : $condicion.=" and can.can_valido=".$data["can_valido"];
                $descripcion.=", filtro de candidato con información valida: ".$data["can_valido"] ;
                array_push($array,' Candidato información valida');
            }
            if($data["can_correo"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" can.can_correo LIKE '%".$data["can_correo"]."%' " : $condicion.=" and can.can_correo LIKE '%".$data["can_correo"]."%' ";
                $descripcion.=", filtro de candidato con correo  : ".$data["can_correo"];
                array_push($array,' Candidato con correo');
            }
            //---------Candidato fin--------------------------------------------///

            //---- Garantia inicio---------------------------------------///
            $fechagar_registro=0;
            if($data["filtro_exc_fechagarantia_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_fechagarantia >='".$data["filtro_exc_fechagarantia_f_inicial"]."'" : $condicion.=" and Expedientecan.exc_fechagarantia >='".$data["filtro_exc_fechagarantia_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de registro de garantía: ".$data["filtro_psi_fecharegistro_f_inicial"];
                $fechagar_registro=1;
            }
            if($data["filtro_exc_fechagarantia_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_fechagarantia <='".$data["filtro_psi_fecharegistro_f_final"]." 23:59:59'" :$condicion.=" and Expedientecan.exc_fechagarantia<='".$data["filtro_psi_fecharegistro_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de registro de garantía: ".$data["filtro_exc_fechagarantia_f_final"];
                $fechapfechagar_registrosi_registro=1;

            }
            if($fechagar_registro==1){
                array_push($array,'Fecha de registro de Garantía');
                array_push($array_cabeceras_td_col,'exc_fechagarantia');
                array_push($array_cabeceras_th,'F. de registro de Garantía');
            }
            if($data["usu_idgarantia"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.usu_idgarantia=".$data["usu_idgarantia"] :  $condicion.=" and Expedientecan.usu_idgarantia=".$data["usu_idgarantia"];
                $descripcion.=", filtro de usuario que mandó a garantía: ".$usuario->getNombre($data['usu_idgarantia']);
                array_push($array,'Usuario que mandó a garantía');
            }
            //---- Garantia fin---------------------------------------///

            //---- Psicometria inicio---------------------------------------///
            if($data["psi_calificacion"]!=-1){
                $condicion = ($condicion == '')
                ? $condicion.=" psi.psi_calificacion='".$data["psi_calificacion"]."'"
                : $condicion.=" and psi.psi_calificacion='".$data["psi_calificacion"]."'";
                $descripcion.=", filtro de calificación psicometría  : ".$data["psi_calificacion"] ;
                array_push($array,' Calificación psicometría');
            }

            //filtro fecha de registro de psicometría
            $fechapsi_registro=0;
            if($data["filtro_psi_fecharegistro_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion."psi.psi_fecharegistro >='".$data["filtro_psi_fecharegistro_f_inicial"]."'" : $condicion.=" and psi.psi_fecharegistro>='".$data["filtro_psi_fecharegistro_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de registro de Psicometría: ".$data["filtro_psi_fecharegistro_f_inicial"];
                $fechapsi_registro=1;
            }
            if($data["filtro_psi_fecharegistro_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" psi.psi_fecharegistro <='".$data["filtro_psi_fecharegistro_f_final"]." 23:59:59'" :$condicion.=" and psi.psi_fecharegistro<='".$data["filtro_psi_fecharegistro_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de registro de Psicometría: ".$data["filtro_psi_fecharegistro_f_final"];
                $fechapsi_registro=1;

            }
            if($fechapsi_registro==1){
                array_push($array,'Fecha de registro de Psicometría');
            }
            //---- Psicometria fin------------------------------------------///

            //---- Entrevista inicio---------------------------------------///
            if($data["ent_seleccionado"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" ent.ent_seleccionado='".$data["ent_seleccionado"]."' " : $condicion.=" and ent.ent_seleccionado='".$data["ent_seleccionado"]."'";
                $descripcion.=", filtro de seleccionado en entrevista  : ".$data["ent_seleccionado"] ;
                array_push($array,' Seleccionado en entrevista');
            }

            //filtro fecha de registro de entrevista
            $ent_fecharegistro=0;
            if($data["filtro_ent_fecharegistro_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ent.ent_fecharegistro >='".$data["filtro_ent_fecharegistro_f_inicial"]."'" : $condicion.=" and ent.ent_fecharegistro>='".$data["filtro_ent_fecharegistro_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de registro de Entrevista: ".$data["filtro_ent_fecharegistro_f_inicial"];
                $ent_fecharegistro=1;
                array_push($array,'Fecha inicio de registro de Entrevista');

            }
            if($data["filtro_ent_fecharegistro_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ent.ent_fecharegistro <='".$data["filtro_ent_fecharegistro_f_final"]." 23:59:59'" :$condicion.=" and ent.ent_fecharegistro<='".$data["filtro_ent_fecharegistro_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de registro de Entrevista: ".$data["filtro_ent_fecharegistro_f_final"];
                $ent_fecharegistro=1;
                array_push($array,'Fecha fin de registro de Entrevista');

            }

            //---- Entrevista fin------------------------------------------///

            //---- Facturación inicio---------------------------------------///
            //filtro de fecha de registro de facturación
             $fat_registro=0;
            if($data["filtro_fat_fecharegistro_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" fat.fat_registro >='".$data["filtro_fat_fecharegistro_f_inicial"]."'" : $condicion.=" and fat.fat_registro>='".$data["filtro_fat_fecharegistro_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de registro de Facturación: ".$data["filtro_fat_fecharegistro_f_inicial"];
                $fat_registro=1;
            }
            if($data["filtro_fat_fecharegistro_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" fat.fat_registro <='".$data["filtro_fat_fecharegistro_f_final"]." 23:59:59'" :$condicion.=" and fat.fat_registro<='".$data["filtro_fat_fecharegistro_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de registro de Facturación: ".$data["filtro_fat_fecharegistro_f_final"];
                $fat_registro=1;
            }
            if($fat_registro==1){
                array_push($array,'Fecha de registro de Facturación');
            }
            //---- Facturación fin---------------------------------------///

            //---- Cita inicio---------------------------------------///
            //filtro fecha de registro de entrevista
            $fecha_cit_registro=0;
            if($data["filtro_cit_registro_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" cit.cit_registro >='".$data["filtro_cit_registro_f_inicial"]."'" : $condicion.=" and cit.cit_registro>='".$data["filtro_cit_registro_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de registro de Cita: ".$data["filtro_cit_registro_f_inicial"];
                $fecha_cit_registro=1;
                array_push($array,'Fecha de registro incio de Cita');

            }
            if($data["filtro_cit_registro_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" cit.cit_registro <='".$data["filtro_cit_registro_f_final"]." 23:59:59'" :$condicion.=" and cit.cit_registro<='".$data["filtro_cit_registro_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de registro de Cita: ".$data["filtro_cit_registro_f_final"];
                $fecha_cit_registro=1;
                array_push($array,'Fecha de registro de Cita');

            }

            //filtro fecha de fecha cita
            $cit_fecha=0;
            if($data["filtro_cit_fecha_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" cit.cit_fecha >='".$data["filtro_cit_fecha_f_inicial"]." 00:00:00'" : $condicion.=" and cit.cit_fecha>='".$data["filtro_cit_fecha_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de Cita: ".$data["filtro_cit_fecha_f_inicial"];
                $cit_fecha=1;
                array_push($array,'Fecha final de Cita');

            }
            if($data["filtro_cit_fecha_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" cit.cit_fecha <='".$data["filtro_cit_fecha_f_final"]." 23:59:59'" :$condicion.=" and cit.cit_fecha<='".$data["filtro_cit_fecha_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de Cita: ".$data["filtro_cit_fecha_f_final"];
                $cit_fecha=1;
                array_push($array,'Fecha final de Cita');

            }

            if($cit_fecha==1){
                array_push($array_cabeceras_td_col,'cit_fecha');
                array_push($array_cabeceras_th,'Fecha de Cita');
            }
            //filtro hora de cita
            $cit_hora=0;
            if($data["filtro_cit_hora_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" cit.cit_hora >='".$data["filtro_cit_hora_f_inicial"]."'" : $condicion.=" and cit.cit_hora>='".$data["filtro_cit_hora_f_inicial"]."'";
                $descripcion.=", filtro de hora inicial de Cita: ".$data["filtro_cit_f_hora_inicial"];
                $cit_hora=1;
                array_push($array,'Hora de Cita');


            }
            if($data["filtro_cit_hora_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" cit.cit_hora <='".$data["filtro_cit_hora_f_final"]."'" :$condicion.=" and cit.cit_hora<='".$data["filtro_cit_hora_f_final"]."'";
                $descripcion.=", filtro de hora final de Cita: ".$data["filtro_cit_hora_f_final"];
                $cit_hora=1;
            }if($cit_hora==1){
                array_push($array,'Hora de Cita');
            }
            if ($cit_hora==1) {
                array_push($array_cabeceras_td_col,'cit_hora');
                array_push($array_cabeceras_th,'Hora de Cita');

            }


            if($data["med_id"]!=-1 ){
                $condicion = ($condicion == '') ? $condicion.=" cit.med_id=".$data["med_id"] : $condicion.=" and cit.med_id=".$data["med_id"];
                $descripcion.=", filtro de medio de contacto  : ".$data["med_id"] ;
                array_push($array,' Medio de contacto');

                array_push($array_cabeceras_td_col,'med_nombre');
                array_push($array_cabeceras_th,'Medio de contacto');
            }

            if($data["tic_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" cit.tic_id=".$data["tic_id"] : $condicion.=" and cit.tic_id=".$data["tic_id"];
                $descripcion.=", filtro de tipo de cita  : ".$data["tic_id"] ;
                array_push($array,' Tipo de cita');
                array_push($array_cabeceras_td_col,'tic_nombre');
                array_push($array_cabeceras_th,'Tipo de cita');
            }
            //---- Cita fin------------------------------------------///

            //---- Seccion laboral inicio---------------------------------------///
            if($data["sel_empleosocultos"]!=-1){
                if ($condicion == '') {
                    $condicion = "sel.sel_empleosocultos = '" . $data["sel_empleosocultos"] . "'";
                } else {
                    $condicion .= " AND sel.sel_empleosocultos = '" . $data["sel_empleosocultos"] . "'";
                }
                $descripcion.=", filtro de sección laboral empleos ocultos  : ".$data["sel_empleosocultos"] ;
                array_push($array,'Empleos ocultos');
                array_push($array_cabeceras_td_col,'sel_empleosocultos');
                array_push($array_cabeceras_th,'Empleos ocultos');
            }
            if($data["sel_necesitoauxiliar"]!=-1){
                if ($condicion == '') {
                    $condicion = "sel.sel_necesitoauxiliar = '" . $data["sel_necesitoauxiliar"] . "'";
                } else {
                    $condicion .= " AND sel.sel_necesitoauxiliar = '" . $data["sel_necesitoauxiliar"] . "'";
                }

                $descripcion.=", filtro de sección laboral necesita auxiliar  : ".$data["sel_necesitoauxiliar"] ;
                array_push($array,'Necesita auxiliar');
                array_push($array_cabeceras_td_col,'sel_necesitoauxiliar');
                array_push($array_cabeceras_th,'Necesita auxiliar');
            }

            if($data["sel_calificacion"]!=-1){

                $condicion = ($condicion == '') ? $condicion.=" sel.sel_calificacion=".$data["sel_calificacion"] : $condicion.=" and sel.sel_calificacion=".$data["sel_calificacion"];
                // error_log($condicion);
                $descripcion.=", filtro de sección laboral calificación  : ".$data["sel_calificacion"] ;
                array_push($array,'Sección laboral calificación');
                array_push($array_cabeceras_td_col,'sel_calificacion');
                array_push($array_cabeceras_th,'Sección laboral calificación');
            }

            //filtro fecha registro de referencias
            $sel_registro=0;
            if($data["filtro_sel_registro_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" sel.sel_registro >='".$data["filtro_sel_registro_f_inicial"]."'" : $condicion.=" and sel.sel_registro>='".$data["filtro_sel_registro_f_inicial"]."'";
                $descripcion.=", filtro de fecha de registro inicial de Referencias: ".$data["filtro_sel_registro_f_inicial"];
                $sel_registro=1;
            }
            if($data["filtro_sel_registro_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" sel.sel_registro <='".$data["filtro_sel_registro_f_final"]." 23:59:59'" :$condicion.=" and sel.sel_registro<='".$data["filtro_sel_registro_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha de registro final de Referencias: ".$data["filtro_sel_registro_f_final"];
                $sel_registro=1;

            }
            if($sel_registro==1){
                array_push($array,'Registro de referencias');

            }

              //filtro fecha de actualización de vacante
              $fechavac_actualizacion=0;
              if($data["vac_actualizacion_f_inicial"]!=""){
                  $condicion = ($condicion == '') ? $condicion.=" vac.vac_actualizacion >='".$data["vac_actualizacion_f_inicial"]."'" : $condicion.=" and vac.vac_fechafin>='".$data["vac_actualizacion_f_inicial"]."'";
                  $descripcion.=", filtro de fecha inicial de actualización de Vacante: ".$data["vac_actualizacion_f_inicial"];
                  $fechavac_actualizacion=1;
              }
              if($data["vac_actualizacion_f_final"]!=""){
                  $condicion = ($condicion == '') ? $condicion.=" vac.vac_actualizacion <='".$data["vac_actualizacion_f_final"]." 23:59:59'" :$condicion.=" and vac.vac_actualizacion<='".$data["vac_actualizacion_f_final"]." 23:59:59'";
                  $descripcion.=", filtro de fecha final de actualización de Vacante: ".$data["vac_actualizacion_f_final"];
                  $fechavac_actualizacion=1;
              }
              if($fechavac_actualizacion==1){
                array_push($array,'Vacante actualización');
              }
             // cav_nombre
             $cav_nombre_mostrar_manualmente=0;
            if($this->cadenaValida($data["cav_nombre"])==1){
                $condicion = ($condicion == '') ? $condicion .= " cav.cav_nombre LIKE '%" . $data["cav_nombre"] . "%'" :  $condicion .= " AND cav.cav_nombre LIKE '%" . $data["cav_nombre"] . "%'";
                $descripcion.=", filtro de puesto vacante : ".$data["cav_nombre"];
                array_push($array_cabeceras_td_col,'cav_nombre');
                array_push($array_cabeceras_th,'Nombre de vacante');
                array_push($array,'Puesto vacante');
            }else {
                $cav_nombre_mostrar_manualmente=1;
            }
            // cav_nombre


            try {
            $expediente_can =Expedientecan::query()
                ->columns("
                Expedientecan.exc_id
                ,Expedientecan.exc_estatus
                ,Expedientecan.usu_idalta
                ,Expedientecan.exc_estatusprevio
                ,Expedientecan.vac_id
                ,Expedientecan.eje_idprincipal
                ,vac.vac_idioma
                ,emp.emp_nombre
                ,emp.emp_id
                ,emp.emp_alias
                ,vac.vac_fechafin
                ,Expedientecan.exc_fechagarantia
                ,Expedientecan.exc_registro
                ,vac.vac_actualizacion
                ,vac.vac_estatus
                ,vac.vac_fechareactivoproceso
                ,Expedientecan.can_id
                ,can.can_curp
                ,can.can_correo
                ,can.can_telefono
                ,can.can_celular
                ,can.can_nosegsocial
                ,can.can_id
                ,vac.cen_id
                ,vac.vac_edadmax
                ,vac.vac_edadmin
                ,vac.vac_sueldomin
                ,vac.vac_sueldomax
                ,cen.cen_nombre
                ,vac.cne_id
                ,tpg.tpg_nombre
                ,gen.gen_nombre
                ,esc.esc_nombre
                ,pre.pre_nombre
                ,sex.sex_nombre
                ,gra.gra_nombre
                ,tie.tie_nombre
                ,vac.est_id, est.est_nombre
                ,vac.mun_id, mun.mun_nombre
                ,cit.cit_id
                ,cit.cit_hora
                ,cit.cit_fecha
                ,med.med_nombre
                ,tic.tic_nombre
                ,sel.sel_id
                ,sel.sel_calificacion
                ,IF(sel.sel_empleosocultos = 1, 'SI', IF(sel.sel_empleosocultos = 0, 'NO', '')) AS sel_empleosocultos
                ,IF(sel.sel_necesitoauxiliar = 1, 'SI', IF(sel.sel_necesitoauxiliar = 0, 'NO', '')) AS sel_necesitoauxiliar
                ,ent.ent_id
                ,psi.psi_id
                ,date_format(Expedientecan.exc_registro,'%d/%m/%Y') as exc_registro
                ,cav.cav_nombre
                ,CONCAT(eje.usu_nombre, ' ', eje.usu_primerapellido,' ', eje.usu_segundoapellido) AS eje_nombre
                ,CONCAT(usualta2.usu_nombre, ' ', usualta2.usu_primerapellido,' ', usualta2.usu_segundoapellido) AS usu_alta_nombre_completo
                ,CONCAT(can.can_nombre, ' ', can.can_primerapellido,' ', can.can_segundoapellido) AS nombre_completo_candidato
                ,CONCAT(exc_eje.usu_nombre, ' ', exc_eje.usu_primerapellido,' ', exc_eje.usu_segundoapellido) AS exc_eje_nombre
                ,CONCAT(cne.cne_nombre, ' ', cne.cne_primerapellido,' ', cne.cne_segundoapellido) AS cne_nombre_completo")
                ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
                ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can')
                ->leftjoin('Usuario','usualta2.usu_id=Expedientecan.usu_idalta','usualta2')
                ->leftjoin('Usuario','usu_actualizo.usu_id=Expedientecan.usu_idactualizo','usu_actualizo')
                ->leftjoin('Usuario','usu_garantia.usu_id=Expedientecan.usu_idgarantia','usu_garantia')
                ->leftjoin('Usuario','usu_autorizo.usu_id=Expedientecan.usu_idautorizo','usu_autorizo')
                ->leftjoin('Tipovacante','tip.tip_id=vac.tip_id','tip')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Generacion','gen.gen_id=vac.gen_id','gen')
                ->leftjoin('Estadocivil','esc.esc_id=vac.esc_id','esc')
                ->leftjoin('Gradoescolar','gra.gra_id=vac.gra_id','gra')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')//ejecutivo
                ->leftjoin('Sexo','sex.sex_id=vac.sex_id','sex')
                ->leftjoin('Centrocosto','cen.cen_id=vac.cen_id','cen')
                ->leftjoin('Contactoemp','cne.cne_id=vac.cne_id','cne')
                ->leftjoin('Tipoempleo','tie.tie_id=vac.tie_id','tie')
                ->leftjoin('Tipopago','tpg.tpg_id=vac.tpg_id','tpg')
                ->leftjoin('Prestacion','pre.pre_id=vac.pre_id','pre')
                ->leftjoin('Candidato','can2.can_id=Expedientecan.can_id','can2')
                ->leftjoin('Usuario','usualta.usu_id=can.usu_idalta','usualta')
                ->leftjoin('Usuario','usuactualiza.usu_id=can.usu_idactualizo','usuactualiza')
                ->leftjoin('Psicometria', 'psi.exc_id=Expedientecan.exc_id AND psi.psi_estatus=2','psi')
                ->leftjoin('Facturacion','fat.exc_id=Expedientecan.exc_id AND fat.fat_estatus=2','fat')//facturacion
                ->leftjoin('Seccionlaboral','sel.exc_id=Expedientecan.exc_id  AND sel.sel_estatus=2','sel')//seción laboral
                ->leftjoin('Cita','cit.exc_id=Expedientecan.exc_id AND cit.cit_estatus > 0','cit')//cita
                ->leftjoin('Entrevista','ent.exc_id=Expedientecan.exc_id  AND ent.ent_estatus=2','ent')//entrevista
                ->leftjoin('Medio','med.med_id=cit.med_id','med')//medio
                ->leftjoin('Tipocita','tic.tic_id=cit.tic_id','tic')//tipo cita
                ->leftjoin('Usuario','exc_eje.usu_id=Expedientecan.eje_idprincipal','exc_eje')
                ->where($condicion)
                ->execute();

                $data_bit=[
                    'bit_descripcion'=>$descripcion,
                    'bit_tablaid'=>0,
                    'bit_modulo'=>"Consulta",
                    'vac_id'=>0,
                    'bit_accion'=>4,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->expediantecan_obj = new Expedientecan();
                $this->usuario = new Usuario();
                $this->view->expediantecan = $this->expediantecan_obj;
                $this->view->usuario = $this->usuario;
                $this->view->page=$expediente_can;
                $this->view->array_cabeceras_th=$array_cabeceras_th;
                $this->view->array_cabeceras_td_col=$array_cabeceras_td_col;
                $this->view->array_cabeceras_td_col_extra=$array_cabeceras_td_col_extra;
                // error_log($cav_nombre_mostrar_manualmente);
                $this->view->cav_nombre_mostrar_manualmente=$cav_nombre_mostrar_manualmente;




                $this->view->mensaje_back="";
            }catch (\Phalcon\Mvc\Model\Exception $e) {
                $mensaje_error="Error SQL: " . $e->getMessage();
                error_log($mensaje_error);
                error_log("ERROR EN LA CONDICION ".$condicion);
                $this->view->page=[];
                $answer['detalle'] =$e->getMessage();
                $data_bit = [
                    'bit_descripcion'=>'ERROR CONSULTA EXPEDIENTE CANDIDATO : '.$answer["detalle"],
                    'bit_tablaid' => 0,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 4,
                ];
                $this->bitacora_registro_ERROR($data_bit,$e);
                $this->view->mensaje_back=$mensaje_error;
            }
        }
        $titulo='Consulta';
        $this->view->titulo=$titulo;
    }

    public function index_vacAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(77,$auth['rol_id']))
            $this->response->redirect('errors/errorpermiso');


        $indexeje=-1;
        $indexinv=-1;
        $indexest=-1;
        $indexemp=-1;
        $indexcan=-1;

        $this->ejecutivo = new Usuario();
        $this->empresa = new Empresa();
        $vac_obj=new Vacante();
        $sel_obj=new Seccionlaboral();

        $ejecutivoselect=$this->ejecutivo->getlistausuario();//ejecutivoselect
        $empresaselect=Empresa::find("emp_estatus=2");

        $estadoselect=Estado::find("est_estatus=2");
        $sexselect = Sexo::find("sex_estatus=2");
        $tpgselect = Tipopago::find("tpg_estatus=2");
        $escselect = Estadocivil::find("esc_estatus=2");
        $graselect = Gradoescolar::find("gra_estatus=2");
        $tieselect = Tipoempleo::find("tie_estatus=2");
        $preselect = Prestacion::find("pre_estatus=2");
        $tipselect = Tipovacante::find("tip_estatus=2");
        $ticselect = Tipocita::find("tic_estatus=2");
        $medselect = Medio::find("med_estatus=2");
        $ususelect = $this->ejecutivo->getanalista();//usuarioreactivoproceso
        $vacselect = Vacante::find("vac_estatus >= 1");

        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingresó a módulo de Consulta";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Consulta";
        $bitacora->NuevoRegistro($databit);

        $this->view->indexeje=$indexeje;
        $this->view->indexinv=$indexinv;
        $this->view->indexest=$indexest;
        $this->view->indexemp=$indexemp;
        $this->view->indexcan=$indexcan;

        $this->view->estadoselect=$estadoselect;
        $this->view->ejecutivoselect=$ejecutivoselect;
        $this->view->empresaselect=$empresaselect;
        $this->view->sexselect=$sexselect;
        $this->view->tpgselect=$tpgselect;
        $this->view->escselect=$escselect;
        $this->view->graselect=$graselect;
        $this->view->tieselect=$tieselect;
        $this->view->preselect=$preselect;
        $this->view->tipselect=$tipselect;
        $this->view->ticselect=$ticselect;
        $this->view->medselect=$medselect;
        $this->view->ususelect=$ususelect;
        $this->view->vacselect=$vacselect;


        $this->view->ejecutivo = $this->ejecutivo;
        $this->view->empresa = $this->empresa;
        $this->view->vacselect_estatus=$vac_obj->estatusTextoArray;


    }

    /**
     * [tablaAction Muestra los registros de la tabla de    ]
     * @param        []
     * @return []    []
     * Notas:la forma de validar los select(catalogos) es validar que no vengan con valor -1
     * la forma de validar que los inputs no vengan vacios es validar que no sean ==""
     *
     */

    public function tabla_vacAction()
    {
        $data = $this->request->getPost();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $array_cabeceras_th=[];
        $array_cabeceras_td_col=[];

        if(!$rol->verificar(77,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $datos=[];
        if($this->request->isPost())
        {
        	$date= new DateTime();
	        $hoy=$date->format('Y-m-d');
            $columna_cal=0;
            $data = $this->request->getPost();
            $condicion="";
            $array= [];
            $indexeje=$data["usu_id"];
            $indexemp=$data["emp_id"];
            $descripcion="Realizó una búsqueda en consulta";
            $usuario= new Usuario();
            // error_log(print_r($data, true));

            if($data["vac_estatus"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_estatus=".$data["vac_estatus"] :  $condicion.=" and Vacante.vac_estatus=".$data["vac_estatus"];
                $filtro= new Vacante();
                $estatus=$filtro->getEstatusTexto($data["vac_estatus"]);
                $descripcion.=", filtro de estatus: ".$estatus;
                array_push($array,'Estatus');
            }

            if (($data["filtro_exc_id"] != '' || $data["filtro_exc_id"] != 0 || $data["filtro_exc_id"] != "0") && !empty($data["filtro_exc_id"])) {

                $data["filtro_exc_id"] = preg_replace("/[^0-9]/", "", $data["filtro_exc_id"]);
                $condicion = ($condicion == '') ? $condicion.=" Expedientecan.exc_id = '".$data["filtro_exc_id"]."' " : $condicion.=" and Expedientecan.exc_id = '".$data["filtro_exc_id"]."' ";
                $descripcion.=", filtro de candidato con ID EXPEDIENTE: ".$data["filtro_exc_id"] ;
                array_push($array,'ID EXPEDIENTE');
            }

            if (($data["filtro_vac_id"] != '' || $data["filtro_vac_id"] != 0 || $data["filtro_vac_id"] != "0") && !empty($data["filtro_vac_id"])) {
                $data["filtro_vac_id"] = preg_replace("/[^0-9]/", "", $data["filtro_vac_id"]);
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_id = '".$data["filtro_vac_id"]."' " : $condicion.=" and Vacante.vac_id = '".$data["filtro_vac_id"]."' ";
                $descripcion.=", filtro de candidato con ID VACANTE: ".$data["filtro_vac_id"] ;
                array_push($array,'ID VACANTE');
            }

            if($data["emp_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.emp_id=".$data["emp_id"] :    $condicion.=" and Vacante.emp_id=".$data["emp_id"];
                $filtro=Empresa::find("emp_id=".$data["emp_id"]);
                $descripcion.=", filtro de empresa: ".$filtro[0]->emp_nombre;
                array_push($array,'Empresa');
            }
            if($data["cne_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.cne_id=".$data["cne_id"] :  $condicion.=" and Vacante.cne_id=".$data["cne_id"];
                $filtro=Contactoemp::find("cne_id=".$data["cne_id"]);
                $descripcion.=", filtro de quien solicito : ".$filtro[0]->cne_nombre.' '.$filtro[0]->cne_primerapellido.' '.$filtro[0]->cne_segundoapellido;
                array_push($array,'Quien solicita');
            }
            if($data["cen_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.='  Vacante.cen_id = '.$data["cen_id"]  : $condicion.=' and  Vacante.cen_id = '.$data["cen_id"] ;
                $filtro=Centrocosto::find("cen_id=".$data["cen_id"]);
                $descripcion.=", filtro de centro de costo : ".$filtro[0]->cen_nombre.' '.$filtro[0]->cen_correo.' '.$filtro[0]->cen_tel;
                array_push($array,'Centro  de costo');
            }

            $data["mun_id"] = isset($data["mun_id"]) ? $data["mun_id"] : -1;
            if($data["mun_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.mun_id=".$data["mun_id"] : $condicion.=" and Vacante.mun_id=".$data["mun_id"];
                $filtro=Municipio::find("mun_id=".$data["mun_id"]);
                $descripcion.=", filtro de municipio: ".$filtro[0]->mun_nombre;
                array_push($array,'Municipio');
            }

            $data["est_id"] = isset($data["est_id"]) ? $data["est_id"] : -1;
            if($data["est_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.est_id=".$data["est_id"] :  $condicion.=" and Vacante.est_id=".$data["est_id"];
                $filtro=Estado::find("est_id=".$data["est_id"]);
                $descripcion.=", filtro de estado: ".$filtro[0]->est_nombre;
                array_push($array,'Estado');
            }

              //filtro de grado escolar
              $data["gra_id"] = isset($data["gra_id"]) ? $data["gra_id"] : -1;
              if($data["gra_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.gra_id=".$data["gra_id"] :  $condicion.=" and Vacante.gra_id=".$data["gra_id"];
                $filtro=Gradoescolar::find("gra_id=".$data["gra_id"]);
                $descripcion.=", filtro de grado escolar: ".$filtro[0]->gra_nombre;
                array_push($array,'Grado escolar');
                array_push($array_cabeceras_td_col,'gra_nombre');
                array_push($array_cabeceras_th,'Grado escolar');
            }


            //filtro de prestación

            if($data["pre_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.pre_id=".$data["pre_id"] :  $condicion.=" and Vacante.pre_id=".$data["pre_id"];
                $filtro=Prestacion::find("pre_id=".$data["pre_id"]);
                $descripcion.=", filtro de prestación: ".$filtro[0]->pre_nombre;
                array_push($array,'Prestación');
                array_push($array_cabeceras_td_col,'pre_nombre');
                array_push($array_cabeceras_th,'Prestación');
            }



            //filtro fecha de actualización de vacante
            $fechavac_actualizacion=0;
            if($data["vac_actualizacion_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_actualizacion >='".$data["vac_actualizacion_f_inicial"]."'" : $condicion.=" and Vacante.vac_fechafin>='".$data["vac_actualizacion_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de actualización de Vacante: ".$data["vac_actualizacion_f_inicial"];
                $fechavac_actualizacion=1;
            }
            if($data["vac_actualizacion_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_actualizacion <='".$data["vac_actualizacion_f_final"]." 23:59:59'" :$condicion.=" and Vacante.vac_actualizacion<='".$data["vac_actualizacion_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de actualización de Vacante: ".$data["vac_actualizacion_f_final"];
                $fechavac_actualizacion=1;
            }
            if($fechavac_actualizacion==1){
                array_push($array,'Fecha de actualización de vacante');
                array_push($array_cabeceras_td_col,'vac_actualizacion');
                array_push($array_cabeceras_th,'F. de actualización de vacante');

            }

            //filtro fecha de reactivación de proceso
            $fechavac_fechareactivoproceso=0;
            if($data["vac_reactivoproceso_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_fechareactivoproceso >='".$data["vac_reactivoproceso_f_inicial"]."'" : $condicion.=" and Vacante.vac_fechafin>='".$data["vac_reactivoproceso_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de reactivación de proceso en Vacante: ".$data["vac_reactivoproceso_f_inicial"];
                $fechavac_fechareactivoproceso=1;
            }
            if($data["vac_reactivoproceso_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_fechareactivoproceso <='".$data["vac_reactivoproceso_f_final"]." 23:59:59'" :$condicion.=" and Vacante.vac_fechareactivoproceso<='".$data["vac_reactivoproceso_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de reactivación de proceso en Vacante: ".$data["vac_reactivoproceso_f_final"];
                $fechavac_fechareactivoproceso=1;
            }
            if($fechavac_fechareactivoproceso==1){
                array_push($array,'Fecha de reactivación de proceso en Vacante');
                array_push($array_cabeceras_td_col,'vac_fechareactivoproceso');
                array_push($array_cabeceras_th,'F. de reactivación de proceso en Vacante');
            }

            //filtro de tipo de sexo en vacante
            if($data["sex_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.sex_id=".$data["sex_id"] :  $condicion.=" and Vacante.sex_id=".$data["sex_id"];
                $filtro=Sexo::find("sex_id=".$data["sex_id"]);
                $descripcion.=", filtro de tipo de sexo: ".$filtro[0]->sex_nombre;
                array_push($array,'Tipo de sexo');
                array_push($array_cabeceras_td_col,'sex_nombre');
                array_push($array_cabeceras_th,'Tipo de sexo');
            }

            //filtro de tipo de pago - pagos aun no esta relacionado a ninguna tabla en la base
            if($data["tpg_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.tpg_id=".$data["tpg_id"] :  $condicion.=" and Vacante.tpg_id=".$data["tpg_id"];
                $filtro=Tipopago::find("tpg_id=".$data["tpg_id"]);
                $descripcion.=", filtro de tipo de pago: ".$filtro[0]->tpg_nombre;
                array_push($array,'Tipo de pago');
                array_push($array_cabeceras_td_col,'tpg_nombre');
                array_push($array_cabeceras_th,'Tipo de pago');
            }

            //filtro de estado civil
            if($data["esc_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.esc_id=".$data["esc_id"] :  $condicion.=" and Vacante.esc_id=".$data["esc_id"];
                $filtro=Estadocivil::find("esc_id=".$data["esc_id"]);
                $descripcion.=", filtro de estado civil: ".$filtro[0]->esc_nombre;
                array_push($array,'Estado civil');
                array_push($array_cabeceras_td_col,'esc_nombre');
                array_push($array_cabeceras_th,'Estado civil');
            }



            //fecha alta vacante
            $fecha_alta_vac=0;
            if($data["vac_registro_fechainicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_fecharegistro >='".$data["vac_registro_fechainicial"]."'" : $condicion.=" and Vacante.vac_fecharegistro>='".$data["vac_registro_fechainicial"]."'";
                $descripcion.=", filtro de fecha inicial de alta Vacante: ".$data["vac_registro_fechainicial"];
            }
            if($data["vac_registro_fechafinal"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_fecharegistro <='".$data["vac_registro_fechafinal"]." 23:59:59'" :$condicion.=" and Vacante.vac_fecharegistro<='".$data["vac_registro_fechafinal"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de alta  Vacante: ".$data["vac_fechavacfin_f_final"];
            }
            if($fecha_alta_vac==1){
                array_push($array,'Fecha alta de vacante');
             //array_push($array_cabeceras_td_col,'vac_fechafin');
             //array_push($array_cabeceras_th,'F. fin de vacante');
            }

            //filtro fecha fin
            $fechafin=0;
            if($data["vac_fechavacfin_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_fechafin >='".$data["vac_fechavacfin_f_inicial"]."'" : $condicion.=" and Vacante.vac_fechafin>='".$data["vac_fechavacfin_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de Vacante: ".$data["vac_fechavacfin_f_inicial"];
                $fechafin=1;
            }
            if($data["vac_fechavacfin_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.vac_fechafin <='".$data["vac_fechavacfin_f_final"]." 23:59:59'" :$condicion.=" and Vacante.vac_fechafin<='".$data["vac_fechavacfin_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de Vacante: ".$data["vac_fechavacfin_f_final"];
                $fechafin=1;
            }
            if($fechafin==1){
                array_push($array,'Fecha fin de vacante');
                array_push($array_cabeceras_td_col,'vac_fechafin');
                array_push($array_cabeceras_th,'F. fin de vacante');
            }
            //filtro de tipo empleo
            if($data["tie_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Vacante.tie_id=".$data["tie_id"] :  $condicion.=" and Vacante.tie_id=".$data["tie_id"];
                $filtro=Tipoempleo::find("tie_id=".$data["gra_id"]);
                $descripcion.=", filtro de tipo empleo: ".$filtro[0]->tie_nombre;
                array_push($array,'Tipo empleo');
                array_push($array_cabeceras_td_col,'tie_nombre');
                array_push($array_cabeceras_th,'Tipo empleo');
            }

             //filtro de tipo vacante
            if($data["tip_id"]!=-1){
                    $condicion = ($condicion == '') ? $condicion.=" Vacante.tip_id=".$data["tip_id"] :  $condicion.=" and Vacante.tip_id=".$data["tip_id"];
                    $filtro=Tipovacante::find("tip_id=".$data["tip_id"]);
                    $descripcion.=", filtro de tipo vacante: ".$filtro[0]->tip_nombre;
                    array_push($array,'Tipo vacante');


            }
            // cav_nombre
            if($this->cadenaValida($data["cav_nombre"])==1){
                $condicion = ($condicion == '') ? $condicion .= " cav.cav_nombre LIKE '%" . $data["cav_nombre"] . "%'" :  $condicion .= " AND cav.cav_nombre LIKE '%" . $data["cav_nombre"] . "%'";
                $descripcion.=", filtro de puesto vacante : ".$data["cav_nombre"];
                array_push($array,'Puesto vacante');


            }
            // error_log($data["cav_nombre"]);
            // cav_nombre

            try {
                $regs = Vacante::query()
                ->columns("
                    Vacante.vac_id,
                    Vacante.emp_id,
                    Vacante.vac_estatus,
                    emp.emp_nombre,
                    emp.emp_id,
                    emp.emp_alias,
                    Vacante.vac_fechafin,
                    Vacante.vac_actualizacion,
                    Vacante.vac_fechareactivoproceso,
                    Vacante.vac_fechacancelacion,
                    date_format(Vacante.vac_fecharegistro, '%d/%m/%Y') as vac_fecharegistro,
                    Vacante.cen_id,
                    Vacante.vac_numero,
                    Vacante.vac_estatusanterior,
                    Vacante.vac_privacidad,
                    Vacante.vac_edadmin,
                    Vacante.vac_edadmax,
                    Vacante.vac_sueldomax,
                    Vacante.vac_sueldomin,
                    Vacante.vac_idioma,
                    Vacante.vac_nivelidioma,
                    Vacante.vac_numeroanterior,
                    Vacante.vac_horario,
                    Vacante.vac_horario,
                    cen.cen_nombre,
                    Vacante.cne_id,
                    tpg.tpg_nombre,
                    esc.esc_nombre,
                    pre.pre_nombre,
                    sex.sex_nombre,
                    gra.gra_nombre,
                    tie.tie_nombre,
                    Vacante.est_id,
                    est.est_nombre,
                    Vacante.mun_id,
                    mun.mun_nombre,
                    tip.tip_nombre,
                    CONCAT(eje.usu_nombre,' ', eje.usu_primerapellido,' ',eje.usu_segundoapellido) as eje_nombre,
                    CONCAT(usu_modifico.usu_nombre,' ', usu_modifico.usu_primerapellido,' ',usu_modifico.usu_segundoapellido) as usu_modifico_nombre,
                    CONCAT(usu_alta.usu_nombre,' ', usu_alta.usu_primerapellido,' ',usu_alta.usu_segundoapellido) as usu_alta_nombre,
                    CONCAT(usu_cancelo.usu_nombre,' ', usu_cancelo.usu_primerapellido,' ',usu_cancelo.usu_segundoapellido) as usu_cancelo_nombre,
                    CONCAT(usu_reactivo.usu_nombre,' ', usu_reactivo.usu_primerapellido,' ',usu_reactivo.usu_segundoapellido) as usu_reactivo_nombre,
                    cne.cne_puesto,
                    cne.cne_celular,
                    cne.cne_tel,
                    cne.cne_correo,
                    cav.cav_nombre,
                    CONCAT(cne.cne_nombre, ' ', cne.cne_primerapellido) AS cne_nombre_completo
                ")
                ->leftjoin('Empresa', 'emp.emp_id = Vacante.emp_id', 'emp')
                ->leftjoin('Estado', 'est.est_id = Vacante.est_id', 'est')
                ->leftjoin('Municipio', 'mun.mun_id = Vacante.mun_id', 'mun')
                ->leftjoin('Generacion', 'gen.gen_id = Vacante.gen_id', 'gen')
                ->leftjoin('Estadocivil', 'esc.esc_id = Vacante.esc_id', 'esc')
                ->leftjoin('Gradoescolar', 'gra.gra_id = Vacante.gra_id', 'gra')
                ->leftjoin('Usuario', 'eje.usu_id = Vacante.eje_id', 'eje')
                ->leftjoin('Sexo', 'sex.sex_id = Vacante.sex_id', 'sex')
                ->leftjoin('Centrocosto', 'cen.cen_id = Vacante.cen_id', 'cen')
                ->leftjoin('Contactoemp', 'cne.cne_id = Vacante.cne_id', 'cne')
                ->leftjoin('Tipoempleo', 'tie.tie_id = Vacante.tie_id', 'tie')
                ->leftjoin('Tipovacante', 'tip.tip_id = Vacante.tip_id', 'tip')
                ->leftjoin('Tipopago', 'tpg.tpg_id = Vacante.tpg_id', 'tpg')
                ->leftjoin('Prestacion', 'pre.pre_id = Vacante.pre_id', 'pre')
                ->leftjoin('Catvacante', 'cav.cav_id = Vacante.cav_id', 'cav')
                ->leftjoin('Usuario', 'usu_modifico.usu_id = Vacante.usu_ultimomodifico', 'usu_modifico')
                ->leftjoin('Usuario', 'usu_alta.usu_id = Vacante.usu_idalta', 'usu_alta')
                ->leftjoin('Usuario', 'usu_cancelo.usu_id = Vacante.usu_idcancelo', 'usu_cancelo')
                ->leftjoin('Usuario', 'usu_reactivo.usu_id = Vacante.usu_idreactivoproceso', 'usu_reactivo')
                ->leftjoin('Expedientecan','Vacante.vac_id=Expedientecan.vac_id')

                ->where($condicion)
                ->groupBy('Vacante.vac_id') // Aplicar GROUP BY por vac_id

                ->execute();
                $data_bit=[
                    'bit_descripcion'=>$descripcion,
                    'bit_tablaid'=>0,
                    'bit_modulo'=>"Consulta vacante",
                    'vac_id'=>0,
                    'bit_accion'=>4,
                ];
                $this->bitacora_registro($data_bit,$auth);
                $this->expediantecan_obj = new Expedientecan();
                $this->usuario = new Usuario();
                $this->view->expediantecan = $this->expediantecan_obj;
                $this->view->vacante_obj = new Vacante();
                $this->view->usuario = $this->usuario;
                $this->view->page=$regs;
                $this->view->mensaje_back="";

            }catch (\Phalcon\Mvc\Model\Exception $e) {
                $mensaje_error="Error SQL: " . $e->getMessage();
                error_log($mensaje_error);
                error_log("ERROR EN LA CONDICION ".$condicion);
                $this->view->page=[];
                $answer['detalle'] =$e->getMessage();
                $data_bit = [
                    'bit_descripcion'=>'ERROR CONSULTA VACANTE : '.$answer["detalle"],
                    'bit_tablaid' => 0,
                    'bit_modulo' => "ERROR ",
                    'vac_id' => 0,
                    'bit_accion' => 4,
                ];
                $this->bitacora_registro_ERROR($data_bit,$e);
                $this->view->mensaje_back=$mensaje_error;
            }
        }
        $titulo='Consulta';
        $this->view->titulo=$titulo;
    }

    public function validaqrAction($id)
    {

    }

    public function get_ajax_detalles_ese_unoAction($ese_id)
    {

    }
}