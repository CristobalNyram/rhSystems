<?php
use Phalcon\Mvc\Model;
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");
require_once ('jpgraph/src/jpgraph_legend.inc.php');
require_once ('jpgraph/src/jpgraph_canvas.php');
require_once ('jpgraph/src/jpgraph_utils.inc.php');

require_once ('jpgraph/src/jpgraph_bar.php');

/**
 * Modelo cascaron para el pdf
 */
class Encuesta_calidad_cascaron_pdf extends Model
{
    public $font_size_comentarios_pdf='12px';
    public function formatoPDFHoja1_GraficasCirculares($data_encabezado, $array_texto_preg, $array_texto_opciones, $array_estadisticas_opciones, $imagen_id, $html, $inv_id = 0, $preguntasParam = []) {
        // Arrays de preguntas
        $array_preguntas = $preguntasParam;
      
        $ke1=$array_preguntas[0];
        $ke2=$array_preguntas[1];
        $text_ke1= $array_texto_preg[$ke1];
        $text_ke2= $array_texto_preg[$ke2];
        // Arrays para almacenar datos y leyendas
        $data = array();
        $data_legend = array();
    
        // Generar datos y leyendas para cada pregunta
        foreach ($array_preguntas as $pregunta) {
            // Obtener los arrays de estadísticas y textos de respuesta para la pregunta actual
            $array_estadisticas_preg = $array_estadisticas_opciones[$pregunta];
            $array_textos_respuesta_preg = $array_texto_opciones[$pregunta];
            // error_log(print_r($array_estadisticas_opciones,true));
            // Obtener el texto de la pregunta
            $texto_pregunta = $array_texto_preg[$pregunta];
            // Generar los datos y leyendas para la pregunta actual
            $data_pregunta = array();
            $data_legend_pregunta = array();
            foreach ($array_estadisticas_preg as $indice => $opcion) {
                $data_pregunta[] = $opcion["porcentaje_total"];
                $data_legend_pregunta[] =  $opcion["opcion_texto"] . ' (%1.2f%%)';

            }
    
            // Almacenar los datos y leyendas para la pregunta actual
            $data[] = $data_pregunta;
            $data_legend[] = $data_legend_pregunta;
        }
    
        // Generar gráficos y guardar imágenes
        $theme_class = new VividTheme();
        $imagen_ids = array(); // Array para almacenar los nombres de archivo de las imágenes generadas
    
        foreach ($data as $indice => $datos) {
            $graph = new PieGraph(600, 300);
            $graph->SetTheme($theme_class);
            $graph->legend->SetFont(FF_DEFAULT, FS_NORMAL, 7); // Leyenda

            $p = new PiePlot($datos);
            $p->SetLegends($data_legend[$indice]);
            $p->SetSize(0.39);
            $graph->legend->SetPos(0.5, 0.99, 'center', 'bottom');

            $graph->Add($p);
    
            // Generar un nombre de archivo único y guardar la imagen
            $imagen_actual_id = $imagen_id . '_' . ($indice + 1); // Añadir un sufijo único
            $graph->Stroke('./graficasencuesta/respuesta-' . $imagen_actual_id . '.jpeg');
            $imagen_ids[] = $imagen_actual_id; // Guardar el nombre de archivo generado
        }
    
        // Sustituir elementos en el HTML
        foreach ($imagen_ids as $indice => $imagen_actual_id) {
            $html = str_replace("#respuesta_" . ($indice + 1) . "_id#", basename('graficasencuesta/respuesta-' . $imagen_actual_id . '.jpeg'), $html);
            $html = str_replace("#respuesta_" . ($indice + 1) . "_legend#", implode(", ", $data_legend[$indice]), $html);
        }
    
        // Sustituir otros elementos en el HTML
        $html = str_replace("#cantidad_enc#", trim($data_encabezado['total_encuestas_contestadas']), $html);
        $html = str_replace("#cantidad_ese#", trim($data_encabezado['total_eses']), $html);
        $html = str_replace("#fecha_consulta#", trim($data_encabezado['fecha_consulta']), $html);
        if ($inv_id != 0) {
            $investigador = Usuario::findFirstByusu_id($inv_id);
            $html = str_replace("#reporte_inv_nombre#", ' realizados por el investigador ' . trim($investigador->getNombreObj()), $html);
        } else {
            $html = str_replace("#reporte_inv_nombre#", trim(''), $html);
        }
    
        $html = str_replace("#pregunta_1#", trim($text_ke1), $html);
        $html = str_replace("#pregunta_2#", trim($text_ke2), $html);
    
        return $html;
    }
    
    
    public function formatoPDFHoja1_GraficasBarras($data_encabezado, $array_texto_preg, $array_texto_opciones, $array_estadisticas_opciones, $imagen_id, $html, $inv_id = 0,$preguntasParam=[]) {
        // Arrays de preguntas
        $array_preguntas =$preguntasParam;
        // print_r($preguntasParam);
        //  die();
        $ke1=$array_preguntas[0];
        $ke2=$array_preguntas[1];
        $text_ke1= $array_texto_preg[$ke1];
        $text_ke2= $array_texto_preg[$ke2];

        // Arrays para almacenar datos y leyendas
        $data = array();
        $data_legend = array();
    
        // Generar datos y leyendas para cada pregunta
        foreach ($array_preguntas as $pregunta) {
            // Obtener los arrays de estadísticas y textos de respuesta para la pregunta actual
            $array_estadisticas_preg = $array_estadisticas_opciones[$pregunta];
            $array_textos_respuesta_preg = $array_estadisticas_opciones[$pregunta];
    
            // Obtener el texto de la pregunta
            $texto_pregunta = $array_texto_preg[$pregunta];
    
            // Generar los datos y leyendas para la pregunta actual
            $data_pregunta = array();
            $data_legend_pregunta = array();
            foreach ($array_estadisticas_preg as $indice => $opcion) {
                $porcentaje = number_format($opcion["porcentaje_total"], 2);
                $data_pregunta[] = $porcentaje;
                $data_legend_pregunta[] = $array_textos_respuesta_preg[$indice]['opcion_texto'] . ' (' . $porcentaje . '%)';
            }
    
            // Almacenar los datos y leyendas para la pregunta actual
            $data[] = $data_pregunta;
            $data_legend[] = $data_legend_pregunta;
        }
    
        // Generar gráficos y guardar imágenes
        $theme_class = new VividTheme();
    
        foreach ($data as $indice => $datos) {
            $graph = new Graph(700, 300);
            $graph->SetScale("textlin");
            $graph->SetTheme($theme_class);
            $graph->xaxis->SetTickLabels($data_legend[$indice]);
    
            $p = new BarPlot($datos);
    
            $graph->img->SetImgFormat('jpeg');
            $graph->xaxis->SetFont(FF_DEFAULT, FS_NORMAL, 7);
            $graph->Add($p);
            $graph->Stroke('./graficasencuesta/respuesta-' . ($indice + 1) . '-' . $imagen_id . '.jpeg');
        }
    
        // Sustituir elementos en el HTML
        $html = str_replace("#respuesta_1_id#", basename('graficasencuesta/respuesta-1-' . $imagen_id . '.jpeg'), $html);
        $html = str_replace("#respuesta_2_id#", basename('graficasencuesta/respuesta-2-' . $imagen_id . '.jpeg'), $html);
    
        $html = str_replace("#cantidad_enc#", trim($data_encabezado['total_encuestas_contestadas']), $html);
        $html = str_replace("#cantidad_ese#", trim($data_encabezado['total_eses']), $html);
        $html = str_replace("#fecha_consulta#", trim($data_encabezado['fecha_consulta']), $html);    
        if ($inv_id != 0) {
            $investigador = Usuario::findFirstByusu_id($inv_id);
            $html = str_replace("#reporte_inv_nombre#", ' realizados por el investigador ' . trim($investigador->getNombreObj()), $html);
        } else {
            $html = str_replace("#reporte_inv_nombre#", trim(''), $html);
        }
    
        $html = str_replace("#pregunta_1#", trim($text_ke1), $html);
        $html = str_replace("#pregunta_2#", trim($text_ke2), $html);

        return $html;
    }

    public function formatoPDFHojaDinamica_GraficasBarras($array_texto_preg,$array_texto_opciones,
    $array_estadisticas_opciones,    $imagen_id,$html,
    $arrayParamKeysPreg=["erl_p3_0_v1","erl_p3_0_v2"],
    $arrayParamKeyImg=[3,4],
    $arrayParamFontsize=[12,12])
    {
       
        $key1=$arrayParamKeysPreg[0];
        $key2=$arrayParamKeysPreg[1];
        $keyImagen1=$arrayParamKeyImg[0];
        $keyImagen2=$arrayParamKeyImg[1];
        $valueFontSize1=$arrayParamFontsize[0];
        $valueFontSize2=$arrayParamFontsize[1];

        $array_estadisticas_preg_1=$array_estadisticas_opciones[$key1];
        $array_estadisticas_preg_2=$array_estadisticas_opciones[$key2];
        $texto_pre_1=$array_texto_preg[$key1];
        $texto_pre_2=$array_texto_preg[$key2];
        $nameImg1='./graficasencuesta/respuesta-'.$keyImagen1.'-'.$imagen_id.'.jpeg';
        $nameImg2='./graficasencuesta/respuesta-'.$keyImagen2.'-'.$imagen_id.'.jpeg';
        $noHayPreg='./graficasencuesta/hoja_blanca.png';


        $data_1 = [];
        $data_legend_1 = [];

        foreach ($array_estadisticas_preg_1 as $item) {
            $porcentaje_1 = number_format($item["porcentaje_total"], 2);
            $data_1[] = $porcentaje_1;
            $data_legend_1[] = $item['opcion_texto'] . ' (' . $porcentaje_1 . '%)';
        }
        

        if ($key2!=null) {
            $data_2 = [];
            $data_legend_2 = [];
            foreach ($array_estadisticas_preg_2 as $item) {
                $porcentaje_2 = number_format($item["porcentaje_total"], 2);
                $data_2[] = $porcentaje_2;
                $data_legend_2[] = $item['opcion_texto'] . ' (' . $porcentaje_2 . '%)';
            }
            
        }
    
        //establecemos el tema
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
       

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
      

        //grafica 2
        if ($key2!=null) {
            $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
            $graph_2->SetScale("textlin");
            $graph_2->ClearTheme();
            $graph_2->SetTheme($theme_class);
            $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
            $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
            $p2 = new BarPlot($data_2);
            $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,$valueFontSize1);
            $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,$valueFontSize2);
        }
      
    

        //imprimimos y  guardamos la imagen
        $graph->Add($p1);
        $graph->Stroke($nameImg1);
        if ($key2!=null) {
            $graph_2->Add($p2);
            $graph_2->Stroke($nameImg2);
        }
     
        //sustiumos elementos inicio
        $html=str_replace("#respuesta_3_id#",basename($nameImg1),$html);
        if ($key2!=null) {
            $html=str_replace("#respuesta_4_id#",basename($nameImg2),$html);
        }else {
            $html=str_replace("#respuesta_4_id#",basename($noHayPreg),$html);
        }

        $html=str_replace("#pregunta_3#",trim($texto_pre_1),$html);
        if ($key2!=null) {
            $html=str_replace("#pregunta_4#",trim($texto_pre_2),$html);
        }else {
            $html=str_replace("#pregunta_4#",trim(""),$html);
        }
        //sustiumos elementos fin
        return $html;
    }

    public function formatoPDFHojaDinamica_GraficasCircular(
    $array_texto_preg, $array_texto_opciones, 
    $array_estadisticas_opciones,
    $imagen_id, $html, 
    $arrayParamKeysPreg = ["erl_p3_0_v1", "erl_p3_0_v2"], 
    $arrayParamKeyImg = [3, 4],
    $arrayParamFontsize=[11,11]
    ) {
    

        $key1 = $arrayParamKeysPreg[0];
        $key2 = $arrayParamKeysPreg[1];
        $keyImagen1 = $arrayParamKeyImg[0];
        $keyImagen2 = $arrayParamKeyImg[1];
        $valueFontSize1=$arrayParamFontsize[0];
        $valueFontSize2=$arrayParamFontsize[1];
       
        $array_estadisticas_preg_1 = $array_estadisticas_opciones[$key1];
        $array_estadisticas_preg_2 = $array_estadisticas_opciones[$key2];
        // var_dump($arrayParamFontsize);
        // die();
        $texto_pre_1 = $array_texto_preg[$key1];
        $texto_pre_2 = $array_texto_preg[$key2];
        $nameImg1 = './graficasencuesta/respuesta-' . $keyImagen1 . '-' . $imagen_id . '.jpeg';
        $nameImg2 = './graficasencuesta/respuesta-' . $keyImagen2 . '-' . $imagen_id . '.jpeg';
    
        $data_1 = [];
        $data_legend_1 = [];
    
        foreach ($array_estadisticas_preg_1 as $item) {
            $data_1[] = $item["porcentaje_total"];
            $data_legend_1[] = $item['opcion_texto'] . ' (%1.2f%%)';
        }
    
        $data_2 = [];
        $data_legend_2 = [];
        if ($key2!=null) {
          
            foreach ($array_estadisticas_preg_2 as $item) {
                $data_2[] = $item["porcentaje_total"];
                $data_legend_2[] = $item['opcion_texto'] . ' (%1.2f%%)';
            }
        }

    
    
        // Verificar si todos los datos son cero
        $all_zero_1 = array_sum($data_1) == 0;
        $all_zero_2 = array_sum($data_2) == 0;
    
        if ($all_zero_1 && $all_zero_2) {
            // Si todos los datos son cero, agregamos la imagen de error y terminamos la función
            return str_replace("#respuesta_3_id#", 'error_no_hay_info.png', str_replace("#respuesta_4_id#", 'error_no_hay_info.png', $html));
        }
    
        $theme_class = new VividTheme;
    
        $graph = new PieGraph(800, 400);
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);
        $graph->img->SetImgFormat('jpeg');
        $p1 = new PiePlot($data_1);
        $p1->SetSize(0.38);
        $graph->legend->SetPos(0.5, 0.98, 'center', 'bottom');
        $p1->value->SetFont(FF_DEFAULT, FS_NORMAL, $valueFontSize1);
        $graph->legend->SetFont(FF_DEFAULT, FS_NORMAL, $valueFontSize1);
        $p1->SetLegends($data_legend_1);
    
        $graph_2 = new PieGraph(800, 400);
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img->SetImgFormat('jpeg');
        $p2 = new PiePlot($data_2);
        $p2->SetSize(0.38);
        $graph_2->legend->SetPos(0.5, 0.98, 'center', 'bottom');
        $graph_2->legend->SetFont(FF_DEFAULT, FS_NORMAL, $valueFontSize2);
        $p2->value->SetFont(FF_DEFAULT, FS_NORMAL, $valueFontSize2);
        $p2->SetLegends($data_legend_2);

        $graph->Add($p1);
        $graph_2->Add($p2);
    
        if (!$all_zero_1) {
            $graph->Stroke($nameImg1);
        } else {
            copy(APP_PATH.'public/graficasencuesta/error_no_hay_info.png', $nameImg1);
        }
    
        if (!$all_zero_2) {
            $graph_2->Stroke($nameImg2);
        } else {
            if($key2==null){
                copy(APP_PATH.'public/assets/images/sistema/hoja_blanca.png', $nameImg2);
            }else{
                copy(APP_PATH.'public/graficasencuesta/error_no_hay_info.png', $nameImg2);
            }
        }
    
        $html = str_replace("#respuesta_3_id#", basename($nameImg1), $html);
        $html = str_replace("#respuesta_4_id#", basename($nameImg2), $html);
        $html = str_replace("#pregunta_3#", trim($texto_pre_1), $html);
        $html = str_replace("#pregunta_4#", trim($texto_pre_2), $html);
    
        return $html;
    }
    



    public function formatoPDFHojaDinamicaComentarios($texto_pregunta, $data_comentarios, $html, $mpdf) {
        # SELECTORES DE PDF INICIO 
        $tabla_respuestas_id = "#tabla_respuestas_7_1#";
        $respuesta_sin_data_comentarios_id = "#respuesta_sin_data_comentarios#";
        $pregunta_texto_id = "#pregunta_7_1#";
        # SELECTORES DE PDF FIN 
    
        $data_procesada = [];
        $html_plantilla = '';
        $filas_por_tabla = 29;
        $index_texto_pregunta = 5;
        $texto_pregunta = $texto_pregunta;
    
        // Filtrar los campos que tengan algo en el campo texto
        foreach ($data_comentarios as $key) {
            if ($key['erl_texto'] != null) {
                array_push($data_procesada, $key);
            }
        }
    
        if (count($data_procesada) > 0) {
            $filas = '';
            $contador_filas = 0;
            $html_tabla = '';
    
            // Verificar si existe la clave 'respueta_previa' en al menos un elemento de $data_procesada
            $respueta_previa_exists = false;
            foreach ($data_procesada as $index => $key) {
                if (isset($key['respueta_previa'])) {
                    $respueta_previa_exists = true;
                    break;
                }
            }
            usort($data_procesada, function($a, $b) {
                return strcmp($a['inv_nombre'], $b['inv_nombre']);
            });
    
            // Construir el encabezado de la tabla <thead> y agregar la columna 'Respuesta Previa' si existe 'respueta_previa'
            $html_tabla .= '
            <table colspan="100%" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:'.$this->font_size_comentarios_pdf.';">
                <thead>';
                $html_tabla .='<tr class="trowhead" style="background:#233840;">';
                if ($respueta_previa_exists) {
                    $html_tabla .= '<th style="width:10%; color:white; font-weight:bold;">Respuesta Previa</th>';
                }
                $html_tabla .=' <th style="width:70%; color:white; font-weight:bold;">Comentario</th>';
                $html_tabla .=' <th style="width:20%; color:white; font-weight:bold;">Investigador</th>';
          
            $html_tabla .= '</tr>
                </thead>';
    
            foreach ($data_procesada as $index => $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size:'.$this->font_size_comentarios_pdf.';"> ';  
                if (isset($key['respueta_previa'])) {
                    // Agregar la columna 'Respuesta Previa' si existe 'respueta_previa'
                    $fila .= '<td style="width:10%; font-size:'.$this->font_size_comentarios_pdf.';">'.$key['respueta_previa'].'</td>';
                }                      
                $fila .='          <td style="width:70%; font-size:'.$this->font_size_comentarios_pdf.';">'.$key['erl_texto'].'</td>';
                $fila .='              <td style="width:20%; font-size:'.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>';
               
                $fila .= '</tr>';
                $filas .= $fila;
                $contador_filas++;
            }
    
            $html_tabla .= '<tbody style="width:100%; padding:2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';">'.$filas.'</tbody></table>';
    
            $html_plantilla = $html;
            $html_plantilla = str_replace($tabla_respuestas_id, $html_tabla, $html_plantilla);
            $html_plantilla = str_replace($respuesta_sin_data_comentarios_id, '', $html_plantilla);
            $html_plantilla = str_replace($pregunta_texto_id, $texto_pregunta, $html_plantilla);
            $answer = ['html' => $html_plantilla, 'existe_info' => count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        } else {
            // No existen datos  
            $html = str_replace($respuesta_sin_data_comentarios_id, 'Sin comentarios', $html);
            $html = str_replace($tabla_respuestas_id, '', $html);
            $html = str_replace($pregunta_texto_id, $texto_pregunta, $html);
            $answer = ['html' => $html, 'existe_info' => count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }
    
        return $answer;
    }
    

    public function limpiarImagenesGeneradasReporteRespuestas($id,$count=17){
        $dir = './graficasencuesta/';
        
        for ($i = 1; $i <= $count; $i++) {
            $archivo = $dir . 'respuesta-' . $i . '-' . $id . '.jpeg';
            if (file_exists($archivo)) {
                unlink($archivo);
            } else {
         
            }
        }
    }
    public function  ImagenesGeneradasReporteRespuestasv2($id) {
        $dir = './graficasencuesta/';
        $pattern = '/^respuesta-[0-9]+-' . preg_quote($id, '/') . '\.jpeg$/';
        $archivos = scandir($dir);
        foreach ($archivos as $archivo) {
            if (is_file($dir . $archivo)) {
                if (preg_match($pattern, $archivo)) {
                    unlink($dir . $archivo);
                }
            }
        }
    }
    function obtenerFechaTextoFormatoLeible($fechaInicial, $fechaFin = null) {
        // Verifica si la fecha inicial es nula o vacía
        if ($fechaInicial === null || trim($fechaInicial) === '') {
            return ""; // Si la fecha inicial es nula o vacía, retorna un espacio en blanco
        }

        // Verifica si la fecha inicial tiene un formato válido
        if (!strtotime($fechaInicial)) {
            return ""; // Si la fecha inicial no es válida, retorna un espacio en blanco
        }
    
        // Convierte la fecha inicial en formato de día/mes/año
        $fechaInicialFormateada = date("d/m/Y", strtotime($fechaInicial));

        // Si se proporciona una fecha final, verifica su validez
        if ($fechaFin !== null && trim($fechaFin) !== '') {
          
            // Verifica si la fecha final tiene un formato válido
            if (!strtotime($fechaFin)) {
                return ""; // Si la fecha final no es válida, retorna un espacio en blanco
            }
    
            // Convierte la fecha final en formato de día/mes/año
            $fechaFinFormateada = date("d/m/Y", strtotime($fechaFin));
    
            // Construye el mensaje con ambas fechas
            $mensaje = "desde la fecha $fechaInicialFormateada hasta la fecha $fechaFinFormateada";
        } else {
            // Si no se proporciona una fecha final, construye el mensaje solo con la fecha inicial
            $mensaje = "desde la fecha $fechaInicialFormateada";
        }
    
        return $mensaje;
    }
    

}
