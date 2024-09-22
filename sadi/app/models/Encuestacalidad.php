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
class Encuestacalidad extends Model
{
    public $font_size_comentarios_pdf='12px';
    public $preg_1_servicio=
    [
        ['valor'=>1,'texto'=>'1-3 DÍAS','name'=>'opcion_preg_1_servicio_calida'],
        ['valor'=>2,'texto'=>'3-6 DÍAS ','name'=>'opcion_preg_1_servicio_calida'],
        ['valor'=>3,'texto'=>'6-8 DÍAS ','name'=>'opcion_preg_1_servicio_calida'],
        ['valor'=>4,'texto'=>'MÁS DE 8 DÍAS ','name'=>'opcion_preg_1_servicio_calida'],

    ];

    public $preg_2_servicio=
    [
        ['valor'=>1,'texto'=>'PRESENCIAL','name'=>'opcion_preg_2_servicio_calida'],
        ['valor'=>2,'texto'=>'A DISTANCIA','name'=>'opcion_preg_2_servicio_calida'],
        

    ];

    public $preg_3_servicio=
    [
        ['valor'=>1,'texto'=>'EL MISMO DÍA','name'=>'opcion_preg_3_servicio_calida'],
        ['valor'=>2,'texto'=>'DÍA SIGUIENTE','name'=>'opcion_preg_3_servicio_calida'],
        ['valor'=>3,'texto'=>'2 DÍAS','name'=>'opcion_preg_3_servicio_calida'],
        ['valor'=>4,'texto'=>'3 DÍAS O MÁS','name'=>'opcion_preg_3_servicio_calida'],

    ];

    public $preg_4_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_4_servicio_calida'],
        ['valor'=>2,'texto'=>'NO','name'=>'opcion_preg_4_servicio_calida']

    ];
    public $preg_5_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_5_servicio_calida'],
        ['valor'=>2,'texto'=>'NO','name'=>'opcion_preg_5_servicio_calida'],
        ['valor'=>3,'texto'=>'N/A','name'=>'opcion_preg_5_servicio_calida']


    ];

    public $preg_6_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_6_servicio_calida'],
        ['valor'=>2,'texto'=>'NO','name'=>'opcion_preg_6_servicio_calida'],

    ];

    public $preg_7_servicio=
    [
        ['valor'=>1,'texto'=>'EXCELENTE','name'=>'opcion_preg_7_servicio_calida'],
        ['valor'=>2,'texto'=>'BUENO','name'=>'opcion_preg_7_servicio_calida'],
        ['valor'=>3,'texto'=>'REGULAR','name'=>'opcion_preg_7_servicio_calida'],
        ['valor'=>4,'texto'=>'MALO','name'=>'opcion_preg_7_servicio_calida'],

        
    ];

    public $preg_8_servicio=
    [
        ['valor'=>1,'texto'=>'ELECTRÓNICO','name'=>'opcion_preg_8_servicio_calida'],
        ['valor'=>2,'texto'=>'IMPRESO','name'=>'opcion_preg_8_servicio_calida'],
        ['valor'=>3,'texto'=>'OTRO','name'=>'opcion_preg_8_servicio_calida'],


    ];

    public $preg_9_servicio=
    [
        ['valor'=>1,'texto'=>'MENOS DE 15 MINS','name'=>'opcion_preg_9_servicio_calida'],
        ['valor'=>2,'texto'=>' DE 15- 30 MINS','name'=>'opcion_preg_9_servicio_calida'],
        ['valor'=>3,'texto'=>' DE 30 A 60 MINS','name'=>'opcion_preg_9_servicio_calida'],
        ['valor'=>4,'texto'=>'MÁS DE 60 MINS','name'=>'opcion_preg_9_servicio_calida']


    ];

    public $preg_10_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_10_servicio_calida'],
        ['valor'=>2,'texto'=>' NO','name'=>'opcion_preg_10_servicio_calida'],
        ['valor'=>3,'texto'=>' N/A','name'=>'opcion_preg_10_servicio_calida'],

    ];

    public $preg_11_servicio=
    [
      
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_11_servicio_calida'],
        ['valor'=>2,'texto'=>' NO','name'=>'opcion_preg_11_servicio_calida'],
        ['valor'=>3,'texto'=>' N/A','name'=>'opcion_preg_11_servicio_calida'],

    ];

    public $preg_12_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_12_servicio_calida'],
        ['valor'=>2,'texto'=>' NO','name'=>'opcion_preg_12_servicio_calida'],

    ];

    public $preg_13_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_13_servicio_calida'],
        ['valor'=>2,'texto'=>' NO','name'=>'opcion_preg_13_servicio_calida'],

    ];

    public $preg_14_servicio=
    [
        ['valor'=>1,'texto'=>'EXCELENTE','name'=>'opcion_preg_14_servicio_calida'],
        ['valor'=>2,'texto'=>'BUENO','name'=>'opcion_preg_14_servicio_calida'],
        ['valor'=>3,'texto'=>'REGULAR','name'=>'opcion_preg_14_servicio_calida'],
        ['valor'=>4,'texto'=>'MALO','name'=>'opcion_preg_14_servicio_calida'],
        ['valor'=>5,'texto'=>'PÉSIMO','name'=>'opcion_preg_14_servicio_calida'],
    ];

    public $preg_15_servicio=
    [
        ['valor'=>1,'texto'=>'ACTITUD DE SERVICIO','name'=>'opcion_preg_15_servicio_calida'],
        ['valor'=>2,'texto'=>'PRESENTACIÓN / IMAGEN','name'=>'opcion_preg_15_servicio_calida'],
        ['valor'=>3,'texto'=>'INFORMACIÓN DEL SERVICIO','name'=>'opcion_preg_15_servicio_calida'],
        ['valor'=>4,'texto'=>'PUNTUALIDAD','name'=>'opcion_preg_15_servicio_calida'],
        ['valor'=>5,'texto'=>'OTRO','name'=>'opcion_preg_15_servicio_calida'],

    ];

    public $preg_16_servicio=
    [
        ['valor'=>1,'texto'=>'SI','name'=>'opcion_preg_16_servicio_calida'],
        ['valor'=>2,'texto'=>' NO','name'=>'opcion_preg_16_servicio_calida'],

    ];

    public $preg_17_servicio=
    [
        ['valor'=>1,'texto'=>'ORIENTACIÓN','name'=>'opcion_preg_17_servicio_calida'],
        ['valor'=>2,'texto'=>'TRANSPORTE','name'=>'opcion_preg_17_servicio_calida'],
        ['valor'=>3,'texto'=>'ECONÓMICA','name'=>'opcion_preg_17_servicio_calida'],
        ['valor'=>4,'texto'=>'OTRO','name'=>'opcion_preg_17_servicio_calida'],

    ];

    
    public function getOpcionesPreguntas__Servico(){
        $answer=[];
     
        $answer['preg_1_opciones']=$this->preg_1_servicio;
        $answer['preg_2_opciones']=$this->preg_2_servicio;
        $answer['preg_3_opciones']=$this->preg_3_servicio;
        $answer['preg_4_opciones']=$this->preg_4_servicio;
        $answer['preg_5_opciones']=$this->preg_5_servicio;
        $answer['preg_6_opciones']=$this->preg_6_servicio;
        $answer['preg_7_opciones']=$this->preg_7_servicio;
        $answer['preg_8_opciones']=$this->preg_8_servicio;
        $answer['preg_9_opciones']=$this->preg_9_servicio;
        $answer['preg_10_opciones']=$this->preg_10_servicio;
        $answer['preg_11_opciones']=$this->preg_11_servicio;
        $answer['preg_12_opciones']=$this->preg_12_servicio;
        $answer['preg_13_opciones']=$this->preg_13_servicio;
        $answer['preg_14_opciones']=$this->preg_14_servicio;
        $answer['preg_15_opciones']=$this->preg_15_servicio;
        $answer['preg_16_opciones']=$this->preg_16_servicio;
        $answer['preg_17_opciones']=$this->preg_17_servicio;

        return  $answer;
    }

    public function getRespuesta_preg1($id){
        $id=$id-1;
        if (array_key_exists($id, $this->preg_1_servicio)) {
            return  $this->preg_1_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg2($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_2_servicio)) {
            return  $this->preg_2_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg3($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_3_servicio)) {
            return  $this->preg_3_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg4($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_4_servicio)) {
            return  $this->preg_4_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg5($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_5_servicio)) {
            return  $this->preg_5_servicio[$id]['texto'];
      }else{
           return '';
      }


    }


    public function getRespuesta_preg6($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_6_servicio)) {
            return  $this->preg_6_servicio[$id]['texto'];
        }else{
            return '';
        }


    }

    public function getRespuesta_preg7($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_7_servicio)) {
            return  $this->preg_7_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg8($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_8_servicio)) {
            return  $this->preg_8_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg9($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_9_servicio)) {
            return  $this->preg_9_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg10($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_10_servicio)) {
            return  $this->preg_10_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg11($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_11_servicio)) {
            return  $this->preg_11_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg12($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_12_servicio)) {
            return  $this->preg_12_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg13($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_12_servicio)) {
            return  $this->preg_12_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg14($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_14_servicio)) {
            return  $this->preg_14_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg15($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_15_servicio)) {
            return  $this->preg_15_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg16($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_16_servicio)) {
            return  $this->preg_16_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getRespuesta_preg17($id){
        $id=$id-1;

        if (array_key_exists($id, $this->preg_17_servicio)) {
            return  $this->preg_17_servicio[$id]['texto'];
      }else{
           return '';
      }


    }

    public function getEstadisticasPregunta1($month,$year_get){
           $condicion_sql='';
           $pre_id=1;
           $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 

            $di = Di::getDefault();
            $db = $di->get('db');
            $sql = '
            SELECT 
            COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
            COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
            COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
            COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,
            (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
            (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
            (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
            (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,
            COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
            FROM respuesta
            LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
            LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
            '.$condicion_sql.'';
            
            $result = $db->query($sql);
    
            $data = $result->fetchAll();

            return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta2($month,$year_get){
        $condicion_sql='';
        $pre_id=2;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 

         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    
    public function getEstadisticasPregunta3($month,$year_get){
           $condicion_sql='';
           $pre_id=3;
           $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
            $di = Di::getDefault();
            $db = $di->get('db');
            $sql = '
            SELECT 
            COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
            COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
            COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
            COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,
            (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
            (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
            (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
            (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,
            COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
            FROM respuesta
            LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
            LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
            '.$condicion_sql.'';
            
            $result = $db->query($sql);
    
            $data = $result->fetchAll();

            return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta4($month,$year_get){
        $condicion_sql='';
        $pre_id=4;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta5($month,$year_get){
        $condicion_sql='';
        $pre_id=5;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,

         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,

         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta6($month,$year_get){
        $condicion_sql='';
        $pre_id=6;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta7($month,$year_get){
        $condicion_sql='';
        $pre_id=7;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta8($month,$year_get){
        $condicion_sql='';
        $pre_id=9;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta9($month,$year_get){
        $condicion_sql='';
        $pre_id=11;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta10($month,$year_get){
        $condicion_sql='';
        $pre_id=12;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta11($month,$year_get){
        $condicion_sql='';
        $pre_id=13;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }


    public function getEstadisticasPregunta12($month,$year_get){
        $condicion_sql='';
        $pre_id=14;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }
    public function getEstadisticasPregunta13($month,$year_get){
        $condicion_sql='';
        $pre_id=16;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta14($month,$year_get){
        $condicion_sql='';
        $pre_id=17;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,
         COUNT(CASE WHEN respuesta.opc_id = 5 THEN 1 END) AS contador_opc_id_5,

         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,
         (COUNT(CASE WHEN respuesta.opc_id = 5 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_5,

         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }


    public function getEstadisticasPregunta15($month,$year_get){
        $condicion_sql='';
        $pre_id=18;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,
         COUNT(CASE WHEN respuesta.opc_id = 5 THEN 1 END) AS contador_opc_id_5,

         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,
         (COUNT(CASE WHEN respuesta.opc_id = 5 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_5,

         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta16($month,$year_get){
        $condicion_sql='';
        $pre_id=20;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }

    public function getEstadisticasPregunta17($month,$year_get){
        $condicion_sql='';
        $pre_id=21;
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2 AND pre_id =$pre_id"; 
         $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,

         (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_1,
         (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_2,
         (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_3,
         (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END)) * 100 AS porcentaje_opc_id_4,

         COUNT(CASE WHEN respuesta.pre_id = '.$pre_id.' THEN 1 END) AS contador_total_respuestas
         FROM respuesta
         LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
         LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
         '.$condicion_sql.'';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();

         return ['estado'=>2,'data'=>$data];

    }


    public function getEstadisticasTodasLasRespuestas($month,$year_get,$inv_id=0){
        
      
        $condicion_sql=''; //CONSULTAMOS POR MES Y ANIO, TAMBIEN EXCLUIMOS LOS IDS DE PREGUNTAS ABIERTAS
        $condicion_sql.=" where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2  AND pre_id BETWEEN 1 AND 23 AND pre_id NOT IN (8, 10, 15,19,22,23) AND respuesta.opc_id > 0"; 
        if($inv_id!=0){
            $condicion_sql.=" AND ese.inv_id=$inv_id ";
        } 
        $di = Di::getDefault();
         $db = $di->get('db');
         $sql = '
         SELECT 
         pre_id,
         ese.ese_id,
         COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) AS contador_opc_id_1,
         COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) AS contador_opc_id_2,
         COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) AS contador_opc_id_3,
         COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) AS contador_opc_id_4,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 1 THEN 1 END)) * 100 AS pre_1_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 1 THEN 1 END)) * 100 AS pre_1_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 1 THEN 1 END)) * 100 AS pre_1_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 1 THEN 1 END)) * 100 AS pre_1_porcentaje_opc_id_4,
        COUNT(CASE WHEN respuesta.pre_id = 1 THEN 1 END) AS pre_1_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 2 THEN 1 END)) * 100 AS pre_2_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 2 THEN 1 END)) * 100 AS pre_2_porcentaje_opc_id_2,
        COUNT(CASE WHEN respuesta.pre_id = 2 THEN 1 END) AS pre_2_contador_total_respuestas,

        
        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 3 THEN 1 END)) * 100 AS pre_3_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 3 THEN 1 END)) * 100 AS pre_3_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 3 THEN 1 END)) * 100 AS pre_3_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 3 THEN 1 END)) * 100 AS pre_3_porcentaje_opc_id_4,
        COUNT(CASE WHEN respuesta.pre_id = 3 THEN 1 END) AS pre_3_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 4 THEN 1 END)) * 100 AS pre_4_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 4 THEN 1 END)) * 100 AS pre_4_porcentaje_opc_id_2,
        COUNT(CASE WHEN respuesta.pre_id = 4 THEN 1 END) AS pre_4_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 5 THEN 1 END)) * 100 AS pre_5_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 5 THEN 1 END)) * 100 AS pre_5_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 5 THEN 1 END)) * 100 AS pre_5_porcentaje_opc_id_3,
        COUNT(CASE WHEN respuesta.pre_id = 5 THEN 1 END) AS pre_5_contador_total_respuestas,

        
        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 6 THEN 1 END)) * 100 AS pre_6_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 6 THEN 1 END)) * 100 AS pre_6_porcentaje_opc_id_2,
        COUNT(CASE WHEN respuesta.pre_id = 6 THEN 1 END) AS pre_6_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 7 THEN 1 END)) * 100 AS pre_7_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 7 THEN 1 END)) * 100 AS pre_7_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 7 THEN 1 END)) * 100 AS pre_7_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 7 THEN 1 END)) * 100 AS pre_7_porcentaje_opc_id_4,
        COUNT(CASE WHEN respuesta.pre_id = 7 THEN 1 END) AS pre_7_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 9 THEN 1 END)) * 100 AS pre_8_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 9 THEN 1 END)) * 100 AS pre_8_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 9 THEN 1 END)) * 100 AS pre_8_porcentaje_opc_id_3,
        COUNT(CASE WHEN respuesta.pre_id = 9 THEN 1 END) AS pre_8_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 11 THEN 1 END)) * 100 AS pre_9_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 11 THEN 1 END)) * 100 AS pre_9_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 11 THEN 1 END)) * 100 AS pre_9_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 11 THEN 1 END)) * 100 AS pre_9_porcentaje_opc_id_4,
        COUNT(CASE WHEN respuesta.pre_id = 11 THEN 1 END) AS pre_9_contador_total_respuestas,
        
        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 12 THEN 1 END)) * 100 AS pre_10_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 12 THEN 1 END)) * 100 AS pre_10_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 12 THEN 1 END)) * 100 AS pre_10_porcentaje_opc_id_3,
        COUNT(CASE WHEN respuesta.pre_id = 12 THEN 1 END) AS pre_10_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 13 THEN 1 END)) * 100 AS pre_11_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 13 THEN 1 END)) * 100 AS pre_11_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 13 THEN 1 END)) * 100 AS pre_11_porcentaje_opc_id_3,
        COUNT(CASE WHEN respuesta.pre_id = 13 THEN 1 END) AS pre_11_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 14 THEN 1 END)) * 100 AS pre_12_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 14 THEN 1 END)) * 100 AS pre_12_porcentaje_opc_id_2,
        COUNT(CASE WHEN respuesta.pre_id = 14 THEN 1 END) AS pre_12_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 16 THEN 1 END)) * 100 AS pre_13_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 16 THEN 1 END)) * 100 AS pre_13_porcentaje_opc_id_2,
        COUNT(CASE WHEN respuesta.pre_id = 16 THEN 1 END) AS pre_13_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 17 THEN 1 END)) * 100 AS pre_14_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 17 THEN 1 END)) * 100 AS pre_14_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 17 THEN 1 END)) * 100 AS pre_14_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 17 THEN 1 END)) * 100 AS pre_14_porcentaje_opc_id_4,
        (COUNT(CASE WHEN respuesta.opc_id = 5 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 17 THEN 1 END)) * 100 AS pre_14_porcentaje_opc_id_5,

        COUNT(CASE WHEN respuesta.pre_id = 17 THEN 1 END) AS pre_14_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 18 THEN 1 END)) * 100 AS pre_15_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 18 THEN 1 END)) * 100 AS pre_15_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 18 THEN 1 END)) * 100 AS pre_15_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 18 THEN 1 END)) * 100 AS pre_15_porcentaje_opc_id_4,
        (COUNT(CASE WHEN respuesta.opc_id = 5 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 18 THEN 1 END)) * 100 AS pre_15_porcentaje_opc_id_5,

        COUNT(CASE WHEN respuesta.pre_id = 18 THEN 1 END) AS pre_15_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 20 THEN 1 END)) * 100 AS pre_16_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 20 THEN 1 END)) * 100 AS pre_16_porcentaje_opc_id_2,
        COUNT(CASE WHEN respuesta.pre_id = 20 THEN 1 END) AS pre_16_contador_total_respuestas,

        (COUNT(CASE WHEN respuesta.opc_id = 1 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 21 THEN 1 END)) * 100 AS pre_17_porcentaje_opc_id_1,
        (COUNT(CASE WHEN respuesta.opc_id = 2 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 21 THEN 1 END)) * 100 AS pre_17_porcentaje_opc_id_2,
        (COUNT(CASE WHEN respuesta.opc_id = 3 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 21 THEN 1 END)) * 100 AS pre_17_porcentaje_opc_id_3,
        (COUNT(CASE WHEN respuesta.opc_id = 4 THEN 1 END) / COUNT(CASE WHEN respuesta.pre_id = 21 THEN 1 END)) * 100 AS pre_17_porcentaje_opc_id_4,
        COUNT(CASE WHEN respuesta.pre_id = 21 THEN 1 END) AS pre_17_contador_total_respuestas

        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id = respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id = enc.ese_id
        LEFT JOIN usuario inv ON inv.usu_id = ese.inv_id

        '.$condicion_sql.'
        GROUP BY pre_id;
         ';
         
         $result = $db->query($sql);
 
         $data = $result->fetchAll();
         
        if(isset($data[0])){
            $response = [
                'estado' => 2,
                'estatus_data' => 2,
                'data' => $data,
            ];
        
            for ($i = 1; $i <= 17; $i++) {
                $response['preg_' . $i] = isset($data[$i - 1]) ? $data[$i - 1] : null;
            }

        
        
        }else{
            $response = [
                'estado'=>2,
                'estatus_data'=>-2
            ];
        }

        return $response;


    }

    public function getDestallesDelMesEncuestas($month,$year_get,$inv_id=0){
        $answer=[];

        $condicion_enc=" enc_estatus='3' AND  MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get  ";
       
        if($inv_id!=0){
            $condicion_enc.="AND ese.inv_id =$inv_id";
        }
        $result_enc=Encuesta::query()
                     ->columns('ese.ese_id,Encuesta.enc_id')
                    ->where($condicion_enc)
                    ->join('Estudio','ese.ese_id=Encuesta.ese_id','ese')
                    ->execute();

        $condicion_ese=" ese_estatus='7' AND  MONTH(ese_fechaentregacliente) = $month AND YEAR(ese_fechaentregacliente) =$year_get AND tip_id NOT IN (4, 2) ";
        if($inv_id!=0){
            $condicion_ese.="AND inv_id =".$inv_id;
        }
        $result_ese=Estudio::query()
                ->where($condicion_ese)
                ->execute();

        setlocale(LC_TIME, 'es_ES'); // establece el idioma a español
        date_default_timezone_set('america/mexico_city');
        $nombre_mes = strftime('%B', mktime(0, 0, 0, $month, 1)); // convierte el número del mes en su nombre en español
        
         $fecha= new Fecha();

         $answer['total_encuestas_contestadas']=count($result_enc);
         $answer['total_eses']=count($result_ese);
         $answer['anio_consulta']=$year_get;
         $answer['mes_consulta']= strtoupper($fecha->getMes($month));
         $answer['inv_consulta']= $inv_id;

         return $answer;

    }

    public function getDestallesByRangoFechaIniFin($condicion_sql_enc="",$condicion_sql_ese="",$fecha_inicio,$fecha_fin,$inv_id=0) {
        $answer = [];
        $answer['total_encuestas_contestadas'] = 0;

        try {
            $fechaIni = date("d/m/Y", strtotime($fecha_inicio));
            $fechaFin = date("d/m/Y", strtotime($fecha_fin));

            $result_enc=new Builder();
            $result_enc=$result_enc
            ->addFrom('Encuesta','enc')
            ->join('Estudio', 'ese.ese_id=enc.ese_id', 'ese')
            ->where($condicion_sql_enc)
            ->getQuery()
            ->execute();

            $result_ese=new Builder();
            $result_ese=$result_ese
            ->addFrom('Estudio','ese')
            // ->join('Estudio', 'ese.ese_id=enc.ese_id', 'ese')
            ->where($condicion_sql_ese)
            ->getQuery()
            ->execute();
    
            setlocale(LC_TIME, 'es_ES'); // establece el idioma a español
            date_default_timezone_set('america/mexico_city');
    

            $answer['total_encuestas_contestadas'] = $result_enc->count();
            $answer['total_eses'] = $result_ese->count();
            $answer['fecha_inicial'] = $fechaIni;
            $answer['fecha_final'] = $fechaFin;
            $answer['fecha_consulta'] = $this->obtenerFechaTextoFormatoLeible($fecha_inicio,$fecha_fin);
            $answer['inv_consulta'] = $inv_id;
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
        }
    
        return $answer;
    }

    public function getDestallesByRangoFechaIniFinParESE($condicion_sql_ese)
    {
       

        try {
           
            $result_ese=new Builder();
            $result_ese=$result_ese
            ->addFrom('Estudio','ese')
            ->leftJoin('Usuario', 'inv.usu_id=ese.inv_id', 'inv')
            ->leftJoin('Tipoestudio', 'tip.tip_id=ese.tip_id', 'tip')
            ->leftJoin('Municipio', 'mun.mun_id=ese.mun_id', 'mun')
            ->leftJoin('Estado', 'est.est_id=ese.est_id', 'est')
            ->leftJoin('Empresa', 'emp.emp_id=ese.emp_id', 'emp')
            ->leftJoin('Centrocosto', 'cen.cen_id=ese.cen_id', 'cen')
            ->leftJoin('Usuario', 'ana.usu_id=ese.ana_id', 'ana')
            ->where($condicion_sql_ese)
            ->getQuery()
            ->execute();

            setlocale(LC_TIME, 'es_ES'); // establece el idioma a español
            date_default_timezone_set('america/mexico_city');
            return  $result_ese->count();
       
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
        }
    
        return 0;
    }

    public function formatoPDFHoja1($data_encabezado,$array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html,$inv_id=0){
        
     
        /*
        echo '<pre>';
        var_dump($array_texto_opciones['preg_1_opciones'][0]);
        echo '</pre>';

        die();*/
        $array_estadisticas_preg_1=$array_estadisticas_opciones['data'][0];
        $array_estadisticas_preg_2=$array_estadisticas_opciones['data'][1];

        $array_textos_respuesta_preg_1=$array_texto_opciones['preg_1_opciones'];
        $array_textos_respuesta_preg_2=$array_texto_opciones['preg_2_opciones'];

        //datos a pasar en la grafica incio
        $data_1 = array(
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_1'],
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_2'],
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_3'],
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_4'],
        );
        $data_legend_1=array(
            ''.$array_textos_respuesta_preg_1[0]['texto'].' (%1.2f%%)',
            ''.$array_textos_respuesta_preg_1[1]['texto'].' (%1.2f%%)',
            ''.$array_textos_respuesta_preg_1[2]['texto'].' (%1.2f%%)',
            ''.$array_textos_respuesta_preg_1[3]['texto'].' (%1.2f%%)',

        );

        $data_2 = array(
            $array_estadisticas_preg_2['pre_2_porcentaje_opc_id_1'],
            $array_estadisticas_preg_2['pre_2_porcentaje_opc_id_2'],
       
            );
        $data_legend_2=array(
            ''.$array_textos_respuesta_preg_2[0]['texto'].' (%1.2f%%)',
            ''.$array_textos_respuesta_preg_2[1]['texto'].' (%1.2f%%)',
               
    
        );

       /* echo '<pre>';
        var_dump($data_legend_2);
        echo '</pre>';

        die();*/
        //datos a pasar en la grafica fin
        //establecemos el tema
        $theme_class = new VividTheme;

        
        $graph = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);
        $graph->SetMargin(0,0,0,30);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
        $p1->SetSize(0.38);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)

        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);

        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,11);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,11);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-1-'.$imagen_id.'.jpeg');

        $graph_2 = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.39);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)

        //Ajustes de letra
           $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
           $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);

        $p2->SetLegends($data_legend_2);
        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-2-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_1_id#",basename('graficasencuesta/respuesta-1-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_2_id#",basename('graficasencuesta/respuesta-2-'.$imagen_id.'.jpeg'),$html);

        
        $texto_pre_1=$array_texto_preg['data'][0]['pre_texto'];
        $texto_pre_2=$array_texto_preg['data'][1]['pre_texto'];
        $html=str_replace("#cantidad_enc#",trim($data_encabezado['total_encuestas_contestadas']),$html);
        $html=str_replace("#cantidad_ese#",trim($data_encabezado['total_eses']),$html);
        $html=str_replace("#reporte_mes#",trim($data_encabezado['mes_consulta']),$html);
        $html=str_replace("#reporte_anio#",trim($data_encabezado['anio_consulta']),$html);

        if($inv_id!=0){
            $investigador=Usuario::findFirstByusu_id($inv_id);
            $html=str_replace("#reporte_inv_nombre#",' realizados por el investigador '.trim($investigador->getNombreObj()),$html);

        }else{
            $html=str_replace("#reporte_inv_nombre#",trim(''),$html);

        }

        $html=str_replace("#pregunta_1#",trim($texto_pre_1),$html);
        $html=str_replace("#pregunta_2#",trim($texto_pre_2),$html);
        //sustiumos elementos fin

        

        


        return $html;

    }
    public function formatoPDFHoja1_GraficasBarras($data_encabezado,$array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html,$inv_id=0){

        $array_estadisticas_preg_1=$array_estadisticas_opciones['data'][0];
        $array_estadisticas_preg_2=$array_estadisticas_opciones['data'][1];

        $array_textos_respuesta_preg_1=$array_texto_opciones['preg_1_opciones'];
        $array_textos_respuesta_preg_2=$array_texto_opciones['preg_2_opciones'];

        //datos a pasar en la grafica incio
        $data_1 = array(
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_1'],
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_2'],
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_3'],
        $array_estadisticas_preg_1['pre_1_porcentaje_opc_id_4'],
        );

        $data_legend_1=array(
            ''.$array_textos_respuesta_preg_1[0]['texto'],
            ''.$array_textos_respuesta_preg_1[1]['texto'],
            ''.$array_textos_respuesta_preg_1[2]['texto'],
            ''.$array_textos_respuesta_preg_1[3]['texto'],

        );

        $data_2 = array(
            $array_estadisticas_preg_2['pre_2_porcentaje_opc_id_1'],
            $array_estadisticas_preg_2['pre_2_porcentaje_opc_id_2'],
       
            );
        $data_legend_2=array(
            ''.$array_textos_respuesta_preg_2[0]['texto'],
            ''.$array_textos_respuesta_preg_2[1]['texto'],
               
    
        );

    
        //establecemos el tema
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
      

        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

      

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
    

        //imprimimos y  guardamos la imagen
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-1-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-2-'.$imagen_id.'.jpeg');
      


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_1_id#",basename('graficasencuesta/respuesta-1-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_2_id#",basename('graficasencuesta/respuesta-2-'.$imagen_id.'.jpeg'),$html);

        
        $texto_pre_1=$array_texto_preg['data'][0]['pre_texto'];
        $texto_pre_2=$array_texto_preg['data'][1]['pre_texto'];
        $html=str_replace("#cantidad_enc#",trim($data_encabezado['total_encuestas_contestadas']),$html);
        $html=str_replace("#cantidad_ese#",trim($data_encabezado['total_eses']),$html);
        $html=str_replace("#reporte_mes#",trim($data_encabezado['mes_consulta']),$html);
        $html=str_replace("#reporte_anio#",trim($data_encabezado['anio_consulta']),$html);
        if($inv_id!=0){
            $investigador=Usuario::findFirstByusu_id($inv_id);
            $html=str_replace("#reporte_inv_nombre#",' realizados por el investigador '.trim($investigador->getNombreObj()),$html);

        }else{
            $html=str_replace("#reporte_inv_nombre#",trim(''),$html);

        }
        $html=str_replace("#pregunta_1#",trim($texto_pre_1),$html);
        $html=str_replace("#pregunta_2#",trim($texto_pre_2),$html);
        //sustiumos elementos fin

        

        


        return $html;

    }

    public function formatoPDFHoja2($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_3=$array_estadisticas_opciones['data'][2];
        $array_estadisticas_preg_4=$array_estadisticas_opciones['data'][3];

        $array_textos_respuesta_preg_3=$array_texto_opciones['preg_3_opciones'];
        $array_textos_respuesta_preg_4=$array_texto_opciones['preg_4_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_1'],
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_2'],
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_3'],
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_3[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_3[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_3[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_3[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_4['pre_4_porcentaje_opc_id_1'],
                $array_estadisticas_preg_4['pre_4_porcentaje_opc_id_2'],
           
                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_4[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_4[1]['texto'].' (%1.2f%%)',
                   
        
            );
    
           /* echo '<pre>';
            var_dump($data_legend_2);
            echo '</pre>';
    
            die();*/
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        
        $graph = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
        $p1->SetSize(0.38);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');
        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,11);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,11);

        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
  

    
        $graph_2 = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.38);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);
        //Ajustes de letra
        $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-3-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-4-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_3_id#",basename('graficasencuesta/respuesta-3-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_4_id#",basename('graficasencuesta/respuesta-4-'.$imagen_id.'.jpeg'),$html);
        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_3=$array_texto_preg['data'][2]['pre_texto'];
        $texto_pre_4=$array_texto_preg['data'][3]['pre_texto'];
        $html=str_replace("#pregunta_3#",trim($texto_pre_3),$html);
        $html=str_replace("#pregunta_4#",trim($texto_pre_4),$html);
        //sustiumos elementos fin        


        return $html;

    }


    public function formatoPDFHoja2_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_3=$array_estadisticas_opciones['data'][2];
        $array_estadisticas_preg_4=$array_estadisticas_opciones['data'][3];

        $array_textos_respuesta_preg_3=$array_texto_opciones['preg_3_opciones'];
        $array_textos_respuesta_preg_4=$array_texto_opciones['preg_4_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_1'],
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_2'],
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_3'],
            $array_estadisticas_preg_3['pre_3_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_3[0]['texto'],
                ''.$array_textos_respuesta_preg_3[1]['texto'],
                ''.$array_textos_respuesta_preg_3[2]['texto'],
                ''.$array_textos_respuesta_preg_3[3]['texto'],
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_4['pre_4_porcentaje_opc_id_1'],
                $array_estadisticas_preg_4['pre_4_porcentaje_opc_id_2'],
           
                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_4[0]['texto'],
                ''.$array_textos_respuesta_preg_4[1]['texto'],
                   
        
            );
    
           /* echo '<pre>';
            var_dump($data_legend_2);
            echo '</pre>';
    
            die();*/
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
      
        //establecemos el tema
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       
        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-3-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-4-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_3_id#",basename('graficasencuesta/respuesta-3-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_4_id#",basename('graficasencuesta/respuesta-4-'.$imagen_id.'.jpeg'),$html);
        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_3=$array_texto_preg['data'][2]['pre_texto'];
        $texto_pre_4=$array_texto_preg['data'][3]['pre_texto'];
        $html=str_replace("#pregunta_3#",trim($texto_pre_3),$html);
        $html=str_replace("#pregunta_4#",trim($texto_pre_4),$html);
        //sustiumos elementos fin        


        return $html;

    }


    public function formatoPDFHoja3($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_5=$array_estadisticas_opciones['data'][4];
        $array_estadisticas_preg_6=$array_estadisticas_opciones['data'][5];

        $array_textos_respuesta_preg_5=$array_texto_opciones['preg_5_opciones'];
        $array_textos_respuesta_preg_6=$array_texto_opciones['preg_6_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_5['pre_5_porcentaje_opc_id_1'],
            $array_estadisticas_preg_5['pre_5_porcentaje_opc_id_2'],
            $array_estadisticas_preg_5['pre_5_porcentaje_opc_id_3'],
           // $array_estadisticas_preg_5['pre_3_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_5[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_5[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_5[2]['texto'].' (%1.2f%%)',
                //''.$array_textos_respuesta_preg_5[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_6['pre_6_porcentaje_opc_id_1'],
                $array_estadisticas_preg_6['pre_6_porcentaje_opc_id_2'],
           
                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_6[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_6[1]['texto'].' (%1.2f%%)',
                   
        
            );
    
           /*echo '<pre>';
            var_dump($array_estadisticas_preg_6);
            echo '</pre>';*/
    
           // die();
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        
        $graph = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
        $p1->SetSize(0.38);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);
        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
  

   

        $graph_2 = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.38);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);
        //Ajustes de letra
        $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);

        
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-5-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-6-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_5_id#",basename('graficasencuesta/respuesta-5-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_6_id#",basename('graficasencuesta/respuesta-6-'.$imagen_id.'.jpeg'),$html);
        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_5=$array_texto_preg['data'][4]['pre_texto'];
        $texto_pre_6=$array_texto_preg['data'][5]['pre_texto'];
        $html=str_replace("#pregunta_5#",trim($texto_pre_5),$html);
        $html=str_replace("#pregunta_6#",trim($texto_pre_6),$html);
        //sustiumos elementos fin        


        return $html;

    }

    public function formatoPDFHoja3_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_5=$array_estadisticas_opciones['data'][4];
        $array_estadisticas_preg_6=$array_estadisticas_opciones['data'][5];

        $array_textos_respuesta_preg_5=$array_texto_opciones['preg_5_opciones'];
        $array_textos_respuesta_preg_6=$array_texto_opciones['preg_6_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_5['pre_5_porcentaje_opc_id_1'],
            $array_estadisticas_preg_5['pre_5_porcentaje_opc_id_2'],
            $array_estadisticas_preg_5['pre_5_porcentaje_opc_id_3'],
           // $array_estadisticas_preg_5['pre_3_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_5[0]['texto'],
                ''.$array_textos_respuesta_preg_5[1]['texto'],
                ''.$array_textos_respuesta_preg_5[2]['texto'],
                //''.$array_textos_respuesta_preg_5[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_6['pre_6_porcentaje_opc_id_1'],
                $array_estadisticas_preg_6['pre_6_porcentaje_opc_id_2'],
           
                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_6[0]['texto'],
                ''.$array_textos_respuesta_preg_6[1]['texto'],
                   
        
            );
    
           /*echo '<pre>';
            var_dump($array_estadisticas_preg_6);
            echo '</pre>';*/
    
           // die();
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
  
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       
        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-5-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-6-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_5_id#",basename('graficasencuesta/respuesta-5-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_6_id#",basename('graficasencuesta/respuesta-6-'.$imagen_id.'.jpeg'),$html);
        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_5=$array_texto_preg['data'][4]['pre_texto'];
        $texto_pre_6=$array_texto_preg['data'][5]['pre_texto'];
        $html=str_replace("#pregunta_5#",trim($texto_pre_5),$html);
        $html=str_replace("#pregunta_6#",trim($texto_pre_6),$html);
        //sustiumos elementos fin        


        return $html;

    }


    public function formatoPDFHoja4($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_7=$array_estadisticas_opciones['data'][6];
        $array_estadisticas_preg_8=$array_estadisticas_opciones['data'][7];

        $array_textos_respuesta_preg_7=$array_texto_opciones['preg_7_opciones'];
        $array_textos_respuesta_preg_8=$array_texto_opciones['preg_8_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_1'],
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_2'],
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_3'],
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_7[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_7[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_7[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_7[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_8['pre_8_porcentaje_opc_id_1'],
                $array_estadisticas_preg_8['pre_8_porcentaje_opc_id_2'],
                $array_estadisticas_preg_8['pre_8_porcentaje_opc_id_3'],

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_8[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_8[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_8[2]['texto'].' (%1.2f%%)',

        
            );
        /*echo '<pre>';
                var_dump($array_estadisticas_preg_6);
            echo '</pre>';*/
    
           // die();
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        $graph = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
         //Ajustes de letra
         $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
         $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);

        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        $p1->SetSize(0.39);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)

     

        $graph_2 = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.39);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);
        //Ajustes de letra
        $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);
        
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-7-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-8-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_7_id#",basename('graficasencuesta/respuesta-7-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_8_id#",basename('graficasencuesta/respuesta-8-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_7=$array_texto_preg['data'][6]['pre_texto'];
        $texto_pre_8=$array_texto_preg['data'][7]['pre_texto'];
        $html=str_replace("#pregunta_7#",trim($texto_pre_7),$html);
        $html=str_replace("#pregunta_8#",trim($texto_pre_8),$html);
        //sustiumos elementos fin        


        return $html;

    }
    
    public function formatoPDFHoja4_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_7=$array_estadisticas_opciones['data'][6];
        $array_estadisticas_preg_8=$array_estadisticas_opciones['data'][7];

        $array_textos_respuesta_preg_7=$array_texto_opciones['preg_7_opciones'];
        $array_textos_respuesta_preg_8=$array_texto_opciones['preg_8_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_1'],
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_2'],
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_3'],
            $array_estadisticas_preg_7['pre_7_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_7[0]['texto'],
                ''.$array_textos_respuesta_preg_7[1]['texto'],
                ''.$array_textos_respuesta_preg_7[2]['texto'],
                ''.$array_textos_respuesta_preg_7[3]['texto'],
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_8['pre_8_porcentaje_opc_id_1'],
                $array_estadisticas_preg_8['pre_8_porcentaje_opc_id_2'],
                $array_estadisticas_preg_8['pre_8_porcentaje_opc_id_3'],

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_8[0]['texto'],
                ''.$array_textos_respuesta_preg_8[1]['texto'],
                ''.$array_textos_respuesta_preg_8[2]['texto'],

        
            );
        /*echo '<pre>';
                var_dump($array_estadisticas_preg_6);
            echo '</pre>';*/
    
           // die();
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       
        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-7-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-8-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_7_id#",basename('graficasencuesta/respuesta-7-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_8_id#",basename('graficasencuesta/respuesta-8-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_7=$array_texto_preg['data'][6]['pre_texto'];
        $texto_pre_8=$array_texto_preg['data'][7]['pre_texto'];
        $html=str_replace("#pregunta_7#",trim($texto_pre_7),$html);
        $html=str_replace("#pregunta_8#",trim($texto_pre_8),$html);
        //sustiumos elementos fin        


        return $html;

    }
    public function formatoPDFHoja5($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_9=$array_estadisticas_opciones['data'][8];
        $array_estadisticas_preg_10=$array_estadisticas_opciones['data'][9];

        $array_textos_respuesta_preg_9=$array_texto_opciones['preg_9_opciones'];
        $array_textos_respuesta_preg_10=$array_texto_opciones['preg_10_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_1'],
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_2'],
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_3'],
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_9[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_9[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_9[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_9[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_10['pre_10_porcentaje_opc_id_1'],
                $array_estadisticas_preg_10['pre_10_porcentaje_opc_id_2'],
                $array_estadisticas_preg_10['pre_10_porcentaje_opc_id_3'],

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_10[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_10[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_10[2]['texto'].' (%1.2f%%)',

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        $graph = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
   

        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        $p1->SetSize(0.39);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)

        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,9);
        

        $graph_2 = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.39);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);
         //Ajustes de letra
         $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
         $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);


        // Ajusta el margen agregando un valor negativo a la coordenada Y de la posición
    

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-9-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-10-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_9_id#",basename('graficasencuesta/respuesta-9-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_10_id#",basename('graficasencuesta/respuesta-10-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_9=$array_texto_preg['data'][8]['pre_texto'];
        $texto_pre_10=$array_texto_preg['data'][9]['pre_texto'];
        $html=str_replace("#pregunta_9#",trim($texto_pre_9),$html);
        $html=str_replace("#pregunta_10#",trim($texto_pre_10),$html);
        //sustiumos elementos fin        


        return $html;

    }
    


    public function formatoPDFHoja5_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_9=$array_estadisticas_opciones['data'][8];
        $array_estadisticas_preg_10=$array_estadisticas_opciones['data'][9];

        $array_textos_respuesta_preg_9=$array_texto_opciones['preg_9_opciones'];
        $array_textos_respuesta_preg_10=$array_texto_opciones['preg_10_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_1'],
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_2'],
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_3'],
            $array_estadisticas_preg_9['pre_9_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_9[0]['texto'],
                ''.$array_textos_respuesta_preg_9[1]['texto'],
                ''.$array_textos_respuesta_preg_9[2]['texto'],
                ''.$array_textos_respuesta_preg_9[3]['texto'],
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_10['pre_10_porcentaje_opc_id_1'],
                $array_estadisticas_preg_10['pre_10_porcentaje_opc_id_2'],
                $array_estadisticas_preg_10['pre_10_porcentaje_opc_id_3'],

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_10[0]['texto'],
                ''.$array_textos_respuesta_preg_10[1]['texto'],
                ''.$array_textos_respuesta_preg_10[2]['texto'],

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

    
        //creacion de graficos incicio
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       
        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        
        
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-9-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-10-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_9_id#",basename('graficasencuesta/respuesta-9-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_10_id#",basename('graficasencuesta/respuesta-10-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_9=$array_texto_preg['data'][8]['pre_texto'];
        $texto_pre_10=$array_texto_preg['data'][9]['pre_texto'];
        $html=str_replace("#pregunta_9#",trim($texto_pre_9),$html);
        $html=str_replace("#pregunta_10#",trim($texto_pre_10),$html);
        //sustiumos elementos fin        


        return $html;

    }
    


    public function formatoPDFHoja6($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_11=$array_estadisticas_opciones['data'][10];
        $array_estadisticas_preg_12=$array_estadisticas_opciones['data'][11];

        $array_textos_respuesta_preg_11=$array_texto_opciones['preg_11_opciones'];
        $array_textos_respuesta_preg_12=$array_texto_opciones['preg_12_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_1'],
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_2'],
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_3'],
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_11[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_11[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_11[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_11[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_12['pre_12_porcentaje_opc_id_1'],
                $array_estadisticas_preg_12['pre_12_porcentaje_opc_id_2'],
                //$array_estadisticas_preg_10['pre_10_porcentaje_opc_id_3'],

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_12[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_12[1]['texto'].' (%1.2f%%)',
               // ''.$array_textos_respuesta_preg_12[2]['texto'].' (%1.2f%%)',

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        $graph = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
   
        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);
        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        $p1->SetSize(0.39);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)

     

        $graph_2 = new PieGraph(800,400);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.39);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);
        //Ajustes de letra
        $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);


        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-11-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-12-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');
      

        //sustiumos elementos inicio
        $html=str_replace("#respuesta_11_id#",basename('graficasencuesta/respuesta-11-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_12_id#",basename('graficasencuesta/respuesta-12-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_11=$array_texto_preg['data'][10]['pre_texto'];
        $texto_pre_12=$array_texto_preg['data'][11]['pre_texto'];
        $html=str_replace("#pregunta_11#",trim($texto_pre_11),$html);
        $html=str_replace("#pregunta_12#",trim($texto_pre_12),$html);
        //sustiumos elementos fin        


        return $html;

    }

    public function formatoPDFHoja6_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_11=$array_estadisticas_opciones['data'][10];
        $array_estadisticas_preg_12=$array_estadisticas_opciones['data'][11];

        $array_textos_respuesta_preg_11=$array_texto_opciones['preg_11_opciones'];
        $array_textos_respuesta_preg_12=$array_texto_opciones['preg_12_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_1'],
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_2'],
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_3'],
            $array_estadisticas_preg_11['pre_11_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_11[0]['texto'],
                ''.$array_textos_respuesta_preg_11[1]['texto'],
                ''.$array_textos_respuesta_preg_11[2]['texto'],
                ''.$array_textos_respuesta_preg_11[3]['texto'],
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_12['pre_12_porcentaje_opc_id_1'],
                $array_estadisticas_preg_12['pre_12_porcentaje_opc_id_2'],
                //$array_estadisticas_preg_10['pre_10_porcentaje_opc_id_3'],

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_12[0]['texto'],
                ''.$array_textos_respuesta_preg_12[1]['texto'],
               // ''.$array_textos_respuesta_preg_12[2]['texto'].' (%1.2f%%)',

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

       //creacion de graficos incicio
       $theme_class = new VividTheme;
       $graph = new Graph(700,300);
       $graph->SetScale("textlin");
       
       $graph->SetTheme($theme_class);
       $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
       $p1 = new BarPlot($data_1);
       $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
      
       //grafica 2
       $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
       $graph_2->SetScale("textlin");
       $graph_2->ClearTheme();
       $graph_2->SetTheme($theme_class);
       $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
       $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-11-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-12-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');
      

        //sustiumos elementos inicio
        $html=str_replace("#respuesta_11_id#",basename('graficasencuesta/respuesta-11-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_12_id#",basename('graficasencuesta/respuesta-12-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_11=$array_texto_preg['data'][10]['pre_texto'];
        $texto_pre_12=$array_texto_preg['data'][11]['pre_texto'];
        $html=str_replace("#pregunta_11#",trim($texto_pre_11),$html);
        $html=str_replace("#pregunta_12#",trim($texto_pre_12),$html);
        //sustiumos elementos fin        


        return $html;

    }

    public function formatoPDFHoja7($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_13=$array_estadisticas_opciones['data'][12];
        $array_estadisticas_preg_14=$array_estadisticas_opciones['data'][13];

        $array_textos_respuesta_preg_13=$array_texto_opciones['preg_13_opciones'];
        $array_textos_respuesta_preg_14=$array_texto_opciones['preg_14_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_13['pre_13_porcentaje_opc_id_1'],
            $array_estadisticas_preg_13['pre_13_porcentaje_opc_id_2'],
            //$array_estadisticas_preg_11['pre_11_porcentaje_opc_id_3'],
            //$array_estadisticas_preg_11['pre_11_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_13[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_13[1]['texto'].' (%1.2f%%)',
                //''.$array_textos_respuesta_preg_11[2]['texto'].' (%1.2f%%)',
                //''.$array_textos_respuesta_preg_11[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_1'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_2'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_3'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_4'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_5'],


                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_14[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_14[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_14[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_14[3]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_14[4]['texto'].' (%1.2f%%)',

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        $graph = new PieGraph(900,500);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
        $p1->SetSize(0.39);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)

        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);

     

        $graph_2 = new PieGraph(900,500);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.38);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);

        //Ajustes de letra
          $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
          $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);
  

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-13-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-14-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_13_id#",basename('graficasencuesta/respuesta-13-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_14_id#",basename('graficasencuesta/respuesta-14-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_13=$array_texto_preg['data'][12]['pre_texto'];
        $texto_pre_14=$array_texto_preg['data'][13]['pre_texto'];
        $html=str_replace("#pregunta_13#",trim($texto_pre_13),$html);
        $html=str_replace("#pregunta_14#",trim($texto_pre_14),$html);
        //sustiumos elementos fin        


        return $html;

    }

    public function formatoPDFHoja7_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_13=$array_estadisticas_opciones['data'][12];
        $array_estadisticas_preg_14=$array_estadisticas_opciones['data'][13];

        $array_textos_respuesta_preg_13=$array_texto_opciones['preg_13_opciones'];
        $array_textos_respuesta_preg_14=$array_texto_opciones['preg_14_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_13['pre_13_porcentaje_opc_id_1'],
            $array_estadisticas_preg_13['pre_13_porcentaje_opc_id_2'],
            //$array_estadisticas_preg_11['pre_11_porcentaje_opc_id_3'],
            //$array_estadisticas_preg_11['pre_11_porcentaje_opc_id_4'],
            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_13[0]['texto'],
                ''.$array_textos_respuesta_preg_13[1]['texto'],
                //''.$array_textos_respuesta_preg_11[2]['texto'].' (%1.2f%%)',
                //''.$array_textos_respuesta_preg_11[3]['texto'].' (%1.2f%%)',
    
            );
    
            $data_2 = array(
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_1'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_2'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_3'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_4'],
                $array_estadisticas_preg_14['pre_14_porcentaje_opc_id_5'],


                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_14[0]['texto'],
                ''.$array_textos_respuesta_preg_14[1]['texto'],
                ''.$array_textos_respuesta_preg_14[2]['texto'],
                ''.$array_textos_respuesta_preg_14[3]['texto'],
                ''.$array_textos_respuesta_preg_14[4]['texto'],

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        //datos a pasar en la grafica fin

        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       
        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,8);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-13-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-14-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_13_id#",basename('graficasencuesta/respuesta-13-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_14_id#",basename('graficasencuesta/respuesta-14-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_13=$array_texto_preg['data'][12]['pre_texto'];
        $texto_pre_14=$array_texto_preg['data'][13]['pre_texto'];
        $html=str_replace("#pregunta_13#",trim($texto_pre_13),$html);
        $html=str_replace("#pregunta_14#",trim($texto_pre_14),$html);
        //sustiumos elementos fin        


        return $html;

    }
    

    public function formatoPDFHoja8($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_15=$array_estadisticas_opciones['data'][14];
        $array_estadisticas_preg_16=$array_estadisticas_opciones['data'][15];

        $array_textos_respuesta_preg_15=$array_texto_opciones['preg_15_opciones'];
        $array_textos_respuesta_preg_16=$array_texto_opciones['preg_16_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_1'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_2'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_3'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_4'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_5'],

            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_15[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_15[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_15[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_15[3]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_15[4]['texto'].' (%1.2f%%)',

            );
    
            $data_2 = array(
                $array_estadisticas_preg_16['pre_16_porcentaje_opc_id_1'],
                $array_estadisticas_preg_16['pre_16_porcentaje_opc_id_2'],
             

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_16[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_16[1]['texto'].' (%1.2f%%)',
               

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        $graph = new PieGraph(950,600);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
      


        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        $p1->SetSize(0.37);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
    //Ajustes de letra
    $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
    $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,10);

        

        $graph_2 = new PieGraph(850,450);//tamanño de la imagen//ancho y alto 
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p2 = new PiePlot($data_2);//creamos la grafica
        $p2->SetSize(0.39);//define el tamaño de la gráfica
        $graph_2->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        $p2->SetLegends($data_legend_2);
        //Ajustes de letra
        $p2->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph_2->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);


        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-15-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-16-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_15_id#",basename('graficasencuesta/respuesta-15-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_16_id#",basename('graficasencuesta/respuesta-16-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_15=$array_texto_preg['data'][14]['pre_texto'];
        $texto_pre_16=$array_texto_preg['data'][15]['pre_texto'];
        $html=str_replace("#pregunta_15#",trim($texto_pre_15),$html);
        $html=str_replace("#pregunta_16#",trim($texto_pre_16),$html);
        //sustiumos elementos fin        


        return $html;

    }


    public function formatoPDFHoja8_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_15=$array_estadisticas_opciones['data'][14];
        $array_estadisticas_preg_16=$array_estadisticas_opciones['data'][15];

        $array_textos_respuesta_preg_15=$array_texto_opciones['preg_15_opciones'];
        $array_textos_respuesta_preg_16=$array_texto_opciones['preg_16_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_1'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_2'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_3'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_4'],
            $array_estadisticas_preg_15['pre_15_porcentaje_opc_id_5'],

            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_15[0]['texto'],
                ''.$array_textos_respuesta_preg_15[1]['texto'],
                ''.$array_textos_respuesta_preg_15[2]['texto'],
                ''.$array_textos_respuesta_preg_15[3]['texto'],
                ''.$array_textos_respuesta_preg_15[4]['texto'],

            );
    
            $data_2 = array(
                $array_estadisticas_preg_16['pre_16_porcentaje_opc_id_1'],
                $array_estadisticas_preg_16['pre_16_porcentaje_opc_id_2'],
             

                );
            $data_legend_2=array(
                ''.$array_textos_respuesta_preg_16[0]['texto'],
                ''.$array_textos_respuesta_preg_16[1]['texto'],
               

        
            );
           /* echo '<pre>';
                var_dump($data_1);
            echo '</pre>';
    
           die();*/
     
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;
        $graph = new Graph(700,300);
        $graph->SetScale("textlin");
        
        $graph->SetTheme($theme_class);
        $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
        $p1 = new BarPlot($data_1);
        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
       
        //grafica 2
        $graph_2 = new Graph(700,300);//tamanño de la imagen//ancho y alto 
        $graph_2->SetScale("textlin");
        $graph_2->ClearTheme();
        $graph_2->SetTheme($theme_class);
        $graph_2->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $graph_2->xaxis->SetTickLabels($data_legend_2);//establecemos los titulos
        $p2 = new BarPlot($data_2);

        $graph->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,6);
        $graph_2->xaxis->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-15-'.$imagen_id.'.jpeg');

        $graph_2->Add($p2);
        $graph_2->Stroke('./graficasencuesta/respuesta-16-'.$imagen_id.'.jpeg');
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_15_id#",basename('graficasencuesta/respuesta-15-'.$imagen_id.'.jpeg'),$html);
        $html=str_replace("#respuesta_16_id#",basename('graficasencuesta/respuesta-16-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_15=$array_texto_preg['data'][14]['pre_texto'];
        $texto_pre_16=$array_texto_preg['data'][15]['pre_texto'];
        $html=str_replace("#pregunta_15#",trim($texto_pre_15),$html);
        $html=str_replace("#pregunta_16#",trim($texto_pre_16),$html);
        //sustiumos elementos fin        


        return $html;

    }

    


    public function formatoPDFHoja9($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_17=$array_estadisticas_opciones['data'][16];

        $array_textos_respuesta_preg_17=$array_texto_opciones['preg_17_opciones'];

        if($array_estadisticas_opciones['preg_17']['pre_17_contador_total_respuestas']<=0){
            $html=str_replace("#respuesta_17_id#",basename('./graficasencuesta/error_no_hay_info.png'),$html);
            //creacion de graficos fin 
            //sustiumos elementos incio        
            $texto_pre_17=$array_texto_preg['data'][16]['pre_texto'];
            $html=str_replace("#pregunta_17#",trim($texto_pre_17),$html);
            //sustiumos elementos fin        
    
    
            return $html;
        }   

           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_1'],
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_2'],
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_3'],
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_4'],

            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_17[0]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_17[1]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_17[2]['texto'].' (%1.2f%%)',
                ''.$array_textos_respuesta_preg_17[3]['texto'].' (%1.2f%%)',

            );
    
           
           /* echo '<pre>';
                var_dump($array_estadisticas_preg_17);
            echo '</pre>';
    
           die();   */
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
        $theme_class = new VividTheme;

        $graph = new PieGraph(800,500);//tamanño de la imagen//ancho y alto 
        $graph->ClearTheme();
        $graph->SetTheme($theme_class);

        $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion
        $p1 = new PiePlot($data_1);//creamos la grafica
   

        // Establecer los colores de las secciones
        $p1->SetLegends($data_legend_1);
        $p1->SetSize(0.4);//define el tamaño de la gráfica
        $graph->legend->SetPos(0.5,0.98,'center','bottom');//establece la posicion de las legandas(descripcion)
        //Ajustes de letra
        $p1->value->SetFont(FF_DEFAULT,FS_NORMAL,12);
        $graph->legend->SetFont(FF_DEFAULT,FS_NORMAL,12);

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-17-'.$imagen_id.'.jpeg');

       
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_17_id#",basename('graficasencuesta/respuesta-17-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_17=$array_texto_preg['data'][16]['pre_texto'];
        $html=str_replace("#pregunta_17#",trim($texto_pre_17),$html);
        //sustiumos elementos fin        


        return $html;

    }

    public function formatoPDFHoja9_GraficasBarras($array_texto_preg,$array_texto_opciones,$array_estadisticas_opciones,$imagen_id,$html){
        
        $array_estadisticas_preg_17=$array_estadisticas_opciones['data'][16];

        $array_textos_respuesta_preg_17=$array_texto_opciones['preg_17_opciones'];


           //datos a pasar en la grafica incio
           $data_1 = array(
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_1'],
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_2'],
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_3'],
            $array_estadisticas_preg_17['pre_17_porcentaje_opc_id_4'],

            );
            $data_legend_1=array(
                ''.$array_textos_respuesta_preg_17[0]['texto'],
                ''.$array_textos_respuesta_preg_17[1]['texto'],
                ''.$array_textos_respuesta_preg_17[2]['texto'],
                ''.$array_textos_respuesta_preg_17[3]['texto'],

            );
    
           
           /* echo '<pre>';
                var_dump($array_estadisticas_preg_17);
            echo '</pre>';
    
           die();   */
        //datos a pasar en la grafica fin

        //creacion de graficos incicio
          $theme_class = new VividTheme;
          $graph = new Graph(700,300);
          $graph->SetScale("textlin");
          
          $graph->SetTheme($theme_class);
          $graph->xaxis->SetTickLabels($data_legend_1);//establecemos los titulos
          $p1 = new BarPlot($data_1);
          $graph->img ->SetImgFormat('jpeg');//para que salga en mejor resolucion

        $graph->Add($p1);
        $graph->Stroke('./graficasencuesta/respuesta-17-'.$imagen_id.'.jpeg');

       
       // $graph->Stroke('./graficasrespuesta/respuesta-2-'.$imagen_id.'.jpeg');


        //sustiumos elementos inicio
        $html=str_replace("#respuesta_17_id#",basename('graficasencuesta/respuesta-17-'.$imagen_id.'.jpeg'),$html);
        

        //creacion de graficos fin 


        //sustiumos elementos incio        
        $texto_pre_17=$array_texto_preg['data'][16]['pre_texto'];
        $html=str_replace("#pregunta_17#",trim($texto_pre_17),$html);
        //sustiumos elementos fin        


        return $html;

    }

    public function limpiarImagenesGeneradasReporteRespuestas($id){
        $dir='./graficasencuesta/';
        for ($i = 1; $i <= 17; $i++) {
            unlink($dir.basename('respuesta-'.$i.'-'.$id.'.jpeg'));
        }

    }

    
    public function formatoPDFHoja9_1($texto_preguntas,$data_comentarios,$html,$mpdf,$pregunta_abierta_relacionada){
        $data_procesada=[];
        $html_plantilla='';
        $tabla_respuestas_id="#tabla_respuestas_7_1#";
        $respuesta_sin_data_comentarios_id="#respuesta_sin_data_comentarios#";
        $pregunta_texto_id="#pregunta_7_1#";
        $filas_por_tabla=29;
        $index_texto_pregunta=0;
        //jalamos todos los campos que tenga algo en el campo texto
        foreach ($data_comentarios as $key) {
            if($key['res_texto']!=null){
                array_push($data_procesada,$key);

            }
        }
  

        if(count($data_procesada)>0){
            $filas='';
            $contador_filas = 0;
            $html_tabla = '';
            
            foreach ($data_procesada as $index=> $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size: '.$this->font_size_comentarios_pdf.';">                           
                            <td style="width:70%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['res_texto'].'</td>
                            <td style="width:30%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>
                        </tr>';
                $filas .= $fila;
                $contador_filas++;
            
                
            }

            
            $html_tabla .= '
            <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;  font-size: '.$this->font_size_comentarios_pdf.';">
                <thead>
                        <tr class="trowhead" style="background:#233840;">
                            <th  style="width:70%; color:white; font-weight:bold;">Comentario</th>
                            <th style="width:20%; color:white; font-weight:bold;">Investigador</th>
                        </tr>
                </thead>   
            
                <tbody style="width:100%; padding: 2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';" >
                    '.$filas.'
                ';

            $tablafin="</tbody></table>";

            $html_tabla=$html_tabla.$tablafin;
            $html_plantilla=$html;
            $html_plantilla=str_replace($tabla_respuestas_id,$html_tabla,$html_plantilla);
            $html_plantilla=str_replace($respuesta_sin_data_comentarios_id,'',$html_plantilla);
            $texto_pre=$pregunta_abierta_relacionada['data'][6]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html_plantilla=str_replace($pregunta_texto_id,$pregunta_completa,$html_plantilla);

            
            
            $answer= ['html'=>$html_plantilla,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
            $mpdf->AddPage();

                  
        }else{
            //no existen datos  
            $html=str_replace($respuesta_sin_data_comentarios_id,'Sin comentarios',$html);
            $html=str_replace($tabla_respuestas_id,'',$html);
            $texto_pre=$pregunta_abierta_relacionada['data'][6]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html=str_replace($pregunta_texto_id,$pregunta_completa,$html);
            $answer= ['html'=>$html,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }

        return $answer;
   
   
    }

    public function formatoPDFHoja10($texto_preguntas,$data_comentarios,$html,$mpdf,$pregunta_abierta_relacionada){
        $data_procesada=[];
        $html_plantilla='';
        $tabla_respuestas_id="#tabla_respuestas_8_1#";
        $respuesta_sin_data_comentarios_id="#respuesta_sin_data_comentarios#";
        $pregunta_texto_id="#pregunta_8_1#";
        $filas_por_tabla=29;
        $index_texto_pregunta=1;
        //jalamos todos los campos que tenga algo en el campo texto
        foreach ($data_comentarios as $key) {
            if($key['res_texto']!=null){
                array_push($data_procesada,$key);

            }
        }
  

        if(count($data_procesada)>0){
            $filas='';
            $contador_filas = 0;
            $html_tabla = '';
            
            foreach ($data_procesada as $index=> $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size: '.$this->font_size_comentarios_pdf.';">                           
                            <td style="width:70%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['res_texto'].'</td>
                            <td style="width:30%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>
                        </tr>';
                $filas .= $fila;
                $contador_filas++;
            
                
            }

            
            $html_tabla .= '
            <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;  font-size: '.$this->font_size_comentarios_pdf.';">
                <thead>
                        <tr class="trowhead" style="background:#233840;">
                            <th  style="width:70%; color:white; font-weight:bold;">Comentario</th>
                            <th style="width:20%; color:white; font-weight:bold;">Investigador</th>
                        </tr>
                </thead>   
            
                <tbody style="width:100%; padding: 2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';" >
                    '.$filas.'
                ';

            $tablafin="</tbody></table>";

            $html_tabla=$html_tabla.$tablafin;
            $html_plantilla=$html;
            $html_plantilla=str_replace($tabla_respuestas_id,$html_tabla,$html_plantilla);
            $html_plantilla=str_replace($respuesta_sin_data_comentarios_id,'',$html_plantilla);
            $texto_pre=$pregunta_abierta_relacionada['data'][7]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html_plantilla=str_replace($pregunta_texto_id,$pregunta_completa,$html_plantilla);

            
            
            $answer= ['html'=>$html_plantilla,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
            $mpdf->AddPage();

                  
        }else{
            //no existen datos  
            $html=str_replace($respuesta_sin_data_comentarios_id,'Sin comentarios',$html);
            $html=str_replace($tabla_respuestas_id,'',$html);
            $texto_pre=$pregunta_abierta_relacionada['data'][7]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html=str_replace($pregunta_texto_id,$pregunta_completa,$html);
            $answer= ['html'=>$html,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }

        return $answer;
    }



    public function formatoPDFHoja11($texto_preguntas,$data_comentarios,$html,$mpdf){
        
        $data_procesada=[];
        $html_plantilla='';
        $tabla_respuestas_id="#tabla_respuestas_12_1#";
        $respuesta_sin_data_comentarios_id="#respuesta_sin_data_comentarios#";
        $pregunta_texto_id="#pregunta_12_1#";
        $filas_por_tabla=29;
        $index_texto_pregunta=2;
        //jalamos todos los campos que tenga algo en el campo texto
        foreach ($data_comentarios as $key) {
            if($key['res_texto']!=null){
                array_push($data_procesada,$key);

            }
        }
  

        if(count($data_procesada)>0){
            $filas='';
            $contador_filas = 0;
            $html_tabla = '';
            
            foreach ($data_procesada as $index=> $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size: '.$this->font_size_comentarios_pdf.';">                           
                            <td style="width:70%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['res_texto'].'</td>
                            <td style="width:30%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>
                        </tr>';
                $filas .= $fila;
                $contador_filas++;
            
                
            }

            
            $html_tabla .= '
            <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;  font-size: '.$this->font_size_comentarios_pdf.';">
                <thead>
                        <tr class="trowhead" style="background:#233840;">
                            <th  style="width:70%; color:white; font-weight:bold;">Comentario</th>
                            <th style="width:20%; color:white; font-weight:bold;">Investigador</th>
                        </tr>
                </thead>   
            
                <tbody style="width:100%; padding: 2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';" >
                    '.$filas.'
                ';

            $tablafin="</tbody></table>";

            $html_tabla=$html_tabla.$tablafin;
            $html_plantilla=$html;
            $html_plantilla=str_replace($tabla_respuestas_id,$html_tabla,$html_plantilla);
            $html_plantilla=str_replace($respuesta_sin_data_comentarios_id,'',$html_plantilla);
            $html_plantilla=str_replace($pregunta_texto_id,$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'],$html_plantilla);
            $answer= ['html'=>$html_plantilla,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
            $mpdf->AddPage();

                  
        }else{
            //no existen datos  
            $html=str_replace($respuesta_sin_data_comentarios_id,'Sin comentarios',$html);
            $html=str_replace($tabla_respuestas_id,'',$html);

            $html=str_replace($pregunta_texto_id,$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'],$html);
            $answer= ['html'=>$html,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }

        return $answer;
    }

    public function formatoPDFHoja12($texto_preguntas,$data_comentarios,$html,$mpdf,$pregunta_abierta_relacionada){
        $data_procesada=[];
        $html_plantilla='';
        $tabla_respuestas_id="#tabla_respuestas_15_1#";
        $respuesta_sin_data_comentarios_id="#respuesta_sin_data_comentarios#";
        $pregunta_texto_id="#pregunta_15_1#";
        $filas_por_tabla=29;
        $index_texto_pregunta=3;
        //jalamos todos los campos que tenga algo en el campo texto
        foreach ($data_comentarios as $key) {
            if($key['res_texto']!=null){
                array_push($data_procesada,$key);

            }
        }
  

        if(count($data_procesada)>0){
            $filas='';
            $contador_filas = 0;
            $html_tabla = '';
            
            foreach ($data_procesada as $index=> $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size: '.$this->font_size_comentarios_pdf.';">                           
                            <td style="width:70%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['res_texto'].'</td>
                            <td style="width:30%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>
                        </tr>';
                $filas .= $fila;
                $contador_filas++;
            
                
            }

            
            $html_tabla .= '
            <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;  font-size: '.$this->font_size_comentarios_pdf.';">
                <thead>
                        <tr class="trowhead" style="background:#233840;">
                            <th  style="width:70%; color:white; font-weight:bold;">Comentario</th>
                            <th style="width:20%; color:white; font-weight:bold;">Investigador</th>
                        </tr>
                </thead>   
            
                <tbody style="width:100%; padding: 2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';" >
                    '.$filas.'
                ';

            $tablafin="</tbody></table>";

            $html_tabla=$html_tabla.$tablafin;
            $html_plantilla=$html;
            $html_plantilla=str_replace($tabla_respuestas_id,$html_tabla,$html_plantilla);
            $html_plantilla=str_replace($respuesta_sin_data_comentarios_id,'',$html_plantilla);
            $texto_pre=$pregunta_abierta_relacionada['data'][14]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html_plantilla=str_replace($pregunta_texto_id, $pregunta_completa,$html_plantilla);
            
            $answer= ['html'=>$html_plantilla,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
            $mpdf->AddPage();

                  
        }else{
            //no existen datos  
            $html=str_replace($respuesta_sin_data_comentarios_id,'Sin comentarios',$html);
            $html=str_replace($tabla_respuestas_id,'',$html);

            $texto_pre=$pregunta_abierta_relacionada['data'][14]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html=str_replace($pregunta_texto_id, $pregunta_completa,$html);
            $answer= ['html'=>$html,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }
        return $answer;
    }

    public function formatoPDFHoja13($texto_preguntas,$data_comentarios,$html,$mpdf,$pregunta_abierta_relacionada){
        $data_procesada=[];
        $html_plantilla='';
        $tabla_respuestas_id="#tabla_respuestas_17_1#";
        $respuesta_sin_data_comentarios_id="#respuesta_sin_data_comentarios#";
        $pregunta_texto_id="#pregunta_17_1#";
        $filas_por_tabla=29;
        $index_texto_pregunta=4;
        //jalamos todos los campos que tenga algo en el campo texto
        foreach ($data_comentarios as $key) {
            if($key['res_texto']!=null){
                array_push($data_procesada,$key);

            }
        }
  

        if(count($data_procesada)>0){
            $filas='';
            $contador_filas = 0;
            $html_tabla = '';
            
            foreach ($data_procesada as $index=> $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size: '.$this->font_size_comentarios_pdf.';">                           
                            <td style="width:70%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['res_texto'].'</td>
                            <td style="width:30%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>
                        </tr>';
                $filas .= $fila;
                $contador_filas++;
            
                
            }

            
            $html_tabla .= '
            <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;  font-size: '.$this->font_size_comentarios_pdf.';">
                <thead>
                        <tr class="trowhead" style="background:#233840;">
                            <th  style="width:70%; color:white; font-weight:bold;">Comentario</th>
                            <th style="width:20%; color:white; font-weight:bold;">Investigador</th>
                        </tr>
                </thead>   
            
                <tbody style="width:100%; padding: 2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';" >
                    '.$filas.'
                ';

            $tablafin="</tbody></table>";

            $html_tabla=$html_tabla.$tablafin;
            $html_plantilla=$html;
            $html_plantilla=str_replace($tabla_respuestas_id,$html_tabla,$html_plantilla);
            $html_plantilla=str_replace($respuesta_sin_data_comentarios_id,'',$html_plantilla);
            
            $texto_pre=$pregunta_abierta_relacionada['data'][16]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html_plantilla=str_replace($pregunta_texto_id, $pregunta_completa,$html_plantilla);
            
            $answer= ['html'=>$html_plantilla,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
            $mpdf->AddPage();

                  
        }else{
            //no existen datos  
            $html=str_replace($respuesta_sin_data_comentarios_id,'Sin comentarios',$html);
            $html=str_replace($tabla_respuestas_id,'',$html);

            $texto_pre=$pregunta_abierta_relacionada['data'][16]['pre_texto'];
            $pregunta_completa=$texto_pre.'<br>'.$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'];
            $html=str_replace($pregunta_texto_id, $pregunta_completa,$html);
            $answer= ['html'=>$html,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }

        return $answer;
    }


    public function formatoPDFHoja14($texto_preguntas,$data_comentarios,$html,$mpdf){
        $data_procesada=[];
        $html_plantilla='';
        $tabla_respuestas_id="#tabla_respuestas_18#";
        $respuesta_sin_data_comentarios_id="#respuesta_sin_data_comentarios#";
        $pregunta_texto_id="#pregunta_18#";
        $filas_por_tabla=29;
        $index_texto_pregunta=5;
        //jalamos todos los campos que tenga algo en el campo texto
        foreach ($data_comentarios as $key) {
            if($key['res_texto']!=null){
                array_push($data_procesada,$key);

            }
        }
  

        if(count($data_procesada)>0){
            $filas='';
            $contador_filas = 0;
            $html_tabla = '';
            
            foreach ($data_procesada as $index=> $key) {
                $background = ($contador_filas % 2 == 0) ? '#CCE4ED' : 'white';
                $fila = '<tr style="background-color:'.$background.'; font-size: '.$this->font_size_comentarios_pdf.';">                           
                            <td style="width:70%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['res_texto'].'</td>
                            <td style="width:30%; font-size: '.$this->font_size_comentarios_pdf.';">'.$key['inv_nombre'].'</td>
                        </tr>';
                $filas .= $fila;
                $contador_filas++;
            
                
            }

            
            $html_tabla .= '
            <table  colspan="100%"  cellspacing="0" style=" width:100% ; border-collapse: collapse;  font-size: '.$this->font_size_comentarios_pdf.';">
                <thead>
                        <tr class="trowhead" style="background:#233840;">
                            <th  style="width:70%; color:white; font-weight:bold;">Comentario</th>
                            <th style="width:20%; color:white; font-weight:bold;">Investigador</th>
                        </tr>
                </thead>   
            
                <tbody style="width:100%; padding: 2% 0% 0%; font-size:'.$this->font_size_comentarios_pdf.';" >
                    '.$filas.'
                ';

            $tablafin="</tbody></table>";

            $html_tabla=$html_tabla.$tablafin;
            $html_plantilla=$html;
            $html_plantilla=str_replace($tabla_respuestas_id,$html_tabla,$html_plantilla);
            $html_plantilla=str_replace($respuesta_sin_data_comentarios_id,'',$html_plantilla);
            $html_plantilla=str_replace($pregunta_texto_id,$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'],$html_plantilla);
            $answer= ['html'=>$html_plantilla,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
           
                  
        }else{
            //no existen datos  
            $html=str_replace($respuesta_sin_data_comentarios_id,'Sin comentarios',$html);
            $html=str_replace($tabla_respuestas_id,'',$html);

            $html=str_replace($pregunta_texto_id,$texto_preguntas['data'][$index_texto_pregunta]['pre_texto'],$html);
            $answer= ['html'=>$html,'existe_info'=> count($data_procesada)];
            $mpdf->WriteHTML($answer['html']);
        }

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
    



}
