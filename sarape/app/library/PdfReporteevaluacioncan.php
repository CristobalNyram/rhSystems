<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporteevaluacioncan extends Component
{
    public $logo_principal_ruta="";

    public $excheader="


        <table width='100%' style='border-spacing: 0;'>
             <tr >
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
                <td style='width:10%'></td>
            </tr>
            <tr>
                <td align='left'  colspan='3'>
                <img src='#logo#' height='25pt'  width='100pt' >

                </td>
           

                <td align='center' class='td-header-info' 
                style='
                background:#ffc407;
                color:white;
                font-weight:bold;
                border: 1px solid black;+
                border-right: none;
                margin:0; 
                padding:0; 
                text-align: center;
                '
                colspan='6'
                >
                    REPORTE DE EVALUACIÓN DEL CANDIDATO
                </td>
                
                <td align='center' 
                    style='
                    border: 1px solid black;
                    border-left: none;

                    background:#17375e;
                    color:white;
                    font-weight:bold; 
                    margin:0; 
                    padding:0; 

                '
                colspan='2'
                >
                    #anio_actual#
    
                    
                </td>
                
            </tr>
        </table> 
    ";
    public $excheader_old="
    <br>
    <br>

    <br>
    <table width='100%'>
        <tr >
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
            <td style='width:10%'></td>
        </tr>
        <tr>
            <td align='left'>
            <img src='assets/images/sistema/logo_documento.png' height='36pt' alt='' >
            </td>
       

            <td   
            style='
            border: 4px solid black;
            padding: 0px;
            margin: 0px;

            '>
               <table width='100%'
               style='
               padding: 0px;
               margin: 0px;
               '
               >
                    <tr 
                    style='
                    padding: 0px;
                    margin: 0px;
                    '
                    >
                    <td align='left' class='td-header-info' style='background:#eeb500;color:white;font-weight:bold;' >
                    REPORTE DE EVALUACIÓN DEL CANDIDATO
                    </td>
                    <td align='center' 
                    style='background:#17375e;color:white;font-weight:bold; 
                 
                    '>
                    2023
    
                    
                    </td>
                    </tr>
                </table> 
            </td>
        </tr>
    </table> 
";

    
    public $excfooter="
        <table width='100%'>
            <tr>
                <td align='center' class='footer' >
                OFICINA MATRIZ: CALLE PIAXTLA #6 2DO. PISO, COL. LA PAZ, C.P. 72160, PUEBLA, PUE. TELÉFONO (222) 296 65 85
                </td>
            </tr>
        </table> 
    ";
    
    public $eseheadersiguientes="
        <table width='100%'>
            <tr>
                <td align='left'>
                <img src='images/#logo#' height='34' alt=''>
                </td>
            </tr>
        </table> 
    ";

    // página uno
    public $head_style='
        <style>
        .text-information-personal{
            font-size:8pt;
            font-weight:bold;
        }
        .border-tabla{
            border:1px solid black;
            
        }
        .text-center{
            text-align: center;

        }
        .sides-border{
            border-right: 1px solid black;
            border-left: 1px solid black;
        }
        .bg-gray{
            background: #cdcdcd;
        }.bt-none{
            border-top: none;
        }
        .b-none{
            border: none;
        }
        .tableDatosValoracion tr td{
            font-size:8pt;
            font-weight:bold;
            letter-spacing: .1pt;

        }
        .text-aviso{
            font-size:7pt;
            font-weight:normal;
            letter-spacing: .1pt;
        }
        .mb-3{
            margin-bottom: 3pt;
        }
        .footer{
            font-size:8pt;
            font-weight:bold;
        }
        .tableDatos{
            border-bottom: 0;
        }
        </style>
    
    ';

    // página2 eses
    public $datospersonales=' 
    <br>

        <table style="border-collapse: collapse;font-family:Montserrat,sans-serif;  width:100%;" class="tableDatos">
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
                    <td class="text-information-personal"  colspan="1" >
                    EMPRESA  
                    </td>
                    <td class="text-information-personal"  colspan="4">
                        #empresa#
                    </td>
                    <td class="text-information-personal"  colspan="1" >
                    PUESTO  
                    </td>
                    <td class="text-information-personal"   colspan="4">
                    #vacante#
                    </td>
                </tr>
                <tr>
                    <td class="text-information-personal"   colspan="1" >
                    CANDIDATO  
                    </td>
                    <td  class="text-information-personal"   colspan="4">
                        #candidato#
                    </td>
                    <td class="text-information-personal"  colspan="2" >
                    FECHA DE ENTREVISTA  
                    </td>
                    <td class="text-information-personal"   colspan="4">
                    #fechadeentrevista#
                    </td>
                </tr>

                <tr>
                    <td class="text-information-personal"  colspan="1" >
                    EJECUTIVO  
                    </td>
                    <td class="text-information-personal"  colspan="9">
                        #ejecutivo#
                    </td>
                  
                </tr>
               
        </tbody>
        </table>
        <br>
        <br>

    ';

    public $tabla_valoracion_exp_lab='    
    <span class="text-aviso mb-3">
    VALORACIÓN: EN LA ESCALA DE 1 A 5 (1=INSUFICIENTE, 5=EXCELENTE Y N/A NO APLICABLE), VALORE LAS SIGUIENTES APTITUDES DEL CANDIDATO
    </span>
    <br>    
    
    <br>
        <table style="width:100%; ">
                <tbody>
                    <tr class="">
                        <td style="width:10%"></td>
                        <td style="width:80%"></td>
                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td colspan="1"> </td>
                        <td colspan="1">
                        
                        <table style="border-collapse: collapse;font-family:Montserrat,sans-serif; border-bottom:0; border-left:0;border-right:0;width:100%; " class="tableDatosValoracion border-tabla ">
                                    <tbody>
                                        <tr class="bg-gray">
                                        <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                        <td style="width:5%"></td>
                                        <td style="width:5.5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                        <td style="width:5.5%"></td>
                                        <td style="width:2.2%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                        <td style="width:2.2%"></td>
                                        <td style="width:2.2%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                        <td style="width:2.2%"></td>
                                        <td style="width:8%; background:red;" style=" border:1px solid black; border-bottom:0; border-right:0;"></td>
                                        <td style="width:2%" style=" border:1px solid black; border-bottom:0; border-left:0; "></td>
                                        </tr>
                                        <tr  class="tableDatos border-tabla bg-gray bt-none" >
                                            <td colspan="8" >EXPERIENCIA LABORAL </td>
                                            <td colspan="2" class="text-center sides-border" >1</td>
                                            <td colspan="2" class="text-center sides-border" >2</td>
                                            <td colspan="2" class=" text-center sides-border" >3</td>
                                            <td colspan="2" class="text-center sides-border" >4</td>
                                            <td colspan="2" class=" text-center sides-border" >5</td>
                                            <td colspan="2" class=" text-center sides-border" >N/A</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla"> 
                                            <td colspan="8">EXPERIENCIA EN PUESTO SIMILAR</td> 
                                            <td colspan="2" class=" border-tabla text-center" >#exp_pusto_sim_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#exp_pusto_sim_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#exp_pusto_sim_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#exp_pusto_sim_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#exp_pusto_sim_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#exp_pusto_sim_na#</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla"> 
                                            <td  colspan="8">ESTABILIDAD LABORAL</td> 
                                            <td colspan="2" class=" border-tabla text-center" >#cit_estabilidalaboral_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_estabilidalaboral_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_estabilidalaboral_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_estabilidalaboral_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_estabilidalaboral_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_estabilidalaboral_na#</td>
                                        </tr>

                                        <tr class="tableDatos border-tabla">
                                            <td  colspan="8">RESPONSABILIDAD</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_responsabilidad_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_responsabilidad_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_responsabilidad_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_responsabilidad_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_responsabilidad_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_responsabilidad_na#</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla">
                                            <td  colspan="8" class=" border-tabla" >CONOCIMIENTOS TÉCNICOS</td> 
                                            <td colspan="2" class=" border-tabla text-center" >#cit_concimientostec_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_concimientostec_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_concimientostec_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_concimientostec_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_concimientostec_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_concimientostec_na#</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla"> 
                                            <td  colspan="8">ACORDE AL SUELDO OFRECIDO</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_acordeasueldoofrecido_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_acordeasueldoofrecido_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_acordeasueldoofrecido_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_acordeasueldoofrecido_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_acordeasueldoofrecido_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_acordeasueldoofrecido_na#</td>
                                        </tr>
                                        <tr class=" border-side" style="border-bottom:0;"> 
                                            <td  colspan="7"></td>
                                            <td colspan="3" ></td>
                                            <td colspan="1"  ></td>
                                            <td colspan="1" ></td>
                                            <td colspan="1"  ></td>
                                            <td colspan="5"  style="font-size:8pt; font-weight:bold;" class="  text-center" >VALORACIÓN  MEDIA</td>
                                            <td colspan="2" class=" border-side text-center" style="border:1px solid black;"   >#valoracion_media#</td>
                                        </tr>

                                        
                                    </tbody>

                            </table> 
                        </td>  
                        <td colspan="1"> </td>

                    </tr>
                    
                    
                </tbody>

        </table> 
        
        ';

        public $tabla_valoracion_entrevista='
            <br>    
            <br>    
            <table style="width:100%; ">
                    <tbody>
                        <tr class="">
                            <td style="width:10%"></td>
                            <td style="width:80%"></td>
                            <td style="width:10%"></td>
                        </tr>
                        <tr>
                            <td colspan="1"> </td>
                            <td colspan="1">
                    

                            <table style="border-collapse: collapse;font-family:Montserrat,sans-serif;  width:100%;  border-bottom:0; border-left:0;" class="tableDatosValoracion border-tabla">
                                    <tbody>
                                            <tr class="bg-gray">
                                                <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                <td style="width:5%"></td>
                                                <td style="width:5.5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                <td style="width:5.5%"></td>
                                                <td style="width:2.2%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                <td style="width:2.2%"></td>
                                                <td style="width:2.2%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                <td style="width:2.2%"></td>
                                                <td style="width:8%; background:red;" style=" border:1px solid black; border-bottom:0; border-right:0;"></td>
                                                <td style="width:2%" style=" border:1px solid black; border-bottom:0; border-left:0; "></td>
                                            </tr>
                                        <tr  class="tableDatos border-tabla bg-gray bt-none" >
                                            <td colspan="8" >ENTREVISTA </td>
                                            <td colspan="2" class="text-center sides-border" >1</td>
                                            <td colspan="2" class="text-center sides-border" >2</td>
                                            <td colspan="2" class=" text-center sides-border" >3</td>
                                            <td colspan="2" class="text-center sides-border" >4</td>
                                            <td colspan="2" class=" text-center sides-border" >5</td>
                                            <td colspan="2" class=" text-center sides-border" >N/A</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla"> 
                                            <td colspan="8">PRESENTACIÓN, APARIENCIA</td> 
                                            <td colspan="2" class=" border-tabla text-center" >#cit_presentacionapariencia_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_presentacionapariencia_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_presentacionapariencia_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_presentacionapariencia_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_presentacionapariencia_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_presentacionapariencia_na#</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla"> 
                                            <td  colspan="8">PUNTUALIDAD</td> 
                                            <td colspan="2" class=" border-tabla text-center" >#cit_puntualidad_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_puntualidad_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_puntualidad_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_puntualidad_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_puntualidad_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_puntualidad_na#</td>
                                        </tr>
                    
                                        <tr class="tableDatos border-tabla">
                                            <td  colspan="8">DISPONIBILIDAD</td>
                                            <td colspan="2"  class=" border-tabla text-center" >#cit_disponibilidad_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_disponibilidad_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_disponibilidad_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_disponibilidad_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_disponibilidad_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_disponibilidad_na#</td>
                                        </tr>
                                        <tr class="tableDatos border-tabla ">
                                            <td  colspan="8">PROACTIVO</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_proactivo_1#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_proactivo_2#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_proactivo_3#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_proactivo_4#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_proactivo_5#</td>
                                            <td colspan="2" class=" border-tabla text-center" >#cit_proactivo_na#</td>
                                        </tr>
                                        
                                
                                        <tr class=" "> 
                                            <td  colspan="7"></td>
                                            <td colspan="3" ></td>
                                            <td colspan="1"  ></td>
                                            <td colspan="1" ></td>
                                            <td colspan="1"  ></td>
                                            <td colspan="5"  style="font-size:8pt; font-weight:bold;" class="  text-center"  >VALORACIÓN  MEDIA</td>
                                            <td colspan="2" class="  text-center" style="border:1px solid black;" >#valoracion_media#</td>
                                        </tr>
                    
                                        
                                    </tbody>
                    
                            </table> 

                            </td>  
                            <td colspan="1"> </td>

                        </tr>
                        
                        
                    </tbody>

            </table> 
          
        ';

    

        public $tabla_valoracion_adicionales='    
        
        <br>    
        <br>   

        <table style="width:100%; ">
                    <tbody>
                        <tr class="">
                            <td style="width:10%"></td>
                            <td style="width:80%"></td>
                            <td style="width:10%"></td>
                        </tr>
                        <tr>
                            <td colspan="1"> </td>
                            <td colspan="1">
                            <table style="border-collapse: collapse;font-family:Montserrat,sans-serif;  width:100%;  border-bottom:0; border-left:0;border-right:0;" class="tableDatosValoracion border-tabla">
                                        <tbody>
                                                <tr class="bg-gray">
                                                        <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                        <td style="width:5%"></td>
                                                        <td style="width:5.5%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                        <td style="width:5.5%"></td>
                                                        <td style="width:2.2%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                        <td style="width:2.2%"></td>
                                                        <td style="width:2.2%" style=" border:1px solid black; border-bottom:0;  border-right:0;"></td>
                                                        <td style="width:2.2%"></td>
                                                        <td style="width:8%; background:red;" style=" border:1px solid black; border-bottom:0; border-right:0;"></td>
                                                        <td style="width:2%" style=" border:1px solid black; border-bottom:0; border-left:0; "></td>
                                                </tr>
                                            <tr  class="tableDatos border-tabla bg-gray bt-none" >
                                                <td colspan="8" >CALIFICACIONES ADICIONALES </td>
                                                <td colspan="2" class="text-center sides-border" >1</td>
                                                <td colspan="2" class="text-center sides-border" >2</td>
                                                <td colspan="2" class=" text-center sides-border" >3</td>
                                                <td colspan="2" class="text-center sides-border" >4</td>
                                                <td colspan="2" class=" text-center sides-border" >5</td>
                                                <td colspan="2" class=" text-center sides-border" >N/A</td>
                                            </tr>
                                            <tr class="tableDatos border-tabla"> 
                                                <td colspan="8">RESULTADO DE PSICOMETRÍA </td> 
                                                <td colspan="2"  class=" border-tabla text-center" >#psi_calificacion_1#</td>
                                                <td colspan="2"  class=" border-tabla text-center" >#psi_calificacion_2#</td>
                                                <td colspan="2"  class=" border-tabla text-center" >#psi_calificacion_3#</td>
                                                <td colspan="2"  class=" border-tabla text-center" >#psi_calificacion_4#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#psi_calificacion_5#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#psi_calificacion_na#</td>
                                            </tr>
                                            <tr class="tableDatos border-tabla"> 
                                                <td colspan="8">REFERENCIAS LABORALES </td> 
                                                <td colspan="2" class=" border-tabla text-center" >#sel_calificacion_1#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#sel_calificacion_2#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#sel_calificacion_3#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#sel_calificacion_4#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#sel_calificacion_5#</td>
                                                <td colspan="2" class=" border-tabla text-center" >#sel_calificacion_na#</td>
                                            </tr>
                            
                                
                                            <tr class=""> 
                                                <td  colspan="7"></td>
                                                <td colspan="3" ></td>
                                                <td colspan="1"  ></td>
                                                <td colspan="1" ></td>
                                                <td colspan="1"  ></td>
                                                <td colspan="5"  style="font-size:8pt; font-weight:bold;" class="  text-center" >VALORACIÓN  MEDIA</td>
                                                <td colspan="2" class=" border-side text-center" style="border:1px solid black;" >#valoracion_media#</td>
                                            </tr>
                        
                                            
                                        </tbody>
                        
                                </table> 
                        

                  

                            </td>  
                            <td colspan="1"> </td>

                        </tr>
                        
                        
                    </tbody>

            </table> 
                  ';

        public $seccionobservaciones='
            <br>
                            
            <table   cellspacing="0" style="page-break-inside: auto; border-collapse: collapse;font-family:Montserrat,sans-serif;  width:100%;" class="tableDatos">
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
                        <td id="datosFP1" style="font-size: 9pt; font-weight: bold;"  colspan="10" >
                        OBSERVACIONES  
                        </td>
                    
                    </tr>
                      

              
                
            </tbody>
            </table>
            <span>
              #observaciones_all#
            </span>
        ';

  

}