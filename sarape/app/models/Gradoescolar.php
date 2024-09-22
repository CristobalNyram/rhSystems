<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Gradoescolar extends Model
{
	public function getEstatusDetail()
	{
		if ($this->gra_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->gra_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->gra_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getGradoescolar($reg_id)
	{
		$registro=Gradoescolar::query()
        ->columns("gra_nombre")
        ->where('gra_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}
}