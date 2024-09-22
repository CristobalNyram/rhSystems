<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Tipoempleo extends Model
{
	public function getEstatusDetail()
	{
		if ($this->tie_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->tie_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->tie_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getTipoempleo($reg_id)
	{
		$registro=Tipoempleo::query()
        ->columns("tie_nombre")
        ->where('tie_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}
}