<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla documento
 */
class Documento extends Model
{
	public $doc_id;
	
	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla documento]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean]  	[Tuvo éxito el registro o no(true-false)]
	 */
	public function NuevoRegistro($data)
	{
		$doc= new Documento();
		

		$form = new DocumentoForm;
		$form->TodosCampos();
		if (!$form->isValid($data,$doc)) {
			$this->error="error al validar";
			return false;
		}

		if ($doc->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return true;
		}
	}
}