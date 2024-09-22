<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
use Phalcon\Di;
    
/**
 * Modelo de la tabla puesto
 */
class Empresaformato extends Model
{
    public function NuevoRegistro($tif_id,$emp_id){
        $registro= new Empresaformato();
        $registro->tif_id=$tif_id;
        $registro->emp_id=$emp_id;
        $registro->emf_estatus=2;
        
        if($registro->save()){
            return ['estado'=>2,'mensaje'=>'ok'];
        }else{
            return ['estado'=>-2,'mensaje'=>'ok'];
        }
    }

    public function getEstatus($valor){

        switch ($valor) {
            case '1':
                return 'INACTIVO';
                break;
            case '2':
                return 'ACTIVO';
                    break;
            default:
                return '';
                break;
        }

    }

    public function getNombreEstatusACambiar($valor){
        switch ($valor) {
            case '1':
                return 'ACTIVAR';
                break;
            case '2':
                return 'DESACTIVAR';
                    break;
            default:
                return '';
                break;
        }

    }
    public function getBadgeEstatus($valor){

        switch ($valor) {
            case '1':
                return 'badge-warning';
                break;
            case '2':
                return 'badge-success';
                    break;
            default:
                return '';
                break;
        }

    }

}
