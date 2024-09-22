<?php
require "intervention_image/index.php";
class EncuestacalidadController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Encuestas');
        parent::initialize();
    }

    public function indexAction()
    {
        try {
            //validamos que tenga permiso para hacer lo
            $rol = new Rol();
            $auth = $this->session->get('auth');
            if (!$rol->verificar(74, $auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }
            //jalamos un registro ramdom
            $enc = new Encuesta();
            $respuesta_modelo_ramdom_data_enc = $enc->getIdRamdom();
            //validamos si existen datos

            if (!$respuesta_modelo_ramdom_data_enc['estado']) {
                $this->flash->warning("No hay encuestas por realizar");
                $this->response->redirect('index/panel');
                $this->view->disable();
                return;
            }

            $respuesta_modelo_get_data_detalle = $enc->getDataDetalle($respuesta_modelo_ramdom_data_enc['enc_id']);
            $this->view->enc_data = $respuesta_modelo_get_data_detalle['data'];
            $this->view->auth = $auth;

            $configuracion = Configuracion::findFirstBycof_id(10);
            $link_encuesta = $configuracion->cof_valor;
            $ese_id = $respuesta_modelo_get_data_detalle["data"]["ese_id"];
            $emp_id = $respuesta_modelo_get_data_detalle["data"]["emp_id"];
            $enc_id = $respuesta_modelo_get_data_detalle["data"]["enc_id"];
            $usu_id = $auth["id"];
            // error_log($ese_id);
            $inv_id = $respuesta_modelo_get_data_detalle["data"]["inv_id"];
            $this->view->encuesta_lime_sourvey_BASE_URL = $link_encuesta . "&ese_id=$ese_id&emp_id=$emp_id&usu_id=$usu_id&inv_id=$inv_id&enc_id=$enc_id";
        } catch (\Exception $e) {
            $this->flash->error("Ocurrió un error: ");
            error_log("ERROR EN ENCUESTA CALIDAD: " . $e->getMessage());
            $this->response->redirect('index/panel');
            $this->view->disable();
        }
    }


    public function servicioAction()
    {
        //validamos que tenga permiso para hacer lo
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if (!$rol->verificar(74, $auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }

        //jalamos un registro ramdom
        $enc = new Encuesta();
        $respuesta_modelo_ramdom_data_enc = $enc->getIdRamdom();
        //validamos si existen datos
        if (!$respuesta_modelo_ramdom_data_enc['estado']) {
            $this->flash->warning("No hay encuestas por realizar");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }

        $respuesta_modelo_get_data_detalle = $enc->getDataDetalle($respuesta_modelo_ramdom_data_enc['enc_id']);
        $this->view->enc_data = $respuesta_modelo_get_data_detalle['data'];
    }

    public function ajax_get_textos_opciones_servicioAction()
    {
        $answers = [];
        $this->view->disable();
        if ($this->request->isAjax()) {
            $encuestacalidad_obj = new Encuestacalidad();
            $respesta_modelo = $encuestacalidad_obj->getOpcionesPreguntas__Servico();
            $answers['data'] = $respesta_modelo;
            $answers['estatus'] = 2;
            $answers['mensaje'] = 'ok';

            return $this->response->setJsonContent($answers);
        } else {
            return http_response_code(400);
        }
    }

    public function ajax_get_detalleAction($ese_id)
    {
        $answers = [];
        $this->view->disable();
        if ($this->request->isAjax() && $ese_id != 0) {
            //obtener detalles de la encuesta
            //obtener detalles de estudio
            $ese_obj = new Estudio();
            $ese_data = $ese_obj->GetDatosInvAnaEse($ese_id);

            $answers['mensaje'] = 'ok';
            $answers['data'] = $ese_data;

            return $this->response->setJsonContent($answers);
        } else {
            return http_response_code(400);
        }
    }

    public function  ajax_set_no_contesto_candidatoAction($enc_id = 0)
    {
        $answer = [];
        $answer['estado'] = -2;
        $answer['titular'] = 'error';
        $answer['mensaje'] = 'error';
        $this->view->disable();
        if ($this->request->isAjax() && $enc_id != 0) {

            $enc = Encuesta::findFirstByenc_id($enc_id);
            $data = $this->request->getPost();

            if ($enc) {

                if ($enc->enc_estatus == 2) {
                    $auth = $this->session->get('auth');

                    $soporte = new Soporte();
                    $respusta_modelo_verifica_sustuir_o_no = $soporte->GenerarEncuesta($enc_id);
                    $comentario_completo = $data['comentario'] . '. ' . $respusta_modelo_verifica_sustuir_o_no;
                    $respuesta_modelo_cancelar_no_contesto = $enc->NoContestoCandidato($auth['id'], $comentario_completo);


                    if ($respuesta_modelo_cancelar_no_contesto['estado']) {
                        $bitacora = new Bitacora();
                        $databit['bit_descripcion'] = 'No contesto una encuesta el candidato relacionado al ESE con ID interno ' . $enc->ese_id;
                        $databit['usu_id'] = $auth['id'];
                        $databit['bit_tablaid'] = $enc->enc_id;
                        $databit['ese_id'] = $enc->ese_id;
                        $databit['bit_modulo'] = "Encuesta";
                        $bitacora->NuevoRegistro($databit);

                        $answer['estado'] = 2;
                        $answer['titular'] = 'Éxito';
                        $answer['mensaje'] = 'Se realizó la acción correctamente';
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    } else {
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                } else {
                    $answers['estado'] = -2;
                    $answers['titular'] = 'Cambio de estatus';
                    $answers['mensaje'] = 'La encuesta ya ah sido contestada';
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } else {
            return http_response_code(400);
        }
    }
    public function reporteAction()
    {
    }

    public function encuestas_tablaAction()
    {
        if ($this->request->isPost()) {
            $condicion_sql = '';
            $mensaje_extra_bitcora = '';
            $data = $this->request->getPost();
            $inv_id = 0;
            if ($data['inv_id'] != '-1') { //validamos que exista un investigador
                $inv_id = $data['inv_id'];
                $usu_inv = new Usuario();
                $usu_inv_nombre = $usu_inv->getNombre($inv_id);
                $mensaje_extra_bitcora .= ' , consulto a detalle datos del investigador con ID interno ' . $inv_id . ' llamado ' . $usu_inv_nombre;
                $condicion_sql .= 'inv.usu_id =' . $inv_id . ' and';
            }

            // Parse the input value into a date object
            $date = new DateTime($data['enc_fecha']);
            // Extract the month and day from the date object
            $fecha_consulta = $data['enc_fecha'];
            //fechas
            $month = $date->format('m');
            $year = $date->format('y');
            $year_get = substr($fecha_consulta, 0, 4);
            $enc_estatus = $data['enc_estatus'];
            if ($enc_estatus >= 1) {
                $condicion_sql .= ' Encuesta.enc_estatus=' . $enc_estatus;
                $enc_columnas_extra = 1;
            } else {
                $condicion_sql .= ' Encuesta.enc_estatus>0';
                $enc_columnas_extra = 1;
            }
            $condicion_sql .= " and MONTH(Encuesta.enc_fechaentregacliente) = $month AND YEAR(Encuesta.enc_fechaentregacliente) =$year_get";

            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            $enc = Encuesta::query()
                ->columns('
                Encuesta.enc_estatus,
                Encuesta.enc_id,
                Encuesta.enc_registro,
                Encuesta.enc_fecharealizo,
                Encuesta.enc_fechaentregacliente,
                Encuesta.enc_comentario,
                Encuesta.ese_id,
                CONCAT(ese.ese_nombre, " ", ese.ese_primerapellido, " ", ese.ese_segundoapellido) as ese_nombre,
                CONCAT(usu.usu_nombre, " ", usu.usu_primerapellido, " ", usu.usu_segundoapellido) as usu_nombre,
                ese.inv_id, 
                CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) as inv_nombre
                ')
                ->where($condicion_sql)
                // ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
                ->leftjoin('Estudio', 'ese.ese_id=Encuesta.ese_id', 'ese')
                ->leftjoin('Usuario', 'usu.usu_id=Encuesta.usu_id', 'usu')
                ->leftjoin('Usuario', 'inv.usu_id=ese.inv_id', 'inv')

                ->execute();

            $obj_enc = new Encuesta();
            $auth = $this->session->get('auth');
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = 'Consultó datos de encuestas de calidad  de la fecha ' . $fecha_consulta . ' con estatus: ' . $obj_enc->getEstatus($enc_estatus, 1) . $mensaje_extra_bitcora;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "Encuesta calidad";
            $bitacora->NuevoRegistro($databit);

            $this->view->page = $enc;
            $this->view->enc_fecha = $fecha_consulta;
            $this->view->enc_estatus = $enc_estatus;
            $this->view->enc_columnas_extra = $enc_columnas_extra;
            $this->view->enc_helper_estatus = $obj_enc->getEstatusConBadge($enc_estatus);
            $this->view->enc_contador_total = count($enc);
            $this->view->obj_enc = $obj_enc;
        }
    }



    public function respuestas_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if ($this->request->isPost()) {

            $mensaje_extra_bitcora = '';
            $obj_enc = new Encuesta();
            $data = $this->request->getPost();

            $inv_id = 0;
            if ($data['inv_id'] != '-1') {
                $usu_inv = new Usuario();
                $usu_inv_nombre = $usu_inv->getNombre($inv_id);
                $mensaje_extra_bitcora .= ' , consulto a detalle datos del investigador con ID interno ' . $inv_id . ' llamado ' . $usu_inv_nombre;
                $inv_id = $data['inv_id'];
            }

            $fecha_consulta = $data['enc_fecha'];
            // Parse the input value into a date object
            $date = new DateTime($data['enc_fecha']);
            // Extract the month and day from the date object
            $fecha_consulta = $data['enc_fecha'];
            $condicion_sql = '';
            //fechas
            $month = $date->format('m');
            $year = $date->format('y');
            $year_get = substr($fecha_consulta, 0, 4);
            $enc_estatus = $data['enc_estatus'];

            $data_enc = $obj_enc->getRespuestasDeManeraOrdenada($month, $year_get, $inv_id);
            $auth = $this->session->get('auth');
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = 'Consultó datos de respuesta de encuesta calidad  de la fecha' . $fecha_consulta . $mensaje_extra_bitcora;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = 0;
            $databit['bit_modulo'] = "Respuesta encuesta calidad";
            $bitacora->NuevoRegistro($databit);

            $this->view->page = $data_enc;
            $this->view->obj_enc_calidad = new Encuestacalidad();
            $this->view->obj_ese = new Estudio();
            $this->view->obj_preg = new Pregunta();
            $this->view->enc_helper_estatus = $obj_enc->getEstatusConBadge($enc_estatus);
            $this->view->enc_contador_total = count($data_enc);
        }
    }

    public function ajax_get_data_respuestas_porcentaje_estadisiticasAction($inv_id = 0)
    {
        $this->view->disable();
        $answer = [];
        if ($this->request->isAjax()) {

            $data = $this->request->getPost();

            if ($inv_id == '-1' || $inv_id == 0) {
                $inv_id = 0;
            }


            // Parse the input value into a date object
            $date = new DateTime($data['enc_fecha']);
            // Extract the month and day from the date object
            $fecha_consulta = $data['enc_fecha'];
            $condicion_sql = '';
            //fechas
            $month = $date->format('m');
            $year = $date->format('y');
            $year_get = substr($fecha_consulta, 0, 4);

            $obj_enc = new Encuestacalidad();
            $obj_enc_normal = new Encuesta();

            $obj_pre = new Pregunta();

            $answer['contador-respuestas'] = count($obj_enc_normal->getRespuestasDeManeraOrdenada($month, $year_get));

            if ($answer['contador-respuestas'] != 0) { //evita error de que consulte datos vacios
                $answer['todas-preguntas-estadisticas'] = $obj_enc->getEstadisticasTodasLasRespuestas($month, $year_get, $inv_id);
                $answer['todas-preguntas-texto'] = $obj_pre->getPreguntasCalidadSerivio();
                $answer['detalles-encuesta'] = $obj_enc->getDestallesDelMesEncuestas($month, $year_get);

                $answer['detalles-textos-opciones'] = $obj_enc->getOpcionesPreguntas__Servico();
            }
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } else {
            return http_response_code(400);
        }
    }


    public function verificiar_encuesta_contestadaAction($ese_id, $enc_id)
    {
        $this->view->disable();
        try {

            if (!$this->request->isAjax())
                throw new Exception("ERROR FORMATO SOLICITUD");
            $auth = $this->session->get('auth');
            $condicion_sql = "Encuesta.enc_id=$enc_id AND  Encuesta.ese_id=$ese_id";

            $encuesta = Encuesta::query()
                ->columns('
                Encuesta.enc_estatus,
                Encuesta.enc_id,
                Encuesta.ese_id
                ')
                ->where($condicion_sql)
                ->execute();

            if (!$encuesta[0])
                throw new Exception("NO EXISTE EL REGISTRO");

            if ($encuesta[0]->enc_estatus == 2) {
                $answer = [
                    'ese_id' => $ese_id,
                    'enc_id' => $enc_id,
                    'mensaje' => "ESTÁ DISPONIBLE ESTA ENCUESTA",
                    'titular' => 'OK',
                    'estatus' => 2,
                ];
            } else {
                $answer = [
                    'ese_id' => $ese_id,
                    'enc_id' => $enc_id,
                    'mensaje' => "NO ESTÁ DISPONIBLE ESTA ENCUESTA",
                    'titular' => 'AVISO',
                    'estatus' => -1,
                ];
            }
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (\Exception $e) {
            error_log("Excepción: verificiar_encuesta_contestadaAction subir el archivo " . $e->getMessage());
            $answer = [
                'ese_id' => $ese_id,
                'enc_id' => $enc_id,
                'mensaje' => $e->getMessage(),
                'titular' => 'AVISO',
                'estatus' => -2,
            ];
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

    public function cambiar_estatus_contestada_encuestaAction($ese_id, $enc_id)
    {
        $this->view->disable();
        try {

            if (!$this->request->isAjax())
                throw new Exception("ERROR FORMATO SOLICITUD");

            $auth = $this->session->get('auth');
            $enc_obj=new Encuesta();
            $condicion_sql = "Encuesta.enc_id=$enc_id AND  Encuesta.ese_id=$ese_id AND Encuesta.enc_version='".$enc_obj->enc_version_activa."' ";
            $encuesta = Encuesta::query()
                ->columns('
                Encuesta.enc_estatus,
                Encuesta.enc_id,
                Encuesta.ese_id
                ')
                ->where($condicion_sql)
                ->execute();

            if (!$encuesta[0])
                throw new Exception("NO EXISTE EL REGISTRO");

            if ($encuesta[0]->enc_estatus != 2) {
                $answer = [
                    'ese_id' => $ese_id,
                    'enc_id' => $enc_id,
                    'mensaje' => "NO ESTÁ DISPONIBLE ESTA ENCUESTA",
                    'titular' => 'AVISO',
                    'estatus' => -1,
                ];
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            } else {
                $enc = Encuesta::findFirstByenc_id($enc_id);

                if (!$enc)
                    throw new Exception("ERROR AL ENCONTRAR REGISTRO -ENC");

                $respuesta_modelo_enc = $enc->setContestado($auth['id']);

                if ($respuesta_modelo_enc["estado"] == false)
                    throw new Exception("ERROR AL ACTUALIZAR REGISTRO -ENC");

                $answer = [
                    'ese_id' => $ese_id,
                    'enc_id' => $enc_id,
                    'mensaje' => "OK",
                    'titular' => 'OK',
                    'estatus' => 2,
                ];

                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
            }
        } catch (\Exception $e) {
            error_log("Excepción: cambiar_estatus_contestada_encuestaAction  " . $e->getMessage());
            $answer = [
                'ese_id' => $ese_id,
                'enc_id' => $enc_id,
                'mensaje' => $e->getMessage(),
                'titular' => 'AVISO',
                'estatus' => -2,
            ];
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

}
