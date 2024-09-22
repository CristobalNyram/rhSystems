<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class CursootorgadoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Curso cerrado');
        parent::initialize();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(1,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla curso]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $curso = Cursootorgado::find(array(
            "cuo_estatus<=2 and cuo_estatus>=0 and cuo_tipo=1"
            ));
        
        $this->view->page=$curso;

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de cursos cerrados";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);
    }

    public function participantesAction($id)
    {
        $cuo=new Builder();
        $cuo=$cuo
        ->columns(array('e.emp_id,c.cur_nombre,e.emp_razonsocial,adm.adr_id,cuo_clave'))
        ->addFrom('Cursootorgado','cuo')
        ->join('Curso','c.cur_id=cuo.cur_id','c')
        ->join('Empresa','e.emp_id=cuo.emp_id','e')
        ->join('Administrador','adm.adm_id=cuo.adm_id','adm')
        ->where('cuo_id='.$id)
        ->getQuery()
        ->execute();
        $this->view->curso=$cuo[0]->cur_nombre;
        $this->view->empresa=$cuo[0]->emp_razonsocial;
        $this->view->id_curso=$id;
        $this->view->id_empresa=$cuo[0]->emp_id;
        $this->view->id_admindirector=$cuo[0]->adr_id;

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó participantes de curso cerrado ".$cuo[0]->cuo_clave;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);
    }

    public function tablaparticipantesAction($id)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $participantes = Participante::find(array(
            "par_estatus<=2 and par_estatus>=0 and cuo_id=".$id
            ));
        $cuo=new Builder();
        $cuo=$cuo
        ->columns(array('adm.adr_id'))
        ->addFrom('Cursootorgado','cuo')
        ->join('Administrador','adm.adm_id=cuo.adm_id','adm')
        ->where('cuo_id='.$id)
        ->getQuery()
        ->execute();

        // $cursootorgado = Cursootorgado::findFirstBycuo_id($id);

        $this->view->page=$participantes;
        $this->view->admindirector=$cuo[0]->adr_id;
    }


    public function reportedc3Action($id)
    {
        date_default_timezone_set('america/mexico_city');
        $url="sipscap.com/dc3/consulta/participantedc3/";
        $part = Participante::findFirstBypar_id($id);
        if($part->par_foliodc3==null){
            $max=Participante::maximum(array("column" => "par_foliodc3"));
            $part->par_foliodc3=$max+1;
            $part->par_fechadc3=date('Y-m-d H:i:s');
            $part->save();
        }
        $historial='';
        $auth = $this->session->get('auth');

        $participante=new Builder();
        $participante=$participante
        ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','p.tra_puesto','cur_nombre','cuo_horas','cuo_diploma',
            'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in','cuo_fechainicio',
            'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin', 'cuo_fechafinal',
            'e.emp_razonsocial', 'e.emp_rfc', 'e.emp_logo','ocu.ocu_clave', 'a.are_clave', 'adm.adm_nombre', 'adm.adm_logo',
            'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido','ins_firma',
            'p.par_id',
            'co.rep_idlegal','co.rep_idtra','p.par_foliodc3','DATE_FORMAT(par_fechadc3, "%d-%m-%Y") as fechadc3', 'par_fechadc3 as fecha_dc3doc'
        ))
        ->addFrom('Participante','p')
        ->join('Trabajador','p.tra_id=t.tra_id','t')
        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
        ->join('Curso','c.cur_id=co.cur_id','c')
        ->join('Empresa','e.emp_id=co.emp_id','e')
        ->join('Ocupacion','ocu.ocu_id=p.ocu_id','ocu')
        ->join('Areatematica','a.are_id=c.are_id','a')
        ->join('Administrador','adm.adm_id=co.adm_id','adm')
        ->join('Instructor','i.ins_id=co.ins_id','i')
        // ->join('Representante','rl.rep_id=co.rep_idlegal','rl')
        // ->join('Representante','rt.rep_id=co.rep_idtra','rt')
        ->where('par_id='.$id)
        ->getQuery()
        ->execute();

        include('phpqrcode/qrlib.php');
        // $datos=;
        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';
        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);
            //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'qr.png';
            //Parametros de Condiguración
        $tamaño = 5; //Tamaño de Pixel
        $level = 'L'; //Precisión Baja
        $framSize = 1; //Tamaño en blanco
        $contenido = $url.$participante[0]->par_foliodc3; //Texto
            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

        $this->view->disable();
        //INICIA CONFIGURACIÓN PÁGINA
            $pdf= new PDF('P','mm','A4');
            $pdf->SetMargins(10, 10 , 10);
            $pdf->SetTitle('FORMATO DC-3', true);
            // $pdf->AliasNbPages();
            $var = 1;
            $pdf->AddPage();
        for($i=1;$i<=$var;$i++){
        //TERMINA CONFIGURACIÓN PÁGINA
        //INICIA HEADER
            $historial=$participante[0];
            $historial->rep_nombrelegal='';
            $historial->rep_primerapellidolegal='';
            $historial->rep_segundoapellidolegal='';
            $historial->rep_nombretra='';
            $historial->rep_primerapellidotra='';
            $historial->rep_segundoapellidotra='';
            $pdf->Image('images/recursos/'.$participante[0]->adm_logo,15,10);//(x,y,tamaño imagen)
            if($participante[0]->emp_logo!=null)
                $pdf->Image('images/empresa/'.$participante[0]->emp_logo,155,10);//(x,y,tamaño imagen)
            $pdf->SetFont('Arial','B',12.5);
            $pdf->Ln(5);
            $pdf->Cell(0,0,utf8_decode('FORMATO DC-3'),0,0,'C');
            $pdf->Ln(6);
            $pdf->Cell(0,0,utf8_decode('CONSTANCIA DE COMPETENCIAS O DE HABILIDADES LABORALES'),0,0,'C');
            $pdf->Ln(5);
        //TERMINA HEADER
        //INICIA CONTENIDO
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(0,6,utf8_decode('DATOS DEL TRABAJADOR'),1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,6,utf8_decode('NOMBRE (ANOTAR APELLIDO PATERNO, APELLIDO MATERNO Y NOMBRE(S))'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper(trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido).' '.trim($participante[0]->tra_nombre))),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',7.5);            
            $pdf->Cell(95,6,utf8_decode('CLAVE ÚNICA DE REGISTRO DE POBLACIÓN'),'LR',0,'C');
            $pdf->Cell(95,6,utf8_decode('OCUPACIÓN ESPECÍFICA (CATÁLOGO NACIONAL DE OCUPACIONES)1/'),'R',0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(95,4,utf8_decode(mb_strtoupper($participante[0]->tra_curp)),'LRB',0,'L');
            $pdf->Cell(95,4,utf8_decode($participante[0]->ocu_clave),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);            
            $pdf->Cell(0,6,utf8_decode('PUESTO*'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->tra_puesto)),'LRB',0,'L');
            $pdf->Ln(7);
            $pdf->SetFont('Arial','B',12.5);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(0,6,utf8_decode('DATOS DE LA EMPRESA'),1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,6,utf8_decode('Nombre o razón social (en caso de persona física, anotar apellido paterno, apellido materno y nombre(s))'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->emp_razonsocial)),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);            
            $pdf->Cell(0,6,utf8_decode('Registro Federal de Contribuyentes con homoclave (SHCP)'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->emp_rfc)),'LRB',0,'L');
            $pdf->Ln(7);
            $pdf->SetFont('Arial','B',12.5);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(0,6,utf8_decode('DATOS DEL PROGRAMA DE CAPACITACIÓN, ADIESTRAMIENTO Y PRODUCTIVIDAD'),1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,6,utf8_decode('NOMBRE DEL CURSO'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->cur_nombre)),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(40,6,utf8_decode('DURACIÓN EN HORAS'),'L',0,'L');
            $pdf->Cell(23,6,utf8_decode('PERIODO DE'),'L',0,'L');
            $pdf->Cell(20,6,utf8_decode('AÑO'),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('MES'),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('DÍA'),'L',0,'C');
            $pdf->Cell(8,6,utf8_decode(''),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('AÑO'),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('MES'),'L',0,'C');
            $pdf->Cell(19,6,utf8_decode('DÍA'),'LR',0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(40,4,utf8_decode($participante[0]->cuo_horas.' HORAS'),'LB',0,'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(23,4,utf8_decode('EJECUCIÓN: DE'),'LB',0,'L');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(20,4,utf8_decode($participante[0]->anio_in),'LB',0,'C');
            $pdf->Cell(20,4,utf8_decode($participante[0]->mes_in),'LB',0,'C');
            $pdf->Cell(20,4,utf8_decode($participante[0]->dia_in),'LB',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8,4,utf8_decode('A'),'LB',0,'C');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(20,4,utf8_decode($participante[0]->anio_fin),'LB',0,'C');
            $pdf->Cell(20,4,utf8_decode($participante[0]->mes_fin),'LB',0,'C');
            $pdf->Cell(19,4,utf8_decode($participante[0]->dia_fin),'LRB',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Ln();
            $pdf->Cell(0,6,utf8_decode('ÁREA TEMÁTICA DEL CURSO 2/'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode($participante[0]->are_clave),'LRB',0,'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Ln();
            $pdf->Cell(0,6,utf8_decode('NOMBRE DEL AGENTE CAPACITADOR O STPS 3/'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode($participante[0]->adm_nombre),'LRB',0,'L');
            $pdf->Ln(9);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(0,6,utf8_decode('Los datos se asientan en esta constancia bajo protesta de decir verdad, apercibidos de la responsabilidad en que incurre todo'),'LRT',0,'C');
            $pdf->Ln();
            $pdf->Cell(0,5,utf8_decode('aquel que no se conduce con verdad.'),'LR',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Ln();        
            $pdf->Cell(70,15,utf8_decode('Instructor o tutor'),'L',0,'C');        
            $pdf->Cell(55,15,utf8_decode('Patrón o representante legal 4/'),'',0,'C');     
            $pdf->Cell(65,15,utf8_decode('Representante de los trabajadores 5/'),'R',0,'C');     
            $pdf->Ln(15);     
            $pdf->Cell(70,10,utf8_decode(mb_strtoupper(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido))),'L',0,'C');

            if($participante[0]->rep_idlegal!=null)
            {
                $part = Representante::findFirstByrep_id($participante[0]->rep_idlegal);   
                $pdf->Cell(55,10,utf8_decode(mb_strtoupper(trim($part->rep_nombre).' '.trim($part->rep_primerapellido).' '.trim($part->rep_segundoapellido))),'',0,'C');

                $historial->rep_nombrelegal=$part->rep_nombre;
                $historial->rep_primerapellidolegal=$part->rep_primerapellido;
                $historial->rep_segundoapellidolegal=$part->rep_segundoapellido;
                
            } 
            if($participante[0]->rep_idtra!=null)
            {
                $part = Representante::findFirstByrep_id($participante[0]->rep_idtra);   
                $pdf->Cell(65,10,utf8_decode(mb_strtoupper(trim($part->rep_nombre).' '.trim($part->rep_primerapellido).' '.trim($part->rep_segundoapellido))),'R',0,'C');
                $historial->rep_nombretra=$part->rep_nombre;
                $historial->rep_primerapellidotra=$part->rep_primerapellido;
                $historial->rep_segundoapellidotra=$part->rep_segundoapellido;
            }
            else
                $pdf->Cell(120,10,'','R',0,'C');
            // $pdf->Cell(55,10,utf8_decode($participante[0]->emp_nombrelegal.' '.$participante[0]->emp_primerapellidolegal.' '.$participante[0]->emp_segundoapellidolegal),'',0,'C');          
            // $pdf->Cell(65,10,utf8_decode($participante[0]->emp_nombretrabajador.' '.$participante[0]->emp_primerapellidotrabajador.' '.$participante[0]->emp_segundoapellidotrabajador),'R',0,'C');
            if($participante[0]->cuo_diploma==2){
                $pdf->Image('images/firmas/'.$participante[0]->ins_firma,35,185,20,9);//(x,y,tamaño imagen)
            }         
            $pdf->Line(20,199,70,199);
            $pdf->Line(80,199,130,199);
            $pdf->Line(140,199,190,199);
            $pdf->Ln();     
            $pdf->Cell(70,4,utf8_decode('Nombre y firma'),'LB',0,'C');        
            $pdf->Cell(55,4,utf8_decode('Nombre y firma'),'B',0,'C');     
            $pdf->Cell(65,4,utf8_decode('Nombre y firma'),'RB',0,'C');
        //TERMINA CONTENID0
        //INICIA FOOTER
            $pdf->Ln(8);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(0,4,utf8_decode('INSTRUCCIONES'),'',0,'L');
            $pdf->SetFont('Arial','',7);
            $pdf->Ln();     
            $pdf->Cell(0,4,utf8_decode('- Llenar a máquina o con letra de molde.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('- Deberá entregarse al trabajador dentro de los veinte días hábiles siguientes al término del curso de capacitación aprobado.'),'',0,'L');  
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('1/ Las áreas y subáreas ocupacionales del Catálogo Nacional de Ocupaciones se encuentran disponibles en el reverso de este formato y en la página www.stps.gob.mx'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('2/ Las área temáticas de los cursos se encuentran disponibles en el reverso de este formato y en la página ww.stps.gob.mx'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('3/ Cursos impartidos por el área competente de la Secretaría del Trabajo y Prevensión Social.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('4/ Para empresas con menos de 51 trabajadores. Para empresas con más de 50 trabajadores firmaría el representante del patrón ante la Comisión mixta de capacitación,'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('   adiestramiento y productividad.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('5/ Solo para empresas con más de 50 trabajadores.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('* Dato no obligatorio.'),'',0,'L');
            $pdf->Ln(10);     
            $pdf->Cell(0,4,utf8_decode('DC-3'),'',0,'R');
            $pdf->Ln();     
            $pdf->Cell(0,4,utf8_decode('ANVERSO'),'',0,'R');
            $pdf->Image($dir.basename($filename),15,241,32);//(x,y,tamaño imagen)
            $pdf->SetFont('Arial','',9);
            $pdf->Text(15,276,'Folio: '.$participante[0]->par_foliodc3);
            $pdf->Text(15,280,$participante[0]->fechadc3);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetY(-15);
            if($i == $var){
                $pdf->Image('images/recursos/'.$participante[0]->adm_logo,15,10,0);//(x,y,tamaño imagen)
                if($participante[0]->emp_logo!=null)
                    $pdf->Image('images/empresa/'.$participante[0]->emp_logo,155,10,0);//(x,y,tamaño imagen)
            }

            unlink($dir.basename($filename));

            $hisdescarga= new Historialdescarga();
            $hisdescarga->NuevoRegistrodc3($historial,$auth['id'],1);
            
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un documento DC3 de manera individual (curso cerrado)";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $bitacora->NuevoRegistro($databit);
        //TERMINA FOOTER
        }
        $pdf->Output('D');
        // $pdf->Output();
        $this->view->pdf=$pdf;

    }

   /* public function reportediplomaAction($id)
    {
        date_default_timezone_set('america/mexico_city');
        $url="sipscap.com/dc3/consulta/participantedip/";
        $part = Participante::findFirstBypar_id($id);
        if($part->par_foliodip==null){
            $max=Participante::maximum(array("column" => "par_foliodip"));
            $part->par_foliodip=$max+1;
            $part->par_fechadip=date('Y-m-d H:i:s');
            $part->save();
        }

        $participante=new Builder();
        $participante=$participante
        ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas',
            'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
            'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
            'par_id','adm.adm_nombredirector','adm.adm_primerapellidodirector', 'adm.adm_segundoapellidodirector','adm.adm_puestofirma','adm.adm_logo','adm.adm_nombre',
            'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido',
            'e.est_nombre','m.mun_nombre',
            'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','cuo_fechafinal'))
        ->addFrom('Participante','p')
        ->join('Trabajador','p.tra_id=t.tra_id','t')
        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
        ->join('Curso','c.cur_id=co.cur_id','c')
        ->join('Administrador','adm.adm_id=co.adm_id','adm')
        ->join('Instructor','i.ins_id=co.ins_id','i')
        ->join('Estado','co.est_id=e.est_id','e')
        ->join('Municipio','co.mun_cla=m.mun_cla','m')
        ->where('par_id='.$id)
        ->getQuery()
        ->execute();

        include('phpqrcode/qrlib.php');
        // $datos=;

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';

        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);

            //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'qr.png';

            //Parametros de Condiguración

        $tamaño = 5; //Tamaño de Pixel
        $level = 'L'; //Precisión Baja
        $framSize = 1; //Tamaño en blanco
        $contenido = $url.$participante[0]->par_foliodip; //Texto

            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

        $this->view->disable();
        $var = 1;
        
        //INICIA CONFIGURACIÓN PÁGINA
            $pdf= new PDF('L','mm','A4');
            $pdf->SetMargins(20, 10 , 20);
            $pdf->SetTitle('CONSTANCIA', true);            
            $pdf->AliasNbPages();
            $pdf->AddPage();
        //TERMINA CONFIGURACIÓN PÁGINA
        for($i=1;$i<=$var;$i++){
        //INICIA HEADER
            // $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            $pdf->SetFont('Times','B',16);
            $pdf->Cell(130);
            $pdf->Cell(50,-15,' ',0,0,'C');
            $pdf->Ln(5);   
        //TERMINA HEADER
        //INICIA CONTENIDO
            $pdf->SetFont('Times','',12);
            $pdf->Cell(55);
            $pdf->Cell(0,0,' ',0,0,'C');
            $pdf->Ln(20);
            $pdf->AddFont('Gothicb','','CenturyGothicBold.php');
            $pdf->SetFont('Gothicb','',27);
            $pdf->Cell(55);
            $pdf->SetTextColor(255,212,51);
            $pdf->Cell(0,0,' ',0,0,'C');
            $pdf->SetTextColor(0,0,0);
            $pdf->Ln(25);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('A: '. $this->primermayus(trim($participante[0]->tra_nombre).' '.trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido))),0,0,'C');
            // $pdf->Cell(0,0,utf8_decode('A: '. ucwords(mb_strtolower(trim($participante[0]->tra_nombre))).' '.ucwords(mb_strtolower(trim($participante[0]->tra_primerapellido))).' '.ucwords(mb_strtolower(trim($participante[0]->tra_segundoapellido)))),0,0,'C');
            $pdf->Ln(18);
            $pdf->Image($dir.basename($filename),40,90,40);//(x,y,tamaño imagen)
            $pdf->SetFont('Times','',9);
            $pdf->Text(45,134,'Folio: '.$participante[0]->par_foliodip);
            $pdf->Text(45,137,$participante[0]->fechadip);
            $pdf->SetFont('Times','',18);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('Por su participación en el Taller'),0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('"'.$this->mb_ucwords($participante[0]->cur_nombre)).'"',0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('Que se realizó en '.$this->primermayus(trim($participante[0]->mun_nombre).', '.trim($participante[0]->est_nombre))."."),0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(55);
            $fecha= new Fecha();
            if($participante[0]->cuo_fechainicio==$participante[0]->cuo_fechafinal){
                $pdf->Cell(0,0,utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.'),0,0,'C');
            }else
            {
                $pdf->Cell(0,0,utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin."."),0,0,'C');
            }
            $pdf->Ln(7);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('Duración: '.$participante[0]->cuo_horas.' Horas.'),0,0,'C');
            $pdf->Ln(7);
        //TERMINA CONTENIDO
        //INICIA FOOTER
            $pdf->SetFont('Times','',12);
            $pdf->Line(90,155,160,155);
            $pdf->Line(190,155,260,155);
            $pdf->Ln(30);
            $pdf->Cell(70);
            $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido))),0,0,'C');
            $pdf->Cell(30);
            $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->adm_nombredirector).' '.trim($participante[0]->adm_primerapellidodirector).' '.trim($participante[0]->adm_segundoapellidodirector))),0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(70);
            $pdf->Cell(70,0,utf8_decode('Facilitador'),0,0,'C');
            $pdf->Cell(30);
            $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->adm_puestofirma))),0,0,'C');
            $pdf->SetY(-15);
            // if($i == $var){
            //     $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            // }
        //TERMINA FOOTER
            unlink($dir.basename($filename));
        }
        $pdf->Output('D');
        // $pdf->Output();
        $this->view->pdf=$pdf;

    }*/

    /**
     * [nuevoAction Crea un nuevo registro de la tabla país]
     * @param        []
     * @return []    []
     */
    public function formularioAction($clave="")
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
       
        $form = new CursootorgadoForm;
        if($clave=="")
        {

            $form->NuevosCampos();
        }
        else
            $form->EditarCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();  
            // $data["via_fechaini"]=$this->convertir_fecha($data["via_fechaini"]);
            // $data["via_fechafin"]=$this->convertir_fecha($data["via_fechafin"]); 
            $curso= new Cursootorgado();
            $id=$auth['id'];
            if($clave=="")
                $res=$curso->NuevoRegistro($data,$id);
            else
                $res=$curso->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Creó un curso cerrado";
                }else{
                    $databit['bit_descripcion']= "Editó un curso cerrado con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);

                $this->flash->success("Registro exitoso");
                $this->response->redirect('cursootorgado/index/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($curso->error);
            }
        }
       $clases=array(
        array("cuo_clave","col-sm-3 col-xs-12","control-label"),
        array("pai_id","col-sm-3 col-xs-6","control-label"),
        array("est_id","col-sm-3 col-xs-6","control-label"),
        array("mun_cla","col-sm-3 col-xs-6","control-label"),
        array("cur_id","col-sm-6 col-xs-6","control-label"),
        array("cuo_horas","col-sm-3 col-xs-3","control-label"),
        array("emp_id","col-sm-6 col-xs-6","control-label"),
        array("cen_id","col-sm-6 col-xs-6","control-label"),
        array("rep_leg","col-sm-6 col-xs-6","control-label"),
        array("rep_tra","col-sm-6 col-xs-6","control-label"),
        array("adm_id","col-sm-5 col-xs-5","control-label"),
        array("ins_id","col-sm-5 col-xs-5","control-label"),
        array("cuo_estatus","col-sm-3 col-xs-12","control-label"),
        array("cuo_fechainicio","col-sm-3 col-xs-12","control-label"),
        array("cuo_fechafinal","col-sm-3 col-xs-12","control-label"),
        array("cuo_diploma","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $curso=Cursootorgado::findFirstBycuo_id($clave);
            if(!$curso)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("cursootorgado/index");
            }
            $clases=array(
                array("cuo_id","col-sm-1 col-xs-2","control-label"),
                array("cuo_clave","col-sm-2 col-xs-2","control-label"),
                array("pai_id","col-sm-2 col-xs-6","control-label"),
                array("est_id","col-sm-3 col-xs-6","control-label"),
                array("mun_cla","col-sm-3 col-xs-6","control-label"),
                array("cur_id","col-sm-6 col-xs-5","control-label"),
                array("cuo_horas","col-sm-6 col-xs-5","control-label"),
                array("emp_id","col-sm-6 col-xs-5","control-label"),
                array("cen_id","col-sm-6 col-xs-6","control-label"),
                array("adm_id","col-sm-6 col-xs-6","control-label"),
                array("ins_id","col-sm-6 col-xs-6","control-label"),
                array("cuo_fechainicio","col-sm-3 col-xs-12","control-label"),
                array("cuo_fechafinal","col-sm-3 col-xs-12","control-label"),
                array("cuo_estatus","col-sm-3 col-xs-12","control-label"),
                array("cuo_diploma","col-sm-3 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('cuo_id',$curso->cuo_id);
            $this->tag->setDefault('cuo_clave',$curso->cuo_clave);
            $this->tag->setDefault('pai_id',$curso->pai_id);
            $this->tag->setDefault('est_id',$curso->est_id);
            $this->tag->setDefault('mun_cla',$curso->mun_cla);
            $this->tag->setDefault('cur_id',$curso->cur_id);
            $this->tag->setDefault('cuo_horas',$curso->cuo_horas);
            $this->tag->setDefault('emp_id',$curso->emp_id);
            $this->tag->setDefault('cen_id',$curso->cen_id);
            $this->tag->setDefault('adm_id',$curso->adm_id);
            $this->tag->setDefault('ins_id',$curso->ins_id);
            $this->tag->setDefault('cuo_estatus',$curso->cuo_estatus);
            $this->tag->setDefault('cuo_fechainicio',$curso->cuo_fechainicio);
            $this->tag->setDefault('cuo_fechafinal',$curso->cuo_fechafinal);
            $this->tag->setDefault('cuo_diploma',$curso->cuo_diploma);
            // $this->tag->setDefault('cur_estatus',$curso->cur_estatus);

        }
        else
            $this->view->vvia_producto="";
        $this->view->form = $form;
        $this->view->clave=$clave;
        $this->view->clases=$clases; 
        
    }

    /*public function formulario2Action($clave="")
    {
        
        $auth = $this->session->get('auth');
        
        $form = new CursootorgadoForm;
        $form->NuevosCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $curso= new Cursootorgado();
            $auth = $this->session->get('auth');
            $id=$auth['id'];
            if($curso->NuevoRegistro($data,$id)==true){ 
                $this->flash->success("Registro creado exitosamente");
                $this->response->redirect('cursootorgado/index');
                $this->view->disable();
                return;
            }
            else{
                $this->flash->error($curso->error);
            }
        }
        $clases=array(
        
        array("cur_id","col-sm-6 col-xs-6","control-label"),
        array("emp_id","col-sm-6 col-xs-6","control-label"),
        array("cuo_estatus","col-sm-3 col-xs-12","control-label"),
        array("cuo_fechainicio","col-sm-3 col-xs-12","control-label"),
        array("cuo_fechafinal","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        $this->view->form = $form;
        $this->view->clave=$clave;
        $this->view->clases=$clases; 
        
    }*/

    /**
     * [editarAction Edita un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    /*public function editarAction($id)
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(39,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form= new PaisForm;
        $form->EditarCampos();
        // $this->view->clave=$id;
        if (!$this->request->isPost()) 
        {

            $pais = Pais::findFirstBypai_id($id);
            if (!$pais) 
            {
                $this->flash->error("País no encontrado");
                return $this->forward("pais/index");
            }
            $this->tag->setDefault('pai_id',$pais->pai_id);
            $this->tag->setDefault('pai_nombre',$pais->pai_nombre);
            $this->tag->setDefault('pai_estatus',$pais->pai_estatus);
            
        }
        else
        {
            $data = $this->request->getPost();
            $pais= new Pais();
            $auth = $this->session->get('auth');
            $id=$auth['id'];
            if($pais->EditarRegistro($data,$id))
            {
                
                    $this->flash->success("Registro editado exitosamente");
                    $this->response->redirect('pais/index');
                    $this->view->disable();
                    return;
            }
            else
            {
                $this->flash->error('Ocurrió un error al editar el registro');
                return $this->forward('pais/editar/' . $data['pai_id']);
            }

        }
        $this->view->form = $form;

    }*/


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id)
    {
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $curso = Curso::findFirstBycur_id($id);
        if (!$curso) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $curso->cur_estatus = -1;
        
        if ($curso->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function participantenuevoAction()
    {
        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            if($this->request->hasFiles() == true){
                $uploads = $this->request->getUploadedFiles();
                $isUploaded = false;
                $date= new DateTime();
                $upload=$uploads[0];

                $a=''.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                #do a loop to handle each file individually
                // foreach($uploads as $upload){

                #define a “unique” name and a path to where our file must go
                $path = 'reporte/'.$a;
                $data = $this->request->getPost();            
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    // require_once 'PHPExcel/Classes/PHPExcel.php';
                    $archivo = $path;
                    $inputFileType = PHPExcel_IOFactory::identify($archivo);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($archivo);
                    $sheet = $objPHPExcel->getSheet(0); 
                    $highestRow = $sheet->getHighestRow(); 
                    $highestColumn = $sheet->getHighestColumn();
                    $curpvaciaidtra=0;
                    for ($row = 2; $row <= $highestRow; $row++){ 
                        $existe=false;
                        $data['tra_curp']= !empty($sheet->getCell("A".$row)->getValue()) ? trim($sheet->getCell("A".$row)->getValue()) : ' ';
                        // $data['tra_curp']= $sheet->getCell("A".$row)->getValue();
                        if($data['tra_curp']!= ' ')
                        {
                            $existe=Trabajador::findFirstBytra_curp($data["tra_curp"]);
                        }
                        if($existe){
                            $res=1;
                        }
                        else
                        {
                            //si el trabajador no existe
                            $trabajador= new Trabajador();


                            // A==5 ? dispara(): espera();
                            // $data['tra_nombre']= $sheet->getCell("B".$row)->getValue()!=null ? trim($sheet->getCell("B".$row)->getValue()) : '';
                            $data['tra_nombre']= $this->upper(trim($sheet->getCell("B".$row)->getValue()));
                            $data['tra_primerapellido'] = $this->upper(trim($sheet->getCell("C".$row)->getValue()));
                            // $data['tra_segundoapellido']= trim($sheet->getCell("D".$row)->getValue());
                            $data['tra_segundoapellido']= !empty($sheet->getCell("D".$row)->getValue()) ? $this->upper(trim($sheet->getCell("D".$row)->getValue())) : ' ';

                            
                            // $data['tra_puesto']= $sheet->getCell("E".$row)->getValue();
                            //busqueda de ocupación de acuerdo a clave de excel
                            
                            $data['emp_id']=$data['id_emp'];
                            // echo "<br>";
                            $res=$trabajador->NuevoRegistro($data);
                            $curpvaciaidtra=$res;

                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= "Creó un trabajador: ".$data['tra_curp'];
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$res;
                            $bitacora->NuevoRegistro($databit);
                        }
                        if($res>0){
                            if($data['tra_curp']!= ' ')
                            {
                                //el trabajador ya existe
                                $trabajador=Trabajador::findFirstBytra_curp($data["tra_curp"]);

                                $existeparticipante=Participante::query()
                                    ->columns("par_id")
                                    // ->join('Proyecto','p.pro_id=Ordenfactura.pro_id','p')
                                    ->where('cuo_id='.$data['id_cuo'].' and tra_id='.$trabajador->tra_id)
                                    ->execute();

                                if(count($existeparticipante)!=0){

                                }
                                else
                                {
                                    $trabajador=Trabajador::findFirstBytra_curp($data["tra_curp"]);
                                    $participante= new Participante();
                                    $datap['cuo_id']= $data['id_cuo'];
                                    $datap['tra_id']= $trabajador->tra_id;
                                    $datap['tra_puesto']= !empty($sheet->getCell("E".$row)->getValue()) ? $this->upper(trim($sheet->getCell("E".$row)->getValue())) : ' ';
                                    $ocupacion=explode('-',$sheet->getCell("F".$row)->getValue());
                                    $ocu=Ocupacion::findFirstByocu_clave($ocupacion[0]);
                                    $datap['ocu_id']=($ocu) ? $ocu->ocu_id : null;
                                    $datap['par_estatus']=2;
                                    $res=$participante->NuevoRegistro($datap);

                                    $auth = $this->session->get('auth');
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= "Agregó un participante ".$trabajador->tra_curp." masivamente al curso cerrado con id ".$datap['cuo_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$res;
                                    $bitacora->NuevoRegistro($databit);

                                    if($res>0){
                                    }
                                }
                            }
                            else
                            {
                                $participante= new Participante();
                                $datap['cuo_id']= $data['id_cuo'];
                                $datap['tra_id']= $curpvaciaidtra;
                                $datap['tra_puesto']= !empty($sheet->getCell("E".$row)->getValue()) ? $this->upper(trim($sheet->getCell("E".$row)->getValue())) : ' ';
                                $ocupacion=explode('-',$sheet->getCell("F".$row)->getValue());
                                $ocu=Ocupacion::findFirstByocu_clave($ocupacion[0]);
                                $datap['ocu_id']=($ocu) ? $ocu->ocu_id : null;
                                $datap['par_estatus']=2;
                                $res=$participante->NuevoRegistro($datap);

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Agregó un participante ".$curpvaciaidtra." masivamente al curso cerrado con id ".$datap['cuo_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$res;
                                $bitacora->NuevoRegistro($databit);
                            }
                        }
                    }
                }
                $this->flash->success("Datos guardados correctamente");
                $this->response->redirect('cursootorgado/participantes/'.$data['id_cuo']);
                $this->view->disable();
                return;
            }
        }
    }

    public function dc3masaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data = $this->request->getPost();
        date_default_timezone_set('america/mexico_city');

        $arreglo=json_encode($data);
        $json=json_decode($arreglo,true);
        $cont= count($json['arreglo']);
        $valor=json_encode($json['arreglo'][0]['valor']);
        $entero=json_decode($valor);
        // echo $arreglo;
        // exit;
        $id=1;
        

        include('phpqrcode/qrlib.php');
        // $datos=;
        //INICIA CONFIGURACIÓN PÁGINA
        $pdf= new PDF('P','mm','A4');
        $pdf->SetMargins(10, 10 , 10);
        $pdf->SetTitle('FORMATO DC-3', true);
        // $pdf->AliasNbPages();
        $var = $cont;
            
        for($i=1;$i<=$var;$i++){
            

            $pdf->AddPage();
            $valor=json_encode($json['arreglo'][$i-1]['valor']);
            $entero=json_decode($valor);

            $url="sipscap.com/dc3/consulta/participantedc3/";
            $part = Participante::findFirstBypar_id($entero);
            if($part->par_foliodc3==null){
                $max=Participante::maximum(array("column" => "par_foliodc3"));
                $part->par_foliodc3=$max+1;
                $part->par_fechadc3=date('Y-m-d H:i:s');
                $part->save();
            }
            $participante=new Builder();
            $participante=$participante
            ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','p.tra_puesto','cur_nombre','cuo_horas','cuo_diploma',
                'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in','cuo_fechainicio',
                'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin','cuo_fechafinal',
                'e.emp_razonsocial', 'e.emp_rfc', 'e.emp_logo','ocu.ocu_clave', 'a.are_clave', 'adm.adm_nombre', 'adm.adm_logo',
                // 'e.emp_nombrelegal','e.emp_primerapellidolegal','e.emp_segundoapellidolegal',
                // 'e.emp_nombretrabajador','e.emp_primerapellidotrabajador','e.emp_segundoapellidotrabajador',
                'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido', 'i.ins_firma',
                'p.par_id','co.rep_idlegal','co.rep_idtra','p.par_foliodc3','DATE_FORMAT(par_fechadc3, "%d-%m-%Y") as fechadc3', 'par_fechadc3 as fecha_dc3doc'))
            ->addFrom('Participante','p')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
            ->join('Curso','c.cur_id=co.cur_id','c')
            ->join('Empresa','e.emp_id=co.emp_id','e')
            ->join('Ocupacion','ocu.ocu_id=p.ocu_id','ocu')
            ->join('Areatematica','a.are_id=c.are_id','a')
            ->join('Administrador','adm.adm_id=co.adm_id','adm')
            ->join('Instructor','i.ins_id=co.ins_id','i')
            ->where('par_id='.$entero)
            ->getQuery()
            ->execute();

            $historial='';
            $auth = $this->session->get('auth');
            $historial=$participante[0];
            $historial->rep_nombrelegal='';
            $historial->rep_primerapellidolegal='';
            $historial->rep_segundoapellidolegal='';
            $historial->rep_nombretra='';
            $historial->rep_primerapellidotra='';
            $historial->rep_segundoapellidotra='';
        //Declaramos una carpeta temporal para guardar la imagenes generadas
            $dir = 'temp/';
            //Si no existe la carpeta la creamos
            if (!file_exists($dir))
                mkdir($dir);
                //Declaramos la ruta y nombre del archivo a generar
            $filename = $dir.'qr'.$entero.'.png';
                //Parametros de Condiguración
            $tamaño = 5; //Tamaño de Pixel
            $level = 'L'; //Precisión Baja
            $framSize = 1; //Tamaño en blanco
            $contenido = $url.$participante[0]->par_foliodc3; //Texto
                //Enviamos los parametros a la Función para generar código QR 
            QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            $this->view->disable();
        // //INICIA CONFIGURACIÓN PÁGINA
        //     $pdf= new PDF('P','mm','A4');
        //     $pdf->SetMargins(10, 10 , 10);
        //     $pdf->SetTitle('FORMATO DC-3', true);
        //     // $pdf->AliasNbPages();
        //     $var = 1;
        //     $pdf->AddPage();
        // for($i=1;$i<=$var;$i++){
        //TERMINA CONFIGURACIÓN PÁGINA
        //INICIA HEADER
            //$pdf->Image('images/recursos/'.$participante[0]->adm_logo,15,10,40);//(x,y,tamaño imagen)
            //$pdf->Image('images/empresa/'.$participante[0]->emp_logo,155,10,40);//(x,y,tamaño imagen)
            $pdf->SetFont('Arial','B',12.5);
            $pdf->Ln(5);
            $pdf->Cell(0,0,utf8_decode('FORMATO DC-3'),0,0,'C');
            $pdf->Ln(6);
            $pdf->Cell(0,0,utf8_decode('CONSTANCIA DE COMPETENCIAS O DE HABILIDADES LABORALES'),0,0,'C');
            $pdf->Ln(5);
        //TERMINA HEADER
        //INICIA CONTENIDO
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(0,6,utf8_decode('DATOS DEL TRABAJADOR'),1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,6,utf8_decode('NOMBRE (ANOTAR APELLIDO PATERNO, APELLIDO MATERNO Y NOMBRE(S))'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper(trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido).' '.trim($participante[0]->tra_nombre))),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',7.5);            
            $pdf->Cell(95,6,utf8_decode('CLAVE ÚNICA DE REGISTRO DE POBLACIÓN'),'LR',0,'C');
            $pdf->Cell(95,6,utf8_decode('OCUPACIÓN ESPECÍFICA (CATÁLOGO NACIONAL DE OCUPACIONES)1/'),'R',0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(95,4,utf8_decode(mb_strtoupper(trim($participante[0]->tra_curp))),'LRB',0,'L');
            $pdf->Cell(95,4,utf8_decode($participante[0]->ocu_clave),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);            
            $pdf->Cell(0,6,utf8_decode('PUESTO*'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->tra_puesto)),'LRB',0,'L');
            $pdf->Ln(7);
            $pdf->SetFont('Arial','B',12.5);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(0,6,utf8_decode('DATOS DE LA EMPRESA'),1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,6,utf8_decode('Nombre o razón social (en caso de persona física, anotar apellido paterno, apellido materno y nombre(s))'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->emp_razonsocial)),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);            
            $pdf->Cell(0,6,utf8_decode('Registro Federal de Contribuyentes con homoclave (SHCP)'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->emp_rfc)),'LRB',0,'L');
            $pdf->Ln(7);
            $pdf->SetFont('Arial','B',12.5);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(0,6,utf8_decode('DATOS DEL PROGRAMA DE CAPACITACIÓN, ADIESTRAMIENTO Y PRODUCTIVIDAD'),1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,6,utf8_decode('NOMBRE DEL CURSO'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode(mb_strtoupper($participante[0]->cur_nombre)),'LRB',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(40,6,utf8_decode('DURACIÓN EN HORAS'),'L',0,'L');
            $pdf->Cell(23,6,utf8_decode('PERIODO DE'),'L',0,'L');
            $pdf->Cell(20,6,utf8_decode('AÑO'),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('MES'),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('DÍA'),'L',0,'C');
            $pdf->Cell(8,6,utf8_decode(''),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('AÑO'),'L',0,'C');
            $pdf->Cell(20,6,utf8_decode('MES'),'L',0,'C');
            $pdf->Cell(19,6,utf8_decode('DÍA'),'LR',0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(40,4,utf8_decode($participante[0]->cuo_horas.' HORAS'),'LB',0,'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(23,4,utf8_decode('EJECUCIÓN: DE'),'LB',0,'L');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(20,4,utf8_decode($participante[0]->anio_in),'LB',0,'C');
            $pdf->Cell(20,4,utf8_decode($participante[0]->mes_in),'LB',0,'C');
            $pdf->Cell(20,4,utf8_decode($participante[0]->dia_in),'LB',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8,4,utf8_decode('A'),'LB',0,'C');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(20,4,utf8_decode($participante[0]->anio_fin),'LB',0,'C');
            $pdf->Cell(20,4,utf8_decode($participante[0]->mes_fin),'LB',0,'C');
            $pdf->Cell(19,4,utf8_decode($participante[0]->dia_fin),'LRB',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Ln();
            $pdf->Cell(0,6,utf8_decode('ÁREA TEMÁTICA DEL CURSO 2/'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode($participante[0]->are_clave),'LRB',0,'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Ln();
            $pdf->Cell(0,6,utf8_decode('NOMBRE DEL AGENTE CAPACITADOR O STPS 3/'),'LR',0,'L');
            $pdf->Ln();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,4,utf8_decode($participante[0]->adm_nombre),'LRB',0,'L');
            $pdf->Ln(9);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(0,6,utf8_decode('Los datos se asientan en esta constancia bajo protesta de decir verdad, apercibidos de la responsabilidad en que incurre todo'),'LRT',0,'C');
            $pdf->Ln();
            $pdf->Cell(0,5,utf8_decode('aquel que no se conduce con verdad.'),'LR',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Ln();        
            $pdf->Cell(70,15,utf8_decode('Instructor o tutor'),'L',0,'C');        
            $pdf->Cell(55,15,utf8_decode('Patrón o representante legal 4/'),'',0,'C');     
            $pdf->Cell(65,15,utf8_decode('Representante de los trabajadores 5/'),'R',0,'C');     
            $pdf->Ln(15);   
            $pdf->Cell(10,10,'','L',0,'C');
            $pdf->Cell(45,10,utf8_decode(mb_strtoupper(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido))),'B',0,'C');          
            $pdf->Cell(15,10,'','',0,'C');

            if($participante[0]->rep_idlegal!=null)
            {
                $part = Representante::findFirstByrep_id($participante[0]->rep_idlegal);   
                $pdf->Cell(50,10,utf8_decode(mb_strtoupper(trim($part->rep_nombre).' '.trim($part->rep_primerapellido).' '.trim($part->rep_segundoapellido))),'B',0,'C');
                $pdf->Cell(15,10,'','',0,'C');
                $historial->rep_nombrelegal=$part->rep_nombre;
                $historial->rep_primerapellidolegal=$part->rep_primerapellido;
                $historial->rep_segundoapellidolegal=$part->rep_segundoapellido;
            }
            else{

                $pdf->Cell(50,10,'','B',0,'C');
                $pdf->Cell(15,10,'','',0,'C');
            }

            if($participante[0]->rep_idtra!=null)
            {
                $part = Representante::findFirstByrep_id($participante[0]->rep_idtra);   
                $pdf->Cell(45,10,utf8_decode(mb_strtoupper(trim($part->rep_nombre).' '.trim($part->rep_primerapellido).' '.trim($part->rep_segundoapellido))),'B',0,'C');          
                $pdf->Cell(10,10,'','R',0,'C');
                $historial->rep_nombretra=$part->rep_nombre;
                $historial->rep_primerapellidotra=$part->rep_primerapellido;
                $historial->rep_segundoapellidotra=$part->rep_segundoapellido;
            }
            else
            {
                $pdf->Cell(45,10,'','B',0,'C');          
                $pdf->Cell(10,10,'','R',0,'C');
            }
            // $pdf->Cell(50,5,utf8_decode($participante[0]->emp_nombrelegal.' '.$participante[0]->emp_primerapellidolegal.' '.$participante[0]->emp_segundoapellidolegal),'B',0,'C');          
            // $pdf->Cell(15,10,'','',0,'C');
            // $pdf->Cell(45,5,utf8_decode($participante[0]->emp_nombretrabajador.' '.$participante[0]->emp_primerapellidotrabajador.' '.$participante[0]->emp_segundoapellidotrabajador),'B',0,'C');          
            // $pdf->Cell(120,5,'','B',0,'C');
            /*$pdf->Line(20,200,70,200);
            $pdf->Line(80,200,130,200);
            $pdf->Line(140,200,190,200);*/
            $pdf->Ln();
            if($participante[0]->cuo_diploma==2){
                $pdf->Image('images/firmas/'.$participante[0]->ins_firma,35,185,20,9);//(x,y,tamaño imagen)
            }
            $pdf->Cell(70,5,utf8_decode('Nombre y firma'),'LB',0,'C');        
            $pdf->Cell(55,5,utf8_decode('Nombre y firma'),'B',0,'C');     
            $pdf->Cell(65,5,utf8_decode('Nombre y firma'),'RB',0,'C');
            // $pdf->Cell(0,10,,'LRB',0,'C');
        //TERMINA CONTENID0
        //INICIA FOOTER
            $pdf->Ln(8);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(0,4,utf8_decode('INSTRUCCIONES'),'',0,'L');
            $pdf->SetFont('Arial','',7);
            $pdf->Ln();     
            $pdf->Cell(0,4,utf8_decode('- Llenar a máquina o con letra de molde.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('- Deberá entregarse al trabajador dentro de los veinte días hábiles siguientes al término del curso de capacitación aprobado.'),'',0,'L');  
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('1/ Las áreas y subáreas ocupacionales del Catálogo Nacional de Ocupaciones se encuentran disponibles en el reverso de este formato y en la página www.stps.gob.mx'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('2/ Las área temáticas de los cursos se encuentran disponibles en el reverso de este formato y en la página ww.stps.gob.mx'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('3/ Cursos impartidos por el área competente de la Secretaría del Trabajo y Prevensión Social.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('4/ Para empresas con menos de 51 trabajadores. Para empresas con más de 50 trabajadores firmaría el representante del patrón ante la Comisión mixta de capacitación,'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('   adiestramiento y productividad.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('5/ Solo para empresas con más de 50 trabajadores.'),'',0,'L');
            $pdf->Ln(3);     
            $pdf->Cell(0,4,utf8_decode('* Dato no obligatorio.'),'',0,'L');
            $pdf->Ln(10);     
            $pdf->Cell(0,4,utf8_decode('DC-3'),'',0,'R');
            $pdf->Ln();     
            $pdf->Cell(0,4,utf8_decode('ANVERSO'),'',0,'R');
            $pdf->Ln();
            $pdf->Image($dir.basename($filename),15,241,32);//(x,y,tamaño imagen)
            $pdf->SetFont('Arial','',9);
            $pdf->Text(15,276,'Folio:'.$participante[0]->par_foliodc3);
            $pdf->Text(15,280,$participante[0]->fechadc3);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetY(-15);
            $pdf->Image('images/recursos/'.$participante[0]->adm_logo,15,10,0);//(x,y,tamaño imagen)
            if($participante[0]->emp_logo!=null)
                $pdf->Image('images/empresa/'.$participante[0]->emp_logo,155,10,0);//(x,y,tamaño imagen)
            /*if($i == $var){
                $pdf->Image('images/recursos/'.$participante[0]->adm_logo,15,5,40);//(x,y,tamaño imagen)
                $pdf->Image('images/empresa/'.$participante[0]->emp_logo,155,5,40);//(x,y,tamaño imagen)
            }*/
        //TERMINA FOOTER
            unlink($dir.basename($filename));
            $hisdescarga= new Historialdescarga();
            $hisdescarga->NuevoRegistrodc3($historial,$auth['id'],1);
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Descargó documentos DC3 de manera masiva de curso cerrado";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $pdf->Output("F",'reporte/reporte.pdf');
        $this->view->pdf=$pdf;
        $this->view->disable();
        // $file='participantes.xlsx';
        // $response = new Response();
        // $path = 'reporte/'.$file;
        // $filetype = filetype($path);
        // $filesize = filesize($path);   
        // $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        // $response->setHeader("Content-Description", 'File Download');
        // $response->setHeader("Content-Type", $filetype);
        // $response->setHeader("Content-Length", $filesize);
        // $response->setFileToSend($path, str_replace(" ","-",$file), true);
        // $response->send();
        // die();

    }

    /*public function diplomamasaAction()
    {

        include('phpqrcode/qrlib.php');
        $this->view->disable();
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data = $this->request->getPost();
        $url="sipscap.com/dc3/consulta/participantedip/";
        date_default_timezone_set('america/mexico_city');

        $arreglo=json_encode($data);
        $json=json_decode($arreglo,true);
        $cont= count($json['arreglo']);
        $valor=json_encode($json['arreglo'][0]['valor']);
        $entero=json_decode($valor);
        $var = $cont;
        
        //INICIA CONFIGURACIÓN PÁGINA
            $pdf= new PDF('L','mm','A4');
            $pdf->SetMargins(20, 10 , 20);
            $pdf->SetTitle('CONSTANCIA', true);            
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->AddFont('Gothicb','','CenturyGothicBold.php');
           
        //TERMINA CONFIGURACIÓN PÁGINA
        for($i=1;$i<=$var;$i++){
            $valor=json_encode($json['arreglo'][$i-1]['valor']);
            $entero=json_decode($valor);


            $part = Participante::findFirstBypar_id($entero);
            if($part->par_foliodip==null){
                $max=Participante::maximum(array("column" => "par_foliodip"));
                $part->par_foliodip=$max+1;
                $part->par_fechadip=date('Y-m-d H:i:s');
                $part->save();
            }
            $participante=new Builder();
            $participante=$participante
            ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas',
                'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
                'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
                'par_id','adm.adm_nombredirector','adm.adm_primerapellidodirector', 'adm.adm_segundoapellidodirector','adm.adm_puestofirma','adm.adm_logo','adm.adm_nombre',
                'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido',
                'e.est_nombre','m.mun_nombre',
                'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','cuo_fechafinal'))
            ->addFrom('Participante','p')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
            ->join('Curso','c.cur_id=co.cur_id','c')
            ->join('Administrador','adm.adm_id=co.adm_id','adm')
            ->join('Instructor','i.ins_id=co.ins_id','i')
            ->join('Estado','co.est_id=e.est_id','e')
            ->join('Municipio','co.mun_cla=m.mun_cla','m')
            ->where('par_id='.$entero)
            ->getQuery()
            ->execute();

        
        // $datos=;

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';

        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);

            //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'qr'.$entero.'.png';

            //Parametros de Condiguración

        $tamaño = 5; //Tamaño de Pixel
        $level = 'L'; //Precisión Baja
        $framSize = 1; //Tamaño en blanco
        $contenido = $url.$participante[0]->par_foliodip; //Texto

            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

        
        //INICIA HEADER
            // $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            $pdf->SetFont('Times','B',16);
            $pdf->Cell(130);
            $pdf->Cell(50,-15,' ',0,0,'C');
            $pdf->Ln(5);   
        //TERMINA HEADER
        //INICIA CONTENIDO
            $pdf->SetFont('Times','',12);
            $pdf->Cell(55);
            $pdf->Cell(0,0,' ',0,0,'C');
            $pdf->Ln(20);
            $pdf->SetFont('Times','B',30);
            $pdf->Cell(55);
            $pdf->SetTextColor(255,212,51);
            $pdf->Cell(0,0,' ',0,0,'C');
            $pdf->SetTextColor(0,0,0);
            $pdf->Ln(25);
            $pdf->Cell(55);
            $pdf->SetFont('Gothicb','',27);
            $pdf->Cell(0,0,utf8_decode('A: '. $this->primermayus(trim($participante[0]->tra_nombre).' '.trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido))),0,0,'C'); 
            // $pdf->Cell(0,0,utf8_decode('A: '. ucwords(mb_strtolower(trim($participante[0]->tra_nombre).' '.trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido)))),0,0,'C');
            $pdf->Ln(18);
            $pdf->Image($dir.basename($filename),40,90,40);//(x,y,tamaño imagen)
            $pdf->SetFont('Times','',9);
            $pdf->Text(45,134,'Folio: '.$participante[0]->par_foliodip);
            $pdf->Text(45,137,$participante[0]->fechadip);
            $pdf->SetFont('Times','',18);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('Por su participación en el Taller'),0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(55);
            // $pdf->Cell(0,0,utf8_decode('"'.$participante[0]->cur_nombre).'"',0,0,'C');
            $pdf->Cell(0,0,utf8_decode('"'.$this->mb_ucwords($participante[0]->cur_nombre)).'"',0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('Que se realizó en '.$this->primermayus($participante[0]->mun_nombre.', '.$participante[0]->est_nombre).'.'),0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(55);
            $fecha= new Fecha();
            if($participante[0]->cuo_fechainicio==$participante[0]->cuo_fechafinal){
                $pdf->Cell(0,0,utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.'),0,0,'C');
            }else
            {
                $pdf->Cell(0,0,utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin."."),0,0,'C');
            }
            // $pdf->Cell(0,0,utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.'),0,0,'C');
            // $pdf->Cell(0,0,utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin).'.',0,0,'C');
            // $pdf->Cell(0,0,utf8_decode('Del '.$participante[0]->cuo_fechainicio.' al '.$participante[0]->cuo_fechafinal),0,0,'C');            
            $pdf->Ln(7);
            $pdf->Cell(55);
            $pdf->Cell(0,0,utf8_decode('Duración: '.$participante[0]->cuo_horas.' Horas.'),0,0,'C');
            $pdf->Ln(7);
        //TERMINA CONTENIDO
        //INICIA FOOTER
            $pdf->SetFont('Times','',12);
            $pdf->Line(90,155,160,155);
            $pdf->Line(190,155,260,155);
            $pdf->Ln(30);
            $pdf->Cell(70);
            $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido))),0,0,'C');
            $pdf->Cell(30);
            $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->adm_nombredirector).' '.trim($participante[0]->adm_primerapellidodirector).' '.trim($participante[0]->adm_segundoapellidodirector))),0,0,'C');
            $pdf->Ln(7);
            $pdf->Cell(70);
            $pdf->Cell(70,0,utf8_decode('Facilitador'),0,0,'C');
            $pdf->Cell(30);
            $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->adm_puestofirma))),0,0,'C');
            $pdf->SetY(-15);

            unlink($dir.basename($filename));
            // if($i == $var){
            //     $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            // }
        //TERMINA FOOTER
        }
        $pdf->Output("F",'reporte/diploma.pdf');
        $this->view->pdf=$pdf;

    }*/

    public function eliminarmasaAction()
    {
        $this->view->disable();
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data = $this->request->getPost();
        
        $arreglo=json_encode($data);
        $json=json_decode($arreglo,true);
        $cont= count($json['arreglo']);
        $valor=json_encode($json['arreglo'][0]['valor']);
        $entero=json_decode($valor);
        $var = $cont;
        
        $eliminados=0;
        for($i=1;$i<=$var;$i++){
            $valor=json_encode($json['arreglo'][$i-1]['valor']);
            $entero=json_decode($valor);

            $participante = Participante::findFirstBypar_id($entero);
            if (!$participante) {
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
                
            }
            $participante->par_estatus= -1;
            
            if($participante->save()) {
               $eliminados++;
            }
            

        }

        $answer[0]=1;
        $answer[1]=$eliminados;

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó ".$eliminados." participantes de curso cerrado";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function gethorasAction($id)
    {
        // $cur = new Curso();
        // $auth = $this->session->get('auth');
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $curso = Curso::findFirstBycur_id($id);
        if (!$curso) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        // $area->are_estatus = -1;
        
        // if ($area->save() == false) {
        //     $this->response->setJsonContent($answer);
        //     $this->response->send(); 
        //     return;
        // }
        $answer[0]=1;
        $answer[1]=$curso->cur_horas;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function diplomainstructorAction($id)
    {
        date_default_timezone_set('america/mexico_city');
        $url="sipscap.com/dc3/consulta/diplomainstructor/";
        $curso = Cursootorgado::findFirstBycuo_id($id);
        // $part = Participante::findFirstBypar_id($id);
        // $foliodip=0;
        // $fechadip='';
        if($curso->ins_id!=null){
            $existedip=Diplomainstructor::query()
                ->columns("dip_id")
                // ->join('Proyecto','p.pro_id=Ordenfactura.pro_id','p')
                ->where('cuo_id='.$id.' and ins_id='.$curso->ins_id)
                ->execute();

            if(count($existedip)!=0){
                // $foliodip=$existedip[0]->dip_foliodip;
                // $fechadip=$existedip[0]->dip_fechadip;
            }
            else
            {
                $max=Participante::maximum(array("column" => "par_foliodip"));
                $folio=$max+1;
                $part = new Participante();
                $part->cuo_id=$id;
                $part->par_foliodip=$folio;
                $part->par_fechadip=date('Y-m-d H:i:s');
                $part->par_estatus=-1;
                $part->save();
                $dip = new Diplomainstructor();
                $dip->ins_id=$curso->ins_id;
                $dip->cuo_id=$id;
                $dip->dip_foliodip=$folio;
                $dip->dip_fechadip=date('Y-m-d H:i:s');
                $dip->dip_estatus=2;
                $dip->save();
                // $foliodip=$dip->dip_foliodip;
                // $fechadip=$dip->dip_fechadip;

            }
        }

        $participante=new Builder();
        $participante=$participante
        ->columns(array('cur_nombre','cuo_horas',
            'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
            'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
            'adm.adm_nombredirector','adm.adm_primerapellidodirector', 'adm.adm_segundoapellidodirector','adm.adm_logo','adm.adm_puestofirma','adm.adm_nombre',
            'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido','i.ins_id',
            'e.est_nombre','m.mun_nombre',
            'cuo_fechainicio','cuo_fechafinal','cuo_diploma','adm_firma'))
        ->addFrom('Cursootorgado','co')
        ->join('Curso','c.cur_id=co.cur_id','c')
        ->join('Administrador','adm.adm_id=co.adm_id','adm')
        ->join('Instructor','i.ins_id=co.ins_id','i')
        ->join('Estado','co.est_id=e.est_id','e')
        ->join('Municipio','co.mun_cla=m.mun_cla','m')
        ->where('co.cuo_id='.$id)
        ->getQuery()
        ->execute();

        $dipl=new Builder();
        $dipl=$dipl
        ->columns(array(
            'dip_foliodip','DATE_FORMAT(dip_fechadip, "%d-%m-%Y") as fechadip'))
        ->addFrom('Diplomainstructor','d')
        ->where('ins_id='.$participante[0]->ins_id.' and cuo_id='.$id)
        ->getQuery()
        ->execute();

        // $participante=new Builder();
        // $participante=$participante
        // ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas',
        //     'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
        //     'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
        //     'par_id','adm.adm_nombredirector','adm.adm_primerapellidodirector', 'adm.adm_segundoapellidodirector','adm.adm_logo','adm.adm_nombre',
        //     'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido',
        //     'e.est_nombre','m.mun_nombre',
        //     'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','cuo_fechafinal'))
        // ->addFrom('Participante','p')
        // ->join('Trabajador','p.tra_id=t.tra_id','t')
        // ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
        // ->join('Curso','c.cur_id=co.cur_id','c')
        // ->join('Administrador','adm.adm_id=co.adm_id','adm')
        // ->join('Instructor','i.ins_id=co.ins_id','i')
        // ->join('Estado','co.est_id=e.est_id','e')
        // ->join('Municipio','co.mun_cla=m.mun_cla','m')
        // ->where('par_id='.$id)
        // ->getQuery()
        // ->execute();

        include('phpqrcode/qrlib.php');
        // $datos=;

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';

        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);

            //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'qr.png';

            //Parametros de Condiguración

        $tamaño = 5; //Tamaño de Pixel
        $level = 'L'; //Precisión Baja
        $framSize = 1; //Tamaño en blanco
        $contenido = $url.$dipl[0]->dip_foliodip; //Texto

            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

        $this->view->disable();
        $var = 1;
        

        $reporte= new PdfReporte();
        $firmainstructor='';
        $firmaadmin='';
        $padding=1;

        if($participante[0]->cuo_diploma==1)
        {
            $mpdf = new mPDF();
            // $mpdf->defaultheaderline = 0;
            $mpdf->AddPage('L','','','','',1,15,5,10,10,0);
            $footer=$reporte->diplomainstructorfooter;
            $diplomahtml=$reporte->diplomainstructorhtml;
        }

        if($participante[0]->cuo_diploma==2)
        {
            $mpdf = new mPDF('L',[280,215]);
            $mpdf->defaultfooterline = 0;
            
            $mpdf->SetImportUse();

            $pagecount = $mpdf->SetSourceFile('reporte/diplomabase.pdf');

            // Import the last page of the source PDF file
            $tplId = $mpdf->ImportPage($pagecount);
            $mpdf->UseTemplate($tplId);
            $footer=$reporte->diplomadigitalinstructorfooter;
            $diplomahtml=$reporte->diplomadigitalinstructorhtml;
        }

        $mpdf->defaultfooterline = 0;
        //INICIA CONFIGURACIÓN PÁGINA
            // $pdf= new PDF('L','mm','A4');
            // $pdf->SetMargins(20, 10 , 20);
            // $pdf->SetTitle('CONSTANCIA', true);            
            // $pdf->AliasNbPages();
            // $pdf->AddPage();
        //TERMINA CONFIGURACIÓN PÁGINA
        for($i=1;$i<=$var;$i++){
        //INICIA HEADER
            // $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            // $pdf->SetFont('Times','B',16);
            // $pdf->Cell(130);
            // $pdf->Cell(50,-15,' ',0,0,'C');
            // $pdf->Ln(5);   
        //TERMINA HEADER
        //INICIA CONTENIDO
            // $pdf->SetFont('Times','',12);
            // $pdf->Cell(55);
            // $pdf->Cell(0,0,' ',0,0,'C');
            // $pdf->Ln(20);
            // $pdf->AddFont('Gothicb','','CenturyGothicBold.php');
            // $pdf->SetFont('Gothicb','',27);
            // $pdf->Cell(55);
            // $pdf->SetTextColor(255,212,51);
            // $pdf->Cell(0,0,' ',0,0,'C');
            // $pdf->SetTextColor(0,0,0);
            // $pdf->Ln(25);
            // $pdf->Cell(55);
            $usuario=$this->primermayus(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido));
            // $pdf->Cell(0,0,utf8_decode('A: '. $this->mayusinstructor(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido))),0,0,'C');
            // $pdf->Cell(0,0,utf8_decode('A: '. ucwords(mb_strtolower(trim($participante[0]->tra_nombre))).' '.ucwords(mb_strtolower(trim($participante[0]->tra_primerapellido))).' '.ucwords(mb_strtolower(trim($participante[0]->tra_segundoapellido)))),0,0,'C');
            // $pdf->Ln(18);
            // $pdf->Image($dir.basename($filename),40,90,40);//(x,y,tamaño imagen)
            // $pdf->SetFont('Times','',9);
            $folio=$dipl[0]->dip_foliodip;
            // $pdf->Text(45,134,'Folio: '.$dipl[0]->dip_foliodip);
            $expedicion=$dipl[0]->fechadip;
            // $pdf->Text(45,137,$dipl[0]->fechadip);
            // $pdf->SetFont('Times','',18);
            // $pdf->Cell(55);
            // $pdf->Cell(0,0,utf8_decode('Por Haber Impartido Satisfactoriamente El Taller'),0,0,'C');
            // $pdf->Ln(7);
            // $pdf->Cell(55);
            $curso=$this->mb_ucwords($participante[0]->cur_nombre);
            // $pdf->Cell(0,0,utf8_decode('"'.$this->mb_ucwords($participante[0]->cur_nombre)).'"',0,0,'C');
            // $pdf->Ln(7);
            // $pdf->Cell(55);
            $municipio=$this->primermayus(trim($participante[0]->mun_nombre));
                $estado=$this->primermayus(trim($participante[0]->est_nombre));
            // $pdf->Cell(0,0,utf8_decode('Que se realizó en '.$this->primermayus($participante[0]->mun_nombre).', '.$this->primermayus($participante[0]->est_nombre)."."),0,0,'C');
            // $pdf->Ln(7);
            // $pdf->Cell(55);
            $fecha= new Fecha();
            $periodo='';
            if($participante[0]->cuo_fechainicio==$participante[0]->cuo_fechafinal){
                $periodo=utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.');
                // $pdf->Cell(0,0,utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.'),0,0,'C');
            }else
            {
                $periodo=utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin.".");
                // $pdf->Cell(0,0,utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin."."),0,0,'C');
            }
            // $pdf->Ln(7);
            // $pdf->Cell(55);
            $horas=$participante[0]->cuo_horas;
            $nombrefirma=$this->primermayus(trim($participante[0]->adm_nombredirector).' '.trim($participante[0]->adm_primerapellidodirector).' '.trim($participante[0]->adm_segundoapellidodirector));
            $puestofirma=$this->primermayus(trim($participante[0]->adm_puestofirma));

            $diplomahtml=str_replace("#usuario#",$usuario,$diplomahtml);
            $diplomahtml=str_replace("#qr#",basename($filename),$diplomahtml);
            $diplomahtml=str_replace("#folio#",$folio,$diplomahtml);
            $diplomahtml=str_replace("#expedicion#",$expedicion,$diplomahtml);
            $diplomahtml=str_replace("#curso#",$curso,$diplomahtml);
            $diplomahtml=str_replace("#municipio#",$municipio,$diplomahtml);
            $diplomahtml=str_replace("#estado#",$estado,$diplomahtml);
            $diplomahtml=str_replace("#periodo#",$periodo,$diplomahtml);
            $diplomahtml=str_replace("#horas#",$horas,$diplomahtml);
            // $footer=str_replace("#instructor#",$instructor,$footer);
            // $footer=str_replace("#firmainstructor#",basename($participante[0]->ins_firma),$footer);
            $footer=str_replace("#nombrefirma#",$nombrefirma,$footer);
            $footer=str_replace("#firmaadmin#",basename($participante[0]->adm_firma),$footer);
            $footer=str_replace("#puestofirma#",$puestofirma,$footer);
            $diplomahtml=str_replace("#paddingfirma#",$padding,$diplomahtml);

            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML($diplomahtml);
            unlink($dir.basename($filename));
            // $pdf->Cell(0,0,utf8_decode('Duración: '.$participante[0]->cuo_horas.' Horas.'),0,0,'C');
            // $pdf->Ln(7);
        //TERMINA CONTENIDO
        //INICIA FOOTER
            // $pdf->SetFont('Times','',12);
            // $pdf->Line(140,155,210,155);
            // $pdf->Line(190,155,260,155);
            // $pdf->Ln(30);
            // $pdf->Cell(120);
            // $pdf->Cell(70,0,utf8_decode($participante[0]->ins_nombre.' '.$participante[0]->ins_primerapellido.' '.$participante[0]->ins_segundoapellido),0,0,'C');
            // $pdf->Cell(30);
            // $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->adm_nombredirector).' '.trim($participante[0]->adm_primerapellidodirector).' '.trim($participante[0]->adm_segundoapellidodirector))),0,0,'C');
            // $pdf->Ln(7);
            // $pdf->Cell(70);
            // $pdf->Cell(70,0,utf8_decode('Facilitador'),0,0,'C');
            // $pdf->Cell(120);
            // $pdf->Cell(70,0,utf8_decode($this->primermayus(trim($participante[0]->adm_puestofirma))),0,0,'C');
            // $pdf->SetY(-15);
            // if($i == $var){
            //     $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            // }
        //TERMINA FOOTER
            unlink($dir.basename($filename));
        }
        $mpdf->Output("Diploma.pdf","D");
        // $pdf->Output('D');
        // $pdf->Output();
        $this->view->pdf=$pdf;

    }

    // public function imprimirAction()
    // {
    //     include('phpqrcode/qrlib.php');
    //     // $datos=;

    //     //Declaramos una carpeta temporal para guardar la imagenes generadas
    //     $dir = 'temp/';

    //     //Si no existe la carpeta la creamos
    //     if (!file_exists($dir))
    //         mkdir($dir);

    //         //Declaramos la ruta y nombre del archivo a generar
    //     $filename = $dir.'qr.png';

    //         //Parametros de Condiguración

    //     $tamaño = 7; //Tamaño de Pixel
    //     $level = 'L'; //Precisión Baja
    //     $framSize = 1; //Tamaño en blanco
    //     $contenido = 'Hola mundo'; //Texto

    //         //Enviamos los parametros a la Función para generar código QR 
    //     QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

    //     $reporte= new PdfReporte();

    //     $diplomahtml=$reporte->diplomahtml;
    //     // $diplomahtml=str_replace("#usuario#",'Pilar Angélica',$diplomahtml);

    //     $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    //     $mpdf = new mPDF();
    //     $mpdf->AddPage('L','','','','',1,15,5,10,10,0); //margin-left, $margin-right, $margin-top, $margin-bottom, $margin-header, $margin-footer,
    //     // $mpdf->AddPage('');
    //     $mpdf->WriteHTML($diplomahtml);
    //     // $mpdf->WriteHTML($diplomahtml);
    //     // $mpdf->WriteHTML($diplomahtml);

    //     $mpdf->Output();
    //     unlink($dir.basename($filename));

    // }

    public function reportediplomaAction($id)
    {
        date_default_timezone_set('america/mexico_city');
        $url="sipscap.com/dc3/consulta/participantedip/";
        $part = Participante::findFirstBypar_id($id);
        if($part->par_foliodip==null){
            $max=Participante::maximum(array("column" => "par_foliodip"));
            $part->par_foliodip=$max+1;
            $part->par_fechadip=date('Y-m-d H:i:s');
            $part->save();
        }

        $participante=new Builder();
        $participante=$participante
        ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas','cuo_diploma',
            'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
            'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
            'par_id','adr.adm_nombredirector','adr.adm_primerapellidodirector', 'adr.adm_segundoapellidodirector','adr.adm_puestofirma','adm.adm_logo','adm.adm_nombre','adr.adm_firma',
            'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido', 'i.ins_firma',
            'e.est_nombre','m.mun_nombre',
            'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','cuo_fechafinal','par_fechadip as fechadiploma'))
        ->addFrom('Participante','p')
        ->join('Trabajador','p.tra_id=t.tra_id','t')
        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
        ->join('Curso','c.cur_id=co.cur_id','c')
        ->join('Administrador','adm.adm_id=co.adm_id','adm')
        ->join('Admindirector','adr.adr_id=adm.adr_id','adr')
        ->join('Instructor','i.ins_id=co.ins_id','i')
        ->join('Estado','co.est_id=e.est_id','e')
        ->join('Municipio','co.mun_cla=m.mun_cla','m')
        ->where('par_id='.$id)
        ->getQuery()
        ->execute();

        include('phpqrcode/qrlib.php');
        // $datos=;

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
        $contenido = $url.$participante[0]->par_foliodip; //Texto

        //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

        $this->view->disable();
        $var = 1;

        $reporte= new PdfReporte();

        $firmainstructor='';
        $firmaadmin='';
        $padding=1;

        if($participante[0]->cuo_diploma==1)
        {
            $mpdf = new mPDF();
            // $mpdf->defaultheaderline = 0;
            $mpdf->AddPage('L','','','','',1,15,5,10,10,0);
            $footer=$reporte->diplomafooter;
            $diplomahtml=$reporte->diplomahtml;
        }

        if($participante[0]->cuo_diploma==2)
        {
            $mpdf = new mPDF('L',[280,215]);
            $mpdf->defaultfooterline = 0;
            
            $mpdf->SetImportUse();

            $pagecount = $mpdf->SetSourceFile('reporte/diplomabase.pdf');

            // Import the last page of the source PDF file
            $tplId = $mpdf->ImportPage($pagecount);
            $mpdf->UseTemplate($tplId);
            $footer=$reporte->diplomadigitalfooter;
            $diplomahtml=$reporte->diplomadigitalhtml;
        }
        $mpdf->defaultfooterline = 0;
        // $footer=$reporte->diplomafooter;
        // $diplomahtml=$reporte->diplomahtml;
        // $mpdf = new mPDF();
        // $mpdf->defaultfooterline = 0;
        // $mpdf->AddPage('L','','','','',1,15,5,10,10,0);
        
        for($i=1;$i<=$var;$i++){
            //30 caracteres por linea
            $usuario=$this->primermayus(trim($participante[0]->tra_nombre).' '.trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido));
            // $long=strlen($usuario);
            $padding=10;
            // if($long > 34){
            //     $padding=5;
            // } 
            $folio=$participante[0]->par_foliodip;
            $expedicion=$participante[0]->fechadip;
            $curso=$this->mb_ucwords($participante[0]->cur_nombre);
            // $longcur=strlen($curso);
            // if($longcur > 53){
            //     $padding-=5;
            // }
            $municipio=$this->primermayus(trim($participante[0]->mun_nombre));
            $estado=$this->primermayus(trim($participante[0]->est_nombre));

            $fecha= new Fecha();
            $periodo='';
            if($participante[0]->cuo_fechainicio==$participante[0]->cuo_fechafinal){

               $periodo=utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.');
            }else
            {
                $periodo=utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin.".");
            }

            $horas=$participante[0]->cuo_horas;
            $instructor=$this->primermayus(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido));
            $nombrefirma=$this->primermayus(trim($participante[0]->adm_nombredirector).' '.trim($participante[0]->adm_primerapellidodirector).' '.trim($participante[0]->adm_segundoapellidodirector));
            $puestofirma=$this->primermayus(trim($participante[0]->adm_puestofirma));

            $diplomahtml=str_replace("#usuario#",$usuario,$diplomahtml);
            $diplomahtml=str_replace("#qr#",basename($filename),$diplomahtml);
            $diplomahtml=str_replace("#folio#",$folio,$diplomahtml);
            $diplomahtml=str_replace("#expedicion#",$expedicion,$diplomahtml);
            $diplomahtml=str_replace("#curso#",$curso,$diplomahtml);
            $diplomahtml=str_replace("#municipio#",$municipio,$diplomahtml);
            $diplomahtml=str_replace("#estado#",$estado,$diplomahtml);
            $diplomahtml=str_replace("#periodo#",$periodo,$diplomahtml);
            $diplomahtml=str_replace("#horas#",$horas,$diplomahtml);
            $footer=str_replace("#instructor#",$instructor,$footer);
            $footer=str_replace("#firmainstructor#",basename($participante[0]->ins_firma),$footer);
            $footer=str_replace("#nombrefirma#",$nombrefirma,$footer);
            $footer=str_replace("#firmaadmin#",basename($participante[0]->adm_firma),$footer);
            $footer=str_replace("#puestofirma#",$puestofirma,$footer);
            $diplomahtml=str_replace("#paddingfirma#",$padding,$diplomahtml);

            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML($diplomahtml);
        
            unlink($dir.basename($filename));

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Descargó un documento Diploma de manera individual de curso cerrado";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$id;
            $bitacora->NuevoRegistro($databit);
        }
        $historial='';
        $auth = $this->session->get('auth');
        $historial=$participante[0];
        $hisdescarga= new Historialdescarga();
        $hisdescarga->NuevoRegistrodiploma($historial,$auth['id'],1);
        // $mpdf->Output();
        $mpdf->Output("Diploma.pdf","D");
        
        // $this->view->pdf=$mpdf;

    }

    public function diplomamasaAction()
    {

        include('phpqrcode/qrlib.php');
        $this->view->disable();
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data = $this->request->getPost();
        $url="sipscap.com/dc3/consulta/participantedip/";
        date_default_timezone_set('america/mexico_city');

        $arreglo=json_encode($data);
        $json=json_decode($arreglo,true);
        $cont= count($json['arreglo']);
        $valor=json_encode($json['arreglo'][0]['valor']);
        $entero=json_decode($valor);
        $var = $cont;
        
        //INICIA CONFIGURACIÓN PÁGINA
        $reporte= new PdfReporte();

        $curso=new Builder();
        $curso=$curso
        ->columns(array('cuo_diploma'))
        ->addFrom('Participante','p')
        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
        ->where('par_id='.$entero)
        ->getQuery()
        ->execute();

        if($curso[0]->cuo_diploma==1)
        {
            $footer=$reporte->diplomafooter;
            $mpdf = new mPDF();
            // $mpdf->defaultheaderline = 0;
            $mpdf->defaultfooterline = 0;
            $mpdf->AddPage('L','','','','',1,15,5,10,10,0);
            
            // $diplomahtml=$reporte->diplomahtml;
        }

        if($curso[0]->cuo_diploma==2)
        {
            $footer=$reporte->diplomadigitalfooter;
            $mpdf = new mPDF('L',[280,215]);
            $mpdf->defaultfooterline = 0;
            // $mpdf->defaultheaderline = 0;
            // $mpdf->AddPage('L','','','','',1,15,5,10,10,0);

            // $mpdf->AddPage('L');
            $mpdf->SetImportUse();

            // $pagecount = $mpdf->SetSourceFile('reporte/diplomabase.pdf');
            $mpdf->SetDocTemplate('reporte/diplomabase.pdf',true);
            // Import the last page of the source PDF file
            // $tplId = $mpdf->ImportPage($pagecount);
            // $mpdf->UseTemplate($tplId);
            
            // $diplomahtml=$reporte->diplomadigitalhtml;
        }
        // $footer=$reporte->diplomafooter;
        // $mpdf = new mPDF();
        // $mpdf->defaultfooterline = 0;
        // $mpdf->defaultheaderline = 0;
        // $mpdf->AddPage('L','','','','',1,15,5,10,10,0);
           
        //TERMINA CONFIGURACIÓN PÁGINA
        for($i=1;$i<=$var;$i++){
            $diplomahtml='';
            if($curso[0]->cuo_diploma==1)
            {          
                $html=$reporte->diplomahtml;
            }

            if($curso[0]->cuo_diploma==2)
            {            
                $html=$reporte->diplomadigitalhtml;
            }
            $diplomahtml=$html;
            // $diplomahtml=$reporte->diplomahtml;
            $valor=json_encode($json['arreglo'][$i-1]['valor']);
            $entero=json_decode($valor);


            $part = Participante::findFirstBypar_id($entero);
            if($part->par_foliodip==null){
                $max=Participante::maximum(array("column" => "par_foliodip"));
                $part->par_foliodip=$max+1;
                $part->par_fechadip=date('Y-m-d H:i:s');
                $part->save();
            }
            $participante=new Builder();
            $participante=$participante
            ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas',
                'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
                'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
                'par_id','adr.adm_nombredirector','adr.adm_primerapellidodirector', 'adr.adm_segundoapellidodirector','adr.adm_puestofirma','adm.adm_logo','adm.adm_nombre', 'adr.adm_firma',
                'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido', 'ins_firma',
                'e.est_nombre','m.mun_nombre',
                'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','cuo_fechafinal','cuo_diploma', 'par_fechadip as fechadiploma'))
            ->addFrom('Participante','p')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
            ->join('Curso','c.cur_id=co.cur_id','c')
            ->join('Administrador','adm.adm_id=co.adm_id','adm')
            ->join('Admindirector','adr.adr_id=adm.adr_id','adr')
            ->join('Instructor','i.ins_id=co.ins_id','i')
            ->join('Estado','co.est_id=e.est_id','e')
            ->join('Municipio','co.mun_cla=m.mun_cla','m')
            ->where('par_id='.$entero)
            ->getQuery()
            ->execute();

        
        // $datos=;

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';

        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);

            //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'qr'.$entero.'.png';

            //Parametros de Condiguración

        $tamaño = 6; //Tamaño de Pixel
        $level = 'L'; //Precisión Baja
        $framSize = 1; //Tamaño en blanco
        $contenido = $url.$participante[0]->par_foliodip; //Texto

            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

            

            $usuario=$this->primermayus(trim($participante[0]->tra_nombre).' '.trim($participante[0]->tra_primerapellido).' '.trim($participante[0]->tra_segundoapellido));
            $long=strlen($usuario);
            $padding=10;
            
            $folio=$participante[0]->par_foliodip;
            $expedicion=$participante[0]->fechadip;
            $curso=$this->mb_ucwords($participante[0]->cur_nombre);
            $longcur=strlen($curso);
            
            $municipio=$this->primermayus(trim($participante[0]->mun_nombre));
            $estado=$this->primermayus(trim($participante[0]->est_nombre));

            $fecha= new Fecha();
            $periodo='';
            if($participante[0]->cuo_fechainicio==$participante[0]->cuo_fechafinal){

               $periodo=utf8_decode('El '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.'.');
            }else
            {
                $periodo=utf8_decode('Del '.$participante[0]->dia_in.' de '.$fecha->getMes($participante[0]->mes_in).' del '.$participante[0]->anio_in.' al '.$participante[0]->dia_fin.' de '.$fecha->getMes($participante[0]->mes_fin).' del '.$participante[0]->anio_fin.".");
            }

            $horas=$participante[0]->cuo_horas;
            $instructor=$this->primermayus(trim($participante[0]->ins_nombre).' '.trim($participante[0]->ins_primerapellido).' '.trim($participante[0]->ins_segundoapellido));
            $nombrefirma=$this->primermayus(trim($participante[0]->adm_nombredirector).' '.trim($participante[0]->adm_primerapellidodirector).' '.trim($participante[0]->adm_segundoapellidodirector));
            $puestofirma=$this->primermayus(trim($participante[0]->adm_puestofirma));

            $diplomahtml=str_replace("#usuario#",$usuario,$diplomahtml);
            $diplomahtml=str_replace("#folio#",$folio,$diplomahtml);
            $diplomahtml=str_replace("#expedicion#",$expedicion,$diplomahtml);
            $diplomahtml=str_replace("#curso#",$curso,$diplomahtml);
            $diplomahtml=str_replace("#municipio#",$municipio,$diplomahtml);
            $diplomahtml=str_replace("#estado#",$estado,$diplomahtml);
            $diplomahtml=str_replace("#periodo#",$periodo,$diplomahtml);
            $diplomahtml=str_replace("#horas#",$horas,$diplomahtml);
            $footer=str_replace("#firmainstructor#",basename($participante[0]->ins_firma),$footer);
            $footer=str_replace("#instructor#",$instructor,$footer);
            $footer=str_replace("#nombrefirma#",$nombrefirma,$footer);
            $footer=str_replace("#firmaadmin#",basename($participante[0]->adm_firma),$footer);
            $footer=str_replace("#puestofirma#",$puestofirma,$footer);
            $diplomahtml=str_replace("#qr#",basename($filename),$diplomahtml);
            $diplomahtml=str_replace("#paddingfirma#",$padding,$diplomahtml);

            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML($diplomahtml);
        
            unlink($dir.basename($filename));

            $historial='';
            $auth = $this->session->get('auth');
            $historial=$participante[0];
            $hisdescarga= new Historialdescarga();
            $hisdescarga->NuevoRegistrodiploma($historial,$auth['id'],1);

            // unlink($dir.basename($filename));
            // if($i == $var){
            //     $pdf->Image('images/recursos/'.$participante[0]->adm_logo,20,20,40);//(x,y,tamaño imagen)
            // }
        //TERMINA FOOTER
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Descargó documentos Diploma de manera masiva de curso cerrado";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $mpdf->Output('reporte/diploma.pdf','F');
        // $this->view->pdf=$pdf;

    }

    public function actualizarAction($id)
    {
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $curso = Cursootorgado::findFirstBycuo_id($id);
        if (!$curso) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $centrotrabajo= Centrotrabajo::findFirstBycen_id($curso->cen_id);
        $curso->rep_idlegal = $centrotrabajo->rep_idlegal;
        $curso->rep_idtra = $centrotrabajo->rep_idtra;
        
        if ($curso->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }
}