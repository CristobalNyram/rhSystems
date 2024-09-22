<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Datocomprobatorio extends Model
{

    public function NuevoRegistro($datos,$permisocalificacion=0)
    {
        $repuesta =[];
        $nuevoDatoComprobatorio= new Datocomprobatorio();

        $nuevoDatoComprobatorio->cop_nacimientofecha=$datos['cop_nacimientofecha'];
        $nuevoDatoComprobatorio->cop_nacimientolugar=$datos['cop_nacimientolugar'];
        $nuevoDatoComprobatorio->cop_nacimientofolio=$datos['cop_nacimientofolio'];

        $nuevoDatoComprobatorio->cop_matrimoniofecha=$datos['cop_matrimoniofecha'];
        $nuevoDatoComprobatorio->cop_matrimoniolugar=$datos['cop_matrimoniolugar'];
        $nuevoDatoComprobatorio->cop_matrimoniofolio=$datos['cop_matrimoniofolio'];

        $nuevoDatoComprobatorio->cop_conyugefecha=$datos['cop_conyugefecha'];
        $nuevoDatoComprobatorio->cop_conyugelugar=$datos['cop_conyugelugar'];
        $nuevoDatoComprobatorio->cop_conyugefolio=$datos['cop_conyugefolio'];

        $nuevoDatoComprobatorio->cop_nacimientohijosfecha=$datos['cop_nacimientohijosfecha'];
        $nuevoDatoComprobatorio->cop_nacimientohijoslugar=$datos['cop_nacimientohijoslugar'];
        $nuevoDatoComprobatorio->cop_nacimientohijosfolio=$datos['cop_nacimientohijosfolio'];

        $nuevoDatoComprobatorio->cop_comprobantedomiciliofecha=$datos['cop_comprobantedomiciliofecha'];
        $nuevoDatoComprobatorio->cop_comprobantedomiciliolugar=$datos['cop_comprobantedomiciliolugar'];
        $nuevoDatoComprobatorio->cop_comprobantedomiciliofolio=$datos['cop_comprobantedomiciliofolio'];

        $nuevoDatoComprobatorio->cop_credencialelectorfecha=$datos['cop_credencialelectorfecha'];
        $nuevoDatoComprobatorio->cop_credencialelectorlugar=$datos['cop_credencialelectorlugar'];
        $nuevoDatoComprobatorio->cop_credencialelectorfolio=$datos['cop_credencialelectorfolio'];

        $nuevoDatoComprobatorio->cop_curpfecha=$datos['cop_curpfecha'];
        $nuevoDatoComprobatorio->cop_curplugar=$datos['cop_curplugar'];
        $nuevoDatoComprobatorio->cop_curpfolio=$datos['cop_curpfolio'];

        $nuevoDatoComprobatorio->cop_imssfecha=$datos['cop_imssfecha'];
        $nuevoDatoComprobatorio->cop_imsslugar=$datos['cop_imsslugar'];
        $nuevoDatoComprobatorio->cop_imssfolio=$datos['cop_imssfolio'];

        $nuevoDatoComprobatorio->cop_retencionfecha=$datos['cop_retencionfecha'];
        $nuevoDatoComprobatorio->cop_retencionlugar=$datos['cop_retencionlugar'];
        $nuevoDatoComprobatorio->cop_retencionfolio=$datos['cop_retencionfolio'];

        $nuevoDatoComprobatorio->cop_rfcfecha=$datos['cop_rfcfecha'];
        $nuevoDatoComprobatorio->cop_rfclugar=$datos['cop_rfclugar'];
        $nuevoDatoComprobatorio->cop_rfcfolio=$datos['cop_rfcfolio'];

        $nuevoDatoComprobatorio->cop_cartillafecha=$datos['cop_cartillafecha'];
        $nuevoDatoComprobatorio->cop_cartillalugar=$datos['cop_cartillalugar'];
        $nuevoDatoComprobatorio->cop_cartillafolio=$datos['cop_cartillafolio'];

        $nuevoDatoComprobatorio->cop_licenciafecha=$datos['cop_licenciafecha'];
        $nuevoDatoComprobatorio->cop_licencialugar=$datos['cop_licencialugar'];
        $nuevoDatoComprobatorio->cop_licenciafolio=$datos['cop_licenciafolio'];
        
        $nuevoDatoComprobatorio->cop_migratoriafecha=$datos['cop_migratoriafecha'];
        $nuevoDatoComprobatorio->cop_migratorialugar=$datos['cop_migratorialugar'];
        $nuevoDatoComprobatorio->cop_migratoriafolio=$datos['cop_migratoriafolio'];

        $nuevoDatoComprobatorio->ese_id=$datos['cop_ese_id'];
        $nuevoDatoComprobatorio->cop_estatus=2;
        if($permisocalificacion==1)
        {
        $nuevoDatoComprobatorio->cop_calificacion= ($datos['cop_calificacion']!= -1) ?$datos['cop_calificacion']:null;
        }
        if($nuevoDatoComprobatorio->save())
        {
            return  $repuesta=['estado'=>2,'id_nuevo'=>$nuevoDatoComprobatorio->cop_id];
        }
        else
        {
            return  $repuesta=['estado'=>0,];
        }




    }

    public function ActualizarRegistro($datos,$permisocalificacion=0)
    {

        $this->cop_nacimientofecha=$datos['cop_nacimientofecha'];
        $this->cop_nacimientolugar=$datos['cop_nacimientolugar'];
        $this->cop_nacimientofolio=$datos['cop_nacimientofolio'];

        $this->cop_matrimoniofecha=$datos['cop_matrimoniofecha'];
        $this->cop_matrimoniolugar=$datos['cop_matrimoniolugar'];
        $this->cop_matrimoniofolio=$datos['cop_matrimoniofolio'];

        $this->cop_conyugefecha=$datos['cop_conyugefecha'];
        $this->cop_conyugelugar=$datos['cop_conyugelugar'];
        $this->cop_conyugefolio=$datos['cop_conyugefolio'];

        $this->cop_nacimientohijosfecha=$datos['cop_nacimientohijosfecha'];
         $this->cop_nacimientohijoslugar=$datos['cop_nacimientohijoslugar'];
        $this->cop_nacimientohijosfolio=$datos['cop_nacimientohijosfolio'];

        $this->cop_comprobantedomiciliofecha=$datos['cop_comprobantedomiciliofecha'];
        $this->cop_comprobantedomiciliolugar=$datos['cop_comprobantedomiciliolugar'];
        $this->cop_comprobantedomiciliofolio=$datos['cop_comprobantedomiciliofolio'];

        $this->cop_credencialelectorfecha=$datos['cop_credencialelectorfecha'];
        $this->cop_credencialelectorlugar=$datos['cop_credencialelectorlugar'];
        $this->cop_credencialelectorfolio=$datos['cop_credencialelectorfolio'];

        $this->cop_curpfecha=$datos['cop_curpfecha'];
        $this->cop_curplugar=$datos['cop_curplugar'];
        $this->cop_curpfolio=$datos['cop_curpfolio'];

        $this->cop_imssfecha=$datos['cop_imssfecha'];
        $this->cop_imsslugar=$datos['cop_imsslugar'];
        $this->cop_imssfolio=$datos['cop_imssfolio'];

        $this->cop_retencionfecha=$datos['cop_retencionfecha'];
        $this->cop_retencionlugar=$datos['cop_retencionlugar'];
        $this->cop_retencionfolio=$datos['cop_retencionfolio'];

        $this->cop_rfcfecha=$datos['cop_rfcfecha'];
        $this->cop_rfclugar=$datos['cop_rfclugar'];
        $this->cop_rfcfolio=$datos['cop_rfcfolio'];

        $this->cop_cartillafecha=$datos['cop_cartillafecha'];
        $this->cop_cartillalugar=$datos['cop_cartillalugar'];
        $this->cop_cartillafolio=$datos['cop_cartillafolio'];

        $this->cop_licenciafecha=$datos['cop_licenciafecha'];
        $this->cop_licencialugar=$datos['cop_licencialugar'];
        $this->cop_licenciafolio=$datos['cop_licenciafolio'];
        
        $this->cop_migratoriafecha=$datos['cop_migratoriafecha'];
        $this->cop_migratorialugar=$datos['cop_migratorialugar'];
        $this->cop_migratoriafolio=$datos['cop_migratoriafolio'];

        $this->ese_id=$datos['cop_ese_id'];
        $this->cop_estatus=2;
        if($permisocalificacion==1)
        {
            $this->cop_calificacion= ($datos['cop_calificacion']!= -1) ?$datos['cop_calificacion']:null;

        }

        if($this->save())
        {
            return  $repuesta=['estado'=>2,'id_actualizo'=>$this->cop_id];
        }
        else
        {
            return  $repuesta=['estado'=>0];
        }
        
    }

    public function getSexo($id)
    {
        if ($id == 1) 
        {
            return 'FEMENINO';
        }
        if ($id == 2) 
        {
            return 'MASCULINO';
        }
        return "";
    }

    public function encontrar_o_crear($ese_id){


        $condicion='ese_id='.$ese_id.' and cop_estatus=2';
        $answer['estado']=-2;

        $query=Datocomprobatorio::query()
        ->where($condicion)
        ->limit(1)
        ->execute();

        if(count($query)>0){
            $answer['data']=$query[0];
            $answer['estado']=2;
            $answer['cop_id']=$query[0]->cop_id;


        }else{
            $registro=new Datocomprobatorio();
            $registro->cop_estatus=2;
            $registro->ese_id=$ese_id;
            
            if($registro->save()){
                $answer['data']=$registro;
                $answer['cop_id']=$registro->cop_id;

                $answer['estado']=2;
            } 
    

        }


        return $answer;
    }

   

    public function ActualizarFormatoTruper($datos){
        $this->cop_nacimientocantidad=$datos['cop_nacimientocantidad'];
        $this->cop_nacimientotipodoc=$datos['cop_nacimientotipodoc'];
        $this->cop_nacimientofolio=$datos['cop_nacimientofolio'];
        $this->cop_nacimientocomentario=$datos['cop_nacimientocomentario'];


        $this->cop_matrimoniotipodoc=$datos['cop_matrimoniotipodoc'];
        $this->cop_matrimoniocantidad=$datos['cop_matrimoniocantidad'];
        $this->cop_matrimoniofolio=$datos['cop_matrimoniofolio'];
        $this->cop_matrimoniocomentario=$datos['cop_matrimoniocomentario'];


        $this->cop_conyugecantidad=$datos['cop_conyugecantidad'];
        $this->cop_conyugetipodoc=$datos['cop_conyugetipodoc'];
        $this->cop_conyugefolio=$datos['cop_conyugefolio'];
        $this->cop_conyugecomentario=$datos['cop_conyugecomentario'];


        $this->cop_nacimientohijosfolio=$datos['cop_nacimientohijosfolio'];
        $this->cop_nacimientohijoscomentario=$datos['cop_nacimientohijoscomentario'];
        $this->cop_nacimientohijoscantidad=$datos['cop_nacimientohijoscantidad'];
        $this->cop_nacimientohijostipodoc=$datos['cop_nacimientohijostipodoc'];


        $this->cop_comprobantedomiciliocantidad=$datos['cop_comprobantedomiciliocantidad'];
        $this->cop_comprobantedomiciliotipodoc=$datos['cop_comprobantedomiciliotipodoc'];
        $this->cop_comprobantedomiciliocomentario=$datos['cop_comprobantedomiciliocomentario'];
        $this->cop_comprobantedomiciliofolio=$datos['cop_comprobantedomiciliofolio'];


        $this->cop_credencialelectorcantidad=$datos['cop_credencialelectorcantidad'];
        $this->cop_credencialelectortipodoc=$datos['cop_credencialelectortipodoc'];
        $this->cop_credencialelectorfolio=$datos['cop_credencialelectorfolio'];
        $this->cop_credencialelectorcomentario=$datos['cop_credencialelectorcomentario'];

        $this->cop_curptipodoc=$datos['cop_curptipodoc'];
        $this->cop_curpcantidad=$datos['cop_curpcantidad'];
        $this->cop_curpfolio=$datos['cop_curpfolio'];
        $this->cop_curpcomentario=$datos['cop_curpcomentario'];


        $this->cop_imsstipodoc=$datos['cop_imsstipodoc'];
        $this->cop_imsscantidad=$datos['cop_imsscantidad'];
        $this->cop_imssfolio=$datos['cop_imssfolio'];
        $this->cop_imsscomentario=$datos['cop_imsscomentario'];

        
        $this->cop_rfccantidad=$datos['cop_rfccantidad'];
        $this->cop_rfctipodoc=$datos['cop_rfctipodoc'];
        $this->cop_rfccomentario=$datos['cop_rfccomentario'];
        $this->cop_rfcfolio=$datos['cop_rfcfolio'];


        
        $this->cop_cartillatipodoc=$datos['cop_cartillatipodoc'];
        $this->cop_cartillacantidad=$datos['cop_cartillacantidad'];
        $this->cop_cartillafolio=$datos['cop_cartillafolio'];
        $this->cop_cartillacomentario=$datos['cop_cartillacomentario'];


        
       $this->cop_licenciacantidad=$datos['cop_licenciacantidad'];
        $this->cop_licenciatipodoc=$datos['cop_licenciatipodoc'];
        $this->cop_licenciafolio=$datos['cop_licenciafolio'];
        $this->cop_licenciacomentario=$datos['cop_licenciacomentario'];


        
        $this->cop_visafolio=$datos['cop_visafolio'];
        $this->cop_visatipodoc=$datos['cop_visatipodoc'];
        $this->cop_visacantidad=$datos['cop_visacantidad'];
        $this->cop_visacomentario=$datos['cop_visacomentario'];



        $this->cop_pasaportefolio=$datos['cop_pasaportefolio'];
        $this->cop_pasaportetipodoc=$datos['cop_pasaportetipodoc'];
        $this->cop_pasaportecantidad=$datos['cop_pasaportecantidad'];
        $this->cop_pasaportecomentario=$datos['cop_pasaportecomentario'];


        $this->cop_ultimosestudiosfolio=$datos['cop_ultimosestudiosfolio'];
        $this->cop_ultimosestudiostipodoc=$datos['cop_ultimosestudiostipodoc'];
        $this->cop_ultimosestudioscomentario=$datos['cop_ultimosestudioscomentario'];
        $this->cop_ultimosestudioscantidad=$datos['cop_ultimosestudioscantidad'];


        $this->cop_cedulaprofesionalfolio=$datos['cop_cedulaprofesionalfolio'];
        $this->cop_cedulaprofesionalcantidad=$datos['cop_cedulaprofesionalcantidad'];
        $this->cop_cedulaprofesionaltipodoc=$datos['cop_cedulaprofesionaltipodoc'];
        $this->cop_cedulaprofesionalcomentario=$datos['cop_cedulaprofesionalcomentario'];



        $this->cop_recibosnominafolio=$datos['cop_recibosnominafolio'];
        $this->cop_recibosnominacantidad=$datos['cop_recibosnominacantidad'];
        $this->cop_recibosnominatipodoc=$datos['cop_recibosnominatipodoc'];
        $this->cop_recibosnominacomentario=$datos['cop_recibosnominacomentario'];

        $this->cop_segurosgastommfolio=$datos['cop_segurosgastommfolio'];
        $this->cop_segurosgastommcantidad=$datos['cop_segurosgastommcantidad'];
        $this->cop_segurosgastommtipodoc=$datos['cop_segurosgastommtipodoc'];
        $this->cop_segurosgastommcomentario=$datos['cop_segurosgastommcomentario'];


        $this->cop_aforefolio=$datos['cop_aforefolio'];
        $this->cop_aforetipodoc=$datos['cop_aforetipodoc'];
        $this->cop_aforecantidad=$datos['cop_aforecantidad'];
        $this->cop_aforecomentario=$datos['cop_aforecomentario'];

        $this->cop_recomendacionesfolio=$datos['cop_recomendacionesfolio'];
        $this->cop_recomendacionescantidad=$datos['cop_recomendacionescantidad'];
        $this->cop_recomendacionestipodoc=$datos['cop_recomendacionestipodoc'];
        $this->cop_recomendacionescomentario=$datos['cop_recomendacionescomentario'];

        $this->cop_ingresosadicionalesfolio=$datos['cop_ingresosadicionalesfolio'];
        $this->cop_ingresosadicionalestipodoc=$datos['cop_ingresosadicionalestipodoc'];
        $this->cop_ingresosadicionalescantidad=$datos['cop_ingresosadicionalescantidad'];
        $this->cop_ingresosadicionalescomentario=$datos['cop_ingresosadicionalescomentario'];
    
        if($this->update())
        {
            return  $repuesta=['estado'=>2,'id_actualizo'=>$this->cop_id];
        }
        else
        {
            return  $repuesta=['estado'=>0];
        }
    }

    public function getCheckSiCopiaOriginal($valor,$posicion_original,$posicion_copia,$td_orginal,$td_copia,$html){
        // $style_td_si='margin: 0 auto; background-color:white;';
        $style_td_no='background-color:#D9D9D9;';
        $img='<img src="images/checkmark.png"  style="max-height:20px; margin: 0 auto;">';

        switch ($valor) {
            case 1:
                 $html=  str_replace($posicion_original,$img,$html);
                 $html=  str_replace($posicion_copia,'',$html);
                 $html=  str_replace($td_copia,$style_td_no,$html);
                 return $html;
             break;
            case 0:
                $html=  str_replace($posicion_original,'',$html);
                $html=  str_replace($posicion_copia,$img,$html);
                $html=  str_replace($td_orginal,$style_td_no,$html);
                return $html;
            
             break;

            default:
                $html=  str_replace($posicion_original,'',$html);
                $html=  str_replace($posicion_copia,'',$html);
                $html=  str_replace($td_orginal,$style_td_no,$html);
                $html=  str_replace($td_copia,$style_td_no,$html);
                return $html;

             break;
        }

   }

    public function formatoEseTruper($data,$ese_id,$data_familiar){
        $reporte= new PdfReporteTruper();
        $formato_pdf=new FormatotruperPDF();

        $html=$reporte->documentospresentados_pagina_6;
   


        
        $html=str_replace("#dgf_comentario#",trim($data_familiar->dgf_comentario),$html);
        $html=str_replace("#dgf_comentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_familiar->dgf_comentario), $html);


        $html=str_replace("#cop_nacimientocantidad#",$this->getCantidadDoc(trim($data->cop_nacimientocantidad)),$html);
        $html=str_replace("#cop_nacimientocantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_nacimientocantidad)), $html);

        $html=str_replace("#cop_nacimientofolio#",trim($data->cop_nacimientofolio),$html);
        $html=str_replace("#cop_nacimientofolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_nacimientofolio), $html);

        $html=str_replace("#cop_nacimientocomentario#",trim($data->cop_nacimientocomentario),$html);
        $html=str_replace("#cop_nacimientocomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_nacimientocomentario), $html);


        $html=str_replace("#cop_conyugecantidad#",$this->getCantidadDoc(trim($data->cop_conyugecantidad)),$html);
        $html=str_replace("#cop_conyugecantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_conyugecantidad)), $html);

        $html=str_replace("#cop_conyugefolio#",trim($data->cop_conyugefolio),$html);
        $html=str_replace("#cop_conyugefolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_conyugefolio), $html);

        $html=str_replace("#cop_conyugecomentario#",trim($data->cop_conyugecomentario),$html);
        $html=str_replace("#cop_conyugecomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_conyugecomentario), $html);


        $html=str_replace("#cop_nacimientohijosfolio#",trim($data->cop_nacimientohijosfolio),$html);
        $html=str_replace("#cop_nacimientohijosfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_nacimientohijosfolio), $html);

        $html=str_replace("#cop_nacimientohijoscomentario#",trim($data->cop_nacimientohijoscomentario),$html);
        $html=str_replace("#cop_nacimientohijoscomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_nacimientohijoscomentario), $html);

        $html=str_replace("#cop_nacimientohijoscantidad#",$this->getCantidadDoc(trim($data->cop_nacimientohijoscantidad)),$html);
        $html=str_replace("#cop_nacimientohijoscantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_nacimientohijoscantidad)), $html);


        $html=str_replace("#cop_matrimoniocantidad#",$this->getCantidadDoc(trim($data->cop_matrimoniocantidad)),$html);
        $html=str_replace("#cop_matrimoniocantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_matrimoniocantidad)), $html);

        $html=str_replace("#cop_matrimoniofolio#",trim($data->cop_matrimoniofolio),$html);
        $html=str_replace("#cop_matrimoniofolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_matrimoniofolio), $html);

        $html=str_replace("#cop_matrimoniocomentario#",trim($data->cop_matrimoniocomentario),$html);
        $html=str_replace("#cop_matrimoniocomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_matrimoniocomentario), $html);

        $html=str_replace("#cop_credencialelectorcantidad#",$this->getCantidadDoc(trim($data->cop_credencialelectorcantidad)),$html);
        $html=str_replace("#cop_credencialelectorcantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_credencialelectorcantidad)), $html);

        $html=str_replace("#cop_credencialelectorfolio#",trim($data->cop_credencialelectorfolio),$html);
        $html=str_replace("#cop_credencialelectorfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_credencialelectorfolio), $html);

        $html=str_replace("#cop_credencialelectorcomentario#",trim($data->cop_credencialelectorcomentario),$html);
        $html=str_replace("#cop_credencialelectorcomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_credencialelectorcomentario), $html);



        $html=str_replace("#cop_curpcantidad#",$this->getCantidadDoc(trim($data->cop_curpcantidad)),$html);
        $html=str_replace("#cop_curpcantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_curpcantidad)), $html);

        $html=str_replace("#cop_curpfolio#",trim($data->cop_curpfolio),$html);
        $html=str_replace("#cop_curpfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_curpfolio), $html);

        $html=str_replace("#cop_curpcomentario#",trim($data->cop_curpcomentario),$html);
        $html=str_replace("#cop_curpcomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_curpcomentario), $html);


        $html=str_replace("#cop_aforecantidad#",$this->getCantidadDoc(trim($data->cop_aforecantidad)),$html);
        $html=str_replace("#cop_aforecantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_aforecantidad)), $html);

        $html=str_replace("#cop_aforefolio#",trim($data->cop_aforefolio),$html);
        $html=str_replace("#cop_aforefolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_aforefolio), $html);

        $html=str_replace("#cop_aforecomentario#",trim($data->cop_aforecomentario),$html);
        $html=str_replace("#cop_aforecomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_aforecomentario), $html);

        $html=str_replace("#cop_rfccantidad#",$this->getCantidadDoc(trim($data->cop_rfccantidad)),$html);
        $html=str_replace("#cop_rfccantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_rfccantidad)), $html);

        $html=str_replace("#cop_rfcfolio#",trim($data->cop_rfcfolio),$html);
        $html=str_replace("#cop_rfcfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_rfcfolio), $html);

        $html=str_replace("#cop_rfccomentario#",trim($data->cop_rfccomentario),$html);
        $html=str_replace("#cop_rfccomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_rfccomentario), $html);


        $html=str_replace("#cop_cartillacomentario#",trim($data->cop_cartillacomentario),$html);
        $html=str_replace("#cop_cartillacomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_cartillacomentario), $html);

        $html=str_replace("#cop_cartillacantidad#",$this->getCantidadDoc(trim($data->cop_cartillacantidad)),$html);
        $html=str_replace("#cop_cartillacantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_cartillacantidad)), $html);

        $html=str_replace("#cop_cartillafolio#",trim($data->cop_cartillafolio),$html);
        $html=str_replace("#cop_cartillafolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_cartillafolio), $html);


        
        $html=str_replace("#cop_pasaportecantidad#",$this->getCantidadDoc(trim($data->cop_pasaportecantidad)),$html);
        $html=str_replace("#cop_pasaportecantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_pasaportecantidad)), $html);

        $html=str_replace("#cop_pasaportefolio#",trim($data->cop_pasaportefolio),$html);
        $html=str_replace("#cop_pasaportefolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_pasaportefolio), $html);

        $html=str_replace("#cop_pasaportecomentario#",trim($data->cop_pasaportecomentario),$html);
        $html=str_replace("#cop_pasaportecomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_pasaportecomentario), $html);



        $html=str_replace("#cop_visacantidad#",$this->getCantidadDoc(trim($data->cop_visacantidad)),$html);
        $html=str_replace("#cop_visacantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_visacantidad)), $html);

        $html=str_replace("#cop_visafolio#",$this->getCantidadDoc(trim($data->cop_visafolio)),$html);
        $html=str_replace("#cop_visafolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_visafolio)), $html);

        $html=str_replace("#cop_visacomentario#",trim($data->cop_visacomentario),$html);
        $html=str_replace("#cop_visacomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_visacomentario), $html);


        $html=str_replace("#cop_licenciacantidad#",$this->getCantidadDoc(trim($data->cop_licenciacantidad)),$html);
        $html=str_replace("#cop_licenciacantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_licenciacantidad)), $html);

        $html=str_replace("#cop_licenciafolio#",trim($data->cop_licenciafolio),$html);
        $html=str_replace("#cop_licenciafolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_licenciafolio), $html);

        $html=str_replace("#cop_licenciacomentario#",trim($data->cop_licenciacomentario),$html);
        $html=str_replace("#cop_licenciacomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_licenciacomentario), $html);


        $html=str_replace("#cop_comprobantedomiciliocantidad#",$this->getCantidadDoc(trim($data->cop_comprobantedomiciliocantidad)),$html);
        $html=str_replace("#cop_comprobantedomiciliocantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_comprobantedomiciliocantidad)), $html);

        $html=str_replace("#cop_comprobantedomiciliofolio#",trim($data->cop_comprobantedomiciliofolio),$html);
        $html=str_replace("#cop_comprobantedomiciliofolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_comprobantedomiciliofolio), $html);

        $html=str_replace("#cop_comprobantedomiciliocomentario#",trim($data->cop_comprobantedomiciliocomentario),$html);
        $html=str_replace("#cop_comprobantedomiciliocomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_comprobantedomiciliocomentario), $html);



        $html=str_replace("#cop_imsscantidad#",$this->getCantidadDoc(trim($data->cop_imsscantidad)),$html);
        $html=str_replace("#cop_imsscantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_imsscantidad)), $html);

        $html=str_replace("#cop_imssfolio#",trim($data->cop_imssfolio),$html);
        $html=str_replace("#cop_imssfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_imssfolio), $html);

        $html=str_replace("#cop_imsscomentario#",trim($data->cop_imsscomentario),$html);
        $html=str_replace("#cop_imsscomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_imsscomentario), $html);


        $html=str_replace("#cop_cedulaprofesionalcantidad#",$this->getCantidadDoc(trim($data->cop_cedulaprofesionalcantidad)),$html);
        $html=str_replace("#cop_cedulaprofesionalcantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_cedulaprofesionalcantidad)), $html);

        $html=str_replace("#cop_cedulaprofesionalfolio#",trim($data->cop_cedulaprofesionalfolio),$html);
        $html=str_replace("#cop_cedulaprofesionalfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_cedulaprofesionalfolio), $html);

        $html=str_replace("#cop_cedulaprofesionalcomentario#",trim($data->cop_cedulaprofesionalcomentario),$html);
        $html=str_replace("#cop_cedulaprofesionalcomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_cedulaprofesionalcomentario), $html);


        $html=str_replace("#cop_recibosnominacantidad#",$this->getCantidadDoc(trim($data->cop_recibosnominacantidad)),$html);
        $html=str_replace("#cop_recibosnominacantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_recibosnominacantidad)), $html);

        $html=str_replace("#cop_recibosnominafolio#",trim($data->cop_recibosnominafolio),$html);
        $html=str_replace("#cop_recibosnominafolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_recibosnominafolio), $html);

        $html=str_replace("#cop_recibosnominacomentario#",trim($data->cop_recibosnominacomentario),$html);
        $html=str_replace("#cop_recibosnominacomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_recibosnominacomentario), $html);



        $html=str_replace("#cop_segurosgastommcantidad#",$this->getCantidadDoc(trim($data->cop_segurosgastommcantidad)),$html);
        $html=str_replace("#cop_segurosgastommcantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_segurosgastommcantidad)), $html);

        $html=str_replace("#cop_segurosgastommfolio#",trim($data->cop_segurosgastommfolio),$html);
        $html=str_replace("#cop_segurosgastommfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_segurosgastommfolio), $html);

        $html=str_replace("#cop_segurosgastommcomentario#",trim($data->cop_segurosgastommcomentario),$html);
        $html=str_replace("#cop_segurosgastommcomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_segurosgastommcomentario), $html);



        $html=str_replace("#cop_ultimosestudioscomentario#",trim($data->cop_ultimosestudioscomentario),$html);
        $html=str_replace("#cop_ultimosestudioscomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_ultimosestudioscomentario), $html);

        $html=str_replace("#cop_ultimosestudiosfolio#",trim($data->cop_ultimosestudiosfolio),$html);
        $html=str_replace("#cop_ultimosestudiosfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_ultimosestudiosfolio), $html);

        $html=str_replace("#cop_ultimosestudioscantidad#",$this->getCantidadDoc(trim($data->cop_ultimosestudioscantidad)),$html);
        $html=str_replace("#cop_ultimosestudioscantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_ultimosestudioscantidad)), $html);

        $html=str_replace("#cop_recomendacionescantidad#",$this->getCantidadDoc(trim($data->cop_recomendacionescantidad)),$html);
        $html=str_replace("#cop_recomendacionescantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_recomendacionescantidad)), $html);

        $html=str_replace("#cop_recomendacionesfolio#",trim($data->cop_recomendacionesfolio),$html);
        $html=str_replace("#cop_recomendacionesfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_recomendacionesfolio), $html);

        $html=str_replace("#cop_recomendacionescomentario#",trim($data->cop_recomendacionescomentario),$html);
        $html=str_replace("#cop_recomendacionescomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_recomendacionescomentario), $html);


        $html=str_replace("#cop_ingresosadicionalescantidad#",$this->getCantidadDoc(trim($data->cop_ingresosadicionalescantidad)),$html);
        $html=str_replace("#cop_ingresosadicionalescantidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getCantidadDoc($data->cop_ingresosadicionalescantidad)), $html);

        $html=str_replace("#cop_ingresosadicionalesfolio#",trim($data->cop_ingresosadicionalesfolio),$html);
        $html=str_replace("#cop_ingresosadicionalesfolio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_ingresosadicionalesfolio), $html);

        $html=str_replace("#cop_ingresosadicionalescomentario#",trim($data->cop_ingresosadicionalescomentario),$html);
        $html=str_replace("#cop_ingresosadicionalescomentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data->cop_ingresosadicionalescomentario), $html);



        $html=$this->getCheckSiCopiaOriginal($data->cop_nacimientotipodoc,'#cop_nacimientotipodoc-original#','#cop_nacimientotipodoc-copia#','#cop_nacimientotipodoc-original-td#','#cop_nacimientotipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_conyugetipodoc,'#cop_conyugetipodoc-original#','#cop_conyugetipodoc-copia#','#cop_conyugetipodoc-original-td#','#cop_conyugetipodoc-copia-td#',$html);
       
        $html=$this->getCheckSiCopiaOriginal($data->cop_nacimientohijostipodoc,'#cop_nacimientohijostipodoc-original#','#cop_nacimientohijostipodoc-copia#','#cop_nacimientohijostipodoc-original-td#','#cop_nacimientohijostipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_matrimoniotipodoc,'#cop_matrimoniotipodoc-original#','#cop_matrimoniotipodoc-copia#','#cop_matrimoniotipodoc-original-td#','#cop_matrimoniotipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_credencialelectortipodoc,'#cop_credencialelectortipodoc-original#','#cop_credencialelectortipodoc-copia#','#cop_credencialelectortipodoc-original-td#','#cop_credencialelectortipodoc-copia-td#',$html);
    
        $html=$this->getCheckSiCopiaOriginal($data->cop_curptipodoc,'#cop_curptipodoc-original#','#cop_curptipodoc-copia#','#cop_curptipodoc-original-td#','#cop_curptipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_aforetipodoc,'#cop_aforetipodoc-original#','#cop_aforetipodoc-copia#','#cop_aforetipodoc-original-td#','#cop_aforetipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_rfctipodoc,'#cop_rfctipodoc-original#','#cop_rfctipodoc-copia#','#cop_rfctipodoc-original-td#','#cop_rfctipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_cartillatipodoc,'#cop_cartillatipodoc-original#','#cop_cartillatipodoc-copia#','#cop_cartillatipodoc-original-td#','#cop_cartillatipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_pasaportetipodoc,'#cop_pasaportetipodoc-original#','#cop_pasaportetipodoc-copia#','#cop_pasaportetipodoc-original-td#','#cop_pasaportetipodoc-copia-td#',$html);



        $html=$this->getCheckSiCopiaOriginal($data->cop_visatipodoc,'#cop_visatipodoc-original#','#cop_visatipodoc-copia#','#cop_visatipodoc-original-td#','#cop_visatipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_licenciatipodoc,'#cop_licenciatipodoc-original#','#cop_licenciatipodoc-copia#','#cop_licenciatipodoc-original-td#','#cop_licenciatipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_comprobantedomiciliotipodoc,'#cop_comprobantedomiciliotipodoc-original#','#cop_comprobantedomiciliotipodoc-copia#','#cop_comprobantedomiciliotipodoc-original-td#','#cop_comprobantedomiciliotipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_imsstipodoc,'#cop_imsstipodoc-original#','#cop_imsstipodoc-copia#','#cop_imsstipodoc-original-td#','#cop_imsstipodoc-copia-td#',$html);

        
        $html=$this->getCheckSiCopiaOriginal($data->cop_ultimosestudiostipodoc,'#cop_ultimosestudiostipodoc-original#','#cop_ultimosestudiostipodoc-copia#','#cop_ultimosestudiostipodoc-original-td#','#cop_ultimosestudiostipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_cedulaprofesionaltipodoc,'#cop_cedulaprofesionaltipodoc-original#','#cop_cedulaprofesionaltipodoc-copia#','#cop_cedulaprofesionaltipodoc-original-td#','#cop_cedulaprofesionaltipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_ingresosadicionalestipodoc,'#cop_ingresosadicionalestipodoc-original#','#cop_ingresosadicionalestipodoc-copia#','#cop_ingresosadicionalestipodoc-original-td#','#cop_ingresosadicionalestipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_recibosnominatipodoc,'#cop_recibosnominatipodoc-original#','#cop_recibosnominatipodoc-copia#','#cop_recibosnominatipodoc-original-td#','#cop_recibosnominatipodoc-copia-td#',$html);
        $html=$this->getCheckSiCopiaOriginal($data->cop_segurosgastommtipodoc,'#cop_segurosgastommtipodoc-original#','#cop_segurosgastommtipodoc-copia#','#cop_segurosgastommtipodoc-original-td#','#cop_segurosgastommtipodoc-copia-td#',$html);

        
        $html=$this->getCheckSiCopiaOriginal($data->cop_recomendacionestipodoc,'#cop_recomendacionestipodoc-original#','#cop_recomendacionestipodoc-copia#','#cop_recomendacionestipodoc-original-td#','#cop_recomendacionestipodoc-copia-td#',$html);
        
        $html=$this->getCheckSiCopiaOriginal($data->cop_ingresosadicionalestipodoc,'#cop_ingresosadicionalestipodoc-original#','#cop_ingresosadicionalestipodoc-copia#','#cop_ingresosadicionalestipodoc-original-td#','#cop_ingresosadicionalestipodoc-copia-td#',$html);        

        
        
        
            
            
        

        
        

        


        

        return $html;
    }

    public function getCantidadDoc($id)
    {
        if ($id == -1) 
        {
            return '';
        }
        
        return $id;
    }
}