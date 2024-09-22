<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Evaluaciontruper
 */
class Evaluaciontruper extends Model
{
    public function encontrar_o_crear($ese_id){

        $condicion='ese_id='.$ese_id.' and evt_estatus=2';
        $answer['estado']=-2;

        $query=Evaluaciontruper::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['evt_id']=$query[0]->evt_id;


        }else{
            $registro=new Evaluaciontruper();
            $registro->evt_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['evt_id']=$registro->evt_id;
                $answer['ese_id']=$registro->ese_id;
                $answer['estado']=2;
            } 
    

        }


        return $answer;

    }


    public function  ActualizarRegistroFormatoTruper($data){

        $this->evt_entornosocioecoacorde=$data['evt_entornosocioecoacorde'];
        $this->evt_vivendaacordeentornofam=$data['evt_vivendaacordeentornofam'];
        $this->evt_infovisitacoincide=$data['evt_infovisitacoincide'];
        $this->evt_candibuenactituinform=$data['evt_candibuenactituinform'];
        $this->evt_infodentrocasacandi=$data['evt_infodentrocasacandi'];
      
        $this->evt_canditodainfo=$data['evt_canditodainfo'];
        $this->evt_problemaagendaentrevista=$data['evt_problemaagendaentrevista'];
        $this->evt_problemaagendaentrevistacual=$data['evt_problemaagendaentrevistacual'];

        $this->evt_problemavisita=$data['evt_problemavisita'];
        $this->evt_problemavisitacual=$data['evt_problemavisitacual'];
        $this->evt_problemaanlisisinfo=$data['evt_problemaanlisisinfo'];
        $this->evt_problemaanlisisinfocual=$data['evt_problemaanlisisinfocual'];
        $this->evt_resumen=$data['evt_resumen'];
       


        if($this->update()){
            return  $repuesta=['estado'=>2,'evt_id'=> $this->evt_id,'ese_id'=> $this->ese_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }
    public function getSiONo($valor){

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

    public function formatoEseTruper($ese_id,$evalucion_truper_data){
        $reporte= new PdfReporteTruper();
        $formato_pdf=new FormatotruperPDF();

        $html=$reporte->evaluaciontruper_pagina_13;

        $html=str_replace("#evt_entornosocioecoacorde#",trim($this->getSiONo($evalucion_truper_data->evt_entornosocioecoacorde)),$html);
        $html=str_replace("#evt_entornosocioecoacorde-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_entornosocioecoacorde), $html);

        $html=str_replace("#evt_entornosocioecoacorde#",trim($this->getSiONo($evalucion_truper_data->evt_entornosocioecoacorde)),$html);
        $html=str_replace("#evt_entornosocioecoacorde-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_entornosocioecoacorde), $html);

        $html=str_replace("#evt_vivendaacordeentornofam#",trim($this->getSiONo($evalucion_truper_data->evt_vivendaacordeentornofam)),$html);
        $html=str_replace("#evt_vivendaacordeentornofam-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_vivendaacordeentornofam), $html);


        $html=str_replace("#evt_infovisitacoincide#",trim($this->getSiONo($evalucion_truper_data->evt_infovisitacoincide)),$html);
        $html=str_replace("#evt_infovisitacoincide-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_infovisitacoincide), $html);

        $html=str_replace("#evt_candibuenactituinform#",trim($this->getSiONo($evalucion_truper_data->evt_candibuenactituinform)),$html);
        $html=str_replace("#evt_candibuenactituinform-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_candibuenactituinform), $html);


        $html=str_replace("#evt_infodentrocasacandi#",trim($this->getSiONo($evalucion_truper_data->evt_infodentrocasacandi)),$html);
        $html=str_replace("#evt_infodentrocasacandi-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_infodentrocasacandi), $html);

        $html=str_replace("#evt_canditodainfo#",trim($this->getSiONo($evalucion_truper_data->evt_canditodainfo)),$html);
        $html=str_replace("#evt_canditodainfo-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_canditodainfo), $html);

        $html=str_replace("#evt_problemaagendaentrevista#",trim($this->getSiONo($evalucion_truper_data->evt_problemaagendaentrevista)),$html);
        $html=str_replace("#evt_problemaagendaentrevista-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_problemaagendaentrevista), $html);



        $html=str_replace("#evt_problemaagendaentrevistacual#",trim($evalucion_truper_data->evt_problemaagendaentrevistacual),$html);
        $html=str_replace("#evt_problemaagendaentrevistacual-style_bg#",$formato_pdf->verificar_si_es_vacio_td($evalucion_truper_data->evt_problemaagendaentrevistacual), $html);

        $html=str_replace("#evt_problemavisita#",trim($this->getSiONo($evalucion_truper_data->evt_problemavisita)),$html);
        $html=str_replace("#evt_problemavisita-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_problemavisita), $html);

        $html=str_replace("#evt_problemavisitacual#",trim($evalucion_truper_data->evt_problemavisitacual),$html);
        $html=str_replace("#evt_problemavisitacual-style_bg#",$formato_pdf->verificar_si_es_vacio_td($evalucion_truper_data->evt_problemavisitacual), $html);

        $html=str_replace("#evt_problemaanlisisinfo#",trim($this->getSiONo($evalucion_truper_data->evt_problemaanlisisinfo)),$html);
        $html=str_replace("#evt_problemaanlisisinfo-style_bg#",$formato_pdf->verificar_si_es_vacio_select($evalucion_truper_data->evt_problemaanlisisinfo), $html);

        $html=str_replace("#evt_problemaanlisisinfocual#",trim($evalucion_truper_data->evt_problemaanlisisinfocual),$html);
        $html=str_replace("#evt_problemaanlisisinfocual-style_bg#",$formato_pdf->verificar_si_es_vacio_td($evalucion_truper_data->evt_problemaanlisisinfocual), $html);

        $html=str_replace("#evt_resumen#",trim($evalucion_truper_data->evt_resumen),$html);
        $html=str_replace("#evt_resumen-style_bg#",$formato_pdf->verificar_si_es_vacio_td($evalucion_truper_data->evt_resumen), $html);


        

        
      /*  $html=str_replace("#rel_notas-$i#",trim($referencialaboral_data_consulta[$i]->rel_notas),$html);
        $html=str_replace("#rel_notas-$i#",trim($referencialaboral_data_consulta[$i]->rel_notas),$html);
        $html=str_replace("#rel_notas-$i#",trim($referencialaboral_data_consulta[$i]->rel_notas),$html);
        $html=str_replace("#rel_notas-$i#",trim($referencialaboral_data_consulta[$i]->rel_notas),$html);
*/
        return $html;
    }
}