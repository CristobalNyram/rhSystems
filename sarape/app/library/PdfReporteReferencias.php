<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporteReferencias extends Component
{
    public $eseheaderprimera="
        <table width='100%'>
            <tr>
                <td align='left'>
               
                </td>
                <td align='right'>
                <img src='#logo#' height='34' alt=''>
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
    public $titulo ='
    <table style="  display: block; margin-top: 0; margin-bottom: 0; margin-left: 0; margin-right: 0; border-style: inset; border-collapse: collapse;width:100%">
        <tbody>

         
            <tr>
                <td style="padding-bottom:0px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">REFERENCIAS LABORALES</td>
            </tr>
        </tbody>
    </table>
    ';
    public $eseportada='
        <head>
        <style>

        @page {
                
            }

        #datosFP1 {
          color: #134B7B;
          font-weight: bold;
          font-size: 14px;
          font-family:Montserrat,sans-serif;
          text-align:left;
        } 

        #datosVP1 {
            color: black;
            font-weight: bold;
            font-size: 14px;
            font-family:Montserrat,sans-serif;
            text-align:left;
        } 

        #letras{
            color: white;
            font-weight: bold;
            font-size: 16px;
            font-family:Montserrat,sans-serif;
            text-align:center;
            background-color:#192C58
        }


        </style>
        </head>

        
        <!-- PAGINA 1 -->
        <table style="  display: block; margin-top: 0; margin-bottom: 0; margin-left: 0; margin-right: 0; border-style: inset; border-collapse: collapse;width:100%">
            <tbody>
                <tr>
                    <td style="text-align:right">
                    <div></div>
                    </td>
                </tr>
                <tr>
                    <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td><p>&nbsp;</p></td>style=",color:#00205B,"
                </tr>
                <tr>
                    <td style="padding-bottom:20px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">ESTUDIO SOCIOECONÓMICO Y LABORAL</td>
                </tr>
            </tbody>
        </table>
        <table style="border-top:none; width:100%; font-family:Montserrat,sans-serif;">
            <tbody>

                <tr >
                    <th id="datosFP1" colspan="1" >EMPRESA SOLICITANTE</th>
                    <th id="datosVP1" colspan="1" >#emp_nombre#</th>
                </tr>
                <tr>
                    <td id="datosFP1" style="border-top:none; width:38%">NOMBRE DEL CANDIDATO(A)</td>
                    <td id="datosVP1" style="border-top:none; width:38%">#ese_nombre#</td>
                    <td id="datosFP1" style="text-align:right">EDAD:</td>
                    <td id="datosVP1" style="text-align:right">#ese_edad# AÑOS</td>
                </tr>
                <tr>
                    <th id=datosFP1 colspan="1" style="border-top:none; width:38%">PUESTO A CUBRIR</th>
                    <th id=datosvP1 colspan="1" >#ese_puesto#</th>
                </tr>
                <tr>
                    <th id=datosFP1 colspan="1" style="border-top:none; width:38%">CALIFICACIÓN PROPUESTA</th>
                    <th colspan="3" style="font-weight: bold;text-align:center; color:white;background-color:#00778A7">#daf_calificacion#</th>
                </tr>
                <tr>
                    <th colspan="1" rowspan="4" id=datosFP1 style="border-top:none; width:38%">OBSERVACIONES FINALES</th>
                    <th colspan="3" rowspan="4" valign="top" style="text-align:center; color:white;background-color:#00778A7">#daf_notafinal#</th>
                </tr>
                <tr>
                
                <tr>
                <td></td>
                </tr>
                <tr>
                <td></td>
                </tr>
                <tr>
                <td></td>
                </tr>
                <tr>
                <td></td>
                </tr>
                <tr>
                <td></td>
                </tr>
                <th style="padding-bottom:15px"></th>
                </tr>
            </tbody>
        </table>

        <table style="border-top:none; font-family:Montserrat,sans-serif; width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th colspan="5" style="padding-bottom:10px;padding-top:5px;color:white;text-align:center; font-weight:bold; ">RESUMEN GENERAL</th>
                </tr>
                
                <tr >
                    <td style="padding-bottom:20px;padding-top:20px;width:6%"></td>
                    <td style="padding-bottom:20px;padding-top:20px;width:44%"></td>
                    <td style="padding-bottom:20px;padding-top:20px;text-align:left;font-weight: bold;">APROPIADO</td>
                    <td style="padding-bottom:20px;padding-top:20px;text-align:left;font-weight: bold;">PROMEDIO</td>
                    <td style="padding-bottom:20px;padding-top:20px;text-align:left;font-weight: bold;">INAPROPIADO</td>
                </tr>   
                
                <tr>
                    <td id="letras"> A </td>
                    <td id="datosFP1" style="font-weight: bold">DATOS PERSONALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #cop_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #cop_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #cop_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> B </td>
                    <td id="datosFP1" style="font-weight: bold;">DATOS ESCOLARES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dae_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dae_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dae_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> C </td>
                    <td id="datosFP1" style="font-weight: bold;">ANTECEDENTES SOCIALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ans_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ans_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ans_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> D </td>
                    <td id="datosFP1" style="font-weight: bold;">ESTADO GENERAL DE SALUD</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ess_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ess_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ess_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> E </td>
                    <td id="datosFP1" style="font-weight: bold;">DATOS DEL GRUPO FAMILIAR</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dgf_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dgf_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dgf_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                    <td style="padding-bottom:20px"></td>
                    <td style="padding-bottom:20px"></td>
                    <td style="padding-bottom:20px"></td>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr style="border-spacing: 0px">
                    <td id="letras"> F </td>
                    <td rowspan="2" id="datosFP1" style="padding-bottom:10px;font-weight: bold;">ANTECEDENTES LABORALES DEL GRUPO FAMILIAR</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #agf_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #agf_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #agf_calificacioni# </td>
                </tr>
                <tr>
                    <td style=""></td>
                    <td style="padding-bottom:5px"></td>
                    <td style="padding-bottom:5px"></td>
                    <td style="padding-bottom:5px"></td>
                </tr>
                <tr>
                    <td id="letras"> G </td>
                    <td id="datosFP1" style="font-weight: bold;">SITUACIÓN ECONÓMICA</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sie_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sie_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sie_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> H </td>
                    <td id="datosFP1" style="font-weight: bold;">BIENES INMUEBLES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #bie_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #bie_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #bie_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> I </td>
                    <td id="datosFP1" style="font-weight: bold;">REFERENCIAS PERSONALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sep_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sep_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sep_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:20px"></td>
                </tr>
                <tr>
                    <td id="letras"> J </td>
                    <td id="datosFP1" style="font-weight: bold;">REFERENCIAS LABORALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sel_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sel_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sel_calificacioni# </td>
                </tr>
                
            </tbody>
        </table>
    ';

    // página2 eses
    public $datospersonales=' 
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                  
                    <th colspan="2" style="text-align:center"><p style="color:white">DATOS GENERALES</p></th>
                </tr>
            </tbody>
        </table>         
        <table style="border-collapse: collapse;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td id="datosFP1" style="width:40%;font-size: 10px;padding-top:20px" >NOMBRE COMPLETO</td>
                    <td style="font-size: 10px;padding-top:20px"> #nombre_completo#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >EMPRESA</td>
                    <td style="font-size: 10px;padding-top:5px">#empresa#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >PUESTO QUE SOLICITA</td>
                    <td style="font-size: 10px;padding-top:5px">#puesto#</td>
                </tr>   
                
                
        </tbody>
        </table>
        
       
        <br>    
    ';
    public $datogrupofamiliar='
            <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr style="background-color:#192C58" >
                        <th style="color:white;width:6%">E</th>
                        <th colspan="2" style="text-align:center"><p style="color:white">DATOS DEL GRUPO FAMILIAR</p></th>
                    </tr>
                </tbody>
            </table>

            <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr>
                        <th style="text-align:center;font-size: 8px"><p>
                        A CONTINUACIÓN DEBERÁ ANOTAR LOS DATOS QUE CORRESPONDAN A FAMILIARES, PERSONAS QUE HABITEN EL INMUEBLE, SI ES EL CASO TAMBIÉN
                        </p></th>
                    </tr>
                    <tr>
                        <th style="text-align:center;font-size: 8px"><p>
                        DEBERÁ INCLUIR LOS DATOS DEL CÓNYUGE E HIJOS
                        </p></th>
                    </tr>
                </tbody>
            </table>

            <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr >
                        <td style="font-size: 10px; font-weight:bold; text-align:center; width:30%; ">NOMBRE</td>
                        <td style="font-size: 10x; font-weight:bold; text-align:center ; ">PARENTESCO</td>
                        <td style="font-size: 10x; font-weight:bold; text-align:center ; width:10%;">EDAD</td>
                        <td style="font-size: 10x; font-weight:bold; text-align:center ; width:15%;">ESTADO CIVIL</td>
                        <td style="font-size: 10x; font-weight:bold; text-align:center ; width:15%;">ESCOLARIDAD</td>
                        <td style="font-size: 10x; font-weight:bold; text-align:center ; width:15%;">VIVE CON USTED</td>
                    </tr>   
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px;text-align:center;">#dgd_nombre0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad0#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id0#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_viveusted0#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px;text-align:center;">#dgd_nombre1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad1#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id1#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_viveusted1#</td>
                    </tr>       
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad2#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id2#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_viveusted2#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad3#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id3#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_viveusted3#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad4#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id4#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_viveusted4#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad5#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id5#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_viveusted5#</td>
                    </tr>
                
                </tbody>
            </table>
            <br>
            <br>

            <table style="border-top:none;font-family:Montserrat,sans-serif; width:100%" class="tableDatos">
                <tbody>
                    <tr>
                        <td id="datosFP1" style="font-size: 10px;text-align:left;width:60%">
                        ¿CUÁNTOS MATRIMONIOS HAN CONTRAÍDO CADA UNO DE SUS PADRES?
                        </td>
                        <td style="font-size: 10px;text-align:left;width:50%"> #dgf_matrimoniopadres# </td>
                    </tr>
                </tbody>
            </table>

            <br>
        ';
        public $antecedenteslaboralesfamiliar='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">F</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">ANTECEDENTES LABORALES DEL GRUPO FAMILIAR</p></th>
                </tr>
            </tbody>
        </table>
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
                    <th style="text-align:center;font-size: 8px"><p>
                    A CONTINUACIÓN DEBERÁ ESPECIFICAR LOS DATOS RELACIONADOS CON LAS PERSONAS QUE PERTENECEN AL SISTEMA FAMILIAR, ASÍ COMO LOS DATOS</p></th>
                </tr>
                <tr>
                    <th style="text-align:center;font-size: 8px"><p>
                    DEL CÓNYUGE E HIJOS, ÚNICAMENTE EN CASO DE QUE SE ENCUENTREN LABORANDO
                    </p></th>
                </tr>
            </tbody>
        </table>
        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:20%; ">NOMBRE</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:30%;">EMPRESA</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:25%;">PUESTO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:15%;">ANTIGÜEDAD</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre0#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa0#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto0#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad0#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre1#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa1#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto1#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad1#</td>
                </tr>       
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre2#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa2#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto2#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad2#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre3#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa3#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto3#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad3#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre4#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa4#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto4#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad4#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre5#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa5#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto5#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad5#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre6#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa6#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto6#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad6#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre7#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa7#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto7#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad7#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre8#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa8#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto8#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad8#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:15px; text-align:center">#agd_nombre9#</td>
                    <td style="font-size: 10px; text-align:center">#agd_empresa9#</td>
                    <td style="font-size: 10px; text-align:center">#agd_puesto9#</td>
                    <td style="font-size: 10px; text-align:center">#agd_antiguedad9#</td>
                </tr>
            </tbody>
        </table>
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
                    <td style="font-size: 10px; width:40%">¿SUS PADRES CUENTAN CON SERVICIO MÉDICO?</td>
                    <td style="font-size: 10px; width:30%">#agf_padrescuentan#</td>
                    <td style="width:30%"></td>
                </tr>
                <tr>
                    <td style="font-size: 10px ">NOMBRE DEL SERVICIO</td>
                    <td style="font-size: 10px ">#agf_padresservicio#</td>
                    <td style="font-size: 10px "></td>
                </tr>
                <tr>
                    <td style="font-size: 10px; height:20px"></td>
                    <td style="font-size: 10px; height:20px "></td>
                    <td style="font-size: 10px; height:20px "></td>
                </tr>
                <tr>
                    <td style="font-size: 10px ">¿SU CÓNYUGE CUENTA CON SERVICIO MÉDICO?</td>
                    <td style="font-size: 10px ">#agf_conyugecuentan#</td>
                    <td style="font-size: 10px "></td>
                </tr>
                <tr>
                    <td style="font-size: 10px ">NOMBRE DEL SERVICIO</td>
                    <td style="font-size: 10px ">#agf_conyugeservicio#</td>
                    <td style="font-size: 10px "></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td valign="top" style="width:28%;color:#044B7B;font-size:10px!important">NOTAS <br><span style="color:black;">#agf_notas#</span></td>
                </tr>       
            </tbody>
        </table>
        ';

        public $referencias_laborales_cabecera='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                 
                    <th colspan="2" style="text-align:center"><p style="color:white">REFERENCIAS LABORALES</p></th>
                </tr>
            </tbody>
        </table>

        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
                    <th style="text-align:center;font-size: 8px"><p>
                    QUE NO SEAN DE PARIENTES, NI EMPLEOS ANTERIORES</p></th>
                </tr>
            </tbody>
        </table>    
    ';

    public $referenciapersonal='
        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; width:25%; ">NOMBRE</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rep_nombre#</td>
                </tr>   
                <tr >
                    <td style="font-size: 10px; font-weight:bold; width:25%; ">TIEMPO DE CONOCERLO(A)</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rep_tiempo#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; width:25%; ">CALLE Y NÚMERO</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rep_callenumero#</td>
                </tr>   
                <tr >
                    <td style="font-size: 10px; font-weight:bold;  width:25%; ">COLONIA</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rep_colonia#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; width:25%; ">CÓDIGO POSTAL</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rep_codpostal#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; width:25%; ">TELÉFONOS</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rep_telefono#</td>
                </tr>   
            </tbody>
        </table>
        <br>
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                <td valign="top" style="height:140px; width:28%;color:#044B7B;font-size:12px">NOTAS <br><span style="color:black;">#rep_notas#</span></td>
                </tr>       
            </tbody>
        </table>
        
    ';

    public $referencialaboral='
            <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr >
                        <th style="font-size: 10px;text-align:center; width:26%; ">#numempleo#</th>
                        <th style="font-size: 10x;text-align:center; width:37%">DATOS PROPORCIONADOS POR EL CANDIDATO</th>
                        <th style="font-size: 10px;text-align:center; width:37%">DATOS PROPORCIONADOS POR R.H.</th>
                    </tr>   
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px; color:#044B7B">NOMBRE DE LA EMPRESA</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatoempresa#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhempresa#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px; color:#044B7Bx">DOMICILIO</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatodomicilio#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhdomicilio#</td>
                    </tr>   
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px; color:#044B7B; background-color:#CCE4ED">NOMBRE DEL JEFE INMEDIATO</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatojefe#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhjefe#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px; color:#044B7B">TELÉFONO</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatotelefono#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhtelefono#</td>
                    </tr>   
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;color:#044B7B;background-color:#CCE4ED">PUESTO INICIAL</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatopuestoinicial#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhpuestoinicial#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;color:#044B7B">PUESTO FINAL</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatopuestofinal#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhpuestofinal#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;color:#044B7B;background-color:#CCE4ED">FECHA DE INGRESO</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatoingreso#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhingreso#</td>
                    </tr>
                        <tr>
                        <td style="font-size: 10px;color:#044B7B">FECHA DE SALIDA</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatosalida#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhsalida#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;color:#044B7B">SUELDO INICIAL</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatosueldoinicial#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhsueldoinicial#</td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;color:#044B7B">SUELDO FINAL</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatosueldofinal#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhsueldofinal#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;color:#044B7B">MOTIVO DE SEPARACIÓN</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatoseparacion#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhseparacion#</td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;color:#044B7B">INCAPACIDAD O ACCIDENTES</td>
                        <td style="font-size: 10px;text-align:center">#rel_candidatoincapacidad#</td>
                        <td style="font-size: 10px;text-align:center">#rel_rhincapacidad#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED; text-align:left" >
                        <td rowspan="2" style="font-size: 7px;color:#044B7B">
                        ¿HUBO DEMANDA O PLÁTICAS CONCILIATORIAS 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        EN LA SEPARACIÓN DEL EMPLEO?</td>
                        <td rowspan="2" style="font-size: 10px; text-align:center;">#rel_candidatodemanda#</td>
                        <td rowspan="2" style="font-size: 10px; text-align:center;">#rel_rhdemanda#</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;color:#044B7B">¿ES RECOMENDABLE?</td>
                        <td style="font-size: 10px;text-align:center;">#rel_candidatorecomendable#</td>
                        <td style="font-size: 10px;text-align:center;">#rel_rhrecomendable#</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr>
                        <td valign="top" style="height:100px; width:28%;color:#044B7B;font-size:12px">COMENTARIOS <br><span style="color:black;">#rel_notas#</span></td>
                    </tr>       
                </tbody>
            </table>
            <br>
            <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
                <tbody>
                    <tr style="background-color:#192C58" >
                        <td style="text-align:center">ESCALA DE DESEMPEÑO</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr>
                        <td style="font-size: 10px;text-align:center; width:5px%"></td>
                        <td style="font-size: 10px;text-align:center; width:30px%"></td>
                        <td style="font-size: 10Px;text-align:center; width:12.5px%">EXCELENTE</td>
                        <td style="font-size: 10px;text-align:center; width:12.5px%">APROPIADO</td>
                        <td style="font-size: 10px;text-align:center; width:12.5px%">REGULAR</td>
                        <td style="font-size: 10px;text-align:center; width:12.5px%">DEFICIENTE</td>
                        <td style="font-size: 10px;text-align:center; width:10px%"></td>
                    </tr>
                    <tr >
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px">CALIDAD EN EL TRABAJO</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;">#rel_calidad1#</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;">#rel_calidad2#</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;">#rel_calidad3#</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;">#rel_calidad4#</td>
                        <td style="font-size: 10px;text-align:center; "></td>
                    </tr>       
                    <tr>
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px;">RESPONSABILIDAD</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_responsabilidad1# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_responsabilidad2# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_responsabilidad3# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_responsabilidad4# </td>
                        <td style="font-size: 10px;"></td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px;">RELACIONES INTERPERSONALES</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_relaciones1# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_relaciones2# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_relaciones3# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_relaciones4# </td>
                        <td style="font-size: 10px;"></td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px">HONRADEZ</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_honradez1# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_honradez2# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_honradez3# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_honradez4# </td>
                        <td style="font-size: 10px;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px;">ASISTENCIA</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_asistencia1# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_asistencia2# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_asistencia3# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_asistencia4# </td>
                        <td style="font-size: 10px;"></td>
                    </tr>       
                    <tr>
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px;">PUNTUALIDAD</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_puntualidad1# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_puntualidad2# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_puntualidad3# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_puntualidad4# </td>
                        <td ></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;text-align:center; "></td>
                        <td style="font-size: 10px;">INICIATIVA</td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_iniciativa1# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_iniciativa2# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_iniciativa3# </td>
                        <td style="font-size: 10px;background-color:#CCE4ED;text-align:center;"> #rel_iniciativa4# </td>
                        <td ></td>
                    </tr>       
                    <tr>
                        <td style="font-size: 10px;text-align:center;"></td>
                        <td style="font-size: 10px; ">ADICCIONES</td>
                        <td style="font-size: 10px; " colspan="4">#rel_adicciones#</td>
                        <td ></td>
                    </tr>
                </tbody>
            </table>
            <br>
        ';

    public $periodoinactivo='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">PERIODOS INACTIVOS Y EMPLEOS OCULTOS</td>
                </tr>
            </tbody>
        </table>
        <br>

    <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px;text-align:center; width:5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:30px%"></td>
                    <td style="font-size: 10Px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:10px%"></td>
                    
                </tr>
        
                <tr >
                    <td style="font-size: 10px;text-align:center; "></td>
                    <td style="font-size: 10px; ">EMPLEOS OCULTOS</td>
                    <td style="height:20px; font-size: 10px; text-align:center;">SI</td>
                    <td style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;"> #sel_empleosocultos1# </td>
                                <td style="height:20px; font-size: 10px; text-align:center;">NO</td>
                    <td style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;"> #sel_empleosocultos0# </td>
                    <td style="font-size: 10px;text-align:center; "></td>
                </tr>
                
                
            </tbody>    
        </table >
    
                <br>

        #epl_registros_dinamicos#
        
        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px;text-align:center; width:5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:30px%"></td>
                    <td style="font-size: 10Px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:12.5px%"></td>
                    <td style="font-size: 10px;text-align:center; width:10px%"></td>
                    
                </tr>
                <tr >
                    <td style="font-size: 10px;text-align:center; "></td>
                    <td style="font-size: 10px;text-align:center; "></td>
                    <td colspan="2" style="font-size: 10Px;text-align:center; ">MOTIVO</td>
                    <td colspan="2" style="font-size: 10Px;text-align:center; ">FECHAS</td>
                    <td style="font-size: 10px;text-align:center; "></td>
                </tr>
                    #per_registros_dinamicos#  
                <tr>
                <td colspan="7" style="font-size: 10px;text-align:center; padding-top:15px"> </td>
                </tr>
                
                
                
            </tbody>    
        </table >
        

        <table style="border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td valign="top" style="height:80px; width:28%;color:#044B7B;font-size:12px">COMENTARIOS <br><span style="color:black;">#sel_notas#</span></td>
                </tr>       
            </tbody>
        </table>
    ';


}