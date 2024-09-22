<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Datoescolar extends Model
{

    public $docrecibidos_select_values=[
        1=>'NINGUNO',
        2=>'BOLETA',
        3=>'CERTIFICADO',
        4=>'TÍTULO Y CÉDULA PROFESIONAL',
        5=>'RECONOCIMIENTO',
        6=>'DIPLOMA',
        7=>'HISTORIAL ACADÉMICO',
        8=>'CONSTANCIA DE ESTUDIOS',



    ];
    public function getNombreDocRecibidos($id){

        if (array_key_exists($id, $this->docrecibidos_select_values)) {
            return $this->docrecibidos_select_values[$id];
       }else{
            return '';
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

    public function GuardarInformacion($data,$usu_id,$permisocalificacion){
        $subs = Datoescolar::find(array(
                'ese_id='.$data['ese_id'],
                'dae_estatus=2'));
        if(count($subs)>0){
            $registro = Datoescolar::findFirstBydae_id($subs[0]->dae_id);
        }else{
            $registro = new Datoescolar();
        }
        
        $registro->ese_id= $data['ese_id'];
        $registro->dae_estatus=2;
        $registro->dae_primariaperiodo=$data['dae_primariaperiodo'];
        $registro->dae_primariaescuela=$data['dae_primariaescuela'];
        $registro->dae_primariacertificado=$data['dae_primariacertificado'];
        $registro->dae_primariapromedio=$data['dae_primariapromedio'];
        $registro->dae_secundariaperiodo=$data['dae_secundariaperiodo'];
        $registro->dae_secundariaescuela=$data['dae_secundariaescuela'];
        $registro->dae_secundariacertificado=$data['dae_secundariacertificado'];
        $registro->dae_secundariapromedio=$data['dae_secundariapromedio'];
        $registro->dae_comercialperiodo=$data['dae_comercialperiodo'];
        $registro->dae_comercialescuela=$data['dae_comercialescuela'];
        $registro->dae_comercialcertificado=$data['dae_comercialcertificado'];
        $registro->dae_comercialpromedio=$data['dae_comercialpromedio'];
        $registro->dae_preparatoriaperiodo=$data['dae_preparatoriaperiodo'];
        $registro->dae_preparatoriaescuela=$data['dae_preparatoriaescuela'];
        $registro->dae_preparatoriacertificado=$data['dae_preparatoriacertificado'];
        $registro->dae_preparatoriapromedio=$data['dae_preparatoriapromedio'];
        $registro->dae_licenciaturaperiodo=$data['dae_licenciaturaperiodo'];
        $registro->dae_licenciaturaescuela=$data['dae_licenciaturaescuela'];
        $registro->dae_licenciaturacertificado=$data['dae_licenciaturacertificado'];
        $registro->dae_licenciaturapromedio=$data['dae_licenciaturapromedio'];
        $registro->dae_cedulaperiodo=$data['dae_cedulaperiodo'];
        $registro->dae_cedulaescuela=$data['dae_cedulaescuela'];
        $registro->dae_cedulacertificado=$data['dae_cedulacertificado'];
        $registro->dae_cedulapromedio=$data['dae_cedulapromedio'];
        $registro->dae_otroperiodo=$data['dae_otroperiodo'];
        $registro->dae_otroescuela=$data['dae_otroescuela'];
        $registro->dae_otrocertificado=$data['dae_otrocertificado'];
        $registro->dae_otropromedio=$data['dae_otropromedio'];
        $registro->dae_actualperiodo=$data['dae_actualperiodo'];
        $registro->dae_actualescuela=$data['dae_actualescuela'];
        $registro->dae_actualcertificado=$data['dae_actualcertificado'];
        $registro->dae_actualpromedio=$data['dae_actualpromedio'];
        $registro->dae_periodoinactivo=$data['dae_periodoinactivo'];
        $registro->dae_motivo=$data['dae_motivo'];
        $registro->dae_notas=$data['dae_notas'];
        
        if($permisocalificacion==1){
            if (isset($data['dae_calificacion'])) {
                $registro->dae_calificacion = $data['dae_calificacion'];
            }
        }

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function getCertificado($id){
        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SÍ";
            case 2:
                return "EN TRÁMITE";
            default:
                return "";
        }
    }
    public function formatoeses($datoescolar){
        $reporte= new PdfReporte();
        $html=$reporte->datosescolares;
        $html=str_replace("#dae_primariaperiodo#",trim($datoescolar->dae_primariaperiodo),$html);
        $html=str_replace("#dae_primariaescuela#",trim($datoescolar->dae_primariaescuela),$html);
        $html=str_replace("#dae_primariacertificado#",$this->getCertificado($datoescolar->dae_primariacertificado),$html);
        $html=str_replace("#dae_primariapromedio#",trim($datoescolar->dae_primariapromedio),$html);

        $html=str_replace("#dae_secundariaperiodo#",trim($datoescolar->dae_secundariaperiodo),$html);
        $html=str_replace("#dae_secundariaescuela#",trim($datoescolar->dae_secundariaescuela),$html);
        $html=str_replace("#dae_secundariacertificado#",$this->getCertificado($datoescolar->dae_secundariacertificado),$html);
        $html=str_replace("#dae_secundariapromedio#",trim($datoescolar->dae_secundariapromedio),$html);

        $html=str_replace("#dae_comercialperiodo#",trim($datoescolar->dae_comercialperiodo),$html);
        $html=str_replace("#dae_comercialescuela#",trim($datoescolar->dae_comercialescuela),$html);
        $html=str_replace("#dae_comercialcertificado#",$this->getCertificado($datoescolar->dae_comercialcertificado),$html);
        $html=str_replace("#dae_comercialpromedio#",trim($datoescolar->dae_comercialpromedio),$html);

        $html=str_replace("#dae_preparatoriaperiodo#",trim($datoescolar->dae_preparatoriaperiodo),$html);
        $html=str_replace("#dae_preparatoriaescuela#",trim($datoescolar->dae_preparatoriaescuela),$html);
        $html=str_replace("#dae_preparatoriacertificado#",$this->getCertificado($datoescolar->dae_preparatoriacertificado),$html);
        $html=str_replace("#dae_preparatoriapromedio#",trim($datoescolar->dae_preparatoriapromedio),$html);

        $html=str_replace("#dae_licenciaturaperiodo#",trim($datoescolar->dae_licenciaturaperiodo),$html);
        $html=str_replace("#dae_licenciaturaescuela#",trim($datoescolar->dae_licenciaturaescuela),$html);
        $html=str_replace("#dae_licenciaturacertificado#",$this->getCertificado($datoescolar->dae_licenciaturacertificado),$html);
        $html=str_replace("#dae_licenciaturapromedio#",trim($datoescolar->dae_licenciaturapromedio),$html);

        $html=str_replace("#dae_cedulaperiodo#",trim($datoescolar->dae_cedulaperiodo),$html);
        $html=str_replace("#dae_cedulaescuela#",trim($datoescolar->dae_cedulaescuela),$html);
        $html=str_replace("#dae_cedulacertificado#",$this->getCertificado($datoescolar->dae_cedulacertificado),$html);
        $html=str_replace("#dae_cedulapromedio#",trim($datoescolar->dae_cedulapromedio),$html);

        $html=str_replace("#dae_otroperiodo#",trim($datoescolar->dae_otroperiodo),$html);
        $html=str_replace("#dae_otroescuela#",trim($datoescolar->dae_otroescuela),$html);
        $html=str_replace("#dae_otrocertificado#",$this->getCertificado($datoescolar->dae_otrocertificado),$html);
        $html=str_replace("#dae_otropromedio#",trim($datoescolar->dae_otropromedio),$html);

        $html=str_replace("#dae_actualperiodo#",trim($datoescolar->dae_actualperiodo),$html);
        $html=str_replace("#dae_actualescuela#",trim($datoescolar->dae_actualescuela),$html);
        $html=str_replace("#dae_actualcertificado#",$this->getCertificado($datoescolar->dae_actualcertificado),$html);
        $html=str_replace("#dae_actualpromedio#",trim($datoescolar->dae_actualpromedio),$html);

        $html=str_replace("#dae_periodoinactivo#",trim($datoescolar->dae_periodoinactivo),$html);
        $html=str_replace("#dae_motivo#",trim($datoescolar->dae_motivo),$html);
        $html=str_replace("#dae_notas#",trim($datoescolar->dae_notas),$html);
        return $html;
    }

    public function formatogabtubos($datoescolar){
        $reporte= new PdfReporteGabineteTubos();
        $html=$reporte->datosescolares;
        $html=str_replace("#dae_primariaperiodo#",trim($datoescolar->dae_primariaperiodo),$html);
        $html=str_replace("#dae_primariaescuela#",trim($datoescolar->dae_primariaescuela),$html);
        $html=str_replace("#dae_primariacertificado#",$this->getCertificado($datoescolar->dae_primariacertificado),$html);
        $html=str_replace("#dae_primariapromedio#",trim($datoescolar->dae_primariapromedio),$html);

        $html=str_replace("#dae_secundariaperiodo#",trim($datoescolar->dae_secundariaperiodo),$html);
        $html=str_replace("#dae_secundariaescuela#",trim($datoescolar->dae_secundariaescuela),$html);
        $html=str_replace("#dae_secundariacertificado#",$this->getCertificado($datoescolar->dae_secundariacertificado),$html);
        $html=str_replace("#dae_secundariapromedio#",trim($datoescolar->dae_secundariapromedio),$html);

        $html=str_replace("#dae_comercialperiodo#",trim($datoescolar->dae_comercialperiodo),$html);
        $html=str_replace("#dae_comercialescuela#",trim($datoescolar->dae_comercialescuela),$html);
        $html=str_replace("#dae_comercialcertificado#",$this->getCertificado($datoescolar->dae_comercialcertificado),$html);
        $html=str_replace("#dae_comercialpromedio#",trim($datoescolar->dae_comercialpromedio),$html);

        $html=str_replace("#dae_preparatoriaperiodo#",trim($datoescolar->dae_preparatoriaperiodo),$html);
        $html=str_replace("#dae_preparatoriaescuela#",trim($datoescolar->dae_preparatoriaescuela),$html);
        $html=str_replace("#dae_preparatoriacertificado#",$this->getCertificado($datoescolar->dae_preparatoriacertificado),$html);
        $html=str_replace("#dae_preparatoriapromedio#",trim($datoescolar->dae_preparatoriapromedio),$html);

        $html=str_replace("#dae_licenciaturaperiodo#",trim($datoescolar->dae_licenciaturaperiodo),$html);
        $html=str_replace("#dae_licenciaturaescuela#",trim($datoescolar->dae_licenciaturaescuela),$html);
        $html=str_replace("#dae_licenciaturacertificado#",$this->getCertificado($datoescolar->dae_licenciaturacertificado),$html);
        $html=str_replace("#dae_licenciaturapromedio#",trim($datoescolar->dae_licenciaturapromedio),$html);

        $html=str_replace("#dae_cedulaperiodo#",trim($datoescolar->dae_cedulaperiodo),$html);
        $html=str_replace("#dae_cedulaescuela#",trim($datoescolar->dae_cedulaescuela),$html);
        $html=str_replace("#dae_cedulacertificado#",$this->getCertificado($datoescolar->dae_cedulacertificado),$html);
        $html=str_replace("#dae_cedulapromedio#",trim($datoescolar->dae_cedulapromedio),$html);

        $html=str_replace("#dae_otroperiodo#",trim($datoescolar->dae_otroperiodo),$html);
        $html=str_replace("#dae_otroescuela#",trim($datoescolar->dae_otroescuela),$html);
        $html=str_replace("#dae_otrocertificado#",$this->getCertificado($datoescolar->dae_otrocertificado),$html);
        $html=str_replace("#dae_otropromedio#",trim($datoescolar->dae_otropromedio),$html);

        $html=str_replace("#dae_actualperiodo#",trim($datoescolar->dae_actualperiodo),$html);
        $html=str_replace("#dae_actualescuela#",trim($datoescolar->dae_actualescuela),$html);
        $html=str_replace("#dae_actualcertificado#",$this->getCertificado($datoescolar->dae_actualcertificado),$html);
        $html=str_replace("#dae_actualpromedio#",trim($datoescolar->dae_actualpromedio),$html);

        $html=str_replace("#dae_periodoinactivo#",trim($datoescolar->dae_periodoinactivo),$html);
        $html=str_replace("#dae_motivo#",trim($datoescolar->dae_motivo),$html);
        $html=str_replace("#dae_notas#",trim($datoescolar->dae_notas),$html);
        return $html;
    }


    public function GuardarInformacionFormatoTruper($data,$usu_id,$permisocalificacion){

        $subs = Datoescolar::find(array(
                'ese_id='.$data['ese_id'],
                'dae_estatus=2'));
        if(count($subs)>0){
            $registro = Datoescolar::findFirstBydae_id($subs[0]->dae_id);
        }else{
            $registro = new Datoescolar();
        }
        
        $registro->ese_id= $data['ese_id'];
        $registro->dae_estatus=2;
        $registro->dae_primariaperiodo=$data['dae_primariaperiodo'];
        $registro->dae_primariaescuela=$data['dae_primariaescuela'];
        $registro->dae_primariapromedio=$data['dae_primariapromedio'];
        if (isset($data['dae_primariadocrecibido'])) {
            $registro->dae_primariadocrecibido = $data['dae_primariadocrecibido'];
        }
        $registro->dae_primariaentidad=$data['dae_primariaentidad'];


        $registro->dae_secundariaperiodo=$data['dae_secundariaperiodo'];
        $registro->dae_secundariaescuela=$data['dae_secundariaescuela'];
        $registro->dae_secundariapromedio=$data['dae_secundariapromedio'];
        if (isset($data['dae_secundariadocrecibido'])) {
            $registro->dae_secundariadocrecibido = $data['dae_secundariadocrecibido'];
        }
        $registro->dae_secundariaentidad=$data['dae_secundariaentidad'];
  

        $registro->dae_carreratecnicaperiodo=$data['dae_carreratecnicaperiodo'];
        $registro->dae_carreratecnicaescuela=$data['dae_carreratecnicaescuela'];
        if (isset($data['dae_carreratecnicadocrecibido'])) {
            $registro->dae_carretecnicadocrecibido=$data['dae_carreratecnicadocrecibido'];
        }
        
        $registro->dae_carreratecnicapromedio=$data['dae_carreratecnicapromedio'];
        $registro->dae_carreratecnicaentidad=$data['dae_carreratecnicaentidad'];
        $registro->dae_carreratecnicaen=$data['dae_carreratecnicaen'];

      
        $registro->dae_preparatoriapromedio=$data['dae_preparatoriapromedio'];
        $registro->dae_preparatoriaperiodo=$data['dae_preparatoriaperiodo'];
        $registro->dae_preparatoriaescuela=$data['dae_preparatoriaescuela'];
        if (isset($data['dae_preparatoriadocrecibido'])) {
            $registro->dae_preparatoriadocrecibido=$data['dae_preparatoriadocrecibido'];
        }
        $registro->dae_preparatoriaentidad=$data['dae_preparatoriaentidad'];
        $registro->dae_preparatoriaen=$data['dae_preparatoriaen'];

        

        $registro->dae_licenciaturaperiodo=$data['dae_licenciaturaperiodo'];
        $registro->dae_licenciaturaescuela=$data['dae_licenciaturaescuela'];
        if (isset($data['dae_licenciaturadocrecibido'])) {
            $registro->dae_licenciaturadocrecibido=$data['dae_licenciaturadocrecibido'];
        }
        $registro->dae_licenciaturapromedio=$data['dae_licenciaturapromedio'];
        $registro->dae_licenciaturaentidad=$data['dae_licenciaturaentidad'];
        $registro->dae_licenciaturaen=$data['dae_licenciaturaen'];

        
        $registro->dae_otroperiodo=$data['dae_otroperiodo'];
        $registro->dae_otroescuela=$data['dae_otroescuela'];
        if (isset($data['dae_otrodocrecibido'])) {
            $registro->dae_otrodocrecibido=$data['dae_otrodocrecibido'];
        }
        $registro->dae_otropromedio=$data['dae_otropromedio'];
        $registro->dae_otroentidad=$data['dae_otroentidad'];
        $registro->dae_otroen=$data['dae_otroen'];

        
        /*if($permisocalificacion==1){
            $registro->dae_calificacion=$data['dae_calificacion'];
        }*/

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function formatoEseTruper($data_academica,$data_salud,$data_antecedentesocial){

        $reporte= new PdfReporteTruper();
        $formato_pdf=new FormatotruperPDF();

        $html=$reporte->datosacademicos_datosmedicos_pagina_4;
   



        $html=str_replace("#dae_primariaperiodo#",trim($data_academica->dae_primariaperiodo),$html);
        $html=str_replace("#dae_primariaperiodo-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_primariaperiodo), $html);

        $html=str_replace("#dae_primariaescuela#",trim($data_academica->dae_primariaescuela),$html);
        $html=str_replace("#dae_primariaescuela-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_primariaescuela), $html);

        $html=str_replace("#dae_primariaentidad#",trim($data_academica->dae_primariaentidad),$html);
        $html=str_replace("#dae_primariaentidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_primariaentidad), $html);

        $html=str_replace("#dae_primariadocrecibido#",trim($this->getNombreDocRecibidos($data_academica->dae_primariadocrecibido)),$html);
        $html=str_replace("#dae_primariadocrecibido-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_academica->dae_primariadocrecibido), $html);

        $html=str_replace("#dae_secundariaperiodo#",trim($data_academica->dae_secundariaperiodo),$html);
        $html=str_replace("#dae_secundariaperiodo-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_secundariaperiodo), $html);

        $html=str_replace("#dae_secundariaescuela#",trim($data_academica->dae_secundariaescuela),$html);
        $html=str_replace("#dae_secundariaescuela-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_secundariaescuela), $html);

        $html=str_replace("#dae_secundariaentidad#",trim($data_academica->dae_secundariaentidad),$html);
        $html=str_replace("#dae_secundariaentidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_secundariaentidad), $html);


        $html=str_replace("#dae_secundariadocrecibido#",trim($this->getNombreDocRecibidos($data_academica->dae_secundariadocrecibido)),$html);
        $html=str_replace("#dae_secundariadocrecibido-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_academica->dae_secundariadocrecibido), $html);

        $html=str_replace("#dae_carreratecnicaperiodo#",trim($data_academica->dae_carreratecnicaperiodo),$html);
        $html=str_replace("#dae_carreratecnicaperiodo-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_carreratecnicaperiodo), $html);

        $html=str_replace("#dae_carreratecnicaescuela#",trim($data_academica->dae_carreratecnicaescuela),$html);
        $html=str_replace("#dae_carreratecnicaescuela-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_carreratecnicaescuela), $html);

        $html=str_replace("#dae_carreratecnicaentidad#",trim($data_academica->dae_carreratecnicaentidad),$html);
        $html=str_replace("#dae_carreratecnicaentidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_carreratecnicaentidad), $html);

        $html=str_replace("#dae_carretecnicadocrecibido#",trim($this->getNombreDocRecibidos($data_academica->dae_carretecnicadocrecibido)),$html);
        $html=str_replace("#dae_carretecnicadocrecibido-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_academica->dae_carretecnicadocrecibido), $html);

        $html=str_replace("#dae_carreratecnicaen#",trim($data_academica->dae_carreratecnicaen),$html);
        $html=str_replace("#dae_carreratecnicaen-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_carreratecnicaen), $html);



        $html=str_replace("#dae_preparatoriaperiodo#",trim($data_academica->dae_preparatoriaperiodo),$html);
        $html=str_replace("#dae_preparatoriaperiodo-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_preparatoriaperiodo), $html);


        $html=str_replace("#dae_preparatoriaescuela#",trim($data_academica->dae_preparatoriaescuela),$html);
        $html=str_replace("#dae_preparatoriaescuela-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_preparatoriaescuela), $html);


        $html=str_replace("#dae_preparatoriaentidad#",trim($data_academica->dae_preparatoriaentidad),$html);
        $html=str_replace("#dae_preparatoriaentidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_preparatoriaentidad), $html);


        $html=str_replace("#dae_preparatoriadocrecibido#",trim($this->getNombreDocRecibidos($data_academica->dae_preparatoriadocrecibido)),$html);
        $html=str_replace("#dae_preparatoriadocrecibido-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_academica->dae_preparatoriadocrecibido), $html);

        $html=str_replace("#dae_preparatoriaen#",trim($data_academica->dae_preparatoriaen),$html);
        $html=str_replace("#dae_preparatoriaen-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_preparatoriaen), $html);


        $html=str_replace("#dae_licenciaturaperiodo#",trim($data_academica->dae_licenciaturaperiodo),$html);
        $html=str_replace("#dae_licenciaturaperiodo-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_licenciaturaperiodo), $html);

        $html=str_replace("#dae_licenciaturaescuela#",trim($data_academica->dae_licenciaturaescuela),$html);
        $html=str_replace("#dae_licenciaturaescuela-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_licenciaturaescuela), $html);

        $html=str_replace("#dae_licenciaturaentidad#",trim($data_academica->dae_licenciaturaentidad),$html);
        $html=str_replace("#dae_licenciaturaentidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_licenciaturaentidad), $html);


        $html=str_replace("#dae_licenciaturadocrecibido#",trim($this->getNombreDocRecibidos($data_academica->dae_licenciaturadocrecibido)),$html);
        $html=str_replace("#dae_licenciaturadocrecibido-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_academica->dae_licenciaturadocrecibido), $html);

        $html=str_replace("#dae_licenciaturaen#",trim($data_academica->dae_licenciaturaen),$html);
        $html=str_replace("#dae_licenciaturaen-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_licenciaturaen), $html);


        
        $html=str_replace("#dae_otroperiodo#",trim($data_academica->dae_otroperiodo),$html);
        $html=str_replace("#dae_otroperiodo-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_otroperiodo), $html);

        $html=str_replace("#dae_otroescuela#",trim($data_academica->dae_otroescuela),$html);
        $html=str_replace("#dae_otroescuela-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_otroescuela), $html);


        $html=str_replace("#dae_otroentidad#",trim($data_academica->dae_otroentidad),$html);
        $html=str_replace("#dae_otroentidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_otroentidad), $html);


        $html=str_replace("#dae_otrodocrecibido#",trim($this->getNombreDocRecibidos($data_academica->dae_otrodocrecibido)),$html);
        $html=str_replace("#dae_otrodocrecibido-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_academica->dae_otrodocrecibido), $html);


        $html=str_replace("#dae_otroen#",trim($data_academica->dae_otroen),$html);
        $html=str_replace("#dae_otroen-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_otroen), $html);


        $html=str_replace("#dae_primariapromedio#",trim($data_academica->dae_primariapromedio),$html);
        $html=str_replace("#dae_primariapromedio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_primariapromedio), $html);


        $html=str_replace("#dae_secundariapromedio#",trim($data_academica->dae_secundariapromedio),$html);
        $html=str_replace("#dae_secundariapromedio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_secundariapromedio), $html);

        $html=str_replace("#dae_carreratecnicapromedio#",trim($data_academica->dae_carreratecnicapromedio),$html);
        $html=str_replace("#dae_carreratecnicapromedio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_carreratecnicapromedio), $html);


        $html=str_replace("#dae_preparatoriapromedio#",trim($data_academica->dae_preparatoriapromedio),$html);
        $html=str_replace("#dae_preparatoriapromedio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_preparatoriapromedio), $html);

        $html=str_replace("#dae_licenciaturapromedio#",trim($data_academica->dae_licenciaturapromedio),$html);
        $html=str_replace("#dae_licenciaturapromedio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_licenciaturapromedio), $html);


        $html=str_replace("#dae_otropromedio#",trim($data_academica->dae_otropromedio),$html);
        $html=str_replace("#dae_otropromedio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_academica->dae_otropromedio), $html);



        //datos salud

        $html=str_replace("#ess_intervencionquirurgicapreg#",trim($this->getSiONo($data_salud->ess_intervencionquirurgicapreg)),$html);
        $html=str_replace("#ess_intervencionquirurgicapreg-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_salud->ess_intervencionquirurgicapreg), $html);

        $html=str_replace("#ess_intervencionquirurgica#",trim($data_salud->ess_intervencionquirurgica),$html);
        $html=str_replace("#ess_intervencionquirurgica-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_intervencionquirurgica), $html);

        $html=str_replace("#ess_incapacidadultimoanio#",trim($data_salud->ess_incapacidadultimoanio),$html);
        $html=str_replace("#ess_incapacidadultimoanio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_incapacidadultimoanio), $html);


        $html=str_replace("#ess_incapacidadultimoaniopreg#",trim($this->getSiONo($data_salud->ess_incapacidadultimoaniopreg)),$html);
        $html=str_replace("#ess_incapacidadultimoaniopreg-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_salud->ess_incapacidadultimoaniopreg), $html);

        
        $html=str_replace("#ess_enfermedadcronicapreg#",trim($this->getSiONo($data_salud->ess_enfermedadcronicapreg)),$html);
        $html=str_replace("#ess_enfermedadcronicapreg-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_salud->ess_enfermedadcronicapreg), $html);

        $html=str_replace("#ess_enfermedadcronica#",trim($data_salud->ess_enfermedadcronica),$html);
        $html=str_replace("#ess_enfermedadcronica-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_enfermedadcronica), $html);

        $html=str_replace("#ess_famconenfermedadcronica#",trim($data_salud->ess_famconenfermedadcronica),$html);
        $html=str_replace("#ess_famconenfermedadcronica-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_famconenfermedadcronica), $html);

        $html=str_replace("#ess_peso#",trim($data_salud->ess_peso),$html);
        $html=str_replace("#ess_peso-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_peso), $html);

        $html=str_replace("#ess_estatura#",trim($data_salud->ess_estatura),$html);
        $html=str_replace("#ess_estatura-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_estatura), $html);

        

        $html=str_replace("#ess_avisar#",trim($data_salud->ess_avisar),$html);
        $html=str_replace("#ess_avisar-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_avisar), $html);

        $html=str_replace("#ess_telefono#",trim($data_salud->ess_telefono),$html);
        $html=str_replace("#ess_telefono-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_salud->ess_telefono), $html);

        //datos salud


        //antecedentes sociales

        $html=str_replace("#ans_bebida#",trim($this->getSiONo($data_antecedentesocial->ans_bebida)),$html);
        $html=str_replace("#ans_bebida-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_bebida), $html);

        $html=str_replace("#ans_droga#",trim($this->getSiONo($data_antecedentesocial->ans_droga)),$html);
        $html=str_replace("#ans_droga-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_droga), $html);

        $html=str_replace("#ans_fumar#",trim($this->getSiONo($data_antecedentesocial->ans_fumar)),$html);
        $html=str_replace("#ans_fumar-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_fumar), $html);


        //antecedentes sociales




        

        
        

        return $html;
    }

    
}
