<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Empleooculto extends Model
{

    public function getRecomendable($valor){
        switch ($valor){

    
           
          
            case '1':
                  return 'NO DIERON INFORMACIÓN POR POLÍTICAS';
                    break;

            case '2':
                  return 'SOLO DATOS DEL SISTEMA';
                    break;
            case '3':
                return '--NO-- RECOMENDABLE';
                 break;
            case '4':
                return 'RECOMENDABLE C/ RESERVAS	';
                break;
            case '5':
                return 'RECOMENDABLE';
                    break;
            default:
                   return '';
                    break;

            }

    }
    public function getDemanda($id){
        switch ($id) {
            case '1':
            return 'SI';
                break;
            case '0':
            return 'NO'; 
                break;
            
            default:
            return ''; 
                break;
        }
    

    }
    public function NuevoRegistro($data){

        $registro_epl= new Empleooculto();
        $registro_epl->epl_empresa=$data['epl_empresa'];
        $registro_epl->epl_telefono=$data['epl_telefono'];

        $registro_epl->epl_fechaingreso=$data['epl_fechaingreso'];
        $registro_epl->epl_fechasalida=$data['epl_fechasalida'];
        $registro_epl->epl_motivoseparacion=$data['epl_motivoseparacion'];

        $registro_epl->epl_demanda=$data['epl_demanda'];
        $registro_epl->epl_recomendable=$data['epl_recomendable'];



        $registro_epl->epl_estatus=2;
        $registro_epl->sel_id=$data['sel_id'];


 


        
        if($registro_epl->save()){
            return  $repuesta=['estado'=>2,'epl_id'=> $registro_epl->epl_id,'sel_id'=> $registro_epl->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }
    public function ActualizarRegistro($data){

        $this->epl_empresa=$data['epl_empresa'];
        $this->epl_telefono=$data['epl_telefono'];

        $this->epl_fechaingreso=$data['epl_fechaingreso'];
        $this->epl_fechasalida=$data['epl_fechasalida'];
        $this->epl_motivoseparacion=$data['epl_motivoseparacion'];

        $this->epl_demanda=$data['epl_demanda'];
        $this->epl_recomendable=$data['epl_recomendable'];


        
        if($this->update()){
            return  $repuesta=['estado'=>2,'epl_id'=> $this->epl_id,'sel_id'=> $this->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }
}