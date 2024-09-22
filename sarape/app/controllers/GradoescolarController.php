<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class GradoescolarController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Grado escolar');
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
        if(!$rol->verificar(25,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $reg = Gradoescolar::find(array(
            "gra_estatus=2"
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
        if(!$rol->verificar(25,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $registro=Gradoescolar::findFirstBygra_id($clave);
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

    public function ajax_gradosescolaresAction()
    {
        $result = [];
        $subs = Gradoescolar::find(array(
            "gra_estatus=2",
            'order'=>'gra_nombre',
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
            $registro = new Gradoescolar();
            $registro->gra_nombre= $data['gra_nombre'];
            $registro->gra_estatus=2;
            
            $auth = $this->session->get('auth');
            if($registro->save())
            {
                $auth = $this->session->get('auth');

                $data_bit = [
                    'bit_descripcion'=>'Creó un grado escolar: '.$data['gra_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$registro->gra_id,
                    'bit_modulo'=>"Grado escolar",
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
            $registro=Gradoescolar::findFirstBygra_id($clave);
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
            $registro=Gradoescolar::findFirstBygra_id($clave);

            if($registro)
            {
                $registro->gra_nombre=$data["gra_nombreeditar"];
                
                $auth = $this->session->get('auth');
                
                if($registro->save())
                {
                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó un grado escolar con id interno: ".$data["gra_ideditar"].',con nombre '.$registro->gra_nombre,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Grado escolar",
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
            $registro=Gradoescolar::findFirstBygra_id($reg_id);
            $auth = $this->session->get('auth');

            if($registro)
            {
                $registro->gra_estatus=-2;

                if($registro->save())
                {
                    $data_bit = [
                        'bit_descripcion'=>'Eliminó el grado escolar con ID interno: '. $registro->gra_id,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$registro->gra_id,
                        'bit_modulo'=>"Grado escolar",
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