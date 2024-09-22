<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Documento extends Model
{
	public $cat_id;
	public $cat_nombre;

	public function getEstatusDetail()
	{
		if ($this->doc_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->doc_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->doc_estatus < 1) 
		{
			return 'Eliminado';
		}
	}
}