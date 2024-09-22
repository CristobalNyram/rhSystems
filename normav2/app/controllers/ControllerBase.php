<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $configuracion=new Configuracion();
        $estatusLogoConfiguracion=$configuracion->estatusConfiguracionAnuncio(5);
        $logo_actual=$estatusLogoConfiguracion['con_texto'];
        $this->view->logoactual=$logo_actual;
        $estadoCuestionario=new Cueactivo();
        $estadoCuestionarios=$estadoCuestionario->EstadoCuestionario();
        $this->view->estadoCuestionariosDescarga=$estadoCuestionarios;    
        
        $pendientes=0;
        $this->tag->prependTitle('Norma | ');
        $this->view->setTemplateAfter('main');
        $auth = $this->session->get('auth');
        if($auth)
        {
            $usuario=Usuario::findFirstByusu_id($auth['id']);
            $rol=Rol::findFirstByrol_id($usuario->rol_id);
            $logo=Administrador::findFirstByadm_default(1);
            $this->view->autentificado=1;
            $this->view->idadmin=$auth['id'];
            $this->view->nombreadmin=$auth['nombre'];
            $this->view->logo=$logo->adm_logo;
            if($usuario->usu_tipo=='Users'){
                $this->view->rol=$rol->rol_nombre;
            }
            else{
                $this->view->rol='Empresa';   
            }
            // $ofactura=Ordenfactura::findFirst("ofa_estatus=5 or ofa_estatus=6 or (ofa_estatus=1 and ofa_fechadocumento>=current_timestamp())");
            // if($ofactura)
            //     $pendientes=1;
            $this->view->correoadmin=$auth['correo'];
            $this->view->tipo=$auth['tipo'];
            $this->view->fotoadmin=$auth['foto'];
            $this->view->configuracion=$auth['configuracion'];
            $this->view->rol_id=$auth['rol_id'];
            $this->view->gmenu=1;
            $this->view->gpendientes=$pendientes;

            /*$catproyecto=Catproyecto::find(array("pro_estatus>=0"));
            $this->view->catproyecto=$gcatproyecto;*/
            // $this->view->autentificado=1;
        }
        else
        {
            $this->view->autentificado=0;
        }
        $this->view->gcolor="bg-empresa";
        $this->view->version="1.0.0 - 2019";
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
        $exceptions['E '] = 'e ';
        $exceptions['Del'] = 'del';
        $exceptions['De '] = 'de ';
        $exceptions['Iso '] = 'ISO ';
        $exceptions['Covid-'] = 'COVID-';
        $exceptions['Dnc'] = 'DNC';
        $exceptions['Amef'] = 'AMEF';
        $exceptions['Sirce'] = 'SIRCE';
        
        
       
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
      /**
     * Verifica si un numero es valido y mayor que cero.
     * @param mixed $num Numero a validar.
     * @return bool Devuelve true si el numero es valido y mayor que cero, de lo contrario, devuelve false.
     */
    public function numerovalidoInputValido($num) {
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
    public function cadenaValida($str) {
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
    public function numerovalidoInputValidoConArray($num, $numeros_no_tomar_en_cuenta = []) {
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
    public function fechaInputValida($fecha) {
        $timestamp = strtotime($fecha);
        return $timestamp !== false && date('Y-m-d', $timestamp) === $fecha;
    }    

    public function agregarAndONoSQL($condicion=""){
        $answer=$condicion;
        if(!trim($condicion)==""){
            $answer=$answer." AND ";
        }
        return $answer;

    }
  
    
    

}
