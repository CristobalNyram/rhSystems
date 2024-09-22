<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporteEfectividad extends Component
{

    public $html_completo = '
        <div id="current_date"></p>    
    ';

    public $cabezera_hoja='   
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse; margin:810px 0px 0px 0px; padding:0px 0px 0px 0px;">
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
                    <th colspan="2" rowspan="3" style="text-align:center"> <img height="34" class="_idGenObjectAttribute-1" src="images/#logo_header#"  /></th>
                </tr>
                <tr>
                    <td colspan="8" style="font-family:Calibri, sans-serif;font-size:20;text-align:start;font-weight: bold;"> Reporte de Efectividad</td>
                </tr>
            </tbody>
        </table>';

    public $header_hoja=' 
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
            <tbody>
                <tr><td style="height:10px border: 1px solid #FF6600;  "></td></tr>
                <tr>
                    <td colspan="8" style="color:white; font-family:Calibri, sans-serif;font-size:14;background-color:white; color:black;text-align:left;font-weight: bold;border:none">
                    &nbsp;&nbsp;&nbsp;</td>
                    <td  style="text-align: left; color:black; text-align:right ;  margin:0 20px 0 0 ; font-size:10px;background-color:white;border:none" colspan="2"> {PAGENO} / {nb}</td>
                </tr>	
            </tbody> 
        </table>';

    public $hoja_1='
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
                
                <tr style="text-align:justify;  text-justify: distribute;">
                    <td colspan="20" style="height:90px; border:;font-family:Calibri, sans-serif;font-size:15;text-align:justify;  text-justify: distribute;">#texto#
                    </td>
                </tr>
                <tr>
                    <td>
                    <td colspan="20" style="height:20px">
                    <img src="graficasencuesta/#respuesta_1_id#" height="400" alt="">
                    </td>
                    </td>
                </tr>
                <tr>
                    <td colspan="20" style="height:40px"></td>
                </tr>

                <tr>
                    <td colspan="100%" style="height:20px;">
                        <p style="text-align:center;  ">Resultados</p>
                        <br>
                    
                        <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;font-size: 10px;">
                            <tbody >
                                <tr style="background:#233840;font-size: 15px;" >
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">0 DÍAS</td>
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">1 DÍA</td>
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">2 DÍAS</td>
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">3 DÍAS</td>
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">4 DÍAS</td>
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">5 DÍAS</td>
                                    <td style="width:100%; color:white; font-weight:bold;font-size: 15px;">6 DÍAS</td>
                                </tr>
                            
                                <tr style="background-color: ;font-size: 15px;">                           
                                    <td style="width:100%;font-size: 15px;">#grupo0#</td>
                                    <td style="width:100%;font-size: 15px;">#grupo1#</td>
                                    <td style="width:100%;font-size: 15px;">#grupo2#</td>
                                    <td style="width:100%;font-size: 15px;">#grupo3#</td>
                                    <td style="width:100%;font-size: 15px;">#grupo4#</td>
                                    <td style="width:100%;font-size: 15px;">#grupo5#</td>
                                    <td style="width:100%;font-size: 15px;">#grupo6#</td>
                                </tr>
                            </tbody>

                        </table>
                    </td>
       
             </tr>
            </tbody>
        </table>
        ';
}