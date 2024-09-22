<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Foliocuetres extends Model
{

	public function getFechaCueTres($folio)
    {
        $folio=Foliocuetres::findFirstByfot_id($folio);

        if($folio)
            return $folio->fot_fecharegistro;
        else
            return "Sin contestar";
    }

}