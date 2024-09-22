<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Transporte
 */
class Transporte extends Model
{
    public $tra_id;
    public $tra_preaprobado;
    public $tra_solicitado;
    public $tra_aprobado;
    public $tra_estatus;

    /**
    *[CompararMontoTrasnporte compara el monto del transporte solicitado con el monto pre_aprobado]
    * @param  $tra_id
    * @return[boolean] [true si el numero es menor o igual monto preaprobado] [false si el monto es mayor] [mensaje de bitacora]
    */

    public function ComprobarMontoSolicitado($tra_id)
    {
        $mensaje_bitacora='';
        $estado=-1;
        $transporte =Transporte::findFirstBytra_id($tra_id);   
  
        if($transporte)
        {          
                    if ($transporte->tra_solicitado <= $transporte->tra_preaprobado) 
                    {
                        $fecha_y_hora = date("Y-m-d H:i:s");
                        $transporte->tra_aprobado=$transporte->tra_solicitado;
                        $transporte->tra_estatus='3';
                        $transporte->aprobadousu_id=0;
                        $transporte->tra_fechaaprobado=$fecha_y_hora;
                        $mensaje_bitacora ='Se ha aprobado automáticamente el monto de transporte solicitado, el monto aprobado es: $'.$transporte->tra_aprobado;
                        $estado=$transporte->save();
                    }
                    else
                    {
                        $transporte->tra_estatus='2';
                        $mensaje_bitacora ='Solicitó transporte con un monto de: $'.$transporte->tra_solicitado;
                        $estado=$transporte->save();
                        ;
                    }
       }
       return ['respuesta'=>$estado,'mensaje_bitacora'=>$mensaje_bitacora];
    }
    public function ResetearTransporteEtapaInical()
    {
        $this->tra_solicitado=null;
        $this->tra_aprobado=null;
        $this->tra_estatus=1;
        $this->asignausu_id=null;
        $this->tra_fechainvestigador=null;
        $this->tra_fechaaprobado=null;
        $this->tra_origen=null;
        $this->tra_destino=null;
        $this->tra_comentario=null;

    }
    public function verificar_estudio_tiene_transporte_asignado_activo($ese_id)
    {
        $transporte_buscar=Transporte::query()
                        ->where("ese_id=".$ese_id.' and tra_estatus >= 0')
                        ->execute();
        // $transporte_buscar=$transporte_estatus[0];
        if(count($transporte_buscar)>0){
            return ['estado'=>2,'mensaje'=>'El estudio SI tiene asignado un transporte'];
        }else{
            return ['estado'=>-2,'mensaje'=>'El estudio NO tiene asignado un transporte'];
        }
       
    }
    public function asignar_transporte($ese_id,$data){

        $this->ese_id=$ese_id;
        $this->tra_preaprobado=$data['pre_aprobado'];
        $this->investigadorusu_id=$data['inv_id'];
        $this->asignausu_id=$data['asignausu_id'];
        $this->tra_estatus=1;
        if($this->create()){
            return ['estado'=>2,'mensaje'=>'se ha creado correctamente','tra_id'=>$this->tra_id,'tra_preaprobado'=>$this->tra_preaprobado];
        }else{
            return ['estado'=>-2,'mensaje'=>'error al procesar los datos','tra_id'=>$this->tra_id,'tra_preaprobado'=>$this->tra_preaprobado];

        }

    }

    public function asignarautorizado_transporte($ese_id,$data){

        $this->ese_id=$ese_id;
        $this->tra_preaprobado=$data['pre_aprobado'];
        $this->tra_solicitado=$data['pre_aprobado'];
        $this->tra_aprobado=$data['pre_aprobado'];
        $this->investigadorusu_id=$data['inv_id'];
        $this->tra_estatus=3;
        $this->asignausu_id=$data['asignausu_id'];
        $this->aprobadousu_id=$data['aprobadousu_id'];
        $this->tra_fechainvestigador=$data['tra_fechainvestigador'];
        $this->tra_fechaaprobado=$data['tra_fechaaprobado'];
        $this->tra_comentarioadmin=$data['tra_comentarioadmin'];
        $this->tra_origen=$data['tra_origen'];
        $this->tra_destino=$data['tra_destino'];
        if($this->create()){
            return ['estado'=>2,'mensaje'=>'se ha creado correctamente','tra_id'=>$this->tra_id,'tra_preaprobado'=>$this->tra_preaprobado];
        }else{
            return ['estado'=>-2,'mensaje'=>'error al procesar los datos','tra_id'=>$this->tra_id,'tra_preaprobado'=>$this->tra_preaprobado];
        }
    }


    public function buscarTransporteSolicitado($ese_id=0){


        $tra_data=Transporte::query()
        ->where('tra_estatus > 0 and ese_id='.$ese_id)
        ->limit(1)
        ->execute();
        if(count($tra_data)>0){
            $answer['estado']=true;
            $answer['data']=$tra_data;
            $answer['tra_id']=$tra_data[0]->tra_id;
        }else{
            $answer['estado']=false;
        }
        return $answer;
    }

    public function desActivarTransporte($tra_id=0){
        $registro= Transporte::findFirstBytra_id($tra_id);
        $registro->tra_estatus=-2;
        $registro->tra_solicitado=null;

       

        if($registro->update()){
            $answer['estado']=true;
          
        }else{
            $answer['estado']=false;

        }

        return $answer;
    }

    public function desActivarLimpiarCamposTransporte($tra_id=0){
        $registro= Transporte::findFirstBytra_id($tra_id);
        $registro->tra_estatus=-2;
        $registro->tra_solicitado=null;
        $registro->tra_aprobado=null;
        $registro->asignausu_id=null;
        $registro->tra_fechainvestigador=null;
        $registro->tra_fechaaprobado=null;
        $registro->tra_origen=null;
        $registro->tra_destino=null;
        $registro->tra_comentario=null;
       

        if($registro->update()){
            $answer['estado']=true;
          
        }else{
            $answer['estado']=false;

        }

        return $answer;
    }
    /**verificarSiEseSolicitadoSiEstaAsignado verifica que el transporte que tenga asigado ya este solicitado
     * si el campo tra_solicitado esta vacio significa que no esta solicitado
     */
    public function buscarTransporteSolicitadoYVerificarQueYaEsteSolicitado($ese_id){
        $answer=[];
        $answer['estado']=false;

        //$registro= Transporte::findFirstByese_id($ese_id);
        $tra_data=Transporte::query()
        ->where('tra_estatus > 0 and ese_id='.$ese_id)
        ->limit(1)
        ->execute();
        if(count($tra_data)>0){
            if($tra_data[0]->tra_solicitado==null){
                $answer['estado']=true;
                $answer['data']=$tra_data[0];
                $answer['tra_id']=$tra_data[0]->tra_id;
            }
        }
        return $answer;
    }
    public function getEstatus($value=0){
        $answer="";
        switch ($value) {
            case '1':
                $answer="SIN COMPROBAR";
                break;
            case '2':
                $answer="SOLICITADO";
                break;
            case '3':
                $answer="PENDIENTE";
                break;
            case '-2':
                $answer="CANCELADO";
                break;
            default:
                $answer="";
                break;
        }
        return $answer;
    }


    

    


    
}