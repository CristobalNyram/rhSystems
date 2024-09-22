<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class NegocioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Negocio');
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
        if(!$rol->verificar(11,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $neg = Negocio::find(array(
            "neg_estatus<=2 and neg_estatus>=0"
            ));
        
        $this->view->negocio=$neg;
    }

    public function detallesAction($clave=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        $this->view->disable();
        if(!$rol->verificar(11,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $agente=Negocio::findFirstByneg_id($clave);
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

    public function ajax_negociosAction()
    {
        $result = [];
        $subs = Negocio::find(array(
            "neg_estatus=2"
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
            $negocio = new Negocio();
            $negocio->neg_nombre= $data['neg_nombre'];
            $negocio->neg_nota= $data['neg_nota'];
            $negocio->neg_estatus=2;
            
            $auth = $this->session->get('auth');
            if($negocio->save())
            {
                $auth = $this->session->get('auth');
                $data_bit = [
                    'bit_descripcion'=>'Creó un grupo de negocio: '.$data['neg_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$negocio->neg_id,
                    'bit_modulo'=>'Negocio',
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
            $negocio=Negocio::findFirstByneg_id($clave);
            if($negocio)
            {
                $answer[0]=1;
                $answer[1]=$negocio;
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
            $negocio=Negocio::findFirstByneg_id($clave);

            if($negocio)
            {
                $negocio->neg_nombre=$data["neg_nombreeditar"];
                $negocio->neg_nota=$data["neg_notaeditar"];
                
                $auth = $this->session->get('auth');
                
                if($negocio->save())
                {
                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó el negocio con id interno: ".$data["neg_ideditar"].',con nombre '.$negocio->neg_nombre,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Negocio",
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

    public function eliminarAction($neg_id=0)
    {
        $answer=array();
        $answer[0]=-1;
        $this->view->disable();

        if($this->request->isAjax()&&$neg_id>0)
        {  
            
            $negocio=Negocio::findFirstByneg_id($neg_id);
            $auth = $this->session->get('auth');

            if($negocio)
            {

            $negocio->neg_estatus=-1;    

                if($negocio->save())
                {
                    $data_bit = [
                        'bit_descripcion'=>'Eliminó el grupo de negocio con ID interno: '. $negocio->neg_id,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$negocio->neg_id,
                        'bit_modulo'=>"Negocio",
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
