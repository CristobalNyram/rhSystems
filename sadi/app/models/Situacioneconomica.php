<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla sitaucion economica
 */
class Situacioneconomica extends Model
{
    public function ActualizarRegistro($data,$permisoCalificacion)
    {   
        $sie=new Situacioneconomicaingresos();
        $sie_modelo= $sie->getTotalIngresosEspecifico($this->sie_id);
       

        $this->sie_totalingresos=$sie_modelo+$data['sie_manuingresomonto'];
        $this->sie_alimentacion =$data['sie_alimentacion'];
        $this->sie_renta=$data['sie_renta'];
        $this->sie_telluzagua=$data['sie_telluzagua'];
        $this->sie_transporte=$data['sie_transporte'];
        $this->sie_ropacalzado=$data['sie_ropacalzado'];
        $this->sie_escolares=$data['sie_escolares'];
        $this->sie_serviciodomestico=$data['sie_serviciodomestico'];
        $this->sie_creditos=$data['sie_creditos'];
        $this->sie_diversiones=$data['sie_diversiones'];
        $this->sie_otros=$data['sie_otros'];
        
        $this->sie_manuingreso=($data['sie_manuingreso'] == '-1' ?null:$data['sie_manuingreso']);
        $this->sie_manuingresomonto=$data['sie_manuingresomonto'];


        $this->sie_manuegreso=($data['sie_manuegreso'] == '-1' ?null:$data['sie_manuegreso']);
        $this->sie_manuegresomonto=$data['sie_manuegresomonto'];


         $this->sie_totalegresos = ($data['sie_alimentacion']+$data['sie_renta']+$data['sie_telluzagua']+$data['sie_transporte']+$data['sie_ropacalzado']
                                    +$data['sie_escolares']+$data['sie_serviciodomestico']+$data['sie_creditos']+$data['sie_diversiones']
                                    +$data['sie_otros']
                                    +$data['sie_manuegresomonto']);
           
        $this->sie_solventa=$data['sie_solventa'];
        $this->sie_buro=$data['sie_buro'];
        $this->sie_institucion=$data['sie_institucion'];

        if($permisoCalificacion==1)
        {
            $this->sie_calificacion=$data['sie_calificacion'];

        }


        if($this->update())
        {
            return  $respuesta=['estado'=>2,'ese_id'=> $this->ese_id,'sie_id'=>$this->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

    public function formatoeses($situacioneconomica, $situacioneconomicaingresos, $situacioneconomicacredito){
        $reporte= new PdfReporte();
        $html=$reporte->situacioneconomica;
        $html=str_replace("#sie_totalingresos#",number_format($situacioneconomica->sie_totalingresos, 2, '.', ','),$html);
        $html=str_replace("#sie_alimentacion#",number_format($situacioneconomica->sie_alimentacion, 2, '.', ','),$html);
        $html=str_replace("#sie_renta#",number_format($situacioneconomica->sie_renta, 2, '.', ','),$html);
        $html=str_replace("#sie_telluzagua#",number_format($situacioneconomica->sie_telluzagua, 2, '.', ','),$html);
        $html=str_replace("#sie_transporte#",number_format($situacioneconomica->sie_transporte, 2, '.', ','),$html);
        $html=str_replace("#sie_ropacalzado#",number_format($situacioneconomica->sie_ropacalzado, 2, '.', ','),$html);
        $html=str_replace("#sie_escolares#",number_format($situacioneconomica->sie_escolares, 2, '.', ','),$html);
        $html=str_replace("#sie_serviciodomestico#",number_format($situacioneconomica->sie_serviciodomestico, 2, '.', ','),$html);
        $html=str_replace("#sie_creditos#",number_format($situacioneconomica->sie_creditos, 2, '.', ','),$html);
        $html=str_replace("#sie_diversiones#",number_format($situacioneconomica->sie_diversiones, 2, '.', ','),$html);
        $html=str_replace("#sie_otros#",number_format($situacioneconomica->sie_otros, 2, '.', ','),$html);
        $html=str_replace("#sie_totalegresos#",number_format($situacioneconomica->sie_totalegresos, 2, '.', ','),$html);
        $html=str_replace("#sie_solventa#",trim($situacioneconomica->sie_solventa),$html);
        $html=str_replace("#sie_buro#",trim($situacioneconomica->sie_buro),$html);
        $html=str_replace("#sie_institucion#",trim($situacioneconomica->sie_institucion),$html);

        $html=str_replace("#diferencia#",number_format($situacioneconomica->sie_totalingresos-$situacioneconomica->sie_totalegresos, 2, '.', ','),$html);

        $detalles=count($situacioneconomicaingresos);

        for ($i=0; $i <= 10; $i++) {
            if($i<$detalles){
                $html=str_replace("#sei_nombre".$i."#",trim($situacioneconomicaingresos[$i]->sei_nombre),$html);
                $html=str_replace("#sei_parentesco".$i."#",trim($situacioneconomicaingresos[$i]->sei_parentesco),$html);
                $html=str_replace("#sei_sueldo".$i."#","$  ".number_format($situacioneconomicaingresos[$i]->sei_sueldo, 2, '.', ','),$html);
                $html=str_replace("#sei_aportacion".$i."#","$  ".number_format($situacioneconomicaingresos[$i]->sei_aportacion, 2, '.', ','),$html);
            }else{
                $html=str_replace("#sei_nombre".$i."#"," ",$html);
                $html=str_replace("#sei_parentesco".$i."#"," ",$html);
                $html=str_replace("#sei_sueldo".$i."#"," ",$html);
                $html=str_replace("#sei_aportacion".$i."#"," ",$html);
            }
        }
        //ingresos manutencion
        
        $html=str_replace("#sie_manuingresomonto#","$  ".number_format($situacioneconomica->sie_manuingresomonto, 2, '.', ','),$html);



        $detalles=count($situacioneconomicacredito);

        for ($i=0; $i <= 6; $i++) {
            if($i<$detalles){
                $html=str_replace("#sec_institucion".$i."#",trim($situacioneconomicacredito[$i]->sec_institucion),$html);
                $html=str_replace("#sec_tipo".$i."#",trim($situacioneconomicacredito[$i]->sec_tipo),$html);
                $html=str_replace("#sec_saldo".$i."#","$  ".number_format($situacioneconomicacredito[$i]->sec_saldo, 2, '.', ','),$html);
                $html=str_replace("#sec_mensual".$i."#","$  ".number_format($situacioneconomicacredito[$i]->sec_mensual, 2, '.', ','),$html);
            }else{
                $html=str_replace("#sec_institucion".$i."#"," ",$html);
                $html=str_replace("#sec_tipo".$i."#"," ",$html);
                $html=str_replace("#sec_saldo".$i."#"," ",$html);
                $html=str_replace("#sec_mensual".$i."#"," ",$html);
            }
      

        }

         //egresos manutencion
        $html=str_replace("#sie_manuegresomonto#","$  ".number_format($situacioneconomica->sie_manuegresomonto, 2, '.', ','),$html);



        return $html;

    }
    public function crearAutomaticoOTraerExistente($ese_id){

        $answer=[];
        
        // $situacioneconomicar_ese_activo=Situacioneconomica::findFirst(["ese_id = '$ese_id'","sie_estatus = '2'"]);

        $situacioneconomicar_ese_activo=Situacioneconomica::query()->where("ese_id=".$ese_id.' and sie_estatus = 2') ->execute(); 

        if(count($situacioneconomicar_ese_activo)>0){
            
            $answer['sie_id']=$situacioneconomicar_ese_activo[0]->sie_id;
            $answer['ese_id']=$situacioneconomicar_ese_activo[0]->ese_id;
            $answer['estado']=2;
            $answer['titular']='ok';
            $answer['mensaje']='se encontro';


            
        }else{
            $situacioneconomica_crear= new Situacioneconomica();
            $situacioneconomica_crear->ese_id=$ese_id;
            $situacioneconomica_crear->sie_estatus=2;

            if($situacioneconomica_crear->save()){

                $answer['sie_id']=$situacioneconomica_crear->sie_id;
                $answer['ese_id']=$situacioneconomica_crear->ese_id;
                $answer['estado']=2;
                $answer['titular']='ok';
                $answer['mensaje']='se creo';


            }else{
          
                $answer['estado']=-2;
                $answer['mensaje']='error';
            }



        }

        return $answer;


    }

    public function encontrar_o_crear($ese_id){

        $condicion='ese_id='.$ese_id.' and sie_estatus=2';
        $answer['estado']=-2;

        $query=Situacioneconomica::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['sie_id']=$query[0]->sie_id;


        }else{
            $registro=new Situacioneconomica();
            $registro->sie_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['sie_id']=$registro->sie_id;

                $answer['estado']=2;
            } 
    

        }


        return $answer;

    }

    public function ActualizarRegistroFormatoTruper($data,$permisoRH=0){

        $sie=new Situacioneconomicaingresos();
        $sie_modelo= $sie->getTotalIngresosEspecificoCandidatoIngresos($this->sie_id)+$data['sie_sueldoingreso'];
       
        $this->sie_totalingresos = $sie_modelo;

        $this->sie_alimentacion =$data['sie_alimentacion'];
        $this->sie_ropacalzado=$data['sie_ropacalzado'];
        $this->sie_serviciodomestico=$data['sie_serviciodomestico'];
        $this->sie_escolares=$data['sie_escolares'];
        $this->sie_creditos=$data['sie_creditos'];
        $this->sie_seguros=$data['sie_seguros'];
        $this->sie_hipoteca=$data['sie_hipoteca'];
        $this->sie_diversiones=$data['sie_diversiones'];
        $this->sie_mascotas=$data['sie_mascotas'];
        $this->sie_ahorros=$data['sie_ahorros'];
        $this->sie_renta=$data['sie_renta'];
        $this->sie_otros=$data['sie_otros'];

        $this->sie_otrosconcepto=$data['sie_otrosconcepto'];
        $this->sie_sueldoingreso=$data['sie_sueldoingreso'];
        
        

         $this->sie_totalegresos = ($data['sie_alimentacion']+$data['sie_ropacalzado']+$data['sie_serviciodomestico']+$data['sie_escolares']+$data['sie_creditos']
                                    +$data['sie_seguros']+$data['sie_hipoteca']+$data['sie_diversiones']+$data['sie_mascotas']
                                    +$data['sie_ahorros']
                                    +$data['sie_renta']
                                    +$data['sie_otros']);
           
        $this->sie_solventa=$data['sie_solventa'];
       

        

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'ese_id'=> $this->ese_id,'sie_id'=>$this->sie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }
}