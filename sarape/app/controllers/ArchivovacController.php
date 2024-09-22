<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class ArchivovacController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Archivo vacante ');
        parent::initialize();
    }

    public function tablaAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion_sql="";
        $mensaje_bitacora="";
        $data = $this->request->getPost();
        $this->view->mensaje ="";

        try {
            $condicion_sql.="a.arv_estatus=2";

            if($id!=0)
                $condicion_sql.=" AND a.vac_id=$id";
            
            if($data["vista"]!=""){
                $condicion_sql.=" AND c.ctv_vista LIKE '%".$data["vista"]."%' ";
            }else{
                throw new Exception("FALTA UN PARÁMETRO -VISTA-");
            }

            $auth = $this->session->get('auth');
            $archivo = new Builder();
            $archivo = $archivo
                ->columns(array('a.arv_id, a.arv_nombre,c.ctv_nombre,a.vac_id'))
                ->addFrom('Archivovac', 'a')
                ->join('Categoriavac', 'c.ctv_id = a.ctv_id', 'c');

            $archivo = $archivo->where($condicion_sql)->getQuery()->execute();

            $data_bit=[
                'bit_descripcion'=>'Consultó archivos de la vacante con ID: '.$id." ".$mensaje_bitacora,
                'bit_tablaid'=>0,
                'bit_modulo'=>'Archivosvac',
                'vac_id'=>$id,
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

    public function archivoAction($id = 0)
    {
        $this->view->disable();
        $this->db->begin();

        try {
            $rol = new Rol();
            $auth = $this->session->get('auth');
            $data = $this->request->getPost();
            $answer = [];
            $answer["estado"] = -2;
            $answer["mensaje"] = "error";
            $answer["titular"] = "error";
            $answer["data"] = $data;
            $mensaje_extra_bitacora = '';
    
            if (!$this->request->isPost()) {
                throw new Exception("Realizó una petición que no es POST");
            }
            if (!isset($_FILES['arv'])) {
                throw new Exception("SE REQUIERE ARCHIVO");
            }


            $obj_arv = new Archivovac();
            $vac_id=$data["vac_id"];
            $ruta = $obj_arv->ruta_files."/".$vac_id.'/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
            $date= new DateTime();
            $categoria=Categoriavac::findFirstByctv_id($data['ctv_id']);
            $countfiles = count($_FILES['archivo_categoria']['name']);

            if($countfiles>$categoria->ctv_numarc){
                throw new Exception("NO. DE ARCHIVOS PERMITIDOS A SIDO SUPERADO, SOLO SE PERMITEN ".$categoria->ctv_numarc);
            }

            $regs_vac = new Builder();
            $regs_vac=$regs_vac
            ->addFrom('Archivovac',"arv")
            ->where('arv_estatus=2 and ctv_id='.$data['ctv_id'].' AND vac_id='.$id)
            ->getQuery()
            ->execute();
            if(($regs_vac->count()+$countfiles) > $categoria->ctv_numarc){
                $mensage_error_num_files="El límite de archivos en está categoría ya ha sido superado. Elimine archivos previos para poder cargar los nuevos. Actualmente, hay  ".$regs_vac->count()."  archivos en el sistema, y usted está intentando subir  ".$countfiles." archivos, lo cual supera el límite de ".$categoria->ctv_numarc." archivo(s) permitido(s)...";;
                throw new Exception($mensage_error_num_files);            }
            
            // Validar si la carpeta no existe y luego crearla
            if (!file_exists($ruta)) {
                if (!mkdir($ruta, 0777, true)) {
                    error_log("No se pudo crear la ruta de archivo");
                } 
            }
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
            $date= new DateTime();
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_categoria']['name'][$i];
                $isUploaded = false;
                $tamano = $_FILES['archivo_categoria']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);
                $admitidos= explode(",", $categoria->ctv_tipovalidacion);
                if($categoria->ctv_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Archivovac','a')
                    ->where('arv_estatus=2 and ctv_id='.$data['ctv_id'].' and vac_id='.$vac_id)
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para esa categoría, no se pueden subir más. Elimine el archivo que anteriormente ya subió de esta categoría si necesita actualizar.";
                        $answer[0]=-2;
                        $answer[2]=$id;
                        $answer[3]=$mensage;
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                }

                if (in_array(mb_strtolower($tipo), $admitidos)) {
                    if($tamano<=$categoria->ctv_tamano){
                        $documento= new Archivovac();
                        $filename=$filename;
                        // Upload file
                        $name_clean=$this->limpiar_string2($filename);
                        
                        $name_clean = substr($name_clean, 0, -3);

                        $a=$this->limpiar_string(''.$date->format('Y-m-d-H-i-s').'-'.strtolower($name_clean).".".$tipo);
                        // error_log($a);

                        (move_uploaded_file($_FILES['archivo_categoria']['tmp_name'][$i],$ruta.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['arv_nombre']=$a;
                            $data1['arv_estatus']=2;
                            $data1['vac_id']=$vac_id;
                            
                            $data1['ctv_id']=$data['ctv_id'];
                            $respuesta_modelo_nuevo_arc=$documento->NuevoRegistro($data1);
                            if($respuesta_modelo_nuevo_arc!=false)
                            {
                                $answer['estado']=2;
                                $auth = $this->session->get('auth');
                                $data_bit=[
                                    'bit_descripcion'=>"Subió el archivo ".$a." a la vacante con clave ".$id,
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
                //RETORNAMOS LA RESPUEST JSON 
             
                $this->db->commit();
                $answer['estado'] = 2;
                $answer['mensaje'] = 'Se actualizaron los datos de la vacante'.$mensaje_extra_bitacora;
                $answer['titular'] = 'Éxito';
                $answer['vac_id'] = $vac_id;

                $this->response->setJsonContent($answer);
                $this->response->send();        
        } catch (\Exception $e) {
            $this->db->rollback();
            error_log("Excepción: archivoAction subir el archivo " . $e->getMessage());
            $answer = [
                'estado' => -2,
                'mensaje' => $e->getMessage(),
                'titular' => 'AVISO',
                'vac_id' => $id,
            ];
            $data_bit = [
                'bit_descripcion'=>'ERROR AL SUBIR LA VACANTE : '. $e->getMessage(),
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
        $arv = Archivovac::findFirstByarv_id($id);
        $file=$arv->arv_nombre;
        $response = new Response();
        $path = 'archivosvac/'.$arv->vac_id.'/'.$file;
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
            'bit_descripcion'=>"Descargó el archivo ".$file." de la vacante ".$arv->vac_id,
            'bit_tablaid'=>$id,
            'usu_id'=>$auth['id'],
            'bit_modulo'=>'Archivosvac',
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
            $archivo = Archivovac::findFirstByarv_id($id);
            if ($archivo) {
                $archivo->arv_estatus = -2;
        
                if ($archivo->save()) {
                    $answer[0] = 1;
        
                    $auth = $this->session->get('auth');

                    $data_bit=[
                        'bit_descripcion'=>"Eliminó el archivo " . $archivo->arv_nombre . " de la vacante con clave: " . $archivo->vac_id,
                        'bit_tablaid'=>$id,
                        'usu_id'=>$auth['id'],
                        'bit_modulo'=>'Archivosvac',
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

    public function ajax_getImagenAction($id=0){
        $this->view->disable();
        $answer=[];
        $answer["estado"]=-2;
        $answer["titular"]="error";

        if($this->request->isAjax())
        {
            $arv=Archivovac::findFirst($id);
            $ruta = 'archivosvac/'.$arv->vac_id.'/'; 
            $ruta_completa=$ruta.$arv->arv_nombre;
         
            // Validar si la carpeta no existe y luego crearla
            if (!file_exists($ruta_completa)) {
                $answer["mensaje"]="No found";
                $answer["data"]=[];
                $answer["estado"]=2;

            }else{
                $answer["mensaje"]="Found";
                $answer["data"]=$arv;
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
   

    

  

  
}