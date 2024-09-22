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
	
	/**
	 * Crea un nuevo registro en la tabla Bitacora.
	 *
	 * @param array $data Los datos del registro de bitácora a crear.
	 *                   - 'bit_descripcion': La descripción del registro.
	 *                   - 'usu_id': El ID del usuario asociado al registro.
	 *                   - 'bit_tablaid': El ID de la tabla asociada al registro.
	 *                   - 'bit_modulo': El módulo del sistema asociado al registro.
	 *                   - 'vac_id' (opcional): El ID de la vacante asociada al registro.
	 *                   - 'bit_accion' (opcional): La acción del registro.
	 *
	 * @return int|false El ID del registro creado si se guarda correctamente, o false en caso de error.
	 */
	public function NuevoRegistro($data)
	{
		
		$bitacora= new Bitacora();
		$bitacora->bit_descripcion=$data['bit_descripcion'];
		$bitacora->usu_id=$data['usu_id'];
		$bitacora->bit_tablaid=$data['bit_tablaid'];
		$bitacora->bit_modulo=$data['bit_modulo'];

		$vac_id=0;
		$exc_id=0;

		$bit_accion=0;
		$bit_tipo=0;

		if(isset($data['vac_id'])){
			$vac_id=$data['vac_id'];
		}
		if(isset($data['exc_id'])){
			$exc_id=$data['exc_id'];
		}
		if(isset($data['bit_accion'])){
			
			$bit_accion=$data['bit_accion'];

		}
		if(isset($data['bit_tipo'])){
			
			$bit_tipo=$data['bit_tipo'];

		}
		$bitacora->vac_id=$vac_id;
		$bitacora->exc_id=$exc_id;

		$bitacora->bit_accion=$bit_accion;
		$bitacora->bit_tipo=$bit_tipo;

		if ($bitacora->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $bitacora->bit_id;
		}	

	}
	

}