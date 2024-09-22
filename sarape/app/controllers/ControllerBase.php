<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Application;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Assets\Manager as AssetsManager;
use Phalcon\Assets\Resource\Css as CssResource;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Di;
use Phalcon\Crypt;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $pendientes=0;
        $this->tag->prependTitle('SARAPE | ');
        $this->view->setTemplateAfter('main');
        $auth = $this->session->get('auth');
        // date_default_timezone_set('America/Mexico_City');
        date_default_timezone_set('America/Chihuahua');

        if($auth)
        {


            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            if($config->security->secretkeyproyect!=$auth['proyc']){
                $this->session->remove('auth');
            }
            $usuario=Usuario::findFirstByusu_id($auth['id']);
            if($usuario->usu_estatus!=2){
                if($usuario->usu_id!=172){
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Se cerró sesión por motivo de baja";
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=0;
                    $databit['bit_modulo']="Sesión";
                    $bitacora->NuevoRegistro($databit);

                    $this->session->remove('auth');
                    // $this->flash->success('Hasta luego.');
                    return $this->forward('index/index');
                }
            }
            // $rol=Rol::findFirstByrol_id($usuario->rol_id);
            // $logo=Administrador::findFirstByadm_default(1);
            $this->view->autentificado=1;
            $this->view->idadmin=$auth['id'];
            $this->view->nombreadmin=$auth['nombre'];
            // $this->view->logo=$logo->adm_logo;
            $this->view->logo="2020-01-29-19-13-59-opt.jpg";
            if($usuario->usu_tipo=='Users'){
                // $this->view->rol=$rol->rol_nombre;
                $this->view->rol='Empresa';
            }
            else{
                $this->view->rol='Empresa';   
            }
            // $ofactura=Ordenfactura::findFirst("ofa_estatus=5 or ofa_estatus=6 or (ofa_estatus=1 and ofa_fechadocumento>=current_timestamp())");
            // if($ofactura)
            //     $pendientes=1;
            $this->view->correoadmin=$auth['correo'];
            $this->view->tipo=$auth['tipo'];
            // $this->view->fotoadmin=$auth['foto'];
            $this->view->configuracion=$auth['configuracion'];
            $this->view->rol_id=$auth['rol_id'];
            $this->view->gmenu=1;
            $this->view->gpendientes=$pendientes;
            $this->setPersonalizarInterfaz();

            /*$catproyecto=Catproyecto::find(array("pro_estatus>=0"));
            $this->view->catproyecto=$gcatproyecto;*/
            // $this->view->autentificado=1;
        }
        else
        {
            $this->view->autentificado=0;
        }
        $this->view->gcolor="bg-empresa";
        $this->view->version="1.0.0 - 2020";
    }
    /** 
     * [funcion para redireccionar desde php]
     * @param  [string] $uri [liga a la cual quieres direccionar] 
     * @return [mixed] [vista que se encuentra en la liga]
     */
    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
    protected function convertir_fecha($fecha)
    {
        $dia=substr($fecha,0,6);
        $mes=substr($fecha,3,2);
        $anio=substr($fecha,6,4);
        return $fecha;
    }

    protected function upper($str)
    {
        $upp=mb_convert_encoding(mb_convert_case(mb_strtoupper($str), MB_CASE_UPPER),"UTF-8");
        return $upp;
    }

    protected function primermayus($str)
    {
        $primermayus=mb_convert_encoding(mb_convert_case(mb_strtolower($str), MB_CASE_TITLE), "UTF-8");
        
        return $primermayus;
    }

    protected function mb_ucwords($str) {
        $exceptions = array();
        $exceptions['Imss'] = 'IMSS';
        $exceptions['Stps'] = 'STPS';
        $exceptions['Infonavit'] = 'INFONAVIT';
        $exceptions['Nom'] = 'NOM';
        
       
        $separator = array(" ","-","+");
       
        $str = mb_strtolower(trim($str));
        foreach($separator as $s){
            $word = explode($s, $str);

            $return = "";
            foreach ($word as $val){
                // $return .= $s . mb_strtoupper($val{0}) . mb_substr($val,1,mb_strlen($val)-1);
                $return= $s.mb_convert_encoding(mb_convert_case($val, MB_CASE_TITLE), "UTF-8");
            }
            // $str = mb_substr($return, 1);
        }

        foreach($exceptions as $find=>$replace){
            if (mb_strpos($return, $find) !== false){
                $return = str_replace($find, $replace, $return);
            }
        }
        return mb_substr($return, 1);
    }

    protected function mayusinstructor($str)
    {
        $primermayus=mb_convert_encoding(mb_convert_case(mb_strtolower($str), MB_CASE_TITLE), "UTF-8");
        $titulos = array("Ing.", "Ing", "T.u.m.", "Tum.", "Tum", "Lic.", "Lic",'C.p.','C.p');
        $limpio = str_replace($titulos, "", $primermayus);
        $sinespacio=trim($limpio);
        return $sinespacio;
    }

    protected function agregarMeses($fecha,$meses)
    {
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        $oldDay = $dt->format("d");
        $dt->add(new DateInterval("P".$meses."M")); // 2016-03-02
        $newDay = $dt->format("d");

        if($oldDay != $newDay) {
            // Check if the day is changed, if so we skipped to the next month.
            // Substract days to go back to the last day of previous month.
            $dt->sub(new DateInterval("P" . $newDay . "D"));
        }

        $fecha= $dt->format("Y-m-d");
        return $fecha;
    }

    protected function finsiguientemes($fecha)
    {
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        // $oldDay = $dt->format("d");
        // $dt->add(new DateInterval("P2M")); // 2016-03-02
        $dt->modify("last day of next month");;

        $fecha= $dt->format("Y-m-d");
        return $fecha;
    }

    protected function sumDias($fecha,$dias)
    {
        //agregar días y regresa el día hábil (no sábado o domingo) próximo
        $restar=$dias-5;
        if($restar<0){
            $restar=0;
        }
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        // $oldDay = $dt->format("d");
        $dt->add(new DateInterval("P".$restar."D"));
        $fecha= $dt->format("Y-m-d");
        if(date("w", strtotime($fecha))==0){
            //0 para domingo
            $dt->sub(new DateInterval("P2D"));
            $fecha= $dt->format("Y-m-d");
        }
        if(date("w", strtotime($fecha))==6){
            //6 para sábado
            $dt->sub(new DateInterval("P1D"));
            $fecha= $dt->format("Y-m-d");
        }
        // $fecha='12-12-2020';
        return $fecha;
        // $newDay = $dt->format("d");
    }

    protected function sumDiasexactos($fecha,$dias)
    {
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        // $oldDay = $dt->format("d");
        $dt->add(new DateInterval("P".$dias."D"));
        $fecha= $dt->format("Y-m-d");
        return $fecha;
        // $newDay = $dt->format("d");
    }

    protected function resDiasexactos($fecha,$dias)
    {
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        $dt->sub(new DateInterval("P".$dias."D"));
        $fecha= $dt->format("Y-m-d");
        return $fecha;
    }

    protected function resDias($fecha,$dias)
    {
        //restar días y regresa el día hábil (no sábado o domingo) próximo
        $restar=$dias;
        if($restar<0){
            $restar=0;
        }
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        // $oldDay = $dt->format("d");
        $dt->sub(new DateInterval("P".$restar."D"));
        $fecha= $dt->format("Y-m-d");
        if(date("w", strtotime($fecha))==0){
            //0 para domingo
            $dt->sub(new DateInterval("P2D"));
            $fecha= $dt->format("Y-m-d");
        }
        if(date("w", strtotime($fecha))==6){
            //6 para sábado
            $dt->sub(new DateInterval("P1D"));
            $fecha= $dt->format("Y-m-d");
        }
        // $fecha='12-12-2020';
        return $fecha;
        // $newDay = $dt->format("d");
    }

    protected function casort($arr, $var) 
    {
       $tarr = array();
       $rarr = array();
       for($i = 0; $i < count($arr); $i++) {
          $element = $arr[$i];
          $tarr[] = strtolower($element->{$var});
       }

       reset($tarr);
       asort($tarr);
       $karr = array_keys($tarr);
       for($i = 0; $i < count($tarr); $i++) {
          $rarr[] = $arr[intval($karr[$i])];
       }

       return $rarr;
    }

    protected function limpiar_string($string)
    {
        $string = trim($string);
     
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
     
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
     
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
     
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
     
        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );
     
        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("¨", "º", "~",
                 "#", "@", "|", "!",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "<code>", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":",
                 " "),
            '',
            $string
        );
     
     
        return $string;
    }


        protected function limpiar_string2($string)
        {
            // Reemplaza caracteres especiales y acentos
            $string = strtr($string, array(
                'á' => 'a', 'à' => 'a', 'ä' => 'a', 'â' => 'a', 'ª' => 'a',
                'Á' => 'A', 'À' => 'A', 'Â' => 'A', 'Ä' => 'A',
                'é' => 'e', 'è' => 'e', 'ë' => 'e', 'ê' => 'e',
                'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
                'í' => 'i', 'ì' => 'i', 'ï' => 'i', 'î' => 'i',
                'Í' => 'I', 'Ì' => 'I', 'Ï' => 'I', 'Î' => 'I',
                'ó' => 'o', 'ò' => 'o', 'ö' => 'o', 'ô' => 'o',
                'Ó' => 'O', 'Ò' => 'O', 'Ö' => 'O', 'Ô' => 'O',
                'ú' => 'u', 'ù' => 'u', 'ü' => 'u', 'û' => 'u',
                'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U',
                'ñ' => 'n', 'Ñ' => 'N', 'ç' => 'c', 'Ç' => 'C'
            ));

            // Elimina caracteres no alfanuméricos
            $string = preg_replace('/[^a-zA-Z0-9]/', '', $string);

            return $string;
        }

    protected function getEstudios($pre=""){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $consulta='(';
        if($rol->verificar(49,$auth['rol_id']))
        {
            $consulta.=$pre."tip_id=1 ";
        }
        if($rol->verificar(50,$auth['rol_id']))
        {
            if($consulta=='('){
                $consulta.=$pre."tip_id=2 ";
            }else{
                $consulta.="or ".$pre."tip_id=2 ";
            }
        }
        if($rol->verificar(51,$auth['rol_id']))
        {
            if($consulta=='('){
                $consulta.=$pre."tip_id=3 ";
            }else{
                $consulta.="or ".$pre."tip_id=3 ";
            }
        }
        if($rol->verificar(52,$auth['rol_id']))
        {
            if($consulta=='('){
                $consulta.=$pre."tip_id=4 ";
            }else{
                $consulta.="or ".$pre."tip_id=4 ";
            }
        }
        if($rol->verificar(53,$auth['rol_id']))
        {
            if($consulta=='('){
                $consulta.=$pre."tip_id=5 ";
            }else{
                $consulta.="or ".$pre."tip_id=5 ";
            }
        }
        return $consulta.')';
    }
        
    public function buscar_fecha_del_lunes_pasado($d="",$format="Y-m-d"){
        if($d=="") $d=date("Y-m-d");
            $delta = date("w",strtotime($d)) - 1;
        
        if ($delta <0) $delta = 6;
            return date($format, mktime(0,0,0,date('m'), date('d')-$delta, date('Y') ));
    }

    public function diastranscurridos($inicio, $fin, $feriados){ //función que regresa la cantidad de días que hay entre dos fechas sin tomar en cuenta fines de semana ni feriados
        $start = new DateTime($inicio);
        $end = new DateTime($fin);

        $interval = $end->diff($start);

        // total dias
        $days = $interval->days;

        // crea un período de fecha iterable (P1D equivale a 1 día)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        $holidays = $feriados;

        foreach($period as $dt) {
            $curr = $dt->format('D');
            // obtiene si es Sábado o Domingo
            if($curr == 'Sat' || $curr == 'Sun') {
                $days--;
            }elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }

        if($days<0){ //si los días fueran menor a 0
            $days = 0;
        }

        return $days;
    }
    function obtenerIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
	}
    function setPersonalizarInterfaz(){
       
        //jalaomos los archivos d csss
         $cssPath = 'assets/css/variables/style.css';//este es archivo donde se remplazan cosas
         $cssPathProduccion = 'assets/css/variables/style_produccion.css';//este es que se modifica

         if (!file_exists($cssPathProduccion)) {
             file_put_contents($cssPathProduccion, '');      
         } 
         
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT *
         FROM configuracion AS cof
         WHERE cof.cof_actualizo = (
             SELECT MAX(cof_actualizo)
             FROM configuracion
         )
         ';//obtenemos el registro con mas reciente de fecha de actualizacion
         
         $result = $db->query($sql);
         $consulta = $result->fetchAll();
         $ultimaActualizacion_registros_bd=$consulta[0]['cof_actualizo'];
         
         // Verificar la última vez que se actualizó el archivo original
         $ultimaModificacion = filemtime($cssPathProduccion);
         $fechaLegibleUltimaModificacion_archivo = date('Y-m-d H:i:s', $ultimaModificacion);
 
         $fechaArchivo = new DateTime($fechaLegibleUltimaModificacion_archivo);
         $fechaUltimaActualizacion = new DateTime($ultimaActualizacion_registros_bd);
         //var_dump( $ultimaActualizacion_registros_bd);
         //die();
         if (!($fechaArchivo > $fechaUltimaActualizacion)) {
 
             // Limpiar el archivo de producción
             file_put_contents($cssPathProduccion, '');
 
             // Configuración de variables
             $configuracion_modelo = new Configuracion();
             $fondo_barra_superior = $configuracion_modelo->getFondoBarraSuperior();
             $border_barra_superior = $configuracion_modelo->getBorderBarraSuperior();
             $fondoHeadDataTable = $configuracion_modelo->getColorHeadDataTable();
             $btn_confirmar_fondo = $configuracion_modelo->getBtnConfirmarFondo();
             $btn_confirmar_fondo_hover = $configuracion_modelo->getBtnConfirmarFondoHover();
             $btn_cancelar_fondo = $configuracion_modelo->getBtnCancelarFondo();
             $btn_cancelar_fondo_hover = $configuracion_modelo->getBtnCancelarFondoHover();
             $iconos_opciones = $configuracion_modelo->getIconosOpciones();
             $fondo_sistema_general = $configuracion_modelo->getFondoSistemaGeneral();

             // Obtener el contenido del archivo original
             $cssContent = file_get_contents($cssPath);
             
             // Reemplazar la palabra '#topbar_background#' por la nueva palabra 'red'
             $nuevoContenido = str_replace('#topbar_background#', $fondo_barra_superior, $cssContent);
             $nuevoContenido = str_replace('#topbar_border_color#', $border_barra_superior, $nuevoContenido);
             $nuevoContenido = str_replace('#table_head_datatable#', $fondoHeadDataTable, $nuevoContenido); 
             $nuevoContenido = str_replace('#btn_confirmar_fondo#', $btn_confirmar_fondo, $nuevoContenido);
             $nuevoContenido = str_replace('#btn_confirmar_fondo_hover#', $btn_confirmar_fondo_hover, $nuevoContenido);
             $nuevoContenido = str_replace('#btn_cancelar_fondo#', $btn_cancelar_fondo, $nuevoContenido);
             $nuevoContenido = str_replace('#btn_cancelar_fondo_hover#', $btn_cancelar_fondo_hover, $nuevoContenido);
             $nuevoContenido = str_replace('#iconos_opciones#', $iconos_opciones, $nuevoContenido);
             $nuevoContenido = str_replace('#fondo_sistema_general#', $fondo_sistema_general, $nuevoContenido);

             // Sobrescribir el archivo de producción con el contenido modificado
             file_put_contents($cssPathProduccion, $nuevoContenido);
             $this->setCacheLimipia();
         }
                
         // Agregar el archivo CSS de producción al objeto $assets
         $this->assets->addCss($cssPathProduccion);
 
     }
 
     public function setCacheLimipia(){
         $carpeta_cache = './../cache/volt';//este es que se modifica
 
         if (is_dir($carpeta_cache)) {
             // Obtener la lista de archivos y subcarpetas dentro de la carpeta
             $archivos = glob($carpeta_cache . '/*');
             // Recorrer los archivos y carpetas
             foreach ($archivos as $archivo) {
                 // Verificar si es un archivo y borrarlo
                 if (is_file($archivo)) {
                     unlink($archivo);
                 }
             }
 
           
         }
     }
    /**
     * Registra una entrada en la bitácora.
     *
     * @param array $data Los datos de la entrada de bitácora.
     *                   - 'bit_descripcion': La descripción de la entrada.
     *                   - 'bit_tablaid': El ID de la tabla asociada a la entrada.
     *                   - 'bit_modulo': El módulo del sistema asociado a la entrada.
     *                   - 'bit_accion': La acción de la entrada.
     * @param array $auth_data Los datos de autenticación del usuario.
     *                         - 'id': El ID del usuario.
     *
     * @return int|false El ID de la entrada de bitácora creada si se guarda correctamente, o false en caso de error.
     */
     public function  bitacora_registro($data,$auth_data){
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= $data['bit_descripcion'];
        $databit['usu_id']=$auth_data['id'];
        $databit['bit_tablaid']=$data['bit_tablaid'];
        $databit['bit_modulo']=$data['bit_modulo'];
        $databit['vac_id'] = isset($data['vac_id']) ? $data['vac_id'] : null;
        $databit['exc_id'] = isset($data['exc_id']) ? $data['exc_id'] : null;

        $databit['bit_accion']=$data['bit_accion'];
        $bitacora->NuevoRegistro($databit);
     }

     public function bitacora_registro_ERROR($data,$e){
        $mensaje = $e->getMessage();
        $clase = get_class($e);
        $linea = $e->getLine();
        $auth_id= 0;
        $mensaje= 'Error ' . $mensaje . ' en ' . $clase . ' en línea ' . $linea;
        $bitacora= new Bitacora();
        $databit['bit_descripcion']=  $mensaje;
        $databit['usu_id']=$auth_id;
        $databit['bit_tablaid']=$data['bit_tablaid'];
        $databit['bit_modulo']=$data['bit_modulo'];
        $databit['vac_id'] = isset($data['vac_id']) ? $data['vac_id'] : null;
        $databit['bit_accion']=$data['bit_accion'];
        $databit['bit_tipo']='ERROR';

        $bitacora->NuevoRegistro($databit);
     }
    

     public function des_encriiptarId($data_)
     {
            $answer["estado"]=-2;
            $answer["titular"]="error";
            $answer["mensaje"]="error";
            try {
                $crypt = new Crypt();
                $data_t = unserialize(base64_decode($data_));
                $key = "5JSjagDAJIGMNgsowKFQswDAS";
                $data_t["id"] = trim($crypt->decryptBase64($data_t["id"], $key));


                if (
                    !array_key_exists('_token', $data_t) ||
                    !array_key_exists('id', $data_t) ||
                    !array_key_exists('extra_key', $data_t) ||
                    !array_key_exists('nombre', $data_t)
                ) {
                    throw new Exception("ERROR #FK404RPPDF ...");
                }

                $token_value=$data_t["_token"];
                
                if (
                strpos($token_value, 'S') === false ||
                strpos($token_value, 'I') === false ||
                strpos($token_value, 'P') === false ||
                strpos($token_value, 'S') === false
                ) {
                throw new Exception("ERROR #FVKN404RPPDF ...");
                }

                if (strpos($data_t['nombre'], 'sarape_') !== false) {
                    $answer["id"]=$data_t["id"];
                    $answer["estado"]=2;
                    $answer["titular"]="OK";
                    $answer["mensaje"]="OK";
                } else {
                    throw new Exception("ERROR #FEN404RPPDF ...");
                }

                
            } catch (Throwable $e) {
                error_log("NO SE PUEDEN HACER LA LECTURA DEL ARREGLO POR ERROR EN LOS PARÁMETROS");
                $answer["titular"]="ERROR";
                $answer["mensaje"]="ERROR";
            }
         return $answer;
    
        }

        public function encriiptarId($data_)
        {
            $crypt = new Crypt();
            $id =$data_;
    
            $key = "5JSjagDAJIGMNgsowKFQswDAS";
            $encripData = trim($crypt->encryptBase64($id, $key));
            $encripData_2 = trim($crypt->encryptBase64($id, $key));
            $token_value=rand(1,10).'_S_'.rand(885,990).'_I_'.rand(50,60).rand(99,212).'_P_'.rand(256,388).'_S_'.rand(201,789);
            $data=[
                '_token'=>$token_value,
                'id'=>$encripData,
                'nombre'=>'sarape_'.$this->generateRandomString(),
                'extra_key'=>$this->generateRandomString(),

            ];
           // Obtén las claves del arreglo y mézclalas
            $claves = array_keys($data);
            shuffle($claves);

            // Crea un nuevo arreglo con el orden aleatorio
            $dataAleatorio = [];
            foreach ($claves as $clave) {
                $dataAleatorio[$clave] = $data[$clave];
            }

            $data_t=base64_encode(serialize($dataAleatorio));
          
            return $data_t;
            
    
    
        }
     
    
        function generateRandomString($length = 10) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $randomString = '';
            $charLength = strlen($characters);
        
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charLength - 1)];
            }
        
            return $randomString;
        }
        function generateRandomKey($length = 5) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomKey = '';
            $charLength = strlen($characters);
        
            for ($i = 0; $i < $length; $i++) {
                $randomKey .= $characters[rand(0, $charLength - 1)];
            }
        
            return $randomKey;
        }

        private function responderError($estado, $titular, $mensaje)
        {
            $answer = [
                'estado' => $estado,
                'titular' => $titular,
                'mensaje' => $mensaje,
            ];

            $this->response->setJsonContent($answer);
            $this->response->send();
        }
        function limpiarValorBD($data) {
            $valoresExcluidos = [null, '-2', '-1'];
            $valorPorDefecto = '';
        
            return in_array($data, $valoresExcluidos) ? $valorPorDefecto : $data;
        }


        
        /**
         * Verifica si una cadena es válida y no está vacía.
         * @param mixed $str Cadena a validar.
         * @return bool Devuelve true si la cadena es válida y no está vacía, de lo contrario, devuelve false.
         */
        function cadenaValida($str) {
            if (isset($str) && is_string($str) && trim($str) !== '') {
                return true;
            } else {
                return false;
            }
        }
            /**
         * Verifica si un numero es valido y mayor que cero.
         * @param mixed $num Numero a validar.
         * @return bool Devuelve true si el numero es valido y mayor que cero, de lo contrario, devuelve false.
         */
        function numerovalidoInputValido($num) {
            if (isset($num) && is_numeric($num) && floatval($num) > 0 && trim($num)!="") {
                return true;
            } else {
                return false;
            }
    }

    
}
