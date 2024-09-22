<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class CatvacanteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Vacantes');
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
        if(!$rol->verificar(17,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(17,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
        $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        $this->response->redirect('index/panel');
        $this->view->disable();
        return;   
        }
        
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $reg = Catvacante::find(array(
            "cav_estatus=2"
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

        if($this->request->isAjax()&&$clave>0)
        {
            $registro=Catvacante::findFirstBycav_id($clave);
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

    public function ajax_catvacantesAction($id)
    {
        $result = [];
        $subs = Catvacante::find(array(
            "cav_estatus=2 and emp_id=".$id
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
            $registro = new Catvacante();
            $registro->cav_nombre= $data['cav_nombre'];
            $registro->cav_estatus=2;
            
            $auth = $this->session->get('auth');
            if($registro->save())
            {
                $auth = $this->session->get('auth');
                $data_bit = [
                    'bit_descripcion'=>'Creó una vacante: '.$data['cav_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$registro->cav_id,
                    'bit_modulo'=>"Vacante catálogo",
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
            $registro=Catvacante::findFirstBycav_id($clave);
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
            $registro=Catvacante::findFirstBycav_id($clave);

            if($registro)
            {
                $registro->cav_nombre=$data["cav_nombreeditar"];
                
                $auth = $this->session->get('auth');
                
                if($registro->save())
                {
                    $auth = $this->session->get('auth');
                    $data_bit = [
                        'bit_descripcion'=>"Editó la vacante con id interno: ".$data["cav_ideditar"].',con nombre '.$registro->cav_nombre,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Vacante catálogo",
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

    public function eliminarAction($cav_id = 0)
    {
        $answer = [
            0 => -1,
            'mensaje' => 'Error al guardar los datos'
        ];
    
        $this->view->disable();
    
        if ($this->request->isAjax() && $cav_id > 0) {
            try {
                $registro = Catvacante::findFirstBycav_id($cav_id);
                $auth = $this->session->get('auth');
    
                if ($registro) {
                    $registro->cav_estatus = -2;
    
                    if ($registro->save()) {
                        $data_bit = [
                            'bit_descripcion'=>'Eliminó la vacante con ID interno: ' . $registro->cav_id,
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$registro->cav_id,
                            'bit_modulo'=>'Vacante catálogo',
                            'bit_accion'=>3
                        ];
                        $this->bitacora_registro($data_bit,$auth);
    
                        $answer[0] = 1;
                        $answer['mensaje'] = 'Éxito al eliminar el registro';
                        $answer['emp_id'] = $registro->emp_id;

                    } else {
                        $answer['mensaje'] = 'Error al guardar los datos';
                    }
                }
            } catch (\Exception $e) {
                $answer['mensaje'] = 'Error en el servidor: ' . $e->getMessage();
            }
    
            $this->response->setJsonContent($answer);
            $this->response->send();
        }
    }
    

    public function tabla_catvacante_empresaAction($emp_id=0){
        try {
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
            $catvacante_empresa = new Builder();
            $catvacante_empresa = $catvacante_empresa
            ->columns(array('ocu.ocu_id,cav.cav_id,cav.cav_nombre,ocu.ocu_nombre,cav.emp_id'))
            ->addFrom('Catvacante', 'cav') ->leftjoin('Ocupacion','ocu.ocu_id=cav.ocu_id','ocu');
        
            if ($emp_id == 0) 
                $catvacante_empresa = $catvacante_empresa->where('cav_estatus = 2');
            else 
                $catvacante_empresa = $catvacante_empresa->where('emp_id = '.$emp_id.' and cav_estatus = 2');
    
        
            $catvacante_empresa = $catvacante_empresa->getQuery()->execute();
        
            // Resto del código
            $auth = $this->session->get('auth');
            $data_bit = [
                'bit_descripcion'=>'Consultó catalogo de vacantes de la empresa con ID '.$emp_id,
                'usu_id'=>$auth['id'],
                'bit_tablaid'=>$emp_id,
                'bit_modulo'=>"Categoriavacantes",
                'bit_accion'=>4
            ];
            $this->bitacora_registro($data_bit,$auth);
        
            $this->view->catvacante_empresa=$catvacante_empresa;

        } catch (\Exception $e) {
            // Manejar la excepción según tus necesidades
            echo 'Ocurrió un error: '.$e->getMessage();
        }
        
        


    }
    public function nuevo_empAction()
    {
        $answer = array();
        $answer[0] = -1;
        $this->view->disable();
    
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
    
            $this->db->begin();
    
            try {
                $auth = $this->session->get('auth');

                $registro = new Catvacante();
                $registro->cav_nombre = $data['cav_nombre'];
                $registro->emp_id = $data['emp_id'];
                $registro->ocu_id = $data['ocu_id'];
                $registro->usu_id = $auth['id'];
                $registro->cav_estatus = 2;
                $registro->save();

                $data_bit = [
                    'bit_descripcion'=>'Creó una vacante: ' . $data['cav_nombre'],
                    'usu_id'=>$auth['id'],
                    'bit_tablaid'=>$registro->cav_id,
                    'bit_modulo'=>"Vacante catálogo",
                    'bit_accion'=>1
                ];
                $this->bitacora_registro($data_bit,$auth);
                $answer[0] = 1;
                $answer[1] = 'Catalogo de vacante creada correctamente';
                $answer['emp_id'] = $registro->emp_id;
    
                $this->db->commit();
            } catch (\Exception $e) {
                $this->db->rollback();
                $answer[0] = 0;
                $answer[1] = "Error en la transacción: " . $e->getMessage();
            }
        } else {
            $answer[0] = -1;
            $answer[1] = "No es una petición Ajax";
        }
    
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function editar_empAction(){
        $answer = array();
        $answer[0] = -1;
        $this->view->disable();
        
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
        
            $this->db->begin();
        
            try {
                $auth = $this->session->get('auth');
                $cav_id = $data['cav_id'];
        
                $registro = Catvacante::findFirst($cav_id);
        
                if ($registro) {
                    $registro->cav_nombre = $data['cav_nombre'];
                    $registro->ocu_id = $data['ocu_id'];
                    $registro->usu_id = $auth['id'];
                    $registro->cav_estatus = 2;
                    $registro->save();

                    $data_bit = [
                        'bit_descripcion'=>'Actualizó una vacante: ' . $data['cav_nombre'],
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$registro->cav_id,
                        'bit_modulo'=>"Vacante catálogo",
                        'bit_accion'=>2
                    ];
                    $this->bitacora_registro($data_bit,$auth);
        
                    $answer[0] = 1;
                    $answer[1] = 'Catálogo de vacante actualizada correctamente';
                    $answer['emp_id'] = $registro->emp_id;
                } else {
                    $answer[0] = 0;
                    $answer[1] = 'No se encontró la vacante con ID: ' . $cav_id;
                }
        
                $this->db->commit();
            } catch (\Exception $e) {
                $this->db->rollback();
                $answer[0] = 0;
                $answer[1] = "Error en la transacción: " . $e->getMessage();
            }
        } else {
            $answer[0] = -1;
            $answer[1] = "No es una petición Ajax";
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    

    
}
