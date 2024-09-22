<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Insigniausuario extends Model
{
	/*public $pai_id;
	public $pai_nombre;
	public $pai_estatus;*/
	public $clave;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->inu_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->inu_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->inu_estatus < 0) 
		{
			return '-1';
		}
	}

	public function getProcesoDetail()
	{
		if ($this->inu_proceso == 1) 
		{
			return 'Otorgada';
		}
		if ($this->inu_proceso == 2) 
		{
			return 'Incentivo solicitado';
		}
		if ($this->inu_proceso == 3) 
		{
			return 'Incentivo otorgado';
		}
	}

	public function getUsuario()
	{
		$usuario=Usuario::findFirstByusu_id($this->usu_id);
		return $usuario->usu_nombre." ".$usuario->usu_apellidop;
	}

	public function getUsuariootorga()
	{
		$usuario=Usuario::findFirstByusu_id($this->usu_idotorga);
		return $usuario->usu_nombre." ".$usuario->usu_apellidop;
	}

	public function getInsignia()
	{
		$insignia=Insignia::findFirstByins_id($this->ins_id);
		return $insignia->ins_nombre;
	}

	public function getTipo()
	{
		$insignia=Insignia::findFirstByins_id($this->ins_id);
		return $insignia->ins_tipo;
	}

	public function getImagen()
	{
		$insignia=Insignia::findFirstByins_id($this->ins_id);
		return $insignia->ins_imagen;
	}

	public function getIncentivo()
	{
		$insignia=Insignia::findFirstByins_id($this->ins_id);
		return $insignia->ins_incentivo;
	}

	public function getDescriptionDetail()
	{
		$insignia=Insignia::findFirstByins_id($this->ins_id);
		return $insignia->ins_descripcion;
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla insignia]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	// public function NuevoRegistro($data,$id)
	// {
	// 	/*verifica si exite el registro*/
	// 	$insignia=false;
		
	// 	if($insignia)
	// 	{
	// 		/*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
			
	// 		if($insignia->ins_estatus>=0)
	// 		{
	// 			$this->error="Estos puntos ya se encuentran registrados";
	// 			return false;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		//si no existe el registro se crea la clase
	// 		$insignia= new Insignia();
	// 	}

	// 	$form = new InsigniaForm;
	// 	$form->NuevosCampos();
	// 	if (!$form->isValid($data, $insignia)) 
	// 	{
	// 		$this->error="error al validar";
	// 		return false;
	// 	}
	// 	$insignia->ins_estatus=2;
	// 	if ($insignia->save() == false)
	// 	{
	// 		$this->error='Error al guardar el registro';
	// 		return false;
	// 	}
	// 	else
	// 	{
	// 		$clave=$insignia->ins_id;
	// 		return $insignia->ins_id;
	// 	}	

	// }
	/**
	 * [EditarRegistro Editar un registro de la tabla pais]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro,id del pais a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	// public function EditarRegistro($data,$id)
	// {
	// 	/*Verifica si existe el registro*/
	// 	$insignia=Insignia::findFirstByins_id($data["ins_id"]);
	// 	if($insignia)
	// 	{
	// 		if($insignia->ins_estatus>=0)
	// 		{
				
	// 		}
	// 		else
	// 		{
	// 			$this->error="Insignia NO existente";
	// 			return false;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$this->error="Insignia NO existentes";
	// 		return false;
	// 	}
	// 	Valida y mueve los datos a la clase
	// 	$form = new InsigniaForm;
	// 	$form->EditarCampos();
	// 	if (!$form->isValid($data, $insignia)) 
	// 	{
	// 		$this->error="error al validar";
	// 		return false;
	// 	}
	// 	// $insignia->via_producto=$data["via_producto"];
	// 	//$viaticos->usu_id=$id;
	// 	if ($insignia->save() == false)
	// 	{
	// 		$this->error='Error al guardar el registro';
	// 		return false;
	// 	}
	// 	else
	// 	{
	// 		return true;
	// 	}		
	// }
	// public function getcliente()
	// {
	// 	$proyecto=Proyecto::findFirstBypro_id($this->pro_id);
	// 	if($proyecto)
	// 	{
	// 		$empresa=Empresa::findFirstByemp_id($proyecto->emp_id);
	// 		if($empresa)
	// 			return $empresa->emp_nombre;
	// 		else
	// 			return "";
	// 	}
	// 	else
	// 	{
	// 		return "";
	// 	}
	// }
	// public function getproyecto()
	// {
	// 	$proyecto=Proyecto::findFirstBypro_id($this->pro_id);
	// 	if($proyecto)
	// 		return $proyecto->pro_nombre;
	// 	else
	// 		return "";
	// }

	
}