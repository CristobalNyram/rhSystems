<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Foliocueclima extends Model
{
    public $folcucli_id;

	public function getFechaCueClima($folio)
    {
        $folio=Foliocueclima::findFirstByfolcucli_id($folio);

        if($folio)
           return $folio->folcucli_fecharegistro;
         else
            return "Sin contestar";
    }

}