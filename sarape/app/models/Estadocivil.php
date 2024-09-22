<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Estadocivil extends Model
{
	public function getEstatusDetail()
	{
		if ($this->esc_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->esc_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->esc_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getEstadocivil($reg_id)
	{
		$registro=Estadocivil::query()
        ->columns("esc_nombre")
        ->where('esc_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}
}