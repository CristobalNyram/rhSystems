<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Nivelestudio extends Model
{
    public function getNombreNivelEstudio($id)
	{
		if($id==0){
			return "ERROR";
		}
		$nivelestudio=Nivelestudio::findFirstByniv_id($id);
		if($nivelestudio)
			return $nivelestudio->niv_nombre;
		else
			return "";
	}
}