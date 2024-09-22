<?php

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Bienvenido');
        parent::initialize();
        $this->view->gmenu=1;
    }

    
    public function indexAction($prueba="")
    {
        $auth = $this->session->get('auth');
        if($auth)
        {
            if($auth['tipo']=='Companies'){
                return $this->forward('empresa/index');     
            }
            else{
                $auth = $this->session->get('auth');
                $rol = new Rol();
                if($rol->verificar(8,$auth['rol_id'])==1) //el número en la funcion es el correspondiente a la bdd
                {
                    return $this->forward("estudio/trafico_index");
                }elseif ($rol->verificar(12,$auth['rol_id'])==1) {
                    return $this->forward("estudio/traficoanalista_index");
                }elseif ($rol->verificar(25,$auth['rol_id'])==1) {
                    return $this->forward("transporte/aprobar_index");
                }elseif ($rol->verificar(82,$auth['rol_id'])==1) {
                    return $this->forward("cliente/index");
                }else{
                    return $this->forward("usuario/perfil");
                }
            }
                // return $this->forward('index/index');       
                // return $this->response->redirect('trabajador/index');
            
            //$this->view->prueba=$prueba;
            //$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        }
        else
        {
            $this->view->prueba=$prueba;
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        }
    }
    public function panelAction()
    {
        $auth = $this->session->get('auth');
        $inversion='hola';
        $this->view->inversion=$auth["tipo"];
        // $this->tag->setTitle('Bienvenido');
        
    }
    /**
     * distribuye a todos los menus la peticion tiene que ser ajax
     * @param  integer $var [numero del menu]
     * @return [type]       [vista del menu]
     */
    public function menuAction($var=-1)
    {
        // TODO: Necesitamos enviar el ID del proyecto actual para cargar correctamente la información
        if($this->request->isAjax())
        {
            switch ($var) 
            {
                case 1:
                return $this->forward('proyecto/index'); 
        # code...
                break;
                case 2:

                    return $this->forward('chat/layout');

                break;
                case 3:
                    return $this->forward('calendario/layout');
                    break;
                default:
        # code...
                break;
            }
        }

        // No existe la opción
        return $this->response->setStatusCode(404);
    }

    
}
