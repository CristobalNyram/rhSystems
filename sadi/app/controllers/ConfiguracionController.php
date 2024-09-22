<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
class ConfiguracionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Configuración');
        parent::initialize();
        $this->view->ocultaredicionarchivo = 1;    
        
    }

    public function apariencia_indexAction()
    {
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        
        if(!$rol->verificar(85,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');


        $configuracion_modelo = new Configuracion();
        $fondo_barra_superior = $configuracion_modelo->getFondoBarraSuperior();
        $border_barra_superior = $configuracion_modelo->getBorderBarraSuperior();
        $cabezera_datatable_color = $configuracion_modelo->getColorHeadDataTable();
       
        $btn_confirmar_fondo = $configuracion_modelo->getBtnConfirmarFondo();
        $btn_confirmar_fondo_hover = $configuracion_modelo->getBtnConfirmarFondoHover();
        $btn_cancelar_fondo = $configuracion_modelo->getBtnCancelarFondo();
        $btn_cancelar_fondo_hover = $configuracion_modelo->getBtnCancelarFondoHover();
        $iconos_opciones=$configuracion_modelo->getIconosOpciones();
        $fondo_sistema_general=$configuracion_modelo->getFondoSistemaGeneral();

        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingresó a módulo de de configuracion de apariencia";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Dashboard";
        $bitacora->NuevoRegistro($databit);

        $this->tag->setTitle('Apariencia');
        $this->view->fondo_barra_superior= $fondo_barra_superior;
        $this->view->border_barra_superior= $border_barra_superior;
        $this->view->cabezera_datatable_color= $cabezera_datatable_color;

        $this->view->btn_confirmar_fondo= $btn_confirmar_fondo;
        $this->view->btn_confirmar_fondo_hover= $btn_confirmar_fondo_hover;
        $this->view->btn_cancelar_fondo= $btn_cancelar_fondo;
        $this->view->btn_cancelar_fondo_hover= $btn_cancelar_fondo_hover;
        $this->view->iconos_opciones= $iconos_opciones;
        $this->view->fondo_sistema_general= $fondo_sistema_general;


    }
    public function actualizar_aparienciaAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            $data = $this->request->getPost();

            $cof= new Configuracion() ;
            $auth = $this->session->get('auth');

            $respuesta_modelo= $cof->actualizar_elementos_apariencia($data);

                if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Actualizó elementos gráficos del sistema';
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=0;
                    $databit['bit_modulo']="Configuración";
                    $bitacora->NuevoRegistro($databit);
                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Actualizaron elementos gráficos del sistema .';      
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


               

         
        }else{
            return http_response_code(400);

        }
    }

    public function correos_indexAction(){
           
        $rol = new Rol();
        $auth = $this->session->get('auth');
        
        if(!$rol->verificar(95,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            $this->response->redirect('errors/errorpermiso');


        $configuracion_modelo = new Configuracion();
        $estatus_envio_correos = $configuracion_modelo->getEstatusEnvioCorreosSistema();

        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingresó a módulo de de configuracion de envio de correos del sistema";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Configuración";
        $bitacora->NuevoRegistro($databit);
        $this->tag->setTitle('Envio de correos');
        $this->view->estatus_envio_correos= $estatus_envio_correos;
   
    }

    public function obtener_linkAction(){
        $rol = new Rol();
        $this->tag->setTitle('Links');
        $auth = $this->session->get('auth');
        if(!$rol->verificar(91,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
             $this->response->redirect('errors/errorpermiso');
       
        $data_bit = [
                'bit_descripcion'=>"Ingresó a módulo de encriptar y desencriptar",
                'usu_id'=>$auth['id'],
                'bit_tablaid'=>0,
                'bit_modulo'=>"Configuración",
                'bit_accion'=>4
        ];
       // $this->bitacora_registro($data_bit,$auth);    
    }

    public function actualizar_envio_correoAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            $data = $this->request->getPost();

            $cof= new Configuracion() ;
            $auth = $this->session->get('auth');

            $respuesta_modelo= $cof->actualizar_config_correo($data);

                if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Actualizó config del correo';
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=0;
                    $databit['bit_modulo']="Configuración";
                    $bitacora->NuevoRegistro($databit);
                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Actualizaron config de envio de correo.';      
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


               

         
        }else{
            return http_response_code(400);

        }
    }
}