<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Trayectorialaboralregistradodetalles extends Model
{

    public function NuevoRegistroFormatoTruper($data){
        $registro=new Trayectorialaboralregistradodetalles();
        $registro->trd_empresa=$data['trd_empresa'];
        $registro->trd_informada=$data['trd_informada'];
        $registro->trd_observaciones=$data['trd_observaciones'];

        $registro->trd_estatus=2;
        $registro->tlr_id=$data['tlr_id'];


        if($registro->save()){
            return  $repuesta=['estado'=>2,'trd_id'=> $registro->trd_id,'tlr_id'=> $registro->tlr_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }

    public function ActualizarRegistroFormatoTruper($data){
        $this->trd_empresa=$data['trd_empresa'];
        $this->trd_informada=$data['trd_informada'];
        $this->trd_observaciones=$data['trd_observaciones'];




        if($this->update()){
            return  $repuesta=['estado'=>2,'trd_id'=> $this->trd_id,'tlr_id'=> $this->tlr_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }

    public function get_informada($valor){

        switch ($valor) {
            case '1':
                     return 'SÍ';
                break;

            case '0':
                    return 'NO';
                break; 
            
            default:
                    return '';
                     break;
        }

    }


 
}
