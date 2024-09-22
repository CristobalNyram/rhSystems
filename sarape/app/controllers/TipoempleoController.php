<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class TipoempleoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Tipo de empleo');
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
        if(!$rol->verificar(21,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $reg = Tipoempleo::find(array(
            "tie_estatus=2"
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
        if(!$rol->verificar(21,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $registro=Tipoempleo::findFirstBytie_id($clave);
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

    public function ajax_tipoempleosAction()
    {
        $result = [];
        $subs = Tipoempleo::find(array(
            "tie_estatus=2",
            'order'=>'tie_nombre',
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
            $registro = new Tipoempleo();
            $registro->tie_nombre= $data['tie_nombre'];
            $registro->tie_estatus=2;
            
            $auth = $this->session->get('auth');
            if($registro->save())
            {
                $auth = $this->session->get('auth');
                $data_bit = [
                    'bit_descripcion'=>'Creó un tipo de empleo: '.$data['tie_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$registro->tie_id,
                    'bit_modulo'=>"Tipo empleo",
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
            $registro=Tipoempleo::findFirstBytie_id($clave);
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
            $registro=Tipoempleo::findFirstBytie_id($clave);

            if($registro)
            {
                $registro->tie_nombre=$data["tie_nombreeditar"];
                
                $auth = $this->session->get('auth');
                
                if($registro->save())
                {
                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó el tipo de empleo con id interno: ".$data["tie_ideditar"].',con nombre '.$registro->tie_nombre,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Tipo empleo",
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
            $registro=Tipoempleo::findFirstBytie_id($reg_id);
            $auth = $this->session->get('auth');

            if($registro)
            {
                $registro->tie_estatus=-2;

                if($registro->save())
                {
                    $data_bit = [
                        'bit_descripcion'=>'Eliminó el tipo de empleo con ID interno: '. $registro->tie_id,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$registro->tie_id,
                        'bit_modulo'=>"Tipo empleo",
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