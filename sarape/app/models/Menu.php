<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla menu
 */
class Menu extends Model
{
	public $men_id;
	public $men_controlador;
	public $men_accion;
	public $men_titulo;
	public $men_estatus;

	/**
	 * [getEstatusDetail Obtener el estado de un menu]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del menu]
	 */
	public function getEstatusDetail()
	{
		if ($this->men_estatus == 1) 
		{
			return '1';
		}
		if ($this->men_estatus == 2) 
		{
			return '2';
		}
		if ($this->men_estatus == 0) 
		{
			return '0';
		}
		if ($this->men_estatus < 0) 
		{
			return '-1';
		}
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla menu]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		$menu= new Menu();
		
		$form = new MenuForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $menu)) {
			$this->error="error al validar";
			return false;
		}
		$menuultimo = Menu::find(array(
                'columns'=>array('men_id','men_titulo'),
                'order'=>'men_id desc'
            ));
		$men_id=$menuultimo[0]->men_id+1;
		$menu->men_id=$men_id;
		if ($menu->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{

			$listarol = Rol::find(array(
            "rol_estatus<=2 and rol_estatus>=1"
            ));
			// $listamenu=Menu::all();
			for ($i=0; $i < count($listarol); $i++)
			{
				$relrolmenu=new Relrolmenu();
				$relrolmenu->men_id=$men_id;
				$relrolmenu->rol_id=$listarol[$i]->rol_id;
				// $relrolmenu->pue_id=$pue_id;
				$relrolmenu->rrm_estatus=0;
				if(!$relrolmenu->save())
				{
					return false;
				}

			}
			return true;
		}

	}
	/**
	 * [EditarRegistro Editar un registro de la tabla menu]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro,id del menu a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	public function EditarRegistro($data,$id)
	{
		
	}

}