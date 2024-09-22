<?php
use Phalcon\Crypt;

class CursoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Curso');
        parent::initialize();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(8,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla curso]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $curso = Curso::find(array(
            "cur_estatus<=2 and cur_estatus>=0"
            ));
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de cursos.";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->view->page=$curso;
    }

    public function formularioAction($clave="")
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // $vtodos=1;
        // $susu=-1;
        
        // if(!$pue->verificar(72,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $vtodos=0;
        //     $susu=$auth["id"];
        // }
        $form = new CursoForm;
        if($clave=="")
        {

            $form->NuevosCampos();
        }
        else
            $form->EditarCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();  
            // $data["via_fechaini"]=$this->convertir_fecha($data["via_fechaini"]);
            // $data["via_fechafin"]=$this->convertir_fecha($data["via_fechafin"]); 
            $curso= new Curso();
            $id=$auth['id'];
            if($clave=="")
                $res=$curso->NuevoRegistro($data,$id);
            else
                $res=$curso->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Agregó un curso al catálogo";
                }else{
                    $databit['bit_descripcion']= "Editó un curso (catálogo) con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);
                //$this->flash->success("Registro creado exitosamente");
                $this->response->redirect('curso/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($curso->error);
            }
        }
       $clases=array(
        
        array("cur_clave","col-sm-6 col-xs-6","control-label"),
        array("cur_nombre","col-sm-6 col-xs-6","control-label"),
        array("cur_horas","col-sm-3 col-xs-12","control-label"),
        array("are_id","col-sm-3 col-xs-12","control-label"),
        array("cur_tipo","col-sm-3 col-xs-12","control-label"),
        array("cur_estatus","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $curso=Curso::findFirstBycur_id($clave);
            if(!$curso)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("curso/index");
            }
            $clases=array(
                array("cur_id","col-sm-3 col-xs-12","control-label"),
                array("cur_clave","col-sm-3 col-xs-6","control-label"),
                array("cur_nombre","col-sm-6 col-xs-6","control-label"),
                array("cur_horas","col-sm-3 col-xs-12","control-label"),
                array("are_id","col-sm-3 col-xs-12","control-label"),
                array("cur_tipo","col-sm-3 col-xs-12","control-label"),
                array("cur_estatus","col-sm-3 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('cur_id',$curso->cur_id);
            $this->tag->setDefault('cur_clave',$curso->cur_clave);
            $this->tag->setDefault('cur_nombre',$curso->cur_nombre);
            $this->tag->setDefault('cur_horas',$curso->cur_horas);
            $this->tag->setDefault('are_id',$curso->are_id);
            $this->tag->setDefault('cur_tipo',$curso->cur_tipo);
            $this->tag->setDefault('cur_estatus',$curso->cur_estatus);

        }
        else
            $this->view->vvia_producto="";
        $this->view->form = $form;
        $this->view->clave=$clave;
        $this->view->clases=$clases; 
        
    }

    /**
     * [nuevoAction Crea un nuevo registro de la tabla país]
     * @param        []
     * @return []    []
     */
    public function nuevoAction()
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(38,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $form = new CursoForm;
        $form->TodosCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $curso= new Curso();
            $auth = $this->session->get('auth');
            $id=$auth['id'];
            if($curso->NuevoRegistro($data,$id)==true){ 
                $this->flash->success("Registro creado exitosamente");
                $this->response->redirect('curso/index');
                $this->view->disable();
                return;
            }
            else{
                $this->flash->error($curso->error);
            }
        }
        $this->view->form = $form;
    }

    /**
     * [editarAction Edita un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function editarAction($id)
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(39,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
            // $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            // $this->response->redirect('index/panel');
            // $this->view->disable();
            // return;   
        // }
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

    }


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id)
    {
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $curso = Curso::findFirstBycur_id($id);
        if (!$curso) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $curso->cur_estatus = -1;
        
        if ($curso->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó del catálogo el curso con id ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }
}