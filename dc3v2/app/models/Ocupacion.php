<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Ocupacion extends Model
{
	public $ocu_id;
	public $ocu_denominacion;
	public $ocu_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->ocu_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->ocu_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->ocu_estatus == 0) 
		{
			return '0';
		}
		if ($this->ocu_estatus < 0) 
		{
			return '-1';
		}
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data,$id)
	{
		/*verifica si exite el registro*/
		// $ocupacion=Ocupacion::findFirstByocu_id($data["ocu_id"]);
		
		// if($ocupacion)
		// {
		// 	si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera
			
		// 	if($ocupacion->ocu_estatus>=0)
		// 	{
		// 		$this->error="El ID ya se encuentra registrado en algún ocupacion";
		// 		return false;
		// 	}
		// }
		// else
		// {
			//si no existe el registro se crea la clase
			$ocupacion= new Ocupacion();
		// }

		$form = new OcupacionForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $ocupacion)) {
			$this->error="error al validar";
			return false;
		}
		// $ocupacion->ocu_id=$id;
		if ($ocupacion->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return true;
		}	

	}
	/**
	 * [EditarRegistro Editar un registro de la tabla pais]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro,id del pais a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	public function EditarRegistro($data,$id)
	{
		/*Verifica si existe el registro*/
		$ocupacion = Ocupacion::findFirstByocu_id($data['ocu_id']);
		if($ocupacion==true)
		{
			if($ocupacion->ocu_estatus==1 || $ocupacion->ocu_estatus==2)
			{
				
			}
			else
			{
				$this->error[0]="Usuario NO existente";
				return false;
			}
		}
		else
		{
			$this->error[0]="Usuario NO existente";
			return false;
		}
		/*Valida y mueve los datos a la clase*/
		$form = new OcupacionForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $ocupacion)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $ocupacion->usu_id=$id;
		if ($ocupacion->save()) 
        {
    		return true;
        }
        else
        {
        	return false;
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
		$ocupacion = Ocupacion::find(array(
                "ocu_estatus<=2 and ocu_estatus>=:min:",
                'columns'=>array('ocu_id','ocu_denominacion'),
                'order'=>'ocu_denominacion desc',
                'bind' => array('min' => $min)
            ));
		return $ocupacion;
	}
}