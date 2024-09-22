<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class EstadoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Estado');
        parent::initialize();
        $this->view->gmenu=0;
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(10,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [indexAction Index para la tabla estado]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla estado]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $estado=new Builder();
        $estado=$estado
        ->columns(array('e.est_id','p.pai_nombre','e.est_nombre','e.est_estatus'))
        ->addFrom('Estado','e')
        ->join('Pais','e.pai_id=p.pai_id','p')
        ->where('e.est_estatus<=2 and e.est_estatus>=0')
        ->getQuery()
        ->execute();
        
        $this->view->page=$estado;
    }

    /**
     * [nuevoAction Crea un nuevo registro de la tabla estado]
     * @param        []
     * @return []    []
     */
   /* public function nuevoAction()
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(11,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form = new EstadoForm;
        $form->TodosCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $estado= new Estado();
            if($estado->NuevoRegistro($data)==true){ 
                $this->flash->success("Registro creado exitosamente");
                $this->response->redirect('estado/index');
                $this->view->disable();
                return;
            }
            else{
                $this->flash->error($estado->error);
            }
        }
        $this->view->form = $form;
    }*/

    /**
     * [editarAction Edita un registro de la tabla estado]
     * @param        []
     * @return []    []
     */
    /*public function editarAction($id=0)
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(12,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form= new EstadoForm;
        $form->EditarCampos();
        // $this->view->clave=$id;
        if (!$this->request->isPost()) 
        {

            $estado = Estado::findFirstByest_id($id);
            if (!$estado) 
            {
                $this->flash->error("Estado no encontrado");
                return $this->forward("estado/index");
            }
            $this->tag->setDefault('est_id',$estado->est_id);
            $this->tag->setDefault('est_nombre',$estado->est_nombre);
            $this->tag->setDefault('est_estatus',$estado->est_estatus);
            
        }
        else
        {
            $data = $this->request->getPost();
            $estado= new Estado();
            
            if($estado->EditarRegistro($data))
            {
                
                    $this->flash->success("Registro editado exitosamente");
                    $this->response->redirect('estado/index');
                    $this->view->disable();
                    return;
            }
            else
            {
                $this->flash->error('Ocurrió un error al editar el registro');
                return $this->forward('estado/editar/' . $data['est_id']);
            }

        }
        $this->view->form = $form;

    }*/


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla estado]
     * @param        []
     * @return []    []
     */
    /*public function eliminarAction($id)
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(13,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $estado = Estado::findFirstByest_id($id);
        if (!$estado) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $estado->est_estatus = -1;
        
        if ($estado->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }*/

    public function listaAction($id)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $estado = Estado::find(array(
            "est_estatus<=2 and est_estatus>=0 and pai_id='".$id."'"
            ));
        
        $this->view->page=$estado;
    }
}
