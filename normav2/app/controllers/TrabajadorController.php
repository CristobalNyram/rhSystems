<?php

use Phalcon\Crypt;

class TrabajadorController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Trabajador');
        parent::initialize();
        // $this->view->gmenu=0;
        // $pue = new Puesto();
        // $auth = $this->session->get('auth');
        // if(!$pue->verificar(37,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
    }

    public function buseditarAction($id)
    {
        $answer = array();
        $this->view->disable();

        if ($this->request->isAjax()) {
            $auth = $this->session->get('auth');

            $data = $this->request->getPost();


            if ($folio = Folio::findFirstByfol_id($id)) {

                if (trim($data['matricula']) != "") {
                    $folio->fol_matricula = $data['matricula'];
                }else {
                    $folio->fol_matricula = null;
                }

                $folio->fol_nombre = $data['nombre'];
                $folio->fol_primerapellido = $data['primerapellido'];
                $folio->fol_segundoapellido = $data['segundoapellido'];
                $folio->fol_correo = $data['correo'];
                $folio->fol_area = $data['area'];
                $folio->fol_puesto = $data['puesto'];
                $folio->fol_partactualizo = $data['fol_partactualizo'];
                if ($data['empresaId'] >= 1) {
                    $folio->emp_id = $data['empresaId'];
                }

                if ($folio->save()) {
                    return json_encode(1);
                } else {
                    return json_encode(-1);
                }
            } else {
                return json_encode(-1);
            }
        } else {
            return json_encode(-1);
        }
    }


    /*
    public function editarAction($clave=0,$idparticipante)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
         
            $trabajador=Trabajador::findFirstBytra_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            if($trabajador)
            {
                // echo $trabajador->tra_nombre;
                $participante=Participante::findFirstBypar_id($idparticipante);

                $trabajador->tra_nombre=$data["tra_nombre"];
                $trabajador->tra_primerapellido=$data["tra_primerapellido"];
                $trabajador->tra_segundoapellido=$data["tra_segundoapellido"];
                $trabajador->tra_curp=$data["tra_curp"];
                $participante->tra_puesto=$data["tra_puesto"];
                $participante->ocu_id=$data["ocu_id"];
               
                if($trabajador->save())
                {
                    $participante->save();
                    $answer[0]=1;
                }
                else
                {
                    $answer[0]=0;
                    // $this->db->rollback();
                }

            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }



*/




    public function crearAction()
    {
        $answer = array();
        $answer[0] = 1;
        $this->view->disable();
        if ($this->request->isAjax()) {
            $auth = $this->session->get('auth');
            $data = $this->request->getPost();
            $folio = new Folio();

            $matriculaExistente = Folio::findFirstByfol_matricula($data['fol_matricula']);
            if ($matriculaExistente && trim($data['fol_matricula']) != "") {
                // $answer[0]=0;
                echo 1;
            } else {

                /*
                             $folio->fol_matricula=$data['fol_matricula'];
                             $folio->fol_nombre=$data['fol_nombre'];
                             $folio->fol_primerapellido=$data['fol_primerapellido'];
                             $folio->fol_segundoapellido=$data['fol_segundoapellido'];
                             $folio->fol_correo =$data['fol_correo'];
                             $folio->fol_estatus=2;
                             $folio->usu_id=5;
                             $folio->fol_areaempr=$data['fol_areaempr'];
                             $folio->fol_puestoempr=$data['fol_puestoempr'];
                             $folio->empr_id=$data['empr_id'];

                            */
                $res = $folio->NuevoRegistro($data, $auth['id']);

                if ($res > 0) {

                    echo 3;
                } else {
                    // $answer[0]=0;
                    echo 2;
                }
            }


            // $trabajador=Trabajador::findFirstBytra_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            // if($trabajador)
            // {

            // $trabajador=Trabajador::findFirstBytra_curp($data["tra_curp"]);
            // $participante= new Participante();
            // $participante->cuo_id=$data["cuo_idcrear"];
            // $participante->tra_id=$trabajador->tra_id;
            // if($participante->save())
            // {
            //     $answer[0]=1;
            // }
            // else
            //     $answer[0]=0;
            // }
        } else {

            echo 2;
        }
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    // public function indexAction()
    // {

    // }

    /**
     * [tablaAction Muestra los registros de la tabla curso]
     * @param        []
     * @return []    []
     */
    // public function tablaAction()
    // {
    //     $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    //     $area = Areatematica::find(array(
    //         "are_estatus<=2 and are_estatus>=0"
    //         ));

    //     $this->view->page=$area;
    // }

    // public function formularioAction($clave="")
    // {
    //     // $pue = new Puesto();
    //     $auth = $this->session->get('auth');
    //     // $vtodos=1;
    //     // $susu=-1;

    //     // if(!$pue->verificar(72,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
    //     // {
    //     //     $vtodos=0;
    //     //     $susu=$auth["id"];
    //     // }
    //     $form = new AreatematicaForm;
    //     if($clave=="")
    //     {

    //         $form->NuevosCampos();
    //     }
    //     else
    //         $form->EditarCampos();

    //     if($this->request->isPost())
    //     {
    //         $data = $this->request->getPost();  
    //         // $data["via_fechaini"]=$this->convertir_fecha($data["via_fechaini"]);
    //         // $data["via_fechafin"]=$this->convertir_fecha($data["via_fechafin"]); 
    //         $area= new Areatematica();
    //         $id=$auth['id'];
    //         if($clave=="")
    //             $res=$area->NuevoRegistro($data,$id);
    //         else
    //             $res=$area->EditarRegistro($data,$id);

    //         if($res>0)
    //         { 
    //             if($clave=="")
    //                 $clave=$res;
    //             //$this->flash->success("Registro creado exitosamente");
    //             $this->response->redirect('areatematica/index/');
    //             //$this->response->redirect('viaticos/asistentes/');
    //             $this->view->disable();
    //             return;
    //         }
    //         else
    //         {
    //             $this->flash->error($area->error);
    //         }
    //     }
    //    $clases=array(

    //     array("are_clave","col-sm-6 col-xs-6","control-label"),
    //     array("are_denominacion","col-sm-6 col-xs-6","control-label"),
    //     array("are_estatus","col-sm-3 col-xs-12","control-label"),
    //     array("enviar","col-sm-6 col-xs-12","control-label"));
    //     if($clave!="")
    //     {
    //         $area=Areatematica::findFirstByare_id($clave);
    //         if(!$area)
    //         {
    //             $this->flash->error("Ruta no encontrado");
    //             return $this->forward("areatematica/index");
    //         }
    //         $clases=array(
    //             array("are_id","col-sm-6 col-xs-12","control-label"),
    //             array("are_clave","col-sm-6 col-xs-12","control-label"),
    //             array("are_denominacion","col-sm-6 col-xs-12","control-label"),
    //             array("are_estatus","col-sm-6 col-xs-12","control-label"),
    //             array("enviar","col-sm-6 col-xs-12","control-label"));
    //         $this->tag->setDefault('are_id',$area->are_id);
    //         $this->tag->setDefault('are_clave',$area->are_clave);
    //         $this->tag->setDefault('are_denominacion',$area->are_denominacion);
    //         $this->tag->setDefault('are_estatus',$area->are_estatus);

    //     }
    //     else
    //         $this->view->vvia_producto="";
    //     $this->view->form = $form;
    //     $this->view->clave=$clave;
    //     $this->view->clases=$clases; 

    // }


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id)
    {
        // $are = new Areatematica();
        $auth = $this->session->get('auth');
        // if(!$are->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }

        $this->view->disable();
        $folio = new Folio();
        $folioExiste = Folio::findFirstByfol_id($id);
        if ($folioExiste) {
            $folioExiste->fol_estatus = -1;
            if ($folioExiste->save()) {
                return json_encode('1');
            } else {
                return json_encode('-1');
            }
        } else {
            return json_encode('-1');
        }

        /*
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $participante = Participante::findFirstBypar_id($id);
        if (!$participante) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        $participante->par_estatus = -1;
        
        if ($participante->delete() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
        */
    }

    public function ajax_set_llenar_por_si_mismo_infoAction($fol_id = 0)
    {
        $this->view->disable();
        $auth = $this->session->get('auth');
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al actualizar los datos.',
            'titular' => 'Error',
        ];

        $this->db->begin();

        try {
            if ($this->request->isAjax()) {
                // $vacante_id = $this->request->getPost('vacante_id');

                $folio_obj = Folio::findFirstByfol_id($fol_id);
                if ($folio_obj) {
                    $configuracion = new Configuracion();
                    $data = $this->request->getPost();
                    $campos_a_solicitar_fol = $configuracion->getCamposAGuardarParticipante();
                    $respuesta_modelo_fol = $folio_obj->ActualizarGeneralByCliente($data, [], $campos_a_solicitar_fol);

                    if ($respuesta_modelo_fol["estado"] == 2) {

                        $this->db->commit();
                        $answer['estado'] = 2;
                        $answer['mensaje'] = 'Se actualizaron los datos';
                        $answer['titular'] = 'Éxito';
                    } else
                        throw new \Exception("ERROR AL ACTUALIZAR LOS DATOS ESTATUS -2");
                } else {
                    $answer['estado'] = -1;
                    $answer['mensaje'] = 'La registro no fue encontrado';
                    $answer['titular'] = 'Error';
                }
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        } catch (Exception $e) {
            $answer['detalle'] = $e;
            $answer['detalle'] = $e->getMessage();
            error_log("ERROR EN ENVIAR DATOS FOLIO " . $e->getMessage());
            $this->db->rollback();
            $this->response->setJsonContent($answer);
            $this->response->send();
            return;
        }
    }

    public function get_ajax_detalleAction($id)
    {
        $this->view->disable();
        $answer = array();
        $answer = [
            'estado' => -2,
            'mensaje' => 'Se produjo un error al encontrar los datos.',
            'titular' => 'Error',
            'data' => [],
        ];


        $folioExiste = Folio::findFirstByfol_id($id);
        if ($folioExiste) {
            $answer['estado'] = 2;
            $answer['data'] = $folioExiste;
            $answer['mensaje'] = 'OK';
            $answer['titular'] = 'OK';
        }
        $this->response->setJsonContent($answer);
        $this->response->send();
        return;
    }
}
