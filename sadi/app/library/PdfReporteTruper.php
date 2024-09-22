<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporteTruper extends Component
{

    
    public $html_completo = '


        <div id="current_date"></p>
       
       
        ';

    public $cabezera_hoja='   
    
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse; margin:810px 0px 0px 0px; padding:100px 0px 0px 0px;">
                    <tbody>
                        <tr >
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                            <td style="width:10%"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="8"></td>
                            <th colspan="2" rowspan="3" style="text-align:center"> <img height="34" class="_idGenObjectAttribute-1" src="images/#logo_header#"  /></th>
                        </tr>
                        <tr>
                            <td colspan="8" style="font-family:Calibri, sans-serif;font-size:20;text-align:center;font-weight: bold;"> ESTUDIO SOCIOECONÓMICO</td>
                        </tr>
                    </tbody>
            </table>  ';


    public $header_hoja=' 
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
        <tbody>
                <tr><td style="height:10px border: 1px solid #FF6600;  "></td></tr>
                <tr   >
            

                    <td colspan="8" style="color:white; font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;
                    color:white;text-align:left;font-weight: bold;border: 1px solid #FF6600">
                    &nbsp;&nbsp;&nbsp;Copyright ©</td>
                    <td  style="text-align: left; color:white; text-align:right ;  margin:0 20px 0 0 ; font-size:10px;background-color:#FF6600;border: 1px solid #FF6600" colspan="2">Página: {PAGENO}</td>
                </tr>	
        </tbody> 
        </table>';


    public $datospersonales_pagina_1=' 
        <style >
            .td_text_format { 
                font-size:9.5;   
                font-weight: bold; 
                color:blue;
                text-align: center;
                font-family:"Monserrat",sans-serif;
            }
            .td_text_format_without_center{
                font-size:12;   
                font-weight: bold; 
                color:blue;
            }

            .td_text_format_left { 
                font-size:12;   
                font-weight: bold; 
                color:blue;
            }
            .td_text_format_align_end { 
                font-size:12;   
                font-weight: bold; 
                color:blue;
                text-align: center;
            }
            .bg-white{
                background-color:white !important; 
            }
            .bg-gray{
                background-color:#D9D9D9 !important; 
            }
        
        </style>

        <!-- PAGINA 1 -->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
         
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DATOS GENERALES</td>
                </tr>
                <tr>
                <th style="display:none;" colspan="2" rowspan="6" style="height:90%">
                
                <img class="_idGenObjectAttribute-1" src="archivos/#candidato_foto#" style="height:110px; width:100px; #candidato_foto_style#  " />
                
                </th>
                
                <td colspan="8" ></td>
                </tr>
                <tr>
                <td colspan="4" style="font-size:14px;background-color:black; text-align:center; font-family:Radio Stars,sans-serif; color:#00FFFF;font-weight: bold; height:14px;">R E S U L T A D O</td>
                <td></td>
                <td colspan="3" style="border: 1px solid #FF6600;background-color:#FF6600; text-align:center; font-family:Calibri, sans-serif;color:white;font-weight: bold;font-size:11px;">FECHAS</td>
                </tr>
                <tr>
                <th colspan="4" rowspan="3" style="font-size:20px; text-align:center; font-family:Calibri, sans-serif; #td_style-ese_calificacion#" >#ese_calificacion#</th>
                <td></td>
                <td style="border: 1px solid #FF6600;height:20px;text-align:center;font-family:Calibri, sans-serif;font-size:11px">Solicitud:</td>
                <td colspan="2" style="border: 1px solid #FF6600; border: 1px solid #FF6600;"  class="td_text_format" >#ese_solicitud#</td>
                <tr>
                </tr>
                <tr>
                <td ></td>
                <td style="text-align: center;border: 1px solid #FF6600;height:20px;font-family:Calibri, sans-serif;font-size:11px">Visita:</td>
                <td colspan="2" style="border: 1px solid #FF6600;"  class="td_text_format #ese_fechavisita-bg#" >#ese_fechavisita#</td>
                </tr>
                <tr>
                <td ></td>
                <td colspan="1" style="text-align: center;border: 1px solid #FF6600;height:20px;font-family:Calibri, sans-serif;font-size:11px">Entrega:</td>
                <td colspan="2" style="border: 1px solid #FF6600;"  class="td_text_format">#ese_fechaentregacliente#</td>
                </tr>
                <tr>
                <td colspan="8" style="width:20px"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-weight: bold;font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left">
                    &nbsp;&nbsp;&nbsp;DATOS GENERALES DEL CANDIDATO</t>
                </tr>
                <tr>
                    <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600; font-family:Calibri, sans-serif;font-size:11;height:25px" >&nbsp;&nbsp;Nombre:</td>
                    <td  style="border: 1px solid #FF6600;  " colspan="5" media="td_text_format"   class="td_text_format #ese_nombre-style_bg# " > #ese_nombre# </td>
                    <td  style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" colspan="2">Fecha de nacimiento:</td>
                    <td  style="border: 1px solid #FF6600; " colspan="2"  class="td_text_format   #ese_fechanacmiento-style_bg#">#ese_fechanacmiento#</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600; font-family:Calibri, sans-serif;font-size:11;height:25px">&nbsp;&nbsp;Edad:</td>
                    <td  style="border: 1px solid #FF6600;"  class="td_text_format" >#ese_edad#</td>
                    <td  style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" >Edo. Civil:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="3" class="td_text_format">#ese_estadocivil#</td>
                    <td  style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;"  >Área:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="3"  class="td_text_format #ese_area-style_bg# ">#ese_area#</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;height:25px" colspan="2">&nbsp;&nbsp;Puesto solicitado:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="8"  class="td_text_format #ese_puestpsolicitado-style_bg#  ">#ese_puestpsolicitado#</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;height:25px" colspan="2">&nbsp;&nbsp;Dirección actual:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="8"  class="td_text_format  #ese_direccion-style_bg#"  >#ese_direccion# </td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;font-size:8px; height:18px; text-align:center" colspan="10">Calle</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;"  class="td_text_format #ese_numext-style_bg# "  >#ese_numext#</td>
                    <td  style="border: 1px solid #FF6600;"   class="td_text_format  #ese_numint-style_bg# ">#ese_numint#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format  #ese_colonia-style_bg#  ">#ese_colonia#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format   #ese_municipio-style_bg#  ">#ese_municipio#</td>
                    <td  style="border: 1px solid #FF6600;"  colspan="2"  class="td_text_format   #ese_estado-style_bg# ">#ese_estado#</td>
                    <td  style="border: 1px solid #FF6600;"  class="td_text_format  #ese_codpostal-style_bg# " >#ese_codpostal#</td>
                    <td  style=" height:30px ;border: 1px solid #FF6600; font-size:9.5"  class="td_text_format  #ese_pais-style_bg#" >#ese_pais#</td>

                </tr>
                <tr style="border: 1px solid #FF6600">
                    <td  style="height:18px;text-align:center;font-size:7px;">No. Ext / Mza.</td>
                    <td  style="text-align:center;font-size:7px; "  >No. Int. / Lt</td>
                    <td  style="text-align:center;font-size:7px;" colspan="2" >Colonia</td>
                    <td  style="text-align:center;font-size:7px;" colspan="2" >Delegacion / Ciudad / Municipio</td>
                    <td  style="text-align:center;font-size:7px;" colspan="2" >Estado</td>
                    <td  style="text-align:center;font-size:7x;" >Código Postal</td>
                    <td  style="text-align:center;font-size:7px;" >País</td>
                </tr>
                <tr>
                    <td  style="height:30px;border: 1px solid #FF6600;" colspan="6"  class="td_text_format  #ese_entrecalles-style_bg#">#ese_entrecalles#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="4"  class="td_text_format  #ese_referenciaubicacion-style_bg# ">#ese_referenciaubicacion#</td>
                </tr>
                    <tr>
                    <td  style="text-align:center;font-size:7px;" colspan="6">Entre que calles se encuentra el domicilio</td>
                    <td  style="text-align:center;font-size:7px;" colspan="4">Referencia de ubicación</td>
                </tr>
                <tr>
                    <td  style="text-align:center;height:30px;border: 1px solid #FF6600;font-size:12px">Teléfono:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format #ese_telefono-style_bg# ">#ese_telefono#</td>
                    <td  style="text-align:center;height:30px;border: 1px solid #FF6600;font-size:12px">Celular:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format    #ese_celular-style_bg# ">#ese_celular#</td>
                    <td  style="text-align:center;height:30px;border: 1px solid #FF6600;font-size:12px" colspan="2">Teléfono de recados:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format  #ese_telefonorecado-style_bg# ">#ese_telefonorecado#</td>
                </tr>
                <tr >
                    <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;UBICACIÓN DEL DOMICILIO</t>
                </tr>
                <tr>
                    <td style="height:20px" colspan="10"></td>
                </tr>
                <tr>
                    <td style=""> </td>
                    <td  style="height:80px;border: 1px solid #FF6600;" colspan="2"></td>
                    <td  style="font-family:Calibri; font-size:9px;text-align: center;font-weight:bold; color:#0000ff" text-rotate="90" rowspan="5";><p> #ese_calleoeste#</td>
                    <td  style="border: 1px solid #FF6600" colspan="2"></td>
                    <td  style="font-family:Calibri; font-size:9px;text-align: center;font-weight:bold; color:#0000ff" text-rotate="90" rowspan="5";><p>  #ese_calleeste#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"></td>
                    <td ></td>
                </tr>
                <tr>
                    <td> </td>
                    <td  style="height:25px;writing-mode: vertical-lr;" colspan="2"></td>
                    <td  style="font-family:Calibri; font-size:9px;text-align:center; writing-mode: vertical-lr; color:#0000ff;font-weight:bold;" colspan="2"> #ese_callenorte#</td>
                    <td  style="writing-mode: vertical-lr" colspan="2"></td>
                    <td ></td>
                </tr>
                <tr>
                
                    <td style=""> </td>
                    <td  style="height:80px;writing-mode: vertical-lr;border: 1px solid #FF6600" colspan="2"></td>

                    <td  ALIGN="left" VALIGN="top" style="margin:0;  writing-mode: vertical-lr;border: 1px solid #FF6600; z-index: 1;" colspan="2">
        
                    <img height="40" class="_idGenObjectAttribute-1" src="images/#UBICACION_IMG#"  style="z-index:999; float: left; #ubicacion_cordenadas#" />      
                   
                    </td>
                    
                    <td  style="writing-mode: vertical-lr;border: 1px solid #FF6600;" colspan="2"></td>
                    
                    <td ></td>
                </tr>
                <tr>
                    <td> </td>
                    <td  style="height:25px;writing-mode: vertical-lr;" colspan="2"></td>
                    <td  style="font-family:Calibri; font-size:9px;text-align:center;writing-mode: vertical-lr; color:#0000ff;font-weight:bold;" colspan="2"> #ese_callesur#</td>
                    <td  style="writing-mode: vertical-lr;" colspan="2"></td>
                    <td ></td>
                </tr>
                <tr>
                    <td style=""> </td>
                    <td  colspan="2" style="height:80%;weight:80%"><img class="_idGenObjectAttribute-1"  src="images/#estrella_norte#" /></td>
                    <td  style="writing-mode: vertical-lr;border: 1px solid #FF6600;" colspan="2"></td>
                    <td  style="writing-mode: vertical-lr;border: 1px solid #FF6600;" colspan="2"></td>
                    <td ></td>
                </tr>
                <tr>
                    <td colspan="10" style="height:30px"> </td>
                </tr>
                
            </tbody>
        </table>
        
        
            
        
        
        
        ';

    public $domiciliocandidato_imagenes_pagina_2=' 
        <!---------------------------------------------------------------------------- PAGINA 2 ----------------------------------------------------------------------->
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                                <td style="width:10%"></td>
                            </tr>
                        
                            <tr>
                                <td colspan="8"></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                                &nbsp;&nbsp;&nbsp;DOMICILIO DE CANDIDATO</td>
                            </tr>
                            <tr><td style="height:10px"></td></tr>
                            <tr>
                                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                                &nbsp;&nbsp;&nbsp;FOTOGRAFÍAS</td>
                            </tr>
                            <tr><td style="height:10px"></td></tr>
                            <tr>
                                <td colspan="5" style="text-align:center;font-family:Calibri, sans-serif;font-size:14;border: 1px solid #FF6600;font-weight: bold;font-size:11px">
                                Mapa de Ubicación</td>
                                <td colspan="5" style="text-align:center;font-family:Calibri, sans-serif;font-size:14;border: 1px solid #FF6600;font-weight: bold;font-size:11px">
                                Fachada del Domicilio</td>
                            </tr>
                            <tr>
                                <td  class="#foto_mapa_img-style_bg#"  colspan="5" style="text-align:center;border: 1px solid #FF6600; height: 260px;">
                                    <img src="archivos/#foto_mapa_img#" style="#foto_mapa_style#"  height="7cm" width="7cm" />
                                </td>
                                <td  class="#foto_facha_domicilio_style-style_bg#"  colspan="5" style="text-align:center;border: 1px solid #FF6600; height: 260px;">
                                    <img src="archivos/#foto_facha_domicilio_img#" style="#foto_facha_domicilio_style#"  height="7cm" width="7cm" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style=" text-align:center;font-family:Calibri, sans-serif;font-size:14;border: 1px solid #FF6600;font-weight: bold;font-size:11px">
                                 Interior del Domicilio</td>
                                <td colspan="5" style=" text-align:center;font-family:Calibri, sans-serif;font-size:14;border: 1px solid #FF6600;font-weight: bold;font-size:11px">
                                Fachada del Domicilio del Vecino</td>
                            </tr>
                            <tr>
                                <td  class="#foto_interior_domicilio_img-style_bg#"   colspan="5"  style=" height: 260px; text-align:center;border: 1px solid #FF6600;">
                                    <img class="_idGenObjectAttribute-1" src="archivos/#foto_interior_domicilio_img#" style="#foto_interior_domicilio_style#" height="7cm" width="7cm" />
                                    </td>
                                <td class="#foto_fachada_vecino_img-style_bg#"   colspan="5" style=" height: 260px; text-align:center;border: 1px solid #FF6600;">
                                    <img class="_idGenObjectAttribute-1" src="archivos/#foto_fachada_vecino_img#"  style="#foto_fachada_vecino_style#" height="7cm" width="7cm" />
                                </td>
                            </tr>
                            <tr><td style="height:9.5px style="border: 1px solid #FF6600;""></td></tr>
                            #domiciliocandidato_data_pagina_2#
                          
                        </tbody>
                    </table>
                ';

    public $domiciliocandidato_data_pagina_2=' 
                            <tr>
                                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                                &nbsp;&nbsp;&nbsp;COMENTARIOS DEL DOMICILIO:</td>
                            </tr>
                            <tr><td colspan="10" style="height:65px;border: 1px solid #FF6600;"  class="td_text_format #dav_comentario-style_bg#" >#dav_comentario#</td></tr>
                            <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
                            <tr>
                                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                                &nbsp;&nbsp;&nbsp;DATOS DE LA VIVIENDA</td>
                            </tr>
                            </tr>
                            <tr>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Antigüedad:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dav_antiguedad-style_bg#" >#dav_antiguedad#</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Zona:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dav_zona-style_bg# " >#dav_zona#</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Clase social:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format  #dav_clasesocial-style_bg# " >#dav_clasesocial#</td>
                            </tr>
                            <tr>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Vivienda:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dav_vivienda-style_bg# ">#dav_vivienda#</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Inmueble:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format  #dav_inmueble-style_bg# " >#dav_inmueble#</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Formato de la vivienda:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format   #dav_formatovivienda-style_bg# " >#dav_formatovivienda#</td>
                            </tr>
                            <tr>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Niveles:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dav_nivel-style_bg# " >#dav_nivel#</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Apariencia:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format  #dav_apariencia-style_bg# " >#dav_apariencia#</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Estado del Mobiliario:</td>
                                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dav_estadomobiliario-style_bg# " >#dav_estadomobiliario#</td>
                            </tr>
                            <tr>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Recámaras:</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format  #dav_recamara-style_bg# " >#dav_recamara#</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Baños:</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format   #dav_banio-style_bg# " >#dav_banio#</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Sala:</td>


                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_sala-bg#">
                                #dav_sala-display# 
                
                                </td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Cocina:</td>
                                <td colspan="1" style="height:20px; padding: 0px 0px 0px 0px; border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_cocina-bg#">
                                    #dav_cocina-display#
                
                                </td>

                        

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Comedor:</td>
                               

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_comedor-bg#">
                                    #dav_comedor-display#
                                </td>


                            </tr>
                            <tr>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Estudio:</td>
       

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_estudio-bg#">
                                    #dav_estudio-display#
                                </td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">S./juegos:</td>
                               

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_salajuego-bg#">
                                    #dav_salajuego-display#
                                </td>

                                

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Terraza:</td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_terraza-bg#">
                                    #dav_terraza-display#
                                </td>




                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">C/Lavado:</td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_cualavado-bg#">
                                    #dav_cualavado-display#
                                </td>


                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">C/Servicio:</td>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_cuaservicio-bg#">
                                    #dav_cuaservicio-display#
                                </td>



                            </tr>
                            <tr>
                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Garage:</td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_garage-bg#">
                                    #dav_garage-display#
                                </td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Jardín</td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_jardin-bg#">
                                    #dav_jardin-display#
                                </td>

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Piscina:</td>   

                                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; #dav_piscina-bg#">
                                    #dav_piscina-display#
                                </td>
                                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10"></td>
                            </tr>

                        <tr>
                            <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Nombre del Propietario de la vivienda:</td>

                            <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold;" class=" td_text_format #dav_nombrepropietario-style_bg#">
                            #dav_nombrepropietario#
                            </td>

                            <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Teléfono</td>

                            <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif; text-align:left; font-size:10;font-weight: bold; "  class="td_text_format #dav_telefonopropietario-style_bg#">
                              #dav_telefonopropietario#
                            </td>

                           
                        </tr>
                          
             	';


    public $datoviviendaanterior_pagina_3='     
        <!---------------------------------------------------------------------------- PAGINA 3 ----------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
            
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;SERVICIOS DE LA ZONA</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Agua:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight:   bold;  #dav_agua-style_td#">
            
                        #dav_agua#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Drenaje:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_drenaje-style_td#">
                        #dav_drenaje#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Luz:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_luz-style_td#">
                        #dav_luz#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Teléfono:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_telefono-style_td#">
                        #dav_telefono#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Alumbrado:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_alumbrado-style_td#">
                        #dav_alumbrado#
                    </td>

                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Pavimento:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_pavimento-style_td#">
                        #dav_pavimento#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Tv Cable:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_tvcable-style_td#">
                        #dav_tvcable#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Internet:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_internet-style_td#">
                        #dav_internet#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Hospitales:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_hospital-style_td#">
                        #dav_hospital#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Parques:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_parque-style_td#">
                        #dav_parque#
                    </td>

                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Deportivos:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_deportivo-style_td#">
                    #dav_deportivo#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Club:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_club-style_td#">
                        #dav_club#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Casa de cultura:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_casacultura-style_td#">
                        #dav_casacultura#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Transporte público:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_transportepub-style_td#">

                    #dav_transportepub#

                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Servicio de Gas:</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold; text-align:center;" class="td_text_format">

                

                    #dav_servgas#

                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Centros comerciales:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_centrocomercial-style_td#">
                        #dav_centrocomercial#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Fibra Óptica:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_fibraoptica-style_td#">
                        #dav_fibraoptica#

                    </td>

                </tr>
                <tr>
                    <td colspan="10" style="height:30px"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;ESTILO DE VIDA</td>
                </tr>
                <tr>-
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Televisión:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_television-style_td#">
                        #dav_television#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Pantalla:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_pantalla-style_td#">
                        #dav_pantalla#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Teatro en casa:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_teatrocasa-style_td#">
                        #dav_teatrocasa#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">DVD:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_dvd-style_td#">
                        #dav_dvd#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Blue Ray:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_blueray-style_td#">
                        #dav_blueray#
                    </td>

                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Estéreo:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_estereo-style_td#">
                        #dav_estereo#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">PC:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_pc-style_td#">
                        #dav_pc#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Lap Top:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_laptop-style_td#">
                        #dav_laptop#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Tablet:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_tablet-style_td#">
                        #dav_tablet#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Smartphone:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_smartphone-style_td#">
                        #dav_smartphone#
                    </td>

                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Videocámara:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_videocamara-style_td#">
                        #dav_videocamara#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Cámara::</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_camara-style_td#">
                        #dav_camara#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Cocina integral:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_cocinaintegral-style_td#">
                        #dav_cocinaintegral#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Estufa:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_estufa-style_td#">
                        #dav_estufa#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Horno:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_horno-style_td#">
                        #dav_horno#
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Microondas:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_microondas-style_td#">
                        #dav_microondas#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Licuadora:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_licuadora-style_td#">
                        #dav_licuadora#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Plancha:</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_plancha-style_td#">
                        #dav_plancha#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Lavadora:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_lavadora-style_td#">
                        #dav_lavadora#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Refrigerador:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_refrigerador-style_td#">
                        #dav_refrigerador#
                    </td>

                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Lavatrastes:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_lavatraste-style_td#">
                        #dav_lavatraste#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Hidrolavadora:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_hidrolavadora-style_td#">
                        #dav_hidrolavadora#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Lámparas:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_lampara-style_td#">
                        #dav_lampara#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Cuadros:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dav_cuadro-style_td#">
                        #dav_cuadro#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                </tr>
                <tr>
                    <td colspan="10" style="height:30px"></td>
                </tr>
        <tr>
                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;DOMICILIO ANTERIOR (Llenar cuando se tenga menos de un año en el domicilio actual)</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Propietario:</td>
                <td colspan="8" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_nombrepropietario-style_bg# " >#dva_nombrepropietario#</td>
            </tr>
            <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Dirección:</td>
            </tr>
            <tr> <td colspan="10" style="height:100px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_direccion-style_bg# " >#dva_direccion#</td>
            </tr>
            <tr>
            <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Motivo del cambio:</td>
            </tr>
            <tr> <td colspan="10" style="height:160px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_motivocamb-style_bg#  " >#dva_motivocamb#</td>
            </tr>
            <tr>
                <td colspan="10" style="height:30px"></td>
            </tr>
            <tr>
                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;DATOS DE LA VIVIENDA ANTERIOR</td>
            </tr>
            <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Antigüedad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_antiguedad-style_bg#  " >#dva_antiguedad#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Zona:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_zona-style_bg#  " >#dva_zona#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Clase social:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_clasesocial-style_bg# " >#dva_clasesocial#</td>
            </tr>
            <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Vivienda:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_vivienda-style_bg# " >#dva_vivienda#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Inmueble:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_inmueble-style_bg# " >#dva_inmueble#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Formato de la vivienda:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format #dva_formatovivienda-style_bg# " >#dva_formatovivienda#</td>
            </tr>
            <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Niveles:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format  #dva_nivel-style_bg# " >#dva_nivel#</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Monto de la Renta o Valor del Inmueble:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format   #dva_montorentaovalor-style_bg# " >#dva_montorentaovalor#</td>
         
            </tr>
            <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Recámaras:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;" class="td_text_format  #dva_recamara-style_bg# " >#dva_recamara#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Baños:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold; ">
                  #dva_banio#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Sala:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_sala-style_td#">
                    #dva_sala#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Cocina:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_cocina-style_td#">
                    #dva_cocina#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Comedor:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_comedor-style_td#">
                    #dva_comedor#
                </td>

            </tr>
            <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Estudio:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_estudio-style_td#">
                    #dva_estudio#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">S./juegos:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_salajuego-style_td#">
                    #dva_salajuego#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Terraza:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_terraza-style_td#">
                    #dva_terraza#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">C/Lavado:</td>
                
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_cualavado-style_td#">
                    #dva_cualavado#
                </td>


                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">C/Servicio:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_cuaservicio-style_td#">
                    #dva_cuaservicio#
                </td>

            </tr>
            <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Garage:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_garage-style_td#">
                    #dva_garage#
                </td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Jardín</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_jardin-style_td#">
                    #dva_jardin#
                </td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Piscina:</td>

                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#dva_piscina-style_td#">
                    #dva_piscina#
                 </td>

                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10"></td>
            </tr>
          
           	
        </tbody>
        </table>';

    public $datosacademicos_datosmedicos_pagina_4='
    
        <!---------------------------------------------------------------------- PAGINA 4 --------------------------------------------------------------------------->
            

        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                    <td style="width:9.09%"></td>
                </tr>
                    <td colspan="9"></td>
                </tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DATOS ACADÉMICOS</td>
                </tr>
                <tr>
                    <td colspan="11" style="height:30px"></td>
                </tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;ESTUDIOS DEL CANDIDATO</td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight:bold">Nivel:</td>
                    <td colspan="2" style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold">Periodo</td>
                    <td colspan="1" style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight:bold">Promedio</td>
                    <td colspan="3" style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold">Institución</td>
                    <td colspan="2" style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight:bold">Entidad</td>
                    <td colspan="2" style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold">Documento recibido</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Primaria</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_primariaperiodo-style_bg#">#dae_primariaperiodo#</td>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_primariapromedio-style_bg# ">#dae_primariapromedio#</td>
                    <td colspan="3" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_primariaescuela-style_bg# "  >#dae_primariaescuela#</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_primariaentidad-style_bg# " >#dae_primariaentidad#</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_primariadocrecibido-style_bg# " >#dae_primariadocrecibido#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Secundaria</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_secundariaperiodo-style_bg# " >#dae_secundariaperiodo#</td>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_secundariapromedio-style_bg#" >#dae_secundariapromedio#</td>
                    <td colspan="3" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_secundariaescuela-style_bg#" >#dae_secundariaescuela#</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_secundariaentidad-style_bg#" >#dae_secundariaentidad#</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_secundariadocrecibido-style_bg#" >#dae_secundariadocrecibido#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">C. Técnica:</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_carreratecnicaperiodo-style_bg#  " >#dae_carreratecnicaperiodo#</td>
                    <td colspan="1" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_carreratecnicapromedio-style_bg# " >#dae_carreratecnicapromedio#</td>
                    <td colspan="3" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_carreratecnicaescuela-style_bg# " >#dae_carreratecnicaescuela#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_carreratecnicaentidad-style_bg# " >#dae_carreratecnicaentidad#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_carretecnicadocrecibido-style_bg# " >#dae_carretecnicadocrecibido#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10px;  padding:0px 0px 0px 45px; font-style: oblique;">En</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_carreratecnicaen-style_bg#  " >#dae_carreratecnicaen#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">M. Superior:</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_preparatoriaperiodo-style_bg# " >#dae_preparatoriaperiodo#</td>
                    <td colspan="1" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_preparatoriapromedio-style_bg# " >#dae_preparatoriapromedio#</td>
                    <td colspan="3" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_preparatoriaescuela-style_bg# " >#dae_preparatoriaescuela#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_preparatoriaentidad-style_bg# ">#dae_preparatoriaentidad#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_preparatoriadocrecibido-style_bg#  ">#dae_preparatoriadocrecibido#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10px;  padding:0px 0px 0px 45px; font-style: oblique;">En</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_preparatoriaen-style_bg#  " >#dae_preparatoriaen#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10; ">Lic. o Ing.:</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_licenciaturaperiodo-style_bg# ">#dae_licenciaturaperiodo#</td>
                    <td colspan="1" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_licenciaturapromedio-style_bg#" >#dae_licenciaturapromedio#</td>
                    <td colspan="3" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_licenciaturaescuela-style_bg# " >#dae_licenciaturaescuela#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_licenciaturaentidad-style_bg# " >#dae_licenciaturaentidad#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_licenciaturadocrecibido-style_bg# " >#dae_licenciaturadocrecibido#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10px;  padding:0px 0px 0px 45px; font-style: oblique;">En</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_licenciaturaen-style_bg# " >#dae_licenciaturaen#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Otras:</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_otroperiodo-style_bg#  " >#dae_otroperiodo#</td>
                    <td colspan="1" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #dae_otropromedio-style_bg#  " >#dae_otropromedio#</td>
                    <td colspan="3" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_otroescuela-style_bg# " >#dae_otroescuela#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_otroentidad-style_bg#  " >#dae_otroentidad#</td>
                    <td colspan="2" rowspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #dae_otrodocrecibido-style_bg#  " >#dae_otrodocrecibido#</td>
                </tr>
                <tr>
                    <td colspan="1" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10px;  padding:0px 0px 0px 45px; font-style: oblique;">En</td>
                    <td colspan="2" style="height:50px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;" class="td_text_format  #dae_otroen-style_bg#  " >#dae_otroen#</td>
                </tr>
                <tr>
                    <td style="height:25px" colspan="9"></td>
                </tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DATOS DE MÉDICOS (SALUD)
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Ha tenido intervenciones quirúrgicas?  <i> (Especifique cual)</i> </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #ess_intervencionquirurgicapreg-style_bg#  " >#ess_intervencionquirurgicapreg#</td>
                    <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #ess_intervencionquirurgica-style_bg#  " >#ess_intervencionquirurgica#</td>
                </tr>
                <tr>
                    <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Tuvo alguna incapacidad de trabajo el último año?</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ess_incapacidadultimoaniopreg-style_bg#  " >#ess_incapacidadultimoaniopreg#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Tipo:</td>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ess_incapacidadultimoanio-style_bg# " >#ess_incapacidadultimoanio#</td>
                </tr>
                <tr>
                    <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Tiene alguna enfermedad crónica familiar? <i>(Especifique cual) </i> </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ess_enfermedadcronicapreg-style_bg# " >#ess_enfermedadcronicapreg#</td>
                    <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ess_enfermedadcronica-style_bg# " >#ess_enfermedadcronica#</td>
                </tr>
                <tr>
                    <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Tienes algún familiar con alguna enfermedad crónica? <i> (Especifique parentesco y qué enfermedad) </i></td>
                    <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ess_famconenfermedadcronica-style_bg# " >#ess_famconenfermedadcronica#</td>
                    
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Datos físicos:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Estatura:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ess_estatura-style_bg# " >#ess_estatura#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">Peso:</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ess_peso-style_bg# " >#ess_peso#</td>
                    <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10"></td>
                </tr>
                <tr>
                    <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10px">En caso de accidente favor de llamar a:</td>
                    <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ess_avisar-style_bg# " >#ess_avisar#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10px">Teléfono:</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ess_telefono-style_bg# ">#ess_telefono#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Ingiere bebidas alcohólicas?</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ans_bebida-style_bg# " >#ans_bebida#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Ingiere algún tipo de droga?</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ans_droga-style_bg# " >#ans_droga#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10">¿Fuma?</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #ans_fumar-style_bg# " >#ans_fumar#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                
            </tbody>
        </table>
        ';

  

    public $datosfamiliares_pagina_5='
                        
        <!---------------------------------------------------------------------- PAGINA 5 --------------------------------------------------------------------------->

                <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                        <td style="width:9.09%"></td>
                    </tr>
                        <td colspan="9"></td>
                    </tr>
                    <tr>
                        <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;DATOS FAMILIARES</td>
                    </tr>
                    <tr>
                        <td colspan="11" style="height:20px"></td>
                    </tr>
                    <tr>
                        <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;FAMILIARES DIRECTOS CON LOS QUE VIVE</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Nombre</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Edad</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Parentesco</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Estudios</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Ocupación</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Puesto</td>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Empresa</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Teléfono</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Estatus</td>
                    </tr>
                #filas_familiares_viven#
                
                    <tr>
                        <td colspan="11" style="height:10px"></td>
                    </tr>
                    <tr>
                        <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;FAMILIARES DIRECTOS CON LOS QUE NO VIVE</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Nombre</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Edad</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Parentesco</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Estudios</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Ocupación</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Puesto</td>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Empresa</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Teléfono</td>
                        <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Estatus</td>
                    </tr>
                
                    #filas_familiares_no_vive#
                    <tr>
                        <td colspan="11" style="height:10px"></td>
                    </tr>
                    <tr>
                        <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;FAMILIARES QUE TRABAJAN EN LA COMPAÑÍA
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Nombre</td>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Parentesco</td>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Puesto</td>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Área</td>
                        <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Teléfono</td>
                    </tr>
                    #filas_familiares_trabajan_compania#


                    <tr>
                    <td colspan="11" style="height:10px"></td>
                </tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;FAMILIARES QUE TIENEN NEGOCIO (S) Y/O TRABAJAN EN EL GIRO FERRETERO

                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Nombre</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Parentesco</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Puesto</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold"> Nombre de negocio</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold">Teléfono</td>
                </tr>
                #filas_familiares_negocio#

            
            
                    <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
                
                    
                        </tbody>
            </table>
        ';



    public $documentospresentados_pagina_6='
        <!----------------------------------------------------------------------- PAGINA 6 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
            
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;COMENTARIOS DE DATOS FAMILIARES <span style="font-family:Calibri, sans-serif;font-size:12;font-style: italic">(Página 5)</span></td>
                </tr>
                <tr>
                    <td colspan="10" style="height:230px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; text-align: start; " class="td_text_format  #dgf_comentario-style_bg# ">#dgf_comentario#</td>
                </tr>
                </tr>
                <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                </tr>
                <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
                <tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DOCUMENTOS PRESENTADOS POR EL CANDIDATO</td>
                </tr>

                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="3" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Documento</td>
                    <td colspan="1" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Cantidad</td>
                    <td colspan="1" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Original</td>
                    <td colspan="1" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Copia</td>
                    <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Folio</td>
                    <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Comentarios</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Acta de Nacimiento(Candidato)</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_nacimientocantidad-style_bg# ">#cop_nacimientocantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_nacimientotipodoc-original-td#" class="td_text_format">
                        #cop_nacimientotipodoc-original#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold; #cop_nacimientotipodoc-copia-td#" class="td_text_format">
                        #cop_nacimientotipodoc-copia#

                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_nacimientofolio-style_bg# ">#cop_nacimientofolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format   #cop_nacimientocomentario-style_bg# ">#cop_nacimientocomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Acta de Nacimiento(Cónyuge)</td>
     
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_conyugecantidad-style_bg#">#cop_conyugecantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; #cop_conyugetipodoc-original-td# " class="td_text_format">
                        #cop_conyugetipodoc-original#
                    </td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; #cop_conyugetipodoc-copia-td# " class="td_text_format">
                        #cop_conyugetipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_conyugefolio-style_bg# ">#cop_conyugefolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format  #cop_conyugecomentario-style_bg# ">#cop_conyugecomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Acta de Nacimiento(Hijos)</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format   #cop_nacimientohijoscantidad-style_bg# ">#cop_nacimientohijoscantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_nacimientohijostipodoc-original-td#" class="td_text_format">
                        #cop_nacimientohijostipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_nacimientohijostipodoc-copia-td#" class="td_text_format">
                        #cop_nacimientohijostipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format  #cop_nacimientohijosfolio-style_bg#  ">#cop_nacimientohijosfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;  " class="td_text_format #cop_nacimientohijoscomentario-style_bg# ">#cop_nacimientohijoscomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Acta de Matrimonio</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_matrimoniocantidad-style_bg# ">#cop_matrimoniocantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; #cop_matrimoniotipodoc-original-td#" class="td_text_format">
                        #cop_matrimoniotipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_matrimoniotipodoc-copia-td#" class="td_text_format">
                        #cop_matrimoniotipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_matrimoniofolio-style_bg#  ">#cop_matrimoniofolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format  #cop_matrimoniocomentario-style_bg# ">#cop_matrimoniocomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">IFE-INE</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_credencialelectorcantidad-style_bg# ">#cop_credencialelectorcantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;#cop_credencialelectortipodoc-original-td#" class="td_text_format">
                        #cop_credencialelectortipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold; #cop_credencialelectortipodoc-copia-td#" class="td_text_format">
                        #cop_credencialelectortipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_credencialelectorfolio-style_bg#">#cop_credencialelectorfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_credencialelectorcomentario-style_bg# ">#cop_credencialelectorcomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">CURP</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_curpcantidad-style_bg# ">#cop_curpcantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_curptipodoc-original-td#" class="td_text_format">
                        #cop_curptipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_curptipodoc-copia-td#" class="td_text_format">
                        #cop_curptipodoc-copia#
                    </td>


                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format #cop_curpfolio-style_bg# ">#cop_curpfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format #cop_curpcomentario-style_bg# ">#cop_curpcomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">AFORE</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_aforecantidad-style_bg# ">#cop_aforecantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_aforetipodoc-original-td#" class="td_text_format">
                        #cop_aforetipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_aforetipodoc-copia-td#" class="td_text_format">
                        #cop_aforetipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format #cop_aforefolio-style_bg# ">#cop_aforefolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format #cop_aforecomentario-style_bg# ">#cop_aforecomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">RFC</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_rfccantidad-style_bg# ">#cop_rfccantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_rfctipodoc-original-td#" class="td_text_format">
                        #cop_rfctipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_rfctipodoc-copia-td#" class="td_text_format">
                        #cop_rfctipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align:start;" class="td_text_format #cop_rfcfolio-style_bg# ">#cop_rfcfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align:start;" class="td_text_format  #cop_rfccomentario-style_bg#  ">#cop_rfccomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Cartilla Militar</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_cartillacantidad-style_bg#  ">#cop_cartillacantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;#cop_cartillatipodoc-original-td#" class="td_text_format">
                        #cop_cartillatipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_cartillatipodoc-copia-td#" class="td_text_format">
                        #cop_cartillatipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align:start;" class="td_text_format #cop_cartillafolio-style_bg# " >#cop_cartillafolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align:start;" class="td_text_format #cop_cartillacomentario-style_bg# " >#cop_cartillacomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Pasaporte</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_pasaportecantidad-style_bg# ">#cop_pasaportecantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_pasaportetipodoc-original-td#" class="td_text_format">
                        #cop_pasaportetipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_pasaportetipodoc-copia-td#" class="td_text_format">
                        #cop_pasaportetipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format #cop_pasaportefolio-style_bg# " >#cop_pasaportefolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format #cop_pasaportecomentario-style_bg# ">#cop_pasaportecomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">VISA</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_visacantidad-style_bg# ">#cop_visacantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_visatipodoc-original-td#" class="td_text_format">
                        #cop_visatipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_visatipodoc-copia-td#" class="td_text_format">
                        #cop_visatipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format  #cop_visafolio-style_bg#  ">#cop_visafolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format  #cop_visacomentario-style_bg# ">#cop_visacomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Licencia de Manejo</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_licenciacantidad-style_bg# ">#cop_licenciacantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_licenciatipodoc-original-td#" class="td_text_format">
                        #cop_licenciatipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_licenciatipodoc-copia-td#" class="td_text_format">
                        #cop_licenciatipodoc-copia#
                    </td>
                    
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format  #cop_licenciafolio-style_bg#">#cop_licenciafolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format  #cop_licenciacomentario-style_bg# ">#cop_licenciacomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold">Comprobante de Domicilio</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_comprobantedomiciliocantidad-style_bg# ">#cop_comprobantedomiciliocantidad#</td>
                    

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_comprobantedomiciliotipodoc-original-td#" class="td_text_format">
                        #cop_comprobantedomiciliotipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_comprobantedomiciliotipodoc-copia-td#" class="td_text_format">
                        #cop_comprobantedomiciliotipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format  #cop_comprobantedomiciliofolio-style_bg# ">#cop_comprobantedomiciliofolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start;" class="td_text_format  #cop_comprobantedomiciliocomentario-style_bg# ">#cop_comprobantedomiciliocomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Comprobante del IMSS</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_imsscantidad-style_bg# ">#cop_imsscantidad#</td>
                    
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_imsstipodoc-original-td#" class="td_text_format">
                        #cop_imsstipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;#cop_imsstipodoc-copia-td#" class="td_text_format">
                        #cop_imsstipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format #cop_imssfolio-style_bg# ">#cop_imssfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start; " class="td_text_format #cop_imsscomentario-style_bg# ">#cop_imsscomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Último comprobante de estudios</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_imsscantidad-style_bg# ">#cop_ultimosestudioscantidad#</td>
                    
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_ultimosestudiostipodoc-original-td#" class="td_text_format">
                        #cop_ultimosestudiostipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold; #cop_ultimosestudiostipodoc-copia-td#" class="td_text_format">
                        #cop_ultimosestudiostipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start;" class="td_text_format #cop_ultimosestudiosfolio-style_bg# ">#cop_ultimosestudiosfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; text-align: start;" class="td_text_format #cop_ultimosestudioscomentario-style_bg# ">#cop_ultimosestudioscomentario#</td>
                </tr>
                
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Cedula Profesional</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_cedulaprofesionalcantidad-style_bg# ">#cop_cedulaprofesionalcantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_cedulaprofesionaltipodoc-original-td# " class="td_text_format">
                        #cop_cedulaprofesionaltipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; #cop_cedulaprofesionaltipodoc-copia-td# " class="td_text_format">
                        #cop_cedulaprofesionaltipodoc-copia#
                    </td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format #cop_cedulaprofesionalfolio-style_bg#  ">#cop_cedulaprofesionalfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format #cop_cedulaprofesionalcomentario-style_bg# ">#cop_cedulaprofesionalcomentario#</td>
                </tr>
                
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Recibos de Nómina</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_recibosnominacantidad-style_bg#  " >#cop_recibosnominacantidad#</td>
                    
                    
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold; #cop_recibosnominatipodoc-original-td#" class="td_text_format">
                        #cop_recibosnominatipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;  #cop_recibosnominatipodoc-copia-td#" class="td_text_format">
                        #cop_recibosnominatipodoc-copia#
                    </td>
                    
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_recibosnominafolio-style_bg# ">#cop_recibosnominafolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; "  class="td_text_format #cop_recibosnominacomentario-style_bg# ">#cop_recibosnominacomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Seguros de Gastos M. M.</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_segurosgastommcantidad-style_bg# ">#cop_segurosgastommcantidad#</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;  #cop_segurosgastommtipodoc-original-td#" class="td_text_format">
                        #cop_segurosgastommtipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_segurosgastommtipodoc-copia-td#" class="td_text_format">
                        #cop_segurosgastommtipodoc-copia#
                    </td>
                    
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format  #cop_segurosgastommfolio-style_bg# ">#cop_segurosgastommfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format #cop_segurosgastommcomentario-style_bg#  ">#cop_segurosgastommcomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Cartas de Recomendación</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format #cop_recomendacionescantidad-style_bg# ">#cop_recomendacionescantidad#</td>
                    
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;  #cop_recomendacionestipodoc-original-td#" class="td_text_format">
                        #cop_recomendacionestipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_recomendacionestipodoc-copia-td#" class="td_text_format">
                        #cop_recomendacionestipodoc-copia#
                    </td>

                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format #cop_recomendacionesfolio-style_bg# ">#cop_recomendacionesfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format  #cop_recomendacionescomentario-style_bg#  ">#cop_recomendacionescomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Ingresos Adicionales</td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;" class="td_text_format  #cop_ingresosadicionalescantidad-style_bg#  ">#cop_ingresosadicionalescantidad#</td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;  #cop_ingresosadicionalestipodoc-original-td#" class="td_text_format">
                        #cop_ingresosadicionalestipodoc-original#
                    </td>

                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold; #cop_ingresosadicionalestipodoc-copia-td#" class="td_text_format">
                        #cop_ingresosadicionalestipodoc-copia#
                    </td>
              
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start;" class="td_text_format  #cop_ingresosadicionalesfolio-style_bg# ">#cop_ingresosadicionalesfolio#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight: bold;  text-align: start; " class="td_text_format  #cop_ingresosadicionalescomentario-style_bg# ">#cop_ingresosadicionalescomentario#</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                    <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;font-weight: bold;"></td>
                </tr>
                
            
            </body>
        </table>
    
    ';

    public $datosfinacieros_ingreso_pagina_7='
        
        <!----------------------------------------------------------------------- PAGINA 7 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
            </tr>
         
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
            <tr>
            <tr>
                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;DATOS FINANCIEROS DEL CANDIDATO Y FAMILIARES DIRECTOS CON LOS QUE VIVE</td>
            </tr>
            </tr>
            <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
            <tr>
                <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;SITUACIÓN FINANCIERA DEL CANDIDATO</td>
            </tr>

            </tr>
            <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold;text-align:center">Ingresos del Candidato</td>
                <td colspan="1"></td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold;text-align:center">Gastos del Candidato</td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Sueldo:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; " class="td_text_format #sie_sueldoingreso-style_td#"   > 
              
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">#sie_sueldoingreso#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Alimentos:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_alimentacion-style_bg#"  align="right" >
                                        
                        <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                            <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">#sie_alimentacion#</td>
                                
                                </tr>
                            </tbody>
                        </table>

                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Otros ingresos 
                <span style="font-weight:bold">&#160; &#160; &#8595;</span></td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">----------------------------</td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Ropa y Calzado:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_ropacalzado-style_bg#" align="right" >
                
                                   
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">#sie_ropacalzado#</td>
                            
                            </tr>
                        </tbody>
                    </table>
                
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_concepto-0-style_bg#" align="left" > #sei_concepto-0# </td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_aportacion-0-style_bg#"  align="right" >
               
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">#sei_aportacion-0# </td>
                            
                            </tr>
                        </tbody>
                    </table>
                
                </td>		
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Servicios: 
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(Agua, Luz, Teléfono, etc.)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_serviciodomestico-style_bg#"  align="right" >
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                            <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_serviciodomestico#</td>
                                
                                </tr>
                            </tbody>
                    </table>
                    
               
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_concepto-1-style_bg#" align="left" >
                #sei_concepto-1#
                </td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_aportacion-1-style_bg#" align="right" >
                
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                    <tr style=" padding:0px ; margin:0px; ">
                                        <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                        <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sei_aportacion-1#</td>
                                    
                                    </tr>
                                </tbody>
                    </table>
                </td>		
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Colegiaturas:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_escolares-style_bg#" align="right" >
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_escolares#</td>
                            
                            </tr>
                        </tbody>
                </table>
                </td>
            </tr>
            <tr>
            <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_concepto-2-style_bg#" align="left" >#sei_concepto-2#</td>
            <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_aportacion-2-style_bg# " align="right" >
            <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                <tbody style=" padding:0px ; margin:0px; "> 
                    <tr style=" padding:0px ; margin:0px; ">
                        <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                        <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">   #sei_aportacion-2#</td>
                    
                    </tr>
                </tbody>
            </table>
          
            

            </td>	
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Créditos: 
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(TDC, Préstamos, Automóvil, etc.)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_creditos-style_bg# " align="right" >
             
                
                        <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                    <tr style=" padding:0px ; margin:0px; ">
                                        <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                        <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">   #sie_creditos#</td>
                                    
                                    </tr>
                                </tbody>
                        </table>

                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_concepto-3-style_bg# "  align="left" >#sei_concepto-3#</td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sei_aportacion-3-style_bg#" align="right" >
                
               
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">   #sei_aportacion-3#</td>
                            
                            </tr>
                        </tbody>
                </table>
                        
                </td>	
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Seguros: 
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(Vida, Auto, GMM, etc.)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_seguros-style_bg#"  align="right" >
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">   #sie_seguros#</td>
                            
                            </tr>
                        </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_concepto-4-style_bg# " align="left" >
                #sei_concepto-4#
                
                </td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_aportacion-4-style_bg#" align="right" >
               
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right">   #sei_aportacion-4#</td>
                            
                            </tr>
                        </tbody>
                </table>
                
                </td>	
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Hipotecas:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sie_hipoteca-style_bg# "  align="right" >
                
               
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_hipoteca#</td>
                            
                            </tr>
                        </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
            <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_concepto-5-style_bg#"  align="left">#sei_concepto-5#</td>
            <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sei_aportacion-5-style_bg# " align="right" >
            
                
            
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sei_aportacion-5#</td>
                            
                            </tr>
                        </tbody>
                </table>



            </td>	
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Diversión:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_diversiones-style_bg#" align="right" >
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_diversiones#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12px;text-align:right;font-weight:bold">TOTAL:</td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sie_totalingresos-style_bg#" align="right" >
                
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_totalingresos#</td>
                        
                        </tr>
                    </tbody>
                </table>


                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Mascotas:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_mascotas-style_bg# "  align="right">
                  
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_mascotas#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Ahorros:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sie_ahorros-style_bg# " align="right" >
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_ahorros#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Renta:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_renta-style_bg#" align="right" >
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_renta#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_otrosconcepto-style_bg#" > #sie_otrosconcepto# </td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sie_otros-style_bg#" align="right" >
                
                
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_otros#</td>
                        
                        </tr>
                    </tbody>
                </table>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12px;text-align:right;font-weight:bold">TOTAL:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sie_totalegresos-style_bg#" align="right" >
                

                  <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sie_totalegresos#</td>
                            
                            </tr>
                        </tbody>
                  </table>
                
                
                </td>
            </tr>
                    <tr><td style="height:20px border: 1px solid #FF6600;"></td></tr>
            <tr>
            <tr>
                <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;SITUACIÓN FINANCIERA FAMILIAR</td>
            </tr>

            </tr>
            <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold;text-align:center">INGRESOS FAMILIARES</td>
                <td colspan="1"></td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;font-weight: bold;text-align:center">Gastos del Candidato</td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Cónyuge:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format"   >
                
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10% ;  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style=" width:90%  padding:0px ; margin:0px;" align ="right"> #sef_conyugeingreso#</td>
                            
                            </tr>
                        </tbody>
                </table>
        
                    
                
                
                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Alimentos:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_alimentacion-style_bg#" align="right" >
                 
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_alimentacion#</td>
                            
                            </tr>
                        </tbody>
                </table>
        
              
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Hijos
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(Mayores de edad)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_hijosadultosingreso-style_bg#"  align="right">
                


                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_hijosadultosingreso#</td>
                            
                            </tr>
                        </tbody>
                </table>
                
                
                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Ropa y Calzado:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_ropacalzado-style_bg#" align="right" >
                
    
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_ropacalzado#</td>
                            
                            </tr>
                        </tbody>
                 </table>
        



                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Hijos
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(Menores de edad)</span></td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_hijosmenoresingreso-style_bg#"  align="right" >
                
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_hijosmenoresingreso#</td>
                            
                            </tr>
                        </tbody>
                </table>
                
                
                </td>		
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Servicios: 
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(Agua, Luz, Teléfono, etc.)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_serviciodomestico-style_bg#" align="right" >
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                        <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_serviciodomestico#</td>
                            
                            </tr>
                        </tbody>
                </table>
        
        
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Padres:</td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_padresingreso-style_bg#"  align="right">
                
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                <tbody style=" padding:0px ; margin:0px; "> 
                    <tr style=" padding:0px ; margin:0px; ">
                        <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                        <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_padresingreso#</td>
                    
                    </tr>
                </tbody>
                </table>


                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Colegiaturas:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_escolares-style_bg#"  align="right">
                

                
                  
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                    <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_escolares#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Hermanos:</td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_hermanosingreso-style_bg#" align="right" >
                

                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_hermanosingreso#</td>
                        
                        </tr>
                    </tbody>
                </table>
            
                
                </td>		
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Créditos: 
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(TDC, Préstamos, Automóvil, etc.)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_creditos-style_bg#" align="right" >
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_creditos#</td>
                        
                        </tr>
                    </tbody>
                </table>


                
                
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Otros ingresos 
                <span style="font-weight:bold">&#160; &#160; &#8595;</span></td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">----------------------------</td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;">Seguros: 
                <span style="font-family:Calibri, sans-serif;font-size:8;font-style:italic">(Vida, Auto, GMM, etc.)</span></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_seguros-style_bg#" align="right" >
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                     <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_seguros#</td>
                        
                        </tr>
                    </tbody>
                </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_sei_parentesco-0-style_bg#" align="left" >#sef_sei_parentesco-0#</td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format"  align="right">
          


                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px; ">
                        <tbody style=" padding:0px ; margin:0px; "> 
                        <tr style=" padding:0px ; margin:0px; ">
                            <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                            <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_sei_aportacion-0#</td>
                        
                        </tr>
                    </tbody>
                </table>

                
                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Hipotecas:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_hipotecas-style_bg#" align="right" >
                
                
                     <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px; ">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_hipotecas#</td>
                                
                                </tr>
                            </tbody>
                    </table>
                
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_sei_parentesco-1-style_bg#" align="left">#sef_sei_parentesco-1#</td>
                 <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_sei_aportacion-1-style_bg#"  align="right" >
                 
              
                 
                 <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_sei_aportacion-1#</td>
                                
                                </tr>
                            </tbody>
                    </table>
                 
                 
                 </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Diversión:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_diversiones-style_bg#" align="right" >
                
          
                 <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_diversiones#</td>
                                
                                </tr>
                            </tbody>
                    </table>
                
                
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12px;text-align:right;font-weight:bold">TOTAL:</td>
                <td colspan="2" style="text-align:center;height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_totalingresos-style_bg#" align="right"  >
                
                
                
                
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_totalingresos#</td>
                                
                                </tr>
                            </tbody>
                    </table>
                
                </td>
                <td colspan="1" style="height:20px;font-family:Calibri, sans-serif;font-size:11"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Mascotas:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_mascotas-style_bg#"  align="right">
                
                
                    <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                <tbody style=" padding:0px ; margin:0px; "> 
                                <tr style=" padding:0px ; margin:0px; ">
                                    <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                    <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_mascotas#</td>
                                
                                </tr>
                            </tbody>
                    </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Ahorros:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format  #sef_ahorro-style_bg#" align="right">
                
                
                        <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                                    <tbody style=" padding:0px ; margin:0px; "> 
                                    <tr style=" padding:0px ; margin:0px; ">
                                        <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                        <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_ahorro#</td>
                                    
                                    </tr>
                                </tbody>
                        </table>
                
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11">Renta:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_renta-style_bg#"  align="right" >
                
                
                
                   <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                            <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_renta#</td>
                            
                            </tr>
                        </tbody>
                    </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format"   align="left">#sef_otrosconcepto#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_otros-style_bg#" align="right">
                
                
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                            <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_otros#</td>
                            
                            </tr>
                        </tbody>
                 </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12px;text-align:right;font-weight:bold">TOTAL:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" class="td_text_format #sef_totalegresos-style_bg#" align="right" >
                
                <table cellspacing="0" style=" width:100% ; border-collapse: collapse; padding:0px ; margin:0px;">
                            <tbody style=" padding:0px ; margin:0px; "> 
                            <tr style=" padding:0px ; margin:0px; ">
                                <td  class="td_text_format" style="width:10%  padding:0px ; margin:0px; " align ="left">$</td>
                                <td   class="td_text_format" style="width:90%  padding:0px ; margin:0px;" align ="right"> #sef_totalegresos#</td>
                            
                            </tr>
                        </tbody>
                 </table>

                
                        
                
                </td>
            </tr>
            <tr><td style="height:20px border: 1px solid #FF6600;"></td></tr>
            <tr>
                <td colspan="3" style="height:140px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">¿Cuándo los gastos son mayores a los ingresos, ¿Cómo los solventa el Candidato?</td>
                <td colspan="7" style="height:140px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:9;  text-align: start;" class="td_text_format" >#sie_solventa#</td>
            </tr>
            <tr><td style="height:10px border: 1px solid #FF6600;"></td></tr>
   
            </body>
        </table>
    
    ';




    public $afilacionespropiedades_pagina_8='
        <!----------------------------------------------------------------------- PAGINA 8 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
        <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
                
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;AFILIACIONES Y PROPIEDADES</td>
                </tr>
                <tr><td ></td></tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;AFILIACIONES Y RECREACIONES DEL CANDIDATO</td>
                </tr>
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">En sus tiempos libres generalmente usted hace:</td>
                <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8" class="td_text_format_left #ans_tiempolibre-style_bg# ">#ans_tiempolibre#</td>
                </tr>
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">¿Pertenece algún Club Social? (Especifique)</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8" class="td_text_format  #ans_clubsocial-style_bg#  ">#ans_clubsocial#</td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format_left  #ans_clubsocialnombre-style_bg#  ">#ans_clubsocialnombre#</td>
                </tr>
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">¿Práctica algún deporte? (Especifique)</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8" class="td_text_format  #ans_deportepractica-style_bg#  ">#ans_deportepractica#</td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format_left  #ans_deporte-style_bg#  ">#ans_deporte#</td>

                
                </tr>
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Frecuencia con la que lo práctica:</td>
                <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8" class="td_text_format  #ans_deportefrecuencia-style_bg#  ">#ans_deportefrecuencia#</td>
                </tr>
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Religión que profesa:</td>
                <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format_left  #ans_religion-style_bg#  ">#ans_religion#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;PROPIEDADES DEL CANDIDATO</td>
                </tr>
                <tr>
                    <td colspan="1">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                    <td colspan="1">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">BIENES INMUEBLES</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12; text-align:center; background-color:#color-bieninmueble#;" class="td_text_format">#bieninmueble#</td>
                <td></td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">AUTOMÓVILES</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12; text-align:center; background-color:#color-auto#; " class="td_text_format ">#auto#</td>
                <td></td>
                </tr>
                <tr>
                    <td colspan="1">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                    <td colspan="1">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd0#;font-family:Calibri, sans-serif;font-size:12;" >#bieninmuebletexto0#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bieninmueble0-style_bg#">#bieninmueble0#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12">#bienautotexto0#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bienauto0-style_bg#">#bienauto0#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd0#;font-family:Calibri, sans-serif;font-size:12">#valorinmuebletexto0#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #valorinmueble0-style_bg# ">#valorinmueble0#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12">#valorautotexto0#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #valorauto0-style_bg#">#valorauto0#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd0#;font-family:Calibri, sans-serif;font-size:12">#antiguedadinmuebletexto0#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #antiguedadinmueble0-style_bg# ">#antiguedadinmueble0#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12">#modeloautotexto0#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #antiguedadinmueble0-style_bg# ">#modeloauto0#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12">#marcaautotexto0#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd0#;font-family:Calibri, sans-serif;font-size:12;text-align:center #marcaauto0-style_bg#" class="td_text_format">#marcaauto0#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd1#;font-family:Calibri, sans-serif;font-size:12">#bieninmuebletexto1#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bieninmueble1-style_bg# ">#bieninmueble1#</td>
                    <td></td>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd1#;font-family:Calibri, sans-serif;font-size:12">#valorinmuebletexto1#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #valorinmueble1-style_bg# " >#valorinmueble1#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12">#bienautotexto1#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bienauto1-style_bg# ">#bienauto1#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd1#;font-family:Calibri, sans-serif;font-size:12">#antiguedadinmuebletexto1#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #antiguedadinmueble1-style_bg# ">#antiguedadinmueble1#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12">#valorautotexto1#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format   #valorauto1-style_bg# ">#valorauto1#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12">#modeloautotexto1#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #modeloauto1-style_bg# ">#modeloauto1#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd2#;font-family:Calibri, sans-serif;font-size:12">#bieninmuebletexto2#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bieninmueble2-style_bg# ">#bieninmueble2#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12">#marcaautotexto1#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd1#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #marcaauto1-style_bg# ">#marcaauto1#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd2#;font-family:Calibri, sans-serif;font-size:12">#valorinmuebletexto2#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #valorinmueble2-style_bg# " >#valorinmueble2#</td>
                    <td></td>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd2#;font-family:Calibri, sans-serif;font-size:12">#antiguedadinmuebletexto2#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #antiguedadinmueble2-style_bg# ">#antiguedadinmueble2#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12">#bienautotexto2#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bienauto2-style_bg# ">#bienauto2#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12">#valorautotexto2#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #valorauto2-style_bg#  "  >#valorauto2#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd3#;font-family:Calibri, sans-serif;font-size:12">#bieninmuebletexto3#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bieninmueble3-style_bg#  ">#bieninmueble3#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12">#modeloautotexto2#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #modeloauto2-style_bg# ">#modeloauto2#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd3#;font-family:Calibri, sans-serif;font-size:12">#valorinmuebletexto3#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #valorinmueble3-style_bg#  ">#valorinmueble3#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12">#marcaautotexto2#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd2#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #marcaauto2-style_bg# ">#marcaauto2#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd3#;font-family:Calibri, sans-serif;font-size:12">#antiguedadinmuebletexto3#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #antiguedadinmueble3-style_bg# ">#antiguedadinmueble3#</td>
                    <td></td>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12">#bienautotexto3#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #bienauto3-style_bg# ">#bienauto3#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd4#;font-family:Calibri, sans-serif;font-size:12">#bieninmuebletexto4#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #bieninmueble4-style_bg#  ">#bieninmueble4#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12;">#valorautotexto3#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #valorauto3-style_bg# " >#valorauto3#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd4#;font-family:Calibri, sans-serif;font-size:12">#valorinmuebletexto4#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #valorinmueble4-style_bg# ">#valorinmueble4#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12">#modeloautotexto3#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #modeloauto3-style_bg# ">#modeloauto3#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd4#;font-family:Calibri, sans-serif;font-size:12">#antiguedadinmuebletexto4#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #antiguedadinmueble4-style_bg#  ">#antiguedadinmueble4#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12">#marcaautotexto3#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd3#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #marcaauto3-style_bg# ">#marcaauto3#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                    <td colspan="1">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd5#;font-family:Calibri, sans-serif;font-size:12">#bieninmuebletexto5#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd5#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #bieninmueble5-style_bg#  ">#bieninmueble5#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12">#bienautotexto4#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #bienauto4-style_bg# ">#bienauto4#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bieninmuebletd5#;font-family:Calibri, sans-serif;font-size:12">#valorinmuebletexto5#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bieninmuebletd5#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #valorinmueble5-style_bg# ">#valorinmueble5#</td>
                    <td></td>
                    <td colspan="1" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12">#valorautotexto4#</td>
                    <td colspan="3" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format  #valorauto4-style_bg# ">#valorauto4#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd5#;font-family:Calibri, sans-serif;font-size:12">#antiguedadinmuebletexto5#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bieninmuebletd5#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #antiguedadinmueble5-style_bg# ">#antiguedadinmueble5#</td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12">#modeloautotexto4#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #modeloauto4-style_bg#  ">#modeloauto4#</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3"></td>
                    <td></td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12">#marcaautotexto4#</td>
                    <td colspan="2" style="height:20px;border: 1px solid #color-bienautotd4#;font-family:Calibri, sans-serif;font-size:12;text-align:center" class="td_text_format #marcaauto4-style_bg#  ">#marcaauto4#</td>
                    <td></td>
                </tr>
            
            </body>
        </table>
    ';

    public $referenciaslaborales_pagina_9_10='
        <!----------------------------------------------------------------------- PAGINA 9 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
            
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES 1</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Candidato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_nombrecandidato-0-style_bg#" >#rel_nombrecandidato-0#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Empresa:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoempresa-0-style_bg# " >#rel_candidatoempresa-0#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Giro:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoempresagiro-0-style_bg# " >#rel_candidatoempresagiro-0#</td>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Domicilio:</td>
                <td colspan="4"  style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatodomicilio-0-style_bg# ">#rel_candidatodomicilio-0#</td>
                </tr>
                <tr>
                <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format bg-gray " >-</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Teléfono:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatotelefono-0-style_bg#  " >#rel_candidatotelefono-0#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Periodo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_periodo-0-style_bg#  " >#rel_periodo-0#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Puesto:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatopuestoinicial-0-style_bg#" >#rel_candidatopuestoinicial-0#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Área:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoareaincial-0-style_bg# " >#rel_candidatoareaincial-0#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Jefe inmediato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatojefe-0-style_bg# " >#rel_candidatojefe-0#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Sueldo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatosueldoinicial-0-style_bg#  " >#rel_candidatosueldoinicial-0#</td>
                </tr>
                <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;background-color:white;">Motivo de separación:
                </td>

                </tr>
                <tr>
                <td colspan="10" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoseparacion-0-style_bg#" >#rel_candidatoseparacion-0#</td>

                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Demando a la empresa:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatodemanda-0-style_bg# " >#rel_candidatodemanda-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Es recomendable:</td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format   #rel_candidatorecomendable-0-style_bg#" >#rel_candidatorecomendable-0#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Comentarios</td>
                </tr>
                <tr>
                <td colspan="10" style="height:60px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; " class="td_text_format  #rel_notas-0-style_bg#">#rel_notas-0#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVALUACIÓN DEL CANDIDATO</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Desempeño:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. en equipo:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. de desiciones:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Honradez:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Adaptación:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_desempenio-0-style_bg# " >#rel_desempenio-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_trabajoenquipo-0-style_bg# " >#rel_trabajoenquipo-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_decisiones-0-style_bg# " >#rel_decisiones-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_honradez-0-style_bg#  " >#rel_honradez-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_adaptacion-0-style_bg#  " >#rel_adaptacion-0#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Calidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Iniciativa:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Puntualidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Responsable:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Apego a normas:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format   #rel_calidad-0-style_bg#  " >#rel_calidad-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_iniciativa-0-style_bg#  " >#rel_iniciativa-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_puntualidad-0-style_bg#  " >#rel_puntualidad-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_responsabilidad-0-style_bg#  " >#rel_responsabilidad-0#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_apegonormas-0-style_bg#  " >#rel_apegonormas-0#</td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con superiores:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_relacionessuperiores-0-style_bg#  " >#rel_relacionessuperiores-0#</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con compañeros:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_relacionescompanieros-0-style_bg#  " >#rel_relacionescompanieros-0#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES 2</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Candidato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_nombrecandidato-1-style_bg#  " >#rel_nombrecandidato-1#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Empresa:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoempresa-1-style_bg#  " >#rel_candidatoempresa-1#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Giro:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoempresagiro-1-style_bg#  " >#rel_candidatoempresagiro-1#</td>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Domicilio:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatodomicilio-1-style_bg#  " >#rel_candidatodomicilio-1#</td>
                </tr>
                <tr>
                <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;" class="td_text_format  bg-gray " >-</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Teléfono:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatotelefono-1-style_bg# " >#rel_candidatotelefono-1#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Periodo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_periodo-1-style_bg#  " >#rel_periodo-1#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Puesto:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatopuestoinicial-1-style_bg# " >#rel_candidatopuestoinicial-1#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Área:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoareaincial-1-style_bg# " >#rel_candidatoareaincial-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Jefe inmediato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_periodo-1-style_bg#  " >#rel_candidatojefe-1#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Sueldo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatosueldoinicial-1-style_bg# ">#rel_candidatosueldoinicial-1#</td>
                </tr>
                <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;background-color:white;">Motivo de separación:
                </td>

                </tr>
                <tr>
                <td colspan="10" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoseparacion-1-style_bg# " >#rel_candidatoseparacion-1#</td>

                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Demando a la empresa:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatodemanda-1-style_bg# " >#rel_candidatodemanda-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Es recomendable:</td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatorecomendable-1-style_bg#  " >#rel_candidatorecomendable-1#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Comentarios</td>
                </tr>
                <tr>
                <td colspan="10" style="height:60px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; text-align: start;" class="td_text_format  #rel_notas-1-style_bg# " >#rel_notas-1#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVALUACIÓN DEL CANDIDATO</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Desempeño:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. en equipo:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. de desiciones:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Honradez:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Adaptación:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_desempenio-1-style_bg# " >#rel_desempenio-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_trabajoenquipo-1-style_bg# " >#rel_trabajoenquipo-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_decisiones-1-style_bg# " >#rel_decisiones-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_honradez-1-style_bg# " >#rel_honradez-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_adaptacion-1-style_bg# " >#rel_adaptacion-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Calidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Iniciativa:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Puntualidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Responsable:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Apego a normas:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format   #rel_calidad-1-style_bg# " >#rel_calidad-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_iniciativa-1-style_bg# " >#rel_iniciativa-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_puntualidad-1-style_bg# " >#rel_puntualidad-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_responsabilidad-1-style_bg# " >#rel_responsabilidad-1#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_apegonormas-1-style_bg# " >#rel_apegonormas-1#</td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con superiores:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_relacionessuperiores-1-style_bg# " >#rel_relacionessuperiores-1#</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con compañeros:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_relacionescompanieros-1-style_bg# " >#rel_relacionescompanieros-1#</td>
                </tr>

                <tr><td style="height:20px style="border: 1px solid #FF6600;""></td></tr>
            
            </body>
        </table>

        <!----------------------------------------------------------------------- PAGINA 10 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
            
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES 3</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Candidato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_nombrecandidato-2-style_bg#  " >#rel_nombrecandidato-2#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Empresa:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoempresa-2-style_bg#  " >#rel_candidatoempresa-2#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Giro:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoempresagiro-2-style_bg#  " >#rel_candidatoempresagiro-2#</td>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Domicilio:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatodomicilio-2-style_bg#  " >#rel_candidatodomicilio-2#</td>
                </tr>
                <tr>
                <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;" class="td_text_format bg-gray " >-</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Teléfono:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatotelefono-2-style_bg#  " >#rel_candidatotelefono-2#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Periodo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_periodo-2-style_bg#" >#rel_periodo-2#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Puesto:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatopuestoinicial-2-style_bg# " >#rel_candidatopuestoinicial-2#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Área:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoareaincial-2-style_bg# " >#rel_candidatoareaincial-2#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Jefe inmediato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatojefe-2-style_bg# " >#rel_candidatojefe-2#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Sueldo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatosueldoinicial-2-style_bg#  " >#rel_candidatosueldoinicial-2#</td>
                </tr>
                <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;background-color:white;">Motivo de separación:
                </td>

                </tr>
                <tr>
                <td colspan="10" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoseparacion-2-style_bg# " >#rel_candidatoseparacion-2#</td>

                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Demando a la empresa:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatodemanda-2-style_bg# " >#rel_candidatodemanda-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Es recomendable:</td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatorecomendable-2-style_bg#  " >#rel_candidatorecomendable-2#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Comentarios</td>
                </tr>
                <tr>
                <td colspan="10" style="height:60px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; text-align: start;"  class="td_text_format  #rel_notas-2-style_bg#" >#rel_notas-2#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVALUACIÓN DEL CANDIDATO</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Desempeño:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. en equipo:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. de desiciones:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Honradez:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Adaptación:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_desempenio-2-style_bg#" >#rel_desempenio-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_trabajoenquipo-2-style_bg#"  >#rel_trabajoenquipo-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_decisiones-2-style_bg#"  >#rel_decisiones-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_honradez-2-style_bg#" >#rel_honradez-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_adaptacion-2-style_bg#"  >#rel_adaptacion-2#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Calidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Iniciativa:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Puntualidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Responsable:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Apego a normas:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_calidad-2-style_bg# " >#rel_calidad-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_iniciativa-2-style_bg# " >#rel_iniciativa-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_puntualidad-2-style_bg# ">#rel_puntualidad-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_responsabilidad-2-style_bg# " >#rel_responsabilidad-2#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_apegonormas-2-style_bg# " >#rel_apegonormas-2#</td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con superiores:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_relacionessuperiores-2-style_bg# " >#rel_relacionessuperiores-2#</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con compañeros:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_relacionescompanieros-2-style_bg# " >#rel_relacionescompanieros-2#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES 4</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Candidato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_nombrecandidato-3-style_bg# " >#rel_nombrecandidato-3#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Empresa:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoempresa-3-style_bg# " >#rel_candidatoempresa-3#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Giro:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoempresagiro-3-style_bg#  " >#rel_candidatoempresagiro-3#</td>
                <td colspan="1" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Domicilio:</td>
                <td colspan="4" style="height:25px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatodomicilio-3-style_bg#  " >#rel_candidatodomicilio-3#</td>
                </tr>
                <tr>
                <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;" class="td_text_format  bg-gray  " >-</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Teléfono:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;" class="td_text_format  #rel_candidatotelefono-3-style_bg#  " >#rel_candidatotelefono-3#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Periodo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_periodo-3-style_bg# " >#rel_periodo-3#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Puesto:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatopuestoinicial-3-style_bg#  " >#rel_candidatopuestoinicial-3#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Área:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatoareaincial-3-style_bg#  " >#rel_candidatoareaincial-3#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Jefe inmediato:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatojefe-3-style_bg# " >#rel_candidatojefe-3#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Sueldo:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatosueldoinicial-3-style_bg# " >#rel_candidatosueldoinicial-3#</td>
                </tr>
                <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;background-color:white;">Motivo de separación:
                </td>

                </tr>
                <tr>
                <td colspan="10" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatoseparacion-3-style_bg# " >#rel_candidatoseparacion-3#</td>

                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center" >Demando a la empresa:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rel_candidatodemanda-3-style_bg# " >#rel_candidatodemanda-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center">Es recomendable:</td>
                <td colspan="5" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_candidatorecomendable-3-style_bg# " >#rel_candidatorecomendable-3#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Comentarios</td>
                </tr>
                <tr>
                <td colspan="10" style="height:60px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; text-align: start;" class="td_text_format  #rel_notas-3-style_bg# " >#rel_notas-3#</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVALUACIÓN DEL CANDIDATO</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Desempeño:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. en equipo:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">T. de desiciones:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Honradez:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Adaptación:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_notas-3-style_bg# " >#rel_desempenio-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_notas-3-style_bg# " >#rel_trabajoenquipo-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_notas-3-style_bg# " >#rel_decisiones-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_notas-3-style_bg# " >#rel_honradez-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_notas-3-style_bg# " >#rel_adaptacion-3#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Calidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Iniciativa:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Puntualidad:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Responsable:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Apego a normas:</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_calidad-3-style_bg# " >#rel_calidad-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_iniciativa-3-style_bg# " >#rel_iniciativa-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_puntualidad-3-style_bg#" >#rel_puntualidad-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_responsabilidadrel_responsabilidad-3-style_bg# " >#rel_responsabilidad-3#</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rel_apegonormas-3-style_bg# " >#rel_apegonormas-3#</td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con superiores:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;" class="td_text_format #rel_relacionessuperiores-3-style_bg# " >#rel_relacionessuperiores-3#</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;">Relación con compañeros:</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;" class="td_text_format #rel_relacionescompanieros-3-style_bg# " >#rel_relacionescompanieros-3#</td>
                </tr>
                <tr><td style="height:2px border: 1px solid #FF6600;"></td></tr>

            </body>
        </table>

    
    ';

    public $referenciaslaborales_pagina_11='
        <!----------------------------------------------------------------------- PAGINA 11 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
            
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;REFERENCIAS LABORALES</td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRAYECTORIA LABORAL DEL CANDIDATO</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Empresa(Marca)</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Empresa(Contratante)</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Periodo</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Observaciones</td>
                </tr>
                #filas_dinamicas_trayectorialaboral#
                <tr>
                <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;"></td>
                <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;";></td>
                <td colspan="2" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;"></td>
                <td colspan="4" style="height:40px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;"></td>
                </tr>

                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRAYECTORIA LABORAL (Empresas registradas en IMSS e Infonavit)</td>
                </tr>
                <tr>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Empresa</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Informada</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12;text-align:center;font-weight:bold">Observaciones</td>
                </tr>
                #filas_dinamicas_trayectorialaboralregistradodetalles#

                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿El candidato reconoce haber laborado en el listado de empresas que aparecen en infonavit?)</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class=" td_text_format #tlr_reconocehabeestado-style_bg#" >#tlr_reconocehabeestado#</td>
                </tr>
                        <tr>
                <td colspan="6" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">menciona las empresas que no reconoce el candidato:	</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class=" td_text_format #tlr_empresasnoreconoce-style_bg#" >#tlr_empresasnoreconoce#</td>
                </tr>
                        <tr>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Los datos proporcionados por el candidato contenían teléfonos de contacto?</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class=" td_text_format #tlr_datocandidatocontienetelcontacto-style_bg#" >#tlr_datocandidatocontienetelcontacto#</td>
                </tr>
                        <tr>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Los datos proporcionados por el candidato contenían nombres de contacto?</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format  #tlr_datocandidatocontienenombrescontacto-style_bg#" >#tlr_datocandidatocontienenombrescontacto#</td>
                </tr>
                        <tr>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Las fechas proporcionadas por el candidato coinciden con las obtenidas?	</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #tlr_coincidefechacandadidatoobtenida-style_bg#" >#tlr_coincidefechacandadidatoobtenida#</td>
                </tr>
                        <tr>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Los datos proporcionados por el candidato coinciden con lo investigado?	</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class=" td_text_format  #tlr_coincidedatoscandidadtoinvestigador-style_bg# ">#tlr_coincidedatoscandidadtoinvestigador#</td>
                </tr>
                        <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
            
            </body>
        </table>
    ';

    public $datosreferencia_pagina_12='
        <!----------------------------------------------------------------------- PAGINA 12 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>

                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DATOS DE REFERENCIAS</td>
                </tr>
                <tr><td style="height:5px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS VECINALES</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">CONCEPTO</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">REFERENTE 1</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">REFERENTE 2</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Nombre:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format   #rev_nombre-0-style_bg#  " >#rev_nombre-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rev_nombre-1-style_bg#  " >#rev_nombre-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Edad:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_edad-0-style_bg# " >#rev_edad-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_edad-1-style_bg# " >#rev_edad-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Teléfono:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_telefono-0-style_bg# " >#rev_telefono-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_telefono-1-style_bg# " >#rev_telefono-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Dirección:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_domicilio-0-style_bg#" >#rev_domicilio-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_domicilio-1-style_bg# " >#rev_domicilio-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Tiempo de conocerle:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_tiempo-0-style_bg# " >#rev_tiempo-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_tiempo-1-style_bg# " >#rev_tiempo-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Como lo conoció:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format t #rev_comoloconocio-0-style_bg# " >#rev_comoloconocio-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format t #rev_comoloconocio-1-style_bg# " >#rev_comoloconocio-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce su domicilio:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format t #rev_conocesudomicilio-0-style_bg#" >#rev_conocesudomicilio-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format t #rev_conocesudomicilio-1-style_bg#" >#rev_conocesudomicilio-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce su estado civil:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_conocesuestadocivil-0-style_bg#" >#rev_conocesuestadocivil-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_conocesuestadocivil-1-style_bg# " >#rev_conocesuestadocivil-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce su empleo:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_conocesuempleo-0-style_bg#" >#rev_conocesuempleo-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_conocesuempleo-1-style_bg# " >#rev_conocesuempleo-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Sabe sus pasatiempos:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rev_conocesupasatiempos-0-style_bg# " >#rev_conocesupasatiempos-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rev_conocesupasatiempos-1-style_bg# " >#rev_conocesupasatiempos-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Concepto de él o ella:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_conceptodeelella-0-style_bg# " >#rev_conceptodeelella-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_conceptodeelella-1-style_bg# " >#rev_conceptodeelella-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Lo recomienda:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rev_lorecomienda-0-style_bg# " >#rev_lorecomienda-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rev_lorecomienda-1-style_bg# " >#rev_lorecomienda-1#</td>
                </tr>	
                <tr>
                <td class="center" colspan="2" style="font-weight:bold;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10; height:60px; text-align:cernter;" text-rotate="" > Comentarios</td>
                <td colspan="8" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format" >#rev_notas-0# <br> #rev_notas-1#</td>
                </tr>	
            <tr><td style="height:5px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS PERSONALES</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">CONCEPTO</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">REFERENTE 1</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">REFERENTE 2</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Nombre del referente</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_nombre-0-style_bg# " >#rep_nombre-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_nombre-1-style_bg# " >#rep_nombre-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Edad</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_edad-0-style_bg#" >#rep_edad-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_edad-1-style_bg# " >#rep_edad-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Teléfono</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_telefono-0-style_bg# " >#rep_telefono-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_telefono-1-style_bg#" >#rep_telefono-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Dirección</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_direccioncompleta-0-style_bg# " >#rep_direccioncompleta-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_direccioncompleta-1-style_bg# " >#rep_direccioncompleta-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Ocupación´</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_ocupacion-0-style_bg# " >#rep_ocupacion-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_ocupacion-1-style_bg#" >#rep_ocupacion-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Empresa en la que trabaja</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_empresatrabaja-0-style_bg# " >#rep_empresatrabaja-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_empresatrabaja-1-style_bg# " >#rep_empresatrabaja-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Tiempo de conocerle</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_tiempo-0-style_bg# " >#rep_tiempo-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_tiempo-1-style_bg# " >#rep_tiempo-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Como lo conoció</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_comoloconocio-0-style_bg# " >#rep_comoloconocio-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_comoloconocio-1-style_bg# " >#rep_comoloconocio-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce su domicilio</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_conocesudomicilio-0-style_bg# " >#rep_conocesudomicilio-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_conocesudomicilio-1-style_bg# " >#rep_conocesudomicilio-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce su estado civil</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_estadocivil-0-style_bg#" >#rep_estadocivil-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_estadocivil-1-style_bg# " >#rep_estadocivil-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Sabe donde ah trabajado</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_conocedonhatrabajado-0-style_bg# " >#rep_conocedonhatrabajado-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_conocedonhatrabajado-1-style_bg# " >#rep_conocedonhatrabajado-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce sus pasatiempos</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rev_lorecomienda-0-style_bg# " >#rep_pasatiempos-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_pasatiempos-1-style_bg# " >#rep_pasatiempos-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Su concepto como persona es;</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_conceptocomopersona-0-style_bg#" >#rep_conceptocomopersona-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_conceptocomopersona-1-style_bg#" >#rep_conceptocomopersona-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Lo recomienda</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #rep_lorecomienda-0-style_bg#" >#rep_lorecomienda-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format  #rep_lorecomienda-1-style_bg# " >#rep_lorecomienda-1#</td>
                </tr>		
                <tr>
                <td class="center" colspan="2" style="font-weight:bold;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10; height:60px; text-align:cernter;" text-rotate="" > Comentarios</td>
                <td colspan="8" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format" >#rep_notas-0# <br> #rep_notas-1#</td>
                </tr>	
                <tr><td style="height:5px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="11" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIAS FAMILIARES</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">CONCEPTO</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">REFERENTE 1</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;font-weight:bold">REFERENTE 2</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Nombre:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_nombre-0-style_bg# " >#ref_nombre-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_nombre-1-style_bg# " >#ref_nombre-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Edad:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_edad-0-style_bg#  " >#ref_edad-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_edad-1-style_bg#  " >#ref_edad-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Tel:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_telefono-0-style_bg#  " >#ref_telefono-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_telefono-1-style_bg#  " >#ref_telefono-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Parentesco:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_parentesco-0-style_bg#  " >#ref_parentesco-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_parentesco-1-style_bg#  " >#ref_parentesco-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Ocupación:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_ocupacion-0-style_bg# " >#ref_ocupacion-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_ocupacion-1-style_bg#  " >#ref_ocupacion-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Direccion:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_direccion-0-style_bg#  " >#ref_direccion-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_direccion-1-style_bg#  " >#ref_direccion-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Conoce su empleo:</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_conocesuempleo-0-style_bg#  " >#ref_conocesuempleo-0#</td>
                <td colspan="4" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_conocesuempleo-1-style_bg#  " >#ref_conocesuempleo-1#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:14px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;">Lo recomienda:</td>
                <td colspan="4" style="height:14px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_lorecomienda-0-style_bg#  " >#ref_lorecomienda-0#</td>
                <td colspan="4" style="height:14px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format #ref_lorecomienda-1-style_bg#  " >#ref_lorecomienda-1#</td>
                </tr>
                <tr>
                <td class="center" colspan="2" style="font-weight:bold;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10; height:60px; text-align:cernter;" text-rotate="" > Comentarios</td>
                <td colspan="8" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;" class="td_text_format" >#ref_comentario-0# <br> #ref_comentario-1#</td>
                </tr>	
                </tr>
                        <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
            
            </body>
        </table>

    ';

    public $evaluaciontruper_pagina_13='
        <!----------------------------------------------------------------------- PAGINA 13 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
            
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;RESULTADOS DEL ESTUDIO</td>
                </tr>
                <tr><td style="height:5px style="border: 1px solid #FF6600;""></td></tr>
                <tr>
                    <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVALUACIÓN FINAL</td>
                </tr>
                <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">1.- ¿El entorno socioeconómico del candidato es acorde a su puesto y sueldo?	</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_entornosocioecoacorde-style_bg# " >#evt_entornosocioecoacorde#</td>
                </tr>
                        <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">2.- ¿La vivienda corresponde al entorno familiar que el candidato refiere?</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_vivendaacordeentornofam-style_bg# " >#evt_vivendaacordeentornofam#</td>
                </tr>
                        <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">3.- ¿La información que el candidato proporcionó coincide con lo observado en la visita?	</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_infovisitacoincide-style_bg# " >#evt_infovisitacoincide#</td>
                </tr>
                        <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">4.- ¿El candidato mostró buena actitud para proporcionar la información?	</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_candibuenactituinform-style_bg# " >#evt_candibuenactituinform#</td>
                </tr>
                        <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">5.- ¿La obtención de información se realizó dentro del domicilio del candidato?	</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_infodentrocasacandi-style_bg# " >#evt_infodentrocasacandi#</td>
                </tr>
                <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">6.- ¿El candidato proporcionó toda la información solicitada?	</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_canditodainfo-style_bg# " >#evt_canditodainfo#</td>
                </tr>
                <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">7.- ¿Se tuvo algún problema durante el proceso de agenda de la investigación?</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_problemaagendaentrevista-style_bg# " >#evt_problemaagendaentrevista#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Cuál?</td>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_problemaagendaentrevistacual-style_bg# " >#evt_problemaagendaentrevistacual#</td>
                </tr>
                <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">8.- ¿Se tuvo algún problema durante el proceso de visita al candidato?	</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format  #evt_problemavisita-style_bg# " >#evt_problemavisita#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Cuál?</td>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_problemavisitacual-style_bg# " >#evt_problemavisitacual#</td>
                </tr>
                <tr>
                <td colspan="8" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">9.- ¿Se tuvo algún problema durante el proceso de análisis de la información?</td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_problemaanlisisinfo-style_bg#  "  >#evt_problemaanlisisinfo#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">¿Cuál?</td>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;" class="td_text_format #evt_problemaanlisisinfocual-style_bg#  " >#evt_problemaanlisisinfocual#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12"></td>
                </tr>
                <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RESUMEN GENERAL</td>
                </tr>
                <tr>
                <td colspan="10" style="height:400px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:9;text-align:center;  text-align: start;" class="td_text_format #evt_resumen-style_bg#" >#evt_resumen#</td>
                </tr>
                                <tr><td style="height:10px style="border: 1px solid #FF6600;""></td></tr>
            
            </body>
        </table>
    ';


    public $datoscliente_pagina_14='
        <!----------------------------------------------------------------------- PAGINA 14 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
                <tr>
            
                <tr>
                <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="10" style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:14;background-color:#FF6600;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATOS DEL CLIENTE</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12"></td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Cliente:</td>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_cliente-nombre#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Domicilio:</td>
                <td colspan="9" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" ></td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Contacto:</td>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_cliente-contacto#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Puesto:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_cliente-puesto#</td>
                </tr>
                <tr>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Teléfono:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_cliente-telefono#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Ext.:</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_cliente-ext#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Correo:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_cliente-correo#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;DATOS DE LA EMPRESA INVESTIGADORA</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12"></td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Nombre o Razón Social:</td>
                <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_emp_investigadora-razonsocial#</td>
                </tr>
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Domicilio fiscal:</td>
                <td colspan="7" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_emp_investigadora-domiciliosical#</td>
                </tr>
                <tr>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Teléfono:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_emp_investigadora-telefono#</td>
                <td colspan="1" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12">Email:</td>
                <td colspan="4" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:10;text-align:center;background-color:#fff" class="td_text_format" >#ese_emp_investigadora-email#</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;FIRMA DEL RESPONSABLE DEL DESPACHO DE INVESTIGACIONES</td>
                </tr>
                <tr>
                <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="1"></td>
                <td colspan="6" style="height:180px;border: 1px solid #FF6600;font-size:12">
                    <table>
                        <tr style="width:100%">
                            <td colspan="1"></td>
                            <td colspan="4" style="width:100%;height:180px;font-size:12;text-align:center;">
                                <img  width="250px" class="_idGenObjectAttribute-1" src="images/#ese_emp_investigadora-firma#"  />
                            </td>
                        </tr>
                    </table>
                </td> 
                
                <td colspan="2" style="height:180px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:12; text-align:center;">
                
                    <img width="90px" class="_idGenObjectAttribute-1" src="temp/#qr#"  />
                    <br>
                    <span style="height:20px;font-size:9.5; font-weight: bold; font-family:"Monserrat",sans-serif;">
                        #folioqr#
                        <br> 
                        #fechaqr#
                    </span> 
                
                </td>
                <td colspan="1"></td>
                </tr>
                <tr>
                <td colspan="1"></td>
                <td colspan="6" style="height:20px; text-align:center; font-family:Calibri, sans-serif;font-size:12;text-align=center">NOMBRE Y FIRMA DEL RESPONSABLE</td>
                <td colspan="2" style="height:20px; ; text-align:center; font-family:Calibri, sans-serif;font-size:12;text-align=center">CÓDIGO QR</td>
                <td colspan="1"></td>
                </tr>
            
            </tbody>
        </table>

    ';


    public $anexos_pagina_15=' 
        <!----------------------------------------------------------------------- PAGINA 15 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
            
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                &nbsp;&nbsp;&nbsp;AVISO DE PRIVACIDAD</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#aviso_privacidad-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:30px;width:10%"> <img  style="#aviso_privacidad-style# height:700px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#aviso_privacidad-img#"  /></th>
                    <td colspan="4"></td>
                </tr>
                
            </tbody>
        </table>';


    public $anexos_pagina_16=' 
        <!----------------------------------------------------------------------- PAGINA 16 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                COMPROBANTE DE DOMICILIO Y  FOTOGRAFIA SELFIE									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#comprobantedomicilio-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#comprobantedomicilio-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#comprobantedomicilio-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


                <tr  class="#selfie-style_bg#">
                <td colspan="8"></td>
                <th colspan="4" style="text-align:center;height:200px;width:200px"> <img  style="#selfie-style# height:220px;width:220px"  class="_idGenObjectAttribute-1" src="archivos/#selfie-img#"  /></th>
                <td colspan="8"></td>

            
                </tr>
                
            </tbody>
        </table>';


    public $anexos_pagina_15_SEMANASCOTIZADASIMMS_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 15 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                SEMANAS COTIZADAS ANTE EL IMSS								

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#semanascotizadas-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#semanascotizadas-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#semanascotizadas-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


            

            
                </tr>
                
            </tbody>
        </table>';


    public $anexos_pagina_16_SITUACIONLEGAL_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 16 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                SITUACIÓN LEGAL									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#situacionlegal-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#situacionlegal-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#situacionlegal-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


                        
            </tbody>
        </table>';


    
    public $anexos_pagina_17_IDENTIFICACIONCURP_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 17 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                IDENTIFICACIÓN OFICIAL / CURP
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
            


                <tr class="#identificacion_oficial-style_bg# " style="margin:0; padding:0;">
                    <td colspan="4"  style="margin:0; padding:0;"></td>
                    <td colspan="12" style="text-align:center;height:380px;width:100%">
                    <img  style="#identificacion_oficial-style# height:380px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#identificacion_oficial-img#"  />
                    </td>
                    <td colspan="2"  style="margin:0; padding:0;"></td>
                
                </tr>


        

                <tr class="#curp-style_bg# " style="margin:0; padding:0;">
                    <td colspan="4"  style="margin:0; padding:0;"></td>
                    <td colspan="12" style="text-align:center;height:380px;width:100%">
                    <img  style="#curp-style# height:380px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#curp-img#"  />
                    </td>
                    <td colspan="2"  style="margin:0; padding:0;"></td>

            
                </tr>

                
            </tbody>
        </table>';


    public $anexos_pagina_18_ACTANACIMIENTO_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 18 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                ACTA DE NACIMIENTO 
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#actanacimiento-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#actanacimiento-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#actanacimiento-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


            
                
            </tbody>
        </table>';



    public $anexos_pagina_19_COMPROBANTEDOMICILIOCARTILLAMILITAR_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 19 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                COMPROBANTE DE DOMICILIO / CARTILLA MILITAR
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
            

                <tr class="#comprobantedomicilio-style_bg# " style="margin:0; padding:0;">
                    <td colspan="4"  style="margin:0; padding:0;"></td>
                    <td colspan="12" style="text-align:center;height:380px;width:100%">
                    <img  style="#comprobantedomicilio-style# height:380px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#comprobantedomicilio-img#"  />
                    </td>
                    <td colspan="2"  style="margin:0; padding:0;"></td>

                
                </tr>


        

                <tr class="#cartillamilitar-style_bg# " style="margin:0; padding:0;">
                    <td colspan="4"  style="margin:0; padding:0;"></td>
                    <td colspan="12" style="text-align:center;height:380px;width:100%">
                    <img  style="#cartillamilitar-style# height:380px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#cartillamilitar-img#"  />
                    </td>
                    <td colspan="2"  style="margin:0; padding:0;"></td>

            
                </tr>


                
            </tbody>
        </table>';


    public $anexos_pagina_20_CONSTANCIAESTUDIOS_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 20 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                CONSTANCIA DE ESTUDIOS
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#constanciadeestudios-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#constanciadeestudios-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#constanciadeestudios-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


            
                
            </tbody>
        </table>';


    public $anexos_pagina_21_CONSTANCIALABORALES_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 21 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                CONSTANCIAS LABORALES
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#constanciaslaborales-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#constanciaslaborales-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#constanciaslaborales-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


            
                
            </tbody>
        </table>';



    public $anexos_pagina_22_RFC_AFORE_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 22 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                RFC / AFORE
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#rfc-style_bg# " style="margin:0; padding:0;">
                    <td colspan="4"  style="margin:0; padding:0;"></td>
                    <td colspan="12" style="text-align:center;height:380px;width:100%">
                    <img  style="#rfc-style# height:380px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#rfc-img#"  />
                    </td>
                    <td colspan="2"  style="margin:0; padding:0;"></td>

                
                </tr>


        

                <tr class="#afore-style_bg# " style="margin:0; padding:0;">
                    <td colspan="4"  style="margin:0; padding:0;"></td>
                    <td colspan="12" style="text-align:center;height:380px;width:100%">
                    <img  style="#afore-style# height:380px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#afore-img#"  />
                    </td>
                    <td colspan="2"  style="margin:0; padding:0;"></td>

            
                </tr>
                
            </tbody>
        </table>';



    public $anexos_pagina_23_AVISO_PRIVACIDAD_ventas=' 
        <!----------------------------------------------------------------------- PAGINA 23 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                AVISO DE PRIVACIDAD
                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr class="#aviso_privacidad-style_bg#">
                    <td colspan="4"></td>
                    <th colspan="12" style="text-align:center;height:500px;width:100%">
                    <img  style="#aviso_privacidad-style# height:645px;width:100%"  class="_idGenObjectAttribute-1" src="archivos/#aviso_privacidad-img#"  />
                    </th>
                    <td colspan="2"></td>

                
                </tr>


                        
            </tbody>
        </table>';

    public $anexos_semanas_cotizadas_pdf=' 
        <!----------------------------------------------------------------------- PAGINA 16 VENTAS -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                SEMANAS COTIZADAS									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                


                        
            </tbody>
        </table>';

        public $anexos_adjuntados_reporte=' 
        <!----------------------------------------------------------------------- CATEGORIAS DE MANERA DINAMICA -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                #nombre_categoria_archivo#									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                
       
          
        
   
            <tr>
                <td  colspan="9" style="text-align:center; height: 260px;">
                    <img src="archivos/#archivo_0#"   height="9.5cm" width="9cm" />
                </td>
              
                <td  class=""  colspan="2" style="text-align:center;">
                </td>
                <td  class=""  colspan="9" style="text-align:center;">
                    <img src="archivos/#archivo_1#"  height="9.5cm" width="9cm" />
                </td>
            </tr>
            <tr>
            <td colspan="20" style="height:.5cm"></td>
            </tr>
            <tr>
                <td  class="#foto_interior_domicilio_img-style_bg#"   colspan="10"  style=" height: 260px; text-align:center;">
                    <img class="_idGenObjectAttribute-1" src="archivos/#archivo_2#" height="9.5cm" width="9cm" />
                </td>
                <td  class=""  colspan="2" style="text-align:center;">
                </td>
                <td class="#foto_fachada_vecino_img-style_bg#"   colspan="10" style=" height: 260px; text-align:center;">
                    <img class="_idGenObjectAttribute-1" src="archivos/#archivo_3#" height="9.5cm" width="9cm" />
                </td>
            </tr>

                        
            </tbody>
        </table>';


        public $anexos_adjuntados_reporte_3_img=' 
        <!----------------------------------------------------------------------- CATEGORIAS DE MANERA DINAMICA -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                #nombre_categoria_archivo#									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                
       
          
        
   
            <tr>
                <td  colspan="10" style="text-align:center; height: 260px;">
                    <img src="archivos/#archivo_0#"   height="9.5cm" width="9.5cm" />
                </td>
                <td  class=""  colspan="2" style="text-align:center;">
                </td>
                <td  class=""  colspan="10" style="text-align:center;">
                    <img src="archivos/#archivo_1#"  height="9.5cm" width="9.5cm" />
                </td>
            </tr>
            
            <tr>
            <td colspan="20" style="height:.5cm"></td>
            </tr>


            <tr>
                <td  class="#foto_interior_domicilio_img-style_bg#"   colspan="20"  style=" height: 260px; text-align:center;">
                    <img class="_idGenObjectAttribute-1" src="archivos/#archivo_2#"  height="10cm" width="10cm" />
                    </td>
                
            </tr>

                        
            </tbody>
        </table>';


        public $anexos_adjuntados_reporte_2_img=' 
        <!----------------------------------------------------------------------- CATEGORIAS DE MANERA DINAMICA -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                #nombre_categoria_archivo#									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                
       
          
        
   
            <tr>
                <td  colspan="20" style="text-align:center; height: 260px;">
                    <img src="archivos/#archivo_0#"   height="10cm" width="10cm" />
                </td>
              
            </tr>
            <tr>
            <td colspan="20" style="height:.5cm"></td>
            </tr>
            <tr>
                <td  class=""  colspan="20" style="text-align:center;">
                    <img src="archivos/#archivo_1#"  height="10cm" width="10cm" />
                </td>
            </tr>

                        
            </tbody>
        </table>';

        public $anexos_adjuntados_reporte_1_img=' 
        <!----------------------------------------------------------------------- CATEGORIAS DE MANERA DINAMICA -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
                
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                #nombre_categoria_archivo#									

                </td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                
       
          
        
   
            <tr>
                <td  colspan="20" style="text-align:center; height: 260px;">
                    <img src="archivos/#archivo_0#"   height="15cm" width="15cm" />
                </td>

            </tr>
         
            <tr>
               
              
            </tr>

                        
            </tbody>
        </table>';
    
    public $datospersonales_pagina_1_referencias=' 
        <style >
            .td_text_format { 
                font-size:9.5;   
                font-weight: bold; 
                color:blue;
                text-align: center;
                font-family:"Monserrat",sans-serif;
            }
            .td_text_format_without_center{
                font-size:12;   
                font-weight: bold; 
                color:blue;
            }

            .td_text_format_left { 
                font-size:12;   
                font-weight: bold; 
                color:blue;
            }
            .td_text_format_align_end { 
                font-size:12;   
                font-weight: bold; 
                color:blue;
                text-align: center;
            }
            .bg-white{
                background-color:white !important; 
            }
            .bg-gray{
                background-color:#D9D9D9 !important; 
            }
        
        </style>

        <!-- PAGINA 1 -->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                    <td style="width:10%"></td>
                </tr>
         
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;DATOS GENERALES</td>
                </tr>
                <tr>
                <th style="display:none;" colspan="2" rowspan="6" style="height:90%">
                
                
                
                </th>
                <td colspan="8" ></td>
                </tr>
                <tr>
                <td colspan="4" style="font-size:14px;background-color:black; text-align:center; font-family:Radio Stars,sans-serif; color:#00FFFF;font-weight: bold; height:14px;">R E S U L T A D O</td>
                <td></td>
                <td colspan="3" style="border: 1px solid #FF6600;background-color:#FF6600; text-align:center; font-family:Calibri, sans-serif;color:white;font-weight: bold;font-size:11px;">FECHAS</td>
                </tr>
                <tr>
                <th colspan="4" rowspan="3" style="font-size:20px; text-align:center; font-family:Calibri, sans-serif; #td_style-ese_calificacion#" >#ese_calificacion#</th>
                <td></td>
                <td style="border: 1px solid #FF6600;height:20px;text-align:center;font-family:Calibri, sans-serif;font-size:11px">Solicitud:</td>
                <td colspan="2" style="border: 1px solid #FF6600; border: 1px solid #FF6600;"  class="td_text_format" >#ese_solicitud#</td>
                <tr>
                </tr>
                <tr>
                <td ></td>
                <td style="text-align: center;border: 1px solid #FF6600;height:20px;font-family:Calibri, sans-serif;font-size:11px">Visita:</td>
                <td colspan="2" style="border: 1px solid #FF6600;"  class="td_text_format #ese_fechavisita-bg#" >#ese_fechavisita#</td>
                </tr>
                <tr>
                <td ></td>
                <td colspan="1" style="text-align: center;border: 1px solid #FF6600;height:20px;font-family:Calibri, sans-serif;font-size:11px">Entrega:</td>
                <td colspan="2" style="border: 1px solid #FF6600;"  class="td_text_format">#ese_fechaentregacliente#</td>
                </tr>
                <tr>
                <td colspan="8" style="width:20px"></td>
                </tr>
                <tr>
                    <td colspan="10" style="font-weight: bold;font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left">
                    &nbsp;&nbsp;&nbsp;DATOS GENERALES DEL CANDIDATO</t>
                </tr>
                <tr>
                    <td colspan="10" style="height:20px"></td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600; font-family:Calibri, sans-serif;font-size:11;height:25px" >&nbsp;&nbsp;Nombre:</td>
                    <td  style="border: 1px solid #FF6600;  " colspan="5" media="td_text_format"   class="td_text_format #ese_nombre-style_bg# " > #ese_nombre# </td>
                    <td  style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" colspan="2">Fecha de nacimiento:</td>
                    <td  style="border: 1px solid #FF6600; " colspan="2"  class="td_text_format   #ese_fechanacmiento-style_bg#">#ese_fechanacmiento#</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600; font-family:Calibri, sans-serif;font-size:11;height:25px">&nbsp;&nbsp;Edad:</td>
                    <td  style="border: 1px solid #FF6600;"  class="td_text_format" >#ese_edad#</td>
                    <td  style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;" >Edo. Civil:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="3" class="td_text_format">#ese_estadocivil#</td>
                    <td  style="text-align:center;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;"  >Área:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="3"  class="td_text_format #ese_area-style_bg# ">#ese_area#</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;height:25px" colspan="2">&nbsp;&nbsp;Puesto solicitado:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="8"  class="td_text_format #ese_puestpsolicitado-style_bg#  ">#ese_puestpsolicitado#</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;height:25px" colspan="2">&nbsp;&nbsp;Dirección actual:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="8"  class="td_text_format  #ese_direccion-style_bg#"  >#ese_direccion# </td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;font-size:8px; height:18px; text-align:center" colspan="10">Calle</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid #FF6600;"  class="td_text_format #ese_numext-style_bg# "  >#ese_numext#</td>
                    <td  style="border: 1px solid #FF6600;"   class="td_text_format  #ese_numint-style_bg# ">#ese_numint#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format  #ese_colonia-style_bg#  ">#ese_colonia#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format   #ese_municipio-style_bg#  ">#ese_municipio#</td>
                    <td  style="border: 1px solid #FF6600;"  colspan="2"  class="td_text_format   #ese_estado-style_bg# ">#ese_estado#</td>
                    <td  style="border: 1px solid #FF6600;"  class="td_text_format  #ese_codpostal-style_bg# " >#ese_codpostal#</td>
                    <td  style=" height:30px ;border: 1px solid #FF6600; font-size:9.5"  class="td_text_format  #ese_pais-style_bg#" >#ese_pais#</td>
                </tr>
                <tr style="border: 1px solid #FF6600">
                    <td  style="height:18px;text-align:center;font-size:7px;">No. Ext / Mza.</td>
                    <td  style="text-align:center;font-size:7px; "  >No. Int. / Lt</td>
                    <td  style="text-align:center;font-size:7px;" colspan="2" >Colonia</td>
                    <td  style="text-align:center;font-size:7px;" colspan="2" >Delegacion / Ciudad / Municipio</td>
                    <td  style="text-align:center;font-size:7px;" colspan="2" >Estado</td>
                    <td  style="text-align:center;font-size:7x;" >Código Postal</td>
                    <td  style="text-align:center;font-size:7px;" >País</td>
                </tr>
                <tr>
                    <td  style="height:30px;border: 1px solid #FF6600;" colspan="6"  class="td_text_format  #ese_entrecalles-style_bg#">#ese_entrecalles#</td>
                    <td  style="border: 1px solid #FF6600;" colspan="4"  class="td_text_format  #ese_referenciaubicacion-style_bg# ">#ese_referenciaubicacion#</td>
                </tr>
                    <tr>
                    <td  style="text-align:center;font-size:7px;" colspan="6">Entre que calles se encuentra el domicilio</td>
                    <td  style="text-align:center;font-size:7px;" colspan="4">Referencia de ubicación</td>
                </tr>
                <tr>
                    <td  style="text-align:center;height:30px;border: 1px solid #FF6600;font-size:12px">Teléfono:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format #ese_telefono-style_bg# ">#ese_telefono#</td>
                    <td  style="text-align:center;height:30px;border: 1px solid #FF6600;font-size:12px">Celular:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format    #ese_celular-style_bg# ">#ese_celular#</td>
                    <td  style="text-align:center;height:30px;border: 1px solid #FF6600;font-size:12px" colspan="2">Teléfono de recados:</td>
                    <td  style="border: 1px solid #FF6600;" colspan="2"  class="td_text_format  #ese_telefonorecado-style_bg# ">#ese_telefonorecado#</td>
                </tr>
                <tr>
                    <td colspan="10" style="height:40px"> </td>
                </tr>
                
            </tbody>
        </table>
    ';

    public $anexos_pagina_referencias=' 
        <!----------------------------------------------------------------------- PAGINA 15 -------------------------------------------------------------------------->
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                    <td style="width:5%"></td>
                </tr>
            
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:black;color:white;text-align:left;font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS</td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px"></td>
                </tr>
                <tr>
                <td colspan="20" style="height:20px; border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;">
                &nbsp;&nbsp;&nbsp;REFERENCIA LABORAL VÍA CORREO</td>
                </tr>
            </tbody>
        </table>';
}