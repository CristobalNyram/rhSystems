<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Participante extends Model
{
	public $par_id;
	
	public $par_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->par_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->par_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->par_estatus == 0) 
		{
			return '0';
		}
		if ($this->par_estatus < 0) 
		{
			return '-1';
		}
	}

	public function getNombreparti()
	{
		$trabajador=Trabajador::findFirstBytra_id($this->tra_id);
		if($trabajador)
			return $trabajador->tra_nombre.' '.$trabajador->tra_primerapellido.' '.$trabajador->tra_segundoapellido;
		else
			return "";
	}

	public function getEmpresa()
	{
		$empresa=Empresa::findFirstByemp_id($this->emp_id);
		if($empresa)
			return $empresa->emp_razonsocial;
		else
			return "";
	}

	public function getCentrotrabajo()
	{
		$centro=Centrotrabajo::findFirstBycen_id($this->cen_id);
		if($centro)
			return $centro->cen_ubicacion;
		else
			return "";
	}
	
	public function getCURP()
	{
		$trabajador=Trabajador::findFirstBytra_id($this->tra_id);
		if($trabajador)
			return $trabajador->tra_curp;
		else
			return "";
	}
	public function getOcupacion()
	{
		// $trabajador=Trabajador::findFirstBytra_id($this->tra_id);
		$ocupacion=Ocupacion::findFirstByocu_id($this->ocu_id);
		if($ocupacion)
			return $ocupacion->ocu_clave.'-'.$ocupacion->ocu_denominacion;
		else
			return "";
	}

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		/*verifica si exite el registro*/
		// $trabajador=Areatematica::findFirstBytra_id($data["are_id"]);
		
		// if($trabajador)
		// {
		// 	si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera
			
		// 	if($trabajador->are_estatus>=0)
		// 	{
		// 		$this->error="El ID ya se encuentra registrado";
		// 		return false;
		// 	}
		// }
		// else
		// {
			//si no existe el registro se crea la clase
			$participante= new Participante();
		// }

		$form = new ParticipanteForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $participante)) {
			$this->error="error al validar";
			return false;
		}
		// $area->usu_id=$id;
		if ($participante->save() == false){
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