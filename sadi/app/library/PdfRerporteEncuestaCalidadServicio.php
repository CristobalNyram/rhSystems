<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfRerporteEncuestaCalidadServicio extends Component
{

        public $html_completo = '


        <div id="current_date"></p>
    
    
        ';

        public $cabezera_hoja=' 
          
        

            <table cellspacing="0" style=" width:100% ; border-collapse: collapse; margin:810px 0px 0px 0px; padding:0px 0px 0px 0px;">
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
                                <td colspan="8" style="font-family:Calibri, sans-serif;font-size:20;text-align:start;font-weight: bold;"> Resultados de Evaluaciones</td>
                            </tr>
                        </tbody>
                </table>  ';

        public $cabezera_hoja_FORMATONUEVO=' 
          
        

            <table cellspacing="0" style=" width:100% ; border-collapse: collapse; margin:810px 0px 0px 0px; padding:0px 0px 0px 0px;">
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
                                <td colspan="7" style="font-family:Calibri, sans-serif;font-size:20;text-align:start;font-weight: bold;"> #titulo_header#</td>
                            </tr>
                        </tbody>
                </table>  ';



        public $header_hoja=' 
        <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
        <tbody>
                <tr><td style="height:10px border: 1px solid #FF6600;  "></td></tr>
                <tr   >
            

                    <td colspan="8" style="color:white; font-family:Calibri, sans-serif;font-size:14;background-color:white;
                    color:black;text-align:left;font-weight: bold;border:none">
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
            
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
        
            <tr>
            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr style="text-align:justify;  text-justify: distribute;">
            <td colspan="20" style="height:90px; border:;font-family:Calibri, sans-serif;font-size:13;text-align:justify;  text-justify: distribute;">
            Se realizaron #cantidad_enc# encuestas de un total de  #cantidad_ese# estudios#reporte_inv_nombre#, evaluando a los investigadores en el mes de #reporte_mes# #reporte_anio# con la finalidad de medir el desempeño, la satisfacción de los candidatos, el tiempo de respuesta e identificar las áreas de oportunidad en el servicio prestado.
            </td>
            </tr>
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_1#

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
            <td colspan="20" style="height:10px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
            #pregunta_2#

            </td>
            </tr>
          
            <tr>
            
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_2_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>



            
            


                     
        </tbody>
    </table>
        
        ';

        public $hoja_1_FORMATONUEVO='
        
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
            <tr style="text-align:justify;  text-justify: distribute;">
            <td colspan="20" style="height:90px; border:;font-family:Calibri, sans-serif;font-size:13;text-align:justify;  text-justify: distribute;">
            Se realizaron #cantidad_enc# encuestas de un total de  #cantidad_ese# estudios #reporte_inv_nombre#, evaluando a los investigadores #fecha_consulta# con la finalidad de medir el desempeño, la satisfacción de los candidatos, el tiempo de respuesta e identificar las áreas de oportunidad en el servicio prestado.
            </td>
            </tr>
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_1#

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
            <td colspan="20" style="height:10px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
            #pregunta_2#

            </td>
            </tr>
          
            <tr>
            
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_2_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>



            
            


                     
        </tbody>
    </table>
        
        '; 

    public $hoja_2='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_3#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_3_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>

            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>

            <tr>
                    <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                        #pregunta_4#

                    </td>

         
            </tr>

            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_4_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            



            
            


                     
        </tbody>
    </table>
    
    
    ';

    
    public $hoja_3='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_5#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>

            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_5_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>

            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_6#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
            <td>
            <td colspan="20" style="height:20px">
            <img src="graficasencuesta/#respuesta_6_id#" height="400" alt="">

            </td>
            </td>
        </tr>
        
            



            
            


                     
        </tbody>
    </table>
    
    
    ';


    
    public $hoja_4='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_7#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_7_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>

            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_8#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_8_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>



            
            


                     
        </tbody>
    </table>
    
    
    ';

    
    public $hoja_5='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_9#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_9_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>

            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_10#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>

            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_10_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            



            
            


                     
        </tbody>
    </table>
    
    
    ';


    public $hoja_6='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_11#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_11_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_12#

            </td>

            </tr>

            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_12_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            



            
            


                     
        </tbody>
    </table>
    
    
    ';


    public $hoja_7='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_13#

            </td>

            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_13_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>

            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_14#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>

            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_14_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            



            
            


                     
        </tbody>
    </table>
    
    
    ';

    public $hoja_8='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_15#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_15_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            <tr>
            <td colspan="20" style="height:30px"></td>
            </tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_16#

            </td>

            </tr>

            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_16_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>
            



            
            


                     
        </tbody>
    </table>
    
    
    ';

    public $hoja_9='
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
            
            </tr>

            <tr>
            <tr>
            <td colspan="20" style="height:20px; border:;font-family:Calibri, sans-serif;font-size:11;text-align:center; margin-top">
                #pregunta_17#

            </td>

            <td colspan="20" style="height:20px"></td>
            </tr>
            <tr>
                <td>
                <td colspan="20" style="height:20px">
                <img src="graficasencuesta/#respuesta_17_id#" height="400" alt="">
    
                </td>
                </td>
            </tr>

         
            



            
            


                     
        </tbody>
    </table>
    
    
    ';

    public $hoja_9_1='
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
            <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:white;color:black;text-align:left;font-weight: bold;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTADO DE RESPUESTA DE PREGUNTA: #pregunta_7_1#</td>
            </tr>
            

      
       
           



            
            


                     
        </tbody>
    </table>

    <div>
        <center>
        <p style="text-align:center;  ">
        #respuesta_sin_data_comentarios# 
        </p>
            #tabla_respuestas_7_1#
        </td>
        </center>
    </div>
    
    
    ';

    public $hoja_10='
    <table cellspacing="0" style=" width:100% ; border-collapse: collapse;">
    <tbody>
            <tr>
                <td style="width:25%"></td>
                <td style="width:25%"></td>
                <td style="width:25%"></td>
                <td style="width:25%"></td>
        
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
            <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:white;color:black;text-align:left;font-weight: bold;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTADO DE RESPUESTA DE PREGUNTA: #pregunta_8_1#</td>
            </tr>

          
          

         
            

          
           



            
            


                     
        </tbody>
    </table>
    <div>
        <center>
        <p style="text-align:center;  ">
        #respuesta_sin_data_comentarios# 
        </p>
            #tabla_respuestas_8_1#
        </td>
        </center>
    </div>
    
    
    ';


    public $hoja_11='
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
            <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:white;color:black;text-align:left;font-weight: bold;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTADO DE RESPUESTA DE PREGUNTA: #pregunta_12_1#</td>
            </tr>
            
          
          
           



            
            


                     
        </tbody>
    </table>
    <div>
        <center>
        <p style="text-align:center;  ">
        #respuesta_sin_data_comentarios# 
        </p>
            #tabla_respuestas_12_1#
        </td>
        </center>
    </div>
    ';


    
    public $hoja_12='
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
            <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:white;color:black;text-align:left;font-weight: bold;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTADO DE RESPUESTA DE PREGUNTA: #pregunta_15_1#</td>
            </tr>
            
         
          
           



            
            


                     
        </tbody>
    </table>
    <div>
        <center>
        <p style="text-align:center;  ">
        #respuesta_sin_data_comentarios# 
        </p>
            #tabla_respuestas_15_1#
        </td>
        </center>
    </div>
    
    ';

    
    
    public $hoja_13='
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
            <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:white;color:black;text-align:left;font-weight: bold;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTADO DE RESPUESTA DE PREGUNTA: #pregunta_17_1#</td>
            </tr>
            

   
           



            
            


                     
        </tbody>
    </table>
    <div>
        <center>
        <p style="text-align:center;  ">
        #respuesta_sin_data_comentarios# 
        </p>
            #tabla_respuestas_17_1#
        </td>
        </center>
    </div>
    
    ';
    
    public $hoja_14='
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
            <td colspan="20" style="font-family:Calibri, sans-serif;font-size:14;background-color:white;color:black;text-align:left;font-weight: bold;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTADO DE RESPUESTA DE PREGUNTA: #pregunta_18#</td>
            </tr>
            
     
          
           



            
            


                     
        </tbody>
    </table>
    <div>
        <center>
        <p style="text-align:center;  ">
        #respuesta_sin_data_comentarios# 
        </p>
            #tabla_respuestas_18#
        </td>
        </center>
    </div>
    ';


}