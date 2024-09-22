<?php

use Phalcon\Mvc\User\Component,
 Phalcon\Mvc\View;

class RequisicionPersonal extends Component
{
    public $eseheaderprimera='
        <table width="100%">
            <tr>
                <td align="left">
                <img src="#logo#" height="33" alt="" style=" margin-left:30px; margin-top:5px; display: block;">
                </td>
            </tr>
        </table> 
    ';

    // página uno
    public $titulo ='
        <br>   
        <table style="margin-top:15px; padding-bottom:10px; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="25%"></td>
                    <td width="50%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">REQUISICIÓN DE PERSONAL</td>
                    <td width="25%"></td>
                </tr>
                <br>
            </tbody>
        </table>
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="25%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px;">FECHA DE SOLICITUD</td>
                    <td width="16.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border: 1px solid #00205B;" >#vac_fecharegistro#</td>
                    <td width="16.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px;"></td>
                    <td width="16.7%"  style="font-size: 9px;padding-top:5px; padding-bottom:5px;">TIPO DE VACANTE</td>
                    <td width="16.%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border: 1px solid #00205B;" >#tip_nombre#</td>
                    <td width="8.6%"></td>
                </tr>
            </tbody>
        </table>
    ';

    public $datosgenerales = ' 
        <table style="margin-top:15px; padding-bottom:10px; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr width="100%" style="padding-top:5px padding-bottom:5px">
                    <td width="100%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">DATOS GENERALES DE LA REQUISICIÓN</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="41.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px;">NOMBRE DE LA VACANTE</td>
                    <td width="16.68%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px;">NO. VACANTES</td>
                    <td width="41.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px;">EMPRESA O ÁREA DE TRABAJO</td>
                </tr>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="41.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-top:1px; border-bottom:1px;">#cav_nombre#</td>
                    <td width="16.68%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-top:1px; border-bottom:1px;">#vac_numero#</td>
                    <td width="41.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#emp_nombre#</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tr style="padding-top:2px padding-bottom:2px">
                <td width="#style_width_td_1_tipo_empleo#"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">TIPO DE EMPLEO</td>
                <td width="#style_width_td_2_tipo_empleo#"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">#tie_nombre#</td>
                #tipo_empleo_template_si_no#
            </tr>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tr style="padding-top:2px padding-bottom:2px">
                <td width="16.68%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">ESTADO</td>
                <td width="41.67%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#est_nombre#</td>
                <td width="12.5%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">MUNICIPIO</td>
                <td width="29.15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#mun_nombre#</td>
            </tr>
        </table>
    ';

    public $personalsubcontratado = '
        <table style="margin-top:15px; padding-bottom:10px; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="100%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">UNICAMENTE PARA PERSONAL SUBCONTRATADO</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tr style="padding-top:2px padding-bottom:2px">
                <td width="30%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">GENERACIÓN DE LA VACANTE POR</td>
                <td width="70%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border:1px;">#gen_nombre#</td>
            </tr>
        </table>
        <br>
    ';

    public $requerimientospuesto = '
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="100%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">REQUERIMIENTOS DEL PUESTO</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="41.7%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">ESTADO CIVIL</td>
                    <td width="29.15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:15px; text-align:start;">RANGO DE EDAD</td>
                    <td width="29.15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; ">SEXO</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="41.7%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#esc_nombre#</td>
                    <td width="6.66%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:center;">DE</td>
                    <td width="5%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#vac_edadmin#</td>
                    <td width="5.83%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">DE</td>
                    <td width="5.83%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#vac_edadmax#</td>
                    <td width="5.83%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="29.15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#sex_nombre#</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="29.15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; border-color: #00205B; border-style: solid; border-top:1px;">ESCOLARIDAD DESEADA</td>
                    <td width="26.7%"  style="font-size: 9px; max-height:fit-content; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#gra_nombre#</td>
                    <td width="15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">ESPECIFICAR</td>
                    <td width="29.15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#vac_escolaridadespecificar#</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">IDIOMAS REQUERIDOS</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#vac_idioma#</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">NIVEL</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#vac_nivelidioma#</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">OTROS IDIOMAS</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px;">#vac_otroidioma#</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">HORARIO DE TRABAJO</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#vac_horario#</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="25%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">CONCEPTO</td>
                    <td width="75%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">DESCRIPCIÓN</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset;box-sizing:none;  border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">CONCEPTOS TÉCNICOS</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:justify; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px;">
                    <p class="justify" style="text-aling:justify; ">
                    #vac_conceptotecnico#
                    </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="border-spacing: unset;border: unset; margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:0px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">HABILIDADES Ó COMPETENCIAS</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:0px; padding-left:5px; text-align:justify; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">
                    <p class="justify" style="text-aling:justify; ">
                    #vac_habilidad#
                    </p>
                    </td>
                </tr>
                <tr style="padding-top:2px ">
                    <td   width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">FUNCIONES PRINCIPALES</td>
                    <td  width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:justify; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">
                        #vac_funcionprincipal#
                </td>

                
                <tr style="padding-top:2px ">
                        <td   width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">EXPERIENCIA</td>
                        <td  width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:justify; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">
                            #vac_experiencia#
                </td>
               
        </tr>
            </tbody>
        </table>
        <table style="border-spacing: unset;border: unset;margin-top:0;box-sizing:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
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
    
         
               
            </tbody>
        </table>
        
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="20%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">SUELDO</td>
                    <td width="10%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-right:5px; text-align:right;">MÍNIMO $</td>
                    <td width="15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#vac_sueldomin#</td>
                    <td width="10%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-right:5px; text-align:right;">MÁXIMO $</td>
                    <td width="15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#vac_sueldomax#</td>
                    <td width="10%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-right:5px; text-align:right;">TIPO DE PAGO</td>
                    <td width="15%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; font-weight:bold; text-align:start; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#tpg_nombre#</td>   
                </tr>
            </tbody>
        </table>
        <br>
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="25%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">PRESTACIONES</td>
                    <td width="75%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#pre_nombre#</td>
                </tr>
            </tbody>
        </table>
   
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:2px padding-bottom:2px">
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>
                    <td width="5%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;"></td>

                </tr>

                <tr style="padding-top:2px padding-bottom:2px">
                    <td colspan="5" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">GARANTÍA POR MES</td>
                    <td colspan="3" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#vac_garantia#</td>

                    <td colspan="3"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:end;">PRIVACIDAD</td>
                    <td colspan="3"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#vac_privacidad#</td>


                </tr>
        
              
      
            </tbody>
        </table>
        <br>
    ';

    public $observaciones = '
        <table style="margin-top:5px; padding-bottom:10px; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="100%" style="background-color:#00205B; font-weight:bold; text-align:center; color:white; font-family:Montserrat,sans-serif; font-size:9px; padding-top:5px; padding-bottom:5px;">OBSERVACIONES</td>
                </tr>
            </tbody>
        </table>     
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
            <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="100%" style=" text-align:start; font-size:9px; font-weight:bold; padding-top:5px; padding-bottom:5px; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-bottom:1px;">
                        #vac_observaciones#
                    </td>
                </tr>
            </tbody>
        </table> 
        <br>
    ';

    public $nombreejecutivo = '
        <table style="margin-top:0;padding-bottom:10px; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
             <tbody>
                <tr style="padding-top:5px padding-bottom:5px">
                    <td width="100%" style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start;">EJECUTIVO DE CUENTA</td>
                </tr>
            </tbody>
        </table> 
        <table style="margin-top:0; padding-bottom:0; margin-left:0; margin-right:0; border-style:inset; border-collapse:collapse; width:100%;">
             <tbody >
                <tr style="width:100%;padding-top:5px padding-bottom:5px">
                    <td width="100%"  style="font-size: 9px; padding-top:5px; padding-bottom:5px; padding-left:5px; text-align:start; font-weight:bold; border-color: #00205B; border-style: solid; border-left:1px; border-right:1px; border-top:1px; border-bottom:1px;">#eje_nombre#</td>
                </tr>
            </tbody>
        </table> 
    ';
}