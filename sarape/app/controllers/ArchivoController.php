<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class ArchivoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Archivo');
        parent::initialize();

    }

    public function tablaAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion_sql="";
        $mensaje_bitacora="";
        $data = $this->request->getPost();
        $this->view->mensaje ="";
        $this->view->mostrar_borrar = isset($data["mostrar_borrar"]) ? $data["mostrar_borrar"] : 1;

        try {
            $condicion_sql.="a.arc_estatus=2";

            if($id!=0)
                $condicion_sql.=" AND a.exc_id=$id";
            
            if($data["vista"]!=""){
                $condicion_sql.=" AND c.cat_vista LIKE '%".$data["vista"]."%' ";
            }else{
                throw new Exception("FALTA UN PARÁMETRO -VISTA-");
                
            }
              
            $auth = $this->session->get('auth');
            $archivo = new Builder();
            $archivo = $archivo
                ->columns(array('a.arc_id, a.arc_nombre,c.cat_nombre,a.exc_id'))
                ->addFrom('Archivo', 'a')
                ->join('Categoria', 'c.cat_id = a.cat_id', 'c');

            $archivo = $archivo->where($condicion_sql)->getQuery()->execute();

            $data_bit=[
                'bit_descripcion'=>'Consultó archivos del exc_id'.$id." ".$mensaje_bitacora,
                'bit_tablaid'=>0,
                'bit_modulo'=>'Archivos',
                'vac_id'=>0,
                'bit_accion'=>4,
            ];

            $this->bitacora_registro($data_bit,$auth);
            $this->view->page = $archivo;
        } catch (\Exception $e) {

            $this->view->page = [];
            $this->view->mensaje = $e->getMessage();

            error_log( "Se produjo una excepción: " . $e->getMessage());
        }
    }
    public function get_archivos_excAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer['mensaje']='ERROR';
        $answer = array();
        $this->view->disable();
        
        try {
            if ($this->request->isAjax() ) {
            $archivo = new Builder();
    
            $archivo = $archivo
                ->columns(array('a.arc_id, a.arc_nombre,c.cat_nombre,a.exc_id'))
                ->addFrom('Archivo', 'a')
                ->join('Categoria', 'c.cat_id = a.cat_id', 'c');
        
            $archivo = $archivo->getQuery()->execute();
            $answer["data"] =$archivo;
            } else {
                $answer[0] = -1;
            }
        } catch (\Exception $e) {
            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();


    }

    public function tabla_visualizador_resumen_excAction($exc_id=33){
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion_sql="";
        $mensaje_bitacora="";
        $data = $this->request->getPost();
        
        $this->view->mensaje ="";

        try {
            $condicion_sql.="a.arc_estatus=2 AND a.exc_id='".$exc_id."'";

         
            $auth = $this->session->get('auth');
            $archivo = new Builder();
            $archivo = $archivo
                ->columns(array('a.arc_id, a.arc_nombre,c.cat_nombre,a.exc_id'))
                ->addFrom('Archivo', 'a')
                ->join('Categoria', 'c.cat_id = a.cat_id', 'c');

            $archivo = $archivo->where($condicion_sql)->getQuery()->execute();
            // error_log(count($archivo));

            $data_bit=[
                'bit_descripcion'=>'Consultó archivos del exc_id'.$exc_id." ".$mensaje_bitacora,
                'bit_tablaid'=>0,
                'bit_modulo'=>'Archivos',
                'vac_id'=>0,
                'bit_accion'=>4,
            ];

            $this->bitacora_registro($data_bit,$auth);
            $this->view->page = $archivo;
            $this->view->exc_id = $exc_id;

        } catch (\Exception $e) {

            $this->view->page = [];
            $this->view->mensaje = $e->getMessage();

            error_log( "Se produjo una excepción: " . $e->getMessage());
        }
    }
    public function archivoAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $this->view->disable();
        $this->db->begin();

        try {
            if(!$this->request->isPost())
                 throw new Exception("FORMATO INCORRECTO DE SOLICITUD");

            $answer=array();
            $answer[0]=-2;
            $data = $this->request->getPost();
            $categoria=Categoria::findFirstBycat_id($data['cat_id']);
            $countfiles = count($_FILES['archivo_categoria']['name']);
            $answer["exc_id"]=$id;

            if($countfiles>$categoria->cat_numarc){
                throw new Exception("NO. DE ARCHIVOS PERMITIDOS A SIDO SUPERADO, SOLO SE PERMITEN ".$categoria->cat_numarc);
            }

            $ruta_base = 'archivosexc/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
            $ruta = 'archivosexc/'.$id.'/'; 
            // Validar si la carpeta no existe y luego crearla
            if (!file_exists($ruta)) {
                if (!mkdir($ruta, 0777, true)) {
                    error_log("No se pudo crear la ruta de archivo");
                } 
            }
            $regs_exc = new Builder();
            $regs_exc=$regs_exc
            ->addFrom('Archivo',"arc")
            ->where('arc_estatus=2 and cat_id='.$data['cat_id'].' AND exc_id='.$id)
            ->getQuery()
            ->execute();
            if(($regs_exc->count()+$countfiles) > $categoria->cat_numarc){
                $mensage_error_num_files="El límite de archivos en está categoría ya ha sido superado. Elimine archivos previos para poder cargar los nuevos. Actualmente, hay  ".$regs_exc->count()."  archivos en el sistema, y usted está intentando subir  ".$countfiles." archivos, lo cual supera el límite de ".$categoria->cat_numarc." archivo(s) permitido(s)...";
                throw new Exception($mensage_error_num_files);
            }
            
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
            $date= new DateTime();
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
                    ->where('arc_estatus=2 and cat_id='.$data['cat_id'].' and exc_id='.$id)
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para esa categoría, no se pueden subir más. Elimine el archivo que anteriormente ya subió de esta categoría si necesita actualizar.";
                        $answer["estado"]=-2;
                        $answer["exc_id"]=$id;
                        $answer["mensaje"]=$mensage;
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                }

                if (in_array(mb_strtolower($tipo), $admitidos)) {
                    if($tamano<=$categoria->cat_tamano){
                        $documento= new Archivo();
                        // Upload 
                        $name_clean=$this->limpiar_string2($filename);
                        $name_clean = substr($name_clean, 0, -3);
                        $a=$this->limpiar_string(''.$date->format('Y-m-d-H-i-s').'-'.strtolower($name_clean).".".$tipo);
                        (move_uploaded_file($_FILES['archivo_categoria']['tmp_name'][$i],$ruta.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['arc_nombre']=$a;
                            $data1['arc_estatus']=2;
                            $data1['exc_id']=$id;
                            $data1['cat_id']=$data['cat_id'];
                                // $data['pol_archivo']=$a;
                            $respuesta_modelo_nuevo_arc=$documento->NuevoRegistro($data1);
                            if($respuesta_modelo_nuevo_arc!=false)
                            {
                                $answer["estado"]=2;
                                $auth = $this->session->get('auth');
                                $data_bit=[
                                    'bit_descripcion'=>"Subió el archivo ".$a." al expediente con clave ".$id,
                                    'bit_tablaid'=>$id,
                                    'usu_id'=>$auth['id'],
                                    'bit_modulo'=>'Archivos',
                                    'bit_accion'=>1,
                                ];
                                $this->bitacora_registro($data_bit,$auth);

                            }
                            else
                            {
                                $answer['estado']=-2;
                                throw new Exception("ERROR SUBIR ARCHIVO");
                            }
                        }
                    }
                    else{
                        $answer['estado']=-2;
                        throw new Exception("<br><br> El archivo ".$filename." tiene un peso mayor al que está permitido. <br><br> <a href='https://tinypng.com/' target='_blank'> Puede comprimir sus imágenes  (jpg, jpeg, png) en ésta página </a>");
                    }
                }
                else
                {
                    $answer['estado']=-2;
                    throw new Exception("<br><br> El archivo ".$filename." no tiene extensión válida para esta categoría, los archivos admitidos debe ser extencion ".implode(", ", $admitidos));
                }
            }
            $this->db->commit();
            $answer["exc_id"]=$id;
            $answer["mensaje"]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
        } catch (\Exception $e) {
            $this->db->rollback();
            error_log("Excepción: archivoAction subir el archivo " . $e->getMessage());
            $answer = [
                'estado' => -2,
                'mensaje' => $e->getMessage(),
                'titular' => 'AVISO',
                'exc_id' => $id,
            ];
            $data_bit = [
                'bit_descripcion'=>'ERROR AL SUBIR LA VACANTE EXP : '. $e->getMessage(),
                'bit_tablaid' => $id,
                'bit_modulo' => "ERROR",
                'vac_id' => 0,
                'bit_accion' => 2,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
            $this->response->setJsonContent($answer);
            $this->response->send();
        }
        
    }

    public function descargarAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
      
        // $response = new Response();
        $arc = Archivo::findFirstByarc_id($id);
        $file=$arc->arc_nombre;
        $response = new Response();
        $path = 'archivosexc/'.$arc->exc_id.'/'.$file;
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

        $data_bit=[
            'bit_descripcion'=>"Descargó el archivo ".$file." del expediente candidato ".$arc->exc_id,
            'bit_tablaid'=>$id,
            'usu_id'=>$auth['id'],
            'bit_modulo'=>'Archivos',
            'bit_accion'=>4,
        ];
        $this->bitacora_registro($data_bit,$auth);
        die();
    }

    public function eliminarAction($id)
    {
        try {
            $rol = new Rol();
            $auth = $this->session->get('auth');
            $answer = array();
        
            $answer[0] = 0;
            $this->view->disable();
            $archivo = Archivo::findFirstByarc_id($id);
            if ($archivo) {
                $archivo->arc_estatus = -2;
        
                if ($archivo->save()) {
                    $answer[0] = 1;
        
                    $auth = $this->session->get('auth');

                    $data_bit=[
                        'bit_descripcion'=>"Eliminó el archivo " . $archivo->arc_nombre . " del expediente de candidato con clave: " . $archivo->exc_id,
                        'bit_tablaid'=>$id,
                        'usu_id'=>$auth['id'],
                        'bit_modulo'=>'Archivos',
                        'bit_accion'=>3,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                    $answer[0] = 1;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
            }
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (\Exception $e) {
           
            $answer["detalle"]= "Se produjo una excepción: " . $e->getMessage();
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
        
    }

    public function pruebaAction(){
        $source = \Tinify\fromFile("archivos/prueba.jpg");
        $source->toFile("archivos/prueba.jpg");
        $this->view->disable();
    }

    public function ajax_getImagenAction($id=0){
        $this->view->disable();
        $answer=[];
        $answer["estado"]=-2;
        $answer["titular"]="error";

        if($this->request->isAjax())
        {
            $arc=Archivo::findFirst($id);
            $ruta = 'archivosexc/'.$arc->exc_id.'/'; 
            $ruta_completa=$ruta.$arc->arc_nombre;
         
            // Validar si la carpeta no existe y luego crearla
            if (!file_exists($ruta_completa)) {
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

    public function ajax_get_detalles_archivoAction($arc_id=0){
        $this->view->disable();

        if($this->request->isAjax())
        {
            if($arc_id==0){
                return http_response_code(400);

            }
            $auth = $this->session->get('auth');

            $data_bit=[
                'bit_descripcion'=>"Consultó detalles del archivo con ID $arc_id",
                'bit_tablaid'=>$arc_id,
                'usu_id'=>$auth['id'],
                'bit_modulo'=>'Archivos',
                'bit_accion'=>4,
            ];
            $this->bitacora_registro($data_bit,$auth);
            
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
                    $mensaje='Quitó el archivo correctamente del reporte';
                    $mensaje_bitacora='Quitó el archivo con ID '.$arc_id.' al reporte que tiene relación con el estudio No. '.$arc->ese_id;


                }elseif($arc->arc_reporte==0){
                    $arc->arc_reporte=1;
                    $mensaje='Adjuntó el archivo correctamente al reporte';
                    $mensaje_bitacora='Adjuntó el archivo con ID '.$arc_id.' al reporte que tiene relación con el estudio No. '.$arc->ese_id;

                }

                if($arc->update()){
                    $auth = $this->session->get('auth');
                    $data_bit=[
                        'bit_descripcion'=>$mensaje_bitacora,
                        'bit_tablaid'=>$arc_id,
                        'usu_id'=>$auth['id'],
                        'bit_modulo'=>'Archivos',
                        'bit_accion'=>2,
                    ];
                    $this->bitacora_registro($data_bit,$auth);

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
                $answer['mensaje']=-'Ya no esta disponible el archivo, ha sido borrado previamente.';
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

  
}