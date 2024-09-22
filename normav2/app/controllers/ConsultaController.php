<?php

use Phalcon\Mvc\Model\Query\Builder;

class ConsultaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Consulta');
        parent::initialize();
        $this->view->gmenu=1;
    }
 


    public function verificarAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);   
    }

  
    
  
}
