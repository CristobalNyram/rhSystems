<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Administrador extends Model
{
	public $adm_id;
	public $adm_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->adm_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->adm_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->adm_estatus == 0) 
		{
			return '0';
		}
		if ($this->adm_estatus < 0) 
		{
			return '-1';
		}
	}

	public function getDefault()
	{
		if ($this->adm_default == 1) 
		{
			return 'Principal';
		}
		if ($this->adm_estatus == 2) 
		{
			return 'Secundario';
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
			$admin= new Administrador();
		// }

		$form = new AdministradorForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $admin)) {
			$this->error="error al validar";
			return false;
		}
		// $curso->cur_id=$id;
		if ($admin->save() == false){
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
		$admin = Administrador::findFirstByadm_id($data['adm_id']);
		if($admin==true)
		{
			if($admin->adm_estatus==1 || $admin->adm_estatus==2)
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
		if($admin->adm_default==1)
		{
			$data['adm_default']=1;
		}
		$default= Administrador::findFirstByadm_default('1');
        if($default->adm_id!=$admin->adm_id){
        	$default->adm_default=0;
        	$default->save();
    	}
		$form = new AdministradorForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $admin)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $area->usu_id=$id;
		if ($admin->save()) 
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
		$admin = Administrador::find(array(
                "adm_estatus<=2 and adm_estatus>=:min:",
                'columns'=>array('adm_id',"adm_nombre"),
                'order'=>'adm_nombre asc',
                'bind' => array('min' => $min)
            ));
		return $admin;
	}
}