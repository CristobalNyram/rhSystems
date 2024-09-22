<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TrayectorialaboralregistradoController extends ControllerBase
{
    public function ajax_encontrar_crear_detalleAction($sel_id=0){

        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {

            $modelo_tlr=new Trayectorialaboralregistrado();
    
            $respuesta_modelo_ans=$modelo_tlr->encontrar_o_crear($sel_id);
        
            $answer['data_trl']=$respuesta_modelo_ans;
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }

    }

   
}