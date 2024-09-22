<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporte extends Component
{

	public $honorario="
		<style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap');
    
            table{
                width: 100%;
            }
            table thead tr th
            {
                font-family: 'Roboto', sans-serif;
                font-size: 12px;
                background-color: #192B65;
                color:#fff;
                border:1px solid #0000;
            }
            table tbody tr td
            {
            	font-family: 'Roboto', sans-serif;
                font-size: 12px;
                padding-top: 2px;
            }
         
            p.h5
            {
                font-family: 'Roboto', sans-serif;
                margin: 0px;
                font-size: 12px;
            }
            </style>
            
            <br>
            <p class='h5'>
                <strong>Colaborador: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; #colaborador#</strong>   
            </p>
            <strong>
            
            </strong>
            <p class='h5'>
                <strong >          
                  Periodo:  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; #periodo#           
                </strong>
            </p>
            <p class='h5'>
                <strong>
                Fecha de pago: &nbsp; &nbsp; &nbsp; &nbsp; #fechapago#
                </strong>
            </p>
        
            <div>
            <br>
            <center>
            #tablaviatico#
                
            </center>
            </div>

            <br>
      
            <div>
            <center>
            #tablahonorario#
            </center>
            </div>
	";
	
	public $honorarioheader="
		<table width='100%'>
            <tr>
                <td align='left'>
                <img src='images/#logo#' height='34' alt=''>
                </td>
            </tr>
        </table> 
	";

    public $eseheaderprimera="
        <table width='100%'>
            <tr>
                <td align='left'   style='width: 200px;'>
                <img src='images/logoempresa/#logoempresa#' style='max-height:100px;' alt=''>
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
                    <th style="color:white;width:6%">A</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">DATOS PERSONALES</p></th>
                </tr>
            </tbody>
        </table>         
        <table style="border-collapse: collapse;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td id="datosFP1" style="width:40%;font-size: 10px;padding-top:20px" >LUGAR Y FECHA DE NACIMIENTO</td>
                    <td style="font-size: 10px;padding-top:20px">#ese_lugarnacimiento#, #ese_fechanacimiento#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >EDAD</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_edad# AÑOS</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >SEXO</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_sexo#</td>
                </tr>   
                <tr style="border-top-color:red;height:2px">
                    <td id="datosFP1" style="height:2px;border-collapse: collapse;font-size: 10px;padding-top:5px" >ESTADO CIVIL</td>
                    <td style="height:2px;border-collapse: collapse;font-size: 10px;padding-top:5px">#esc_id#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 5px;margin-bottom: 5px;border-style: inset">
                </td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;" >DOMICILIO  
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 6px; text-align:right;">(CALLE,NÚMERO EXTERIOR E INTERIOR).</span></td>
                    <td style="font-size: 10px">#ese_calle# #ese_numext# #ese_numint#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >COLONIA</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_colonia#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >MUNICIPIO</td>
                    <td style="font-size: 10px;padding-top:5px">#mun_id#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >C.P.</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_codpostal#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >CIUDAD O EDO.</td>
                    <td style="font-size: 10px;padding-top:5px">#est_id#</td>
                </tr>
                    <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:5px" >ENTRE CALLES DE:</td>
                    <td style="font-size: 10px;padding-top:5px">#ese_entrecalles#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 5px;margin-bottom: 5px;border-style: inset">
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
                
        </tbody>
        </table>
        <br>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">DATOS COMPROBATORIOS</td>
                </tr>
            </tbody>
        </table>
        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px;text-align:center; width:40%; ">CONCEPTO</td>
                    <td style="font-size: 10x;text-align:center">FECHA DE EXPEDICIÓN</td>
                    <td style="font-size: 10px;text-align:center">LUGAR Y FOLIO</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="width:40%;font-size: 10px; color:#044B7B">ACTA DE NACIMIENTO</td>
                    <td style="font-size: 10px;text-align:center">#cop_nacimientofecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_nacimientolugar# #cop_nacimientofolio#</td>
                </tr>   
                <tr>
                    <td style="width:40%;font-size: 10px; color:#044B7Bx">ACTA DE MATRIMONIO</td>
                    <td style="font-size: 10px;text-align:center">#cop_matrimoniofecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_matrimoniolugar# #cop_matrimoniofolio#</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="width:40%;font-size: 10px; color:#044B7B; background-color:#CCE4ED">ACTA DE NACIMIENTO DEL CÓNYUGE</td>
                    <td style="font-size: 10px;text-align:center">#cop_conyugefecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_conyugelugar# #cop_conyugefolio#</td>
                </tr>   
                <tr>
                    <td style="width:40%;font-size: 10px; color:#044B7B">ACTA DE NACIMIENTO HIJOS</td>
                    <td style="font-size: 10px;text-align:center">#cop_nacimientohijosfecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_nacimientohijoslugar# #cop_nacimientohijosfolio#</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="width:40%;font-size: 10px;color:#044B7B;background-color:#CCE4ED">COMPROBANTE DE DOMICILIO</td>
                    <td style="font-size: 10px;text-align:center">#cop_comprobantedomiciliofecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_comprobantedomiciliolugar# #cop_comprobantedomiciliofolio#</td>
                </tr>   
                <tr>
                    <td style="width:40%;font-size: 10px;color:#044B7B">CREDENCIAL DE ELECTOR</td>
                    <td style="font-size: 10px;text-align:center">#cop_credencialelectorfecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_credencialelectorlugar# #cop_credencialelectorfolio#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="width:40%;font-size: 10px;color:#044B7B;background-color:#CCE4ED">CLAVE DE REGISTRO DE POBLACIÓN C.U.R.P.</td>
                    <td style="font-size: 10px;text-align:center">#cop_curpfecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_curplugar# #cop_curpfolio#</td>
                </tr>
                    <tr>
                    <td style="width:40%;font-size: 10px;color:#044B7B">AFILIACIÓN AL I.M.S.S</td>
                    <td style="font-size: 10px;text-align:center">#cop_imssfecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_imsslugar# #cop_imssfolio#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;color:#044B7B">COMPROBANTE DE RETENCIÓN DE IMPUESTOS</td>
                    <td style="font-size: 10px;text-align:center">#cop_retencionfecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_retencionlugar# #cop_retencionfolio#</td>
                </tr>
                <tr>
                    <td style="font-size: 10px;color:#044B7B">R.F.C.</td>
                    <td style="font-size: 10px;text-align:center">#cop_rfcfecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_rfclugar# #cop_rfcfolio#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;color:#044B7B">CARTILLA DEL SERVICIO MILITAR NACIONAL</td>
                    <td style="font-size: 10px;text-align:center">#cop_cartillafecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_cartillalugar# #cop_cartillafolio#</td>
                </tr>
                        <tr>
                    <td style="font-size: 10px;color:#044B7B">LICENCIA PARA CONDUCIR</td>
                    <td style="font-size: 10px;text-align:center">#cop_licenciafecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_licencialugar# #cop_licenciafolio#</td>
                <tr/>
                    <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;color:#044B7B">VIGENCIA MIGRATORIA (PARA EXTRANJEROS)</td>
                    <td style="font-size: 10px;text-align:center">#cop_migratoriafecha#</td>
                    <td style="font-size: 10px;text-align:center">#cop_migratorialugar# #cop_migratoriafolio#</td>
                </tr>
                
        </tbody>
        </table>
        <br>    
    ';

    public $datosescolares='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">B</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">DATOS ESCOLARES</p></th>
                </tr>
            </tbody>
        </table>

        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="text-align:center;width:28%;font-size:10px">NIVEL ESCOLAR</td>
                    <td style="text-align:center;width:20%;font-size: 10px">PERIODO(MES Y AÑO)</td>
                    <td style="text-align:center;width:30%;font-size: 10px">ESCUELA</td>
                    <td style="text-align:center;font-size: 10px">CERTIFICADO</td>
                    <td style="text-align:center;font-size: 10px">PROMEDIO</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size:10px;color:#044B7B">PRIMARIA</td>
                    <td style="font-size: 10px; text-align:center">#dae_primariaperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_primariaescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_primariacertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_primariapromedio#</td>
                </tr>   
                <tr >
                    <td style="font-size:10px;color:#044B7B">SECUNDARIA</td>
                    <td style="font-size: 10px; text-align:center">#dae_secundariaperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_secundariaescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_secundariacertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_secundariapromedio#</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size:10px;color:#044B7B">CARRERA COMERCIAL</td>
                    <td style="font-size: 10px; text-align:center">#dae_comercialperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_comercialescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_comercialcertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_comercialpromedio#</td>
                </tr>   
                <tr >
                    <td style="font-size:10px;color:#044B7B">PREPARATORIA O BACHILLERATO</td>
                    <td style="font-size: 10px; text-align:center">#dae_preparatoriaperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_preparatoriaescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_preparatoriacertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_preparatoriapromedio#</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size:10px;color:#044B7B">LICENCIATURA</td>
                    <td style="font-size: 10px; text-align:center">#dae_licenciaturaperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_licenciaturaescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_licenciaturacertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_licenciaturapromedio#</td>
                </tr>   
                <tr >
                    <td style="font-size:10px;color:#044B7B">CÉDULA PROFESIONAL</td>
                    <td style="font-size: 10px; text-align:center">#dae_cedulaperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_cedulaescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_cedulacertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_cedulapromedio#</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size:10px;color:#044B7B">OTROS</td>
                    <td style="font-size: 10px; text-align:center">#dae_otroperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_otroescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_otrocertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_otropromedio#</td>
                </tr>   
                <tr >
                    <td style="font-size:10px;color:#044B7B">ESTUDIOS ACTUALES</td>
                    <td style="font-size: 10px; text-align:center">#dae_actualperiodo#</td>
                    <td style="font-size: 10px; text-align:center">#dae_actualescuela#</td>
                    <td style="font-size: 10px; text-align:center">#dae_actualcertificado#</td>
                    <td style="font-size: 10px; text-align:center">#dae_actualpromedio#</td>
                </tr>   
            </tbody>
        </table>
            
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                <td style="width:28%;font-size:10px;color:#044B7B">PERIODOS INACTIVOS</td>
                <td style="font-size: 10px">#dae_periodoinactivo#</td>
                </tr>
                <tr >
                <td style="width:28%;font-size:10px;color:#044B7B">MOTIVOS</td>
                <td style="font-size: 10px">#dae_motivo#</td>
                </tr>       
            </tbody>
        </table>
            
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                <td valign="top" style="width:28%;color:#044B7B;font-size:10px!important">NOTAS <br><span style="color:black;">#dae_notas#</span></td>
            </tr>       
            </tbody>
        </table>
    ';

    public $antecedentesocial='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
            <tr style="background-color:#192C58" >
                <th style="color:white;width:6%">C</th>
                <th colspan="2" style="text-align:center"><p style="color:white">ANTECEDENTES SOCIALES</p></th>
            </tr>
            </tbody>
        </table>

        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td id="datosFP1" style="width:40%;font-size: 10px;padding-top:2px" >ACTIVIDADES EN SU TIEMPO LIBRE</td>
                    <td style="font-size: 10px;padding-top:2px">#ans_tiempolibre#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>       
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >¿PERTENECE A ALGÚN CLUB DEPORTIVO?</td>
                    <td style="font-size: 10px;">#ans_clubdeportivo#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿QUÉ DEPORTE PRACTICA?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_deporte#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>   
                <tr>
                <td id="datosFP1" style="font-size: 10px" >¿PERTENECE A ALGÚN PUESTO SINDICAL?</td>
                    <td style="font-size: 10px">#ans_puestosindical#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿A CÚAL?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_puestonombre#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿QUÉ CARGO?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_puestocargo#</td>
                </tr>   
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >¿PERTENECE A ALGÚN PUESTO POLÍTICO?</td>
                    <td style="font-size: 10px">#ans_politico#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿A CÚAL?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_politiconombre#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿QUÉ CARGO?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_politicocargo#</td>
                </tr>       
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >¿QUÉ RELIGIÓN PROFESA?</td>
                    <td style="font-size: 10px;">#ans_religion#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:1.2px" >¿CON QUÉ FRECUENCIA?</td>
                    <td style="font-size: 10px;padding-top:1.2px">#ans_religionfrecuencia#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >¿CUÁLES SON SUS PLANES A CORTO PLAZO?</td>
                    <td style="font-size: 10px">#ans_cortoplazo#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿CUÁLES SON SUS PLANES A MEDIANO PLAZO?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_medianoplazo#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿CUÁLES SON SUS PLANES A LARGO PLAZO?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_largoplazo#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px ">¿INGIERE BEBIDAS ALCOHÓLICAS?</td>
                    <td style="font-size: 10px">#ans_bebida#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿CON QUÉ FRECUENCIA?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_bebidafrecuencia#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿ACOSTUMBRA FUMAR?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_fumar#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >¿CON QUÉ FRECUENCIA?</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ans_fumarfrecuencia#</td>
                </tr>
            </tbody>
        </table>
        
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td valign="top" style="height:90px; width:28%;color:#044B7B;font-size:12px">NOTAS <br><span style="color:black;">#ans_nota#</span></td>
                </tr>       
            </tbody>
        </table>
        <br>
    ';

    public $estadosalud='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">D</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">ESTADO GENERAL DE SALUD</p></th>
                </tr>
            </tbody>
        </table>
        
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td id="datosFP1" style="width:40%;font-size: 10px;padding-top:2px" >FECHA DE SU ÚLTIMO EXAMEN MÉDICO REALIZADO</td>
                    <td style="font-size: 10px;padding-top:2px">#ess_fechaexamenmedico#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >ESTADO DE SALUD ACTUAL</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_estadosalud#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >ENFERMEDADES CRÓNICAS QUE PADEZCA</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_enfermedadcronica#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >MEDICAMENTO QUE HABITÚA CONSUMIR</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_medicamento#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >INTERVENCIONES QUIRÚRGICAS</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_intervencionquirurgica#</td>
                </tr>   
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >ALERGÍAS</td>
                    <td style="font-size: 10px">#ess_alergia#</td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >TIPO SANGUÍNEO</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_tiposangre#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >ESTATURA</td>
                    <td style="font-size: 10px">#ess_estatura#</td>
                </tr>
                    <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >PESO</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_peso#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>   
                <tr>
                    <td id="datosFP1" style="font-size: 10px" >EN CASO DE ACCIDENTE AVISAR A:</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_avisar#</td>
                </tr>
                        <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >TELÉFONO</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_telefono#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >DIRECCIÓN</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_direccion#</td>
                </tr>
                <tr>
                    <td id="datosFP1" style="font-size: 10px;padding-top:2.4px" >PARENTESCO</td>
                    <td style="font-size: 10px;padding-top:2.4px">#ess_parentesco#</td>
                </tr>
                <tr>
                <td colspan="2">
                <hr style="  display: block;margin-top: 1.2px;margin-bottom: 1.2px;border-style: inset">
                </td>
                </tr>
            </tbody>
        </table>
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                <td valign="top" style="height:80px; width:28%;color:#044B7B;font-size:12px">NOTAS <br><span style="color:black;">#ess_nota#</span></td>
            </tr>       
            </tbody>
        </table>
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

    public $datogrupofamiliar_formato_separado='
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
    <br>
    <div style="#style_tabla_vive_con_el_candidato#">

            <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr>

                        <th colspan="2" style="text-align:center;"><p style=" color:#192C58;">VIVE CON EL CANDIDATO</p></th>
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
                    
                    </tr>   
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px;text-align:center;">#dgd_nombre0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad0#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id0#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id0#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px;text-align:center;">#dgd_nombre1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad1#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id1#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id1#</td>
                    </tr>       
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad2#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id2#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id2#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad3#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id3#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id3#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad4#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id4#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id4#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad5#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id5#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id5#</td>
                    </tr>
                
                </tbody>
                </table>
        </div>
        <div style="#style_tabla_no_vive_con_el_candidato#">
            <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                    <tbody>
                        <tr>

                            <th colspan="2" style="text-align:center;"><p style=" color:#192C58;">NO VIVE CON EL CANDIDATO</p></th>
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
                    
                    </tr>   
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px;text-align:center;">#dgd_nombre_no_vive_con0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco_no_vive_con0#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad_no_vive_con0#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id_no_vive_con0#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id_no_vive_con0#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px;text-align:center;">#dgd_nombre_no_vive_con1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco_no_vive_con1#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad_no_vive_con1#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id_no_vive_con1#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id_no_vive_con1#</td>
                    </tr>       
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre_no_vive_con2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco_no_vive_con2#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad_no_vive_con2#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id_no_vive_con2#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id_no_vive_con2#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre_no_vive_con3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco_no_vive_con3#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad_no_vive_con3#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id_no_vive_con3#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id_no_vive_con3#</td>
                    </tr>
                    <tr style="background-color:#CCE4ED">
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre_no_vive_con4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco_no_vive_con4#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad_no_vive_con4#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id_no_vive_con4#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id_no_vive_con4#</td>
                    </tr>   
                    <tr>
                        <td style="font-size: 10px;height:15px; text-align:center;">#dgd_nombre_no_vive_con5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_parentesco_no_vive_con5#</td>
                        <td style="font-size: 10px; text-align:center;">#dgd_edad_no_vive_con5#</td>
                        <td style="font-size: 10px; text-align:center;">#esc_id_no_vive_con5#</td>
                        <td style="font-size: 10px; text-align:center;">#niv_id_no_vive_con5#</td>
                    </tr>
                
                </tbody>
            </table>

        </div>
    
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

    public $situacioneconomica='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">G</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">SITUACIÓN ECONÓMICA</p></th>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="text-align:center"><p style="color:white">INGRESOS MENSUALES</p></th>
                </tr>
            </tbody>
        </table>

        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:25%; ">NOMBRE</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:25%;">PARENTESCO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:25%;">SUELDO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:25%;">APORTACIÓN</td>
                </tr>   
                <tr style="background-color:#CCE4ED;">
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre0#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco0#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo0#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion0#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre1#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco1#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo1#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion1#</td>
                </tr>       
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre2#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco2#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo2#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion2#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre3#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco3#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo3#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion3#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre4#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco4#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo4#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion4#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre5#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco5#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo5#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion5#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre6#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco6#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo6#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion6#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre7#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco7#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo7#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion7#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre8#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco8#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo8#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion8#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center">#sei_nombre9#</td>
                    <td style="font-size: 10px; text-align:center">#sei_parentesco9#</td>
                    <td style="font-size: 10px; text-align:center">#sei_sueldo9#</td>
                    <td style="font-size: 10px; text-align:center">#sei_aportacion9#</td>
                </tr>
                
                <tr >
                    <td colspan="3" style="font-size:10px; text-align: right; font-weight:bold; 10px;height:16PX">MANUTENCIÓN</td>
                    <td style="background-color:#CCE4ED;  font-size: 10px; text-align:center">  #sie_manuingresomonto#</td>
                </tr>
                <tr >
                    <td colspan="3" style="font-size:10px; text-align: right; font-weight:bold; 10px;height:16PX">TOTALES</td>
                    <td style=" font-size: 10px; text-align:center">$  #sie_totalingresos#</td>
                </tr>
        </tbody>
        </table>
        <br>
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="text-align:center"><p style="color:white">EGRESOS MENSUALES</p></th>
                </tr>
            </tbody>
        </table>

        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:50%; ">CONCEPTO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:50%;">MONTO</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16PX">ALIMENTACIÓN</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_alimentacion#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16PX">RENTA</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_renta#</td>
                </tr>       
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16PX">TELÉFONO, LUZ, AGUA</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_telluzagua#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16PX">TRANSPORTE</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_transporte#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16PX">ROPA Y CALZADO</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_ropacalzado#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16PX">ESCOLARES</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_escolares#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16PX">SERVICIO DOMÉSTICO</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_serviciodomestico#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16PX">CRÉDITOS</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_creditos#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16PX">DIVERSIONES</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_diversiones#</td>
                </tr>   
                <tr >
                    <td style="font-size: 10px;height:16PX">MANUTENCIÓN</td>
                    <td style="font-size: 10px; text-align:right">#sie_manuegresomonto#</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16PX">OTROS</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_otros#</td>
                </tr>
                <tr >
                    <td style="font-size:10px; text-align: right; font-weight:bold; 10px;height:16PX">TOTAL</td>
                    <td style=" font-size: 10px; text-align:right">$  #sie_totalegresos#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; height:20px; "></td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; height:20px; width:50%;"></td>
                </tr>   
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:50%; ">CONCEPTO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:50%;">MONTO</td>
                </tr>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px">INGRESOS MENSUALES</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_totalingresos#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px">EGRESOS MENSUALES</td>
                    <td style="font-size: 10px; text-align:right">$  #sie_totalegresos#</td>
                </tr>
                <tr >
                    <td style="font-size:10px; text-align: right; font-weight:bold; 10px;height:16PX">DIFERENCIA</td>
                    <td style="background-color:#CCE4ED; font-size: 10px ;text-align:right;" >$  #diferencia#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; height:20px; "></td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; height:20px; width:50%;"></td>
                </tr>   
                <tr >
                    <td rowspan="2" style="font-size: 10px;height:16PX; text-align:left;">¿CUÁNDO LOS EGRESOS SON MAYORES A LOS INGRESOS, CÓMO LOS SOLVENTA?</td>
                    <td style="background-color:#CCE4ED;font-size: 10px">#sie_solventa#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px"></td>
                </tr>       
                <tr >
                    <td style="font-size: 10px;height:16PX">SU SITUACION ACTUAL ANTE BURÓ DE CRÉDITO ES:</td>
                    <td style="background-color:#CCE4ED; font-size: 10px">#sie_buro#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16PX">EN CASO NEGATIVO, ¿CON QUÉ INSTITUCIÓN?</td>
                    <td style="font-size: 10px">#sie_institucion#</td>
                </tr>       
        </tbody>
        </table>
        <br>

        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="text-align:center"><p style="color:white">CRÉDITOS VIGENTES</p></th>
                </tr>
            </tbody>
        </table>

        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:25%; ">INSTITUCIÓN</td>
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:25%; ">TIPO DE CREDITO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:25%; ">SALDO</td>
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:25%; ">PAGO MENSUAL</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion0# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo0# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo0# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual0# </td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion1# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo1# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo1# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual1# </td>
                </tr>       
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion2# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo2# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo2# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual2# </td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion3# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo3# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo3# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual3# </td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion4# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo4# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo4# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual4# </td>
                </tr>   
                <tr>
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion5# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo5# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo5# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual5# </td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px;height:16px; text-align:center; "> #sec_institucion6# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_tipo6# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_saldo6# </td>
                    <td style="font-size: 10px;text-align:center;"> #sec_mensual6# </td>
                </tr>   
            </tbody>
        </table>
    ';

    public $bieninmueble='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">H</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">BIENES INMUEBLES</p></th>
                </tr>
            </tbody>
        </table>

        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
                    <th style="text-align:center;font-size: 8px"><p>
                    A CONTINUACIÓN DEBERÁ ESPECIFICAR LOS BIENES QUE SEAN DE SU PROPIEDAD O DE LOS FAMILIARES QUE ACTUALMENTE VIVEN CON USTED</p></th>
                </tr>
            </tbody>
        </table>

        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:33.33%; ">NOMBRE DEL PROPIETARIO</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:33.33%;">UBICACIÓN</td>
                    <td style="font-size: 10x; font-weight:bold; text-align:center ; width:33.33%;">VALOR DEL INMUEBLE</td>
                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre0#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion0#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor0#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre1#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion1#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor1#</td>
                </tr>       
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre2#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion2#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor2#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre3#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion3#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor3#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre4#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion4#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor4#</td>
                </tr>   
                <tr>
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre5#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion5#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor5#</td>
                </tr>
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#bid_nombre6#</td>
                    <td style="font-size: 10px; text-align:center">#bid_ubicacion6#</td>
                    <td style="font-size: 10px; text-align:center">#bid_valor6#</td>
                </tr>   
            </tbody>
        </table>

        <br>
           <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                <tbody>
                    <tr >
                    <td valign="top" style="height:100px; width:28%;color:#044B7B;font-size:12px">NOTAS <br><span style="color:black;">#bie_notasfamiliares#</span></td>
                </tr>       
                </tbody>
                </table>
                <br>
                <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="text-align:center"><p style="color:white">AUTOMÓVIL</p></th>
                </tr>
            </tbody>
        </table>
                <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; text-align:center; width:20%; ">TIPO</td>
                    <td style="font-size: 10px; font-weight:bold; text-align:center ; width:20%;">MARCA</td>
                    <td style="font-size: 10px; font-weight:bold; text-align:center ; width:20%;">MODELO</td>
                    <td style="font-size: 10px; font-weight:bold; text-align:center ; width:20%;">AÑO</td>
                    <td style="font-size: 10px; font-weight:bold; text-align:center ; width:20%;">VALOR</td>

                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#aut_tipo0#</td>
                    <td style="font-size: 10px; text-align:center">#aut_marca0#</td>
                    <td style="font-size: 10px; text-align:center">#aut_modelo0#</td>
                    <td style="font-size: 10px; text-align:center">#aut_anio0#</td>
                    <td style="font-size: 10px; text-align:center">#aut_valor0#</td>

                </tr>   
                <tr >
                    <td style="font-size: 10px; height:16px; text-align:center">#aut_tipo1#</td>
                    <td style="font-size: 10px; text-align:center">#aut_marca1#</td>
                    <td style="font-size: 10px; text-align:center">#aut_modelo1#</td>
                    <td style="font-size: 10px; text-align:center">#aut_anio1#</td>
                    <td style="font-size: 10px; text-align:center">#aut_valor1#</td>

                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#aut_tipo2#</td>
                    <td style="font-size: 10px; text-align:center">#aut_marca2#</td>
                    <td style="font-size: 10px; text-align:center">#aut_modelo2#</td>
                    <td style="font-size: 10px; text-align:center">#aut_anio2#</td>
                    <td style="font-size: 10px; text-align:center">#aut_valor2#</td>

                </tr>   

                <tr >
                    <td style="font-size: 10px; height:16px; text-align:center">#aut_tipo3#</td>
                    <td style="font-size: 10px; text-align:center">#aut_marca3#</td>
                    <td style="font-size: 10px; text-align:center">#aut_modelo3#</td>
                    <td style="font-size: 10px; text-align:center">#aut_anio3#</td>
                    <td style="font-size: 10px; text-align:center">#aut_valor3#</td>

                </tr>   
                <tr style="background-color:#CCE4ED">
                    <td style="font-size: 10px; height:16px; text-align:center">#aut_tipo4#</td>
                    <td style="font-size: 10px; text-align:center">#aut_marca4#</td>
                    <td style="font-size: 10px; text-align:center">#aut_modelo4#</td>
                    <td style="font-size: 10px; text-align:center">#aut_anio4#</td>
                    <td style="font-size: 10px; text-align:center">#aut_valor4#</td>

                </tr>   
            </tbody>
        </table>

        <br>
        
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="text-align:center"><p style="color:white">EVALUACIÓN DE LA VIVIENDA</p></th>
                </tr>
            </tbody>
        </table>
        <br>


        <table style="border-top:20px; font-family:Montserrat,sans-serif;font-weight:bold; font-size: 10px;; width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                    <td style="margin-right:4px; width:20%; text-align:right ">SERVICIOS DE LA ZONA</td>
                    <td style="margin-right:4px; width:2%; text-align:right "></td>
                    <td style="width:12%;">AGUA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_agua#</td>
                    <td style="width:12%;">DRENAJE</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_drenaje#</td>
                    <td style="width:12%;">PAVIMENTO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_pavimento#</td>
                    <td style="width:12%;">ELECTRICIDAD</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_electricidad#</td>
                    <td style="width:12%;">ESCUELAS</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_escuela#</td>
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                </tr>   
                <tr >
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                    <td style="margin-right:4px; width:20%; text-align:right ">NIVEL DE LA ZONA</td>
                    <td style="margin-right:4px; width:2%; text-align:right "></td>
                    <td style="width:12%;">ALTO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_nivelzonaalto#</td>
                    <td style="width:12%;">MEDIO ALTO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_nivelzonamedioalto#</td>
                    <td style="width:12%;">MEDIO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_nivelzonamedio#</td>
                    <td style="width:12%;">MEDIO BAJO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_nivelzonamediobajo#</td>
                    <td style="width:12%;">BAJO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_nivelzonabajo#</td>
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                </tr>   
                <tr >
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                    <td style="margin-right:4px; width:20%; text-align:right ">TIPO</td>
                    <td style="margin-right:4px; width:2%; text-align:right "></td>
                    <td style="width:12%;">CASA SOLA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_tipocasa#</td>
                    <td style="width:12%;">DUPLEX</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_tipoduplex#</td>
                    <td style="width:12%;">DEPTO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_tipodepto#</td>
                    <td style="width:12%;">CONDOMINIO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_tipocondominio#</td>
                    <td style="width:12%;">OTRO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_tipootro#</td>
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                </tr>   
                <tr >
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                    <td style="margin-right:4px; width:20%; text-align:right ">RÉGIMEN</td>
                    <td style="margin-right:4px; width:2%; text-align:right "></td>
                    <td style="width:12%;">PROPIA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_regimenpropia#</td>
                    <td style="width:12%;">RENTADA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_regimenrentada#</td>
                    <td style="width:12%;">HIPOTECARIA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_regimenhipotecaria#</td>
                    <td style="width:12%;">PRESTADA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_regimenprestada#</td>
                    <td style="width:12%;">PROVISIONAL</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_regimenprovisional#</td>
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                </tr>   
                <tr >
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                    <td style="margin-right:4px; width:20%; text-align:right ">MOBILIARIO</td>
                    <td style="margin-right:4px; width:2%; text-align:right "></td>
                    <td style="width:12%;">EXCELENTE</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_mobilarioexcelente#</td>
                    <td style="width:12%;">BUENO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_mobilariobueno#</td>
                    <td style="width:12%;">REGULAR</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_mobilarioregular#</td>
                    <td style="width:12%;">MALO</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_mobilariomalo#</td>
                    <td style="width:12%;">DEFICIENTE</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_mobilariosuficiente#</td>
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                </tr>   
                <tr >
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                    <td style="margin-right:4px; width:20%; text-align:right ">DISTRIBUCIÓN</td>
                    <td style="margin-right:4px; width:2%; text-align:right "></td>
                    <td style="width:12%;">RECÁMARAS</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_recamaras#</td>
                    <td style="width:12%;">BAÑOS</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_banos#</td>
                    <td style="width:12%;">SALA</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_sala#</td>
                    <td style="width:12%;">COMEDOR</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_comedor#</td>
                    <td style="width:12%;">GARAJE</td>
                    <td style="width:4%;text-align:center;background-color:#CCE4ED">#bie_garaje#</td>
                    <td style="margin-right:4px; width:3%; text-align:right "></td>
                </tr>   
                
            </tbody>
        </table>

        <br>

        <table style="border-top:20px; font-family:Montserrat,sans-serif;font-weight:bold; font-size: 10px;; width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="margin-right:4px; width:20%;">TIEMPO DE HABITAR EL INMUEBLE</td>
                    <td style="margin-right:4px; text-align:center; width:8.125%; text-align:right ">#bie_habitaranos#</td>
                    <td style="margin-right:4px; text-align:center; width:8.125%; text-align:right ">AÑOS</td>
                    <td style="margin-right:4px; text-align:center; width:8.125%; text-align:right ">#bie_habitarmeses#</td>
                    <td style="margin-right:4px; text-align:center; width:8.125%; text-align:right ">MESES</td>
                    
                    <td style="margin-right:12px; text-align:center; width:30%; text-align:right "></td>
                </tr>   
                <tr>
                    <td colspan="6" style="font-size: 8px">SÍ EL TIEMPO DE HABITAR EL DOMICILIO ES DE 12 MESES O MENOR, FAVOR DE ANOTAR EL DOMICILIO ANTERIOR</td>
                </tr>
                <tr>
                    <td style="height:20px;width:4%; background-color:#CCE4ED" colspan="6">#bie_domicilioanterior#</td>
                </tr>
                
            </table>
        </table>
        <br>
        <br>
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td valign="top" style="height:100px; width:28%;color:#044B7B;font-size:12px">NOTAS <br><span style="color:black;">#bie_notasvivienda#</span></td>
                </tr>       
            </tbody>
        </table>
    ';

    public $referenciaspersonalescabecera='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">I</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">REFERENCIAS PERSONALES</p></th>
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

    public $referenciasvecinalescabecera='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="text-align:center"><p style="color:white">REFERENCIAS VECINALES</p></th>
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

    public $referenciavecinal='
        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px; font-weight:bold; width:40%; ">NOMBRE</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_nombre#</td>
                </tr>   
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">TIEMPO DE CONOCER AL CANDIDATO(A)</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_tiempo#</td>
                </tr>   
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">DOMICILIO</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_domicilio#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">TELÉFONO</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_telefono#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">¿CÓMO CONCEPTÚA AL CANDIDATO(A)?</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_conceptocandidato#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">¿CÓMO CONCEPTÚA A LA FAMILIA CÓMO VECINOS?</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_conceptofamilia#</td>
                </tr>   
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">¿ESTADO CIVIL DEL CANDIDATO(A)?</td>
                    <td style="font-size: 10x; font-weight:bold; ">#esc_id#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">¿TIENE HIJOS?</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_hijos#</td>
                </tr>
                <tr >
                    <td style="font-size: 10px; font-weight:bold;">¿SABE DONDE TRABAJA?</td>
                    <td style="font-size: 10x; font-weight:bold; ">#rev_trabaja#</td>
                </tr>       
            </tbody>
        </table>
        <br>
        <table style=" border: 2px solid;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr>
                    <td valign="top" style="height:200px; width:28%;color:#044B7B;font-size:12px">NOTAS <br><span style="color:black;">#rev_notas#</span></td>
                </tr>       
            </tbody>
        </table>
        <br>
    ';

    public $referenciaslaboralescabecera='
        <table style="border-top:none;font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th style="color:white;width:6%">J</th>
                    <th colspan="2" style="text-align:center"><p style="color:white">REFERENCIAS LABORALES</p></th>
                </tr>
            </tbody>
        </table>
        <br>
        
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

    public $graficos=' 
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos"> 
            <tbody> 
                <tr style="background-color:#192C58" > 
                    <td style="text-align:center">GRÁFICOS DE LA VIVIENDA</td> 
                </tr> 
            </tbody> 
        </table> 
        <br> 
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos"> 
            <tbody> 
                <tr > 
                    <td style="font-size: 10px;text-align:center; width:43%"></td> 
                    <td style="font-size: 10px;text-align:center; width:6%"></td> 
                    <td style="font-size: 10Px;text-align:center; width:43%"></td> 
                </tr> 
                <tr > 
                    <td style="font-size:25px;text-align:center; ">IMAGEN AL INTERIOR DE LA VIVIENDA</td> 
                    <td></td> 
                    <td style="font-size:25px;text-align:center; ">IMAGEN AL EXTERIOR DE LA VIVIENDA</td> 
                </tr> 
 
                <tr > 
                    <td style="text-align:center; "><img class="_idGenObjectAttribute-1" src="archivos/#interior#" height="80%" width="100%" /></td> 
                    <td ></td> 
                    <td style="text-align:center; "><img class="_idGenObjectAttribute-1" src="archivos/#exterior#" width="100%" height="80%" /></td> 
                </tr> 
                 
                        <tr> 
                <th colspan="5" style="padding-bottom:20px;height:20px"><br></th> 
                </tr> 
                 
                <tr><td style="padding-n"></td></tr> 
                        <tr > 
                    <td style="font-size:25px;text-align:center; ">IMAGEN DE LA CALLE</td> 
                    <td></td> 
                    <td style="font-size:25px;text-align:center; ">IMAGEN DEL MAPA</td> 
                </tr> 
 
                <tr > 
                    <td style="text-align:center; "><img class="_idGenObjectAttribute-1" src="archivos/#calle#" height="80%" width="100%" /></td> 
                    <td ></td> 
                    <td style="text-align:center; "><img class="_idGenObjectAttribute-1" src="archivos/#mapa#" width="100%" height="80%" /></td> 
                </tr> 
                 
            </tbody> 
        </table> 
        <br> 
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos"> 
            <tbody> 
                <tr> 
                    <td style="font-size: 10px;text-align:center; width:26%; "><img class="_idGenObjectAttribute-1" src="images/firmas/#firma#" width="280px" /><br>SIPS se compromete a manejar la información recabada con profesionalismo, discreción y confidencialidad</td> 
                    <td style="height:70px; width:6%"></td> 
                    <td style="height:70px; width:35%; text-align:right"><img class="_idGenObjectAttribute-1" src="temp/#qr#" height:"100px" width="150px" /></td> 
                    <td valign="top" style=" width:10%;font-size:10px; text-align:left"> 
                    <br><br> 
                    #folioqr# <br> #fechaqr#</td> 
                </tr> 
            </tbody> 
        </table> 
    ';

    public $eseportadaargos='
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
                    <td align="right" style="width: 200px;">
                        <br>
                        <img src="archivos/#rostro#" style="max-height:150px;" height="" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom:0px;font-weight: bold;text-align:center;color:#00205B;font-family:Montserrat,sans-serif;font-size:22px">ESTUDIO SOCIOECONÓMICO Y LABORAL</td>
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
                <th style="padding-bottom:5px"></th>
                </tr>
            </tbody>
        </table>

        <table style="border-top:none; font-family:Montserrat,sans-serif; width:100%" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <th colspan="5" style="padding-bottom:10px;padding-top:5px;color:white;text-align:center; font-weight:bold; ">RESUMEN GENERAL</th>
                </tr>
                
                <tr >
                    <td style="padding-bottom:10px;padding-top:10px;width:6%"></td>
                    <td style="padding-bottom:10px;padding-top:10px;width:44%"></td>
                    <td style="padding-bottom:10px;padding-top:10px;text-align:left;font-weight: bold;">APROPIADO</td>
                    <td style="padding-bottom:10px;padding-top:10px;text-align:left;font-weight: bold;">PROMEDIO</td>
                    <td style="padding-bottom:10px;padding-top:10px;text-align:left;font-weight: bold;">INAPROPIADO</td>
                </tr>   
                
                <tr>
                    <td id="letras"> A </td>
                    <td id="datosFP1" style="font-weight: bold">DATOS PERSONALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #cop_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #cop_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #cop_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
                </tr>
                <tr>
                    <td id="letras"> B </td>
                    <td id="datosFP1" style="font-weight: bold;">DATOS ESCOLARES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dae_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dae_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dae_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
                </tr>
                <tr>
                    <td id="letras"> C </td>
                    <td id="datosFP1" style="font-weight: bold;">ANTECEDENTES SOCIALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ans_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ans_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ans_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
                </tr>
                <tr>
                    <td id="letras"> D </td>
                    <td id="datosFP1" style="font-weight: bold;">ESTADO GENERAL DE SALUD</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ess_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ess_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #ess_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
                </tr>
                <tr>
                    <td id="letras"> E </td>
                    <td id="datosFP1" style="font-weight: bold;">DATOS DEL GRUPO FAMILIAR</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dgf_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dgf_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #dgf_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
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
                </tr>
                <tr>
                    <td id="letras"> G </td>
                    <td id="datosFP1" style="font-weight: bold;">SITUACIÓN ECONÓMICA</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sie_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sie_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sie_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
                </tr>
                <tr>
                    <td id="letras"> H </td>
                    <td id="datosFP1" style="font-weight: bold;">BIENES INMUEBLES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #bie_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #bie_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #bie_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
                </tr>
                <tr>
                    <td id="letras"> I </td>
                    <td id="datosFP1" style="font-weight: bold;">REFERENCIAS PERSONALES</td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sep_calificaciona# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sep_calificacionp# </td>
                    <td style="color: #134B7B; font-weight: bold;text-align:center"> #sep_calificacioni# </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px"></td>
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

    public $anexos_v1='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">ANEXOS</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                <tr >

                    #anexo_style_dinamico_selfie_rosto#
                    
                </tr>
                <tr >
                     <td  style="font-size:25px;text-align:center; "><p style="#anexo_selfie_style_dinamico# ">SELFIE</p></td>
                <td style="text-align:center;">
                    #foto_unica_selfie_rostro_titulo#
                </td>
                    <td    style="font-size:25px;text-align:center;"> <p style="#anexo_rostro_candidato_style_dinamico# ">ROSTRO DEL CANDIDATO</p></td>
                </tr>

                <tr >
                    <td   style="text-align:center;  #anexo_selfie_style_dinamico#">
                         <img class="_idGenObjectAttribute-1" src="archivos/#anexo_selfie#" height="100%" width="100%"  style="#anexo_selfie_style_dinamico# " />
                    </td>

                    <td style="text-align:center;"> 
                    #foto_unica_selfie_rostro#

                    </td>

                    <td   style="text-align:center;  #anexo_rostro_candidato_style_dinamico# ">
                         <img class="_idGenObjectAttribute-1" src="archivos/#anexo_rostro_candidato#" height="100%" width="100%"   style="#anexo_rostro_candidato_style_dinamico# "/>
                    </td>
                </tr>
            
                
            </tbody>
        </table>
        <br>
      
        <br>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px;text-align:center; width:100%"></td>
                   
                </tr>

                <tr >
                <td style="text-align:center; ">
                    <p style=" #style_aviso_de_privacidad#">AVISO DE PRIVACIDAD</p> 
                </td>
                </tr>
            </tbody>
        </table>
        
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px;text-align:center; width:43%"></td>
                    <td style="font-size: 10px;text-align:center; width:6%"></td>
                    <td style="font-size: 10Px;text-align:center; width:43%"></td>
                </tr>
    

              #filas_dinamicas_aviso_privacidad#
        

            
                
            </tbody>
        </table>
    
   


        <br>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold; display:none;" class="tableDatos">
                <tbody>
                    <tr >
                        <td style="font-size: 10px;text-align:center; width:100%"></td>
                    
                    </tr>

                    <tr >
                    <td style="text-align:center; "> 
                    <p style=" #style_dinamico_mostrados_en_visita#">DOCUMENTOS MOSTRADOS EN LA VISITA</p>
                     </td>
                    </tr>
                </tbody>
         </table>

         <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                <tr >
                    <td style="font-size: 10px;text-align:center; width:43%"></td>
                    <td style="font-size: 10px;text-align:center; width:6%"></td>
                    <td style="font-size: 10Px;text-align:center; width:43%"></td>
                </tr>
    

                #filas_dinamicas_documentos_mostrados_en_visita#

                
            </tbody>
         </table>


    ';
     public $anexos='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">ANEXOS</td>
                </tr>
            </tbody>
        </table>
        <br>

      
      

   


        <br>

         <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                
                 #style_dinamico_anexos_archivos#

                #filas_dinamicas_anexos_archivos#


                
            </tbody>
         </table>


    ';

    public $anexosemanacotizada='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">SEMANAS COTIZADAS</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
    ';

    public $anexoreferencias='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                
            </tbody>
        </table>
    ';

	public function contrarecibohtml(){
		$contrarecibo=Configuracion::findFirstBycon_id(1);

		return $contrarecibo->con_contrarecibo;
	}

	public function contrarecibofooter(){
		$contrarecibo=Configuracion::findFirstBycon_id(1);

		return $contrarecibo->con_contrarecibofooter;
	}

    public $anexosreferenciascabecera='
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold;color:white" class="tableDatos">
            <tbody>
                <tr style="background-color:#192C58" >
                    <td style="text-align:center">REFERENCIA LABORAL VÍA CORREO</td>
                </tr>
            </tbody>
        </table>
    ';

    public $anexosreferencias='
        <br>
        <table style="font-family:Montserrat,sans-serif;  width:100%; font-weight:bold" class="tableDatos">
            <tbody>
                #style_dinamico_anexos_archivos#
                #filas_dinamicas_anexos_archivos#                
            </tbody>
        </table>
    ';
}