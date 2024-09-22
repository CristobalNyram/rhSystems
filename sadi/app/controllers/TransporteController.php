<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class TransporteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Comprobar transportes');
        parent::initialize();
    }

    public function asignados_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(22,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
           return;   
        }

        if($rol->verificar(28,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $titular='Desglose de todo los transportes que se necesitan comprobar';
            
        }
        if($rol->verificar(29,$auth['rol_id']))
        {
            $titular='Desglose de transportes que necesita comprobar';

        }
        $this->view->titular=$titular;

        
    }
    public function asignados_tablaAction()
    {

        $rol = new Rol();
        $auth = $this->session->get('auth');
        $condicion=' ';
        $titular='';
        if(!$rol->verificar(22,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
           return;   
        }

        if($rol->verificar(28,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $condicion='';
        }
        if($rol->verificar(29,$auth['rol_id']))
        {
            $condicion='and investigadorusu_id='.$auth['id'];
        }
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $tranportes_asignados = Transporte::find(array(
            'tra_estatus=1 '.$condicion
            ));
        
        $this->view->transporte_asignados=$tranportes_asignados;
    }

    public function ajax_nuevo_comprobar_transporte_investigadorAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $fecha_y_hora = date("Y-m-d H:i:s");

            $rol=Rol::findFirstByrol_id($auth['rol_id']);
            if($data['tra_solicitado__solicitar']>$rol->rol_trasolicitar){
                $answer[0]=-1;
                $answer['titular']='ERROR';
                $answer['mensaje']='El monto solicitado supera al permitido para tu usuario. Contacte a un administrador.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }

            $transporte_utilizado=Transporte::findFirstBytra_id($data['tra_id__solicitar']);
            if($transporte_utilizado==true)
            {

                if($transporte_utilizado->tra_estatus==3 || $transporte_utilizado->tra_estatus==2){
                    $answer[0]=-1;
                    $answer['titular']='ADVERTENCIA';
                    $answer['mensaje']='El transporte ya ha sido solicitado/aprobado anteriormente.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                    
                }
                
                if($transporte_utilizado->tra_estatus==-2){
                    $answer[0]=-1;
                    $answer['titular']='ADVERTENCIA';
                    $answer['mensaje']='El transporte ya no está disponible...';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                    
                }
                if($transporte_utilizado->tra_solicitado!=null){
                    $answer[0]=-1;
                    $answer['titular']='ADVERTENCIA';
                    $answer['mensaje']='El transporte ya no está disponible...';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                    
                }

                $transporte_utilizado->tra_solicitado=$data['tra_solicitado__solicitar'];
                $transporte_utilizado->est_idorigen=$data['est_idorigen'];
                $transporte_utilizado->mun_idorigen=$data['mun_idorigen'];
                $transporte_utilizado->est_iddestino=$data['est_iddestino'];
                $transporte_utilizado->mun_iddestino=$data['mun_iddestino'];

                $estado = new Estado();
                $origen = $estado->getNombre($data['est_idorigen']);
                $destino = $estado->getNombre($data['est_iddestino']);

                $municipio = new Municipio();
                $origen.=", ".$municipio->getNombre($data['mun_idorigen']);
                $destino.=", ".$municipio->getNombre($data['mun_iddestino']);

                $transporte_utilizado->tra_origen=$origen;
                $transporte_utilizado->tra_estatus=1;

                $transporte_utilizado->tra_destino=$destino;
                $transporte_utilizado->tra_comentario=$data['tra_comentario__solicitar'];
                $transporte_utilizado->tra_fechainvestigador=$fecha_y_hora;


                if($transporte_utilizado->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Solicito transporte con un monto de $'.$data['tra_solicitado__solicitar'].' con origen de '.$origen.' con destino a '.$destino;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$data['tra_id__solicitar'];
                    $databit['ese_id']=$transporte_utilizado->ese_id;
                    $databit['bit_modulo']="Transporte";
                    $bitacora->NuevoRegistro($databit);
                       
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='¡Has solicitado transporte correctamente!';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar tus datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
        }
        else
        {

            $answer[0]=-1;
            $answer['titular']='ERROR';
            $answer['mensaje']='No se pudieron procesar tus datos.(ajax)';
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
    }

    public function ajax_editar_comprobar_transporte_investigadorAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');

            $rol=Rol::findFirstByrol_id($auth['rol_id']);
            if($data['tra_solicitado__editar']>$rol->rol_trasolicitar){
                $answer[0]=-1;
                $answer['titular']='ERROR';
                $answer['mensaje']='El monto solicitado supera al permitido para tu usuario. Contacte a un administrador.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }

            $transporte_utilizado=Transporte::findFirstBytra_id($data['tra_id__editar']);
            if($transporte_utilizado==true)
            {
                if($transporte_utilizado->tra_estatus==3)
                {
                    $answer[0]=-1;
                    $answer['titular']='ADVERTENCIA';
                    $answer['mensaje']='El transporte ya ha sido solicitado anteriormente.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                    
                }

                if($transporte_utilizado->tra_estatus==-2)
                {
                    $answer[0]=-1;
                    $answer['titular']='ADVERTENCIA';
                    $answer['mensaje']='El transporte ya ha no está disponible.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                    
                }

                $transporte_utilizado->est_idorigen=$data['est_idorigen_editar'];
                $transporte_utilizado->mun_idorigen=$data['mun_idorigen_editar'];
                $transporte_utilizado->est_iddestino=$data['est_iddestino_editar'];
                $transporte_utilizado->mun_iddestino=$data['mun_iddestino_editar'];

                $estado = new Estado();
                $origen = $estado->getNombre($data['est_idorigen_editar']);
                $destino = $estado->getNombre($data['est_iddestino_editar']);

                $municipio = new Municipio();
                $origen.=", ".$municipio->getNombre($data['mun_idorigen_editar']);
                $destino.=", ".$municipio->getNombre($data['mun_iddestino_editar']);

                $transporte_utilizado->tra_solicitado=$data['tra_solicitado__editar'];
                $transporte_utilizado->tra_origen=$origen;
                $transporte_utilizado->tra_destino=$destino;
                $transporte_utilizado->tra_comentario=$data['tra_comentario__editar'];
                if($transporte_utilizado->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Edito transporte con un monto de $'.$data['tra_solicitado__editar'].' con origen de '.$origen.' con destino a '.$destino;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$data['tra_id__editar'];
                    $databit['ese_id']= $transporte_utilizado->ese_id;
                    $databit['bit_modulo']="Transporte";
                    $bitacora->NuevoRegistro($databit);
                       
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='¡Has editado la solicitud de transporte correctamente!';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar tus datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
        }
        else
        {

            $answer[0]=-1;
            $answer['titular']='ERROR';
            $answer['mensaje']='No se pudieron procesar tus datos.(ajax)';
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

    }

    //esta funcion cambia a estatus 2 el transporte
    public function ajax_solicitar_tranpsorte_investigadorAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $fecha_y_hora = date("Y-m-d H:i:s");


            $transporte_utilizado=Transporte::findFirstBytra_id($data['tran_id']);
            if($transporte_utilizado==true)
            {
           
                $transporte_utilizado->tra_estatus=2;
                $transporte_utilizado->tra_fechainvestigador=$fecha_y_hora;
                if($transporte_utilizado->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Mandó a solicitar transporte con ID interno del sistema #'.$data['tran_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$data['tran_id'];
                    $databit['ese_id']= $transporte_utilizado->ese_id;

                    $databit['bit_modulo']="Transporte";
                    $bitacora->NuevoRegistro($databit);
                       
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='¡Has enviado la solicitud de transporte correctamente! ';
                
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }
            else
            {
                $answer[0]=-1;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar tus datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }        
        }
    }

    public function ajax_subir_archivo_transporteAction($id_ese=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        $this->db->begin();    
        try {
            if(!$this->request->isPost())
            throw new Exception("FORMATO INCORRECTO DE SOLICITUD");
            //proceso inicio
            $answer=array();
            $answer[0]=1;
            $data = $this->request->getPost();
            $ruta = 'transportes/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
            $title = '';
            $date= new DateTime();
            $countfiles = count($_FILES['archivo_transporte']['name']);
          
            for($i=0;$i<$countfiles;$i++){

                $filename = $_FILES['archivo_transporte']['name'][$i];
                $isUploaded = false;
                $documento= new Archivotransporte();
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                // Upload file
                // $nombre_archivo=$this->limpiar_string(''.$date->format('Y-m-d-H-i-s').'-'.strtolower($filename));
                $name_clean=$this->limpiar_string2($filename);
                $name_clean = substr($name_clean, 0, -3);
                $a=$this->limpiar_string(''.$date->format('Y-m-d-H-i-s').'-'.strtolower($name_clean).".".$tipo);
                $nombre_archivo=$a;
                
                (move_uploaded_file($_FILES['archivo_transporte']['tmp_name'][$i],'transportes/'.$nombre_archivo)) ? $isUploaded = true : $isUploaded = false;
                if($isUploaded){
                    $answer[2]='entra';
                    $data1['art_nombre']=$nombre_archivo;
                    $data1['art_estatus']=2;
                    $data1['art_nota']=$data['archivotransporte_art_nota_nuevo'];
                    $data1['ese_id']=$data['archivotransporte_ese_id_nuevo'];
                    $data1['tra_id']=$data['archivotransporte_tra_id_nuevo'];

                        // $data['pol_archivo']=$a;
                    if($documento->NuevoRegistro($data1)==true)
                    {
                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Subió el archivo '.$nombre_archivo.', al transporte con ID interno de '.$data['archivotransporte_tra_id_nuevo'];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=1;
                        $databit['bit_modulo']="Archivos transporte";
                        $bitacora->NuevoRegistro($databit);
                        $title='Éxito';
                        $message='Se ha subido correctamente su archivo.';
                    }
                    else
                    {
                        $title='error';
                        $message='error al subir - bitácora';
                    }
                }else{
                    $title='error';
                    $message='error al subir';
                }
            }

            $this->db->commit();
            $answer['estado']=2;
            $answer['tra_id']=$data['archivotransporte_tra_id_nuevo'];
            $answer['titular']=$title;
            $answer['mensaje']=$message;
            $this->response->setJsonContent($answer);
            $this->response->send();     
            //proceso fin 

        } catch (\Exception $e) {
            $this->db->rollback();
            $title='error';
            $message='error al subir';
            error_log("Excepción: archivoAction Transporte subir el archivo transporte " . $e->getMessage());
            $answer = [
                 0 => -2,
                 3 => $e->getMessage(),
                'titular' => 'AVISO',
                //'exc_id' => $id,
            ];
    
            $this->response->setJsonContent($answer);
            $this->response->send();
        }
        
        
       


           
        

    }

    public function archivo_tablaAction($id=0){
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(22,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        if($id==0)
        {
        	$archivo = Archivotransporte::find(array(
            "art_estatus=2"
            ));
        }
        else
        {
        	$archivo=new Builder();
	        $archivo=$archivo
	        ->columns(array('a.art_id, art_nombre, a.ese_id, art_nota,tra_id'))
	        ->addFrom('Archivotransporte','a')
	        ->where('art_estatus=2 and tra_id='.$id)
	        ->getQuery()
	        ->execute();

            
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los archivos del transporte con clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Archivos transportes";
        $bitacora->NuevoRegistro($databit);
        $this->view->page=$archivo;

    
    }

    public function eliminar_evidencia_transporteAction($id)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        // 
        if(!$rol->verificar(22,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        // $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $archivo=Archivotransporte::findFirstByart_id($id);
        if($archivo){
            $archivo->art_estatus=-1;
            
            if($archivo->save()) {
                $answer[0]=1;

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Eliminó el archivo '.$archivo->art_nombre.' del transporte  con ID interno #:'.$archivo->ese_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Archivos transporte";
                $bitacora->NuevoRegistro($databit);

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function aprobar_indexAction()
    {

        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(25,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
           return;   
        }

        
        
    }

    public function aprobar_tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(25,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
           return;   
        }

        $condicion='tra_estatus=2 and ';
        $condicion.=$this->getEstudios("est.");

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $transporte_solicitados=Transporte::query()
        ->columns(' tra_id,tra_preaprobado,tra_solicitado,tra_aprobado,est.ese_id,tra_comentario,tra_origen,tra_fechainvestigador,tra_destino
                    ,usu.usu_nombre as inv_nombre ,usu.usu_primerapellido as inv_apellido
                    ,usu.usu_segundoapellido as inv_segundoApellido, tip_clave, ese_fechaentregacliente
                    ,tif_id, est.tip_id
                    ,est.ese_estatus,est.ese_folioverificacion
                    ,est.ese_fechaentregainvestigador
                    '
                    )
        ->where($condicion)
        ->leftjoin('Usuario','usu.usu_id=Transporte.investigadorusu_id','usu')
        ->join('Estudio','est.ese_id=Transporte.ese_id','est')
        ->join('Tipoestudio','tip.tip_id=est.tip_id','tip')
        ->execute();


        $this->estudio = new Estudio();
        $this->usuario = new Usuario(); 
        $this->view->estudio = $this->estudio;
        $this->view->usuario = $this->usuario;

        $this->view->transporte_solicitados=$transporte_solicitados;

    }
    public function ajax_aprobarAction()
    {
          
        $answer=array();
        $answer[0]=1;
        $this->view->disable();

        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $fecha_y_hora = date("Y-m-d H:i:s");

            $transporte_utilizado=Transporte::findFirstBytra_id($data['tra_id__aprobar']);
            if($transporte_utilizado==true)
            {
                $rol=Rol::findFirstByrol_id($auth['rol_id']);

                if($transporte_utilizado->tra_estatus!=2){
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se pudieron procesar tus datos por el trasporte ha cambiado de estatus.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

                if($data['tra_aprobado__aprobar']>$rol->rol_traaprobar){
                    $transporte_utilizado->tra_comentarioadmin=$data['tra_comentario_admin'];
                    $transporte_utilizado->save();
                    $answer[0]=-1;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='El monto autorizado supera al permitido para tu rol. Contacta a un administrador.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                $transporte_utilizado->tra_aprobado=$data['tra_aprobado__aprobar'];
                $transporte_utilizado->tra_estatus=3;
                $transporte_utilizado->tra_comentarioadmin=$data['tra_comentario_admin'];
                $transporte_utilizado->aprobadousu_id=$auth['id'];
                $transporte_utilizado->tra_fechaaprobado=$fecha_y_hora;
                if($transporte_utilizado->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Aprobó el transporte con un monto de $'.$data['tra_aprobado__aprobar'];
                    $databit['usu_id']=$auth['id'];
                    $databit['ese_id']= $transporte_utilizado->ese_id;
                    $databit['bit_tablaid']=$data['tra_id__aprobar'];
                    $databit['bit_modulo']="Transporte";
                    $bitacora->NuevoRegistro($databit);
                       
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='¡Has aprobado transporte correctamente #'.$data['tra_id__aprobar'].'!';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }
            else
            {
                $answer[0]=-1;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar tus datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
        }
    }

    public function descargarAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(22,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        // $response = new Response();
        $art = Archivotransporte::findFirstByart_id($id);
        $file=$art->art_nombre;
        $response = new Response();
        $path = 'transportes/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);   
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, '"'.str_replace(" ","-",$file).'"', true);
        $response->send();

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Descargó el archivo ".$file." del estudio ".$art->ese_id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=1;
        $databit['bit_modulo']="Archivos transporte";
        $bitacora->NuevoRegistro($databit);
        die();
    }


    public function ajax_get_detalleAction($tra_id)
    {
        $this->view->disable();
        $answer=array();

        if ($tra_id!=0 && is_numeric($tra_id)) {
            $subs =Transporte::findFirstBytra_id($tra_id);
            $ese_data=Estudio::findFirstByese_id($subs->ese_id);

            if ($subs->tra_estatus!=-2) {
                $answer[0]=2;
                $answer['data']= $subs;
                $answer['data_ese']= $ese_data;

                $answer['titular']='OK';
                $answer['mensaje']='OK';
                return $this->response->setJsonContent($answer);
            }
            else{
                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                return $this->response->setJsonContent($answer);
            }
        }
        else{
            
            $answer[0]=-2;
            $answer['titular']='NO DISPONIBLE';
            $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
            return $this->response->setJsonContent($answer);
        }
       
        return $this->response->setJsonContent($answer);

    }

    public function ajax_asignar_transporteAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $data_transporte=$data['asignar_transporte'];
            $ese_id=  $data_transporte['ese_id'];
            // $estudio=$data_transporte['ese_id'];
            $estudio_estatus=Estudio::query()
                        ->where("ese_id=".$ese_id.' and ese_estatus >= 0')
                        ->execute();
            $estudio=$estudio_estatus[0];
            if($estudio){
                $transporte= new Transporte();
                $respuesta_modelo_verificar_transporte= $transporte->verificar_estudio_tiene_transporte_asignado_activo($ese_id);

                if( $respuesta_modelo_verificar_transporte['estado']!=2){
                    $rol=Rol::findFirstByrol_id($auth['rol_id']);
                    if($data_transporte['pre_aprobado']>$rol->rol_traaprobar){
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='El monto pre-aprobado supera el permitido para tu rol.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }

                    if($estudio->ese_estatus==-2){
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='El estudio ya no está disponible.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }

                    $investigador=Usuario::findFirstByusu_id($data_transporte['inv_id']);
                    if($investigador->usu_transporte!=1){ //si el investigador tiene una restricción para que se le asignen transportes
                        $rol = new Rol();
                        $auth = $this->session->get('auth');
                        if(!$rol->verificar(77,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                        {
                            $answer[0]=-2;
                            $answer['titular']='ERROR';
                            $answer['mensaje']='No cuentas con los permisos para asignarle transporte al investigador solicitado.';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }
                    }
                    $data_transporte['asignausu_id']= $auth['id'];
                    $respuesta_modelo_asignar_transporte=$transporte->asignar_transporte($ese_id,$data_transporte);
                    $estudio->ese_transporte=2;
                    $estudio->update();

                        if( $respuesta_modelo_asignar_transporte['estado']==2){
                            
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Asignó un transporte al estudio con ID interno '.$ese_id.' al usuario con ID '.$data_transporte['inv_id'].'  con un pre aprobado de $'.$data_transporte['pre_aprobado'].' el ID interno del transporte es '.$respuesta_modelo_asignar_transporte['tra_id'];
                            $databit['usu_id']=$auth['id'];
                            $databit['ese_id']=$ese_id;
                            $databit['bit_tablaid']=$respuesta_modelo_asignar_transporte['tra_id'];
                            $databit['bit_modulo']="Transporte";
                            $bitacora->NuevoRegistro($databit);

                            $comentario= new Comentarioese();
                            $comentario->com_comentario= $databit['bit_descripcion'];
                            $comentario->com_estatus= 2;
                            $comentario->usu_id= $auth['id'];
                            $comentario->ese_id= $ese_id;
                            $comentario->ese_estatus= 2;
                            $comentario->save();

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='¡Has asignado un transporte correctamente!';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }else{
                            $answer[0]=-2;
                            $answer['titular']='Error';
                            $answer['mensaje']='Error al procesar los datos...';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }
                   

                }else
                {

                    $answer[0]=-1;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='El estudio ya tiene asignado un transporte.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;

                }

            }else{

                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El estudio está borrado.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;

            }
           
        }
       
        
    }
    
    public function ajax_asignarautorizado_transporteAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $data_transporte=$data['asignar_transporte'];
            $ese_id=  $data_transporte['ese_id'];
            // $estudio=$data_transporte['ese_id'];
            $estudio_estatus=Estudio::query()
                        ->where("ese_id=".$ese_id.' and ese_estatus >= 0')
                        ->execute();
            $estudio=$estudio_estatus[0];
            if($estudio){
                if($estudio->ese_estatus!=7){
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='El estudio no ha sido entregado aún.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                $transporte= new Transporte();
                $respuesta_modelo_verificar_transporte= $transporte->verificar_estudio_tiene_transporte_asignado_activo($ese_id);

                if( $respuesta_modelo_verificar_transporte['estado']!=2){
                    $rol=Rol::findFirstByrol_id($auth['rol_id']);
                    if($data_transporte['pre_aprobado']>$rol->rol_traaprobar){
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='El monto pre-aprobado supera el permitido para tu rol.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }

                    $investigador=Usuario::findFirstByusu_id($data_transporte['inv_id']);
                    if($investigador->usu_transporte!=1){ //si el investigador tiene una restricción para que se le asignen transportes
                        $rol = new Rol();
                        $auth = $this->session->get('auth');
                        if(!$rol->verificar(77,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                        {
                            $answer[0]=-2;
                            $answer['titular']='ERROR';
                            $answer['mensaje']='No cuentas con los permisos para asignarle transporte al investigador solicitado.';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }
                    }
                    $date= new DateTime();
                    $hoy=$date->format('Y-m-d H:i:s');
                    $data_transporte['asignausu_id']= $auth['id'];
                    $data_transporte['aprobadousu_id']= $auth['id'];
                    $data_transporte['tra_fechainvestigador']= $hoy;
                    $data_transporte['tra_fechaaprobado']= $hoy;
                    // $data_transporte['tra_comentarioadmin']=$data['tra_comentarioadmin'];
                    // $data_transporte['tra_origen']=$data['tra_origen'];
                    // $data_transporte['tra_destino']=$data['tra_destino'];
                    $respuesta_modelo_asignar_transporte=$transporte->asignarautorizado_transporte($ese_id,$data_transporte);
                    $estudio->ese_transporte=2;
                    $estudio->update();

                        if( $respuesta_modelo_asignar_transporte['estado']==2){
                            
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Asignó un transporte al estudio con ID interno '.$ese_id.' al usuario con ID '.$data_transporte['inv_id'].'  con un pre aprobado de $'.$data_transporte['pre_aprobado'].' el ID interno del transporte es '.$respuesta_modelo_asignar_transporte['tra_id'];
                            $databit['usu_id']=$auth['id'];
                            $databit['ese_id']=$ese_id;
                            $databit['bit_tablaid']=$respuesta_modelo_asignar_transporte['tra_id'];
                            $databit['bit_modulo']="Transporte";
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='¡Has asignado un transporte correctamente!';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }else{
                            $answer[0]=-2;
                            $answer['titular']='Error';
                            $answer['mensaje']='Error al procesar los datos...';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }
                   

                }else
                {

                    $answer[0]=-1;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='El estudio ya tiene asignado un transporte.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;

                }

            }else{

                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El estudio está borrado.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }  
        }
    }
}
    



     
        

    
    

