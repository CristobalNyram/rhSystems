<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;

/**
 * Modelo de la tabla Calificacionfinalgrupo
 */
class Calificacionfinal extends Model
{

    public function getCalificacionTexto($cal_id){
        $cal_texto="";
        $calificacionfinal=Calificacionfinal::findFirst($cal_id);
        if($calificacionfinal){
            $cal_texto=$calificacionfinal->cal_texto;
        }else{
            error_log("NO SE ENCONTRO EL CAL_TEXT DE LA CAL ID ".$cal_id);
        }   

        return $cal_texto;

    }  
    public function getCalificacionStyle($cal_id){
        $cal_estilocss="";
        $calificacionfinal=Calificacionfinal::findFirst($cal_id);
        if($calificacionfinal){
            $cal_estilocss=$calificacionfinal->cal_estilocss;
        }else{
            error_log("NO SE ENCONTRO EL cal_estilocss DE LA CAL ID ".$cal_id);
        }   

        return $cal_estilocss;

    }
	
}