<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Facturacion
 */
class Facturacion extends Model
{

    public function NuevoRegistro($data,$auth){
        $registro= new Facturacion();
        $registro->fat_observacion=$data['gar_observacion'];
        $registro->fat_registro=$data['gar_registro'];
        $registro->fat_estatus=2;
        $registro->exc_id=$data['exc_id'];
        $registro->usu_id=$auth['id'];

        if($registro->save())
            return  $repuesta=['estado'=>2,'fat_id'=> $registro->fat_id,'fat_id'=> $registro->exc_id];
        else
            return  $repuesta=['estado'=>-2];
        
    }

    public function ActualizarFatMandoAGar($exc_id, $auth){
        try {
            $answer = [];
            $answer["estado"] = -2;
            $answer["mensaje"] = "normal";
            $fecha_y_hora = date("Y-m-d H:i:s");
            $condicion_sql = "exc_id=" . $exc_id . ' AND fat_estatus=2';
            $facturacion_exc = Facturacion::query();
            $facturacion_exc = $facturacion_exc->where($condicion_sql)->execute();
           
            if (count($facturacion_exc) > 0) {
                $registro = Facturacion::findFirst($facturacion_exc[0]->fat_id);
                if (!$registro) {
                    return $repuesta = ['estado' => -2, "mensaje" => "no se encontró la fat"];
                }
                $registro->usu_idactualizo = $auth['id'];
                $registro->fat_estatus = -2;
                if ($registro->update()) {
                    return $repuesta = ['estado' => 2, 'fat_id' => $registro->fat_id, 'exc_id' => $registro->exc_id];
                } else {
                    // Registro de error en el log
                    $error_msg = "Error al actualizar el registro en ActualizarFatMandoAGar: " . print_r($registro->getMessages(), true);
                    $error_line = __LINE__;
                    error_log("Error en línea $error_line: $error_msg");
                    return $repuesta = ['estado' => -2];
                }
            } else {
                return $repuesta = ['estado' => -2, 'mensaje' => 'No se encontraron registros para actualizar'];
            }
        } catch (\Exception $e) {
            // Registro de error en el log
            $error_msg = "Excepción en facturación model : " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            return ['estado' => -2, 'mensaje' => 'Error en la función: ' . $e->getMessage()];
        }
    }

    public function setUpdateOrCreateData($exc_id,$data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='';
        $fecha_y_hora = date("Y-m-d H:i:s");
        $query = $this->modelsManager->createBuilder()
            ->from('Facturacion')
            ->where('exc_id = :exc_id: AND fat_estatus >= 0')
            ->getQuery()
            ->execute([
                'exc_id' => $exc_id,
            ]);

        $registros = $query->getFirst();
        if(!$registros){
            $registro = new Facturacion();
            $registro->fat_estatus=2;
            $registro->usu_id=$auth["id"]; 

        }else{
            $registro=$registros;
        }
        $registro->fat_observacion=$data['fat_observacion'];
        if (!empty($data['fat_fechaingreso'])) {
            $registro->fat_fechaingreso = $data['fat_fechaingreso'];
        }        
        $registro->fat_montofacturar=$data['fat_montofacturar'];
        $registro->fat_sueldo=$data['fat_sueldo'];
        $registro->fat_factor=$data['fat_factor'];
        $registro->fat_reqfactura=$data['fat_reqfactura'];

        $registro->fat_fechaactualizo=$fecha_y_hora;        
        $registro->exc_id=$exc_id; 
        $registro->vac_estatus=$data["vac_estatus"]; 
        $registro->usu_idactualizo=$auth["id"]; 

        if($registro->save()){
            $answer['estado']=2;
            $answer['mensaje']=' actualizo datos de la entrevista';
            $answer['fat_id']=$registro->fat_id;
            $answer['exc_id']=$registro->exc_id;

        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error';
        }

        return $answer;
        
    }
    
    public function getEstatusTexto($estatus)
    {
        switch(trim($estatus))
        {   
            case "0":
                return "NO";
            break;
            case 1:
                return "SI";
            break;
            case "":
                return "";
            break;
            default:
                return "ERROR";
            break;
        }
    }

    public function  desactivarFatAsociadaByExcId($exc_id=0,$auth=[]){
        try {
            $answer = [];
            $answer["estado"] = -2;
            $answer["mensaje"] = "error";
            $fecha_y_hora = date("Y-m-d H:i:s");
            $condicion_sql = "exc_id=" . $exc_id . ' AND fat_estatus=2';
            $facturacion_exc = Facturacion::query();
            $facturacion_exc = $facturacion_exc->where($condicion_sql)->execute();
           
            if (count($facturacion_exc) > 0) {
                $registro = Facturacion::findFirst($facturacion_exc[0]->fat_id);
                if (!$registro) {
                    return $repuesta = ['estado' => -2, "mensaje" => "no se encontró la fat"];
                }
                $registro->fat_fechacancelacion=$fecha_y_hora;
                $registro->usu_idcancelo = $auth['id'];
                $registro->fat_estatus = -2;
                if ($registro->update()) {
                    return $repuesta = [
                        'estado' => 2,
                        'fat_id' =>$registro->fat_id,
                        'exc_id' =>  $registro->exc_id,
                        'mensaje' => 'se cancelo el registró de facturación con ID interno '.$registro->fat_id
                    ];
                } else {
                    // Registro de error en el log
                    $error_msg = "Error al actualizar el registro en desactivarFatAsociadaByExcId: " . print_r($registro->getMessages(), true);
                    $error_line = __LINE__;
                    error_log("Error en línea $error_line: $error_msg");
                    return $repuesta = ['estado' => -2];
                }
            } else {
                return $repuesta = ['estado' => -2, 'mensaje' => 'No se encontraron registros para actualizar'];
            }
        } catch (\Exception $e) {
            // Registro de error en el log
            $error_msg = "Excepción en facturación model : " . $e->getMessage();
            $error_line = __LINE__;
            error_log("Error en línea $error_line: $error_msg");
            return ['estado' => -2, 'mensaje' => 'Error en la función: ' . $e->getMessage()];
        }
    }

    public function generearTemplateCorreoFacturacion($data_vac,$data_exp,$data_fat,$template){
        $template_html=$template;

        return $template_html;

    }
    
}