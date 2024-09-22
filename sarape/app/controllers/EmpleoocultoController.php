<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Query;
use Phalcon\Di;

require_once("tinify/vendor/autoload.php");
\Tinify\setKey("wvMw7Jxtk9nN4CHBCbBVKBQLw0MNll2c");

class EmpleoocultoController extends ControllerBase
{
    public function tablaAction($id = 0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');
    
        try {
            $condicion_sql = ($id == 0) ? 'epl_estatus = 2' : 'sel_id = ' . $id . ' AND epl_estatus = 2';
    
            $empleosocultos = new Builder();
            $empleosocultos = $empleosocultos->addFrom('Empleooculto', 'epl')
                ->where($condicion_sql)
                ->getQuery()
                ->execute();
    
            $databit = [
                'bit_descripcion' => "Consultó los detalles de empleos ocultos con clave interna: " . $id,
                'bit_tablaid' => $id,
                'vac_id' => 0,
                'bit_accion' =>4,
                'bit_modulo' => "Empleos ocultos"
            ];
            $this->bitacora_registro($databit,$auth);
    
            $this->view->page = $empleosocultos;
            $this->view->obj_epl = new Empleooculto();
        } catch (\Exception $e) {
            $this->view->page = array();
        }
    }
    

    public function eliminarAction($epl_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $epl_id!=0 and is_numeric($epl_id))
        {
            $buscar_epl=Empleooculto::findFirst($epl_id);
            if($buscar_epl->epl_estatus==2)
            {
                $buscar_epl->epl_estatus=-2;

                    if($buscar_epl->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó un empleo oculto que tenía por clave interna: '.$buscar_epl->epl_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_epl->epl_id;
                        $databit['bit_modulo']="Empleo oculto.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_epl->epl_id;
                        $answer['epl_id']= $buscar_epl->epl_id;
                        $answer['sel_id']= $buscar_epl->sel_id;
                 
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;  

                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='No se pudieron procesar los datos.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;    
                        
                    }
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            
        }
        
    }
    public function crear_generalAction()
    {
        
        $auth = $this->session->get('auth');
        $this->view->disable();
        $answer = [
            'estado' => -2,
            'mensaje' => "ERROR GENERAL",
            'titular' => 'ERROR',
        ];
    
        try {
            if ($this->request->isAjax()) {
                $data = $this->request->getPost();
                $epl = new Empleooculto();
    
                $this->db->begin();
                $respuesta_modelo_epl = $epl->NuevoRegistro($data);
    
                if ($respuesta_modelo_epl['estado'] == 2) {
    
                    $databit = [
                        'bit_descripcion' => 'Registró un empleo oculto con la clave interna del registro ' . $respuesta_modelo_epl['epl_id'],
                        'bit_tablaid' => $respuesta_modelo_epl['epl_id'],
                        'bit_modulo' => "Empleo oculto",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($databit, $auth);
    
                    $answer['estado'] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se guardaron los datos correctamente.';
                    $answer['epl_id'] = $respuesta_modelo_epl['epl_id'];
                    $answer['sel_id'] = $respuesta_modelo_epl['sel_id'];
    
                    $this->response->setJsonContent($answer);
                    $this->db->commit();
                    $this->response->send();
                    return;
                } else {
                    $answer['estado'] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se pudieron procesar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->db->rollback();
                    $this->response->send();
                    return;
                }
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }
    
    public function actualizar_generalAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $epl_id=$data['epl_id'];
                $buscar_epl=Empleooculto::findFirst($epl_id);

                if($buscar_epl->epl_estatus!=-2)
                {

                    $respuesta_modelo_epl = $buscar_epl->ActualizarRegistro($data);
                                if($respuesta_modelo_epl['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó un empleo oculto con la clave intenar del registro'.$respuesta_modelo_epl['epl_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo_epl['epl_id'];
                                    $databit['bit_modulo']="Empleo oculto";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['epl_id']=$respuesta_modelo_epl['epl_id'];
                                    $answer['sel_id']=$respuesta_modelo_epl['sel_id'];


                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    
                                }
                                else
                                {
                                    $answer[0]=-2;
                                    $answer['titular']='ERROR';
                                    $answer['mensaje']='No se procesaron los datos correctamente';
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    

                                }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
        
    }
    public function ajax_get_detalleAction($epl_id)
    {

        $this->view->disable();
        $answer=array();

        if ($epl_id!=0 && is_numeric($epl_id)) {
            $subs = Empleooculto::findFirst(array(
                'epl_id='.$epl_id,
                'epl_estatus=2'));

                if ($subs->epl_estatus==2) {
                    $answer[0]=2;
                    $answer['data']= $result = $subs->toArray();
                    $answer['titular']='OK';
                    $answer['mensaje']='OK';
                   
                }
                else{
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                    return;    
                }
                
            
        }
        else{
            
            $answer[0]=-2;
            $answer['titular']='NO DISPONIBLE';
            $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
            return;    
        }
       
        return $this->response->setJsonContent($answer);

    }
}

