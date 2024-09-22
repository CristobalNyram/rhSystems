<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla   Psicometria
 */
class Psicometria extends Model
{
    public function ActualizarGeneral($data,$auth_data){
        $answer['estado']=-2;
        $answer['mensaje']='';
        $fecha_y_hora = date("Y-m-d H:i:s");
        $this->psi_observacion=$data['psi_observacion'];
        $this->psi_calificacion=$data['psi_calificacion'];
        $this->psi_actualizacion=$fecha_y_hora;        

        if($this->update()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['psi_id']=$this->psi_id;
            $answer['exc_id']=$this->exc_id;

        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error';
        }

        return $answer;

    }
    

}