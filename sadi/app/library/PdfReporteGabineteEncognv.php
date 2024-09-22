<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporteGabineteEncognv extends Component
{
    public $eseheaderprimera="
        <table width='100%'>
            <tr>
                <td align='left'>
                <img src='images/logoempresa/#logoempresa#' height='116' alt=''>
                </td>
                <td align='right'>
                <img src='images/#logo#' height='34' alt=''>
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
                    <td style="padding-bottom:10px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">INVESTIGACIÓN LABORAL</td>
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
                    <td id="datosVP1" style="border-top:none; width:38%; #style_en_linea_ese_nombre#">#ese_nombre#</td>
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
                    <th colspan="3" rowspan="4" valign="top" style="text-align:justify; color:white;background-color:#00778A7; #style_en_linea_daf_notafinal#">#daf_notafinal#</th>
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
                <tr>
                    <td id="datosFP1" style="font-size: 10px;" >DOMICILIO  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 6px; text-align:right;"></span></td>
                    <td style=" #style_en_linea_direccion_completa_ese#">#direccion_completa_ese# </td>
                </tr>
                <tr >
                    <td id="datosFP1" style="width:40%;font-size: 10px;padding-top:5px" >LUGAR Y FECHA DE NACIMIENTO</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_lugarnacimiento#, #ese_fechanacimiento#</td>
                </tr>
                <tr style="border-top-color:red;height:2px">
                    <td id="datosFP1" style="height:2px;border-collapse: collapse;font-size: 10px;padding-top:5px" >ESTADO CIVIL</td>
                    <td style="height:2px;border-collapse: collapse;font-size: 10px;padding-top:5px">#esc_id#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >SEXO</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_sexo#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 0px;margin-bottom: 0px;border-style: inset">
                </td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >CELULAR</td>
                    <td style="font-size: 10px">#ese_celular#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >TELÉFONO</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_telefono#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 0px;margin-bottom: 0px;border-style: inset">
                </td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >FAMILIARES EN LA EMPRESA</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_familiarempresa#</td>
                </tr>
        </tbody>
        </table>
    ';

    public $referenciaslaboralescabecera='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58">
                    <th colspan="2" style="text-align:center"><p style="color:white">REFERENCIAS LABORALES</p></th>
                </tr>
            </tbody>
        </table>
    ';

    public $referencialaboral='
        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
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
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
                    <td valign="top" style="height:60px; width:28%;color:#044B7B;font-size:12px">COMENTARIOS <br><span style="color:black;">#rel_notas#</span></td>
                </tr>       
            </tbody>
        </table>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">ESCALA DE DESEMPEÑO</td>
                </tr>
            </tbody>
        </table>
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
    ';

    public $periodoinactivo='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">PERIODOS INACTIVOS Y EMPLEOS OCULTOS</td>
                </tr>
            </tbody>
        </table>    
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
                <tr >
                    <td style="font-size: 10px;text-align:center; "></td>
                    <td style="font-size: 10px">PERIODOS DE INACTIVIDAD</td>
                    <td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;">#per_motivo0#</td>
                    <td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;">#per_fecha0#</td>
                    <td style="font-size: 10px;text-align:center; "></td>
                </tr>
                <tr >
                    <td style="font-size: 10px;text-align:center; "></td>
                    <td style="font-size: 10px;text-align:center; "></td>
                    <td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;">#per_motivo1#</td>
                    <td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;">#per_fecha1#</td>
                    <td style="font-size: 10px;text-align:center; "></td>
                </tr>       
                <tr>
                <td colspan="7" style="font-size: 10px;text-align:center; padding-top:15px"> </td>
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
        
      
        <table style="border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td valign="top" style="height:80px; width:28%;color:#044B7B;font-size:12px">COMENTARIOS <br><span style="color:black;">#sel_notas#</span></td>
                </tr>       
            </tbody>
        </table>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                <tr>
                    <td style="font-size: 10px;text-align:center; width:26%; "><img class="_idGenObjectAttribute-1" src="images/firmas/#firma#" width="280px" /><br>SIPS se compromete a manejar la información recabada con profesionalismo, discreción y confidencialidad</td>
                </tr>
            </tbody>
        </table>
    ';

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
            <td colspan="20"  style="padding-bottom:10px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">DOCUMENTOS</td>

            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px;font-family:Calibri, sans-serif;font-size:15px;text-align:center; font-weight: bold;text-align:center;color:#00205B;">
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
            <td colspan="20"  style="padding-bottom:10px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">DOCUMENTOS</td>

            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px;font-family:Calibri, sans-serif;font-size:15px;text-align:center; font-weight: bold;text-align:center;color:#00205B;">
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
            <td colspan="20"  style="padding-bottom:10px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">DOCUMENTOS</td>

            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:15px;font-family:Calibri, sans-serif;font-size:15px;text-align:center; font-weight: bold;text-align:center;color:#00205B;">
            #nombre_categoria_archivo#									

            </td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            
   
      
    

        <tr>
            <td  colspan="20" style="text-align:center; height: 260px;">
                <img src="archivos/#archivo_0#"   height="9cm" width="10cm" />
            </td>
          
        </tr>
        <tr>
        <td colspan="20" style="height:.5cm"></td>
        </tr>
        <tr>
            <td  class=""  colspan="20" style="text-align:center;">
                <img src="archivos/#archivo_1#"  height="9cm" width="10cm" />
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
            <td colspan="20"  style="padding-bottom:10px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">DOCUMENTOS</td>

            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px;font-family:Calibri, sans-serif;font-size:15px;text-align:center; font-weight: bold;text-align:center;color:#00205B;">
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
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td colspan="20"  style="padding-bottom:10px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">

            SEMANAS COTIZADAS									

            </td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            


                    
        </tbody>
    </table>';


    
    public $array_referencialaboral=[
        "referencias_lab"=>' 
         <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
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
        </table>',
        'comentario'=> 
            '<table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr>
                        <td valign="top" style="height:#rel_notas_height_size#; width:28%;color:#044B7B;#style_in_linea_rel_notas#">COMENTARIOS <br><span style="color:black;">#rel_notas#</span></td>
                    </tr>       
                </tbody>
            </table>',

        'escala_desempenio'=>
        '
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">ESCALA DE DESEMPEÑO</td>
                </tr>
            </tbody>
        </table>
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
    '];

    public function calcularFontSizeGeneral($letras = "",$default_size=12)
    {
        $respuesta="";
        if(trim($letras)!=""){$respuesta = "font-size:";}
        $count_letras = strlen($letras);
        // error_log($count_letras);
        switch ($count_letras) {
            case ($count_letras >= 280 && $count_letras < 350):
                $respuesta .= "9px;";
                break;

            case ($count_letras >= 200 && $count_letras < 280):
                $respuesta .= "10px;";
                break;

            case ($count_letras >= 150 && $count_letras < 200):
                $respuesta . "11.5px;";
                break;
            case ($count_letras >= 100 && $count_letras < 150):
                $respuesta .= "11.6px;";
                break;
            case ($count_letras >= 50 && $count_letras < 100):
                $respuesta .= "12px;";
                break;
            default:
                break;
        }


        return $respuesta;
    }
    public function calcularFontSizeComentarioNota($letras = "",$default_size=12)
    {
        $respuesta="";
        if(trim($letras)!=""){$respuesta = "font-size:";}
        $count_letras = strlen($letras);
        //  error_log($count_letras);
        switch ($count_letras) {
            case ($count_letras >= 280 && $count_letras < 350):
                $respuesta .= "8.5px;";
                break;

            case ($count_letras >= 200 && $count_letras < 280):
                $respuesta .= "9px;";
                break;

            case ($count_letras >= 150 && $count_letras < 200):
                $respuesta . "9.5px;";
                break;
            case ($count_letras >= 100 && $count_letras < 150):
                $respuesta .= "10px;";
                break;
            case ($count_letras >= 50 && $count_letras < 100):
                $respuesta .= "10.5px;";
                break;
            default:
                $respuesta .= $default_size."px;";

                break;
        }


        return $respuesta;
    }
    
    public function calcularFontSizeComentarioNotaDinamico($letras = "",$default_size=12)
    {
        $respuesta="";
        if(trim($letras)!=""){$respuesta = "font-size:";}
        $count_letras = strlen($letras);
        $tamanio_fuente = $default_size;

        //   error_log($count_letras);
        switch ($count_letras) {
            case ($count_letras >590):
                $respuesta .= ($tamanio_fuente-4.2)."px;";
                break;
            case ($count_letras >= 550 && $count_letras < 590):
                $respuesta .= ($tamanio_fuente-3.9)."px;";
                break;
            case ($count_letras >= 450 && $count_letras < 550):
                $respuesta .= ($tamanio_fuente-3.6)."px;";
                break;
                case ($count_letras >= 350 && $count_letras < 450):
                  $respuesta .= ($tamanio_fuente-3)."px;";
                break;
            case ($count_letras >= 280 && $count_letras < 350):
                $respuesta .= ($tamanio_fuente-2.5)."px;";
                break;

            case ($count_letras >= 200 && $count_letras < 280):
                $respuesta .= ($tamanio_fuente-2)."px;";
                break;

            case ($count_letras >= 150 && $count_letras < 200):
                $respuesta .= ($tamanio_fuente-1.5)."px;";
                break;
            case ($count_letras >= 100 && $count_letras < 150):
                $respuesta .= ($tamanio_fuente-1)."px;";
                break;
            case ($count_letras >= 50 && $count_letras < 100):
                $respuesta .= ($tamanio_fuente-.5)."px;";
                break;
            default:
                $respuesta .= $default_size."px;";

                break;
        }
        # error_log($respuesta);


        return $respuesta;
    }
    
}