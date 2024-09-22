<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Antecedentesocial extends Model
{

    public $frecuencia_practica_deporte_formatotruper=[
        ['id'=>'1','nombre'=>'RARA VEZ'],
        ['id'=>'2','nombre'=>'EVENTUAL'],
        ['id'=>'3','nombre'=>'SEMANAL'],
        ['id'=>'4','nombre'=>'DIARIO'],
    ];

    public $religion_profesa_formatotruper=[
        ['id'=>'1','nombre'=>'NINGUNA'],
        ['id'=>'2','nombre'=>'CATÓLICA'],
        ['id'=>'3','nombre'=>'EVANGELISTA'],
        ['id'=>'4','nombre'=>'CRISTIANA'],
        ['id'=>'5','nombre'=>'MORMÓN'],
        ['id'=>'6','nombre'=>'TESTIGO DE JEHOVÁ	'],
        ['id'=>'7','nombre'=>'JUDAÍSMO'],
        ['id'=>'8','nombre'=>'ISLAMISTA'],

    ];


    public function GuardarInformacion($data,$usu_id,$permisocalificacion){
        $subs = Antecedentesocial::find(array(
                'ese_id='.$data['ese_id'],
                'ans_estatus=2'));
        if(count($subs)>0){
            $registro = Antecedentesocial::findFirstByans_id($subs[0]->ans_id);
        }else{
            $registro = new Antecedentesocial();
        }
        
        $registro->ese_id= $data['ese_id'];
        $registro->ans_estatus=2;
        $registro->ans_tiempolibre=$data['ans_tiempolibre'];
        $registro->ans_clubdeportivo=$data['ans_clubdeportivo'];
        $registro->ans_deporte=$data['ans_deporte'];
        $registro->ans_puestosindical=$data['ans_puestosindical'];
        $registro->ans_puestonombre=$data['ans_puestonombre'];
        $registro->ans_puestocargo=$data['ans_puestocargo'];
        $registro->ans_politico=$data['ans_politico'];
        $registro->ans_politiconombre=$data['ans_politiconombre'];
        $registro->ans_politicocargo=$data['ans_politicocargo'];
        $registro->ans_religion=$data['ans_religion'];
        $registro->ans_religionfrecuencia=$data['ans_religionfrecuencia'];
        $registro->ans_cortoplazo=$data['ans_cortoplazo'];
        $registro->ans_medianoplazo=$data['ans_medianoplazo'];
        $registro->ans_largoplazo=$data['ans_largoplazo'];
        $registro->ans_bebida=$data['ans_bebida'];
        $registro->ans_bebidafrecuencia=$data['ans_bebidafrecuencia'];
        $registro->ans_fumar=$data['ans_fumar'];
        $registro->ans_fumarfrecuencia=$data['ans_fumarfrecuencia'];
        $registro->ans_nota=$data['ans_nota'];
        
        if($permisocalificacion==1){
            $registro->ans_calificacion=$data['ans_calificacion'];
        }

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function getSiNo($id){
        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SI";
            default:
                return "";
        }
    }

    public function formatoeses($antecedente)
    {
        $reporte= new PdfReporte();
        $html=$reporte->antecedentesocial;
        $html=str_replace("#ans_tiempolibre#",trim($antecedente->ans_tiempolibre),$html);
        $html=str_replace("#ans_clubdeportivo#",$this->getSiNo($antecedente->ans_clubdeportivo),$html);
        $html=str_replace("#ans_deporte#",trim($antecedente->ans_deporte),$html);
        $html=str_replace("#ans_puestosindical#",$this->getSiNo($antecedente->ans_puestosindical),$html);
        $html=str_replace("#ans_puestonombre#",trim($antecedente->ans_puestonombre),$html);
        $html=str_replace("#ans_puestocargo#",trim($antecedente->ans_puestocargo),$html);
        $html=str_replace("#ans_politico#",$this->getSiNo($antecedente->ans_politico),$html);
        $html=str_replace("#ans_politiconombre#",trim($antecedente->ans_politiconombre),$html);
        $html=str_replace("#ans_politicocargo#",trim($antecedente->ans_politicocargo),$html);

        $html=str_replace("#ans_religion#",trim($antecedente->ans_religion),$html);
        $html=str_replace("#ans_religionfrecuencia#",trim($antecedente->ans_religionfrecuencia),$html);
        $html=str_replace("#ans_cortoplazo#",trim($antecedente->ans_cortoplazo),$html);
        $html=str_replace("#ans_medianoplazo#",trim($antecedente->ans_medianoplazo),$html);
        $html=str_replace("#ans_largoplazo#",trim($antecedente->ans_largoplazo),$html);

        $html=str_replace("#ans_bebida#",$this->getSiNo($antecedente->ans_bebida),$html);
        $html=str_replace("#ans_bebidafrecuencia#",trim($antecedente->ans_bebidafrecuencia),$html);

        $html=str_replace("#ans_fumar#",$this->getSiNo($antecedente->ans_fumar),$html);
        $html=str_replace("#ans_fumarfrecuencia#",trim($antecedente->ans_fumarfrecuencia),$html);

        $html=str_replace("#ans_nota#",trim($antecedente->ans_nota),$html);

        return $html;
    }

    public function econtrar_o_crear($ese_id){
        $condicion='ese_id='.$ese_id.' and ans_estatus=2';
        $answer['estado']=-2;

        $query=Antecedentesocial::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['ans_id']=$query[0]->ans_id;


        }else{
            $registro=new Antecedentesocial();
            $registro->ans_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['ans_id']=$registro->ans_id;

                $answer['estado']=2;
            } 
    

        }


        return $answer;
    }


    public function GuardarInformacionFormatoTruper($data,$usu_id=0,$permisocalificacion=0,$ese_id){

        $modelo= new Antecedentesocial();
        $repuesta_modelo=$modelo->econtrar_o_crear($ese_id);

        if($repuesta_modelo['estado']==2){
            $registro= Antecedentesocial::findFirstByans_id($repuesta_modelo['ans_id']);
        }

        $registro->ese_id= $ese_id;
        $registro->ans_fumar= $data['ans_fumar'];
        $registro->ans_droga= $data['ans_droga'];
        $registro->ans_bebida= $data['ans_bebida'];

        if($registro->save())
        {
            return['estado'=>2,'ese_id'=>$registro->ese_id,'ans_id'=> $registro->ans_id]; 
        }else{
            return['estado'=>-2]; 
        }
    }

   function GuardarInformacionBieneInmuebles_FormatoTruper($data,$usu_id=0,$permisocalificacion=0,$ese_id){

            $modelo= new Antecedentesocial();
            $repuesta_modelo=$modelo->econtrar_o_crear($ese_id);

            if($repuesta_modelo['estado']==2){
                $registro= Antecedentesocial::findFirstByans_id($repuesta_modelo['ans_id']);
            }

            $registro->ese_id= $ese_id;
            $registro->ans_clubsocial= $data['ans_clubsocial'];
            $registro->ans_clubsocialnombre= $data['ans_clubsocialnombre'];
            $registro->ans_tiempolibre= $data['ans_tiempolibre'];
            $registro->ans_deporte= $data['ans_deporte'];
            $registro->ans_deportepractica= $data['ans_deportepractica'];

            $registro->ans_religion= $data['ans_religion'];
            $registro->ans_deportefrecuencia= $data['ans_deportefrecuencia'];

            

            

            if($registro->save())
            {
                return['estado'=>2,'ese_id'=>$registro->ese_id,'ans_id'=> $registro->ans_id]; 
            }else{
                return['estado'=>-2]; 
            }
    }


    
    public function get_frecuencia_practica_deporte_formatotruper($valor_id){

        if($valor_id>=1 and $valor_id<= 4){
            $nombre_frecuencia= $this->frecuencia_practica_deporte_formatotruper[$valor_id-1]['nombre'];

        }else{
            $nombre_frecuencia='';
        }


        return  $nombre_frecuencia;

    }

    public function get_religion_profesa_formatotruper($valor_id){

        if($valor_id>=1 and $valor_id<= 8){
            $religion_nombre= $this->religion_profesa_formatotruper[$valor_id-1]['nombre'];

        }else{
            $religion_nombre='';
        }


        return  $religion_nombre;

    }

}
