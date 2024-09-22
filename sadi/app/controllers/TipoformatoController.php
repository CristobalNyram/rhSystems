<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TipoformatoController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Tipo de formato');
        parent::initialize();
    }

    public function ajax_tiposformatosAction()
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];

        $subs = Tipoformato::find(array(
            "tif_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

    public function ajax_tiposformatos_acorde_a_empresaAction($emp_id=0)
    {
        $result = [];
       
        $subs=Empresaformato::query()
            ->columns('tif.tif_nombre, tif.tif_id, tif.tip_id ')
            ->where('Empresaformato.emf_estatus=2 and Empresaformato.emp_id="'.$emp_id.'"')
            ->leftjoin('Tipoformato','tif.tif_id=Empresaformato.tif_id','tif')
            ->execute();


        
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }


    
}