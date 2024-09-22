<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Bieninmuebledetalles
 */
class Referencialaboral extends Model
{
    public function NuevoRegistro($data,$permisoRH,$permisoInvestigador,$permisoEscalaDesem){
        $registro_rel= new Referencialaboral();
        $ultimoOrden = ReferenciaLaboral::obtenerUltimoOrden( $data['rel_sel_id']);

        if($permisoInvestigador==1)
        {
            $registro_rel->rel_candidatoempresa=$data['rel_candidatoempresa_crear'];
            $registro_rel->rel_candidatodomicilio=$data['rel_candidatodomicilio_crear'];
            $registro_rel->rel_candidatojefe=$data['rel_candidatojefe_crear'];
            $registro_rel->rel_candidatotelefono=$data['rel_candidatotelefono_crear'];
            
            $registro_rel->rel_candidatopuestofinal=  $data['rel_candidatopuestofinal_crear'] ;

            $registro_rel->rel_candidatopuestoinicial=  $data['rel_candidatopuestoinicial_crear'] ;
            $registro_rel->rel_candidatoingreso=  $data['rel_candidatoingreso_crear'] ;
            $registro_rel->rel_candidatosalida=  $data['rel_candidatosalida_crear'] ;
            $registro_rel->rel_candidatosueldoinicial=  $data['rel_candidatosueldoinicial_crear'] ;
            $registro_rel->rel_candidatosueldofinal=   $data['rel_candidatosueldofinal_crear'] ;
            $registro_rel->rel_candidatoincapacidad=   $data['rel_candidatoincapacidad_crear'] ;
            $registro_rel->rel_candidatodemanda=   $data['rel_candidatodemanda_crear'] ;
            $registro_rel->rel_candidatorecomendable=   $data['rel_candidatorecomendable_crear'] ;
            $registro_rel->rel_candidatoseparacion=   $data['rel_candidatoseparacion_crear'] ;

            
        }

        if($permisoRH==1)
        {
            $registro_rel->rel_rhempresa=   $data['rel_rhempresa_crear'] ;
            $registro_rel->rel_rhdomicilio=   $data['rel_rhdomicilio_crear'] ;
            $registro_rel->rel_rhjefe=   $data['rel_rhjefe_crear'] ;
            $registro_rel->rel_rhtelefono=   $data['rel_rhtelefono_crear'] ;
            $registro_rel->rel_rhpuestoinicial=   $data['rel_rhpuestoinicial_crear'] ;
            $registro_rel->rel_rhpuestofinal=   $data['rel_rhpuestofinal_crear'] ;
            $registro_rel->rel_rhingreso=   $data['rel_rhingreso_crear'] ;
            $registro_rel->rel_rhsalida=   $data['rel_rhsalida_crear'] ;
            $registro_rel->rel_rhsueldoinicial=   $data['rel_rhsueldoinicial_crear'] ;
            $registro_rel->rel_rhsueldofinal=   $data['rel_rhsueldofinal_crear'] ;
            $registro_rel->rel_rhseparacion=   $data['rel_rhseparacion_crear'] ;
            $registro_rel->rel_rhincapacidad=   $data['rel_rhincapacidad_crear'] ;
            $registro_rel->rel_rhdemanda=   $data['rel_rhdemanda_crear'] ;
            $registro_rel->rel_rhrecomendable=   $data['rel_rhrecomendable_crear'] ;

            
        }



        $registro_rel->rel_notas=   $data['rel_notas_crear'] ;

        if($permisoEscalaDesem==1)
        {
            $registro_rel->rel_calidad=   $data['rel_calidad_crear'] ;
            $registro_rel->rel_responsabilidad=   $data['rel_responsabilidad_crear'] ;
            $registro_rel->rel_relaciones=   $data['rel_relaciones_crear'] ;
            $registro_rel->rel_honradez=   $data['rel_honradez_crear'] ;
            $registro_rel->rel_asistencia=   $data['rel_asistencia_crear'] ;
            $registro_rel->rel_puntualidad=   $data['rel_puntualidad_crear'] ;
            $registro_rel->rel_iniciativa=   $data['rel_iniciativa_crear'] ;
            $registro_rel->rel_adicciones=   $data['rel_adicciones_crear'] ;
        }

        $registro_rel->sel_id=   $data['rel_sel_id'] ;
        $registro_rel->rel_estatus=   2 ;
        $registro_rel->rel_orden =$ultimoOrden +1;


        
        if($registro_rel->save()){
            return  $repuesta=['estado'=>2,'rel_id'=> $registro_rel->rel_id,'sel_id'=> $registro_rel->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }
    

    public function ActualizarRegistro($data,$permisoRH,$permisoInvestigador,$permisoEscalaDesem){
        if($permisoInvestigador==1)
        {
            $this->rel_candidatoempresa=$data['rel_candidatoempresa_editar'];
            $this->rel_candidatodomicilio=$data['rel_candidatodomicilio_editar'];
            $this->rel_candidatojefe=$data['rel_candidatojefe_editar'];
            $this->rel_candidatotelefono=$data['rel_candidatotelefono_editar'];
            
            $this->rel_candidatopuestofinal=  $data['rel_candidatopuestofinal_editar'] ;

            $this->rel_candidatopuestoinicial=  $data['rel_candidatopuestoinicial_editar'] ;
            $this->rel_candidatoingreso=  $data['rel_candidatoingreso_editar'] ;
            $this->rel_candidatosalida=  $data['rel_candidatosalida_editar'] ;
            $this->rel_candidatosueldoinicial=  $data['rel_candidatosueldoinicial_editar'] ;
            $this->rel_candidatosueldofinal=   $data['rel_candidatosueldofinal_editar'] ;
            $this->rel_candidatoincapacidad=   $data['rel_candidatoincapacidad_editar'] ;
            $this->rel_candidatodemanda=   $data['rel_candidatodemanda_editar'] ;
            $this->rel_candidatorecomendable=   $data['rel_candidatorecomendable_editar'] ;
            $this->rel_candidatoseparacion=   $data['rel_candidatoseparacion_editar'] ;

            
        }

        if($permisoRH==1)
        {
            $this->rel_rhempresa=   $data['rel_rhempresa_editar'] ;
            $this->rel_rhdomicilio=   $data['rel_rhdomicilio_editar'] ;
            $this->rel_rhjefe=   $data['rel_rhjefe_editar'] ;
            $this->rel_rhtelefono=   $data['rel_rhtelefono_editar'] ;
            $this->rel_rhpuestoinicial=   $data['rel_rhpuestoinicial_editar'] ;
            $this->rel_rhpuestofinal=   $data['rel_rhpuestofinal_editar'] ;
            $this->rel_rhingreso=   $data['rel_rhingreso_editar'] ;
            $this->rel_rhsalida=   $data['rel_rhsalida_editar'] ;
            $this->rel_rhsueldoinicial=   $data['rel_rhsueldoinicial_editar'] ;
            $this->rel_rhsueldofinal=   $data['rel_rhsueldofinal_editar'] ;
            $this->rel_rhseparacion=   $data['rel_rhseparacion_editar'] ;
            $this->rel_rhincapacidad=   $data['rel_rhincapacidad_editar'] ;
            $this->rel_rhdemanda=   $data['rel_rhdemanda_editar'] ;
            $this->rel_rhrecomendable=   $data['rel_rhrecomendable_editar'] ;

            
        }



        $this->rel_notas=   $data['rel_notas_editar'] ;

        if($permisoEscalaDesem==1)
        {
            $this->rel_calidad=   $data['rel_calidad_editar'] ;
            $this->rel_responsabilidad=   $data['rel_responsabilidad_editar'] ;
            $this->rel_relaciones=   $data['rel_relaciones_editar'] ;
            $this->rel_honradez=   $data['rel_honradez_editar'] ;
            $this->rel_asistencia=   $data['rel_asistencia_editar'] ;
            $this->rel_puntualidad=   $data['rel_puntualidad_editar'] ;
            $this->rel_iniciativa=   $data['rel_iniciativa_editar'] ;
            $this->rel_adicciones=   $data['rel_adicciones_editar'] ;
        }


        
        if($this->update()){
            return  $repuesta=['estado'=>2,'rel_id'=> $this->rel_id,'sel_id'=> $this->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }
    public function get_escalaDesempeno($valor)
    {
        switch ($valor){
            case "-1":
                return "";
            case "1":
                return "Excelente";
             case "2":
                return "Apropiado";
             case "3":
                return "Regular";
             case "4":
                return "Deficiente";
           
            default:
                return "";
        }

    }
    public function getRecomendableFormatoTruper($valor){

        switch ($valor){
            case '5':
                return 'RECOMENDABLE';
                    break;
    
            case '1':
                  return 'RECOMENDABLE C/ RESERVAS	';
                    break;
            case '2':
                  return '--NO-- RECOMENDABLE';
                    break;
            case '3':
                  return 'NO DIERON INFORMACIÓN POR POLÍTICAS';
                    break;

            case '4':
                  return 'SOLO DATOS DEL SISTEMA';
                    break;
    
            default:
                   return '';
                    break;

            }

    }

    public function altaEstudioNuevoRegistro($data,$sel_id){

        $registro_rel= new Referencialaboral();
        $registro_rel->rel_candidatoempresa=$data['rel_candidatoempresa'];
        $registro_rel->rel_candidatodomicilio=$data['rel_candidatodomicilio'];
        $registro_rel->rel_candidatojefe=$data['rel_candidatojefe'];
        $registro_rel->rel_candidatotelefono=$data['rel_candidatotelefono'];
        $registro_rel->rel_candidatopuestofinal=  $data['rel_candidatopuestofinal'] ;
        $registro_rel->rel_candidatopuestoinicial=  $data['rel_candidatopuestoinicial'] ;
        $registro_rel->rel_candidatoingreso=  $data['rel_candidatoingreso'] ;
        $registro_rel->rel_candidatosalida=  $data['rel_candidatosalida'] ;
        $registro_rel->rel_candidatosueldoinicial=  $data['rel_candidatosueldoinicial'] ;
        $registro_rel->rel_candidatosueldofinal=   $data['rel_candidatosueldofinal'] ;
        $registro_rel->rel_candidatoincapacidad=   $data['rel_candidatoincapacidad'] ;
        $registro_rel->rel_candidatodemanda=   $data['rel_candidatodemanda'] ;
        $registro_rel->rel_candidatorecomendable=   $data['rel_candidatorecomendable'] ;
        $registro_rel->rel_candidatoseparacion=   $data['rel_candidatoseparacion'] ;
        $registro_rel->rel_notas=$data['rel_notas'];
        $registro_rel->sel_id=$sel_id;
        $registro_rel->rel_estatus=2;

        if($registro_rel->save()){
            return  $repuesta=['estado'=>2,'mensaje'=>'ok','rel_id'=> $registro_rel->rel_id,'sel_id'=> $registro_rel->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2,'mensaje'=>'error'];
        }
    }

    public function NuevoRegistroFormatoTruper($data,$permisoRH,$permisoInvestigador,$permisoEscalaDesem){
        $registro_rel= new Referencialaboral();
        $ultimoOrden = ReferenciaLaboral::obtenerUltimoOrden( $data['sel_id']);

      //  if($permisoInvestigador==1)
    //{
            $registro_rel->rel_candidatoempresa=$data['rel_candidatoempresa'];
            $registro_rel->rel_candidatodomicilio=$data['rel_candidatodomicilio'];
            $registro_rel->rel_candidatoempresagiro=$data['rel_candidatoempresagiro'];


            $registro_rel->rel_candidatoareaincial=$data['rel_candidatoareaincial'];
            $registro_rel->rel_candidatoareafinal=$data['rel_candidatoareafinal'];

            $registro_rel->rel_candidatojefe=$data['rel_candidatojefe'];
            $registro_rel->rel_candidatotelefono=$data['rel_candidatotelefono'];
            $registro_rel->rel_candidatopuestofinal=  $data['rel_candidatopuestofinal'] ;
            $registro_rel->rel_candidatopuestoinicial=  $data['rel_candidatopuestoinicial'] ;
            $registro_rel->rel_candidatoingreso=  $data['rel_candidatoingreso'] ;
            $registro_rel->rel_candidatosalida=  $data['rel_candidatosalida'] ;
            $registro_rel->rel_candidatosueldoinicial=  $data['rel_candidatosueldoinicial'] ;
            $registro_rel->rel_candidatosueldofinal=   $data['rel_candidatosueldofinal'] ;
            $registro_rel->rel_candidatodemanda=   $data['rel_candidatodemanda'] ;
            $registro_rel->rel_candidatorecomendable=   $data['rel_candidatorecomendable'] ;
            $registro_rel->rel_candidatoseparacion=   $data['rel_candidatoseparacion'] ;

            
        //}

        

        $registro_rel->rel_notas=   $data['rel_notas'] ;

        if($permisoEscalaDesem==1)
        {

            
            $registro_rel->rel_desempenio=   $data['rel_desempenio'] ;


            $registro_rel->rel_trabajoenquipo=   $data['rel_trabajoenquipo'] ;
            $registro_rel->rel_adaptacion=   $data['rel_adaptacion'] ;
            $registro_rel->rel_decisiones=   $data['rel_decisiones'] ;
            $registro_rel->rel_apegonormas=   $data['rel_apegonormas'] ;
            $registro_rel->rel_relacionessuperiores=   $data['rel_relacionessuperiores'] ;
            $registro_rel->rel_relacionescompanieros=   $data['rel_relacionescompanieros'] ;
            
            $registro_rel->rel_calidad=   $data['rel_calidad'] ;
            $registro_rel->rel_responsabilidad=   $data['rel_responsabilidad'] ;
            $registro_rel->rel_honradez=   $data['rel_honradez'] ;
            // $registro_rel->rel_asistencia=   $data['rel_asistencia'] ;
            $registro_rel->rel_puntualidad=   $data['rel_puntualidad'] ;
            $registro_rel->rel_iniciativa=   $data['rel_iniciativa'] ;
         
        }

        $registro_rel->sel_id=   $data['sel_id'] ;
        $registro_rel->rel_estatus=   2 ;
        $registro_rel->rel_orden =$ultimoOrden +1;
        
        if($registro_rel->save()){
            return  $repuesta=['estado'=>2,'rel_id'=> $registro_rel->rel_id,'sel_id'=> $registro_rel->sel_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }

    public function getDemanda_FormatoTruper($valor){
        switch ($valor){
            case "-1":
                return "";
            case "1":
                return "SI";
             case "0":
                return "NO";

           
            default:
                return "";
        }
    }

    public function getRecomendable_FormatoTruper($valor){
        switch ($valor){
            case "-1":
                return "";
            case "1":
                return "RECOMENDABLE C / RESERVAS";
            case "2":
                return "--  NO -- RECOMENDABLE";

            case "3":
                return "NO DIERON INFORMACIÓN POR POLÍTICAS";

            case "4":
                return "SOLO DATOS DEL SISTEMA	";

           
            default:
                return "";
        }
    }

    public function ActualizarRegistroFormatoTruper($data,$permisoRH,$permisoInvestigador,$permisoEscalaDesem){
        // $registro_rel= new Referencialaboral();
      //  if($permisoInvestigador==1)
    //{
            $this->rel_candidatoempresa=$data['rel_candidatoempresa'];
            $this->rel_candidatodomicilio=$data['rel_candidatodomicilio'];
            $this->rel_candidatoempresagiro=$data['rel_candidatoempresagiro'];


            $this->rel_candidatoareaincial=$data['rel_candidatoareaincial'];
            $this->rel_candidatoareafinal=$data['rel_candidatoareafinal'];

            $this->rel_candidatojefe=$data['rel_candidatojefe'];
            $this->rel_candidatotelefono=$data['rel_candidatotelefono'];
            $this->rel_candidatopuestofinal=  $data['rel_candidatopuestofinal'] ;
            $this->rel_candidatopuestoinicial=  $data['rel_candidatopuestoinicial'] ;
            $this->rel_candidatoingreso=  $data['rel_candidatoingreso'] ;
            $this->rel_candidatosalida=  $data['rel_candidatosalida'] ;
            $this->rel_candidatosueldoinicial=  $data['rel_candidatosueldoinicial'] ;
            $this->rel_candidatosueldofinal=   $data['rel_candidatosueldofinal'] ;
            $this->rel_candidatodemanda=   $data['rel_candidatodemanda'] ;
            $this->rel_candidatorecomendable=   $data['rel_candidatorecomendable'] ;
            $this->rel_candidatoseparacion=   $data['rel_candidatoseparacion'] ;

            
        //}

        

        $this->rel_notas=   $data['rel_notas'] ;

        if($permisoEscalaDesem==1)
        {

            
            $this->rel_desempenio=   $data['rel_desempenio'] ;


            $this->rel_trabajoenquipo=   $data['rel_trabajoenquipo'] ;
            $this->rel_adaptacion=   $data['rel_adaptacion'] ;
            $this->rel_decisiones=   $data['rel_decisiones'] ;
            $this->rel_apegonormas=   $data['rel_apegonormas'] ;
            $this->rel_relacionessuperiores=   $data['rel_relacionessuperiores'] ;
            $this->rel_relacionescompanieros=   $data['rel_relacionescompanieros'] ;
            
            $this->rel_calidad=   $data['rel_calidad'] ;
            $this->rel_responsabilidad=   $data['rel_responsabilidad'] ;
            $this->rel_honradez=   $data['rel_honradez'] ;
            // $registro_rel->rel_asistencia=   $data['rel_asistencia'] ;
            $this->rel_puntualidad=   $data['rel_puntualidad'] ;
            $this->rel_iniciativa=   $data['rel_iniciativa'] ;
         
        }

        // $this->sel_id=   $data['sel_id'] ;
        // $registro_rel->rel_estatus=   2 ;


        
        if($this->save()){
            return  $repuesta=['estado'=>2,'rel_id'=> $this->rel_id,'sel_id'=> $this->sel_id];
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

    public function getCalidadFormatoTruper($valor){

        switch ($valor) {
            case '1':
                return 'BUENO';
                break;

            case '2':
                return 'REGULAR';
                    break;
            case '3':
                return 'MALO';
                    break;
            
            default:
                return '';
                break;
        }

    }

    
    public function getHonradezFormatoTruper($valor){
        
        switch ($valor) {
            case '1':
                return 'BUENO';
                break;

            case '2':
                return 'REGULAR';
                    break;
            case '3':
                return 'MALO';
                    break;
            
            default:
                return '';
                break;
        }

    }
    public function getDesempenioFormatoTruper($valor){
        
        switch ($valor) {
            case '1':
                return 'BUENO';
                break;

            case '2':
                return 'REGULAR';
                    break;
            case '3':
                return 'MALO';
                    break;
            
            default:
                return '';
                break;
        }

    }
    public function getRelacionComapnierosFormatoTruper($valor){
        
        switch ($valor) {
            case '1':
                return 'EXCELENTE (ABIERTO)	';
                break;

            case '2':
                return 'BUENO (ABIERTO)	';
                    break;
            case '3':
                return 'LO NECESARIO';
                    break;
            case '4':
                return 'PASA DESAPERCIBIDO';
                    break;
            case '5':
                return 'MALO';
                    break;
            default:
                return '';
                break;
        }
    }
    public function getRelacionSuperioresFormatoTruper($valor){
        
        switch ($valor) {
            case '1':
                return 'EXCELENTE (ABIERTO)	';
                break;

            case '2':
                return 'BUENO (ABIERTO)	';
                    break;
            case '3':
                return 'LO NECESARIO';
                    break;
            case '4':
                return 'PASA DESAPERCIBIDO';
                    break;
            case '5':
                return 'MALO';
                    break;
            default:
                return '';
                break;
        }

    }

    public function formatoEseTruper($ese_id,$data_seccion_laboral,$data_referencialaborales,$ese_data){
        $reporte= new PdfReporteTruper();
        $formato_pdf=new FormatotruperPDF();

        $html=$reporte->referenciaslaborales_pagina_9_10;    
        $referencialaboral_data_consulta=new Builder();
        $referencialaboral_data_consulta=$referencialaboral_data_consulta
        ->addFrom('Referencialaboral','rel')
        ->where('sel_id='.$data_seccion_laboral->sel_id.' and rel_estatus=2 ')
        ->orderBy('rel_orden')
        ->getQuery()
        ->execute();
    
        for ($i=0; $i <=3 ; $i++) {
        
       
            if($i<count($referencialaboral_data_consulta)){
              
                // $html=str_replace("#sei_concepto-$i#",$referencialaboral_data_consulta[$i]->sei_concepto,$html);
                $html=str_replace("#rel_nombrecandidato-$i#",trim($ese_data->get_nombrecompletocandidato()),$html);

                $html=str_replace("#rel_candidatoempresa-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatoempresa),$html);
                $html=str_replace("#rel_candidatoempresa-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatoempresa),$html);

                $html=str_replace("#rel_candidatoempresagiro-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatoempresagiro),$html);
                $html=str_replace("#rel_candidatoempresagiro-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatoempresagiro),$html);

                $html=str_replace("#rel_candidatodomicilio-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatodomicilio),$html);
                $html=str_replace("#rel_candidatodomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatodomicilio),$html);

                $html=str_replace("#rel_candidatodomicilio-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatodomicilio),$html);
                $html=str_replace("#rel_candidatodomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatodomicilio),$html);

                $html=str_replace("#rel_candidatotelefono-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatotelefono),$html);
                $html=str_replace("#rel_candidatotelefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatotelefono),$html);

                $html=str_replace("#rel_periodo-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatoingreso),$html);
                $html=str_replace("#rel_periodo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatoingreso),$html);

                $html=str_replace("#rel_candidatopuestoinicial-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatopuestoinicial),$html);
                $html=str_replace("#rel_candidatopuestoinicial-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatopuestoinicial),$html);

                $html=str_replace("#rel_candidatoareaincial-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatoareaincial),$html);
                $html=str_replace("#rel_candidatoareaincial-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatoareaincial),$html);


                $html=str_replace("#rel_candidatojefe-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatojefe),$html);
                $html=str_replace("#rel_candidatojefe-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatojefe),$html);

                $html=str_replace("#rel_candidatojefe-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatojefe),$html);
                $html=str_replace("#rel_candidatojefe-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatojefe),$html);

                $html=str_replace("#rel_candidatoseparacion-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatoseparacion),$html);
                $html=str_replace("#rel_candidatoseparacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatoseparacion),$html);

                $html=str_replace("#rel_candidatosueldoinicial-$i#",trim($referencialaboral_data_consulta[$i]->rel_candidatosueldoinicial),$html);
                $html=str_replace("#rel_candidatosueldoinicial-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_candidatosueldoinicial),$html);

                
                //si,no
                $html=str_replace("#rel_candidatodemanda-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_candidatodemanda)),$html);
                $html=str_replace("#rel_candidatodemanda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_candidatodemanda),$html);

                $html=str_replace("#rel_candidatorecomendable-$i#",trim($this->getRecomendableFormatoTruper($referencialaboral_data_consulta[$i]->rel_candidatorecomendable)),$html);
                $html=str_replace("#rel_candidatorecomendable-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_candidatorecomendable),$html);

                $html=str_replace("#rel_apegonormas-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_apegonormas)),$html);
                $html=str_replace("#rel_apegonormas-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_apegonormas),$html);

                $html=str_replace("#rel_responsabilidad-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_responsabilidad)),$html);
                $html=str_replace("#rel_responsabilidad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_responsabilidad),$html);

                $html=str_replace("#rel_puntualidad-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_puntualidad)),$html);
                $html=str_replace("#rel_puntualidad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_puntualidad),$html);

                $html=str_replace("#rel_iniciativa-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_iniciativa)),$html);
                $html=str_replace("#rel_iniciativa-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_iniciativa),$html);

                $html=str_replace("#rel_adaptacion-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_adaptacion)),$html);
                $html=str_replace("#rel_adaptacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_adaptacion),$html);

                $html=str_replace("#rel_decisiones-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_decisiones)),$html);
                $html=str_replace("#rel_decisiones-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_decisiones),$html);

                $html=str_replace("#rel_trabajoenquipo-$i#",trim($this->getSiONo($referencialaboral_data_consulta[$i]->rel_trabajoenquipo)),$html);
                $html=str_replace("#rel_trabajoenquipo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_trabajoenquipo),$html);

                //si.no
                $html=str_replace("#rel_notas-$i#",trim($referencialaboral_data_consulta[$i]->rel_notas),$html);
                $html=str_replace("#rel_notas-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td($referencialaboral_data_consulta[$i]->rel_notas),$html);

                

                ///selects dinamicos
                $html=str_replace("#rel_calidad-$i#",trim($this->getCalidadFormatoTruper($referencialaboral_data_consulta[$i]->rel_calidad)),$html);
                $html=str_replace("#rel_calidad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_calidad),$html);

                $html=str_replace("#rel_honradez-$i#",trim($this->getHonradezFormatoTruper($referencialaboral_data_consulta[$i]->rel_honradez)),$html);
                $html=str_replace("#rel_honradez-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_honradez),$html);

                $html=str_replace("#rel_desempenio-$i#",trim($this->getDesempenioFormatoTruper($referencialaboral_data_consulta[$i]->rel_desempenio)),$html);
                $html=str_replace("#rel_desempenio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_desempenio),$html);

                $html=str_replace("#rel_relacionessuperiores-$i#",trim($this->getRelacionSuperioresFormatoTruper($referencialaboral_data_consulta[$i]->rel_relacionessuperiores)),$html);
                $html=str_replace("#rel_relacionessuperiores-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_relacionessuperiores),$html);

                $html=str_replace("#rel_relacionescompanieros-$i#",trim($this->getRelacionSuperioresFormatoTruper($referencialaboral_data_consulta[$i]->rel_relacionescompanieros)),$html);
                $html=str_replace("#rel_relacionescompanieros-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_select($referencialaboral_data_consulta[$i]->rel_relacionescompanieros),$html);

            }else{
  
                $html=str_replace("#rel_nombrecandidato-$i#",'',$html);
                $html=str_replace("#rel_nombrecandidato-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);


                $html=str_replace("#rel_candidatoempresa-$i#",'',$html);
                $html=str_replace("#rel_candidatoempresa-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);
 
                $html=str_replace("#rel_candidatoempresagiro-$i#",'',$html);
                $html=str_replace("#rel_candidatoempresagiro-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                
                $html=str_replace("#rel_candidatodomicilio-$i#",'',$html); 
                $html=str_replace("#rel_candidatodomicilio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_candidatotelefono-$i#",'',$html); 
                $html=str_replace("#rel_candidatotelefono-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_periodo-$i#",'',$html); 
                $html=str_replace("#rel_periodo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_candidatopuestoinicial-$i#",'',$html); 
                $html=str_replace("#rel_candidatopuestoinicial-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_candidatoareaincial-$i#",'',$html); 
                $html=str_replace("#rel_candidatoareaincial-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_candidatojefe-$i#",'',$html); 
                $html=str_replace("#rel_candidatojefe-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_candidatosueldoinicial-$i#",'',$html); 
                $html=str_replace("#rel_candidatosueldoinicial-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_candidatoseparacion-$i#",'',$html);   
                $html=str_replace("#rel_candidatoseparacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);
         
                $html=str_replace("#rel_candidatodemanda-$i#",'',$html); 
                $html=str_replace("#rel_candidatodemanda-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_notas-$i#",'',$html); 
                $html=str_replace("#rel_notas-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);


                $html=str_replace("#rel_candidatorecomendable-$i#",'',$html); 
                $html=str_replace("#rel_candidatorecomendable-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_desempenio-$i#",'',$html); 
                $html=str_replace("#rel_desempenio-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_trabajoenquipo-$i#",'',$html); 
                $html=str_replace("#rel_trabajoenquipo-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_decisiones-$i#",'',$html); 
                $html=str_replace("#rel_decisiones-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_honradez-$i#",'',$html); 
                $html=str_replace("#rel_honradez-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_adaptacion-$i#",'',$html); 
                $html=str_replace("#rel_adaptacion-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_calidad-$i#",'',$html); 
                $html=str_replace("#rel_calidad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);


                $html=str_replace("#rel_iniciativa-$i#",'',$html); 
                $html=str_replace("#rel_iniciativa-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_puntualidad-$i#",'',$html);
                $html=str_replace("#rel_puntualidad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);
 
                $html=str_replace("#rel_responsabilidad-$i#",'',$html); 
                $html=str_replace("#rel_responsabilidad-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_apegonormas-$i#",'',$html); 
                $html=str_replace("#rel_apegonormas-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_relacionessuperiores-$i#",'',$html); 
                $html=str_replace("#rel_relacionessuperiores-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_relacionescompanieros-$i#",'',$html); 
                $html=str_replace("#rel_relacionescompanieros-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                $html=str_replace("#rel_relacionessuperiores-$i#",'',$html); 
                $html=str_replace("#rel_relacionessuperiores-$i-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);


                


            }

         

        }
        

        
        return $html;
    }

    public function cambiarOrdenArriba($rel_id)
    {
        $answer["estado"] = -2;
        $answer["mensaje"] = "error";
        $answer["rel_id"] = $rel_id;
        $referencia = ReferenciaLaboral::findFirstByrel_id($rel_id);
    
        if ($referencia) {
            $answer["sel_id"] =  $referencia->sel_id;

            // Obtener todas las referencias con el mismo sel_id y ordenar por rel_orden
            $referencias = ReferenciaLaboral::find([
                "conditions" => "sel_id = :sel_id: AND rel_estatus != -2",
                "bind" => ["sel_id" => $referencia->sel_id],
                "order" => "rel_orden ASC"
            ]);
    
            // Asignar nuevos ordenes consecutivos
            $nuevoOrden = 1;
            foreach ($referencias as $ref) {
                $ref->rel_orden = $nuevoOrden;
                $ref->save();
                $nuevoOrden++;
            }
    
            // Obtener la referencia actual con el nuevo orden
            $referencia = ReferenciaLaboral::findFirstByrel_id($rel_id);
    
            // Obtener la referencia con un orden inmediatamente inferior y el mismo sel_id
            $referenciaAnterior = ReferenciaLaboral::findFirst([
                "conditions" => "rel_orden = :orden: AND rel_estatus != -2 AND sel_id = :sel_id:",
                "bind"       => ["orden" => ($referencia->rel_orden - 1), "sel_id" => $referencia->sel_id]
            ]);
    
            if ($referenciaAnterior) {
                // Intercambiar los valores de rel_orden
                $tempOrden = $referenciaAnterior->rel_orden;
                $referenciaAnterior->rel_orden = $referencia->rel_orden;
                $referencia->rel_orden = $tempOrden;
    
                // Guardar los cambios
                $referenciaAnterior->save();
                $referencia->save();
    
                $answer["estado"] = 2;
                $answer["mensaje"] = "Orden cambiado hacia arriba con éxito.";
            } else {
                $answer["mensaje"] = "No hay referencia anterior para cambiar el orden.";
            }
        } else {
            $answer["mensaje"] = "Referencia no encontrada.";
        }
    
        return $answer;
    }
    
    
    
    public function cambiarOrdenAbajo($rel_id)
    {
        $answer["estado"] = -2;
        $answer["mensaje"] = "error";
        $answer["rel_id"] = $rel_id;
    
        $referencia = ReferenciaLaboral::findFirstByrel_id($rel_id);
    
        if ($referencia) {
            $answer["sel_id"] =  $referencia->sel_id;
    
            // Obtener todas las referencias con el mismo sel_id y ordenar por rel_orden
            $referencias = ReferenciaLaboral::find([
                "conditions" => "sel_id = :sel_id: AND rel_estatus != -2",
                "bind" => ["sel_id" => $referencia->sel_id],
                "order" => "rel_orden ASC"
            ]);
    
            // Asignar nuevos ordenes consecutivos
            $nuevoOrden = 1;
            foreach ($referencias as $ref) {
                $ref->rel_orden = $nuevoOrden;
                $ref->save();
                $nuevoOrden++;
            }
    
            // Obtener la referencia actual con el nuevo orden
            $referencia = ReferenciaLaboral::findFirstByrel_id($rel_id);
    
            // Obtener la referencia con un orden inmediatamente superior y el mismo sel_id
            $referenciaSiguiente = ReferenciaLaboral::findFirst([
                "conditions" => "rel_orden = :orden: AND rel_estatus != -2 AND sel_id = :sel_id:",
                "bind" => ["orden" => ($referencia->rel_orden + 1), "sel_id" => $referencia->sel_id]
            ]);
    
            if ($referenciaSiguiente) {
                // Intercambiar los valores de rel_orden
                $tempOrden = $referenciaSiguiente->rel_orden;
                $referenciaSiguiente->rel_orden = $referencia->rel_orden;
                $referencia->rel_orden = $tempOrden;
    
                // Guardar los cambios
                $referenciaSiguiente->save();
                $referencia->save();
    
                $answer["estado"] = 2;
                $answer["mensaje"] = "Orden cambiado hacia abajo con éxito.";
            } else {
                $answer["mensaje"] = "No hay referencia siguiente para cambiar el orden.";
            }
        } else {
            $answer["mensaje"] = "Referencia no encontrada.";
        }
    
        return $answer;
    }

    public function reordenarDespuesBorrar($sel_id)
    {
        $answer["estado"] = -2;
        $answer["mensaje"] = "error";

        // Obtener todas las referencias con el mismo sel_id y estatus != -2, ordenadas por rel_orden
        $referencias = ReferenciaLaboral::find([
            "conditions" => "sel_id = :sel_id: AND rel_estatus != -2",
            "bind" => ["sel_id" => $sel_id],
            "order" => "rel_orden ASC"
        ]);

        if ($referencias->count() > 0) {
            // Asignar nuevos ordenes consecutivos
            $nuevoOrden = 1;
            foreach ($referencias as $ref) {
                $ref->rel_orden = $nuevoOrden;
                $ref->save();
                $nuevoOrden++;
            }

            $answer["estado"] = 2;
            $answer["mensaje"] = "Reordenado con éxito.";
        } else {
            $answer["estado"] = -1;

            $answer["mensaje"] = "No hay referencias para reordenar.";
        }

        return $answer;
    }
    public static function obtenerUltimoOrden($sel_id)
    {
        try {
            if ($sel_id == 0) {
                throw new Exception("El valor de sel_id no puede ser 0.");
            }
    
            $conditions = "rel_estatus != -2 AND sel_id = :sel_id:";

            $ultimoOrden = ReferenciaLaboral::maximum([
                "column" => "rel_orden",
                "conditions" => $conditions,
                "bind" => ["sel_id" => $sel_id]
            ]);

            return $ultimoOrden;

        } catch (\Exception $e) {
            
            return null; // O cualquier valor que desees en caso de excepción
        }
    }

}