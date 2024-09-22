<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Ocupacion extends Model
{
	public $neg_id;
	public $neg_nombre;

	public function getEstatusDetail()
	{
		if ($this->ocu_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->ocu_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->ocu_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getOcupacion($ocu_id)
	{
		$ocupacion=Ocupacion::query()
        ->columns("ocu_nombre")
        ->where('ocu_id='.$ocu_id)
        ->execute();

		if($ocupacion[0])
			return $ocupacion[0];
		else
			return "";
	}

}