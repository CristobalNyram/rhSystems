<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Bieninmuebledetalles
 */
class Seccionpersonal extends Model
{

    
    public  $recomienda_datosreferencia=[
        1=>'RECOMENDABLE',
        2=>'RECOMENDABLE C / RESERVAS',
        3=>' --  NO -- RECOMENDABLE',       
   ];
   public function getRecomienda_formatotruper($id){

    if (array_key_exists($id, $this->recomienda_datosreferencia)) {
        return $this->recomienda_datosreferencia[$id];
        //return $id;
    }else{
         return '';
    }

}
    public function formatoeses($seccionpersonal, $referenciapersonal){
        $reporte= new PdfReporte();
        $html='';
        $htmlheader=$reporte->referenciaspersonalescabecera;
        $html.=$htmlheader;

        $detalles=count($referenciapersonal);

        for ($i=0; $i < $detalles ; $i++) {
            $htmlbody=$reporte->referenciapersonal;
            $htmlbody=str_replace("#rep_nombre#",trim($referenciapersonal[$i]->rep_nombre),$htmlbody);
            $htmlbody=str_replace("#rep_tiempo#",trim($referenciapersonal[$i]->rep_tiempo),$htmlbody);
            $htmlbody=str_replace("#rep_callenumero#",trim($referenciapersonal[$i]->rep_callenumero),$htmlbody);
            $htmlbody=str_replace("#rep_colonia#",trim($referenciapersonal[$i]->rep_colonia),$htmlbody);
            $htmlbody=str_replace("#rep_codpostal#",trim($referenciapersonal[$i]->rep_codpostal),$htmlbody);
            $htmlbody=str_replace("#rep_telefono#",trim($referenciapersonal[$i]->rep_telefono),$htmlbody);
            $htmlbody=str_replace("#rep_notas#",trim($referenciapersonal[$i]->rep_notas),$htmlbody);
            $html.=$htmlbody;
            if($i!=($detalles-1)){
               $html.= '<br>';
            }
        }
        return $html;
    }

    public function formatoesesvecinal($referenciavecinal){
        $reporte= new PdfReporte();
        $html='';
        
        $htmlheader=$reporte->referenciasvecinalescabecera;
        $html.=$htmlheader;

        $detalles=count($referenciavecinal);

        for ($i=0; $i < $detalles ; $i++) {
            $htmlbody=$reporte->referenciavecinal;
            $htmlbody=str_replace("#rev_nombre#",trim($referenciavecinal[$i]->rev_nombre),$htmlbody);
            $htmlbody=str_replace("#rev_tiempo#",trim($referenciavecinal[$i]->rev_tiempo),$htmlbody);
            $htmlbody=str_replace("#rev_domicilio#",trim($referenciavecinal[$i]->rev_domicilio),$htmlbody);
            $htmlbody=str_replace("#rev_telefono#",trim($referenciavecinal[$i]->rev_telefono),$htmlbody);
            $htmlbody=str_replace("#rev_conceptocandidato#",trim($referenciavecinal[$i]->rev_conceptocandidato),$htmlbody);
            $htmlbody=str_replace("#rev_conceptofamilia#",trim($referenciavecinal[$i]->rev_conceptofamilia),$htmlbody);
            $dat=new Estadocivil();
            $htmlbody=str_replace("#esc_id#",trim($dat->getNombreEstadoCivil($referenciavecinal[$i]->esc_id)),$htmlbody);
            $dat=new Referenciavecinal();
            $htmlbody=str_replace("#rev_hijos#",trim($dat->getSiNo($referenciavecinal[$i]->rev_hijos)),$htmlbody);
            $htmlbody=str_replace("#rev_trabaja#",trim($dat->getSiNo($referenciavecinal[$i]->rev_trabaja)),$htmlbody);
            $htmlbody=str_replace("#rev_notas#",trim($referenciavecinal[$i]->rev_notas),$htmlbody);
            $html.=$htmlbody;
        }
        return $html;
    }

    public function ActualizarRegistro($data,$permisoCalificacion)
    {

        if($permisoCalificacion==1)
        {
            $this->sep_calificacion=$data['sep_calificacion'];

        }


        if($this->update())
        {
            return  $respuesta=['estado'=>2,'ese_id'=> $this->ese_id,'sep_id'=>$this->sep_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

    public function formatogabtubos($seccionpersonal, $referenciapersonal){
        $reporte= new PdfReporteGabineteTubos();
        $html='';
        $htmlheader=$reporte->referenciaspersonalescabecera;
        $html.=$htmlheader;

        $detalles=count($referenciapersonal);

        for ($i=0; $i < $detalles ; $i++) {
            $htmlbody=$reporte->referenciapersonal;
            $htmlbody=str_replace("#rep_nombre#",trim($referenciapersonal[$i]->rep_nombre),$htmlbody);
            $htmlbody=str_replace("#rep_tiempo#",trim($referenciapersonal[$i]->rep_tiempo),$htmlbody);
            $htmlbody=str_replace("#rep_callenumero#",trim($referenciapersonal[$i]->rep_callenumero),$htmlbody);
            $htmlbody=str_replace("#rep_colonia#",trim($referenciapersonal[$i]->rep_colonia),$htmlbody);
            $htmlbody=str_replace("#rep_codpostal#",trim($referenciapersonal[$i]->rep_codpostal),$htmlbody);
            $htmlbody=str_replace("#rep_telefono#",trim($referenciapersonal[$i]->rep_telefono),$htmlbody);
            $htmlbody=str_replace("#rep_notas#",trim($referenciapersonal[$i]->rep_notas),$htmlbody);
            $html.=$htmlbody;
            if($i!=($detalles-1)){
               $html.= '<br>';
            }
        }
        return $html;
    }

    public function formatogabtubosvecinal($referenciavecinal){
        $reporte= new PdfReporteGabineteTubos();
        $html='';
        
        $htmlheader=$reporte->referenciasvecinalescabecera;
        $html.=$htmlheader;

        $detalles=count($referenciavecinal);

        for ($i=0; $i < $detalles ; $i++) {
            $htmlbody=$reporte->referenciavecinal;
            $htmlbody=str_replace("#rev_nombre#",trim($referenciavecinal[$i]->rev_nombre),$htmlbody);
            $htmlbody=str_replace("#rev_tiempo#",trim($referenciavecinal[$i]->rev_tiempo),$htmlbody);
            $htmlbody=str_replace("#rev_domicilio#",trim($referenciavecinal[$i]->rev_domicilio),$htmlbody);
            $htmlbody=str_replace("#rev_telefono#",trim($referenciavecinal[$i]->rev_telefono),$htmlbody);
            $htmlbody=str_replace("#rev_conceptocandidato#",trim($referenciavecinal[$i]->rev_conceptocandidato),$htmlbody);
            $htmlbody=str_replace("#rev_conceptofamilia#",trim($referenciavecinal[$i]->rev_conceptofamilia),$htmlbody);
            $dat=new Estadocivil();
            $htmlbody=str_replace("#esc_id#",trim($dat->getNombreEstadoCivil($referenciavecinal[$i]->esc_id)),$htmlbody);
            $dat=new Referenciavecinal();
            $htmlbody=str_replace("#rev_hijos#",trim($dat->getSiNo($referenciavecinal[$i]->rev_hijos)),$htmlbody);
            $htmlbody=str_replace("#rev_trabaja#",trim($dat->getSiNo($referenciavecinal[$i]->rev_trabaja)),$htmlbody);
            $htmlbody=str_replace("#rev_notas#",trim($referenciavecinal[$i]->rev_notas),$htmlbody);
            $html.=$htmlbody;
        }
        return $html;
    }

    public function crearRegistroAutomatico($ese_id){
        $nuevo_registro=new Seccionpersonal();
        $nuevo_registro->ese_id=$ese_id;
        $nuevo_registro->sep_estatus=2;
        
        if($nuevo_registro->save()){
            return ['estado'=>2,'mensaje'=>'ok','ese_id'=>$nuevo_registro->ese_id,'sep_id'=>$nuevo_registro->sep_id];

        }else{
            return ['estado'=>-2,'mensaje'=>'error'];
        }

    }

    public function encontrar_o_crear($ese_id){

        $condicion='ese_id='.$ese_id.' and sep_estatus=2';
        $answer['estado']=-2;

        $query=Seccionpersonal::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['sep_id']=$query[0]->sep_id;


        }else{
            $registro=new Seccionpersonal();
            $registro->sep_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['sep_id']=$registro->sep_id;
                $answer['estado']=2;
            } 
    

        }


        return $answer;
    }
}