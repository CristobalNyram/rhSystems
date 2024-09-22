<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla  comentarios de cuestionario
 */
class Commentcue extends Model
{

    public $com_id;
    public $com_texto;
    public $recli_id;

}