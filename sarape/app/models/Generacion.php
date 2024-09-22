<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Generacion extends Model
{
	public function getEstatusDetail()
	{
		if ($this->gen_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->gen_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->gen_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getGeneracion($reg_id)
	{
		$registro=Generacion::query()
        ->columns("gen_nombre")
        ->where('gen_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}
}