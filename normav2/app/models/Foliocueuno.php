<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla pais
 */
class Foliocueuno extends Model
{

	public function getFechaCueUno($folio)
    {
        $folio=Foliocueuno::findFirstByfou_id($folio);

        if($folio)
            return $folio->fou_fecharegistro;
        else
            return "Sin contestar";
    }

}