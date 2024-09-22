<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla dato vivienda
 */
class Datovivienda extends Model
{

    public  $antiguedad_select_values=[
         1=>'0 - 1  AÑO',
         2=>'1 - 3  AÑOS	',
         3=>'3 - 5  AÑOS',
         4=>'5 - MÁS',

    ];

    public  $zona_select_values=[
         1=>'CÉNTRICA',
         2=>'CITADINA',
         3=>'PERIFÉRICA',
         4=>'RURAL',
         5=>'SUBURBANA',
         6=>'URBANA',
    ];

    public  $clase_social_select_values=[
         1=>'ALTA',
         2=>'MEDIA ALTA',
         3=>'MEDIA',
         4=>'MEDIA BAJA',
         5=>'BAJA',
    ];


    public  $vivienda_select_values=[
         1=>'PROPIA',
         2=>'FAMILIAR',
         3=>'RENTADA',
         4=>'PRESTADA(FAMILIAR)',
         5=>'PRESTADA(AMIGO)',
    ];

    public  $inmueble_select_values=[
         1=>'CASA SOLA',
         2=>'DEPARTAMENTO',
         3=>'CONDOMINIO',
         4=>'DÚPLEX',
    ];

    public  $formatovivienda_select_values=[
         1=>'RESIDENCIAL',
         2=>'INTERÉS SOCIAL',    
    ];

    public  $niveles_select_values=[
         1=>'PLANTA BAJA',
         2=>'DOS PISOS',
         3=>'TRES PISOS',
         4=>'CUATRO PISOS',
    ];

    public  $apariencia_select_values=[
         1=>'ORDENADO / LIMPIO',
         2=>'DESORDENADO / LIMPIO',
         3=>'DESORDENADO / SUCIO',
         4=>'DESCUIDADO / SUCIO',
    ];

    public  $estadomobiliario_select_values=[
         1=>'EXCELENTE',
         2=>'BUENO',
         3=>'REGULAR',
         4=>'MALO',

    ];

    public function getestadomobiliario($id){

               if (array_key_exists($id, $this->estadomobiliario_select_values)) {
                     return $this->estadomobiliario_select_values[$id];
               }else{
                    return '';
               }

    }

    public function getValorSelectNumericos($valor){

     if($valor==-1||$valor==null){

          return '';
     }
     else{
          return $valor;
     }

    } 
    

    public function getApariencia($id){

          if (array_key_exists($id, $this->apariencia_select_values)) {
               return $this->apariencia_select_values[$id];
          }else{
               return '';
          }

     }

     public function getNiveles($id){

          if (array_key_exists($id, $this->niveles_select_values)) {
               return $this->niveles_select_values[$id];
          }else{
               return '';
          }

     }

     public function getFormatoVivienda($id){

          if (array_key_exists($id, $this->formatovivienda_select_values)) {
               return $this->formatovivienda_select_values[$id];
          }else{
               return '';
          }

     }
     public function getInmueble($id){

          if (array_key_exists($id, $this->inmueble_select_values)) {
               return $this->inmueble_select_values[$id];
          }else{
               return '';
          }

     }


     public function getVivienda($id){

          if (array_key_exists($id, $this->vivienda_select_values)) {
               return $this->vivienda_select_values[$id];
          }else{
               return '';
          }

     }

     public function getClaseSocial($id){

          if (array_key_exists($id, $this->clase_social_select_values)) {
               return $this->clase_social_select_values[$id];
          }else{
               return '';
          }

     }

     public function getNumero($value){
          if($value>=0)
          return $value;
          else
          return '';

     }

     

     public function getZona($id){

          if (array_key_exists($id, $this->zona_select_values)) {
               return $this->zona_select_values[$id];
          }else{
               return '';
          }

     }

     

     
     public function getAntiguedad($id){

          if (array_key_exists($id, $this->antiguedad_select_values)) {
               return $this->antiguedad_select_values[$id];
          }else{
               return '';
          }

     }

     public function getNombreServicioGas($id){
          switch ($id) {
               case '1':
                   return 'ESTACIONARIO';
                    break;
               case '2':
                    return 'NATURAL';
                    break;

               case '3':
                    return 'CILINDRO';
                         break;
               default:
                     return '';
                    break;
          }

     }




    public function registro_automatico($ese_id=0){

        $registro_automatico= new Datovivienda();
        $registro_automatico->ese_id=$ese_id;
        $registro_automatico->dav_estatus=2;


        if($registro_automatico->save()){
            return ['estado'=>2,'dav_id'=>$registro_automatico->dav_id,'ese_id'=>$ese_id];

        }else{
            return ['estado'=>-2];

        }
    }

    public function getSioNo($id){

          switch ($id) {
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

    

    public function NuevoRegistro($data,$permiso_calificacion){


    }

    public function getCheckSi($valor,$html,$id_img,$id_imagen_style,$id_td){
          $style_td_si='margin: 0 auto; text-align:center; background-color:white;';
          $style_td_no='background-color:#D9D9D9;';

          $img_url=basename('/images/checkmark.png');

          switch ($valor) {
          case 1:
          
               //cambiamos el color del fono la td 
               $html=  str_replace($id_td,$style_td_si,$html);
               //cambiamos la url y colocamos la imagen
               $html=  str_replace($id_img,$img_url,$html);
               return $html;
     
               break;

     
          default:
               //en caso de que no,ocultamos la imagen
               $html=  str_replace($id_imagen_style,'display:none;',$html);
               $html=  str_replace($id_td,$style_td_no,$html);
               
          return $html;

          break;

          }
     }
   
     //version 2
     public function getCheckSiOcultarMostrar($valor,$id_display_img,$id_td_style,$html){

          if($valor!=1){
               
               $html=  str_replace($id_td_style,"background-color:#D9D9D9;",$html);
               // $html=  str_replace($id_display_img,"display:none;",$html);
               $html=  str_replace($id_display_img,'',$html);
          }
          else{
               $html=  str_replace($id_display_img,'<img src="images/checkmark.png"  style="max-height:18px; margin: 0  0 0 20px; text-align:left; ">',$html);
               
          }

          return $html;

     }



    public function ActualizarRegistro($data,$permiso_calificacion){
     
     $this->dav_antiguedad=$data['dav_antiguedad'];
     $this->dav_zona=$data['dav_zona'];
     $this->dav_clasesocial=$data['dav_clasesocial'];
     $this->dav_vivienda=$data['dav_vivienda'];
     $this->dav_inmueble=$data['dav_inmueble'];
     $this->dav_formatovivienda=$data['dav_formatovivienda'];
     $this->dav_nivel=$data['dav_nivel'];
     $this->dav_apariencia=$data['dav_apariencia'];
     $this->dav_estadomobiliario=$data['dav_estadomobiliario'];
     $this->dav_recamara=$data['dav_recamara'];
     $this->dav_banio=$data['dav_banio'];
     if (isset($data['dav_sala'])) {
          $this->dav_sala=$data['dav_sala'];
     }else{
          $this->dav_sala=-1;

     }
     $this->dav_cocina=$data['dav_cocina'];
     $this->dav_estudio=$data['dav_estudio'];
     $this->dav_comedor=$data['dav_comedor'];
     $this->dav_salajuego=$data['dav_salajuego'];
     $this->dav_terraza=$data['dav_terraza'];
     $this->dav_cualavado=$data['dav_cualavado'];
     $this->dav_laptop=$data['dav_laptop'];
     $this->dav_camara=$data['dav_camara'];

     
     $this->dav_cuaservicio=$data['dav_cuaservicio'];
     $this->dav_garage=$data['dav_garage'];
     $this->dav_jardin=$data['dav_jardin'];
     $this->dav_piscina=$data['dav_piscina'];
     $this->dav_nombrepropietario=trim($data['dav_nombrepropietario']);
     $this->dav_telpropietario=$data['dav_telpropietario'];
     $this->dav_agua=$data['dav_agua'];
     $this->dav_drenaje=$data['dav_drenaje'];
     $this->dav_luz=$data['dav_luz'];



     $this->dav_telefono=$data['dav_telefono'];
     $this->dav_alumbrado=$data['dav_alumbrado'];
     $this->dav_pavimento=$data['dav_pavimento'];
     $this->dav_tvcable=$data['dav_tvcable'];
     $this->dav_internet=$data['dav_internet'];
     $this->dav_hospital=$data['dav_hospital'];
     $this->dav_parque=$data['dav_parque'];
     $this->dav_deportivo=$data['dav_deportivo'];


     $this->dav_club=$data['dav_club'];
     $this->dav_casacultura=$data['dav_casacultura'];
     $this->dav_transportepub=$data['dav_transportepub'];
     $this->dav_servgas=$data['dav_servgas'];
     $this->dav_centrocomercial=$data['dav_centrocomercial'];
     $this->dav_fibraoptica=$data['dav_fibraoptica'];
     $this->dav_television=$data['dav_television'];
     $this->dav_pantalla=$data['dav_pantalla'];


     $this->dav_teatrocasa=$data['dav_teatrocasa'];
     $this->dav_dvd=$data['dav_dvd'];
     $this->dav_blueray=$data['dav_blueray'];
     $this->dav_estereo=$data['dav_estereo'];
     $this->dav_pc=$data['dav_pc'];
     $this->dav_tablet=$data['dav_tablet'];
     $this->dav_smartphone=$data['dav_smartphone'];
     $this->dav_videocamara=$data['dav_videocamara'];
     $this->dav_cocinaintegral=$data['dav_cocinaintegral'];


     $this->dav_estufa=$data['dav_estufa'];
     $this->dav_horno=$data['dav_horno'];
     $this->dav_microondas=$data['dav_microondas'];
     $this->dav_licuadora=$data['dav_licuadora'];
     $this->dav_plancha=$data['dav_plancha'];
     $this->dav_lavadora=$data['dav_lavadora'];
     $this->dav_refrigerador=$data['dav_refrigerador'];
     $this->dav_lavatraste=$data['dav_lavatraste'];
     $this->dav_hidrolavadora=$data['dav_hidrolavadora'];


     $this->dav_lampara=$data['dav_lampara'];
     $this->dav_cuadro=$data['dav_cuadro'];
     // $this->dav_estatus=$data['dav_estatus'];
     $this->dav_comentario=$data['dav_comentario'];
     $this->ese_id=$data['ese_id'];


     
     if($this->update()){
          return ['estado'=>2,'dav_id'=>$this->dav_id,'ese_id'=>$this->ese_id,'mensaje_bitacora'=>'Actualizo datos de vivienda del estudio número '.$this->ese_id];

      }else{
          return ['estado'=>-2];

      }
     
     

    }


    public function formatoEseTruper($datovivienda,$ese_id){

     $reporte= new PdfReporteTruper();
     $html=$reporte->domiciliocandidato_data_pagina_2;

     $formato_pdf=new FormatotruperPDF();

     $html=str_replace("#dav_comentario#",trim($datovivienda->dav_comentario),$html);

     $html=str_replace("#dav_comentario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($datovivienda->dav_comentario), $html);

     $html=str_replace("#dav_antiguedad#",trim($this->getAntiguedad($datovivienda->dav_antiguedad)),$html);
     $html=str_replace("#dav_antiguedad-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_antiguedad), $html);

     $html=str_replace("#dav_zona#",trim($this->getZona($datovivienda->dav_zona)),$html);
     $html=str_replace("#dav_zona-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_zona), $html);


     $html=str_replace("#dav_clasesocial#",trim($this->getClaseSocial($datovivienda->dav_clasesocial)),$html);
     $html=str_replace("#dav_clasesocial-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_clasesocial), $html);


     $html=str_replace("#dav_vivienda#",trim($this->getVivienda($datovivienda->dav_vivienda)),$html);
     $html=str_replace("#dav_vivienda-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_vivienda), $html);


     $html=str_replace("#dav_nivel#",trim($this->getNiveles($datovivienda->dav_nivel)),$html);
     $html=str_replace("#dav_nivel-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_nivel), $html);

     $html=str_replace("#dav_apariencia#",trim($this->getApariencia($datovivienda->dav_apariencia)),$html);
     $html=str_replace("#dav_apariencia-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_apariencia), $html);

     $html=str_replace("#dav_recamara#",trim($datovivienda->dav_recamara),$html);
     $html=str_replace("#dav_recamara-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_recamara), $html);


     $html=str_replace("#dav_banio#",trim($datovivienda->dav_banio),$html);
     $html=str_replace("#dav_banio-style_bg#",$formato_pdf->verificar_si_es_vacio_td($datovivienda->dav_banio), $html);

     // $html=str_replace("#dav_sala#",trim($this->getSioNo($datovivienda->dav_sala)),$html);
     $html=str_replace("#dav_sala-style_bg#",$formato_pdf->verificar_si_es_vacio_td($datovivienda->dav_sala), $html);


     $html=str_replace("#dav_inmueble#",trim($this->getInmueble($datovivienda->dav_inmueble)),$html);
     $html=str_replace("#dav_inmueble-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_inmueble), $html);


     $html=str_replace("#dav_formatovivienda#",trim($this->getFormatoVivienda($datovivienda->dav_formatovivienda)),$html);
     $html=str_replace("#dav_formatovivienda-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_formatovivienda), $html);


     $html=str_replace("#dav_estadomobiliario#",trim($this->getestadomobiliario($datovivienda->dav_estadomobiliario)),$html);
     $html=str_replace("#dav_estadomobiliario-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_estadomobiliario), $html);


     // $html=str_replace("#dav_cocina#",trim($this->getSioNo($datovivienda->dav_cocina)),$html);
     $html=str_replace("#dav_cocina-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_cocina), $html);


     // $html=str_replace("#dav_comedor#",trim($this->getSioNo($datovivienda->dav_comedor)),$html);
     $html=str_replace("#dav_comedor-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_comedor), $html);


     // $html=str_replace("#dav_estudio#",trim($this->getSioNo($datovivienda->dav_estudio)),$html);
     $html=str_replace("#dav_estudio-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_estudio), $html);


     // $html=str_replace("#dav_salajuego#",trim($this->getSioNo($datovivienda->dav_salajuego)),$html);
     $html=str_replace("#dav_salajuego-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_salajuego), $html);


     // $html=str_replace("#dav_terraza#",trim($this->getSioNo($datovivienda->dav_terraza)),$html);
     $html=str_replace("#dav_terraza-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_terraza), $html);

     // $html=str_replace("#dav_cualavado#",trim($this->getSioNo($datovivienda->dav_cualavado)),$html);
     $html=str_replace("#dav_cualavado-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_cualavado), $html);

     // $html=str_replace("#dav_cuaservicio#",trim($this->getSioNo($datovivienda->dav_cuaservicio)),$html);
     $html=str_replace("#dav_cuaservicio-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_cuaservicio), $html);


     // $html=str_replace("#dav_garage#",trim($this->getSioNo($datovivienda->dav_garage)),$html);
     $html=str_replace("#dav_garage-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_garage), $html);

     // $html=str_replace("#dav_jardin#",trim($this->getSioNo($datovivienda->dav_jardin)),$html);
     $html=str_replace("#dav_jardin-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_jardin), $html);

     // $html=str_replace("#dav_cuaservicio#",trim($this->getSioNo($datovivienda->dav_cuaservicio)),$html);
     $html=str_replace("#dav_cuaservicio-style_bg#",$formato_pdf->verificar_si_es_vacio_select($datovivienda->dav_cuaservicio), $html);


     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_sala,"#dav_sala-display#","#dav_sala-bg#",$html);



     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_cocina,"#dav_cocina-display#","#dav_cocina-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_comedor,"#dav_comedor-display#","#dav_comedor-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_estudio,"#dav_estudio-display#","#dav_estudio-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_comedor,"#dav_comedor-display#","#dav_comedor-bg#",$html);


     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_terraza,"#dav_terraza-display#","#dav_terraza-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_cualavado,"#dav_cualavado-display#","#dav_cualavado-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_salajuego,"#dav_salajuego-display#","#dav_salajuego-bg#",$html);

     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_cuaservicio,"#dav_cuaservicio-display#","#dav_cuaservicio-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_garage,"#dav_garage-display#","#dav_garage-bg#",$html);
     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_jardin,"#dav_jardin-display#","#dav_jardin-bg#",$html);


     $html=$this->getCheckSiOcultarMostrar($datovivienda->dav_piscina,"#dav_piscina-display#","#dav_piscina-bg#",$html);


     $html=str_replace("#dav_nombrepropietario#",trim($datovivienda->dav_nombrepropietario),$html);
     $html=str_replace("#dav_nombrepropietario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($datovivienda->dav_nombrepropietario), $html);

     $html=str_replace("#dav_telefonopropietario#",trim($datovivienda->dav_telpropietario),$html);
     $html=str_replace("#dav_telefonopropietario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($datovivienda->dav_telpropietario), $html);
     
     
     // $html=str_replace("#dav_piscina#",trim($this->getSioNo($datovivienda->dav_piscina)),$html);

     // $html=$this->getCheckSi($datovivienda->dav_cuaservicio,$html,$id_img='#dav_cuaservicio-url#',$id_imagen_style='#dav_cuaservicio-img_style#',$id_td='#dav_cuaservicio-style_td#');


     // $html=str_replace("#dav_piscina#",trim($this->getSioNo($datovivienda->dav_piscina)),$html);
     // $html=str_replace("#dav_nombrepropietario#",trim($datovivienda->dav_nombrepropietario),$html);

     // $html=str_replace("#dav_telpropietario#",trim($datovivienda->dav_telpropietario),$html);



   

     return $html;

    }
  


}