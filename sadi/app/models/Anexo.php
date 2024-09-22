<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla antecedentegrupofamiliar
 */
class Anexo extends Model
{  
    public function formatoeses($ese_id,$anexos_archivos_array)
    {

    $reporte= new PdfReporte();
    $html=$reporte->anexos;
  
  
     if(count($anexos_archivos_array)>1){
        $tr_style='<tr >
                    <td style="font-size: 10px;text-align:center; width:43%"></td>
                    <td style="font-size: 10px;text-align:center; width:6%"></td>
                    <td style="font-size: 10Px;text-align:center; width:43%"></td>
                  </tr>';

        $html= str_replace("#style_dinamico_anexos_archivos#",$tr_style,$html);

        $tr_agregar='';
        $tr="
        
         <tr>
                 <td   style='text-align:center;  text-transform: uppercase; '>
                 <p style='font-size: 27x;text-align:center; width:100% text-transform: uppercase;'> #anexos_mostrados_en_visita_par_titulo_catagoria#</p>
                 <br>
                 <img class='_idGenObjectAttribute-1' src='archivos/#anexos_mostrados_en_visita_par#' height='100%' width='100%' style='  padding-bottom: 50px;' />
                 </td>
                 <td ></td>

                 <td  style='text-align:center; text-transform: uppercase; '>

                 <p style='font-size: 27px;text-align:center; width:100%'> #anexos_mostrados_en_visita_impar_titulo_catagoria#</p>
                 <br>


                 #img_impar_mostrado_en_visita#

         </tr>";
 
         $anexos_archivos_array_count_array=count($anexos_archivos_array)-1;
         if (($anexos_archivos_array_count_array % 2) != 0) {
          
            for ($i=0; $i  < count($anexos_archivos_array) ; $i++) { 
 
                $tr_nuevo='';
                $tr_nuevo=$tr;
    
                if (($i % 2) != 0) {
                    //Es un número impar
                    $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par#",basename('archivos/'.$anexos_archivos_array[$i-1]->arc_nombre),$tr_nuevo);
                    $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par_titulo_catagoria#",$anexos_archivos_array[$i-1]->cat_nombre,$tr_nuevo);


                    $img_impar_mostrado_en_visita="
                    <img class='_idGenObjectAttribute-1' src='archivos/".basename('archivos/'.$anexos_archivos_array[$i]->arc_nombre)."' height='100%' width='100%' style='  padding-bottom: 50px;' /></td>
                    ";

                    $tr_nuevo= str_replace("#img_impar_mostrado_en_visita#",$img_impar_mostrado_en_visita,$tr_nuevo);
                    $tr_nuevo= str_replace("#anexos_mostrados_en_visita_impar_titulo_catagoria#",$anexos_archivos_array[$i]->cat_nombre,$tr_nuevo);

                    $tr_agregar=$tr_agregar.$tr_nuevo;
    
    
                } 
    
               
              
            }

         }
         if (($anexos_archivos_array_count_array % 2) == 0) {
            
                for ($i=0; $i  < count($anexos_archivos_array) ; $i++) { 
             
                    $tr_nuevo='';
                    $tr_nuevo=$tr;
        
                    if (($i % 2) == 0) {
                        //Es un número par
                        $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par#",basename('archivos/'.$anexos_archivos_array[$i]->arc_nombre),$tr_nuevo);
                        $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par_titulo_catagoria#",$anexos_archivos_array[$i]->cat_nombre,$tr_nuevo);

                            if($i!=$anexos_archivos_array_count_array){


                                $img_impar_mostrado_en_visita="
                                <img class='_idGenObjectAttribute-1' src='archivos/".basename('archivos/'.$anexos_archivos_array[$i+1]->arc_nombre)."' height='100%' width='100%' style='  padding-bottom: 50px;' /></td>
                                ";
                                $tr_nuevo= str_replace("#anexos_mostrados_en_visita_impar_titulo_catagoria#",$anexos_archivos_array[$i+1]->cat_nombre,$tr_nuevo);


                                $tr_nuevo= str_replace("#img_impar_mostrado_en_visita#",$img_impar_mostrado_en_visita,$tr_nuevo);


                            }
                            if($i==$anexos_archivos_array_count_array){
                                $tr_nuevo= str_replace("#img_impar_mostrado_en_visita#","",$tr_nuevo);
                                $tr_nuevo= str_replace("#anexos_mostrados_en_visita_impar_titulo_catagoria#","",$tr_nuevo);


                            }
                            
                    
                        $tr_agregar=$tr_agregar.$tr_nuevo;
        
        
                    }       
                }
                
         }

      
 
 
         $html= str_replace("#filas_dinamicas_anexos_archivos#",$tr_agregar,$html);
        
     }
     if(count($anexos_archivos_array)==1){
        $tr_style='<tr >
                        <td style="font-size: 10px;text-align:center; width:0$"></td>
                        <td style="font-size: 10px;text-align:center;width:10px"></td>
                        <td style="font-size: 10Px;text-align:center; width:0%"></td>
                 </tr>';

        $html= str_replace("#style_dinamico_anexos_archivos#",$tr_style,$html);

        $tr_agregar='';
        $tr="
         <tr >
                 <td   style='text-align:center; '>
                 </td>
                 <td style='text-align:center; text-transform: uppercase;'>
                 <p style='font-size: 15px;text-align:center; width:100% text-transform: uppercase;'> #anexos_mostrados_en_visita_unica_titulo_catagoria#</p>
                 <img class='_idGenObjectAttribute-1' src='archivos/#anexos_mostrados_en_visita_unica#' height='540px' width='100%' />
                 </td>

                 <td  style='text-align:center; '>

                  </tr>";
        $tr_agregar=$tr;

        $tr_agregar= str_replace("#anexos_mostrados_en_visita_unica_titulo_catagoria#",$anexos_archivos_array[0]->cat_nombre,$tr_agregar);
        $tr_agregar= str_replace("#anexos_mostrados_en_visita_unica#",basename('archivos/'.$anexos_archivos_array[0]->arc_nombre),$tr_agregar);

         $html= str_replace("#filas_dinamicas_anexos_archivos#",$tr_agregar,$html);

     }        
     

     

     


        return $html;


    }

    public function  formatoEseTruper($ese_id){
    
        $reporte= new PdfReporteTruper();
        $html=$reporte->domiciliocandidato_imagenes_pagina_2;

        $formato_pdf=new FormatotruperPDF();
        


                //foto del mapa
                $foto_mapa=Archivo::query()
                ->where('ese_id='.$ese_id.' and arc_estatus=2 and cat_id=6')
                ->execute();
        
                if(count($foto_mapa)>0){
        
                    $html=str_replace("#foto_mapa_img#",trim(basename('archivos/'.$foto_mapa[0]->arc_nombre)),$html);
                    $html=str_replace("#foto_mapa_img-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1),$html);

        
                }else{
                    $html=str_replace("#foto_mapa_style#","display:none;",$html);
                    $html=str_replace("#foto_mapa_img-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

        
                }
                //foto del mapa fin

            

                           //foto de domicilio 
                           $foto_domicilio=Archivo::query()
                           ->where('ese_id='.$ese_id.' and arc_estatus=2 and cat_id=4')
                           ->execute();
                   
                           if(count($foto_domicilio)>0){
                   
                               $html=str_replace("#foto_facha_domicilio_img#",trim(basename('archivos/'.$foto_domicilio[0]->arc_nombre)),$html);
                               $html=str_replace("#foto_facha_domicilio_style-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1),$html);

                           }else{
                              $html=str_replace("#foto_facha_domicilio_style-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);
                               $html=str_replace("#foto_facha_domicilio_style#","display:none;",$html);
                               $html=str_replace("#foto_facha_domicilio_style#","display:none;",$html);

                           }
                           //foto domicilio fin

                           //foto_interior_domicilio_img inicio
                           $foto_interior_domicilio=Archivo::query()
                           ->where('ese_id='.$ese_id.' and arc_estatus=2 and cat_id=3')
                           ->execute();
                   
                           if(count($foto_interior_domicilio)>0){
                   
                            $html=str_replace("#foto_interior_domicilio_img#",trim(basename('archivos/'.$foto_interior_domicilio[0]->arc_nombre)),$html);
                            $html=str_replace("#foto_interior_domicilio_img-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1),$html);

                           }else{
                            $html=str_replace("#foto_interior_domicilio_img-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                              $html=str_replace("#foto_interior_domicilio_style#","display:none;",$html);
                   
                           }

                           //foto_interior_domicilio_img fin


                           ///foto_fachada_vecino_img inicio

                           $foto_fachada_vecino=Archivo::query()
                           ->where('ese_id='.$ese_id.' and arc_estatus=2 and cat_id=14')
                           ->execute();
                   
                           if(count($foto_fachada_vecino)>0){
                            $html=str_replace("#foto_fachada_vecino_img-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1),$html);

                               $html=str_replace("#foto_fachada_vecino_img#",trim(basename('archivos/'.$foto_fachada_vecino[0]->arc_nombre)),$html);
                   
                           }else{
                            $html=str_replace("#foto_fachada_vecino_img-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null),$html);

                               $html=str_replace("#foto_fachada_vecino_style#","display:none;",$html);
                   
                           }
                           //foto_fachada_vecino_img fin

        return $html;
    }
    
    public function formatoesesreferenciascabecera()
    {
        $reporte= new PdfReporte();
        $html=$reporte->anexosreferenciascabecera;
        return $html;
    }

    public function formatoesesreferencias($ese_id,$anexos_archivos_array)
    {
        $reporte= new PdfReporte();
        $html=$reporte->anexosreferencias;
    
        if(count($anexos_archivos_array)>1){
            $tr_style='<tr >
                        <td style="font-size: 10px;text-align:center; width:43%"></td>
                        <td style="font-size: 10px;text-align:center; width:6%"></td>
                        <td style="font-size: 10Px;text-align:center; width:43%"></td>
                    </tr>';

            $html= str_replace("#style_dinamico_anexos_archivos#",$tr_style,$html);

            $tr_agregar='';
            $tr="
                <tr>
                    <td   style='text-align:center;  text-transform: uppercase; '>
                    <p style='font-size: 27x;text-align:center; width:100% text-transform: uppercase;'> </p>
                    
                    <img class='_idGenObjectAttribute-1' src='archivos/#anexos_mostrados_en_visita_par#' height='100%' width='100%' style='  padding-bottom: 50px;' />
                    </td>
                    <td></td>
                    <td  style='text-align:center; text-transform: uppercase; '>
                        <p style='font-size: 27px;text-align:center; width:100%'>  </p>
                    #img_impar_mostrado_en_visita#
                </tr>";

            $anexos_archivos_array_count_array=count($anexos_archivos_array)-1;
            if (($anexos_archivos_array_count_array % 2) != 0) {
                for ($i=0; $i  < count($anexos_archivos_array) ; $i++) {
                    $tr_nuevo='';
                    $tr_nuevo=$tr;

                    if (($i % 2) != 0) {
                        //Es un número impar
                        $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par#",basename('archivos/'.$anexos_archivos_array[$i-1]->arc_nombre),$tr_nuevo);
                        $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par_titulo_catagoria#","",$tr_nuevo);
                        $img_impar_mostrado_en_visita="
                        <img class='_idGenObjectAttribute-1' src='archivos/".basename('archivos/'.$anexos_archivos_array[$i]->arc_nombre)."' height='100%' width='100%' style='  padding-bottom: 50px;' /></td>
                        ";
                        $tr_nuevo= str_replace("#img_impar_mostrado_en_visita#",$img_impar_mostrado_en_visita,$tr_nuevo);
                        $tr_agregar=$tr_agregar.$tr_nuevo;
                    }
                }
            }
            if (($anexos_archivos_array_count_array % 2) == 0) {
                for ($i=0; $i  < count($anexos_archivos_array) ; $i++) {
                    $tr_nuevo='';
                    $tr_nuevo=$tr;

                    if (($i % 2) == 0) {
                        //Es un número par
                        $tr_nuevo= str_replace("#anexos_mostrados_en_visita_par#",basename('archivos/'.$anexos_archivos_array[$i]->arc_nombre),$tr_nuevo);
                        if($i!=$anexos_archivos_array_count_array){
                            $img_impar_mostrado_en_visita="
                            <img class='_idGenObjectAttribute-1' src='archivos/".basename('archivos/'.$anexos_archivos_array[$i+1]->arc_nombre)."' height='100%' width='100%' style='  padding-bottom: 50px;' /></td>
                            ";
                            $tr_nuevo= str_replace("#img_impar_mostrado_en_visita#",$img_impar_mostrado_en_visita,$tr_nuevo);
                        }
                        if($i==$anexos_archivos_array_count_array){
                            $tr_nuevo= str_replace("#img_impar_mostrado_en_visita#","",$tr_nuevo);
                        }
                        $tr_agregar=$tr_agregar.$tr_nuevo;
                    }       
                }    
            }
            $html= str_replace("#filas_dinamicas_anexos_archivos#",$tr_agregar,$html);
            
        }
        if(count($anexos_archivos_array)==1){
            $tr_style='<tr>
                    <td style="font-size: 10px;text-align:center; width:0$"></td>
                    <td style="font-size: 10px;text-align:center;width:10px"></td>
                    <td style="font-size: 10Px;text-align:center; width:0%"></td>
                </tr>';

            $html= str_replace("#style_dinamico_anexos_archivos#",$tr_style,$html);

            $tr_agregar='';
            $tr="
                <tr >
                    <td style='text-align:center; '>
                    </td>
                    <td style='text-align:center; text-transform: uppercase;'>
                    <img class='_idGenObjectAttribute-1' src='archivos/#anexos_mostrados_en_visita_unica#' height='340px' width='100%' />
                    </td>
                    <td style='text-align:center; '>
                </tr>";
            $tr_agregar=$tr;
            $tr_agregar= str_replace("#anexos_mostrados_en_visita_unica#",basename('archivos/'.$anexos_archivos_array[0]->arc_nombre),$tr_agregar);
            $html= str_replace("#filas_dinamicas_anexos_archivos#",$tr_agregar,$html);

        }
        return $html;
    }
}
