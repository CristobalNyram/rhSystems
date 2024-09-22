<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class OcupacionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Ocupación');
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
        if(!$rol->verificar(16,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $ocu = Ocupacion::find(array(
            "ocu_estatus=2"
            ));
        
        $this->view->registro=$ocu;
    }

    public function detallesAction($clave=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        $this->view->disable();
        if(!$rol->verificar(16,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        // $answer=array();
        // $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $agente=Ocupacion::findFirstByocu_id($clave);
            if($agente)
            {
                $answer[0]=1;
                $answer[1]=$agente;

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

    public function ajax_ocupacionesAction()
    {
        $result = [];
        $subs = Ocupacion::find(array(
            "ocu_estatus=2 AND ocu_id>0"
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
            $ocupacion = new Ocupacion();
            $ocupacion->ocu_nombre= $data['ocu_nombre'];
            $ocupacion->ocu_estatus=2;
            
            $auth = $this->session->get('auth');
            if($ocupacion->save())
            {
                $auth = $this->session->get('auth');
                $data_bit = [
                    'bit_descripcion'=> 'Creó una ocupación: '.$data['ocu_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$ocupacion->ocu_id,
                    'bit_modulo'=>"Ocupación",
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
            $ocupacion=Ocupacion::findFirstByocu_id($clave);
            if($ocupacion)
            {
                $answer[0]=1;
                $answer[1]=$ocupacion;
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
            $ocupacion=Ocupacion::findFirstByocu_id($clave);

            if($ocupacion)
            {
                $ocupacion->ocu_nombre=$data["ocu_nombreeditar"];
                
                $auth = $this->session->get('auth');
                
                if($ocupacion->save())
                {
                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó la ocupación con id interno: ".$data["ocu_ideditar"].',con nombre '.$ocupacion->ocu_nombre,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Ocupacion",
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

    public function eliminarAction($ocu_id=0)
    {
        $answer=array();
        $answer[0]=-1;
        $this->view->disable();

        if($this->request->isAjax() && $ocu_id>0)
        {
            $ocupacion=Ocupacion::findFirstByocu_id($ocu_id);
            $auth = $this->session->get('auth');

            if($ocupacion)
            {
                $ocupacion->ocu_estatus=-1;

                if($ocupacion->save())
                {                    
                    $data_bit = [
                        'bit_descripcion'=>'Eliminó la ocupación con ID interno: '. $ocupacion->ocu_id,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$ocupacion->ocu_id,
                        'bit_modulo'=>"Ocupación",
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
