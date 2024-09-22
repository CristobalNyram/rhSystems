<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Archivo
 */
class Archivovac extends Model
{
    public $categoria_id_cotizacion_vac=1;
    public $arv_id;
	public $arv_nombre;
    public $ruta_files="archivosvac/";

    protected function upper($str)
    {
        $upp=mb_convert_encoding(mb_convert_case(mb_strtoupper($str), MB_CASE_UPPER),"UTF-8");
        return $upp;
    }

	/**
	 * getEstatusDetail - OBTENER EL NOMBRE DEL ESTATUS DEL ARCHIVO
	 *@param  $this [archivo]
	 * @return string
	 */
	public function getEstatusDetail()
	{
		if ($this->arv_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->arv_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->arv_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

    public function ValidarTamanioArch(){

        
        $filename = $_FILES['arv']['name'];
        $isUploaded = false;

        $tamano = $_FILES['arv']['size'];
        $tipo = pathinfo($filename, PATHINFO_EXTENSION);

        $categoria = Categoriavac::findFirstByctv_id($this->categoria_id_cotizacion_vac);
        
        $categoria = Categoriavac::findFirstByctv_id($this->categoria_id_cotizacion_vac);
        $admitidos = explode(",", $categoria->ctv_tipovalidacion);
        /*if ($tamano <= $categoria->ctv_tamano) {

        if ($categoria->ctv_multiple != 'multiple') {
            $archivossubidos = new Builder();
            $archivossubidos = $archivossubidos
        }*/

    }

	public function NuevoRegistro($data)
	{
		$archivo= new Archivovac();
		$archivo->arv_nombre=$data['arv_nombre'];
		$archivo->arv_estatus=$data['arv_estatus'];
		$archivo->vac_id=$data['vac_id'];
		$archivo->ctv_id=$data['ctv_id'];
		
		if ($archivo->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $archivo->arv_id;
		}	

	}
    public function limpiar_string($string)
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


    public function NuevaCotizacion($data,$auth,$vac_id){

        $answer=array();
        $answer["estado"]=-2;
        $ruta = $this->ruta_files."/".$vac_id.'/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
        if (!file_exists($ruta)) {
            if (!mkdir($ruta, 0777, true)) {
                error_log("No se pudo crear la ruta de archivo");
            } 
        }
        $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
        $date= new DateTime();
       

        $filename = $_FILES['arv']['name'];
        $isUploaded = false;

        $tamano = $_FILES['arv']['size'];
        $tipo = pathinfo($filename, PATHINFO_EXTENSION);

        $categoria = Categoriavac::findFirstByctv_id($this->categoria_id_cotizacion_vac);
        $admitidos = explode(",", $categoria->ctv_tipovalidacion);

        if ($categoria->ctv_multiple != 'multiple') {
            $archivossubidos = new Builder();
            $archivossubidos = $archivossubidos
                ->addFrom('Archivovac', 'a')
                ->where('arv_estatus = 2 and ctv_id = ' .$this->categoria_id_cotizacion_vac . ' and vac_id = ' . $vac_id)
                ->getQuery()
                ->execute();

            if (count($archivossubidos) > 0) {
                $answer["estado"] = -1;
                $answer[1] = 0;
                $answer[2] = "Ya existe un archivo para esta categoría, no se puede subir más. Elimine el archivo que anteriormente subió de esta categoría si necesita actualizar.";
                echo json_encode($answer);
                return;
            }
        }

        if (in_array(mb_strtolower($tipo), $admitidos)) {
            if ($tamano <= $categoria->ctv_tamano) {
                $documento = $this;
                // Upload file
                $a = $this->limpiar_string('' . $date->format('Y-m-d-H-i-s') . '-' . strtolower($filename));
                (move_uploaded_file($_FILES['arv']['tmp_name'], $ruta . $a)) ? $isUploaded = true : $isUploaded = false;

                if ($isUploaded) {
                    $data1['arv_nombre'] = $a;
                    $data1['arv_estatus'] = 2;
                    $data1['vac_id'] =$vac_id;
                    $data1['ctv_id'] =$this->categoria_id_cotizacion_vac;
                    $respuesta_modelo_arc_boolean=$documento->NuevoRegistro($data1);
                    if ($respuesta_modelo_arc_boolean== true) {
                        $answer["estado"] = 2;
                        $answer["arv_id"] =$respuesta_modelo_arc_boolean ;
                        $answer[2] = "El archivo se subió exitosamente.";
                        return $answer;

                    } else {
                        $answer["estado"] = -2;
                        $answer[2] = $documento->error;
                        
                        return $answer;
                    }
                }
            } else {
                $answer["estado"] = -1;
                $answer[2] = "El archivo " . $filename . " tiene un peso mayor al permitido. Puede comprimir sus imágenes (jpg, jpeg, png) en esta página: <a href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>";
                return $answer;

            }
        } else {
            $answer["estado"] = -1;
    
            $answer[2] = "El archivo " . $filename . " no tiene una extensión válida para esta categoría.";
            return $answer;

        }
    
    }

    public function SubirArchivos($data,$data_arv,$auth,$vac_id){

        $answer=array();
        $answer["estado"]=-2;
        $ruta = $this->ruta_files."/".$vac_id.'/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
        if (!file_exists($ruta)) {
            if (!mkdir($ruta, 0777, true)) {
                error_log("No se pudo crear la ruta de archivo");
            } 
        }
        $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
        $date= new DateTime();
        $categoria_a_subir_id=$data["ctv_id"];

        $filename = $_FILES['arv']['name'];
        $isUploaded = false;

        $tamano = $_FILES['arv']['size'];
        $tipo = pathinfo($filename, PATHINFO_EXTENSION);

        $categoria = Categoriavac::findFirstByctv_id($categoria_a_subir_id);
        $admitidos = explode(",", $categoria->ctv_tipovalidacion);

        if ($categoria->ctv_multiple != 'multiple') {
            $archivossubidos = new Builder();
            $archivossubidos = $archivossubidos
                ->addFrom('Archivovac', 'a')
                ->where('arv_estatus = 2 and ctv_id = ' .$categoria_a_subir_id . ' and vac_id = ' . $vac_id)
                ->getQuery()
                ->execute();

            if (count($archivossubidos) > 0) {
                $answer["estado"] = -1;
                $answer[1] = 0;
                $answer[2] = "Ya existe un archivo para esta categoría, no se puede subir más. Elimine el archivo que anteriormente subió de esta categoría si necesita actualizar.";
                return($answer);
                die();
            }
        }

        if (in_array(mb_strtolower($tipo), $admitidos)) {
            if ($tamano <= $categoria->ctv_tamano) {
                $documento = $this;
                // Upload file
                $a = $this->limpiar_string('' . $date->format('Y-m-d-H-i-s') . '-' . strtolower($filename));
                (move_uploaded_file($_FILES['arv']['tmp_name'], $ruta . $a)) ? $isUploaded = true : $isUploaded = false;

                if ($isUploaded) {
                    $data1['arv_nombre'] = $a;
                    $data1['arv_estatus'] = 2;
                    $data1['vac_id'] =$vac_id;
                    $data1['ctv_id'] =$categoria_a_subir_id;
                    $respuesta_modelo_arc_boolean=$documento->NuevoRegistro($data1);
                    if ($respuesta_modelo_arc_boolean== true) {
                        $answer["estado"] = 2;
                        $answer["arv_id"] =$respuesta_modelo_arc_boolean ;
                        $answer[2] = "El archivo se subió exitosamente.";
                        return($answer);
                        die();

                    } else {
                        $answer["estado"] = -2;
                        $answer[2] = $documento->error;
                        return($answer);
                        die();
                    }
                }
            } else {
                $answer["estado"] = -1;
                $answer[2] = "El archivo " . $filename . " tiene un peso mayor al permitido. Puede comprimir sus imágenes (jpg, jpeg, png) en esta página: <a href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>";
                return($answer);
                die();

            }
        } else {
            $answer["estado"] = -1;
            $answer[2] = "El archivo " . $filename . " no tiene una extensión válida para esta categoría.";
            return($answer);
            die();

        }
    
    }


    public function getVerificarSiEstaElArchivoCotizacion($vac_id=0){
        $answer=[];
        $answer['estado']=-2;
        $answer['mensaje']='';
        $answer['titular']='error';

        $condicion_sql='vac_id = '.$vac_id.' AND ctv_id=1  AND arv_estatus=2';
        $builder = new Builder();
        $builder->addFrom('Archivovac')
                ->where($condicion_sql);

        $subs = $builder->getQuery()->execute();


        if($subs->count()>=1){
            $answer['estado']=2;
            $answer['mensaje']='EXISTE EL REGISTRO';
            $answer['titular']='OK';

        }else{
            $answer['estado']=-1;
            $answer['mensaje']='NO EXISTE EL REGISTRO';
            $answer['titular']='NO FOUND';
        }

        return $answer;

    }

   /*

    public function validarPesoArchivos($archivos, $pesoPermitido) {
        $archivosPermitidos = array();
        $archivosNoCumplen = array();
        $estado = 2; // Por defecto, todos los archivos cumplen con el peso permitido
        $mensaje="";

        foreach ($archivos as $archivo) {
            $pesoArchivo = filesize($archivo['tmp_name']);

            if ($pesoArchivo > $pesoPermitido) {
                $estado = -1; // Al menos un archivo no cumple con el peso permitido
                $archivosNoCumplen[] = $archivo;
            } else {
                // Agregar el archivo a la lista de archivos permitidos
                $archivosPermitidos[] = $archivo;
            }
        }

        if ($estado === -1 && count($archivosPermitidos) > 0) {
            $estado = -2; // Al menos uno no cumple, pero hay archivos permitidos
        }
        return array(
            'estado' => $estado,
            'mensaje' => $mensaje,
            'archivosPermitidos' => $archivosPermitidos,
            'archivosNoCumplen' => $archivosNoCumplen
        );
    }
    public function validarExtensionCadaArchivo($archivos, $extensionesPermitidas) {
        $archivosPermitidos = array();
        $archivosNoCumplen = array();
        $estado = 2; // Por defecto, todos los archivos cumplen con las extensiones permitidas
        $mensaje="";
        $extensionesPermitidas = explode(',', $extensionesPermitidas);

        foreach ($archivos as $archivo) {
            $nombreArchivo = $archivo['name'];
            $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

            if (!in_array($extensionArchivo, $extensionesPermitidas)) {
                $estado = -1; // Al menos un archivo no cumple con las extensiones permitidas
                $archivosNoCumplen[] = $archivo;
            } else {
                // Agregar el archivo a la lista de archivos permitidos
                $archivosPermitidos[] = $archivo;
            }
        }

        if ($estado === -1 && count($archivosPermitidos) > 0) {
            $estado = -2; // Al menos uno no cumple, pero hay archivos permitidos
        }

        return array(
            'estado' => $estado,
            'mensaje' => $mensaje,
            'archivosPermitidos' => $archivosPermitidos,
            'archivosNoCumplen' => $archivosNoCumplen
        );
    }

    /*
    public function subirArchivosOk($archivos,$vac_id,$cat_id) {
        $archivosSubidos = array();
        $archivosNoSubidos = array();
        $estado = 2; // Por defecto, todos los archivos se subieron correctamente

     
        $ubicacionDestino = $this->ruta_files."/".$vac_id.'/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
        if (!file_exists($ubicacionDestino)) {
            if (!mkdir($ubicacionDestino, 0777, true)) {
                error_log("No se pudo crear la ruta de archivo");
            } 
        }

        $documento = $this;
        $mensaje="";
        foreach ($archivos as $archivo) {
            $nombreArchivoOriginal = $archivo['name'];

            $date = new DateTime();
            $nombreArchivoNuevo = $this->limpiar_string('' . $date->format('Y-m-d-H-i-s') . '-' . strtolower($nombreArchivoOriginal));
            // Intentar subir el archivo
            if (move_uploaded_file($archivo['tmp_name'], $ubicacionDestino . $nombreArchivoNuevo)) {
                $archivosSubidos[] = $nombreArchivoNuevo;
                $data1['arv_nombre'] = $nombreArchivoNuevo;
                $data1['arv_estatus'] = 2;
                $data1['vac_id'] =$vac_id;
                $data1['ctv_id'] =$cat_id;
                $respuesta_modelo_arc_boolean=$documento->NuevoRegistroOK($data1);
            } else {
                $estado = -1; // Al menos un archivo no se subió correctamente
                $archivosNoSubidos[] = $nombreArchivoNuevo;
            }
        }

        if ($estado === -1 && count($archivosSubidos) > 0) {
            $estado = -2; // Al menos uno no se subió correctamente, pero hay archivos subidos
        }

        return array(
            'estado' => $estado,
            'archivosSubidos' => $archivosSubidos,
            'mensaje' => $mensaje,
            'vac_id'=>$vac_id,
            'archivosNoSubidos' => $archivosNoSubidos
        );
    }
*/
/*
    public function NuevoRegistroOK($data)
    {
        $mensaje="";
        $resultado['mensaje'] = $mensaje;
        $archivo = new Archivovac();
        $archivo->arv_nombre = $data['arv_nombre'];
        $archivo->arv_estatus = $data['arv_estatus'];
        $archivo->vac_id = $data['vac_id'];
        $archivo->ctv_id = $data['ctv_id'];
        $resultado = array();
        if ($archivo->save()) {
            // El registro se guardó correctamente
            $resultado['estado'] = 2;
            $resultado['id_registro'] = $archivo->arv_id;
        } else {
            // No se pudo guardar el registro
            $resultado['estado'] = -2;
            $resultado['id_registro'] = null;
        }

        return $resultado;
    }
    */


}