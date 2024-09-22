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

	public function NuevoRegistro($data,$usu)
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
		$max=Folio::maximum(array("column" => "fol_id"));
		$random= rand(21, 250);
		$folio->fol_id=$max+$random;

		if (trim($data['fol_matricula'])!="") {
			$folio->fol_matricula=$data['fol_matricula'];
		}
		$folio->fol_nombre=$data['fol_nombre'];
		$folio->fol_primerapellido=$data['fol_primerapellido'];
		$folio->fol_segundoapellido=$data['fol_segundoapellido'];
		$folio->fol_correo=$data['fol_correo'];
		$folio->fol_estatus=2;	
		$folio->usu_id=$usu;

		$folio->fol_area=$data['fol_area'];
        $folio->fol_puesto=$data['fol_puesto'];
		
		if(!empty($data['emp_id']))
        {
			$folio->emp_id=$data['emp_id'];
		}
		
		
		if ($folio->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $folio->fol_id;
		}	

	}
	public function getCargoInfoPorSiMismo($fol_id,$campos_a_solicitar=[]){
		$answer['estatus']=-2;
        $answer['mensaje']='';
		$answer['falta_cargar_info']=-2;
		$answer['data']=[];
		$campos=[];

		if (empty($campos_a_solicitar)) {
			$campos = ['fol_nombre', 'fol_primerapellido', 'fol_segundoapellido', 'fol_correo', 'emp_id'];
		}else{
			$campos =$campos_a_solicitar;
		}

		$folio = Folio::findFirstByfol_id($fol_id);
		if ($folio) {
			$answer['data']=$folio;
			$answer['estatus']=2;

			// validamos los campos que estan vacios ini

			#fol_nombre,fol_primerapellido,fol_segundoapellido
			#fol_correo,fol_area,fol_puesto,emp_id
			foreach ($campos as $campo) {
				if (empty($folio->$campo)) {
					$answer['falta_cargar_info'] = 2;
					break;
				} elseif ($campo === 'emp_id' && ($folio->$campo == -1 || $folio->$campo == null || $folio->$campo == -2 || $folio->$campo === '')) {
					// Validar que emp_id no sea -1, null o vacío
					$answer['falta_cargar_info'] = 2;
					break;
				}
			}
			if ($folio->fol_partactualizo!=1) {
				$answer['falta_cargar_info'] = 2;
			}



		}
			
		return $answer;
	}
	public function ActualizarGeneralByCliente($data, $auth = [], $campos_a_solicitar = []) {
		$answer['estado'] = -2;
		$answer['mensaje'] = 'error';
	
		if (empty($campos_a_solicitar)) {
			$campos_a_solicitar = ['fol_nombre', 'fol_primerapellido', 'fol_segundoapellido', 'fol_correo', 'emp_id'];
		}
	
		foreach ($campos_a_solicitar as $campo) {
			if (array_key_exists($campo, $data) && (!empty($data[$campo]) || $data[$campo] === 0 || $data[$campo] === '0')) {
				if (property_exists($this, $campo)) {
					$this->{$campo} = $data[$campo];
				}
			}
		}
		$dateTime = new DateTime(); 
		$this->fol_fechaactpart = $dateTime->format('Y-m-d H:i:s');;
		$this->fol_partactualizo = 1;
		if ($this->update()) {
			$answer['estado'] = 2;
			$answer['mensaje'] = 'ok';
		} else {
			$answer['estado'] = -2;
			$answer['mensaje'] = 'error';
		}
		return $answer;
	}
	
	

}