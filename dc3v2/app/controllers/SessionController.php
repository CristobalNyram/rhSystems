<?php

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
    private function _registerSessionUsuario(Usuario $usuario)
    {
        
        $this->session->set('auth', array(
            'nombre' => $usuario->usu_nombre,
            'correo' =>$usuario->usu_correo,
            'id' =>$usuario->usu_id,
            'tipo'=>$usuario->usu_tipo,
            'foto'=>$usuario->usu_foto,
            'configuracion'=>0,
            'rol_id'=>$usuario->rol_id
        ));

        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Inicio de sesión";
        $databit['usu_id']=$usuario->usu_id;
        $databit['bit_tablaid']=0;
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
            
            $usuario=new Usuario();
            if($usuario->BuscarRegistro($data)==true)
            {    
                $answer[0]='1';
               // $this->flash->success('Bienvenido.');
                $this->_registerSessionusuario($usuario);   
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
        $bitacora->NuevoRegistro($databit);

        $this->session->remove('auth');
        // $this->flash->success('Hasta luego.');
        return $this->forward('index/index');
    }
}
