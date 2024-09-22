<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Di;
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");
require_once ('jpgraph/src/jpgraph_legend.inc.php');
require_once ('jpgraph/src/jpgraph_canvas.php');
require_once ('jpgraph/src/jpgraph_utils.inc.php');
require "mpdf/index.php";
require_once ('jpgraph/src/jpgraph_bar.php');
/*
 * Modelo de la tabla Encuesta_calidad_2024_enero
 */
class Encuesta_calidad_2024_enero extends Model
{
    public $nombre_tabla="encuesta_calidad_2024_enero";
    public $enc_version="2024_enero";
    public $enc_preguntas_abiertas_pdf=true;
    public $condiciones_personalizadas=true;
    public $configuracion_personalizada_graficas=true;
    public $configuracion_titulo_pdf=true;

    public $preguntas=
    [
        "erl_p1_0_v0"=>"¿CÓMO FUE LA ATENCIÓN QUE LE BRINDÓ NUESTRO PERSONAL EN EL PRIMER CONTACTO?",
        "erl_p1_1_v0"=>"¿POR QUÉ?",
        "erl_p2_0_v0"=>"¿EL ESTUDIO SOCIOECONÓMICO SE REALIZO PRESENCIAL O VÍA TELEFÓNICA?",
        "erl_p3_0_v1"=>"UNA VEZ AGENDADA LA CITA ¿CUÁNTOS DÍAS DESPUÉS SE REALIZÓ LA INVESTIGACIÓN? (PRESENCIAL)",
        "erl_p3_0_v2"=>"UNA VEZ AGENDADA LA CITA ¿CUÁNTOS DÍAS DESPUÉS SE REALIZÓ LA INVESTIGACIÓN? (TELEFÓNICA)",
        "erl_p4_0_v1"=>"¿EL INVESTIGADOR SE PRESENTÓ DE MANERA PUNTUAL? (PRESENCIAL)",
        "erl_p4_0_v2"=>"¿EL INVESTIGADOR LE LLAMÓ EN EL HORARIO ACORDADO? (TELEFÓNICA)",
        "erl_p5_0_v1"=>"¿EL INVESTIGADOR LE MOSTRÓ CREDENCIAL DE SIPS RH? (PRESENCIAL)",
        "erl_p5_0_v2"=>"¿EL INVESTIGADOR SE IDENTIFICÓ? (TELEFÓNICA)",
        "erl_p6_0_v1"=>"¿EL INVESTIGADOR PORTABA PLAYERA DE SIPS RH?",
        
        "erl_p7_0_v1"=>"¿CÓMO FUE EL TRATO QUE LE BRINDÓ EL INVESTIGADOR DURANTE LA VISITA? (PRESENCIAL)",
        "erl_p7_0_v2"=>"¿CÓMO FUE EL TRATO QUE LE BRINDÓ EL INVESTIGADOR DURANTE LA LLAMADA? (TELEFÓNICA)",
        "erl_p7_1_v1"=>"¿POR QUÉ?",
        "erl_p7_1_v2"=>"¿POR QUÉ?",
        "erl_p8_0_v1"=>"¿EL INVESTIGADOR LE PRESENTÓ Y EXPLICÓ EL AVISO DE PRIVACIDAD ANTES  DE INICIAR CON LA INVESTIGACIÓN? (PRESENCIAL)",
        "erl_p8_0_v2"=>"¿EL INVESTIGADOR LE COMPARTIÓ Y EXPLICÓ EL AVISO DE PRIVACIDAD ANTES  DE INICIAR CON LA INVESTIGACIÓN? (TELEFÓNICA)",
        "erl_p9_0_v1"=>"¿QUÉ TIEMPO DURÓ LA VISITA? (PRESENCIAL)",
        "erl_p9_0_v2"=>"¿QUÉ TIEMPO DURÓ LA LLAMADA?  (TELEFÓNICA)",
        "erl_p10_0_v1"=>"¿LE FUERON TOMADAS LAS FOTOGRAFÍAS AL MOMENTO DE LA VISITA?",
        "erl_p10_0_v2"=>"AL MOMENTO DE AGENDAR LA CITA, LE INFORMARON DE LAS FOTOGRAFÍAS REQUERIDAS",
        "erl_p11_0_v1"=>"EL INVESTIGADOR VISITÓ A SUS VECINOS PARA SOLICITARLES REFERENCIAS ",
        "erl_p12_0_v1"=>"¿EL INVESTIGADOR LE PIDIÓ EL ENVÍO DE ALGÚN DOCUMENTO, POR MEDIOS ELECTRONICOS",
        "erl_p12_1_v1"=>"¿QUÉ DOCUMENTO O INFORMACIÓN LE COMPARTIÓ Y POR QUÉ MEDIO SE LO HIZO LLEGAR?",
        "erl_p13_0_v1"=>"¿EL INVESTIGADOR SOLICITÓ ALGÚN TIPO DE APOYO O AYUDA, YA SEA ECONÓMICO, DE ORIENTACIÓN O ALGÚN OTRO TIPO?",
        "erl_p13_1_v1"=>"¿QUÉ TIPO DE AYUDA LE SOLICITÓ?",
        "erl_p13_2_v1"=>"ESPECIFICAR",
        "erl_p14_0_v0"=>"¿EL INVESTIGADOR LE GENERÓ CONFIANZA?",
        "erl_p14_1_v0"=>"¿POR QUÉ?",
        "erl_p15_0_v0"=>"¿CÓMO CALIFICA LA CALIDAD DEL SERVICIO EN GENERAL?",
        "erl_p16_0_v0"=>"EN QUE ÁREA CONSIDERA PODEMOS MEJORAR EL SERVICIO BRINDADO",
        "erl_p17_0_v0"=>"OBSERVACIONES GENERALES",
    ];
    public function construirConsultaTelefonicaPresencial($columna_pregunta, $opciones,$condicion) {
        $condicion1 = '';
        $condicion2 = '';
    
        $posicion_p2ia1 = strpos($condicion, "and erl.erl_p2_0_v0='P2IA1'");
        $posicion_p2ia2 = strpos($condicion, "and erl.erl_p2_0_v0='P2IA2'");
        

        if ($posicion_p2ia1 !== false) {
            $condicion = substr_replace($condicion, '', $posicion_p2ia1, strlen("and erl.erl_p2_0_v0='P2IA1'"));
        } elseif ($posicion_p2ia2 !== false) {
            $condicion = substr_replace($condicion, '', $posicion_p2ia2, strlen("and erl.erl_p2_0_v0='P2IA2'"));
        }

    
        if ($condicion != null  or $condicion != "") {
            $condicion1 = 'erl1.' . $columna_pregunta . ' IS NOT NULL
            AND erl1.' . $columna_pregunta . ' != ""
            AND enc1.enc_estatus = 3
            AND erl1.erl_estatus = 2
            AND ' . str_replace(["erl.", "ese.", "enc."], ["erl1.", "ese1.", "enc1."], $condicion);
    
            $condicion2 = 'erl2.' . $columna_pregunta . ' IS NOT NULL
            AND erl2.' . $columna_pregunta . ' != ""
            AND enc2.enc_estatus = 3
            AND erl2.erl_estatus = 2
            AND ' . str_replace(["erl.", "ese.", "enc."], ["erl2.", "ese2.", "enc2."], $condicion);
        }
    
        $sql = 'SELECT 
                    opciones.opcion,
                    opciones.opcion_texto,
                    IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) AS total_respuestas,
                    IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) * 100.0 / (
                        SELECT  COUNT(*)
                        FROM encuesta_calidad_2024_enero erl1
                        LEFT JOIN encuesta enc1 ON enc1.enc_id = erl1.enc_id
                        LEFT JOIN estudio ese1 ON ese1.ese_id = enc1.ese_id
                        WHERE ' . $condicion1 . '
                    ) AS porcentaje_total,
                    (
                        SELECT COUNT(*)
                        FROM encuesta_calidad_2024_enero erl2
                        LEFT JOIN encuesta enc2 ON enc2.enc_id = erl2.enc_id
                        LEFT JOIN estudio ese2 ON ese2.ese_id = enc2.ese_id
                        WHERE ' . $condicion2 . '
                    ) AS total_respuestas_general
                FROM (';
    
        foreach ($opciones as $key => $value) {
            $sql .= 'SELECT "' . $key . '" AS opcion, "' . $value . '" AS opcion_texto ';
            $sql .= 'UNION ALL ';
        }
        $sql = rtrim($sql, 'UNION ALL ');
        $sql .= ') AS opciones
        LEFT JOIN encuesta_calidad_2024_enero erl ON erl.' . $columna_pregunta . ' = opciones.opcion
        LEFT JOIN encuesta enc ON enc.enc_id = erl.enc_id
        LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id';
    
        if (!empty($condicion)) {
            $sql .= ' WHERE ' . $condicion;
        }
    
        $sql .= ' GROUP BY opciones.opcion, opciones.opcion_texto, erl.erl_p2_0_v0;';
        return $sql;
    }
    
    public $respuestas_preguntas= [
        "erl_p1_0_v0"=> [
            "P1A1"=>"MALA",
            "P1A2"=>"REGULAR",
            "P1A3"=>"BUENA",
            "P1A4"=>"EXCELENTE",
        ],
        "erl_p2_0_v0"=> [
            "P2IA1"=>"PRESENCIAL",
            "P2IA2"=>"POR TELÉFONO",
        ],

        "erl_p3_0_v1"=> [
            "A1"=>"EL MISMO DÍA",
            "A2"=>"AL DÍA SIGUIENTE",
            "A3"=>"2 DÍAS DESPUÉS",
            "A4"=>"MÁS DE 3 DÍAS",
        ],
        "erl_p3_0_v2"=> [
            "A1"=>"EL MISMO DÍA",
            "A2"=>"AL DÍA SIGUIENTE",
            "A3"=>"2 DÍAS DESPUÉS",
            "A4"=>"MÁS DE 3 DÍAS",
        ],
        "erl_p4_0_v1"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p4_0_v2"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p5_0_v1"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p5_0_v2"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p6_0_v1"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p7_0_v1"=> [
            "A1"=>"MALO",
            "A2"=>"REGULAR",
            "A3"=>"BUENO",
            "A4"=>"EXCELENTE",
        ],
        "erl_p7_0_v2"=> [
            "A1"=>"MALO",
            "A2"=>"REGULAR",
            "A3"=>"BUENO",
            "A4"=>"EXCELENTE",
        ],
        "erl_p8_0_v1"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],"erl_p8_0_v2"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p9_0_v1"=> [
            "A1"=>"MENOS DE 15 MIN.",
            "A2"=>"DE 15 A 30 MIN.",
            "A3"=>"DE 30 A 60 MIN.",
            "A4"=>"MÁS DE 60 MIN..",
        ],
        "erl_p9_0_v2"=> [
            "A1"=>"MENOS DE 15 MIN.",
            "A2"=>"DE 15 A 30 MIN.",
            "A3"=>"DE 30 A 60 MIN.",
            "A4"=>"MÁS DE 60 MIN.",
        ],
        "erl_p10_0_v1"=> [
            "A1"=>"SI",
            "A2"=>"NO",
            "A3"=>"NO APLICA",
        ],
        "erl_p10_0_v2"=> [
            "A1"=>"SI",
            "A2"=>"NO",
            "A3"=>"NO APLICA",
        ],
        "erl_p11_0_v1"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],"erl_p11_0_v2"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p12_0_v1"=> [
            "A1"=>"SÍ, ANTES DE LA ENTREVISTA",
            "A2"=>"SÍ, EN LA ENTREVISTA",
            "A3"=>"SÍ, DESPUÉS DE LA ENTREVISTA",
            "A4"=>"NO",

        ],
        "erl_p13_0_v1"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],"erl_p14_0_v2"=> [
            "Y"=>"SI",
            "N"=>"NO",
        ],
        "erl_p13_1_v1"=> [
            "A1"=>"ORIENTACIÓN",
            "A2"=>"TRANSPORTE",
            "A3"=>"ECONÓMICA",
            "A4"=>"OTRO",
        ],
        "erl_p14_0_v0"=> [
            "Y"=>"SI",
            "N"=>"NO",
           
        ],
        "erl_p15_0_v0"=> [
            "A1"=>"MALO",
            "A2"=>"REGULAR",
            "A3"=>"BUENO",
            "A4"=>"EXCELENTE",
        ],
        
    ];
    public $pregunta_numero_orden_general=
    [
        "erl_p1_0_v0"=>"1",
        "erl_p1_1_v0"=>"1.1",
        "erl_p2_0_v0"=>"2",
        "erl_p3_0_v1"=>"3",
        "erl_p3_0_v2"=>"3",
        "erl_p4_0_v1"=>"4",
        "erl_p4_0_v2"=>"4",
        "erl_p5_0_v1"=>"5",
        "erl_p5_0_v2"=>"5",
        "erl_p6_0_v1"=>"6",
        "erl_p7_0_v1"=>"7",
        "erl_p7_0_v2"=>"7",
        "erl_p7_1_v1"=>"7.1",
        "erl_p7_1_v2"=>"7.1",
        "erl_p8_0_v1"=>"8",
        "erl_p8_0_v2"=>"8",
        "erl_p9_0_v1"=>"9",
        "erl_p9_0_v2"=>"9",
        "erl_p10_0_v1"=>"10",
        "erl_p10_0_v2"=>"10",
        "erl_p11_0_v1"=>"11",
        "erl_p12_0_v1"=>"12",
        "erl_p12_1_v1"=>"12.1",
        "erl_p13_0_v1"=>"13",
        "erl_p13_1_v1"=>"13.1",
        "erl_p13_2_v1"=>"13.2",
        "erl_p14_0_v0"=>"14",
        "erl_p14_1_v0"=>"14.1",
        "erl_p15_0_v0"=>"15",
        "erl_p16_0_v0"=>"16",
        "erl_p17_0_v0"=>"17",
    ];
    #V1=PRESENCIAL
    #V2 VIRTIUAL
    #V0 NEUTRAL
    public $pregunta_numero_orden_pdf_presencial=
    [
        "erl_p3_0_v2"=>"3",
        "erl_p4_0_v2"=>"4",
        "erl_p5_0_v2"=>"5",
        "erl_p7_0_v2"=>"7",
        "erl_p7_1_v2"=>"7.1",
        "erl_p10_0_v2"=>"10",
        "erl_p8_0_v2"=>"8",
        "erl_p9_0_v2"=>"9",

        "erl_p3_0_v1"=>"2",
        "erl_p4_0_v1"=>"3",
        "erl_p5_0_v1"=>"4",
        "erl_p6_0_v1"=>"5",
        "erl_p7_0_v1"=>"6",
        "erl_p7_1_v1"=>"6.1",
        "erl_p8_0_v1"=>"7",
        "erl_p10_0_v1"=>"9",
        "erl_p11_0_v1"=>"10",
        "erl_p12_0_v1"=>"11",
        "erl_p12_1_v1"=>"11.1",
        "erl_p13_0_v1"=>"12",
        "erl_p13_1_v1"=>"12.1",
        "erl_p13_2_v1"=>"12.2",
        
        "erl_p14_1_v0"=>"13.1",
        "erl_p15_0_v0"=>"14",
        "erl_p16_0_v0"=>"15",
        "erl_p17_0_v0"=>"16",
        
        "erl_p1_0_v0"=>"1",
        "erl_p1_1_v0"=>"1.1",
        "erl_p2_0_v0"=>"2",

        "erl_p9_0_v1"=>"8",
        "erl_p14_0_v0"=>"13",
      
    ];
    public $pregunta_numero_orden_pdf_virtual=
    [
        "erl_p3_0_v2"=>"2",
        "erl_p4_0_v2"=>"3",
        "erl_p5_0_v2"=>"4",
        "erl_p7_0_v2"=>"5",
        "erl_p7_1_v2"=>"5.1",
        "erl_p8_0_v2"=>"6",
        "erl_p9_0_v2"=>"7",
        "erl_p10_0_v2"=>"8",
        //  inicio
        "erl_p14_0_v0"=>"9",
        "erl_p14_1_v0"=>"9.1",
        "erl_p15_0_v0"=>"10",
        "erl_p16_0_v0"=>"11",
        "erl_p17_0_v0"=>"12",
        
        "erl_p1_0_v0"=>"1",
        "erl_p1_1_v0"=>"1.1",
        "erl_p2_0_v0"=>"2",

        "erl_p9_0_v1"=>"8",

        "erl_p3_0_v1"=>"2",
        "erl_p4_0_v1"=>"3",
        "erl_p5_0_v1"=>"4",
        "erl_p6_0_v1"=>"5",
        "erl_p7_0_v1"=>"6",
        "erl_p7_1_v1"=>"6.1",
        "erl_p8_0_v1"=>"7",
        "erl_p10_0_v1"=>"9",
        "erl_p11_0_v1"=>"10",
        "erl_p12_0_v1"=>"11",
        "erl_p12_1_v1"=>"11.1",
        "erl_p13_0_v1"=>"12",
        "erl_p13_1_v1"=>"12.1",
        "erl_p13_2_v1"=>"12.2",
        
    
      
    ];
  
    #formato general 
    public $elementos_por_pagina = array(
        array("erl_p1_0_v0", "erl_p2_0_v0"),
        array("erl_p3_0_v1", "erl_p3_0_v2"),
        array("erl_p4_0_v1", "erl_p4_0_v2"),
        array("erl_p5_0_v1", "erl_p5_0_v2"),
        array("erl_p7_0_v1", "erl_p7_0_v2"),
        array("erl_p8_0_v1", "erl_p8_0_v2"),
        array("erl_p9_0_v1", "erl_p9_0_v2"),
        array("erl_p10_0_v1", "erl_p10_0_v2"),
        array("erl_p11_0_v1", "erl_p12_0_v1"),
        array("erl_p13_0_v1", "erl_p13_1_v1"),
        array("erl_p14_0_v0", "erl_p15_0_v0")
    );

    #formato general
    public $medidas_graficas_barras_texto = array(
        array(11,11),
        array(10,10),
        array(11,11),
        array(11,11),
        array(11,11),
        array(11,11),
        array(11,11),
        array(11,11),
        array(11,7),
        array(11,11),
        array(11,11),
        array(11,11),
    );
    #formato general general 
    public $medidas_graficas_circular_texto = array(
        array(11,11),
        array(10,10),
        array(11,11),
        array(11,11),
        array(11,11),
        array(11,11),
        array(9,9),
        array(9,9),
        array(9,7.5),
        array(9,9),
        array(9,9),
        array(11,11),
    );

    #formato/filtro presencial para el PDF
    public $elementos_por_pagina_presencialOLD = array(
        array("erl_p1_0_v0", "erl_p2_0_v0"),
        array("erl_p3_0_v1", "erl_p4_0_v1"),
        array("erl_p5_0_v1", "erl_p6_0_v1"),
        array("erl_p7_0_v1", "erl_p8_0_v1"),
        array("erl_p9_0_v1", "erl_p10_0_v1"),
        array("erl_p11_0_v1", "erl_p12_0_v1"),
        array("erl_p13_0_v1", "erl_p13_1_v1"),
        array("erl_p14_0_v0", "erl_p15_0_v0")
    );
    public $elementos_por_pagina_presencial = array(
        array("erl_p1_0_v0", "erl_p3_0_v1"),
        array("erl_p4_0_v1", "erl_p5_0_v1"),
        array("erl_p6_0_v1", "erl_p7_0_v1"),
        array("erl_p8_0_v1", "erl_p9_0_v1"),
        array("erl_p10_0_v1", "erl_p11_0_v1"),
        array("erl_p12_0_v1", "erl_p13_0_v1"),
        array("erl_p13_1_v1", "erl_p14_0_v0"),
        array("erl_p15_0_v0", null)
    );
    


    #formato/filtro tel para el PDF
    public $elementos_por_pagina_telefonicaOLD = array(
        array("erl_p1_0_v0", "erl_p2_0_v0"),
        array("erl_p3_0_v2", "erl_p4_0_v2"),
        array("erl_p5_0_v2", "erl_p7_0_v2"),
        array("erl_p8_0_v2", "erl_p9_0_v2"),
        array("erl_p10_0_v2", "erl_p14_0_v0"),
        array("erl_p15_0_v0",null)
    );
    public $elementos_por_pagina_telefonica =array(
        array("erl_p1_0_v0", "erl_p3_0_v2"),
        array("erl_p4_0_v2", "erl_p5_0_v2"),
        array("erl_p7_0_v2", "erl_p8_0_v2"),
        array("erl_p9_0_v2", "erl_p10_0_v2"),
        array("erl_p14_0_v0", "erl_p15_0_v0"),
    );
    


       #formato telefonica
       public $medidas_graficas_barras_texto_telefonica = array(
        array(11,11),
        array(10,10),
        array(11,9),
        array(7,9),
        array(11,11),
        array(11,11),
    );
    #formato telefonica 
    public $medidas_graficas_circular_texto_telefonica = array(
        array(11,11),
        array(12,12),
        array(9,12),
        array(9,12),
        array(12,9),
        array(11,11),
    );
     #formato presencial
     public $medidas_graficas_barras_texto_presencial = array(
        array(7,7),
        array(10,10),
        array(10,10),
        array(10,7),
        array(10,10),
        array(6.2,10),
        array(10,10),
        array(10,10),
        array(10,7),
        array(10,10),
        array(10,10),
        array(10,10),
    );
    #formato presencial 
    public $medidas_graficas_circular_texto_presencial = array(
        array(11,11),
        array(13,13),
        array(13,11),
        array(13,9),
        array(12,13),
        array(7,13),
        array(9,13),
        array(9,9),
        array(9,5),
        array(9,7),
        array(9,7),
        array(11,11),
    );


    // textos para la seccion de titulo de las ultimas hojas de comentarios
    public function getPreguntasTextoAbiertoParaReportePDF($dataParam=[]){
        $data=array();

        $enc_formato = isset($dataParam["enc_formato"]) && trim($dataParam["enc_formato"]) !== '' ? $dataParam["enc_formato"] : 'general';
        $enc_formato_texto_preg='VISITA/LLAMADA';
        switch ($enc_formato) {
            case 'presencial':
                $enc_formato_texto_preg='VISITA';
                break;
            case 'telefonica':
                $enc_formato_texto_preg='LLAMADA';
                break;
         
        }
        // error_log($enc_formato);
        $data=
        [
            "p1_1_v0"=> $this->getPreguntaNumeroText("erl_p1_1_v0",$enc_formato).".".$this->getPreguntaText("erl_p1_0_v0").",".$this->getPreguntaText("erl_p1_1_v0"),
            "p7_1_v0"=> $this->getPreguntaNumeroText("erl_p7_1_v1",$enc_formato)."."."¿CÓMO FUE EL TRATO QUE LE BRINDÓ EL INVESTIGADOR DURANTE LA ".$enc_formato_texto_preg." ?".",".$this->getPreguntaText("erl_p7_1_v1"),
            "p12_1_v1"=> $this->getPreguntaNumeroText("erl_p12_1_v1",$enc_formato).".".$this->getPreguntaText("erl_p12_1_v1"),
            "p13_2_v1"=> $this->getPreguntaNumeroText("erl_p13_1_v1",$enc_formato).".".$this->getPreguntaText("erl_p13_1_v1").",".$this->getPreguntaText("erl_p13_2_v1"),
            "p14_1_v0"=> $this->getPreguntaNumeroText("erl_p14_0_v0",$enc_formato).".".$this->getPreguntaText("erl_p14_0_v0").",".$this->getPreguntaText("erl_p14_1_v0"),
            "p15_0_v0"=> $this->getPreguntaNumeroText("erl_p15_0_v0",$enc_formato).".".$this->getPreguntaText("erl_p15_0_v0"),
            "p16_0_v0"=> $this->getPreguntaNumeroText("erl_p16_0_v0",$enc_formato).".".$this->getPreguntaText("erl_p16_0_v0"),
            "p17_0_v0"=>$this->getPreguntaNumeroText("erl_p17_0_v0",$enc_formato).".".$this->getPreguntaText("erl_p17_0_v0"),
        ];

        return $data;    
    } 
    //textos para formato requerido para el reporte 
    public function getPreguntasFormatoPDFGraficas($data= []) {
        $answer = [];
        $lista_numero_preguntas= [];
        $enc_formato = isset($data["enc_formato"]) && trim($data["enc_formato"]) !== '' ? $data["enc_formato"] : 'general';
        switch ($enc_formato) {
            case 'presencial':
                $lista_numero_preguntas= $this->pregunta_numero_orden_pdf_presencial;
                break;
            case 'telefonica':
                $lista_numero_preguntas= $this->pregunta_numero_orden_pdf_virtual;
                break;
            default:
                $lista_numero_preguntas= $this->pregunta_numero_orden_general;
                break;
        }
        foreach ($this->preguntas as $key => $value) {
            $pregunta_numero = array_key_exists($key, $lista_numero_preguntas) ? $lista_numero_preguntas[$key] : '';
            $pregunta_combinada = $pregunta_numero . '. ' . $value;
            $answer['data'][$key] = $pregunta_combinada;
        }
        
        $answer['estado'] = 2;
        return $answer;
    }
    
    public function getPreguntaText($key_array){
        if(array_key_exists($key_array, $this->preguntas)) {
            return $this->preguntas[$key_array];
        } else {
            return "NO FOUND PREG";
        }
    }
    public function getPreguntaNumeroText($key_array,$enc_formato=''){
        $lista_numero_preguntas=[];
        //  error_log($enc_formato);
        switch ($enc_formato) {
            case 'presencial':
                $lista_numero_preguntas= $this->pregunta_numero_orden_pdf_presencial;
                break;
            case 'telefonica':
                $lista_numero_preguntas= $this->pregunta_numero_orden_pdf_virtual;
                break;
            default:
                $lista_numero_preguntas= $this->pregunta_numero_orden_general;
                break;
        }

        if(array_key_exists($key_array, $this->pregunta_numero_orden_general)) {
            return $lista_numero_preguntas[$key_array];
        } else {
            return "NO FOUND PREG";
        }
    }

    public function getTextoRespuestaByPregunta($key_array, $value_res) {
        if (array_key_exists($key_array, $this->respuestas_preguntas)) {
            $respuestas = $this->respuestas_preguntas[$key_array];
            
            if (array_key_exists($value_res, $respuestas)) {
                return $respuestas[$value_res];
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public function getRespuestaYN($value){
        $answer="";
        switch ($value) {
            case 'Y':
                $answer="SI";
                break;
            case 'N':
                $answer="NO";
                break;
            default:
                break;
        }
        return $answer;
    }

    public function obtenerRespuestas($condicion="") {
        try {
            $respuestas = new Builder();
            $respuestas = $respuestas
                ->columns(
                    array('
                         erl.erl_limeid,
                         enc.enc_id,
                         enc.ese_id,
        
                         tip.tip_nombre,
                         enc.enc_fechaentregacliente,
                         enc.enc_fecharealizo,
        
                         CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
                         CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
                         CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) as inv_nombre,
                         CONCAT(ana.usu_nombre, " ", ana.usu_primerapellido, " ", ana.usu_segundoapellido) as ana_nombre,
        
                         emp.emp_nombre,
        
                         erl.erl_p1_0_v0, 
                         erl.erl_p1_1_v0, 
                         erl.erl_p2_0_v0, 
                         erl.erl_p3_0_v1, 
                         erl.erl_p3_0_v2, 
                         erl.erl_p4_0_v1, erl.erl_p4_0_v2, 
                         erl.erl_p5_0_v1, erl.erl_p5_0_v2, 
                         erl.erl_p6_0_v1, 
                         erl.erl_p7_0_v1,erl.erl_p7_0_v2,
                         erl.erl_p7_1_v1,erl.erl_p7_1_v2,
                         erl.erl_p8_0_v1,erl.erl_p8_0_v2,
                         erl.erl_p9_0_v1,erl.erl_p9_0_v2,
                         erl.erl_p10_0_v1,erl.erl_p10_0_v2,
                         erl.erl_p11_0_v1,
                         erl.erl_p12_0_v1,
                         erl.erl_p12_1_v1,
                         erl.erl_p13_0_v1,
                         erl.erl_p13_1_v1,
                         erl.erl_p13_2_v1,
                         erl.erl_p14_0_v0,
                         erl.erl_p14_1_v0,
                         erl.erl_p15_0_v0,
                         erl.erl_p16_0_v0,
                         erl.erl_p17_0_v0
        
                     ')
                )
                ->addFrom('Encuesta', 'enc')
                ->join('Encuesta_calidad_2024_enero', 'erl.enc_id = enc.enc_id and enc.enc_estatus=3', 'erl')
                ->join('Estudio', 'ese.ese_id = enc.ese_id', 'ese')
                ->leftjoin('Tipoestudio', 'tip.tip_id=ese.tip_id', 'tip')
                ->leftjoin('Usuario', 'usu.usu_id=enc.usu_id', 'usu')
                ->leftjoin('Usuario', 'inv.usu_id=ese.inv_id', 'inv')
                ->leftjoin('Municipio', 'mun.mun_id=ese.mun_id', 'mun')
                ->leftjoin('Estado', 'est.est_id=ese.est_id', 'est')
                ->leftjoin('Empresa', 'emp.emp_id=ese.emp_id', 'emp')
                ->leftjoin('Centrocosto', 'cen.cen_id=ese.cen_id', 'cen')
                ->leftjoin('Usuario', 'ana.usu_id=ese.ana_id', 'ana')
                ->where($condicion)
                ->getQuery()
                ->execute();
            return $respuestas;
        } catch (Exception $e) { 
            error_log('Error en obtenerRespuestas: ' . $e->getMessage());
            return []; 
        }
    }
    
    public function construirConsulta($columna_pregunta, $opciones,$condicion) {
        $condicion1 = '';
        $condicion2 = '';
        // error_log($condicion);
    
        if ($condicion != null  or $condicion != "") {
            $condicion1 = 'erl1.' . $columna_pregunta . ' IS NOT NULL
            AND erl1.' . $columna_pregunta . ' != ""
            AND enc1.enc_estatus = 3
            AND erl1.erl_estatus = 2
            AND ' . str_replace(["erl.", "ese.", "enc."], ["erl1.", "ese1.", "enc1."], $condicion);
    
            $condicion2 = 'erl2.' . $columna_pregunta . ' IS NOT NULL
            AND erl2.' . $columna_pregunta . ' != ""
            AND enc2.enc_estatus = 3
            AND erl2.erl_estatus = 2
            AND ' . str_replace(["erl.", "ese.", "enc."], ["erl2.", "ese2.", "enc2."], $condicion);
        }
    
        // error_log($condicion1);
        $sql = 'SELECT 
                    opciones.opcion,
                    opciones.opcion_texto,
                    IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) AS total_respuestas,
                    IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) * 100.0 / (
                        SELECT  COUNT(*)
                        FROM encuesta_calidad_2024_enero erl1
                        LEFT JOIN encuesta enc1 ON enc1.enc_id = erl1.enc_id
                        LEFT JOIN estudio ese1 ON ese1.ese_id = enc1.ese_id
                        WHERE ' . $condicion1 . '
                    ) AS porcentaje_total,
                    (
                        SELECT COUNT(*)
                        FROM encuesta_calidad_2024_enero erl2
                        LEFT JOIN encuesta enc2 ON enc2.enc_id = erl2.enc_id
                        LEFT JOIN estudio ese2 ON ese2.ese_id = enc2.ese_id
                        WHERE ' . $condicion2 . '
                    ) AS total_respuestas_general
                FROM (';
    
        foreach ($opciones as $key => $value) {
            $sql .= 'SELECT "' . $key . '" AS opcion, "' . $value . '" AS opcion_texto ';
            $sql .= 'UNION ALL ';
        }
        $sql = rtrim($sql, 'UNION ALL ');
        $sql .= ') AS opciones
        LEFT JOIN encuesta_calidad_2024_enero erl ON erl.' . $columna_pregunta . ' = opciones.opcion
        LEFT JOIN encuesta enc ON enc.enc_id = erl.enc_id
        LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id';
    
        if (!empty($condicion)) {
            // Reemplazar la condición principal en la cláusula WHERE
            $sql .= ' WHERE ' . $condicion;
        }
    
        $sql .= ' GROUP BY opciones.opcion, opciones.opcion_texto, erl.erl_p2_0_v0;';
        // error_log($sql);
        return $sql;
    }
    public function construirConsultaTelefonica($columna_pregunta, $opciones, $condicion) {
            // Consulta SQL dinámica
            $condicion1 = '';
            $condicion2 = '';
        
            if ($condicion != null  or $condicion != "") {
                $condicion1 = 'erl1.' . $columna_pregunta . ' IS NOT NULL
                AND erl1.' . $columna_pregunta . ' != ""
                AND enc1.enc_estatus = 3
                AND erl1.erl_estatus = 2
                AND erl1.erl_p2_0_v0 = "P2IA2"
                AND ' . str_replace(["erl.", "ese.", "enc."], ["erl1.", "ese1.", "enc1."], $condicion);
        
                $condicion2 = 'erl2.' . $columna_pregunta . ' IS NOT NULL
                AND erl2.' . $columna_pregunta . ' != ""
                AND enc2.enc_estatus = 3
                AND erl2.erl_estatus = 2
                AND erl2.erl_p2_0_v0 = "P2IA2"
                AND ' . str_replace(["erl.", "ese.", "enc."], ["erl2.", "ese2.", "enc2."], $condicion);
            }
        
            // error_log($condicion1);
            $sql = 'SELECT 
                        opciones.opcion,
                        opciones.opcion_texto,
                        IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) AS total_respuestas,
                        IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) * 100.0 / (
                            SELECT  COUNT(*)
                            FROM encuesta_calidad_2024_enero erl1
                            LEFT JOIN encuesta enc1 ON enc1.enc_id = erl1.enc_id
                            LEFT JOIN estudio ese1 ON ese1.ese_id = enc1.ese_id
                            WHERE ' . $condicion1 . '
                        ) AS porcentaje_total,
                        (
                            SELECT COUNT(*)
                            FROM encuesta_calidad_2024_enero erl2
                            LEFT JOIN encuesta enc2 ON enc2.enc_id = erl2.enc_id
                            LEFT JOIN estudio ese2 ON ese2.ese_id = enc2.ese_id
                            WHERE ' . $condicion2 . '
                        ) AS total_respuestas_general
                    FROM (';
        
            foreach ($opciones as $key => $value) {
                $sql .= 'SELECT "' . $key . '" AS opcion, "' . $value . '" AS opcion_texto ';
                $sql .= 'UNION ALL ';
            }
            $sql = rtrim($sql, 'UNION ALL ');
            $sql .= ') AS opciones
            LEFT JOIN encuesta_calidad_2024_enero erl ON erl.' . $columna_pregunta . ' = opciones.opcion
            LEFT JOIN encuesta enc ON enc.enc_id = erl.enc_id
            LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id';
        
            if (!empty($condicion)) {
                // Reemplazar la condición principal en la cláusula WHERE
                $sql .= ' WHERE ' . $condicion;
            }
        
            $sql .= ' GROUP BY opciones.opcion, opciones.opcion_texto, erl.erl_p2_0_v0;';
            // error_log($sql);
            return $sql;
    }
        
        
    public function construirConsultaPresencial($columna_pregunta, $opciones, $condicion) {
        // Consulta SQL dinámica
    
        // error_log($condicion);
        $condicion1 = '';
        $condicion2 = '';
    
        if ($condicion != null  or $condicion != "") {
            $condicion1 = 'erl1.' . $columna_pregunta . ' IS NOT NULL
            AND erl1.' . $columna_pregunta . ' != ""
            AND enc1.enc_estatus = 3
            AND erl1.erl_estatus = 2
            AND erl1.erl_p2_0_v0 = "P2IA1"
            AND ' . str_replace(["erl.", "ese.", "enc."], ["erl1.", "ese1.", "enc1."], $condicion);
    
            $condicion2 = 'erl2.' . $columna_pregunta . ' IS NOT NULL
            AND erl2.' . $columna_pregunta . ' != ""
            AND enc2.enc_estatus = 3
            AND erl2.erl_estatus = 2
            AND erl2.erl_p2_0_v0 = "P2IA1"
            AND ' . str_replace(["erl.", "ese.", "enc."], ["erl2.", "ese2.", "enc2."], $condicion);
        }
    
        // error_log($condicion1);
        $sql = 'SELECT 
                    opciones.opcion,
                    opciones.opcion_texto,
                    IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) AS total_respuestas,
                    IFNULL(COUNT(erl.' . $columna_pregunta . '), 0) * 100.0 / (
                        SELECT  COUNT(*)
                        FROM encuesta_calidad_2024_enero erl1
                        LEFT JOIN encuesta enc1 ON enc1.enc_id = erl1.enc_id
                        LEFT JOIN estudio ese1 ON ese1.ese_id = enc1.ese_id
                        WHERE ' . $condicion1 . '
                    ) AS porcentaje_total,
                    (
                        SELECT COUNT(*)
                        FROM encuesta_calidad_2024_enero erl2
                        LEFT JOIN encuesta enc2 ON enc2.enc_id = erl2.enc_id
                        LEFT JOIN estudio ese2 ON ese2.ese_id = enc2.ese_id
                        WHERE ' . $condicion2 . '
                    ) AS total_respuestas_general
                FROM (';
    
        foreach ($opciones as $key => $value) {
            $sql .= 'SELECT "' . $key . '" AS opcion, "' . $value . '" AS opcion_texto ';
            $sql .= 'UNION ALL ';
        }
        $sql = rtrim($sql, 'UNION ALL ');
        $sql .= ') AS opciones
        LEFT JOIN encuesta_calidad_2024_enero erl ON erl.' . $columna_pregunta . ' = opciones.opcion
        LEFT JOIN encuesta enc ON enc.enc_id = erl.enc_id
        LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id';
    
        if (!empty($condicion)) {
            // Reemplazar la condición principal en la cláusula WHERE
            $sql .= ' WHERE ' . $condicion;
        }
    
        $sql .= ' GROUP BY opciones.opcion, opciones.opcion_texto, erl.erl_p2_0_v0;';
        // error_log($sql);
        return $sql;
    }
    
    
    
    
    public function getEstadisticasPorClave($clave,$condicion="",$enc_formato="") {
        $di = Di::getDefault();
        $db = $di->get('db');
        $opciones = $this->respuestas_preguntas[$clave];

     
        if($enc_formato==""){
            $sql = $this->construirConsulta($clave, $opciones,$condicion);
        }elseif ($clave=="erl_p2_0_v0") {
            $sql = $this->construirConsultaTelefonicaPresencial($clave, $opciones,$condicion);
        }
        else if($enc_formato=="presencial"){
            $sql = $this->construirConsultaPresencial($clave, $opciones,$condicion);
        }
        else if($enc_formato=="telefonica"){
            $sql = $this->construirConsultaTelefonica($clave, $opciones,$condicion);
        }

        if ($clave=="erl_p1_0_v0") {
            // error_log("CONSULTA 1.- ".$sql);
            // $sql_clean = str_replace(array("\r", "\n", "\r\n", "\n\r",), '', $sql);
            // error_log("Clean SQL: '" . $sql_clean . "'");
        }
        // error_log($clave);

         
        $result = $db->query($sql);
        $data = $result->fetchAll();
        // Convertir a array asociativo
        $data = array_map(function($item) {
            return [
                'opcion' => $item['opcion'],
                'opcion_texto' => $item['opcion_texto'],
                'total_respuestas' => $item['total_respuestas'],
                'porcentaje_total' => $item['porcentaje_total']
            ];
        }, $data);
    
        // Crear un array de opciones presentes en el resultado
        $opciones_presentes = array_column($data, 'opcion');
    
        foreach ($opciones as $opcion => $opcion_texto) {
            if (!in_array($opcion, $opciones_presentes)) {
                $data[] = [
                    'opcion' => $opcion,
                    'opcion_texto' => $opcion_texto,
                    'total_respuestas' => "0.00", // O el valor predeterminado 
                    'porcentaje_total' => "0.00" // O el valor predeterminado 
                ];
            }
        }
    
        return $data;
    }
    
    
    
    
    public function getEstadisticasTodasLasRespuestas($condicion="",$enc_formato="") {

        $condicion_clean = str_replace(array("\r", "\n", "\r\n", "\n\r"), '', $condicion);
        // error_log("Condición SQL: '" . $condicion_clean . "'");

        if ($enc_formato=="") {
            $data["erl_p1_0_v0"]= $this->getEstadisticasPorClave("erl_p1_0_v0",$condicion);
            $data["erl_p2_0_v0"]= $this->getEstadisticasPorClave("erl_p2_0_v0",$condicion); 
            $data["erl_p3_0_v1"]= $this->getEstadisticasPorClave("erl_p3_0_v1",$condicion);   
            $data["erl_p3_0_v2"]= $this->getEstadisticasPorClave("erl_p3_0_v2",$condicion);  
            $data["erl_p4_0_v1"]= $this->getEstadisticasPorClave("erl_p4_0_v1",$condicion); 
            $data["erl_p4_0_v2"]= $this->getEstadisticasPorClave("erl_p4_0_v2",$condicion); 
            $data["erl_p5_0_v1"]= $this->getEstadisticasPorClave("erl_p5_0_v1",$condicion); 
            $data["erl_p5_0_v2"]= $this->getEstadisticasPorClave("erl_p5_0_v2",$condicion);   
            $data["erl_p6_0_v1"]= $this->getEstadisticasPorClave("erl_p6_0_v1",$condicion); 
            $data["erl_p7_0_v1"]= $this->getEstadisticasPorClave("erl_p7_0_v1",$condicion); 
            $data["erl_p7_0_v2"]= $this->getEstadisticasPorClave("erl_p7_0_v2",$condicion); 
            $data["erl_p8_0_v1"]= $this->getEstadisticasPorClave("erl_p8_0_v1",$condicion); 
            $data["erl_p8_0_v2"]= $this->getEstadisticasPorClave("erl_p8_0_v2",$condicion); 
            $data["erl_p9_0_v1"]= $this->getEstadisticasPorClave("erl_p9_0_v1",$condicion); 
            $data["erl_p9_0_v2"]= $this->getEstadisticasPorClave("erl_p9_0_v2",$condicion); 
            $data["erl_p10_0_v1"]= $this->getEstadisticasPorClave("erl_p10_0_v1",$condicion); 
            $data["erl_p10_0_v2"]= $this->getEstadisticasPorClave("erl_p10_0_v2",$condicion); 
            $data["erl_p11_0_v1"]= $this->getEstadisticasPorClave("erl_p11_0_v1",$condicion); 
            $data["erl_p12_0_v1"]= $this->getEstadisticasPorClave("erl_p12_0_v1",$condicion); 
            $data["erl_p13_0_v1"]= $this->getEstadisticasPorClave("erl_p13_0_v1",$condicion); 
            $data["erl_p13_1_v1"]= $this->getEstadisticasPorClave("erl_p13_1_v1",$condicion); 
            $data["erl_p14_0_v0"]= $this->getEstadisticasPorClave("erl_p14_0_v0",$condicion);       
            $data["erl_p15_0_v0"]= $this->getEstadisticasPorClave("erl_p15_0_v0",$condicion); 

        }
        // error_log($condicion);

        if ($enc_formato=="telefonica") {
            $data["erl_p1_0_v0"]= $this->getEstadisticasPorClave("erl_p1_0_v0",$condicion,$enc_formato); 

            $data["erl_p2_0_v0"]= $this->getEstadisticasPorClave("erl_p2_0_v0",$condicion,$enc_formato); 
            $data["erl_p3_0_v2"]= $this->getEstadisticasPorClave("erl_p3_0_v2",$condicion,$enc_formato);  
            usort($data["erl_p3_0_v2"], array($this, "comparar_texto_cantidad_dias"));

            $data["erl_p4_0_v2"]= $this->getEstadisticasPorClave("erl_p4_0_v2",$condicion,$enc_formato); 
            usort($data["erl_p4_0_v2"], array($this, "comparar_texto_si_no"));

            $data["erl_p5_0_v2"]= $this->getEstadisticasPorClave("erl_p5_0_v2",$condicion,$enc_formato);  
            usort($data["erl_p5_0_v2"], array($this, "comparar_texto_si_no"));
            $data["erl_p7_0_v2"]= $this->getEstadisticasPorClave("erl_p7_0_v2",$condicion,$enc_formato);
            usort($data["erl_p7_0_v2"], array($this, "comparar_texto_excelente_b_r_m_v2"));
            $data["erl_p8_0_v2"]= $this->getEstadisticasPorClave("erl_p8_0_v2",$condicion,$enc_formato); 
            usort($data["erl_p8_0_v2"], array($this, "comparar_texto_si_no"));

            $data["erl_p9_0_v2"]= $this->getEstadisticasPorClave("erl_p9_0_v2",$condicion,$enc_formato); 
            usort($data["erl_p9_0_v2"], array($this, "comparar_texto_cantidad_min"));
            // error_log(print_r($data["erl_p9_0_v2"],true));

            $data["erl_p10_0_v2"]= $this->getEstadisticasPorClave("erl_p10_0_v2",$condicion,$enc_formato);  
            usort($data["erl_p10_0_v2"], array($this, "comparar_texto_si_no_na"));

            $data["erl_p14_0_v0"]= $this->getEstadisticasPorClave("erl_p14_0_v0",$condicion,$enc_formato);  
            $data["erl_p15_0_v0"]= $this->getEstadisticasPorClave("erl_p15_0_v0",$condicion,$enc_formato); 
        }
        if ($enc_formato=="presencial") {
            $data["erl_p1_0_v0"]= $this->getEstadisticasPorClave("erl_p1_0_v0",$condicion,$enc_formato); 
            $data["erl_p2_0_v0"]= $this->getEstadisticasPorClave("erl_p2_0_v0",$condicion,$enc_formato); 
            $data["erl_p3_0_v1"]= $this->getEstadisticasPorClave("erl_p3_0_v1",$condicion,$enc_formato);   
            usort($data["erl_p3_0_v1"], array($this, "comparar_texto_cantidad_dias"));
            $data["erl_p4_0_v1"]= $this->getEstadisticasPorClave("erl_p4_0_v1",$condicion,$enc_formato);
            usort($data["erl_p4_0_v1"], array($this, "comparar_texto_si_no"));
            $data["erl_p5_0_v1"]= $this->getEstadisticasPorClave("erl_p5_0_v1",$condicion,$enc_formato); 
            usort($data["erl_p5_0_v1"], array($this, "comparar_texto_si_no"));
            $data["erl_p6_0_v1"]= $this->getEstadisticasPorClave("erl_p6_0_v1",$condicion,$enc_formato);
            usort($data["erl_p6_0_v1"], array($this, "comparar_texto_si_no"));
 
            $data["erl_p7_0_v1"]= $this->getEstadisticasPorClave("erl_p7_0_v1",$condicion,$enc_formato); 
            usort($data["erl_p7_0_v1"], array($this, "comparar_texto_excelente_b_r_m_v2"));

            $data["erl_p8_0_v1"]= $this->getEstadisticasPorClave("erl_p8_0_v1",$condicion,$enc_formato); 
            usort($data["erl_p8_0_v1"], array($this, "comparar_texto_si_no"));

            $data["erl_p9_0_v1"]= $this->getEstadisticasPorClave("erl_p9_0_v1",$condicion,$enc_formato);
            usort($data["erl_p9_0_v1"], array($this, "comparar_texto_cantidad_min"));
            // error_log(print_r($data["erl_p9_0_v1"],true));
            

            // echo  "<pre>";
            // print_r($data["erl_p9_0_v1"]);
            // echo "</pre>";
            // die();

 
            $data["erl_p10_0_v1"]= $this->getEstadisticasPorClave("erl_p10_0_v1",$condicion,$enc_formato);
            usort($data["erl_p10_0_v1"], array($this, "comparar_texto_si_no_na"));
 
            $data["erl_p11_0_v1"]= $this->getEstadisticasPorClave("erl_p11_0_v1",$condicion,$enc_formato); 
            usort($data["erl_p11_0_v1"], array($this, "comparar_texto_si_no"));

            $data["erl_p12_0_v1"]= $this->getEstadisticasPorClave("erl_p12_0_v1",$condicion,$enc_formato); 
            $data["erl_p13_0_v1"]= $this->getEstadisticasPorClave("erl_p13_0_v1",$condicion,$enc_formato); 
            usort($data["erl_p13_0_v1"], array($this, "comparar_texto_si_no"));

            $data["erl_p13_1_v1"]= $this->getEstadisticasPorClave("erl_p13_1_v1",$condicion,$enc_formato);
            usort($data["erl_p13_1_v1"], array($this, "comparar_texto_tipo_ayuda"));
 
            $data["erl_p14_0_v0"]= $this->getEstadisticasPorClave("erl_p14_0_v0",$condicion,$enc_formato); 
      
            $data["erl_p15_0_v0"]= $this->getEstadisticasPorClave("erl_p15_0_v0",$condicion,$enc_formato);  

        }
        if (isset($data["erl_p1_0_v0"]) && is_array($data["erl_p1_0_v0"])) {
            usort($data["erl_p1_0_v0"], array($this, "comparar_texto_excelente_b_r_m"));
            // echo "si";
            // die();
        } 
        if (isset($data["erl_p14_0_v0"]) && is_array($data["erl_p14_0_v0"])) {
            usort($data["erl_p14_0_v0"], array($this, "comparar_texto_si_no"));
        } 

        if (isset($data["erl_p15_0_v0"]) && is_array($data["erl_p15_0_v0"])) {
            usort($data["erl_p15_0_v0"], array($this, "comparar_texto_excelente_b_r_m_v2"));
        } 
        // error_log(print_r($data["erl_p4_0_v1"],true));
       
    
        return $data;
    }
    public function comparar_texto_excelente_b_r_m($a, $b) {
        $orden = array("EXCELENTE","BUENA", "REGULAR", "MALA");
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
    public function comparar_texto_excelente_b_r_m_v2($a, $b) {
        $orden = array("EXCELENTE","BUENO", "REGULAR", "MALO");
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
    public function comparar_texto_cantidad_dias($a, $b) {
        $orden = array(
            "EL MISMO DÍA",
            "AL DÍA SIGUIENTE",
            "2 DÍAS DESPUÉS",
            "MÁS DE 3 DÍAS");
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
    public  function comparar_texto_si_no($a, $b) {
        $orden = array("SI", "NO");
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
    public  function comparar_texto_si_no_na($a, $b) {
        $orden = array("SI", "NO","NO APLICA");
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
    public function comparar_texto_tipo_ayuda($a, $b) {
        $orden = array(
            "ORIENTACIÓN",
            "TRANSPORTE",
            "ECONÓMICA",
            "OTRO",
        );
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
  
    public  function comparar_texto_cantidad_min($a, $b) {
        $orden = array(
        "MENOS DE 15 MIN.",
        "DE 15 A 30 MIN.",
        "DE 30 A 60 MIN.",
        "MÁS DE 60 MIN..");
        $posicion_a = array_search($a['opcion_texto'], $orden);
        $posicion_b = array_search($b['opcion_texto'], $orden);
        return $posicion_a - $posicion_b;
    }
    public function getPreguntas(){
        $answer=[];
        $answer['data']=$this->preguntas;
        $answer['estado']=2;
        return $answer;

    }

    public function getOpcionesPreguntas(){
        $answer=[];
        $answer['data']=$this->respuestas_preguntas;
        $answer['estado']=2;
        return $answer;
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

    public function getAllTodasLasRespuestasPreguntasAbiertas($data = [],$data_param=[]) {
        $preguntas = [
            'erl_p1_1_v0' => 'pregunta_abierta_erl_p1_1_v0',
            'erl_p7_1_v1' => 'pregunta_abierta_erl_p7_1_v1',
            'erl_p7_1_v2' => 'pregunta_abierta_erl_p7_1_v2',
            'erl_p12_1_v1' => 'pregunta_abierta_erl_p12_1_v1',
            'erl_p13_2_v1' => 'pregunta_abierta_erl_p13_2_v1',
            'erl_p14_1_v0' => 'pregunta_abierta_erl_p14_1_v0',
            'erl_p16_0_v0' => 'pregunta_abierta_erl_p16_0_v0',
            'erl_p17_0_v0' => 'pregunta_abierta_erl_p17_0_v0'
        ];
    
        if (empty($data)) {
            $data = $this->obtenerRespuestas();
        }
        
        $pregunta_abierta_erl_p1_1_v0 = [];
        $pregunta_abierta_erl_p7_1_v1 = [];
        $pregunta_abierta_erl_p7_1_v2 = [];
        $pregunta_abierta_erl_p12_1_v1 = [];
        $pregunta_abierta_erl_p13_2_v1 = [];
        $pregunta_abierta_erl_p14_1_v0 = [];
        $pregunta_abierta_erl_p16_0_v0 = [];
        $pregunta_abierta_erl_p17_0_v0 = [];
        // error_log(print_r($data,true));
        // echo print_r($data);
        // die();
        foreach ($data as $elemento) {
            foreach ($preguntas as $pregunta => $nombre_variable) {

                if (isset($elemento[$pregunta])) {
                    if ($pregunta == "erl_p1_1_v0") {
                        ${$nombre_variable}[] = [
                            'respueta_previa' => $this->getTextoRespuestaByPregunta("erl_p1_0_v0", $elemento["erl_p1_0_v0"]),
                            'inv_nombre' => $elemento['inv_nombre'],
                            'erl_texto' => $elemento[$pregunta]
                        ];
                    } elseif ($pregunta == "erl_p7_1_v1") {
                        ${$nombre_variable}[] = [
                            'respueta_previa' => $this->getTextoRespuestaByPregunta("erl_p7_0_v1", $elemento["erl_p7_0_v1"]),
                            'inv_nombre' => $elemento['inv_nombre'],
                            'erl_texto' => $elemento[$pregunta]
                        ];
                    } elseif ($pregunta == "erl_p7_1_v2") {
                        ${$nombre_variable}[] = [
                            'respueta_previa' => $this->getTextoRespuestaByPregunta("erl_p7_0_v2", $elemento["erl_p7_0_v2"]),
                            'inv_nombre' => $elemento['inv_nombre'],
                            'erl_texto' => $elemento[$pregunta]
                        ];
                    } else {
                        ${$nombre_variable}[] = [
                            // 'respueta_previa' =>"", 
                            'inv_nombre' => $elemento['inv_nombre'],
                            'erl_texto' => $elemento[$pregunta]
                        ];
                    }
                    
                   
                }
            }
        }
    
        $pregunta_abierta_erl_p7_1_v0 = array_merge($pregunta_abierta_erl_p7_1_v1, $pregunta_abierta_erl_p7_1_v2);

     
         $answer= [
            'p1_1_v0' => $pregunta_abierta_erl_p1_1_v0,
            'p7_1_v0' => $pregunta_abierta_erl_p7_1_v0,
            'p12_1_v1' => $pregunta_abierta_erl_p12_1_v1,
            'p13_2_v1' => $pregunta_abierta_erl_p13_2_v1,
            'p14_1_v0' => $pregunta_abierta_erl_p14_1_v0,
            'p16_0_v0' => $pregunta_abierta_erl_p16_0_v0,
            'p17_0_v0' => $pregunta_abierta_erl_p17_0_v0
        ];

        $controller_base=new ControllerBase();
        if($controller_base->cadenaValida($data_param["enc_formato"])==true){
           
            if ($data_param["enc_formato"]=="telefonica") {
                // p12_1_v1,p13_2_v1--elimina los indexes
                unset($answer['p12_1_v1']);
                unset($answer['p13_2_v1']);
            }
        }
  

        return $answer;
    }

    public function setSelectCondicionesPersonalizadasAvanzadas($data,$condicion_sql,$condicion_sql_enc,$condicion_sql_ese,$mensaje_extra_bitcora) {
        $controller_base=new ControllerBase();
            // error_log($controller_base->cadenaValida($data["enc_formato"]));
        $formato_estudio="";
        if($controller_base->cadenaValida($data["enc_formato"])==true){
            switch ($data["enc_formato"]) {
                case 'presencial':
                    $enc_formato="P2IA1";
                    $formato_estudio="1";
 
                    break;
                case 'telefonica':
                    $enc_formato="P2IA2";
                    $formato_estudio="5";
                    break;
                default:
                    // $enc_formato="5";
                    break;
            }
            $condicion_sql = ($condicion_sql == '') ? $condicion_sql.=" erl.erl_p2_0_v0='".$enc_formato."'" : $condicion_sql.=" and erl.erl_p2_0_v0='".$enc_formato."'";
            if (trim($formato_estudio)!="") {
                $condicion_sql_enc = ($condicion_sql_enc == '') ? $condicion_sql_enc.=" ese.tip_id='".$formato_estudio."'" : $condicion_sql_enc.=" and ese.tip_id='".$formato_estudio."'";
                $condicion_sql_ese = ($condicion_sql_ese == '') ? $condicion_sql_ese.=" ese.tip_id='".$formato_estudio."'" : $condicion_sql_ese.=" and ese.tip_id='".$formato_estudio."'";
            }
            //  error_log($condicion_sql);
           $mensaje_extra_bitcora.=", filtro de modalidad : ".$data["enc_formato"];
           
        }

        return[
        "condicion_sql"=>$condicion_sql,
        "condicion_sql_enc"=>$condicion_sql_enc,
        "condicion_sql_ese"=>$condicion_sql_ese,
        "mensaje_extra_bitcora"=>$mensaje_extra_bitcora
        ];
    }
    public function getConfiguracionPersonalizadaGraficasPDF($data){
        $controller_base=new ControllerBase();
        $enc_formato="";
        $elementos_por_pagina= $this->elementos_por_pagina;
        $medidas_graficas_barras_texto= $this->medidas_graficas_barras_texto;
        $medidas_graficas_circular_texto= $this->medidas_graficas_circular_texto;

        if($controller_base->cadenaValida($data["enc_formato"])){
           $enc_formato=$data["enc_formato"];
           $nombre_propiedad_elementos_por_pagina = "elementos_por_pagina_" . $enc_formato;
           $nombre_propiedad_medidas_graficas_barras_texto = "medidas_graficas_barras_texto_" . $enc_formato;
           $nombre_propiedad_medidas_graficas_circular_texto = "medidas_graficas_circular_texto_" . $enc_formato;
        // echo $nombre_propiedad_elementos_por_pagina;
            // error_log($nombre_propiedad_medidas_graficas_circular_texto);
        // die();
           if (property_exists($this, $nombre_propiedad_elementos_por_pagina)) {
              $elementos_por_pagina = $this->{$nombre_propiedad_elementos_por_pagina};
           }
           if (property_exists($this, $nombre_propiedad_medidas_graficas_barras_texto)) {
           $medidas_graficas_barras_texto = $this->{$nombre_propiedad_medidas_graficas_barras_texto};
           }
           if (property_exists($this, $nombre_propiedad_medidas_graficas_circular_texto)) {
            $medidas_graficas_circular_texto = $this->{$nombre_propiedad_medidas_graficas_circular_texto};
           }

        }

        return[
            "elementos_por_pagina"=>$elementos_por_pagina,
            "medidas_graficas_barras_texto"=>$medidas_graficas_barras_texto,
            "medidas_graficas_circular_texto"=>$medidas_graficas_circular_texto,
        ];
    }
    public function getTituloPdf($data){
        $titulo="";
        $controller_base= new ControllerBase();
        if($controller_base->cadenaValida($data["enc_formato"])==true){
            switch ($data["enc_formato"]) {
                case 'presencial':
                    $titulo="Resultados de encuestas de estudios socioeconómicos con visita presencial";
                    break;
                case 'telefonica':
                    $titulo="Resultado de encuestas de estudios por llamada telefónica";
                    break;
                default:
                    // $enc_formato="5";
                    break;
            }
         
           
        }
        return $titulo;
    }
    
    


}
