<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla sitaucion economica
 */
class Situacioneconomicafamiliar extends Model
{
 
    public function encontrar_o_crear($ese_id){

        $condicion='ese_id='.$ese_id.' and sef_estatus=2';
        $answer['estado']=-2;

        $query=Situacioneconomicafamiliar::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['sef_id']=$query[0]->sef_id;


        }else{
            $registro=new Situacioneconomicafamiliar();
            $registro->sef_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['sef_id']=$registro->sef_id;

                $answer['estado']=2;
            } 
    

        }


        return $answer;

    }


    public function ActualizarRegistroFormatoTruper($data,$permisoRH=0){

        $sef=new Situacioneconomicaingresos();
        $sef_modelo= $sef->getTotalIngresosEspecificoFamiliaresIngresos($this->sef_id)
        +$data['sef_conyugeingreso']+$data['sef_hijosmenoresingreso']
        +$data['sef_hijosadultosingreso']
        +$data['sef_padresingreso']
        +$data['sef_hermanosingreso'];


        $this->sef_totalingresos = $sef_modelo;

        $this->sef_alimentacion =$data['sef_alimentacion'];
        $this->sef_ropacalzado=$data['sef_ropacalzado'];
        $this->sef_serviciodomestico=$data['sef_serviciodomestico'];
        $this->sef_escolares=$data['sef_escolares'];
        $this->sef_creditos=$data['sef_creditos'];
        $this->sef_seguros=$data['sef_seguros'];
        $this->sef_hipotecas=$data['sef_hipotecas'];
        $this->sef_diversiones=$data['sef_diversiones'];
        $this->sef_mascotas=$data['sef_mascotas'];
        $this->sef_ahorro=$data['sef_ahorro'];
        $this->sef_renta=$data['sef_renta'];
        $this->sef_otros=$data['sef_otros'];
        $this->sef_otrosconcepto=$data['sef_otrosconcepto'];

        $this->sef_conyugeingreso=$data['sef_conyugeingreso'];
        $this->sef_hijosmenoresingreso=$data['sef_hijosmenoresingreso'];
        $this->sef_hijosadultosingreso=$data['sef_hijosadultosingreso'];
        $this->sef_padresingreso=$data['sef_padresingreso'];
        $this->sef_hermanosingreso=$data['sef_hermanosingreso'];


        
        

         $this->sef_totalegresos = ($data['sef_alimentacion']+$data['sef_ropacalzado']+$data['sef_serviciodomestico']+$data['sef_escolares']+$data['sef_creditos']
                                    +$data['sef_seguros']+$data['sef_hipotecas']+$data['sef_diversiones']+$data['sef_mascotas']
                                    +$data['sef_ahorro']
                                    +$data['sef_renta']
                                    +$data['sef_otros']);
           
       

        

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'ese_id'=> $this->ese_id,'sef_id'=>$this->sef_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }

}