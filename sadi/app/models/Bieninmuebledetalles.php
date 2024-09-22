<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Bieninmuebledetalles
 */
class Bieninmuebledetalles extends Model
{
    public function NuevoRegistro($data){

        $registro_bid= new Bieninmuebledetalles();
        $registro_bid->bid_nombre=trim($data['bid_nombre_crear']);
        $registro_bid->bid_ubicacion=$data['bid_ubicacion_crear'];
        $registro_bid->bid_valor=$data['bid_valor_crear'];
        $registro_bid->bid_estatus=2;
        $registro_bid->bie_id=$data['bid_bie_id'];

        if($registro_bid->save())
        {
            return  $respuesta=['estado'=>2,'bid_id'=> $registro_bid->bid_id,'bie_id'=>$registro_bid->bie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }

    public function ActualizarRegistro($data){
        
        $this->bid_nombre=trim($data['bid_nombre_editar']);
        $this->bid_ubicacion=$data['bid_ubicacion_editar'];
        $this->bid_valor=$data['bid_valor_editar'];
   
        
        if($this->update())
        {
            return  $respuesta=['estado'=>2,'bid_id'=> $this->bid_id,'bie_id'=>$this->bie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }


    }
    public function NuevoRegistroFormatoTruper($data){

        $registro_bid= new Bieninmuebledetalles();
        $registro_bid->bid_nombre=trim($data['bid_nombre_crear']);
        $registro_bid->bid_antiguedad=$data['bid_antiguedad_crear'];
        $registro_bid->bid_valor=$data['bid_valor_crear'];
        $registro_bid->bid_estatus=2;
        $registro_bid->bie_id=$data['bid_bie_id'];

        if($registro_bid->save())
        {
            return  $respuesta=['estado'=>2,'bid_id'=> $registro_bid->bid_id,'bie_id'=>$registro_bid->bie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }

    }


    public function ActualizarRegistroFormatoTruper($data){
        
        $this->bid_nombre=trim($data['bid_nombre_editar']);
        $this->bid_antiguedad=$data['bid_antiguedad_editar'];
        $this->bid_valor=$data['bid_valor_editar'];
   
        
        if($this->update())
        {
            return  $respuesta=['estado'=>2,'bid_id'=> $this->bid_id,'bie_id'=>$this->bie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }


    }

    public function RegistroAutomaticoCargado($data,$ese_id)
    {
        $answer=[];
        $modelo_bieninmueble=new Bieninmueble();
        $respuesta_modelo_bieninmueble= $modelo_bieninmueble->crearAutomaticoOTraerExistente($ese_id);

        if($respuesta_modelo_bieninmueble['estado']===2){
            $bieninmuebledetalles_nuevo= new Bieninmuebledetalles();
            $bieninmuebledetalles_nuevo->bid_nombre=trim($data['dgd_nombre_crear']);
            $bieninmuebledetalles_nuevo->bie_id=$respuesta_modelo_bieninmueble['bie_id'];
            $bieninmuebledetalles_nuevo->bid_estatus= 2;

            if( $bieninmuebledetalles_nuevo->save()){

                $answer['estado']=2;
                $answer['mensaje']='ok';
            }


        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error en el proceso';

        }

        return $answer;
    }


    public function getNombreBienInmueble_FormatoTruper($id){

        switch ($id) {
            case '0':
                return 'CASA';
                break;
            case '1':
                       return 'DEPARTAMENTO';
         
                break;
            case '2':
                  return 'EDIFICIO';
              
                break;

            case '3':
                  return 'RANCHO';
              
                break;
            case '4':
                  return 'TIEMPO COMPARTIDO	';
            
                break;

            case '5':
                   return 'TERRENO';
             
                break;
            case '6':
                    return 'LOCALES COMERCIALES';
            
                break;

            case '7':
                    return 'NEGOCIO';
            
                    break;
            
            default:
                    return '';
          
                break;
        }

    }


}