<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla candidato
 */
class Candidato extends Model
{
    /**
     * Crea un nuevo registro de candidato.
     *
     * @param array $data_can Arreglo con los datos del candidato:
     *                        - can_curp: CURP del candidato.
     *                        - can_nombre: Nombre del candidato.
     *                        - can_primerapellido: Primer apellido del candidato.
     *                        - can_segundoapellido: Segundo apellido del candidato.
     *                        - can_correo: Correo electrónico del candidato.
     *                        - can_telefono: Teléfono del candidato.
     *                        - can_celular: Celular del candidato.
     * @param array $auth Arreglo con los datos de autenticación:
     *                    - id: ID del usuario que realiza el registro.
     *
     * @return array Arreglo con el resultado de la operación:
     *               - estado: Estado de la operación. Valor -2 si hay un error, 2 si se realiza correctamente.
     *               - mensaje: Mensaje asociado al estado.
     *               - can_id: ID del candidato creado en caso de éxito.
     */
    public function NuevoGeneral($data_can,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='';

        $registro_can=new Candidato();
        $registro_can->can_curp=trim($data_can['can_curp']);
        $registro_can->can_nosegsocial=trim($data_can['can_nosegsocial']);
        $registro_can->can_nombre = trim($data_can['can_nombre']);
        $registro_can->can_primerapellido = trim($data_can['can_primerapellido']);
        $registro_can->can_segundoapellido = trim($data_can['can_segundoapellido']);        
        $registro_can->can_correo=$data_can['can_correo'];
        $registro_can->can_telefono=$data_can['can_telefono'];
        $registro_can->can_celular=$data_can['can_celular'];        
        $registro_can->usu_idalta=$auth['id'];
        
        $registro_can->can_estatus=2;

        if($registro_can->save()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['can_id']=$registro_can->can_id;
        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error';

        }

        return $answer;




    }
    /**
     * Verifica si un candidato tiene asignada una cita relacionada con una vacante específica.
     *
     * @param int $can_id  ID de la candidato a verificar.
     * @param int   $vac_id    ID de la vacante a verificar.
     * @return array           Arreglo con el resultado de la verificación ("estado" y "mensaje").
     */

     public function candidatoTieneCitaAsignada($can_id, $vac_id)
     {
         $can_id =$can_id;
         $answer["can_id"] = $can_id;
         $answer = [
             "estado" => false,
             "mensaje" => "No se encontró",
             "can_id" => 0

         ];
             // Verificar si el candidato tiene un expediente relacionado
             $expediente = Expedientecan::query()
                 ->where('can_id = :can_id: AND exc_estatus >= 0 AND vac_id = :vac_id:')
                 ->bind([
                 'can_id' => $can_id,
                 'vac_id' => $vac_id
                 ])
                 ->execute();
     
             if (count($expediente) > 0) {
                    $expediente = $expediente[0];

        
                    // Verificar si el expediente tiene una cita asignada activa relacionada con la vacante
                    $cita = Cita::query()
                        ->where('exc_id = :exc_id: AND cit_estatus > 0')
                        ->bind([
                            'exc_id' => $expediente->exc_id
                        ])
                        ->execute();
        
                    if (count($cita) > 0) {
                        $cita = $cita[0];
                        

                        // Ya hay una cita asignada para este expediente relacionado con la vacante
                        $answer["estado"] = true;
                        $answer["mensaje"] = "El candidato ya está inscrito en la misma vacante con ID " . $vac_id . " , por lo cual ya tiene asignada una cita con el ID " . $cita->cit_id . ", el candidato con el ID " . $can_id . ", y el expediente con el ID " . $expediente->exc_id;
                    }
             
            }
     
         return $answer;
     }


     public function buscarCandidatoActivoByCurp($can_curp){
        $answer["estado"]=false;
        $answer["mensaje"]="no esta el candidato";

        $candidato = Candidato::query()
        ->where('can_curp = :can_curp: AND can_estatus = 2')
        ->bind(['can_curp' => $can_curp])
        ->execute();

        if(count($candidato)>0){
            $answer["estado"]=true;
            $answer["mensaje"]="OK";
            $answer["data"]=$candidato[0];
            $answer["can_id"]=$candidato[0]->can_id;


        }

        return $answer;

     }



    public function ActualizarGeneral($data_can, $auth)
    {
        $answer['estado'] = -2;
        $answer['mensaje'] = '';   
        // Actualizar los campos relevantes con los nuevos valores
        $this->can_curp = trim($data_can['can_curp']);
        $this->can_nosegsocial=trim($data_can['can_nosegsocial']);
        $this->can_nombre = trim($data_can['can_nombre']);
        $this->can_primerapellido = trim($data_can['can_primerapellido']);
        $this->can_segundoapellido = trim($data_can['can_segundoapellido']);        
        $this->can_correo = $data_can['can_correo'];
        $this->can_telefono = $data_can['can_telefono'];
        $this->can_celular = $data_can['can_celular'];

        if ($this->update()) {
            $answer['estado'] = 2;
            $answer['mensaje'] = 'ok';
            $answer['can_id'] = $this->can_id;
        } else {
            $answer['estado'] = -2;
            $answer['mensaje'] = 'error';
        }
    

         return $answer;
    }

    public function ActualizarGeneral_NOVALIDADO($data_can, $auth)
    {
        $answer['estado'] = -2;
        $answer['mensaje'] = '';   
        // Actualizar los campos relevantes con los nuevos valores
        if (isset($data_can['can_curp'])) {
            $this->can_curp = trim($data_can['can_curp']);
        }
        
        if (isset($data_can['can_nosegsocial'])) {
            $this->can_nosegsocial = trim($data_can['can_nosegsocial']);
        }
        
        if (isset($data_can['can_nombre'])) {
            $this->can_nombre = trim($data_can['can_nombre']);
        }
        
        if (isset($data_can['can_primerapellido'])) {
            $this->can_primerapellido = trim($data_can['can_primerapellido']);
        }
        
        if (isset($data_can['can_segundoapellido'])) {
            $this->can_segundoapellido = trim($data_can['can_segundoapellido']);
        }
        
        if (isset($data_can['can_correo'])) {
            $this->can_correo = $data_can['can_correo'];
        }
        
        if (isset($data_can['can_telefono'])) {
            $this->can_telefono = $data_can['can_telefono'];
        }
        
        if (isset($data_can['can_celular'])) {
            $this->can_celular = $data_can['can_celular'];
        }
        

        if ($this->update()) {
            $answer['estado'] = 2;
            $answer['mensaje'] = 'ok';
            $answer['can_id'] = $this->can_id;
        } else {
            $answer['estado'] = -2;
            $answer['mensaje'] = 'error';
        }
    

         return $answer;
    }

    public function buscarCoincidenciasCandidatoExpediente($can_id=0){
        $answer["data_exc"]=[];
        $answer["count_exc"]=0;
        $answer["estado"]=2;
        $answer["mensaje"]="ok";
        $answer["titulo"]="ok";

            $condicion_sql_vac = "can.can_id";
            $regs = new Builder();
            $regs = $regs
            ->columns(array(
                'exc.exc_id'
            ))
            ->addFrom('Candidato', 'can')
            ->leftjoin('Expedientecan','exc.can_id=can.can_id','exc')
            ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac');

            $regs = $regs->where($condicion_sql_vac);
            $reg = $regs->getQuery()->execute();

        $answer["count_exc"]=count($reg);
        $answer["data_exc"]=$reg;
        return $answer;

    }

     


}