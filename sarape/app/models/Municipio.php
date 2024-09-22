<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Municipio extends Model
{
	
	public function getEstatusDetail()
	{
		if ($this->mun_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->mun_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->mun_estatus < 1) 
		{
			return 'Eliminado';
		}
	}
	
	public function FillSelect($incluyebaja=false)
	{
		$min=0;
		if($incluyebaja)
			$min=1;
		else
			$min=2;
		$age = Agente::find(array(
                "age_estatus<=2 and age_estatus>=:min:",
                'columns'=>array('age_id',"CONCAT(age_nombre, ' ', age_primerapellido, ' ',age_segundoapellido) as nombre"),
                'order'=>'age_nombre',
                'bind' => array('min' => $min)
            ));
		return $age;
	}

	public function getNombre($id)
	{
		if($id==0){
			return "";
		}
		$reg=Municipio::findFirstBymun_id($id);
		if($reg)
			return $reg->mun_nombre;
		else
			return "";
	}
}