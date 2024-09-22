<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;

/**
 * Modelo de la tabla Catcancelado
 */
class Catcancelado extends Model
{
    private $prefijo = "cac_id";
	public function getNombre($id=0)
	{

		if($id==0) {return "ERROR"; }

		$reg=Catcancelado::findFirstBycac_id($id);

		if($reg) return $reg->cac_nombre;
		else return "";
	}
}