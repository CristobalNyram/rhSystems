<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Garantia
 */
class Garantia extends Model
{

    public function NuevoRegistro($data,$auth){
        $registro= new Garantia();
        $registro->gar_observacion=$data['gar_observacion'];
        $registro->gar_registro=date("Y-m-d H:i:s");
        $registro->gar_estatus=2;
        $registro->exc_id=$data['exc_id'];
        $registro->usu_id=$auth['id'];

        if($registro->save())
            return  $repuesta=['estado'=>2,'gar_id'=> $registro->gar_id,'exc_id'=> $registro->exc_id];
        else
            return  $repuesta=['estado'=>-2];
        
    }

    public function verificarLimiteGarantia($exc_id=0,$vac_id=0){
        $answer["estado"]=-2;
        $answer["mensaje"]="NO HAY ESPACIOS DISPONIBLES PARA MANDAR A GARANTÍA, YA SE SUPERÓ EL LÍMITE ESPACIOS DISPONIBLES";
        $registro_gar_vac = Garantia::query()
        ->leftjoin('Expedientecan','exc.exc_id=Garantia.exc_id','exc')
        ->where('exc.vac_id = ' . $vac_id.' AND Garantia.gar_estatus=2') 
        ->execute();

        $obj_vac=Vacante::findFirst($vac_id);

        if(!$obj_vac)
            $answer["estado"]=-2;

        $limite_gar=$obj_vac->vac_numero*2;

        if (!(count($registro_gar_vac ) >= $limite_gar)) {
            $answer["estado"]=2;
            $answer["mensaje"]="HAY ESPACIOS";
        }

        return $answer;


    }


}