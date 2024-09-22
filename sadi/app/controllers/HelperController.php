<?php
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\User\Component\Encriptarparametros;

class HelperController extends ControllerBase
{
  

    public function get_encript_idAction($id=0){
        $this->view->disable();
        $answer['estado']=-2;
        $answer['mensaje']='error';
        $answer['titular']='error';
        $answer['data']="";
            try {
                $answer["data"]=$this->encriiptarId($id);
                $answer['estado']=2;
                $answer['mensaje']='ok';
                $answer['titular']='ok';

            } catch (\Exception $e) {
                    $answer[0] = -2;
                    $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
}