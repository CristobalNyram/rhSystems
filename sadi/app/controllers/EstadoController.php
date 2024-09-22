<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class EstadoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Estado');
        parent::initialize();
        // $rol = new Rol();
        // $auth = $this->session->get('auth');
        // if(!$rol->verificar(10,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
    }

    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(4,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [tablaAction Muestra los registros de la tabla]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $estado = Estado::find(array(
            "est_estatus<=2 and est_estatus>=0"
            ));
        $date= new DateTime();
        $hoy=$date->format('Y-m-d');
        
        $this->view->datostabla=$estado;

        $this->view->hoy=$hoy;
    }

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $existe = Estado::findFirstByest_clave($data['est_clave']);
            if($existe==true){
                $answer[0]=0;
                $answer[1]='Ya existe un estado asociado con esa clave.';
                // return false;
            }
            else{
                $auth = $this->session->get('auth');
                $registro = new Estado();
                $registro->est_clave= $data['est_clave'];
                $registro->est_nombre= $data['est_nombre'];
                $registro->est_estatus=2;
                $registro->ultimo_usuid=$auth['id'];
                $registro->pai_id=1;

                if($registro->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Creó un estado con folio interno: ".$registro->est_id;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=0;
                    $databit['bit_modulo']="Estado";
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=1;
                }
                else
                    $answer[0]=0;
            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function buseditarAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        
        if($this->request->isAjax()&&$clave>0)
        {
            $registro=Estado::findFirstByest_id($clave);
            if($registro)
            {
                $answer[0]=1;
                $answer[1]=$registro;
            }
            else
            {
                $answer[0]=-1;    
            }
            
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }


    public function editarAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();

        if($this->request->isAjax()&&$clave>0)
        {
            // $rol = new Rol();
            $auth = $this->session->get('auth');
            
            $data = $this->request->getPost();
            $registro=Estado::findFirstByest_id($clave);

            if($registro)
            {
                $existe2 = Estado::findFirstByest_clave($data['est_claveeditar']);
                
                if($existe2==true){
                    if($existe2->est_id!=$clave){
                        $answer[0]=0;
                        $answer[1]='Ya existe un registro asociado a la clave.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                
                $registro->est_clave=$data["est_claveeditar"];
                $registro->est_nombre=$data["est_nombreeditar"];
                

                $auth = $this->session->get('auth');
                $registro->ultimo_usuid=$auth['id'];

                if($registro->save())
                {

                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Editó el estado clave ".$data["est_claveeditar"].', folio interno: '.$clave;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$clave;
                    $databit['bit_modulo']="Estado";
                    $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                }
                else
                {
                    $answer[0]=0;
                }

            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function eliminarAction($id)
    {
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
    }

    public function ajax_estadosAction()
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];

        $subs = Estado::find(array(
            "est_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
    public function ajax_get_unoAction($est_id)
    {
        $this->view->disable();
        $answer=array();

/*
        $subs = Estado::findFirstByest_id($est_id);
        if ($subs) {
            $result = $subs->toArray();
        }
        */
        // return $this->response->setJsonContent(1);
        // return json_encode(2);

    }
}
