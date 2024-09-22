<?php
use Phalcon\Crypt;

class OcupacionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Ocupación');
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
        $ocupacion = Ocupacion::find(array(
            "ocu_estatus<=2 and ocu_estatus>=0"
            ));
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de ocupación específica.";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->view->page=$ocupacion;
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
        $form = new OcupacionForm;
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
            $ocupacion= new Ocupacion();
            $id=$auth['id'];
            if($clave=="")
                $res=$ocupacion->NuevoRegistro($data,$id);
            else
                $res=$ocupacion->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Creó una ocupación específica";
                }else{
                    $databit['bit_descripcion']= "Editó una ocupación específica con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);
                //$this->flash->success("Registro creado exitosamente");
                $this->response->redirect('ocupacion/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($ocupacion->error);
            }
        }
       $clases=array(
        
        array("ocu_clave","col-sm-6 col-xs-6","control-label"),
        array("ocu_denominacion","col-sm-6 col-xs-6","control-label"),
        array("ocu_estatus","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $ocupacion=Ocupacion::findFirstByocu_id($clave);
            if(!$ocupacion)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("ocupacion/index");
            }
            $clases=array(
                array("ocu_id","col-sm-6 col-xs-12","control-label"),
                array("ocu_clave","col-sm-6 col-xs-12","control-label"),
                array("ocu_denominacion","col-sm-6 col-xs-12","control-label"),
                array("ocu_estatus","col-sm-6 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('ocu_id',$ocupacion->ocu_id);
            $this->tag->setDefault('ocu_clave',$ocupacion->ocu_clave);
            $this->tag->setDefault('ocu_denominacion',$ocupacion->ocu_denominacion);
            $this->tag->setDefault('ocu_estatus',$ocupacion->ocu_estatus);

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
        $ocupacion = new Ocupacion();
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
        $ocupacion = Ocupacion::findFirstByocu_id($id);
        if (!$ocupacion) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $ocupacion->ocu_estatus = -1;
        
        if ($ocupacion->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó la ocupación específica con id ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function ajax_ocupacionesAction()
    {
        // $act_id = (int) $this->request->getQuery('act_id');
        $result = [];
        $auth = $this->session->get('auth');
        $id_usuario = $auth['id'];

        $subs = Ocupacion::find(array(
            "ocu_estatus<=2 and ocu_estatus>=0"
            ));
        // Buscar los sub-departamentos
        // $subs=new Builder();
        // $subs=$subs->columns(array('a.act_id','a.act_nombre','a.act_fechainicio','a.act_fechafinal'))
        // ->addFrom('Actividad','a')
        // ->join('Relactividadusuario','a.act_id=r.act_id','r')
        // ->where(' a.act_estatus=2 and a.act_padre='.$act_id.' and r.rel_estatus=2 and r.usu_id='.$id_usuario)
        // ->getQuery()
        // ->execute();

        // Tiene sub-departamentos?
        if ($subs) {

            $result = $subs->toArray();
        }

        // retornar
        return $this->response->setJsonContent($result);
    }
}