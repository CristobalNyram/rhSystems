<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class TipopagoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Tipo pago');
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
        if(!$rol->verificar(74,$auth['rol_id']))  
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
        $reg = Tipopago::find(array(
            "tpg_estatus=2"
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
        if(!$rol->verificar(74,$auth['rol_id'])) 
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
            $registro=Tipopago::findFirstBytpg_id($clave);
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

    public function ajax_tpgAction()
    {
        $result = [];
        $subs = Tipopago::find(array(
            "tpg_estatus=2"
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
        $answer['mensaje']='ERROR';
        $this->view->disable();
        if($this->request->isAjax())
        {
            $this->db->begin(); 
            try {
                $data = $this->request->getPost();
                $registro = new Tipopago();
                $registro->tpg_nombre= $data['tpg_nombre'];
                $registro->tpg_estatus=2;
            
                $auth = $this->session->get('auth');
                if($registro->save())
                {
                    $data_bit = [
                        'bit_descripcion'=>'Creó un tipo pago: '.$data['tpg_nombre'],
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$registro->tpg_id,
                        'bit_modulo'=>"Tipo pago",
                        'bit_accion'=>1
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $answer[0]=1;
                    $this->db->commit();
                }
                else{
                    throw new Exception("Error al crear un nuevo registro de tipo pago");
                }
            } catch (\Exception $e) {
                $this->db->rollback(); 
                $error_msg = "Excepción al crear un tipo pago: " . $e->getMessage();
                error_log($error_msg);

                $answer[0] = -1;
                $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;  
        }
        else{
            $answer[0]=-1;
            $answer['mensaje']='Error al crear un nuevo registro';
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

    public function buseditarAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        
        if($this->request->isAjax()&&$clave>0)
        {
            $registro=Tipopago::findFirstBytpg_id($clave);
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
        $answer['mensaje']='ERROR';
        $this->view->disable();

        if($this->request->isAjax()&&$clave>0)
        {
            $this->db->begin(); 
            try {
                $auth = $this->session->get('auth');
                $data = $this->request->getPost();
                $registro=Tipopago::findFirstBytpg_id($clave);

                if($registro)
                {
                    $registro->tpg_nombre=$data["tpg_nombreeditar"];
                    
                    $auth = $this->session->get('auth');
                    
                    if($registro->save())
                    {
                        $data_bit = [
                            'bit_descripcion'=>"Editó un tipo pago con id interno: ".$data["tpg_ideditar"].', con nombre '.$registro->tpg_nombre,
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$clave,
                            'bit_modulo'=>"Tipo pago",
                            'bit_accion'=>2
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        $answer[0]=1;
                        $this->db->commit();
                    }
                    else
                    {
                        throw new Exception("Error al editar registro de tipo pago");
                    }
                }else{
                    throw new Exception("Error con registro de tipo pago");
                }
            } catch (\Exception $e) {
                $this->db->rollback(); 
                $error_msg = "Excepción en editar tipo pago: " . $e->getMessage();
                error_log($error_msg);

                $answer[0] = -1;
                $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
            return;   
        }else{
            $answer[0]=-1;
            $answer['mensaje']='Error al editar los datos';
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
        
    }


    public function eliminarAction($reg_id = 0)
    {
        $answer = array();
        $answer[0] = -1;
        $answer['mensaje']='ERROR';
        $this->view->disable();

        if ($this->request->isAjax() && $reg_id > 0) {
            $this->db->begin(); 

            try {
                $registro = Tipopago::findFirstBytpg_id($reg_id);
                $auth = $this->session->get('auth');

                if ($registro) {
                    $registro->tpg_estatus = -2;

                    if ($registro->save()) {
                        $data_bit = [
                            'bit_descripcion'=>'Eliminó el tipo pago con ID interno: ' . $registro->tpg_id,
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$registro->tpg_id,
                            'bit_modulo'=>"Tipo pago",
                            'bit_accion'=>3
                        ];
                        $this->bitacora_registro($data_bit,$auth);


                        $answer[0] = 1;
                        $answer['mensaje'] = "Éxito al eliminar el registro";

                        $this->db->commit();
                    } else {
                        throw new Exception("Error al guardar los datos");
                    }
                } else {
                    throw new Exception("Error al guardar los datos");
                }
            } catch (\Exception $e) {
                $this->db->rollback(); 
                $error_msg = "Excepción en eliminar tipo pago: " . $e->getMessage();
                error_log($error_msg);

                $answer[0] = -1;
                $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }else{
            $answer[0]=-1;
            $answer['mensaje']='Error al eliminar los datos';
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

}