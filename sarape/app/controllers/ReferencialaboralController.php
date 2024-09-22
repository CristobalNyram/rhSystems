<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class ReferencialaboralController extends ControllerBase
{
    public function crearAction()
    {
        $auth = $this->session->get('auth');
        $this->view->disable();
        $answer = [];
        $this->db->begin();

        try {
            if ($this->request->isAjax()) {
                $data = $this->request->getPost();
                $rel = new Referencialaboral();
                $rol = new Rol();
                $permisocalificacion = 0;
                $permisoRh = 0;
                $permisoInvestigador = 1;
                $permisoEscalaDese = 0;
    
                if ($rol->verificar(40, $auth['rol_id'])) {
                    $permisoRh = 1;
                }
    
                if ($rol->verificar(41, $auth['rol_id'])) {
                    $permisoEscalaDese = 1;
                }
    
                $respuesta_modelo = $rel->NuevoRegistro($data, $permisoRh, $permisoInvestigador, $permisoEscalaDese);
    
                if ($respuesta_modelo['estado'] == 2) {
                    $databit = [
                        'bit_descripcion' => 'Registró una referencia laboral con la clave interna del registro ' . $respuesta_modelo['rel_id'],
                        'bit_tablaid' => $respuesta_modelo['rel_id'],
                        'bit_modulo' => "Referencia laboral",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($databit,$auth);
    
                    $answer["estado"] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se guardaron los datos correctamente.';
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
    
                    $this->response->setJsonContent($answer);
                    $this->db->commit();
                    $this->response->send();
                    return;
                } else {
                    $answer["estado"] = -2;
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
            error_log('Ocurrió un error durante el proceso de crear rel'.$e->getMessage());
            $answer["estado"] = -2;
            $answer['titular'] = 'ERROR';
            $answer['mensaje'] = 'Ocurrió un error durante el proceso.';
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }
    
    public function actualizarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $rel_id=$data['rel_id_editar'];
                $buscar_rel=Referencialaboral::findFirst($rel_id);

                if($buscar_rel->rel_estatus!=-2)
                {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion=0;
                    $permisoRh=0;
                    $permisoInvestigador=1;
                    $permisoEscalaDese=0;
                    if($rol->verificar(41,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisoRh=1;  
                    }
                    if($rol->verificar(45,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisoEscalaDese=1;  
                    }
                    $respuesta_modelo = $buscar_rel->ActualizarRegistro($data,$permisoRh,$permisoInvestigador,$permisoEscalaDese);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $databit = [
                                        'bit_descripcion' => 'Editó una referencia laboral con la clave interna del registro'.$respuesta_modelo['rel_id'],
                                        'bit_tablaid' => $respuesta_modelo['rel_id'],
                                        'bit_modulo' => "Referencia laboral",
                                        'usu_id' => $auth['id'],
                                        'vac_id' => 0,
                                        'bit_accion' => 2,
                                    ];

                                    $this->bitacora_registro($databit,$auth);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['rel_id']=$respuesta_modelo['rel_id'];
                                    $answer['sel_id']=$respuesta_modelo['sel_id'];


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
    public function eliminarAction($rel_id=0)
    {
            $rol = new Rol();
            $auth = $this->session->get('auth');

            if (!$rol->verificar(54, $auth['rol_id'])) {
                $this->responderError(2, 'NO TIENE ACCESO', 'No cuenta con los permisos necesarios para acceder a esta característica.');
                return;
            }

            $this->view->disable();
            $answer = [];

            try {
                $this->db->begin();

                if ($this->request->isAjax() && $rel_id != 0 && is_numeric($rel_id)) {
                    $buscar_rel = Referencialaboral::findFirst($rel_id);

                    if ($buscar_rel && $buscar_rel->rel_estatus == 2) {
                        $buscar_rel->rel_estatus = -2;

                        if ($buscar_rel->update()) {
                            $obj_ref = new Referencialaboral();
                            $obj_ref->reordenarDespuesBorrar($buscar_rel->sel_id);

                            $databit = [
                                'bit_descripcion' => 'Eliminó una referencia laboral que tenía por clave interna: ' . $buscar_rel->rel_id,
                                'bit_tablaid' => $buscar_rel->rel_id,
                                'bit_modulo' => "Referencia laboral",
                                'vac_id' => 0,
                                'bit_accion' => 3,
                            ];
                            $this->bitacora_registro($databit, $auth);

                            $answer = [
                                'estado' => 2,
                                'titular' => 'Éxito',
                                'mensaje' => 'Se borraron los datos exitosamente del registro que tenía el ID ' . $buscar_rel->rel_id,
                                'rel_id' => $buscar_rel->rel_id,
                                'sel_id' => $buscar_rel->sel_id,
                            ];
                        } else {
                            throw new \Exception('No se pudieron procesar los datos.');
                        }
                    } else {
                        throw new \Exception('El archivo ha sido modificado anteriormente.');
                    }
                }

                $this->db->commit();

            } catch (\Exception $e) {
                $this->db->rollback();
                $this->responderError(2, 'ERROR', $e->getMessage());
                return;
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
    }



    
    
   
    
    
    public function tablaAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $auth = $this->session->get('auth');

        try {
            $condicion_sql = "";
            $referencialaboral = new Builder();
            $referencialaboral = $referencialaboral
                ->addFrom('Referencialaboral', 'rel');
            if ($id == 0)
                $condicion_sql = 'rel_estatus=2';
            else
                $condicion_sql = 'rel_estatus=2 AND sel_id=' . $id;
        
            $referencialaboral = $referencialaboral->where($condicion_sql);

            $referencialaboral = $referencialaboral->orderBy('rel.rel_orden ASC');    
                
            $referencialaboral = $referencialaboral->getQuery()->execute();
        
            $data_bit = [
                'bit_descripcion' => "Consultó los detalles de referencias laborales que tiene por clave interna: " . $id,
                'bit_tablaid' => $id,
                'bit_modulo' =>  "Referencia laboral",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro($data_bit, $auth);
            $this->view->getSiNoObject=new Referencialaboral();

            $this->view->page = $referencialaboral;
            $this->view->escalaDesempenoObject = new Referencialaboral();
        } catch (\Exception $e) {
            $this->view->page = array();
        }
        
    }
  
    public function ajax_get_detalleAction($rel_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($rel_id!=0 && is_numeric($rel_id)) {
            $subs = Referencialaboral::findFirst(array(
                'rel_id='.$rel_id,
                'rel_estatus=2'));

                if ($subs) 
                $result = $subs->toArray();
            
        }
       
        return $this->response->setJsonContent($result);
    }


    public function ajax_set_orden_abajoAction($rel_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['rel_id'] = $rel_id;
        $authF['id'] = 0;
        if(!$rol->verificar(94,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bd
           return  $this->responderError(-2,'ERROR','FALTA DE PERMISOS');
    

        $this->db->begin();
        try {
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al cambiar el orden de referencias laborales',
                'titular' => 'Error',
            ];
            $mensaje_extra = '';
            $mensaje_extra_json = '';
            $rel = new Referencialaboral();

            
            if (!$this->request->isAjax() || !is_numeric($rel_id) || $rel_id==0) 
                throw new Exception("Error al enviar datos.");
            
                $respuesta_modelo = $rel->CambiarOrdenAbajo($rel_id);
    
                if ($respuesta_modelo['estado'] == 2) {
        
                    $answer["estado"] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se ordenó  correctamente la referencia laboral  No. '.$rel_id;
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
                    $databit = [
                        'bit_descripcion' => 'Cambió el orden de referencia laboral con la clave interna del registro ' . $respuesta_modelo['rel_id'],
                        'bit_tablaid' => $respuesta_modelo['rel_id'],
                        'bit_modulo' => "Referencia laboral",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($databit,$auth);
                    $this->db->commit();
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                } else {
                    $answer["estado"] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se pudieron procesar los datos. '.$respuesta_modelo['mensaje'];
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
                    $answer['res_modelo'] = $respuesta_modelo;
                    $this->response->setJsonContent($answer);
                    $this->db->rollback();
                    $this->response->send();
                    return;
                
            
                }
            
            
        } catch (Exception $e) {
    
                // El error es una Notice
                $this->db->rollback();
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $answer['detalle'] = $mensaje;
                $answer['detalle_mas'] = 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea;
                $data_bit = [
                    'bit_descripcion' => "Error en el cambiar orden para arriba :".$answer['detalle_mas'],
                    'bit_tablaid' => $rel_id,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 2,
                ];
                $this->bitacora_registro($data_bit, $authF);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        
        }

    }

    public function ajax_set_orden_arribaAction($rel_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $this->view->disable();
        $answer = array();
        $answer['rel_id'] = $rel_id;
        $authF=0;
        if(!$rol->verificar(94,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bd
             return  $this->responderError(-2,'ERROR','FALTA DE PERMISOS');


        $this->db->begin();
        try {
            $answer = [
                'estado' => -2,
                'mensaje' => 'Se produjo un error al cambiar el orden de referencias laborales',
                'titular' => 'Error',
            ];
            $mensaje_extra = '';
            $mensaje_extra_json = '';
            $rel = new Referencialaboral();
            
            if (!$this->request->isAjax() || !is_numeric($rel_id) || $rel_id==0) 
                throw new Exception("Error al enviar datos.");
            

                $respuesta_modelo = $rel->CambiarOrdenArriba($rel_id);
    
                if ($respuesta_modelo['estado'] == 2) {
                    $answer["estado"] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se ordenó  correctamente la referencia laboral  No. '.$rel_id;
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
                    $databit = [
                        'bit_descripcion' => 'Cambió el orden de referencia laboral con la clave interna del registro ' . $respuesta_modelo['rel_id'],
                        'bit_tablaid' => $respuesta_modelo['rel_id'],
                        'bit_modulo' => "Referencia laboral",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($databit,$auth);
                    $this->db->commit();
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                } else {
                    $answer["estado"] = -2;
                    $answer['titular'] = 'AVISO';
                    $answer['mensaje'] = 'No se pudieron procesar los datos. '.$respuesta_modelo['mensaje'];
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
                    $answer['res_modelo'] = $respuesta_modelo;
                    $this->response->setJsonContent($answer);
                    $this->db->rollback();
                    $this->response->send();
                    return;
                }
            
            
            
        } catch (Exception $e) {
    
                // El error es una Notice
                $this->db->rollback();
                $mensaje = $e->getMessage();
                $clase = get_class($e);
                $linea = $e->getLine();
                $answer['detalle'] = $mensaje;
                $answer['detalle_mas'] = 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea;
                $data_bit = [
                    'bit_descripcion' => "Error en el cambiar orden para abajo :".$answer['detalle_mas'],
                    'bit_tablaid' => $rel_id,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 2,
                ];
                $this->bitacora_registro($data_bit, $authF);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        
        }

    }



   
}