<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class PruebaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Reporte - PDF');
        parent::initialize();
    }

    public function formato_honorarioAction(){
        
        $this->view->disable();
        $mpdf = new mPDF('utf-8','A4-L');
        $this->response->setHeader('Cache-Control', 'max-age=0');
        $this->response->setHeader('Content-Type', 'application/pdf');

        // para poder aplicar estilos con el style,debes expecificar la etiqueta y después su clase ejemplo:span.ejemplo{}
        $html = "
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap');
       
      
    
            table{
                width: 100%;   
               
             
            }
            table thead tr th
            {
                font-family: 'Roboto', sans-serif;
                font-weight: lighter;

                background-color: #192B65;
                color:#fff;
                border:1px solid #0000;
            }
            table tbody tr td
            {
                padding-top: 2px;

            }
        
         
            p.h5
            {
                font-family: 'Roboto', sans-serif;

            }

        
            img
            {
               with:80px;
               height:80px;
            }

          
        </style>

       
       
        <br>
        <br>
        <br>
        
            <p class='h5'>
                <strong>Colaborador: XXXXXXXXX</strong>   
            </p>
            <strong>
            
            </strong>
            <p class='h5'>
                    <strong  style='border: none;'>          
                      Periodo: XXXXXX         AL            XXXXX
                    </strong>
            </p>
            <p class='h5'>
                    <strong>
                    Fecha de pago: XXXXXX
                    </strong>
            </p>
    
        
        <div>
            <center>
                <table style='width:100%'>
                    <thead >
                        <tr class='trowhead'>
                            <th >
                                <center>ID</center>
                                
                            </th>
                            <th >
                                <center>
                                NOMBRE DE CANDIDATO
                                </center>
                            </th>
                            <th >
                            <center>
                                ESTADO
                            </center>
                            </th>
                            <th >
                            <center>
                                MUNICIPIO
                            </center>
                            </th>
                            <th >
                                                        <center>
                                                            FECHA ENTREGA CLIENTE
        
                                                        </center>
                            </th>
                            <th >
                                <center>
                                PAGO VIATICO 
                            </center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                                <td  >
                                    <center>
                                    examples
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    example
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    example
                                    </center>
                                
                                </td>
                                <td>
                                    <center>
                                    example
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    example
                                    </center>
                                </td>
                                <td>
                                <center> 
                                    example
                                </center>
                                </td>
                        </tr>
                        <tr >
                        <td  >
                            <center>
                            examples
                            </center>
                        </td>
                        <td>
                            <center>
                            example
                            </center>
                        </td>
                        <td>
                            <center>
                            example
                            </center>
                        
                        </td>
                        <td>
                            <center>
                            example
                            </center>
                        </td>
                        <td>
                            <center>
                            example
                            </center>
                        </td>
                        <td>
                        <center> 
                            example
                        </center>
                        </td>
                </tr>
                <tr >
                <td  >
                    <center>
                    examples
                    </center>
                </td>
                <td>
                    <center>
                    example
                    </center>
                </td>
                <td>
                    <center>
                    example
                    </center>
                
                </td>
                <td>
                    <center>
                    example
                    </center>
                </td>
                <td>
                    <center>
                    example
                    </center>
                </td>
                <td>
                <center> 
                    example
                </center>
                </td>
        </tr>
                        
                
                    </tbody>
                </table>
            </center>
        </div>

        <br>
      
        <div>
        <center>
            <table style='width:100%'>
                <thead >
                    <tr class='trowhead'>
                        <th >
                            <center>ID</center>
                            
                        </th>
                        <th >
                            <center>
                            NOMBRE DE CANDIDATO
                            </center>
                        </th>
                        <th >
                        <center>
                            ESTADO
                        </center>
                        </th>
                        <th >
                        <center>
                            MUNICIPIO
                        </center>
                        </th>
                        <th >
                                                    <center>
                                                        FECHA ENTREGA CLIENTE
    
                                                    </center>
                        </th>
                        <th >
                            <center>
                            PAGO HONORARIO 
                        </center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                            <td  >
                                <center>
                                examples
                                </center>
                            </td>
                            <td>
                                <center>
                                example
                                </center>
                            </td>
                            <td>
                                <center>
                                example
                                </center>
                            
                            </td>
                            <td>
                                <center>
                                example
                                </center>
                            </td>
                            <td>
                                <center>
                                example
                                </center>
                            </td>
                            <td>
                            <center> 
                                example
                            </center>
                            </td>
                    </tr>
                    <tr >
                    <td  >
                        <center>
                        examples
                        </center>
                    </td>
                    <td>
                        <center>
                        example
                        </center>
                    </td>
                    <td>
                        <center>
                        example
                        </center>
                    
                    </td>
                    <td>
                        <center>
                        example
                        </center>
                    </td>
                    <td>
                        <center>
                        example
                        </center>
                    </td>
                    <td>
                    <center> 
                        example
                    </center>
                    </td>
            </tr>
            <tr >
            <td  >
                <center>
                examples
                </center>
            </td>
            <td>
                <center>
                example
                </center>
            </td>
            <td>
                <center>
                example
                </center>
            
            </td>
            <td>
                <center>
                example
                </center>
            </td>
            <td>
                <center>
                example
                </center>
            </td>
            <td>
            <center> 
                example
            </center>
            </td>
    </tr>
                    
            
                </tbody>
            </table>
        </center>
    </div>
        
        
                ";
     

       
        
        $HeaderHtml="
                <table width='100%'  style='border: none;'>
                    <tr  style='border: none;'>
                        <td width='33%' align='left'  style='border: none;'>
                        <img src='images/#logo#' alt=''>
                        </td>
                    </tr>
                </table>    
        ";
        $var_image_header=$HeaderHtml; 
        $var_image_header=str_replace("#logo#",basename('images/sips_logo_fondo_blanco_color_azul.jpg'),$var_image_header);
        $mpdf->SetHeader($var_image_header);


            //footer  

            $mpdf->SetHTMLFooter('
            <table width="100%">
                <tr>
                    <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
                </tr>
            </table>');
            ///footer

 
        // $var_image=$html; 
        // $var_image=str_replace("#logo#",basename('images/sips_logo_fondo_blanco_color_azul.jpg'),$var_image);

        $mpdf->SetTitle('REPORTE HONORARIOS');
        $mpdf->SetAuthor('SIPS | SADI');
        $mpdf->WriteHTML($html);
        $mpdf->Output("reportes/formato_honorario.pdf", 'F');
        
        //out put in browser below output function
        $mpdf->Output();

    }

    public function revisionAction(){
        $this->view->disable();
        $soporte= new Soporte();
        return $soporte->generarencuesta(1);
    }


}