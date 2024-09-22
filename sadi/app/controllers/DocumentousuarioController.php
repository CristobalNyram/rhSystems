<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Query;
use Phalcon\Di;

require_once("tinify/vendor/autoload.php");
\Tinify\setKey("wvMw7Jxtk9nN4CHBCbBVKBQLw0MNll2c");

class DocumentousuarioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Archivo');
        parent::initialize();
        // $rol = new Rol();
        // $auth = $this->session->get('auth');
        // if(!$rol->verificar(10,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
    }
    
    public function tablaAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(62,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Documentousuario::find(array(
            "dou_estatus=1"
            ));
        }
        else
        {
        	$archivo=new Builder();
	        $archivo=$archivo
	        ->columns(array('a.dou_id, dou_nombre, doc_nombre, a.usu_id, a.doc_id, dou_estatus'))
	        ->addFrom('Documentousuario','a')
	        // ->join('Curso','c.cur_id=cuo.cur_id','c')
	        ->join('Documento','c.doc_id=a.doc_id','c')
	        ->where('dou_estatus>0 and usu_id='.$id)
	        // ->orderBy('rec_serierecibo asc')
	        ->getQuery()
	        ->execute();

        }

        // $curso=Cuootorgado::findFirstBycuo_id($id);
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los documentos del usuario con clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Documentos";
        $bitacora->NuevoRegistro($databit);
        $this->view->page=$archivo;
        $this->view->documento = new Documentousuario();

        // $this->view->objArchivo=new Archivo();
        
    }

    public function descargarAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(62,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        // $response = new Response();
        $arc = Documentousuario::findFirstBydou_id($id);
        $file=$arc->dou_nombre;
        $response = new Response();
        $path = 'documentos/'.$file;
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
        $databit['bit_descripcion']= "Descargó el archivo ".$file." del usuario ".$arc->usu_id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Documentos";
        $bitacora->NuevoRegistro($databit);
        die();
    }

    public function eliminarAction($id)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        // 
        if(!$rol->verificar(62,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $archivo=Documentousuario::findFirstBydou_id($id);
        if($archivo){
            $archivo->dou_estatus=-1;
            
            if($archivo->save()) {
                $answer[0]=1;

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Eliminó el archivo ".$archivo->dou_nombre." del usuario con clave: ".$archivo->usu_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Documentos";
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

    public function aprobarAction($id)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        // 
        if(!$rol->verificar(62,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $archivo=Documentousuario::findFirstBydou_id($id);
        if($archivo){
            $archivo->dou_estatus=1;
            
            if($archivo->save()) {
                $answer[0]=1;

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Autorizó el archivo ".$archivo->dou_nombre." del usuario con clave: ".$archivo->usu_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Documentos";
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

    public function desactualizadoAction($id)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        // 
        if(!$rol->verificar(62,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $archivo=Documentousuario::findFirstBydou_id($id);
        if($archivo){
            $archivo->dou_estatus=2;
            
            if($archivo->save()) {
                $answer[0]=1;

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Marcó como desactualizado el archivo ".$archivo->dou_nombre." del usuario con clave: ".$archivo->usu_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Documentos";
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

    public function archivoAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(62,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        // $answer=array();
        $this->view->disable();
        if($this->request->isPost())
        {

            $answer=array();
            $answer[0]=-2;
            $data = $this->request->getPost();
            $ruta = 'documentos/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
            $date= new DateTime();
            $countfiles = count($_FILES['archivo_categoria']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_categoria']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_categoria']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id($data['doc_id']);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('dou_estatus=2 and doc_id='.$data['doc_id'].' and usu_id='.$id)
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para esa categoría, no se pueden subir más. Elimine el archivo ya subido de esta categoría si necesita actualizar.";
                        $answer[0]=-2;
                        $answer[2]=$id;
                        $answer[3]=$mensage;
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                }

                if (in_array(mb_strtolower($tipo), $admitidos)) {
                    if($tamano<=$categoria->doc_tamano){
                        $documento= new Documentousuario();
                        // Upload file
                        $a=$this->limpiar_string(''.$date->format('Y-m-d-H-i-s').'-'.strtolower($filename));
                        (move_uploaded_file($_FILES['archivo_categoria']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=1;
                            $data1['usu_id']=$id;
                            $data1['doc_id']=$data['doc_id'];
                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo ".$a." al usuario con clave ".$id;
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$id;
                                $databit['bit_modulo']="Documentos";
                                $bitacora->NuevoRegistro($databit);

                            }
                            else
                            {
                                $answer[0]=-2;

                            // $this->flash->error($documento->error);
                            }
                        }
                    }
                    else{
                        $answer[0]=-2;

                        $mensage=$mensage."<br><br> El archivo ".$filename." tiene un peso mayor al permitido. <br><br> <a href='https://tinypng.com/' target='_blank'> Puede comprimir sus imágenes  (jpg, jpeg, png) en ésta página </a>";
                    }
                }
                else
                {
                    $answer[0]=-2;

                    $mensage=$mensage."<br><br> El archivo ".$filename." no tiene extensión válida para esta categoría.";
                }
            }
            $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function checklistAction($usu_id)
    {
        $result = [];
        // $this->view->disable();
        $container = Di::getDefault();
        $query     = new Query(
            'select doc_id, doc_nombre, (select case dou_estatus when 1 then dou_estatus when 3 then dou_estatus end from Documentousuario as du where du.doc_id = d.doc_id and du.usu_id = '.$usu_id.' and (dou_estatus=1 or dou_estatus=3) LIMIT 1) as estatus from Documento as d',
            $container
        );

        $invoices = $query->execute();
        // $info= $this->db->query("SELECT * FROM documento");
        if ($invoices) {
            $result = $invoices->toArray();
        }
        return $this->response->setJsonContent($result);
        // $this->response->send();
    }
}