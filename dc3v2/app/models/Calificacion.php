<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Calificacion extends Model
{

	public function getCalificacion($opcion, $valor)
	{
		$r=0;
		if ($opcion == 1) 
		{
			switch ($valor)
            {
                case 0:
                	$r=2;
                    break;
                case 1:
                	$r=3;
                	break;
                default:
                    $r=1;
                    break;
            }
		}
		if ($opcion == 2) 
		{
			switch ($valor)
            {
                case 0:
                	$r=4;
                    break;
                case 1:
                	$r=5;
                	break;
                case 2:
                	$r=6;
                	break;
                case 3:
                	$r=7;
                	break;
                case 4:
                	$r=8;
                	break;
            }
		}
		if ($opcion == 3) 
		{
			switch ($valor)
            {
                case 0:
                	$r=13;
                    break;
                case 1:
                	$r=12;
                	break;
                case 2:
                	$r=11;
                	break;
                case 3:
                	$r=10;
                	break;
                case 4:
                	$r=9;
                	break;
            }
		}
		return $r;
	}

	


}