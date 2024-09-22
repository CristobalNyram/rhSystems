<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla empresa
 */
class Verificaciones extends Model
{
	public $cne_id;
	public $cne_nombre;
	public $cne_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->ver_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->ver_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->ver_estatus == 0) 
		{
			return '0';
		}
		if ($this->ver_estatus < 0) 
		{
			return '-1';
		}
	}

}