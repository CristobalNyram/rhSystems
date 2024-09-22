<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Curso extends Model
{
	public $cur_id;
	public $cur_nombre;
	public $cur_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->cur_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->cur_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->cur_estatus == 0) 
		{
			return '0';
		}
		if ($this->cur_estatus < 0) 
		{
			return '-1';
		}
	}

	public function getTipo()
	{
		if ($this->cur_tipo == 2) 
		{
			return 'Externo';
		}
		if ($this->cur_tipo == 1) 
		{
			return 'Interno';
		}
		// if ($this->cur_tipo == 0) 
		// {
			return 'Error';
		// }
		
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data,$id)
	{
		/*verifica si exite el registro*/
		// $curso=Curso::findFirstBycur_id($data["cur_id"]);
		
		// if($curso)
		// {
			/*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
			
			// if($curso->cur_estatus>=0)
			// {
			// 	$this->error="El ID ya se encuentra registrado en algún curso";
			// 	return false;
			// }
		// }
		// else
		// {
			//si no existe el registro se crea la clase
			$curso= new Curso();
		// }

		$form = new CursoForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $curso)) {
			$this->error="error al validar";
			return false;
		}
		// $curso->cur_id=$id;
		if ($curso->save() == false){
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
		$curso = Curso::findFirstBycur_id($data['cur_id']);
		if($curso==true)
		{
			if($curso->cur_estatus==1 || $curso->cur_estatus==2)
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
		$form = new CursoForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $curso)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $curso->usu_id=$id;
		if ($curso->save()) 
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
		$curso = Curso::find(array(
                "cur_estatus<=2 and cur_estatus>=:min:",
                'columns'=>array('cur_id','cur_nombre'),
                'order'=>'cur_nombre desc',
                'bind' => array('min' => $min)
            ));
		return $curso;
	}
}