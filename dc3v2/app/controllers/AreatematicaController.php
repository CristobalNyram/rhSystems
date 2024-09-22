<?php
use Phalcon\Crypt;

class AreatematicaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Área temática');
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
        $area = Areatematica::find(array(
            "are_estatus<=2 and are_estatus>=0"
            ));
        
        $this->view->page=$area;

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de área temática";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);
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
        $form = new AreatematicaForm;
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
            $area= new Areatematica();
            $id=$auth['id'];
            if($clave=="")
                $res=$area->NuevoRegistro($data,$id);
            else
                $res=$area->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Creó un área temática";
                }else{
                    $databit['bit_descripcion']= "Editó un área temática con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);
                //$this->flash->success("Registro creado exitosamente");
                $this->response->redirect('areatematica/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($area->error);
            }
        }
       $clases=array(
        
        array("are_clave","col-sm-6 col-xs-6","control-label"),
        array("are_denominacion","col-sm-6 col-xs-6","control-label"),
        array("are_estatus","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $area=Areatematica::findFirstByare_id($clave);
            if(!$area)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("areatematica/index");
            }
            $clases=array(
                array("are_id","col-sm-6 col-xs-12","control-label"),
                array("are_clave","col-sm-6 col-xs-12","control-label"),
                array("are_denominacion","col-sm-6 col-xs-12","control-label"),
                array("are_estatus","col-sm-6 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('are_id',$area->are_id);
            $this->tag->setDefault('are_clave',$area->are_clave);
            $this->tag->setDefault('are_denominacion',$area->are_denominacion);
            $this->tag->setDefault('are_estatus',$area->are_estatus);

        }
        else
            $this->view->vvia_producto="";
        $this->view->form = $form;
        $this->view->clave=$clave;
        $this->view->clases=$clases; 
        
    }


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id)
    {
        $are = new Areatematica();
        $auth = $this->session->get('auth');
        // if(!$are->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $area = Areatematica::findFirstByare_id($id);
        if (!$area) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $area->are_estatus = -1;
        
        if ($area->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó el área temática con id ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }
}