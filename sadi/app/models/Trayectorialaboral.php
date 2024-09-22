<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Trayectorialaboral extends Model
{

    public function NuevoRegistroFormatoTruper($data){

        $registro=new Trayectorialaboral();
        $registro->tyl_empresamarca=$data['tyl_empresamarca'];
        $registro->tyl_empresacontratante=$data['tyl_empresacontratante'];
        $registro->tyl_periodo=$data['tyl_periodo'];
        $registro->tyl_comentario=$data['tyl_comentario'];
        $registro->tyl_estatus=2;
        $registro->sel_id=$data['sel_id'];


        if($registro->save()){
            return  $repuesta=['estado'=>2,'tyl_id'=> $registro->tyl_id,'sel_id'=> $registro->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }

    public function get_informadaSiNo($valor){
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

    public function getSiNo($valor){
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

    public function ActualizarRegistroFormatoTruper($data){
        $this->tyl_empresamarca=$data['tyl_empresamarca'];
        $this->tyl_empresacontratante=$data['tyl_empresacontratante'];
        $this->tyl_periodo=$data['tyl_periodo'];
        $this->tyl_comentario=$data['tyl_comentario'];
       


        if($this->update()){
            return  $repuesta=['estado'=>2,'tyl_id'=> $this->tyl_id,'sel_id'=> $this->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }


    public function formatoEseTruper($ese_id,$seccion_laboral_data,$trayectorialaboralregistrado_data){
        $reporte= new PdfReporteTruper();
        $html=$reporte->referenciaslaborales_pagina_11;
        $formato_pdf= new FormatotruperPDF();
        
        $trayectorialaboralregistrado_detalles=Trayectorialaboral::query()
        ->where('sel_id='.$seccion_laboral_data->sel_id.' and tyl_estatus=2')
        ->execute();
       $rows_agregar_trayectorialaboral_detalles='';
     
 
        for ($i=0; $i <= 7; $i++) {
        
       
            if($i<count($trayectorialaboralregistrado_detalles)){
                $row='  
                <tr>
                <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF" class="td_text_format" >'.trim($trayectorialaboralregistrado_detalles[$i]->tyl_empresamarca).'</td>
                <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF;" class="td_text_format" >'.trim($trayectorialaboralregistrado_detalles[$i]->tyl_empresacontratante).'</td>
                <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF;" class="td_text_format" >'.trim($trayectorialaboralregistrado_detalles[$i]->tyl_periodo).'</td>
                <td colspan="4" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF;" class="td_text_format" >'.trim($trayectorialaboralregistrado_detalles[$i]->tyl_comentario).'</td>
               </tr>
            
                ';
             
            }else{
                $row='  
                <tr>
                    <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9"></td>
                    <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9";></td>
                    <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9"></td>
                    <td colspan="4" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9"></td>
                </tr>
                  ';
            }

           $rows_agregar_trayectorialaboral_detalles.=$row;

        }

        
            
        $trayectorialaboralregistradodetalles_detalles=Trayectorialaboralregistradodetalles::query()
        ->where('tlr_id='.$trayectorialaboralregistrado_data->tlr_id.' and trd_estatus=2')
        ->execute();

        $rows_agregar_trayectorialaboralregistradodetalles='';
        for ($i=0; $i <= 7; $i++) {
        
       
            if($i<count($trayectorialaboralregistradodetalles_detalles)){
                $row='  
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF;" class="td_text_format" >'.trim($trayectorialaboralregistradodetalles_detalles[$i]->trd_empresa).'</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF;" class="td_text_format" >'.trim($this->get_informadaSiNo($trayectorialaboralregistradodetalles_detalles[$i]->trd_informada)).'</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;background-color:#FFF;" class="td_text_format" >'.trim($trayectorialaboralregistradodetalles_detalles[$i]->trd_observaciones).'</td>
                </tr>
    
            
                ';
             
            }else{
                $row='  
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9";></td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;background-color:#D9D9D9"></td>
                </tr>
    
    
                  ';
            }

           $rows_agregar_trayectorialaboralregistradodetalles.=$row;

        }

        $html=str_replace("#tlr_reconocehabeestado#",$this->getSiNo($trayectorialaboralregistrado_data->tlr_reconocehabeestado),$html);
        $html=str_replace("#tlr_reconocehabeestado-style_bg#",$formato_pdf->verificar_si_es_vacio_select($trayectorialaboralregistrado_data->tlr_reconocehabeestado),$html);

        $html=str_replace("#tlr_empresasnoreconoce#",$trayectorialaboralregistrado_data->tlr_empresasnoreconoce,$html);
        $html=str_replace("#tlr_empresasnoreconoce-style_bg#",$formato_pdf->verificar_si_es_vacio_td($trayectorialaboralregistrado_data->tlr_empresasnoreconoce),$html);

        $html=str_replace("#tlr_datocandidatocontienetelcontacto#",$this->getSiNo($trayectorialaboralregistrado_data->tlr_datocandidatocontienetelcontacto),$html);
        $html=str_replace("#tlr_datocandidatocontienetelcontacto-style_bg#",$formato_pdf->verificar_si_es_vacio_select($trayectorialaboralregistrado_data->tlr_datocandidatocontienetelcontacto),$html);

        $html=str_replace("#tlr_datocandidatocontienenombrescontacto#",$this->getSiNo($trayectorialaboralregistrado_data->tlr_datocandidatocontienenombrescontacto),$html);
        $html=str_replace("#tlr_datocandidatocontienenombrescontacto-style_bg#",$formato_pdf->verificar_si_es_vacio_select($trayectorialaboralregistrado_data->tlr_datocandidatocontienenombrescontacto),$html);

        $html=str_replace("#tlr_coincidefechacandadidatoobtenida#",$this->getSiNo($trayectorialaboralregistrado_data->tlr_coincidefechacandadidatoobtenida),$html);
        $html=str_replace("#tlr_coincidefechacandadidatoobtenida-style_bg#",$formato_pdf->verificar_si_es_vacio_select($trayectorialaboralregistrado_data->tlr_coincidefechacandadidatoobtenida),$html);

        $html=str_replace("#tlr_coincidedatoscandidadtoinvestigador#",$this->getSiNo($trayectorialaboralregistrado_data->tlr_coincidedatoscandidadtoinvestigador),$html);
        $html=str_replace("#tlr_coincidedatoscandidadtoinvestigador-style_bg#",$formato_pdf->verificar_si_es_vacio_select($trayectorialaboralregistrado_data->tlr_coincidedatoscandidadtoinvestigador),$html);


        



        $html=str_replace("#filas_dinamicas_trayectorialaboral#",$rows_agregar_trayectorialaboral_detalles,$html);
        $html=str_replace("#filas_dinamicas_trayectorialaboralregistradodetalles#",$rows_agregar_trayectorialaboralregistradodetalles,$html);

        return $html;
    }
}
