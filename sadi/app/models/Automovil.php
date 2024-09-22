<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla automovil
 */
class Automovil extends Model
{

    public $tipos_auto_movil=[
        ['id'=>'1','nombre'=>'AUTOMÓVIL'],
        ['id'=>'2','nombre'=>'CAMIONETA'],
        ['id'=>'3','nombre'=>'MOTOCICLETA'],
        ['id'=>'4','nombre'=>'COMBIE'],
        ['id'=>'5','nombre'=>'CAMIÓN'],
        ['id'=>'6','nombre'=>'TAXI'],

    ];

    public $tipos_auto_movi_formatotruper=[
        ['id'=>'1','nombre'=>'AUTOMÓVIL'],
        ['id'=>'2','nombre'=>'CAMIONETA'],
        ['id'=>'3','nombre'=>'MOTOCICLETA'],
        ['id'=>'4','nombre'=>'COMBIE'],
        ['id'=>'5','nombre'=>'CAMIÓN'],
        ['id'=>'6','nombre'=>'TAXI'],
        ['id'=>'7','nombre'=>'MICROBÚS'],


    ];
    public function NuevoRegistro($data){

        $registro_aut= new Automovil();
        $registro_aut->aut_tipo=$data['aut_tipo_crear'];
        $registro_aut->aut_marca=$data['aut_marca_crear'];
        $registro_aut->aut_modelo=$data['aut_modelo_crear'];
        $registro_aut->aut_anio=$data['aut_anio_crear'];
        $registro_aut->aut_estatus=2;
        $registro_aut->aut_valor=$data['aut_valor_crear'];
        $registro_aut->bie_id=$data['aut_bie_id'];

        if($registro_aut->save())
        {
            return  $respuesta=['estado'=>2,'aut_id'=> $registro_aut->aut_id,'bie_id'=>$registro_aut->bie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }

    public function ActualizarRegistro($data){
        
        $this->aut_tipo=$data['aut_tipo_editar'];
        $this->aut_marca=$data['aut_marca_editar'];
        $this->aut_modelo=$data['aut_modelo_editar'];
        $this->aut_anio=$data['aut_anio_editar'];
        $this->aut_valor=$data['aut_valor_editar'];


        if($this->update())
            return  $respuesta=['estado'=>2,'aut_id'=> $this->aut_id,'bie_id'=>$this->bie_id];
        else
            return  $respuesta=['estado'=>-2];



    }
    public function get_data_tipo_automovil(){

        return $this->tipos_auto_movil;
    }
    public function get_data_tipo_automovil_formatotruper(){

        return $this->tipos_auto_movi_formatotruper;
    }

    public function get_nombre_tipo_automovil($aut_tipo){

        if($aut_tipo>=0 and $aut_tipo<= 6){
            $nombre_aut_tipo= $this->tipos_auto_movil[$aut_tipo-1]['nombre'];

        }else{
            $nombre_aut_tipo='';
        }


        return  $nombre_aut_tipo;

    }

    public function get_nombre_tipo_automovil_formatotruper($aut_tipo){

        if($aut_tipo>=0 and $aut_tipo<= 7){
            $nombre_aut_tipo= $this->tipos_auto_movi_formatotruper[$aut_tipo-1]['nombre'];

        }else{
            $nombre_aut_tipo='';
        }


        return  $nombre_aut_tipo;

    }


}
