<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla antecedentegrupofamiliar
 */
class Antecedentegrupofamiliar extends Model
{
    /*ActualizarRegistro [ actualiza un registro de la tabla antecedentegrupofamiliar]
    * @param   array $data 
    * @return  array['estado'=la operació fue exitosa o no,'agf_id' =el id que fue actualizado , 'ese_id']
    */
    public function ActualizarRegistro($data,$permisocalificacion)
    {
        $this->agf_padrescuentan=$data['agf_padrescuentan'];
        $this->agf_padresservicio=$data['agf_padresservicio'];
        $this->agf_conyugecuentan=$data['agf_conyugecuentan'];
        $this->agf_conyugeservicio=$data['agf_conyugeservicio'];
        $this->agf_notas=$data['agf_notas'];

        if($permisocalificacion==1)
        {   
            $this->agf_calificacion=$data['agf_calificacion'];

        }

            if($this->update())
            {
                return  $respuesta=['estado'=>2,'agf_id'=> $this->agf_id,'ese_id'=>$this->ese_id];
            }
            else
            {
                return  $respuesta=['estado'=>-2];
            }
        

    }

    public function getSiNo($id){
        switch ($id){
            case "0":
                return "NO";
            case "1":
                return "SI";
            case "2":
                return "NO APLICA";
            case "3":
                return "DESCONOCE";
            default:
                return "";
        }
    }

    public function formatoeses($antecedentelaboralfamiliar,$antecedentegrupofamiliardetalles)
    {
        $reporte= new PdfReporte();
        $html=$reporte->antecedenteslaboralesfamiliar;
        $html=str_replace("#agf_padrescuentan#",$this->getSiNo($antecedentelaboralfamiliar->agf_padrescuentan),$html);
        $html=str_replace("#agf_padresservicio".$i."#",trim($antecedentelaboralfamiliar->agf_padresservicio),$html);
        $html=str_replace("#agf_conyugecuentan#",$this->getSiNo($antecedentelaboralfamiliar->agf_conyugecuentan),$html);
        $html=str_replace("#agf_conyugeservicio".$i."#",trim($antecedentelaboralfamiliar->agf_conyugeservicio),$html);
        $html=str_replace("#agf_notas".$i."#",trim($antecedentelaboralfamiliar->agf_notas),$html);
        $detalles=count($antecedentegrupofamiliardetalles);

        for ($i=0; $i <= 10; $i++) {
            if($i<$detalles){
                $html=str_replace("#agd_nombre".$i."#",trim($antecedentegrupofamiliardetalles[$i]->agd_nombre),$html);
                $html=str_replace("#agd_empresa".$i."#",trim($antecedentegrupofamiliardetalles[$i]->agd_empresa),$html);
                $html=str_replace("#agd_puesto".$i."#",trim($antecedentegrupofamiliardetalles[$i]->agd_puesto),$html);
                $html=str_replace("#agd_antiguedad".$i."#",trim($antecedentegrupofamiliardetalles[$i]->agd_antiguedad),$html);
            }else{
                $html=str_replace("#agd_nombre".$i."#"," ",$html);
                $html=str_replace("#agd_empresa".$i."#"," ",$html);
                $html=str_replace("#agd_puesto".$i."#"," ",$html);
                $html=str_replace("#agd_antiguedad".$i."#"," ",$html);
            }
        }
        
        return $html;
    }

    /**
    * Crear un registro de manera automatica en la tabla Antecedentegrupofamiliar en caso de existir un registro activo retonar los ids de esa tabla
    *
    * @return array ['estado'=>'estado de la respuesta 2 es ok , -2 es error ','agf_id'=>'','ese_id'=>']
    * @param int $ese_id  
    */


    public function crearAutomaticoOTraerExistente($ese_id){

        $answer=[];
        
        // $antecedentegrupofamiliar_ese_activo=Antecedentegrupofamiliar::findFirst(["ese_id = '$ese_id'","agf_estatus = '2'"]);
        $antecedentegrupofamiliar_ese_activo=Antecedentegrupofamiliar::query()->where("ese_id=".$ese_id.' and agf_estatus = 2') ->execute(); 
        if(count($antecedentegrupofamiliar_ese_activo)>0){
            
            $answer['agf_id']=$antecedentegrupofamiliar_ese_activo[0]->agf_id;
            $answer['ese_id']=$antecedentegrupofamiliar_ese_activo[0]->ese_id;
            $answer['estado']=2;
            $answer['titular']='ok';
            $answer['mensaje']='se encontro';


            
        }else{
            $antecedentegrupofamiliar_crear= new Antecedentegrupofamiliar();
            $antecedentegrupofamiliar_crear->ese_id=$ese_id;
            $antecedentegrupofamiliar_crear->agf_estatus=2;

            if($antecedentegrupofamiliar_crear->save()){

                $answer['agf_id']=$antecedentegrupofamiliar_crear->agf_id;
                $answer['ese_id']=$antecedentegrupofamiliar_crear->ese_id;
                $answer['estado']=2;
                $answer['titular']='ok';
                $answer['mensaje']='se creo';


            }else{
          
                $answer['estado']=-2;
                $answer['mensaje']='error';
            }



        }

        return $answer;


    }
}