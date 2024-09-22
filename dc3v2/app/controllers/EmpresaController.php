<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';
require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class EmpresaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Empresa');
        parent::initialize();
        // $this->view->gmenu=2;
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
     * [indexAction Index para la tabla departamento]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {

    }

    /**
     * [tablaAction Muestra los registros de la tabla departamento]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $empresa = Empresa::find(array(
            "emp_estatus<=2 and emp_estatus>=0"
        ));

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó catálogo de empresas";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $bitacora->NuevoRegistro($databit);
        
        $this->view->page=$empresa;
    }

    public function formularioAction($clave="")
    {
        
        $auth = $this->session->get('auth');
        
        $form = new EmpresaForm;
        $val=0;
        if($clave=="")
        {
            $form->NuevosCampos();
            $val=1;
        }
        else
            $form->EditarCampos();

        if($this->request->isPost())
        {
            $data = $this->request->getPost();  
            
            $empresa= new Empresa();
            $id=$auth['id'];
            if($clave==""){
                // $res=$empresa->NuevoRegistro($data,$id);
                if($this->request->hasFiles() == true)
                {
                    $uploads = $this->request->getUploadedFiles();
                    $isUploaded = false;
                    $date= new DateTime();
                    $upload=$uploads[0];
                    $data['emp_logo']='-';
                    if($upload->getname()==''){
                        
                    }
                    else{
                        $a=''.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                        #do a loop to handle each file individually
                        // foreach($uploads as $upload){
                        #define a “unique” name and a path to where our file must go
                        $path = 'images/empresa/'.$a;
                        $data = $this->request->getPost();            
                        #move the file and simultaneously check if everything was ok
                        ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                        #if any file couldn’t be moved, then throw an message
                        if($isUploaded){
                            $b='opt'.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                            $c=''.$date->format('Y-m-d-H-i-s').'-opt';
                            $d=''.$date->format('Y-m-d-H-i-s').'-opt.jpg';
                            $intervention = new ImageManager(array('driver' => 'gd'));
                            $intervention->make($path)->widen(150)->save('images/empresa/'.$b, 100);
                            $intervention->make('images/empresa/'.$b)->widen(150)->save('images/empresa/'.$d, 100,'jpg');
                            // $usu->emp_logo=$c.'.jpg';
                            unlink($path);
                            unlink('images/empresa/'.$b);
                            $data['emp_logo']=$c.'.jpg';
                        }
                    }
                    $id=$auth['id'];
                    $reslegal=null;

                    if($data['emp_nombrelegal']!='' || $data['emp_primerapellidolegal']!='' || $data['emp_segundoapellidolegal']!='')
                    {
                        $replegal= new Representante();
                        $datarl['rep_nombre'] = $data['emp_nombrelegal'];
                        $datarl['rep_primerapellido']= $data['emp_primerapellidolegal'];
                        $datarl['rep_segundoapellido']= $data['emp_segundoapellidolegal'];
                        $datarl['rep_tipo']=1;
                        $reslegal= $replegal->NuevoRegistro($datarl);

                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Agregó un representante";
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$reslegal;
                        $bitacora->NuevoRegistro($databit);
                    }

                    $restra=null;
                    if($data['emp_nombretrabajador']!='' || $data['emp_primerapellidotrabajador']!='' || $data['emp_segundoapellidotrabajador']!='')
                    {
                        $reptra= new Representante();
                        $datart['rep_nombre'] = $data['emp_nombretrabajador'];
                        $datart['rep_primerapellido']= $data['emp_primerapellidotrabajador'];
                        $datart['rep_segundoapellido']= $data['emp_segundoapellidotrabajador'];
                        $datart['rep_tipo']=2;
                        $restra= $reptra->NuevoRegistro($datart);

                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Agregó un representante";
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$restra;
                        $bitacora->NuevoRegistro($databit);

                    }

                    $datae['emp_razonsocial'] = $data['emp_razonsocial'];
                    $datae['emp_logo']= $data['emp_logo'];
                    $datae['emp_rfc']= $data['emp_rfc'];
                    $datae['emp_correo']=$data['emp_correo'];
                    $datae['emp_nombre']=$data['emp_nombre'];
                    // $datae['rep_idlegal']=$reslegal;
                    // $datae['rep_idtra']=$restra;
                    $res=$empresa->NuevoRegistro($datae,$id);

                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Agregó una empresa";
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$res;
                    $bitacora->NuevoRegistro($databit);

                        // else
                            // $res=$insignia->EditarRegistro($data,$id);
                    if($res!= false)
                    { 
                        $centro= new Centrotrabajo();
                        $datadef['cen_ubicacion'] = $data['emp_ubicacion'];
                        $datadef['rep_idlegal']= $reslegal;
                        $datadef['rep_idtra']= $restra;
                        $datadef['emp_id']=$res;
                        $datadef['cen_default']=1;
                        $centrotra= $centro->NuevoRegistro($datadef);

                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Agregó un centro de trabajo";
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$centrotra;
                        $bitacora->NuevoRegistro($databit);

                        if(count($data['ubicacion'])>0)
                        {
                            for($x=0;$x<count($data['ubicacion']);$x++)
                            {    
                                $reslegalc=null;

                                if($data['nomrep_legal'][$x]!='' || $data['primrep_legal'][$x]!='' || $data['segunrep_legal'][$x]!='')
                                {
                                    $replegalc= new Representante();
                                    $datarlc['rep_nombre'] = $data['nomrep_legal'][$x];
                                    $datarlc['rep_primerapellido']= $data['primrep_legal'][$x];
                                    $datarlc['rep_segundoapellido']= $data['segunrep_legal'][$x];
                                    $datarlc['rep_tipo']=1;
                                    $reslegalc= $replegalc->NuevoRegistro($datarlc);

                                    $auth = $this->session->get('auth');
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= "Agregó un representante";
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$reslegalc;
                                    $bitacora->NuevoRegistro($databit);
                                }
                                $restrac=null;
                                if($data['nomrep_trabaja'][$x]!='' || $data['primrep_trabaja'][$x]!='' || $data['segunrep_trabaja'][$x]!='')
                                {
                                    $reptrac= new Representante();
                                    $datartc['rep_nombre'] = $data['nomrep_trabaja'][$x];
                                    $datartc['rep_primerapellido']= $data['primrep_trabaja'][$x];
                                    $datartc['rep_segundoapellido']= $data['segunrep_trabaja'][$x];
                                    $datartc['rep_tipo']=2;
                                    $restrac= $reptrac->NuevoRegistro($datartc);

                                    $auth = $this->session->get('auth');
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= "Agregó un representante";
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$restrac;
                                    $bitacora->NuevoRegistro($databit);
                                }
                                $centro= new Centrotrabajo();
                                $datacen['cen_ubicacion'] = $data['ubicacion'][$x];
                                $datacen['rep_idlegal']= $reslegalc;
                                $datacen['rep_idtra']= $restrac;
                                $datacen['emp_id']=$res;
                                $centrotra= $centro->NuevoRegistro($datacen);

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Agregó un centro de trabajo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$centrotra;
                                $bitacora->NuevoRegistro($databit);
                            }
                        }
                        $this->flash->success("Registro creado exitosamente");
                        $this->response->redirect('empresa/index');
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
            }
            else
                $res=$empresa->EditarRegistro($data,$id);

            if($res>0)
            { 
                if($clave=="")
                    $clave=$res;
                //$this->flash->success("Registro creado exitosamente");
                $this->response->redirect('empresa/index/');
                //$this->response->redirect('viaticos/asistentes/');
                $this->view->disable();
                return;
            }
            else
            {
                $this->flash->error($empresa->error);
            }
        }
        $clases=array(
            
            array("emp_nombre","col-sm-6 col-xs-6","control-label"),
            array("emp_razonsocial","col-sm-6 col-xs-6","control-label"),
            array("emp_rfc","col-sm-3 col-xs-12","control-label"),
            array("emp_estatus","col-sm-3 col-xs-12","control-label"),
            array("emp_correo","col-sm-6 col-xs-12","control-label"),
            array("emp_logo","col-sm-5 col-xs-6","control-label"),
            array("emp_ubicacion","col-sm-7 col-xs-7","control-label"),
            array("emp_nombrelegal","col-sm-5 col-xs-12","control-label"),
            array("emp_primerapellidolegal","col-sm-3 col-xs-12","control-label"),
            array("emp_segundoapellidolegal","col-sm-3 col-xs-12","control-label"),
            array("emp_nombretrabajador","col-sm-3 col-xs-12","control-label"),
            array("emp_primerapellidotrabajador","col-sm-3 col-xs-12","control-label"),
            array("emp_segundoapellidotrabajador","col-sm-3 col-xs-12","control-label"),
            
            array("enviar","col-sm-6 col-xs-12","control-label"));
        if($clave!="")
        {
            $empresa=Empresa::findFirstByemp_id($clave);
            if(!$empresa)
            {
                $this->flash->error("Ruta no encontrado");
                return $this->forward("empresa/index");
            }
            $clases=array(
                array("emp_id","col-sm-2 col-xs-12","control-label"),
                array("emp_nombre","col-sm-4 col-xs-6","control-label"),
                array("emp_razonsocial","col-sm-4 col-xs-6","control-label"),                
                array("emp_rfc","col-sm-3 col-xs-12","control-label"),
                array("emp_correo","col-sm-3 col-xs-12","control-label"),
                // array("emp_nombrelegal","col-sm-3 col-xs-12","control-label"),
                // array("emp_primerapellidolegal","col-sm-3 col-xs-12","control-label"),
                // array("emp_segundoapellidolegal","col-sm-3 col-xs-12","control-label"),
                // array("emp_nombretrabajador","col-sm-3 col-xs-12","control-label"),
                // array("emp_primerapellidotrabajador","col-sm-3 col-xs-12","control-label"),
                // array("emp_segundoapellidotrabajador","col-sm-3 col-xs-12","control-label"),
                array("emp_estatus","col-sm-3 col-xs-12","control-label"),
                array("enviar","col-sm-6 col-xs-12","control-label"));
            $this->tag->setDefault('emp_id',$empresa->emp_id);
            $this->tag->setDefault('emp_razonsocial',$empresa->emp_razonsocial);
            $this->tag->setDefault('emp_nombre',$empresa->emp_nombre);
            $this->tag->setDefault('emp_rfc',$empresa->emp_rfc);
            $this->tag->setDefault('emp_correo',$empresa->emp_correo);
            // $this->tag->setDefault('emp_nombrelegal',$empresa->emp_nombrelegal);
            // $this->tag->setDefault('emp_primerapellidolegal',$empresa->emp_primerapellidolegal);
            // $this->tag->setDefault('emp_segundoapellidolegal',$empresa->emp_segundoapellidolegal);
            // $this->tag->setDefault('emp_nombretrabajador',$empresa->emp_nombretrabajador);
            // $this->tag->setDefault('emp_primerapellidotrabajador',$empresa->emp_primerapellidotrabajador);
            // $this->tag->setDefault('emp_segundoapellidotrabajador',$empresa->emp_segundoapellidotrabajador);
            $this->tag->setDefault('emp_estatus',$empresa->emp_estatus);

        }
        else
            $this->view->vvia_producto="";
        $this->view->form = $form;
        $this->view->val=$val;
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
        $empresa = Empresa::findFirstByemp_id($id);
        if (!$empresa) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $empresa->emp_estatus = -1;
        
        if ($empresa->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó la empresa con id ".$id;
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
            $path = 'images/empresa/'.$a;
            $data = $this->request->getPost();   
            $usu=Empresa::findFirstByemp_id(strtolower($data["emp_id"]));
            if($usu){
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    $b='opt'.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                    $c=''.$date->format('Y-m-d-H-i-s').'-opt';
                    $d=''.$date->format('Y-m-d-H-i-s').'-opt.jpg';
                    $intervention = new ImageManager(array('driver' => 'gd'));
                    $intervention->make($path)->widen(150)->save('images/empresa/'.$b, 100);
                    $intervention->make('images/empresa/'.$b)->widen(150)->save('images/empresa/'.$d, 100,'jpg');
                    $usu->emp_logo=$c.'.jpg';
                    unlink($path);
                    unlink('images/empresa/'.$b);
                    if($usu->save()){
                        
                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Cambio el logo de la empresa ".$data["emp_id"];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$data["emp_id"];
                        $bitacora->NuevoRegistro($databit);

                        $this->flash->success("Imagen guardada exitosamente.");
                        $this->response->redirect('empresa/index');
                        $this->view->disable();
                        return;
                    }else
                    {
                        $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                        $this->response->redirect('empresa/index');
                        $this->view->disable();
                        return;
                    }
                    
                }else
                {
                    $this->flash->error("Error al guardar la imagen, intente de nuevo por favor.");
                    $this->response->redirect('empresa/index');
                    $this->view->disable();
                    return;
                } 
            }else
            {
                $this->flash->error("Error al encontrar la insignia a editar, intente de nuevo por favor.");
                $this->response->redirect('empresa/index');
                $this->view->disable();
                return;
            }
        }else{
            $this->flash->error("Error al cargar la imagen, intente de nuevo por favor");
            $this->response->redirect('empresa/index');
            $this->view->disable();
            return;
        }
    }

    public function ajax_empresasAction()
    {
        // $act_id = (int) $this->request->getQuery('act_id');
        $result = [];
        $auth = $this->session->get('auth');
        $id_usuario = $auth['id'];

        $subs = Empresa::find(array(
            "emp_estatus<=2 and emp_estatus>=0"
            ));
        
        if ($subs) {

            $result = $subs->toArray();
        }

        // retornar
        return $this->response->setJsonContent($result);
    }

}
