<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class MedioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Tipo pago');
        parent::initialize();
        
    }
    public function ajax_mediosAction()
    {
        $this->view->disable();

        $answer=[];
        $answer["estado"]=-2;
        $answer["mensaje"]="error";
        $answer["titular"]="error";
        $answer["data"] = [];
        $subs = Medio::find(array(
            "med_estatus=2"
            ));
        if ($subs) {
            $answer["data"] = $subs->toArray();

        }
       
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }


   

    /**
     * [indexAction Index para la tabla medio]
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

  
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $reg = Medio::find(array(
            "med_estatus=2"
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
            $registro=Medio::findFirs($clave);
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

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $answer['mensaje']='ERROR';
        $data = $this->request->getPost();
        $auth = $this->session->get('auth');
        $this->view->disable();
      

        if($this->request->isAjax())
        {
            $this->db->begin(); 
            try {
                $registro = new Medio();
                $registro->med_nombre= "sas";
                $registro->med_estatus=2;
            
                if($registro->save())
                {
                    $data_bit = [
                        'bit_descripcion'=>'Creó un  medio : '.$data['med_nombre'],
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$registro->med_id,
                        'bit_modulo'=>"Medio",
                        'bit_accion'=>1
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $answer[0]=1;
                    $this->db->commit();
                }
                else{
                    throw new Exception("Error al crear un nuevo registro del medio");
                }
            } catch (\Exception $e) {
                $this->db->rollback(); 
                $error_msg = "Excepción al crear un medio: " . $e->getMessage();
                error_log($error_msg);

                $answer[0] = -1;
                $answer["data"] = $data;
                $answer['mensaje_adicional'] = 'Detalles de la excepción: ' . $e->getTraceAsString(); // Esto proporcionará una traza de la excepción.

                $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;  
        }
        else{
            $answer[0]=-2;
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
            $registro=Medio::findFirst($clave);
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
                $registro=Medio::findFirst($clave);

                if($registro)
                {
                    $registro->med_nombre=$data["med_nombreeditar"];
                    
                    $auth = $this->session->get('auth');
                    
                    if($registro->save())
                    {
                        $data_bit = [
                            'bit_descripcion'=>"Editó un medio contacto con id interno: ".$registro->med_id.', con nombre '.$registro->med_nombre,
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$clave,
                            'bit_modulo'=>"Medio",
                            'bit_accion'=>2
                        ];
                        $this->bitacora_registro($data_bit,$auth);
                        $answer[0]=1;
                        $this->db->commit();
                    }
                    else
                    {
                        throw new Exception("Error al editar registro de medio de contacto");
                    }
                }else{
                    throw new Exception("Error con registro de medio de contacto");
                }
            } catch (\Exception $e) {
                $this->db->rollback(); 
                $error_msg = "Excepción en editar medio de contacto: " . $e->getMessage();
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
                $registro = Medio::findFirst($reg_id);
                $auth = $this->session->get('auth');

                if ($registro) {
                    $registro->med_estatus = -2;

                    if ($registro->save()) {
                        $data_bit = [
                            'bit_descripcion'=>'Eliminó el tipo pago con ID interno: ' . $registro->med_id,
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$registro->med_id,
                            'bit_modulo'=>"Medio",
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
                $error_msg = "Excepción en eliminar medio de contacto: " . $e->getMessage();
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