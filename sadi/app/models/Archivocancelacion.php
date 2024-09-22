<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Archivocancelacion extends Model
{

    public function NuevoRegistro($data)
	{
        $answer=array();
        $answer['estado']=false;
        $answer['acc_id']=0;
        $answer['acc_nombre']="";

		$archivo= new Archivocancelacion();
		$archivo->acc_nombre=$data['acc_nombre'];
		$archivo->acc_estatus=2;
		$archivo->ese_id=$data['ese_id'];
		$archivo->eca_id=$data['eca_id'];
		
		if ($archivo->save()){
            $answer['estado']=true;
            $answer['acc_id']=$archivo->acc_id;
            $answer['ese_id']=$archivo->ese_id;
            $answer['acc_nombre']=	$archivo->acc_nombre;
		
		}else {error_log("NO SE PUDO REGISTRAR EL ARCHIVO");}

        return $answer;

	}
	
	
	
}