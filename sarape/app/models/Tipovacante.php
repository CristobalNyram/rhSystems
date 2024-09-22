<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Tipovacante extends Model
{
	public function getEstatusDetail()
	{
		if ($this->tip_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->tip_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->tip_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getTipovacante($reg_id)
	{
		$registro=Tipovacante::query()
        ->columns("tip_nombre")
        ->where('tip_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}

}