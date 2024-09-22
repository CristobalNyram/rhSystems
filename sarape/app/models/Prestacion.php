<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla sexo
 */
class Prestacion extends Model
{
	public function getEstatusDetail()
	{
		if ($this->pre_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->pre_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->pre_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getSexo($reg_id)
	{
		$registro=Sexo::query()
        ->columns("sex_nombre")
        ->where('sex_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}
}