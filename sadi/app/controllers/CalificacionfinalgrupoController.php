<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class CalificacionfinalgrupoController extends ControllerBase
{
    
    public function initialize()
    {
        $this->tag->setTitle('Cal grupo');
        parent::initialize();
        
    }

    public function ajax_get_valores_por_grupoAction($gru_id = 0)
    {
        $answer = [];
        $answer["estatus"] = -2;
        $answer["data"] = [];
    
        try {
            $subs = Calificacionfinal::find(array(
                "cal_estatus=2 and gru_id=" . $gru_id
            ));
    
            if ($subs) {
                $answer["data"] = $subs->toArray();
                $answer["estatus"] = 2;
                $answer["message"] ="ok"; 

            } else {
                $answer["estatus"] = 1; 
            }
        } catch (Exception $e) {
            $answer["estatus"] = -2;
            $answer["message"] = $e->getMessage(); 
        }
    
        return $this->response->setJsonContent($answer);
    }
    public function ajax_get_calificacion_por_idAction($cal_id = 0)
{
    $answer = [];
    $answer["estatus"] = -2;
    $answer["data"] = [];

    try {
        $calificacion = Calificacionfinal::findFirst(array(
            "conditions" => "cal_id = :cal_id:",
            "bind" => array("cal_id" => $cal_id)
        ));

        if ($calificacion) {
            $answer["data"] = $calificacion->toArray();
            $answer["estatus"] = 2;
            $answer["message"] = "ok";
        } else {
            $answer["estatus"] = 1;
            $answer["message"] = "No se encontró una calificación con ese ID.";
        }
    } catch (Exception $e) {
        $answer["estatus"] = -2;
        $answer["message"] = $e->getMessage();
    }

    return $this->response->setJsonContent($answer);
}

    

}
