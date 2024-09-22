<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla empresa
 */
class Empresa extends Model
{
	public $emp_id;
	public $emp_razonsocial;
	public $emp_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->emp_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->emp_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->emp_estatus == 0) 
		{
			return '0';
		}
		if ($this->emp_estatus < 0) 
		{
			return '-1';
		}
	}

	public function getCantidadCentros()
	{
		$centros=new Builder();
            $centros=$centros
            ->columns(array('emp_id'))
            ->addFrom('Centrotrabajo','p')
            ->where('cen_estatus=2 and emp_id='.$this->emp_id)
            ->getQuery()
            ->execute();
		return $centros->count();	
	}

	public function getLegal()
	{
		$representante=Representante::findFirstByrep_id($this->rep_idlegal);
		if($representante)
			return $representante->rep_nombre.' '.$representante->rep_primerapellido.' '.$representante->rep_segundoapellido;
		else
			return "";
	}

	public function getRepTrabajador()
	{
		$representante=Representante::findFirstByrep_id($this->rep_idtra);
		if($representante)
			return $representante->rep_nombre.' '.$representante->rep_primerapellido.' '.$representante->rep_segundoapellido;
		else
			return "";
	}


	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data,$id)
	{
		
		$empresa= new Empresa();
		

		$form = new EmpresaForm;
		$form->CrearCampos();
		if (!$form->isValid($data, $empresa)) {
			$this->error="error al validar";
			return false;
		}
		// $curso->cur_id=$id;
		if ($empresa->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $empresa->emp_id;
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
		$empresa = Empresa::findFirstByemp_id($data['emp_id']);
		if($empresa==true)
		{
			if($empresa->emp_estatus==1 || $empresa->emp_estatus==2)
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
		$form = new EmpresaForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $empresa)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $curso->usu_id=$id;
		if ($empresa->save()) 
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
		$empresa = Empresa::find(array(
                "emp_estatus<=2 and emp_estatus>=:min:",
                'columns'=>array('emp_id','emp_razonsocial'),
                'order'=>'emp_razonsocial desc',
                'bind' => array('min' => $min)
            ));
		return $empresa;
	}

}