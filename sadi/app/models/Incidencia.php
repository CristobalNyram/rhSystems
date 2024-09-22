<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Incidencia extends Model
{
	public function GuardarInformacion($data, $usu_id){
        $subs=new Builder();
        $subs=$subs
            ->addFrom('Incidenciaestudio','i')
            ->where('ine_estatus=2 and ese_id='.$data['ese_id'].' and inc_id='.$data['inc_id'])
            ->getQuery()
            ->execute();
        
        if(count($subs)>0){
            $registro = Incidenciaestudio::findFirstByine_id($subs[0]->ine_id);
                // $registro->ine_estatus=3;
                $registro->delete();
            if($data['check']==0){

                return 1;
            }
            if($data['check']==1){
                
                return 1;
            }
        }else{
            if($data['check']==0){
                return 1;
            }
            if($data['check']==1){
                $incidenciaestudio = new Incidenciaestudio();
                $incidenciaestudio->ine_estatus=2;
                $incidenciaestudio->inc_id=$data['inc_id'];
                $incidenciaestudio->ese_id=$data['ese_id'];
                $incidenciaestudio->usu_id=$usu_id;
                $incidenciaestudio->save();
                return 1;
            }
        }
    }
}