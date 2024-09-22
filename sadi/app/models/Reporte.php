<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Reporte extends Model
{
    /**[intervaloDeDias  Intervalo de dias: Calcula el intervalo de días que hay entre fecha_incial y fecha_fin, no toma en cuenta los fines de semana.]
     * @param [fecha_incial y fecha_fin ]
     * @return [Número de días que hay en el intervalo de tiempo señalado(sin tomar en cuenta los fines de semana)]
     */
    public function intervaloDeDias($fecha_inicio,$fecha_final)
    {
        $f_incio = new DateTime($fecha_inicio);
        $f_fin = new DateTime($fecha_final);
        $dias=0;
        $invtervalo_validacion = $f_incio->diff($f_fin);
        $dias_validacion = $invtervalo_validacion->days;

        if($f_incio>=$f_fin){
        }
        if($dias_validacion==0)
        {
        }
        else
        {
            //de lo contrario, se excluye la fecha de finalización
            // $f_fin->modify('+1 day');
            $invtervalo = $f_fin->diff($f_incio);
            // total dias
            $dias = $invtervalo->days;
            // crea un período de fecha iterable (P1D equivale a 1 día)
            $periodo = new DatePeriod($f_incio, new DateInterval('P1D'), $f_fin);
            // almacenado como matriz, por lo que puede agregar más de una fecha feriada
            // $holidays = array('2012-09-07');
             foreach($periodo as $dt)
                {
                    $curr = $dt->format('D');
                    // obtiene si es Sábado o Domingo
                    if($curr == 'Sat' || $curr == 'Sun') {
                        $dias--;
                    }
                    // elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                    //     $dias--;
                    // }
                }
        }
        return $dias;
        
    }

    public function honorario($data){
        $mpdf = new mPDF('L',[280,215]);
        $mpdf->defaultheaderline = 0;
        $reporte= new PdfReporte();
        $reporteheader= new PdfReporte();
        $html=$reporte->honorario;
           
        
        $HeaderHtml=$reporteheader->honorarioheader;
        $var_image_header=$HeaderHtml; 
        $var_image_header=str_replace("#logo#",basename('images/sips_documento.png'),$var_image_header);
        $mpdf->SetHeader($var_image_header);
        //footer  
        $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
            </tr>
        </table>');

        $mpdf->SetTitle('REPORTE HONORARIOS');
        $mpdf->SetAuthor('SIPS | SADI');
        $mpdf->WriteHTML($html);
        $mpdf->Output("reportes/formato_honorario.pdf", 'F');
        // $mpdf->Output();
    }


    public function helperBackgroundFormatoTruper($variable,$ubicacion_style_css){

    }


}