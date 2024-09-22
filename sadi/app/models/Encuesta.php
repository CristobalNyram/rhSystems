<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
use Phalcon\Di;

/**
 * Modelo de la tabla puesto
 */
class Encuesta extends Model
{
    public $enc_version_activa = "2024_enero";
    public function getDataDetalle($enc_id)
    {
        $answer = [];
        $ese_data = Encuesta::query()
            ->columns('
            Encuesta.enc_id,

            Encuesta.ese_id,
            emp.emp_id,
            emp.emp_alias as empresa_nombre, 
            ese.ese_correo, 
            ese.tip_id,
            ese.ese_telefono,
            ese.ese_telefonorecado,
            ese.ese_celular,
            CONCAT(ese.ese_nombre," ", ese.ese_primerapellido," ",ese.ese_segundoapellido) as ese_nombre,
            CONCAT(inv.usu_nombre," ", inv.usu_primerapellido," ", inv.usu_segundoapellido) as inv_nombre,
            inv.usu_id as inv_id

        ')

            ->where('Encuesta.enc_id=' . $enc_id)
            ->leftjoin('Estudio', 'ese.ese_id=Encuesta.ese_id', 'ese')
            ->leftjoin('Empresa', 'emp.emp_id=ese.emp_id', 'emp')
            ->leftjoin('Usuario', 'inv.usu_id=ese.inv_id', 'inv')
            ->leftjoin('Estado', 'est.est_id=ese.est_id', 'est')
            ->leftjoin('Municipio', 'mun.mun_id=ese.mun_id', 'mun')
            ->leftjoin('Centrocosto', 'cen.cen_id=ese.cen_id', 'cen')
            ->leftjoin('Tipoestudio', 'tip.tip_id=ese.tip_id', 'tip')
            ->limit(1)
            ->execute();



        if (count($ese_data) > 0) {
            $answer['estado'] = true;
            $answer['data'] = $ese_data[0]->toArray();
        } else {
            $answer['estado'] = false;
        }

        return $answer;
    }
    public function getEstatusConBadge($estatus_id)
    {
        $answer = [];

        switch ($estatus_id) {
            case '1':
                $answer['texto'] = 'NO CONTESTÓ';
                $answer['class_helper'] = 'badge-danger';

                break;
            case '2':
                $answer['texto'] = 'POR CONTESTAR';
                $answer['class_helper'] = 'badge-warning';

                break;

            case '3':
                $answer['texto'] = 'CONTESTADA';
                $answer['class_helper'] = 'badge-success';

                break;


            default:
                $answer['texto'] = 'General';
                $answer['class_helper'] = 'badge-primary';
                break;
        }

        return $answer;
    }

    public function getIdRamdom()
    {
        $answer = [];

        $enc_data = Encuesta::query()
            ->where('enc_estatus=2 AND enc_version="' . $this->enc_version_activa . '"')
            ->orderBy('RAND()')
            ->limit(1)
            ->execute();


        if (count($enc_data) > 0) {
            $answer['estado'] = true;
            $answer['data'] = $enc_data[0]->toArray();
            $answer['enc_id'] = $enc_data[0]->enc_id;
            $answer['ese_id'] = $enc_data[0]->ese_id;
        } else {
            $answer['estado'] = false;
        }

        return $answer;
    }

    public function NoContestoCandidato($usu_id, $comentario_extra)
    {
        $answer = [];
        $fecha_y_hora = date("Y-m-d H:i:s");

        $this->enc_estatus = 1;
        $this->usu_id = $usu_id;
        $this->enc_comentario = $comentario_extra;
        $this->enc_fecharealizo = $fecha_y_hora;

        if ($this->update()) {
            $answer['estado'] = true;
            $answer['enc_id'] = $this->enc_id;
        } else {
            $answer['estado'] = false;
        }

        return $answer;
    }

    public function setContestado($usu_id)
    {

        $fecha_y_hora = date("Y-m-d H:i:s");

        $this->enc_estatus = 3;
        $this->usu_id = $usu_id;
        $this->enc_comentario = 'Si realizó la encuesta';
        $this->enc_fecharealizo = $fecha_y_hora;
        $this->enc_comentario = 'Si realizó la encuesta';


        if ($this->update()) {
            $answer['estado'] = true;
            $answer['enc_id'] = $this->enc_id;
        } else {
            $answer['estado'] = false;
        }
        return $answer;
    }

    public function getEstatus($estatus_id, $es_general = 0)
    {

        switch ($estatus_id) {
            case '1':
                return 'SIN CONTESTAR';
                break;

            case '3':
                return 'CONTESTADA';
                break;
            case '2':
                return 'PENDIENTE';
                break;
            default:
                if ($es_general == 1) {
                    return 'GENERAL';
                }

                break;
        }
    }

    public function getRespuestasDeManeraOrdenada($month, $year_get, $inv_id = 0)
    {

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2";

        if ($inv_id != 0) {
            $condicion_sql .= ' and inv.usu_id=' . $inv_id;
        }

        $di = Di::getDefault();
        $db = $di->get('db');
        $sql = '
        SELECT 
        respuesta.enc_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        tip.tip_clave,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
        CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) as inv_nombre,
        MAX(CASE WHEN respuesta.pre_id = 1 THEN respuesta.opc_id ELSE NULL END) AS preg_1,
        MAX(CASE WHEN respuesta.pre_id = 2 THEN respuesta.opc_id ELSE NULL END) AS preg_2,
        MAX(CASE WHEN respuesta.pre_id = 3 THEN respuesta.opc_id ELSE NULL END) AS preg_3,
        MAX(CASE WHEN respuesta.pre_id = 4 THEN respuesta.opc_id ELSE NULL END) AS preg_4,
        MAX(CASE WHEN respuesta.pre_id = 5 THEN respuesta.opc_id ELSE NULL END) AS preg_5,
        MAX(CASE WHEN respuesta.pre_id = 6 THEN respuesta.opc_id ELSE NULL END) AS preg_6,
        MAX(CASE WHEN respuesta.pre_id = 7 THEN respuesta.opc_id ELSE NULL END) AS preg_7,
        MAX(CASE WHEN respuesta.pre_id = 8 THEN respuesta.res_texto ELSE NULL END) AS preg_7_1,
        MAX(CASE WHEN respuesta.pre_id = 9 THEN respuesta.opc_id ELSE NULL END) AS preg_8,
        MAX(CASE WHEN respuesta.pre_id = 10 THEN respuesta.res_texto ELSE NULL END) AS preg_8_1,
        MAX(CASE WHEN respuesta.pre_id = 11 THEN respuesta.opc_id ELSE NULL END) AS preg_9,
        MAX(CASE WHEN respuesta.pre_id = 12 THEN respuesta.opc_id ELSE NULL END) AS preg_10,
        MAX(CASE WHEN respuesta.pre_id = 13 THEN respuesta.opc_id ELSE NULL END) AS preg_11,
        MAX(CASE WHEN respuesta.pre_id = 14 THEN respuesta.opc_id ELSE NULL END) AS preg_12,
        MAX(CASE WHEN respuesta.pre_id = 15 THEN respuesta.res_texto ELSE NULL END) AS preg_12_1,
        MAX(CASE WHEN respuesta.pre_id = 16 THEN respuesta.opc_id ELSE NULL END) AS preg_13,
        MAX(CASE WHEN respuesta.pre_id = 17 THEN respuesta.opc_id ELSE NULL END) AS preg_14,
        MAX(CASE WHEN respuesta.pre_id = 18 THEN respuesta.opc_id ELSE NULL END) AS preg_15,
        MAX(CASE WHEN respuesta.pre_id = 19 THEN respuesta.res_texto ELSE NULL END) AS preg_15_1,
        MAX(CASE WHEN respuesta.pre_id = 20 THEN respuesta.opc_id ELSE NULL END) AS preg_16,
        MAX(CASE WHEN respuesta.pre_id = 21 THEN respuesta.opc_id ELSE NULL END) AS preg_17,
        MAX(CASE WHEN respuesta.pre_id = 22 THEN respuesta.res_texto ELSE NULL END) AS preg_17_1,
        MAX(CASE WHEN respuesta.pre_id = 23 THEN respuesta.res_texto ELSE NULL END) AS preg_18
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        LEFT JOIN tipoestudio tip ON tip.tip_id=ese.tip_id

        ' . $condicion_sql . '

        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido,inv.usu_nombre, inv.usu_primerapellido, inv.usu_segundoapellido
        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }

    public function getRespuestaPreguntasAbiertas($month = 0, $year_get = 0, $inv_id = 0)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get and respuesta.res_estatus=2";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
        MAX(CASE WHEN respuesta.pre_id = 8 THEN respuesta.res_texto ELSE NULL END) AS preg_7_1,
        MAX(CASE WHEN respuesta.pre_id = 10 THEN respuesta.res_texto ELSE NULL END) AS preg_8_1,
        MAX(CASE WHEN respuesta.pre_id = 15 THEN respuesta.res_texto ELSE NULL END) AS preg_12_1,
        MAX(CASE WHEN respuesta.pre_id = 19 THEN respuesta.res_texto ELSE NULL END) AS preg_15_1,
        MAX(CASE WHEN respuesta.pre_id = 22 THEN respuesta.res_texto ELSE NULL END) AS preg_17_1,
        MAX(CASE WHEN respuesta.pre_id = 23 THEN respuesta.res_texto ELSE NULL END) AS preg_18
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }
    public function getRespuestaPreguntasAbiertasPregunta7_1($month = 0, $year_get = 0, $inv_id = 0)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get AND respuesta.res_estatus=2 and respuesta.pre_id=8  ";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        respuesta.pre_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
		(SELECT CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) FROM usuario inv WHERE inv.usu_id = ese.inv_id) as inv_nombre,

        MAX(CASE WHEN respuesta.pre_id = 8 THEN respuesta.res_texto ELSE NULL END) AS res_texto
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        ' . $condicion_sql . '
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ORDER BY inv_nombre;

        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }


    public function getRespuestaPreguntasAbiertasPregunta8_1($month = 0, $year_get = 0, $inv_id = 0)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get AND respuesta.res_estatus=2 and respuesta.pre_id=10  ";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        respuesta.pre_id,

        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
		(SELECT CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) FROM usuario inv WHERE inv.usu_id = ese.inv_id) as inv_nombre,
        MAX(CASE WHEN respuesta.pre_id = 10 THEN respuesta.res_texto ELSE NULL END) AS res_texto
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        ' . $condicion_sql . '
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ORDER BY inv_nombre;

        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }

    public function getRespuestaPreguntasAbiertasPregunta12_1($month = 0, $year_get = 0, $inv_id = 0)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get AND respuesta.res_estatus=2 and respuesta.pre_id=15";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        respuesta.pre_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
		(SELECT CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) FROM usuario inv WHERE inv.usu_id = ese.inv_id) as inv_nombre,
        MAX(CASE WHEN respuesta.pre_id = 15 THEN respuesta.res_texto ELSE NULL END) AS res_texto
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        ' . $condicion_sql . '
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ORDER BY inv_nombre;

        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }

    public function getRespuestaPreguntasAbiertasPregunta15_1($month = 0, $year_get = 0, $inv_id = 0)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get AND respuesta.res_estatus=2 and respuesta.pre_id=19 ";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
		(SELECT CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) FROM usuario inv WHERE inv.usu_id = ese.inv_id) as inv_nombre,
        MAX(CASE WHEN respuesta.pre_id = 19 THEN respuesta.res_texto ELSE NULL END) AS res_texto
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        ' . $condicion_sql . '
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ORDER BY inv_nombre;

        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }

    public function getRespuestaPreguntasAbiertasPregunta17_1($month = 0, $year_get = 0, $inv_id)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get AND respuesta.res_estatus=2 and respuesta.pre_id=22";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
		(SELECT CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) FROM usuario inv WHERE inv.usu_id = ese.inv_id) as inv_nombre,
        MAX(CASE WHEN respuesta.pre_id = 22 THEN respuesta.res_texto ELSE NULL END) AS res_texto
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        ' . $condicion_sql . '
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ORDER BY inv_nombre;

        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }

    public function getRespuestaPreguntasAbiertasPregunta18($month = 0, $year_get = 0, $inv_id)
    {
        $di = Di::getDefault();
        $db = $di->get('db');

        $condicion_sql = '';
        $condicion_sql .= " where MONTH(enc_fechaentregacliente) = $month AND YEAR(enc_fechaentregacliente) =$year_get AND respuesta.res_estatus=2 and respuesta.pre_id=23 ";
        if ($inv_id != 0) {
            $condicion_sql .= " AND ese.inv_id=$inv_id ";
        }
        $sql = '
        SELECT 
        respuesta.enc_id,
        enc.enc_fecharealizo,
        enc.enc_fechaentregacliente,
        ese.ese_id,
        CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
        CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
		(SELECT CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) FROM usuario inv WHERE inv.usu_id = ese.inv_id) as inv_nombre,
        MAX(CASE WHEN respuesta.pre_id = 23 THEN respuesta.res_texto ELSE NULL END) AS res_texto
        FROM respuesta
        LEFT JOIN encuesta enc ON enc.enc_id=respuesta.enc_id 
        LEFT JOIN estudio ese ON ese.ese_id=enc.ese_id
        LEFT JOIN usuario usu ON usu.usu_id=enc.usu_id
        LEFT JOIN usuario inv ON inv.usu_id=ese.inv_id
        ' . $condicion_sql . '
        GROUP BY respuesta.enc_id, ese.ese_nombre, ese.ese_primerapellido, ese.ese_segundoapellido, usu.usu_nombre, usu.usu_primerapellido, usu.usu_segundoapellido
        ORDER BY inv_nombre;

        ';

        $result = $db->query($sql);

        $data = $result->fetchAll();

        return $data;
    }
}
