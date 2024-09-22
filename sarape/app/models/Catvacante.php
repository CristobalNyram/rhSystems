<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla catvacante
 */
class Catvacante extends Model
{
	public function getEstatusDetail()
	{
		if ($this->cav_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->cav_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->vac_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getCatvacante($cav_id)
	{
		$registro=Catvacante::query()
        ->columns("cav_nombre")
        ->where('cav_id='.$cav_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}

}