<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Entrevista
 */
class Entrevista extends Model
{
    public function ActualizarGeneral($data,$auth_data){
        $answer['estado']=-2;
        $answer['mensaje']='';
        $fecha_y_hora = date("Y-m-d H:i:s");

        $this->ent_hora=$data['ent_hora'];
        $this->ent_fecha=$data['ent_fecha'];
        $this->ent_observacion = trim($data['ent_observacion']);
  
        $this->ent_fechaactualizo=$fecha_y_hora;        

        if($this->update()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['ent_id']=$this->ent_id;
            $answer['exc_id']=$this->exc_id;

        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error';
            $answer['titular']='error';

        }

        return $answer;

    }
    public function getSiNo($respuesta){
        switch($respuesta)
        {   
        
            case 1:
            return "NO";
            break;

            case 2:
            return "SÍ";
            break;

            default:
            return "";
            break;
        }
    }

    public function setUpdateDataFacturacion($exc_id,$data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='';
        $fecha_y_hora = date("Y-m-d H:i:s");
        
        $query = $this->modelsManager->createBuilder()
            ->from('Entrevista')
            ->where('exc_id = :exc_id: AND ent_estatus >= 0')
            ->getQuery()
            ->execute([
                'exc_id' => $exc_id,
            ]);

        $registros = $query->getFirst();

        if(!$registros){
            $registro = new Entrevista();
            $registro->ent_estatus=2;

        }else{
                $registro=$registros;
        }
        $registro->ent_motivo=$data['ent_motivo'];
        if (!empty($data['ent_fechaingreso'])) {
            $registro->ent_fechaingreso = $data['ent_fechaingreso'];
        }        
        $registro->ent_montofacturar=$data['ent_montofacturar'];
        $registro->ent_fechaactualizo=$fecha_y_hora;        
        $registro->exc_id=$exc_id;        

        if($registro->save()){
            $answer['estado']=2;
            $answer['mensaje']=' actualizo datos de la entrevista';
            $answer['ent_id']=$registro->ent_id;
            $answer['exc_id']=$registro->exc_id;

        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error';
        }

        return $answer;
        
    }
    
    

}