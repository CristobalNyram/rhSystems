<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Archivotransporte extends Model
{
	public $art_id;
	public $art_nombre;

	public function getEstatusDetail()
	{
		if ($this->art_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->art_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->art_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function NuevoRegistro($data)
	{
		
		$archivo= new Archivotransporte();
		$archivo->art_nombre=$data['art_nombre'];
		$archivo->art_estatus=$data['art_estatus'];
        $archivo->art_nota=$data['art_nota'];
		$archivo->ese_id=$data['ese_id'];
		$archivo->tra_id=$data['tra_id'];
		
		if ($archivo->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $archivo->art_id;
		}	

	}
	
}