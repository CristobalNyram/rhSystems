<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Negocio extends Model
{
	public $neg_id;
	public $neg_nombre;

	public function getEstatusDetail()
	{
		if ($this->neg_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->neg_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->neg_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getNegocio($neg_id)
	{
		$negocio=Negocio::query()
        ->columns("neg_nombre")
        ->where('neg_id='.$neg_id)
        ->execute();

		if($negocio[0])
			return $negocio[0];
		else
			return "";
	}

}