<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla cita
 */
class Cita extends Model
{  
 
    public function getEstatusTexto($estatus)
    {
        
        switch ($estatus) {
            case 1:
                return "ACTUAL";
                break;
            case 2:
                return "REAGENDADA ";
                break;
            case 3:
                return "FINALIZADA";
                break;
            case 4:
                return "VENCIDA";
                break;
            default:
                return "";
        }
    }
    public function getEstatusBandera($estatus)
    {
        
        switch($estatus)
        {   
            case -2:
            return "badge-danger";
            break;

            case 1:
            return "badge-info";
            break;

            case 2:
            return "badge-warning";
            break;

            case 3:
            return "badge-success";
            break;
            
            case 4:
                return "badge-danger";
                break;

         
        }
    }

    public function getEstatusParaReAgendar($estatus)
    {
        
        switch($estatus)
        {   
            case 1:
              return true;
            break;

            default:
              return false;


         
        }
    }

    public function NuevoRegistro($data,$usu_data){
        $registro_cit=new Cita();
        $fecha_y_hora = date("Y-m-d H:i:s");

        $registro_cit->cit_fecha=$data['cit_fecha'];
        $registro_cit->cit_hora=$data['cit_hora'];
        $fecha_y_hora_format = date("Y-m-d h:i A");

        if($data['cit_comentario']!=null){
            $registro_cit->cit_comentario=trim($usu_data['nombre_completo']).'('.$fecha_y_hora_format.'): '.trim($data['cit_comentario']).';';
        }
        
        $registro_cit->usu_id=$usu_data['id'];
        $registro_cit->cit_cambioestatus=$fecha_y_hora ;
        $registro_cit->ese_id=$data['ese_id'];
        $registro_cit->cit_estatus=1;

        if($registro_cit->save())
            return  $respuesta=['estado'=>2,'cit_id'=> $registro_cit->cit_id,'ese_id'=>$registro_cit->ese_id];
        else
            return  $respuesta=['estado'=>-2];

    }

    public function AgregarComentario($data,$usu_data){
        $fecha_y_hora_format = date("Y-m-d h:i A");

        $this->cit_comentario=trim($usu_data['nombre_completo']).'('.$fecha_y_hora_format.'): '.trim($data['cit_comentario']).';'.'<br>'.$this->cit_comentario;

        if($this->update())
            return  $respuesta=['estado'=>2,'cit_id'=> $this->cit_id,'ese_id'=>$this->ese_id];
        else
            return  $respuesta=['estado'=>-2];

    }
    
    public function CambiarEstatusAReAgendada($data,$usu_data){
        $fecha_y_hora = date("Y-m-d H:i:s");
        $fecha_y_hora_format = date("Y-m-d h:i A");

        $this->cit_comentario=trim($usu_data['nombre_completo']).'('.$fecha_y_hora_format.'): '.trim($data['cit_comentario']).';'.'<br>'.$this->cit_comentario;
        $this->cit_estatus=2;
        $this->usu_idcambioestatus=$usu_data['id'];
        $this->cit_cambioestatus=$fecha_y_hora ;

        if($this->update())
            return  $respuesta=['estado'=>2,'cit_id'=> $this->cit_id,'ese_id'=>$this->ese_id];
        else
            return  $respuesta=['estado'=>-2];
    }

    public function FinalizarCita($cit_id,$usu_data){

        $registro=Cita::findFirstBycit_id($cit_id);
        $registro->cit_estatus=3;
        $registro->usu_idcambioestatus=$usu_data['id'];

        if($registro->update())
        return  $respuesta=['estado'=>2,'cit_id'=> $registro->cit_id,'ese_id'=>$registro->ese_id];
        else
            return  $respuesta=['estado'=>-2];
    }

    public function BuscarCitaActual($ese_id){
        
        $cit_data=Cita::query()
        ->where('ese_id='.$ese_id.' AND cit_estatus=1')
        ->limit(1)
        ->execute();

        if(count($cit_data)>0){
            $answer['estado']=true;
            $answer['data']=$cit_data;
            $answer['cit_id']=$cit_data[0]->cit_id;


        }else{
            $answer['estado']=false;
        }
        return $answer;
    }

    public function BuscarCitaFinalizada($ese_id){
        
        $cit_data=Cita::query()
        ->where('ese_id='.$ese_id.' AND cit_estatus=3')
        ->limit(1)
        ->execute();

        if(count($cit_data)>0){
            $answer['estado']=true;
            $answer['data']=$cit_data[0];
            $answer['cit_id']=$cit_data[0]->cit_id;


        }else{
            $answer['estado']=false;
        }
        return $answer;


    }


    public function BuscarCitaCancelada($ese_id){
        
        $cit_data=Cita::query()
        ->where('ese_id='.$ese_id.' AND cit_estatus=-2')
        ->limit(1)
        ->execute();

        if(count($cit_data)>0){
            $answer['estado']=true;
            $answer['data']=$cit_data[0];
            $answer['cit_id']=$cit_data[0]->cit_id;


        }else{
            $answer['estado']=false;
        }
        return $answer;


    }
    public function ReActivarCita($cit_id,$usu_data){

        $registro=Cita::findFirstBycit_id($cit_id);
        $registro->cit_estatus=1;
        $registro->usu_idcambioestatus=$usu_data['id'];

        if($registro->update())
        return  $respuesta=['estado'=>2,'cit_id'=> $registro->cit_id,'ese_id'=>$registro->ese_id];
        else
            return  $respuesta=['estado'=>-2];
    }
    public function DesActivarCita($cit_id,$usu_data){

        $registro=Cita::findFirstBycit_id($cit_id);
        $registro->cit_estatus=-2;
        $registro->usu_idcambioestatus=$usu_data['id'];

        if($registro->update())
        return  $respuesta=['estado'=>2,'cit_id'=> $registro->cit_id,'ese_id'=>$registro->ese_id];
        else
            return  $respuesta=['estado'=>-2];
    }


}