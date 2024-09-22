<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Cursootorgado extends Model
{
	public $cuo_id;
	public $cuo_clave;
	public $cuo_estatus;
	
	/**
	 * [getEstatusDetail Obtener el estado de un pais]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del pais]
	 */
	public function getEstatusDetail()
	{
		if ($this->cuo_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->cuo_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->cuo_estatus == 0) 
		{
			return '0';
		}
		if ($this->cuo_estatus < 0) 
		{
			return '-1';
		}
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

	public function getCurso()
	{
		$curso=Curso::findFirstBycur_id($this->cur_id);
		if($curso)
			return $curso->cur_nombre;
		else
			return "";
	}

	public function getCantidadParticipantes()
	{
		$participante=new Builder();
            $participante=$participante
            ->columns(array('cuo_id'))
            ->addFrom('Participante','p')
            ->where('par_estatus=2 and cuo_id='.$this->cuo_id)
            ->getQuery()
            ->execute();
		return $participante->count();	
	}

	

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla pais]
	 * @param  $data 		[datos del ajax con los datos para el registro,id de quien crea el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data,$id)
	{
		$curso= new Cursootorgado();
		
		$form = new CursootorgadoForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $curso)) {
			$this->error="error al validar";
			return false;
		}
		$rl=null;
		$rt=null;
		if($data['cen_id']==0){
			$empresa = Empresa::findFirstByemp_id($data['emp_id']);
			$rl=$empresa->rep_idlegal;
			$rt=$empresa->rep_idtra;
		}
		else
		{
			$centro = Centrotrabajo::findFirstBycen_id($data['cen_id']);
			$rl=$centro->rep_idlegal;
			$rt=$centro->rep_idtra;
		}

		// $administrador = Administrador::findFirstByadm_id($data['adm_id']);

		// $curso->adr_id= $administrador->adr_id;
		$curso->rep_idlegal=$rl;
		$curso->rep_idtra=$rt;
		$curso->usu_ultmod=$id;

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
		$curso = Cursootorgado::findFirstBycuo_id($data['cuo_id']);
		if($curso==true)
		{
			if($curso->cuo_estatus==1 || $curso->cuo_estatus==2)
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
		$form = new CursootorgadoForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $curso)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        
  //       $rl=null;
		// $rt=null;
		// if($data['cen_id']==0){
		// 	$empresa = Empresa::findFirstByemp_id($data['emp_id']);
		// 	$rl=$empresa->rep_idlegal;
		// 	$rt=$empresa->rep_idtra;
		// }
		// else
		// {
		// 	$centro = Centrotrabajo::findFirstBycen_id($data['cen_id']);
		// 	$rl=$centro->rep_idlegal;
		// 	$rt=$centro->rep_idtra;
		// }

        // $administrador = Administrador::findFirstByadm_id($data['adm_id']);
		// $curso->adr_id= $administrador->adr_id;
		$curso->usu_ultmod=$id;

		$curso->rep_idlegal=$curso->rep_idlegal;
		$curso->rep_idtra=$curso->rep_idtra;
		
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
		$cuo = Cursootorgado::find(array(
                "cuo_estatus<=2 and cuo_estatus>=:min:",
                'columns'=>array('cuo_id','cuo_id'),
                'order'=>'cuo_id desc',
                'bind' => array('min' => $min)
            ));
		return $cuo;
	}
}