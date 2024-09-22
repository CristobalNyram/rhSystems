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
        if(!$rol->verificar(1,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingreso al listado de usuarios";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Usuario";
        $bitacora->NuevoRegistro($databit);

    }

    /**
     * [tablaAction Muestra los registros de la tabla usuario]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $usuario = Usuario::query()
        ->columns([
            'Usuario.usu_nombre',
            'Usuario.usu_primerapellido',
            'Usuario.usu_segundoapellido',
            'Usuario.rol_id',
            'Usuario.usu_id',
            'Usuario.usu_estatus',
            'Usuario.usu_correo',
            'IFNULL(est.est_nombre, "Sin asignación.") AS est_nombre', 
            'IFNULL(mun.mun_nombre, "Sin asignación.") AS mun_nombre'
        ])
        ->leftJoin('Estado', 'est.est_id=Usuario.est_id', 'est')
        ->leftJoin('Municipio', 'mun.mun_id=Usuario.mun_id', 'mun')
        ->where('Usuario.usu_estatus<=2 and Usuario.usu_estatus>=0')
        ->execute();
        
        $this->view->page=$usuario;
        $this->view->usuario=new Usuario();
        $this->view->usuario_sesion= $this->session->get('auth');
        

    }

    public function perfilAction()
    {
        $auth= $this->session->get('auth');
        if($auth)
        {
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
            $rol = new Rol();
            if($rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $curp=0;
                $nacimiento=0;
                $domicilio=0;
                $estudios=0;
                $elector=0;
                $fotografia=0;
                $caratula=0;
                $fiscal=0;

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=2 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $curp=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=2 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $curp=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=3 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $nacimiento=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=3 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $nacimiento=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=4 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $domicilio=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=4 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $domicilio=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=5 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $estudios=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=5 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $estudios=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=6 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $elector=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=6 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $elector=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=9 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $fotografia=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=9 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $fotografia=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=10 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $caratula=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=10 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $caratula=3;
                    }
                }

                $archivossubidos=new Builder();
                $archivossubidos=$archivossubidos
                ->addFrom('Documentousuario','a')
                ->where('dou_estatus=1 and doc_id=11 and usu_id='.$auth['id'])
                ->getQuery()
                ->execute();
                if(count($archivossubidos)>0){
                    $fiscal=1;
                }else{
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=3 and doc_id=11 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $fiscal=3;
                    }
                }


                $this->view->curp=$curp;
                $this->view->nacimiento=$nacimiento;
                $this->view->domicilio=$domicilio;
                $this->view->estudios=$estudios;
                $this->view->elector=$elector;
                $this->view->fotografia=$fotografia;
                $this->view->caratula=$caratula;
                $this->view->fiscal=$fiscal;

             
            }
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Ingreso a la vista de perfil";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$auth['id'];
            $databit['bit_modulo']="Usuario";
            $bitacora->NuevoRegistro($databit);
            
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
                            $databit['bit_descripcion']='Cambió su contraseña el usuario '.$user->usu_nombre.' '.$user->usu_primerapellido.' con ID  interno del sistema '.$user->usu_id;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$user->usu_id;
                            $databit['bit_modulo']="Usuario";
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
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Actualizo datos de perfil";
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$auth['id'];
                $databit['bit_modulo']="Usuario";
                $bitacora->NuevoRegistro($databit); 
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
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= 'Se le eliminó al usuario con nombre '.$usuario->usu_nombre.' '.$usuario->usu_primerapellido.' '.$usuario->usu_segundoapellido.' con Id interno del sistema '.$usuario->usu_id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$usuario->usu_id;
            $databit['bit_modulo']="Usuario";
            $bitacora->NuevoRegistro($databit);
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
                            
                            //registro de Bitacora
                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Se le actualizo su contraseña al usuario con nombre '. $user->usu_nombre.' '.$user->usu_primerapellido.' '.$user->usu_segundoapellido.' con Id interno del sistema '.$user->usu_id;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$user->usu_id;
                            $databit['bit_modulo']="Usuario";
                            $bitacora->NuevoRegistro($databit);

                            //fin de registro en Bitacora
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
                if($clave=="")
                    $clave=$res;
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
        array("usu_nombre","col-lg-4","col-form-label title-busq"),
        array("usu_primerapellido","col-lg-4","col-form-label title-busq"),
        array("usu_segundoapellido","col-lg-4","col-form-label title-busq"),
        array("usu_correo","col-lg-6","col-form-label title-busq"),
        array("usu_contrasena","col-lg-6","col-form-label title-busq"),
        array("usu_estatus","col-lg-3","col-form-label title-busq"),
        array("usu_telefono","col-lg-3","col-form-label title-busq"),
        array("rol_id","col-lg-3","col-form-label title-busq"),
        array("enviar","col-sm-6 col-xs-12","col-form-label title-busq"));
        if($clave!="")
        {
            $usuario=Usuario::findFirstByusu_id($clave);
            if(!$usuario)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("usuario/index");
            }
            $clases=array(
                array("usu_id","col-lg-3","col-form-label title-busq"),
                array("usu_nombre","col-lg-3","col-form-label title-busq"),
                array("usu_primerapellido","col-lg-3","col-form-label title-busq"),
                array("usu_segundoapellido","col-lg-3","col-form-label title-busq"),
                array("usu_correo","col-lg-6","col-form-label title-busq"),
                array("usu_estatus","col-lg-3","col-form-label title-busq"),
                array("usu_telefono","col-lg-3","col-form-label title-busq"),
                array("rol_id","col-lg-3","col-form-label title-busq"),
                array("enviar","col-sm-6 col-xs-12","col-form-label title-busq"));
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

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $auth = $this->session->get('auth');
        $this->view->disable();
        $mensaje_bitacora='';
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            
            $existe = Usuario::findFirstByusu_correo($data['usu_correo']);
            
            if($existe==true){
                $answer[0]=1;
                $answer[1]='Ya existe un usuario con este correo.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;            
            }
          
            $rfc_buscar=preg_replace('/\s+/', '', $data['usu_rfc']);

            if($rfc_buscar==null || $rfc_buscar==''){
                $answer[0]=1;
                $answer[1]='El RFC del usuario es requerido.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }

             $existe_rfc= Usuario::findFirstByusu_rfc($data['usu_rfc']);
            
            if($existe_rfc){
                $answer[0]=1;
                $answer[1]='El RFC está repetido.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
       
            else{
                $id=$auth['id'];
                $usuario= new Usuario();


                 $res_crear_usuario=$usuario->NuevoRegistro($data,$id);
                if($data['ute']==='')
                {

                  $mensaje_bitacora= 'Creó al usuario '. $data['usu_nombre']." ". $data['usu_primerapellido']." ". $data['usu_segundoapellido'];
                }
                else
                {
                    $auth = $this->session->get('auth');


                    $usuariotipo = new Usuariotipoest();
                    foreach ($data['ute'] as $key => $data_tipo_estudio) 
                    {
                         $res_tipo_estudio= $usuariotipo->NuevoRegistro($data_tipo_estudio,$res_crear_usuario['usu_id'],$auth['id']);
                           
                            
                    }
                    
                    $mensaje_bitacora= 'Creó al usuario '. $data['usu_nombre']." ". $data['usu_primerapellido']." ". $data['usu_segundoapellido'].'con honorarios';

                }
   
                        if($res_crear_usuario["respuesta"]>0)
                        { 
                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']=$mensaje_bitacora;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$res_crear_usuario['usu_id'];
                            $databit['bit_modulo']="Usuario";
                            $bitacora->NuevoRegistro($databit);
                            $answer[0]=2;
                        }
                        else
                        {
                            $this->flash->error($usuario->error);
                        }
                
            }
        }
        else
         $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function buseditarAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        
        if($this->request->isAjax()&&$clave>0)
        {
            $usuario=Usuario::findFirstByusu_id($clave);
            if($usuario)
            {
                $answer[0]=1;
                $answer[1]=$usuario;
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
        $this->view->disable();

        if($this->request->isAjax()&&$clave>0)
        {
            $auth = $this->session->get('auth');
            $data = $this->request->getPost();
            $usuario=Usuario::findFirstByusu_id($clave);

            if($usuario)
            {
                
                $existe2 = Usuario::findFirstByusu_correo($data['usu_correoeditar']);
                if($existe2==true){
                    if($existe2->usu_id!=$clave){
                        $answer[0]=0;
                        $answer[1]='Ya existe un usuario asociado al correo.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                $rfc_buscar=preg_replace('/\s+/', '', $data['usu_rfceditar']);

                if($rfc_buscar==null || $rfc_buscar==''){
                    $answer[0]=0;
                    $answer[1]='El RFC del usuario es requerido.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
    
                 $usuario_existe_rfc= Usuario::findFirstByusu_rfc($data['usu_rfceditar']);

                
                 if($data['usu_rfceditar']!=$usuario->usu_rfc)
                 {
                    if($usuario_existe_rfc){
                        if($usuario_existe_rfc->usu_id!=$usuario->usu_id){
                            $answer[0]=0;
                            $answer[1]='El RFC está repetido y este RFC lo tiene registrado el usuario con ID '.$usuario_existe_rfc->usu_id;
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                           
                            
                        }
                       
                        
                    }  
   
                 }
          
                        $respuesta_modelo=$usuario->actualizarPerfil($data);
                        $auth = $this->session->get('auth');
                        
                        if($respuesta_modelo['estado']===2)
                        {
                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= "Editó el usuario: ".$data["usu_nombreeditar"].' '.$data["usu_primerapellidoeditar"].' '.$data["usu_segundoapellidoeditar"].', folio interno: '.$clave;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$clave;
                            $databit['bit_modulo']="Trabajador";
                            $bitacora->NuevoRegistro($databit);
        
                            $answer[0]=1;
                            // $soporte= new Soporte();
                            // $soporte->asignarfechalimite($poliza->pol_id);
                        }
                        else
                        {
                            $answer[0]=0;
                            // $this->db->rollback();
                        }
                    
                
          
                
               

                

            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function ajax_getinvestigadorAction($tipo_estudio){
        $result = [];

        $subs=new Builder();
        $subs=$subs
        ->columns(array('u.usu_id','CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre','usu_transporte'))
        ->addFrom('Usuario','u')
        ->join('Relrolmenu','r.rol_id=u.rol_id','r')
        ->join('Usuariotipoest','u.usu_id=ut.usu_id','ut')
        ->where('usu_estatus=2 and r.men_id=8 and rrm_estatus=1 and ut.ute_estatus=2 and ut.tip_id='.$tipo_estudio)
        ->getQuery()
        ->execute();
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

    public function ajax_get_all_investigadoresAction(){
        $result = [];
   
        $subs=Usuario::query()
        ->columns('Usuario.usu_id, CONCAT(Usuario.usu_nombre, " ", Usuario.usu_primerapellido, " ", Usuario.usu_segundoapellido) as usu_nombre')
        ->leftjoin('Relrolmenu','r.rol_id=Usuario.rol_id','r')
        ->where('usu_estatus=2 and r.men_id=8 and rrm_estatus=1')
        ->execute();
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

    public function ajax_getanalistaAction(){
        $result = [];

        $subs=new Builder();
        $subs=$subs
        ->columns(array('u.usu_id','CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre'))
        ->addFrom('Usuario','u')
        ->join('Relrolmenu','r.rol_id=u.rol_id','r')
        ->where('usu_estatus=2 AND r.men_id=12 and rrm_estatus=1 AND u.usu_id NOT IN (1, 2, 3, 4,40,75,39,71,69)')
        ->orderBy('nombre ASC') // Agrega la cláusula ORDER BY para ordenar por el campo "nombre" en orden ascendente
        ->getQuery()
        ->execute();
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
    public function ajax_getanalista_excluir_un_analistaAction($ese_id){
        $estudio=Estudio::findFirstByese_id($ese_id);
        $result= [];
        $subs=new Builder();       
        $subs=$subs
        ->columns(array('u.usu_id','CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre'))
        ->addFrom('Usuario','u')
        ->join('Relrolmenu','r.rol_id=u.rol_id','r')
        ->where('usu_estatus=2 and r.men_id=12 and rrm_estatus=1 and  usu_id <> '.$estudio->inv_id.' AND u.usu_id NOT IN (1, 2, 3, 4,40,75,39,71,69)')
        ->orderBy('nombre ASC') // Agrega la cláusula ORDER BY para ordenar por el campo "nombre" en orden ascendente
        ->getQuery()
        ->execute();
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }


    //función para obrtener el transporte minimo que tiene asignado un investigador
    //consulta las tablas  usuario y  la tabla usuariotipotest
    
    public function ajax_get_investigador_transporteAction($id_usuario)
    {

        $result = [];

        $subs=new Builder();
        $subs=$subs
        ->columns(array('uts.ute_honorario  as ute_transportemin'))
        ->addFrom('Usuario','u')
        ->join('Usuariotipoest','uts.usu_id=u.usu_id','uts')
        ->where('u.usu_id='.$id_usuario)
        ->getQuery()
        ->execute();
     
        $result = $subs->toArray();
        
        return $this->response->setJsonContent($result[0]);

    }
}
