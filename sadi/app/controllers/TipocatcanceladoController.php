<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TipocatcanceladoController extends ControllerBase
{

    public function ajax_get_todosAction($tip_id=0,$tiene_select_dependiente=0)
    {
        $answer = [];
        $answer["estado"]=-2;
        $answer["mensaje"]="ok";
        $answer["titular"]="ok";
        $answer["data"]=[];
        $condicion="tcc.tcc_estatus=2 AND cac.cac_estatus=2 ";

        if ($tip_id!=0 ) { $condicion.=" AND tcc.tip_id=".$tip_id;}
        
        $subs=new Builder();
        $subs=$subs
        ->columns('tcc.tcc_id, cac.cac_id, cac.cac_nombre')
        ->addFrom('Tipocatcancelado','tcc')
        ->leftjoin('Catcancelado', 'cac.cac_id = tcc.cac_id', 'cac')
        ->where($condicion)
        ->getQuery()
        ->execute();

        if ($subs) { $answer["data"]=$subs->toArray(); $answer["estado"]=2;}

        return $this->response->setJsonContent($answer);
    }

}