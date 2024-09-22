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
        $condiciontipoestudio="";
        $auth = $this->session->get('auth');
        if(!$rol->verificar(18,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
        }

        $indexana=-1;
        $indexinv=-1;
        $indexest=-1;
        $indexemp=-1;
        $indexcan=-1;
        
        $this->analista = new Usuario();
        $this->investigador = new Usuario();
        $this->empresa = new Empresa();
        

        $analistaselect=$this->analista->getAnalista();
        $investigadorselect=$this->investigador->getInvestigador();
        $empresaselect=Empresa::find("emp_estatus=2");
        $condiciontipoestudio.=$this->getEstudios();

        $tipoEstudioSelect=Tipoestudio::query()
            ->columns('tip_id, tip_nombre')
            ->where($condiciontipoestudio.' and tip_estatus=2')
            ->execute();
        
        $estadoselect=Estado::find("est_estatus=2");


        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingresó a módulo de Consulta";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Consulta";
        $bitacora->NuevoRegistro($databit);
        
        $this->view->indexana=$indexana;
        $this->view->indexinv=$indexinv;
        $this->view->indexest=$indexest;
        $this->view->indexemp=$indexemp;
        $this->view->indexcan=$indexcan;
        
        $this->view->estadoselect=$estadoselect;
        $this->view->tipoEstudios=$tipoEstudioSelect;
        
        $this->view->analistaselect=$analistaselect;
        $this->view->investigadorselect=$investigadorselect;
        $this->view->empresaselect=$empresaselect;
        
        
        $this->view->analista = $this->analista;
        $this->view->investigador = $this->investigador;
        $this->view->empresa = $this->empresa;
        

    }

    /**
     * [tablaAction Muestra los registros de la tabla de estudios]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(18,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $datos=[];

        if($this->request->isPost())
        {
        	$date= new DateTime();
	        $hoy=$date->format('Y-m-d');
	        $diasmenos = $this->resDiasexactos($hoy,180);
            $columna_cal=0;

            $data = $this->request->getPost();
           
            $condicion="";

            $array= [];

            $indexana=$data["ana_id"];
            $indexinv=$data["inv_id"];
            $indexest=$data["ese_estatus"];
            $indexemp=$data["emp_id"];
            $indexcan=$data["ese_id"];
            
            $descripcion="Realizó una búsqueda en consulta";

            $usuario= new Usuario();
            //tipo de estudio
            if($data["tip_id"]!="-1"){
                $condicion = ($condicion == '') ? $condicion.='  Estudio.tip_id = '.$data["tip_id"]  : $condicion.=' and  Estudio.tip_id = '.$data["tip_id"] ;
                $filtro=Tipoestudio::find("tip_id=".$data["tip_id"]);
                $descripcion.=', filtro de tipo de estudio de : '.$filtro[0]->tip_nombre;
                array_push($array,'Tipo estudio');
            }else{
                $condicion.=$this->getEstudios("Estudio.");
            }

            if($data["ana_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ana_id=".$data["ana_id"] : $condicion.=" and Estudio.ana_id=".$data["ana_id"];
                $descripcion.=", filtro de analista: ".$usuario->getNombre($data["ana_id"]);
                array_push($array,'Analista');
            }
            if($data["inv_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.inv_id=".$data["inv_id"] :  $condicion.=" and inv_id=".$data["inv_id"];
                $descripcion.=", filtro de investigador: ".$usuario->getNombre($data["inv_id"]);
                array_push($array,'Investigador');
            }

            if($data["ese_estatus"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_estatus=".$data["ese_estatus"] :  $condicion.=" and Estudio.ese_estatus=".$data["ese_estatus"];
                $filtro= new Estudio();
                $estatus=$filtro->getEstatusDetail($data["ese_estatus"]);
                $descripcion.=", filtro de estatus: ".$estatus;
                array_push($array,'Estatus');
            }
            if($data["emp_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" e.emp_id=".$data["emp_id"] :    $condicion.=" and e.emp_id=".$data["emp_id"];
                $filtro=Empresa::find("emp_id=".$data["emp_id"]);
                $descripcion.=", filtro de empresa: ".$filtro[0]->emp_nombre;
                array_push($array,'Empresa');
            }
            if($data["cne_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.cne_id=".$data["cne_id"] :  $condicion.=" and Estudio.cne_id=".$data["cne_id"];
                $filtro=Contactoemp::find("cne_id=".$data["cne_id"]);
                $descripcion.=", filtro de quien solicito : ".$filtro[0]->cne_nombre.' '.$filtro[0]->cne_primerapellido.' '.$filtro[0]->cne_segundoapellido;
                array_push($array,'Quien solicita');
            }
            if($data["cen_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.='  Estudio.cen_id = '.$data["cen_id"]  : $condicion.=' and  Estudio.cen_id = '.$data["cen_id"] ;
                $filtro=Centrocosto::find("cen_id=".$data["cen_id"]);
                $descripcion.=", filtro de centro de costo : ".$filtro[0]->cen_nombre.' '.$filtro[0]->cen_correo.' '.$filtro[0]->cen_tel;
                array_push($array,'Centro  de costo');
            }

            if($data["est_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.est_id=".$data["est_id"] :  $condicion.=" and Estudio.est_id=".$data["est_id"];
                $filtro=Estado::find("est_id=".$data["est_id"]);
                $descripcion.=", filtro de estado: ".$filtro[0]->est_nombre;
                array_push($array,'Estado');
            }
            if($data["mun_id"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.mun_id=".$data["mun_id"] : $condicion.=" and Estudio.mun_id=".$data["mun_id"];
                $filtro=Municipio::find("mun_id=".$data["mun_id"]);
                $descripcion.=", filtro de municipio: ".$filtro[0]->mun_nombre;
                array_push($array,'Municipio');
            }

            if($data["ese_id"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_id =".$data["ese_id"]." " : $condicion.=" and Estudio.ese_id =".$data["ese_id"]." ";
                $descripcion.=", filtro de candidato con ESE ID: ".$data["ese_id"] ;
                array_push($array,'ESE ID');
            }
            if($data["ese_curp"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_curp LIKE '%".$data["ese_curp"]."%' " : $condicion.=" and Estudio.ese_curp LIKE '%".$data["ese_curp"]."%' ";
                $descripcion.=", filtro de candidato con CURP : ".$data["ese_curp"] ;
                array_push($array,'CURP');
            }

            if($data["ese_puesto"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_puesto LIKE '%".$data["ese_puesto"]."%' " : $condicion.=" and Estudio.ese_puesto LIKE '%".$data["ese_puesto"]."%' ";
                $descripcion.=", filtro de candidato con puesto  : ".$data["ese_puesto"] ;
                array_push($array,'Puesto');
            }

            if($data["ese_nombre"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_nombre LIKE '%".$data["ese_nombre"]."%' " : $condicion.=" and Estudio.ese_nombre LIKE '%".$data["ese_nombre"]."%' ";
                $descripcion.=", filtro de candidato con nombre  : ".$data["ese_nombre"] ;
                array_push($array,'Nombre');
            }

            if($data["ese_primerapellido"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_primerapellido LIKE '%".$data["ese_primerapellido"]."%' " : $condicion.=" and Estudio.ese_primerapellido LIKE '%".$data["ese_primerapellido"]."%' ";
                $descripcion.=", filtro de candidato con primer apellido  : ".$data["ese_primerapellido"] ;
                array_push($array,'Primer apellido');
            }

            if($data["ese_segundoapellido"]!=''){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_segundoapellido LIKE '%".$data["ese_segundoapellido"]."%' " : $condicion.=" and Estudio.ese_segundoapellido LIKE '%".$data["ese_segundoapellido"]."%' ";
                $descripcion.=", filtro de candidato con segundo apellido  : ".$data["ese_segundoapellido"] ;
                array_push($array,'Segundo apellido');
            }
            
            if($data["ese_transporte"]!=-1){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_transporte=".$data["ese_transporte"] :    $condicion.=" and ese_transporte=".$data["ese_transporte"];
                $tranporte_estatus = ($data["ese_transporte"] == 2) ? "asignado" : "no asignado";
                $descripcion.=", filtro de estatus de transporte: transporte".$tranporte_estatus;
                array_push($array,'Transporte');
            }
             ///CONSULTA DE FECHAS incio
            $alta=0;
            if($data["ese_registro_fechainicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_registro>='".$data["ese_registro_fechainicial"]."'" : $condicion.=" and ese_registro>='".$data["ese_registro_fechainicial"]."'";
                $descripcion.=", filtro de fecha inicial de alta de ESE: ".$data["ese_registro_fechainicial"];
                $alta=1;
            }
            if($data["ese_registro_fechafinal"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_registro<='".$data["ese_registro_fechafinal"]." 23:59:59'" :$condicion.=" and ese_registro<='".$data["ese_registro_fechafinal"]." 23:59:59'";
                 $descripcion.=", filtro de fecha final de alta de ESE: ".$data["ese_registro_fechafinal"];
                 $alta=1;
            }
            if($alta==1){
                array_push($array,'Fecha de alta');
            }

            $fechacliente=0;
            if($data["ese_fechaentregacliente_f_inicial"]!=""){ 
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'" : $condicion.=" and ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de entrega cliente de ESE: ".$data["ese_fechaentregacliente_f_inicial"];
                $fechacliente=1;
            }
            if($data["ese_fechaentregacliente_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechaentregacliente<='".$data["ese_fechaentregacliente_f_final"]." 23:59:59'" :   $condicion.=" and ese_fechaentregacliente<='".$data["ese_fechaentregacliente_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de entrega cliente de ESE: ".$data["ese_fechaentregacliente_f_final"];
                $fechacliente=1;
            }
            if($fechacliente==1){
                array_push($array,'Fecha entrega cliente');
            }

            $fechainvestigador=0;
            if($data["ese_fechaentregainvestigador_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechaentregainvestigador>='".$data["ese_fechaentregainvestigador_f_inicial"]."'" :   $condicion.=" and ese_fechaentregainvestigador>='".$data["ese_fechaentregainvestigador_f_inicial"]." 23:59:59'";
                $descripcion.=", filtro de fecha inicial de entrega investigador de ESE: ".$data["ese_fechaentregainvestigador_f_inicial"];
                $fechainvestigador=1;
            }
            if($data["ese_fechaentregainvestigador_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ese_fechaentregainvestigador<='".$data["ese_fechaentregainvestigador_f_final"]." 23:59:59'": $condicion.=" and ese_fechaentregainvestigador<='".$data["ese_fechaentregainvestigador_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de entrega investigador de ESE: ".$data["ese_fechaentregainvestigador_f_final"];
                $fechainvestigador=1;
            }
            if($fechainvestigador==1){
                array_push($array,'Fecha entrega investigador');
            }

            $fechaentregaana=0;
            if($data["ese_fechaentregaanalista_f_inicial"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ese_fechaentregaanalista>='".$data["ese_fechaentregaanalista_f_inicial"]."'":   $condicion.=" and ese_fechaentregaanalista>='".$data["ese_fechaentregaanalista_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de entrega analista de ESE: ".$data["ese_fechaentregaanalista_f_inicial"];
                $fechaentregaana=1;
            }
            if($data["ese_fechaentregaanalista_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ese_fechaentregaanalista<='".$data["ese_fechaentregaanalista_f_final"]." 23:59:59'": $condicion.=" and ese_fechaentregaanalista<='".$data["ese_fechaentregaanalista_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de entrega analista de ESE: ".$data["ese_fechaentregaanalista_f_final"];
                $fechaentregaana=1;
            }
            if($fechaentregaana==1){
                array_push($array,'Fecha entrega analista');
            }
            
            $fechaasigana=0;
            if($data["ese_fechaasiganalista_f_inical"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ese_fechaasiganalista>='".$data["ese_fechaasiganalista_f_inical"]."'":$condicion.=" and ese_fechaasiganalista>='".$data["ese_fechaasiganalista_f_inical"]."'";
                $descripcion.=", filtro de fecha inicial de asignación analista de ESE: ".$data["ese_fechaasiganalista_f_inical"];
                $fechaasigana=1;
            }
            if($data["ese_fechaasiganalista_f_final"]!=""){
                $condicion = ($condicion == '') ?  $condicion.=" ese_fechaasiganalista<='".$data["ese_fechaasiganalista_f_final"]." 23:59:59'": $condicion.=" and ese_fechaasiganalista<='".$data["ese_fechaasiganalista_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de asignación analista de ESE: ".$data["ese_fechaasiganalista_f_final"];
                $fechaasigana=1;
            }
            if($fechaasigana==1){
                array_push($array,'Fecha asignación analista');
            }

            $fechaasiginv=0;
            if($data["ese_fechaasiginvestigador_f_inical"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ese_fechaasiginvestigador>='".$data["ese_fechaasiginvestigador_f_inical"]."'" : $condicion.=" and ese_fechaasiginvestigador>='".$data["ese_fechaasiginvestigador_f_inical"]."'";
                $descripcion.=", filtro de fecha inicial de asignación investigador de ESE: ".$data["ese_fechaasiginvestigador_f_inical"];
                $fechaasiginv=1;
            }
            if($data["ese_fechaasiginvestigador_f_final"]!=""){
                $condicion = ($condicion == '') ? $condicion.=" ese_fechaasiginvestigador<='".$data["ese_fechaasiginvestigador_f_final"]." 23:59:59'": $condicion.=" and ese_fechaasiginvestigador<='".$data["ese_fechaasiginvestigador_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de asignación investigador de ESE: ".$data["ese_fechaasiginvestigador_f_final"];
                $fechaasiginv=1;
            }
            if($fechaasiginv==1){
                array_push($array,'Fecha asignación investigador');
            }

            $fechacancela=0;
            if($data["ese_fechacancelacion_f_inicial"]!=""){
                $condicion = ($condicion == '') ?  $condicion.="  ese_fechacancelacion>='".$data["ese_fechacancelacion_f_inicial"]."'":  $condicion.=" and ese_fechacancelacion>='".$data["ese_fechacancelacion_f_inicial"]."'";
                $descripcion.=", filtro de fecha inicial de cancelación de ESE: ".$data["ese_fechacancelacion_f_inicial"];
                $fechacancela=1;
            }
            if($data["ese_fechacancelacion_f_final"]!=""){
                $condicion = ($condicion == '') ?  $condicion.="  ese_fechacancelacion<='".$data["ese_fechacancelacion_f_final"]." 23:59:59'":  $condicion.=" and ese_fechacancelacion<='".$data["ese_fechacancelacion_f_final"]." 23:59:59'";
                $descripcion.=", filtro de fecha final de cancelación de ESE: ".$data["ese_fechacancelacion_f_final"];
                $fechacancela=1;
            }
            if($fechacancela==1){
                array_push($array,'Fecha cancelación');
            }

            ///CONSULTA DE FECHAS fin 

            if($data["ese_folioverificacion"]!=""){
                $condicion = ($condicion == '') ? $condicion.="  ese_folioverificacion  LIKE '%".$data["ese_folioverificacion"]."%'": $condicion.=" and ese_folioverificacion  LIKE '%".$data["ese_folioverificacion"]."%'";
                $descripcion.=", filtro de folio de verificación: ".$data["ese_folioverificacion"];
                array_push($array,'Referencia númerica');
            }
            
            //TIENE CALIFACIONES ese_calificacion(este filtro solo se encarga de mostrar la columna de calficacion)
            if($data["ese_calificacion"]=="2"){
                $columna_cal=1;
                $descripcion.=', filtro de calificación de estudio de  tiene calificación ';
                array_push($array,' Calificación estudio');
            }
             //TIENE CALIFACIONES ese_calificacion FIN(este filtro solo se encarga de mostrar la columna de calficacion)


            //empresa recluta INI
            $columna_ese_empresarecluta=0;
            if($data["ese_empresarecluta"]=="2"){
                $columna_ese_empresarecluta=1;
                $descripcion.=', filtro de empresa que recluta ';
                array_push($array,' Empresa recluta');
            }
            //empresa recluta FIN

            $estudio=Estudio::query()
                ->columns("Estudio.ese_id,Estudio.emp_id, ese_folioverificacion, ese_curp, ese_correo, ese_nombre, ese_primerapellido,ese_segundoapellido ,emp_nombre, ese_registro, ese_estatus, ana.usu_id as analista, inv.usu_id as investigador,Estudio.ese_precancelar, ese_fechaentregacliente
                    ,ese_telefono,ese_celular,est.est_nombre ,Estudio.est_id, Estudio.mun_id,mun.mun_nombre, Estudio.cne_id, cne.cne_nombre,cne.cne_primerapellido ,cne.cne_segundoapellido, cen_nombre, e.emp_rfc,cne.cne_celular,cne.cne_correo
                    ,ese_calle,ese_numext,ese_numint,ese_colonia,ese_codpostal,ese_fechanacimiento,ese_fechacancelacion,ese_fechaentregacliente
                    ,ese_fechaasiginvestigador,ese_fechaentregainvestigador
                    ,Estudio.ese_empresarecluta
                    ,tip_nombre,tip_clave,Estudio.tip_id,Estudio.ese_tippersona
                    ,Estudio.usu_idcancela,Estudio.ese_fechacancelacion,Estudio.ese_precancelar
                    ,Estudio.usu_idvalida
                    ,Estudio.tif_id
                    ,tra.tra_id, tra.tra_fechaaprobado,tra.tra_solicitado,tra.tra_aprobado,tra.aprobadousu_id,tra.tra_preaprobado,tra.tra_origen,tra.tra_destino,tra.tra_comentario,Estudio.ana_id,Estudio.ese_fechaasiganalista,Estudio.ese_fechaentregaanalista
                    ,Estudio.ese_visita
                    ,ute.ute_honorario as honorario_asignado, Estudio.tif_id
                    ,Estudio.cen_id
                    ,daf.daf_calificacion
                    ,daf.cal_id
                    ")
                ->join('Empresa','e.emp_id=Estudio.emp_id','e')
                ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
                ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id and tip.tip_estatus=2 ','tip')
                ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
                ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
                ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
                ->leftjoin('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
                ->leftjoin('Usuariotipoest','ute.tip_id=Estudio.tip_id and ute.usu_id=Estudio.inv_id and ute.ute_estatus=2','ute')
                ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.tra_estatus != -2 and  tra.investigadorusu_id = Estudio.inv_id','tra')
                ->leftjoin('Datofinal','daf.daf_estatus=2 and daf.ese_id = Estudio.ese_id','daf')
                ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
                ->where($condicion)
                // ->order('Estudio.ese_registro DESC')
                ->execute();

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Consulta";
            $bitacora->NuevoRegistro($databit);
        }
        $this->estudio = new Estudio();
        $this->usuario = new Usuario(); 
        $this->view->estudio = $this->estudio;
        $this->view->usuario = $this->usuario;
        $this->view->page=$estudio;
        $this->view->estudiomodel = new Estudio();
        $this->view->datofinalmodel = new Datofinal();
        $this->view->columna_cal = $columna_cal;
        $this->view->columna_ese_empresarecluta = $columna_ese_empresarecluta;

        $titulo='Consulta';

        if(count($array)>3){

        }else{
            for($i=0;$i<count($array);$i++){
                $titulo= $titulo.', '.$array[$i];
            }
        }
            

        $this->view->titulo=$titulo;
        
    }

    public function validaqrAction($id)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $ese_id = Estudio::findFirstByese_id($id);
        $valido=0;
        $ese_nombre='';
        $expedicion='';
        $folio='';

        if ($ese_id) 
        {
            if($ese_id->ese_estatus==7)
            {
                $valido=1;

                $ese_nombre='"'.mb_substr($ese_id->ese_nombre, 0, 3).' '.mb_substr($ese_id->ese_primerapellido, 0, 3).' '.mb_substr($ese_id->ese_segundoapellido, 0, 3).'"';
                $ini= new DateTime($ese_id->ese_fechaentregacliente);
                $expedicion=$ini->format('d/m/Y');
                $folio=$id;
            }
        }

        $this->view->valido=$valido;
        $this->view->ese_nombre=$ese_nombre;
        $this->view->expedicion=$expedicion;
        $this->view->folio=$folio;

    }

    public function get_ajax_detalles_ese_unoAction($ese_id)
    {
        $this->view->disable();
        if ($ese_id!=0 && is_numeric($ese_id)) {
           
                    $estudio=Estudio::query()
                    ->columns("
                        CONCAT(Estudio.ese_nombre, ' ', Estudio.ese_primerapellido,' ', Estudio.ese_segundoapellido) AS ese_nombre_nombre_completo_candidato
                        ,Estudio.ese_id,Estudio.emp_id, ese_folioverificacion,ese_curp,ese_correo,ese_nombre,Estudio.ese_transporte
                        ,ese_primerapellido,ese_segundoapellido ,emp_nombre
                        ,date_format(Estudio.ese_registro,'%d/%m/%Y') as ese_registro
                        ,ese_estatus, ana.usu_id as analista, inv.usu_id as investigador,Estudio.ese_precancelar
                        ,date_format(Estudio.ese_fechaentregacliente,'%d/%m/%Y') as ese_fechaentregacliente
                        ,ese_telefono,ese_celular,est.est_nombre ,Estudio.est_id, Estudio.mun_id,mun.mun_nombre, Estudio.cne_id, cne.cne_nombre,cne.cne_primerapellido ,cne.cne_segundoapellido ,Estudio.ese_centrocosto, e.emp_rfc,cne.cne_celular,cne.cne_correo
                        ,ese_calle,ese_numext
                        ,ese_numint,ese_colonia,ese_codpostal
                        ,date_format(Estudio.ese_fechanacimiento,'%d/%m/%Y') as ese_fechanacimiento
                        ,date_format(Estudio.ese_fechaasiginvestigador,'%d/%m/%Y') as ese_fechaasiginvestigador
                        ,date_format(Estudio.ese_fechaentregainvestigador,'%d/%m/%Y') as ese_fechaentregainvestigador
                        ,tip_nombre,tip_clave,Estudio.tip_id,Estudio.ese_tippersona
                        ,Estudio.usu_idcancela
                        ,date_format(Estudio.ese_fechacancelacion,'%d/%m/%Y') as ese_fechacancelacion
                        ,Estudio.ese_precancelar
                        ,CONCAT(cne.cne_nombre, ' ', cne.cne_primerapellido) AS cne_nombre_completo
                        ,Estudio.usu_idvalida
                        ,Estudio.cen_id,cen.cen_nombre
                        ,CONCAT(ana.usu_nombre, ' ', ana.usu_primerapellido,' ', ana.usu_segundoapellido) AS ana_nombre
                        ,CONCAT('Calle ',Estudio.ese_calle,', No. externo ',Estudio.ese_numext,', No. externo ',Estudio.ese_numext, ',  No. interno #', Estudio.ese_numint,', Colonia ', Estudio.ese_colonia) AS ese_direccion_completa
                        ,tra.tra_id,tra.tra_estatus
                        ,tra.tra_comentarioadmin
                        ,date_format(tra.tra_fechaaprobado,'%d/%m/%Y') as tra_fechaaprobado
                        ,tra.tra_solicitado,tra.tra_aprobado,tra.aprobadousu_id,tra.tra_preaprobado,tra.tra_origen,tra.tra_destino,tra.tra_comentario
                        ,date_format(tra.tra_fechainvestigador,'%d/%m/%Y') as tra_fechainvestigador
                        ,date_format(tra.tra_fechaaprobado,'%d/%m/%Y') as tra_fechaaprobado
                        ,CONCAT(tra_asigno_usu.usu_nombre, ' ', tra_asigno_usu.usu_primerapellido,' ', tra_asigno_usu.usu_segundoapellido) AS tra_asigno_usuario
                        ,Estudio.ana_id
                        ,CONCAT(tra_aprobo_usu.usu_nombre, ' ', tra_aprobo_usu.usu_primerapellido,' ', tra_aprobo_usu.usu_segundoapellido) AS usuario_aprobo_transporte
                        ,date_format(Estudio.ese_fechaasiganalista,'%d/%m/%Y') as ese_fechaasiganalista
                        ,date_format(Estudio.ese_fechaentregaanalista,'%d/%m/%Y') as ese_fechaentregaanalista
                        ,CONCAT(inv.usu_nombre, ' ', inv.usu_primerapellido,' ', inv.usu_segundoapellido) AS inv_nombre
                        ,CONCAT(usu_alta.usu_nombre, ' ', usu_alta.usu_primerapellido,' ', usu_alta.usu_segundoapellido) AS usu_alta_nombre_completo
                        ,CONCAT(usu_cancela.usu_nombre, ' ', usu_cancela.usu_primerapellido,' ', usu_cancela.usu_segundoapellido) AS usu_cancela_nombre_completo
                        ,CONCAT(usu_valida.usu_nombre, ' ', usu_valida.usu_primerapellido,' ', usu_valida.usu_segundoapellido) AS usu_valida_nombre_completo
                        ,Estudio.ese_visita
                        ,Estudio.ese_honorario as honorario_asignado
                        ")
                    ->leftjoin('Empresa','e.emp_id=Estudio.emp_id','e')
                    ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
                    ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
                    ->leftjoin('Usuario','usu_alta.usu_id=Estudio.usu_idalta','usu_alta')
                    ->leftjoin('Usuario','usu_cancela.usu_id=Estudio.usu_idcancela','usu_cancela')
                    ->leftjoin('Usuario','usu_valida.usu_id=Estudio.usu_idvalida','usu_valida')
                    ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id and tip.tip_estatus=2 ','tip')
                    ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
                    ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
                    ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
                    ->leftjoin('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
                    ->leftjoin('Usuariotipoest','ute.tip_id=Estudio.tip_id and ute.usu_id=Estudio.inv_id and ute.ute_estatus=2','ute')
                    ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.tra_estatus != -2 and  tra.investigadorusu_id = Estudio.inv_id','tra')
                    ->leftjoin('Usuario','tra_aprobo_usu.usu_id=tra.aprobadousu_id and tra.tra_estatus != -2 and  tra.investigadorusu_id = Estudio.inv_id','tra_aprobo_usu')
                    ->leftjoin('Usuario','tra_asigno_usu.usu_id=tra.asignausu_id and tra.tra_estatus != -2 and  tra.investigadorusu_id = Estudio.inv_id','tra_asigno_usu')


                    // ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','tra_usuario_aprobado')

                    ->where('Estudio.ese_id = '.$ese_id)
                    // ->order('Estudio.ese_registro DESC')
                    ->execute();


                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Ok...';
                    $answer['data']=$estudio;
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

        
        }else{
            $answer[0]=2;
            $answer['titular']='Error';
            $answer['mensaje']='Error en los parametros...';
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;    

        }

    }
}