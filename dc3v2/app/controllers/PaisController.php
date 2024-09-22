<?php
use Phalcon\Crypt;

class PaisController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Pais');
        parent::initialize();
        $this->view->gmenu=0;
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(37,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [indexAction Index para la tabla pais]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $pais = Pais::find(array(
            "pai_estatus<=2 and pai_estatus>=0"
            ));
        
        $this->view->page=$pais;
    }

    /**
     * [nuevoAction Crea un nuevo registro de la tabla país]
     * @param        []
     * @return []    []
     */
    /*public function nuevoAction()
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(38,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form = new PaisForm;
        $form->TodosCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $pais= new Pais();
            $auth = $this->session->get('auth');
            $id=$auth['id'];
            if($pais->NuevoRegistro($data,$id)==true){ 
                $this->flash->success("Registro creado exitosamente");
                $this->response->redirect('pais/index');
                $this->view->disable();
                return;
            }
            else{
                $this->flash->error($pais->error);
            }
        }
        $this->view->form = $form;
    }*/

    /**
     * [editarAction Edita un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    /*public function editarAction($id)
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(39,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form= new PaisForm;
        $form->EditarCampos();
        // $this->view->clave=$id;
        if (!$this->request->isPost()) 
        {

            $pais = Pais::findFirstBypai_id($id);
            if (!$pais) 
            {
                $this->flash->error("País no encontrado");
                return $this->forward("pais/index");
            }
            $this->tag->setDefault('pai_id',$pais->pai_id);
            $this->tag->setDefault('pai_nombre',$pais->pai_nombre);
            $this->tag->setDefault('pai_estatus',$pais->pai_estatus);
            
        }
        else
        {
            $data = $this->request->getPost();
            $pais= new Pais();
            $auth = $this->session->get('auth');
            $id=$auth['id'];
            if($pais->EditarRegistro($data,$id))
            {
                
                    $this->flash->success("Registro editado exitosamente");
                    $this->response->redirect('pais/index');
                    $this->view->disable();
                    return;
            }
            else
            {
                $this->flash->error('Ocurrió un error al editar el registro');
                return $this->forward('pais/editar/' . $data['pai_id']);
            }

        }
        $this->view->form = $form;

    }*/


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    /*public function eliminarAction($id)
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $pais = Pais::findFirstBypai_id($id);
        if (!$pais) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $pais->pai_estatus = -1;
        
        if ($pais->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;*/
    }
}