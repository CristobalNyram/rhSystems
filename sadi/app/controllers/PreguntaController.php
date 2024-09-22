<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class PreguntaController extends ControllerBase
{

            
        public function ajax_get_textos_preguntas_servicioAction(){
            $answers=[];
            $this->view->disable();
            if($this->request->isAjax()){
                    $preg_obj=new Pregunta();


                    $respesta_modelo=$preg_obj->getPreguntasCalidadServicio();


                    $answers['data']= $respesta_modelo;
                    $answers['estatus']= 2;
                    $answers['mensaje']= 'ok';

                    return $this->response->setJsonContent($answers);

            }else{
                return http_response_code(400);
            }
        }

}

