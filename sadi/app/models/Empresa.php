<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Empresa extends Model
{
	public $neg_id;
	public $neg_nombre;

	public function getEstatusDetail()
	{
		if ($this->neg_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->neg_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->neg_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function getNegocio($neg_id)
	{
		// $agente=Agente::findFirstByage_id($age_id);
		// if($agente)
		// 	return $agente->age_nombre." ".$agente->age_primerapellido." ".$agente->age_segundoapellido;
		// else
		// 	return "";

		$negocio=Negocio::query()
        ->columns("neg_nombre")
        ->where('neg_id='.$neg_id)
        ->execute();
		// $aseguradora=Aseguradora::findFirstByase_id($ase_id);

		if($negocio[0])
			return $negocio[0];
		else
			return "";
	}

	public function NuevoRegistro($data,$id)
	{
		
		$negocio= new Negocio();
		

		$form = new NegocioForm;
		$form->NuevosCampos();
		if (!$form->isValid($data, $negocio)) {
			$this->error="error al validar";
			return false;
		}
		$negocio->neg_estatus=2;
		if ($negocio->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $negocio->neg_id;
		}	

	}

	public function EditarRegistro($data,$id)
	{
		/*Verifica si existe el registro*/
		$negocio = Negocio::findFirstByneg_id($data['neg_id']);
		if($negocio==true)
		{
			if($negocio->neg_estatus==1 || $negocio->neg_estatus==2)
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
		$form = new NegocioForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $negocio)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $area->usu_id=$id;
		if ($negocio->save()) 
        {
    		return true;
        }
        else
        {
        	return false;
        }		
	}
	
	public function FillSelect($incluyebaja=false)
	{
		$min=0;
		if($incluyebaja)
			$min=1;
		else
			$min=2;
		$neg = Negocio::find(array(
                "neg_estatus<=2 and neg_estatus>=:min:",
                'columns'=>array('neg_id',"neg_nombre"),
                'order'=>'neg_nombre',
                'bind' => array('min' => $min)
            ));
		return $neg;
	}

	public function getAlias($id)
	{
		$empresa=Empresa::findFirstByemp_id($id);
		if($empresa)
			return $empresa->emp_alias;
		else
			return "";
	}
	public function getGruId($emp_id){
		$gru_id = 0;

		$emp = Empresa::findFirstByemp_id($emp_id);
	
		if ($emp) {
			$gru_id = $emp->gru_id;
			if ($gru_id !== null) {
				return $gru_id;
			} 
		}
		return $gru_id;
	}
	
}