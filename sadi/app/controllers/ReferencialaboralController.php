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
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $rel= new Referencialaboral() ;
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
       
            $respuesta_modelo= $rel->NuevoRegistro($data,$permisoRh,$permisoInvestigador,$permisoEscalaDese);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia laboral con la clave interna del registro '.$respuesta_modelo['rel_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['rel_id'];
                $databit['bit_modulo']="Referencia laboral";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sel_id']=$respuesta_modelo['sel_id'];
                $answer['rel_id']=$respuesta_modelo['rel_id'];


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
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia laboral con la clave interna del registro '.$respuesta_modelo['rel_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['rel_id'];
                                    $databit['bit_modulo']="Referencia laboral";
                                    $bitacora->NuevoRegistro($databit);
                                   
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
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Eliminó una referencia laboral que tenía por clave interna: ' . $buscar_rel->rel_id;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$rel_id;
                            $databit['bit_modulo']="Referencia laboral";
                            $bitacora->NuevoRegistro($databit);
                            $answer = [
                                 0 => 2,
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
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'ERROR al eliminar referencia laboral ' . $e->getMessage();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$rel_id;
                $databit['bit_modulo']="ERROR";
                $bitacora->NuevoRegistro($databit);
                $this->responderError(2, 'ERROR', $e->getMessage());
                return;
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
    }

    
    
    public function tablagabtubosAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referencialaboral=new Builder();
            $referencialaboral=$referencialaboral
            ->addFrom('Referencialaboral','rel')
            ->where('rel_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','rel')
                ->where('sel_id='.$id.' and rel_estatus=2')
                ->orderBy('rel.rel_orden ASC')   
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias laborales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia laboral;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$referencialaboral;
        $this->view->getSiNoObject=new Referenciavecinal();
        $this->view->escalaDesempenoObject=new Referencialaboral();


    }
    
    
    public function tablaAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referencialaboral=new Builder();
            $referencialaboral=$referencialaboral
            ->addFrom('Referencialaboral','rel')
            ->where('rel_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','rel')
                ->where('sel_id='.$id.' and rel_estatus=2')
                ->orderBy('rel.rel_orden ASC')   
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias laborales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia laboral;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$referencialaboral;
        $this->view->getSiNoObject=new Referenciavecinal();
        $this->view->escalaDesempenoObject=new Referencialaboral();


    }
    public function tabla_truperAction($id=0){
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referencialaboral=new Builder();
            $referencialaboral=$referencialaboral
            ->addFrom('Referencialaboral','rel')
            ->where('rel_estatus=2')
            ->orderBy('rel.rel_orden ASC')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','rel')
                ->where('sel_id='.$id.' and rel_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias laborales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia laboral;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$referencialaboral;
        $this->view->getSiNoObject=new Referenciavecinal();
        $this->view->escalaDesempenoObject=new Referencialaboral();
        $this->view->objeRefLab=new Referencialaboral();

    }
    public function tablagabtencognvAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referencialaboral=new Builder();
            $referencialaboral=$referencialaboral
            ->addFrom('Referencialaboral','rel')
            ->where('rel_estatus=2')
            ->orderBy('rel.rel_orden ASC')   
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referencialaboral=new Builder();
                $referencialaboral=$referencialaboral
                ->addFrom('Referencialaboral','rel')
                ->where('sel_id='.$id.' and rel_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias laborales que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia laboral;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$referencialaboral;
        $this->view->getSiNoObject=new Referenciavecinal();
        $this->view->escalaDesempenoObject=new Referencialaboral();


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

    public function crear_formato_truperAction(){
        
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $data_trayectoria_laboral=[];

            $rel= new Referencialaboral() ;
            $tray= new Trayectorialaboral() ;

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
         
            $data_trayectoria_laboral['tyl_empresamarca']=$data['rel_candidatoempresa'];
            $data_trayectoria_laboral['tyl_empresacontratante']=$data['rel_candidatoempresa'];
            $data_trayectoria_laboral['tyl_periodo']=$data['rel_candidatoingreso'];
            $data_trayectoria_laboral['tyl_comentario']=$data['rel_notas'];
            $data_trayectoria_laboral['sel_id']=$data['sel_id'];


            $respuesta_modelo= $rel->NuevoRegistroFormatoTruper($data,$permisoRh,$permisoInvestigador,$permisoEscalaDese);
            $respuesta_modelo_tray_laboral= $tray->NuevoRegistroFormatoTruper($data_trayectoria_laboral);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia laboral con la clave interna del registro '.$respuesta_modelo['rel_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['rel_id'];
                $databit['bit_modulo']="Referencia laboral";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sel_id']=$respuesta_modelo['sel_id'];
                $answer['rel_id']=$respuesta_modelo['rel_id'];


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

    }

    public function actualizar_formato_truperAction(){
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
                        $permisoRh=1;  
                    
                    if($rol->verificar(45,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                        $permisoEscalaDese=1;  
                    
                    $respuesta_modelo = $buscar_rel->ActualizarRegistroFormatoTruper($data,$permisoRh,$permisoInvestigador,$permisoEscalaDese);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia laboral con la clave interna del registro '.$respuesta_modelo['rel_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['rel_id'];
                                    $databit['bit_modulo']="Referencia laboral";
                                    $bitacora->NuevoRegistro($databit);
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
    
    public function ajax_set_orden_abajoAction($rel_id=0){
        $this->view->disable();
        $rol = new Rol();
        $auth = $this->session->get('auth');
        //error_log('orden abajo');
        if(!$rol->verificar(90,$auth['rol_id'])) 
           return $this->responderError(-2,'ERROR ','NO TIENES PERMISOS PARA ESTA CARACTERISTICA');
    

        $this->db->begin();
        try {
            $authF['id'] = 0;
            $answer = array();
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
            
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Cambió el orden (abajo) de referencia laboral con la clave interna del registro ' . $respuesta_modelo['rel_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$rel_id;
                    $databit['bit_modulo']="Referencia laboral";
                    $bitacora->NuevoRegistro($databit);
                    $this->db->commit();
                    $answer["estado"] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se ordenó  correctamente la referencia laboral  No. '.$rel_id;
                    //error_log($answer['mensaje']);
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                } else {
                    $answer["estado"] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se pudieron procesar los datos. '.$respuesta_modelo['mensaje'];
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
                //error_log($answer['detalle_mas']);
                $bitacora= new Bitacora();
                $databit['bit_descripcion']=  "Error en el cambiar orden para abajo :".$answer['detalle_mas'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$rel_id;
                $databit['bit_modulo']="Referencia laboral";
                $bitacora->NuevoRegistro($databit);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        
        }

    }

    public function ajax_set_orden_arribaAction($rel_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $this->view->disable();
        //error_log('orden arriba');
        if(!$rol->verificar(90,$auth['rol_id'])) 
                return $this->responderError(-2,'ERROR ','NO TIENES PERMISOS PARA ESTA CARACTERISTICA');
    

        $this->db->begin();
        try {
            $authF['id'] = 0;
            $answer = array();
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
                  
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Cambió el orden (arriba) de referencia laboral con la clave interna del registro ' . $respuesta_modelo['rel_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['rel_id'];
                    $databit['bit_modulo']="Referencia laboral";
                    $bitacora->NuevoRegistro($databit);

                    $answer["estado"] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se ordenó  correctamente la referencia laboral  No. '.$rel_id;
                    $answer['sel_id'] = $respuesta_modelo['sel_id'];
                    $answer['rel_id'] = $respuesta_modelo['rel_id'];
                    $this->db->commit();
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;

                } else {
                    $answer["estado"] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se pudieron procesar los datos. '.$respuesta_modelo['mensaje'];
                    $answer['res_modelo'] = $respuesta_modelo;
                    $this->db->rollback();
                    $this->response->setJsonContent($answer);
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
                error_log($answer['detalle_mas']);
                $bitacora= new Bitacora();
                $databit['bit_descripcion']=  "Error en el cambiar orden para arriba :".$answer['detalle_mas'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$rel_id;
                $databit['bit_modulo']="Referencia laboral";
                $bitacora->NuevoRegistro($databit);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
        }

    }

}