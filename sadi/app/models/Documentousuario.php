<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Documentousuario extends Model
{
	public $doc_id;
	public $doc_nombre;

	public function getEstatusDetail($dou_estatus)
	{
		if ($dou_estatus == '-1') 
		{
			return 'ELIMINADO';
		}
		if ($dou_estatus == "1") 
		{
			return '<span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span>';
		}
		if ($dou_estatus == "2") 
		{
			return '<span class="pl-3 pr-3 pt-2 pb-2 badge badge-danger" id="badge_modal_resument_tipoestudio_2">DESACTUALIZADO</span>';
		}
		if ($dou_estatus == "3") 
		{
			return '<span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span>';
		}
	}

	public function NuevoRegistro($data)
	{
		
		$archivo= new Documentousuario();
		$archivo->dou_nombre=$data['doc_nombre'];
		$archivo->dou_estatus=$data['doc_estatus'];
		$archivo->usu_id=$data['usu_id'];
		$archivo->doc_id=$data['doc_id'];
		
		if ($archivo->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $archivo->dou_id;
		}	

	}

	
}