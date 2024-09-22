<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Estcancelado
 */
class Estcancelado extends ModelBase
{
    public $ruta_archivos="cancelacion";
    public $key_input_file="eca_evidencia";
    public $obj_archivo_acc="";

    public $estatus= [
        "1"=> "REACTIVADO",
        "2"=> "CANCELADO",
        "-2"=> "",
    ];
    function onConstruct()
    {
     $this->obj_archivo_acc=new Archivocancelacion();
    }
    

    public function NuevoRegistro($data,$auth){
        $answer['estado']=false;
        $answer['data']=array();
        $answer['eca_id']=0;
        $answer['mensaje']="";
        $answer['mensaje_extra']="";
        #error_log(print_r($data,true));

        $registro = new Estcancelado();
        $registro->eca_estatus=2;
        $registro->eca_motivo=$data["eca_motivo"];
        $registro->cac_id=$data["cac_id"];
        $registro->ese_id=$data["ese_id"];
        $registro->usu_id=$auth["id"];

        if($registro->save()){
            $answer['estado']=true;
            $answer['data']=$registro;
            $answer['eca_id']=$registro->eca_id;
            $answer['mensaje']="";
            $answer['mensaje_extra']="";
        }else {error_log("NO SE PUDO REGISTRAR EL ESTCANCELACION");}

        return $answer;
    }

    public function SubirArchivoUno($data, $auth) {
        $date = new DateTime();
        $answer = []; 
        $answer["estado"]=false; 
        $answer["mensaje"]="error"; 
        $answer["titular"]="error"; 
        $answer["ruta_archivo_subido"]=""; 
        $answer["ruta_base"]="";
        $answer["is_uploaded"]=false; 
        $key_file=$this->key_input_file; 
        $countfiles = count($_FILES[$key_file]['name']);
        #error_log(print_r($_FILES[$key_file],true));
        # error_log("count files ".$countfiles);
        try {
            if (!file_exists($this->ruta_archivos)) {if (!mkdir($this->ruta_archivos, 0777, true)) {throw new Exception("Error al crear la carpeta");} }

                $filename = $_FILES[$key_file]['name'];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);
                $name_clean = $this->limpiar_string2($filename);
                $name_clean = substr($name_clean, 0, -3);
                $a = $this->limpiar_string('' . $date->format('Y-m-d-H-i-s') . '-' . strtolower($name_clean) . "." . $tipo);
                if (move_uploaded_file($_FILES[$key_file]['tmp_name'], $this->ruta_archivos . '/' . $a)) {
                
                 
                            $data_archivo['acc_nombre']=$a;
                            $data_archivo['acc_estatus']=2;
                            $data_archivo['ese_id']=$data['ese_id'];
                            $data_archivo['eca_id']=$data['eca_id'];
                                // $data['pol_archivo']=$a;
                            $respuesta_modelo_registar_sub_archivo=$this->obj_archivo_acc->NuevoRegistro($data_archivo);
                            if($respuesta_modelo_registar_sub_archivo['estado']==true)
                            {
                                // $answer[0]=2;
                                $answer["is_uploaded"]=true; 
                                $answer["estado"]=true; 
                                $answer["mensaje"]="ok"; 
                                $answer["titular"]="ok"; 
                                $answer["ruta_archivo_subido"]=$a; 
                                $answer["ruta_base"]=$this->ruta_archivos; 

                               # $auth = $this->session->get('auth');
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= "Subió el archivo ".$a." al estudio con clave ".$respuesta_modelo_registar_sub_archivo['acc_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo_registar_sub_archivo;
                                $databit['bit_modulo']="Archivoscancelacion";
                                $databit['ese_id']=$data['ese_id'];
                                $bitacora->NuevoRegistro($databit);
                            }
                            else{throw new Exception("ERROR SUBIR ARCHIVO");}
                        
                    
                }else {$answer["mensaje"]="error al mover el archivo de una carpeta a otra";}
        } catch (Exception $e) {
            error_log("Error al guardar subir archivo de cancelacion ".$e->getMessage());
            $answer["estado"]=false; 
            $answer["mensaje"]=$e->getMessage(); 
        }
        return $answer;
    }
    public function SubirArchivos($data, $auth) {
        $date = new DateTime();
        $answer = array(); 
        $answer["estado"] = false; 
        $answer["mensaje"] = "error"; 
        $answer["titular"] = "error"; 
        $answer["archivos_subidos"] = array(); 
        $answer["ruta_base"] = "";
        $key_file = $this->key_input_file; 
        
        try {
            if (!file_exists($this->ruta_archivos)) {
                if (!mkdir($this->ruta_archivos, 0777, true)) {
                    throw new Exception("Error al crear la carpeta");
                } 
            }
    
            $countfiles = count($_FILES[$key_file]['name']);
            $errores = array();
            for ($i = 0; $i < $countfiles; $i++) {
                $filename = $_FILES[$key_file]['name'][$i];
                $tipo = pathinfo($filename, PATHINFO_EXTENSION);
                $name_clean = $this->limpiar_string2($filename);
                $name_clean = substr($name_clean, 0, -3);
                $a = $this->limpiar_string('' . $date->format('Y-m-d-H-i-s') . '-' . strtolower($name_clean) . "." . $tipo);
    
                if (move_uploaded_file($_FILES[$key_file]['tmp_name'][$i], $this->ruta_archivos . '/' . $a)) {
                    $data_archivo['acc_nombre'] = $a;
                    $data_archivo['acc_estatus'] = 2;
                    $data_archivo['ese_id'] = $data['ese_id'];
                    $data_archivo['eca_id'] = $data['eca_id'];
                    $respuesta_modelo_registar_sub_archivo = $this->obj_archivo_acc->NuevoRegistro($data_archivo);
                    
                    if ($respuesta_modelo_registar_sub_archivo['estado'] == true) {
                        $answer["archivos_subidos"][] = array(
                            "nombre" => $a,
                            "ruta" => $this->ruta_archivos,
                            "acc_id" => $respuesta_modelo_registar_sub_archivo['acc_id']
                        );
                    } else {
                        $errores[] = "Error al subir el archivo ".$filename;
                    }
                } else {
                    $errores[] = "Error al mover el archivo ".$filename." de una carpeta a otra";
                }
            }
    
            if (empty($errores)) {
                $answer["estado"] = true; 
                $answer["mensaje"] = "Todos los archivos se han subido con éxito"; 
                $answer["titular"] = "ok"; 
            } else {
                $answer["mensaje"] = "Algunos archivos no se han podido subir correctamente"; 
                $answer["errores"] = $errores;
            }
        } catch (Exception $e) {
            error_log("Error al subir archivos: ".$e->getMessage());
            $answer["mensaje"] = $e->getMessage(); 
        }
    
        return $answer;
    }
    
    

    public function DesativarRegistro($ese_id, $auth) {
        $answer["estado"]=1; 
        $answer["mensaje"]="ok";
        $answer["titular"]="ok";
        $answer["eca_id"]=0;
        $fecha_y_hora = date("Y-m-d H:i:s");

        $registro = Estcancelado::findFirst(array(
            "ese_id = :ese_id: AND eca_estatus = 2",
            'bind' => array('ese_id' => $ese_id),
        ));
    
        if ($registro) {
            $answer["eca_id"]= $registro->eca_id;
            $registro->eca_estatus = 1;
            $registro->eca_fechacambio = $fecha_y_hora;
            $registro->usu_idcambio= $auth["id"];
            if ($registro->save()) {
                $answer["estado"]=2; 
            } else {$answer["estado"]=-2; }
        } 
        return $answer;
    }

    public function getEstatusNombre($valor) {
        $estatus = $this->estatus;
        if (isset($estatus[$valor])) {return $estatus[$valor];} 
        else { return "";}
    }
    public function buscarEncontrarEvidencia($eca_id = 0) {
        $answer=[];
        $answer["acc_id"]= "";
        $answer["acc_nombre"]= "";

        
        $registro = Archivocancelacion::findFirst([
            "eca_id = :eca_id:",
            'bind' => ['eca_id' => $eca_id],
        ]);
        if ($registro) {
            $answer["acc_id"] = $registro->acc_id;
            $answer["acc_nombre"]= $registro->acc_nombre;

        }
    
        return $answer;
    }
    
    

}
