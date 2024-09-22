<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Usuariotipoest extends Model
{

    /**
	 * [NuevoRegistro Crea un nuevo registro de la tabla usuariotipoest]
	 * @param  $data [datos del ajax con los datos para el registro] [$usu_id pertenece al $id del usuario que se le asigna este tiposte ] [$ultimo_usu_id del usuario que está creando este creado este registro ]
	 * @return [boolean][Tuvo éxito el registro o no(true-false) y ]  [ute_id][id del registro de la tabla ] 	
	 */
	public function NuevoRegistro($data,$usu_id,$ultimo_usu_id)
	{
        $usuariotipo = new Usuariotipoest();
        $usuariotipo->usu_id= $usu_id;
        $usuariotipo->tip_id= $data['tip_id'];
        $usuariotipo->ute_honorario= $data['ute_honorario'];
        $usuariotipo->ute_honorario2= $data['ute_honorario2'];
        $usuariotipo->ute_honorario3= $data['ute_honorario3'];
        $usuariotipo->ute_estatus=2;
		$usuariotipo->ultimousu_id=$ultimo_usu_id;

        if ($usuariotipo->save() == false){
			$this->error='Error al guardar el registro de los honorario';
			return  ["respuesta"=> -1];
		}
		else{
			return ["respuesta"=> 1,'ute_id'=>$usuariotipo->ute_id];
		}
    }

	public function verificarHonorarioActivoAcordeATipoFormatoEstudio($inv_id,$tip_id){
		$answer['estado']=false;

		$data=Usuariotipoest::query()
		->where('tip_id='.$tip_id.' AND usu_id='.$inv_id.' AND ute_estatus=2')
		->execute();
		if(count($data)>0){
			$answer['estado']=true;
			$answer['data']=$data[0];

		}

		return $answer;


	}


}