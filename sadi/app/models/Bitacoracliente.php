<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Bitacoracliente extends Model
{
	public $bit_id;
	

	public function NuevoRegistro($data)
	{
		
		$bitacora= new Bitacoracliente();
		$bitacora->bic_descripcion=$data['bic_descripcion'];
		$bitacora->cli_id=$data['cli_id'];
		$bitacora->bic_tablaid=$data['bic_tablaid'];
		$bitacora->bic_modulo=$data['bic_modulo'];

		$ese_id=0;
		if(isset($data['ese_id'])){
			$ese_id=$data['ese_id'];
		}
		$bitacora->ese_id=$ese_id;
		
		if ($bitacora->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $bitacora->bic_id;
		}	

	}
	

}