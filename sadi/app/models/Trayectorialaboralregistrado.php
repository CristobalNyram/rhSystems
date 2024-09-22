<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Trayectorialaboralregistrado extends Model
{
    public function encontrar_o_crear($sel_id){
        $condicion='sel_id='.$sel_id.' and tlr_estatus=2';
        $answer['estado']=-2;

        $query=Trayectorialaboralregistrado::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['tlr_id']=$query[0]->tlr_id;


        }else{
            $registro=new Trayectorialaboralregistrado();
            $registro->tlr_estatus=2;
            $registro->sel_id=$sel_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['tlr_id']=$registro->tlr_id;
                $answer['estado']=2;
            } 
    

        }


        return $answer;
    }

    public function ActualizarRegistroFormatoTruper($data){


        $this->tlr_reconocehabeestado=$data['tlr_reconocehabeestado'];
        $this->tlr_empresasnoreconoce=$data['tlr_empresasnoreconoce'];
        $this->tlr_datocandidatocontienetelcontacto=$data['tlr_datocandidatocontienetelcontacto'];
        $this->tlr_datocandidatocontienenombrescontacto=trim($data['tlr_datocandidatocontienenombrescontacto']);
        $this->tlr_coincidefechacandadidatoobtenida=$data['tlr_coincidefechacandadidatoobtenida'];
        $this->tlr_coincidedatoscandidadtoinvestigador=$data['tlr_coincidedatoscandidadtoinvestigador'];

        if($this->update()){
            return  $repuesta=['estado'=>2,'tlr_id'=> $this->tlr_id,'sel_id'=> $this->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }
}
