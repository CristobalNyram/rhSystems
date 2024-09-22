<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;


class Historialdescarga extends Model
{
	
	public $clave;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	

	public function NuevoRegistrodc3($data,$usu_id,$tipo_curso)
	{
		$his= new Historialdescarga();
		
		$his->par_id=$data->par_id;
		$his->his_tipo=1;
		$his->usu_id=$usu_id;
		$his->tra_nombre=$data->tra_nombre;
		$his->tra_primerapellido=$data->tra_primerapellido;
		$his->tra_segundoapellido=$data->tra_segundoapellido;
		$his->tra_curp=$data->tra_curp;
		$his->ocu_clave=$data->ocu_clave;
		$his->tra_puesto=$data->tra_puesto;
		$his->emp_razonsocial=$data->emp_razonsocial;
		$his->emp_rfc=$data->emp_rfc;
		$his->cur_nombre=$data->cur_nombre;
		$his->cuo_horas=$data->cuo_horas;
		$his->cuo_fechainicio=$data->cuo_fechainicio;
		$his->cuo_fechafinal=$data->cuo_fechafinal;
		$his->are_clave=$data->are_clave;
		$his->adm_nombre=$data->adm_nombre;
		$his->ins_nombre=$data->ins_nombre;
		$his->ins_primerapellido=$data->ins_primerapellido;
		$his->ins_segundoapellido=$data->ins_segundoapellido;
		$his->ins_firma=$data->ins_firma;
		$his->rep_nombrelegal=$data->rep_nombrelegal;
		$his->rep_primerapellidolegal=$data->rep_primerapellidolegal;
		$his->rep_segundoapellidolegal=$data->rep_segundoapellidolegal;
		$his->rep_nombretra=$data->rep_nombretra;
		$his->rep_primerapellidotra=$data->rep_primerapellidotra;
		$his->rep_segundoapellidotra=$data->rep_segundoapellidotra;
		$his->par_foliodc3=$data->par_foliodc3;
		$his->par_fechadc3=$data->fecha_dc3doc;
		$his->cuo_diploma=$data->cuo_diploma;
		$his->adm_logo=$data->adm_logo;
		$his->emp_logo=$data->emp_logo;
		$his->tipo_curso=$tipo_curso;

		if ($his->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return true;
		}	
	}

	public function NuevoRegistrodiploma($data,$usu_id,$tipo_curso)
	{
		$his= new Historialdescarga();
		
		$his->par_id=$data->par_id;
		$his->his_tipo=2;
		$his->usu_id=$usu_id;
		$his->tra_nombre=$data->tra_nombre;
		$his->tra_primerapellido=$data->tra_primerapellido;
		$his->tra_segundoapellido=$data->tra_segundoapellido;
		$his->cur_nombre=$data->cur_nombre;
		$his->cuo_horas=$data->cuo_horas;
		$his->cuo_fechainicio=$data->cuo_fechainicio;
		$his->cuo_fechafinal=$data->cuo_fechafinal;
		$his->ins_nombre=$data->ins_nombre;
		$his->ins_primerapellido=$data->ins_primerapellido;
		$his->ins_segundoapellido=$data->ins_segundoapellido;
		$his->ins_firma=$data->ins_firma;
		$his->est_nombre=$data->est_nombre;
		$his->mun_nombre=$data->mun_nombre;
		$his->par_foliodip=$data->par_foliodip;
		$his->par_fechadip=$data->fechadiploma;
		$his->cuo_diploma=$data->cuo_diploma;
		$his->adm_nombredirector=$data->adm_nombredirector;
		$his->adm_primerapellidodirector=$data->adm_primerapellidodirector;
		$his->adm_segundoapellidodirector=$data->adm_segundoapellidodirector;
		$his->adm_puestofirma=$data->adm_puestofirma;
		$his->adm_firma=$data->adm_firma;
		$his->tipo_curso=$tipo_curso;

		if ($his->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return true;
		}	
	}

	public function getTipo()
	{
		if ($this->his_tipo == 1) 
		{
			return 'DC3';
		}
		if ($this->his_tipo == 2) 
		{
			return 'Diploma';
		}
		
	}
}