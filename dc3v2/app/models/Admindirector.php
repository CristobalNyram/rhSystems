<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Admindirector extends Model
{

	public function getDirector($id)
	{
		$director=Admindirector::findFirstByadr_id($id);
		if($director)
			return $director->adm_nombredirector.' '.$director->adm_primerapellidodirector.' '.$director->adm_segundoapellidodirector;
		else
			return "";
	}

	public function getFirma($id)
	{
		$director=Admindirector::findFirstByadr_id($id);
		if($director)
			return $director->adm_firma;
		else
			return "";
	}


}