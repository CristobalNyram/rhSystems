<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Pregunta extends Model
{



    public function getPreguntasCalidadServicio(){
        $condicion="pre_estatus='2' and pre_sercal='2'";
        $answer=[];
        $result=Pregunta::query()
            ->where($condicion)
            ->execute();


        if(count($result)>0){

            $answer['data']=$result->toArray();
            $answer['estado']=2;
        }


        return $answer;

    }

    public function getPreguntaEspecifica($id=0){
        if($id!=0){
            $pregunta=Pregunta::findFirstBypre_id($id);

            return $pregunta->pre_texto;
        }else{
            return '';

        }
       
    }

    public function getPreguntasCalidadSerivio(){

        $condicion=" pre_sercal='2' AND pre_estatus='2' AND pre_id NOT IN (8, 10, 15,19,22,23)";
        $answer=[];
        $result=Pregunta::query()
            ->where($condicion)
            ->execute();


        if(count($result)>0){

            $answer['data']=$result->toArray();
            $answer['estado']=2;
        }
        return $answer;

    }

    public function getPreguntasAbiertaCalidadSerivio(){

        $condicion=" pre_sercal='2' AND pre_estatus='2' AND pre_id IN (8, 10, 15,19,22,23)";
        $answer=[];
        $result=Pregunta::query()
            ->where($condicion)
            ->execute();


        if(count($result)>0){

            $answer['data']=$result->toArray();
            $answer['estado']=2;
        }
        return $answer;

    }



}