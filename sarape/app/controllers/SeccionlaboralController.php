<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class SeccionlaboralController extends ControllerBase
{

    public function ajax_get_set_detalleAction($exc_id = 0)
    {
        $this->view->disable();
        $answer = [];
        $answer[0] = -2;
        $answer['titular'] = 'ERROR';
        $answer['mensaje'] = 'Error al generar los datos.';
        $auth = $this->session->get('auth');

        if ($exc_id != 0 && is_numeric($exc_id) && $this->request->isAjax()) {
            try {
                $this->db->begin(); // Iniciar la transacción

                $condicion_sql='sel.exc_id = '.$exc_id.'';
                $builder = new Builder();
                $builder->columns(array('
                              sel.sel_id,
                              sel.usu_idauxiliar,
                              sel.sel_estatus,
                              sel.sel_calificacion,
                              sel.sel_notas,
                              sel.sel_empleosocultos,
                              sel.sel_necesitoauxiliar,
                              can.can_nombre,
                              can.can_primerapellido,
                              can.can_segundoapellido,
                              CONCAT(can.can_nombre," ", can.can_primerapellido," ",can.can_segundoapellido) as can_nombre_completo,
                              can.can_correo,
                              can.can_telefono,
                              can.can_celular,
                              vac.vac_id,
                              exc.exc_id,
                              exc.exc_estatus,
                              exc.exc_comentario,
                              exc.exc_comentario,
                              can.can_id,
                              cav.cav_nombre,
                              emp.emp_nombre,
                              vac.vac_estatus

                        '))
                        ->addFrom('Seccionlaboral',"sel")
                        ->leftjoin('Expedientecan','exc.exc_id=sel.exc_id','exc')
                        ->leftjoin('Candidato','can.can_id=exc.can_id','can')
                        ->leftjoin('Vacante','vac.vac_id=exc.vac_id','vac')
                        ->leftjoin('Empresa','emp.emp_id=vac.emp_id','emp')
                        ->leftjoin('Estado','est.est_id=vac.est_id','est')
                        ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                        ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                        ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav')
                        ->where($condicion_sql)
                        ->limit(1);

                $subs = $builder->getQuery()->execute();

                if ($subs->count() == 0) {
                    $seccion_laboral_obj=new Seccionlaboral();
                    $seccion_laboral_obj->sel_estatus=2;
                    $seccion_laboral_obj->exc_id=$exc_id;


                   if($seccion_laboral_obj->save()){
                    $data_bit = [
                        'bit_descripcion' => "Se registró una sección laboral relacionada con el expediente candidato ".$seccion_laboral_obj->exc_id,
                        'bit_tablaid' => $seccion_laboral_obj->sel_id,
                        'bit_modulo' => "Seccion laboral",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($data_bit, $auth);
                    $answer[0] = 2;
                    $answer["titular"] = "OK";
                    $answer["mensaje"] = "NUEVO";
                    $answer['data'] = $seccion_laboral_obj;
                    $answer['exc_id'] = $exc_id;
                    $answer['sel_id'] = $seccion_laboral_obj->sel_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    $this->db->commit(); // Confirmar la transacción
                    return;

                   }else
                      throw new \Exception('Error al guardar los datos de sel.');
                   

                   

                } else {
                    $data_bit = [
                        'bit_descripcion' => "Se consultó una sección laboral relacionada con el expediente candidato ".$subs[0]->exc_id,
                        'bit_tablaid' => $subs[0]->sel_id,
                        'bit_modulo' => "Seccion laboral",
                        'vac_id' => 0,
                        'bit_accion' => 1,
                    ];
                    $this->bitacora_registro($data_bit, $auth);
                    $answer[0] = 2;
                    $answer['sel_id'] = $subs[0]->sel_id;
                    $answer['data'] = $subs[0];
                    $answer['titular'] = "OK";
                    $answer['mensaje'] = "EXISTENTE";
                    $this->response->setJsonContent($answer);
                    $this->response->send();

                }
            } catch (\Exception $e) {
                $this->db->rollback(); // Deshacer la transacción en caso de error
                $data_bit = [
                    'bit_descripcion' => "ERROR en sección laboral consultar-crear : ".$e->getMessage(),
                    'bit_tablaid' => 0,
                    'bit_modulo' => "ERROR",
                    'vac_id' => 0,
                    'bit_accion' => 1,
                ];
                $answer["detalle"]=$e->getMessage();
                error_log($answer["detalle"]);
                $this->bitacora_registro($data_bit, $auth);
                $this->response->setJsonContent($answer);
                $this->response->send();
            }
        }else{
            return http_response_code(400);
        }
    }


    
   
    public function ajax_get_detalleAction($exc_id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer['mensaje']='ERROR';
        $this->view->disable();
        
        try {
            if ($this->request->isAjax() && $exc_id > 0) {
                $registro = Seccionlaboral::query()
                    ->columns('
                         Seccionlaboral.*
                        
                    ')
                    ->where('Seccionlaboral.exc_id=' . $exc_id)
                    ->execute();
                if (count($registro)>0) {
                    $answer[0] = 1;
                    $answer['data'] = $registro[0];
                    $answer['mensaje']='OK';

                } else {
                    $answer[0] = -1;
                }
            } else {
                $answer[0] = -1;
            }
        } catch (\Exception $e) {
            $answer[0] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    public function ajax_set_updateAction($sel_id = 0)
    {
    $this->view->disable();
    $answer = array();
    $answer[0] = -2;
    $answer['titular'] = 'Error';
    $answer['mensaje'] = 'Ocurrió un error al procesar los datos.';

            if ($sel_id != 0 && is_numeric($sel_id) && $this->request->isAjax()) {
                $data = $this->request->getPost();

                $sel_registro = Seccionlaboral::findFirst([
                    "sel_id = :sel_id: AND sel_estatus = 2",
                    'bind' => ['sel_id' => $sel_id],
                ]);

                if ($sel_registro) {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion = 0;

                    try {
                        $this->db->begin(); // Iniciar la transacción

                        $permisoCalificacion=$rol->verificar(36,$auth['rol_id']);
                        $permiso_empleos_ocultos=$rol->verificar(34,$auth['rol_id']);
                        $permiso_notas=$rol->verificar(50,$auth['rol_id']);
                        $permiso_solicitar_aux=$rol->verificar(88,$auth['rol_id']);

                        $respuesta_modelo = $sel_registro->ActualizarRegistro($data,$permiso_notas,$permiso_empleos_ocultos, $permisoCalificacion,$permiso_solicitar_aux);

                        if ($respuesta_modelo['estado'] == 2) {
                            $data_bit = [
                                'bit_descripcion' => "Se registró una sección laboral relacionada con el expediente candidato " . $respuesta_modelo["exc_id"],
                                'bit_tablaid' => $respuesta_modelo["sel_id"],
                                'bit_modulo' => "Sección laboral",
                                'vac_id' => 0,
                                'bit_accion' => 2,
                            ];
                            $this->bitacora_registro($data_bit, $auth);

                            $answer["estado"] = 2;
                            $answer['titular'] = 'Éxito';
                            $answer['mensaje'] = 'Se guardaron los datos correctamente.';
                            $answer['exc_id'] = $respuesta_modelo['exc_id'];
                            $answer['sel_id'] = $respuesta_modelo['sel_id'];

                            $this->db->commit(); // Confirmar la transacción
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        } else {
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
                    } catch (\Exception $e) {
                        $auth["id"]=0;
                        $this->db->rollback(); // Revertir la transacción en caso de excepción
                        $data_bit = [
                            'bit_descripcion' => "ERROR en sección laboral actualizar:".$e->getMessage(),
                            'bit_tablaid' => $respuesta_modelo["sel_id"],
                            'bit_modulo' => "ERROR",
                            'vac_id' => 0,
                            'bit_accion' => 2,
                        ];
                        $this->bitacora_registro($data_bit, $auth);
                        $this->response->setJsonContent($answer);
                        $this->response->send();
                        return;
                    }
                }
            }
    }

    public function ajax_set_update_formato_truperAction($sel_id){
        $this->view->disable();
        $answer=array();
        if($sel_id!=0 && is_numeric($sel_id) && $this->request->isAjax())
        {
            $data = $this->request->getPost();
            $sel_registro= Seccionlaboral::findFirst(array(
                                "sel_id = '$sel_id'",
                                'sel_estatus=2',
                              ));

             $trl_registro =Trayectorialaboralregistrado::findFirstBysel_id($sel_id);
                if($trl_registro)
                {
                    $auth = $this->session->get('auth');
                    $respuesta_modelo= $trl_registro->ActualizarRegistroFormatoTruper($data);
                            if( $respuesta_modelo['estado']==2)
                            {
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de sección de referencias laborales del registro con clave interna:'.$respuesta_modelo['sel_id'].' del estudio No. '. $sel_registro->ese_id;
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['sel_id'];
                                $databit['bit_modulo']="Sección laboral";
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$sel_registro->ese_id;
                                $answer['sel_id']=$respuesta_modelo['sel_id'];
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
                            }
                            else
                            {    
                                $answer[0]=-2;
                                $answer['titular']='Error';
                                $answer['mensaje']='No se procesaron los datos correctamente.';
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
                            }

                }
            
        }

    }
}