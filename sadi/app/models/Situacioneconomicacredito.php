<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla sitaucion economica
 */
class Situacioneconomicacredito extends Model
{

    public function NuevoRegistro($data){

        $registro_sec= new Situacioneconomicacredito();
        $registro_sec->sec_institucion=$data['sec_institucion_crear'];
        $registro_sec->sec_tipo=$data['sec_tipo_crear'];
        $registro_sec->sec_saldo=$data['sec_saldo_crear'];
        $registro_sec->sec_mensual=$data['sec_mensual_crear'];
        $registro_sec->sec_estatus=2;
        $registro_sec->sie_id=$data['sec_sie_id'];

        if($registro_sec->save())
        {
            return  $respuesta=['estado'=>2,'sec_id'=> $registro_sec->sec_id,'sie_id'=>$registro_sec->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }

    public function ActualizarRegistro($data){
        
        $this->sec_institucion=$data['sec_institucion_editar'];
        $this->sec_tipo=$data['sec_tipo_editar'];
        $this->sec_saldo=$data['sec_saldo_editar'];
        $this->sec_mensual=$data['sec_mensual_editar'];

        

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'sec_id'=> $this->sec_id,'sie_id'=>$this->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }


    }
    public function getTotalCreditosEspecifico($sie_id)
    {
        $sec= Situacioneconomicacredito::find(array('sec_estatus = 2 and sie_id='.$sie_id));
        
        $total=0;
        for ($i=0; $i <count($sec) ; $i++) { 
               $total=$total+$sec[$i]->sec_mensual;
        }
        return $total;

    }
    public function setUpdateCreditoEseEspecifico($situacion_eco_id,$total_creditos)
    {
        $sei=Situacioneconomica::findFirst($situacion_eco_id);
        $sei->sie_creditos=$total_creditos;

        if($sei->update())
            return  $respuesta=['estado'=>2];
        
        else
            return  $respuesta=['estado'=>-2];



    }
 
}