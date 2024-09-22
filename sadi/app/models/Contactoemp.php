<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla empresa
 */
class Contactoemp extends Model
{
	public $cne_id;
	public $cne_nombre;
	public $cne_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->cne_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->cne_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->cne_estatus == 0) 
		{
			return '0';
		}
		if ($this->cnc_estatus < 0) 
		{
			return '-1';
		}
	}

	public function get_contactoempresa_activa($emp_id){

		$contactoemp_data=Contactoemp::query()
		->where('cne_id='.$emp_id)
		->execute();


		if(count($contactoemp_data)>0){
			return $contactoemp_data[0];
		}else{
			return null;
		}
	}

}