<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Pais extends Model
{
	public $pai_id;
	public $pai_nombre;
	public $pai_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->pai_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->pai_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->pai_estatus == 0) 
		{
			return '0';
		}
		if ($this->pai_estatus < 0) 
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
		$pais=Pais::findFirstBypai_id($data["pai_id"]);
		
		if($pais)
		{
			/*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
			
			if($pais->pai_estatus>=0)
			{
				$this->error="El ID ya se encuentra registrado en algún pais";
				return false;
			}
		}
		else
		{
			//si no existe el registro se crea la clase
			$pais= new Pais();
		}

		$form = new PaisForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $pais)) {
			$this->error="error al validar";
			return false;
		}
		$pais->usu_id=$id;
		if ($pais->save() == false){
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
		$pais = Pais::findFirstBypai_id($data['pai_id']);
		if($pais==true)
		{
			if($pais->pai_estatus==1 || $pais->pai_estatus==2)
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
		$form = new PaisForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $pais)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        $pais->usu_id=$id;
		if ($pais->save()) 
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
		$pais = Pais::find(array(
                "pai_estatus<=2 and pai_estatus>=:min:",
                'columns'=>array('pai_id','pai_nombre'),
                'order'=>'pai_nombre desc',
                'bind' => array('min' => $min)
            ));
		return $pais;
	}
}