<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use \Phalcon\Config\Adapter\Ini as ConfigIni;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';
require "mpdf/index.php";

class ReporteController extends ControllerBase
{
    public $logo_principal_ruta="assets/images/sistema/logo.svg";
    public $logo_principal_ruta_2="assets/images/sistema/logo positivo.png";

    public function initialize()
    {
        $this->tag->setTitle('Reporte');
        parent::initialize();
    }

    public function reporte_evaluacion_candidatoAction($id=0,$correo=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        
        try {

            if(!$rol->verificar(52,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            { 
                $this->flash->error("ERROR #NPBD505SIS");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
    
            //validamos que no exista un error el la funcion
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id);
            if($respuesta_modelo_des_encript["estado"]==-2){
                $this->flash->error("PARÁMETROS ERROR.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }  
            
            $id=$respuesta_modelo_des_encript["id"];
            //validamos el id 
            if($id==0) 
            { 
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            //$host="";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
            //$url=$host.$carpeta."consulta/validaqr/";
    
            $expedientecan=Expedientecan::findFirstByexc_id($id);
            if(!$expedientecan) //si no existe el estudio
            {  
                $this->flash->error("No existe el expediente.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
    
            $registro = Expedientecan::query()
            ->columns('
                Expedientecan.exc_id,
                Expedientecan.can_id,
                Expedientecan.vac_id,
                Expedientecan.exc_estatus,
                vac.vac_estatus,
                cav.cav_nombre,
                ent.ent_fecha,
                CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                CONCAT(exc_eje.usu_nombre," ", exc_eje.usu_primerapellido," ",exc_eje.usu_segundoapellido) as exc_eje_nombre,
                cit.cit_puestosimilar,
                cit.cit_estabilidalaboral,
                cit.cit_fecha,
                cit.cit_responsabilidad,
                cit.cit_concimientostec,
                cit.cit_acordeasueldoofrecido,
                cit.cit_presentacionapariencia,
                cit.cit_observaciones,
                psi.psi_observacion,
                psi.psi_calificacion,
                sel.sel_calificacion,
                cit.cit_puntualidad,
                cit.cit_disponibilidad,
                cit.cit_proactivo,
                ent.ent_observacion,
                emp.emp_nombre  
            ')
            ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
            ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
            ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
            ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can')
            ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
            ->leftjoin('Usuario','exc_eje.usu_id=Expedientecan.eje_idprincipal','exc_eje')
            ->leftjoin('Entrevista','ent.exc_id=Expedientecan.exc_id','ent')
            ->leftjoin('Psicometria','psi.exc_id=Expedientecan.exc_id','psi')
            ->leftjoin('Seccionlaboral','sel.exc_id=Expedientecan.exc_id','sel')
            ->leftjoin('Cita','cit.exc_id=Expedientecan.exc_id','cit')
            ->where('Expedientecan.exc_id=' .  $expedientecan->exc_id)
            ->limit(1)
            ->execute();
    
    
            $this->view->disable();

            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación
            $reporte= new PdfReporteevaluacioncan();
            $reporte_obj= new Reporteevaluacioncan();
            $anio_actual = date('Y');
            $header = str_replace("#anio_actual#", $anio_actual, $reporte->excheader);

            $header = str_replace("#logo#", "assets/images/sistema/logo positivo.png", $header);    
            $mpdf->SetHTMLHeader($header);
    
            $mpdf->SetHTMLFooter($reporte->excfooter);
            $mpdf->WriteHTML($reporte->head_style);
    
            $respuesta_modelo_datos_personales=$reporte_obj->datosPersonales($reporte->datospersonales, $registro[0]);
            $mpdf->WriteHTML($respuesta_modelo_datos_personales["html"]);
    
            $respuesta_modelo_exp_lab=$reporte_obj->valoracionExpLab($reporte->tabla_valoracion_exp_lab, $registro[0]);
            $mpdf->WriteHTML($respuesta_modelo_exp_lab["html"]);
    
            $respuesta_modelo_ent=$reporte_obj->valoracionEnt($reporte->tabla_valoracion_entrevista, $registro[0]);
            $mpdf->WriteHTML($respuesta_modelo_ent["html"]);
    
            
            $respuesta_modelo_adicionales=$reporte_obj->valoracionAdicional($reporte->tabla_valoracion_adicionales, $registro[0]);
            $mpdf->WriteHTML($respuesta_modelo_adicionales["html"]);
    
            $respuesta_modelo_observaciones=$reporte_obj->valoracionObservaciones($reporte->seccionobservaciones, $registro[0]);
            $mpdf->WriteHTML($respuesta_modelo_observaciones["html"]);
            
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un EXC con ID: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="REPORTE";
            $bitacora->NuevoRegistro($databit);
    
            $fecha_y_hora = date("d_m_y");
            $mpdf->SetTitle('REPORTE_EVALUACIÓN_CANDIDATO_No._'.$id."_FECHA_".$fecha_y_hora);
            $mpdf->SetAuthor('SIPS | SARAPE');
            $mpdf->Output('REPORTE_EVALUACIÓN_CANDIDATO_No._'.$id.'_FECHA_'.$fecha_y_hora.'.pdf','I');


        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            // echo str_replace("\n", '<br />', $mensaje);
            echo $e->getMessage();
        }

    }

    public function reporte_referencias_candidatoAction($id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        try {


              
                if(!$rol->verificar(53,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $this->flash->error("ERROR #NPBD505SIS");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
                //validamos que no exista un error el la funcion
                $respuesta_modelo_des_encript = $this->des_encriiptarId($id);
                if($respuesta_modelo_des_encript["estado"]==-2){
                    $this->flash->error("PARÁMETROS ERROR.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }  

                $id=$respuesta_modelo_des_encript["id"];


                if($id==0) //el número en la funcion es el correspondiente a la bdd
                {
                    $this->flash->error("ID no válido.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }


                date_default_timezone_set('america/mexico_city');
               // $host="https://sadisips.com/";
                $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
                $carpeta=$config->application->baseUri;
                //$url=$host.$carpeta."consulta/validaqr/";

                $expedientecan=Expedientecan::findFirstByexc_id($id);
                if(!$expedientecan) //si no existe el estudio
                {
                
                    $this->flash->error("No existe el expediente.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
                $this->view->disable();
             
                $registro = Expedientecan::query()
                ->columns('
                    Expedientecan.exc_id,
                    Expedientecan.can_id,
                    Expedientecan.vac_id,
                    Expedientecan.exc_estatus,
                    vac.vac_estatus,
                    cav.cav_nombre,
                    ent.ent_fecha,
                    CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre,
                    CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                    cit.cit_puestosimilar,
                    cit.cit_estabilidalaboral,
                    cit.cit_responsabilidad,
                    cit.cit_concimientostec,
                    cit.cit_acordeasueldoofrecido,
                    cit.cit_presentacionapariencia,
                    cit.cit_observaciones,
                    psi.psi_observacion,
                    psi.psi_calificacion,
                    sel.sel_id,
                    sel.sel_calificacion,
                    sel.sel_notas,
                    sel.sel_empleosocultos,
                    cit.cit_puntualidad,
                    cit.cit_disponibilidad,
                    cit.cit_proactivo,
                    emp.emp_logo,
                    emp.emp_nombre  
                ')
                ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Entrevista','ent.exc_id=Expedientecan.exc_id','ent')
                ->leftjoin('Psicometria','psi.exc_id=Expedientecan.exc_id','psi')
                ->leftjoin('Seccionlaboral','sel.exc_id=Expedientecan.exc_id','sel')
                ->leftjoin('Cita','cit.exc_id=Expedientecan.exc_id','cit')
                ->leftjoin('Referencialaboral','rel.rel_id=sel.sel_id','rel')
                ->leftjoin('Periodoinactivo','per.sel_id=sel.sel_id','per')

                ->where('Expedientecan.exc_id=' .  $expedientecan->exc_id)
                ->limit(1)
                ->execute();
                $data=$registro[0];
              
                if (isset($data->sel_id)) {
                    $referencialaboral = new Builder();
                    $referencialaboral = $referencialaboral
                        ->addFrom('Referencialaboral', 'd')
                        ->where('rel_estatus=2 and sel_id=' . $data->sel_id)
                        ->orderBy('rel_orden')
                        ->getQuery()
                        ->execute();

                        //empleos ocultos 
                        $empleooculto=new Builder();
                        $empleooculto=$empleooculto
                        ->addFrom('Empleooculto','epl')
                        ->where('epl_estatus=2 and sel_id='.$data->sel_id)
                        ->orderBy('epl_id')
                        ->getQuery()
                        ->execute();    
            
                        $periodoinactivo=new Builder();
                        $periodoinactivo=$periodoinactivo
                        ->addFrom('Periodoinactivo','d')
                        ->where('per_estatus=2 and sel_id='.$data->sel_id)
                        ->orderBy('per_id')
                        ->getQuery()
                        ->execute();
                
                    // Continuar con el procesamiento de $referencialaboral si es necesario
                } else {
                    $referencialaboral=[];
                    $periodoinactivo=[];
                    $empleooculto=[];

                }
                if (isset($referencialaboral[0])) {
                    $data_rel = $referencialaboral;
                } else {
                    $data_rel=[];
                }
            
                $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación
                $reporte= new  PdfReporteReferencias();
                $reporte_obj= new Seccionlaboral();
                $header=$reporte->eseheaderprimera;
                $mpdf->SetHTMLFooter('
                    <table width="100%">
                        <tr>
                            <td width="33%" style="text-align: right;">{PAGENO}-{nbpg}</td>
                        </tr>
                    </table>');

                if( $data->emp_logo=="" ||  $data->emp_logo==null){
                    $logo= $this->logo_principal_ruta_2;
                }else{
                    $logo="images/logoempresa/".$data->emp_logo;
                    if (!file_exists($logo)) {
                        $logo="";
                        $logo= $this->logo_principal_ruta_2;
                    }

                }
          
                $header = str_replace("#logo#",$logo, $header);
                $mpdf->SetHTMLHeader($header);
                $mpdf->WriteHTML($reporte->titulo);
                $respuesta_objeto_datos_personales= $reporte_obj->datosPersonales_Reporte($reporte->datospersonales,$data);
                $mpdf->WriteHTML($respuesta_objeto_datos_personales["html"]);
                $mpdf->WriteHTML($reporte->referencias_laborales_cabecera);
                
                $detalles_rel=count($data_rel);
                for ($i=0; $i < count($data_rel); $i++){ 
                    
                    if($i==0){
                        $respuesta_objeto_datos_ref_lab=$reporte_obj->referenciasLaborales_Reporte($reporte->referencialaboral,$data_rel[$i],0); //0 es último empleo
                        $mpdf->WriteHTML($respuesta_objeto_datos_ref_lab["html"]);
                    }else{
                        $respuesta_objeto_datos_ref_lab=$reporte_obj->referenciasLaborales_Reporte($reporte->referencialaboral,$data_rel[$i],1); //1 es para anteriores empleos
                        $mpdf->AddPage();
                        $mpdf->WriteHTML($respuesta_objeto_datos_ref_lab["html"]);
                    }
                }
                $respuesta_objeto_datos_per= $reporte_obj->periodoInactividadEmpleosOcultosPeriodoInactividad_Reporte($reporte->periodoinactivo,$data,$empleooculto,$periodoinactivo);
                $mpdf->WriteHTML($respuesta_objeto_datos_per["html"]);
                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Descargó un EXC con ID: ".$id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="REPORTE";
                $bitacora->NuevoRegistro($databit);
                $fecha_y_hora = date("d_m_y");
                $mpdf->SetTitle('REPORTE_REFERENCIAS_LABORALES_No._'.$id."_FECHA_".$fecha_y_hora);
                $mpdf->SetAuthor('SIPS | SARAPE');
                $mpdf->Output('Expediente_Referencias_Laborales_'.$id."_FECHA_".$fecha_y_hora.'.pdf','I');
        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            // echo str_replace("\n", '<br />', $mensaje);
            echo $e->getMessage();
        }
    }

    public function reporte_requision_personalAction($id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        try {

            if(!$rol->verificar(75,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("ERROR #NPBD505SIS");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            //validamos que no exista un error el la funcion
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id);
            if($respuesta_modelo_des_encript["estado"]==-2){
                    $this->flash->error("PARÁMETROS ERROR.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
            }
            $id=$respuesta_modelo_des_encript["id"];
  
            if($id==0) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            date_default_timezone_set('america/mexico_city');
           // $host="https://sadisips.com/";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
           // $url=$host.$carpeta."consulta/validaqr/";

            $vacante=Vacante::findFirstByvac_id($id);
            if (!$vacante) {//No existe una vacante con este id
                $this->flash->error("No existe la vacante.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $vac_obj=new Vacante();
            $registro = Vacante::query()
            ->columns('
                Vacante.vac_id,
                Vacante.tip_id,
                Vacante.cav_id,
                Vacante.emp_id,
                Vacante.est_id,
                Vacante.mun_id,
                Vacante.gen_id,
                Vacante.esc_id,
                Vacante.gra_id,
                Vacante.eje_id,
                Vacante.sex_id,
                Vacante.cen_id,
                Vacante.cne_id,
                Vacante.tie_id,
                Vacante.pre_id,
                Vacante.usu_idalta,
                tip.tip_id,
                cav.cav_id,
                emp.emp_id,
                tie.tie_id,
                est.est_id,
                mun.mun_id,
                gen.gen_id,
                gra.gra_id,
                Vacante.vac_fecharegistro,
                tip.tip_nombre,
                cav.cav_nombre,
                Vacante.vac_numero,
                emp.emp_nombre,
                tie.tie_nombre,
                est.est_nombre,
                mun.mun_nombre,
                gen.gen_nombre,
                Vacante.vac_edadmin,
                Vacante.vac_edadmax,
                sex.sex_nombre,
                gra.gra_nombre,
                pre.pre_id,
                Vacante.vac_escolaridadespecificar,
                Vacante.vac_idioma,
                Vacante.vac_nivelidioma,
                Vacante.vac_otroidioma,
                Vacante.vac_horario,
                Vacante.vac_conceptotecnico,
                Vacante.vac_habilidad,
                Vacante.vac_funcionprincipal,
                Vacante.vac_experiencia,
                Vacante.vac_sueldomin,
                Vacante.vac_sueldomax,
                Vacante.vac_privacidad,
                Vacante.vac_garantia,

                pre.pre_nombre,
                esc.esc_nombre,
                tpg.tpg_nombre,
                cen.cen_nombre,


                Vacante.vac_observaciones,
                CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre
            ')
            ->leftjoin('Tipovacante','tip.tip_id=Vacante.tip_id','tip')
            ->leftjoin('Catvacante', 'cav.cav_id=Vacante.cav_id','cav')
            ->leftjoin('Empresa','emp.emp_id=Vacante.emp_id','emp')
            ->leftjoin('Tipoempleo','tie.tie_id=Vacante.tie_id','tie')
            ->leftjoin('Estado','est.est_id=Vacante.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Vacante.mun_id','mun')
            ->leftjoin('Generacion','gen.gen_id=Vacante.gen_id','gen')
            ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
            ->leftjoin('Gradoescolar','gra.gra_id=Vacante.gra_id','gra')
            ->leftjoin('Prestacion','pre.pre_id=Vacante.pre_id','pre')
            ->leftjoin('Usuario','eje.usu_id=Vacante.eje_id','eje')
            ->leftjoin('Estadocivil','esc.esc_id=Vacante.esc_id','esc')
            ->leftjoin('Tipopago','tpg.tpg_id=Vacante.tpg_id','tpg')
            ->leftjoin('Centrocosto','cen.cen_id=Vacante.cen_id','cen')

            ->where('Vacante.vac_id='.$vacante->vac_id)
            ->limit(1)
            ->execute();
            $data= $registro[0];
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación
            $reporte= new RequisicionPersonal();
            //Valores iniciales
            $header=$reporte->eseheaderprimera;
            $titulo = $reporte->titulo;
            $datosgenerales = $reporte->datosgenerales;
            $personalsubcontratado = $reporte->personalsubcontratado;
            $requerimientospuesto = $reporte->requerimientospuesto;
            $observaciones = $reporte->observaciones;
            $nombreejecutivo = $reporte->nombreejecutivo;
            if( $data->emp_logo=="" ||  $data->emp_logo==null){
                $logo= $this->logo_principal_ruta_2;
            }else{
                $logo="images/logoempresa/".$data->emp_logo;
                if (!file_exists($logo)) {
                    $logo="";
                    $logo= $this->logo_principal_ruta_2;
                }
            }

            // Fomatear valores
            $fechaFormateada = date('d/m/Y', strtotime($data->vac_fecharegistro));           
            //Remplazar valores
            $header = str_replace("#logo#",$logo, $header);
            $titulo = str_replace("#vac_fecharegistro#",$fechaFormateada, $titulo);
            $titulo = str_replace("#tip_nombre#", $data->tip_nombre, $titulo);
            $datosgenerales = str_replace("#cav_nombre#", $data->cav_nombre, $datosgenerales);
            $datosgenerales = str_replace("#vac_numero#", $data->vac_numero, $datosgenerales);
            $datosgenerales = str_replace("#emp_nombre#", $data->emp_nombre, $datosgenerales);

            
            $centro_costo_visible=false;
            if($data->emp_id==1){
                $centro_costo_visible=true;
                $datosgenerales = str_replace("#style_width_td_1_tipo_empleo#", "16.56%", $datosgenerales);
                $datosgenerales = str_replace("#style_width_td_2_tipo_empleo#","12%", $datosgenerales);
 
                $template_tipo_empleo_temporal_si='
                <td width="13%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">POR</td>
                <td width="8.59%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">'.$data->vac_tiempomeses.'</td>
                <td width="8%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">MESES</td>
    
                <td width="12.50%"  style="#style_tipo_empleo_si_temporal#  font-size: 8.5px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">CENTRO  DE COSTO </td>
                <td width="29.06%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">'.$data->cen_nombre.'</td>
                ';
                $template_tipo_empleo_temporal_no='
                <td width="13%"></td>
                <td width="8.59%"></td>
                <td width="8%"></td>
                <td width="12.50%"  style="#style_tipo_empleo_si_temporal#  font-size: 8.5px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">CENTRO DE COSTO</td>
                <td width="29.06%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">'.$data->cen_nombre.'</td>
                ';


            }else{
                $datosgenerales = str_replace("#style_width_td_1_tipo_empleo#", "16.68%", $datosgenerales);
                $datosgenerales = str_replace("#style_width_td_2_tipo_empleo#","41.66%", $datosgenerales);
                $template_tipo_empleo_temporal_si='
                <td width="12.5%"  style="#style_tipo_empleo_si_temporal#  font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">POR</td>
                <td width="12.5%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">'.$data->vac_tiempomeses.'</td>
                <td width="16.66%"  style="#style_tipo_empleo_si_temporal# font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">MESES</td>
                ';
                $template_tipo_empleo_temporal_no='
                <td width="12.5%"></td>
                <td width="12.5%"></td>
                <td width="16.66%"></td>
                ';

            }

            $datosgenerales = str_replace("#tie_nombre#", $data->tie_nombre, $datosgenerales);
            //validamos que tipo de empleo inicio
      
            //$datosgenerales = str_replace("#cen_nombre#", $data->cen_nombre, $datosgenerales);
           //if(true){
          if($data->tie_id==3){
                $datosgenerales = str_replace("#tipo_empleo_template_si_no#", $template_tipo_empleo_temporal_si, $datosgenerales);
            }else{
                $datosgenerales = str_replace("#tipo_empleo_template_si_no#", $template_tipo_empleo_temporal_no, $datosgenerales);
            }
            //validamos que tipo de empleo fin
            
            $datosgenerales = str_replace("#est_nombre#", $data->est_nombre, $datosgenerales);
            $datosgenerales = str_replace("#mun_nombre#", $data->mun_nombre, $datosgenerales);
            $personalsubcontratado = str_replace("#gen_nombre#", $data->gen_nombre, $personalsubcontratado);
            $requerimientospuesto = str_replace("#esc_nombre#",$data->esc_nombre, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_edadmin#",$data->vac_edadmin, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_edadmax#",$data->vac_edadmax, $requerimientospuesto);
            $requerimientospuesto = str_replace("#sex_nombre#",$data->sex_nombre, $requerimientospuesto);
            $requerimientospuesto = str_replace("#gra_nombre#",$data->gra_nombre, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_escolaridadespecificar#",$data->vac_escolaridadespecificar, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_idioma#",$data->vac_idioma, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_nivelidioma#",$data->vac_nivelidioma, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_otroidioma#",$data->vac_otroidioma, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_horario#",$data->vac_horario, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_conceptotecnico#",nl2br($data->vac_conceptotecnico), $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_habilidad#",nl2br($data->vac_habilidad), $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_funcionprincipal#",nl2br($data->vac_funcionprincipal), $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_experiencia#",nl2br($data->vac_experiencia), $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_sueldomin#",$data->vac_sueldomin, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_sueldomax#",$data->vac_sueldomax, $requerimientospuesto);
            $requerimientospuesto = str_replace("#pre_nombre#",$data->pre_nombre, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_garantia#",$this->limpiarValorBD($data->vac_garantia), $requerimientospuesto);
            $requerimientospuesto = str_replace("#tpg_nombre#",$data->tpg_nombre, $requerimientospuesto);
            $requerimientospuesto = str_replace("#vac_privacidad#",$vac_obj->getTextoPrivacidad($data->vac_privacidad), $requerimientospuesto);
                        $observaciones = str_replace("#vac_observaciones#",$data->vac_observaciones, $observaciones);
            $nombreejecutivo = str_replace("#eje_nombre#",$data->eje_nombre, $nombreejecutivo);

            $mpdf->SetHTMLHeader($header);
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML($datosgenerales);
            $mpdf->WriteHTML($personalsubcontratado);
            $mpdf->WriteHTML($requerimientospuesto);
            $mpdf->WriteHTML($observaciones);
            $mpdf->WriteHTML($nombreejecutivo);
                
            $fecha_y_hora = date("d_m_y");
            $mpdf->SetTitle('REPORTE_DE_REQUISICIÓN_DE_PERSONAL NO_'.$id.'_FECHA_'.$fecha_y_hora);
            $mpdf->SetAuthor('SIPS | SARAPE | REPORTE');
            $mpdf->Output('REPORTE_DE_REQUISICIÓN_DE_PERSONAL_'.$id.'_FECHA_'.$fecha_y_hora.'.pdf','I');
        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
           // echo str_replace("\n", '<br />', $mensaje);
            echo $e->getMessage();
        }
    }

    public function facturacion_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(91,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }

    }
    public function facturacion_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Los parámetros de búsqueda fueron:';

        $auth = $this->session->get('auth');
        if(!$rol->verificar(91,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            if($data['ese_fechainicial'] != ''  &&  $data['ese_fechafinal'] != '')
            {
                $condicion = "fat_estatus=2 and (exc_fechafacturacion >= '{$data['ese_fechainicial']} 00:00:00' AND exc_fechafacturacion <= '{$data['ese_fechafinal']} 23:59:59') or (exc_fechagarantia >= '{$data['ese_fechainicial']} 00:00:00' AND exc_fechagarantia <= '{$data['ese_fechafinal']} 23:59:59')";
                //consulta inicio
                $expediente=Expedientecan::query()
                ->columns("
                    Expedientecan.exc_id, vac.vac_id, exc_fechafacturacion, exc_fechagarantia, exc_estatus, emp_nombre,
                    cav_nombre, fat_sueldo, fat_factor, fat_montofacturar, fat_reqfactura, CONCAT_WS(' ', eje.usu_nombre, 
                    eje.usu_primerapellido, eje.usu_segundoapellido) as eje_nombre,
                    CONCAT_WS(' ', exc_eje.usu_nombre, exc_eje.usu_primerapellido, exc_eje.usu_segundoapellido) as exc_eje_nombre,
                    vac_fecharegistro, fat_fechaingreso,
                    CONCAT_WS(' ', can.can_nombre, can.can_primerapellido, can.can_segundoapellido) as candidato
                    ")//la parte que esta separada es la parte que son llaves foraneas
                ->leftjoin('Vacante','vac.vac_id=Expedientecan.vac_id','vac')
                ->leftjoin('Catvacante','vac.cav_id=cav.cav_id','cav')
                ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                ->leftjoin('Facturacion','fac.exc_id=Expedientecan.exc_id','fac')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Usuario','exc_eje.usu_id=Expedientecan.eje_idprincipal','exc_eje')
                ->leftjoin('Candidato','can.can_id=Expedientecan.can_id','can')
                ->where($condicion)
                ->execute();
                //consulta fin

                ///bitacora inicio
                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Realizó una consulta de facturación.';
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Reporte de facturación";
                $bitacora->NuevoRegistro($databit);
                //bitacora fin
                $this->usuario = new Usuario();
                // $this->empresa =new Empresa();
                // $this->reporte =new Reporte();
                // $this->view->estudiomodel = new Estudio();
                // $this->view->usuario = $this->usuario;
                // $this->view->reporte= $this->reporte;
                $this->view->expedientecan = new Expedientecan();
                $this->view->facturacion = new Facturacion();
                $this->view->page=$expediente;
                $this->view->mensaje='';
            }else{
                $this->view->page=[];
                $this->view->mensaje='DEBES COLOCAR AMBAS FECHAS';
            }
        }
    }
}