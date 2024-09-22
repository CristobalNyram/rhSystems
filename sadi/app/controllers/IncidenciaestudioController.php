<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class IncidenciaestudioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Incidencia');
        parent::initialize();        
    }
     
}