<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla estado
 */
class Municipio extends Model
{
	public $mun_id;
	public $mun_nombre;
	public $mun_estatus;
	// public $mun_id;
	
	/**
	 * [getEstatusDetail Obtener el estado de un estado]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del estado]
	 */
	public function getEstatusDetail()
	{
		if ($this->mun_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->mun_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->mun_estatus == 0) 
		{
			return '0';
		}
		if ($this->mun_estatus < 0) 
		{
			return '-1';
		}
	}
	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla estado]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	

	/**
	 * [EditarRegistro Editar un registro de la tabla estado]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro,id del estado a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	
	/**
	 * [FillSelect Seleccionar los registros de la tabla estado]
	 * @param  $incluyebaja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
	public function FillSelect($incluyebaja=false)
	{
		$min=0;
		if($incluyebaja)
			$min=1;
		else
			$min=2;
		$municipio = Municipio::find(array(
                "mun_estatus<=2 and mun_estatus>=:min:",
                'columns'=>array('mun_cla','mun_nombre'),
                'order'=>'mun_nombre',
                'bind' => array('min' => $min)
            ));
		return $municipio;
	}
}