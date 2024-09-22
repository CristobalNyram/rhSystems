<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Tipo pago
 */
class Tipopago extends Model
{
	public function getEstatusDetail()
	{
		if ($this->tpg_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->tpg_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->tpg_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getTipopago($reg_id)
	{
		$registro=TipoPago::query()
        ->columns("tpg_nombre")
        ->where('tpg_id='.$reg_id)
        ->execute();

		if($registro[0])
			return $registro[0];
		else
			return "";
	}
}