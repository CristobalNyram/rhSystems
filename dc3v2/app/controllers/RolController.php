<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class RolController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Rol');
        parent::initialize();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(10,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [indexAction Index para la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $rol = Rol::find(array(
            "rol_estatus<=2 and rol_estatus>=0"
            ));
        
        $this->view->page=$rol;
    }

    /**
     * [nuevoAction Crea un nuevo registro de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function nuevoAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(42,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $form = new RolForm;
        $form->TodosCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $rol= new Rol();
            if($rol->NuevoRegistro($data)==true){ 
                $this->flash->success("Registro creado exitosamente");
                $this->response->redirect('rol/index');
                $this->view->disable();
                return;
            }
            else{
                $this->flash->error($rol->error);
            }
        }
        $this->view->form = $form;
    }

    /**
     * [editarAction Edita un registro de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function editarAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(43,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $form= new RolForm;
        $form->EditarCampos();
        // $this->view->clave=$id;
        if (!$this->request->isPost()) 
        {

            $rol = Rol::findFirstByrol_id($id);
            if (!$rol) 
            {
                $this->flash->error("Rol no encontrado");
                return $this->forward("rol/index");
            }
            $this->tag->setDefault('rol_id',$rol->rol_id);
            $this->tag->setDefault('rol_nombre',$rol->rol_nombre);
            $this->tag->setDefault('rol_estatus',$rol->rol_estatus);
            $this->tag->setDefault('rol_descripcion',$rol->rol_descripcion);
            
        }
        else
        {
            $data = $this->request->getPost();
            $rol= new Rol();
            
            if($rol->EditarRegistro($data))
            {
                
                    $this->flash->success("Registro editado exitosamente");
                    $this->response->redirect('rol/index');
                    $this->view->disable();
                    return;
            }
            else
            {
                $this->flash->error('Ocurrió un error al editar el registro');
                return $this->forward('rol/editar/' . $data['rol_id']);
            }

        }
        $this->view->form = $form;

    }


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id='')
    {
        $rol = new Rol();
        // $auth = $this->session->get('auth');
        // if(!$rol->verificar(44,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $rol = Rol::findFirstByrol_id($id);
        if (!$rol) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $rol->rol_estatus = -1;
        
        if ($rol->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    /**
     * [permisoAction Permisos de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function permisoAction($id='')
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(45,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        if (!$this->request->isAjax()) 
        {
            $rol = Rol::findFirstByrol_id($id);
            if (!$rol) {
                $this->flash->error("Rol no existente");
                $this->response->redirect('rol/index');
                $this->view->disable();
                return;
                
            }
            
            $relpuemenu=new Builder();
            $relpuemenu=$relpuemenu->columns(array('r.rrm_id','r.rrm_estatus','m.men_id','m.men_titulo','m.men_estatus','m.men_padre','p.rol_nombre','p.rol_estatus','p.rol_id','r.rrm_id as datos'))
                ->addFrom('Relrolmenu','r')
                ->join('Rol','p.rol_id=r.rol_id','p')
                ->join('Menu','r.men_id=m.men_id','m')
                ->where('p.rol_id='.$id)
                ->andWhere('p.rol_estatus=2 and m.men_estatus=2')
                ->orderBy('m.men_orden')
                ->getQuery()
                ->execute();
            $arreglobase=[];
            
            for($a=1;$a<=count($relpuemenu);$a++){
                $relpuemenu[$a-1]->datos=[];
                if($relpuemenu[$a-1]->men_padre==0){
                    $arreglobase[]=$relpuemenu[$a-1];
                }
            }
            for($a=1;$a<=count($relpuemenu);$a++){
                $relpuemenu[$a-1]->datos=[];
                if($relpuemenu[$a-1]->men_padre!=0){
                    for($b=1;$b<=count($arreglobase);$b++){
                        if($relpuemenu[$a-1]->men_padre==$arreglobase[$b-1]->men_id){
                            $datos=[];
                            $datos=$relpuemenu[$a-1];
                            $arreglobase[$b-1]->datos[]=$datos;
                        }    
                    }
                }
            }
            for($a=1;$a<=count($relpuemenu);$a++){
                if($relpuemenu[$a-1]->men_padre!=0){
                    for($b=1;$b<=count($arreglobase);$b++){
                        for($c=1;$c<=count($arreglobase[$b-1]->datos);$c++){
                            if($relpuemenu[$a-1]->men_padre==$arreglobase[$b-1]->datos[$c-1]->men_id){
                                $datos=[];
                                $datos=$relpuemenu[$a-1];
                                $arreglobase[$b-1]->datos[$c-1]->datos[]=$datos;
                            }
                        }    
                    }
                }
            }
            
            $this->view->relpuemenu=$arreglobase;
            $this->view->rol_nombre=$rol->rol_nombre;
            return;
        }
        else
        {
            $answer=array();
            $this->view->disable();
            $data = $this->request->getPost();
            $relpuemenu=new Builder();
            $relpuemenu=$relpuemenu->columns(array('r.rrm_id','r.rrm_estatus','m.men_titulo','m.men_estatus','p.rol_nombre','p.rol_estatus','p.rol_id'))
                ->addFrom('Relrolmenu','r')
                ->join('Rol','p.rol_id=r.rol_id','p')
                ->join('Menu','r.men_id=m.men_id','m')
                ->where('p.rol_id='.$data['rol'])
                ->andWhere('p.rol_estatus=2 and m.men_estatus=2')
                ->getQuery()
                ->execute();
            // $datos=json_decode($data);
            // $cantidad=count($data);
            // $data[];
            // print_r($datos);
            // die($relpuemenu);
            // return;
            $bandera=0;
            $this->db->begin();
            for ($i=0; $i < count($relpuemenu) ; $i++) { 
                $rel = Relrolmenu::findFirstByrrm_id($relpuemenu[$i]->rrm_id);
                $rel->rrm_estatus=$data[$relpuemenu[$i]->rrm_id];
                if(!$rel->save())
                {
                    $bandera++;
                }
            }
            if($bandera==0){
                $this->db->commit();
                $answer[0]='1';
                $this->flash->success("Permisos cambiados exitosamente");
                $this->response->redirect('rol/index');
                $this->view->disable();
                return;
            }else{
                $this->db->rollback();
                $answer[0]='0';
                $answer[1]="Ha ocurrido un error. Inténtalo nuevamente.";
                $this->flash->error('Ocurrió un error al editar el registro');
            }
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }

    }
}
