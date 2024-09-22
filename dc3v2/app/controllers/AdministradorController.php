<?php
use Phalcon\Crypt;
require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class AdministradorController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Administrador');
        parent::initialize();
        // $this->view->gmenu=0;
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(8,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla curso]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $adm = Administrador::find(array(
            "adm_estatus<=2 and adm_estatus>=0"
            ));
        $admindir= new Admindirector();

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de administrador";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->view->page=$adm;
        $this->view->admindir=$admindir;
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
        $form = new AdministradorForm;
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
            $admin= new Administrador();
            $id=$auth['id'];
            
            if($clave==""){
                if($this->request->hasFiles() == true){
                    $uploads = $this->request->getUploadedFiles();
                    $isUploaded = false;
                    $date= new DateTime();
                    $upload=$uploads[0];
                    $data['adm_logo']='-';
                    if($upload->getname()==''){
                        
                    }
                    else{
                        $a=''.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                        #do a loop to handle each file individually
                        // foreach($uploads as $upload){

                        #define a “unique” name and a path to where our file must go
                        $path = 'images/recursos/'.$a;
                        $data = $this->request->getPost();            
                        #move the file and simultaneously check if everything was ok
                        ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                        #if any file couldn’t be moved, then throw an message
                        if($isUploaded){
                            $b='opt'.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                            $c=''.$date->format('Y-m-d-H-i-s').'-opt';
                            $d=''.$date->format('Y-m-d-H-i-s').'-opt.jpg';
                            $intervention = new ImageManager(array('driver' => 'gd'));
                            $intervention->make($path)->widen(150)->save('images/recursos/'.$b, 100);
                            $intervention->make('images/recursos/'.$b)->widen(150)->save('images/recursos/'.$d, 100,'jpg');
                            // $usu->emp_logo=$c.'.jpg';
                            unlink($path);
                            unlink('images/recursos/'.$b);
                            // $data['emp_logo']=$c.'.jpg';
                            $data['adm_logo']=$c.'.jpg';
                        }
                    }
                        $id=$auth['id'];
                        // if($clave=="")
                        if($data['adm_default']==1)
                        {
                            $default= Administrador::findFirstByadm_default('1');
                            $default->adm_default=0;
                            $default->save();
                        }
                        $res=$admin->NuevoRegistro($data,$id);
                        // else
                            // $res=$insignia->EditarRegistro($data,$id);

                        if($res)
                        { 
                            $this->flash->success("Registro creado exitosamente");
                            $this->response->redirect('administrador/index');
                            $this->view->disable();
                            return;
                        }
                        else
                        {
                            $this->flash->error($insignia->error);
                        }

                }
                else
                {
                    $this->flash->error("Error al cargar la imagen");
                }
                // if($data['adm_default']==1)
                // {
                //     $default= Administrador::findFirstByadm_default('1');
                //     $default->adm_default=0;
                //     $default->save();
                // }
                // $res=$admin->NuevoRegistro($data,$id);
            }
            else
                $res=$admin->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Creó un administrador";
                }else{
                    $databit['bit_descripcion']= "Editó un administrador con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);

                $this->flash->success("Registro exitoso");
                $this->response->redirect('administrador/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($admin->error);
            }
        }
       $clases=array(
        
        array("adm_nombre","col-sm-6 col-xs-6","control-label"),
        array("adm_rfc","col-sm-6 col-xs-6","control-label"),
        // array("adm_nombredirector","col-sm-6 col-xs-6","control-label"),
        // array("adm_primerapellidodirector","col-sm-6 col-xs-6","control-label"),
        // array("adm_segundoapellidodirector","col-sm-6 col-xs-6","control-label"),
        // array("adm_puestofirma","col-sm-3 col-xs-6","control-label"),
        array("adm_default","col-sm-3 col-xs-6","control-label"),
        array("adm_estatus","col-sm-3 col-xs-6","control-label"),
        array("adm_logo","col-sm-3 col-xs-6","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $admin=Administrador::findFirstByadm_id($clave);
            if(!$admin)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("administrador/index");
            }
            $clases=array(
                array("adm_id","col-sm-6 col-xs-12","control-label"),
                array("adm_nombre","col-sm-6 col-xs-6","control-label"),
                array("adm_rfc","col-sm-6 col-xs-6","control-label"),
                // array("adm_nombredirector","col-sm-6 col-xs-6","control-label"),
                // array("adm_primerapellidodirector","col-sm-6 col-xs-6","control-label"),
                // array("adm_segundoapellidodirector","col-sm-6 col-xs-6","control-label"),
                // array("adm_puestofirma","col-sm-3 col-xs-6","control-label"),
                array("adm_default","col-sm-6 col-xs-6","control-label"),
                array("adm_estatus","col-sm-3 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('adm_id',$admin->adm_id);
            $this->tag->setDefault('adm_nombre',$admin->adm_nombre);
            $this->tag->setDefault('adm_rfc',$admin->adm_rfc);
            // $this->tag->setDefault('adm_nombredirector',$admin->adm_nombredirector);
            // $this->tag->setDefault('adm_primerapellidodirector',$admin->adm_primerapellidodirector);
            // $this->tag->setDefault('adm_segundoapellidodirector',$admin->adm_segundoapellidodirector);
            $this->tag->setDefault('adm_default',$admin->adm_default);
            // $this->tag->setDefault('adm_puestofirma',$admin->adm_puestofirma);
            $this->tag->setDefault('adm_estatus',$admin->adm_estatus);

        }
        else
            $this->view->vvia_producto="";
        $this->view->form = $form;
        $this->view->clave=$clave;
        $this->view->clases=$clases; 
        
    }


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id)
    {
        $admin = new Administrador();
        $auth = $this->session->get('auth');
        // if(!$are->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $admin = Administrador::findFirstByadm_id($id);
        if (!$admin) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $admin->adm_estatus = -1;
        
        if ($admin->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó el administrador con id ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function cambiarfotoAction()
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(67,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
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
             $path = 'images/recursos/'.$a;
             $data = $this->request->getPost();   
             $usu=Administrador::findFirstByadm_id(strtolower($data["adm_id"]));
             if($usu){
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    $b='opt'.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                    $c=''.$date->format('Y-m-d-H-i-s').'-opt';
                    $d=''.$date->format('Y-m-d-H-i-s').'-opt.jpg';
                    $intervention = new ImageManager(array('driver' => 'gd'));
                    $intervention->make($path)->widen(150)->save('images/recursos/'.$b, 100);
                    $intervention->make('images/recursos/'.$b)->widen(150)->save('images/recursos/'.$d, 100,'jpg');
                    $usu->adm_logo=$c.'.jpg';
                    unlink($path);
                    unlink('images/recursos/'.$b);
                    // $usu->adm_logo=$a;
                    if($usu->save()){

                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Cambió el logo del administrador con id ".$data["adm_id"];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$data["adm_id"];
                        $bitacora->NuevoRegistro($databit);

                        $this->flash->success("Imagen guardada exitosamente.");
                        $this->response->redirect('administrador/index');
                        $this->view->disable();
                        return;
                    }else
                    {
                        $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                        $this->response->redirect('administrador/index');
                        $this->view->disable();
                        return;
                    }
                    
                }else
                {
                    $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                    $this->response->redirect('administrador/index');
                    $this->view->disable();
                    return;
                } 
             }else
             {
                $this->flash->error("Error al encontrar la insignia a editar, intente de nuevo por favor.");
                $this->response->redirect('administrador/index');
                $this->view->disable();
                return;
             }
        }else{
            $this->flash->error("Error al cargar la imagen, intente de nuevo por favor");
            $this->response->redirect('administrador/index');
            $this->view->disable();
            return;
        }
    }

    public function cambiarfirmaAction()
    {
        // $pue = new Puesto();
        $auth = $this->session->get('auth');
        // if(!$pue->verificar(67,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
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
             $path = 'images/firmas/'.$a;
             $data = $this->request->getPost();   
             $admin=Administrador::findFirstByadm_id(strtolower($data["adm_idfirma"]));
             $usu=Admindirector::findFirstByadr_id($admin->adr_id);
             if($usu){
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    $b='opt'.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                    $c=''.$date->format('Y-m-d-H-i-s').'-opt';
                    $d=''.$date->format('Y-m-d-H-i-s').'-opt.jpg';
                    $intervention = new ImageManager(array('driver' => 'gd'));
                    $intervention->make($path)->widen(150)->save('images/firmas/'.$b, 100);
                    $intervention->make('images/firmas/'.$b)->widen(150)->save('images/firmas/'.$d, 100,'jpg');
                    $usu->adm_firma=$c.'.jpg';
                    unlink($path);
                    unlink('images/firmas/'.$b);
                    // $usu->adm_logo=$a;
                    if($usu->save()){
                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Cambió la firma del administrador con id ".$data["adm_idfirma"];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$data["adm_idfirma"];
                        $bitacora->NuevoRegistro($databit);

                        $this->flash->success("Imagen guardada exitosamente.");
                        $this->response->redirect('administrador/index');
                        $this->view->disable();
                        return;
                    }else
                    {
                        $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                        $this->response->redirect('administrador/index');
                        $this->view->disable();
                        return;
                    }
                    
                }else
                {
                    $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                    $this->response->redirect('administrador/index');
                    $this->view->disable();
                    return;
                } 
             }else
             {
                $this->flash->error("Error al encontrar la firma a editar, intente de nuevo por favor.");
                $this->response->redirect('administrador/index');
                $this->view->disable();
                return;
             }
        }else{
            $this->flash->error("Error al cargar la imagen, intente de nuevo por favor");
            $this->response->redirect('administrador/index');
            $this->view->disable();
            return;
        }
    }

    public function eliminardirectorAction($id)
    {
        
        $auth = $this->session->get('auth');
       
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $admin = Administrador::findFirstByadm_id($id);
        if (!$admin) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
       
        $admin->adr_id = null;
       
        
        if ($admin->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó del administrador el director con id".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function creardirectorAction()
    {
        $answer=array();
        $auth = $this->session->get('auth');
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $admindirector= new Admindirector();

            $admindirector->adm_nombredirector=$data["dir_nombrec"];
            $admindirector->adm_primerapellidodirector=$data["dir_primerapellidoc"];
            $admindirector->adm_segundoapellidodirector=$data["dir_segundoapellidoc"];
            $admindirector->adm_puestofirma=$data["dir_puestoc"];
            $admindirector->adm_firma='blanco.jpg';
            $admindirector->adr_estatus=2;
            $admindirector->usu_id=$auth['id'];

            if($admindirector->save())
            {
                $admin=Administrador::findFirstByadm_id($data["adm_idcrear"]);
                $admin->adr_id=$admindirector->adr_id;
                
                if($admin->save()){

                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Asignó al administrador ".$data["adm_idcrear"]." el director con id".$admindirector->adr_id;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$data["adm_idcrear"];
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=1;
                }else
                    $answer[0]=0;             
            }
            else
            {
                $answer[0]=0;
                // $this->db->rollback();
            }
            

            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function buseditardirectorAction($clave=0)
    {
        $answer=array();
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $admindirector=Admindirector::findFirstByadr_id($clave);
            if($admindirector)
            {
                $answer[0]=1;
                $answer[1]=$admindirector->adm_nombredirector;
                $answer[2]=$admindirector->adm_primerapellidodirector;
                $answer[3]=$admindirector->adm_segundoapellidodirector;
                $answer[4]=$admindirector->adm_puestofirma;
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

    public function editardirectorAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $data = $this->request->getPost();
            $admindirector=Admindirector::findFirstByadr_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            if($admindirector)
            {
                // echo $trabajador->tra_nombre;
                $admindirector->adm_nombredirector=$data["adr_nombre"];
                $admindirector->adm_primerapellidodirector=$data["adr_primerapellido"];
                $admindirector->adm_segundoapellidodirector=$data["adr_segundoapellido"];
                $admindirector->adm_puestofirma=$data["adr_puesto"];
                if($admindirector->save())
                {
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Editó el director con id ".$clave;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$clave;
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=1;
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
    
}