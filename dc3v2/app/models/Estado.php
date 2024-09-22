<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla estado
 */
class Estado extends Model
{
	public $est_id;
	public $est_nombre;
	public $est_estatus;
	public $pai_id;
	
	/**
	 * [getEstatusDetail Obtener el estado de un estado]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del estado]
	 */
	public function getEstatusDetail()
	{
		if ($this->est_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->est_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->est_estatus == 0) 
		{
			return '0';
		}
		if ($this->est_estatus < 0) 
		{
			return '-1';
		}
	}
	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla estado]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		$estado= new Estado();

		$form = new EstadoForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $estado)) {
			$this->error="error al validar";
			return false;
		}

		if ($estado->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return true;
		}
	}

	/**
	 * [EditarRegistro Editar un registro de la tabla estado]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro,id del estado a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	public function EditarRegistro($data)
	{
		/*Verifica si existe el registro*/
		$estado = Estado::findFirstByest_id($data['est_id']);
		if($estado==true)
		{
			if($estado->est_estatus==1 || $estado->est_estatus==2)
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
		$form = new EstadoForm;
		$form->EditarCampos();
        if (!$form->isValid($data,$estado)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        

		if ($estado->save()) 
        {
    		return true;
        }
        else
        {
        	return false;
        }	
	}
	/**
	 * [FillSelect Seleccionar los registros de la tabla estado]
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
		$estado = Estado::find(array(
                "est_estatus<=2 and est_estatus>=:min:",
                'columns'=>array('est_id','est_nombre'),
                'order'=>'est_nombre',
                'bind' => array('min' => $min)
            ));
		return $estado;
	}
}