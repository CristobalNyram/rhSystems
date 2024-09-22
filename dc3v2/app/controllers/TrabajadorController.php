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

    public function buseditarAction($clave=0,$idparticipante)
    {
        $answer=array();
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $trabajador=Trabajador::findFirstBytra_id($clave);
            if($trabajador)
            {
                // $relactividad=Relactividadusuario::find(array("act_id=:clave: and rel_estatus=2",
                //     "bind"=>array('clave'=>$clave)
                // ));
                $participante=Participante::findFirstBypar_id($idparticipante);

                $answer[0]=1;
                $answer[1]=$trabajador->tra_nombre;
                $answer[2]=$trabajador->tra_primerapellido;
                $answer[3]=$trabajador->tra_segundoapellido;
                $answer[4]=$trabajador->tra_curp;
                $answer[5]=$participante->tra_puesto;
                $answer[6]=$trabajador->tra_id;
                $answer[7]=$participante->ocu_id;
                // $answer[5]=intval($trabajador->act_horasestimadas);
                // $answer[6]=($trabajador->act_horasestimadas-$answer[5])*60;
                // $relact=array();
                // for ($i=0; $i < count($relactividad); $i++) 
                // { 
                //     $relact[$i]=$relactividad[$i]->usu_id;
                // }
                // $answer[7]=$relact;
            }
            else
            {
                $answer[0]=-1;    
            }
            
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        
    }

    public function editarAction($clave=0,$idparticipante)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $data = $this->request->getPost();
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
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Editó datos del trabajador ".$data["tra_curp"];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$clave;
                    $bitacora->NuevoRegistro($databit);

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

    public function crearAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            // $trabajador=Trabajador::findFirstBytra_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            // if($trabajador)
            // {
            $existe=Trabajador::findFirstBytra_curp($data["tra_curpc"]);
            if($existe){
                $existeparticipante=Participante::query()
                    ->columns("par_id")
                    ->where('cuo_id='.$data['cuo_idcrear'].' and tra_id='.$existe->tra_id)
                    ->execute();

                if(count($existeparticipante)!=0){
                    $answer[0]=1;
                }
                else
                {
                    $participante= new Participante();
                    $participante->cuo_id= $data['cuo_idcrear'];
                    $participante->tra_puesto= $data['tra_puestoc'];
                    $participante->ocu_id= $data['ocu_idcreate'];
                    $participante->tra_id= $existe->tra_id;
                    $participante->par_estatus=2;

                    if($participante->save())
                    {
                        $auth = $this->session->get('auth');
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= "Se agregó un participante al curso con id".$data['cuo_idcrear'];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$participante->par_id;
                        $bitacora->NuevoRegistro($databit);
                        $answer[0]=1;
                    }
                    else
                        $answer[0]=0;
                    
                }
                // $participante= new Participante();
                // $participante->cuo_id=$data["cuo_idcrear"];
                // $participante->tra_id=$trabajador->tra_id;
                // if($participante->save())
                // {
                //     $answer[0]=1;
                // }
                // else
                //     $answer[0]=0;
            }else{
                $trabajador= new Trabajador();

                $trabajador->tra_nombre=trim($data["tra_nombrec"]);
                $trabajador->tra_primerapellido=trim($data["tra_primerapellidoc"]);
                $trabajador->tra_segundoapellido=trim($data["tra_segundoapellidoc"]);
                $trabajador->tra_curp=$data["tra_curpc"];
                // $trabajador->tra_puesto=$data["tra_puestoc"];
                // $trabajador->ocu_id=$data["ocu_idcreate"];

                if($trabajador->save())
                {
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Se creó un trabajador".$data["tra_curpc"];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$trabajador->tra_id;
                    $bitacora->NuevoRegistro($databit);

                    $trabajador=Trabajador::findFirstBytra_curp($data["tra_curpc"]);
                    $existeparticipante=Participante::query()
                    ->columns("par_id")
                    ->where('cuo_id='.$data['cuo_idcrear'].' and tra_id='.$trabajador->tra_id)
                    ->execute();

                    if(count($existeparticipante)!=0){
                        $answer[0]=1;
                    }
                    else
                    {
                        $participante= new Participante();
                        $participante->cuo_id= $data['cuo_idcrear'];
                        $participante->tra_puesto= $data['tra_puestoc'];
                        $participante->ocu_id= $data['ocu_idcreate'];
                        $participante->tra_id= $trabajador->tra_id;
                        $participante->par_estatus=2;

                        if($participante->save())
                        {
                            $auth = $this->session->get('auth');
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= "Se agregó un participante al curso con id".$data['cuo_idcrear'];
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$participante->par_id;
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=1;
                        }
                        else
                            $answer[0]=0;
                        
                    }
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
                }
                else
                {
                    $answer[0]=0;
                    // $this->db->rollback();
                }
            }

            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

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
        
        if ($participante->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó un participante con id de participante ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

}