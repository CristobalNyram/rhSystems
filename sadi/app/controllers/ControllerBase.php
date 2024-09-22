<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Application;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Di;
use Phalcon\Crypt;
class ControllerBase extends Controller
{

    protected function initialize()
    {    
        $pendientes=0;
        $this->tag->prependTitle('SADI | ');
        
        $auth = $this->session->get('auth');
        // date_default_timezone_set('America/Mexico_City');
        date_default_timezone_set('America/Chihuahua');

        if($auth)
        {
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
            if($config->security->secretkeyproyect!=$auth['proyc']){
                $this->session->remove('auth');
            }
            if($auth['tipo']=="Users"){
                $this->view->setTemplateAfter('main');
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
                        return $this->forward('index/index');
                    }
                }
                $this->view->rol='Empresa';
            }
            elseif($auth['tipo']=="Cliente"){
                $this->view->setTemplateAfter('maincliente');
                $usuario=Cliente::findFirstBycli_id($auth['id']);
                if($usuario->cli_estatus!=2){
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacoracliente();
                    $databit['bic_descripcion']= "Se cerró sesión por motivo de baja";
                    $databit['cli_id']=$auth['id'];
                    $databit['bic_tablaid']=0;
                    $databit['bic_modulo']="Sesión";
                    $bitacora->NuevoRegistro($databit);

                    $this->session->remove('auth');
                    return $this->forward('cliente/index');
                }
                $this->view->rol='Cliente';   
            }
            $this->view->autentificado=1;
            $this->view->idadmin=$auth['id'];
            $this->view->nombreadmin=$auth['nombre'];
            $this->view->logo="2020-01-29-19-13-59-opt.jpg";
            $this->view->correoadmin=$auth['correo'];
            $this->view->tipo=$auth['tipo'];
            $this->view->configuracion=$auth['configuracion'];
            $this->view->rol_id=$auth['rol_id'];
            $this->view->gmenu=1;
            $this->view->gpendientes=$pendientes;
            $this->setPersonalizarInterfaz();
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
    /**
     * Resta un número específico de días a una fecha dada.
     * @param string $fecha La fecha de la cual restar los días en formato 'Y-m-d'.
     * @param int $dias El número de días a restar.
     * @return string La fecha resultante después de restar los días, en formato 'Y-m-d'.
     */
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

    protected function getEstudiosCliente($pre=""){
        // $rol = new Rol();
        $auth = $this->session->get('auth');
        $consulta='(';
        if($auth['nivel']==1)
        {
            $consulta.=$pre."neg_id=".$auth['neg_id'];
        }elseif($auth['nivel']==2)
        {
            $consulta.="emp.emp_id=".$auth['emp_id'];
        }elseif($auth['nivel']==3)
        {
            $consulta.=$pre."cne_id=".$auth['cne_id'];
        }
        return $consulta.')';
    }

    
 
    public function des_encriiptarId($data_)
    {
        $answer["estado"] = -2;
        $answer["titular"] = "error";
        $answer["mensaje"] = "error";
    
        try {
            $crypt = new Crypt();
    
            // Separar la cadena en sus partes
            $decoded_data = base64_decode($data_);
            $exploded_data = explode("--", $decoded_data);
    
            // Verificar si la cadena se dividió correctamente
            if (!is_array($exploded_data) || count($exploded_data) !== 3) {
                throw new Exception("ERROR #FEN404RPPDF -1...");
            }
    
            // Asignar partes a variables
            list($strng_key_ramdom_before, $data_serialized, $strng_key_ramdom_after) = $exploded_data;
    
            // Verificar si las partes aleatorias coinciden
            if ($strng_key_ramdom_before !== $strng_key_ramdom_after) {
                throw new Exception("ERROR #FEN404RPPDF -2...");
            }
    
            // Verificar si la cadena aleatoria es válida
            $strng_key_ramdom_length = strlen($strng_key_ramdom_before);
            if ($strng_key_ramdom_length !== 5) {
                throw new Exception("ERROR #FEN404RPPDF -3...");
            }
    
            // Deserializar la cadena
            $data_t = unserialize($data_serialized);
    
            $key = "CMSagDAOIESTfsowKFQouADI";
    
            // Desencriptar el ID
            $data_t["id"] = trim($crypt->decryptBase64($data_t["id"], $key));
           
            $extra_key = $data_t["extra_key"];

            if(strlen($extra_key)!=13){
                throw new Exception("ERROR NOT 1.3 CHARACTERS -3...");
            }

            
            // Verificar la validez del token y del nombre
            $token_value = $data_t["_token"];
            if (
                strpos($token_value, 'S') === false ||
                strpos($token_value, 'A') === false ||
                strpos($token_value, 'D') === false ||
                strpos($token_value, 'I') === false
            ) {
                throw new Exception("ERROR #FVKN404RPPDF -4...");
            }

    
            if (strpos($data_t['nombre'], 'sadi_') !== false) {
                $answer["id"] = $data_t["id"];
                $answer["estado"] = 2;
                $answer["titular"] = "OK";
                $answer["mensaje"] = "OK";
            } else {
                throw new Exception("ERROR #FEN404RPPDF -5...");
            }
        } catch (Throwable $e) {
            error_log("NO SE PUEDEN HACER LA LECTURA DEL ARREGLO POR ERROR EN LOS PARÁMETROS");
            $answer["titular"] = "ERROR";
            $answer["mensaje"] = "ERROR";
        }
    
        return $answer;
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
     * Encripta un ID y genera un token único.
     * @param mixed $data_ El ID que se va a cifrar.
     * @return string El token generado que contiene el ID cifrado y otros valores aleatorios.
     */
    public function encriiptarId($data_){
        $crypt = new Crypt();
        $id = $data_;
    
        $key = "CMSagDAOIESTfsowKFQouADI";
        $encripData = trim($crypt->encryptBase64($id, $key));
        
        // Genera un string aleatorio
        $strng_ramdom = $this->generateRandomString(13);
        $strng_key_ramdom = $this->generateRandomString(5);

        $token_value = rand(1,10).'_S_'.rand(885,990).'_A_'.rand(50,60).rand(99,212).'_D_'.rand(256,388).'_I_'.rand(201,789);
        
        $data = [
            '_token' => $token_value,
            'id' => $encripData,
            'extra_key' => $strng_ramdom,
            'nombre' => 'sadi_'.$strng_ramdom,
        ];
        
        $claves = array_keys($data);
        shuffle($claves);
        
        $dataAleatorio = [];
        foreach ($claves as $clave) {
            $dataAleatorio[$clave] = $data[$clave];
        }
    
        $data_serialized = serialize($dataAleatorio);
        
        $data_t = base64_encode($strng_key_ramdom ."--". $data_serialized."--". $strng_key_ramdom);
        return $data_t;
    }
    function generateRandomString($length = 13) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomString;
    }
    function generateRandomKey($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomKey = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomKey .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomKey;
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
    /**
     * Verifica si un numero es valido y mayor que cero.
     * @param mixed $num Numero a validar.
     * @return bool Devuelve true si el numero es valido y mayor que cero, de lo contrario, devuelve false.
     */
    function numerovalidoInputValido($num) {
        if (isset($num) && is_numeric($num) && floatval($num) > 0) {
            return true;
        } else {
            return false;
        }
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
     * Verifica si un numero es valido y no está presente en un array específico de numeros a no tomar en cuenta. 
     * @param mixed $num Número a validar.
     * @param array $numeros_no_tomar_en_cuenta Array de numeros que no se deben tomar en cuenta.
     * @return bool Devuelve true si el numero es válido y no está en la lista especificada, de lo contrario, devuelve false.
     */
    function numerovalidoInputValidoConArray($num, $numeros_no_tomar_en_cuenta = []) {
        if (isset($num) && is_numeric($num) && !in_array($num, $numeros_no_tomar_en_cuenta)) {
            return true; 
        } else {
            return false; 
        }
    }
    /**
     * Verifica si una fecha es valida.
     * @param string $fecha Fecha en formato 'Y-m-d' a validar.
     * @return bool Devuelve true si la fechas es valida, de lo contrario, devuelve false.
     */
    function fechaInputValida($fecha) {
        $timestamp = strtotime($fecha);
        return $timestamp !== false && date('Y-m-d', $timestamp) === $fecha;
    }    

  
}
