<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Foliocuedos extends Model
{

	public function getFechaCueDos($folio)
    {
        $folio=Foliocuedos::findFirstByfod_id($folio);

        if($folio)
            return $folio->fod_fecharegistro;
        else
            return "Sin contestar";
    }
    
    
    

    


}