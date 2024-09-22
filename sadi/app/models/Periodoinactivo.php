<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla   
 */
class Periodoinactivo extends Model
{
    public function NuevoRegistro($data){
        $registro_per= new Periodoinactivo();
        $registro_per->per_motivo=$data['per_motivo_crear'];
        $registro_per->per_fecha=$data['per_fecha_crear'];
        $registro_per->per_estatus=2;
        $registro_per->sel_id=$data['per_sel_id'];


 


        
        if($registro_per->save()){
            return  $repuesta=['estado'=>2,'per_id'=> $registro_per->per_id,'sel_id'=> $registro_per->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }

    public function ActualizarRegistro($data){
        $this->per_motivo=$data['per_motivo_editar'];
        $this->per_fecha=$data['per_fecha_editar'];


        
        if($this->update()){
            return  $repuesta=['estado'=>2,'per_id'=> $this->per_id,'sel_id'=> $this->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }

}