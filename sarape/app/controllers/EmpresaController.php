<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class EmpresaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Empresa');
        parent::initialize();

        
    }

    /**
     * [indexAction Index para la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(6,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
       
        
    }

    /**
     * [tablaAction Muestra los registros de la tabla puesto]
     * @param        []
     * @return []    []
     */
    public function tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $rol = Empresa::find(array(
            "emp_estatus<=2 and emp_estatus>=0"
            ));
        
        $this->view->empresas=$rol;
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
        // Comprobación si la solicitud es una solicitud POST y si el ID es válido
        if ($this->request->isPost() && $id > 0) {
            // Buscar la empresa por ID
            $empresa = Empresa::findFirstByemp_id($id);

            if ($empresa) {
                // Si se encuentra la empresa, configurar los valores de respuesta
                $answer['estatus'] = 2;
                $answer['titular'] = 'OK';
                $answer['mensaje'] = 'OK';
                $answer['data'] = $empresa;
            } else {
                // Si no se encuentra la empresa, configurar los valores de respuesta
                $answer['estatus'] = -2;
                $answer['titular'] = 'NO DATA';
                $answer['mensaje'] = 'NO DATA';
            }

            // Devolver la respuesta en formato JSON
            return $this->response->setJsonContent($answer);
        } else {
            // Devolver un código de respuesta HTTP 400 Bad Request si la solicitud no cumple los requisitos
            return http_response_code(400);
        }

    }

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();     
            $existe = Empresa::findFirstByemp_rfc($data['emp_rfc']);
            
            if($existe==true){
                $answer[0]=0;
                $answer[1]='Ya existe una empresa con este RFC.';
                // return false;
            }
            else{
                // empresa info inicio
                $empresa = new Empresa();
                $empresa->emp_nombre= $data['emp_nombre'];
                $empresa->emp_alias= $data['emp_alias'];
                $empresa->emp_rfc= $data['emp_rfc'];
                // direcion inicio
                $empresa->emp_colonia= $data['emp_colonia'];
                $empresa->emp_calle= $data['emp_calle'];
                $empresa->emp_numero= $data['emp_numero'];
                $empresa->est_id= $data['est_id'];
                $empresa->mun_id= $data['mun_id'];
                $empresa->emp_cp= $data['emp_cp'];
                // direcion fin

                //$empresa->emp_tipoformato= $data['emp_tipoformato'];
                $empresa->emp_estatus=2;
                if($data['neg_id']!=-1){
                    $empresa->neg_id=$data['neg_id'];
                }
                
                $auth = $this->session->get('auth');
                $empresa->ultimousu_id=$auth['id'];
                if($empresa->save())
                {
                    // $empresaformato = new Empresaformato();
                    // foreach ($data['emp_tipoformato'] as $key => $emp_tipoformato) 
                    // {
                    //      $res_emp_tipoformato= $empresaformato->NuevoRegistro($emp_tipoformato,$empresa->emp_id);          
                    // }

                    $contacto= new Contactoemp();
                    $contacto->emp_id= $empresa->emp_id;
                    $contacto->cne_nombre= $data['cne_nombreempresa'];
                    $contacto->cne_primerapellido= $data['cne_primerapellidoempresa'];
                    $contacto->cne_segundoapellido= $data['cne_segundoapellidoempresa'];
                    $contacto->cne_puesto= $data['cne_puestoempresa'];
                    $contacto->cne_celular= $data['cne_celularempresa'];
                    $contacto->cne_tel= $data['cne_telempresa'];
                    $contacto->cne_ext= $data['cne_extempresa'];
                    $contacto->cne_correo= $data['cne_correoempresa'];
                    $contacto->cne_estatus= 2;

                    if($contacto->save()){
                        $auth = $this->session->get('auth');
                        $data_bit = [
                            'bit_descripcion'=>'Creó la empresa llamada '. $data['emp_nombre'].' con RFC '.$data["emp_rfc"],
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$empresa->emp_id,
                            'bit_modulo'=>"Empresa",
                            'bit_accion'=>1,
                        ];
                        $this->bitacora_registro($data_bit,$auth);

                    }

                    // $auth = $this->session->get('auth');
                    // $bitacora= new Bitacora();
                    // $databit['bit_descripcion']= 'Creó la empresa  llamada '. $data['emp_nombre'].' con RFC '.$data["emp_rfc"];
                    // $databit['usu_id']=$auth['id'];
                    // $databit['bit_tablaid']=$empresa->emp_id;
                    // $databit['bit_modulo']="Empresa";
                    // $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                }
                else
                    $answer[0]=0;
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
                // dirrecion inicio
                    $empresa->emp_colonia= $data['emp_colonia_editar'];
                    $empresa->emp_calle= $data['emp_calle_editar'];
                    $empresa->emp_numero= $data['emp_numero_editar'];
                    $empresa->est_id= $data['est_id_editar'];
                    $empresa->mun_id= $data['mun_id_editar'];
                    $empresa->emp_cp= $data['emp_cp_editar'];
                // direcion fin 

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

                    $data_bit = [
                        'bit_descripcion'=>"Editó la empresa con id interno ".$data["emp_ideditar"].',con nombre '.$empresa->emp_nombre.'y con RFC '.$empresa->emp_rfc,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$clave,
                        'bit_modulo'=>"Empresa",
                        'bit_accion'=>2
                    ];
                    $this->bitacora_registro($data_bit,$auth);
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
                        $data_bit = [
                            'bit_descripcion'=>"Cambió el logo de la empresa ".$data["emp_id"],
                            'usu_id'=>$auth['id'],
                            'bit_tablaid'=>$data["emp_id"],
                            'bit_modulo'=>"Empresa",
                            'bit_accion'=>2
                        ];
                        $this->bitacora_registro($data_bit,$auth);

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
                    $data_bit = [
                        'bit_descripcion'=>'Eliminó la empresa  con id  '. $empresa->emp_id.' interno del sistema,la empresa con el nombre de '.$empresa->emp_nombre.  ' y con RFC '.$empresa->emp_rfc,
                        'usu_id'=>$auth['id'],
                        'bit_tablaid'=>$empresa->emp_id,
                        'bit_modulo'=>"Empresa",
                        'bit_accion'=>3
                    ];

                    $this->bitacora_registro($data_bit,$auth);

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

    public function ajax_get_detalle_completoAction($emp_id=0){
        $rol = new Rol();
        $auth = $this->session->get('auth');

        $answer = array();
        $answer['mensaje']='ERROR';
        $this->view->disable();
        try {
            if ($this->request->isAjax() && $emp_id > 0) {
                $emp_obj=new Empresa();
                $registro = Empresa::query()
                ->columns('
                        Empresa.emp_alias,
                        Empresa.emp_calle,
                        Empresa.emp_colonia,
                        Empresa.emp_cp,
                        Empresa.emp_id,
                        Empresa.emp_logo,
                        Empresa.emp_numero,
                        Empresa.emp_rfc,
                        Empresa.emp_registro,
                        Empresa.emp_nombre,
                        neg.neg_nombre,
                        mun.mun_nombre,
                        est.est_nombre
                    ')
                    ->where('Empresa.emp_id=' . $emp_id)
                    ->leftjoin('Estado','est.est_id=Empresa.est_id','est')
                    ->leftjoin('Municipio','mun.mun_id=Empresa.mun_id','mun')
                    ->leftjoin('Negocio','neg.neg_id=Empresa.neg_id','neg')
                    ->execute();

                    //validamos si existe el logo inicio
                    $logo="";
                    if(count($registro)>0){
                        if( $registro[0]->emp_logo=="" ||  $registro[0]->emp_logo==null){
                            $logo= $emp_obj->logo_iniciador;
                        }else{
                            $logo_find="images/logoempresa/".$registro[0]->emp_logo;
                            $logo=$registro[0]->emp_logo;;

                            if (!file_exists($logo_find)) {
                                $logo="";
                                $logo= $emp_obj->logo_iniciador;
                            }
                        }

                    }
                    //validamos si existe el logo fin 

                    $registros_cne = Contactoemp::query()
                    ->columns('
                        CONCAT(
                            Contactoemp.cne_nombre, " ",
                            Contactoemp.cne_primerapellido, " ",
                            Contactoemp.cne_segundoapellido
                        ) as cne_nombre,
                        Contactoemp.cne_puesto,
                        Contactoemp.cne_tel,
                        Contactoemp.cne_celular,
                        Contactoemp.cne_id,

                        Contactoemp.cne_correo
                    ')
                    ->where('Contactoemp.emp_id=' . $emp_id.' AND Contactoemp.cne_estatus > 0')
                    ->execute();
                    $regs_fat_vac_normal_count = new Builder();
                    $regs_fat_vac_normal_count=$regs_fat_vac_normal_count
                    ->addFrom('Facturacion',"fat")
                    ->leftjoin('Expedientecan','exc.exc_id=fat.exc_id','exc')
                    ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                    ->where('fat.fat_estatus=2 AND fat.vac_estatus=5 AND vac.emp_id='.$emp_id)
                    ->getQuery()
                    ->execute()->count();
                    $regs_fat_vac_gar_count = new Builder();
                    $regs_fat_vac_gar_count=$regs_fat_vac_gar_count
                    ->addFrom('Facturacion',"fat")
                    ->leftjoin('Expedientecan','exc.exc_id=fat.exc_id','exc')
                    ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                    ->where('fat.fat_estatus=2 AND fat.vac_estatus=3 AND vac.emp_id='.$emp_id)
                    ->getQuery()
                    ->execute()->count();

                    

                    $registros_cen = Centrocosto::query()
                    ->columns('
                        Centrocosto.cen_nombre,
                        Centrocosto.cen_correo,
                        Centrocosto.cen_clave,
                        Centrocosto.cen_id,
                        Centrocosto.cen_tel
                    ')
                    ->where('Centrocosto.emp_id=' . $emp_id.' AND Centrocosto.cen_estatus > 0')
                    ->execute();
                    
                    $registros_vac_alta = Vacante::query()
                    ->where('Vacante.emp_id=' . $emp_id.' AND Vacante.vac_estatus > 0')
                    ->execute();

                    $vac_alta_count=count($registros_vac_alta);

        
                if (count($registro)>0) {
                    $answer['estado'] = 2;
                    $answer['data_emp'] = $registro[0];
                    $answer['data_emp_logo'] = $logo;

                    $answer['data_cne'] = $registros_cne;
                    $answer['data_cen'] = $registros_cen;
                    $answer['vac_alta_count'] = $vac_alta_count;
                    $answer['fat_vac_normal_count'] = $regs_fat_vac_normal_count;
                    $answer['fat_vac_gar_count'] = $regs_fat_vac_gar_count;
                    $answer['mensaje']='OK';
                    $answer['titular']='OK';


                } else {
                    $answer['estado'] = -1;
                }
            } else {
                $answer['estado'] = -1;
            }
        } catch (\Exception $e) {
            $answer['estado'] = -1;
            $answer['mensaje']='ERROR';
            $answer['titular']='ERROR';
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
            $data_bit = [
                'bit_descripcion'=>'ERROR OBTENER DETALLES DE GET EN EMPRESA : '.$answer["mensaje"],
                'bit_tablaid' => $emp_id,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();

    }

   
}
