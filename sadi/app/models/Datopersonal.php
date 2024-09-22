<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Datopersonal extends Model
{
    public function getSiNo($id){
        switch ($id){
            case "0":
                return "NO";
            case "1":
                return "SÍ";
            default:
                return "";
        }
    }
    public function getEdad($date)
    {
        
        $dob = new DateTime($date);
        
        $now = new DateTime();
         
        $difference = $now->diff($dob);
         
        $age = $difference->y;
         
        return  $age;
    }

    public function getEdadFormatTexto($date){

        $age=$this->getEdad($date);
      
       if($age==1){
        return  $age.' AÑO';
       }

       if($age>0){
        return  $age.' AÑOS';

       }
       else{
        return '';

       }
    }

    public function getCalificacionBackgroundTdTruper($value){

  
        switch ($value) {

            case '3':
                return 'background-color:green; color:white;';
                    break;
    
            case '2':
                  return 'background-color:yellow;	 color:black;';
                    break;
            case '1':
                  return 'background-color:red; color:white;';
                    break;
    
                default:
                   return 'background-color:#D9D9D9;';
                    break;
            }

    }
    // calificacion
    public function getCalificacionTruper($cal_id){
        $obj_cal=new Calificacionfinal();
        $cal_texto= $obj_cal->getCalificacionTexto($cal_id);
        return $cal_texto;
        // switch ($value) {
        //     case '3':
        //         return 'RECOMENDABLE';
        //             break;
    
        //     case '2':
        //           return 'RECOMENDABLE CON RESERVAS	';
        //             break;
        //     case '1':
        //           return 'NO - RECOMENDABLE';
        //             break;
        //         default:
        //            return '';
        //             break;
        //     }
    
    }

    public function formatoeses($estudio,$datocomprobatorio){
        $reporte= new PdfReporte();
        $html=$reporte->datospersonales;

        $html=str_replace("#ese_lugarnacimiento#",trim($estudio->ese_lugarnacimiento),$html);
        $html=str_replace("#cop_nacimientolugar#",trim($datocomprobatorio->cop_nacimientolugar),$html);
        $html=str_replace("#cop_nacimientofecha#",trim($datocomprobatorio->cop_nacimientofecha),$html);
        $ini= new DateTime($estudio->ese_fechanacimiento);
        $html=str_replace("#ese_fechanacimiento#",$ini->format('d/m/Y'),$html);
        $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
        $dat = new Datocomprobatorio();
        $html=str_replace("#ese_sexo#",trim($dat->getSexo($estudio->ese_sexo)),$html);

        $dat=new Estadocivil();
        $html=str_replace("#esc_id#",trim($dat->getNombreEstadoCivil($estudio->esc_id)),$html);

        $html=str_replace("#ese_calle#",trim($estudio->ese_calle),$html);
        $html=str_replace("#ese_numext#",trim($estudio->ese_numext),$html);
        $html=str_replace("#ese_numint#",trim($estudio->ese_numint),$html);

        $html=str_replace("#ese_colonia#",trim($estudio->ese_colonia),$html);
        $dat=new Municipio();
        $html=str_replace("#mun_id#",trim($dat->getNombre($estudio->mun_id)),$html);
        $html=str_replace("#ese_codpostal#",trim($estudio->ese_codpostal),$html);
        $dat=new Estado();
        $html=str_replace("#est_id#",trim($dat->getNombre($estudio->est_id)),$html);
        $html=str_replace("#ese_entrecalles#",trim($estudio->ese_entrecalles),$html);
        $html=str_replace("#ese_celular#",trim($estudio->ese_celular),$html);
        $html=str_replace("#ese_telefono#",trim($estudio->ese_telefono),$html);


        $html=str_replace("#cop_nacimientofolio#",trim($datocomprobatorio->cop_nacimientofolio),$html);

        $html=str_replace("#cop_matrimoniofecha#",trim($datocomprobatorio->cop_matrimoniofecha),$html);
        $html=str_replace("#cop_matrimoniolugar#",trim($datocomprobatorio->cop_matrimoniolugar),$html);
        $html=str_replace("#cop_matrimoniofolio#",trim($datocomprobatorio->cop_matrimoniofolio),$html);

        $html=str_replace("#cop_conyugefecha#",trim($datocomprobatorio->cop_conyugefecha),$html);
        $html=str_replace("#cop_conyugelugar#",trim($datocomprobatorio->cop_conyugelugar),$html);
        $html=str_replace("#cop_conyugefolio#",trim($datocomprobatorio->cop_conyugefolio),$html);

        $html=str_replace("#cop_nacimientohijosfecha#",trim($datocomprobatorio->cop_nacimientohijosfecha),$html);
        $html=str_replace("#cop_nacimientohijoslugar#",trim($datocomprobatorio->cop_nacimientohijoslugar),$html);
        $html=str_replace("#cop_nacimientohijosfolio#",trim($datocomprobatorio->cop_nacimientohijosfolio),$html);

        $html=str_replace("#cop_comprobantedomiciliofecha#",trim($datocomprobatorio->cop_comprobantedomiciliofecha),$html);
        $html=str_replace("#cop_comprobantedomiciliolugar#",trim($datocomprobatorio->cop_comprobantedomiciliolugar),$html);
        $html=str_replace("#cop_comprobantedomiciliofolio#",trim($datocomprobatorio->cop_comprobantedomiciliofolio),$html);

        $html=str_replace("#cop_credencialelectorfecha#",trim($datocomprobatorio->cop_credencialelectorfecha),$html);
        $html=str_replace("#cop_credencialelectorlugar#",trim($datocomprobatorio->cop_credencialelectorlugar),$html);
        $html=str_replace("#cop_credencialelectorfolio#",trim($datocomprobatorio->cop_credencialelectorfolio),$html);

        $html=str_replace("#cop_curpfecha#",trim($datocomprobatorio->cop_curpfecha),$html);
        $html=str_replace("#cop_curplugar#",trim($datocomprobatorio->cop_curplugar),$html);
        $html=str_replace("#cop_curpfolio#",trim($datocomprobatorio->cop_curpfolio),$html);

        $html=str_replace("#cop_imssfecha#",trim($datocomprobatorio->cop_imssfecha),$html);
        $html=str_replace("#cop_imsslugar#",trim($datocomprobatorio->cop_imsslugar),$html);
        $html=str_replace("#cop_imssfolio#",trim($datocomprobatorio->cop_imssfolio),$html);

        $html=str_replace("#cop_retencionfecha#",trim($datocomprobatorio->cop_retencionfecha),$html);
        $html=str_replace("#cop_retencionlugar#",trim($datocomprobatorio->cop_retencionlugar),$html);
        $html=str_replace("#cop_retencionfolio#",trim($datocomprobatorio->cop_retencionfolio),$html);

        $html=str_replace("#cop_rfcfecha#",trim($datocomprobatorio->cop_rfcfecha),$html);
        $html=str_replace("#cop_rfclugar#",trim($datocomprobatorio->cop_rfclugar),$html);
        $html=str_replace("#cop_rfcfolio#",trim($datocomprobatorio->cop_rfcfolio),$html);

        $html=str_replace("#cop_cartillafecha#",trim($datocomprobatorio->cop_cartillafecha),$html);
        $html=str_replace("#cop_cartillalugar#",trim($datocomprobatorio->cop_cartillalugar),$html);
        $html=str_replace("#cop_cartillafolio#",trim($datocomprobatorio->cop_cartillafolio),$html);

        $html=str_replace("#cop_licenciafecha#",trim($datocomprobatorio->cop_licenciafecha),$html);
        $html=str_replace("#cop_licencialugar#",trim($datocomprobatorio->cop_licencialugar),$html);
        $html=str_replace("#cop_licenciafolio#",trim($datocomprobatorio->cop_licenciafolio),$html);

        $html=str_replace("#cop_migratoriafecha#",trim($datocomprobatorio->cop_migratoriafecha),$html);
        $html=str_replace("#cop_migratorialugar#",trim($datocomprobatorio->cop_migratorialugar),$html);
        $html=str_replace("#cop_migratoriafolio#",trim($datocomprobatorio->cop_migratoriafolio),$html);

        return $html;
    }

    public function formatogabtubos($estudio,$datocomprobatorio){
        $reporte= new PdfReporteGabineteTubos();
        $html=$reporte->datospersonales;

        $html=str_replace("#ese_lugarnacimiento#",trim($estudio->ese_lugarnacimiento),$html);
        $html=str_replace("#cop_nacimientolugar#",trim($datocomprobatorio->cop_nacimientolugar),$html);
        $html=str_replace("#cop_nacimientofecha#",trim($datocomprobatorio->cop_nacimientofecha),$html);
        $ini= new DateTime($estudio->ese_fechanacimiento);
        $html=str_replace("#ese_fechanacimiento#",$ini->format('d/m/Y'),$html);
        $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
        $dat = new Datocomprobatorio();
        $html=str_replace("#ese_sexo#",trim($dat->getSexo($estudio->ese_sexo)),$html);

        $dat=new Estadocivil();
        $html=str_replace("#esc_id#",trim($dat->getNombreEstadoCivil($estudio->esc_id)),$html);

        $html=str_replace("#ese_calle#",trim($estudio->ese_calle),$html);
        $html=str_replace("#ese_numext#",trim($estudio->ese_numext),$html);
        $html=str_replace("#ese_numint#",trim($estudio->ese_numint),$html);

        $html=str_replace("#ese_colonia#",trim($estudio->ese_colonia),$html);
        $dat=new Municipio();
        $html=str_replace("#mun_id#",trim($dat->getNombre($estudio->mun_id)),$html);
        $html=str_replace("#ese_codpostal#",trim($estudio->ese_codpostal),$html);
        $dat=new Estado();
        $html=str_replace("#est_id#",trim($dat->getNombre($estudio->est_id)),$html);
        $html=str_replace("#ese_entrecalles#",trim($estudio->ese_entrecalles),$html);
        $html=str_replace("#ese_celular#",trim($estudio->ese_celular),$html);
        $html=str_replace("#ese_telefono#",trim($estudio->ese_telefono),$html);


        $html=str_replace("#cop_nacimientofolio#",trim($datocomprobatorio->cop_nacimientofolio),$html);

        $html=str_replace("#cop_matrimoniofecha#",trim($datocomprobatorio->cop_matrimoniofecha),$html);
        $html=str_replace("#cop_matrimoniolugar#",trim($datocomprobatorio->cop_matrimoniolugar),$html);
        $html=str_replace("#cop_matrimoniofolio#",trim($datocomprobatorio->cop_matrimoniofolio),$html);

        $html=str_replace("#cop_conyugefecha#",trim($datocomprobatorio->cop_conyugefecha),$html);
        $html=str_replace("#cop_conyugelugar#",trim($datocomprobatorio->cop_conyugelugar),$html);
        $html=str_replace("#cop_conyugefolio#",trim($datocomprobatorio->cop_conyugefolio),$html);

        $html=str_replace("#cop_nacimientohijosfecha#",trim($datocomprobatorio->cop_nacimientohijosfecha),$html);
        $html=str_replace("#cop_nacimientohijoslugar#",trim($datocomprobatorio->cop_nacimientohijoslugar),$html);
        $html=str_replace("#cop_nacimientohijosfolio#",trim($datocomprobatorio->cop_nacimientohijosfolio),$html);

        $html=str_replace("#cop_comprobantedomiciliofecha#",trim($datocomprobatorio->cop_comprobantedomiciliofecha),$html);
        $html=str_replace("#cop_comprobantedomiciliolugar#",trim($datocomprobatorio->cop_comprobantedomiciliolugar),$html);
        $html=str_replace("#cop_comprobantedomiciliofolio#",trim($datocomprobatorio->cop_comprobantedomiciliofolio),$html);

        $html=str_replace("#cop_credencialelectorfecha#",trim($datocomprobatorio->cop_credencialelectorfecha),$html);
        $html=str_replace("#cop_credencialelectorlugar#",trim($datocomprobatorio->cop_credencialelectorlugar),$html);
        $html=str_replace("#cop_credencialelectorfolio#",trim($datocomprobatorio->cop_credencialelectorfolio),$html);

        $html=str_replace("#cop_curpfecha#",trim($datocomprobatorio->cop_curpfecha),$html);
        $html=str_replace("#cop_curplugar#",trim($datocomprobatorio->cop_curplugar),$html);
        $html=str_replace("#cop_curpfolio#",trim($datocomprobatorio->cop_curpfolio),$html);

        $html=str_replace("#cop_imssfecha#",trim($datocomprobatorio->cop_imssfecha),$html);
        $html=str_replace("#cop_imsslugar#",trim($datocomprobatorio->cop_imsslugar),$html);
        $html=str_replace("#cop_imssfolio#",trim($datocomprobatorio->cop_imssfolio),$html);

        $html=str_replace("#cop_retencionfecha#",trim($datocomprobatorio->cop_retencionfecha),$html);
        $html=str_replace("#cop_retencionlugar#",trim($datocomprobatorio->cop_retencionlugar),$html);
        $html=str_replace("#cop_retencionfolio#",trim($datocomprobatorio->cop_retencionfolio),$html);

        $html=str_replace("#cop_rfcfecha#",trim($datocomprobatorio->cop_rfcfecha),$html);
        $html=str_replace("#cop_rfclugar#",trim($datocomprobatorio->cop_rfclugar),$html);
        $html=str_replace("#cop_rfcfolio#",trim($datocomprobatorio->cop_rfcfolio),$html);

        $html=str_replace("#cop_cartillafecha#",trim($datocomprobatorio->cop_cartillafecha),$html);
        $html=str_replace("#cop_cartillalugar#",trim($datocomprobatorio->cop_cartillalugar),$html);
        $html=str_replace("#cop_cartillafolio#",trim($datocomprobatorio->cop_cartillafolio),$html);

        $html=str_replace("#cop_licenciafecha#",trim($datocomprobatorio->cop_licenciafecha),$html);
        $html=str_replace("#cop_licencialugar#",trim($datocomprobatorio->cop_licencialugar),$html);
        $html=str_replace("#cop_licenciafolio#",trim($datocomprobatorio->cop_licenciafolio),$html);

        $html=str_replace("#cop_migratoriafecha#",trim($datocomprobatorio->cop_migratoriafecha),$html);
        $html=str_replace("#cop_migratorialugar#",trim($datocomprobatorio->cop_migratorialugar),$html);
        $html=str_replace("#cop_migratoriafolio#",trim($datocomprobatorio->cop_migratoriafolio),$html);

        return $html;
    }

    public function formatogabencognv($estudio){
        $reporte= new PdfReporteGabineteEncognv();
        $html=$reporte->datospersonales;
        $direccion_completa_ese="";
        $ini= new DateTime($estudio->ese_fechanacimiento);
        $html=str_replace("#ese_lugarnacimiento#",trim($estudio->ese_lugarnacimiento),$html);
        $html=str_replace("#ese_fechanacimiento#",$ini->format('d/m/Y'),$html);
        $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
        $dat = new Datocomprobatorio();
        $html=str_replace("#ese_sexo#",trim($dat->getSexo($estudio->ese_sexo)),$html);

        $dat=new Estadocivil();
        $html=str_replace("#esc_id#",trim($dat->getNombreEstadoCivil($estudio->esc_id)),$html);

        $direccion_completa_ese="";
        $direccion_completa_ese .= trim($estudio->ese_calle);
        $direccion_completa_ese .= (trim($direccion_completa_ese) != "" and  trim($estudio->ese_numext)!="") ? ", ".$estudio->ese_numext : $estudio->ese_numext;
        $direccion_completa_ese .= (trim($direccion_completa_ese) != "" and  trim($estudio->ese_numint)!="") ? ", ".$estudio->ese_numint : $estudio->ese_numint;
        $direccion_completa_ese .= (trim($direccion_completa_ese) != "" and  trim($estudio->ese_colonia)!="") ? ", ".$estudio->ese_colonia : $estudio->ese_colonia;

        // $html=str_replace("#ese_calle#",trim($estudio->ese_calle),$html);
        // $html=str_replace("#ese_numext#",trim($estudio->ese_numext),$html);
        // $html=str_replace("#ese_numint#",trim($estudio->ese_numint),$html);
        // $html=str_replace("#ese_colonia#",trim($estudio->ese_colonia),$html);
        $dat=new Municipio();
        $mun_nombre=$dat->getNombre($estudio->mun_id);
        // $html=str_replace("#mun_id#",trim($dat->getNombre($estudio->mun_id)),$html);
        $direccion_completa_ese .= (trim($direccion_completa_ese) != "" and  trim($mun_nombre)!="") ? ", ".$mun_nombre : $mun_nombre;
        $direccion_completa_ese .= (trim($direccion_completa_ese) != "" and  trim($estudio->ese_codpostal)!="") ? ", ".$estudio->ese_codpostal :$estudio->ese_codpostal;
        // $html=str_replace("#ese_codpostal#",trim($estudio->ese_codpostal),$html);
        // $html=str_replace("#est_id#",trim($dat->getNombre($estudio->est_id)),$html);
        $dat=new Estado();
        $est_nombre=$dat->getNombre($estudio->est_id);
        $direccion_completa_ese .= (trim($direccion_completa_ese) != "" and  trim($est_nombre)!="") ? ", ".$est_nombre : $est_nombre;
        $html=str_replace("#direccion_completa_ese#",trim($direccion_completa_ese),$html);
        $html=str_replace("#style_en_linea_direccion_completa_ese#",trim($reporte->calcularFontSizeComentarioNotaDinamico($direccion_completa_ese,10)),$html);

        
        $html=str_replace("#ese_celular#",trim($estudio->ese_celular),$html);
        $html=str_replace("#ese_telefono#",trim($estudio->ese_telefono),$html);
        $html=str_replace("#ese_familiarempresa#",$this->getSiNo($estudio->ese_familiarempresa),$html);

        return $html;
    }

    public function formatogabsips($estudio){
        $reporte= new PdfReporteGabineteSips();
        $html=$reporte->datospersonales;

        $ini= new DateTime($estudio->ese_fechanacimiento);
        $html=str_replace("#ese_lugarnacimiento#",trim($estudio->ese_lugarnacimiento),$html);
        $html=str_replace("#ese_fechanacimiento#",$ini->format('d/m/Y'),$html);
        $html=str_replace("#ese_edad#",trim($estudio->ese_edad),$html);
        $dat = new Datocomprobatorio();
        $html=str_replace("#ese_sexo#",trim($dat->getSexo($estudio->ese_sexo)),$html);

        $dat=new Estadocivil();
        $html=str_replace("#esc_id#",trim($dat->getNombreEstadoCivil($estudio->esc_id)),$html);

        $html=str_replace("#ese_calle#",trim($estudio->ese_calle),$html);
        $html=str_replace("#ese_numext#",trim($estudio->ese_numext),$html);
        $html=str_replace("#ese_numint#",trim($estudio->ese_numint),$html);

        $html=str_replace("#ese_colonia#",trim($estudio->ese_colonia),$html);
        $dat=new Municipio();
        $html=str_replace("#mun_id#",trim($dat->getNombre($estudio->mun_id)),$html);
        $html=str_replace("#ese_codpostal#",trim($estudio->ese_codpostal),$html);
        $dat=new Estado();
        $html=str_replace("#est_id#",trim($dat->getNombre($estudio->est_id)),$html);
        $html=str_replace("#ese_celular#",trim($estudio->ese_celular),$html);
        $html=str_replace("#ese_telefono#",trim($estudio->ese_telefono),$html);

        return $html;
    }



    //funcion para devolver la ubicacion de la casa
    public function get_ubicacion_en_mapa_mpdf($ubicacion_id){
       
        switch ($ubicacion_id){
            //acomodar en la primera fila
            case "1":
                    $cordenandas=' padding-top: -7px; padding-left: -5px;';
                    return $cordenandas;
                    break;
            case "2":
                    $cordenandas=' padding-top: -7px; padding-left: 20px;';
                    return $cordenandas;
                    break;

            case "3":
                    $cordenandas=' padding-top: -7px; padding-left: 50px;';
                    return $cordenandas;
                    break;

            case "4":
                    $cordenandas=' padding-top: -7px; padding-left: 75px;';
                    return $cordenandas;
                    break;

            case "5":
                    $cordenandas=' padding-top: -7px; padding-left: 115px;';

                    return $cordenandas;
                    break;
            //acomodar en la segunda fila

            case "6":
                    $cordenandas=' padding-top: 15px; padding-left: -5px;';
                    return $cordenandas;
                    break;

            case "7":
                    $cordenandas=' padding-top: 15px; padding-left: 20px;';
                    return $cordenandas;
                    break;


            case "8":
                    $cordenandas=' padding-top: 15px; padding-left: 50px;';
                    return $cordenandas;
                    break;

            case "9":
                    $cordenandas=' padding-top: 15px; padding-left: 75px;';
                    return $cordenandas;
                    break;

            case "10":
                    $cordenandas=' padding-top: 15px; padding-left: 110px;';
                    return $cordenandas;
                    break;


            //acomodar en la tercer fila
            case "11":
                $cordenandas=' padding-top: 35px; padding-left: -5px;';
                return $cordenandas;
                break;
            case "12":
                $cordenandas=' padding-top: 35px; padding-left: 20px;';
                return $cordenandas;
                break;
            case "13":
                $cordenandas=' padding-top: 35px; padding-left: 50px;';
                return $cordenandas;
                break;

            case "14":
                $cordenandas=' padding-top: 35px; padding-left: 75px;';
                return $cordenandas;
                break;
            case "15":
                $cordenandas=' padding-top: 35px; padding-left: 110px;';
                return $cordenandas;
                break;
            default:
            $cordenandas=' display:none;';
                 return $cordenandas;
              
        }
            

    }


    public function formatoEseTruper($estudio,$datosfinales_data){

        $reporte= new PdfReporteTruper();
        $html=$reporte->datospersonales_pagina_1;

        $ini= new DateTime($estudio->ese_fechanacimiento);
        $ese_fechavisita= new DateTime($estudio->ese_fechavisita);
        $ese_fechaentregacliente= new DateTime($estudio->ese_fechaentregacliente);
        $ese_solicitud= new DateTime($estudio->ese_registro);
        $formato_pdf=new FormatotruperPDF();

        $estado=new Estado();
        $municipio=new Municipio();
        $estadocivil=new Estadocivil();

        if(count($datosfinales_data)>0){
            $html=str_replace("#td_style-ese_calificacion#",trim($this->getCalificacionBackgroundTdTruper($datosfinales_data[0]->daf_calificacion)),$html);
            $html=str_replace("#ese_calificacion#",trim($this->getCalificacionTruper($datosfinales_data[0]->cal_id)),$html);

        }else{
            $html=str_replace("#td_style-ese_calificacion#",trim($this->getCalificacionBackgroundTdTruper(-1)),$html);
            $html=str_replace("#ese_calificacion#",trim($this->getCalificacionTruper(-1)),$html);
        }

        // $html=str_replace("#ubicacion_cordenadas#",$this->get_ubicacion_en_mapa_mpdf($estudio->ese_ubicacioncasa),$html);
        $html=str_replace("#ubicacion_cordenadas#",$this->get_ubicacion_en_mapa_mpdf($estudio->ese_ubicacioncasa),$html);

        if($estudio->ese_fechavisita!=null || $estudio->ese_fechavisita!=''){
            $html=str_replace("#ese_fechavisita#",$ese_fechavisita->format('d/m/Y'),$html);

        }else{
            $html=str_replace("#ese_fechavisita#",'',$html);
        }

        if($estudio->ese_fechaentregacliente!=null || $estudio->ese_fechaentregacliente!=''){
            $html=str_replace("#ese_fechaentregacliente#",$ese_fechaentregacliente->format('d/m/Y'),$html);

        }else{
            $html=str_replace("#ese_fechaentregacliente#",'',$html);
        }


        // $html=str_replace("#ese_fechaentregacliente#",$ese_fechaentregacliente->format('d/m/Y'),$html);
        $html=str_replace("#ese_solicitud#",$ese_solicitud->format('d/m/Y'),$html);





        


        $html=str_replace("#UBICACION_IMG#",trim(basename('images/icono_ubicacion.png')),$html);
        $html=str_replace("#estrella_norte#",trim(basename('images/estrella_norte.jpg')),$html);

        $html=str_replace("#ese_nombre#",trim($estudio->ese_nombre.' '.$estudio->ese_primerapellido.' '.$estudio->ese_segundoapellido),$html);
        
        $html=str_replace("#ese_fechanacmiento#",$ini->format('d/m/Y'),$html);

        
        $html=str_replace("#ese_edad#",trim( $this->getEdadFormatTexto($estudio->ese_fechanacimiento)),$html);
        $html=str_replace("#ese_estadocivil#",trim($estadocivil->getNombreEstadoCivil($estudio->esc_id)),$html);
        $html=str_replace("#ese_area#",trim($estudio->ese_area),$html);
        $html=str_replace("#ese_area-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_area), $html);


        $html=str_replace("#ese_puestpsolicitado#",trim($estudio->ese_puesto),$html);
        $html=str_replace("#ese_puestpsolicitado-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_puesto), $html);

        $html=str_replace("#ese_direccion#",trim($estudio->ese_calle),$html);
        $html=str_replace("#ese_direccion-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_calle), $html);

        $html=str_replace("#ese_numext#",trim($estudio->ese_numext),$html);
        $html=str_replace("#ese_numext-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_numext), $html);

        $html=str_replace("#ese_numint#",trim($estudio->ese_numint),$html);
        $html=str_replace("#ese_numint-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_numint), $html);

        $html=str_replace("#ese_colonia#",trim($estudio->ese_colonia),$html);
        $html=str_replace("#ese_colonia-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_colonia), $html);

        $html=str_replace("#ese_municipio#",trim($municipio->getNombre($estudio->mun_id)),$html);
        $html=str_replace("#ese_municipio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->mun_id), $html);

        $html=str_replace("#ese_estado#",trim($estado->getNombre($estudio->est_id)),$html);
        $html=str_replace("#ese_estado-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->est_id), $html);

        $html=str_replace("#ese_codpostal#",trim($estudio->ese_codpostal),$html);
        $html=str_replace("#ese_codpostal-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_codpostal), $html);

        $html=str_replace("#ese_pais#",trim('MÉXICO'),$html);

        $html=str_replace("#ese_telefono#",trim($estudio->ese_telefono),$html);
        $html=str_replace("#ese_telefono-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_telefono), $html);

        $html=str_replace("#ese_celular#",trim($estudio->ese_celular),$html);
        $html=str_replace("#ese_celular-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_celular), $html);

        $html=str_replace("#ese_telefonorecado#",trim($estudio->ese_telefonorecado),$html);
        $html=str_replace("#ese_telefonorecado-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_telefonorecado), $html);


        $html=str_replace("#ese_calleoeste#",trim($estudio->ese_calleoeste),$html);
        $html=str_replace("#ese_calleoeste-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_calleoeste), $html);

        $html=str_replace("#ese_entrecalles#",trim($estudio->ese_entrecalles),$html);
        $html=str_replace("#ese_entrecalles-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_entrecalles), $html);


        $html=str_replace("#ese_referenciaubicacion#",trim($estudio->ese_referenciaubicacion),$html);
        $html=str_replace("#ese_referenciaubicacion-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_referenciaubicacion), $html);


        $html=str_replace("#ese_callesur#",trim($estudio->ese_callesur),$html);
        $html=str_replace("#ese_callesur-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_callesur), $html);

        $html=str_replace("#ese_callenorte#",trim($estudio->ese_callenorte),$html);
        $html=str_replace("#ese_calleeste#",trim($estudio->ese_calleeste),$html);



        //foto del candidato inicio
        $foto_candidato=Archivo::query()
        ->where('ese_id='.$estudio->ese_id.' and arc_estatus=2 and cat_id=1')
        ->execute();

        

        if(count($foto_candidato)>0){

            $html=str_replace("#candidato_foto#",trim(basename('archivos/'.$foto_candidato[0]->arc_nombre)),$html);

        }else{
            // echo count($foto_candidato);
        // die();
            $html=str_replace("#candidato_foto_style#","display:none;",$html);

        }
        //foto del candidato fin
        return $html;

    }

    public function formatoEseTruperReferencias($estudio,$datosfinales_data){

        $reporte= new PdfReporteTruper();
        $html=$reporte->datospersonales_pagina_1_referencias;

        $ini= new DateTime($estudio->ese_fechanacimiento);
        $ese_fechavisita= new DateTime($estudio->ese_fechavisita);
        $ese_fechaentregacliente= new DateTime($estudio->ese_fechaentregacliente);
        $ese_solicitud= new DateTime($estudio->ese_registro);
        $formato_pdf=new FormatotruperPDF();

        $estado=new Estado();
        $municipio=new Municipio();
        $estadocivil=new Estadocivil();

        // if(count($datosfinales_data)>0){
        //     $html=str_replace("#td_style-ese_calificacion#",trim($this->getCalificacionBackgroundTdTruper($datosfinales_data[0]->daf_calificacion)),$html);
        //     $html=str_replace("#ese_calificacion#",trim($this->getCalificacionTruper($datosfinales_data[0]->daf_calificacion)),$html);
        // }else{
            $html=str_replace("#td_style-ese_calificacion#",trim($this->getCalificacionBackgroundTdTruper(2)),$html);
            $html=str_replace("#ese_calificacion#","AVANCE",$html);
        // }
        // $html=str_replace("#ubicacion_cordenadas#",$this->get_ubicacion_en_mapa_mpdf($estudio->ese_ubicacioncasa),$html);
        $html=str_replace("#ubicacion_cordenadas#",$this->get_ubicacion_en_mapa_mpdf($estudio->ese_ubicacioncasa),$html);

        if($estudio->ese_fechavisita!=null || $estudio->ese_fechavisita!=''){
            $html=str_replace("#ese_fechavisita#",$ese_fechavisita->format('d/m/Y'),$html);

        }else{
            $html=str_replace("#ese_fechavisita#",'',$html);
        }
        
        if($estudio->ese_fechaentregacliente!=null || $estudio->ese_fechaentregacliente!=''){
            $html=str_replace("#ese_fechaentregacliente#",$ese_fechaentregacliente->format('d/m/Y'),$html);

        }else{
            $html=str_replace("#ese_fechaentregacliente#",'',$html);
        }
        // $html=str_replace("#ese_fechaentregacliente#",$ese_fechaentregacliente->format('d/m/Y'),$html);
        $html=str_replace("#ese_solicitud#",$ese_solicitud->format('d/m/Y'),$html);

        $html=str_replace("#UBICACION_IMG#",trim(basename('images/icono_ubicacion.png')),$html);
        $html=str_replace("#estrella_norte#",trim(basename('images/estrella_norte.jpg')),$html);

        $html=str_replace("#ese_nombre#",trim($estudio->ese_nombre.' '.$estudio->ese_primerapellido.' '.$estudio->ese_segundoapellido),$html);
        
        $html=str_replace("#ese_fechanacmiento#",$ini->format('d/m/Y'),$html);

        $html=str_replace("#ese_edad#",trim( $this->getEdadFormatTexto($estudio->ese_fechanacimiento)),$html);
        $html=str_replace("#ese_estadocivil#",trim($estadocivil->getNombreEstadoCivil($estudio->esc_id)),$html);
        $html=str_replace("#ese_area#",trim($estudio->ese_area),$html);
        $html=str_replace("#ese_area-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_area), $html);

        $html=str_replace("#ese_puestpsolicitado#",trim($estudio->ese_puesto),$html);
        $html=str_replace("#ese_puestpsolicitado-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_puesto), $html);

        $html=str_replace("#ese_direccion#",trim($estudio->ese_calle),$html);
        $html=str_replace("#ese_direccion-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_calle), $html);

        $html=str_replace("#ese_numext#",trim($estudio->ese_numext),$html);
        $html=str_replace("#ese_numext-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_numext), $html);

        $html=str_replace("#ese_numint#",trim($estudio->ese_numint),$html);
        $html=str_replace("#ese_numint-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_numint), $html);

        $html=str_replace("#ese_colonia#",trim($estudio->ese_colonia),$html);
        $html=str_replace("#ese_colonia-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_colonia), $html);

        $html=str_replace("#ese_municipio#",trim($municipio->getNombre($estudio->mun_id)),$html);
        $html=str_replace("#ese_municipio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->mun_id), $html);

        $html=str_replace("#ese_estado#",trim($estado->getNombre($estudio->est_id)),$html);
        $html=str_replace("#ese_estado-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->est_id), $html);

        $html=str_replace("#ese_codpostal#",trim($estudio->ese_codpostal),$html);
        $html=str_replace("#ese_codpostal-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_codpostal), $html);

        $html=str_replace("#ese_pais#",trim('MÉXICO'),$html);

        $html=str_replace("#ese_telefono#",trim($estudio->ese_telefono),$html);
        $html=str_replace("#ese_telefono-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_telefono), $html);

        $html=str_replace("#ese_celular#",trim($estudio->ese_celular),$html);
        $html=str_replace("#ese_celular-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_celular), $html);

        $html=str_replace("#ese_telefonorecado#",trim($estudio->ese_telefonorecado),$html);
        $html=str_replace("#ese_telefonorecado-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_telefonorecado), $html);

        $html=str_replace("#ese_entrecalles#",trim($estudio->ese_entrecalles),$html);
        $html=str_replace("#ese_entrecalles-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_entrecalles), $html);

        $html=str_replace("#ese_referenciaubicacion#",trim($estudio->ese_referenciaubicacion),$html);
        $html=str_replace("#ese_referenciaubicacion-style_bg#",$formato_pdf->verificar_si_es_vacio_td($estudio->ese_referenciaubicacion), $html);
        return $html;
    }

}
