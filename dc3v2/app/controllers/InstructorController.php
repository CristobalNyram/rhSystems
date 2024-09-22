<?php
use Phalcon\Crypt;
require "intervention_image/index.php";
use Intervention\Image\ImageManager;

class InstructorController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Instructor');
        parent::initialize();
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
        $instructor = Instructor::find(array(
            "ins_estatus<=2 and ins_estatus>=0"
            ));

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de instructores";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);

        $this->view->page=$instructor;
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
        $form = new InstructorForm;
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
            $instructor= new Instructor();
            $id=$auth['id'];
            if($clave=="")
                $res=$instructor->NuevoRegistro($data,$id);
            else
                $res=$instructor->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave==""){
                    $clave=$res;
                    $databit['bit_descripcion']= "Creó un instructor";
                }else{
                    $databit['bit_descripcion']= "Editó un instructor con id ".$clave;
                }

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$clave;
                $bitacora->NuevoRegistro($databit);

                $this->flash->success("Registro exitoso");
                $this->response->redirect('instructor/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($instructor->error);
            }
        }
       $clases=array(
        
        array("ins_nombre","col-sm-6 col-xs-6","control-label"),
        array("ins_primerapellido","col-sm-3 col-xs-12","control-label"),
        array("ins_segundoapellido","col-sm-3 col-xs-12","control-label"),
        array("ins_rfc","col-sm-3 col-xs-12","control-label"),
        array("ins_correo","col-sm-6 col-xs-12","control-label"),
        array("ins_estatus","col-sm-3 col-xs-12","control-label"),
        array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $instructor=Instructor::findFirstByins_id($clave);
            if(!$instructor)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("instructor/index");
            }
            $clases=array(
                array("ins_id","col-sm-3 col-xs-12","control-label"),
                array("ins_nombre","col-sm-3 col-xs-6","control-label"),
                array("ins_primerapellido","col-sm-6 col-xs-6","control-label"),
                array("ins_segundoapellido","col-sm-3 col-xs-12","control-label"),
                array("ins_rfc","col-sm-6 col-xs-12","control-label"),
                array("ins_correo","col-sm-3 col-xs-12","control-label"),
                array("ins_estatus","col-sm-3 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('ins_id',$instructor->ins_id);
            $this->tag->setDefault('ins_nombre',$instructor->ins_nombre);
            $this->tag->setDefault('ins_primerapellido',$instructor->ins_primerapellido);
            $this->tag->setDefault('ins_segundoapellido',$instructor->ins_segundoapellido);
            $this->tag->setDefault('ins_rfc',$instructor->ins_rfc);
            $this->tag->setDefault('ins_correo',$instructor->ins_correo);
            $this->tag->setDefault('ins_estatus',$instructor->ins_estatus);

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
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $instructor = Instructor::findFirstByins_id($id);
        if (!$instructor) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $instructor->ins_estatus = -1;
        
        if ($instructor->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó el instructor con id ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
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
             $usu=Instructor::findFirstByins_id(strtolower($data["ins_idfirma"]));
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
                    $usu->ins_firma=$c.'.jpg';
                    unlink($path);
                    unlink('images/firmas/'.$b);
                    // $usu->adm_logo=$a;
                    if($usu->save()){

                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Cambió la firma del instructor con id ".$data["ins_idfirma"];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$data["ins_idfirma"];
                        $bitacora->NuevoRegistro($databit);

                        $this->flash->success("Imagen guardada exitosamente.");
                        $this->response->redirect('instructor/index');
                        $this->view->disable();
                        return;
                    }else
                    {
                        $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                        $this->response->redirect('instructor/index');
                        $this->view->disable();
                        return;
                    }
                    
                }else
                {
                    $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                    $this->response->redirect('instructor/index');
                    $this->view->disable();
                    return;
                } 
             }else
             {
                $this->flash->error("Error al encontrar la firma a editar, intente de nuevo por favor.");
                $this->response->redirect('instructor/index');
                $this->view->disable();
                return;
             }
        }else{
            $this->flash->error("Error al cargar la imagen, intente de nuevo por favor");
            $this->response->redirect('instructor/index');
            $this->view->disable();
            return;
        }
    }
}