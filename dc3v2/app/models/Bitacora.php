<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Bitacora extends Model
{
	public $bit_id;
	

	public function NuevoRegistro($data)
	{
		
		$bitacora= new Bitacora();
		$bitacora->bit_descripcion=$data['bit_descripcion'];
		$bitacora->usu_id=$data['usu_id'];
		$bitacora->bit_tablaid=$data['bit_tablaid'];
		
		if ($bitacora->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $bitacora->bit_id;
		}	

	}
	

}