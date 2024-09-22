<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class SexoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sexo');
        parent::initialize();
        
       
        
    }

    /**
     * [indexAction Index para la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(24,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [tablaAction Muestra los registros de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $reg = Sexo::find(array(
            "sex_estatus=2"
            ));
        
        $this->view->registro=$reg;
    }

    public function detallesAction($clave=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        $this->view->disable();
        if(!$rol->verificar(24,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        if($this->request->isAjax()&&$clave>0)
        {
            $registro=Sexo::findFirstBysex_id($clave);
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

    public function ajax_sexosAction()
    {
        $result = [];
        $subs = Sexo::find(array(
            "sex_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $registro = new Sexo();
            $registro->sex_nombre= $data['sex_nombre'];
            $registro->sex_estatus=2;
            
            $auth = $this->session->get('auth');
            if($registro->save())
            {
                $auth = $this->session->get('auth');
                $data_bit = [
                    'bit_descripcion'=>'Creó un sexo: '.$data['sex_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$registro->sex_id,
                    'bit_modulo'=>"Sexo",
                    'bit_accion'=>1
                ];
                $this->bitacora_registro($data_bit,$auth);
                $answer[0]=1;
            }
            else
                $answer[0]=0;
           
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
            $registro=Sexo::findFirstBysex_id($clave);
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
            $auth = $this->session->get('auth');
            $data = $this->request->getPost();
            $registro=Sexo::findFirstBysex_id($clave);

            if($registro)
            {
                $registro->sex_nombre=$data["sex_nombreeditar"];
                
                $auth = $this->session->get('auth');
                
                if($registro->save())
                {
                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó un sexo con id interno: ".$data["sex_ideditar"].',con nombre '.$registro->sex_nombre,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Sexo",
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

    public function eliminarAction($reg_id=0)
    {
        $answer=array();
        $answer[0]=-1;
        $this->view->disable();

        if($this->request->isAjax() && $reg_id>0)
        {
            $registro=Sexo::findFirstBysex_id($reg_id);
            $auth = $this->session->get('auth');

            if($registro)
            {
                $registro->sex_estatus=-2;

                if($registro->save())
                {
                    $data_bit = [
                        'bit_descripcion'=>'Eliminó el sexo con ID interno: '. $registro->sex_id,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$registro->sex_id,
                        'bit_modulo'=>"Sexo",
                        'bit_accion'=>3
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $answer[0]=1;
                    $answer['mensaje']="Éxito al eliminar el registro";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                else
                {
                    $answer[0]=-1;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
            }
            else
            {
                $answer[0]=-1;
                $answer['mensaje']='Error al guardar los datos';
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            }
        }
    }
}