<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Referenciafamiliar
 */
class Referenciafamiliar extends Model
{
 

    public function NuevoRegistroFormatoTruper($data){
        $registro_ref= new Referenciafamiliar();
        $registro_ref->ref_nombre=$data['ref_nombre'];
        $registro_ref->ref_edad=$data['ref_edad'];
        $registro_ref->ref_telefono=$data['ref_telefono'];
        $registro_ref->ref_direccion=$data['ref_direccion'];
        $registro_ref->ref_ocupacion=  $data['ref_ocupacion'] ;
        $registro_ref->ref_parentesco=  $data['ref_parentesco'] ;
        $registro_ref->ref_conocesuempleo= $data['ref_conocesuempleo'] ;
     

        $registro_ref->ref_lorecomienda=   $data['ref_lorecomienda'] ;
        $registro_ref->ref_comentario=   $data['ref_comentario'] ;
        $registro_ref->sep_id=   $data['sep_id'] ;

       
        
        $registro_ref->ref_estatus=   2 ;



        
        if($registro_ref->save()){
            return  $repuesta=['estado'=>2,'ref_id'=> $registro_ref->ref_id,'sep_id'=> $registro_ref->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }

    public function ActualizarRegistroFormatoTruper($data){


        $this->ref_nombre=$data['ref_nombre'];
        $this->ref_edad=$data['ref_edad'];
        $this->ref_telefono=$data['ref_telefono'];
        $this->ref_direccion=$data['ref_direccion'];
        $this->ref_ocupacion=  $data['ref_ocupacion'] ;
        $this->ref_parentesco=  $data['ref_parentesco'] ;
        $this->ref_conocesuempleo= $data['ref_conocesuempleo'] ;
     

        $this->ref_lorecomienda=   $data['ref_lorecomienda'] ;
        $this->ref_comentario=   $data['ref_comentario'] ;
        
        if($this->update()){
            return  $repuesta=['estado'=>2,'ref_id'=> $this->ref_id,'sep_id'=> $this->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }

}