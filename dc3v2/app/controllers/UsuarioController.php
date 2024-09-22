<?php
use Phalcon\Crypt;
use Intervention\Image\ImageManager;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Dispatcher;

class UsuarioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Usuario');
        parent::initialize();
        
    }
    
    /**
     * [indexAction Index para la tabla usuario]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(10,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [tablaAction Muestra los registros de la tabla usuario]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $usuario = Usuario::find(array(
            "usu_estatus<=2 and usu_estatus>=0"
            ));
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó el catálogo de usuarios";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->view->page=$usuario;
    }

    /**
     * [nuevoAction Crea un nuevo registro de la tabla usuario]
     * @param        []
     * @return []    []
     */
    /*public function nuevoAction()
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(63,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form = new UsuarioForm;
        $form->TodosCampos();
        $this->db->begin();
        if($this->request->isPost())
        {
            $data = $this->request->getPost();   
            $usuario= new Usuario();
            $auth = $this->session->get('auth');
            if($usuario->NuevoRegistro($data,$auth['id'])==true){
                $hus= new Historialusuario();
                $fecha= new DateTime();
                $actual=$fecha->format('Y-m-d');
                if($hus->NuevoRegistro($data['usu_id'],$actual,$auth['id'],$data['usu_estatus'])){ 
                    $this->flash->success("Registro creado exitosamente");
                    $this->response->redirect('usuario/index');
                    $this->view->disable();
                    $this->db->commit();
                    return;
                }
                else{
                    $this->flash->error($hus->error);
                    $this->db->rollback();
                }
            }
            else{
                $this->flash->error($usuario->error);
                $this->db->rollback();
            }
        }
        $this->view->form = $form;
    }*/

    /*public function informationAction(){
        
    }*/

    public function perfilAction()
    {
        $auth= $this->session->get('auth');
        if($auth)
        {
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Revisó su perfil";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $bitacora->NuevoRegistro($databit);
            // $usuario= Usuario::findFirstByusu_id($auth['id']);
            $usuario=new Builder();
            $usuario=$usuario
            ->columns(array('usu_id,usu_nombre,usu_primerapellido,usu_segundoapellido,usu_correo'))
            ->addFrom('Usuario','u')
            ->where('usu_estatus=2 and u.usu_id='.$auth['id'])
            ->getQuery()
            ->getSingleResult();
            // ->execute();
            if($usuario)
            {
            	$this->view->usuario=$usuario;
            }
        }
        else
        {
            return $this->forward('index/index');
        }
    }
    public function editarperfilAction()
    {
        if($this->request->isAjax())
        {
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            $auth= $this->session->get('auth');
            $user= Usuario::findFirstByusu_email($auth['correo']);
            if($user)
            {
                $this->view->nombre=$user->usu_nombre;
                $this->view->apellidop=$user->usu_apellidop;
                $this->view->apellidom=$user->usu_apellidom;
                $this->view->calle=$user->usu_calle;
                $this->view->exterior=$user->usu_exterior;
                $this->view->colonia=$user->usu_colonia;
                $this->view->estado=$user->usu_estado;
                $this->view->telefono=$user->usu_telefono;
                $this->view->correo_personal=$user->usu_emailpersonal;

            }
            else
            {
                $answer= array();
                $answer[0]=0;
                $answer[1]="Error al cargar los datos";
                $this->view->disable();
                $this->response->setJsonContent($answer);
                $this->response->send(); 
            }
        }
        else
        {
            return $this->forward('session/end');
        }
    }
    public function editarpasswordAction()
    {

        if($this->request->isAjax() == true){
                       
            $answer=array();
            $auth = $this->session->get('auth');
            /*recibe los datos enviados atraves de ajax o un post*/
            $data = $this->request->getPost();
            $user= Usuario::findFirstByusu_id($auth['id']);
            if($user){
            	$usuario=new Usuario();
            	if($usuario->ComprobarContrasenia($user->usu_id,$data['password']))
            	{    
	                if($data['password1']==$data['password2']){
	                    $crypt = new Crypt();
	                    $key  = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
	                    $text = $data['password1'];
	                    $encrypt = $crypt->encryptBase64($text, $key);
	                    $user->usu_contrasena=$encrypt;
	                   
	                    if ($user->save() == false){                        
	                        $answer[0]=0;
	                        $answer[1]="Hubo un error al guardar, reintente";
	                    }else{
                            
                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= "Cambió su contraseña";
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=0;
                            $bitacora->NuevoRegistro($databit);

	                        $answer[0]=1;                   
	                    } 
	                }else{
	                    $answer[0]=0;
	                    $answer[1]="Las contraseñas no coinciden, reintente";
	                }
	            }else
	            {
	            	$answer[0]=0;
                   	$answer[1]="Contraseña incorrecta, reintente";
	            }
            }else{
                $answer[0]=0;
                $answer[1]="Hubo un error al verificar su usuario, reintente";
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

    public function guardarperfilAction()
    {
        if($this->request->isAjax() == true) 
        {
            //deshabilito la vista
            $this->view->disable();
            $answer=array();
            $auth = $this->session->get('auth');
            /*recibe los datos enviados atraves de ajax o un post*/
            $data = $this->request->getPost();
            $usuario = new Usuario();
            if($usuario->EditarRegistro($data,$auth['correo'])==true)
            {
                $answer[0]='1';
            }
            else
            {
                $answer[0]='0';
                $answer[1]=$usuario->error;
            }
            $this->response->setJsonContent($answer);
            $this->response->send();    
        }
        else
        {
            return $this->forward('index/index');
        }
    }    
    
   /* public function cambiarfotoAction()
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(67,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        #check if there is any file
        if($this->request->hasFiles() == true){
            $uploads = $this->request->getUploadedFiles();
            $isUploaded = false;
            $date= new DateTime();
            $upload=$uploads[0];
            $a=''.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
             #do a loop to handle each file individually
             // foreach($uploads as $upload){
             
             #define a “unique” name and a path to where our file must go
             $path = 'images/fotos/'.$a;
             $data = $this->request->getPost();   
             $usu=Usuario::findFirstByusu_id(strtolower($data["usu_id"]));
             if($usu){
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    $usu->usu_foto=$a;
                    if($usu->save()){
                        $this->flash->success("Foto guardada exitosamente.");
                        $this->response->redirect('usuario/index');
                        $this->view->disable();
                        return;
                    }else
                    {
                        $this->flash->error("Error al guardar la foto, intente de nuevo por favor.");
                        $this->response->redirect('usuario/index');
                        $this->view->disable();
                        return;
                    }
                    
                }else
                {
                    $this->flash->error("Error al guardar la foto, intente de nuevo por favor.");
                    $this->response->redirect('usuario/index');
                    $this->view->disable();
                    return;
                } 
             }else
             {
                $this->flash->error("Error al encontrar el usuario a editar, intente de nuevo por favor.");
                $this->response->redirect('usuario/index');
                $this->view->disable();
                return;
             }
        }else{
            $this->flash->error("Error al cargar la foto, intente de nuevo por favor");
            $this->response->redirect('usuario/index');
            $this->view->disable();
            return;
        }
    }*/

    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla usuario]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id)
    {
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(65,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $usuario = Usuario::findFirstByusu_id($id);
        if (!$usuario) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        // $this->db->begin();
        $usuario->usu_estatus = -1;
        
        if ($usuario->save() == false) {

            $this->response->setJsonContent($answer);
            $this->response->send(); 
            $this->db->rollback();
            return;
        }
        $auth = $this->session->get('auth');
        // $hus= new Historialusuario();
        // $fecha= new DateTime();
        // $actual=$fecha->format('Y-m-d');
        // if($hus->NuevoRegistro($usuario->usu_id,$actual,$auth['id'],-1)==false){
        //     $this->response->setJsonContent($answer);
        //     $this->response->send(); 
        //     $this->db->rollback();
        //     return;
        // }
        $answer[0]=1;
        // $this->db->commit();
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }
    
    /**
     * [editarAction Edita un registro de la tabla usuario]
     * @param        []
     * @return []    []
     */
    /*public function editarAction($id=0)
    {
        $pue = new Puesto();
        $auth = $this->session->get('auth');
        if(!$pue->verificar(64,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $form= new UsuarioForm;
        $form->TodosCampos();
        // $this->view->clave=$id;
        if (!$this->request->isPost()) 
        {

            $usuario = Usuario::findFirstByusu_id($id);
            if (!$usuario) 
            {
                $this->flash->error("Usuario no encontrado");
                return $this->forward("usuario/index");
            }            
            $this->tag->setDefault('usu_id',$usuario->usu_id);
            $this->tag->setDefault('usu_nombre',$usuario->usu_nombre);
            $this->tag->setDefault('usu_apellidop',$usuario->usu_apellidop);
            $this->tag->setDefault('usu_apellidom',$usuario->usu_apellidom);
            $this->tag->setDefault('usu_rfc',$usuario->usu_rfc);
            $this->tag->setDefault('usu_curp',$usuario->usu_curp);
            $this->tag->setDefault('usu_nss',$usuario->usu_nss);
            $this->tag->setDefault('usu_correo_personal',$usuario->usu_correo_personal);
            $this->tag->setDefault('usu_fechanacimiento',date("Y-m-d", strtotime($usuario->usu_fechanacimiento)));
            $this->tag->setDefault('usu_celular',$usuario->usu_celular);
            $this->tag->setDefault('usu_sexo',$usuario->usu_sexo);
            $this->tag->setDefault('usu_estcivil',$usuario->usu_estcivil);
            $this->tag->setDefault('usu_hijos',$usuario->usu_hijos);
            
            $this->tag->setDefault('usu_calle',$usuario->usu_calle);
            $this->tag->setDefault('usu_exterior',$usuario->usu_exterior);
            $this->tag->setDefault('usu_interior',$usuario->usu_interior);
            $this->tag->setDefault('usu_colonia',$usuario->usu_colonia);
            $this->tag->setDefault('usu_municipio',$usuario->usu_municipio);
            $this->tag->setDefault('pai_id',$usuario->pai_id);
            $this->tag->setDefault('est_id',$usuario->est_id);

            $this->tag->setDefault('soc_id',$usuario->soc_id);
            $this->tag->setDefault('tco_id',$usuario->tco_id);
            $this->tag->setDefault('tjo_id',$usuario->tjo_id);
            $this->tag->setDefault('usu_estatus',$usuario->usu_estatus);
            $this->tag->setDefault('usu_horascap',$usuario->usu_horascap);
            $this->tag->setDefault('usu_proxevaluacion',date("Y-m-d", strtotime($usuario->usu_proxevaluacion)));
            $this->tag->setDefault('usu_licenciatura',$usuario->usu_licenciatura);
            $this->tag->setDefault('usu_experiencia',$usuario->usu_experiencia);
            $this->tag->setDefault('usu_cuotahora',$usuario->usu_cuotahora);
            $this->tag->setDefault('dep_id',$usuario->dep_id);
            $this->tag->setDefault('sde_id',$usuario->sde_id);
            $this->tag->setDefault('usu_jefe',$usuario->usu_jefe);
            $this->tag->setDefault('pue_id',$usuario->pue_id);
            $this->tag->setDefault('usu_fechaingreso',date("Y-m-d", strtotime($usuario->usu_fechaingreso)));
            $this->tag->setDefault('usu_vigenciavacaciones',date("Y-m-d", strtotime($usuario->usu_vigenciavacaciones)));
            $this->tag->setDefault('usu_correo',$usuario->usu_correo);
            $this->tag->setDefault('usu_telefono',$usuario->usu_telefono);
            $this->tag->setDefault('usu_extension',$usuario->usu_extension);
            $this->tag->setDefault('usu_nocuenta',$usuario->usu_nocuenta);
            $this->tag->setDefault('ban_id',$usuario->ban_id);

        }
        else
        {
            $this->db->begin();
            $data = $this->request->getPost();

            $usuario = Usuario::findFirstByusu_id($data["usu_id"]);
            $correo=Usuario::findFirstByusu_correo($data["usu_correo"]);
            if($correo)
            {
                if($correo->usu_id!=$usuario->usu_id){
                    //si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera
                    if($correo->usu_estatus>=0)
                    {
                        $this->flash->error('El correo ya existe en otro usuario, verifique.');
                        $this->view->form = $form;
                        return;
                    }
                    else
                    {
                        $correo->usu_correo='Eliminado';
                        if(!$correo->save()){
                            $this->flash->error('Ocurrió un error al editar el registro, intente más tarde.');
                            $this->response->redirect('cliente/index');
                            $this->view->disable();
                            return;
                        }
                    }
                }
            }


            $usuario= new Usuario();
            $auth = $this->session->get('auth');
            if($usuario->EditarRegistro($data))
            {
                $hus= new Historialusuario();
                $fecha= new DateTime();
                $actual=$fecha->format('Y-m-d');
                if($hus->NuevoRegistro($data['usu_id'],$actual,$auth['id'],$data['usu_estatus'])){
                    $this->flash->success("Registro editado exitosamente");
                    $this->response->redirect('usuario/index');
                    $this->view->disable();
                    $this->db->commit();
                    return;
                }
                else
                {
                    $this->db->rollback();
                    $this->flash->error('Ocurrió un error al editar el registro');
                    return $this->forward('usuario/editar/'.$data['usu_id']);
                }
            }
            else
            {   
                $this->db->rollback();
                $this->flash->error('Ocurrió un error al editar el registro');
                return $this->forward('usuario/editar/'.$data['usu_id']);
            }

        }
        $this->view->form = $form;

    }*/
    public function cambiarcontraadminAction()
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(66,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        if($this->request->isAjax() == true){
                       
            $answer=array();
            /*recibe los datos enviados atraves de ajax o un post*/
            $data = $this->request->getPost();
            $user= Usuario::findFirstByusu_id($data['usu_id']);
            if($user){
                $usuario=new Usuario();
                    if($data['password1']==$data['password2']){
                        $crypt = new Crypt();
                        // $key  = "v9BhpzZK7fx2phNe1ujMu4dwUuxpabuxFLvvEyOTeIQMlqMcRZnb0Rz8gsMy438J6wf0lFTAt1hhF6YS2zzzsRAmssIgxG91VBA4";
                        $key  = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
                        $text = $data['password1'];
                        $encrypt = $crypt->encryptBase64($text, $key);
                        $user->usu_contrasena=$encrypt;
                       
                        if ($user->save() == false){                        
                            $answer[0]=0;
                            $answer[1]="Hubo un error al guardar, reintente";
                        }else{
                            $answer[0]=1;                   
                        } 
                    }else{
                        $answer[0]=0;
                        $answer[1]="Las contraseñas no coinciden, reintente";
                    }
                
            }else{
                $answer[0]=0;
                $answer[1]="Hubo un error al verificar su usuario, reintente";
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

    public function formularioAction($clave="")
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // $vtodos=1;
        // $susu=-1;
        
        // if(!$pue->verificar(72,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $vtodos=0;
        //     $susu=$auth["id"];
        // }
        $form = new UsuarioForm;
        if($clave=="")
        {

            $form->NuevosCampos();
        }
        else
            $form->EditarCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();  
            // $data["via_fechaini"]=$this->convertir_fecha($data["via_fechaini"]);
            // $data["via_fechafin"]=$this->convertir_fecha($data["via_fechafin"]); 
            $usuario= new Usuario();
            $id=$auth['id'];
            if($clave=="")
                $res=$usuario->NuevoRegistro($data,$id);
            else
            {
                $usuario = Usuario::findFirstByusu_id($data["usu_id"]);
                $correo=Usuario::findFirstByusu_correo($data["usu_correo"]);
                if($correo)
                {
                    if($correo->usu_id!=$usuario->usu_id){
                        /*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
                        if($correo->usu_estatus>=0)
                        {
                            $this->flash->error('El correo '.$data["usu_correo"].' ya existe en otro usuario, verifique.');
                            $this->response->redirect('usuario/formulario/'.$clave);
                            $this->view->disable();
                            return;
                        }
                        else
                        {
                            $correo->usu_correo='Eliminado';
                            if(!$correo->save()){
                                $this->flash->error('Ocurrió un error al editar el registro, intente más tarde.');
                                $this->response->redirect('usuario/index');
                                $this->view->disable();
                                return;
                            }
                        }
                    }
                }
                $res=$usuario->EditarRegistro($data,$id);
            }

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Creó un usuario";
                }else{
                    $databit['bit_descripcion']= "Editó un usuario con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);
                //$this->flash->success("Registro creado exitosamente");
                $this->response->redirect('usuario/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($usuario->error);
            }
        }
       $clases=array(
        array("usu_nombre","col-sm-4 col-xs-12","control-label"),
        array("usu_primerapellido","col-sm-4 col-xs-12","control-label"),
        array("usu_segundoapellido","col-sm-4 col-xs-12","control-label"),
        array("usu_correo","col-sm-6 col-xs-6","control-label"),
        array("usu_contrasena","col-sm-6 col-xs-6","control-label"),
        array("usu_estatus","col-sm-3 col-xs-12","control-label"),
        array("rol_id","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $usuario=Usuario::findFirstByusu_id($clave);
            if(!$usuario)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("usuario/index");
            }
            $clases=array(
                array("usu_id","col-sm-3 col-xs-12","control-label"),
                array("usu_nombre","col-sm-3 col-xs-12","control-label"),
                array("usu_primerapellido","col-sm-3 col-xs-12","control-label"),
                array("usu_segundoapellido","col-sm-3 col-xs-12","control-label"),
                array("usu_correo","col-sm-6 col-xs-6","control-label"),
                
                array("usu_estatus","col-sm-3 col-xs-12","control-label"),
                array("rol_id","col-sm-3 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('usu_id',$usuario->usu_id);
            $this->tag->setDefault('usu_nombre',$usuario->usu_nombre);
            $this->tag->setDefault('usu_primerapellido',$usuario->usu_primerapellido);
            $this->tag->setDefault('usu_segundoapellido',$usuario->usu_segundoapellido);
            $this->tag->setDefault('usu_correo',$usuario->usu_correo);
            $this->tag->setDefault('usu_estatus',$usuario->usu_estatus);
            $this->tag->setDefault('rol_id',$usuario->rol_id);

        }
        else
            $this->view->vvia_producto="";
        $this->view->form = $form;
        $this->view->clave=$clave;
        $this->view->clases=$clases; 
        
    }
}
