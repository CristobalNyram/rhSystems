<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class HistorialdescargaController extends ControllerBase
{	
	public function initialize()
    {
        $this->tag->setTitle('Historial');
        parent::initialize();
    }

	public function tablaAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $historial = Historialdescarga::find(array(
            "his_estatus=2 and par_id=".$id
        ));
        
        $this->user = new Usuario();
        $this->view->user = $this->user;
        $this->view->page=$historial;
    }
}