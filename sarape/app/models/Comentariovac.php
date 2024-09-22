<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla comentarios de vacante
 */
class Comentariovac extends Model
{
    public function NuevoRegistro($data = [], $auth)
    {
        $answer['estado'] = -2;
        $answer['mensaje'] = 'error';
    
        try {
            $registro = new Comentariovac();
            $registro->cmv_comentario = $data['cmv_comentario'];
            $registro->cmv_estatus = 2;
            $registro->cmv_vista = $data["cmv_vista"];
            $registro->usu_id = $auth['id'];
            $registro->vac_id = $data['vac_id'];
            $registro->vac_estatus = $data["vac_estatus"];
    
            if ($registro->save()) {
                $answer['estado'] = 2;
                $answer['mensaje'] = 'ok';
                $answer['cmv_id'] = $registro->cmv_id;
                $answer['vac_id'] = $registro->vac_id;
                $answer['mensaje_extra_bitacora']=', se agregó un comentarió con ID interno '.$registro->cmv_id;
            }
        } catch (\Exception $e) {
            // Registra el error en el archivo de registro
            error_log("Error en NuevoRegistro: " . $e->getMessage());
            $answer['mensaje'] = 'Error interno en el servidor';
        }
    
        return $answer;
    }

}
