<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class EmpresaController extends ControllerBase
{
    public $gru_id_default=3;
    public function initialize()
    {
        $this->tag->setTitle('Empresa');
        parent::initialize();
        
        // $rol = new Rol();
        // $auth = $this->session->get('auth');
        // if(!$rol->verificar(6,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //  $this->response->redirect('index/panel');
        //   $this->view->disable();
        //    return;   
        // }
        
    }

    /**
     * [indexAction Index para la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {/*
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(7,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        */
    }

    /**
     * [tablaAction Muestra los registros de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $empresa=Empresa::query()
            ->columns('emp_id, emp_nombre, emp_rfc, emp_alias, neg.neg_id, neg_nombre')
            ->where("emp_estatus=2")
            ->leftjoin('Negocio','neg.neg_id=Empresa.neg_id','neg')
            ->execute();
        
        $this->view->empresas=$empresa;
    }

    public function detallesAction($clave=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        $this->view->disable();
        if(!$rol->verificar(9,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        // $answer=array();
        // $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $agente=Agente::findFirstByage_id($clave);
            if($agente)
            {
                $answer[0]=1;
                $answer[1]=$agente;

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

    public function ajax_empresasAction()
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];

        $subs = Empresa::find(array(
            "emp_estatus=2"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

    public function ajax_empresa_detalleAction($id=0)
    {
      
        $answer=[];
        if($this->request->isAjax()&&$id>0)
        {

            $empresa=Empresa::findFirstByemp_id($id);

            if($empresa){
             $answer['estatus']=2;
             $answer['titular']='OK';
             $answer['mensaje']='OK';
             $answer['data']=$empresa;


            }else{
                $answer['estatus']=-2;
                $answer['titular']='NO DATA';
                $answer['mensaje']='NO DATA';
            }
      
            return $this->response->setJsonContent($answer);
        }else{
            return http_response_code(400);

        }

    }
    public function nuevoAction()
    {
        $answer = array();
        $answer[0] = 1;
        $this->view->disable();
    
        if ($this->request->isAjax()) {
            try {
                $this->db->begin(); // Iniciar transacción
    
                $data = $this->request->getPost();     
                $existe = Empresa::findFirstByemp_rfc($data['emp_rfc']);
                
                if ($existe) {
                    $answer[0] = 0;
                    $answer[1] = 'Ya existe una empresa con este RFC.';
                } else {
                    $empresa = new Empresa();
                    $empresa->emp_nombre = $data['emp_nombre'];
                    $empresa->emp_alias = $data['emp_alias'];
                    $empresa->emp_rfc = $data['emp_rfc'];
                    $empresa->emp_estatus = 2;
                    $empresa->gru_id = $this->gru_id_default;

                    if ($data['neg_id'] != -1) {
                        $empresa->neg_id = $data['neg_id'];
                    }
                    
                    $auth = $this->session->get('auth');
                    $empresa->ultimousu_id = $auth['id'];
    
                    if ($empresa->save()) {
                        $empresaformato = new Empresaformato();
                        foreach ($data['emp_tipoformato'] as $key => $emp_tipoformato) {
                             $res_emp_tipoformato = $empresaformato->NuevoRegistro($emp_tipoformato, $empresa->emp_id);          
                        }
    
                        $contacto = new Contactoemp();
                        $contacto->emp_id = $empresa->emp_id;
                        $contacto->cne_nombre = $data['cne_nombreempresa'];
                        $contacto->cne_primerapellido = $data['cne_primerapellidoempresa'];
                        $contacto->cne_segundoapellido = $data['cne_segundoapellidoempresa'];
                        $contacto->cne_puesto = $data['cne_puestoempresa'];
                        $contacto->cne_celular = $data['cne_celularempresa'];
                        $contacto->cne_tel = $data['cne_telempresa'];
                        $contacto->cne_ext = $data['cne_extempresa'];
                        $contacto->cne_correo = $data['cne_correoempresa'];
                        $contacto->cne_estatus = 2;
                        $contacto->cne_copiaenvio = $data['cne_copiaenvio'];
    
                        if ($contacto->save()) {
                            $auth = $this->session->get('auth');
                            $bitacora = new Bitacora();
                            $databit['bit_descripcion'] = 'Creó la empresa  llamada '. $data['emp_nombre'].' con RFC '.$data["emp_rfc"];
                            $databit['usu_id'] = $auth['id'];
                            $databit['bit_tablaid'] = $empresa->emp_id;
                            $databit['bit_modulo'] = "Empresa";
                            $bitacora->NuevoRegistro($databit);
    
                            $this->db->commit();
                            $answer[0] = 1;
                        } else {
                            $this->db->rollback();
                            $answer[0] = 0;
                        }
                    } else {
                        $this->db->rollback();
                        $answer[0] = 0;
                    }
                }
            } catch (\Exception $e) {
                $this->db->rollback();
                $answer[0] = 0;
                $answer[1] = 'Error al procesar la solicitud: ' . $e->getMessage();
            }
        } else {
            $answer[0] = -1;
        }
    
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
            $empresa=Empresa::findFirstByemp_id($clave);
            if($empresa)
            {
                $answer[0]=1;
                $answer[1]=$empresa;
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
            $empresa=Empresa::findFirstByemp_id($clave);

            if($empresa)
            {

                
                $empresa->emp_nombre=$data["emp_nombreeditar"];
                $empresa->emp_rfc=$data["emp_rfceditar"];
                $empresa->emp_alias= $data['emp_aliaseditar'];
                //$empresa->emp_tipoformato= $data['emp_tipoformatoeditar'];
                
                $auth = $this->session->get('auth');
                $empresa->ultimousu_id=$auth['id'];
                if($data['neg_ideditar']!=-1){
                    $empresa->neg_id=$data['neg_ideditar'];
                }else{
                    $empresa->neg_id=null;
                }
                
                if($empresa->save())
                {

                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Editó la empresa con id interno ".$data["emp_ideditar"].',con nombre '.$empresa->emp_nombre.'y con RFC '.$empresa->emp_rfc;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$clave;
                    $databit['bit_modulo']="Empresa";
                    $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                }
                else
                {
                    $answer[0]=0;
                }
                

            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

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
            $path = 'images/logoempresa/'.$a;
            $data = $this->request->getPost();   
            $usu=Empresa::findFirstByemp_id($data["emp_id"]);
            if($usu){
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    $b='opt'.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                    $c=''.$date->format('Y-m-d-H-i-s').'-opt';
                    $d=''.$date->format('Y-m-d-H-i-s').'-opt.jpg';
                    $intervention = new ImageManager(array('driver' => 'gd'));
                    $intervention->make($path)->widen(150)->save('images/logoempresa/'.$b, 100);
                    $intervention->make('images/logoempresa/'.$b)->widen(150)->save('images/logoempresa/'.$d, 100,'jpg');
                    $usu->emp_logo=$c.'.jpg';
                    unlink($path);
                    unlink('images/logoempresa/'.$b);
                    if($usu->save()){
                        
                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Cambió el logo de la empresa ".$data["emp_id"];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$data["emp_id"];
                        $databit['bit_modulo']="Empresa";
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
                $this->flash->error("Error al encontrar la empresa a editar, intente de nuevo por favor.");
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


    public function eliminarAction($emp_id=0)
    {
        $answer=array();
        $answer[0]=-1;
        $this->view->disable();

        if($this->request->isAjax()&&$emp_id>0)
        {  
            
            $empresa=Empresa::findFirstByemp_id($emp_id);
            $auth = $this->session->get('auth');

            if($empresa)
            {

            $empresa->emp_estatus=-1;    

                if($empresa->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Eliminó la empresa  con id  '. $empresa->emp_id.' interno del sistema,la empresa con el nombre de '.$empresa->emp_nombre.  ' y con RFC '.$empresa->emp_rfc;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$empresa->emp_id;
                    $databit['bit_modulo']="Empresa";
                    $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                    $answer['mensaje']="Éxito al eliminar el registro";
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                else
                {
                    $answer[0]=-1;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
             
            }
            else
            {
                $answer[0]=-1;
                $answer['mensaje']='Error al guardar los datos';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }

        }
       
        
        
    }
    public function ajax_empresas_con_formatoAction($tif_id = 0, $emp_id = 0)
    {
        $this->view->disable();
        $answer = array();
        $answer[0] = -2;
        $answer["mensaje"] = "error";
    
        if ($this->request->isAjax() && $tif_id != 0 && is_numeric($tif_id)) {
            $answer[0] = 2;
            $empresas = Empresa::query()
                ->columns('Empresa.emp_id, emp_nombre')
                ->leftjoin('Empresaformato', 'emf.emp_id=Empresa.emp_id', 'emf')
                ->where('emf.tif_id=' . $tif_id . ' AND Empresa.emp_estatus=2 AND emf.emf_estatus=2')
                ->execute();
    
            if (count($empresas) == 0) {
                // Aquí no encontró información relacionada al formato correspondiente
    
                if ($emp_id != 0) {
                    // Validamos que venga el id de la empresa a la que corresponde el estudio
                    $answer['data'] = Empresa::query()
                        ->columns('Empresa.emp_id, emp_nombre')
                        ->where('Empresa.emp_estatus=2 AND Empresa.emp_id=' . $emp_id)
                        ->execute();
                    $answer["mensaje"] = "empresa ok y formato no found";
                }
            } else {
                // Aquí encontró información relacionada al formato
                $answer['data'] = $empresas;
                $answer["mensaje"] = "empresa ok y formato ok";
            }
    
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } else {
            return http_response_code(400);
        }
    }
    
}
