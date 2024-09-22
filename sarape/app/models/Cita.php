<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Cita
 */
class Cita extends Model
{
    /**
     * Crea un nuevo registro de cita general.
     *
     * @param array $data_cit Los datos de la cita a crear.
     *                        - cit_observaciones: Las observaciones de la cita.
     *                        - cit_fecha: La fecha de la cita.
     *                        - cit_hora: La hora de la cita.
     *                        - med_id: El ID del médico.
     *                        - tic_id: El ID del tipo de cita.
     *                        - can_id: El ID del candidato.
     *                        - vac_id: El ID de la vacante.
     * @param array $auth Los datos de autenticación.
     *                    - id: El ID del usuario autenticado.
     * @return array El resultado de la función.
     *               - estado: El estado de la operación. (2 para éxito, -2 para error)
     *               - mensaje: El mensaje asociado al resultado.
     *               - cit_id: El ID de la cita creada en caso de éxito.
     */

    public function NuevoGeneral($data_cit,$auth){
            $answer['estado']=-2;
            $answer['mensaje']='';
    
            $registro_cit=new Cita();
            $registro_cit->cit_observaciones=$data_cit['cit_observaciones'];
            $registro_cit->cit_fecha=$data_cit['cit_fecha'];
            $registro_cit->cit_hora=$data_cit['cit_hora'];
            $registro_cit->med_id=$data_cit['med_id'];
            $registro_cit->tic_id=$data_cit['tic_id'];
           
            $registro_cit->usu_idalta=$auth['id'];
            $registro_cit->exc_id=$data_cit['exc_id'];
           //$registro_cit->vac_id=$data_cit['vac_id'];
        /*
           $registro_cit->cit_puestosimilar = $data_cit['cit_puestosimilar'];
           $registro_cit->cit_estabilidalaboral = $data_cit['cit_estabilidalaboral'];
           $registro_cit->cit_responsabilidad = $data_cit['cit_responsabilidad'];
           $registro_cit->cit_concimientostec = $data_cit['cit_concimientostec'];
           $registro_cit->cit_puntualidad = $data_cit['cit_puntualidad'];
           $registro_cit->cit_acordeasueldoofrecido = $data_cit['cit_acordeasueldoofrecido'];

           $registro_cit->cit_presentacionapariencia = $data_cit['cit_presentacionapariencia'];
           $registro_cit->cit_disponibilidad = $data_cit['cit_disponibilidad'];
           $registro_cit->cit_proactivo = $data_cit['cit_proactivo'];
           $registro_cit->cit_concimientostec = $data_cit['cit_concimientostec'];
    */
            $registro_cit->cit_estatus=1;
    
            if($registro_cit->save()){
                $answer['estado']=2;
                $answer['mensaje']='ok';
                $answer['cit_id']=$registro_cit->cit_id;
            }else{
                $answer['estado']=-2;
                $answer['mensaje']='error';
    
            }
    
            return $answer;
    
    
    
    
        }

    public function ActualizarGeneral($data_cit, $auth)
    {
        $answer['estado'] = -2;
        $answer['mensaje'] = '';
    
        // Obtener el registro existente a actualizar
        $registro_cit = Cita::findFirst($data_cit['cit_id']);
    
        if ($registro_cit) {
            // Actualizar los campos relevantes con los nuevos valores
            $registro_cit->cit_observaciones = $data_cit['cit_observaciones'];
           // $registro_cit->cit_observaciones =nl2br($data_cit['cit_observaciones']);

            $registro_cit->cit_fecha = $data_cit['cit_fecha'];
            $registro_cit->cit_hora = $data_cit['cit_hora'];
            $registro_cit->med_id = $data_cit['med_id'];
            $registro_cit->tic_id = $data_cit['tic_id'];
            $registro_cit->usu_idactualizo = $auth['id'];
            $registro_cit->exc_id = $data_cit['exc_id'];

            //valoracion 
            
            $registro_cit->cit_puestosimilar = $data_cit['cit_puestosimilar'];
            $registro_cit->cit_estabilidalaboral = $data_cit['cit_estabilidalaboral'];
            $registro_cit->cit_responsabilidad = $data_cit['cit_responsabilidad'];
            $registro_cit->cit_concimientostec = $data_cit['cit_concimientostec'];
            $registro_cit->cit_puntualidad = $data_cit['cit_puntualidad'];
            $registro_cit->cit_acordeasueldoofrecido = $data_cit['cit_acordeasueldoofrecido'];

            

            $registro_cit->cit_presentacionapariencia = $data_cit['cit_presentacionapariencia'];
            $registro_cit->cit_disponibilidad = $data_cit['cit_disponibilidad'];
            $registro_cit->cit_proactivo = $data_cit['cit_proactivo'];
            $registro_cit->cit_concimientostec = $data_cit['cit_concimientostec'];

            
            $registro_cit->cit_actualizo =  date("Y-m-d H:i:s");

           
            if ($registro_cit->update()) {
                $answer['estado'] = 2;
                $answer['mensaje'] = 'ok';
                $answer['cit_id'] = $registro_cit->cit_id;
            } else {
                $answer['estado'] = -2;
                $answer['mensaje'] = 'error actualizar cita';
            }
        } else {
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Registro no encontrado';
        }
    
        return $answer;
    }
    

    

}