<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class SoporteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Soporte');
        parent::initialize();
        
    }

    public function asignardatoscerradosAction()
    {
    	$condicion='Participante.par_estatus=2';

    	$datos=Participante::query()
        ->columns('t.tra_puesto as puesto, t.ocu_id as ocupacion, Participante.par_id')
        ->join('Cursootorgado','cuo.cuo_id=Participante.cuo_id','cuo')
        ->join('Trabajador','t.tra_id=Participante.tra_id','t')
        ->where($condicion)
        ->execute();

        for($x=0;$x<count($datos);$x++){
        		$parti = Participante::findFirstBypar_id($datos[$x]->par_id);
        		$parti->tra_puesto=$datos[$x]->puesto;
        		$parti->ocu_id=$datos[$x]->ocupacion;
            	$parti->save();
        }
    }

    public function agregarhistorialcerradoAction()
    {
    	$condicion='Participante.par_estatus=2 and cuo_tipo=1 and cuo.cuo_id>459 and cuo.cuo_id<600';

    	$datos=Participante::query()
        ->columns('Participante.par_id, cuo_tipo, par_foliodc3, par_foliodip')
        ->join('Cursootorgado','cuo.cuo_id=Participante.cuo_id','cuo')
        // ->join('Trabajador','t.tra_id=Participante.tra_id','t')
        ->where($condicion)
        ->execute();

        for($x=0;$x<count($datos);$x++){
        	if($datos[$x]->par_foliodc3!=null)
        	{
        		$historial='';
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
		        ->where('par_id='.$datos[$x]->par_id)
		        ->getQuery()
		        ->execute();

		        $historial=$participante[0];
	            $historial->rep_nombrelegal='';
	            $historial->rep_primerapellidolegal='';
	            $historial->rep_segundoapellidolegal='';
	            $historial->rep_nombretra='';
	            $historial->rep_primerapellidotra='';
	            $historial->rep_segundoapellidotra='';
		        if($participante[0]->rep_idlegal!=null)
	            {
	            	$part = Representante::findFirstByrep_id($participante[0]->rep_idlegal);
	                $historial->rep_nombrelegal=$part->rep_nombre;
	                $historial->rep_primerapellidolegal=$part->rep_primerapellido;
	                $historial->rep_segundoapellidolegal=$part->rep_segundoapellido;
	                
	            } 
	            if($participante[0]->rep_idtra!=null)
	            {
					$part = Representante::findFirstByrep_id($participante[0]->rep_idtra);   
	                $historial->rep_nombretra=$part->rep_nombre;
	                $historial->rep_primerapellidotra=$part->rep_primerapellido;
	                $historial->rep_segundoapellidotra=$part->rep_segundoapellido;
	            }

	            $hisdescarga= new Historialdescarga();
            	$hisdescarga->NuevoRegistrodc3($historial,0,1);
        	}

        	if($datos[$x]->par_foliodip!=null)
        	{
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
		        ->where('par_id='.$datos[$x]->par_id)
		        ->getQuery()
		        ->execute();

		        $historial='';
		        $auth = $this->session->get('auth');
		        $historial=$participante[0];
		        $hisdescarga= new Historialdescarga();
		        $hisdescarga->NuevoRegistrodiploma($historial,0,1);
        	}
        		
        }
    }

    public function agregarhistorialabiertoAction()
    {
    	$condicion='Participante.par_estatus=2 and cuo_tipo=2 and cuo.cuo_id>499 and cuo.cuo_id<600';

    	$datos=Participante::query()
        ->columns('Participante.par_id, cuo_tipo, par_foliodc3, par_foliodip')
        ->join('Cursootorgado','cuo.cuo_id=Participante.cuo_id','cuo')
        // ->join('Trabajador','t.tra_id=Participante.tra_id','t')
        ->where($condicion)
        ->execute();

        for($x=0;$x<count($datos);$x++){
        	if($datos[$x]->par_foliodc3!=null)
        	{
        		$historial='';

        		$participante=new Builder();
	            $participante=$participante
	            ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','p.tra_puesto','cur_nombre','cuo_horas','cuo_diploma',
	                'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in', 'cuo_fechainicio',
	                'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin', 'cuo_fechafinal',
	                'e.emp_razonsocial', 'e.emp_rfc', 'e.emp_logo','ocu.ocu_clave', 'a.are_clave', 'adm.adm_nombre', 'adm.adm_logo',
	                'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido','ins_firma',
	                'p.par_id',
	                'p.rep_idlegal','p.rep_idtra','p.par_foliodc3','DATE_FORMAT(par_fechadc3, "%d-%m-%Y") as fechadc3', 'par_fechadc3 as fecha_dc3doc'
	            ))
	            ->addFrom('Participante','p')
	            ->join('Trabajador','p.tra_id=t.tra_id','t')
	            ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
	            ->join('Curso','c.cur_id=co.cur_id','c')
	            ->join('Empresa','e.emp_id=p.emp_id','e')
	            ->join('Ocupacion','ocu.ocu_id=p.ocu_id','ocu')
	            ->join('Areatematica','a.are_id=c.are_id','a')
	            ->join('Administrador','adm.adm_id=co.adm_id','adm')
	            ->join('Instructor','i.ins_id=co.ins_id','i')
	            // ->join('Representante','rl.rep_id=co.rep_idlegal','rl')
	            // ->join('Representante','rt.rep_id=co.rep_idtra','rt')
	            ->where('par_id='.$datos[$x]->par_id)
	            ->getQuery()
	            ->execute();

		        $historial=$participante[0];
	            $historial->rep_nombrelegal='';
	            $historial->rep_primerapellidolegal='';
	            $historial->rep_segundoapellidolegal='';
	            $historial->rep_nombretra='';
	            $historial->rep_primerapellidotra='';
	            $historial->rep_segundoapellidotra='';
		        if($participante[0]->rep_idlegal!=null)
	            {
	            	$part = Representante::findFirstByrep_id($participante[0]->rep_idlegal);
	                $historial->rep_nombrelegal=$part->rep_nombre;
	                $historial->rep_primerapellidolegal=$part->rep_primerapellido;
	                $historial->rep_segundoapellidolegal=$part->rep_segundoapellido;
	                
	            } 
	            if($participante[0]->rep_idtra!=null)
	            {
					$part = Representante::findFirstByrep_id($participante[0]->rep_idtra);   
	                $historial->rep_nombretra=$part->rep_nombre;
	                $historial->rep_primerapellidotra=$part->rep_primerapellido;
	                $historial->rep_segundoapellidotra=$part->rep_segundoapellido;
	            }

	            $hisdescarga= new Historialdescarga();
            	$hisdescarga->NuevoRegistrodc3($historial,0,2);
        	}

        	if($datos[$x]->par_foliodip!=null)
        	{
        		$participante=new Builder();
		        $participante=$participante
		        ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas',
		            'DATE_FORMAT(cuo_fechainicio, "%Y") as anio_in','DATE_FORMAT(cuo_fechainicio, "%m") as mes_in','DATE_FORMAT(cuo_fechainicio, "%d") as dia_in',
		            'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
		            'par_id','adr.adm_nombredirector','adr.adm_primerapellidodirector', 'adr.adm_segundoapellidodirector','adr.adm_puestofirma','adr.adm_firma',
		            'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido','i.ins_firma',
		            'e.est_nombre','m.mun_nombre',
		            'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','cuo_fechafinal','cuo_diploma','par_fechadip as fechadiploma'))
		        ->addFrom('Participante','p')
		        ->join('Trabajador','p.tra_id=t.tra_id','t')
		        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
		        ->join('Curso','c.cur_id=co.cur_id','c')
		        ->join('Administrador','adm.adm_id=co.adm_id','adm')
		        ->join('Admindirector','adr.adr_id=adm.adr_id','adr')
		        ->join('Instructor','i.ins_id=co.ins_id','i')
		        ->join('Estado','co.est_id=e.est_id','e')
		        ->join('Municipio','co.mun_cla=m.mun_cla','m')
		        ->where('par_id='.$datos[$x]->par_id)
		        ->getQuery()
		        ->execute();

		        $historial='';
		        $auth = $this->session->get('auth');
		        $historial=$participante[0];
		        $hisdescarga= new Historialdescarga();
		        $hisdescarga->NuevoRegistrodiploma($historial,0,2);
        	}
        		
        }
    }

    public function agregarhistoriallineaAction()
    {
    	$condicion='Participante.par_estatus=2 and cuo_tipo=3';

    	$datos=Participante::query()
        ->columns('Participante.par_id, cuo_tipo, par_foliodc3, par_foliodip')
        ->join('Cursootorgado','cuo.cuo_id=Participante.cuo_id','cuo')
        // ->join('Trabajador','t.tra_id=Participante.tra_id','t')
        ->where($condicion)
        ->execute();

        for($x=0;$x<count($datos);$x++){
        	if($datos[$x]->par_foliodc3!=null)
        	{
        		$historial='';

        		$participante=new Builder();
	            $participante=$participante
	            ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','p.tra_puesto','cur_nombre','cuo_horas','cuo_diploma',
	                'DATE_FORMAT(par_fechaexamen, "%Y") as anio_in','DATE_FORMAT(par_fechaexamen, "%m") as mes_in','DATE_FORMAT(par_fechaexamen, "%d") as dia_in',
	                'e.emp_razonsocial', 'e.emp_rfc', 'e.emp_logo','ocu.ocu_clave', 'a.are_clave', 'adm.adm_nombre', 'adm.adm_logo',
	                'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido','ins_firma',
	                'p.par_id',
	                'p.rep_idlegal','p.rep_idtra','p.par_foliodc3','DATE_FORMAT(par_fechadc3, "%d-%m-%Y") as fechadc3', 'par_fechadc3 as fecha_dc3doc','par_fechaexamen','par_fechaexamen as cuo_fechainicio','par_fechaexamen as cuo_fechafinal'
	            ))
	            ->addFrom('Participante','p')
	            ->join('Trabajador','p.tra_id=t.tra_id','t')
	            ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
	            ->join('Curso','c.cur_id=co.cur_id','c')
	            ->join('Empresa','e.emp_id=p.emp_id','e')
	            ->join('Ocupacion','ocu.ocu_id=p.ocu_id','ocu')
	            ->join('Areatematica','a.are_id=c.are_id','a')
	            ->join('Administrador','adm.adm_id=co.adm_id','adm')
	            ->join('Instructor','i.ins_id=co.ins_id','i')
	            // ->join('Representante','rl.rep_id=co.rep_idlegal','rl')
	            // ->join('Representante','rt.rep_id=co.rep_idtra','rt')
	            ->where('par_id='.$datos[$x]->par_id)
	            ->getQuery()
	            ->execute();

		        $historial=$participante[0];
	            $historial->rep_nombrelegal='';
	            $historial->rep_primerapellidolegal='';
	            $historial->rep_segundoapellidolegal='';
	            $historial->rep_nombretra='';
	            $historial->rep_primerapellidotra='';
	            $historial->rep_segundoapellidotra='';
		        if($participante[0]->rep_idlegal!=null)
	            {
	            	$part = Representante::findFirstByrep_id($participante[0]->rep_idlegal);
	                $historial->rep_nombrelegal=$part->rep_nombre;
	                $historial->rep_primerapellidolegal=$part->rep_primerapellido;
	                $historial->rep_segundoapellidolegal=$part->rep_segundoapellido;
	                
	            } 
	            if($participante[0]->rep_idtra!=null)
	            {
					$part = Representante::findFirstByrep_id($participante[0]->rep_idtra);   
	                $historial->rep_nombretra=$part->rep_nombre;
	                $historial->rep_primerapellidotra=$part->rep_primerapellido;
	                $historial->rep_segundoapellidotra=$part->rep_segundoapellido;
	            }

	            $hisdescarga= new Historialdescarga();
            	$hisdescarga->NuevoRegistrodc3($historial,0,3);
        	}

        	if($datos[$x]->par_foliodip!=null)
        	{
        		$participante=new Builder();
		        $participante=$participante
		        ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_horas',
		            'DATE_FORMAT(par_fechaexamen, "%Y") as anio_in','DATE_FORMAT(par_fechaexamen, "%m") as mes_in','DATE_FORMAT(par_fechaexamen, "%d") as dia_in',
		            'DATE_FORMAT(cuo_fechafinal, "%Y") as anio_fin','DATE_FORMAT(cuo_fechafinal, "%m") as mes_fin','DATE_FORMAT(cuo_fechafinal, "%d") as dia_fin',
		            'par_id','adr.adm_nombredirector','adr.adm_primerapellidodirector', 'adr.adm_segundoapellidodirector','adr.adm_puestofirma','adr.adm_firma',
		            'i.ins_nombre', 'i.ins_primerapellido', 'i.ins_segundoapellido','i.ins_firma',
		            'e.est_nombre','m.mun_nombre',
		            'par_foliodip','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip','cuo_fechainicio','par_fechaexamen','cuo_fechafinal','cuo_diploma','par_fechaexamen as cuo_fechainicio','par_fechaexamen as cuo_fechafinal','par_fechadip as fechadiploma'))
		        ->addFrom('Participante','p')
		        ->join('Trabajador','p.tra_id=t.tra_id','t')
		        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
		        ->join('Curso','c.cur_id=co.cur_id','c')
		        ->join('Administrador','adm.adm_id=co.adm_id','adm')
		        ->join('Admindirector','adr.adr_id=adm.adr_id','adr')
		        ->join('Instructor','i.ins_id=co.ins_id','i')
		        ->join('Estado','co.est_id=e.est_id','e')
		        ->join('Municipio','co.mun_cla=m.mun_cla','m')
		        ->where('par_id='.$datos[$x]->par_id)
		        ->getQuery()
		        ->execute();

		        $historial='';
		        $auth = $this->session->get('auth');
		        $historial=$participante[0];
		        $hisdescarga= new Historialdescarga();
		        $hisdescarga->NuevoRegistrodiploma($historial,0,3);
        	}
        		
        }
    }

    public function verificasesionAction()
    {
        $this->view->disable();
        $answer=array();
        $auth = $this->session->get('auth');
        if($auth){
            $answer[0]=1;
        }else{
            $answer[0]=0;
        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }
}