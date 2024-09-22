<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Rol extends Model
{
	public $rol_id;
	public $rol_nombre;
	public $rol_descripcion;
	

	/**
	 * [getEstatusDetail Obtener el estado de un puesto]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del puesto]
	 */
	public function getEstatusDetail()
	{
		if ($this->rol_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->rol_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->rol_estatus == 0) 
		{
			return '0';
		}
		if ($this->rol_estatus < 0) 
		{
			return '-1';
		}
	}
	
	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla puesto]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		$rol= new Rol();
		
		$form = new RolForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $rol)) {
			$this->error="error al validar";
			return false;
		}
		$rolultimo = Rol::find(array(
			'columns'=>array('rol_id','rol_nombre'),
			'order'=>'rol_id desc'
		));
		$rol_id=$rolultimo[0]->rol_id+1;
		$rol->rol_id=$rol_id;
		if ($rol->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{

			$listamenu = Menu::find(array(
            "men_estatus<=2 and men_estatus>=1"
            ));
			// $listamenu=Menu::all();
			for ($i=0; $i < count($listamenu); $i++)
			{
				$relpuemenu=new Relrolmenu();
				$relpuemenu->men_id=$listamenu[$i]->men_id;
				$relpuemenu->rol_id=$rol_id;
				$relpuemenu->rrm_estatus=0;
				if(!$relpuemenu->save())
				{
					return false;
				}

			}
			return true;
		}
	}
	/**
	 * [EditarRegistro Editar un registro de la tabla puesto]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	public function EditarRegistro($data=0)
	{
		/*Verifica si existe el registro*/
		$rol = Rol::findFirstByrol_id($data['rol_id']);
		if($rol==true)
		{
			if($rol->rol_estatus==1 || $rol->rol_estatus==2)
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
		$form = new RolForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $rol)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        

		if ($rol->save()) 
        {
    		return true;
        }
        else
        {
        	return false;
        }
	}
	/**
	 * [FillSelect Seleccionar los registros de la tabla puesto]
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
		$rol = Rol::find(array(
                "rol_estatus<=2 and rol_estatus>=:min:",
                'columns'=>array('rol_id','rol_nombre'),
                'order'=>'rol_nombre',
                'bind' => array('min' => $min)
            ));
		return $rol;
	}

	/**
	 * [verificar Verifica que el puesto tenga acceso a un menú específico]
	 * @param  $menu, $puesto 	[id del menú, id del puesto]
	 * @return [boolean] 	[tiene o no acceso]
	 */
	public function verificar($menu,$rol)
    {
        $existe=Relrolmenu::query()
            ->where('men_id='.$menu.' and rol_id='.$rol)
            ->execute();
        if (count($existe)>0) {
            if($existe[0]->rrm_estatus==0)
            {
            	return 0;
            }
            return 1;
        }
        return 0;
    }

}