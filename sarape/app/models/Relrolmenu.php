<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla relpuestomenu
 */
class Relrolmenu extends Model
{
	public $rrm_estatus;
	public $men_id;
	public $pue_id;
	
	/**
	 * [getEstatusDetail Obtener el estado de la relacion puesto menu]
	 * @param  ' ' 			[No recibe parametros]
	 * @return [string] 	[Descripción del estatus de la relacion puesto menu]
	 */
	public function getEstatusDetail()
	{
		if ($this->rrm_estatus == 1) 
		{
			return '1';
		}
		if ($this->rrm_estatus == 2) 
		{
			return '2';
		}
		if ($this->rrm_estatus == 0) 
		{
			return '0';
		}
		if ($this->rrm_estatus < 0) 
		{
			return '-1';
		}
	}
	
	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla relpuestomenu]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		

	}
	/**
	 * [EditarRegistro Editar un registro de la tabla relpuestomenu]
	 * @param  $data, $id	[datos del ajax con los datos para el registro,id del registro a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	public function EditarRegistro($data,$id)
	{
		
	}

}