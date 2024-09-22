<?php

class MenuController extends ControllerBase {

    /**
     * Carga las vistas de las "tabs"
     * @param int $tab_id
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function initialize()
    {
        $this->tag->setTitle('');
        parent::initialize();
        $this->view->gmenu=1;
    }
    public function tabAction($tab_id = -1) {

        // ID de Proyecto
        $pro_id = $this->request->getQuery('pro_id');

        // Es raro que esto pase, pero lo comprobamos
        if ( ! $pro_id)
            return $this->response->setStatusCode(404);

        if($this->request->isAjax())
        {
            switch ($tab_id)
            {
                case 1:
                    return $this->dispatcher->forward([
                        'controller' => 'proyecto',
                        'action' => 'layout',
                        'params' => [$pro_id]
                    ]);
                    break;
                case 2:
                    return $this->dispatcher->forward([
                        'controller' => 'chat',
                        'action' => 'layout',
                        'params' => [$pro_id]
                    ]);
                    break;
                case 3:
                    return $this->dispatcher->forward([
                        'controller' => 'calendario',
                        'action' => 'layout_actividades',
                        'params' => [$pro_id]
                    ]);
                    break;
                default:
                    # code...
                    break;
            }
        }

        // No existe la opción
        return $this->response->setStatusCode(404);
    }

    public function nuevoAction()
    {
        $men = new Menu();
        $auth = $this->session->get('auth');
        $rol = new Rol();
        if(!$rol->verificar(92,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');

        $form = new MenuForm;
        $form->NuevosCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $menu= new Menu();
            if($menu->NuevoRegistro($data)==true){ 
                $this->flash->success("Registro creado exitosamente");
                $this->response->redirect('menu/nuevo');
                $this->view->disable();
                return;
            }
            else{
                $this->flash->error($menu->error);
            }
        }
        $this->view->form = $form;
    }
}