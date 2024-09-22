<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla dato vivienda
 */
class Datoviviendanterdetalles extends Model
{

     public function NuevoRegistro($data){

          $registro= new Datoviviendanterdetalles();
          $registro->dva_nombrepropietario=trim($data['dva_nombrepropietario']);

          $registro->dva_banio=$data['dva_banio'];
          $registro->dva_calle=$data['dva_calle'];
          $registro->dva_cocina=$data['dva_cocina'];
          $registro->dva_codpostal=$data['dva_codpostal'];
          $registro->dva_colonia=$data['dva_colonia'];
          $registro->dva_comedor=$data['dva_comedor'];
          $registro->dva_cualavado=$data['dva_cualavado'];
          $registro->dva_cuaservicio=$data['dva_cuaservicio'];
          $registro->dva_estudio=$data['dva_estudio'];
          $registro->dva_garage=$data['dva_garage'];
    
          $registro->dva_montorentaovalor=$data['dva_montorentaovalor'];
          $registro->dva_motivocamb=$data['dva_motivocamb'];
          $registro->dva_numint=$data['dva_numint'];
          $registro->dva_numlext=$data['dva_numlext'];
          $registro->dva_piscina=$data['dva_piscina'];
          $registro->dva_recamara=$data['dva_recamara'];
          $registro->dva_sala=$data['dva_sala'];
          $registro->dva_salajuego=$data['dva_salajuego'];
          $registro->dva_terraza=$data['dva_terraza'];
          $registro->est_id=($data['est_id']=='-1'|| $data['est_id']==null ? null :$data['est_id']);
          $registro->mun_id=($data['mun_id']=='-1'|| $data['mun_id']==null ? null :$data['mun_id']);

          $registro->dva_antiguedad=$data['dva_antiguedad'];
          $registro->dva_zona=$data['dva_zona'];
          $registro->dva_clasesocial=$data['dva_clasesocial'];
          $registro->dva_vivienda=$data['dva_vivienda'];
          $registro->dva_inmueble=$data['dva_inmueble'];
          $registro->dva_formatovivienda=$data['dva_formatovivienda'];
          $registro->dva_piscina=$data['dva_piscina'];
          $registro->dva_jardin=$data['dva_jardin'];
          
        //   $registro->dva_servicio=$data['dva_servicio'];
          $registro->dva_nivel=$data['dva_nivel'];



          $registro->dva_formatovivienda=$data['dva_formatovivienda'];

          $registro->dav_id=$data['dav_id'];
          $registro->dva_estatus=2;

            if($registro->save()){

                
                return  $repuesta=['estado'=>2,'dav_id'=> $registro->dav_id,'dva_id'=> $registro->dva_id];
            }       
            else
            {
                return  $repuesta=['estado'=>-2];
            }

         
    
     }

        /**
     * Devuelve html ya trabajado en el que valida si hay un check o no
     *
     * *
     *
     * @access public
     * @param string $valor=este proviene de la bd,$html =es el que se analiza,$id_img
     * @return HTML
     */
     public function getCheckSi($valor,$html,$id_img1){

        $id_img="#".$id_img1."#";
        // $id_imagen_style="#".$id_img."-img_style#"; //este es el que eliminaré
        $id_td="#".$id_img1."-style_td#";

        $style_td_si='margin: 0 auto; text-align:center; background-color:white;';
        $style_td_no='background-color:#D9D9D9;';

        $img_url=basename('/images/checkmark.png');

        switch ($valor) {
            case 1:
                $html=  str_replace($id_img,'<img src="images/checkmark.png" style="max-height:20px; margin: 0 auto;">',$html);
                //cambiamos el color del fono la td 
                $html=  str_replace($id_td,$style_td_si,$html);
                //cambiamos la url y colocamos la imagen
                // $html=  str_replace($id_img,$img_url,$html);
                return $html;
    
              break;

      
        default:
                //en caso de que no,ocultamos la imagen
                $html=  str_replace($id_img,'<img src="images/checkmark.png" style="max-height:20px; margin: 0 auto; display:none;">',$html);
                // $html=  str_replace($id_imagen_style,'display:none;',$html);
                $html=  str_replace($id_td,$style_td_no,$html);
                
           return $html;

           break;

         }
    }
    

     public function ActualizarRegistro($data){

          $this->dva_nombrepropietario=trim($data['dva_nombrepropietario']);
          $this->dva_calle=$data['dgd_parentesco_crear'];
          $this->dva_numint=$data['dgd_edad_crear'];
          $this->dva_numlext=$data['dgd_esc_id_crear'];
          $this->dva_colonia=  $data['dgd_niv_id_crear'] ;
          $this->dva_codpostal=$data['dgd_nombre_crear'];
          $this->est_id=$data['dgd_parentesco_crear'];
          $this->mun_ip=$data['dgd_edad_crear'];
          $this->dva_zona=$data['dgd_esc_id_crear'];
          $this->dva_antiguedad=  $data['dgd_niv_id_crear'] ;
          $this->dva_clasesocial=$data['dgd_nombre_crear'];
          $this->dva_vivienda=$data['dgd_parentesco_crear'];
          $this->dva_inmueble=$data['dgd_edad_crear'];
          $this->dva_formatovivienda=$data['dgd_esc_id_crear'];
          $this->dva_nivel=  $data['dgd_niv_id_crear'] ;
          $this->dva_montorentaovalor=$data['dgd_esc_id_crear'];
          $this->dva_recamara=  $data['dgd_niv_id_crear'] ;
          $this->dva_banio=$data['dgd_esc_id_crear'];
          $this->dva_sala=  $data['dgd_niv_id_crear'] ;
          $this->dva_cocina=  $data['dgd_niv_id_crear'];
          $this->dva_comedor=$data['dgd_dgf_id'];
          $this->dva_estudio=$data['dva_estudio'];
          $this->dva_salajuego=$data['dva_salajuego'];
          $this->dva_terraza=$data['dva_terraza'];
          $this->dva_cualavado=  $data['dva_cualavado'];
          $this->dva_cuaservicio=$data['dva_cuaservicio'];
          $this->dva_servicio=$data['dva_servicio'];
          $this->dva_garage=  $data['dva_garage'] ;
          $this->dva_jardin=  $data['dva_jardin'];
          $this->dva_piscina=$data['dva_piscina'];
          $this->dva_motivocamb=$data['dva_motivocamb'];
          $this->dva_registro=  $data['dva_registro'] ;
          $this->dva_estatus=  $data['dva_estatus'];
          $this->dav_id=$data['dav_id'];
          $this->dva_estatus=2;
  
          if($this->update()){
              return  $repuesta=['estado'=>2,'dav_id'=> $this->dav_id,'dva_id'=> $this->dva_id];
          }       
          else
          {
              return  $repuesta=['estado'=>-2];
          }
     
     }


     
     public function ActualizarRegistroFormatoTruper($data){
        

        $this->dva_nombrepropietario=trim($data['dva_nombrepropietario']);

        $this->dva_banio=$data['dva_banio'];
        $this->dva_calle=$data['dva_calle'];
        $this->dva_cocina=$data['dva_cocina'];
        $this->dva_codpostal=$data['dva_codpostal'];
        $this->dva_colonia=$data['dva_colonia'];
        $this->dva_comedor=$data['dva_comedor'];
        $this->dva_cualavado=$data['dva_cualavado'];
        $this->dva_cuaservicio=$data['dva_cuaservicio'];
        $this->dva_estudio=$data['dva_estudio'];
        $this->dva_garage=$data['dva_garage'];
  
        $this->dva_montorentaovalor=$data['dva_montorentaovalor'];
        $this->dva_motivocamb=$data['dva_motivocamb'];
        $this->dva_numint=$data['dva_numint'];
        $this->dva_numlext=$data['dva_numlext'];
        $this->dva_piscina=$data['dva_piscina'];
        $this->dva_recamara=$data['dva_recamara'];
        $this->dva_sala=$data['dva_sala'];
        $this->dva_salajuego=$data['dva_salajuego'];
        $this->dva_terraza=$data['dva_terraza'];
        $this->est_id=($data['est_id']=='-1'|| $data['est_id']==null ? null :$data['est_id']);
        $this->mun_id=($data['mun_id']=='-1'|| $data['mun_id']==null ? null :$data['mun_id']);

        $this->dva_antiguedad=$data['dva_antiguedad'];
        $this->dva_zona=$data['dva_zona'];
        $this->dva_clasesocial=$data['dva_clasesocial'];
        $this->dva_vivienda=$data['dva_vivienda'];
        $this->dva_inmueble=$data['dva_inmueble'];
        $this->dva_formatovivienda=$data['dva_formatovivienda'];
        $this->dva_piscina=$data['dva_piscina'];
        $this->dva_jardin=$data['dva_jardin'];
        
      //   $this->dva_servicio=$data['dva_servicio'];
        $this->dva_nivel=$data['dva_nivel'];



        $this->dva_formatovivienda=$data['dva_formatovivienda'];


          if($this->update()){

              
              return  $repuesta=['estado'=>2,'dav_id'=> $this->dav_id,'dva_id'=> $this->dva_id];
          }       
          else
          {
              return  $repuesta=['estado'=>-2];
          }

        if($this->update()){
            return  $repuesta=['estado'=>2,'dav_id'=> $this->dav_id,'dva_id'=> $this->dva_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
   
   }


     public function getDireccionFormatoCompleto($data){

        $obj_mun = new Municipio();
        $obj_est = new Estado();
        $mun_nombre=$obj_mun->getNombre($data->mun_id);
        $est_nombre = $obj_est->getNombre($data->est_id);

        $dva_numint = ( $data->dva_numint!=null || $data->dva_numint!="") ? "Num. int. $data->dva_numint" : '';
        $dva_numlext = ( $data->dva_numlext!=null || $data->dva_numlext!="") ? "Num. ext. $data->dva_numint" : '';
        $dva_colonia = ( $data->dva_colonia!=null || $data->dva_colonia!="") ? "Colonia  $data->dva_colonia" : '';
        $dva_codpostal = ( $data->dva_codpostal!=null || $data->dva_codpostal!="") ? "CP  $data->dva_codpostal" : '';
        $mun = ( $data->mun_id!=null || $data->mun_id!="") ? "Municipio $mun_nombre" : '';


        $est= ( $data->est_id!=null || $data->est_id!="") ? "Estado $est_nombre " : '';

        

        return $dva_numint . " " . $dva_numlext . " " . $dva_colonia . " " . $dva_codpostal. " " . $mun. " " . $est;
     }

     public function formatoEseTruper($data_datovivienda,$ese_id){
        $reporte= new PdfReporteTruper();
        $html=$reporte->datoviviendaanterior_pagina_3;
        $formato_pdf=new FormatotruperPDF();

        $datovivienda=new Datovivienda();



        $DatoviviendanterdetallesDetalles=new Builder();
        $DatoviviendanterdetallesDetalles=$DatoviviendanterdetallesDetalles
        ->addFrom('Datoviviendanterdetalles','dva')
        ->where('dav_id='.$data_datovivienda->dav_id.' and dva_estatus=2')
        ->getQuery()
        ->execute();

 
        // getCheckSi($valor,$html,$id_img,$id_imagen_style,$id_td)


        ///check de palomita
        $html=$this->getCheckSi($data_datovivienda->dav_agua,$html,'dav_agua');
        $html=$this->getCheckSi($data_datovivienda->dav_drenaje,$html,'dav_drenaje');
        $html=$this->getCheckSi($data_datovivienda->dav_luz,$html,'dav_luz');
        $html=$this->getCheckSi($data_datovivienda->dav_telefono,$html,'dav_telefono');
        // $html=$this->getCheckSi($data_datovivienda->dav_telefono,$html,$id_img='#dav_telefono-url#',$id_imagen_style='#dav_telefono-img_style#',$id_td='#dav_telefono-style_td#');
        // $html=$this->getCheckSi($data_datovivienda->dav_telefono,$html,$id_img='#dav_telefono-url#',$id_imagen_style='#dav_telefono-img_style#',$id_td='#dav_telefono-style_td#');
        $html=$this->getCheckSi($data_datovivienda->dav_alumbrado,$html,'dav_alumbrado');
        $html=$this->getCheckSi($data_datovivienda->dav_pavimento,$html,'dav_pavimento');
        $html=$this->getCheckSi($data_datovivienda->dav_tvcable,$html,'dav_tvcable');
        $html=$this->getCheckSi($data_datovivienda->dav_internet,$html,'dav_internet');
        $html=$this->getCheckSi($data_datovivienda->dav_hospital,$html,'dav_hospital');
        $html=$this->getCheckSi($data_datovivienda->dav_parque,$html,'dav_parque');
        $html=$this->getCheckSi($data_datovivienda->dav_deportivo,$html,'dav_deportivo');
        $html=$this->getCheckSi($data_datovivienda->dav_club,$html,'dav_club');
        $html=$this->getCheckSi($data_datovivienda->dav_casacultura,$html,'dav_casacultura');
        $html=$this->getCheckSi($data_datovivienda->dav_centrocomercial,$html,'dav_centrocomercial');
        $html=$this->getCheckSi($data_datovivienda->dav_fibraoptica,$html,'dav_fibraoptica');
        $html=$this->getCheckSi($data_datovivienda->dav_television,$html,'dav_television');
        $html=$this->getCheckSi($data_datovivienda->dav_pantalla,$html,'dav_pantalla');
        $html=$this->getCheckSi($data_datovivienda->dav_dvd,$html,'dav_dvd');
        $html=$this->getCheckSi($data_datovivienda->dav_blueray,$html,'dav_blueray');
        $html=$this->getCheckSi($data_datovivienda->dav_estereo,$html,'dav_estereo');
        $html=$this->getCheckSi($data_datovivienda->dav_pc,$html,'dav_pc');
        $html=$this->getCheckSi($data_datovivienda->dav_laptop,$html,'dav_laptop');
        $html=$this->getCheckSi($data_datovivienda->dav_tablet,$html,'dav_tablet');
        $html=$this->getCheckSi($data_datovivienda->dav_smartphone,$html,'dav_smartphone');
        $html=$this->getCheckSi($data_datovivienda->dav_videocamara,$html,'dav_videocamara');
        $html=$this->getCheckSi($data_datovivienda->dav_laptop,$html,'dav_camara');
        $html=$this->getCheckSi($data_datovivienda->dav_cocinaintegral,$html,'dav_cocinaintegral');
        $html=$this->getCheckSi($data_datovivienda->dav_estufa,$html,'dav_estufa');
        $html=$this->getCheckSi($data_datovivienda->dav_horno,$html,'dav_horno');
        $html=$this->getCheckSi($data_datovivienda->dav_microondas,$html,'dav_microondas');
        $html=$this->getCheckSi($data_datovivienda->dav_licuadora,$html,'dav_licuadora');
        $html=$this->getCheckSi($data_datovivienda->dav_plancha,$html,'dav_plancha');
        $html=$this->getCheckSi($data_datovivienda->dav_lavadora,$html,'dav_lavadora');
        $html=$this->getCheckSi($data_datovivienda->dav_refrigerador,$html,'dav_refrigerador');
        $html=$this->getCheckSi($data_datovivienda->dav_lavatraste,$html,'dav_lavatraste');
        $html=$this->getCheckSi($data_datovivienda->dav_hidrolavadora,$html,'dav_hidrolavadora');
        $html=$this->getCheckSi($data_datovivienda->dav_lampara,$html,'dav_lampara');
        $html=$this->getCheckSi($data_datovivienda->dav_cuadro,$html,'dav_cuadro');
        $html=$this->getCheckSi($data_datovivienda->dav_transportepub,$html,'dav_transportepub');
        $html=$this->getCheckSi($data_datovivienda->dav_teatrocasa,$html,'dav_teatrocasa');
        ///check de palomita fin
        // $html=$this->getCheckSi($data_datovivienda->dav_servgas,$html,$id_img='#dav_servgas-url#',$id_imagen_style='#dav_servgas-img_style#',$id_td='#dav_servgas-style_td#');

        $html=str_replace("#dav_servgas#",trim($datovivienda->getNombreServicioGas($data_datovivienda->dav_servgas)),$html);


        if(count($DatoviviendanterdetallesDetalles)>0){
            
            $html=str_replace("#dva_nombrepropietario#",$DatoviviendanterdetallesDetalles[0]->dva_nombrepropietario,$html);
            $html=str_replace("#dva_nombrepropietario-style_bg#",$formato_pdf->verificar_si_es_vacio_td($DatoviviendanterdetallesDetalles[0]->dva_nombrepropietario), $html);

            $html=str_replace("#dva_motivocamb#",$DatoviviendanterdetallesDetalles[0]->dva_motivocamb,$html);
            $html=str_replace("#dva_motivocamb-style_bg#",$formato_pdf->verificar_si_es_vacio_td($DatoviviendanterdetallesDetalles[0]->dva_motivocamb), $html);

            $html=str_replace("#dva_antiguedad#",$datovivienda->getAntiguedad($DatoviviendanterdetallesDetalles[0]->dva_antiguedad),$html);
            $html=str_replace("#dva_antiguedad-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_antiguedad), $html);


            $html=str_replace("#dva_zona#",$datovivienda->getZona($DatoviviendanterdetallesDetalles[0]->dva_zona),$html);
            $html=str_replace("#dva_zona-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_zona), $html);


            $html=str_replace("#dva_clasesocial#",$datovivienda->getClaseSocial($DatoviviendanterdetallesDetalles[0]->dva_clasesocial),$html);
            $html=str_replace("#dva_clasesocial-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_clasesocial), $html);

            $html=str_replace("#dva_vivienda#",$datovivienda->getVivienda($DatoviviendanterdetallesDetalles[0]->dva_vivienda),$html);
            $html=str_replace("#dva_vivienda-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_vivienda), $html);

            $html=str_replace("#dva_inmueble#",$datovivienda->getInmueble($DatoviviendanterdetallesDetalles[0]->dva_inmueble),$html);
            $html=str_replace("#dva_inmueble-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_inmueble), $html);


            $html=str_replace("#dva_formatovivienda#",$datovivienda->getFormatoVivienda($DatoviviendanterdetallesDetalles[0]->dva_formatovivienda),$html);
            $html=str_replace("#dva_formatovivienda-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_formatovivienda), $html);

            $html=str_replace("#dva_nivel#",$datovivienda->getNiveles($DatoviviendanterdetallesDetalles[0]->dva_nivel),$html);
            $html=str_replace("#dva_nivel-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_nivel), $html);

            $html=str_replace("#dva_recamara#",$datovivienda->getValorSelectNumericos($DatoviviendanterdetallesDetalles[0]->dva_recamara),$html);
            $html=str_replace("#dva_recamara-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_recamara), $html);

            $html=str_replace("#dva_banio#",$datovivienda->getValorSelectNumericos($DatoviviendanterdetallesDetalles[0]->dva_banio),$html);
            $html=str_replace("#dva_banio-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_banio), $html);


            $html=str_replace("#dva_montorentaovalor#",$DatoviviendanterdetallesDetalles[0]->dva_montorentaovalor,$html);
            $html=str_replace("#dva_montorentaovalor-style_bg#",$formato_pdf->verificar_si_es_vacio_select($DatoviviendanterdetallesDetalles[0]->dva_montorentaovalor), $html);

            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_comedor,$html,'dva_comedor');

            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_jardin,$html,'dva_jardin');
            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_piscina,$html,'dva_piscina');
            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_garage,$html,'dva_garage');
            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_cuaservicio,$html,'dva_cuaservicio');
            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_cualavado,$html,'dva_cualavado');

            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_terraza,$html,'dva_terraza');

            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_salajuego,$html,'dva_salajuego');

            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_estudio,$html,'dva_estudio');
            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_cocina,$html,'dva_cocina');
            $html=$this->getCheckSi($DatoviviendanterdetallesDetalles[0]->dva_sala,$html,'dva_sala');



            $html=str_replace("#dva_direccion#",$this->getDireccionFormatoCompleto($DatoviviendanterdetallesDetalles[0]),$html);
            $html=str_replace("#dva_direccion-style_bg#",$formato_pdf->verificar_si_es_vacio_td($this->getDireccionFormatoCompleto($DatoviviendanterdetallesDetalles[0])), $html);


        }else{

        
            
            $html=str_replace("#dva_direccion#",'',$html);
            $html=str_replace("#dva_direccion-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_nombrepropietario#",'',$html);
            $html=str_replace("#dva_nombrepropietario-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);


            $html=str_replace("#dva_motivocamb#",'',$html);
            $html=str_replace("#dva_motivocamb-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_antiguedad#",'',$html);
            $html=str_replace("#dva_antiguedad-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_zona#",'',$html);
            $html=str_replace("#dva_zona-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_clasesocial#",'',$html);
            $html=str_replace("#dva_clasesocial-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);


            $html=str_replace("#dva_vivienda#",'',$html);
            $html=str_replace("#dva_vivienda-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_inmueble#",'',$html);
            $html=str_replace("#dva_inmueble-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_formatovivienda#",'',$html);
            $html=str_replace("#dva_formatovivienda-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_nivel#",'',$html);
            $html=str_replace("#dva_nivel-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_recamara#",'',$html);
            $html=str_replace("#dva_recamara-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_montorentaovalor#",'',$html);
            $html=str_replace("#dva_montorentaovalor-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            $html=str_replace("#dva_banio#",'',$html);
            $html=str_replace("#dva_banio-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

            



            $html=$this->getCheckSi(-1,$html,'dva_comedor');

            $html=$this->getCheckSi(-1,$html,'dva_jardin');
            $html=$this->getCheckSi(-1,$html,'dva_piscina');
            $html=$this->getCheckSi(-1,$html,'dva_garage');
            $html=$this->getCheckSi(-1,$html,'dva_cuaservicio');
            $html=$this->getCheckSi(-1,$html,'dva_cualavado');

            $html=$this->getCheckSi(-1,$html,'dva_terraza');

            $html=$this->getCheckSi(-1,$html,'dva_salajuego');

            $html=$this->getCheckSi(-1,$html,'dva_estudio');
            $html=$this->getCheckSi(-1,$html,'dva_cocina');
            $html=$this->getCheckSi(-1,$html,'dva_sala');
            
        }

        return $html;
     }
     
     



}