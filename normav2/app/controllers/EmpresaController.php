<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Http\Request;

class EmpresaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Empresa');
        parent::initialize();
     
    }


   
    public function ajax_empresaAction()
    {
        $this->view->disable();
        $result = [];
     
        

        $empresaslista = Empresa::find(
            "emp_estatus=2 "
        );
       

            $result = $empresaslista->toArray();
        

        // retornar
         $this->response->setJsonContent($result);
         return $this->response->send(); 
        

         
    }

}