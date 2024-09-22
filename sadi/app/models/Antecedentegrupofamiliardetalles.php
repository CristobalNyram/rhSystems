<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Antecedentegrupofamiliardetalles extends Model
{

    public function NuevoRegistro($data){

        $registro_agd= new Antecedentegrupofamiliardetalles();
        $registro_agd->agd_nombre=$data['agd_nombre_crear'];
         $registro_agd->agd_empresa=$data['agd_empresa_crear'];
         $registro_agd->agd_puesto=$data['agd_puesto_crear'];
        $registro_agd->agd_antiguedad=$data['agd_antiguedad_crear'];
        $registro_agd->agd_estatus=2;
        $registro_agd->agf_id=$data['agd_agf_id'];

        if($registro_agd->save())
        {
            return  $respuesta=['estado'=>2,'agd_id'=> $registro_agd->agd_id,'agf_id'=>$registro_agd->agf_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }

    public function ActualizarRegistro($data){
        
        $this->agd_nombre=$data['agd_nombre_editar'];
        $this->agd_empresa=$data['agd_empresa_editar'];
        $this->agd_puesto=$data['agd_puesto_editar'];
        $this->agd_antiguedad=$data['agd_antiguedad_editar'];

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'agd_id'=> $this->agd_id,'agf_id'=>$this->agf_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }


    }
    public function RegistroAutomaticoCargado($data,$ese_id)
    {       
        $answer=[];
        $modelo_antecedentegrupofamiliar=new Antecedentegrupofamiliar();
        $respuesta_modelo_antecedentegrupofamiliar= $modelo_antecedentegrupofamiliar->crearAutomaticoOTraerExistente($ese_id);

        if($respuesta_modelo_antecedentegrupofamiliar['estado']===2){
            $antecedentegrupofamiliardetalles_nuevo= new Antecedentegrupofamiliardetalles();
            $antecedentegrupofamiliardetalles_nuevo->agd_nombre=$data['dgd_nombre_crear'];
            $antecedentegrupofamiliardetalles_nuevo->agf_id=$respuesta_modelo_antecedentegrupofamiliar['agf_id'];
            $antecedentegrupofamiliardetalles_nuevo->agd_estatus= 2;

            if( $antecedentegrupofamiliardetalles_nuevo->save()){

                $answer['estado']=2;
                $answer['mensaje']='ok';
            }


        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error en el proceso';

        }

        return $answer;
        
    
    }


}

