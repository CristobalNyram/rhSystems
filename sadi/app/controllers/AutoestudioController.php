<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require_once("tinify/vendor/autoload.php");
\Tinify\setKey("wvMw7Jxtk9nN4CHBCbBVKBQLw0MNll2c");

class AutoestudioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('ESES');
        parent::initialize();
    }


    
    private function __verificarSesionCorrecta(){
        $auth = $this->session->get('auth');
        if(!array_key_exists('autoestudio',$auth)){

            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica. -AES");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

    }

  
    public function eses_loginAction()
    {
        
    	$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    public function indexAction()
    {
        

    	$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

       
    }
    public function eses_principalAction()
    {
        $auth = $this->session->get('auth');
        $this->__verificarSesionCorrecta();

    	$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $this->view->ese_id=$auth['ese_id'];
        $this->view->aes_id=$auth['aes_id'];
        $this->view->nombreadmin=$auth['nombre_candidato'];

    }

    public function enviar_a_trafico_analista_aesAction(){
        $answer=array();
        $answer[0]=-2;
        $answer['titular']='ERROR.';
        $answer['mensaje']='ERROR';


        $this->view->disable();
        if($this->request->isAjax())
        {
            $aes=new Autoestudio();
            $ese=new Estudio();
            $data = $this->request->getPost();
            $aes_verificar=Autoestudio::findFirstByaes_id($data['aes_id']);

            if($aes_verificar->aes_estatus==2){

                $respuesta_modelo_aes_enviar=$aes->EnviarATraficoAnalista($data['aes_id']);
                $respuesta_modelo_ese_enviar=$ese->EnviarATraficoAnalista($data['ese_id']);
    
                if( $respuesta_modelo_aes_enviar['estado'] &&  $respuesta_modelo_ese_enviar['estado']){
    
                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Se contestó un autoestudio. ';
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$respuesta_modelo_ese_enviar['ese_id'];
                            $databit['bit_modulo']="Autoestudio";
                            $databit['ese_id']= $respuesta_modelo_ese_enviar['ese_id'];
                            $bitacora->NuevoRegistro($databit);
    
                            $this->session->remove('auth');
                            $answer[0]='2';
                            $answer['titular']='OK';
                            $answer['mensaje']='Gracias por contestar correctamente todos los campos, en breve tu sesión se cerrará';
                            $answer['url_redireccionar']= $this->url->get('autoestudio/index');
    
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
    
                }
                
    
            }else{

                $this->session->remove('auth');
                $answer[0]='-1';
                $answer['titular']='AVISO';
                $answer['mensaje']='Se ha cambiado el estatus de AES...';
                $answer['url_redireccionar']= $this->url->get('autoestudio/index');
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
          
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;

        }
    }

    public function ajax_detalleAction($ese_id){
        $this->view->disable();
        $answer=array();
        $answer[0]=-2;
        $answer['titular']='ERROR.';
        $answer['mensaje']='ERROR';
        if($this->request->isAjax())
        {

            $aes=new Autoestudio;
            $respuesta_modelo_aes_buscar=$aes->BuscarUnicoRegistroActivo($ese_id);
            if($respuesta_modelo_aes_buscar['estado']){
                $answer[0]=2;
                $answer['titular']='OK.';
                $answer['mensaje']='OK';
                $answer['data']=$respuesta_modelo_aes_buscar;


            }

            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

    }

    public function actualizarAction($aes_id=0){
                $this->view->disable();
                $answer=array();
                $answer['estado']=-2;
                $answer['titular']='ERROR.';
                $answer['mensaje']='ERROR';

                if($this->request->isAjax() && $aes_id!=0)
                {
                    $data = $this->request->getPost();

                    $aes=new Autoestudio;
                    $aes_registro=Autoestudio::findFirstByaes_id($aes_id);
                    if($aes_registro){

                         //validacion de contraseñas iguales
                         $respuesta_modelo_comparar_contra=$aes->CompararContraseniasIgualesParaGuardar($data['aes_contrasenia'],$data['aes_contrasenia_confirmar']);
                         if($respuesta_modelo_comparar_contra['estado']===-1){
                                 $answer=$respuesta_modelo_comparar_contra;
                                  
            
                         }

                         //validacion que el correo no se repita en registros activos
                         $respuesta_modelo_validar_correo=$aes_registro->ValidarCorreoNoRepetido($data['aes_id'],$data['aes_correo']);
                         if($respuesta_modelo_validar_correo['estado']===-1){
                                 $answer=$respuesta_modelo_validar_correo;
                         
                         }

                         ///guardamos la informacion 
                         if($respuesta_modelo_comparar_contra['estado']===true  &&  $respuesta_modelo_validar_correo['estado']===true){

                                 $respuesta_modelo_aes_actualizar=$aes_registro->ActualizarDatosUsuario($data);

                                 if($respuesta_modelo_aes_actualizar['estado']==2){
                                    $auth = $this->session->get('auth');
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Actualizo información del autoestudio con ID interno '.$respuesta_modelo_aes_actualizar['aes_id'].'  relacionado con el estudio No. '.$respuesta_modelo_aes_actualizar['ese_id'].' ';
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo_aes_actualizar['aes_id'];
                                    $databit['bit_modulo']="Autoestudio";
                                    $databit['ese_id']= $respuesta_modelo_aes_actualizar['ese_id'];
                                    $bitacora->NuevoRegistro($databit);
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizo correctamente la información de autoestudio...';
                                    $answer['estado']=2;
                                 }

                         }

                       


                    }


                
                }
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
                die();

    }

 
}