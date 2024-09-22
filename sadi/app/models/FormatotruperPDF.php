<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class FormatotruperPDF extends Model
{

    public $bg_lleno='bg-white';
    public $bg_vacio='bg-gray';

    public function verificar_si_es_vacio_td($value){

        if($value!=null || trim($value)!=''){
            return $this->bg_lleno;
        }else{
            return $this->bg_vacio;

        }
       

    }
    public function verificar_si_es_vacio_select($value){

        if($value=='-1'){
            return $this->bg_vacio;

        }
        else if($value==null || trim($value)==''){
            return $this->bg_vacio;

        }
        else{
            return $this->bg_lleno;

        }
       

    }

    public function verificar_si_es_vacio_campo_dinero($value){

        if($value<=0){
            return $this->bg_vacio;

        }
        else{
            return $this->bg_lleno;

        }
       

    }

}