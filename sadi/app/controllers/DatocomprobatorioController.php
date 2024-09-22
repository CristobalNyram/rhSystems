<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
class DatocomprobatorioController extends ControllerBase
{


    //esta función se encarga de crear o autalizar los datos de la tabla de datos comprobatorios ,hace la creación en base a un id de estudio 
    public function ajax_set_updateAction()
    {

        $this->view->disable();
        $answer = array();
        $this->db->begin();
        try {

            if (!$this->request->isAjax()) {
                throw new Exception("SOLICITUD CON FORMATO INCORRECTO");
            }

            $data = $this->request->getPost();
            $datosComprobatorioBuscar = Datocomprobatorio::findFirstByese_id($data['cop_ese_id']);

            $ese_data = $data['ese'];
            $ese_data['ese_nss'] = $data['cop_imssfolio'];
            $ese_data['ese_curp'] = $data['cop_curpfolio'];

            if (!$this->numerovalidoInputValido($ese_data["est_id"])) {
                throw new Exception("FALTA EL ESTADO...");
            }

            $ese_cop = Estudio::findFirstByese_id($data['cop_ese_id']);
            $respuesta_modelo_ese = $ese_cop->ActualizarRegistroEseDatoComprobatorio($ese_data);

            if ($datosComprobatorioBuscar) {
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion = 0;
                if ($rol->verificar(40, $auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion = 1;
                }
                $respuesta_modelo = $datosComprobatorioBuscar->ActualizarRegistro($data, $permisocalificacion);
                if ($respuesta_modelo['estado'] == 2) {
                    $auth = $this->session->get('auth');

                    $bitacora = new Bitacora();
                    $databit['bit_descripcion'] = 'Actualizó los datos comprobatorios del estudio número ' . $data['cop_ese_id'] . ' el ID  interno de datos comprobatorios es ' . $respuesta_modelo['id_actualizo'];
                    $databit['usu_id'] = $auth['id'];
                    $databit['bit_tablaid'] = $respuesta_modelo['id_actualizo'];
                    $databit['bit_modulo'] = "Datos comprobatorios";
                    $bitacora->NuevoRegistro($databit);

                    $answer[0] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se actualizaron los datos correctamente';
                    $answer['ese_id'] = $data['cop_ese_id'];
                    $this->db->commit();
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                } else {
                    $answer[0] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se actualizaron los datos correctamente';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
            } else {
                $datosComprobatorio = new Datocomprobatorio();
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion = 0;
                if ($rol->verificar(40, $auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion = 1;
                }

                $respuesta_modelo = $datosComprobatorio->NuevoRegistro($data, $permisocalificacion);
                if ($respuesta_modelo['estado'] == 2) {
                    $auth = $this->session->get('auth');

                    $bitacora = new Bitacora();
                    $databit['bit_descripcion'] = 'Actualizó los datos comprobatorios del estudio número ' . $data['cop_ese_id'] . ' el ID  interno de datos comprobatorios es ' . $respuesta_modelo['id_nuevo'];
                    $databit['usu_id'] = $auth['id'];
                    $databit['bit_tablaid'] = $respuesta_modelo['id_nuevo'];
                    $databit['bit_modulo'] = "Datos comprobatorios";
                    $bitacora->NuevoRegistro($databit);

                    $answer[0] = 2;
                    $answer['titular'] = 'Éxito';
                    $answer['mensaje'] = 'Se actualizaron los datos correctamente';
                    $answer['ese_id'] = $data['cop_ese_id'];
                    $this->db->commit();
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                } else {
                    $answer[0] = -2;
                    $answer['titular'] = 'ERROR';
                    $answer['mensaje'] = 'No se actualizaron los datos correctamente';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
            }
        } catch (\Throwable $e) {
            $this->db->rollback();
            error_log("ERROR EN ajax_set_updateAction " . $e->getMessage());
            $answer[0] = -2;
            $answer['titular'] = 'ERROR';
            $answer['mensaje'] = 'No se actualizaron los datos correctamente';
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

    public function ajax_get_especificoAction($id=0)
    {
        $this->view->disable();
        $result = [];

        if ($id!=0 && is_numeric($id)) {
                $subs = Datocomprobatorio::find(array(
                    'ese_id='.$id,
                    'cop_estatus=2'));

                if ($subs) {
                    $result = $subs->toArray();
                }
        }
        
        return $this->response->setJsonContent($result);
    }
    public function ajax_set_update_formato_gabtubosAction()
    {
      
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {

            $data = $this->request->getPost();
        
            $datosComprobatorioBuscar =Datocomprobatorio::findFirstByese_id($data['cop_ese_id']);
            
            $ese_data=$data['ese'];
            
            
            $ese_cop=Estudio::findFirstByese_id($data['cop_ese_id']);
            $ese_data['ese_nss'] = $ese_cop['cop_imssfolio'];
            $respuesta_modelo_ese=$ese_cop->ActualizarRegistroEseDatoComprobatorio($ese_data);
        

            
            if($datosComprobatorioBuscar)
            {
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion=0;
                if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion=1;  
                }
                 $respuesta_modelo = $datosComprobatorioBuscar->ActualizarRegistro($data,$permisocalificacion);
                 if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');

                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Actualizó los datos comprobatorios del estudio número '.$data['cop_ese_id'].' el ID  interno de datos comprobatorios es '.$respuesta_modelo['id_actualizo'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['id_actualizo'];
                    $databit['bit_modulo']="Datos comprobatorios";
                    $bitacora->NuevoRegistro($databit);
                    
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se actualizaron los datos correctamente';
                    $answer['ese_id']=$data['cop_ese_id'];

                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se actualizaron los datos correctamente';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

            }
            else
            {
                $datosComprobatorio= new Datocomprobatorio();
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion=0;
                if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion=1;  
                } 

               $respuesta_modelo = $datosComprobatorio->NuevoRegistro($data,$permisocalificacion);
               if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');

                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Actualizó los datos comprobatorios del estudio número '.$data['cop_ese_id'].' el ID  interno de datos comprobatorios es '.$respuesta_modelo['id_nuevo'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['id_nuevo'];
                    $databit['bit_modulo']="Datos comprobatorios";
                    $bitacora->NuevoRegistro($databit);
                    
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se actualizaron los datos correctamente';
                    $answer['ese_id']=$data['cop_ese_id'];

                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se actualizaron los datos correctamente';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

            }
        }

    }

    public function ajax_set_update_formato_gabencognvAction()
    {
      
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
    
            
            $ese_data=$data['ese'];
            $ese_modelo=Estudio::findFirstByese_id($ese_data['ese_id']);
         
            if( $ese_modelo->ese_estatus==='-2')
            {
           
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No está disponible este registro';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }

            $respuesta_modelo_ese=$ese_modelo->ActualizarRegistroEseDatoComprobatorio_formato_gabencognv($ese_data);
            if($respuesta_modelo_ese['estado']==2)
            {
                $auth = $this->session->get('auth');

                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Actualizó información del estudio No.'.$ese_data['ese_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$ese_data['ese_id'];
                $databit['bit_modulo']="Datos comprobatorios -ESTUDIO";
                $bitacora->NuevoRegistro($databit);
                
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se actualizaron los datos correctamente';
                $answer['ese_id']=$ese_data['ese_id'];

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se actualizaron los datos correctamente';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }

        }

    }

    public function ajax_encontrar_o_crearAction($ese_id){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {

            $data = $this->request->getPost();

            $modelo_datos_comprobatorio= new Datocomprobatorio();

            $respuesta_modelo=$modelo_datos_comprobatorio->encontrar_o_crear($ese_id);
            $estudio_data =Estudio::findFirstByese_id($ese_id);

            if( $respuesta_modelo['estado']==2){
                $answer[0]=2;
                $answer['titular']='OK';
                $answer['mensaje']='ok';
                $answer['data']=$respuesta_modelo['data'];
                $answer['estudio_data']=$estudio_data;

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;   
            }

            
            

        }

    }

    public function ajax_set_update_formato_truperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $datosComprobatorio =Datocomprobatorio::findFirstBycop_id($data['cop_id']);
            $dataEseComprobatorios =Estudio::findFirstByese_id($data['ese_id']);


            $respuesta_modelo= $datosComprobatorio->ActualizarFormatoTruper($data);
            $respuesta_modelo_ese=$dataEseComprobatorios->ActualizarImssCurp($data);

            if($respuesta_modelo['estado']==2 && $respuesta_modelo_ese['estado']==2){

                $auth = $this->session->get('auth');

                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Actualizó información de datos comprobataorios que tienen por ID'.$data['cop_id'].' al estudio  No.'.$data['ese_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$data['ese_id'];
                $databit['bit_modulo']="Datos comprobatorios ";
                $bitacora->NuevoRegistro($databit);
                
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se actualizaron los datos correctamente';
                $answer['ese_id']=$data['ese_id'];

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }else{
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se actualizaron los datos correctamente';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            

    
            
            
     

        }

        
    }

        
}