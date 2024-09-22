<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Respuesta extends Model
{
    //lS?=lime sourvey
    function getRespuestaYN_LS($value){
        $answer="";

        switch ($value) {
            case 'Y':
            $answer="SI";
                break;
            case 'N':
            $answer="NO";
                break; 
            default:
            $answer="";
                break;
        }
        return $answer;
    }


    
}