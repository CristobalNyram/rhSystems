<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';
require "mpdf/index.php";
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");
require_once ('jpgraph/src/jpgraph_legend.inc.php');
require_once ('jpgraph/src/jpgraph_canvas.php');
require_once ('jpgraph/src/jpgraph_utils.inc.php');
require_once ('jpgraph/src/jpgraph_bar.php');
class ReporteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Reporte');
        parent::initialize();
    }

    public function estatus_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(27,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

    }
    public function estatus_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Los parámetros de búsqueda fueron:';

        $auth = $this->session->get('auth');
        if(!$rol->verificar(27,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
               
                $condicion = "(Estudio.ese_fechaentregacliente >= '{$data['ese_fechainicial']} 00:00:00' AND Estudio.ese_fechaentregacliente <= '{$data['ese_fechafinal']} 23:59:59') OR (Estudio.ese_estatus = -2 AND Estudio.ese_fechacancelacion >= '{$data['ese_fechainicial']} 00:00:00' AND Estudio.ese_fechacancelacion <= '{$data['ese_fechafinal']} 23:59:59')";
             

            //consulta incio
            $estudio=Estudio::query()
            ->columns("
                        Estudio.ese_registro,Estudio.emp_id, Estudio.ese_estatus,Estudio.ese_id,Estudio.ese_fechacancelacion,Estudio.ese_folioverificacion,
                        Estudio.ese_nombre,Estudio.ese_primerapellido,Estudio.ese_segundoapellido,
                        Estudio.ese_telefono,Estudio.ese_celular, Estudio.inv_id,
                        Estudio.ese_fechaasiginvestigador,Estudio.ese_fechaentregainvestigador,Estudio.ana_id,
                        Estudio.ese_fechaasiganalista,Estudio.ese_fechaentregacliente,
                        Estudio.mun_id,Estudio.est_id,Estudio.cne_id,Estudio.cen_id,Estudio.ver_id,Estudio.tip_id,Estudio.ese_visita,
                        Estudio.ese_puesto,
                        ver.ver_nombre,ver.ver_alias,
                        cen_nombre,
                        CONCAT(cne.cne_nombre,' ',cne.cne_primerapellido,' ',
                        cne.cne_segundoapellido ) AS cne_nombre_completo, cne.cne_puesto,
                        tra.tra_aprobado,tra.tra_solicitado,tra.tra_comentario,
                        mun.mun_nombre,
                        est.est_nombre,
                        emp.emp_nombre
                        ,Estudio.ese_honorario as honorario_asignado, tip_clave

                        ")//la parte que esta separada es la parte que son llaves foraneas
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
            ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Verificaciones','ver.ver_id=Estudio.ver_id','ver') 
            //->leftjoin('Usuariotipoest','ute.tip_id=Estudio.tip_id and ute.usu_id=Estudio.inv_id and ute.ute_estatus=2','ute')
            ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.investigadorusu_id = Estudio.inv_id and tra.tra_estatus > 0 ','tra')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->where($condicion)
            ->execute();
          //consulta fin


            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= 'Realizó una consulta de estatus a los estudios,'.$descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reportes de estatus";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
            $this->usuario = new Usuario(); 
            $this->empresa =new Empresa();
            $this->reporte =new Reporte();
    
            $this->view->estudiomodel = new Estudio();
            // $this->view->estudio = $this->estudio;
    
            $this->view->usuario = $this->usuario;
            $this->view->reporte= $this->reporte;
    
            $this->view->page=$estudio;
            $this->view->mensaje='';

            }else{
                $this->view->page=[];
                $this->view->mensaje='DEBES COLOCAR AMBAS FECHAS';

            }
            

          
        
        }
      

    }

    public function honorario_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(37,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

    }
    public function honorario_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Buscó datos de honorarios y viáticos.';


        $auth = $this->session->get('auth');
        if(!$rol->verificar(37,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $condicion='Estudio.ese_honorario IS NOT NULL AND Estudio.ese_estatus!= -2 ';
            
            if($data['ese_fechainicial'] != '')
            {
                $descripcion_bitacora=' Filtro fecha inicial: '.$data['ese_fechainicial'];
                $condicion.=" and Estudio.ese_fechaentregacliente >= '".$data['ese_fechainicial']." 00:00:00'";
            }

            if($data['ese_fechafinal'] != '')
            {
                $descripcion_bitacora=' Filtro fecha final: '.$data['ese_fechafinal'];
                $condicion.=" and Estudio.ese_fechaentregacliente <= '".$data['ese_fechafinal']." 23:59:59'";
            }
                    
            //consulta incio
            $estudio=Estudio::query()
            ->columns("Estudio.ese_estatus,Estudio.tip_id,Estudio.ese_visita, Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_primerapellido, Estudio.ese_segundoapellido, Estudio.inv_id, Estudio.ese_fechaentregacliente, tra.tra_aprobado, 
            Estudio.ese_honorario AS ute_honorario
                        ")//la parte que esta separada es la parte que son llaves foraneas
            //->leftjoin('Usuariotipoest','ute.tip_id=Estudio.tip_id and ute.usu_id=Estudio.inv_id and ute.ute_estatus=2','ute')
            ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.investigadorusu_id = Estudio.inv_id and tra.tra_estatus = 3 ','tra')
            ->where($condicion)
            ->execute();
            // error_log(print_r($estudio,true));
           /* foreach($estudio as $item){
                echo $item->ese_id.'<br>';
            }

            die();*/
            $arreglo=[];

            for ($i=0; $i < count($estudio); $i++) {
                if(count($arreglo)==0){
                    $object = new stdClass();
                    $object->inv_id = $estudio[$i]->inv_id;
                    // $object->honorario = $estudio[$i]->ute_honorario;
                    if($estudio[$i]->tip_id==4)
                    {
                        $object->honorario=$estudio[$i]->ute_honorario*$estudio[$i]->ese_visita;
                        // $arreglo[$j]->honorario=5;
                    }
                    else
                    {
                        $object->honorario =$estudio[$i]->ute_honorario;
                    }
                    if(!is_null($estudio[$i]->tra_aprobado)){
                        $object->viatico = $estudio[$i]->tra_aprobado;
                    }
                    else{
                        $object->viatico = 0;
                    }
                    array_push($arreglo,$object);
                }
                else{
                    $bandera=0;
                    for($j=0;$j<count($arreglo);$j++){
                        if($estudio[$i]->inv_id==$arreglo[$j]->inv_id){                       
                            if($estudio[$i]->tip_id==4)
                            {
                                $arreglo[$j]->honorario=$arreglo[$j]->honorario+($estudio[$i]->ute_honorario*$estudio[$i]->ese_visita);
                                // $arreglo[$j]->honorario=5;
                            }
                            else
                            {
                                $arreglo[$j]->honorario =$arreglo[$j]->honorario+$estudio[$i]->ute_honorario;
                            }
                            if(!is_null($estudio[$i]->tra_aprobado)){
                                $arreglo[$j]->viatico=$arreglo[$j]->viatico+$estudio[$i]->tra_aprobado;
                            }
                            $bandera=1;
                            break;
                        }
                    }
                    if($bandera==0){
                        $object = new stdClass();
                        $object->inv_id = $estudio[$i]->inv_id;
                        // $object->honorario = $estudio[$i]->ute_honorario;
                        if($estudio[$i]->tip_id==4)
                        {
                            $object->honorario=$estudio[$i]->ute_honorario*$estudio[$i]->ese_visita;
                            // $arreglo[$j]->honorario=5;
                        }
                        else
                        {
                            $object->honorario =$estudio[$i]->ute_honorario;
                        }

                        if(!is_null($estudio[$i]->tra_aprobado)){
                            $object->viatico = $estudio[$i]->tra_aprobado;
                        }
                        else{
                            $object->viatico = 0;
                        }
                        array_push($arreglo,$object);
                    }
                }
            }

            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reportes de honorarios/viáticos";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
        }
        $this->usuario = new Usuario(); 
        $this->empresa =new Empresa();
        // $this->reporte =new Reporte();

        $this->view->estudiomodel = new Estudio();

        $this->view->usuario = $this->usuario;
        // $this->view->reporte= $this->reporte;

        $this->view->fechainicio= $data['ese_fechainicial'];
        $this->view->fechafin= $data['ese_fechafinal'];
        $this->view->page=$arreglo;

    }

    public function enviarhonorarioAction()
    {
        $this->view->disable();
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data = $this->request->getPost();

        $fecha_ini= $data['fechaini'];
        $fecha_fin= $data['fechafin'];
        $arreglo=json_encode($data);
        $json=json_decode($arreglo,true);
        $cont= count($json['arreglo']);
        $valor=json_encode($json['arreglo'][0]['valor']);
        $entero=json_decode($valor);
        $var = $cont;
        $auth = $this->session->get('auth');

        $errores="";
        $mensaje_envio_correos_estatus="";
        $conterrores=0;

        $ini= new DateTime($fecha_ini);
        $fin= new DateTime($fecha_fin);
        $periodo=$ini->format('d/m/Y'). " AL ". $fin->format('d/m/Y');

        $fechapago=$fin->add(new DateInterval('P5D'))->format('d/m/Y');

        // include('phpqrcode/qrlib.php');
        $contador=0;
        for($i=1;$i<=$var;$i++){
            $valor=json_encode($json['arreglo'][$contador]['valor']);
            $entero=json_decode($valor);

            $usuario=Usuario::findFirstByusu_id($entero);
            $completo=$usuario->usu_nombre." ".$usuario->usu_primerapellido." ".$usuario->usu_segundoapellido;

            $condicion="Estudio.ese_honorario IS NOT NULL and Estudio.ese_estatus!= -2  and Estudio.ese_fechaentregacliente >='".$fecha_ini."  00:00:00 ' and Estudio.ese_fechaentregacliente <= '".$fecha_fin." 23:59:59' and Estudio.inv_id=".$entero;

            $estudio=Estudio::query()
            ->columns("Estudio.tip_id ,Estudio.ese_visita ,Estudio.ese_estatus, Estudio.ese_id, concat(Estudio.ese_nombre,' ', Estudio.ese_primerapellido, ' ', Estudio.ese_segundoapellido) as candidato, Estudio.inv_id, DATE_FORMAT(Estudio.ese_fechaentregacliente,'%d/%m/%Y') as fechacliente, tra.tra_aprobado,
            Estudio.ese_honorario AS ute_honorario,
             m.mun_nombre, est.est_nombre 
                        ")
            ->leftjoin("Municipio", 'm.mun_id=Estudio.mun_id', 'm')
            ->join("Estado", 'est.est_id=Estudio.est_id', 'est')
            ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.investigadorusu_id = Estudio.inv_id and tra.tra_estatus = 3 ','tra')
            ->where($condicion)
            ->execute();
  
            $tablaheadviatico="<table style='width:100%; padding: 2% 0% 0%'>
                    <thead>
                        <tr class='trowhead'>
                            <th><center>ID</center></th>
                            <th><center>NOMBRE DE CANDIDATO</center></th>
                            <th><center>ESTADO</center></th>
                            <th><center>MUNICIPIO</center></th>
                            <th><center>FECHA ENTREGA CLIENTE</center></th>
                            <th><center>PAGO VIÁTICO</center></th>
                        </tr>
                    </thead>
                    <tbody>";

            $tablaheadhonorario="<table style='width:100%; padding: 2% 0% 0%'>
                    <thead>
                        <tr class='trowhead'>
                            <th><center>ID</center></th>
                            <th><center>NOMBRE DE CANDIDATO</center></th>
                            <th><center>ESTADO</center></th>
                            <th><center>MUNICIPIO</center></th>
                            <th><center>FECHA ENTREGA CLIENTE</center></th>
                            <th><center>PAGO HONORARIO</center></th>
                        </tr>
                    </thead>
                    <tbody>";
            $tr="<tr>
                        <td><center>#id#</center></td>
                        <td><center>#nombre#</center></td>
                        <td><center>#estado#</center></td>
                        <td><center>#municipio#</center></td>
                        <td><center>#fecha#</center></td>
                        <td><center>#monto#</center></td>
                    </tr>";                    

            $tablatrviatico='';
            $tablatrhonorario='';
            $sumaviatico=0;
            $sumahonorario=0;
            for ($j=0; $j < count($estudio); $j++) {
                $trforviatico=$tr;
                $trforviatico=str_replace("#id#",$estudio[$j]->ese_id,$trforviatico);
                $trforviatico=str_replace("#nombre#",$estudio[$j]->candidato,$trforviatico);
                $trforviatico=str_replace("#estado#",$estudio[$j]->est_nombre,$trforviatico);
                $trforviatico=str_replace("#municipio#",$estudio[$j]->mun_nombre,$trforviatico);
                $trforviatico=str_replace("#fecha#",$estudio[$j]->fechacliente,$trforviatico);
                $trforviatico=str_replace("#monto#",number_format($estudio[$j]->tra_aprobado,2),$trforviatico);
                $tablatrviatico=$tablatrviatico.$trforviatico;
                $sumaviatico+=$estudio[$j]->tra_aprobado;

                $trforhonorario=$tr;
                $trforhonorario=str_replace("#id#",$estudio[$j]->ese_id,$trforhonorario);
                $trforhonorario=str_replace("#nombre#",$estudio[$j]->candidato,$trforhonorario);
                $trforhonorario=str_replace("#estado#",$estudio[$j]->est_nombre,$trforhonorario);
                $trforhonorario=str_replace("#municipio#",$estudio[$j]->mun_nombre,$trforhonorario);
                $trforhonorario=str_replace("#fecha#",$estudio[$j]->fechacliente,$trforhonorario);
                $trforhonorario=str_replace("#monto#",number_format($estudio[$j]->ute_honorario*$estudio[$j]->ese_visita,2),$trforhonorario);
                $tablatrhonorario=$tablatrhonorario.$trforhonorario;

                if($estudio[$j]->tip_id==4)
                {
                    $sumahonorario+=$estudio[$j]->ute_honorario*$estudio[$j]->ese_visita;
                }
                else
                {
                    $sumahonorario+=$estudio[$j]->ute_honorario;
                }
                

                if($j==count($estudio)-1){
                    $trforviatico=$tr;
                    $trforviatico=str_replace("#id#","",$trforviatico);
                    $trforviatico=str_replace("#nombre#","",$trforviatico);
                    $trforviatico=str_replace("#estado#","",$trforviatico);
                    $trforviatico=str_replace("#municipio#","",$trforviatico);
                    $trforviatico=str_replace("#fecha#","<b>TOTAL</b>",$trforviatico);
                    $trforviatico=str_replace("#monto#","<b>".number_format($sumaviatico,2)."</b>",$trforviatico);
                    $tablatrviatico=$tablatrviatico.$trforviatico;

                    $trforhonorario=$tr;
                    $trforhonorario=str_replace("#id#","",$trforhonorario);
                    $trforhonorario=str_replace("#nombre#","",$trforhonorario);
                    $trforhonorario=str_replace("#estado#","",$trforhonorario);
                    $trforhonorario=str_replace("#municipio#","",$trforhonorario);
                    $trforhonorario=str_replace("#fecha#","<b>TOTAL</b>",$trforhonorario);
                    $trforhonorario=str_replace("#monto#","<b>".number_format($sumahonorario,2)."</b>",$trforhonorario);
                    $tablatrhonorario=$tablatrhonorario.$trforhonorario;
                }
            }
            
            $tablafin="</tbody></table>";

            $tablaviatico=$tablaheadviatico.$tablatrviatico.$tablafin;
            $tablahonorario=$tablaheadhonorario.$tablatrhonorario.$tablafin;

            $mpdf = new mPDF('L',[280,215]);
            $mpdf->autoMarginPadding = 5;
            $mpdf->defaultfooterline = 0;
            $mpdf->defaultheaderline = 0;
            $reporte= new PdfReporte();
            $reporteheader= new PdfReporte();
            $html=$reporte->honorario;  
            
            $HeaderHtml=$reporteheader->honorarioheader;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            $html=str_replace("#tablaviatico#",$tablaviatico,$html);
            $html=str_replace("#tablahonorario#",$tablahonorario,$html);
            $html=str_replace("#colaborador#",$completo,$html);
            $html=str_replace("#periodo#",$periodo,$html);
            $html=str_replace("#fechapago#",$fechapago,$html);
            $mpdf->SetHTMLHeader($var_image_header,'O');
            //footer  
            $mpdf->SetHTMLFooter('
            <table width="100%">
                <tr>
                    <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
                </tr>
            </table>');

            $mpdf->SetTitle('REPORTE HONORARIOS');
            $mpdf->SetAuthor('SIPS | SADI');
            $mpdf->WriteHTML($html);

            $nombre=$completo.".pdf";
            $mpdf->Output("reporte/honorarios/".$nombre,'F');
            $enviado=0;
            $mensaje="Buen día: <br><br>Por medio del presente envío desglose de la semana del ".$periodo. " que corresponde al pago del ".$fechapago.".<br><br>Quedo atenta<br>Saludos!";
            if($enviado==0){


                // ENVIO DE CORREOS INICIO VALIDACION
                $configuracion_obj=new Configuracion();
                $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
                if($enviar_correo_estatus==1){
                    $correo= new ServicioCorreo();
                    if($correo->enviarhonorario($nombre, "DESGLOSE SEMANA DEL ".$periodo, $mensaje, $completo, $usuario->usu_correo, $auth['id'])==1)
                    {
                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Envió reporte de honorario a: ".$completo;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=0;
                        $databit['bit_modulo']="Correo honorario";
                        $bitacora->NuevoRegistro($databit);
                        $enviado++;
                    }
                    else
                    {
                        $errores.=" id: ".$entero.",";
                        $conterrores++;
                    }   
                    
                }else{
                    $mensaje_envio_correos_estatus="el envío de correos esta desactivado. Comuníquese con un administrador";
                }
                 // ENVIO DE CORREOS FIN VALIDACION

               
            }

            $contador++;
        }

        $answer[0]=1;
        $answer[1]="";
        $answer[2]=0;
        if($errores!=""){
            if($conterrores==$cont)
            {
                $answer[0]=-1;
            }
            $answer[2]=1;
            $answer[1]='No se pudieron enviar todos los correos, hubo un error al enviar los siguientes folios de investigador: '.$errores.".";
            
        }else{
            $answer[2]=2;
            if(trim($mensaje_envio_correos_estatus)!=""){
                $answer[2]=-1;

                $answer[1]=$mensaje_envio_correos_estatus;

            }else{
                $answer[1]='Todos los correos fueron enviados exitosamente';

            }
        }
        
        // $answer=array();
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function formatoesesAction($id_=0,$correo=0)
    {
        try {
        
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];

            if($id==0) //el número en la funcion es el correspondiente a la bdd
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $rol = new Rol();
            $auth = $this->session->get('auth');

            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
            }
            
          

            date_default_timezone_set('america/mexico_city');
            // $host=$_SERVER["HTTP_HOST"];
            $host="https://sadisips.com/";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
            $url=$host.$carpeta."consulta/validaqr/";

            $estudio=Estudio::findFirstByese_id($id);
            

            if(!$estudio) //si no existe el estudio
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->columns(array('emp_nombre','emp_estatus','emp_logo'))
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            $datoscomprobatorios=new Builder();
                $datoscomprobatorios=$datoscomprobatorios
                // ->columns()
                ->addFrom('Datocomprobatorio','d')
                ->where('cop_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datoscomprobatorios)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos comprobatorios cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datocomprobatorio= $datoscomprobatorios[0];

            $datosescolares=new Builder();
                $datosescolares=$datosescolares
                // ->columns()
                ->addFrom('Datoescolar','d')
                ->where('dae_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datosescolares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos escolares cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datoescolar= $datosescolares[0];

            //seccion C
            $antecedentessociales=new Builder();
                $antecedentessociales=$antecedentessociales
                // ->columns()
                ->addFrom('Antecedentesocial','d')
                ->where('ans_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($antecedentessociales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de antecedentes sociales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $antecedentesocial= $antecedentessociales[0];

            //seccion D
            $estadosdesalud=new Builder();
                $estadosdesalud=$estadosdesalud
                // ->columns()
                ->addFrom('Estadosalud','d')
                ->where('ess_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($estadosdesalud)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de estado de salud cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $estadosalud= $estadosdesalud[0];

            //seccion E
            $datogrupofamiliares=new Builder();
                $datogrupofamiliares=$datogrupofamiliares
                // ->columns()
                ->addFrom('Datogrupofamiliar','d')
                ->where('dgf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datogrupofamiliares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datogrupofamiliar= $datogrupofamiliares[0];

            //seccion F
            $antecedenteslaboralesfamiliar=new Builder();
                $antecedenteslaboralesfamiliar=$antecedenteslaboralesfamiliar
                // ->columns()
                ->addFrom('Antecedentegrupofamiliar','d')
                ->where('agf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($antecedenteslaboralesfamiliar)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de antecedentes laborales del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $antecedentelaboralfamiliar= $antecedenteslaboralesfamiliar[0];

            //seccion G
            $situacioneseconomicas=new Builder();
                $situacioneseconomicas=$situacioneseconomicas
                // ->columns()
                ->addFrom('Situacioneconomica','d')
                ->where('sie_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($situacioneseconomicas)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de situación económica cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $situacioneconomica= $situacioneseconomicas[0];

            //seccion H
            $bienesinmuebles=new Builder();
                $bienesinmuebles=$bienesinmuebles
                ->addFrom('Bieninmueble','d')
                ->where('bie_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($bienesinmuebles)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de bienes inmuebles cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $bieninmueble= $bienesinmuebles[0];

            //seccion I
            $seccionespersonales=new Builder();
                $seccionespersonales=$seccionespersonales
                ->addFrom('Seccionpersonal','d')
                ->where('sep_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionespersonales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias personales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionpersonal= $seccionespersonales[0];

            //seccion J
            $seccioneslaborales=new Builder();
                $seccioneslaborales=$seccioneslaborales
                ->addFrom('Seccionlaboral','d')
                ->where('sel_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            //datos finales 
            $seccionesdatosfinales=new Builder();
                $seccionesdatosfinales=$seccionesdatosfinales
                ->addFrom('Datofinal','d')
                ->where('daf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionesdatosfinales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos finales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $secciondatofinal= $seccionesdatosfinales[0];

            if($estudio->ese_estatus==7){
                include('phpqrcode/qrlib.php');

                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'temp/';

                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);

                //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'qr.png';

                //Parametros de Configuración
                $tamaño = 6; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 1; //Tamaño en blanco
                $contenido = $url.$id; //Texto

                //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            }else{
                $filename='iniciador.jpg';
            }

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

            // $mpdf->defaultheaderline = 0;
            // $mpdf->autoMarginPadding = 5;
            // $mpdf->defaultfooterline = 0;
            // $mpdf->defaultheaderline = 0;
            // $mpdf->setAutoTopMargin= 5000;

            $reporte= new PdfReporte();
            $reporteheader= new PdfReporte();
            $HeaderHtml=$reporteheader->eseheaderprimera;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            $var_image_header=str_replace("#logoempresa#",basename('images/logoempresa/'.$empresa->emp_logo),$var_image_header);
            $html='';
            $html=$reporte->eseportada;
            $mpdf->SetHTMLHeader($var_image_header,'O');

            $html=str_replace("#emp_nombre#",trim($empresa->emp_nombre),$html);
            $html=str_replace("#ese_nombre#",trim($estudio->ese_nombre). " ". trim($estudio->ese_primerapellido). " ". trim($estudio->ese_segundoapellido),$html);
            $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
            $html=str_replace("#ese_puesto#",trim($estudio->ese_puesto),$html);

            $datofinal= new Datofinal();

            $html=str_replace("#daf_calificacion#",trim($datofinal->getCalificacion($secciondatofinal->cal_id)),$html);
            $html=str_replace("#daf_notafinal#",trim($secciondatofinal->daf_notafinal),$html);

            ($datocomprobatorio->cop_calificacion == '1') ? $html=str_replace("#cop_calificacioni#",'X',$html) :  $html=str_replace("#cop_calificacioni#",'',$html);
            ($datocomprobatorio->cop_calificacion == '2') ? $html=str_replace("#cop_calificacionp#",'X',$html) :  $html=str_replace("#cop_calificacionp#",'',$html);
            ($datocomprobatorio->cop_calificacion == '3') ? $html=str_replace("#cop_calificaciona#",'X',$html) :  $html=str_replace("#cop_calificaciona#",'',$html);

            ($datoescolar->dae_calificacion == '1') ? $html=str_replace("#dae_calificacioni#",'X',$html) :  $html=str_replace("#dae_calificacioni#",'',$html);
            ($datoescolar->dae_calificacion == '2') ? $html=str_replace("#dae_calificacionp#",'X',$html) :  $html=str_replace("#dae_calificacionp#",'',$html);
            ($datoescolar->dae_calificacion == '3') ? $html=str_replace("#dae_calificaciona#",'X',$html) :  $html=str_replace("#dae_calificaciona#",'',$html);


            ($antecedentesocial->ans_calificacion == '1') ? $html=str_replace("#ans_calificacioni#",'X',$html) :  $html=str_replace("#ans_calificacioni#",'',$html);
            ($antecedentesocial->ans_calificacion == '2') ? $html=str_replace("#ans_calificacionp#",'X',$html) :  $html=str_replace("#ans_calificacionp#",'',$html);
            ($antecedentesocial->ans_calificacion == '3') ? $html=str_replace("#ans_calificaciona#",'X',$html) :  $html=str_replace("#ans_calificaciona#",'',$html);

            ($estadosalud->ess_calificacion == '1') ? $html=str_replace("#ess_calificacioni#",'X',$html) :  $html=str_replace("#ess_calificacioni#",'',$html);
            ($estadosalud->ess_calificacion == '2') ? $html=str_replace("#ess_calificacionp#",'X',$html) :  $html=str_replace("#ess_calificacionp#",'',$html);
            ($estadosalud->ess_calificacion == '3') ? $html=str_replace("#ess_calificaciona#",'X',$html) :  $html=str_replace("#ess_calificaciona#",'',$html);

            ($datogrupofamiliar->dgf_calificacion == '1') ? $html=str_replace("#dgf_calificacioni#",'X',$html) :  $html=str_replace("#dgf_calificacioni#",'',$html);
            ($datogrupofamiliar->dgf_calificacion == '2') ? $html=str_replace("#dgf_calificacionp#",'X',$html) :  $html=str_replace("#dgf_calificacionp#",'',$html);
            ($datogrupofamiliar->dgf_calificacion == '3') ? $html=str_replace("#dgf_calificaciona#",'X',$html) :  $html=str_replace("#dgf_calificaciona#",'',$html);

            ($antecedentelaboralfamiliar->agf_calificacion == '1') ? $html=str_replace("#agf_calificacioni#",'X',$html) :  $html=str_replace("#agf_calificacioni#",'',$html);
            ($antecedentelaboralfamiliar->agf_calificacion == '2') ? $html=str_replace("#agf_calificacionp#",'X',$html) :  $html=str_replace("#agf_calificacionp#",'',$html);
            ($antecedentelaboralfamiliar->agf_calificacion == '3') ? $html=str_replace("#agf_calificaciona#",'X',$html) :  $html=str_replace("#agf_calificaciona#",'',$html);

            ($situacioneconomica->sie_calificacion == '1') ? $html=str_replace("#sie_calificacioni#",'X',$html) :  $html=str_replace("#sie_calificacioni#",'',$html);
            ($situacioneconomica->sie_calificacion == '2') ? $html=str_replace("#sie_calificacionp#",'X',$html) :  $html=str_replace("#sie_calificacionp#",'',$html);
            ($situacioneconomica->sie_calificacion == '3') ? $html=str_replace("#sie_calificaciona#",'X',$html) :  $html=str_replace("#sie_calificaciona#",'',$html);

            ($bieninmueble->bie_calificacion == '1') ? $html=str_replace("#bie_calificacioni#",'X',$html) :  $html=str_replace("#bie_calificacioni#",'',$html);
            ($bieninmueble->bie_calificacion == '2') ? $html=str_replace("#bie_calificacionp#",'X',$html) :  $html=str_replace("#bie_calificacionp#",'',$html);
            ($bieninmueble->bie_calificacion == '3') ? $html=str_replace("#bie_calificaciona#",'X',$html) :  $html=str_replace("#bie_calificaciona#",'',$html);

            ($seccionpersonal->sep_calificacion == '1') ? $html=str_replace("#sep_calificacioni#",'X',$html) :  $html=str_replace("#sep_calificacioni#",'',$html);
            ($seccionpersonal->sep_calificacion == '2') ? $html=str_replace("#sep_calificacionp#",'X',$html) :  $html=str_replace("#sep_calificacionp#",'',$html);
            ($seccionpersonal->sep_calificacion == '3') ? $html=str_replace("#sep_calificaciona#",'X',$html) :  $html=str_replace("#sep_calificaciona#",'',$html);

            ($seccionlaboral->sel_calificacion == '1') ? $html=str_replace("#sel_calificacioni#",'X',$html) :  $html=str_replace("#sel_calificacioni#",'',$html);
            ($seccionlaboral->sel_calificacion == '2') ? $html=str_replace("#sel_calificacionp#",'X',$html) :  $html=str_replace("#sel_calificacionp#",'',$html);
            ($seccionlaboral->sel_calificacion == '3') ? $html=str_replace("#sel_calificaciona#",'X',$html) :  $html=str_replace("#sel_calificaciona#",'',$html);
            $mpdf->WriteHTML($html);

            $reporteheader= new PdfReporte();

            $HeaderHtml=$reporteheader->eseheadersiguientes;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            
            $mpdf->SetHTMLHeader($var_image_header,'O');

            //sección A
            $secciondatospersonales= new Datopersonal();
            $html=$secciondatospersonales->formatoeses($estudio, $datocomprobatorio);
            $mpdf->AddPage();
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="33%" style="text-align: right;">{PAGENO}-{nbpg}</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);

            //sección B
            $secciondatosescolares= new Datoescolar();
            $html=$secciondatosescolares->formatoeses($datoescolar);
            $mpdf->WriteHTML($html);

            //sección C
            $seccionantecedentesocial= new Antecedentesocial();
            $html=$seccionantecedentesocial->formatoeses($antecedentesocial);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección D
            $seccionestadosalud= new Estadosalud();
            $html=$seccionestadosalud->formatoeses($estadosalud);
            $mpdf->WriteHTML($html);

            //sección E
            $datogrupofamiliardetalles_vive_con=new Builder();
            $datogrupofamiliardetalles_vive_con=$datogrupofamiliardetalles_vive_con
                // ->columns()
                ->addFrom('Datogrupofamiliardetalles','d')
                ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id.' and dgd_viveusted = 1 ')
                ->orderBy('dgd_id')
                ->getQuery()
                ->execute();
            $datogrupofamiliardetalles_NO_vive_con=new Builder();
            $datogrupofamiliardetalles_NO_vive_con=$datogrupofamiliardetalles_NO_vive_con
                // ->columns()
                ->addFrom('Datogrupofamiliardetalles','d')
                ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id.' and dgd_viveusted = 0 ')
                ->orderBy('dgd_id')
                ->getQuery()
                ->execute();
            $secciondatogrupofamiliar= new Datogrupofamiliar();
            $html=$secciondatogrupofamiliar->formatoeses($datogrupofamiliar,$datogrupofamiliardetalles_vive_con,$datogrupofamiliardetalles_NO_vive_con);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
        
            //sección F
            $antecedentegrupofamiliardetalles=new Builder();
                $antecedentegrupofamiliardetalles=$antecedentegrupofamiliardetalles
                // ->columns()
                ->addFrom('Antecedentegrupofamiliardetalles','d')
                ->where('agd_estatus=2 and agf_id='.$antecedentelaboralfamiliar->agf_id)
                ->orderBy('agd_id')
                ->getQuery()
                ->execute();
            $seccionantecedentegrupofamiliar= new Antecedentegrupofamiliar();
            $html=$seccionantecedentegrupofamiliar->formatoeses($antecedentelaboralfamiliar,$antecedentegrupofamiliardetalles);
            $mpdf->WriteHTML($html);

            //sección G
            $situacioneconomicaingresos=new Builder();
                $situacioneconomicaingresos=$situacioneconomicaingresos
                ->addFrom('Situacioneconomicaingresos','d')
                ->where('sei_estatus=2 and sie_id='.$situacioneconomica->sie_id)
                ->orderBy('sei_id')
                ->getQuery()
                ->execute();

            $situacioneconomicacredito=new Builder();
                $situacioneconomicacredito=$situacioneconomicacredito
                ->addFrom('Situacioneconomicacredito','d')
                ->where('sec_estatus=2 and sie_id='.$situacioneconomica->sie_id)
                ->orderBy('sec_id')
                ->getQuery()
                ->execute();

            $seccionsituacioneconomica= new Situacioneconomica();
            $html=$seccionsituacioneconomica->formatoeses($situacioneconomica, $situacioneconomicaingresos, $situacioneconomicacredito);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección H
            $bieninmuebledetalles=new Builder();
                $bieninmuebledetalles=$bieninmuebledetalles
                ->addFrom('Bieninmuebledetalles','d')
                ->where('bid_estatus=2 and bie_id='.$bieninmueble->bie_id)
                ->orderBy('bid_id')
                ->getQuery()
                ->execute();
            $bieninmueble_automovil=new Builder();
                $bieninmueble_automovil=$bieninmueble_automovil
                ->addFrom('Automovil','a')
                ->where('aut_estatus=2 and bie_id='.$bieninmueble->bie_id)
                ->orderBy('aut_id')
                ->getQuery()
                ->execute();
            $seccionbienesinmuebles= new Bieninmueble();
            $html=$seccionbienesinmuebles->formatoeses($bieninmueble, $bieninmuebledetalles,$bieninmueble_automovil);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección I
            $referenciapersonal=new Builder();
                $referenciapersonal=$referenciapersonal
                ->addFrom('Referenciapersonal','d')
                ->where('rep_estatus=2 and sep_id='.$seccionpersonal->sep_id)
                ->orderBy('rep_id')
                ->getQuery()
                ->execute();

            $referenciavecinal=new Builder();
                $referenciavecinal=$referenciavecinal
                ->addFrom('Referenciavecinal','d')
                ->where('rev_estatus=2 and sep_id='.$seccionpersonal->sep_id)
                ->orderBy('rev_id')
                ->getQuery()
                ->execute();

            $modelseccionpersonal= new Seccionpersonal();
            $html=$modelseccionpersonal->formatoeses($seccionpersonal, $referenciapersonal);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
            $html=$modelseccionpersonal->formatoesesvecinal($referenciavecinal);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección J
            $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','d')
                ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('rel_orden')
                ->getQuery()
                ->execute();
    
            $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','d')
                ->where('per_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('per_id')
                ->getQuery()
                ->execute();

            //empleos ocultos 
            $empleooculto=new Builder();
            $empleooculto=$empleooculto
            ->addFrom('Empleooculto','epl')
            ->where('epl_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('epl_id')
            ->getQuery()
            ->execute();    

            $modelseccionlaboral = new Seccionlaboral();
            $html=$modelseccionlaboral->formatoeses();
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            $detalles=count($referencialaboral);
            for ($i=0; $i < count($referencialaboral); $i++){ 
                
                if($i==0){
                    $html=$modelseccionlaboral->formatoesesreferenciaslaborales($referencialaboral[$i],0); //0 es último empleo
                    $mpdf->WriteHTML($html);
                }else{
                    $html=$modelseccionlaboral->formatoesesreferenciaslaborales($referencialaboral[$i],1); //1 es para anteriores empleos
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($html);
                }
            }
            $html=$modelseccionlaboral->formatoesesperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto);
            $mpdf->WriteHTML($html);

            //seccion de graficos inicio
            $modelgraficos= new Grafico();
            if($estudio->ese_estatus==7){
                $fecha_fin= $estudio->ese_fechaentregacliente;
                $fin= new DateTime($fecha_fin);
                $entrega=$fin->format('d-m-Y');
            }else{
                $filename='iniciador.jpg';
                $entrega='';
            }
            $html=$modelgraficos->formatoeses($id, $entrega, $filename);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
            //seccion de graficos fin

            //seccion de anexos inicio
            $modelanexos= new Anexo();
            $condicion_anexos="
                    (
                    arc_estatus=2 and ese_id=$id and arc_reporte=1 
                        and 
                        ( Archivo.cat_id!=2  or  Archivo.cat_id!=3 or Archivo.cat_id!=4 or Archivo.cat_id!=5  or Archivo.cat_id!=6 )
                    ) or (
                        arc_estatus=2 and ese_id=$id 
                        and 
                        (Archivo.cat_id=7 or Archivo.cat_id=8 )
                    )
                    ";
    
                $anexos=Archivo::query()
                ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
                ->where($condicion_anexos)
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->orderBy('cat_prioridad')
                ->execute();
    
            if(count($anexos)>0){   
                    $html=$modelanexos->formatoeses($ese_id=$id,$anexos);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            //inicio de sección de referencias laborales
            $anexosreferenciastotal=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where("arc_estatus=2 and cat.cat_id=31 and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();

            if(count($anexosreferenciastotal)>0){
                $modelanexosreferencias= new Anexo();
                $html=$modelanexosreferencias->formatoesesreferenciascabecera();
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }

            $modelanexosreferencias= new Anexo();
            $condicion_anexosreferencias=
            "arc_estatus=2 and cat.cat_id=31 and arc_nombre not like '%.pdf' and ese_id=$id";
    
            $anexosreferencias=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where($condicion_anexosreferencias)
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();
    
            if(count($anexosreferencias)>0){   
                    $html=$modelanexosreferencias->formatoesesreferencias($ese_id=$id,$anexosreferencias);
                    // $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            $anexoreferenciacorreo=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=31 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexoreferenciacorreo)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexoreferencias;

                $mpdf->WriteHTML($html);
                
                if(count($anexoreferenciacorreo)==1){
                    $coorx=60;
                    $coory=-1;
                    $tamaniox=95;
                    $tamanioy=120;
                    if($mpdf->y>=160){
                        $mpdf->AddPage();
                        $tamaniox=180;
                        $tamanioy=227;
                        $coorx=-1;
                        $coory=-1;
                    }
                    $mpdf->SetImportUse();
                    $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[0]->arc_nombre);
                    $import_page = $mpdf->ImportPage($pagecount);
                    $mpdf->UseTemplate($import_page,$coorx,$coory,$tamaniox,$tamanioy);
                }else{
                    $mpdf->SetImportUse();
                    $bandera=1;
                    for($i=0; $i<count($anexoreferenciacorreo); $i++){
                        if($mpdf->y>=160){
                            $mpdf->AddPage();
                        }
                        $coorx=-1;
                        if($i % 2 != 0){
                            $coorx=110;
                        }
                        $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[$i]->arc_nombre);
                        $import_page = $mpdf->ImportPage($pagecount);
                        $mpdf->UseTemplate($import_page,$coorx,-1, 95,120);
                        if($bandera==2){
                            $mpdf->y= $mpdf->y + 120;
                            $bandera=0;
                        }
                        $bandera++;
                    }
                }
            }
            //fin de sección de referencias laborales

            $anexosemanacotizada=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=15 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexosemanacotizada)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexosemanacotizada;

                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
                
                $mpdf->SetImportUse(); // only with mPDF <8.0

                $mpdf->Thumbnail("archivos/".$anexosemanacotizada[0]->arc_nombre, 2, 5);
            }

            //inicio de adjutar anexo playeritees
            $anexoplayeritees=Archivo::query()
            ->columns('arc_nombre')
            ->where("arc_estatus=2 and cat.cat_id=27 and arc_nombre like '%.pdf' and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->execute();
            if(count($anexoplayeritees)>0){
                $mpdf->AddPage();
                $mpdf->SetImportUse(); // only with mPDF <8.0
                $mpdf->Thumbnail("archivos/".$anexoplayeritees[0]->arc_nombre, 1);
            }
            //seccion de anexos fin
            if($estudio->ese_estatus==7){
                unlink($dir.basename($filename));
            }
            
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un ESE con ID: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato ESES";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            if($correo==1){
                $nombre='Estudio'.$id.'.pdf';
                $mpdf->Output('reporte/estudios/'.$nombre,'F');
                // $mpdf->Output($nombre,'I');
                return $nombre;
            }else{
                $mpdf->SetTitle("Estudio ESE ".$id);
                $mpdf->Output('Estudio'.$id.'.pdf','I');
            }
        
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

    public function formatogabtubosAction($id_=0, $correo=0)
    {
        try {
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];
            if($id==0) //el número en la funcion es el correspondiente a la bdd
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $rol = new Rol();
            $auth = $this->session->get('auth');
            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
            }
            date_default_timezone_set('america/mexico_city');
            // $host=$_SERVER["HTTP_HOST"];
            $host="https://sadisips.com/";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
            $url=$host.$carpeta."consulta/validaqr/";

            $estudio=Estudio::findFirstByese_id($id);
            

            if(!$estudio) //si no existe el estudio
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->columns(array('emp_nombre','emp_estatus','emp_logo'))
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            $datoscomprobatorios=new Builder();
                $datoscomprobatorios=$datoscomprobatorios
                // ->columns()
                ->addFrom('Datocomprobatorio','d')
                ->where('cop_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datoscomprobatorios)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos comprobatorios cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datocomprobatorio= $datoscomprobatorios[0];

            $datosescolares=new Builder();
                $datosescolares=$datosescolares
                // ->columns()
                ->addFrom('Datoescolar','d')
                ->where('dae_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datosescolares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos escolares cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datoescolar= $datosescolares[0];

            //seccion C
            $datogrupofamiliares=new Builder();
                $datogrupofamiliares=$datogrupofamiliares
                // ->columns()
                ->addFrom('Datogrupofamiliar','d')
                ->where('dgf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datogrupofamiliares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datogrupofamiliar= $datogrupofamiliares[0];

            //seccion I
            $seccionespersonales=new Builder();
                $seccionespersonales=$seccionespersonales
                ->addFrom('Seccionpersonal','d')
                ->where('sep_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionespersonales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias personales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionpersonal= $seccionespersonales[0];

            //seccion J
            $seccioneslaborales=new Builder();
                $seccioneslaborales=$seccioneslaborales
                ->addFrom('Seccionlaboral','d')
                ->where('sel_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            //datos finales 
            $seccionesdatosfinales=new Builder();
                $seccionesdatosfinales=$seccionesdatosfinales
                ->addFrom('Datofinal','d')
                ->where('daf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionesdatosfinales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos finales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $secciondatofinal= $seccionesdatosfinales[0];

            if($estudio->ese_estatus==7){
                include('phpqrcode/qrlib.php');

                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'temp/';

                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);

                //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'qr.png';

                //Parametros de Configuración
                $tamaño = 6; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 1; //Tamaño en blanco
                $contenido = $url.$id; //Texto

                //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            }else{
                $filename='iniciador.jpg';
            }

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

            $reporte= new PdfReporteGabineteTubos();
            $reporteheader= new PdfReporteGabineteTubos();
            $HeaderHtml=$reporteheader->eseheaderprimera;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            $var_image_header=str_replace("#logoempresa#",basename('images/logoempresa/'.$empresa->emp_logo),$var_image_header);
            $html=$reporte->eseportada;
            $mpdf->SetHTMLHeader($var_image_header,'O');

            $html=str_replace("#emp_nombre#",trim($empresa->emp_nombre),$html);
            $html=str_replace("#ese_nombre#",trim($estudio->ese_nombre). " ". trim($estudio->ese_primerapellido). " ". trim($estudio->ese_segundoapellido),$html);
            $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
            $html=str_replace("#ese_puesto#",trim($estudio->ese_puesto),$html);

            $datofinal= new Datofinal();

            $html=str_replace("#daf_calificacion#",trim($datofinal->getCalificacion($secciondatofinal->cal_id)),$html);
            $html=str_replace("#daf_notafinal#",trim($secciondatofinal->daf_notafinal),$html);

            ($datocomprobatorio->cop_calificacion == '1') ? $html=str_replace("#cop_calificacioni#",'X',$html) :  $html=str_replace("#cop_calificacioni#",'',$html);
            ($datocomprobatorio->cop_calificacion == '2') ? $html=str_replace("#cop_calificacionp#",'X',$html) :  $html=str_replace("#cop_calificacionp#",'',$html);
            ($datocomprobatorio->cop_calificacion == '3') ? $html=str_replace("#cop_calificaciona#",'X',$html) :  $html=str_replace("#cop_calificaciona#",'',$html);

            ($datoescolar->dae_calificacion == '1') ? $html=str_replace("#dae_calificacioni#",'X',$html) :  $html=str_replace("#dae_calificacioni#",'',$html);
            ($datoescolar->dae_calificacion == '2') ? $html=str_replace("#dae_calificacionp#",'X',$html) :  $html=str_replace("#dae_calificacionp#",'',$html);
            ($datoescolar->dae_calificacion == '3') ? $html=str_replace("#dae_calificaciona#",'X',$html) :  $html=str_replace("#dae_calificaciona#",'',$html);


            ($datogrupofamiliar->dgf_calificacion == '1') ? $html=str_replace("#dgf_calificacioni#",'X',$html) :  $html=str_replace("#dgf_calificacioni#",'',$html);
            ($datogrupofamiliar->dgf_calificacion == '2') ? $html=str_replace("#dgf_calificacionp#",'X',$html) :  $html=str_replace("#dgf_calificacionp#",'',$html);
            ($datogrupofamiliar->dgf_calificacion == '3') ? $html=str_replace("#dgf_calificaciona#",'X',$html) :  $html=str_replace("#dgf_calificaciona#",'',$html);

            ($seccionpersonal->sep_calificacion == '1') ? $html=str_replace("#sep_calificacioni#",'X',$html) :  $html=str_replace("#sep_calificacioni#",'',$html);
            ($seccionpersonal->sep_calificacion == '2') ? $html=str_replace("#sep_calificacionp#",'X',$html) :  $html=str_replace("#sep_calificacionp#",'',$html);
            ($seccionpersonal->sep_calificacion == '3') ? $html=str_replace("#sep_calificaciona#",'X',$html) :  $html=str_replace("#sep_calificaciona#",'',$html);

            ($seccionlaboral->sel_calificacion == '1') ? $html=str_replace("#sel_calificacioni#",'X',$html) :  $html=str_replace("#sel_calificacioni#",'',$html);
            ($seccionlaboral->sel_calificacion == '2') ? $html=str_replace("#sel_calificacionp#",'X',$html) :  $html=str_replace("#sel_calificacionp#",'',$html);
            ($seccionlaboral->sel_calificacion == '3') ? $html=str_replace("#sel_calificaciona#",'X',$html) :  $html=str_replace("#sel_calificaciona#",'',$html);

            if($estudio->ese_estatus==7){
                $fecha_fin= $estudio->ese_fechaentregacliente;
                $fin= new DateTime($fecha_fin);
                $entrega=$fin->format('d-m-Y');
            }else{
                // $filename='iniciador.jpg';
                $entrega='';
            }

            $html=str_replace("#firma#",basename('images/firmas/firma.jpg'),$html);
            $html=str_replace("#qr#",basename('temp/'.$filename),$html);
            
            $html=str_replace("#folioqr#",$id,$html);
            $html=str_replace("#fechaqr#",$entrega,$html);

            $mpdf->WriteHTML($html);

            $reporteheader= new PdfReporteGabineteTubos();

            $HeaderHtml=$reporteheader->eseheadersiguientes;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            
            $mpdf->SetHTMLHeader($var_image_header,'O');

            //sección A
            $secciondatospersonales= new Datopersonal();
            $html=$secciondatospersonales->formatogabtubos($estudio, $datocomprobatorio);
            $mpdf->AddPage();
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="33%" style="text-align: right;">{PAGENO}-{nbpg}</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);

            //sección B
            $secciondatosescolares= new Datoescolar();
            $html=$secciondatosescolares->formatogabtubos($datoescolar);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección E
            $datogrupofamiliardetalles_vive_con=new Builder();
            $datogrupofamiliardetalles_vive_con=$datogrupofamiliardetalles_vive_con
                // ->columns()
                ->addFrom('Datogrupofamiliardetalles','d')
                ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id.' and dgd_viveusted=1')
                ->orderBy('dgd_id')
                ->getQuery()
                ->execute();
            $datogrupofamiliardetalles_NO_vive_con=new Builder();
            $datogrupofamiliardetalles_NO_vive_con=$datogrupofamiliardetalles_NO_vive_con
                    // ->columns()
                    ->addFrom('Datogrupofamiliardetalles','d')
                    ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id.'  and dgd_viveusted=0')
                    ->orderBy('dgd_id')
                    ->getQuery()
                    ->execute();

            //emeplos ocultos
            $empleooculto=new Builder();
            $empleooculto=$empleooculto
            ->addFrom('Empleooculto','epl')
            ->where('epl_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('epl_id')
            ->getQuery()
            ->execute();    
            
            $secciondatogrupofamiliar= new Datogrupofamiliar();
            $html=$secciondatogrupofamiliar->formatogabtubos($datogrupofamiliar,$datogrupofamiliardetalles_vive_con,$datogrupofamiliardetalles_NO_vive_con);
            // $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección I
            $referenciapersonal=new Builder();
                $referenciapersonal=$referenciapersonal
                ->addFrom('Referenciapersonal','d')
                ->where('rep_estatus=2 and sep_id='.$seccionpersonal->sep_id)
                ->orderBy('rep_id')
                ->getQuery()
                ->execute();

            $referenciavecinal=new Builder();
                $referenciavecinal=$referenciavecinal
                ->addFrom('Referenciavecinal','d')
                ->where('rev_estatus=2 and sep_id='.$seccionpersonal->sep_id)
                ->orderBy('rev_id')
                ->getQuery()
                ->execute();

            $modelseccionpersonal= new Seccionpersonal();
            $html=$modelseccionpersonal->formatogabtubos($seccionpersonal, $referenciapersonal);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección J
            $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','d')
                ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('rel_orden')
                ->getQuery()
                ->execute();

            $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','d')
                ->where('per_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('per_id')
                ->getQuery()
                ->execute();

            $modelseccionlaboral = new Seccionlaboral();
            $html=$modelseccionlaboral->formatogabtubos();
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            $detalles=count($referencialaboral);
            for ($i=0; $i < count($referencialaboral); $i++){ 
                
                if($i==0){
                    $html=$modelseccionlaboral->formatogabtubosreferenciaslaborales($referencialaboral[$i],0); //0 es último empleo
                    $mpdf->WriteHTML($html);
                }else{
                    $html=$modelseccionlaboral->formatogabtubosreferenciaslaborales($referencialaboral[$i],1); //1 es para anteriores empleos
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($html);
                }
            }
            $html=$modelseccionlaboral->formatogabtubosperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto);
            $mpdf->WriteHTML($html);

            $modelanexos= new Anexo();
            $condicion_anexos="
                    (
                    arc_estatus=2 and ese_id=$id and arc_reporte=1 
                        and 
                        ( Archivo.cat_id!=2  or  Archivo.cat_id!=3 or Archivo.cat_id!=4 or Archivo.cat_id!=5  or Archivo.cat_id!=6 )
                    ) or (
                        arc_estatus=2 and ese_id=$id 
                        and 
                        (Archivo.cat_id=7 or Archivo.cat_id=8 or Archivo.cat_id=18)
                    )
                    ";
    
                $anexos=Archivo::query()
                ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
                ->where($condicion_anexos)
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->orderBy('cat_prioridad')
                ->execute();
    
            if(count($anexos)>0){   
                    $html=$modelanexos->formatoeses($ese_id=$id,$anexos);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            //inicio de sección de referencias laborales
            $anexosreferenciastotal=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where("arc_estatus=2 and cat.cat_id=31 and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();

            if(count($anexosreferenciastotal)>0){
                $modelanexosreferencias= new Anexo();
                $html=$modelanexosreferencias->formatoesesreferenciascabecera();
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }

            $modelanexosreferencias= new Anexo();
            $condicion_anexosreferencias=
            "arc_estatus=2 and cat.cat_id=31 and arc_nombre not like '%.pdf' and ese_id=$id";
    
            $anexosreferencias=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where($condicion_anexosreferencias)
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();
    
            if(count($anexosreferencias)>0){   
                    $html=$modelanexosreferencias->formatoesesreferencias($ese_id=$id,$anexosreferencias);
                    // $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            $anexoreferenciacorreo=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=31 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexoreferenciacorreo)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexoreferencias;

                $mpdf->WriteHTML($html);
                
                if(count($anexoreferenciacorreo)==1){
                    $coorx=60;
                    $coory=-1;
                    $tamaniox=95;
                    $tamanioy=120;
                    if($mpdf->y>=160){
                        $mpdf->AddPage();
                        $tamaniox=180;
                        $tamanioy=227;
                        $coorx=-1;
                        $coory=-1;
                    }
                    $mpdf->SetImportUse();
                    $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[0]->arc_nombre);
                    $import_page = $mpdf->ImportPage($pagecount);
                    $mpdf->UseTemplate($import_page,$coorx,$coory,$tamaniox,$tamanioy);
                }else{
                    $mpdf->SetImportUse();
                    $bandera=1;
                    for($i=0; $i<count($anexoreferenciacorreo); $i++){
                        if($mpdf->y>=160){
                            $mpdf->AddPage();
                        }
                        $coorx=-1;
                        if($i % 2 != 0){
                            $coorx=110;
                        }
                        $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[$i]->arc_nombre);
                        $import_page = $mpdf->ImportPage($pagecount);
                        $mpdf->UseTemplate($import_page,$coorx,-1, 95,120);
                        if($bandera==2){
                            $mpdf->y= $mpdf->y + 120;
                            $bandera=0;
                        }
                        $bandera++;
                    }
                }
            }
            //fin de sección de referencias laborales

            $anexosemanacotizada=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=15 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexosemanacotizada)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexosemanacotizada;

                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
                
                $mpdf->SetImportUse(); // only with mPDF <8.0

                $mpdf->Thumbnail("archivos/".$anexosemanacotizada[0]->arc_nombre, 2, 5);
            }

            if($estudio->ese_estatus==7){
                unlink($dir.basename($filename));
            }

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un estudio con ID: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato Gabinete Tubos";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            // $mpdf->Output('Estudio'.$id.'.pdf','I');
            if($correo==1){
                $nombre='Estudio'.$id.'.pdf';
                $mpdf->Output('reporte/estudios/'.$nombre,'F');
                // $mpdf->Output($nombre,'I');
                return $nombre;
            }else{
                $mpdf->SetTitle("Estudio ESE ".$id);
                $mpdf->Output('Estudio'.$id.'.pdf','I');
            }
        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
    }

    public function formatoencognvAction($id_=0, $correo=0)
    {
        try {
        
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];
            if($id==0) //el número en la funcion es el correspondiente a la bdd
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $rol = new Rol();
            $auth = $this->session->get('auth');
            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
            }
        

            $estudio=Estudio::findFirstByese_id($id);
            if(!$estudio) //si no existe el estudio
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->columns(array('emp_nombre','emp_estatus','emp_logo'))
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            //seccion J
            $seccioneslaborales=new Builder();
                $seccioneslaborales=$seccioneslaborales
                ->addFrom('Seccionlaboral','d')
                ->where('sel_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            //datos finales 
            $seccionesdatosfinales=new Builder();
                $seccionesdatosfinales=$seccionesdatosfinales
                ->addFrom('Datofinal','d')
                ->where('daf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionesdatosfinales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos finales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }


            $secciondatofinal= $seccionesdatosfinales[0];

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

            $reporte= new PdfReporteGabineteEncognv();
            $reporteheader= new PdfReporteGabineteEncognv();
            $HeaderHtml=$reporteheader->eseheaderprimera;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            $var_image_header=str_replace("#logoempresa#",basename('images/logoempresa/'.$empresa->emp_logo),$var_image_header);
            $html=$reporte->eseportada;
            $mpdf->SetHTMLHeader($var_image_header,'O');

            $html=str_replace("#emp_nombre#",trim($empresa->emp_nombre),$html);
            $nombre_completo_can_ese=trim($estudio->ese_nombre). " ". trim($estudio->ese_primerapellido). " ". trim($estudio->ese_segundoapellido);

            
            $html=str_replace("#style_en_linea_ese_nombre#",trim($reporte->calcularFontSizeGeneral($nombre_completo_can_ese)),$html);
            $html=str_replace("#ese_nombre#",trim($nombre_completo_can_ese),$html);
            $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
            $html=str_replace("#ese_puesto#",trim($estudio->ese_puesto),$html);

            $datofinal= new Datofinal();

            $html=str_replace("#daf_calificacion#",trim($datofinal->getCalificacion($secciondatofinal->cal_id)),$html);

            
            $html=str_replace("#style_en_linea_daf_notafinal#",trim($reporte->calcularFontSizeComentarioNota($secciondatofinal->daf_notafinal)),$html);
            $html=str_replace("#daf_notafinal#",trim($secciondatofinal->daf_notafinal),$html);

            $html=str_replace("#firma#",basename('images/firmas/firma.jpg'),$html);

            $mpdf->WriteHTML($html);

            $reporteheader= new PdfReporteGabineteEncognv();

            $HeaderHtml=$reporteheader->eseheadersiguientes;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            
            $mpdf->SetHTMLHeader($var_image_header,'O');

            //sección A
            $secciondatospersonales= new Datopersonal();
            $html=$secciondatospersonales->formatogabencognv($estudio);
            // $mpdf->AddPage();
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="33%" style="text-align: right;">{PAGENO}-{nbpg}</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);

            //sección J
            $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','d')
                ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('rel_orden')
                ->getQuery()
                ->execute();
            
            $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','d')
                ->where('per_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('per_id')
                ->getQuery()
                ->execute();
            
            //emeplos ocultos
            $empleooculto=new Builder();
            $empleooculto=$empleooculto
            ->addFrom('Empleooculto','epl')
            ->where('epl_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('epl_id')
            ->getQuery()
            ->execute();    

            $modelseccionlaboral = new Seccionlaboral();
            $html=$modelseccionlaboral->formatogabencognv();
            //  $mpdf->AddPage();
             $mpdf->WriteHTML($html);

             #error_log($mpdf->y.$mpdf->h);
            #die();
          
            $detalles=count($referencialaboral);
            for ($i=0; $i < count($referencialaboral); $i++){ 
                
                if($i==0){
                    $html=$modelseccionlaboral->formatogabencognvreferenciaslaborales_V2_Responsive($referencialaboral[$i],0,$mpdf,0); //0 es último empleo
                    #$mpdf->WriteHTML($html);
                }else{
                    $html=$modelseccionlaboral->formatogabencognvreferenciaslaborales_V2_Responsive($referencialaboral[$i],1,$mpdf,0); //1 es para anteriores empleos
                   # $mpdf->AddPage();
                    #$mpdf->WriteHTML($html);
                }
            }

            

            $html=$modelseccionlaboral->formatogabencognvperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto);
            $mpdf->WriteHTML($html);

            //anexos adjuntos de manera dinamica incio
            $archivo_data= new Archivo();

                $data_archivos_adjuntos=Archivo::query()
                ->columns('Archivo.arc_nombre, cat.cat_nombre, cat.cat_truperadjunto, cat.cat_prioridad')
                ->where('
                (Archivo.arc_estatus="2" and Archivo.arc_reporte="1" and cat.cat_gabineteadjunto="1" and Archivo.ese_id='.$id.' )
                or
                (Archivo.arc_estatus="2" and Archivo.cat_id="8"  and Archivo.ese_id='.$id.' ) 
                ')
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->orderBy('cat.cat_prioridadgabinete')
                ->execute();
        
                //validamos que exista data
                if(count($data_archivos_adjuntos)>0){
                    $html_pagina_archivos_adjuntos=$archivo_data->registrosDinamicosAdjuntadosReporte_formatogabinete($data_archivos_adjuntos,$mpdf);
                }
        
            //anexos adjunto sde manera dinamica fin

            //inicio de sección de referencias laborales
            $anexosreferenciastotal=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where("arc_estatus=2 and cat.cat_id=31 and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();

            if(count($anexosreferenciastotal)>0){
                $modelanexosreferencias= new Anexo();
                $html=$modelanexosreferencias->formatoesesreferenciascabecera();
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }

            $modelanexosreferencias= new Anexo();
            $condicion_anexosreferencias=
            "arc_estatus=2 and cat.cat_id=31 and arc_nombre not like '%.pdf' and ese_id=$id";
    
            $anexosreferencias=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where($condicion_anexosreferencias)
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();
    
            if(count($anexosreferencias)>0){   
                    $html=$modelanexosreferencias->formatoesesreferencias($ese_id=$id,$anexosreferencias);
                    // $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            $anexoreferenciacorreo=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=31 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexoreferenciacorreo)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexoreferencias;

                $mpdf->WriteHTML($html);
                
                if(count($anexoreferenciacorreo)==1){
                    $coorx=60;
                    $coory=-1;
                    $tamaniox=95;
                    $tamanioy=120;
                    if($mpdf->y>=160){
                        $mpdf->AddPage();
                        $tamaniox=180;
                        $tamanioy=227;
                        $coorx=-1;
                        $coory=-1;
                    }
                    $mpdf->SetImportUse();
                    $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[0]->arc_nombre);
                    $import_page = $mpdf->ImportPage($pagecount);
                    $mpdf->UseTemplate($import_page,$coorx,$coory,$tamaniox,$tamanioy);
                }else{
                    $mpdf->SetImportUse();
                    $bandera=1;
                    for($i=0; $i<count($anexoreferenciacorreo); $i++){
                        if($mpdf->y>=160){
                            $mpdf->AddPage();
                        }
                        $coorx=-1;
                        if($i % 2 != 0){
                            $coorx=110;
                        }
                        $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[$i]->arc_nombre);
                        $import_page = $mpdf->ImportPage($pagecount);
                        $mpdf->UseTemplate($import_page,$coorx,-1, 95,120);
                        if($bandera==2){
                            $mpdf->y= $mpdf->y + 120;
                            $bandera=0;
                        }
                        $bandera++;
                    }
                }
            }
            //fin de sección de referencias laborales

            //incio de adjutar pdf de semanas cotizadas


                $anexosemanacotizada=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=15 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

                if(count($anexosemanacotizada)>0){
                $reporte= new PdfReporteGabineteEncognv();
                $html=$reporte->anexos_semanas_cotizadas_pdf;

                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
                
                $mpdf->SetImportUse(); // only with mPDF <8.0

                $mpdf->Thumbnail("archivos/".$anexosemanacotizada[0]->arc_nombre, 2, 5);
                }

            //fin de anexo de pdf de semanas cotizadas

            //inicio de adjutar anexo playeritees
            $anexoplayeritees=Archivo::query()
            ->columns('arc_nombre')
            ->where("arc_estatus=2 and cat.cat_id=27 and arc_nombre like '%.pdf' and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->execute();
            if(count($anexoplayeritees)>0){
                $mpdf->AddPage();
                $mpdf->SetImportUse(); // only with mPDF <8.0
                $mpdf->Thumbnail("archivos/".$anexoplayeritees[0]->arc_nombre, 1);
            }
            //fin de anexo de pdf de semanas cotizadas


            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un estudio con ID: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato Gabinete Encognv";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            if($correo==1){
                $nombre='Estudio'.$id.'.pdf';
                $mpdf->Output('reporte/estudios/'.$nombre,'F');
                // $mpdf->Output($nombre,'I');
                return $nombre;
            }else{
                $mpdf->SetTitle("Estudio ESE ".$id);
                $mpdf->Output('Estudio'.$id.'.pdf','I');

            }
            // $mpdf->Output('Estudio'.$id.'.pdf','I');
        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
    }

    public function formatogabsipsAction($id_=0)
    {
        try {
        
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];
            if($id==0) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $rol = new Rol();
            $auth = $this->session->get('auth');
            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
    
            }
           
            $estudio=Estudio::findFirstByese_id($id);
            

            if(!$estudio) //si no existe el estudio
            {
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->columns(array('emp_nombre','emp_estatus','emp_logo'))
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            //seccion J
            $seccioneslaborales=new Builder();
                $seccioneslaborales=$seccioneslaborales
                ->addFrom('Seccionlaboral','d')
                ->where('sel_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            //datos finales 
            $seccionesdatosfinales=new Builder();
                $seccionesdatosfinales=$seccionesdatosfinales
                ->addFrom('Datofinal','d')
                ->where('daf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionesdatosfinales)<=0) //si no existen datos comprobatorios
            {
                $this->flash->error("No existen datos finales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $secciondatofinal= $seccionesdatosfinales[0];

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

            $reporte= new PdfReporteGabineteSips();
            $reporteheader= new PdfReporteGabineteSips();
            $HeaderHtml=$reporteheader->eseheaderprimera;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            $var_image_header=str_replace("#logoempresa#",basename('images/logoempresa/'.$empresa->emp_logo),$var_image_header);
            $html=$reporte->eseportada;
            $mpdf->SetHTMLHeader($var_image_header,'O');

            $html=str_replace("#emp_nombre#",trim($empresa->emp_nombre),$html);
            $html=str_replace("#ese_nombre#",trim($estudio->ese_nombre). " ". trim($estudio->ese_primerapellido). " ". trim($estudio->ese_segundoapellido),$html);
            $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
            $html=str_replace("#ese_puesto#",trim($estudio->ese_puesto),$html);

            $datofinal= new Datofinal();

            $html=str_replace("#daf_calificacion#",trim($datofinal->getCalificacion($secciondatofinal->cal_id)),$html);
            $html=str_replace("#daf_notafinal#",trim($secciondatofinal->daf_notafinal),$html);

            $html=str_replace("#firma#",basename('images/firmas/firma.jpg'),$html);

            $mpdf->WriteHTML($html);

            $reporteheader= new PdfReporteGabineteSips();

            $HeaderHtml=$reporteheader->eseheadersiguientes;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            
            $mpdf->SetHTMLHeader($var_image_header,'O');

            //sección A
            $secciondatospersonales= new Datopersonal();
            $html=$secciondatospersonales->formatogabsips($estudio, $datocomprobatorio);
            // $mpdf->AddPage();
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="33%" style="text-align: right;">{PAGENO}-{nbpg}</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);

            //sección J
            $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','d')
                ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('rel_orden')
                ->getQuery()
                ->execute();
            //emeplos ocultos
            $empleooculto=new Builder();
            $empleooculto=$empleooculto
            ->addFrom('Empleooculto','epl')
            ->where('epl_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('epl_id')
            ->getQuery()
            ->execute();    
            $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','d')
                ->where('per_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('per_id')
                ->getQuery()
                ->execute();

            $modelseccionlaboral = new Seccionlaboral();
            $html=$modelseccionlaboral->formatogabsips();
            // $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            $detalles=count($referencialaboral);
            for ($i=0; $i < count($referencialaboral); $i++){ 
                
                if($i==0){
                    $html=$modelseccionlaboral->formatogabsipsreferenciaslaborales($referencialaboral[$i],0); //0 es último empleo
                    $mpdf->WriteHTML($html);
                }else{
                    $html=$modelseccionlaboral->formatogabsipsreferenciaslaborales($referencialaboral[$i],1); //1 es para anteriores empleos
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($html);
                }
            }
            $html=$modelseccionlaboral->formatogabsipsperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto);
            $mpdf->WriteHTML($html);

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un estudio con ID: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato Gabinete SIPS";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            $mpdf->SetTitle("Estudio GAB SIPS ".$id);
            $mpdf->Output('Estudio'.$id.'.pdf','I');

        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
    }

    public function formatoargosAction($id_=0, $correo=0)
    {

        try {
        
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];
            if($id==0) //el número en la funcion es el correspondiente a la bdd
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $rol = new Rol();
            $auth = $this->session->get('auth');
            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
    
            }
          
            date_default_timezone_set('america/mexico_city');
            // $host=$_SERVER["HTTP_HOST"];
            $host="https://sadisips.com/";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
            $url=$host.$carpeta."consulta/validaqr/";

            $estudio=Estudio::findFirstByese_id($id);
            

            if(!$estudio) //si no existe el estudio
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->columns(array('emp_nombre','emp_estatus','emp_logo'))
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            $datoscomprobatorios=new Builder();
                $datoscomprobatorios=$datoscomprobatorios
                // ->columns()
                ->addFrom('Datocomprobatorio','d')
                ->where('cop_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datoscomprobatorios)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos comprobatorios cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datocomprobatorio= $datoscomprobatorios[0];

            $datosescolares=new Builder();
                $datosescolares=$datosescolares
                // ->columns()
                ->addFrom('Datoescolar','d')
                ->where('dae_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datosescolares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos escolares cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datoescolar= $datosescolares[0];

            //seccion C
            $antecedentessociales=new Builder();
                $antecedentessociales=$antecedentessociales
                // ->columns()
                ->addFrom('Antecedentesocial','d')
                ->where('ans_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($antecedentessociales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de antecedentes sociales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $antecedentesocial= $antecedentessociales[0];

            //seccion D
            $estadosdesalud=new Builder();
                $estadosdesalud=$estadosdesalud
                // ->columns()
                ->addFrom('Estadosalud','d')
                ->where('ess_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($estadosdesalud)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de estado de salud cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $estadosalud= $estadosdesalud[0];

            //seccion E
            $datogrupofamiliares=new Builder();
                $datogrupofamiliares=$datogrupofamiliares
                // ->columns()
                ->addFrom('Datogrupofamiliar','d')
                ->where('dgf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datogrupofamiliares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datogrupofamiliar= $datogrupofamiliares[0];

            //seccion F
            $antecedenteslaboralesfamiliar=new Builder();
                $antecedenteslaboralesfamiliar=$antecedenteslaboralesfamiliar
                // ->columns()
                ->addFrom('Antecedentegrupofamiliar','d')
                ->where('agf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($antecedenteslaboralesfamiliar)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de antecedentes laborales del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $antecedentelaboralfamiliar= $antecedenteslaboralesfamiliar[0];

            //seccion G
            $situacioneseconomicas=new Builder();
                $situacioneseconomicas=$situacioneseconomicas
                // ->columns()
                ->addFrom('Situacioneconomica','d')
                ->where('sie_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($situacioneseconomicas)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de situación económica cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $situacioneconomica= $situacioneseconomicas[0];

            //seccion H
            $bienesinmuebles=new Builder();
                $bienesinmuebles=$bienesinmuebles
                ->addFrom('Bieninmueble','d')
                ->where('bie_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($bienesinmuebles)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de bienes inmuebles cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $bieninmueble= $bienesinmuebles[0];

            //seccion I
            $seccionespersonales=new Builder();
                $seccionespersonales=$seccionespersonales
                ->addFrom('Seccionpersonal','d')
                ->where('sep_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionespersonales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias personales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionpersonal= $seccionespersonales[0];

            //seccion J
            $seccioneslaborales=new Builder();
                $seccioneslaborales=$seccioneslaborales
                ->addFrom('Seccionlaboral','d')
                ->where('sel_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            //datos finales 
            $seccionesdatosfinales=new Builder();
                $seccionesdatosfinales=$seccionesdatosfinales
                ->addFrom('Datofinal','d')
                ->where('daf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($seccionesdatosfinales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos finales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $secciondatofinal= $seccionesdatosfinales[0];

            if($estudio->ese_estatus==7){
                include('phpqrcode/qrlib.php');

                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'temp/';

                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);

                //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'qr.png';

                //Parametros de Configuración
                $tamaño = 6; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 1; //Tamaño en blanco
                $contenido = $url.$id; //Texto

                //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            }else{
                $filename='iniciador.jpg';
            }

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

            // $mpdf->defaultheaderline = 0;
            // $mpdf->autoMarginPadding = 5;
            // $mpdf->defaultfooterline = 0;
            // $mpdf->defaultheaderline = 0;
            // $mpdf->setAutoTopMargin= 5000;

            $reporte= new PdfReporte();
            $reporteheader= new PdfReporte();
            $HeaderHtml=$reporteheader->eseheaderprimera;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            $var_image_header=str_replace("#logoempresa#",basename('images/logoempresa/'.$empresa->emp_logo),$var_image_header);

            $html=$reporte->eseportadaargos;
            
            $mpdf->SetHTMLHeader($var_image_header,'O');

            $archivossubidos=new Builder();
            $archivossubidos=$archivossubidos
            ->addFrom('Archivo','a')
            ->where('arc_estatus=2 and cat_id=1 and ese_id='.$id)
            ->getQuery()
            ->execute();
            if(count($archivossubidos)>0){
                $html=str_replace("#rostro#",basename('archivos/'.$archivossubidos[0]->arc_nombre),$html);
            }
            
            $html=str_replace("#rostro#",basename('archivos/iniciador.jpg'),$html);

            $html=str_replace("#emp_nombre#",trim($empresa->emp_nombre),$html);
            $html=str_replace("#ese_nombre#",trim($estudio->ese_nombre). " ". trim($estudio->ese_primerapellido). " ". trim($estudio->ese_segundoapellido),$html);
            $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
            $html=str_replace("#ese_puesto#",trim($estudio->ese_puesto),$html);

            $datofinal= new Datofinal();

            $html=str_replace("#daf_calificacion#",trim($datofinal->getCalificacion($secciondatofinal->cal_id)),$html);
            $html=str_replace("#daf_notafinal#",trim($secciondatofinal->daf_notafinal),$html);

            ($datocomprobatorio->cop_calificacion == '1') ? $html=str_replace("#cop_calificacioni#",'X',$html) :  $html=str_replace("#cop_calificacioni#",'',$html);
            ($datocomprobatorio->cop_calificacion == '2') ? $html=str_replace("#cop_calificacionp#",'X',$html) :  $html=str_replace("#cop_calificacionp#",'',$html);
            ($datocomprobatorio->cop_calificacion == '3') ? $html=str_replace("#cop_calificaciona#",'X',$html) :  $html=str_replace("#cop_calificaciona#",'',$html);

            ($datoescolar->dae_calificacion == '1') ? $html=str_replace("#dae_calificacioni#",'X',$html) :  $html=str_replace("#dae_calificacioni#",'',$html);
            ($datoescolar->dae_calificacion == '2') ? $html=str_replace("#dae_calificacionp#",'X',$html) :  $html=str_replace("#dae_calificacionp#",'',$html);
            ($datoescolar->dae_calificacion == '3') ? $html=str_replace("#dae_calificaciona#",'X',$html) :  $html=str_replace("#dae_calificaciona#",'',$html);


            ($antecedentesocial->ans_calificacion == '1') ? $html=str_replace("#ans_calificacioni#",'X',$html) :  $html=str_replace("#ans_calificacioni#",'',$html);
            ($antecedentesocial->ans_calificacion == '2') ? $html=str_replace("#ans_calificacionp#",'X',$html) :  $html=str_replace("#ans_calificacionp#",'',$html);
            ($antecedentesocial->ans_calificacion == '3') ? $html=str_replace("#ans_calificaciona#",'X',$html) :  $html=str_replace("#ans_calificaciona#",'',$html);

            ($estadosalud->ess_calificacion == '1') ? $html=str_replace("#ess_calificacioni#",'X',$html) :  $html=str_replace("#ess_calificacioni#",'',$html);
            ($estadosalud->ess_calificacion == '2') ? $html=str_replace("#ess_calificacionp#",'X',$html) :  $html=str_replace("#ess_calificacionp#",'',$html);
            ($estadosalud->ess_calificacion == '3') ? $html=str_replace("#ess_calificaciona#",'X',$html) :  $html=str_replace("#ess_calificaciona#",'',$html);

            ($datogrupofamiliar->dgf_calificacion == '1') ? $html=str_replace("#dgf_calificacioni#",'X',$html) :  $html=str_replace("#dgf_calificacioni#",'',$html);
            ($datogrupofamiliar->dgf_calificacion == '2') ? $html=str_replace("#dgf_calificacionp#",'X',$html) :  $html=str_replace("#dgf_calificacionp#",'',$html);
            ($datogrupofamiliar->dgf_calificacion == '3') ? $html=str_replace("#dgf_calificaciona#",'X',$html) :  $html=str_replace("#dgf_calificaciona#",'',$html);

            ($antecedentelaboralfamiliar->agf_calificacion == '1') ? $html=str_replace("#agf_calificacioni#",'X',$html) :  $html=str_replace("#agf_calificacioni#",'',$html);
            ($antecedentelaboralfamiliar->agf_calificacion == '2') ? $html=str_replace("#agf_calificacionp#",'X',$html) :  $html=str_replace("#agf_calificacionp#",'',$html);
            ($antecedentelaboralfamiliar->agf_calificacion == '3') ? $html=str_replace("#agf_calificaciona#",'X',$html) :  $html=str_replace("#agf_calificaciona#",'',$html);

            ($situacioneconomica->sie_calificacion == '1') ? $html=str_replace("#sie_calificacioni#",'X',$html) :  $html=str_replace("#sie_calificacioni#",'',$html);
            ($situacioneconomica->sie_calificacion == '2') ? $html=str_replace("#sie_calificacionp#",'X',$html) :  $html=str_replace("#sie_calificacionp#",'',$html);
            ($situacioneconomica->sie_calificacion == '3') ? $html=str_replace("#sie_calificaciona#",'X',$html) :  $html=str_replace("#sie_calificaciona#",'',$html);

            ($bieninmueble->bie_calificacion == '1') ? $html=str_replace("#bie_calificacioni#",'X',$html) :  $html=str_replace("#bie_calificacioni#",'',$html);
            ($bieninmueble->bie_calificacion == '2') ? $html=str_replace("#bie_calificacionp#",'X',$html) :  $html=str_replace("#bie_calificacionp#",'',$html);
            ($bieninmueble->bie_calificacion == '3') ? $html=str_replace("#bie_calificaciona#",'X',$html) :  $html=str_replace("#bie_calificaciona#",'',$html);

            ($seccionpersonal->sep_calificacion == '1') ? $html=str_replace("#sep_calificacioni#",'X',$html) :  $html=str_replace("#sep_calificacioni#",'',$html);
            ($seccionpersonal->sep_calificacion == '2') ? $html=str_replace("#sep_calificacionp#",'X',$html) :  $html=str_replace("#sep_calificacionp#",'',$html);
            ($seccionpersonal->sep_calificacion == '3') ? $html=str_replace("#sep_calificaciona#",'X',$html) :  $html=str_replace("#sep_calificaciona#",'',$html);

            ($seccionlaboral->sel_calificacion == '1') ? $html=str_replace("#sel_calificacioni#",'X',$html) :  $html=str_replace("#sel_calificacioni#",'',$html);
            ($seccionlaboral->sel_calificacion == '2') ? $html=str_replace("#sel_calificacionp#",'X',$html) :  $html=str_replace("#sel_calificacionp#",'',$html);
            ($seccionlaboral->sel_calificacion == '3') ? $html=str_replace("#sel_calificaciona#",'X',$html) :  $html=str_replace("#sel_calificaciona#",'',$html);

            $mpdf->WriteHTML($html);

            $reporteheader= new PdfReporte();

            $HeaderHtml=$reporteheader->eseheadersiguientes;
            $var_image_header=$HeaderHtml; 
            $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
            
            $mpdf->SetHTMLHeader($var_image_header,'O');

            //sección A
            $secciondatospersonales= new Datopersonal();
            $html=$secciondatospersonales->formatoeses($estudio, $datocomprobatorio);
            $mpdf->AddPage();
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="33%" style="text-align: right;">{PAGENO}-{nbpg}</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);

            //sección B
            $secciondatosescolares= new Datoescolar();
            $html=$secciondatosescolares->formatoeses($datoescolar);
            $mpdf->WriteHTML($html);

            //sección C
            $seccionantecedentesocial= new Antecedentesocial();
            $html=$seccionantecedentesocial->formatoeses($antecedentesocial);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección D
            $seccionestadosalud= new Estadosalud();
            $html=$seccionestadosalud->formatoeses($estadosalud);
            $mpdf->WriteHTML($html);

            //sección E
            $datogrupofamiliardetalles_vive_con=new Builder();
            $datogrupofamiliardetalles_vive_con=$datogrupofamiliardetalles_vive_con
                // ->columns()
                ->addFrom('Datogrupofamiliardetalles','d')
                ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id.' and dgd_viveusted = 1 ')
                ->orderBy('dgd_id')
                ->getQuery()
                ->execute();
            $datogrupofamiliardetalles_NO_vive_con=new Builder();
            $datogrupofamiliardetalles_NO_vive_con=$datogrupofamiliardetalles_NO_vive_con
                // ->columns()
                ->addFrom('Datogrupofamiliardetalles','d')
                ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id.' and dgd_viveusted = 0 ')
                ->orderBy('dgd_id')
                ->getQuery()
                ->execute();
            $secciondatogrupofamiliar= new Datogrupofamiliar();
            $html=$secciondatogrupofamiliar->formatoeses($datogrupofamiliar,$datogrupofamiliardetalles_vive_con,$datogrupofamiliardetalles_NO_vive_con);
            // $datogrupofamiliardetalles=new Builder();
            //     $datogrupofamiliardetalles=$datogrupofamiliardetalles
            //     // ->columns()
            //     ->addFrom('Datogrupofamiliardetalles','d')
            //     ->where('dgd_estatus=2 and dgf_id='.$datogrupofamiliar->dgf_id)
            //     ->orderBy('dgd_id')
            //     ->getQuery()
            //     ->execute();
            // $secciondatogrupofamiliar= new Datogrupofamiliar();
            // $html=$secciondatogrupofamiliar->formatoeses($datogrupofamiliar,$datogrupofamiliardetalles);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección F
            $antecedentegrupofamiliardetalles=new Builder();
                $antecedentegrupofamiliardetalles=$antecedentegrupofamiliardetalles
                // ->columns()
                ->addFrom('Antecedentegrupofamiliardetalles','d')
                ->where('agd_estatus=2 and agf_id='.$antecedentelaboralfamiliar->agf_id)
                ->orderBy('agd_id')
                ->getQuery()
                ->execute();
            $seccionantecedentegrupofamiliar= new Antecedentegrupofamiliar();
            $html=$seccionantecedentegrupofamiliar->formatoeses($antecedentelaboralfamiliar,$antecedentegrupofamiliardetalles);
            $mpdf->WriteHTML($html);

            //sección G
            $situacioneconomicaingresos=new Builder();
                $situacioneconomicaingresos=$situacioneconomicaingresos
                ->addFrom('Situacioneconomicaingresos','d')
                ->where('sei_estatus=2 and sie_id='.$situacioneconomica->sie_id)
                ->orderBy('sei_id')
                ->getQuery()
                ->execute();

            $situacioneconomicacredito=new Builder();
                $situacioneconomicacredito=$situacioneconomicacredito
                ->addFrom('Situacioneconomicacredito','d')
                ->where('sec_estatus=2 and sie_id='.$situacioneconomica->sie_id)
                ->orderBy('sec_id')
                ->getQuery()
                ->execute();

            $seccionsituacioneconomica= new Situacioneconomica();
            $html=$seccionsituacioneconomica->formatoeses($situacioneconomica, $situacioneconomicaingresos, $situacioneconomicacredito);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección H
            $bieninmuebledetalles=new Builder();
                $bieninmuebledetalles=$bieninmuebledetalles
                ->addFrom('Bieninmuebledetalles','d')
                ->where('bid_estatus=2 and bie_id='.$bieninmueble->bie_id)
                ->orderBy('bid_id')
                ->getQuery()
                ->execute();

            //seccion automovil bienesinmuebles
        $bieninmueble_automovil=new Builder();
                $bieninmueble_automovil=$bieninmueble_automovil
                ->addFrom('Automovil','a')
                ->where('aut_estatus=2 and bie_id='.$bieninmueble->bie_id)
                ->orderBy('aut_id')
                ->getQuery()
                ->execute();



            $seccionbienesinmuebles= new Bieninmueble();


            $html=$seccionbienesinmuebles->formatoeses($bieninmueble, $bieninmuebledetalles,$bieninmueble_automovil);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección I
            $referenciapersonal=new Builder();
                $referenciapersonal=$referenciapersonal
                ->addFrom('Referenciapersonal','d')
                ->where('rep_estatus=2 and sep_id='.$seccionpersonal->sep_id)
                ->orderBy('rep_id')
                ->getQuery()
                ->execute();

            $referenciavecinal=new Builder();
                $referenciavecinal=$referenciavecinal
                ->addFrom('Referenciavecinal','d')
                ->where('rev_estatus=2 and sep_id='.$seccionpersonal->sep_id)
                ->orderBy('rev_id')
                ->getQuery()
                ->execute();

            $modelseccionpersonal= new Seccionpersonal();
            $html=$modelseccionpersonal->formatoeses($seccionpersonal, $referenciapersonal);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
            $html=$modelseccionpersonal->formatoesesvecinal($referenciavecinal);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            //sección J
            $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','d')
                ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('rel_orden')
                ->getQuery()
                ->execute();

            $periodoinactivo=new Builder();
                $periodoinactivo=$periodoinactivo
                ->addFrom('Periodoinactivo','d')
                ->where('per_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('per_id')
                ->getQuery()
                ->execute();
            
            $empleooculto=new Builder();
            $empleooculto=$empleooculto
            ->addFrom('Empleooculto','epl')
            ->where('epl_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('epl_id')
            ->getQuery()
            ->execute();

            $modelseccionlaboral = new Seccionlaboral();
            $html=$modelseccionlaboral->formatoeses();
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            $detalles=count($referencialaboral);
            for ($i=0; $i < count($referencialaboral); $i++){ 
                
                if($i==0){
                    $html=$modelseccionlaboral->formatoesesreferenciaslaborales($referencialaboral[$i],0); //0 es último empleo
                    $mpdf->WriteHTML($html);
                }else{
                    $html=$modelseccionlaboral->formatoesesreferenciaslaborales($referencialaboral[$i],1); //1 es para anteriores empleos
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($html);
                }
            }
            $html=$modelseccionlaboral->formatoesesperiodosinactivos($periodoinactivo, $seccionlaboral, $empleooculto);
            $mpdf->WriteHTML($html);

            $modelgraficos= new Grafico();
            if($estudio->ese_estatus==7){
                $fecha_fin= $estudio->ese_fechaentregacliente;
                $fin= new DateTime($fecha_fin);
                $entrega=$fin->format('d-m-Y');
            }else{
                $filename='iniciador.jpg';
                $entrega='';
            }
            

            $html=$modelgraficos->formatoeses($id, $entrega, $filename);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);


            //seccion de anexos inicio
            $modelanexos= new Anexo();
            $condicion_anexos="
                (
                arc_estatus=2 and ese_id=$id and arc_reporte=1 
                    and 
                    ( Archivo.cat_id!=2  or  Archivo.cat_id!=3 or Archivo.cat_id!=4 or Archivo.cat_id!=5  or Archivo.cat_id!=6 )
                ) or (
                    arc_estatus=2 and ese_id=$id 
                    and 
                    (Archivo.cat_id=7 or Archivo.cat_id=8 or Archivo.cat_id=18)
                )
                ";
        
            $anexos=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where($condicion_anexos)
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();
        
            if(count($anexos)>0){
                $html=$modelanexos->formatoeses($ese_id=$id,$anexos);
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }
    
            //seccion de anexos fin

            //inicio de sección de referencias laborales
            $anexosreferenciastotal=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where("arc_estatus=2 and cat.cat_id=31 and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();

            if(count($anexosreferenciastotal)>0){
                $modelanexosreferencias= new Anexo();
                $html=$modelanexosreferencias->formatoesesreferenciascabecera();
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }

            $modelanexosreferencias= new Anexo();
            $condicion_anexosreferencias=
            "arc_estatus=2 and cat.cat_id=31 and arc_nombre not like '%.pdf' and ese_id=$id";
    
            $anexosreferencias=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where($condicion_anexosreferencias)
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();
    
            if(count($anexosreferencias)>0){   
                    $html=$modelanexosreferencias->formatoesesreferencias($ese_id=$id,$anexosreferencias);
                    // $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            $anexoreferenciacorreo=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=31 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexoreferenciacorreo)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexoreferencias;

                $mpdf->WriteHTML($html);
                
                if(count($anexoreferenciacorreo)==1){
                    $coorx=60;
                    $coory=-1;
                    $tamaniox=95;
                    $tamanioy=120;
                    if($mpdf->y>=160){
                        $mpdf->AddPage();
                        $tamaniox=180;
                        $tamanioy=227;
                        $coorx=-1;
                        $coory=-1;
                    }
                    $mpdf->SetImportUse();
                    $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[0]->arc_nombre);
                    $import_page = $mpdf->ImportPage($pagecount);
                    $mpdf->UseTemplate($import_page,$coorx,$coory,$tamaniox,$tamanioy);
                }else{
                    $mpdf->SetImportUse();
                    $bandera=1;
                    for($i=0; $i<count($anexoreferenciacorreo); $i++){
                        if($mpdf->y>=160){
                            $mpdf->AddPage();
                        }
                        $coorx=-1;
                        if($i % 2 != 0){
                            $coorx=110;
                        }
                        $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[$i]->arc_nombre);
                        $import_page = $mpdf->ImportPage($pagecount);
                        $mpdf->UseTemplate($import_page,$coorx,-1, 95,120);
                        if($bandera==2){
                            $mpdf->y= $mpdf->y + 120;
                            $bandera=0;
                        }
                        $bandera++;
                    }
                }
            }
            //fin de sección de referencias laborales

            $anexosemanacotizada=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=15 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexosemanacotizada)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexosemanacotizada;

                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
                
                $mpdf->SetImportUse(); // only with mPDF <8.0

                $mpdf->Thumbnail("archivos/".$anexosemanacotizada[0]->arc_nombre, 2, 5);
            }

            if($estudio->ese_estatus==7){
                unlink($dir.basename($filename));
            }

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un ESE con ID: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato ESES";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            if($correo==1){
                $nombre='Estudio'.$id.'.pdf';
                $mpdf->Output('reporte/estudios/'.$nombre,'F');
                
                return $nombre;
            }else{
                $mpdf->SetTitle("Estudio ESE ".$id);
                $mpdf->Output('Estudio'.$id.'.pdf','I');
            }
        } catch (Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
    }

    public function formatotruperAction($id_, $correo=0){
    try {
        $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
        $id=$respuesta_modelo_des_encript["id"];
       // echo print_r($respuesta_modelo_des_encript);
        //die();
            if($id<=0 || !is_numeric($id)) //el número en la funcion es el correspondiente a la bdd
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
    
            $rol = new Rol();
            $auth = $this->session->get('auth');

            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
            
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }    
            }
            date_default_timezone_set('america/mexico_city');
            // $host=$_SERVER["HTTP_HOST"];
            $host="https://sadisips.com/";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
            $url=$host.$carpeta."consulta/validaqr/";

            $estudio=Estudio::findFirstByese_id($id);
            //VALIDACION DE LLENADO DE SECCIONES INICIO-----------------------------------------------------------------------------------------VALIDACION DE LLENADO DE SECCIONES INICIO

            if(!$estudio) //si no existe el estudio
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            //secion a -datos finales

            $datosfinales_data=new Builder();
            $datosfinales_data=$datosfinales_data
            // ->columns()
            ->addFrom('Datofinal','daf')
            ->where('daf_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        


            //seccion B
            $datovivienda=new Builder();
            $datovivienda=$datovivienda
            // ->columns()
            ->addFrom('Datovivienda','dav')
            ->where('dav_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
            if(count($datovivienda)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos vivienda cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datovivienda= $datovivienda[0];

            //seccion c
            $datoescolar=new Builder();
            $datoescolar=$datoescolar
            // ->columns()
            ->addFrom('Datoescolar','dae')
            ->where('dae_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
            if(count($datoescolar)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos escolares cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datoescolar= $datoescolar[0];


            //  $estadosalud=new Builder();
            //  $estadosalud=$estadosalud
            //  // ->columns()
            //  ->addFrom('Estadosalud','ess')
            //  ->where('ess_estatus=2 and ese_id='.$id)
            //  ->getQuery()
            //  ->execute();
        
            //  if(count($estadosalud)<=0) //si no existen datos comprobatorios
            //  {
            //     if($correo==1){
            //         return 'error';
            //     }
            //      $this->flash->error("No existen datos salud cargados.");
            //      $this->response->redirect('index/panel');
            //      $this->view->disable();
            //      return;   
            //  }
            //  $estadosalud= $estadosalud[0];


            //seccion D
            $estadosdesalud=new Builder();
                $estadosdesalud=$estadosdesalud
                // ->columns()
                ->addFrom('Estadosalud','d')
                ->where('ess_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($estadosdesalud)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de estado de salud cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $estadosalud= $estadosdesalud[0];

            
            
            $antecedentesocial=new Builder();
            $antecedentesocial=$antecedentesocial
            // ->columns()
            ->addFrom('Antecedentesocial','ans')
            ->where('ans_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
                if(count($antecedentesocial)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de antecedentes sociales cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
            $antecedentesocial= $antecedentesocial[0];
            //seccion E
            $datogrupofamiliares=new Builder();
            $datogrupofamiliares=$datogrupofamiliares
            // ->columns()
            ->addFrom('Datogrupofamiliar','d')
            ->where('dgf_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();

            if(count($datogrupofamiliares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $datogrupofamiliar= $datogrupofamiliares[0];
            

            //seccion F
            $datoscomprobatorios=new Builder();
                $datoscomprobatorios=$datoscomprobatorios
                // ->columns()
                ->addFrom('Datocomprobatorio','d')
                ->where('cop_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datoscomprobatorios)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos comprobatorios cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datocomprobatorio= $datoscomprobatorios[0];

            //seccion G
            $situacioneseconomicas=new Builder();
            $situacioneseconomicas=$situacioneseconomicas
            // ->columns()
            ->addFrom('Situacioneconomica','d')
            ->where('sie_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();

            if(count($situacioneseconomicas)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de situación económica candidato cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $situacioneconomica= $situacioneseconomicas[0];

            $situacioneconomicafamiliar=new Builder();
            $situacioneconomicafamiliar=$situacioneconomicafamiliar
            // ->columns()
            ->addFrom('Situacioneconomicafamiliar','sef')
            ->where('sef_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();

            if(count($situacioneconomicafamiliar)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de situación económica familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $situacioneconomicafamiliar= $situacioneconomicafamiliar[0];


            //seccion H
                $bienesinmuebles=new Builder();
                    $bienesinmuebles=$bienesinmuebles
                    ->addFrom('Bieninmueble','d')
                    ->where('bie_estatus=2 and ese_id='.$id)
                    ->getQuery()
                    ->execute();
                
                if(count($bienesinmuebles)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de bienes inmuebles cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
                $bieninmueble= $bienesinmuebles[0];

                $bieninmuebledetalles=new Builder();
                    $bieninmuebledetalles=$bieninmuebledetalles
                    ->addFrom('Bieninmuebledetalles','d')
                    ->where('bid_estatus=2 and bie_id='.$bieninmueble->bie_id)
                    ->getQuery()
                    ->execute();

                $automoviles=new Builder();
                    $automoviles=$automoviles
                    ->addFrom('Automovil','d')
                    ->where('aut_estatus=2 and bie_id='.$bieninmueble->bie_id)
                    ->getQuery()
                    ->execute();
                
            //seccion I

            $seccioneslaborales=new Builder();
            $seccioneslaborales=$seccioneslaborales
            ->addFrom('Seccionlaboral','d')
            ->where('sel_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de seccion laboralcargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            $referencialaborales=new Builder();
            $referencialaborales=$referencialaborales
            ->addFrom('Referencialaboral','rel')
            ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('rel_orden')
            ->getQuery()
            ->execute();
            if(count($referencialaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }


            //pagina 11

            

            $trayectorialaboralregistrado_data=new Builder();
            $trayectorialaboralregistrado_data=$trayectorialaboralregistrado_data
            ->addFrom('Trayectorialaboralregistrado','tlr')
            ->where('tlr_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->getQuery()
            ->execute();
        
            if(count($trayectorialaboralregistrado_data)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de trayectoria laboral cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $trayectorialaboralregistrado_data= $trayectorialaboralregistrado_data[0];

            
            //seccion J-pag 12

            $seccionespersonales=new Builder();
            $seccionespersonales=$seccionespersonales
            ->addFrom('Seccionpersonal','sep')
            ->where('sep_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
            
            if(count($seccionespersonales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias personales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionpersonal= $seccionespersonales[0];

            $referenciavecinales=new Builder();
            $referenciavecinales=$referenciavecinales
            ->addFrom('Referenciavecinal','rev')
            ->where('rev_estatus=2 and sep_id='.$seccionpersonal->sep_id)
            ->getQuery()
            ->execute();
        
        if(count($referenciavecinales)<=0) //si no existen datos comprobatorios
        {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias vecinales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
        }

        $referenciafamiliares=new Builder();
        $referenciafamiliares=$referenciafamiliares
        ->addFrom('Referenciafamiliar','ref')
        ->where('ref_estatus=2 and sep_id='.$seccionpersonal->sep_id)
        ->getQuery()
        ->execute();
    
            if(count($referenciafamiliares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias familiares cargadas.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }


        
        $referenciapersonales=new Builder();
        $referenciapersonales=$referenciapersonales
        ->addFrom('Referenciapersonal','d')
        ->where('rep_estatus=2 and sep_id='.$seccionpersonal->sep_id)
        ->getQuery()
        ->execute();
    
            if(count($referenciapersonales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias personales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            //seccion final pagina 13
        
            $evaluaciontruper=new Builder();
            $evaluaciontruper=$evaluaciontruper
            ->addFrom('Evaluaciontruper','evt')
            ->where('evt_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
            
            if(count($evaluaciontruper)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de evaulacion final truper cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $evaluaciontruper= $evaluaciontruper[0];



            //NVRL--VALIDACION DE LLENADO DE SECCIONES INICIO-----------------------------------------------------------------------------------------VALIDACION DE LLENADO DE SECCIONES INICIO

        
            $qrfolio="";
            $qrfecha="";
            if($estudio->ese_estatus==7){
                $qrfolio=$estudio->ese_id;

                $fecha_fin= $estudio->ese_fechaentregacliente;
                $fin= new DateTime($fecha_fin);
                $qrfecha=$fin->format('d-m-Y');

                include('phpqrcode/qrlib.php');

                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'temp/';

                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);

                //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'qr.png';

                //Parametros de Configuración
                $tamaño = 6; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 1; //Tamaño en blanco
                $contenido = $url.$id; //Texto

                //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            }else{
                $filename='iniciador.jpg';
            }

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

    


            $reporte_completo= new PdfReporteTruper();
            $estudio_datospersonales= new Datopersonal();

            //dandole formato cabezera y footer

            


                $var_header=str_replace("#logo_header#",basename('images/sips_documento.png'),$reporte_completo->cabezera_hoja);


                $mpdf->SetHTMLHeader($var_header,'O');

                $mpdf->SetHTMLFooter($reporte_completo->header_hoja);

                $mpdf->SetTitle('ESE TRUPER No.'.$id);
                $mpdf->SetAuthor('SIPS | SADI');
            
            //dandole formato cabezera y footer-fin


            //escribiendo pagina 1
            $estudio_datospersonales_html=$estudio_datospersonales->formatoEseTruper($estudio,$datosfinales_data);
            $mpdf->WriteHTML($estudio_datospersonales_html);
            //escribiendo pagina 1 fin



            //pagina 2 inicio 1er parte
            $mpdf->AddPage();
            
            $domicilio_imgs_pagina_2= new Anexo( );
            $html_pagina_2=$domicilio_imgs_pagina_2->formatoEseTruper($ese_id=$id);

            //pagina  2 ,2da parte

            
            $domicilio_data_pagina_2= new Datovivienda();

            $html_pagina_2_seccion_data=$domicilio_data_pagina_2->formatoEseTruper($datovivienda,$ese_id=$id);
            $html_pagina_2=str_replace("#domiciliocandidato_data_pagina_2#", $html_pagina_2_seccion_data,$html_pagina_2);


            $mpdf->WriteHTML($html_pagina_2);
            //pagina 2 fin


                #encabezado#
            //pagina 3 inicio 1er parte
            $mpdf->AddPage();
            

            $domicilioanteriror_data= new Datoviviendanterdetalles();
            $html_pagina_3_domicilioviviendaanterior=$domicilioanteriror_data->formatoEseTruper($datovivienda,$ese_id=$id);
            $mpdf->WriteHTML($html_pagina_3_domicilioviviendaanterior);

            //pagina  3 ,2da parte


            //pagina4 inicio
            $mpdf->AddPage();
            $datoacademicos_data= new Datoescolar();
            $html_pagina_4_datoacademicos_data=$datoacademicos_data->formatoEseTruper($datoescolar,$estadosalud,$antecedentesocial);
            $mpdf->WriteHTML($html_pagina_4_datoacademicos_data);

            //pagina4 fin


            //pagina5 inicio
            $mpdf->AddPage();
            $datogrupofamiliardetalles_data= new Datogrupofamiliardetalles();
            $html_pagina_5_datogrupofamiliardetalles_data=$datogrupofamiliardetalles_data->formatoEseTruper($datogrupofamiliar,$ese_id=$id);
            $mpdf->WriteHTML($html_pagina_5_datogrupofamiliardetalles_data);

            //pagina5 fin


            //pagina6 inicio
                $mpdf->AddPage();
                $Datocomprobatorio_data= new Datocomprobatorio();
                $html_pagina_6_Datocomprobatorio_data=$Datocomprobatorio_data->formatoEseTruper($datocomprobatorio,$ese_id=$id,$datogrupofamiliar);
                $mpdf->WriteHTML($html_pagina_6_Datocomprobatorio_data);
        
            //pagina6 fin



            //pagina7 inicio
            $mpdf->AddPage();
            $situaacionfinanciera_data= new Situacionfinanciera();
            $html_pagina_7_situacionfinanciera=$situaacionfinanciera_data->formatoEseTruper($ese_id=$id,$situacioneconomica,$situacioneconomicafamiliar);
            $mpdf->WriteHTML($html_pagina_7_situacionfinanciera);
            //pagina7 fin


            //pagina8 inicio
            $mpdf->AddPage();
            $bieninmueble_data= new Bieninmueble();
            $html_pagina_8_bieninmueble_data=$bieninmueble_data->formatoEseTruper($bieninmueble, $antecedentesocial, $automoviles, $bieninmuebledetalles, $ese_id=$id);
            $mpdf->WriteHTML($html_pagina_8_bieninmueble_data);
            //pagina8 fin


            //pagina9 y 10 inicio
                $mpdf->AddPage();
                $referenciaslaboral_data= new Referencialaboral();
                $html_pagina_9_10_referencias_data=$referenciaslaboral_data->formatoEseTruper($ese_id=$id,$seccionlaboral,$referencialaborales,$estudio);
                $mpdf->WriteHTML($html_pagina_9_10_referencias_data);
            //pagina9y10 fin


        //pagina11 inicio
            $mpdf->AddPage();
            $trayectorialaboral_data= new Trayectorialaboral();
            $html_pagina_11_trayectorialaboral_data=$trayectorialaboral_data->formatoEseTruper($ese_id=$id,$seccionlaboral,$trayectorialaboralregistrado_data);
            $mpdf->WriteHTML($html_pagina_11_trayectorialaboral_data);
        //pagina11 fin


            //pagina12 inicio
            $mpdf->AddPage();
            $referencias_data= new Referencias();
            $html_pagina_12_referencias_data=$referencias_data->formatoEseTruper($ese_id=$id,$seccionespersonales,$referenciavecinales,$referenciafamiliares,$referenciapersonales);
            $mpdf->WriteHTML($html_pagina_12_referencias_data);
            //pagina12 fin


            
            //pagina13 inicio
            $mpdf->AddPage();
            $evaluaciontruper_data= new Evaluaciontruper();
            $html_pagina_13_evaluaciontruper_data=$evaluaciontruper_data->formatoEseTruper($ese_id=$id,$evaluaciontruper);
            $mpdf->WriteHTML($html_pagina_13_evaluaciontruper_data);
            //pagina13 fin


                
            //pagina14 inicio
            $mpdf->AddPage();
                $datocliente_data= new Estudio();
                $html_pagina_14_datocliente_data=$datocliente_data->formatoEseTruperDatosCliente($ese_id=$id,$estudio,$empresa, $filename, $qrfolio, $qrfecha);
                $mpdf->WriteHTML($html_pagina_14_datocliente_data);
            //pagina14 fin


            //pagina15 y 16 inicio------------------------------------------------------------------ARCHIVOS 
            $archivo_data= new Archivo();

            //AVISO DE PRIVACIDAD------------------------------------------------AVISO DE PRIVACIDAD
            $limite_agregar_archivos_privacidad = 2;
            $aviso_priv=Archivo::query()
                ->columns('Archivo.arc_nombre, cat.cat_nombre, cat.cat_truperadjunto, cat.cat_prioridad')
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->where('ese_id='.$id.' and Archivo.arc_estatus=2 and cat.cat_id=8')
                ->limit($limite_agregar_archivos_privacidad)
                ->execute();
            if(count($aviso_priv)>0){
                    $html_pagina_15_archivo_data=$archivo_data->registrosDinamicosAdjuntadosReporte($aviso_priv,$mpdf);    
            }   
            ///AVISO DE PRIVACIDAD------------------------------------------------------------------------FIN

            $comprobantedomicilio=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=13')
            ->execute();
            $selfie=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=7')
            ->execute();


            if(count($comprobantedomicilio)>0 || count($selfie)>0 ){
                $mpdf->AddPage();
                $html_pagina_16_archivo_data=$archivo_data->formatoEseTruperAnexosFinalesPagina16($ese_id=$id,$comprobantedomicilio,$selfie);
                $mpdf->WriteHTML($html_pagina_16_archivo_data);
            
            }
        

            
            //anexos adjuntos de manera dinamica incio
            $data_archivos_adjuntos=Archivo::query()
                ->columns('Archivo.arc_nombre, cat.cat_nombre, cat.cat_truperadjunto, cat.cat_prioridad')
                ->where('Archivo.arc_estatus="2" and Archivo.arc_reporte="1" and cat.cat_truperadjunto="1" and Archivo.ese_id='.$id)
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->orderBy('cat.cat_prioridad')
                ->execute();

                //validamos que exista data
                if(count($data_archivos_adjuntos)>0){
                    $html_pagina_archivos_adjuntos=$archivo_data->registrosDinamicosAdjuntadosReporte($data_archivos_adjuntos,$mpdf);
                }
        
            //anexos adjunto sde manera dinamica fin

            //inicio de sección de referencias laborales
            $anexosreferenciastotal=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where("arc_estatus=2 and cat.cat_id=31 and ese_id=$id")
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();

            if(count($anexosreferenciastotal)>0){
                $modelanexosreferencias= new Archivo();
                $html=$modelanexosreferencias->anexos_pagina_referencias();
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }

            $modelanexosreferencias= new Anexo();
            $condicion_anexosreferencias=
            "arc_estatus=2 and cat.cat_id=31 and arc_nombre not like '%.pdf' and ese_id=$id";
    
            $anexosreferencias=Archivo::query()
            ->columns('arc_nombre,arc_estatus,arc_reporte,ese_id,Archivo.cat_id,cat.cat_nombre')
            ->where($condicion_anexosreferencias)
            ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
            ->orderBy('cat_prioridad')
            ->execute();
    
            if(count($anexosreferencias)>0){   
                    $html=$modelanexosreferencias->formatoesesreferencias($ese_id=$id,$anexosreferencias);
                    // $mpdf->AddPage();
                    $mpdf->WriteHTML($html);

            }

            $anexoreferenciacorreo=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=31 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexoreferenciacorreo)>0){
                $reporte= new PdfReporte();
                $html=$reporte->anexoreferencias;

                $mpdf->WriteHTML($html);
                
                if(count($anexoreferenciacorreo)==1){
                    $coorx=60;
                    $coory=-1;
                    $tamaniox=95;
                    $tamanioy=120;
                    if($mpdf->y>=160){
                        $mpdf->AddPage();
                        $tamaniox=180;
                        $tamanioy=227;
                        $coorx=-1;
                        $coory=-1;
                    }
                    $mpdf->SetImportUse();
                    $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[0]->arc_nombre);
                    $import_page = $mpdf->ImportPage($pagecount);
                    $mpdf->UseTemplate($import_page,$coorx,$coory,$tamaniox,$tamanioy);
                }else{
                    $mpdf->SetImportUse();
                    $bandera=1;
                    for($i=0; $i<count($anexoreferenciacorreo); $i++){
                        if($mpdf->y>=160){
                            $mpdf->AddPage();
                        }
                        $coorx=-1;
                        if($i % 2 != 0){
                            $coorx=110;
                        }
                        $pagecount = $mpdf->SetSourceFile("archivos/".$anexoreferenciacorreo[$i]->arc_nombre);
                        $import_page = $mpdf->ImportPage($pagecount);
                        $mpdf->UseTemplate($import_page,$coorx,-1, 95,120);
                        if($bandera==2){
                            $mpdf->y= $mpdf->y + 120;
                            $bandera=0;
                        }
                        $bandera++;
                    }
                }
            }
            //fin de sección de referencias laborales

            $anexosemanacotizada=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=15 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexosemanacotizada)>0){
                $reporte= new PdfReporteTruper();
                $html=$reporte->anexos_semanas_cotizadas_pdf;

                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
                
                $mpdf->SetImportUse(); // only with mPDF <8.0

                $mpdf->Thumbnail("archivos/".$anexosemanacotizada[0]->arc_nombre, 2, 5);
            }
            //pagina15 y 16 fin  

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un ESE con ID: ".$id." en FORMATO TRUPER";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato ESES";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            if($correo==1){
                $nombre='Estudio'.$id.'.pdf';
                $mpdf->Output('reporte/estudios/'.$nombre,'F');
                // $mpdf->Output($nombre,'I');
                return $nombre;
            }else{
                $mpdf->SetTitle("Estudio ESE TRUPER ".$id);
                $mpdf->Output('Estudio-FormatoTruper'.$id.'.pdf','I');
            }
        } catch (Exception $e) {
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
 
    }


    public function formatotruper_ventasAction($id_, $correo=0){
        try {
        
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];
            if($id<=0 || !is_numeric($id)) //el número en la funcion es el correspondiente a la bdd
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("ID no válido.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
    
            $rol = new Rol();
            $auth = $this->session->get('auth');

            if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
            }
            


            date_default_timezone_set('america/mexico_city');
            // $host=$_SERVER["HTTP_HOST"];
            $host="https://sadisips.com/";
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            $carpeta=$config->application->baseUri;
            $url=$host.$carpeta."consulta/validaqr/";

            $estudio=Estudio::findFirstByese_id($id);
            

            //VALIDACION DE LLENADO DE SECCIONES INICIO-----------------------------------------------------------------------------------------VALIDACION DE LLENADO DE SECCIONES INICIO

            if(!$estudio) //si no existe el estudio
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existe el estudio.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $empresas=new Builder();
                $empresas=$empresas
                ->addFrom('Empresa','e')
                ->where('emp_id='.$estudio->emp_id)
                ->getQuery()
                ->execute();
            $empresa= $empresas[0];

            //secion a -datos finales

            $datosfinales_data=new Builder();
            $datosfinales_data=$datosfinales_data
            // ->columns()
            ->addFrom('Datofinal','daf')
            ->where('daf_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
    


            //seccion B
            $datovivienda=new Builder();
            $datovivienda=$datovivienda
            // ->columns()
            ->addFrom('Datovivienda','dav')
            ->where('dav_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
            if(count($datovivienda)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos vivienda cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datovivienda= $datovivienda[0];

            //seccion c
            $datoescolar=new Builder();
            $datoescolar=$datoescolar
            // ->columns()
            ->addFrom('Datoescolar','dae')
            ->where('dae_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
            if(count($datoescolar)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos escolares cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datoescolar= $datoescolar[0];


            //  $estadosalud=new Builder();
            //  $estadosalud=$estadosalud
            //  // ->columns()
            //  ->addFrom('Estadosalud','ess')
            //  ->where('ess_estatus=2 and ese_id='.$id)
            //  ->getQuery()
            //  ->execute();
        
            //  if(count($estadosalud)<=0) //si no existen datos comprobatorios
            //  {
            //     if($correo==1){
            //         return 'error';
            //     }
            //      $this->flash->error("No existen datos salud cargados.");
            //      $this->response->redirect('index/panel');
            //      $this->view->disable();
            //      return;   
            //  }
            //  $estadosalud= $estadosalud[0];


            //seccion D
            $estadosdesalud=new Builder();
                $estadosdesalud=$estadosdesalud
                // ->columns()
                ->addFrom('Estadosalud','d')
                ->where('ess_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($estadosdesalud)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de estado de salud cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $estadosalud= $estadosdesalud[0];

            
            
            $antecedentesocial=new Builder();
            $antecedentesocial=$antecedentesocial
            // ->columns()
            ->addFrom('Antecedentesocial','ans')
            ->where('ans_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
                if(count($antecedentesocial)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de antecedentes sociales cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
            $antecedentesocial= $antecedentesocial[0];
            //seccion E
            $datogrupofamiliares=new Builder();
            $datogrupofamiliares=$datogrupofamiliares
            // ->columns()
            ->addFrom('Datogrupofamiliar','d')
            ->where('dgf_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();

            if(count($datogrupofamiliares)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos del grupo familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $datogrupofamiliar= $datogrupofamiliares[0];
            

            //seccion F
            $datoscomprobatorios=new Builder();
                $datoscomprobatorios=$datoscomprobatorios
                // ->columns()
                ->addFrom('Datocomprobatorio','d')
                ->where('cop_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
            if(count($datoscomprobatorios)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos comprobatorios cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $datocomprobatorio= $datoscomprobatorios[0];

            //seccion G
            $situacioneseconomicas=new Builder();
            $situacioneseconomicas=$situacioneseconomicas
            // ->columns()
            ->addFrom('Situacioneconomica','d')
            ->where('sie_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();

            if(count($situacioneseconomicas)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de situación económica candidato cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $situacioneconomica= $situacioneseconomicas[0];

            $situacioneconomicafamiliar=new Builder();
            $situacioneconomicafamiliar=$situacioneconomicafamiliar
            // ->columns()
            ->addFrom('Situacioneconomicafamiliar','sef')
            ->where('sef_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();

            if(count($situacioneconomicafamiliar)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de situación económica familiar cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            $situacioneconomicafamiliar= $situacioneconomicafamiliar[0];


            //seccion H
                $bienesinmuebles=new Builder();
                    $bienesinmuebles=$bienesinmuebles
                    ->addFrom('Bieninmueble','d')
                    ->where('bie_estatus=2 and ese_id='.$id)
                    ->getQuery()
                    ->execute();
                
                if(count($bienesinmuebles)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de bienes inmuebles cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
                $bieninmueble= $bienesinmuebles[0];

                $bieninmuebledetalles=new Builder();
                    $bieninmuebledetalles=$bieninmuebledetalles
                    ->addFrom('Bieninmuebledetalles','d')
                    ->where('bid_estatus=2 and bie_id='.$bieninmueble->bie_id)
                    ->getQuery()
                    ->execute();

                $automoviles=new Builder();
                    $automoviles=$automoviles
                    ->addFrom('Automovil','d')
                    ->where('aut_estatus=2 and bie_id='.$bieninmueble->bie_id)
                    ->getQuery()
                    ->execute();
                
            //seccion I

            $seccioneslaborales=new Builder();
            $seccioneslaborales=$seccioneslaborales
            ->addFrom('Seccionlaboral','d')
            ->where('sel_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
        
            if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de seccion laboralcargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionlaboral= $seccioneslaborales[0];

            $referencialaborales=new Builder();
            $referencialaborales=$referencialaborales
            ->addFrom('Referencialaboral','rel')
            ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->orderBy('rel_orden')
            ->getQuery()
            ->execute();
        
            if(count($referencialaborales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias laborales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }


            //pagina 11

            

            $trayectorialaboralregistrado_data=new Builder();
            $trayectorialaboralregistrado_data=$trayectorialaboralregistrado_data
            ->addFrom('Trayectorialaboralregistrado','tlr')
            ->where('tlr_estatus=2 and sel_id='.$seccionlaboral->sel_id)
            ->getQuery()
            ->execute();
        
            if(count($trayectorialaboralregistrado_data)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de trayectoria laboral cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }

            $trayectorialaboralregistrado_data= $trayectorialaboralregistrado_data[0];

            
            //seccion J-pag 12

            $seccionespersonales=new Builder();
            $seccionespersonales=$seccionespersonales
            ->addFrom('Seccionpersonal','sep')
            ->where('sep_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
            
            if(count($seccionespersonales)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de referencias personales cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $seccionpersonal= $seccionespersonales[0];

            $referenciavecinales=new Builder();
            $referenciavecinales=$referenciavecinales
            ->addFrom('Referenciavecinal','rev')
            ->where('rev_estatus=2 and sep_id='.$seccionpersonal->sep_id)
            ->getQuery()
            ->execute();
        
        if(count($referenciavecinales)<=0) //si no existen datos comprobatorios
        {
            if($correo==1){
                return 'error';
            }
            $this->flash->error("No existen datos de referencias vecinales cargados.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        $referenciafamiliares=new Builder();
        $referenciafamiliares=$referenciafamiliares
        ->addFrom('Referenciafamiliar','ref')
        ->where('ref_estatus=2 and sep_id='.$seccionpersonal->sep_id)
        ->getQuery()
        ->execute();
    
        if(count($referenciafamiliares)<=0) //si no existen datos comprobatorios
        {
            if($correo==1){
                return 'error';
            }
            $this->flash->error("No existen datos de referencias familiares cargadas.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }


        
        $referenciapersonales=new Builder();
        $referenciapersonales=$referenciapersonales
        ->addFrom('Referenciapersonal','d')
        ->where('rep_estatus=2 and sep_id='.$seccionpersonal->sep_id)
        ->getQuery()
        ->execute();
    
        if(count($referenciapersonales)<=0) //si no existen datos comprobatorios
        {
                if($correo==1){
                    return 'error';
                }
            $this->flash->error("No existen datos de referencias personales cargados.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

            //seccion final pagina 13
        
            $evaluaciontruper=new Builder();
            $evaluaciontruper=$evaluaciontruper
            ->addFrom('Evaluaciontruper','evt')
            ->where('evt_estatus=2 and ese_id='.$id)
            ->getQuery()
            ->execute();
            
            if(count($evaluaciontruper)<=0) //si no existen datos comprobatorios
            {
                if($correo==1){
                    return 'error';
                }
                $this->flash->error("No existen datos de evaulacion final truper cargados.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;   
            }
            $evaluaciontruper= $evaluaciontruper[0];

        



            //NVRL--VALIDACION DE LLENADO DE SECCIONES INICIO-----------------------------------------------------------------------------------------VALIDACION DE LLENADO DE SECCIONES INICIO

            $qrfolio="";
            $qrfecha="";
            if($estudio->ese_estatus==7){
                $qrfolio=$estudio->ese_id;

                $fecha_fin= $estudio->ese_fechaentregacliente;
                $fin= new DateTime($fecha_fin);
                $qrfecha=$fin->format('d-m-Y');

                include('phpqrcode/qrlib.php');

                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'temp/';

                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);

                //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'qr.png';

                //Parametros de Configuración
                $tamaño = 6; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 1; //Tamaño en blanco
                $contenido = $url.$id; //Texto

                //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            }else{
                $filename='iniciador.jpg';
            }

            $this->view->disable();
            // $var = 1;
            $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

            $reporte_completo= new PdfReporteTruper();
            $estudio_datospersonales= new Datopersonal();

            //dandole formato cabezera y footer

            


                $var_header=str_replace("#logo_header#",basename('images/sips_documento.png'),$reporte_completo->cabezera_hoja);


                $mpdf->SetHTMLHeader($var_header,'O');

                $mpdf->SetHTMLFooter($reporte_completo->header_hoja);

                $mpdf->SetTitle('ESE TRUPER-VENT No.'.$id);
                $mpdf->SetAuthor('SIPS | SADI');
            
                
            //dandole formato cabezera y footer-fin


            //escribiendo pagina 1
            $estudio_datospersonales_html=$estudio_datospersonales->formatoEseTruper($estudio,$datosfinales_data);
            $mpdf->WriteHTML($estudio_datospersonales_html);
            //escribiendo pagina 1 fin



            //pagina 2 inicio 1er parte
            $mpdf->AddPage();
            
            $domicilio_imgs_pagina_2= new Anexo( );
            $html_pagina_2=$domicilio_imgs_pagina_2->formatoEseTruper($ese_id=$id);

            //pagina  2 ,2da parte

            
            $domicilio_data_pagina_2= new Datovivienda();

            $html_pagina_2_seccion_data=$domicilio_data_pagina_2->formatoEseTruper($datovivienda,$ese_id=$id);
            $html_pagina_2=str_replace("#domiciliocandidato_data_pagina_2#", $html_pagina_2_seccion_data,$html_pagina_2);


            $mpdf->WriteHTML($html_pagina_2);
            //pagina 2 fin


                #encabezado#
            //pagina 3 inicio 1er parte
            $mpdf->AddPage();
            

            $domicilioanteriror_data= new Datoviviendanterdetalles();
            $html_pagina_3_domicilioviviendaanterior=$domicilioanteriror_data->formatoEseTruper($datovivienda,$ese_id=$id);
            $mpdf->WriteHTML($html_pagina_3_domicilioviviendaanterior);

            //pagina  3 ,2da parte


            //pagina4 inicio
            $mpdf->AddPage();
            $datoacademicos_data= new Datoescolar();
            $html_pagina_4_datoacademicos_data=$datoacademicos_data->formatoEseTruper($datoescolar,$estadosalud,$antecedentesocial);
            $mpdf->WriteHTML($html_pagina_4_datoacademicos_data);

            //pagina4 fin


            //pagina5 inicio
            $mpdf->AddPage();
            $datogrupofamiliardetalles_data= new Datogrupofamiliardetalles();
            $html_pagina_5_datogrupofamiliardetalles_data=$datogrupofamiliardetalles_data->formatoEseTruper($datogrupofamiliar,$ese_id=$id);
            $mpdf->WriteHTML($html_pagina_5_datogrupofamiliardetalles_data);

            //pagina5 fin


            //pagina6 inicio
                $mpdf->AddPage();
                $Datocomprobatorio_data= new Datocomprobatorio();
                $html_pagina_6_Datocomprobatorio_data=$Datocomprobatorio_data->formatoEseTruper($datocomprobatorio,$ese_id=$id,$datogrupofamiliar);
                $mpdf->WriteHTML($html_pagina_6_Datocomprobatorio_data);
        
            //pagina6 fin



            //pagina7 inicio
            $mpdf->AddPage();
            $situaacionfinanciera_data= new Situacionfinanciera();
            $html_pagina_7_situacionfinanciera=$situaacionfinanciera_data->formatoEseTruper($ese_id=$id,$situacioneconomica,$situacioneconomicafamiliar);
            $mpdf->WriteHTML($html_pagina_7_situacionfinanciera);
            //pagina7 fin


            //pagina8 inicio
            $mpdf->AddPage();
            $bieninmueble_data= new Bieninmueble();
            $html_pagina_8_bieninmueble_data=$bieninmueble_data->formatoEseTruper($bieninmueble, $antecedentesocial, $automoviles, $bieninmuebledetalles, $ese_id=$id);
            $mpdf->WriteHTML($html_pagina_8_bieninmueble_data);
            //pagina8 fin


            //pagina9 y 10 inicio
                $mpdf->AddPage();
                $referenciaslaboral_data= new Referencialaboral();
                $html_pagina_9_10_referencias_data=$referenciaslaboral_data->formatoEseTruper($ese_id=$id,$seccionlaboral,$referencialaborales,$estudio);
                $mpdf->WriteHTML($html_pagina_9_10_referencias_data);
            //pagina9y10 fin


        //pagina11 inicio
            $mpdf->AddPage();
            $trayectorialaboral_data= new Trayectorialaboral();
            $html_pagina_11_trayectorialaboral_data=$trayectorialaboral_data->formatoEseTruper($ese_id=$id,$seccionlaboral,$trayectorialaboralregistrado_data);
            $mpdf->WriteHTML($html_pagina_11_trayectorialaboral_data);
        //pagina11 fin


            //pagina12 inicio
            $mpdf->AddPage();
            $referencias_data= new Referencias();
            $html_pagina_12_referencias_data=$referencias_data->formatoEseTruper($ese_id=$id,$seccionespersonales,$referenciavecinales,$referenciafamiliares,$referenciapersonales);
            $mpdf->WriteHTML($html_pagina_12_referencias_data);
            //pagina12 fin


            
            //pagina13 inicio
            $mpdf->AddPage();
            $evaluaciontruper_data= new Evaluaciontruper();
            $html_pagina_13_evaluaciontruper_data=$evaluaciontruper_data->formatoEseTruper($ese_id=$id,$evaluaciontruper);
            $mpdf->WriteHTML($html_pagina_13_evaluaciontruper_data);
            //pagina13 fin


                
            //pagina14 inicio
            $mpdf->AddPage();
                $datocliente_data= new Estudio();
                $html_pagina_14_datocliente_data=$datocliente_data->formatoEseTruperDatosCliente($ese_id=$id,$estudio,$empresa, $filename, $qrfolio, $qrfecha);
                $mpdf->WriteHTML($html_pagina_14_datocliente_data);
            //pagina14 fin


            //pagina15 a la 23 inicio

        //15
            $archivo_data= new Archivo();
            $semanas_cotizadas=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=15 and  arc_nombre NOT LIKE "%.pdf" ' )
            //->where("ese_id= $ese_id and arc_estatus=2 and cat_id=15 and  RIGHT(arc_nombre,3) != '$lastCharacters'  " )
            ->execute();
            if(count($semanas_cotizadas)>0){
                $mpdf->AddPage();

                $html_pagina_15_archivo_data=$archivo_data->formatoEseTruperVentas_semanas_cotizadas_imss($ese_id=$id,$semanas_cotizadas);
                $mpdf->WriteHTML($html_pagina_15_archivo_data);
            }

        


            //16
            $situacionlegal=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=16')
            ->execute();



            if(count($situacionlegal)>0){
                $mpdf->AddPage();
                $html_pagina_16_archivo_data=$archivo_data->formatoEseTruperVentas_situacion_legal($ese_id=$id,$situacionlegal);
                $mpdf->WriteHTML($html_pagina_16_archivo_data);
        
            }
        
            //17
            $identificacion_oficial=Archivo::query()
            ->where('ese_id='.$ese_id.' and arc_estatus=2 and cat_id=22')
            ->execute();

            $curp =Archivo::query()
            ->where('ese_id='.$ese_id.' and arc_estatus=2 and cat_id=23')
            ->execute();
            if(count($curp)>0 || count($identificacion_oficial)>0){
                $mpdf->AddPage();
                $html_pagina_17_archivo_data=$archivo_data->formatoEseTruperVentas_identificacion_curp($ese_id=$id,$identificacion_oficial,$curp);
                $mpdf->WriteHTML($html_pagina_17_archivo_data);
            }
        
            //18
            
            $actanacimiento=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=24')
            ->execute();
            if(count($actanacimiento)>0){
                $mpdf->AddPage();
                $html_pagina_18_archivo_data=$archivo_data->formatoEseTruperVentas_actanacimiento($ese_id=$id,$actanacimiento);
                $mpdf->WriteHTML($html_pagina_18_archivo_data);
            }
            
        

            //19
            $comprobantedomicilio=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=13')
            ->execute();

            $cartillamilitar=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=19')
            ->execute();
    
            if(count($comprobantedomicilio)>0 ||  count($cartillamilitar)>0){
                $mpdf->AddPage();
                $html_pagina_19_archivo_data=$archivo_data->formatoEseTruperVentas_cartilla_domicilio($ese_id=$id,$comprobantedomicilio,$cartillamilitar);
                $mpdf->WriteHTML($html_pagina_19_archivo_data);
    
            }
            
            
            //20

            $constanciadeestudios=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=17')
            ->execute();
            if(count($constanciadeestudios)>0){

                $mpdf->AddPage();
                $html_pagina_20_archivo_data=$archivo_data->formatoEseTruperVentas_constanciaestudios($ese_id=$id,$constanciadeestudios);
                $mpdf->WriteHTML($html_pagina_20_archivo_data);
        
            }

        

            //21
            $constanciaslaborales=Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=18')
            ->execute();

            if(count($constanciaslaborales)>0){
                $mpdf->AddPage();
                $html_pagina_21_archivo_data=$archivo_data->formatoEseTruperVentas_constancialaborales($ese_id=$id,$constanciaslaborales);
                $mpdf->WriteHTML($html_pagina_21_archivo_data);
        
            }


        

            //22

                $rfc=Archivo::query()
                ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=20')
                ->execute(); 
                $afore=Archivo::query()
                ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=21')
                ->execute();
                
                if(count($rfc)>0 ||count($afore)>0 ){

                    $mpdf->AddPage();
                    $html_pagina_22_archivo_data=$archivo_data->formatoEseTruperVentas_rfc_afore($ese_id=$id,$rfc,$afore);
                    $mpdf->WriteHTML($html_pagina_22_archivo_data);

                }
            
    
            //23----AVISO DE PRIVACIDAD INICIO------------------------------------------------------------------------AVISO DE PRIVACIDAD INICIO
            
            $aviso_privacidad =Archivo::query()
            ->where('ese_id='.$id.' and arc_estatus=2 and cat_id=8')
            ->execute();

            if(count($aviso_privacidad)>0){
                    $mpdf->AddPage();
                $html_pagina_23_archivo_data=$archivo_data->formatoEseTruperVentas_aviso_privacidad($ese_id=$id,$aviso_privacidad);
                $mpdf->WriteHTML($html_pagina_23_archivo_data);

                }
    
        
            //pagina15  a la 23 fin----AVISO DE PRIVACIDAD INICIO------------------------------------------------------------------------AVISO DE PRIVACIDAD INICIO

            $anexosemanacotizada=Archivo::query()
                ->columns('arc_nombre')
                ->where("arc_estatus=2 and cat.cat_id=15 and arc_nombre like '%.pdf' and ese_id=$id")
                ->join('Categoria','cat.cat_id=Archivo.cat_id','cat')
                ->execute();

            if(count($anexosemanacotizada)>0){
                $reporte= new PdfReporteTruper();
                $html=$reporte->anexos_semanas_cotizadas_pdf;

                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
                
                $mpdf->SetImportUse(); // only with mPDF <8.0

                $mpdf->Thumbnail("archivos/".$anexosemanacotizada[0]->arc_nombre, 2, 5);
            }



            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un ESE con ID: ".$id." en FORMATO TRUPER VENTAS";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $databit['bit_modulo']="Formato ESES";
            $bitacora->NuevoRegistro($databit);

            // $mpdf->Output();
            if($correo==1){
                $nombre='Estudio'.$id.'.pdf';
                $mpdf->Output('reporte/estudios/'.$nombre,'F');
                return $nombre;
            }else{
                $mpdf->SetTitle("Estudio ESE TUPER VENTAS ".$id);
                $mpdf->Output('Estudio-FormatoTruper-Ventas-'.$id.'.pdf','I');
            }

        }catch(Exception $e) {
            // Manejar la excepción aquí, por ejemplo, mostrar un mensaje de error o registrar la excepción en un archivo de registro.
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
        
    }


    public function comentarioese_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(68,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        $indexusu=-1;
        $this->usuario = new Usuario();
        $usuarioselect=$this->usuario->getlistausuario();
        $this->view->indexusu=$indexusu;
        $this->view->usuarioselect=$usuarioselect;

        $tipoEstudioSelect=Tipoestudio::find("tip_estatus=2");

        $this->view->tipoEstudios=$tipoEstudioSelect;

    }
    public function comentarioese_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Buscó datos de comentarios.';


        $auth = $this->session->get('auth');
        if(!$rol->verificar(68,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $condicion='com_estatus=2';
            
            if($data['com_fechainicial'] != '')
            {
                $descripcion_bitacora.=' Filtro fecha inicial: '.$data['com_fechainicial'];
                $condicion.=" and com_fecharegistro >= '".$data['com_fechainicial']."'";
            }

            if($data['com_fechafinal'] != '')
            {
                $descripcion_bitacora.=' Filtro fecha final: '.$data['com_fechafinal'];
                $condicion.=" and com_fecharegistro <= '".$data['com_fechafinal']." 23:59:59'";
            }

            if($data["tip_id"]!="-1"){
                $condicion.=' and t.tip_id = '.$data["tip_id"] ;
                $filtro=Tipoestudio::findFirstBytip_id($data["tip_id"]);
                $descripcion_bitacora.=', filtro de tipo de estudio de : '.$filtro->tip_nombre;
            }

            if($data["usu_id"]!="-1"){
                $condicion.=' and u.usu_id = '.$data["usu_id"] ;
                $filtro=Usuario::findFirstByusu_id($data["usu_id"]);
                $descripcion_bitacora.=', filtro de usuario de : '.$filtro->usu_nombre;
            }

            if($data["com_regresoautoriza"]!="-1"){
                $condicion.=' and com_regresoautoriza = '.$data["com_regresoautoriza"] ;
                // $filtro=Usuario::findFirstByusu_id($data["usu_id"]);
                $descripcion_bitacora.=', filtro de usuario de regresados de autorización ';
            }
                    
            //consulta incio
            $registros=Comentarioese::query()
            ->columns("CONCAT(u.usu_nombre,' ', u.usu_primerapellido,' ', u.usu_segundoapellido) as registra, com_comentario, 
                    com_fecharegistro as fecharegistro, Comentarioese.ese_id, com_regresoautoriza, tip_nombre
                        ")
            ->join('Estudio','Comentarioese.ese_id=e.ese_id','e')
            ->join('Usuario','u.usu_id=Comentarioese.usu_id','u')
            ->join('Tipoestudio','t.tip_id=e.tip_id','t')
            ->where($condicion)
            ->execute();

            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reportes de incidencia";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
        }
        $this->usuario = new Usuario(); 
        // $this->empresa =new Empresa();
        // $this->reporte =new Reporte();

        // $this->view->estudiomodel = new Estudio();

        $this->view->usuario = $this->usuario;
        // $this->view->reporte= $this->reporte;

        $this->view->fechainicio= $data['ine_fechainicial'];
        $this->view->fechafin= $data['ine_fechafinal'];
        $this->view->page=$registros;

    }
    /** 
     * REPORTE PDF de respuestas de encuesta calidad por mes
     * @param  $mes,$anio,$tipo_grafica=grafica de barrar o de pastel (1,0) y $inv_id
     * @return PDF
     * 
    */
    
    public function  respuesta_estadisticas_servicio_calidadAction($mes=0,$anio=0,$tipo_grafica=0,$inv_id=0){
        $descripcion_bitacora='Consultó datos del reporte de repuesta ';
        $this->view->disable();

        $rol = new Rol();
        date_default_timezone_set('america/mexico_city');

        //VALIDAMOS PERMISOS
        $auth = $this->session->get('auth');
        if(!$rol->verificar(74,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
          
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        } 

        //validamos el parametro
        $mes =$mes; 
        $anio = $anio;
        $dia = 1;//este es solo para validar la fecha
       
        if($mes==0 || $anio==0 || (checkdate($mes, $dia, $anio)==false)){
            $this->flash->error("Fechas incorrectas.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        if(!is_numeric($tipo_grafica) || $tipo_grafica>2 || $tipo_grafica<0){
            $this->flash->error("¿Tipo de formato?.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        if($inv_id<0){

            $this->flash->error("Parametros no validos...");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;  
        }
        if($inv_id>0){
            $investigador=Usuario::findFirstByusu_id($inv_id);

            if($investigador==false){
                $this->flash->error("Parametros no validos...");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;  
            }else{
                $descripcion_bitacora.=' con los datos del investigador '.$investigador->getNombreObj();

            }
        }
     


        //validamos que exista data existente
        $obj_enc_normal=new Encuesta();
        $respuesta_modelo_respuestas_ordenadas=$obj_enc_normal->getRespuestasDeManeraOrdenada($mes,$anio,$inv_id);
        if(count($respuesta_modelo_respuestas_ordenadas)==0){
            $this->flash->error("No hay datos disponibles.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }


        //consultar datos fin


        //empezando a generar pdf 
       $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",25,25,25,0,8,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación
       $mpdf->SetTitle('REPORTE RESPUESTAS');
       $mpdf->SetAuthor('SIPS | SADI'); 
       $mpdf->SetAutoPageBreak(true, 20);


        //consultar datos incio
            //instanciamos valores
            $reporte_completo= new PdfRerporteEncuestaCalidadServicio();

           $obj_enc=new Encuestacalidad();
           $obj_pre=new Pregunta();
                //validamos que exista estudios realizados 
                $estadisticas_detalle=$obj_enc->getDestallesDelMesEncuestas($mes,$anio,$inv_id);
                if($estadisticas_detalle['total_eses']==0 || $estadisticas_detalle['total_encuestas_contestadas']==0){
                    $this->flash->error("No hay estudios o encuestas relacionadas de este investigador.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
               $estadisticas_respuestas=$obj_enc->getEstadisticasTodasLasRespuestas($mes,$anio,$inv_id);
               $data_comentarios= $obj_enc_normal->getRespuestaPreguntasAbiertas($mes,$anio,$inv_id);
               $data_comentarios_7_1=$obj_enc_normal->getRespuestaPreguntasAbiertasPregunta7_1($mes,$anio,$inv_id);
               $data_comentarios_8_1=$obj_enc_normal->getRespuestaPreguntasAbiertasPregunta8_1($mes,$anio,$inv_id);
               $data_comentarios_12_1=$obj_enc_normal->getRespuestaPreguntasAbiertasPregunta12_1($mes,$anio,$inv_id);
               $data_comentarios_15_1=$obj_enc_normal->getRespuestaPreguntasAbiertasPregunta15_1($mes,$anio,$inv_id);

        
               $data_comentarios_17_1=$obj_enc_normal->getRespuestaPreguntasAbiertasPregunta17_1($mes,$anio,$inv_id);
               $data_comentarios_18=$obj_enc_normal->getRespuestaPreguntasAbiertasPregunta18($mes,$anio,$inv_id);


               $texto_preguntas_servicio=$obj_pre->getPreguntasCalidadSerivio();
               $texto_preguntas_abiertas_servicio=$obj_pre->getPreguntasAbiertaCalidadSerivio();

               $texto_opciones_respuesta_servicio=$obj_enc->getOpcionesPreguntas__Servico();
        //consultar datos fin
        



        $var_header=str_replace("#logo_header#",basename('images/sips_documento.png'),$reporte_completo->cabezera_hoja);
        $mpdf->SetHTMLHeader($var_header,'O');

        $mpdf->SetHTMLFooter($reporte_completo->header_hoja);
        $mpdf->SetTitle('Reporte respuestas encuesta calidad');
        $mpdf->SetAuthor('SIPS | SADI');



        //primera grafica

        $unix_timestamp = time();

        if($tipo_grafica==0){

            $pagina_1_html=$obj_enc->formatoPDFHoja1($estadisticas_detalle,$texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_1,$inv_id);
            $mpdf->WriteHTML($pagina_1_html);
            $mpdf->AddPage();
    
            $pagina_2_html=$obj_enc->formatoPDFHoja2($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_2);
            $mpdf->WriteHTML($pagina_2_html);
            $mpdf->AddPage();
    
            $pagina_3_html=$obj_enc->formatoPDFHoja3($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_3);
            $mpdf->WriteHTML($pagina_3_html);
            $mpdf->AddPage();
    
            $pagina_4_html=$obj_enc->formatoPDFHoja4($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_4);
            $mpdf->WriteHTML($pagina_4_html);
            $mpdf->AddPage();
    
            $pagina_5_html=$obj_enc->formatoPDFHoja5($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_5);
            $mpdf->WriteHTML($pagina_5_html);
            $mpdf->AddPage();
    
            $pagina_6_html=$obj_enc->formatoPDFHoja6($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_6);
            $mpdf->WriteHTML($pagina_6_html);
            $mpdf->AddPage();
    
           
            $pagina_7_html=$obj_enc->formatoPDFHoja7($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_7);
            $mpdf->WriteHTML($pagina_7_html);
            $mpdf->AddPage();
           
         
            $pagina_8_html=$obj_enc->formatoPDFHoja8($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_8);
            $mpdf->WriteHTML($pagina_8_html);
            $mpdf->AddPage();
       
    
       
            //validamos que exista la data
            if(isset($estadisticas_respuestas['preg_17'])){
                $pagina_9_html=$obj_enc->formatoPDFHoja9($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_9);
                $mpdf->WriteHTML($pagina_9_html);
                $mpdf->AddPage();
            }
           


         }
      
        if($tipo_grafica==1){

            $pagina_1_html=$obj_enc->formatoPDFHoja1_GraficasBarras($estadisticas_detalle,$texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_1,$inv_id);
            $mpdf->WriteHTML($pagina_1_html);
            $mpdf->AddPage();
    
            $pagina_2_html=$obj_enc->formatoPDFHoja2_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_2);
            $mpdf->WriteHTML($pagina_2_html);
            $mpdf->AddPage();
    
            $pagina_3_html=$obj_enc->formatoPDFHoja3_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_3);
            $mpdf->WriteHTML($pagina_3_html);
            $mpdf->AddPage();
    
            $pagina_4_html=$obj_enc->formatoPDFHoja4_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_4);
            $mpdf->WriteHTML($pagina_4_html);
            $mpdf->AddPage();
    
            $pagina_5_html=$obj_enc->formatoPDFHoja5_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_5);
            $mpdf->WriteHTML($pagina_5_html);
            $mpdf->AddPage();
    
            $pagina_6_html=$obj_enc->formatoPDFHoja6_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_6);
            $mpdf->WriteHTML($pagina_6_html);
            $mpdf->AddPage();
    
            $pagina_7_html=$obj_enc->formatoPDFHoja7_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_7);
            $mpdf->WriteHTML($pagina_7_html);
            $mpdf->AddPage();
    
            
            $pagina_8_html=$obj_enc->formatoPDFHoja8_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_8);
            $mpdf->WriteHTML($pagina_8_html);
            $mpdf->AddPage();
    
       
            //validamos que exista la data
            if(isset($estadisticas_respuestas['data'][16])){
            $pagina_9_html=$obj_enc->formatoPDFHoja9_GraficasBarras($texto_preguntas_servicio,$texto_opciones_respuesta_servicio,$estadisticas_respuestas,$unix_timestamp,$reporte_completo->hoja_9);
            $mpdf->WriteHTML($pagina_9_html);
            $mpdf->AddPage();
            }
        }
        

        $respuesta_modelo_9_1=$obj_enc->formatoPDFHoja9_1($texto_preguntas_abiertas_servicio,$data_comentarios_7_1,$reporte_completo->hoja_9_1,$mpdf,$texto_preguntas_servicio);

        $modelo_pagina_10=$obj_enc->formatoPDFHoja10($texto_preguntas_abiertas_servicio,$data_comentarios_8_1,$reporte_completo->hoja_10,$mpdf,$texto_preguntas_servicio);
       
        $modelo_pagina_11=$obj_enc->formatoPDFHoja11($texto_preguntas_abiertas_servicio,$data_comentarios_12_1,$reporte_completo->hoja_11,$mpdf);
        
        $modelo_15_1_html=$obj_enc->formatoPDFHoja12($texto_preguntas_abiertas_servicio,$data_comentarios_15_1,$reporte_completo->hoja_12,$mpdf,$texto_preguntas_servicio);
        
        $modelo_17_1_html=$obj_enc->formatoPDFHoja13($texto_preguntas_abiertas_servicio,$data_comentarios_17_1,$reporte_completo->hoja_13,$mpdf,$texto_preguntas_servicio);

        $modelo_18_html=$obj_enc->formatoPDFHoja14($texto_preguntas_abiertas_servicio,$data_comentarios_18,$reporte_completo->hoja_14,$mpdf);
      
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= $descripcion_bitacora;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Reportes de respuestas";
        $bitacora->NuevoRegistro($databit);
    
        $obj_enc->limpiarImagenesGeneradasReporteRespuestas($unix_timestamp);


        $mpdf->Output('Reporte-respuestas-'.$mes.'-'.$anio.'.pdf','I');
   


    }

    public function efectividad_indexAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(78,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }

        $tipoEstudioSelect=Tipoestudio::find("tip_estatus=2");
        $this->view->tipoEstudios=$tipoEstudioSelect;

        $negocioSelect=Negocio::find("neg_estatus=2");
        $this->view->negocioSelect=$negocioSelect;

        $empresaSelect=Empresa::find("emp_estatus=2");
        $this->view->empresaSelect=$empresaSelect;

        $estadoSelect=Estado::find("est_estatus=2");
        $this->view->estadoSelect=$estadoSelect;
    }

    public function efectividad_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Buscó datos de efectividad.';

        $auth = $this->session->get('auth');
        if(!$rol->verificar(78,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $condicion='ese_estatus>0';
            $descripcion_bitacora="Para la búsqueda se agregaron las siguientes condiciones";

            if($data['ese_fechainicial'] != '')
            {
                $datetime = new DateTime($data['ese_fechainicial']);
                $descripcion_bitacora.=', filtro fecha inicial: '.$datetime->format('d-m-Y');
                $condicion.=" and ese_registro >= '".$data['ese_fechainicial']."'";
            }

            if($data['ese_fechafinal'] != '')
            {
                $datetime = new DateTime($data['ese_fechafinal']);
                $descripcion_bitacora.=', filtro fecha final: '.$datetime->format('d-m-Y');
                $condicion.=" and ese_registro <= '".$data['ese_fechafinal']." 23:59:59'";
            }

            if($data["tip_id"]!="-1"){
                $condicion.=' and tip_id = '.$data["tip_id"] ;
                $filtro=Tipoestudio::findFirstBytip_id($data["tip_id"]);
                $descripcion_bitacora.=', filtro de tipo de estudio: '.$filtro->tip_nombre;
            }

            if($data["emp_id"]!="-1"){
                $condicion.=' and emp_id = '.$data["emp_id"] ;
                $filtro=Empresa::findFirstByemp_id($data["emp_id"]);
                $descripcion_bitacora.=', filtro de empresa: '.$filtro->emp_nombre;
            }

            if($data["neg_id"]!="-1"){
                $condicion.=' and n.neg_id = '.$data["neg_id"] ;
                $filtro=Negocio::findFirstByneg_id($data["neg_id"]);
                $descripcion_bitacora.=', filtro de negocio: '.$filtro->neg_nombre;
            }

            if($data["neg_id"]!="-1"){
                $registros=Estudio::query()
                ->columns("DATE_FORMAT(ese_registro,'%Y-%m-%d') as ese_registro, DATE_FORMAT(ese_fechaentregacliente,'%Y-%m-%d') as ese_fechaentregacliente, ese_estatus, ese_id")
                ->join('Empresa','Estudio.emp_id=e.emp_id','e')
                ->join('Negocio','e.neg_id=n.neg_id','n')
                ->where($condicion)
                ->execute();
            }else{
                $registros=Estudio::query()
                ->columns("DATE_FORMAT(ese_registro,'%Y-%m-%d') as ese_registro, DATE_FORMAT(ese_fechaentregacliente,'%Y-%m-%d') as ese_fechaentregacliente, ese_estatus, ese_id")
                ->where($condicion)
                ->execute();
            }

            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reporte de efectividad";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
        }

        $datos=[];
        
        $feriados=Feriado::query()
        ->columns("DATE_FORMAT(fer_fecha,'%Y-%m-%d') as fer_fecha")
        ->where('fer_estatus=2')
        ->execute();

        $datosferiados=[];
        $maxferiados=count($feriados);
        for($i=0; $i<$maxferiados; $i++){
            array_push($datosferiados,$feriados[$i]->fer_fecha);
        }
        
        $contador=0;
        if(count($registros)>0){
            $max=count($registros);
            for($i=0; $i<$max; $i++){
                if($registros[$i]->ese_estatus==7){
                    $dias= $this->diastranscurridos($registros[$i]->ese_registro,$registros[$i]->ese_fechaentregacliente,$datosferiados);
                    $object = new stdClass();
                    $object->ese_id= $registros[$i]->ese_id;
                    $object->ese_estatus=$registros[$i]->ese_estatus;
                    $object->ese_fechaentregacliente=$registros[$i]->ese_fechaentregacliente;
                    $object->ese_registro=$registros[$i]->ese_registro;
                    $object->diferencia = $dias;
                    array_push($datos,$object);
                }else{
                    $contador++;
                }
            }
        }

        $maxdatos=count($datos);
        $grupo0=0;
        $grupo1=0;
        $grupo2=0;
        $grupo3=0;
        $grupo4=0;
        $grupo5=0;
        $grupo6=0;
        $datosgrupo=[];
        for($i=0; $i<$maxdatos; $i++){
            if($datos[$i]->diferencia<=0){
                $grupo0++;
            }elseif($datos[$i]->diferencia==1){
                $grupo1++;
            }elseif($datos[$i]->diferencia==2){
                $grupo2++;
            }elseif($datos[$i]->diferencia==3){
                $grupo3++;
            }elseif($datos[$i]->diferencia==4){
                $grupo4++;
            }elseif($datos[$i]->diferencia==5){
                $grupo5++;
            }elseif($datos[$i]->diferencia>=6){
                $grupo6++;
            }
        }

        $object = new stdClass();
        $object->grupo0= $grupo0;
        $object->grupo1= $grupo1;
        $object->grupo2= $grupo2;
        $object->grupo3= $grupo3;
        $object->grupo4= $grupo4;
        $object->grupo5= $grupo5;
        $object->grupo6= $grupo6;
        array_push($datosgrupo,$object);

        $this->view->page=$datos;
        $this->view->noentregados=$contador;
        $this->view->datosgrupo=$datosgrupo;
        $this->view->descripcion=$descripcion_bitacora;

    }

    public function  reporte_efectividadAction($grupo0=0,$grupo1=0,$grupo2=0,$grupo3=0,$grupo4=0,$grupo5=0,$grupo6=0,$texto=''){
        $descripcion_bitacora='Consultó datos del reporte de efectividad';
        $this->view->disable();

        $rol = new Rol();
        //VALIDAMOS PERMISOS
        $auth = $this->session->get('auth');
        if(!$rol->verificar(78,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }
        //empezando a generar pdf 
        $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",25,25,25,0,8,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación
        $mpdf->SetTitle('REPORTE EFECTIVIDAD');
        $mpdf->SetAuthor('SIPS | SADI'); 
        $mpdf->SetAutoPageBreak(true, 20);

        //consultar datos incio
        //instanciamos valores
        $reporte_completo= new PdfReporteEfectividad();
        //consultar datos fin

        $var_header=str_replace("#logo_header#",basename('images/sips_documento.png'),$reporte_completo->cabezera_hoja);
        $mpdf->SetHTMLHeader($var_header,'O');

        $mpdf->SetHTMLFooter($reporte_completo->header_hoja);
        $mpdf->SetTitle('Reporte efectividad');
        $mpdf->SetAuthor('SIPS | SADI');

        $obj_enc=new Efectividad();

        $pagina_1_html=$obj_enc->formatoPDF($grupo0,$grupo1,$grupo2,$grupo3,$grupo4,$grupo5,$grupo6, $reporte_completo->hoja_1,$texto);
        $mpdf->WriteHTML($pagina_1_html);
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= $descripcion_bitacora;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Reporte de efectividad";
        $bitacora->NuevoRegistro($databit);
    
        // $obj_enc->limpiarImagenesGeneradasReporteRespuestas($unix_timestamp);
        unlink("./graficasencuesta/efectividad.jpeg");
        $mpdf->Output('Reporte-efectividad.pdf','I');
    }

    public function formatogabtruperAction($id_, $correo=0){
        try {
            $respuesta_modelo_des_encript = $this->des_encriiptarId($id_);
            $id= $respuesta_modelo_des_encript["id"];
                if($id<=0 || !is_numeric($id)) //el número en la funcion es el correspondiente a la bdd
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("ID no válido.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
        
                $rol = new Rol();
                $auth = $this->session->get('auth');
                if( $auth["type"]!="cliente"){//a la sesion de cliente no le pide permisos
                    if(!$rol->verificar(43,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        if($correo==1){
                            return 'error';
                        }
                        $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                        $this->response->redirect('index/panel');
                        $this->view->disable();
                        return;   
                    }
                }
               

                date_default_timezone_set('america/mexico_city');
                // $host=$_SERVER["HTTP_HOST"];
                $host="https://sadisips.com/";
                $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
                $carpeta=$config->application->baseUri;
                $url=$host.$carpeta."consulta/validaqr/";

                $estudio=Estudio::findFirstByese_id($id);
                
                //VALIDACION DE LLENADO DE SECCIONES INICIO-----------------------------------------------------------------------------------------VALIDACION DE LLENADO DE SECCIONES INICIO

                if(!$estudio) //si no existe el estudio
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existe el estudio.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }

                $empresas=new Builder();
                    $empresas=$empresas
                    ->addFrom('Empresa','e')
                    ->where('emp_id='.$estudio->emp_id)
                    ->getQuery()
                    ->execute();
                $empresa= $empresas[0];

                //secion a -datos finales
                $datosfinales_data=new Builder();
                $datosfinales_data=$datosfinales_data
                // ->columns()
                ->addFrom('Datofinal','daf')
                ->where('daf_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
                    
                //seccion I
                $seccioneslaborales=new Builder();
                $seccioneslaborales=$seccioneslaborales
                ->addFrom('Seccionlaboral','d')
                ->where('sel_estatus=2 and ese_id='.$id)
                ->getQuery()
                ->execute();
            
                if(count($seccioneslaborales)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de seccion laboral cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }
                $seccionlaboral= $seccioneslaborales[0];

                $referencialaborales=new Builder();
                $referencialaborales=$referencialaborales
                ->addFrom('Referencialaboral','rel')
                ->where('rel_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->orderBy('rel_orden')
                ->getQuery()
                ->execute();
            
                if(count($referencialaborales)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de referencias laborales cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }

                //pagina 11
                $trayectorialaboralregistrado_data=new Builder();
                $trayectorialaboralregistrado_data=$trayectorialaboralregistrado_data
                ->addFrom('Trayectorialaboralregistrado','tlr')
                ->where('tlr_estatus=2 and sel_id='.$seccionlaboral->sel_id)
                ->getQuery()
                ->execute();
            
                if(count($trayectorialaboralregistrado_data)<=0) //si no existen datos comprobatorios
                {
                    if($correo==1){
                        return 'error';
                    }
                    $this->flash->error("No existen datos de trayectoria laboral cargados.");
                    $this->response->redirect('index/panel');
                    $this->view->disable();
                    return;   
                }

                $trayectorialaboralregistrado_data= $trayectorialaboralregistrado_data[0];

                $this->view->disable();
                // $var = 1;
                $mpdf = new mPDF('',[215,280],"","Montserrat, sans-serif",10,10,20,20,5,5); //modo, formato, tamaño-fuente, fuente, margin-left, right, top, bottom, header, footer, orientación

                $reporte_completo= new PdfReporteTruper();
                $estudio_datospersonales= new Datopersonal();

                //dandole formato cabezera y footer

                $var_header=str_replace("#logo_header#",basename('images/sips_documento.png'),$reporte_completo->cabezera_hoja);

                $mpdf->SetHTMLHeader($var_header,'O');

                $mpdf->SetHTMLFooter($reporte_completo->header_hoja);

                $mpdf->SetTitle('REFERENCIAS TRUPER No.'.$id);
                $mpdf->SetAuthor('SIPS | SADI');
                
                //dandole formato cabezera y footer-fin

                //escribiendo pagina 1
                $estudio_datospersonales_html=$estudio_datospersonales->formatoEseTruperReferencias($estudio,$datosfinales_data);
                $mpdf->WriteHTML($estudio_datospersonales_html);
                //escribiendo pagina 1 fin

                //pagina9 y 10 inicio
                // $mpdf->AddPage();
                $referenciaslaboral_data= new Referencialaboral();
                $html_pagina_9_10_referencias_data=$referenciaslaboral_data->formatoEseTruper($ese_id=$id,$seccionlaboral,$referencialaborales,$estudio);
                $mpdf->WriteHTML($html_pagina_9_10_referencias_data);
                //pagina9y10 fin

                //pagina11 inicio
                $mpdf->AddPage();
                $trayectorialaboral_data= new Trayectorialaboral();
                $html_pagina_11_trayectorialaboral_data=$trayectorialaboral_data->formatoEseTruper($ese_id=$id,$seccionlaboral,$trayectorialaboralregistrado_data);
                $mpdf->WriteHTML($html_pagina_11_trayectorialaboral_data);
                //pagina11 fin        

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Descargó un ESE con ID: ".$id." en FORMATO TRUPER REFERENCIAS";
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Formato ESES";
                $bitacora->NuevoRegistro($databit);

                // $mpdf->Output();
                if($correo==1){
                    $nombre='Estudio-FormatoTruperReferencias'.$id.'.pdf';
                    $mpdf->Output('reporte/estudios/'.$nombre,'F');
                    // $mpdf->Output($nombre,'I');
                    return $nombre;
                }else{
                    $mpdf->SetTitle("Estudio Tuper Referencias ".$id);
                    $mpdf->Output('Estudio-FormatoTruperReferencias'.$id.'.pdf','I');
                }
        
        } catch (Exception $e) {
            $mensaje = ' Error: ' . $e->getMessage() . "\n";
            $mensaje .= ' Línea: ' . $e->getLine() . "\n";
            $mensaje .= 'Pila de llamadas: ' . $e->getTraceAsString() . "\n";            
            error_log($mensaje);
            echo "link incorrecto";
            die();
        } 
    }


    public function transporte_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $condiciontipoestudio="";
        if(!$rol->verificar(93,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        $condiciontipoestudio.=$this->getEstudios();   
        $tipoEstudioSelect=Tipoestudio::query()
        ->columns('tip_id, tip_nombre')
        ->where($condiciontipoestudio.' and tip_estatus=2')
        ->execute();
        $indexana=-1;
        $indexinv=-1;
        $indexest=-1;
        $indexemp=-1;
        $indexcan=-1;
        $this->view->tipoEstudios =$tipoEstudioSelect;

        $this->analista = new Usuario();
        $this->investigador = new Usuario();
        $this->empresa = new Empresa();
        $analistaselect=$this->analista->getAnalista();
        $investigadorselect=$this->investigador->getInvestigador();
        $empresaselect=Empresa::find("emp_estatus=2");
        $estadoselect=Estado::find("est_estatus=2");
        $this->view->indexana=$indexana;
        $this->view->indexinv=$indexinv;
        $this->view->indexest=$indexest;
        $this->view->indexemp=$indexemp;
        $this->view->indexcan=$indexcan;
        $this->view->estadoselect=$estadoselect;
        $this->view->analistaselect=$analistaselect;
        $this->view->investigadorselect=$investigadorselect;
        $this->view->empresaselect=$empresaselect;
        $this->view->analista = $this->analista;
        $this->view->investigador = $this->investigador;
        $this->view->empresa = $this->empresa;
    }
    

    public function transporte_autorizadoAction($data = [])
    {
        $this->view->disable();
        try {
            if(!$this->request->isPost())
                throw new \Exception("Formato incorrecto de solicitud");

            $data_ = $this->request->getPost();

            if(empty($data_) || !isset($data_['value']) || !isset($data_['nombre']))
                throw new \Exception("El array de datos no cumple con los requisitos necesarios");
            
            $data_values = $data_['value'];
            $data_labels = $data_['nombre'];
            $data = array_values($data_values); 
            $legends = array_values($data_labels);
            /* 
            $data = array(); 
            $legends = array(); 
            for ($i = 0; $i < 30; $i++) {
                $data[] = 30;
                $legends[] = "update";
            }
            */

            $graph = new Graph(2400, 1800);
            $graph->SetScale("textlin");
            $graph->dpi = 1000;  
            $barplot = new BarPlot($data);
            $barplot->SetFillColor('blue');
            $graph->Add($barplot);
            $graph->title->Set('Transportes aprobados');
            $graph->xaxis->SetTickLabels($legends);
            $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL, 12);
            $ruta_nombre_archivo = './graficasencuesta/grafica-transporte_' . time() . '.jpeg';
            $nombre_imprimir = 'transportes_autorizados';
            if (file_exists($ruta_nombre_archivo)) {
                if (!unlink($ruta_nombre_archivo)) {
                    throw new \Exception("No se pudo eleminar la img cargada");
                }
            }          
            //bitacora inicio 
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= 'Realizó generación de gráfica de barras con datos estadísticos de investigadores aprobados de transporte.';
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reportes de transporte";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
            $graph->img->SetImgFormat('jpeg');
            $graph->Stroke($ruta_nombre_archivo);
            $fecha_actual = date("j_m_Y") . '_fecha_' . date("H_i");
            $nombre_archivo_con_fecha = $nombre_imprimir . '_' . $fecha_actual . '_hora.jpeg';
            header('Content-Type: image/jpeg');
            header('Content-Disposition: attachment; filename="' . $nombre_archivo_con_fecha . '.jpeg"');
            readfile($ruta_nombre_archivo);
            unlink($ruta_nombre_archivo);
            exit;
        } catch (Exception $e) {
            //echo 'Error: ' . $e->getMessage();
            error_log("ERROR EN GENERAR REPORTE GRÁFICO TRANSPORTE:".$e->getMessage());
            $ruta_nombre_archivo = './assets/images/sistema/error-generar-imagen.png';
            $nombre_archivo_con_fecha = 'error_grafica';
            header('Content-Type: image/png');
            header('Content-Disposition: attachment; filename="' . $nombre_archivo_con_fecha . '.png"');
            readfile($ruta_nombre_archivo);
            exit;
        }

    }
    
    /**
     * Generación y visualización de datos relacionados con el transporte y estudio.
     * @param array $data datos a través de la solicitud POST.
     * @return void No devuelve un valor como tal pero asigna valores a las variables de la vista.
     * @throws \Exception En caso de errores durante el procesamiento, se capturan excepciones, se registran en la bitácora y se muestran mensajes de error en la vista.
    */
    public function transporte_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);        
        $mensaje="";
        $mensaje_nota_filtro_inv="";
        $auth = $this->session->get('auth');

        try {
    
            $rol = new Rol();
            $condicion = '';
            $descripcion_bitacora = 'Buscó datos de transporte ';
            $usuario_obj=new Usuario();
            $tranporte_obj= new Transporte();
            $estudio_obj=new Estudio();
            $empresa_obj=new Empresa();
            $estado_obj=new Estado();
            $municipio_obj=new Municipio();
            
            if (!$rol->verificar(93, $auth['rol_id'])) {
                throw new \Exception("No cuenta con los permisos necesarios para acceder a esta característica.");
            }
    
            if (!$this->request->isPost()) {
                throw new \Exception("Formato incorrecto");
            }

            $data = $this->request->getPost();
            //error_log(print_r($data, true)); 
            $condicion="";///variable para condicion de datos generales
            $condicion_inv="";//variable para la condicion de datos estadisticas 


            $columns_init="
            Estudio.ese_id,
            Estudio.ese_puesto,
            Estudio.ese_area,
            Estudio.ese_estatus,
            Estudio.emp_id,
            Estudio.tip_id,
            Estudio.ese_fechaentregacliente,
            tra.tra_id,
            tra.tra_preaprobado,
            tra.tra_solicitado,
            tra.tra_aprobado,
            tra.tra_estatus,
            tra.tra_registro,
            tra.tra_fechainvestigador,
            tra.tra_fechaaprobado,
            tra.tra_comentario,
            tra.tra_comentarioadmin,
            CONCAT(ana.usu_nombre,' ', ana.usu_primerapellido, ' ', ana.usu_segundoapellido) as ana_nombre,
            CONCAT(tra_usu_asigna.usu_nombre,' ', tra_usu_asigna.usu_primerapellido, ' ', tra_usu_asigna.usu_segundoapellido) as tra_usu_asigna_nombre,
            CONCAT(tra_usu_aprobado.usu_nombre,' ', tra_usu_aprobado.usu_primerapellido, ' ', tra_usu_aprobado.usu_segundoapellido) as usu_aprobado_nombre,
            CONCAT(inv.usu_nombre,' ', inv.usu_primerapellido, ' ', inv.usu_segundoapellido) as inv_nombre,
            inv.usu_id AS inv_id,
            emp.emp_nombre,
            cne.cne_nombre,
            cen.cen_nombre,
            tra_est_org.est_nombre AS est_nombre_ori,
            tra_mun_org.mun_nombre AS mun_nombre_ori,
            tra_est_dest.est_nombre AS est_nombre_dest,
            tra_mun_dest.mun_nombre AS mun_nombre_dest,
            tip.tip_nombre
            ";
            $regs=new Builder();
            $regs=$regs
            ->addFrom('Transporte', 'tra')
            ->leftjoin('Estudio','tra.ese_id=Estudio.ese_id','Estudio')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
            ->leftjoin('Usuario','inv.usu_id=tra.investigadorusu_id','inv')
            ->leftjoin('Usuario','tra_usu_aprobado.usu_id=tra.aprobadousu_id','tra_usu_aprobado')
            ->leftjoin('Estado','tra_est_org.est_id=tra.est_idorigen','tra_est_org')
            ->leftjoin('Municipio','tra_mun_org.mun_id=tra.mun_idorigen','tra_mun_org')	
            ->leftjoin('Estado','tra_est_dest.est_id=tra.est_iddestino','tra_est_dest')
            ->leftjoin('Municipio','tra_mun_dest.mun_id=tra.mun_iddestino','tra_mun_dest')	
            ->leftjoin('Usuario','tra_usu_asigna.usu_id=tra.asignausu_id','tra_usu_asigna');
            $regs_inv_pagados_tra = clone $regs;
            //filtros de estudio incio
            $tipo_estudio_filtro=false;
            if($this->numerovalidoInputValido($data["tip_id"])==1) {
                $condicion = ($condicion == '') ? $condicion.='  Estudio.tip_id = '.$data["tip_id"]  : $condicion.=' and  Estudio.tip_id = '.$data["tip_id"] ;
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.='  Estudio.tip_id = '.$data["tip_id"]  : $condicion_inv.=' and  Estudio.tip_id = '.$data["tip_id"] ;
                $filtro=Tipoestudio::find("tip_id=".$data["tip_id"]);
                $descripcion_bitacora.=', filtro de tipo de estudio de : '.$filtro[0]->tip_nombre;
                $tipo_estudio_filtro=true;
            }else{
                $condicion_dinamica_tip_id="";
                $condicion_dinamica_tip_id.=$this->getEstudios("Estudio.");
                $condicion = ($condicion == '') ? $condicion.= $condicion_dinamica_tip_id: $condicion.=' AND '.$condicion_dinamica_tip_id;
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.= $condicion_dinamica_tip_id: $condicion_inv.=' AND '.$condicion_dinamica_tip_id;

            }
            //filtros de estudio fin

            //filtros de id especificos de los filtros principales inicio
            if($this->numerovalidoInputValido($data["ese_id"])==1) {
                $condicion .= ($condicion == '') ? " tra.ese_id={$data["ese_id"]}" : " and tra.ese_id={$data["ese_id"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.ese_id={$data["ese_id"]}" : " and tra.ese_id={$data["ese_id"]}";
                $descripcion_bitacora .= ', con filtro de ESE ID No. '.$data["ese_id"];
            }
            if($this->numerovalidoInputValido($data["tra_id"])) {
                $condicion .= ($condicion == '') ? " tra.tra_id={$data["tra_id"]}" : " and tra.tra_id={$data["tra_id"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.tra_id={$data["tra_id"]}" : " and tra.tra_id={$data["tra_id"]}";
                $descripcion_bitacora .= ', con filtro de transporte ID No. '.$data["tra_id"];
            }
             //filtros de id especificos de los filtros principales fin

            if($this->numerovalidoInputValido($data["emp_id"])) {
                $condicion .= ($condicion == '') ? " Estudio.emp_id={$data["emp_id"]}" : " and Estudio.emp_id={$data["emp_id"]}";
                $condicion_inv .= ($condicion_inv == '') ? " Estudio.emp_id={$data["emp_id"]}" : " and Estudio.emp_id={$data["emp_id"]}";
                $descripcion_bitacora .= ', con filtro de la empresa '.$empresa_obj->getAlias($data["emp_id"]);
            }
            //filtros de id usuario ini
            if($this->numerovalidoInputValido($data["aprobadousu_id"])) {
                $condicion .= ($condicion == '') ? " tra.aprobadousu_id={$data["aprobadousu_id"]}" : " and tra.aprobadousu_id={$data["aprobadousu_id"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.aprobadousu_id={$data["aprobadousu_id"]}" : " and tra.aprobadousu_id={$data["aprobadousu_id"]}";
                 $descripcion_bitacora .= ', con filtro del usuario que aprobó '.$usuario_obj->getNombre($data["aprobadousu_id"]);
            }
            if($this->numerovalidoInputValido($data["asignausu_id"])) {
                $condicion .= ($condicion == '') ? " tra.asignausu_id={$data["asignausu_id"]}" : " and tra.asignausu_id={$data["asignausu_id"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.asignausu_id={$data["asignausu_id"]}" : " and tra.asignausu_id={$data["asignausu_id"]}";
                $descripcion_bitacora .= ', con filtro del usuario que asignó '.$usuario_obj->getNombre($data["asignausu_id"]);
            }
            if($this->numerovalidoInputValido($data["investigadorusu_id"])) {
                $condicion .= ($condicion == '') ? " tra.investigadorusu_id={$data["investigadorusu_id"]}" : " and tra.investigadorusu_id={$data["investigadorusu_id"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.investigadorusu_id={$data["investigadorusu_id"]}" : " and tra.investigadorusu_id={$data["investigadorusu_id"]}";
                $descripcion_bitacora .= ', con filtro del investigador '.$usuario_obj->getNombre($data["investigadorusu_id"])." FOLIO ".$data["investigadorusu_id"];
            }
            //filtros de id usuario fin

            //filtros de estados origen destino ini
            if($this->numerovalidoInputValido($data["tra_est_id_ori"])) {
                $condicion .= ($condicion == '') ? " tra.est_idorigen={$data["tra_est_id_ori"]}" : " and tra.est_idorigen={$data["tra_est_id_ori"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.est_idorigen={$data["tra_est_id_ori"]}" : " and tra.est_idorigen={$data["tra_est_id_ori"]}";
                $descripcion_bitacora .= ' ,con filtro del estado de origen '.$estado_obj->getNombre($data["tra_est_id_ori"]);
            }
            if($this->numerovalidoInputValido($data["tra_mun_id_ori"])) {
                $condicion .= ($condicion == '') ? " tra.mun_idorigen={$data["tra_mun_id_ori"]}" : " and tra.mun_idorigen={$data["tra_mun_id_ori"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.mun_idorigen={$data["tra_mun_id_ori"]}" : " and tra.mun_idorigen={$data["tra_mun_id_ori"]}";
                $descripcion_bitacora .= ', con filtro del municipio de origen '.$municipio_obj->getNombre($data["tra_mun_id_ori"]);
            }
            if($this->numerovalidoInputValido($data["tra_est_id_dest"])) {
                $condicion .= ($condicion == '') ? " tra.est_iddestino={$data["tra_est_id_dest"]}" : " and tra.est_iddestino={$data["tra_est_id_dest"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.est_iddestino={$data["tra_est_id_dest"]}" : " and tra.est_iddestino={$data["tra_est_id_dest"]}";

                $descripcion_bitacora .= ', con filtro de estado destinó '.$estado_obj->getNombre($data["tra_est_id_dest"]);
            }
            if($this->numerovalidoInputValido($data["tra_mun_id_dest"])) {
                $condicion .= ($condicion == '') ? " tra.mun_iddestino={$data["tra_mun_id_dest"]}" : " and tra.mun_iddestino={$data["tra_mun_id_dest"]}";
                $condicion_inv .= ($condicion_inv == '') ? " tra.mun_iddestino={$data["tra_mun_id_dest"]}" : " and tra.mun_iddestino={$data["tra_mun_id_dest"]}";
                $descripcion_bitacora .= ', con filtro de municipio destinó '.$municipio_obj->getNombre($data["tra_mun_id_dest"]);
            }
            //filtros de estados origen destino fin 

            //filtros de estatus inicio
            $condicion_inv .= ($condicion_inv == '') ? " tra.tra_estatus=3" : " and tra.tra_estatus=3";
            $mensaje_nota_filtro_inv .= "El filtro de estatus de transporte y estatus de estudio no aplica para las gráficas y datos por investigador; solo se aplica la búsqueda de transportes autorizados y estudios aprobados.";
            if($this->numerovalidoInputValidoConArray($data["tra_estatus"],[-1])) {
                $condicion .= ($condicion == '') ? " tra.tra_estatus={$data["tra_estatus"]}" : " and tra.tra_estatus={$data["tra_estatus"]}";
                //condicion_inv aqui no aplica por que solo mostramos  transportes pagados=autorizados
                $descripcion_bitacora .= ', con filtro del estatus transporte '.$tranporte_obj->getEstatus($data["tra_estatus"]);
            }
            $condicion_inv .= ($condicion_inv == '') ? " Estudio.ese_estatus=7" : " and Estudio.ese_estatus=7";
          //  $mensaje_nota_filtro_inv.=", el filtro estatus de estudio no aplica para las gráficas, solo se aplica la búsqueda de estudios aprobados";
            if($this->numerovalidoInputValidoConArray($data["ese_estatus"],[-1])) {
                $condicion .= ($condicion == '') ? " Estudio.ese_estatus={$data["ese_estatus"]}" : " and Estudio.ese_estatus={$data["ese_estatus"]}";
                //$condicion_inv .= ($condicion_inv == '') ? " Estudio.ese_estatus={$data["ese_estatus"]}" : " and Estudio.ese_estatus={$data["ese_estatus"]}";
                $descripcion_bitacora .= ',  con filtro del estatus de estudio '.$estudio_obj->getEstatusDetail($data["ese_estatus"]);
            }
            //filtros de estatus inicio

            //fechas de entrega cliente inicio 
            if($this->fechaInputValida($data["ese_fechaentregacliente_f_inicial"])){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'" : $condicion.=" and Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'" : $condicion_inv.=" and Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'";
                $descripcion_bitacora.=", filtro de fecha inicial de entrega cliente: ".$data["ese_fechaentregacliente_f_inicial"];
            }
            if($this->fechaInputValida($data["ese_fechaentregacliente_f_final"])){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechaentregacliente<='".$data["ese_fechaentregacliente_f_final"]." 23:59:59'" :$condicion.=" and Estudio.ese_fechaentregacliente<='".$data["ese_fechaentregacliente_f_final"]." 23:59:59'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'" : $condicion_inv.=" and Estudio.ese_fechaentregacliente>='".$data["ese_fechaentregacliente_f_inicial"]."'";
                $descripcion_bitacora.=", filtro de fecha final de entrega cliente de ESE: ".$data["ese_fechaentregacliente_f_final"];
            }
            //fechas de entrega cliente fin 

            //fechas de comprobancion inv inicio
            if($this->fechaInputValida($data["tra_fechainvestigador_f_inicial"])){
                $condicion = ($condicion == '') ? $condicion.=" tra.tra_fechainvestigador>='".$data["tra_fechainvestigador_f_inicial"]."'" : $condicion.=" and tra.tra_fechainvestigador>='".$data["tra_fechainvestigador_f_inicial"]."'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" tra.tra_fechainvestigador>='".$data["tra_fechainvestigador_f_inicial"]."'" : $condicion_inv.=" and tra.tra_fechainvestigador>='".$data["tra_fechainvestigador_f_inicial"]."'";
                $descripcion_bitacora.=", filtro de fecha inicial de entrega cliente: ".$data["tra_fechainvestigador_f_inicial"];
            }
            if($this->fechaInputValida($data["tra_fechainvestigador_f_final"])){
                $condicion = ($condicion == '') ? $condicion.=" tra.tra_fechainvestigador<='".$data["tra_fechainvestigador_f_final"]." 23:59:59'" :$condicion.=" and tra.tra_fechainvestigador<='".$data["tra_fechainvestigador_f_final"]." 23:59:59'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" tra.tra_fechainvestigador<='".$data["tra_fechainvestigador_f_final"]." 23:59:59'" :$condicion_inv.=" and tra.tra_fechainvestigador<='".$data["tra_fechainvestigador_f_final"]." 23:59:59'";
                $descripcion_bitacora.=", filtro de fecha final de solicitud de ESE: ".$data["tra_fechainvestigador_f_final"];
            }
            //fechas de comprobancion inv fin

            //fechas de aprobacion tra ini
            if($this->fechaInputValida($data["tra_fechaaprobado_f_inicial"])){
                $condicion = ($condicion == '') ? $condicion.=" tra.tra_fechaaprobado>='".$data["tra_fechaaprobado_f_inicial"]."'" : $condicion.=" and tra.tra_fechaaprobado>='".$data["tra_fechaaprobado_f_inicial"]."'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" tra.tra_fechaaprobado>='".$data["tra_fechaaprobado_f_inicial"]."'" : $condicion_inv.=" and tra.tra_fechaaprobado>='".$data["tra_fechaaprobado_f_inicial"]."'";
                $descripcion_bitacora.=", filtro de fecha inicial de aprobado de transporte: ".$data["tra_fechainvestigador_f_inicial"];
            }
            if($this->fechaInputValida($data["tra_fechaaprobado_f_final"])){
                $condicion = ($condicion == '') ? $condicion.=" tra.tra_fechaaprobado<='".$data["tra_fechaaprobado_f_final"]." 23:59:59'" :$condicion.=" and tra.tra_fechaaprobado<='".$data["tra_fechaaprobado_f_final"]." 23:59:59'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" tra.tra_fechaaprobado<='".$data["tra_fechaaprobado_f_final"]." 23:59:59'" :$condicion_inv.=" and tra.tra_fechaaprobado<='".$data["tra_fechaaprobado_f_final"]." 23:59:59'";
                $descripcion_bitacora.=", filtro de fecha final de aprobado de transporte: ".$data["tra_fechainvestigador_f_final"];
            }
            //fechas de aprobacion tra fin

            //fechas de registro tra ini
            if($this->fechaInputValida($data["tra_registro_f_inicial"])){
                $condicion = ($condicion == '') ? $condicion.=" tra.tra_registro>='".$data["tra_registro_f_inicial"]."'" : $condicion.=" and tra.tra_registro>='".$data["tra_registro_f_inicial"]."'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" tra.tra_registro>='".$data["tra_registro_f_inicial"]."'" : $condicion_inv.=" and tra.tra_registro>='".$data["tra_registro_f_inicial"]."'";
                $descripcion_bitacora.=", filtro de fecha inicial de registro de transporte: ".$data["tra_registro_f_inicial"];
            }
            if($this->fechaInputValida($data["tra_registro_f_final"])){
                $condicion = ($condicion == '') ? $condicion.=" tra.tra_registro<='".$data["tra_registro_f_final"]." 23:59:59'" :$condicion.=" and tra.tra_registro<='".$data["tra_registro_f_final"]." 23:59:59'";
                $condicion_inv = ($condicion_inv == '') ? $condicion_inv.=" tra.tra_registro<='".$data["tra_registro_f_final"]." 23:59:59'" :$condicion_inv.=" and tra.tra_registro<='".$data["tra_registro_f_final"]." 23:59:59'";
                $descripcion_bitacora.=", filtro de fecha final de registro de transporte: ".$data["tra_registro_f_final"];
            }
            //fechas de registro tra fin

            //monto filtros ini

              //EXACTOS
                if($this->numerovalidoInputValido($data["tra_preaprobado"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_preaprobado={$data["tra_preaprobado"]}" : " and tra.tra_preaprobado={$data["tra_preaprobado"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_preaprobado={$data["tra_preaprobado"]}" : " and tra.tra_preaprobado={$data["tra_preaprobado"]}";
                    $descripcion_bitacora .= ', con filtro del monto pre aprobado de  $'.$municipio_obj->getNombre($data["tra_preaprobado"]);
                }
                if($this->numerovalidoInputValido($data["tra_solicitado"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_solicitado={$data["tra_solicitado"]}" : " and tra.tra_solicitado={$data["tra_solicitado"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_solicitado={$data["tra_solicitado"]}" : " and tra.tra_solicitado={$data["tra_solicitado"]}";
                    $descripcion_bitacora .= ', con filtro de monto solicitado '.$estado_obj->getNombre($data["tra_solicitado"]);
                } 
                if($this->numerovalidoInputValido($data["tra_aprobado"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_aprobado={$data["tra_aprobado"]}" : " and tra.tra_aprobado={$data["tra_aprobado"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_aprobado={$data["tra_aprobado"]}" : " and tra.tra_aprobado={$data["tra_aprobado"]}";
                    $descripcion_bitacora .= ', con filtro de monto aprobado '.$estado_obj->getNombre($data["tra_aprobado"]);
                } 
              //EXACTOS

             //RANGO INI 
                if ($this->numerovalidoInputValido($data["tra_aprobado_inicio"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_aprobado >= {$data["tra_aprobado_inicio"]}" : " and tra.tra_aprobado >= {$data["tra_aprobado_inicio"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_aprobado >= {$data["tra_aprobado_inicio"]}" : " and tra.tra_aprobado >= {$data["tra_aprobado_inicio"]}";
                    $descripcion_bitacora .= ', con filtro de monto aprobado desde ' . $estado_obj->getNombre($data["tra_aprobado_inicio"]);
                }
                if ($this->numerovalidoInputValido($data["tra_aprobado_fin"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_aprobado <= {$data["tra_aprobado_fin"]}" : " and tra.tra_aprobado <= {$data["tra_aprobado_fin"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_aprobado <= {$data["tra_aprobado_fin"]}" : " and tra.tra_aprobado <= {$data["tra_aprobado_fin"]}";
                    $descripcion_bitacora .= ', con filtro de monto aprobado hasta ' . $estado_obj->getNombre($data["tra_aprobado_fin"]);
                }
                if ($this->numerovalidoInputValido($data["tra_preaprobado_inicio"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_preaprobado >= {$data["tra_preaprobado_inicio"]}" : " and tra.tra_preaprobado >= {$data["tra_preaprobado_inicio"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_preaprobado >= {$data["tra_preaprobado_inicio"]}" : " and tra.tra_preaprobado >= {$data["tra_preaprobado_inicio"]}";
                    $descripcion_bitacora .= ', con filtro del monto pre aprobado desde $' . $municipio_obj->getNombre($data["tra_preaprobado_inicio"]);
                }
                if ($this->numerovalidoInputValido($data["tra_preaprobado_fin"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_preaprobado <= {$data["tra_preaprobado_fin"]}" : " and tra.tra_preaprobado <= {$data["tra_preaprobado_fin"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_preaprobado <= {$data["tra_preaprobado_fin"]}" : " and tra.tra_preaprobado <= {$data["tra_preaprobado_fin"]}";
                    $descripcion_bitacora .= ', con filtro del monto pre aprobado hasta $' . $municipio_obj->getNombre($data["tra_preaprobado_fin"]);
                }
                if ($this->numerovalidoInputValido($data["tra_solicitado_inicio"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_solicitado >= {$data["tra_solicitado_inicio"]}" : " and tra.tra_solicitado >= {$data["tra_solicitado_inicio"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_solicitado >= {$data["tra_solicitado_inicio"]}" : " and tra.tra_solicitado >= {$data["tra_solicitado_inicio"]}";
                    $descripcion_bitacora .= ', con filtro de tra_solicitado desde ' . $estado_obj->getNombre($data["tra_solicitado_inicio"]);
                }
                if ($this->numerovalidoInputValido($data["tra_solicitado_fin"])) {
                    $condicion .= ($condicion == '') ? " tra.tra_solicitado <= {$data["tra_solicitado_fin"]}" : " and tra.tra_solicitado <= {$data["tra_solicitado_fin"]}";
                    $condicion_inv .= ($condicion_inv == '') ? " tra.tra_solicitado <= {$data["tra_solicitado_fin"]}" : " and tra.tra_solicitado <= {$data["tra_solicitado_fin"]}";
                    $descripcion_bitacora .= ', con filtro de tra_solicitado hasta ' . $estado_obj->getNombre($data["tra_solicitado_fin"]);
                }
             //RAGOS FIN 
            //monto filtros fin


            //SCRIPT QUERY  INICIO---------------SCRIPT QUERY  INICIO
            $columns_inv = ", COUNT(inv_id) AS inv_total_coincidencias, 
            COUNT(Estudio.ese_id) AS ese_autorizados_total,
            SUM(tra_aprobado) AS inv_total_transporte_autorizado, 
            ROUND(AVG(tra.tra_aprobado), 2) AS inv_promedio_transporte_autorizado
            ";
            $regs_inv_pagados_tra=$regs_inv_pagados_tra->columns($columns_init.$columns_inv);
            $regs_inv_pagados_tra=$regs_inv_pagados_tra
                                    ->where($condicion_inv)
                                    ->groupBy(['inv_id'])
                                    ->getQuery()
                                    ->execute();
            //consulta para estadisticas fin

            //consulta para transportes ini
            $regs_tra=$regs->columns($columns_init)->where($condicion)->getQuery()->execute();
            //consulta para transportes fin

            //SCRIPT QUERY  FIN---------------SCRIPT QUERY  FIN

            // Bitacora inicio
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = $descripcion_bitacora;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "Reporte de transporte";
            $bitacora->NuevoRegistro($databit);
            // Bitacora fin

            $this->view->tipo_estudio_filtro =$tipo_estudio_filtro;
            $this->view->tranporte_obj =$tranporte_obj;
            $this->view->estudio_obj =$estudio_obj;
            $this->view->usuario = $usuario_obj;
            $this->view->page = $regs_tra;
            $this->view->regs_inv_pagados_tra = $regs_inv_pagados_tra;
            $this->view->mensaje =$mensaje;
            $this->view->mensaje_nota_filtro_inv =$mensaje_nota_filtro_inv;
        } catch (\Exception $e) {
            $this->view->page = [];
            $prefijo_mensaje="Error en tabla reporte / transporte ";
            $mensaje=$e->getMessage();
            $this->view->mensaje =$mensaje;
            $this->view->mensaje_nota_filtro_inv =$mensaje_nota_filtro_inv;
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = $prefijo_mensaje.$e->getMessage();
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "ERROR";
            $bitacora->NuevoRegistro($databit);
            error_log($prefijo_mensaje.$e->getMessage());
            return;
            die();
        }

    }


    #REPORTE DE ESE CANCELADOS CATOLOGO INIICIO 
    public function ese_cancelado_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $condiciontipoestudio="";
        if(!$rol->verificar(97,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        $condiciontipoestudio.=$this->getEstudios();   
        $tipoEstudioSelect=Tipoestudio::query()
        ->columns('tip_id, tip_nombre')
        ->where($condiciontipoestudio.' and tip_estatus=2')
        ->execute();

        $indexana=-1;
        $indexinv=-1;
        $indexest=-1;
        $indexemp=-1;
        $indexcan=-1;
        $this->view->tipoEstudios =$tipoEstudioSelect;

        $this->analista = new Usuario();
        $this->investigador = new Usuario();
        $this->empresa = new Empresa();
        $analistaselect=$this->analista->getAnalista();
        $investigadorselect=$this->investigador->getInvestigador();

        $estadoselect=Estado::find("est_estatus=2");
        $this->view->indexana=$indexana;
        $this->view->indexinv=$indexinv;
        $this->view->indexest=$indexest;
        $this->view->indexemp=$indexemp;
        $this->view->indexcan=$indexcan;
        $this->view->estadoselect=$estadoselect;
        $this->view->analistaselect=$analistaselect;
        $this->view->investigadorselect=$investigadorselect;
        $this->view->analista = $this->analista;
        $this->view->investigador = $this->investigador;
        $this->view->empresa = $this->empresa;
    }
    /**
     * Generación y visualización de datos relacionados con el  estudio cancelado.
     * @param array $data datos a través de la solicitud POST.
     * @return void No devuelve un valor como tal pero asigna valores a las variables de la vista.
     * @throws \Exception En caso de errores durante el procesamiento, se capturan excepciones, se registran en la bitácora y se muestran mensajes de error en la vista.
    */
    public function ese_cancelado_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);        
        $mensaje="";
        $mensaje_nota_filtro_inv="";
        $auth = $this->session->get('auth');
        try {
    
            $rol = new Rol();
            $condicion = '';
            $descripcion_bitacora = 'Buscó datos de ese cancelación';
            $usuario_obj=new Usuario();
            $estudio_obj=new Estudio();
            // $empresa_obj=new Empresa();
            $estcancelacion_obj=new Estcancelado();
            $catcancelado_obj=new Catcancelado();

            $estado_obj=new Estado();
            $municipio_obj=new Municipio();
            
            if (!$rol->verificar(97, $auth['rol_id'])) {throw new \Exception("No cuenta con los permisos necesarios para acceder a esta característica.");}
            if (!$this->request->isPost()) {throw new \Exception("Formato incorrecto");}

            $data = $this->request->getPost();
            #error_log(print_r($data, true)); 
            $condicion="Estudio.ese_estatus=-2 ";///variable para condicion de datos generales


            $columns_init="
            Estudio.ese_id,
            Estudio.ese_puesto,
            Estudio.ese_area,
            Estudio.ese_estatus,
            Estudio.emp_id,
            Estudio.tip_id,
            Estudio.ese_fechaentregainvestigador,
            Estudio.ese_fechaasiginvestigador,
            Estudio.ese_fechacancelacion,
            Estudio.ese_fechaentregaanalista,
            Estudio.ese_fechaasiganalista,            
            Estudio.ese_registro,
            Estudio.ese_precancelar,
            
            CONCAT(ana.usu_nombre,' ', ana.usu_primerapellido, ' ', ana.usu_segundoapellido) as ana_nombre,
            CONCAT(inv.usu_nombre,' ', inv.usu_primerapellido, ' ', inv.usu_segundoapellido) as inv_nombre,
            CONCAT(ese_usu_alta.usu_nombre,' ', ese_usu_alta.usu_primerapellido, ' ', ese_usu_alta.usu_segundoapellido) as ese_usu_alta_nombre,

            CONCAT(ese_usu_cancela.usu_nombre,' ', ese_usu_cancela.usu_primerapellido, ' ', ese_usu_cancela.usu_segundoapellido) as ese_usu_cancela_nombre,

            inv.usu_id AS inv_id,
            emp.emp_nombre,
            CONCAT(cne.cne_nombre,' ', cne.cne_primerapellido, ' ', cne.cne_segundoapellido) as cne_nombre,

            cen.cen_nombre,

            eca.eca_id,eca.eca_fechacambio,eca.eca_fecharegistro,eca.eca_estatus,
            eca.eca_motivo,
            cac.cac_nombre AS eca_cac_nombre,
            CONCAT(eca_usu_cambio.usu_nombre,' ', eca_usu_cambio.usu_primerapellido, ' ', eca_usu_cambio.usu_segundoapellido) as eca_usu_cambio_nombre,
            CONCAT(eca_usu_registro.usu_nombre,' ', eca_usu_registro.usu_primerapellido, ' ', eca_usu_registro.usu_segundoapellido) as eca_usu_regitro_nombre,

            mun.mun_nombre,
            est.est_nombre,

            tip.tip_nombre
            ";
            $regs=new Builder();
            $regs=$regs
            ->addFrom('Estudio', 'Estudio')
            #->leftjoin('Estcancelado','eca.ese_id=Estudio.ese_id','eca')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Estcancelado','eca.ese_id=Estudio.ese_id','eca')
            ->leftjoin('Catcancelado','cac.cac_id=eca.cac_id','cac')
            //usuario join ini
            ->leftjoin('Usuario','ese_usu_alta.usu_id=Estudio.usu_idalta','ese_usu_alta')
            #->leftjoin('Usuario','ese_usu_alta.usu_id=Estudio.usu_idalta','ese_usu_alta')
            ->leftjoin('Usuario','ese_usu_cancela.usu_id=Estudio.usu_idcancela','ese_usu_cancela')
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Usuario','eca_usu_registro.usu_id=eca.usu_id','eca_usu_registro')
            ->leftjoin('Usuario','eca_usu_cambio.usu_id=eca.usu_idcambio','eca_usu_cambio');
            //usuario join fin;


            /*=============================================
            =            Filtro inicio            =
            =============================================*/            

            //filtros de estudio incio
            $tipo_estudio_filtro=false;
            if($this->numerovalidoInputValido($data["tip_id"])==1) {
                $condicion = ($condicion == '') ? $condicion.='  Estudio.tip_id = '.$data["tip_id"]  : $condicion.=' and  Estudio.tip_id = '.$data["tip_id"] ;
                $filtro=Tipoestudio::find("tip_id=".$data["tip_id"]);
                $descripcion_bitacora.=', filtro de tipo de estudio de : '.$filtro[0]->tip_nombre;
                $tipo_estudio_filtro=true;
            }else{
                $condicion_dinamica_tip_id="";
                $condicion_dinamica_tip_id.=$this->getEstudios("Estudio.");
                $condicion = ($condicion == '') ? $condicion.= $condicion_dinamica_tip_id: $condicion.=' AND '.$condicion_dinamica_tip_id;
            }
            //filtros de estudio fin

            //filtros de id especificos de los filtros principales inicio
            if($this->numerovalidoInputValido($data["ese_id"])==1) {
                $condicion .= ($condicion == '') ? " Estudio.ese_id={$data["ese_id"]}" : " and Estudio.ese_id={$data["ese_id"]}";
                $descripcion_bitacora .= ', con filtro de ESE ID No. '.$data["ese_id"];
            }
        
             //filtros de id especificos de los filtros principales fin

  
            //filtros de id usuario ini
       
            if($this->numerovalidoInputValido($data["investigadorusu_id"])) {
                $condicion .= ($condicion == '') ? " Estudio.inv_id={$data["investigadorusu_id"]}" : " and Estudio.inv_id={$data["investigadorusu_id"]}";
                $descripcion_bitacora .= ', con filtro del investigador '.$usuario_obj->getNombre($data["investigadorusu_id"])." FOLIO ".$data["investigadorusu_id"];
            }
            if($this->numerovalidoInputValido($data["analistausu_id"])) {
                $condicion .= ($condicion == '') ? " Estudio.ana_id={$data["investigadorusu_id"]}" : " and Estudio.ana_id={$data["investigadorusu_id"]}";
                $descripcion_bitacora .= ', con filtro del investigador '.$usuario_obj->getNombre($data["investigadorusu_id"])." FOLIO ".$data["investigadorusu_id"];
            }

            if($this->numerovalidoInputValido($data["usu_idcancela"])) {
                $condicion .= ($condicion == '') ? " Estudio.usu_idcancela={$data["usu_idcancela"]}" : " and Estudio.usu_idcancela={$data["usu_idcancela"]}";
                $descripcion_bitacora .= ', con filtro del usuario que cancelo '.$usuario_obj->getNombre($data["usu_idcancela"])." FOLIO ".$data["usu_idcancela"];
            }
            if($this->numerovalidoInputValido($data["eca_usu_idcambio"])) {
                $condicion .= ($condicion == '') ? " eca.usu_idcambio={$data["eca_usu_idcambio"]}" : " and eca.usu_idcambio={$data["eca_usu_idcambio"]}";
                 $descripcion_bitacora .= ', con filtro del usuario que cambio de esatus el estcancelado '.$usuario_obj->getNombre($data["eca_usu_idcambio"])." FOLIO ".$data["eca_usu_idcambio"];
             }

            

            
            //filtros de id usuario fin

            //filtros de estados ini
            if($this->numerovalidoInputValido($data["est_id"])) {
                $condicion .= ($condicion == '') ? " Estudio.est_id={$data["est_id"]}" : " and Estudio.est_id={$data["est_id"]}";
                $descripcion_bitacora .= ' ,con filtro del estado de origen '.$estado_obj->getNombre($data["est_id"]);
            }
            if($this->numerovalidoInputValido($data["mun_id"])) {
                $condicion .= ($condicion == '') ? " Estudio.mun_id={$data["mun_id"]}" : " and Estudio.mun_id={$data["mun_id"]}";
                $descripcion_bitacora .= ', con filtro del municipio de origen '.$municipio_obj->getNombre($data["mun_id"]);
            }
      
            //filtros de estados fin 

            //filtros de estatus inicio 
            if($this->numerovalidoInputValido($data["eca_estatus"])) {
                $condicion .= ($condicion == '') ? " eca.eca_estatus={$data["eca_estatus"]}" : " and eca.eca_estatus={$data["eca_estatus"]}";
                $descripcion_bitacora .= ', con filtro de estatus de cancelacion '.$estcancelacion_obj->getEstatusNombre($data["eca_estatus"]);
            }
            //filtros de estatus fin

            // filtros varios inicio 
            if($this->numerovalidoInputValido($data["cac_id"])) {
                $condicion .= ($condicion == '') ? " eca.cac_id={$data["cac_id"]}" : " and eca.cac_id={$data["cac_id"]}";
                $descripcion_bitacora .= ', con filtro de motivo de cancelación  '.$estcancelacion_obj->getEstatusNombre($data["cac_id"]);
            }
            // filtros varios fin

            //filtros de fechas inicio
            
            // cambio de estatus ini
            if($this->fechaInputValida($data["eca_fechacambio_inicio"])){
                $condicion = ($condicion == '') ? $condicion.=" eca.eca_fechacambio>='".$data["eca_fechacambio_inicio"]."'" : $condicion.=" and eca.eca_fechacambio>='".$data["eca_fechacambio_inicio"]."'";
                $descripcion_bitacora.=", filtro de fecha inicial de cambio de cancelación: ".$data["eca_fechacambio_inicio"];
            }
            if($this->fechaInputValida($data["eca_fechacambio_fin"])){
                $condicion = ($condicion == '') ? $condicion.=" eca.eca_fechacambio<='".$data["eca_fechacambio_fin"]." 23:59:59'" :$condicion.=" and eca.eca_fechacambio<='".$data["eca_fechacambio_fin"]." 23:59:59'";
                $descripcion_bitacora.=", filtro de fecha final cambio de cancelación : ".$data["eca_fechacambio_fin"];
            }
            // registro  cancelacion  ini
                #estcancelacion 
                // if($this->fechaInputValida($data["eca_fecharegistro_inicio"])){
                //     $condicion = ($condicion == '') ? $condicion.=" eca.eca_fecharegistro>='".$data["eca_fecharegistro_inicio"]."'" : $condicion.=" and eca.eca_fecharegistro>='".$data["eca_fecharegistro_inicio"]."'";
                //     $descripcion_bitacora.=", filtro de fecha inicial de registro de cancelación: ".$data["eca_fecharegistro_inicio"];
                // }
                // if($this->fechaInputValida($data["eca_fecharegistro_fin"])){
                //     $condicion = ($condicion == '') ? $condicion.=" eca.eca_fecharegistro<='".$data["eca_fecharegistro_fin"]." 23:59:59'" :$condicion.=" and eca.eca_fecharegistro<='".$data["eca_fecharegistro_fin"]." 23:59:59'";
                //     $descripcion_bitacora.=", filtro de fecha final registro de cancelación : ".$data["eca_fecharegistro_fin"];
                // }
                #estudio
                if($this->fechaInputValida($data["eca_fecharegistro_inicio"])){
                    $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechacancelacion>='".$data["eca_fecharegistro_inicio"]."'" : $condicion.=" and Estudio.ese_fechacancelacion>='".$data["eca_fecharegistro_inicio"]."'";
                    $descripcion_bitacora.=", filtro de fecha inicial de registro de cancelación ESE : ".$data["eca_fecharegistro_inicio"];
                }
                if($this->fechaInputValida($data["eca_fecharegistro_fin"])){
                    $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_fechacancelacion<='".$data["eca_fecharegistro_fin"]." 23:59:59'" :$condicion.=" and Estudio.ese_fechacancelacion<='".$data["eca_fecharegistro_fin"]." 23:59:59'";
                    $descripcion_bitacora.=", filtro de fecha final registro de cancelación ESE : ".$data["eca_fecharegistro_fin"];
                }


            // alta ese  ini
            if($this->fechaInputValida($data["ese_registro_inicio"])){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_registro>='".$data["ese_registro_inicio"]."'" : $condicion.=" and Estudio.ese_registro>='".$data["ese_registro_inicio"]."'";
                $descripcion_bitacora.=", filtro de fecha inicial de registro de cancelación: ".$data["ese_registro_inicio"];
            }
            if($this->fechaInputValida($data["ese_registro_fin"])){
                $condicion = ($condicion == '') ? $condicion.=" Estudio.ese_registro<='".$data["ese_registro_fin"]." 23:59:59'" :$condicion.=" and Estudio.ese_registro<='".$data["ese_registro_fin"]." 23:59:59'";
                $descripcion_bitacora.=", filtro de fecha final registro de cancelación : ".$data["ese_registro_fin"];
            }

            //filtros de estatus fin


            /*=============================================
            =            Filtro fin            =
            =============================================*/ 

            
            // Ejecutamos consultas incio
           # error_log($condicion);error_log($columns_init);
            $regs=$regs->columns($columns_init)->where($condicion)->getQuery()->execute();
            // Ejecutamos consultas fin


            // Bitacora inicio
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = $descripcion_bitacora;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "Reporte de ese cancelación";
            $bitacora->NuevoRegistro($databit);
            // Bitacora fin

            $this->view->tipo_estudio_filtro =$tipo_estudio_filtro;
            $this->view->estudio_obj =$estudio_obj;
            $this->view->usuario = $usuario_obj;
            $this->view->page = $regs;
            $this->view->mensaje =$mensaje;
            $this->view->estcancelacion_obj=$estcancelacion_obj;
            $this->view->mensaje_nota_filtro_inv =$mensaje_nota_filtro_inv;
        } catch (\Exception $e) {
            $this->view->page = [];
            $prefijo_mensaje="Error en tabla reporte / ese cancelación ";
            $mensaje=$e->getMessage();
            $this->view->mensaje =$mensaje;
            $this->view->mensaje_nota_filtro_inv =$mensaje_nota_filtro_inv;

            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = $prefijo_mensaje.$e->getMessage();
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "ERROR";
            $bitacora->NuevoRegistro($databit);
            error_log($prefijo_mensaje.$e->getMessage());
            return;
            die();
        }

    }
    #REPORTES DE ESE CANCELADOS CATOLOGO FIN 

    
}