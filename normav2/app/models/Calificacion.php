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


		//estas respuestas corresponden a el cuestionario de clima
		/*
		totalmente de acuerdo..=5
		parcialmente de acuerdo =4
		*/
		if ($opcion == 4) 
		{
			switch ($valor)
            {
              
                case 1:
                	$r=18;
                	break;
                case 2:
                	$r=17;
                	break;
                case 3:
                	$r=16;
                	break;
                case 4:
                	$r=15;
                	break;
				 case 5:
                	$r=14;
                	break;	
            }
		}

		//repuestas relacionadas al tiempo que lleva en la empresa
		if ($opcion == 5) 
		{
			switch ($valor)
            {
              
                case 1:
                	$r=21;
                	break;
                case 2:
                	$r=20;
                	break;
                case 3:
                	$r=19;
                	break;
            }
		}
		//preguntas relacioandas a su edad 
		if ($opcion == 6) 
		{
			switch ($valor)
            {
              
                case 1:
                	$r=24;
                	break;
                case 2:
                	$r=23;
                	break;
                case 3:
                	$r=22;
                	break;
          
            }
		}


		//pregutas relacioandas con comentarios abiertas
		if ($opcion == 7) 
		{
			switch ($valor)
            {
              
                case 1:
                	$r=27;
                	break;
                case 2:
                	$r=26;
                	break;
                case 3:
                	$r=25;
                	break;
          
            }
		}
		return $r;
	}

	


}