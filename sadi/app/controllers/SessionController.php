<?php
use \Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Crypt;

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Iniciar Sesión');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->tag->setDefault('email', '');
            $this->tag->setDefault('password', '');
        }
    }
/**
 * [_registerSessionUsuario se mandan los valores de la sesion del usuario]
 * @param  Usuario $usuario [recibe una variable de tipo Usuario]
 * @return []               []
 */
    private function _registerSessionUsuario(Usuario $usuario,$data)
    {
        // define('APP_PATH', realpath('..') . '/');
        $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
        $this->session->set('auth', array(
            'nombre' => $usuario->usu_nombre,
            'nombre_completo' => $usuario->usu_nombre_completo,
            'correo' =>$usuario->usu_correo,
            'id' =>$usuario->usu_id,
            'tipo'=>$usuario->usu_tipo,
            'type'=>"normal",

            // 'foto'=>$usuario->usu_foto,
            'configuracion'=>0,
            'rol_id'=>$usuario->rol_id,
            'rol_nivel'=>$usuario->getRolNivel($usuario->rol_id),
            'proyc'=>$config->security->secretkeyproyect
        ));

        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Inicio de sesión con la siguientes IP's: servidor ".$usuario->obtenerIP().' y cliente '.$data['ip_cliente'];
        $databit['usu_id']=$usuario->usu_id;
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Sesión";
        $bitacora->NuevoRegistro($databit);
    }

    /**
     * [startAction método donde se recibe la información para proceder a crear o no la sesión del usuario]
     * @param  [] []
     * @return [] []
     */
    public function startAction()
    {
        if($this->request->isAjax() == true) 
        {
            $answer=array();
            $data = $this->request->getPost();
            
            $valorrecaptcha=0;
            $config=new Configuracion();
            if($config->get_estatuscaptcha())
            {
                $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
                $recaptcha_secret = '6LfRM7EpAAAAAKGtVJBEIRI3wPshLN2ldSQVsJ-s'; 
                $recaptcha_response = $data["recaptcha_response"]; 
                $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
                $recaptcha = json_decode($recaptcha);
                $valorrecaptcha = $recaptcha->score;
                if($recaptcha->success){
                    if ($valorrecaptcha >= 0.6) {
                    }else{
                        $answer[0]='0';
                        $answer[1]="Captcha no válido intente de nuevo. Cal: ".$valorrecaptcha;
                        $this->view->disable();
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                }else{
                    $answer[0]='0';
                        $answer[1]="Captcha no válido intente de nuevo. Not success.";
                        $this->view->disable();
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                }
                
            }

            $usuario=new Usuario();
            if($usuario->BuscarRegistro($data)==true)
            {    
                $answer[0]='1';
               // $this->flash->success('Bienvenido.');
                $this->_registerSessionusuario($usuario,$data);
                $auth = $this->session->get('auth');
                $rol = new Rol();
                if($rol->verificar(8,$auth['rol_id'])==1) //el número en la funcion es el correspondiente a la bdd
                {
                    $answer[2]="estudio/trafico_index";
                }elseif ($rol->verificar(12,$auth['rol_id'])==1) {
                    $answer[2]="estudio/traficoanalista_index";
                }elseif ($rol->verificar(25,$auth['rol_id'])==1) {
                    $answer[2]="transporte/aprobar_index";
                }elseif ($rol->verificar(82,$auth['rol_id'])==1) {
                    $answer[2]="cliente/index";
                }else{
                    $answer[2]="usuario/perfil";
                }
                // $answer[2]=$auth['id'];
                $answer[1]=$valorrecaptcha;
                $usuario=null;
            }
            else
            {
                $answer[0]='0';
                $answer[1]=$usuario->error;
                
            }
            $this->view->disable();
            $this->response->setJsonContent($answer);
            $this->response->send();
               
        }
        else
        {
            return $this->forward('index/index');
        }
    }

    /**
     * [endAction finaliza la sesión del usuario]
     * @param  [] []
     * @return [] []
     */
    public function endAction()
    {
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Cerró sesión";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Sesión";
        $bitacora->NuevoRegistro($databit);

        $this->session->remove('auth');
        // $this->flash->success('Hasta luego.');
        return $this->forward('index/index');
    }


    public function start_aesAction()
    {

        $this->view->disable();

        if($this->request->isAjax() == true) 
        {


            $answer=array();
            $answer['estado']='-2';
            $answer['titular']='ERROR';
            $answer['mensaje']='Correo o contraseña equivocados';

            $data = $this->request->getPost();
            $aes_obj=new Autoestudio();
            $respuesta_modelo=$aes_obj->BuscarRegistro($data);

          


            //validamos que el correo que se esta buscando 
            if($respuesta_modelo['estado'])
            {    

                $aes_data=Autoestudio::findFirstByaes_id($respuesta_modelo['aes_id']);

                //validamos que la contraseña sean iguales
                if($aes_data->CompararContraseniasIguales($aes_data->aes_contrasenia,$data['password']))
                {
                
                    //validamos que el estatus sea activo del estatus
                    if($aes_data->aes_estatus==2)
                    {
                        //marcamos la hora en la que se inica el proceso de contestacion
                        $aes_data->setHoraInicioContestacion();
                        $usuario=$aes_data->getUsuarioParaSesion($aes_data->ese_id,172,$respuesta_modelo['aes_id']);// Usuario::findFirstByusu_id(172);
                        $this->_registerSessionUsuario_aes($usuario,$data);

                        $answer['estado']='2';
                        $answer['url_redireccionar']= $this->url->get('autoestudio/eses_principal');
                        $answer['mensaje']="Redireccionando a el cuestionario...";
                        $answer['titular']="Bienvenido";
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;

                    }else{
                        $IP=$this->obtenerIP();
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Intento iniciar sesión, pero estatus del estudio no es activo, internto ingresar con este correo ".$data["correo"].' con la siguiente info recopilada por el servidor  IP :'.$IP.' y la IP del cliente es '.$data["ip_cliente"];
                        $databit['usu_id']=0;
                        $databit['bit_tablaid']=0;
                        $databit['bit_modulo']="Sesión AES";
                        $bitacora->NuevoRegistro($databit);
                    }
                  
                        
            
                }else{
                    $IP=$this->obtenerIP();
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Intento iniciar sesión con este correo ".$data["correo"].' con la siguiente info recopilada por el servidor  IP :'.$IP.' y la IP del cliente es '.$data["ip_cliente"];
                    $databit['usu_id']=0;
                    $databit['bit_tablaid']=0;
                    $databit['bit_modulo']="Sesión AES";
                    $bitacora->NuevoRegistro($databit);
                }
            
             
 
               
            }else{
                $IP=$this->obtenerIP();
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Intento iniciar sesión con este correo ".$data["correo"].' con la siguiente info recopilada por el servidor  IP :'.$IP.' y la IP del cliente es '.$data["ip_cliente"];
                $databit['usu_id']=0;
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Sesión AES";
                $bitacora->NuevoRegistro($databit);
            }
          

            
           
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
               
        }
        else
        {
            return $this->forward('autoestudio/eses_login');
        }

    }


    /**
     * [_registerSessionUsuario se mandan los valores de la sesion del usuario]
     * @param  Usuario $usuario [recibe una variable de tipo Usuario]
     * @return []               []
     */
    private function _registerSessionUsuario_aes(Usuario $usuario,$data)
    {
        // define('APP_PATH', realpath('..') . '/');
        $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
        $this->session->set('auth', array(
            'nombre' => $usuario->usu_nombre,
            'correo' =>$usuario->usu_correo,
            'id' =>$usuario->usu_id,
            'tipo'=>$usuario->usu_tipo,
            'nombre_candidato'=>$usuario->nombre_candidato,
            'usu_nombre_completo'=>$usuario->usu_nombre_candidato,
            // 'foto'=>$usuario->usu_foto
            'autoestudio'=>1,///validamos que sea un usuario autoestudio
            'ese_id'=>$usuario->ese_id,
            'aes_id'=>$usuario->aes_id,
            'type'=>"aes",
            'configuracion'=>0,
            'rol_id'=>$usuario->rol_id,
            'rol_nivel'=>$usuario->rol_nivel,
            'proyc'=>$config->security->secretkeyproyect
        ));

        $auth = $this->session->get('auth');

        $bitacora= new Bitacora();
        $mensaje_ips="con la siguientes IP's: servidor ".$usuario->obtenerIP().' y cliente '.$data['ip_cliente'];
        $databit['bit_descripcion']= $auth['id']." Inicio de sesión usuario de autoestudio con ID ".$usuario->aes_id.' para contestar el ESE con ID interno :'.$usuario->ese_id.' '.$mensaje_ips;
        $databit['usu_id']=$usuario->usu_id;
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Sesión AES";
        $bitacora->NuevoRegistro($databit);
    }


    public function end_aesAction()
    {
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Cerró sesión usuario Auto Estudio";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Sesión";
        $bitacora->NuevoRegistro($databit);

        $this->session->remove('auth');
        // $this->flash->success('Hasta luego.');
        return $this->forward('autoestudio/index');
    }

    public function start_clienteAction()
    {
        if($this->request->isAjax() == true) 
        {
            $this->view->disable();
            $answer=array();
            $answer['estado']='-2';
            $answer['titular']='ERROR';
            $answer['mensaje']='Correo o contraseña equivocados';
            $data = $this->request->getPost();
            
            $cliente=new Cliente();
            if($cliente->BuscarRegistro($data)==true)
            {    
                $answer[0]='1';
               // $this->flash->success('Bienvenido.');
                $this->_registerSessioncliente($cliente,$data);
                $auth = $this->session->get('auth');
                // $rol = new Rol();
                // if($rol->verificar(8,$auth['rol_id'])==1) //el número en la funcion es el correspondiente a la bdd
                // {
                //     $answer[2]="estudio/trafico_index";
                // }elseif ($rol->verificar(12,$auth['rol_id'])==1) {
                //     $answer[2]="estudio/traficoanalista_index";
                // }elseif ($rol->verificar(25,$auth['rol_id'])==1) {
                //     $answer[2]="transporte/aprobar_index";
                // }elseif ($rol->verificar(82,$auth['rol_id'])==1) {
                //     $answer[2]="cliente/index";
                // }else{
                    $answer['estado']='2';
                    $answer['url_redireccionar']= $this->url->get('cliente/trafico_index');
                    $answer['mensaje']="Redireccionando a tus dashboard...";
                    $answer['titular']="Bienvenido";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                    
                    // $answer["estado"]="2";
                    // $answer["url_redireccionar"]="usuario/perfil";
                // }
                // $answer[2]=$auth['id'];
                $cliente=null;
            }
            else
            {
                $answer[0]='0';
                $answer[1]=$cliente->error;
                
            }
            
            $this->response->setJsonContent($answer);
            $this->response->send();
               
        }
        else
        {
            return $this->forward('index/index');
        }
    }

    private function _registerSessioncliente(Cliente $cliente,$data)
    {
        // define('APP_PATH', realpath('..') . '/');
        $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
        $this->session->set('auth', array(
            'nombre' => $cliente->cli_nombre,
            'nombre_completo' => $cliente->cli_nombre_completo,
            'correo' =>$cliente->cli_correo,
            'id' =>$cliente->cli_id,
            'tipo'=>$cliente->cli_tipo,
            'nivel'=>$cliente->nivel,
            // 'foto'=>$usuario->usu_foto,
            'configuracion'=>0,
            'type'=>"cliente",
            'rol_id'=>0,
            'neg_id'=>$cliente->neg_id,
            'emp_id'=>$cliente->emp_id,
            'cne_id'=>$cliente->cne_id,
            // 'rol_nivel'=>$cliente->getRolNivel($cliente->rol_id),
            'proyc'=>$config->security->secretkeyproyect
        ));

        $bitacora= new Bitacoracliente();
        $databit['bic_descripcion']= "Inicio de sesión con la siguientes IP's: servidor ".$cliente->obtenerIP().' y cliente '.$data['ip_cliente'];
        $databit['cli_id']=$cliente->cli_id;
        $databit['bic_tablaid']=0;
        $databit['bic_modulo']="Sesión";
        $bitacora->NuevoRegistro($databit);
    }

    public function end_clienteAction()
    {
        $auth = $this->session->get('auth');
        $bitacora= new Bitacoracliente();
        $databit['bic_descripcion']= "Cerró sesión usuario cliente";
        $databit['cli_id']=$auth['id'];
        $databit['bic_tablaid']=0;
        $databit['bic_modulo']="Sesión";
        $bitacora->NuevoRegistro($databit);

        $this->session->remove('auth');
        // $this->flash->success('Hasta luego.');
        return $this->forward('cliente/index/');
    }

}
