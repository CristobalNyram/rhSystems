<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla empresa
 */
class Representante extends Model
{
	public $rep_id;
	public $rep_nombre;
	public $rep_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->rep_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->rep_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->rep_estatus == 0) 
		{
			return '0';
		}
		if ($this->rep_estatus < 0) 
		{
			return '-1';
		}
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		
		$representante= new Representante();
		
		$form = new RepresentanteForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $representante)) {
			$this->error="error al validar";
			return false;
		}
		// $curso->cur_id=$id;
		if ($representante->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $representante->rep_id;
		}	

	}

	/**
	 * [FillSelect Seleccionar los registros de la tabla pais]
	 * @param  $incluyebaja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
	public function FillSelect($incluyebaja=false)
	{
		$min=0;
		if($incluyebaja)
			$min=1;
		else
			$min=2;
		$representante = Representante::find(array(
                "rep_estatus<=2 and rep_estatus>=:min:",
                'columns'=>array('rep_id','rep_nombre'),
                'order'=>'rep_nombre desc',
                'bind' => array('min' => $min)
            ));
		return $representante;
	}

}