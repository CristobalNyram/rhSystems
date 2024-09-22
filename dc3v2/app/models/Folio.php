<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Folio extends Model
{

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
			$folio= new Folio();
		// }

		// $form = new TrabajadorForm;
		// $form->NuevosCampos();
		// if (!$form->isValid($data, $trabajador)) {
		// 	$this->error="error al validar";
		// 	return false;
		// }
		// $area->usu_id=$id;
		$folio->fol_matricula=$data['fol_matricula'];
		if ($folio->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $folio->fol_id;
		}	

	}

}