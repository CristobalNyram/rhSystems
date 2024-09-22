<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla empresa
 */
class Centrotrabajo extends Model
{
	public $cen_id;
	public $cen_ubicacion;
	public $cen_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->cen_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->cen_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->cen_estatus == 0) 
		{
			return '0';
		}
		if ($this->cen_estatus < 0) 
		{
			return '-1';
		}
	}

	public function getLegal()
	{
		$representante=Representante::findFirstByrep_id($this->rep_idlegal);
		if($representante)
			return $representante->rep_nombre.' '.$representante->rep_primerapellido.' '.$representante->rep_segundoapellido;
		else
			return "";
	}

	public function getRepTrabajador()
	{
		$representante=Representante::findFirstByrep_id($this->rep_idtra);
		if($representante)
			return $representante->rep_nombre.' '.$representante->rep_primerapellido.' '.$representante->rep_segundoapellido;
		else
			return "";
	}

	
	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		
		$centro= new Centrotrabajo();
		

		$form = new CentrotrabajoForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $centro)) {
			$this->error="error al validar";
			return false;
		}
		// $curso->cur_id=$id;
		if ($centro->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return true;
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
		$centro = Centrotrabajo::find(array(
                "cen_estatus<=2 and cen_estatus>=:min:",
                'columns'=>array('cen_id','cen_ubicacion'),
                'order'=>'cen_ubicacion desc',
                'bind' => array('min' => $min)
            ));
		return $centro;
	}

}