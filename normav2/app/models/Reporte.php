<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Reporte extends Model
{
	public $are_id;
	public $are_denominacion;
	public $are_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->are_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->are_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->are_estatus == 0) 
		{
			return '0';
		}
		if ($this->cur_estatus < 0) 
		{
			return '-1';
		}
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($id)
	{
		/*verifica si exite el registro*/
		$area=Areatematica::findFirstByare_id($data["are_id"]);
		
		if($area)
		{
			/*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
			
			if($area->are_estatus>=0)
			{
				$this->error="El ID ya se encuentra registrado";
				return false;
			}
		}
		else
		{
			//si no existe el registro se crea la clase
			$area= new Areatematica();
		}

		$form = new AreatematicaForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $area)) {
			$this->error="error al validar";
			return false;
		}
		// $area->usu_id=$id;
		if ($area->save() == false){
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
		$area = Areatematica::findFirstByare_id($data['are_id']);
		if($area==true)
		{
			if($area->are_estatus==1 || $area->are_estatus==2)
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
		$form = new AreatematicaForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $area)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $area->usu_id=$id;
		if ($area->save()) 
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
		$area = Areatematica::find(array(
                "are_estatus<=2 and are_estatus>=:min:",
                'columns'=>array('are_id',"CONCAT(are_clave,' ',are_denominacion) as denominacion"),
                'order'=>'denominacion asc',
                'bind' => array('min' => $min)
            ));
		return $area;
	}
}