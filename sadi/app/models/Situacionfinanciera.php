<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Situacionfinanciera extends Model
{

    public function getMenosAcero($value){

        if($value>0){
            return $value;

        }else{
            return '-';
        }
    }


    public function formatoEseTruper($ese_id,$data_situacion_eco_candidato,$data_situacion_eco_fam){

        $reporte= new PdfReporteTruper();
        $html=$reporte->datosfinacieros_ingreso_pagina_7;
        $formato_pdf=new FormatotruperPDF();
        //situacion economica candidato
        $html=str_replace("#sie_sueldoingreso#",$data_situacion_eco_candidato->sie_sueldoingreso,$html);

        $html=str_replace("#sie_alimentacion#",$this->getMenosAcero($data_situacion_eco_candidato->sie_alimentacion),$html);
        $html=str_replace("#sie_alimentacion-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_alimentacion),$html);


        $html=str_replace("#sie_ropacalzado#",$this->getMenosAcero($data_situacion_eco_candidato->sie_ropacalzado),$html);
        $html=str_replace("#sie_ropacalzado-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_ropacalzado),$html);

        $html=str_replace("#sie_serviciodomestico#",$this->getMenosAcero($data_situacion_eco_candidato->sie_serviciodomestico),$html);
        $html=str_replace("#sie_serviciodomestico-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_serviciodomestico),$html);

        $html=str_replace("#sie_escolares#",$this->getMenosAcero($data_situacion_eco_candidato->sie_escolares),$html);
        $html=str_replace("#sie_escolares-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_escolares),$html);


        $html=str_replace("#sie_creditos#",$this->getMenosAcero($data_situacion_eco_candidato->sie_creditos),$html);
        $html=str_replace("#sie_creditos-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_creditos),$html);

        $html=str_replace("#sie_seguros#",$this->getMenosAcero($data_situacion_eco_candidato->sie_seguros),$html);
        $html=str_replace("#sie_seguros-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_seguros),$html);
        
        $html=str_replace("#sie_hipoteca#",$this->getMenosAcero($data_situacion_eco_candidato->sie_hipoteca),$html);
        $html=str_replace("#sie_hipoteca-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_hipoteca),$html);

        $html=str_replace("#sie_diversiones#",$this->getMenosAcero($data_situacion_eco_candidato->sie_diversiones),$html);
        $html=str_replace("#sie_diversiones-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_diversiones),$html);

        $html=str_replace("#sie_mascotas#",$this->getMenosAcero($data_situacion_eco_candidato->sie_mascotas),$html);
        $html=str_replace("#sie_mascotas-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_mascotas),$html);

        $html=str_replace("#sie_ahorros#",$this->getMenosAcero($data_situacion_eco_candidato->sie_ahorros),$html);
        $html=str_replace("#sie_ahorros-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_ahorros),$html);

        $html=str_replace("#sie_renta#",$this->getMenosAcero($data_situacion_eco_candidato->sie_renta),$html);
        $html=str_replace("#sie_renta-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_renta),$html);

        $html=str_replace("#sie_otros#",$this->getMenosAcero($data_situacion_eco_candidato->sie_otros),$html);
        $html=str_replace("#sie_otros-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_otros),$html);

        $html=str_replace("#sie_otrosconcepto#",$data_situacion_eco_candidato->sie_otrosconcepto,$html);

        $html=str_replace("#sie_totalingresos#",$this->getMenosAcero($data_situacion_eco_candidato->sie_totalingresos),$html);
        $html=str_replace("#sie_totalingresos-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_totalingresos),$html);

        $html=str_replace("#sie_totalegresos#",$this->getMenosAcero($data_situacion_eco_candidato->sie_totalegresos),$html);
        $html=str_replace("#sie_totalegresos-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_candidato->sie_totalegresos),$html);

        $html=str_replace("#sie_solventa#",$data_situacion_eco_candidato->sie_solventa,$html);

        $situacioneconomicaingresos_candidato=new Builder();
        $situacioneconomicaingresos_candidato=$situacioneconomicaingresos_candidato
        ->addFrom('Situacioneconomicaingresos','sei')
        ->where('sie_id='.$data_situacion_eco_candidato->sie_id.' and sei_estatus=2 and sei_candidato=1')
        ->getQuery()
        ->execute();
        



        
        for ($i=0; $i <=5 ; $i++) {
        
       
            if($i<count($situacioneconomicaingresos_candidato)){
              
                $html=str_replace("#sei_concepto-$i#",$situacioneconomicaingresos_candidato[$i]->sei_concepto,$html);
                $html=str_replace("#sei_concepto-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($situacioneconomicaingresos_candidato[$i]->sei_concepto),$html);

                $html=str_replace("#sei_aportacion-$i#",$this->getMenosAcero($situacioneconomicaingresos_candidato[$i]->sei_aportacion),$html);
                $html=str_replace("#sei_aportacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($situacioneconomicaingresos_candidato[$i]->sei_aportacion),$html);

            }else{
  
                $html=str_replace("#sei_concepto-$i#",'',$html);
                $html=str_replace("#sei_concepto-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#sei_aportacion-$i#",$this->getMenosAcero(null),$html);
                $html=str_replace("#sei_aportacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero(null),$html);
            }

         

        }
        //situacion economica candidato

        //situacion econimica familiar

        
        $html=str_replace("#sef_conyugeingreso#",$this->getMenosAcero($data_situacion_eco_fam->sef_conyugeingreso),$html);
        $html=str_replace("#sef_conyugeingreso-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_conyugeingreso),$html);


        $html=str_replace("#sef_hijosadultosingreso#",$this->getMenosAcero($data_situacion_eco_fam->sef_hijosadultosingreso),$html);
        $html=str_replace("#sef_hijosadultosingreso-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_hijosadultosingreso),$html);


        $html=str_replace("#sef_hijosmenoresingreso#",$this->getMenosAcero($data_situacion_eco_fam->sef_hijosmenoresingreso),$html);
        $html=str_replace("#sef_hijosmenoresingreso-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_hijosmenoresingreso),$html);



        $html=str_replace("#sef_hermanosingreso#",$this->getMenosAcero($data_situacion_eco_fam->sef_hermanosingreso),$html);
        $html=str_replace("#sef_hermanosingreso-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_hermanosingreso),$html);



        $html=str_replace("#sef_padresingreso#",$this->getMenosAcero($data_situacion_eco_fam->sef_padresingreso),$html);
        $html=str_replace("#sef_padresingreso-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_padresingreso),$html);


        $html=str_replace("#sef_totalingresos#",$this->getMenosAcero($data_situacion_eco_fam->sef_totalingresos),$html);
        $html=str_replace("#sef_totalingresos-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_totalingresos),$html);



        $html=str_replace("#sef_alimentacion#",$this->getMenosAcero($data_situacion_eco_fam->sef_alimentacion),$html);
        $html=str_replace("#sef_alimentacion-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_alimentacion),$html);



        $html=str_replace("#sef_ropacalzado#",$this->getMenosAcero($data_situacion_eco_fam->sef_ropacalzado),$html);
        $html=str_replace("#sef_ropacalzado-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_ropacalzado),$html);

        $html=str_replace("#sef_serviciodomestico#",$this->getMenosAcero($data_situacion_eco_fam->sef_serviciodomestico),$html);
        $html=str_replace("#sef_serviciodomestico-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_serviciodomestico),$html);


        $html=str_replace("#sef_creditos#",$this->getMenosAcero($data_situacion_eco_fam->sef_creditos),$html);
        $html=str_replace("#sef_creditos-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_creditos),$html);

        $html=str_replace("#sef_hipotecas#",$this->getMenosAcero($data_situacion_eco_fam->sef_hipotecas),$html);
        $html=str_replace("#sef_hipotecas-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_hipotecas),$html);

        $html=str_replace("#sef_diversiones#",$this->getMenosAcero($data_situacion_eco_fam->sef_diversiones),$html);
        $html=str_replace("#sef_diversiones-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_diversiones),$html);
        
        $html=str_replace("#sef_mascotas#",$this->getMenosAcero($data_situacion_eco_fam->sef_mascotas),$html);
        $html=str_replace("#sef_mascotas-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_mascotas),$html);

        $html=str_replace("#sef_ahorro#",$this->getMenosAcero($data_situacion_eco_fam->sef_ahorro),$html);
        $html=str_replace("#sef_ahorro-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_ahorro),$html);
        
        $html=str_replace("#sef_renta#",$this->getMenosAcero($data_situacion_eco_fam->sef_renta),$html);
        $html=str_replace("#sef_renta-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_renta),$html);

        $html=str_replace("#sef_otros#",$this->getMenosAcero($data_situacion_eco_fam->sef_otros),$html);
        $html=str_replace("#sef_otros-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_otros),$html);

        $html=str_replace("#sef_renta#",$this->getMenosAcero($data_situacion_eco_fam->sef_renta),$html);
        $html=str_replace("#sef_renta-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_renta),$html);

        $html=str_replace("#sef_totalegresos#",$this->getMenosAcero($data_situacion_eco_fam->sef_totalegresos),$html);
        $html=str_replace("#sef_totalegresos-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_totalegresos),$html);
        
        $html=str_replace("#sef_seguros#",$this->getMenosAcero($data_situacion_eco_fam->sef_seguros),$html);
        $html=str_replace("#sef_seguros-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_seguros),$html);


        $html=str_replace("#sef_escolares#",$this->getMenosAcero($data_situacion_eco_fam->sef_escolares),$html);
        $html=str_replace("#sef_escolares-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($data_situacion_eco_fam->sef_escolares),$html);
        
        $html=str_replace("#sef_otrosconcepto#",$data_situacion_eco_fam->sef_otrosconcepto,$html);

        //ingresos familiar
        $situacioneconomicaingresos_fam=new Builder();
        $situacioneconomicaingresos_fam=$situacioneconomicaingresos_fam
        ->addFrom('Situacioneconomicaingresos','sei')
        ->where('sef_id='.$data_situacion_eco_fam->sef_id.' and sei_estatus=2 and sei_candidato=2')
        ->getQuery()
        ->execute();


        
        for ($i=0; $i <=3 ; $i++) {
        
       
            if($i<count($situacioneconomicaingresos_fam)){
              
                $html=str_replace("#sef_sei_parentesco-$i#",$situacioneconomicaingresos_fam[$i]->sei_parentesco,$html);
                $html=str_replace("#sef_sei_parentesco-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($situacioneconomicaingresos_fam[$i]->sei_parentesco),$html);


                $html=str_replace("#sef_sei_aportacion-$i#",$this->getMenosAcero($situacioneconomicaingresos_fam[$i]->sei_aportacion),$html);
                $html=str_replace("#sef_sei_aportacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero($situacioneconomicaingresos_fam[$i]->sei_aportacion),$html);

            }else{
  
                $html=str_replace("#sef_sei_parentesco-$i#",'',$html);
                $html=str_replace("#sef_sei_parentesco-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#sef_sei_aportacion-$i#",$this->getMenosAcero(null),$html);
                $html=str_replace("#sef_sei_aportacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_campo_dinero(null),$html);

            }

         

        }

        //situacion econimica familiar




        return $html;

    }


}