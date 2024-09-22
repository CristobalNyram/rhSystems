<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Bieninmuebledetalles
 */
class Referencias extends Model
{

    public function getComentarioFormato($value){

        if(is_null($value) || $value==''){
            return ' sin comentarios';
        }else{
            return $value;

        }

    }

    public function formatoEseTruper($ese_id,$seccionpersonal_data,$referenciavecinal_data,$referenciafamiliar_data,$referenciaspersonales_data){
        $reporte= new PdfReporteTruper();
        $html=$reporte->datosreferencia_pagina_12;

        $obj_seccion_personal= new Seccionpersonal();
        $formato_pdf=new FormatotruperPDF();


        for ($i=0; $i <= 1; $i++) {
        
            
            if($i<count($referenciavecinal_data)){
             
                $html=str_replace("#rev_nombre-$i#",trim($referenciavecinal_data[$i]->rev_nombre),$html);
                $html=str_replace("#rev_nombre-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_nombre),$html);

                $html=str_replace("#rev_edad-$i#",trim($referenciavecinal_data[$i]->rev_edad),$html);
                $html=str_replace("#rev_edad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_edad),$html);

                $html=str_replace("#rev_telefono-$i#",trim($referenciavecinal_data[$i]->rev_telefono),$html);
                $html=str_replace("#rev_telefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_telefono),$html);

                $html=str_replace("#rev_domicilio-$i#",trim($referenciavecinal_data[$i]->rev_domicilio),$html);
                $html=str_replace("#rev_domicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_domicilio),$html);

                $html=str_replace("#rev_tiempo-$i#",trim($referenciavecinal_data[$i]->rev_tiempo),$html);
                $html=str_replace("#rev_tiempo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_tiempo),$html);

                $html=str_replace("#rev_comoloconocio-$i#",trim($referenciavecinal_data[$i]->rev_comoloconocio),$html);
                $html=str_replace("#rev_comoloconocio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_comoloconocio),$html);

                $html=str_replace("#rev_conocesudomicilio-$i#",trim($referenciavecinal_data[$i]->rev_conocesudomicilio),$html);
                $html=str_replace("#rev_conocesudomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_conocesudomicilio),$html);

                $html=str_replace("#rev_conocesuestadocivil-$i#",trim($referenciavecinal_data[$i]->rev_conocesuestadocivil),$html);
                $html=str_replace("#rev_conocesuestadocivil-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_conocesuestadocivil),$html);

                $html=str_replace("#rev_conocesupasatiempos-$i#",trim($referenciavecinal_data[$i]->rev_conocesupasatiempos),$html);
                $html=str_replace("#rev_conocesupasatiempos-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_conocesupasatiempos),$html);

                $html=str_replace("#rev_conocesuempleo-$i#",trim($referenciavecinal_data[$i]->rev_conocesuempleo),$html);
                $html=str_replace("#rev_conocesuempleo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_conocesuempleo),$html);

                $html=str_replace("#rev_conceptodeelella-$i#",trim($referenciavecinal_data[$i]->rev_conceptodeelella),$html);
                $html=str_replace("#rev_conceptodeelella-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciavecinal_data[$i]->rev_conceptodeelella),$html);

                $html=str_replace("#rev_lorecomienda-$i#",trim($obj_seccion_personal->getRecomienda_formatotruper($referenciavecinal_data[$i]->rev_lorecomienda)),$html);
                $html=str_replace("#rev_lorecomienda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referenciavecinal_data[$i]->rev_lorecomienda),$html);

                $html=str_replace("#rev_notas-$i#",trim('Comentario de referencia vecinal '.($i+1) .': '.$this->getComentarioFormato($referenciavecinal_data[$i]->rev_notas)),$html);

                
            }else{
     
                $html=str_replace("#rev_nombre-$i#",'',$html);
                $html=str_replace("#rev_nombre-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_edad-$i#",'',$html);
                $html=str_replace("#rev_edad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_telefono-$i#",'',$html);
                $html=str_replace("#rev_telefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_domicilio-$i#",'',$html);
                $html=str_replace("#rev_domicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_tiempo-$i#",'',$html);
                $html=str_replace("#rev_tiempo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_comoloconocio-$i#",'',$html);
                $html=str_replace("#rev_comoloconocio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_conocesudomicilio-$i#",'',$html);
                $html=str_replace("#rev_conocesudomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_conocesuestadocivil-$i#",'',$html);
                $html=str_replace("#rev_conocesuestadocivil-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_conocesupasatiempos-$i#",'',$html);
                $html=str_replace("#rev_conocesupasatiempos-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_conocesuempleo-$i#",'',$html);
                $html=str_replace("#rev_conocesuempleo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_conceptodeelella-$i#",'',$html);
                $html=str_replace("#rev_conceptodeelella-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_lorecomienda-$i#",'',$html);
                $html=str_replace("#rev_lorecomienda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rev_notas-$i#",'Comentario de referencia vecinal '.($i+1).': sin comentarios',$html);
            }


        }

        for ($i=0; $i <= 1; $i++) {
        
       
            if($i<count($referenciafamiliar_data)){
             
                $html=str_replace("#ref_nombre-$i#",trim($referenciafamiliar_data[$i]->ref_nombre),$html);
                $html=str_replace("#ref_nombre-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_nombre),$html);

                $html=str_replace("#ref_edad-$i#",trim($referenciafamiliar_data[$i]->ref_edad),$html);
                $html=str_replace("#ref_edad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_edad),$html);

                $html=str_replace("#ref_telefono-$i#",trim($referenciafamiliar_data[$i]->ref_telefono),$html);
                $html=str_replace("#ref_telefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_telefono),$html);

                $html=str_replace("#ref_parentesco-$i#",trim($referenciafamiliar_data[$i]->ref_parentesco),$html);
                $html=str_replace("#ref_parentesco-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_parentesco),$html);

                $html=str_replace("#ref_ocupacion-$i#",trim($referenciafamiliar_data[$i]->ref_ocupacion),$html);
                $html=str_replace("#ref_ocupacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_ocupacion),$html);

                $html=str_replace("#ref_direccion-$i#",trim($referenciafamiliar_data[$i]->ref_direccion),$html);
                $html=str_replace("#ref_direccion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_direccion),$html);

                $html=str_replace("#ref_conocesuempleo-$i#",trim($referenciafamiliar_data[$i]->ref_conocesuempleo),$html);
                $html=str_replace("#ref_conocesuempleo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciafamiliar_data[$i]->ref_conocesuempleo),$html);

                $html=str_replace("#ref_lorecomienda-$i#",trim($obj_seccion_personal->getRecomienda_formatotruper($referenciafamiliar_data[$i]->ref_lorecomienda)),$html);
                $html=str_replace("#ref_lorecomienda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referenciafamiliar_data[$i]->ref_lorecomienda),$html);

                $html=str_replace("#ref_comentario-$i#",trim('Comentario de referencia familiar '.($i+1).':  '.$this->getComentarioFormato($referenciafamiliar_data[$i]->ref_comentario)),$html);

                
                
                
            }else{
     
                $html=str_replace("#ref_nombre-$i#",'',$html);
                $html=str_replace("#ref_nombre-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_edad-$i#",'',$html);
                $html=str_replace("#ref_edad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_parentesco-$i#",'',$html);
                $html=str_replace("#ref_parentesco-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_ocupacion-$i#",'',$html);
                $html=str_replace("#ref_ocupacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_direccion-$i#",'',$html);
                $html=str_replace("#ref_direccion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_conocesuempleo-$i#",'',$html);
                $html=str_replace("#ref_conocesuempleo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_lorecomienda-$i#",'',$html);
                $html=str_replace("#ref_lorecomienda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#ref_comentario-$i#",'Comentario de referencia familiar '.($i+1) .': sin comentarios ',$html);

            }


        }


        for ($i=0; $i <= 1; $i++) {
        
       
            if($i<count($referenciaspersonales_data)){
             
                $html=str_replace("#rep_nombre-$i#",trim($referenciaspersonales_data[$i]->rep_nombre),$html);
                $html=str_replace("#rep_nombre-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_nombre),$html);

             
                $html=str_replace("#rep_edad-$i#",trim($referenciaspersonales_data[$i]->rep_edad),$html);
                $html=str_replace("#rep_edad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_edad),$html);

                $html=str_replace("#rep_telefono-$i#",trim($referenciaspersonales_data[$i]->rep_telefono),$html);
                $html=str_replace("#rep_telefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_telefono),$html);

                $html=str_replace("#rep_direccioncompleta-$i#",trim($referenciaspersonales_data[$i]->rep_direccioncompleta),$html);
                $html=str_replace("#rep_direccioncompleta-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_direccioncompleta),$html);

                $html=str_replace("#rep_empresatrabaja-$i#",trim($referenciaspersonales_data[$i]->rep_empresatrabaja),$html);
                $html=str_replace("#rep_empresatrabaja-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_empresatrabaja),$html);

                $html=str_replace("#rep_tiempo-$i#",trim($referenciaspersonales_data[$i]->rep_tiempo),$html);
                $html=str_replace("#rep_tiempo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_tiempo),$html);

                $html=str_replace("#rep_comoloconocio-$i#",trim($referenciaspersonales_data[$i]->rep_comoloconocio),$html);
                $html=str_replace("#rep_comoloconocio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_comoloconocio),$html);

                $html=str_replace("#rep_conocesudomicilio-$i#",trim($referenciaspersonales_data[$i]->rep_conocesudomicilio),$html);
                $html=str_replace("#rep_conocesudomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_conocesudomicilio),$html);


                $html=str_replace("#rep_estadocivil-$i#",trim($referenciaspersonales_data[$i]->rep_estadocivil),$html);
                $html=str_replace("#rep_estadocivil-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_estadocivil),$html);

                $html=str_replace("#rep_conocedonhatrabajado-$i#",trim($referenciaspersonales_data[$i]->rep_conocedonhatrabajado),$html);
                $html=str_replace("#rep_conocedonhatrabajado-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_conocedonhatrabajado),$html);


                $html=str_replace("#rep_pasatiempos-$i#",trim($referenciaspersonales_data[$i]->rep_pasatiempos),$html);
                $html=str_replace("#rep_pasatiempos-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_pasatiempos),$html);

                $html=str_replace("#rep_conceptocomopersona-$i#",trim($referenciaspersonales_data[$i]->rep_conceptocomopersona),$html);
                $html=str_replace("#rep_conceptocomopersona-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_conceptocomopersona),$html);

                $html=str_replace("#rep_lorecomienda-$i#",trim($obj_seccion_personal->getRecomienda_formatotruper($referenciaspersonales_data[$i]->rep_lorecomienda)),$html);
                $html=str_replace("#rep_lorecomienda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referenciaspersonales_data[$i]->rep_lorecomienda),$html);

                $html=str_replace("#rep_notas-$i#",trim('Comentario de referencia personal '.($i+1).':'. $this->getComentarioFormato($referenciaspersonales_data[$i]->rep_notas)),$html);

                $html=str_replace("#rep_ocupacion-$i#",trim($referenciaspersonales_data[$i]->rep_ocupacion ),$html);
                $html=str_replace("#rep_ocupacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referenciaspersonales_data[$i]->rep_ocupacion),$html);



            }else{
                $html=str_replace("#rep_nombre-$i#",'',$html);
                $html=str_replace("#rep_nombre-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_edad-$i#",'',$html);
                $html=str_replace("#rep_edad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_telefono-$i#",'',$html);
                $html=str_replace("#rep_telefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_direccioncompleta-$i#",'',$html);
                $html=str_replace("#rep_direccioncompleta-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_empresatrabaja-$i#",'',$html);
                $html=str_replace("#rep_empresatrabaja-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_tiempo-$i#",'',$html);
                $html=str_replace("#rep_tiempo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_comoloconocio-$i#",'',$html);
                $html=str_replace("#rep_comoloconocio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_conocesudomicilio-$i#",'',$html);
                $html=str_replace("#rep_conocesudomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_estadocivil-$i#",'',$html);
                $html=str_replace("#rep_estadocivil-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_conocedonhatrabajado-$i#",'',$html);
                $html=str_replace("#rep_conocedonhatrabajado-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_ocupacion-$i#",'',$html);
                $html=str_replace("#rep_ocupacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                
                $html=str_replace("#rep_pasatiempos-$i#",'',$html);
                $html=str_replace("#rep_pasatiempos-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_conceptocomopersona-$i#",'',$html);
                $html=str_replace("#rep_conceptocomopersona-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_lorecomienda-$i#",'',$html);
                $html=str_replace("#rep_lorecomienda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rep_notas-$i#",'Comentario de referencia personal '.($i+1) .': sin comentarios',$html);

            }


        }


        return $html;
    }

}