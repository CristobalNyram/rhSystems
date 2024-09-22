<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Instructor extends Model
{
	public $ins_id;
	public $ins_nombre;
	public $ins_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->ins_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->ins_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->ins_estatus == 0) 
		{
			return '0';
		}
		if ($this->ins_estatus < 0) 
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
		$instructor=Instructor::findFirstByins_id($data["ins_id"]);
		
		if($instructor)
		{
			/*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
			
			if($instructor->ins_estatus>=0)
			{
				$this->error="El ID ya se encuentra registrado";
				return false;
			}
		}
		else
		{
			//si no existe el registro se crea la clase
			$instructor= new Instructor();
		}

		$form = new InstructorForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $instructor)) {
			$this->error="error al validar";
			return false;
		}
		// $area->usu_id=$id;
		if ($instructor->save() == false){
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
		$instructor = Instructor::findFirstByins_id($data['ins_id']);
		if($instructor==true)
		{
			if($instructor->ins_estatus==1 || $instructor->ins_estatus==2)
			{
				
			}
			else
			{
				$this->error[0]=" NO existente";
				return false;
			}
		}
		else
		{
			$this->error[0]=" NO existente";
			return false;
		}
		/*Valida y mueve los datos a la clase*/
		$form = new InstructorForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $instructor)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $area->usu_id=$id;
		if ($instructor->save()) 
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
		$ins = Instructor::find(array(
                "ins_estatus<=2 and ins_estatus>=:min:",
                'columns'=>array('ins_id',"CONCAT_WS(' ',ins_nombre,ins_primerapellido,ins_segundoapellido) as nombre"),
                'order'=>'nombre asc',
                'bind' => array('min' => $min)
            ));
		return $ins;
	}
}