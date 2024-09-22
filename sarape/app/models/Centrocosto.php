<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla centrocosto
 */
class Centrocosto extends Model
{
	public $cne_id;
	public $cne_nombre;
	public $cne_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un centro]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del centro]
	 */
	public function getEstatusDetail()
	{
		if ($this->cen_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->cen_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->cen_estatus == 0) 
		{
			return '0';
		}
		if ($this->cen_estatus < 0) 
		{
			return '-1';
		}
	}

}