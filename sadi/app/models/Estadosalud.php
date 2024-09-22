<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Estadosalud extends Model
{
    public function GuardarInformacion($data,$usu_id,$permisocalificacion){
        $subs = Estadosalud::find(array(
                'ese_id='.$data['ese_id'],
                'ess_estatus=2'));
        if(count($subs)>0){
            $registro = Estadosalud::findFirstByess_id($subs[0]->ess_id);
        }else{
            $registro = new Estadosalud();
        }
        
        $registro->ese_id= $data['ese_id'];
        $registro->ess_estatus=2;
        $registro->ess_fechaexamenmedico=$data['ess_fechaexamenmedico'];
        $registro->ess_estadosalud=$data['ess_estadosalud'];
        $registro->ess_enfermedadcronica=$data['ess_enfermedadcronica'];
        $registro->ess_medicamento=$data['ess_medicamento'];
        $registro->ess_intervencionquirurgica=$data['ess_intervencionquirurgica'];
        $registro->ess_alergia=$data['ess_alergia'];
        $registro->ess_tiposangre=$data['ess_tiposangre'];
        $registro->ess_estatura=$data['ess_estatura'];
        $registro->ess_peso=$data['ess_peso'];
        $registro->ess_avisar=$data['ess_avisar'];
        $registro->ess_telefono=$data['ess_telefono'];
        $registro->ess_direccion=$data['ess_direccion'];
        $registro->ess_parentesco=$data['ess_parentesco'];
        $registro->ess_nota=$data['ess_nota'];
        
        if($permisocalificacion==1){
            if(isset($data['ess_calificacion'])){
                $registro->ess_calificacion=$data['ess_calificacion'];
            }
        }

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }


    public function formatoeses($estadosalud){
        $reporte= new PdfReporte();
        $html=$reporte->estadosalud;
        $html=str_replace("#ess_fechaexamenmedico#",trim($estadosalud->ess_fechaexamenmedico),$html);
        $html=str_replace("#ess_estadosalud#",trim($estadosalud->ess_estadosalud),$html);
        $html=str_replace("#ess_enfermedadcronica#",trim($estadosalud->ess_enfermedadcronica),$html);
        $html=str_replace("#ess_medicamento#",trim($estadosalud->ess_medicamento),$html);
        $html=str_replace("#ess_intervencionquirurgica#",trim($estadosalud->ess_intervencionquirurgica),$html);
        $html=str_replace("#ess_alergia#",trim($estadosalud->ess_alergia),$html);
        $html=str_replace("#ess_tiposangre#",trim($estadosalud->ess_tiposangre),$html);
        $html=str_replace("#ess_estatura#",trim($estadosalud->ess_estatura),$html);
        $html=str_replace("#ess_peso#",trim($estadosalud->ess_peso),$html);
        $html=str_replace("#ess_avisar#",trim($estadosalud->ess_avisar),$html);
        $html=str_replace("#ess_telefono#",trim($estadosalud->ess_telefono),$html);
        $html=str_replace("#ess_direccion#",trim($estadosalud->ess_direccion),$html);
        $html=str_replace("#ess_parentesco#",trim($estadosalud->ess_parentesco),$html);
        $html=str_replace("#ess_nota#",trim($estadosalud->ess_nota),$html);
        
        return $html;
    }

    public function econtrar_o_crear($ese_id){

        $condicion='ese_id='.$ese_id.' and ess_estatus=2';
        $answer['estado']=-2;

        $query=Estadosalud::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['ess_id']=$query[0]->ess_id;


        }else{
            $registro=new Estadosalud();
            $registro->ess_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['ess_id']=$registro->ess_id;
                $answer['estado']=2;
            } 
    

        }

        return $answer;
    }


    public function GuardarInformacionFormatoTruper($data,$usu_id=0,$permisocalificacion=0,$ese_id){

        $modelo= new Estadosalud();
        $repuesta_modelo=$modelo->econtrar_o_crear($ese_id);

        if($repuesta_modelo['estado']==2){
            $registro= Estadosalud::findFirstByess_id($repuesta_modelo['ess_id']);

        }

        $registro->ese_id= $ese_id;
        $registro->ess_enfermedadcronica=$data['ess_enfermedadcronica'];
        $registro->ess_enfermedadcronicapreg=$data['ess_enfermedadcronicapreg'];

        $registro->ess_incapacidadultimoaniopreg=$data['ess_incapacidadultimoaniopreg'];
        $registro->ess_incapacidadultimoanio=$data['ess_incapacidadultimoanio'];


        $registro->ess_famconenfermedadcronicapreg=$data['ess_famconenfermedadcronicapreg'];
        $registro->ess_famconenfermedadcronica=$data['ess_famconenfermedadcronica'];

        $registro->ess_intervencionquirurgicapreg=$data['ess_intervencionquirurgicapreg'];
        $registro->ess_intervencionquirurgica=$data['ess_intervencionquirurgica'];

        $registro->ess_estatura=$data['ess_estatura'];
        $registro->ess_peso=$data['ess_peso'];

        $registro->ess_avisar=$data['ess_avisar'];
        $registro->ess_telefono=$data['ess_telefono'];
        $registro->ess_direccion=$data['ess_direccion'];
        $registro->ess_parentesco=$data['ess_parentesco'];
        


        if($registro->save())
        {
            return['estado'=>2,'ese_id'=>$registro->ese_id,'ess_id'=> $registro->ess_id]; 
        }else{
            return['estado'=>-2]; 
        }
    }




}
