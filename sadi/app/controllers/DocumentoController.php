<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require_once("tinify/vendor/autoload.php");
\Tinify\setKey("wvMw7Jxtk9nN4CHBCbBVKBQLw0MNll2c");

class DocumentoController extends ControllerBase
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
    
    public function archivocurpAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_curp']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_curp']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_curp']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(2);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=2 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_curp']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=2;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivonacimientoAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_nacimiento']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_nacimiento']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_nacimiento']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(3);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=3 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_nacimiento']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=3;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivodomicilioAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_domicilio']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_domicilio']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_domicilio']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(4);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=4 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_domicilio']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=4;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivoestudiosAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_estudios']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_estudios']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_estudios']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(5);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=5 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_estudios']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=5;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivoelectorAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_elector']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_elector']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_elector']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(6);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=6 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_elector']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=6;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivofotografiaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_fotografia']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_fotografia']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_fotografia']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(9);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=9 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_fotografia']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=9;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivocaratulaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_caratula']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_caratula']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_caratula']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(10);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=10 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_caratula']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=10;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function archivofiscalAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(61,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
            $countfiles = count($_FILES['archivo_fiscal']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['archivo_fiscal']['name'][$i];
                $isUploaded = false;


                $tamano = $_FILES['archivo_fiscal']["size"][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);

                $categoria=Documento::findFirstBydoc_id(11);
                $admitidos= explode(",", $categoria->doc_tipovalidacion);
                // $admitidos=array($categoria->cat_tipovalidacion);

                if($categoria->doc_multiple!='multiple'){
                    $archivossubidos=new Builder();
                    $archivossubidos=$archivossubidos
                    ->addFrom('Documentousuario','a')
                    ->where('(dou_estatus=1 or dou_estatus=3) and doc_id=11 and usu_id='.$auth['id'])
                    ->getQuery()
                    ->execute();
                    if(count($archivossubidos)>0){
                        $mensage=$mensage." Ya existen archivos para este documento, no se pueden subir más. Espere a que sean revisados o contacte a un administrador.";
                        $answer[0]=-2;
                        // $answer[2]=$id;
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
                        (move_uploaded_file($_FILES['archivo_fiscal']['tmp_name'][$i],'documentos/'.$a)) ? $isUploaded = true : $isUploaded = false;
                        if($isUploaded){
                            $data1['doc_nombre']=$a;
                            $data1['doc_estatus']=3;
                            // $data1['ese_id']=$id;
                            $data1['doc_id']=11;
                            $data1['usu_id']=$auth['id'];

                                // $data['pol_archivo']=$a;
                            if($documento->NuevoRegistro($data1)==true)
                            {
                                $answer[0]=2;

                                $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo";
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=0;
                                $databit['bit_modulo']="Documentación";
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
            // $answer[2]=$id;
            $answer[3]=$mensage;
            $this->response->setJsonContent($answer);
            $this->response->send(); 

        }
    }

    public function ajax_getinfoAction($id)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $categoria = Documento::findFirstBydoc_id($id);
            if($categoria)
            {  
                $answer[0]=1;
                $answer[1]=$categoria->doc_tipo;
                $answer[2]=$categoria->doc_multiple;
                $answer[3]=$categoria->doc_especificaciones;   
            }
            else
                $answer[0]=0;
        }
        else
            $answer[0]=0;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

    public function ajax_documentosAction()
    {
        $result = [];

        $subs = Documento::find(array(
            "doc_estatus=2","order"=>"doc_nombre"
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

}