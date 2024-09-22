<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class VerificacionesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Verificaciones');
        parent::initialize();
    }

    public function ajax_verificacionesAction()
    {
        $result = [];
        $subs = Verificaciones::find(array(
            "ver_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
}