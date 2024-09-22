<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Query;
use Phalcon\Di;

class TipocitaController extends ControllerBase
{
    public function ajax_tiposcitasAction()
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];

        $subs = Tipocita::find(array(
            "tic_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
   
}