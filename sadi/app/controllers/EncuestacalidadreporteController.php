<?php

use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Phalcon\Mvc\Model\Query;
use Phalcon\Di;
use Phalcon\Db\Adapter\Pdo;
use Intervention\Image\ImageManager;

class EncuestacalidadreporteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Encuestas');
        parent::initialize();
    }
    // reporte de encuesta 2024
    public function reporte_vdosAction()
    {
    }
    public function respuestas_vdos_tablaAction()
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $mensaje_aviso_error = "";
        $inv_id = 0;
        $mensaje_extra_bitcora = '';
        $descripcion_bitacora = "";
        

        try {
            $usuario_obj = new Usuario();

            if (!$this->request->isPost())
                throw new \Exception('ERROR REQUEST.');

            $condicion = "erl.erl_fechacontesto IS NOT NULL AND  erl.erl_estatus=2 and enc.enc_estatus=3 ";
            $data = $this->request->getPost();

            $enc_version='2024_enero';
            $nombre_clase_encuesta_version = 'Encuesta_calidad_' . $enc_version;
            eval("\$obj_enc = new $nombre_clase_encuesta_version();");
            $enc_formato='';


            if (isset($obj_enc->condiciones_personalizadas) && $obj_enc->condiciones_personalizadas) {
                if (method_exists($obj_enc, 'setSelectCondicionesPersonalizadasAvanzadas')) {
                    $respuesta_modelos_select_condicion_personalizad = $obj_enc->setSelectCondicionesPersonalizadasAvanzadas($data, "", $condicion, "", $mensaje_extra_bitcora);
                    if (is_array($respuesta_modelos_select_condicion_personalizad)) {

                        $enc_formato=$data["enc_formato"];

                        if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"])) 
                            $condicion = $respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"];
                             
                    } 
                }  
            } 

            //filtros de empresa incio
            if ($this->numerovalidoInputValido($data["emp_id"]) == 1) {
                $condicion = ($condicion == '') ? $condicion .= '  ese.emp_id = ' . $data["emp_id"]  : $condicion .= ' and  ese.emp_id = ' . $data["emp_id"];
                $filtro = Empresa::find("emp_id=" . $data["emp_id"]);
                $descripcion_bitacora .= ', filtro de tipo de estudio de : ' . $filtro[0]->emp_nombre;
            }
            //filtros de empresa fin
                //fechas de entrega cliente inicio 
                if($this->fechaInputValida($data["enc_fecha_inical"])){
                    $condicion = ($condicion == '') ? $condicion.=" enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'" : $condicion.=" and enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'";
                    $mensaje_extra_bitcora.=", filtro de fecha inicial de entrega cliente: ".$data["enc_fecha_inical"];
                }
                if($this->fechaInputValida($data["enc_fecha_fin"])){
                    $condicion = ($condicion == '') ? $condicion.=" enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'" :$condicion.=" and enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'";
                    $mensaje_extra_bitcora.=", filtro de fecha final de entrega cliente de ESE: ".$data["enc_fecha_fin"];
                }

                //fechas de entrega cliente fin 


            //filtros de id usuario ini

            if ($this->numerovalidoInputValido($data["inv_id"])) {
                $condicion .= ($condicion == '') ? " ese.inv_id={$data["inv_id"]}" : " and ese.inv_id={$data["inv_id"]}";
                $descripcion_bitacora .= ', con filtro del investigador ' . $usuario_obj->getNombre($data["inv_id"]) . " FOLIO " . $data["inv_id"];
            }
            if ($this->numerovalidoInputValido($data["ana_id"])) {
                $condicion .= ($condicion == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                $descripcion_bitacora .= ', con filtro del analista ' . $usuario_obj->getNombre($data["ana_id"]) . " FOLIO " . $data["ana_id"];
            }
            //filtros de id usuario fin


            $respuestas=$obj_enc->obtenerRespuestas($condicion);

            $auth = $this->session->get('auth');
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = "";
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "Respuesta encuesta calidad V2";
            $bitacora->NuevoRegistro($databit);
            $this->view->page = $respuestas;
            $this->view->enc_contador_total = count($respuestas);
            $this->view->obj_enc = $obj_enc;
            $this->view->enc_version = $enc_version;
            $this->view->enc_formato = $enc_formato;

        } catch (\Exception $e) {
            error_log("ERORR respuestas_vdos_tablaAction " . $e->getMessage());
            $this->view->page = [];
            $this->view->enc_contador_total = 0;
            $mensaje_aviso_error = "ERROR";
            $this->view->enc_version = "";

        }
    }
    public function encuestas_vdos_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $mensaje_aviso_error = "";
        $inv_id = 0;
        $mensaje_extra_bitcora = '';
        try {
            if (!$this->request->isPost())
                throw new \Exception('ERROR REQUEST.');


            $condicion_sql = '';
            $mensaje_extra_bitcora = '';
            $data = $this->request->getPost();
            $inv_id = 0;
            $usuario_obj = new Usuario();
            $enc_version = isset($data["enc_version"]) ? $data["enc_version"] : "2024_enero";
            $condicion_sql .= ($condicion_sql === '') ? " enc.enc_version='$enc_version'" : " AND enc.enc_version='$enc_version'";
            $nombre_clase_encuesta_version = 'Encuesta_calidad_' . $enc_version;

            eval("\$obj_enc = new $nombre_clase_encuesta_version();");
            $enc_formato='';

            if (isset($obj_enc->condiciones_personalizadas) && $obj_enc->condiciones_personalizadas) {
                if (method_exists($obj_enc, 'setSelectCondicionesPersonalizadasAvanzadas')) {
                    $respuesta_modelos_select_condicion_personalizad = $obj_enc->setSelectCondicionesPersonalizadasAvanzadas($data, "", $condicion_sql, "", $mensaje_extra_bitcora);
                    if (is_array($respuesta_modelos_select_condicion_personalizad)) {

                        $enc_formato=$data["enc_formato"];
                        if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"])) 
                            $condicion_sql = $respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"];
                             
                    } 
                }  
            } 

         
            // error_log($condicion_sql);

            // usuarios inicio
            if ($this->numerovalidoInputValido($data["inv_id"])) {
                $condicion_sql .= ($condicion_sql == '') ? " ese.inv_id={$data["inv_id"]}" : " and ese.inv_id={$data["inv_id"]}";
                $mensaje_extra_bitcora .= ', con filtro del investigador ' . $usuario_obj->getNombre($data["inv_id"]) . " FOLIO " . $data["inv_id"];
            }
            if ($this->numerovalidoInputValido($data["ana_id"])) {
                $condicion_sql .= ($condicion_sql == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                $mensaje_extra_bitcora .= ', con filtro del investigador ' . $usuario_obj->getNombre($data["ana_id"]) . " FOLIO " . $data["ana_id"];
            }
            // usuarios fin


            //filtros de empresa incio
              if ($this->numerovalidoInputValido($data["emp_id"]) == 1) {
                $condicion_sql = ($condicion_sql == '') ? $condicion_sql .= '  ese.emp_id = ' . $data["emp_id"]  : $condicion_sql .= ' and  ese.emp_id = ' . $data["emp_id"];
                $filtro = Empresa::find("emp_id=" . $data["emp_id"]);
                $mensaje_extra_bitcora .= ', filtro de tipo de estudio de : ' . $filtro[0]->emp_nombre;
            }
            //filtros de empresa fin

            //fechas de entrega cliente inicio 
               if($this->fechaInputValida($data["enc_fecha_inical"])){
                $condicion_sql = ($condicion_sql == '') ? $condicion_sql.=" enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'" : $condicion_sql.=" and enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'";
                $mensaje_extra_bitcora.=", filtro de fecha inicial de entrega cliente: ".$data["enc_fecha_inical"];
            }
            if($this->fechaInputValida($data["enc_fecha_fin"])){
                $condicion_sql = ($condicion_sql == '') ? $condicion_sql.=" enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'" :$condicion_sql.=" and enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'";
                $mensaje_extra_bitcora.=", filtro de fecha final de entrega cliente de ESE: ".$data["enc_fecha_fin"];
            }
       
            //fechas de entrega cliente fin 

          

            $enc_estatus = $data['enc_estatus'];
            $enc_columnas_extra = 0;
            if ($enc_estatus >= 1) {
                $condicion_sql .= (empty(trim($condicion_sql)) ? '' : ' AND ') . 'enc.enc_estatus=' . $enc_estatus;
                $enc_columnas_extra = 1;
            } else {
                $condicion_sql .= (empty(trim($condicion_sql)) ? '' : ' AND ') . 'enc.enc_estatus>0';
                $enc_columnas_extra = 1;
            }
            


            $encuestasBuilder = new Builder();
            $encuestasBuilder = $encuestasBuilder->columns(
                array(
                    'enc.enc_estatus,
                    enc.enc_id,
                    enc.enc_registro,
                    enc.enc_fecharealizo,
                    enc.enc_fechaentregacliente,
                    enc.enc_comentario,
                    enc.ese_id,
                    CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
                    CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
                    ese.inv_id,
                    CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) as inv_nombre'
                ))
                ->addFrom('Encuesta', 'enc')
                ->leftJoin('Estudio', 'ese.ese_id=enc.ese_id', 'ese')
                ->leftJoin('Usuario', 'usu.usu_id=enc.usu_id', 'usu')
                ->leftJoin('Usuario', 'inv.usu_id=ese.inv_id', 'inv')
                ->leftJoin('Tipoestudio', 'tip.tip_id=ese.tip_id', 'tip')
                ->leftJoin('Municipio', 'mun.mun_id=ese.mun_id', 'mun')
                ->leftJoin('Estado', 'est.est_id=ese.est_id', 'est')
                ->leftJoin('Empresa', 'emp.emp_id=ese.emp_id', 'emp')
                ->leftJoin('Centrocosto', 'cen.cen_id=ese.cen_id', 'cen')
                ->leftJoin('Usuario', 'ana.usu_id=ese.ana_id', 'ana')
                ->where($condicion_sql);
                    
            $enc = $encuestasBuilder->getQuery()->execute();
            
        

            $obj_enc = new Encuesta();
            $auth = $this->session->get('auth');
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = 'Consultó datos de encuestas de calidad  de la fecha ' . "" . ' con estatus: ' . $obj_enc->getEstatus($enc_estatus, 1) . $mensaje_extra_bitcora;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "Encuesta calidad";
            $bitacora->NuevoRegistro($databit);


            $this->view->page = $enc;
            $this->view->enc_version = $enc_version;
            $this->view->enc_fecha = "";
            $this->view->enc_estatus = $enc_estatus;
            $this->view->enc_columnas_extra = $enc_columnas_extra;
            $this->view->enc_helper_estatus = $obj_enc->getEstatusConBadge($enc_estatus);
            $this->view->enc_contador_total = count($enc);
            $this->view->obj_enc = $obj_enc;
        } catch (\Exception $e) {
            error_log("ERORR respuestas_tablaAction " . $e->getMessage());
            $this->view->page = [];
            $this->view->enc_contador_total = 0;
            $this->view->enc_helper_estatus = "";
            $this->view->enc_version = "";


        }
    }

    public function ajax_get_data_respuestas_porcentaje_estadisiticasAction() {
        $this->view->disable();
        $answer = [];
        $answer['estado'] =-2;
        $answer['mensaje'] ="error";


        try {
                if (!$this->request->isAjax()) {
                    throw new \Exception('ERROR REQUEST.');
                }
                $data = $this->request->getPost();
                $condicion_respuestas_preguntas="erl.erl_fechacontesto IS NOT NULL AND erl.erl_estatus = 2 and enc.enc_estatus=3 ";
                $condicion_respuestas_preguntas_encuesta="erl.erl_fechacontesto IS NOT NULL AND enc.enc_estatus=3  and erl.erl_estatus= 2 ";
                $condicion_ese="ese.ese_estatus='7' AND ese.tip_id NOT IN (4, 2) ";


                //filtros inicio --------------------------------------------------------filtros inicio
                //fechas de 
                $enc_fecha_inicial="";
                if ($this->fechaInputValida($data["enc_fecha_inical"])) {
                    $enc_fecha_inicial = $data["enc_fecha_inical"];
                    $condicion_respuestas_preguntas .= ($condicion_respuestas_preguntas == '') ? " enc.enc_fechaentregacliente >= '{$data["enc_fecha_inical"]}'" : " and enc.enc_fechaentregacliente >= '{$data["enc_fecha_inical"]}' ";
                    $condicion_respuestas_preguntas_encuesta .= ($condicion_respuestas_preguntas_encuesta == '') ? " enc.enc_fechaentregacliente >= '{$data["enc_fecha_inical"]}'" : " and enc.enc_fechaentregacliente >= '{$data["enc_fecha_inical"]}'";
                    $condicion_ese .= ($condicion_ese == '') ? " ese.ese_fechaentregacliente >= '{$data["enc_fecha_inical"]}'" : " AND ese.ese_fechaentregacliente >= '{$data["enc_fecha_inical"]}'";

                }
                
                $enc_fecha_fin = "";
                if ($this->fechaInputValida($data["enc_fecha_fin"])) {
                    $enc_fecha_fin = $data["enc_fecha_fin"];
                    $condicion_ese .= ($condicion_ese == '') ? " ese.ese_fechaentregacliente <= '{$data["enc_fecha_fin"]} 23:59:59'" : " and ese.ese_fechaentregacliente <= '{$data["enc_fecha_fin"]} 23:59:59'";
                    $condicion_respuestas_preguntas .= ($condicion_respuestas_preguntas == '') ? " enc.enc_fechaentregacliente <= '{$data["enc_fecha_fin"]} 23:59:59'" : " and enc.enc_fechaentregacliente <= '{$data["enc_fecha_fin"]} 23:59:59'";
                    $condicion_respuestas_preguntas_encuesta .= ($condicion_respuestas_preguntas_encuesta == '') ? " enc.enc_fechaentregacliente <= '{$data["enc_fecha_fin"]} 23:59:59'" : " and enc.enc_fechaentregacliente <= '{$data["enc_fecha_fin"]} 23:59:59'";
                }
                
                //fechas de 
                // empresa inicio 
                $emp_id=0;
                if($this->numerovalidoInputValido($data["emp_id"])){
                    $emp_id=$data["emp_id"];
                    $condicion_respuestas_preguntas .= ($condicion_respuestas_preguntas == '') ? " ese.emp_id={$data["emp_id"]}" : " and ese.emp_id={$data["emp_id"]}";
                    $condicion_respuestas_preguntas_encuesta .= ($condicion_respuestas_preguntas_encuesta == '') ? " ese.emp_id={$data["emp_id"]}" : " and ese.emp_id={$data["emp_id"]}";
                    $condicion_ese .= ($condicion_ese == '') ? " ese.emp_id={$data["emp_id"]}" : " and ese.emp_id={$data["emp_id"]}";


                }
                // empresa fin
                // analista inicio 
                $ana_id=0;
                if($this->numerovalidoInputValido($data["ana_id"])){
                    $ana_id=$data["ana_id"];
                    $condicion_respuestas_preguntas .= ($condicion_respuestas_preguntas == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                    $condicion_respuestas_preguntas_encuesta .= ($condicion_respuestas_preguntas_encuesta == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                    $condicion_ese .= ($condicion_ese == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";

                }
                // analista fin    
                // investigador inicio 
                $ana_id=0;
                if($this->numerovalidoInputValido($data["inv_id"])){
                    $ana_id=$data["inv_id"];
                    $condicion_respuestas_preguntas .= ($condicion_respuestas_preguntas == '') ? " ese.inv_id= {$data["inv_id"]}" : " and ese.inv_id= {$data["inv_id"]}";
                    $condicion_respuestas_preguntas_encuesta .= ($condicion_respuestas_preguntas_encuesta == '') ? " ese.inv_id= {$data["inv_id"]}" : " and ese.inv_id= {$data["inv_id"]}";
                    $condicion_ese .= ($condicion_ese == '') ? " ese.inv_id= {$data["inv_id"]}" : " and ese.inv_id= {$data["inv_id"]}";

                }
                // investigador fin


                
                //filtros fin -------------------------------------------------------filtro fin 
               

                $enc_version = isset($data["enc_version"]) ? $data["enc_version"] : "2024_enero";
                $nombre_clase_encuesta_version = 'Encuesta_calidad_' . $enc_version;
                eval("\$obj_enc = new $nombre_clase_encuesta_version();");

                 // FILTROS PERSONALIZADOS INICIO
                 $enc_formato = isset($data["enc_formato"]) ? $data["enc_formato"] : "";
                        if (isset($obj_enc->condiciones_personalizadas) && $obj_enc->condiciones_personalizadas) {
                            if (method_exists($obj_enc, 'setSelectCondicionesPersonalizadasAvanzadas')) {
                                $respuesta_modelos_select_condicion_personalizad = $obj_enc->setSelectCondicionesPersonalizadasAvanzadas($data,$condicion_respuestas_preguntas, $condicion_respuestas_preguntas_encuesta,$condicion_ese, "");
                                if (is_array($respuesta_modelos_select_condicion_personalizad)) {
            
                                    // $enc_formato=$data["enc_formato"];
                                    if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"])){
                                        $condicion_respuestas_preguntas_encuesta = $respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"];

                                    }
                                    
                                    if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql"])){
                                        $condicion_respuestas_preguntas = $respuesta_modelos_select_condicion_personalizad["condicion_sql"];
                                        // error_log($respuesta_modelos_select_condicion_personalizad["condicion_sql"]);

                                    }

                                    if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql_ese"])) 
                                        $condicion_ese = $respuesta_modelos_select_condicion_personalizad["condicion_sql_ese"];
                                         
                                } 
                            }  
                        } 
                // FILTROS PERSONALIZADOS FIN


                $enc_calidad_main=new Encuestacalidad();
                $answer['todas-preguntas-estadisticas']=$obj_enc->getEstadisticasTodasLasRespuestas($condicion_respuestas_preguntas,$enc_formato);
                $answer['detalles-encuesta']['total_encuestas_contestadas']=count($obj_enc->obtenerRespuestas($condicion_respuestas_preguntas_encuesta));
                $answer['detalles-encuesta']['estatus_data'] = ($answer['detalles-encuesta']['total_encuestas_contestadas'] <= 0) ? "-2": "2";
                $answer['detalles-encuesta']['fecha_formato_texto']=$obj_enc->obtenerFechaTextoFormatoLeible($enc_fecha_inicial,$enc_fecha_fin);
                $answer['detalles-encuesta']['total_eses']=$enc_calidad_main->getDestallesByRangoFechaIniFinParESE($condicion_ese);

                $answer['todas-preguntas-texto']=$obj_enc->getPreguntasFormatoPDFGraficas();
                $answer['estado'] =2;
                $answer['mensaje'] ="OK";
               
        } catch (Exception $e) {
            $answer['mensaje'] = $e->getMessage();
            $answer['estatus'] = -2;

            error_log("ajax_get_data_respuestas_porcentaje_estadisiticasAction error ".$e->getMessage());
        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }
     /** 
     * Genera un reporte PDF de respuestas de encuesta de calidad por un rango de fecha.
     *
     * Esta función procesa los datos de una encuesta de calidad para generar un reporte en formato PDF,
     * mostrando estadísticas y gráficas de las respuestas obtenidas. Además, registra una entrada en la bitácora
     * con información sobre la generación del reporte.
     *
     * @return  PDF Devuelve un PDF generado con las estadísticas y gráficas de las respuestas de la encuesta.
     * @author  SIPSRH 
     * @throws Exception Si hay errores durante el proceso de generación del reporte.
     * 
     * @param string $dataRequest Los datos de la solicitud POST, que deben estar serializados. Se esperan los siguientes datos:
     *    - tipo_reporte: El tipo de formato del reporte (0, 1 o 2). [OBLIGATORIO]
     *    - enc_fecha_inical: La fecha de inicio para filtrar las respuestas de la encuesta.[OBLIGATORIO]
     *    - enc_fecha_fin: La fecha de fin para filtrar las respuestas de la encuesta.
     *    - inv_id: El identificador del investigador.
     *    - ana_id: El identificador del analista.
     *    - emp_id: El identificador de la empresa.
     */
    public function  respuesta_estadisticas_servicio_calidad_pdfAction(){
        try {
            $dataRequest = $this->request->getPost("data");#la data viene serializada con jquery por esa razon se hace parse_str
            $data = [];
            ini_set('memory_limit', '256M');

            parse_str($dataRequest, $data);
            //ini variables 
            $mensaje_extra_bitcora='Consultó datos del reporte de repuesta ';
            $this->view->disable();
            $rol = new Rol();
            date_default_timezone_set('america/mexico_city');
            $condicion_sql="erl.erl_fechacontesto IS NOT NULL AND erl.erl_estatus = 2 and enc.enc_estatus=3";
            $condicion_sql_enc="enc.enc_estatus='3' ";
            $condicion_sql_ese="ese.ese_estatus='7' AND ese.tip_id NOT IN (4, 2)  ";
            $auth = $this->session->get('auth');
            $tipo_grafica=$data["tipo_reporte"];
            //fom variables 
             //VALIDAMOS PERMISOS
            if(!$rol->verificar(74,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            } 
            //VALIDAMOS PERMISOS FIN 
            ///validamos  parametros 
            if(!is_numeric($tipo_grafica) || $tipo_grafica>2 || $tipo_grafica<0){
                $this->flash->error("¿Tipo de formato?.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            ///validamos  parametros 

            //---------------------------[FILTROS INICIO ]-----------------------------------------------------------------------------------------------[FILTROS INICIO ]------------------------[FILTROS INICIO ]
            $usuario_obj = new Usuario();
            $fecha_inicio="";
            if($this->fechaInputValida($data["enc_fecha_inical"])){
                $condicion_sql = ($condicion_sql == '') ? $condicion_sql.=" enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'" : $condicion_sql.=" and enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'";
                $condicion_sql_enc = ($condicion_sql_enc == '') ? $condicion_sql_enc.=" enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'" : $condicion_sql_enc.=" and enc.enc_fechaentregacliente>='".$data["enc_fecha_inical"]."'";
                $condicion_sql_ese = ($condicion_sql_ese == '') ? $condicion_sql_ese.=" ese.ese_fechaentregacliente>='".$data["enc_fecha_inical"]."'" : $condicion_sql_ese.=" and ese.ese_fechaentregacliente>='".$data["enc_fecha_inical"]."'";
                $fecha_inicio=$data["enc_fecha_inical"];
                $mensaje_extra_bitcora.=", filtro de fecha inicial de entrega cliente: ".$data["enc_fecha_inical"];
            }else{
                $this->flash->error("Fecha inicial requerida");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return; 
            }
            $fecha_fin="";
            if($this->fechaInputValida($data["enc_fecha_fin"])){
                $fecha_fin=$data["enc_fecha_fin"];
                $condicion_sql = ($condicion_sql == '') ? $condicion_sql.=" enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'" :$condicion_sql.=" and enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'";
                $condicion_sql_enc = ($condicion_sql_enc == '') ? $condicion_sql_enc.=" enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'" :$condicion_sql_enc.=" and enc.enc_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'";
                $condicion_sql_ese = ($condicion_sql_ese == '') ? $condicion_sql_ese.=" ese.ese_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'" :$condicion_sql_ese.=" and ese.ese_fechaentregacliente<='".$data["enc_fecha_fin"]." 23:59:59'";
                $mensaje_extra_bitcora.=", filtro de fecha final de entrega cliente de ESE: ".$data["enc_fecha_fin"];
            }
            $fecha_titulo = $fecha_inicio . '_' . $fecha_fin;
            
            //usuarios inicio 
            $inv_id="";
            if ($this->numerovalidoInputValido($data["inv_id"])) {
                $inv_id=$data["inv_id"];
                $condicion_sql .= ($condicion_sql == '') ? " ese.inv_id={$data["inv_id"]}" : " and ese.inv_id={$data["inv_id"]}";
                $condicion_sql_enc .= ($condicion_sql_enc == '') ? " ese.inv_id={$data["inv_id"]}" : " and ese.inv_id={$data["inv_id"]}";
                $condicion_sql_ese .= ($condicion_sql_ese == '') ? " ese.inv_id={$data["inv_id"]}" : " and ese.inv_id={$data["inv_id"]}";
                $mensaje_extra_bitcora .= ', con filtro del investigador ' . $usuario_obj->getNombre($data["inv_id"]) . " FOLIO " . $data["inv_id"];
            }
            $ana_id="";
            if ($this->numerovalidoInputValido($data["ana_id"])) {
                $condicion_sql .= ($condicion_sql == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                $condicion_sql_enc .= ($condicion_sql_enc == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                $condicion_sql_ese .= ($condicion_sql_ese == '') ? " ese.ana_id={$data["ana_id"]}" : " and ese.ana_id={$data["ana_id"]}";
                $mensaje_extra_bitcora .= ', con filtro del analista ' . $usuario_obj->getNombre($data["ana_id"]) . " FOLIO " . $data["ana_id"];
                $ana_id=$data["ana_id"];

            }
            // usuarios fin
            //filtros de empresa incio
              if ($this->numerovalidoInputValido($data["emp_id"]) == 1) {
                $condicion_sql = ($condicion_sql == '') ? $condicion_sql .= '  ese.emp_id = ' . $data["emp_id"]  : $condicion_sql .= ' and  ese.emp_id = ' . $data["emp_id"];
                $condicion_sql_enc = ($condicion_sql_enc == '') ? $condicion_sql_enc .= '  ese.emp_id = ' . $data["emp_id"]  : $condicion_sql_enc .= ' and  ese.emp_id = ' . $data["emp_id"];
                $condicion_sql_ese = ($condicion_sql_ese == '') ? $condicion_sql_ese .= '  ese.emp_id = ' . $data["emp_id"]  : $condicion_sql_ese .= ' and  ese.emp_id = ' . $data["emp_id"];
                $filtro = Empresa::find("emp_id=" . $data["emp_id"]);
                $mensaje_extra_bitcora .= ', filtro de tipo de estudio de : ' . $filtro[0]->emp_nombre;
            }
            //filtros de empresa fin
            //---------------------------[FILTROS FIN ]-----------------------------------------------------------------------------------------------[FILTROS FIN ]------------------------[FILTROS FIN ]


            $reporte_completo= new PdfRerporteEncuestaCalidadServicio();
            $enc_calidad= new Encuestacalidad();
             //---------------------------[CONSULTAR DATOS INICIO ]-----------------------------------------------------------------------------------------------[CONSULTAR DATOS INICIO ]------------------------[CONSULTAR DATOS INICIO ]
             $enc_version=(isset($data['enc_version']) && trim($data['enc_version'])!="" ) ? $data['enc_version']: '2024_enero';
             $nombre_clase_encuesta_version = 'Encuesta_calidad_' . $enc_version;
             eval("\$obj_enc = new $nombre_clase_encuesta_version();");#ejecutamos de manera dinamica el abj

            //filtros ini  persoanlziados por modelo-------------------------------------------------------filtro ini 
            $enc_formato="";
            if (isset($obj_enc->condiciones_personalizadas) && $obj_enc->condiciones_personalizadas) {
                if (method_exists($obj_enc, 'setSelectCondicionesPersonalizadasAvanzadas')) {
                    $respuesta_modelos_select_condicion_personalizad = $obj_enc->setSelectCondicionesPersonalizadasAvanzadas($data, $condicion_sql, $condicion_sql_enc, $condicion_sql_ese, $mensaje_extra_bitcora);
                    $enc_formato = isset($data["enc_formato"]) ? $data["enc_formato"] : "";

                    if (is_array($respuesta_modelos_select_condicion_personalizad)) {
                        if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql"])) 
                            $condicion_sql = $respuesta_modelos_select_condicion_personalizad["condicion_sql"];
                        
                        if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"])) 
                            $condicion_sql_enc = $respuesta_modelos_select_condicion_personalizad["condicion_sql_enc"];
                        
                        if (isset($respuesta_modelos_select_condicion_personalizad["condicion_sql_ese"])) 
                            $condicion_sql_ese = $respuesta_modelos_select_condicion_personalizad["condicion_sql_ese"];
                        
            
                        if (isset($respuesta_modelos_select_condicion_personalizad["mensaje_extra_bitcora"])) 
                            $mensaje_extra_bitcora = $respuesta_modelos_select_condicion_personalizad["mensaje_extra_bitcora"];
                        
                    } 
                }  
            } 
            //  error_log($condicion_sql);
            // error_log(print_r($respuesta_modelos_select_condicion_personalizad,true));

            //filtros fin  persoanlziados por modelo-------------------------------------------------------filtro fin 

             $data_encuesta=[];
             $data_encuesta['detalles-encuesta']['respuestas_encuesta_todo']=$obj_enc->obtenerRespuestas($condicion_sql);
             $data_encuesta['detalles-encuesta']['total_encuestas_contestadas']=count($data_encuesta['detalles-encuesta']['respuestas_encuesta_todo']);
             $data_encuesta['detalles-encuesta']['estatus_data'] = ($data_encuesta['detalles-encuesta']['total_encuestas_contestadas'] <= 0) ? "-2": "2";
             if($data_encuesta['detalles-encuesta']['total_encuestas_contestadas']==0){
                $this->flash->error("No hay estudios o encuestas relacionadas de este investigador.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
           # $data_encuesta = $obj_enc->obtenerRespuestas($condicion_sql);
            $estadisticas_detalle=$enc_calidad->getDestallesByRangoFechaIniFin($condicion_sql_enc,$condicion_sql_ese ,$fecha_inicio,$fecha_fin,$inv_id);
            $texto_preguntas_servicio=$obj_enc->getPreguntasFormatoPDFGraficas($data);
            $texto_opciones_respuesta_servicio=$obj_enc->getOpcionesPreguntas();
            $estadisticas_respuestas=$obj_enc->getEstadisticasTodasLasRespuestas($condicion_sql,$enc_formato);
             //---------------------------[CONSULTAR DATOS FIN ]-----------------------------------------------------------------------------------------------[CONSULTAR DATOS FIN ]------------------------[CONSULTAR DATOS FIN ]

            //---------------------------[GENERAR PDF INI ]-----------------------------------------------------------------------------------------------[CONSULTAR DATOS INI ]------------------------[CONSULTAR DATOS INI ]
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",25,25,25,0,8,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación
            $mpdf->SetAuthor('SIPS | SADI'); 
            $mpdf->SetAutoPageBreak(true, 20);
            $var_header=str_replace("#logo_header#",basename('images/sips_documento.png'),$reporte_completo->cabezera_hoja_FORMATONUEVO);

            // titulo inicio 
            $tituloPdf="";
                  if (isset($obj_enc->configuracion_titulo_pdf) && $obj_enc->configuracion_titulo_pdf) {
                      if (method_exists($obj_enc, 'getTituloPdf')) {
                        $tituloPdf = $obj_enc->getTituloPdf($data);
                        
                      }
                  }else {
                      $tituloPdf='Reporte-respuestas-v2-'.$fecha_titulo.'-';
                  }
                  $var_header=str_replace("#titulo_header#",trim($tituloPdf),$var_header);

             // titulo fin

            $mpdf->SetHTMLHeader($var_header,'O');
            $mpdf->SetHTMLFooter($reporte_completo->header_hoja);
            //---------------------------[GRAFICAS  INI ]---------------------------------------------------------
            $obj_molde_pdf_reporte=new Encuesta_calidad_cascaron_pdf();
            $unix_timestamp = time();
            
            //---------------------------[VARIABLES GLOBALES INICIO ]-------
            // echo "probando";
            // die();
            // configuracion dinamica inicio d  graficas
            if (isset($obj_enc->configuracion_personalizada_graficas) && $obj_enc->configuracion_personalizada_graficas) {
                  if (method_exists($obj_enc, 'getConfiguracionPersonalizadaGraficasPDF')) {
                    $respuesta_config_personalizada_graficas = $obj_enc->getConfiguracionPersonalizadaGraficasPDF($data);
                    if (is_array($respuesta_config_personalizada_graficas)) {

                        if (isset($respuesta_config_personalizada_graficas["elementos_por_pagina"])) {
                             $elementos_por_pagina = $respuesta_config_personalizada_graficas["elementos_por_pagina"];
                        }
                        
                        if (isset($respuesta_config_personalizada_graficas["medidas_graficas_barras_texto"])){
                             $medidas_graficas_barras_texto = $respuesta_config_personalizada_graficas["medidas_graficas_barras_texto"];
                        }
                        
                        if (isset($respuesta_config_personalizada_graficas["medidas_graficas_circular_texto"])){
                         $medidas_graficas_circular_texto = $respuesta_config_personalizada_graficas["medidas_graficas_circular_texto"];
                        }
                          
                    } 
                //    echo print_r($respuesta_config_personalizada_graficas,true);
                //     die();
                //     error_log(print_r($respuesta_config_personalizada_graficas,true));
                }  
            }else {
                $elementos_por_pagina =$obj_enc->elementos_por_pagina;
                $medidas_graficas_barras_texto =$obj_enc->medidas_graficas_barras_texto;
                $medidas_graficas_circular_texto =$obj_enc->medidas_graficas_circular_texto;
             }
            // configuracion dinamica fin d  graficas



            $indices = array();
            for ($i = 1; $i <= count($elementos_por_pagina); $i++) {
                $indices[] = array($i * 2 - 1, $i * 2);
            }

      

            // echo "<pres>";
            // var_dump($estadisticas_detalle);
            // echo "</pre>";
            // die();
            //---------------------------[VARIABLES GLOBALES FIN ]-------

            //---------------------------[GRAFICAS CIRCULARES INICIO ]---------------------------------------------------------------
            if($tipo_grafica==0){
                foreach ($elementos_por_pagina as $key => $elementos) {
                    if ($key == 0) {
                        $pagina_html = $obj_molde_pdf_reporte->formatoPDFHoja1_GraficasCirculares(
                            $estadisticas_detalle,
                            $texto_preguntas_servicio["data"],
                            $texto_opciones_respuesta_servicio,
                            $estadisticas_respuestas,
                            $unix_timestamp,
                            $reporte_completo->hoja_1_FORMATONUEVO,
                            $inv_id,
                            $elementos
                        );
                    } else {
                        // echo print_r( $medidas_graficas_circular_texto);
                        // die();
                        $pagina_html = $obj_molde_pdf_reporte->formatoPDFHojaDinamica_GraficasCircular(
                            $texto_preguntas_servicio["data"],
                            $texto_opciones_respuesta_servicio,
                            $estadisticas_respuestas,
                            $unix_timestamp,
                            $reporte_completo->hoja_2,
                            $elementos,
                            $indices[$key],
                            $medidas_graficas_circular_texto[$key]
                        );
                    }
                    $mpdf->WriteHTML($pagina_html);
                    $mpdf->AddPage();
                    // Solo limpiamos las imágenes generadas para las páginas siguientes a la primera
                    if ($key > 0) {
                        $obj_molde_pdf_reporte->ImagenesGeneradasReporteRespuestasv2($unix_timestamp);
                    }
                }

             }
            //---------------------------[GRAFICAS CIRCULARES FIN ]---------------------------------------------------------------
            //---------------------------[GRAFICAS DE BARRAS INICIO ]---------------------------------------------------------------
             elseif($tipo_grafica==1){
                // echo "<pre>";
                // var_dump($estadisticas_detalle);
                // echo "</pre>";
                // die();
                foreach ($elementos_por_pagina as $key => $elementos) {
                    if ($key == 0) {
                        $pagina_html = $obj_molde_pdf_reporte->formatoPDFHoja1_GraficasBarras(
                            $estadisticas_detalle,
                            $texto_preguntas_servicio["data"],
                            $texto_opciones_respuesta_servicio,
                            $estadisticas_respuestas,
                            $unix_timestamp,
                            $reporte_completo->hoja_1_FORMATONUEVO,
                            $inv_id,
                            $elementos
                        );
                    } else {
                        $pagina_html = $obj_molde_pdf_reporte->formatoPDFHojaDinamica_GraficasBarras(
                            $texto_preguntas_servicio["data"],
                            $texto_opciones_respuesta_servicio,
                            $estadisticas_respuestas,
                            $unix_timestamp,
                            $reporte_completo->hoja_2,
                            $elementos,
                            $indices[$key],
                            $medidas_graficas_barras_texto[$key]
                        );
                    }
                    $mpdf->WriteHTML($pagina_html);
                    $mpdf->AddPage();
                    // Solo limpiamos las imágenes generadas para las páginas siguientes a la primera
                    if ($key > 0) {
                        $obj_molde_pdf_reporte->ImagenesGeneradasReporteRespuestasv2($unix_timestamp);
                    }
                }
 
            }
            //---------------------------[GRAFICAS DE BARRAS FIN ]---------------------------------------------------------------
            else{
                throw new \Exception('FORMATO NO ENCONTRADO.');
            }
            
       
            //---------------------------[PREGUNTAS ABIERTAS  INI ]---------------------------------------------------------
            if($obj_enc->enc_preguntas_abiertas_pdf){
                 # Obteniendo data de acuerdo a las preguntas
                 $preguntas_respuestas_preguntas_abiertas = $obj_enc->getAllTodasLasRespuestasPreguntasAbiertas($data_encuesta['detalles-encuesta']['respuestas_encuesta_todo'],$data);
                 $preguntas_textos_preguntas_abiertas = $obj_enc->getPreguntasTextoAbiertoParaReportePDF($data);

                 foreach ($preguntas_textos_preguntas_abiertas as $pregunta_key => $pregunta_texto) {
                     if (isset($preguntas_respuestas_preguntas_abiertas[$pregunta_key])) {
                         $obj_molde_pdf_reporte->formatoPDFHojaDinamicaComentarios(
                             $pregunta_texto,
                             $preguntas_respuestas_preguntas_abiertas[$pregunta_key],
                             $reporte_completo->hoja_9_1,
                             $mpdf
                         );
                     }
                 }
            }
            //---------------------------[PREGUNTAS ABIERTAS  FIN ]---------------------------------------------------------
            
            //---------------------------[BITACORA INICIO ]---------------------------------------------------------------


            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $mensaje_extra_bitcora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reportes de respuestas v. ".$enc_version;
            $bitacora->NuevoRegistro($databit);
            $mpdf->SetTitle($tituloPdf." ".$enc_version);
            $mpdf->Output($tituloPdf.".pdf",'I');

            //---------------------------[BITACORA FIN ]------------------------------------------------------------------

        } catch (Exception $e) {
            $answer['mensaje'] = $e->getMessage();
            error_log("respuesta_estadisticas_servicio_calidad_pdf error en la línea " . $e->getLine() . ": " . $e->getMessage());

            $answer['estatus'] = -2;
            $mensajeLog= "ERROR EN EL PROCESO ".$e->getMessage();
            $mensaje= "ERROR EN EL PROCESO ";
            $this->flash->error($mensajeLog);
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;  
        }
    }
}
