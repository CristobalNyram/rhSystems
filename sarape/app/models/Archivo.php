<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Archivo
 */
class Archivo extends Model
{
    public $categoria_id_cv_candidato=1;
    public $arc_id;
	public $arc_nombre;
    public $ruta_can="archivosexc/";

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
		if ($this->arc_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->arc_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->arc_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function NuevoRegistro($data)
	{
		
		$archivo= new Archivo();
		$archivo->arc_nombre=$data['arc_nombre'];
		$archivo->arc_estatus=$data['arc_estatus'];
		$archivo->exc_id=$data['exc_id'];
		$archivo->cat_id=$data['cat_id'];
		
		if ($archivo->save() == false){
            // error_log("prueba");
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
            // error_log("prueba true");

			return $archivo->arc_id;
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


    public function NuevoCVCandidato($data,$auth,$exc_id){

        $answer=array();
        $answer["estado"]=-2;
        $ruta = $this->ruta_can."/".$exc_id.'/'; //Declaramos una variable con la ruta en donde almacenaremos los archivos
        if (!file_exists($ruta)) {
            if (!mkdir($ruta, 0777, true)) {
                error_log("No se pudo crear la ruta de archivo");
            } 
        }
        $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
        $date= new DateTime();
       

        $filename = $_FILES['arc']['name'];
        $isUploaded = false;

        $tamano = $_FILES['arc']['size'];
        $tipo = pathinfo($filename, PATHINFO_EXTENSION);

        $categoria = Categoria::findFirstBycat_id($this->categoria_id_cv_candidato);
        $admitidos = explode(",", $categoria->cat_tipovalidacion);

        if ($categoria->cat_multiple != 'multiple') {
            $archivossubidos = new Builder();
            $archivossubidos = $archivossubidos
                ->addFrom('Archivo', 'a')
                ->where('arc_estatus = 2 and cat_id = ' .$this->categoria_id_cv_candidato . ' and exc_id = ' . $exc_id)
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
            if ($tamano <= $categoria->cat_tamano) {
                $documento = $this;
                // Upload file
                $a = $this->limpiar_string('' . $date->format('Y-m-d-H-i-s') . '-' . strtolower($filename));
                (move_uploaded_file($_FILES['arc']['tmp_name'], $ruta . $a)) ? $isUploaded = true : $isUploaded = false;

                if ($isUploaded) {
                    $data1['arc_nombre'] = $a;
                    $data1['arc_estatus'] = 2;
                    $data1['exc_id'] =$exc_id;
                    $data1['cat_id'] =$this->categoria_id_cv_candidato;
                    $respuesta_modelo_arc_boolean=$documento->NuevoRegistro($data1);
                    if ($respuesta_modelo_arc_boolean== true) {
                        $answer["estado"] = 2;
                        $answer["arc_id"] =$respuesta_modelo_arc_boolean ;
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
   

}