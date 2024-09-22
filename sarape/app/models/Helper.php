<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de ayuda generañ
 */
class Helper extends Model
{
    public function CrearEncontrarRegistroSeccionCambioEstatusExc($exc_estatus,$exc_id,$auth,$data){
        $answer['estado']=-2;
        $answer['mensaje']='error crear o encontrar automatico';
        $answer['data']=[];
        $answer['titulo_seccion']="SIN INFO";
        
    try {

            switch ($exc_estatus) {
                case 1:
                    $registro = Cita::query()
                    ->where('Cita.cit_estatus>=1 AND Cita.exc_id=' . $exc_id)
                    ->limit(1)
                    ->execute();
                // error_log(boolval($registro));

                        if(count($registro)>0){
                            $answer['estado']=2;
                            $answer['data']=$registro[0];
                            $answer['titulo_seccion']="Cita";
                            $answer['mensaje']=',se encontró un registro de la sección CITA con folio '.$registro[0]->cit_id;


                        }else{
                            $registro=new Cita();
                            $registro->cit_estatus=2;
                            $registro->exc_id=$exc_id;
                            
                            if($registro->save()){
                                $answer['estado']=2;
                                $answer['mensaje']='ok';
                                $answer['data']=$registro;
                                $answer['titulo_seccion']="Cita";
                                $answer['mensaje']=',se creó un registro de la sección CITA con folio '.$registro->cit_id;

                            }else{
                                throw new Exception("Error al actualizar/crear de Cita ");

                            }
                        }

                    break;
                case 2:
                    //error_log("entro a referencias");
                    $registro = Seccionlaboral::query()
                    ->where('Seccionlaboral.sel_estatus>=1 AND Seccionlaboral.exc_id=' . $exc_id)
                    ->limit(1)
                    ->execute();
                // error_log(boolval($registro));

                        if(count($registro)>0){
                            $answer['estado']=2;
                            $answer['data']=$registro[0];
                            $answer['titulo_seccion']="Seccionlaboral";
                            $answer['mensaje']=',se creó un registro de la  Sección laboral con folio '.$registro[0]->sel_id;


                        }else{
                            $registro=new Seccionlaboral();
                            $registro->sel_estatus=2;
                            $registro->exc_id=$exc_id;
                            
                            if($registro->save()){
                                $answer['estado']=2;
                                $answer['mensaje']=',se encontró un registro de la  Sección laboral con folio '.$registro->sel_id;
                                $answer['data']=$registro;
                                $answer['titulo_seccion']="Seccionlaboral";
                            }else{
                                throw new Exception("Error al actualizar/crear de Seccionlaboral ");

                            }


                        }


                    break;
                case 3:
                    $registro = Psicometria::query()
                    ->where('Psicometria.psi_estatus>=1 AND Psicometria.exc_id=' . $exc_id)
                    ->limit(1)
                    ->execute();

                        if(count($registro)>0){
                            $answer['estado']=2;
                            $answer['mensaje']=',se encontró un registro de la  Psicometría con folio '.$registro[0]->psi_id;                       
                            $answer['data']=$registro[0];
                            $answer['titulo_seccion']="Psicometria";

                        }else{
                        // error_log(print_r($registro));
                            $registro=new Psicometria();
                            $registro->psi_estatus=2;
                            $registro->exc_id=$exc_id;
                            $registro->usu_idregistro=$auth["id"];

                            if($registro->save()){
                                
                                $answer['estado']=2;
                                $answer['mensaje']=',se creo un registro de la  Psicometría con folio '.$registro->psi_id;                        
                                $answer['data']=$registro;
                                $answer['titulo_seccion']="Psicometria";
                            }else{
                                throw new Exception("Error al actualizar/crear de Psicometria ");

                            }


                        }

                    break;
                case 4:
                    $registro = Entrevista::query()
                    ->where('Entrevista.ent_estatus>=1 AND Entrevista.exc_id=' . $exc_id)
                    ->limit(1)
                    ->execute();

                        if(count($registro)>0){
                            $answer['estado']=2;
                            $answer['mensaje']=',se encontró  un registro de la  Entrevista con folio '.$registro[0]->ent_id;                        
                            $answer['data']=$registro[0];
                            $answer['titulo_seccion']="Entrevista";

                        }else{
                            $registro=new Entrevista();
                            $registro->ent_estatus=2;
                            $registro->exc_id=$exc_id;
                        ///  $registro->usu_idregistro=$auth["id"];

                            if($registro->save()){
                                $answer['estado']=2;
                                $answer['mensaje']=',se creo un registro de la  Entrevista con folio '.$registro->ent_id;                        
                                $answer['data']=$registro;
                                $answer['titulo_seccion']="Entrevista";
                            }else{
                                throw new Exception("Error al actualizar/crear de Entrevista ");

                            }


                        }
                    break;
                case 6:
                    $answer['estado']=1;

                    $registro = Facturacion::query()
                    ->where('Facturacion.fat_estatus=2 AND Facturacion.exc_id=' . $exc_id)
                    ->limit(1)
                    ->execute();

                    //error_log("si llego a fat");
                        if(count($registro)>0){
                            
                            $answer['estado']=2;
                            $answer['mensaje']=',se encontró  un registro de la  Facturación  con folio '.$registro[0]->fat_id;                        
                            $answer['data']=$registro[0];
                            $answer['titulo_seccion']="Facturación";

                        }else{
                            $registro=new Facturacion();
                            $registro->fat_observacion=$data['comentario'];
                            $registro->fat_registro=date("Y-m-d H:i:s");;
                            $registro->fat_estatus=2;
                            $registro->exc_id=$exc_id;
                            $registro->usu_id=$auth['id'];
                    
                            if($registro->save()){
                                $answer['estado']=2;
                                $answer['mensaje']=',se creo un registro de la  Facturacion con folio '.$registro->fat_id;                        
                                $answer['data']=$registro;
                                $answer['titulo_seccion']="Facturación";
                                //error_log("si jala");

                            }else{
                                throw new Exception("Error al actualizar/crear de Facturación ");

                            }       


                        }

                    break;
        
                
                default:
                    $answer['estado']=1;
                    break;
            }
            
        } catch (\Exception $e) {
            // Aquí capturas cualquier excepción lanzada durante la ejecución del bloque try
            $errorDetails = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ];

            // Puedes hacer lo que quieras con los detalles del error, como registrarlos, imprimirlos, etc.
            // Por ejemplo, para imprimirlos:
            error_log("Error: " . $errorDetails['message']);
            error_log("File: " . $errorDetails['file']);
            error_log("Line: " . $errorDetails['line']);
            error_log("Trace: " . $errorDetails['trace']);

            // Luego, puedes manejar el flujo de tu aplicación según el error capturado.
            // Por ejemplo, podrías establecer un mensaje de error personalizado en $answer y cambiar el estado.
            $answer['estado'] = -2;
            $answer['mensaje'] = 'Ocurrió un error en la función.';
            $answer['data'] = [];
            $answer['titulo_seccion'] = 'SIN INFO';
            
        }



        return $answer;
      
    }
    public function autorizo_text($value){
        switch ($value) {
            case '1':
                return "AUTORIZÓ";
                break;
            case '0':
                return "NO AUTORIZÓ";
                break;
           
        }

    }

    public function mandarAGarantia($data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='error crear o encontrar automatico';
        $answer['data']=[];
        $answer['titulo_seccion']="SIN INFO";
      

        //validamos que el numero de garantias no se alla superado
        $registro_vac=Vacante::findFirst($data["vac_id"]);
        $garantia = Garantia::query()
        ->leftjoin('Expedientecan','exc.vac_id=Vacante.vac_id','exc')
        ->where('Garantia.gar_estatus>=1 AND vac.vac_id=' . $vac_id)
        ->execute();

        $count_gar=count($garantia);
        if( $count_gar > $registro_vac->num){

        }
        ///mandamos a garantia


        //registramos en garantias

        //retornamos

    }
    

 
}