<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla sitaucion economica
 */
class Situacioneconomicaingresos extends Model
{
    public function NuevoRegistro($data){

        $registro_sei= new Situacioneconomicaingresos();
        $registro_sei->sei_nombre=trim($data['sei_nombre_crear']);
        $registro_sei->sei_parentesco=$data['sei_parentesco_crear'];
        $registro_sei->sei_sueldo=$data['sei_sueldo_crear'];
        $registro_sei->sei_aportacion=$data['sei_aportacion_crear'];
        $registro_sei->sei_estatus=2;
        $registro_sei->sie_id=$data['sei_sie_id'];

        if($registro_sei->save())
        {
            return  $respuesta=['estado'=>2,'sei_id'=> $registro_sei->sei_id,'sie_id'=>$registro_sei->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }

    public function ActualizarRegistro($data){
        
        $this->sei_nombre=trim($data['sei_nombre_editar']);
        $this->sei_parentesco=$data['sei_parentesco_editar'];
        $this->sei_sueldo=$data['sei_sueldo_editar'];
        $this->sei_aportacion=$data['sei_aportacion_editar'];

        if($this->update())
            return  $respuesta=['estado'=>2,'sei_id'=> $this->sei_id,'sie_id'=>$this->sie_id];
        else
            return  $respuesta=['estado'=>-2];



    }

    public function getTotalIngresosEspecifico($sie_id)
    {
        $sie= Situacioneconomicaingresos::find(array('sei_estatus = 2 and sie_id='.$sie_id));
        
        $total=0;
        for ($i=0; $i <count($sie) ; $i++) { 
               $total=$total+$sie[$i]->sei_aportacion;
        }
        return $total;

    }
    public function getTotalIngresosEspecificoMasOtrosIngresos($sie_id)
    {
        $sie= Situacioneconomicaingresos::find(array('sei_estatus = 2 and sie_id='.$sie_id));
        $situacion_eco =Situacioneconomica::findFirstBysie_id($sie_id);

        $total=0;
        for ($i=0; $i <count($sie) ; $i++) { 
               $total=$total+$sie[$i]->sei_aportacion;
        }
        return $total+$situacion_eco->sie_manuingresomonto;

    }
    public function setUpdateIngresoEseEspecifico($situacion_eco_id,$total_ingresos)
    {
        $sei=Situacioneconomica::findFirst($situacion_eco_id);
        $sei->sie_totalingresos=$total_ingresos;
        if($sei->save())
            return  $respuesta=['estado'=>2];
        
        else
            return  $respuesta=['estado'=>-2];

    }
    public function setUpdateIngresoEseEspecificoCandidatoFormatoTruper($situacion_eco_id,$total_ingresos)
    {
        $sei=Situacioneconomica::findFirst($situacion_eco_id);
        $sei->sie_totalingresos=$total_ingresos+$sei->sie_sueldoingreso;
        if($sei->save())
            return  $respuesta=['estado'=>2];
        
        else
            return  $respuesta=['estado'=>-2];

    }

    public function setUpdateBorrarUnIngresoEseEspecifico($situacion_eco_id,$ingresos_a_restar)
    {
        $sei=Situacioneconomica::findFirst($situacion_eco_id);
        $sei->sie_totalingresos=$sei->sie_totalingresos-$ingresos_a_restar;
        if($sei->update())
            return  $respuesta=['estado'=>2,'sie_totalingresos'=>$sei->sie_totalingresos];
        else
            return  $respuesta=['estado'=>-2];


    }

    public function RegistroAutomaticoCargado($data,$ese_id)
    {
        
        $answer=[];
        $modelo_situacioneconomica=new Situacioneconomica();
        $respuesta_modelo_situacioneconomica= $modelo_situacioneconomica->crearAutomaticoOTraerExistente($ese_id);

        if($respuesta_modelo_situacioneconomica['estado']===2){
            $situacioneconomicaingresos_nuevo= new Situacioneconomicaingresos();
            $situacioneconomicaingresos_nuevo->sei_nombre=trim($data['dgd_nombre_crear']);
            $situacioneconomicaingresos_nuevo->sie_id=$respuesta_modelo_situacioneconomica['sie_id'];
            $situacioneconomicaingresos_nuevo->sei_estatus= 2;

            if( $situacioneconomicaingresos_nuevo->save()){

                $answer['estado']=2;
                $answer['mensaje']='ok';
            }


        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error en el proceso';

        }

        return $answer;
        
    }

    public function NuevoRegistroCandidatoFormatoTruper($data){

        $registro_sei= new Situacioneconomicaingresos();
        
        $registro_sei->sei_candidato=1;
        $registro_sei->sei_aportacion=$data['sei_aportacion'];
        $registro_sei->sei_estatus=2;
        $registro_sei->sei_concepto=$data['sei_concepto'];

        
        $registro_sei->sie_id=$data['sie_id'];

        if($registro_sei->save())
        {
            return  $respuesta=['estado'=>2,'sei_id'=> $registro_sei->sei_id,'sie_id'=>$registro_sei->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

    public function ActualizarRegistroCandidatoFormatoTruper($data){

        $this->sei_aportacion=$data['sei_aportacion'];
        $this->sei_concepto=$data['sei_concepto'];        

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'sei_id'=> $this->sei_id,'sie_id'=>$this->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }


    public function NuevoRegistroFamiliarFormatoTruper($data){

        $registro= new Situacioneconomicaingresos();
        
        $registro->sei_candidato=2;
        $registro->sei_aportacion=$data['sei_aportacion'];
        $registro->sei_estatus=2;
        $registro->sei_parentesco=$data['sei_parentesco'];

        
        $registro->sef_id=$data['sef_id'];

        if($registro->save())
        {
            return  $respuesta=['estado'=>2,'sei_id'=> $registro->sei_id,'sef_id'=>$registro->sef_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

    public function ActualizarRegistroFamiliarFormatoTruper($data){

        
        
        $this->sei_aportacion=$data['sei_aportacion'];
        $this->sei_parentesco=$data['sei_parentesco'];

        
     

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'sei_id'=> $this->sei_id,'sef_id'=>$this->sef_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

  
    public function setUpdateBorrarUnIngresoFamiliarEseEspecifico($situacion_eco_id,$ingresos_a_restar)
    {
        $sef=Situacioneconomicafamiliar::findFirst($situacion_eco_id);
        $sef->sef_totalingresos=$sef->sef_totalingresos-$ingresos_a_restar;
        if($sef->update())
            return  $respuesta=['estado'=>2,'sef_totalingresos'=>$sef->sef_totalingresos];
        else
            return  $respuesta=['estado'=>-2];


    }
    public function getTotalIngresosEspecificoFamiliaresIngresos($sef_id)
    {
        $condicion='sei_estatus = 2 and sef_id='.$sef_id.' and sei_candidato=2';

              $total=  Situacioneconomicaingresos::sum(
                    [
                        'column' => 'sei_aportacion',
                        'conditions' => $condicion,
                       
                    ]
                );

   
        return $total;
    }
    public function setUpdateIngresoEseEspecificoTotalIngresoFamiliar($situacion_eco_id,$total_ingresos)
    {
        $sef=Situacioneconomicafamiliar::findFirst($situacion_eco_id);
        $sef->sef_totalingresos=$total_ingresos+$sef->sef_conyugeingreso
        +$sef->sef_hijosmenoresingreso
        +$sef->sef_hijosadultosingreso
        +$sef->sef_padresingreso
        +$sef->sef_hermanosingreso;
        if($sef->save())
            return  $respuesta=['estado'=>2,'sef_totalingresos'=>  $sef->sef_totalingresos];
        
        else
            return  $respuesta=['estado'=>-2];

    }


    //candidato

    public function getTotalIngresosEspecificoCandidatoIngresos($sie_id)
    {
        $condicion='sei_estatus = 2 and sie_id='.$sie_id.' and sei_candidato=1';

              $total=  Situacioneconomicaingresos::sum(
                    [
                        'column' => 'sei_aportacion',
                        'conditions' => $condicion,
                       
                    ]
                );

   
        return $total;
    }

   

}

