<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class MunicipioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Municipio');
        parent::initialize();
        // $this->view->gmenu=0;
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(10,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
    }

    /**
     * [indexAction Index para la tabla estado]
     * @param        []
     * @return []    []
     */
    

    public function listaAction($id)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $municipio = Municipio::find(array(
            "mun_estatus<=2 and mun_estatus>=0 and est_id='".$id."'"
            ));
        
        $this->view->page=$municipio;
    }
}
