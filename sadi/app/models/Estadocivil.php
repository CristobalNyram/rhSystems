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
	public function getNombreEstadoCivil($id)
	{
		if($id==0){
			return "ERROR";
		}
		$estadocivil=Estadocivil::findFirstByesc_id($id);
		if($estadocivil)
			return $estadocivil->esc_nombre;
		else
			return "";
	}
}