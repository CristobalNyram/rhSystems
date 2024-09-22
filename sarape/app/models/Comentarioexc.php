<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Comentarioexc extends Model
{

    public function NuevoRegistroCambioEstatus($data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='error';

        $registro= new Comentarioexc();
        $registro->com_comentario= $data['com_comentario'];
        $registro->com_seguimiento= $data['com_seguimiento'];
        $registro->vista = isset($data['com_vista']) ?  $data['com_vista']:$this->getVistaTexto($data["exc_estatus"]);
        $registro->com_estatus= 2;
        $registro->usu_id= $auth['id'];
        $registro->exc_id= $data['exc_id'];
        $registro->exc_estatus=$data["exc_estatus"];
        $registro->com_estatus=2;

        if($registro->save()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['com_id']=$registro->com_id;
            $answer['exc_id']=$registro->exc_id;
        }

        return $answer;

    }

    public function NuevoRegistro($data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='error';

        $registro= new Comentarioexc();
        $registro->com_comentario= $data['com_comentario'];
        $registro->com_estatus= 2;
        $registro->usu_id= $auth['id'];
        $registro->exc_id= $data['exc_id'];
        $registro->exc_estatus=$data["exc_estatus"];
        $registro->com_estatus=2;
        $registro->vista = isset($data['com_vista']) ?  $data['com_vista']: $this->getVistaTexto($data["exc_estatus"]);

        if($registro->save()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['com_id']=$registro->com_id;
            $answer['exc_id']=$registro->exc_id;

        }

        return $answer;

    }

    public function getVistaTexto($value){
        switch ($value) {
            case 1:
            case 11:
            case 12:
            case 13:
            case 14:
                return  "citas";
            break;
            case 2:
            case 21:
                return  "referencias";
            break;  
            case 3:
            case 31:
            return  "psicometria";
            break;     
            case 4:
            case 41:
            case 42:
            case 43:
            return  "entrevista";
            break;      
            default:
               return  "general";
                break;
        }

    }

}