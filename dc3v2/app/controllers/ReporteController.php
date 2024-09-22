<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class ReporteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Consulta');
        parent::initialize();
        $this->view->gmenu=1;
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(9,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    public function indexAction(){
        $indexemp=-1;
        $indexare=-1;
        $indexcur=-1;
        $indexadm=-1;
        $indexins=-1;
        $indextipo=-1;
        $indexparti=-1;
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $empresa=Empresa::find("emp_estatus=2");
        $area=Areatematica::find("are_estatus=2");
        $curso=Curso::find("cur_estatus=2");
        $admin=Administrador::find("adm_estatus=2");
        $instructor=Instructor::find("ins_estatus=2");

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Cursootorgado.cuo_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexemp=$data["emp_id"];
            $indexare=$data["are_id"];
            $indexcur=$data["cur_id"];
            $indexadm=$data["adm_id"];
            $indexins=$data["ins_id"];
            $indextipo=$data["cuo_tipo"];
            $indexparti=$data["participantes"];

            if($data["emp_id"]!=-1)
                $condicion.=" and e.emp_id=".$data["emp_id"];
            if($data["are_id"]!=-1)
                $condicion.=" and a.are_id=".$data["are_id"];
            if($data["cur_id"]!=-1)
                $condicion.=" and c.cur_id=".$data["cur_id"];
            if($data["adm_id"]!=-1)
                $condicion.=" and ad.adm_id=".$data["adm_id"];
            if($data["ins_id"]!=-1)
                $condicion.=" and i.ins_id=".$data["ins_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and cuo_fechainicio>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and cuo_fechafinal<='".$data["fecha_fin"]."'";
            
            $datos=[];
            if($data["participantes"]==-1){
                if($data["cuo_tipo"]!=-1)
                    $condicion.=" and Cursootorgado.cuo_tipo=".$data["cuo_tipo"];
                
                $datos=Cursootorgado::query()
                ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                ->leftjoin('Empresa','e.emp_id=Cursootorgado.emp_id','e')
                ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                ->join('Areatematica','a.are_id=c.are_id','a')
                ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                ->where($condicion)
                ->execute();
            }
            if($data["participantes"]==1){
                if($data["cuo_tipo"]==-1)
                {
                    $condicion2=$condicion;
                    $condicion2.=" and Cursootorgado.cuo_tipo=1 and par_estatus=2";
                    $datos1=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->leftjoin('Empresa','e.emp_id=Cursootorgado.emp_id','e')
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->where($condicion2)
                    ->execute();

                    $condicion3=$condicion;
                    $condicion3.=" and Cursootorgado.cuo_tipo=2 and par_estatus=2";
                    $datos2=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion3)
                    ->execute();

                    $condicion4=$condicion;
                    $condicion4.=" and Cursootorgado.cuo_tipo=3 and par_estatus=2";
                    $datos3=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion4)
                    ->execute();

                    for($x=0;$x<count($datos1);$x++){
                        array_push($datos,$datos1[$x]);
                    }
                    for($x=0;$x<count($datos2);$x++){
                        array_push($datos,$datos2[$x]);
                    }
                    for($x=0;$x<count($datos3);$x++){
                        array_push($datos,$datos3[$x]);
                    }
                    // array_merge($datos,$datos1,$datos2);
                }
                if($data["cuo_tipo"]==1)
                {
                    $condicion2=$condicion;
                    $condicion2.=" and Cursootorgado.cuo_tipo=1 and par_estatus=2";
                    $datos=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->leftjoin('Empresa','e.emp_id=Cursootorgado.emp_id','e')
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->where($condicion2)
                    ->execute();
                }
                if($data["cuo_tipo"]==2)
                {
                    $condicion3=$condicion;
                    $condicion3.=" and Cursootorgado.cuo_tipo=2 and par_estatus=2";
                    $datos=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion3)
                    ->execute();
                }
                 if($data["cuo_tipo"]==3)
                {
                    $condicion4=$condicion;
                    $condicion4.=" and Cursootorgado.cuo_tipo=3 and par_estatus=2";
                    $datos=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion4)
                    ->execute();
                }
                
            }

        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó el módulo de reporte";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->view->indexemp=$indexemp;
        $this->view->indexare=$indexare;
        $this->view->indexcur=$indexcur;
        $this->view->indexadm=$indexadm;
        $this->view->indexins=$indexins;
        $this->view->indextipo=$indextipo;
        $this->view->indexparti=$indexparti;
        $this->view->empresa=$empresa;
        $this->view->area=$area;
        $this->view->curso=$curso;
        $this->view->admin=$admin;
        $this->view->instructor=$instructor;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;

    }

    public function participantescursoAction(){
        $indexemp=-1;
        // $indexare=-1;
        $indexcur=-1;
        // $indexadm=-1;
        // $indexins=-1;
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $empresa=Empresa::find("emp_estatus=2");
        // $area=Areatematica::find("are_estatus=2");
        $curso=Curso::find("cur_estatus=2");
        // $admin=Administrador::find("adm_estatus=2");
        // $instructor=Instructor::find("ins_estatus=2");

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Cursootorgado.cuo_estatus=2 and Cursootorgado.cuo_tipo=1 and p.par_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexemp=$data["emp_id"];
            // $indexare=$data["are_id"];
            $indexcur=$data["cur_id"];
            // $indexadm=$data["adm_id"];
            // $indexins=$data["ins_id"];

            if($data["emp_id"]!=-1)
                $condicion.=" and e.emp_id=".$data["emp_id"];
            // if($data["are_id"]!=-1)
            //     $condicion.=" and a.are_id=".$data["are_id"];
            if($data["cur_id"]!=-1)
                $condicion.=" and c.cur_id=".$data["cur_id"];
            // if($data["adm_id"]!=-1)
            //     $condicion.=" and ad.adm_id=".$data["adm_id"];
            // if($data["ins_id"]!=-1)
            //     $condicion.=" and i.ins_id=".$data["ins_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and cuo_fechainicio>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and cuo_fechafinal<='".$data["fecha_fin"]."'";

            $datos=Cursootorgado::query()
            ->columns("cuo_clave,c.cur_id,c.cur_nombre,e.emp_razonsocial,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,tra_nombre,tra_primerapellido,tra_segundoapellido")
            ->join('Empresa','e.emp_id=Cursootorgado.emp_id','e')
            ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
            ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            // ->join('Areatematica','a.are_id=c.are_id','a')
            // ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
            // ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
            ->where($condicion)
            ->execute();
        }

        $this->view->indexemp=$indexemp;
        // $this->view->indexare=$indexare;
        $this->view->indexcur=$indexcur;
        // $this->view->indexadm=$indexadm;
        // $this->view->indexins=$indexins;
        $this->view->empresa=$empresa;
        // $this->view->area=$area;
        $this->view->curso=$curso;
        // $this->view->admin=$admin;
        // $this->view->instructor=$instructor;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;

    }

    public function participantescursoexcelAction(){
        $indexemp=-1;
        // $indexare=-1;
        $indexcur=-1;
        // $indexadm=-1;
        // $indexins=-1;
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $empresa=Empresa::find("emp_estatus=2");
        // $area=Areatematica::find("are_estatus=2");
        $curso=Curso::find("cur_estatus=2");
        // $admin=Administrador::find("adm_estatus=2");
        // $instructor=Instructor::find("ins_estatus=2");

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Cursootorgado.cuo_estatus=2 and Cursootorgado.cuo_tipo=1 and p.par_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexemp=$data["emp_id"];
            // $indexare=$data["are_id"];
            $indexcur=$data["cur_id"];
            // $indexadm=$data["adm_id"];
            // $indexins=$data["ins_id"];

            if($data["emp_id"]!=-1)
                $condicion.=" and e.emp_id=".$data["emp_id"];
            // if($data["are_id"]!=-1)
            //     $condicion.=" and a.are_id=".$data["are_id"];
            if($data["cur_id"]!=-1)
                $condicion.=" and c.cur_id=".$data["cur_id"];
            // if($data["adm_id"]!=-1)
            //     $condicion.=" and ad.adm_id=".$data["adm_id"];
            // if($data["ins_id"]!=-1)
            //     $condicion.=" and i.ins_id=".$data["ins_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and cuo_fechainicio>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and cuo_fechafinal<='".$data["fecha_fin"]."'";

            $datos=Cursootorgado::query()
            ->columns("cuo_clave,c.cur_id,c.cur_nombre,e.emp_razonsocial,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,tra_nombre,tra_primerapellido,tra_segundoapellido")
            ->join('Empresa','e.emp_id=Cursootorgado.emp_id','e')
            ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
            ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            // ->join('Areatematica','a.are_id=c.are_id','a')
            // ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
            // ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
            ->where($condicion)
            ->execute();
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Cursos por empresa")
        ->setSubject("Cursos por empresa")
        ->setDescription("Cursos por empresa")
        ->setKeywords("Reporte")
        ->setCategory("Cursos por empresa");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Trabajador');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Clave del curso');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Curso');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Empresa');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Fecha inicial');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Fecha final');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
        array(
            'font' => array(
                'bold' => true,
                'size' => 9
                )
            )
        );
        for ($i=0; $i < count($datos); $i++) 
        { 
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $datos[$i]->tra_nombre.' '.$datos[$i]->tra_primerapellido.' '.$datos[$i]->tra_segundoapellido);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $datos[$i]->cuo_clave);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $datos[$i]->cur_nombre);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $datos[$i]->emp_razonsocial);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $datos[$i]->cuo_fechainicio);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $datos[$i]->cuo_fechafinal);
            
        }
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/participantes.xlsx');
        $this->view->disable();

        $file='participantes.xlsx';
        $response = new Response();
        $path = 'reporte/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);   
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ","-",$file), true);
        $response->send();
        die();


        $this->view->indexemp=$indexemp;
        $this->view->indexcur=$indexcur;
        $this->view->empresa=$empresa;
        $this->view->curso=$curso;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;

    }

    public function cursoempresaAction($id='')
    {
        $auth = $this->session->get('auth');
        if(!$this->request->isPost()){
            $form = new ReporteForm;
            $form->TodosCampos();
            $this->view->form = $form;
            return;
        }
        $data = $this->request->getPost();
        $info=Cursootorgado::query()
        ->columns("cuo_id,e.emp_id,emp_razonsocial,cur_nombre,cuo_fechainicio,cuo_fechafinal")
        ->join("Empresa","Cursootorgado.emp_id=e.emp_id","e")
        ->join("Curso","Cursootorgado.cur_id=c.cur_id","c")
        // ->join("Usuario","Proyecto.usu_id=u.usu_id","u")
        ->where('e.emp_id='.$data['emp_id'])
        ->orderBy("e.emp_id")
        ->execute();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Cursos por empresa")
        ->setSubject("Cursos por empresa")
        ->setDescription("Cursos por empresa")
        ->setKeywords("Reporte")
        ->setCategory("Cursos por empresa");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Cursos');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Fecha de inicio');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Fecha final');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Cliente');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Responsable');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Actividad vulnerable');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Estatus');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
        array(
            'font' => array(
                'bold' => true,
                'size' => 9
                )
            )
        );
        for ($i=0; $i < count($info); $i++) 
        { 
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+4), $info[$i]->cur_nombre);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+4), $info[$i]->cuo_fechainicio);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+4), $info[$i]->cuo_fechafinal);
            // $objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $info[$i]->emp_nombre);
            // $objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $info[$i]->usu_nombre.' '.$info[$i]->usu_apellidop.' '.$info[$i]->usu_apellidom);
            // if ($info[$i]->pro_vulnerable==1) 
            // {
            //     $objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2),'SI');    
            // }
            // else
            //     $objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), 'NO');
            // switch ($info[$i]->pro_estatus) 
            // {
            //     case 0:
            //         $objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), 'Cancelado');
            //         break;
            //     case 1:
            //         $objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), 'Pausa');
            //         break;    
            //     case 2:
            //         $objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), 'Activo');
            //         break;
            //     case 3:
            //         $objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), 'Terminado');
            //         break;
                
            //     default:
            //         # code...
            //         break;
            // }
        }
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/'.$auth['id'].'_proyecto.xlsx');
        $this->view->disable();

        $file=$auth['id'].'_proyecto.xlsx';
        $response = new Response();
        $path = 'reporte/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);   
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ","-",$file), true);
        $response->send();
        die();
        // $answer[0]=1;
        // $answer[1]=$auth['id'].'_proyecto.xlsx';
        // $this->response->setJsonContent($answer);
        // $this->response->send();
    }

    public function descargarAction(){
        $indexemp=-1;
        $indexare=-1;
        $indexcur=-1;
        $indexadm=-1;
        $indexins=-1;
        $indextipo=-1;
        $indexparti=-1;
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $empresa=Empresa::find("emp_estatus=2");
        $area=Areatematica::find("are_estatus=2");
        $curso=Curso::find("cur_estatus=2");
        $admin=Administrador::find("adm_estatus=2");
        $instructor=Instructor::find("ins_estatus=2");

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Cursootorgado.cuo_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexemp=$data["emp_id"];
            $indexare=$data["are_id"];
            $indexcur=$data["cur_id"];
            $indexadm=$data["adm_id"];
            $indexins=$data["ins_id"];
            $indextipo=$data["cuo_tipo"];
            $indexparti=$data["participantes"];

            if($data["emp_id"]!=-1)
                $condicion.=" and e.emp_id=".$data["emp_id"];
            if($data["are_id"]!=-1)
                $condicion.=" and a.are_id=".$data["are_id"];
            if($data["cur_id"]!=-1)
                $condicion.=" and c.cur_id=".$data["cur_id"];
            if($data["adm_id"]!=-1)
                $condicion.=" and ad.adm_id=".$data["adm_id"];
            if($data["ins_id"]!=-1)
                $condicion.=" and i.ins_id=".$data["ins_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and cuo_fechainicio>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and cuo_fechafinal<='".$data["fecha_fin"]."'";
            
            $datos=[];
            if($data["participantes"]==-1){
                if($data["cuo_tipo"]!=-1)
                    $condicion.=" and Cursootorgado.cuo_tipo=".$data["cuo_tipo"];
                
                $datos=Cursootorgado::query()
                ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                ->leftjoin('Empresa','e.emp_id=Cursootorgado.emp_id','e')
                ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                ->join('Areatematica','a.are_id=c.are_id','a')
                ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                ->where($condicion)
                ->execute();
            }
            if($data["participantes"]==1){
                if($data["cuo_tipo"]==-1)
                {
                    $condicion2=$condicion;
                    $condicion2.=" and Cursootorgado.cuo_tipo=1 and par_estatus=2";
                    $datos1=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->leftjoin('Empresa','e.emp_id=Cursootorgado.emp_id','e')
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->where($condicion2)
                    ->execute();

                    $condicion3=$condicion;
                    $condicion3.=" and Cursootorgado.cuo_tipo=2 and par_estatus=2";
                    $datos2=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion3)
                    ->execute();

                    $condicion4=$condicion;
                    $condicion4.=" and Cursootorgado.cuo_tipo=3 and par_estatus=2";
                    $datos3=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion4)
                    ->execute();

                    for($x=0;$x<count($datos1);$x++){
                        array_push($datos,$datos1[$x]);
                    }
                    for($x=0;$x<count($datos2);$x++){
                        array_push($datos,$datos2[$x]);
                    }
                    for($x=0;$x<count($datos3);$x++){
                        array_push($datos,$datos3[$x]);
                    }
                    // array_merge($datos,$datos1,$datos2);
                }
                if($data["cuo_tipo"]==1)
                {
                    $condicion2=$condicion;
                    $condicion2.=" and Cursootorgado.cuo_tipo=1 and par_estatus=2";
                    $datos=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->leftjoin('Empresa','e.emp_id=Cursootorgado.emp_id','e')
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->where($condicion2)
                    ->execute();
                }
                if($data["cuo_tipo"]==2)
                {
                    $condicion3=$condicion;
                    $condicion3.=" and Cursootorgado.cuo_tipo=2 and par_estatus=2";
                    $datos=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion3)
                    ->execute();
                }
                 if($data["cuo_tipo"]==3)
                {
                    $condicion4=$condicion;
                    $condicion4.=" and Cursootorgado.cuo_tipo=3 and par_estatus=2";
                    $datos=Cursootorgado::query()
                    ->columns("Cursootorgado.cuo_id,cuo_clave,cuo_tipo,c.cur_id,c.cur_nombre,t.tra_nombre,t.tra_primerapellido,t.tra_segundoapellido,e.emp_razonsocial,a.are_denominacion,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,ad.adm_nombre,i.ins_id,i.ins_nombre,i.ins_nombre,i.ins_primerapellido,i.ins_segundoapellido")
                    ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
                    ->join('Areatematica','a.are_id=c.are_id','a')
                    ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
                    ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
                    ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
                    ->join('Trabajador','t.tra_id=p.tra_id','t')
                    ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
                    ->where($condicion4)
                    ->execute();
                }
                
            }

        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Cursos por empresa")
        ->setSubject("Cursos por empresa")
        ->setDescription("Cursos por empresa")
        ->setKeywords("Reporte")
        ->setCategory("Cursos por empresa");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();

        if($data["participantes"]==-1){        
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Clave del curso');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Curso');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Empresa');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Área temática');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Fecha inicio');
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Fecha final');
            $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Administrador');
            $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Instructor');
        }
        if($data["participantes"]==1){
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Participante');    
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Clave del curso');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Curso');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Empresa');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Área temática');
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Fecha inicio');
            $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Fecha final');
            $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Administrador');
            $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Instructor');
        }
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray(
        array(
            'font' => array(
                'bold' => true,
                'size' => 9
                )
            )
        );
        for ($i=0; $i < count($datos); $i++) 
        {
            if($data["participantes"]==-1){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $datos[$i]->cuo_clave);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $datos[$i]->cur_nombre);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $datos[$i]->emp_razonsocial);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $datos[$i]->are_denominacion);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $datos[$i]->cuo_fechainicio);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $datos[$i]->cuo_fechafinal);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), $datos[$i]->adm_nombre);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.($i+2), $datos[$i]->ins_nombre.' '.$datos[$i]->ins_primerapellido.' '.$datos[$i]->ins_segundoapellido);
            }
            if($data["participantes"]==1){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $datos[$i]->tra_nombre.' '.$datos[$i]->tra_primerapellido.' '.$datos[$i]->tra_segundoapellido);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $datos[$i]->cuo_clave);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $datos[$i]->cur_nombre);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $datos[$i]->emp_razonsocial);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $datos[$i]->are_denominacion);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $datos[$i]->cuo_fechainicio);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), $datos[$i]->cuo_fechafinal);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.($i+2), $datos[$i]->adm_nombre);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.($i+2), $datos[$i]->ins_nombre.' '.$datos[$i]->ins_primerapellido.' '.$datos[$i]->ins_segundoapellido);
            }
            
        }
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/reportegeneral.xlsx');
        $this->view->disable();

        $file='reportegeneral.xlsx';
        $response = new Response();
        $path = 'reporte/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);   
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ","-",$file), true);
        $response->send();
        die();

        $this->view->indexemp=$indexemp;
        $this->view->indexare=$indexare;
        $this->view->indexcur=$indexcur;
        $this->view->indexadm=$indexadm;
        $this->view->indexins=$indexins;
        $this->view->indextipo=$indextipo;
        $this->view->indexparti=$indexparti;
        $this->view->empresa=$empresa;
        $this->view->area=$area;
        $this->view->curso=$curso;
        $this->view->admin=$admin;
        $this->view->instructor=$instructor;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;
    }

    public function participantescursoabiertoAction(){
        $indexemp=-1;
        // $indexare=-1;
        $indexcur=-1;
        // $indexadm=-1;
        // $indexins=-1;
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $empresa=Empresa::find("emp_estatus=2");
        // $area=Areatematica::find("are_estatus=2");
        $curso=Curso::find("cur_estatus=2");
        // $admin=Administrador::find("adm_estatus=2");
        // $instructor=Instructor::find("ins_estatus=2");

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Cursootorgado.cuo_estatus=2 and Cursootorgado.cuo_tipo=2 and p.par_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexemp=$data["emp_id"];
            // $indexare=$data["are_id"];
            $indexcur=$data["cur_id"];
            // $indexadm=$data["adm_id"];
            // $indexins=$data["ins_id"];

            if($data["emp_id"]!=-1)
                $condicion.=" and e.emp_id=".$data["emp_id"];
            // if($data["are_id"]!=-1)
            //     $condicion.=" and a.are_id=".$data["are_id"];
            if($data["cur_id"]!=-1)
                $condicion.=" and c.cur_id=".$data["cur_id"];
            // if($data["adm_id"]!=-1)
            //     $condicion.=" and ad.adm_id=".$data["adm_id"];
            // if($data["ins_id"]!=-1)
            //     $condicion.=" and i.ins_id=".$data["ins_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and cuo_fechainicio>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and cuo_fechafinal<='".$data["fecha_fin"]."'";

            $datos=Cursootorgado::query()
            ->columns("cuo_clave,c.cur_id,c.cur_nombre,e.emp_razonsocial,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,tra_nombre,tra_primerapellido,tra_segundoapellido")
            
            ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
            ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
            ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            // ->join('Areatematica','a.are_id=c.are_id','a')
            // ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
            // ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
            ->where($condicion)
            ->execute();
        }

        $this->view->indexemp=$indexemp;
        // $this->view->indexare=$indexare;
        $this->view->indexcur=$indexcur;
        // $this->view->indexadm=$indexadm;
        // $this->view->indexins=$indexins;
        $this->view->empresa=$empresa;
        // $this->view->area=$area;
        $this->view->curso=$curso;
        // $this->view->admin=$admin;
        // $this->view->instructor=$instructor;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;

    }

    public function participantescursoabiertoexcelAction(){
        $indexemp=-1;
        // $indexare=-1;
        $indexcur=-1;
        // $indexadm=-1;
        // $indexins=-1;
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $empresa=Empresa::find("emp_estatus=2");
        // $area=Areatematica::find("are_estatus=2");
        $curso=Curso::find("cur_estatus=2");
        // $admin=Administrador::find("adm_estatus=2");
        // $instructor=Instructor::find("ins_estatus=2");

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Cursootorgado.cuo_estatus=2 and Cursootorgado.cuo_tipo=2 and p.par_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexemp=$data["emp_id"];
            // $indexare=$data["are_id"];
            $indexcur=$data["cur_id"];
            // $indexadm=$data["adm_id"];
            // $indexins=$data["ins_id"];

            if($data["emp_id"]!=-1)
                $condicion.=" and e.emp_id=".$data["emp_id"];
            // if($data["are_id"]!=-1)
            //     $condicion.=" and a.are_id=".$data["are_id"];
            if($data["cur_id"]!=-1)
                $condicion.=" and c.cur_id=".$data["cur_id"];
            // if($data["adm_id"]!=-1)
            //     $condicion.=" and ad.adm_id=".$data["adm_id"];
            // if($data["ins_id"]!=-1)
            //     $condicion.=" and i.ins_id=".$data["ins_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and cuo_fechainicio>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and cuo_fechafinal<='".$data["fecha_fin"]."'";

            $datos=Cursootorgado::query()
            ->columns("cuo_clave,c.cur_id,c.cur_nombre,e.emp_razonsocial,DATE_FORMAT(cuo_fechainicio,'%d/%m/%Y') as cuo_fechainicio,DATE_FORMAT(cuo_fechafinal, '%d/%m/%Y') as cuo_fechafinal,tra_nombre,tra_primerapellido,tra_segundoapellido")
            ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
            ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
            ->leftjoin('Empresa','e.emp_id=p.emp_id','e')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            // ->join('Empresa','e.emp_id=Cursootorgado.emp_id','e')
            // ->join('Curso','c.cur_id=Cursootorgado.cur_id','c')
            // ->join('Participante','p.cuo_id=Cursootorgado.cuo_id','p')
            // ->join('Trabajador','p.tra_id=t.tra_id','t')
            // ->join('Areatematica','a.are_id=c.are_id','a')
            // ->join('Administrador','ad.adm_id=Cursootorgado.adm_id','ad')
            // ->join('Instructor','i.ins_id=Cursootorgado.ins_id','i')
            ->where($condicion)
            ->execute();
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Cursos por empresa")
        ->setSubject("Cursos por empresa")
        ->setDescription("Cursos por empresa")
        ->setKeywords("Reporte")
        ->setCategory("Cursos por empresa");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Trabajador');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Clave del curso');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Curso');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Empresa');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Fecha inicial');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Fecha final');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
        array(
            'font' => array(
                'bold' => true,
                'size' => 9
                )
            )
        );
        for ($i=0; $i < count($datos); $i++) 
        { 
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $datos[$i]->tra_nombre.' '.$datos[$i]->tra_primerapellido.' '.$datos[$i]->tra_segundoapellido);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $datos[$i]->cuo_clave);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $datos[$i]->cur_nombre);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $datos[$i]->emp_razonsocial);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $datos[$i]->cuo_fechainicio);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $datos[$i]->cuo_fechafinal);
            
        }
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/participantes.xlsx');
        $this->view->disable();

        $file='participantes.xlsx';
        $response = new Response();
        $path = 'reporte/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);   
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ","-",$file), true);
        $response->send();
        die();


        $this->view->indexemp=$indexemp;
        $this->view->indexcur=$indexcur;
        $this->view->empresa=$empresa;
        $this->view->curso=$curso;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;

    }
}
