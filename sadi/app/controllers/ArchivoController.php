<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;


require_once("tinify/vendor/autoload.php");
\Tinify\setKey("wvMw7Jxtk9nN4CHBCbBVKBQLw0MNll2c");

class ArchivoController extends ControllerBase
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

    public function tablaAction($id=0, $ocultaredicionarchivo=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $condicion_extra_sql='';
        if(!$rol->verificar(20,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        if(!$rol->verificar(86,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
         $condicion_extra_sql=' AND (c.cat_id != 15 OR (c.cat_id = 15 AND a.arc_nombre NOT LIKE "%.pdf"))';   
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Archivo::find(array(
            "arc_estatus=2"
            ));
        }
        else
        {
            $archivo = new Builder();
            $archivo = $archivo
                ->columns(array('a.arc_id, arc_nombre, cat_nombre, a.ese_id, a.arc_reporte, a.cat_id, ese.tif_id, c.cat_eseadjunto, c.cat_truperadjunto, ese.ese_estatus, c.cat_gabineteadjunto'))
                ->addFrom('Archivo', 'a')
                ->leftjoin('Estudio', 'ese.ese_id = a.ese_id', 'ese')
                ->join('Categoria', 'c.cat_id = a.cat_id', 'c')
                ->where('arc_estatus = 2 AND a.ese_id = '.$id.' '.$condicion_extra_sql)
                // ->orderBy('rec_serierecibo asc')
                ->getQuery()
                ->execute();

        }

        // $curso=Cuootorgado::findFirstBycuo_id($id);
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los archivos del estudio con clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Archivos";
        $databit['ese_id']= $id;
        $bitacora->NuevoRegistro($databit);
        $this->view->page=$archivo;

        $this->view->objArchivo=new Archivo();
        if($ocultaredicionarchivo!=0){
            $this->view->ocultaredicionarchivo = 1;
        }
        
    }


  

    
   
    public function archivoAction($id=0)
    {
    $this->view->disable();
    $this->db->begin();
    try {
            $rol = new Rol();
            $auth = $this->session->get('auth');
           /* if(!$rol->verificar(20,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $this->response->redirect('errors/errorpermiso');
                return;
            }*/
        // $answer=array();
            if(!$this->request->isPost())
                throw new Exception("FORMATO INCORRECTO DE SOLICITUD");

            $answer=array();
            $answer[0]=-2;
            $data = $this->request->getPost();
            $ruta = 'archivos/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
            $date= new DateTime();
            $countfiles = count($_FILES['archivo_categoria']['name']);
            $categoria=Categoria::findFirstBycat_id($data['cat_id']);


            if($countfiles>$categoria->cat_numarc)
                throw new Exception("NO. DE ARCHIVOS PERMITIDOS A SIDO SUPERADO, SOLO SE PERMITEN ".$categoria->cat_numarc);
            

            $regs_arc = new Builder();
            $regs_arc=$regs_arc
            ->addFrom('Archivo',"arc")
            ->where('arc_estatus=2 and cat_id='.$data['cat_id'].' AND ese_id='.$id)
            ->getQuery()
            ->execute();

            if(($regs_arc->count()+$countfiles) > $categoria->cat_numarc){
                $mensage_error_num_files="El límite de archivos en está categoría ya ha sido superado. Elimine archivos previos para poder cargar los nuevos. Actualmente, hay  ".$regs_arc->count()."  archivos en el sistema, y usted está intentando subir  ".$countfiles." archivo(s), lo cual supera el límite de ".$categoria->cat_numarc." archivo(s) permitido(s)...";
                throw new Exception($mensage_error_num_files);
            }

            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_categoria']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_categoria']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $admitidos= explode(",", $categoria->cat_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->cat_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Archivo','a')
                    ->where('arc_estatus=2 and cat_id='.$data['cat_id'].' and ese_id='.$id)
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
                    if($tamano<=$categoria->cat_tamano){
                        $documento= new Archivo();
                        // Upload file
                        $name_clean=$this->limpiar_string2($filename);
                        $name_clean = substr($name_clean, 0, -3);
                        $a=$this->limpiar_string(''.$date->format('Y-m-d-H-i-s').'-'.strtolower($name_clean).".".$tipo);
                        (move_uploaded_file($_FILES['archivo_categoria']['tmp_name'][$i],'archivos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['arc_nombre']=$a;
                            $data1['arc_estatus']=2;
                            $data1['ese_id']=$id;
                            $data1['cat_id']=$data['cat_id'];
                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;
                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo ".$a." al estudio con clave ".$id;
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$id;
                                $databit['bit_modulo']="Archivos";
                                $databit['ese_id']= $id;
                                $bitacora->NuevoRegistro($databit);
                            }
                            else
                            {
                                $answer[0]=-2;
                                throw new Exception("ERROR SUBIR ARCHIVO");
                            // $this->flash->error($documento->error);
                            }
                        }
                    }
                    else{
                        $answer[0]=-2;
                        $mensage=$mensage."<br><br> El archivo ".$filename." tiene un peso mayor al permitido. <br><br> <a href='https://tinypng.com/' target='_blank'> Puede comprimir sus imágenes  (jpg, jpeg, png) en ésta página </a>";
                        throw new Exception($mensage);
                    }
                }
                else
                {
                    $answer[0]=-2;
                    $mensage=$mensage."<br><br> El archivo ".$filename." no tiene extensión válida para esta categoría.";
                    throw new Exception($mensage);
                }
            }
            $this->db->commit();
            $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
    } catch (\Exception $e) {
        $this->db->rollback();
        error_log("Excepción: archivoAction subir el archivo " . $e->getMessage());
        $answer = [
             0 => -2,
             2=>$id,
             3 => $e->getMessage(),
            'titular' => 'AVISO',
            //'exc_id' => $id,
        ];

        $this->response->setJsonContent($answer);
        $this->response->send();
    }
       
    }

    public function descargarAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(20,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        // $response = new Response();
        $arc = Archivo::findFirstByarc_id($id);
        $file=$arc->arc_nombre;
        $response = new Response();
        $path = 'archivos/'.$file;
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
        $databit['bit_descripcion']= "Descargó el archivo ".$file." del estudio ".$arc->ese_id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Archivos";
        $databit['ese_id']= $arc->ese_id;
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
        if(!$rol->verificar(20,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $archivo=Archivo::findFirstByarc_id($id);
        if($archivo){
            $archivo->arc_estatus=-1;
            
            if($archivo->save()) {
                $answer[0]=1;

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Eliminó el archivo ".$archivo->arc_nombre." del estudio con clave: ".$archivo->ese_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Archivos";
                $databit['ese_id']= $archivo->ese_id;
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

    public function pruebaAction(){
        $source = \Tinify\fromFile("archivos/prueba.jpg");
        $source->toFile("archivos/prueba.jpg");
        $this->view->disable();
    }

    public function ajax_get_detalles_archivoAction($arc_id=0){
        $this->view->disable();

        if($this->request->isAjax())
        {
            if($arc_id==0){
                return http_response_code(400);

            }
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consulto detalles del archivo con ID $arc_id";
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$arc_id;
            $databit['bit_modulo']="Archivos";
            $bitacora->NuevoRegistro($databit);
            
            $arc=Archivo::query()
            ->columns('Archivo.arc_nombre, Archivo.arc_id, Archivo.arc_reporte')
            ->where("Archivo.arc_estatus=2 and Archivo.arc_id=$arc_id ")
            ->execute();
    
            $this->response->setJsonContent($arc);
            $this->response->send();

        }else{
              return http_response_code(400);
        }   
    }
    public function ajax_adjuntar_archivo_reporteAction($arc_id=0){
        $this->view->disable();
        $answer=[];
        $mensaje='';
        $mensaje_bitacora='';

        if($this->request->isAjax())
        {
            if($arc_id==0){
                return http_response_code(400);

            }
            

            $arc=Archivo::findFirstByarc_id($arc_id);

           if($arc->arc_estatus==2) {

                if($arc->arc_reporte==1){
                    $arc->arc_reporte=0;
                    $mensaje='Quito el archivo correctamente del reporte';
                    $mensaje_bitacora='Quito el archivo con ID '.$arc_id.' al reporte que tiene relación con el estudio No. '.$arc->ese_id;


                }elseif($arc->arc_reporte==0){
                    $arc->arc_reporte=1;
                    $mensaje='Adjunto el archivo correctamente al reporte';
                    $mensaje_bitacora='Adjunto el archivo con ID '.$arc_id.' al reporte que tiene relación con el estudio No. '.$arc->ese_id;

                }

                if($arc->update()){
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']=$mensaje_bitacora;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$arc_id;
                    $databit['bit_modulo']="Archivos";
                    $databit['ese_id']= $arc->ese_id;
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']=$mensaje;
                    $answer['ese_id']=$arc->ese_id;

                    $this->response->setJsonContent($answer);
                    $this->response->send();
                }
                
           }else{
                $answer[0]=-2;
                $answer['titular']='Error';
                $answer['mensaje']=-'Ya no esta disponible el archivo, a sido borrado previamente.';
                $this->response->setJsonContent($answer);
                $this->response->send();
           }
          

        }else{
              return http_response_code(400);
        }   
    }

    public function getcurpapiAction($id){

        $this->view->disable();
        
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(65,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        
        $api= new Api();
        $respuesta= $api->BuscarCURP($id,$auth['id']);

        $this->response->setJsonContent($respuesta);
        $this->response->send(); 
        return;
        
    }

    public function getPoderJudicialAction($id){

        $this->view->disable();
        
        $rol = new Rol();
        $auth = $this->session->get('auth');

        if(!$rol->verificar(69,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        
        $api= new Api();
        $respuesta= $api->BuscarPoderJudicial($id,$auth['id']);

        $this->response->setJsonContent($respuesta);
        $this->response->send(); 
        return;
        
    }

    public function tabla_truperAction($id=0, $ocultaredicionarchivo=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(20,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Archivo::find(array(
            "arc_estatus=2"
            ));
        }
        else
        {
        	$archivo=new Builder();
	        $archivo=$archivo
	        ->columns(array('a.arc_id, arc_nombre, cat_nombre, a.ese_id,a.arc_reporte, a.cat_id'))
	        ->addFrom('Archivo','a')
	        // ->join('Curso','c.cur_id=cuo.cur_id','c')
	        ->join('Categoria','c.cat_id=a.cat_id','c')
	        ->where('arc_estatus=2 and ese_id='.$id)
	        // ->orderBy('rec_serierecibo asc')
	        ->getQuery()
	        ->execute();

        }

        // $curso=Cuootorgado::findFirstBycuo_id($id);
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los archivos del estudio con clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Archivos";
        $databit['ese_id']= $id;
        $bitacora->NuevoRegistro($databit);
        $this->view->page=$archivo;

        $this->view->objArchivo=new Archivo();
        if($ocultaredicionarchivo!=0){
            $this->view->ocultaredicionarchivo = 1;
        }
    }
    public function tabla_clienteAction($id_ = 0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        try {
            $respuesta_modelo_des_enc=$this->des_encriiptarId($id_);
            $id=$respuesta_modelo_des_enc["id"];

            if(!$this->request->isAjax()|| $id==0 || !is_numeric($id))
                throw new Exception("FORMATO INCORRECTO DE SOLICITUD");
            
            $categorias_permitidas=[11];
            $auth = $this->session->get('auth');
            $condicion_extra_sql = '';
            if (!empty($categorias_permitidas)) {
                $categorias_sql = implode(',', array_map('intval', $categorias_permitidas));
                $condicion_extra_sql = "AND a.cat_id IN ($categorias_sql)";
            }else{
                throw new Exception("FORMATO DE INDEX INCORRECTO");
            }
            $archivo = new Builder();
            $archivo = $archivo
                ->columns(array('a.arc_id, arc_nombre, cat_nombre, a.ese_id, a.arc_reporte, a.cat_id, ese.tif_id, c.cat_eseadjunto, c.cat_truperadjunto, ese.ese_estatus, c.cat_gabineteadjunto'))
                ->addFrom('Archivo', 'a')
                ->leftjoin('Estudio', 'ese.ese_id = a.ese_id', 'ese')
                ->join('Categoria', 'c.cat_id = a.cat_id', 'c')
                ->where('arc_estatus = 2 AND a.ese_id = ' . $id . ' ' . $condicion_extra_sql)
                ->getQuery()
                ->execute();

            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = "Consultó los archivos del estudio con clave interna: " . $id . " cliente";
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = $id;
            $databit['bit_modulo'] = "Archivos";
            $databit['ese_id'] = $id;
            $bitacora->NuevoRegistro($databit);
            $this->view->page = $archivo;
        } catch (\Exception $e) {
            $this->view->page = [];
            error_log("error en tabla cliente archivo ".$e->getMessage());  
        }
    }
    //versionencriptada
    public function descencAction($id_)
    {
        try {

            $respuesta_modelo_des_enc=$this->des_encriiptarId($id_);
            $id=$respuesta_modelo_des_enc["id"];

            if($id==0 || !is_numeric($id))
                throw new Exception("FORMATO INCORRECTO DE SOLICITUD");

            $auth = $this->session->get('auth');
    
            $arc = Archivo::findFirstByarc_id($id);
            $file = $arc->arc_nombre;
    
            $response = new Response();
            $path = 'archivos/' . $file;
            $filetype = filetype($path);
            $filesize = filesize($path);
    
            $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
            $response->setHeader("Content-Description", 'File Download');
            $response->setHeader("Content-Type", $filetype);
            $response->setHeader("Content-Length", $filesize);
            $response->setFileToSend($path, '"' . str_replace(" ", "-", $file) . '"', true);
            $response->send();
    
            $auth = $this->session->get('auth');
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = "Descargó el archivo " . $file . " del estudio " . $arc->ese_id;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = $id;
            $databit['bit_modulo'] = "Archivos";
            $databit['ese_id'] = $arc->ese_id;
            $bitacora->NuevoRegistro($databit);
            die();

        } catch (\Exception $e) {
            error_log("error en la descargar cliente archivo ".$e->getMessage());  
            die();
        }
    }
    public function ajax_getImagenAction($id=0,$tipo=""){
        $this->view->disable();
        $answer=[];
        $answer["estado"]=-2;
        $answer["titular"]="error";

        if($this->request->isAjax())
        {
            $ruta="";
            if($tipo=="cancelacion"){
                $arc=Archivocancelacion::findFirstByacc_id($id);
                $ruta ="cancelacion/"; 
                $ruta_completa=$ruta.$arc->acc_nombre;
            }
            elseif($tipo=="transportes"){
                $arc=Archivotransporte::findFirstByart_id($id);
                $ruta = 'transportes/'; 
                $ruta_completa=$ruta.$arc->art_nombre;
            }else{
                $arc=Archivo::findFirstByarc_id($id);
                $ruta = 'archivos/'; 
                $ruta_completa=$ruta.$arc->arc_nombre;
            }
          
         
            // Validar si la carpeta no existe y luego crearla
            if (!file_exists($ruta_completa)) {
                error_log("No found file ".$ruta_completa." tipo ".$tipo.", id ".$id.", ruta base ".$ruta);
                $answer["mensaje"]="No found";
                $answer["data"]=[];
                $answer["estado"]=2;

            }else{
                $answer["mensaje"]="Found";
                $answer["data"]=$arc;
                $answer["estado"]=2;
                $answer["titular"]="ok";

            }
            // Validar si la carpeta no existe y luego crearla

        }else{
            return http_response_code(400); 
        }
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    

  
}