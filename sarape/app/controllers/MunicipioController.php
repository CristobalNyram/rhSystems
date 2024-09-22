<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class MunicipioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Municipio');
        parent::initialize();

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
        $registro = Municipio::find(array(
            "mun_estatus<=2 and mun_estatus>=0"
            ));
        $this->view->datostabla=$registro;
    }

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $existe = Municipio::findFirstBymun_clave($data['mun_clave']);
            if($existe==true){
                $answer[0]=0;
                $answer[1]='Ya existe un registro asociado con esa clave.';
                // return false;
            }
            else{
                $auth = $this->session->get('auth');
                $registro = new Municipio();
                $registro->mun_clave= $data['mun_clave'];
                $registro->mun_nombre= $data['mun_nombre'];
                $registro->mun_estatus=2;
                $registro->ultimo_usuid=$auth['id'];
                // $registro->pai_id=1;

                if($registro->save())
                {
                    $data_bit = [
                        'bit_descripcion'=> "Creó un municipio con folio interno: ".$registro->mun_id,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>0,
                        'bit_modulo'=>"Municipio",
                        'bit_accion'=>1
                    ];
                    $this->bitacora_registro($data_bit,$auth);

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
            $registro=Municipio::findFirstBymun_id($clave);
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
            $registro=Municipio::findFirstBymun_id($clave);

            if($registro)
            {
                $existe2 = Municipio::findFirstBymun_clave($data['mun_claveeditar']);
                
                if($existe2==true){
                    if($existe2->mun_id!=$clave){
                        $answer[0]=0;
                        $answer[1]='Ya existe un registro asociado a la clave.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                
                $registro->mun_clave=$data["mun_claveeditar"];
                $registro->mun_nombre=$data["mun_nombreeditar"];
                

                $auth = $this->session->get('auth');
                $registro->ultimo_usuid=$auth['id'];

                if($registro->save())
                {

                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó el municipio clave ".$data["mun_claveeditar"].', folio interno: '.$clave,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Municipio",
                        'bit_accion'=>2
                    ];
                    $this->bitacora_registro($data_bit,$auth);
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
        $registro = Municipio::findFirstBymun_id($id);
        if (!$registro) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $registro->mun_estatus = -1;
        
        if ($registro->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function ajax_municipiosAction($id)
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];

        $subs = Municipio::find(array(
            "mun_estatus=2 and est_id=".$id
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
    public function ajax_get_unoAction($mun_id)
    {
          // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];
        $this->view->disable();
        $answer=array();

        $subs = Municipio::findFirst(array(
            "mun_estatus=2 and mun_id=".$mun_id
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);

    }

}
