<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
use Phalcon\Di;
use Phalcon\Db\Adapter\Pdo;
use Intervention\Image\ImageManager;
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");
require_once ('jpgraph/src/jpgraph_legend.inc.php');
require_once ('jpgraph/src/jpgraph_canvas.php');
require_once ('jpgraph/src/jpgraph_utils.inc.php');

require_once ('jpgraph/src/jpgraph_bar.php');

/**
 * Modelo de la tabla puesto
 */
class Efectividad extends Model
{
    public function formatoPDF($grupo0,$grupo1,$grupo2,$grupo3,$grupo4,$grupo5,$grupo6, $html, $texto){
        $html=str_replace("#grupo0#",$grupo0,$html);
        $html=str_replace("#grupo1#",$grupo1,$html);
        $html=str_replace("#grupo2#",$grupo2,$html);
        $html=str_replace("#grupo3#",$grupo3,$html);
        $html=str_replace("#grupo4#",$grupo4,$html);
        $html=str_replace("#grupo5#",$grupo5,$html);
        $html=str_replace("#grupo6#",$grupo6,$html);
        $html=str_replace("#texto#",$texto,$html);
        $total=$grupo0+$grupo1+$grupo2+$grupo3+$grupo4+$grupo5+$grupo6;

        $grupo0=number_format($grupo0*100/$total, 2, ".",",");
        $grupo1=number_format($grupo1*100/$total, 2, ".",",");
        $grupo2=number_format($grupo2*100/$total, 2, ".",",");
        $grupo3=number_format($grupo3*100/$total, 2, ".",",");
        $grupo4=number_format($grupo4*100/$total, 2, ".",",");
        $grupo5=number_format($grupo5*100/$total, 2, ".",",");
        $grupo6=number_format($grupo6*100/$total, 2, ".",",");

        $data_1 = array(
            $grupo0,$grupo1,$grupo2,$grupo3,$grupo4,$grupo5,$grupo6
            );

        $data_legend_1=array(
            '0 DÍAS (%1.2f%%)',
            '1 DÍA (%1.2f%%)',
            '2 DÍAS (%1.2f%%)',
            '3 DÍAS (%1.2f%%)',
            '4 DÍAS (%1.2f%%)',
            '5 DÍAS (%1.2f%%)',
            '6 DÍAS O MÁS (%1.2f%%)'
        );
        $theme_class = new VividTheme;

        $graph = new PieGraph(900,700);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
        // $p1->SetFont(FF_ARIAL, FS_NORMAL,15);
        $p1->value->SetFont(FF_DEFAULT ,FS_NORMAL ,15);
        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        $p1->SetSize(0.42);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $graph->legend->SetFont(FF_DEFAULT, FS_NORMAL,15);
        // $graph->legend->SetFrameWeight(3);
        // $graph->legend->SetColumns(5);
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/efectividad.jpeg');

        $html=str_replace("#respuesta_1_id#",basename('graficasencuesta/efectividad.jpeg'),$html);

        return $html;
    }
}