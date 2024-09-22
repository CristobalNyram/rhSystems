<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

use \Phalcon\Config\Adapter\Ini as ConfigIni;

require "mpdf/index.php";

class EstudioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Estudio');
        parent::initialize();
    }

    public function asignarinvestigador_indexAction()
    {
        

        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(7,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }
 


    public function asignarinvestigador_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion='ese_estatus=1 and ';
        $condicion.=$this->getEstudios("Estudio.");

            $ESE=Estudio::query()
            ->columns('ese_id, Estudio.mun_id, ese_registro, ese_estatus, ese_nombre, ese_primerapellido, ese_segundoapellido, emp.emp_alias as empresa_nombre, Estudio.tip_id, mun_nombre, est_nombre, tip_clave, tip.tip_id, ese_folioverificacion, Estudio.tif_id, cen_nombre')
            ->where($condicion)
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $fecha = date("d/m/Y");
        $this->view->fechahoy=$fecha;

        $fechahoy = date("Y-m-d");
        $estudios=Estudio::query()
            ->columns('ese_id, ese_registro, ese_estatus, tip_id')
            ->where("ese_registro>='".$fechahoy."'")
            ->execute();

        $socioeconomico=0;
        $verificacion=0;
        $supervivencia=0;
        $asignados=0;

        for ($i=0; $i < count($estudios) ; $i++) { 
            if($estudios[$i]->tip_id==1 || $estudios[$i]->tip_id==3 || $estudios[$i]->tip_id==5){
                $socioeconomico++;
            }
            if($estudios[$i]->tip_id==2){
                $verificacion++;
            }
            if($estudios[$i]->tip_id==4){
                $supervivencia++;
            }
            if($estudios[$i]->ese_estatus!=1){
                $asignados++;
            }
        }

      

        $this->view->estudios= count($estudios);
  
        $this->view->socioeconomico=$socioeconomico;
        $this->view->verificacion=$verificacion;
        $this->view->asignados=$asignados;
        $this->view->supervivencia=$supervivencia;


    }

    public function cancelarAction()
    {
        $answer=array();
        $this->view->disable();
        $mensaje_extra_bitacora='';
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $estudio=Estudio::findFirstByese_id($data['ese_idcancelar']);
            if($estudio && (!empty($data['com_comentario-cancelar']))  )
            {
                $this->db->begin(); 
                $auth = $this->session->get('auth');
                $comenatrio_validar=trim($data['com_comentario-cancelar']);
                if(strlen($comenatrio_validar)<4)
                {
                    $answer[0]=1;
                    $answer['titular']='El campo comentarios debe tener un mínimo  de 5 caracteres...';
                    $answer['mensaje']='';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                // error_log(print_r($data,true));
                if(!isset($data['cac_id']) ||  trim($data['cac_id'])=="" || $data['cac_id']<=0)
                {
                    $answer[0]=1;
                    $answer['titular']='Faltan datos';
                    $answer['mensaje']='Debe seleccionar una opción válida del campo motivo';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

                
                if($estudio->ese_estatus==-2)
                {
                        $answer[0]=-1;
                        $answer['titular']='Error';
                        $answer['mensaje']='Error, el estudio ya no ha sido cancelado anteriormente(estatus cambiado)';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                }
                if($estudio->ese_fechaentregacliente!=null)
                {
                        $answer[0]=-1;
                        $answer['titular']='Error';
                        $answer['mensaje']='Error, el estudio ya no puedo ser cancelado por que ya tiene asiganada una fecha de entrega al cliente';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                }

                $comentario= new Comentarioese();
                $comentario->com_comentario=$data['com_comentario-cancelar'];
                $comentario->usu_id=$auth['id'];
                $comentario->ese_id=$data['ese_idcancelar'];
                $comentario->ese_estatus= $estudio->ese_estatus;
                $comentario->com_estatus=2;
                $fecha_y_hora = date("Y-m-d H:i:s");
                
                
                //validamos si existe alguna cita incio relacionada al ese_id
                if($estudio->ese_estatus<=3){ 
                    $cita=new Cita();              
                    $respuesta_modelo_buscar_cita =$cita->BuscarCitaActual($estudio->ese_id);
                    if( $respuesta_modelo_buscar_cita['estado']){
                        $respuesta_modelo_finalizar_cita= $cita->DesActivarCita($respuesta_modelo_buscar_cita['cit_id'],$auth);
    
                    }
                }
                if($estudio->ese_estatus>=4){ 
                    $cita=new Cita();              
                    $respuesta_modelo_buscar_cita =$cita->BuscarCitaFinalizada($estudio->ese_id);
                    if( $respuesta_modelo_buscar_cita['estado']){
                        $respuesta_modelo_finalizar_cita= $cita->DesActivarCita($respuesta_modelo_buscar_cita['cit_id'],$auth);
    
                    }
                }
                //validamos si existe alguna cita incio relacionada al ese_id fin

                $estudio->ese_precancelar=$estudio->ese_estatus;       
                $estudio->ese_estatus=-2;
                $estudio->usu_idcancela=$auth['id'];
                $estudio->ese_fechacancelacion=$fecha_y_hora;
    
                if( $estudio->ese_autoestudio==1){
                    $respuesta_modelo_cancelar_aes= $estudio->CancelarAutoestudioAsociado();
                    $mensaje_extra_bitacora.=$respuesta_modelo_cancelar_aes['mensaje_extra'];
                }

                #estcancelado INICIO 
                $obj_estcancelado=new Estcancelado();
                $data['ese_id']=$data['ese_idcancelar'];
                $data['eca_motivo']=$data['com_comentario-cancelar'];

                $respuesta_modelo_crear_registro_estcancelado= $obj_estcancelado->NuevoRegistro($data,$auth);
                // error_log(count($_FILES[$obj_estcancelado->key_input_file]["name"]));

                if( $respuesta_modelo_crear_registro_estcancelado['estado']){
                     $mensaje_extra_bitacora.=$respuesta_modelo_crear_registro_estcancelado['mensaje_extra'];
                     #ARCHIVOS INICIO ---------------------------------------ARCHIVOS INICIO                      
                     $eca_evidencia = isset($_FILES[$obj_estcancelado->key_input_file]) && is_array($_FILES[$obj_estcancelado->key_input_file]['error']) ? $_FILES[$obj_estcancelado->key_input_file] : null;
                    //  error_log(print_r($eca_evidencia,true));

                     if ($eca_evidencia != null) {
                         $data['eca_id'] = $respuesta_modelo_crear_registro_estcancelado['eca_id'];
                     
                         $countfiles = count($_FILES[$obj_estcancelado->key_input_file]['name']);
                         if ($countfiles >= 1) {
                            $respuesta_modelo_subir_archivo = $obj_estcancelado->SubirArchivos($data, $auth);
                            if (!$respuesta_modelo_subir_archivo["estado"]) {
                                error_log("Error al subir archivo registro principal: ".print_r($respuesta_modelo_crear_registro_estcancelado,true));
                                error_log("Error al subir archivo: " . print_r($respuesta_modelo_subir_archivo, true));
                                $this->db->rollback(); 
                                $answer[0] = 1;
                                $answer['titular'] = 'Error al procesar';
                                $answer['mensaje'] = 'Proceso #estcancelado archivo';
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;
                            }
                        } 
                       
                     }
                     
                    #ARCHIVOS INICIO ---------------------------------------ARCHIVOS INICIO 
                }
                else{
                    $this->db->rollback(); 
                    $answer[0]=1;
                    $answer['titular']='Error al procesar';
                    $answer['mensaje']='Proceso #estcancelado';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                #error_log(print_r($respuesta_modelo_crear_registro_estcancelado,true))
                #estcancelado FIN 

                
                if(($estudio->save()) && ($comentario->save()) )
                {
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Canceló el estudio con id '.$estudio->ese_id.' interno del sistema .'.$mensaje_extra_bitacora;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$estudio->ese_id;
                    $databit['bit_modulo']="Cancelar";
                    $databit['ese_id']= $estudio->ese_id;
                    $bitacora->NuevoRegistro($databit);
                    $this->db->commit();                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se guardaron los datos correctamente.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                else
                {
                    $this->db->rollback(); 
                    $answer[0]=-1;
                    $answer['titular']='Error';
                    $answer['mensaje']='Error al guardar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
            }
            else
            {

                $answer[0]=1;
                $answer['titular']='El campo comentarios es requerido...';
                $answer['mensaje']='';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            } 
        }

    }

    public function trafico_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(8,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

 
    }
    public function trafico_tablaAction()
    {

        $rol = new Rol();
        $auth = $this->session->get('auth');
        $this->view->nivel_estudios=Nivelestudio::query()
        ->columns('niv_id,niv_nombre')
        ->where("niv_estatus=2")
        ->execute();

        $condicion='';
        if($rol->verificar(9,$auth['rol_id'])) //con esto tiene el permiso de ver todos los ESES
        {
            $condicion='';
        }
        if($rol->verificar(10,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los ESES asignados
        {
            $condicion='inv_id='.$auth['id'].' and ';
        }

        $condicion.=$this->getEstudios("Estudio.");

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $ESE=Estudio::query()
            ->columns('Estudio.ese_id,Estudio.ese_autoestudio,aes.aes_estatus  ,Estudio.ese_registro, Estudio.ese_fechaasiginvestigador, Estudio.ese_estatus,Estudio.ese_transporte, Estudio.ese_nombre, Estudio.ese_primerapellido, Estudio.ese_segundoapellido, 
                      emp.emp_alias as empresa_nombre, Estudio.tip_id, mun_nombre, est_nombre, tip_clave,
                       CONCAT(inv.usu_nombre," ", inv.usu_primerapellido," ",inv.usu_segundoapellido) as investigador, inv_id,
                       tra.tra_id,tra.tra_preaprobado,tra.tra_solicitado,tra.tra_destino,tra.tra_origen,tra.tra_comentario, cen_nombre, ese_folioverificacion, Estudio.tif_id
                       ,Estudio.mun_id, ana_id
                       ')
            ->where($condicion.' and (ese_estatus=2 or ese_estatus=3)')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Autoestudio','aes.ese_id=Estudio.ese_id','aes')
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
            ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.tra_estatus=1','tra')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();

        if($rol->verificar(36,$auth['rol_id'])) ///con esto buscamos información para el resumen de analistas
            {
                $socioeconomico=0;
                $verificacion=0;
                $supervivencia=0;
                $total=count($ESE);
                
                for ($i=0; $i < count($ESE) ; $i++) {
                    switch($ESE[$i]->tip_id)
                    {   
                        case 1:
                        case 3:
                        case 5:
                            $socioeconomico++;
                            break;

                        case 2:
                            $verificacion++;
                            break;

                        case 4:
                            $supervivencia++;
                            break;
                    }
                }

                $investigadores=Estudio::query()
                    ->columns('Estudio.tip_id, CONCAT(inv.usu_nombre, " ", inv.usu_primerapellido, " ", inv.usu_segundoapellido) as investigador, inv_id, count(Estudio.tip_id) as cantidad')
                    ->where($condicion.' and (ese_estatus=2 or ese_estatus=3)')
                    ->join('Usuario','inv.usu_id=Estudio.inv_id','inv')
                    ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
                    ->groupBy('inv_id')
                    ->execute();

                // $analistas=Estudio::query()
                // ->columns('ana_id, CONCAT(a.usu_nombre, " ", a.usu_primerapellido, " ", a.usu_segundoapellido) as analista, count(Estudio.tip_id) as cantidad')
                // ->where($condicion)
                // ->join('Usuario','a.usu_id=Estudio.ana_id','a')
                // ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
                // ->groupBy('ana_id')
                // ->execute();

                $this->view->totalestudios=$total;
                $this->view->socioeconomico=$socioeconomico;
                $this->view->verificacion=$verificacion;
                $this->view->supervivencia=$supervivencia;
                $this->view->investigadores=$investigadores;
            }
       
     
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $date= new DateTime();
        $hoy=$date->format('Y-m-d');
        $tresdias = $this->resDias($hoy,3);
        $seisdias = $this->resDias($hoy,5);

        $this->view->tresdias=$tresdias;
        $this->view->seisdias=$seisdias;

    }

    public function reasignarinvestigadorAction()
    {
            $this->view->disable();
            if($this->request->isAjax())
            {
                $data = $this->request->getPost();
                $estudio=Estudio::findFirstByese_id($data['ese_id']);
                $investigador_reasignado=Usuario::findFirstByusu_id($data['inv_id']);
                if($estudio &&  $investigador_reasignado)
                {
                    $auth = $this->session->get('auth');
                    $comentario= new Comentarioese();
                    $comentario->com_comentario=$data['com_comentario'];
                    $comentario->usu_id=$auth['id'];
                    $comentario->ese_id=$data['ese_id'];
                    $comentario->ese_estatus= $estudio->ese_estatus;
                    $comentario->com_estatus=2;

                    $fecha_y_hora = date("Y-m-d H:i:s");
                    $estudio->ese_estatus=3;  
                    $estudio->inv_id= $investigador_reasignado->usu_id;
                    $estudio->ese_fechaasiginvestigador=$fecha_y_hora;
                         
                    if(($estudio->save()) && ($comentario->save()))
                    {    
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Se reasignó el estudio socioeconómico con ID '.$data['ese_id'].' interno del sistema, el investigador que tenía asignado este estudio socioeconómico erá '.$investigador_reasignado->usu_nombre.' '.$investigador_reasignado->usu_primerapellido.' '. $investigador_reasignado->usu_segundoapellido;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_id'];
                            $databit['bit_modulo']="Tráfico";
                            $databit['ese_id']= $data['ese_id'];
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se reasignó el ESE correctamente';
        
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                    }
                    else
                    {
                        $answer[0]=-1;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-1;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }
    }

    public function asignaranalista_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(11,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }
    public function asignaranalista_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $condicion='ese_estatus=4 and ';
        $condicion.=$this->getEstudios("Estudio.");
        
        $ESE=Estudio::query()
        ->columns('ese_id, ese_solicita, ese_fechaasiginvestigador, ese_fechaentregainvestigador, ese_estatus, ese_nombre,ese_primerapellido, ese_segundoapellido, ana_id, inv_id, ese_registro,
         inv.usu_nombre as investigador_nombre, inv.usu_primerapellido as investigador_apellidoP , inv.usu_segundoapellido as investigador_apellidoM,
         emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id
         ')
        ->where($condicion)
        ->join('Usuario','inv.usu_id=Estudio.inv_id','inv')
        ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
        ->join('Estado','est.est_id=Estudio.est_id','est')
        ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
        ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
        ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
        ->execute();
              
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

    }
    public function ajax_setasignaranalistaAction()
    {
   
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
            {
                $data = $this->request->getPost();
                if(!isset($data['ana_id']))
                     {
                        $answer[0]=-1;
                        $answer['titular']='Error - Falta asignar analista';
                        $answer['mensaje']='Error, el estudio requiere que se le asigne un analista...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;

                    }
                $estudio=Estudio::findFirstByese_id($data['ese_id']);
                $analista_asignado=Usuario::findFirstByusu_id($data['ana_id']);
                if($estudio &&  $analista_asignado)
                {       
                    $auth = $this->session->get('auth');
                    if($estudio->ese_estatus!=4)
                     {
                        $answer[0]=-2;
                        $answer['titular']='Error';
                        $answer['mensaje']='Error, el estudio ya no está disponible(estatus cambiado)';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;

                    }
                    if($estudio->inv_id==$data['ana_id']){
                        $answer[0]=-1;
                        $answer['titular']='INVESTIGADOR COMO ANALISTA';
                        $answer['mensaje']='El investigador del estudio no puede ser el mismo que el analista...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }

                    


                    if($data['com_comentario']!=''){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario=$data['com_comentario'];
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_id'];
                        $comentario->ese_estatus= $estudio->ese_estatus;
                        $comentario->com_estatus=2;
                        $comentario->save();
                    }
                    
                    $estudio->ese_estatus=5;
                    $fecha_y_hora = date("Y-m-d H:i:s");      
                    $estudio->ana_id= $analista_asignado->usu_id;
                    $estudio->ese_fechaasiganalista=$fecha_y_hora;
              
                    if($estudio->save())
                    {
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Se asignó el estudio con ID '.$data['ese_id'].' interno del sistema,al analista con ID interno del sistema '.$analista_asignado->usu_id.' con el nombre de '.$analista_asignado->usu_nombre.' '.$analista_asignado->usu_primerapellido.' '. $analista_asignado->usu_segundoapellido;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_id'];
                            $databit['bit_modulo']="Asignar analista";
                            $databit['ese_id']= $data['ese_id'];
                            $bitacora->NuevoRegistro($databit);

                            $comentario= new Comentarioese();
                            $comentario->com_comentario= $databit['bit_descripcion'];
                            $comentario->com_estatus= 2;
                            $comentario->usu_id= $auth['id'];
                            $comentario->ese_id= $data['ese_id'];
                            $comentario->ese_estatus= 2;
                            $comentario->save();
                       
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se asignó el ESE correctamente';
        
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return; 
                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }

    }

    public function altaAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(5,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

  
    public function nuevoAction()
    {
        $answer = array();
        $answer[0] = 1;
        $mensaje_extra = '';
        $data_aes = '';
        $mensaje_extra_json = '';
        $this->view->disable();
        $this->db->begin();

        if ($this->request->isAjax()) {
            try {
    
                $data = $this->request->getPost();
                $auth = $this->session->get('auth');
                $estudio = new Estudio();
                $idestudio = 0;
    
                if ($data['tip_id'] == 1 || $data['tip_id'] == 5) {
                    $aes = new Autoestudio();
    
                    if ($data['tip_id'] == 1 && isset($data['ese_aes_preg'])) {
                        $data_aes = $data['aes'];
                        $busqueda_correo = $aes->ValidarExisteCorreoActivo($data_aes['aes_correo']);
    
                        if ($busqueda_correo['estado']) {
                            $answer[0] = -2;
                            $answer['mensaje'] = 'correo repetido';
                            $answer['titular'] = 'DATOS REPETIDOS';
                            $this->response->setJsonContent($answer);
                            $this->response->send();
                            return;
                        }
    
                        $idestudio = $estudio->CrearSocioeconomico($data, $auth['id']);
                        $respuesta_modelo_aes = $aes->NuevoRegistro($idestudio, $data_aes);
                        $respuesta_modelo_convertir_aes = $aes->Convertirlo_A_Autoestudio($idestudio);
                        $mensaje_extra .= ', se agregó con autoestudio que tiene por clave interna ' . $respuesta_modelo_aes['aes_id'];
                        $mensaje_extra_json .= '<br> con un autoestudio con ID interno: ' . $respuesta_modelo_aes['aes_id'];
                    } else {
                        $idestudio = $estudio->CrearSocioeconomico($data, $auth['id']);
                    }
    
                    if (isset($data['referencia_personal'])) {
                        $seccion_personal = new Seccionpersonal();
                        $respuesta_modelo_seccion_personal = $seccion_personal->crearRegistroAutomatico($idestudio);
    
                        if ($respuesta_modelo_seccion_personal['estado'] == 2) {
                            $referenciapersonal = new Referenciapersonal();
                            foreach ($data['referencia_personal'] as $key => $data_referencia_personal) {
                                $referenciapersonal->altaEstudioNuevoRegistro($data_referencia_personal, $respuesta_modelo_seccion_personal['sep_id']);
                            }
                            $mensaje_extra = $mensaje_extra . ', con datos de sección personal con ID ' . $respuesta_modelo_seccion_personal['sep_id'] . ' ';
                        }
                    }
    
                    if (isset($data['referencia_laboral'])) {
                        $seccion_laboral = new Seccionlaboral();
                        $respuesta_modelo_seccion_laboral = $seccion_laboral->crearRegistroAutomatico($idestudio);
    
                        if ($respuesta_modelo_seccion_laboral['estado'] == 2) {
                            $referencialaboral = new Referencialaboral();
                            foreach ($data['referencia_laboral'] as $key => $data_referencia_laboral) {
                                $referencialaboral->altaEstudioNuevoRegistro($data_referencia_laboral, $respuesta_modelo_seccion_laboral['sel_id']);
                            }
                            $mensaje_extra = $mensaje_extra . ' con datos de sección personal con ID ' . $respuesta_modelo_seccion_laboral['sel_id'] . ' ';
                        }
                    }
                }
    
                if ($data['tip_id'] == 2) {
                    $idestudio = $estudio->CrearVerificacion($data, $auth['id']);
                }
    
                if ($data['tip_id'] == 3) {
                    $idestudio = $estudio->CrearNegocio($data, $auth['id']);
                }
    
                if ($data['tip_id'] == 4) {
                    $idestudio = $estudio->CrearSupervivencia($data, $auth['id']);
                }
                


                if ($idestudio != 0) {
                    $bitacora = new Bitacora();
                    $databit['bit_descripcion'] = "Creó un estudio con folio interno: " . $idestudio . ' ' . $mensaje_extra;
                    $databit['usu_id'] = $auth['id'];
                    $databit['bit_tablaid'] = 0;
                    $databit['bit_modulo'] = "Alta investigación";
                    $databit['ese_id'] = $idestudio;
                    $bitacora->NuevoRegistro($databit);
                    $answer[0] = 1;
                    $answer[1] = $idestudio;
                    $answer['mensaje'] = 'Estudio creado correctamente. ID interno generado para el estudio:' . $idestudio . $mensaje_extra_json;
                    $answer['titular'] = 'Éxito';
                } else {
                    $answer[0] = 0;
                }
    
                $this->db->commit();
            } catch (\Exception $e) {
                $this->db->rollback(); 
                error_log("ERROR AL DAR DE ALTA UN ESTUDIO ". $e->getMessage());
                $answer[0] = 0;
                $answer['mensaje'] ="ERROR EN EL PROCESO";
                $answer['titular'] = 'ERROR';
                $answer[1] = 'Error al procesar la solicitud: ' . $e->getMessage();
            }
        } else {
            $answer[0] = -1;
        }
    
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    

    public function ajax_setasignarinvestigadorAction(){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $fecha_y_hora = date("Y-m-d H:i:s");
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $ese_id_utilizando=$data['ese_idasignar'];
            $registro=Estudio::findFirstByese_id($data['ese_idasignar']);

            if($registro->ese_estatus!=1)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']="intentó asignar uno ya asignado ";
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']= $registro->ese_id;
                $databit['bit_modulo']="ASIGNAR INVESTIGADOR";
                $databit['ese_id']= $registro->ese_id;
                $bitacora->NuevoRegistro($databit);

                $answer[0]=-1;
                $answer['titular']='AVISO ';
                $answer['mensaje']='No se puede realizar la acción solicitada, el estudio previamente fue cambiado, recargue la página para actualizar información #estado'.$registro->ese_estatus.' ESE ID '.$registro->ese_id;
                $answer[1]=$registro->ese_id;
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
           

            }
            
            $registro->inv_id=$data['inv_id'];
            $registro->ese_estatus=2;
            $registro->ese_fechaasiginvestigador=$fecha_y_hora;

             //evalua: en caso de que le hayan asignado un transporte anteriormente y este estudio NO tenga un registro en la tabla de transporte.
            if($data['ese_transporte_estatus_val']==2)
            {
                $usuarioinvestigador=Usuario::findFirstByusu_id($data['inv_id']);
                if($usuarioinvestigador->usu_transporte != 1){ //si el investigador no tiene permisos para que se le asigne transporte
                    $answer[0]=-1;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='El investigador no tiene permisos para que se le asigne transporte.';
                    $answer[1]=$registro->ese_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                   
                }

                $rol=Rol::findFirstByrol_id($auth['rol_id']);
                if($data['tra_preaprobado']>$rol->rol_traaprobar){
                    $answer[0]=-1;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='El monto pre-aprobado supera al permitido para tu rol.';
                    $answer[1]=$registro->ese_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }

                $registro->ese_transporte=2;
                $trasporte = new Transporte();
                $trasporte->tra_preaprobado=$data['tra_preaprobado'];
                $trasporte->ese_id=$ese_id_utilizando;
                $trasporte->investigadorusu_id=$data['inv_id'];
                $trasporte->asignausu_id=$auth['id'];
                $trasporte->tra_estatus=1;
                $trasporte->tra_comentarioadmin=$data['tra_comentario_admin'];
                if( $trasporte->save())
                {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']='Agregó transporte con la cantidad $'.$data['tra_preaprobado']. ' preaprobado al estudio con ID interno '.$registro->ese_id ;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']= $trasporte->tra_id;
                    $databit['bit_modulo']="Transporte";
                    $databit['ese_id']= $registro->ese_id;
                    $bitacora->NuevoRegistro($databit);

                    $comentario= new Comentarioese();
                    $comentario->com_comentario= $databit['bit_descripcion'];
                    $comentario->com_estatus= 2;
                    $comentario->usu_id= $auth['id'];
                    $comentario->ese_id= $registro->ese_id;
                    $comentario->ese_estatus= 1;
                    $comentario->save();

                }
            }
            else{
                $registro->ese_transporte=1;
            }

            

            if($registro->save())
            {   
                $usuario=Usuario::findFirstByusu_id($data['inv_id']);
                $nombre=$usuario->usu_nombre." ".$usuario->usu_primerapellido." ".$usuario->usu_segundoapellido;
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Asignó investigador: ".$nombre." al estudio con folio interno: ".$registro->ese_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$registro->ese_id;
                $databit['bit_modulo']="Asignar investigador";
                $databit['ese_id']=$registro->ese_id;
                $bitacora->NuevoRegistro($databit);

                $comentario= new Comentarioese();
                $comentario->com_comentario= $databit['bit_descripcion'];
                $comentario->com_estatus= 2;
                $comentario->usu_id= $auth['id'];
                $comentario->ese_id= $registro->ese_id;
                $comentario->ese_estatus= 1;
                $comentario->save();

                $answer['mensaje']='Investigador asignado correctamente';
                if($registro->tip_id==1 || $registro->tip_id==3 || $registro->tip_id==5){
                    $configuracion_obj=new Configuracion();
                    $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
                    if($enviar_correo_estatus==1){                    
                        $correo = new ServicioCorreo();
                        $mensaje = $correo->notificaasiginves;
                        $mensaje=str_replace("#id#",trim($registro->ese_id),$mensaje);
                        $mensaje=str_replace("#nombre#",trim(implode(" ",array($registro->ese_nombre, $registro->ese_primerapellido, $registro->ese_segundoapellido))),$mensaje);
                        
                        $empresamodel = new Empresa();
                        $mensaje=str_replace("#empresa#", $empresamodel->getAlias($registro->emp_id), $mensaje);
                        $estadomodel = new Estado();
                        $mensaje=str_replace("#estado#", $estadomodel->getNombre($registro->est_id), $mensaje);
                        $municipiomodel = new Municipio();
                        $mensaje=str_replace("#municipio#", $municipiomodel->getNombre($registro->mun_id), $mensaje);
                        $mensaje=str_replace("#colonia#",trim($registro->ese_colonia),$mensaje);
                        $mensaje=str_replace("#calle#",trim($registro->ese_calle),$mensaje);
                        $mensaje=str_replace("#numero#",trim($registro->ese_numext),$mensaje);
                        $mensaje=str_replace("#telefono#",trim($registro->ese_telefono),$mensaje);
                        $mensaje=str_replace("#celular#",trim($registro->ese_celular),$mensaje);

                        $envio= $correo->notificarasignacioninv($nombre, $usuario->usu_correo, $mensaje);
                        if($envio==1){
                            $answer['mensaje']='Investigador asignado y correo de notificación entregado exitosamente.';
                        }
                        else{
                            $answer['mensaje']='Investigador asignado correctamente. Error al entregar correo de notificación.';
                        }
                    }
                    else{
                        $answer['mensaje']='Investigador asignado correctamente. El envío de correos esta desactivado. Comuníquese con un administrador.';
                    }
                }
                $answer[0]=1;
                $answer['titular']='Éxito';
                
                $answer[1]=$registro->ese_id;
            }
            else
                $answer[0]=0;
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    
    public function traficoanalista_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(12,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingresó a módulo de Tráfico analista";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Tráfico analista";
        $bitacora->NuevoRegistro($databit);
    }

    public function traficoanalista_tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            // $indexana=$data["ana_idselect"];

            $descripcion="Realizó una búsqueda en consulta";
            $condicion='(ese_estatus=5 or ese_estatus=8 or ese_estatus=2 or ese_estatus=3 and ana_id!=null)';

            $usuario= new Usuario();
            
            if($rol->verificar(13,$auth['rol_id'])) //con esto tiene el permiso de ver todos los ESES
            {
                // $condicion='';
            }
            if($rol->verificar(14,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los ESES asignados
            {
                $condicion.=' and ana_id='.$auth['id'];
            }

            $condicion.=' and '.$this->getEstudios("Estudio.");
            $ESE=Estudio::query()
            ->columns('Estudio.ese_id, ese_fechaasiginvestigador, ese_fechaentregainvestigador, ese_registro, ese_fechaasiganalista, ese_solicita, ese_correo, ese_puesto, ese_estatus, ese_nombre,ese_primerapellido ,ese_segundoapellido,
             ana_id, inv_id,ese_fechanacimiento,ese_telefono,ese_celular,
             a.usu_nombre as analista_nombre, a.usu_primerapellido as analista_apellidoP , a.usu_segundoapellido as analista_apellidoM,
             inv.usu_nombre as investigador_nombre, inv.usu_primerapellido as investigador_apellidoP , inv.usu_segundoapellido as investigador_apellidoM,
             emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id,
             aes.aes_estatus, ese_autoestudio
             ')
            ->where($condicion)
            ->join('Usuario','a.usu_id=Estudio.ana_id','a')
            ->join('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Autoestudio','aes.ese_id=Estudio.ese_id','aes')

            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();

            if($rol->verificar(35,$auth['rol_id'])) ///con esto buscamos información para el resumen de analistas
            {
                $socioeconomico=0;
                $verificacion=0;
                $supervivencia=0;
                $total=count($ESE);
                

                for ($i=0; $i < count($ESE) ; $i++) {
                    switch($ESE[$i]->tip_id)
                    {   
                        case 1:
                        case 3:
                        case 5:
                            $socioeconomico++;
                            break;

                        case 2:
                            $verificacion++;
                            break;

                        case 4:
                            $supervivencia++;
                            break;
                    }
                }

                $analistas=Estudio::query()
                ->columns('ana_id, CONCAT(a.usu_nombre, " ", a.usu_primerapellido, " ", a.usu_segundoapellido) as analista, count(Estudio.tip_id) as cantidad')
                ->where($condicion)
                ->join('Usuario','a.usu_id=Estudio.ana_id','a')
                ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
                ->groupBy('ana_id')
                ->execute();

                $this->view->totalestudios=$total;
                $this->view->socioeconomico=$socioeconomico;
                $this->view->verificacion=$verificacion;
                $this->view->supervivencia=$supervivencia;
                $this->view->analistas=$analistas;
            }
        }
      
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $date= new DateTime();
        $hoy=$date->format('Y-m-d');
        $cuatrodias = $this->resDias($hoy,4);
        $cincodias = $this->resDias($hoy,5);

        $this->view->cuatrodias=$cuatrodias;
        $this->view->cincodias=$cincodias;
    }

    public function ajax_setreasignaranalistaAction()
    {
        $answer=array();
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $analista_asignado=Usuario::findFirstByusu_id($data['ana_id']);
            $estudio=Estudio::findFirstByese_id($data['ese_id']);
            if(($estudio) && ($analista_asignado) && (!empty($data['com_comentario'])) )
            {
                $comentario= new Comentarioese();
                $comentario->com_comentario=$data['com_comentario'];
                $comentario->usu_id=$auth['id'];
                $comentario->ese_id=$data['ese_id'];
                $comentario->ese_estatus= $estudio->ese_estatus;
                $comentario->com_estatus=2;
                 $estudio->ese_estatus=5; //  SE MANTIENE EN EL MISMO ESTATUS
                $estudio->ana_id= $analista_asignado->usu_id;
                $fecha_y_hora = date("Y-m-d H:i:s");
                $estudio->ese_fechaasiganalista=$fecha_y_hora;
                if(($estudio->save()) && ($comentario->save()))
                    {
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Se reasignó el estudio socioeconómico con ID '.$data['ese_id'].' interno del sistema,al analista con ID interno del sistema'.$analista_asignado->usu_id.' con el nombre de '.$analista_asignado->usu_nombre.' '.$analista_asignado->usu_primerapellido.' '. $analista_asignado->usu_segundoapellido;
                            $databit['usu_id']=0;
                            $databit['bit_tablaid']=$data['ese_id'];
                            $databit['bit_modulo']="Tráfico analista";
                            $databit['ese_id']= $data['ese_id'];
                            $bitacora->NuevoRegistro($databit);

                            $comentario= new Comentarioese();
                            $comentario->com_comentario= $databit['bit_descripcion'];
                            $comentario->com_estatus= 2;
                            $comentario->usu_id= $auth['id'];
                            $comentario->ese_id= $data['ese_id'];
                            $comentario->ese_estatus= 5;
                            $comentario->save();
                       
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se reasignó el ESE correctamente';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;   
                    }
                    else
                    {
                        $answer[0]=-1;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }

            }
            else
            {  
                $answer[0]=-1;
                $answer['titular']='ERROR EN  COINCIDENCIAS';
                $answer['mensaje']='Error en coincidencia de los datos o el comentario está vacío.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;

            }      

        }
        else
        $answer[0]=-1;
        $answer['mensaje']='Error de los datos';
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function investigadormandareseAction()
    {
        $this->view->disable();   
            if($this->request->isAjax())
            {
                $data = $this->request->getPost();
                $estudio=Estudio::findFirstByese_id($data['ese_idmandar']);
                // $investigador_reasignado=Usuario::findFirstByusu_id($data['inv_id']);
                $mensaje_bitacora='';

                $transporte=new Transporte();
                $usuario_honorario=new Usuariotipoest();

                if($estudio)
                {
                    if($estudio->ese_estatus!=2)
                    {
                       $answer[0]=-1;
                       $answer['titular']='Error';
                       $answer['mensaje']='Error, el estudio ya no está disponible (estatus cambiado)';
                       $this->response->setJsonContent($answer);
                       $this->response->send(); 
                       return;

                    }
                    //validacion para verificar que el usuario tenga un honorario asignado activo
                    $respuesta_modelo_verificar_honorario_inv=$usuario_honorario->verificarHonorarioActivoAcordeATipoFormatoEstudio($estudio->inv_id,$estudio->tip_id);
                    if($respuesta_modelo_verificar_honorario_inv['estado']==false){
                        
                        $answer[0]=-1;
                        $answer['titular']='ADVERTENCIA';
                        $answer['mensaje']='Este estudio  NO tiene asignado un honorario de acorde al tipo de formato...#'.$estudio->inv_id.'#'.$estudio->tip_id;
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                     

                    }
                    $respuesta_modelo_transporte_relacionado=$transporte->buscarTransporteSolicitadoYVerificarQueYaEsteSolicitado($estudio->ese_id);
                    if($respuesta_modelo_transporte_relacionado['estado']){
                        
                        $answer[0]=-1;
                        $answer['titular']='ADVERTENCIA';
                        $answer['mensaje']='Este estudio tiene un transporte asignado, el cual no ha sido rellenado correctamente...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                     

                    }
                    if($estudio->ese_estatus!=2)
                    {
                       $answer[0]=-1;
                       $answer['titular']='Error';
                       $answer['mensaje']='Error, el estudio ya no está disponible (estatus cambiado)';
                       $this->response->setJsonContent($answer);
                       $this->response->send(); 
                       return;

                    }
                   
                    $transporte_respuesta=$transporte->ComprobarMontoSolicitado($data['tra_idmandar']);


                    $fecha_y_hora = date("Y-m-d H:i:s");
                    $auth = $this->session->get('auth');

                    if($data['com_comentariomandar']!=''){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario=$data['com_comentariomandar'];
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_idmandar'];
                        $comentario->ese_estatus= $estudio->ese_estatus;
                        $comentario->com_estatus=2;
                        $comentario->save();
                    }

                    $estudio->ese_fechaentregainvestigador=$fecha_y_hora;
                    $estudio->ese_honorario=$respuesta_modelo_verificar_honorario_inv['data']->ute_honorario;

                    if($estudio->ana_id == null ){
                         
                        $estudio->ese_estatus=4;
                       

                    }else
                    {
                        $mensaje_bitacora='El estudio ya lleva asignado a un analista con el ID '.$estudio->ana_id.' con nombre ';
                        $estudio->ese_estatus=5;
                        // $estudio->ese_fechaasiganalista=$fecha_y_hora;


                    }
                    $aes=new Autoestudio();
                    $respuesta_modelo_aes_buscar =$aes->BuscarUnicoRegistroActivo($estudio->ese_id);
                    if( $respuesta_modelo_aes_buscar['estado']){
                       $respuesta_modelo_cambiar_aes= $aes->EnviarATraficoAnalista($respuesta_modelo_aes_buscar['aes_id']);
                    }

                    $cita=new Cita();
                    $respuesta_modelo_buscar_cita =$cita->BuscarCitaActual($estudio->ese_id);
                    if( $respuesta_modelo_buscar_cita['estado']){
                        $respuesta_modelo_finalizar_cita= $cita->FinalizarCita($respuesta_modelo_buscar_cita['cit_id'],$auth);
                        $answer['cita_fin']=$respuesta_modelo_finalizar_cita;
                        $answer['cita_buscar']=$respuesta_modelo_buscar_cita;
                    }
                    // $estudio->inv_id= $investigador_reasignado->usu_id;
              
                    if($estudio->save())
                    {
                              
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Envió el estudio con ID interno '.$data['ese_idmandar'].' para su revisión. '.$mensaje_bitacora.' '.$transporte_respuesta['mensaje_bitacora'];
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_idmandar'];
                            $databit['bit_modulo']="Tráfico investigador";
                            $databit['ese_id']= $data['ese_idmandar'];
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se envió el ESE correctamente';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                    }
                    else
                    {
                        $answer[0]=-1;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-1;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }

    }

    public function autorizacion_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(15,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }


    public function autorizacion_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion='ese_estatus=6 and';
        $condicion.=$this->getEstudios("Estudio.");

            $ESE=Estudio::query()
            ->columns('ese_id, ese_registro, ese_estatus, ese_nombre, ese_primerapellido, ese_segundoapellido, ana_id, inv_id, emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id
             ')
            ->where($condicion)
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();
        $this->view->usuariomodel = new Usuario();
    }

    public function autorizareseAction()
    {
        $this->view->disable();   
            if($this->request->isAjax())
            {
                $data = $this->request->getPost();
                $estudio=Estudio::findFirstByese_id($data['ese_idautorizar']);
                // $investigador_reasignado=Usuario::findFirstByusu_id($data['inv_id']);
                if($estudio)
                {
                    if($estudio->ese_estatus!=6)
                    {
                        $answer[0]=-2;
                        $answer['tif_id']=0;
                        $answer['titular']='Error';
                        $answer['mensaje']='Error, el estudio ya no esta disponible(estatus cambiado)';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;

                    }
                    if($estudio->ese_estatus=='-2')
                    {
                        $answer[0]=-2;
                        $answer['tif_id']=0;
                        $answer['titular']='Error';
                        $answer['mensaje']='Error, el estudio ya no esta disponible(estatus cambiado)';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;

                    }

                    if($estudio->tip_id==1 || $estudio->tip_id==3 || $estudio->tip_id==5)
                    {
                        $avisopriv=Archivo::query()
                            ->columns('ese_id')
                            ->where('ese_id='.$data['ese_idautorizar'].' and cat_id=8 and arc_estatus=2')
                            // ->join('Estudio','e.ese_id=Archivo.ese_id','e')
                            ->execute();
                        if(count($avisopriv)==0){
                            $answer[0]=-2;
                            $answer['tif_id']=0;
                            $answer['titular']='Error';
                            $answer['mensaje']='El estudio no tiene cargado el aviso de privacidad. Cargue el archivo e intente de nuevo.';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                        }
                        
                    }
                    
                    // $estudio_transporte=Transporte::query()
                    //     ->where("ese_id=".$estudio->ese_id.' and tra_estatus >= 0')
                    //     ->execute();
                    // // $estudio_transporte=Transporte::findFirst(array("ese_id = '$estudio->ese_id'","tra_estatus >= 0 "));
                    
                    // if(count($estudio_transporte)>0)
                    // {
                    //     if($estudio_transporte[0]->tra_estatus!=3){
                    //         $answer[0]=-1;
                    //         $answer['titular']='Transporte no ha sido aprobado';
                    //         $answer['mensaje']='El transporte que tiene asignado este estudio aún no ha sido autorizado, por favor espere a que el transporte sea autorizado, el <strong> folio de transporte es '.$estudio_transporte[0]->tra_id.'</strong> ...';
                    //         // $answe['image_url']="https://cdn-icons-png.flaticon.com/512/1048/1048339.png";
                    //         $this->response->setJsonContent($answer);
                    //         $this->response->send(); 
                    //         return;
                    //     }
                      

                    // }



                    $descripcion_extra='.';
                    //validamos si es un estudio tipo 4 //supervivencia
                    if($estudio->tip_id==4)
                    {
                        $descripcion_extra='';
                        $descripcion_extra=' y autorizó el siguiente número de visitas: '.$data['ese_visita'].'.';
                        $estudio->ese_visita=$data['ese_visita']; 
                    }

                    $auth = $this->session->get('auth');
                    if($data['com_comentarioautorizar']!=''){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario=$data['com_comentarioautorizar'];
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_idautorizar'];
                        $comentario->ese_estatus= $estudio->ese_estatus;
                        $comentario->com_estatus=2;
                        $comentario->save();
                    }
                    
                    $fecha_y_hora = date("Y-m-d H:i:s");
                    $estudio->ese_estatus=7;
                    $estudio->usu_idvalida=$auth['id'];
                    if( $estudio->ese_fechaentregacliente==null){
                        $estudio->ese_fechaentregacliente=$fecha_y_hora;
                    }

                    if($estudio->save())
                    {         
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Autorizó el estudio con ID interno '.$data['ese_idautorizar'] .$descripcion_extra;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_idautorizar'];
                            $databit['bit_modulo']="Autorizar ESE";
                            $databit['ese_id']= $data['ese_idautorizar'];
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['tif_id']=0;
                            if($estudio->tip_id==1){
                                switch($estudio->tif_id)
                                {   
                                    case 1:
                                        $url="../reporte/formatoeses/".$estudio->ese_id;
                                        $answer['tif_id']=1;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    case 7:
                                        $url="../reporte/formatoargos/".$estudio->ese_id;
                                        $answer['tif_id']=7;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    case 9:
                                        $url="../reporte/formatotruper/".$estudio->ese_id;
                                        $answer['tif_id']=9;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    case 10:
                                        $url="../reporte/formatotruper_ventas/".$estudio->ese_id;
                                        $answer['tif_id']=10;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    case 11:
                                        $url="../reporte/formatotruper/".$estudio->ese_id;
                                        $answer['tif_id']=9;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                }
                                
                            }
                            elseif($estudio->tip_id==5){
                                switch($estudio->tif_id)
                                {
                                    case 11:
                                        $url="../reporte/formatotruper/".$estudio->ese_id;
                                        $answer['tif_id']=9;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    case 5:
                                        $url="../reporte/formatogabtubos/".$estudio->ese_id;
                                        $answer['tif_id']=5;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    case 6:
                                        $url="../reporte/formatoencognv/".$estudio->ese_id;
                                        $answer['tif_id']=6;
                                        $answer['mensaje']='Se actualizó el ESE correctamente <a href="'.$url.'" target="_blank">Clic aquí para descargar PDF<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i></a>';
                                        break;
                                    default:
                                        $answer['mensaje']='Se actualizó el ESE correctamente.';
                                        break;
                                }
                            }
                            else{
                                $answer['mensaje']='Se actualizó el ESE correctamente.';
                            }
                            

                            
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }
    }

    public function noaprobareseAction()
    {
        $this->view->disable();   
            if($this->request->isAjax())
            {
                $data = $this->request->getPost();
                $estudio=Estudio::findFirstByese_id($data['ese_idnoaprobar']);
                // $investigador_reasignado=Usuario::findFirstByusu_id($data['inv_id']);
                if($estudio)
                {
                  

                    if($estudio->ese_estatus==8){
                        $answer[0]=-1;
                        $answer['mensaje']='El estudio ya ha sido cambiado de estatus';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                    $auth = $this->session->get('auth');

                    $comentario= new Comentarioese();
                    $comentario->com_comentario=$data['com_comentarionoaprobar'];
                    $comentario->usu_id=$auth['id'];
                    $comentario->ese_id=$data['ese_idnoaprobar'];
                    $comentario->ese_estatus= $estudio->ese_estatus;
                    $comentario->com_estatus=2;
                    $comentario->com_regresoautoriza=1;
                    $estudio->ese_estatus=8;  
                    // $estudio->inv_id= $investigador_reasignado->usu_id;
              
                    if(($estudio->save()) && ($comentario->save()))
                    {
                              
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'No aprobó el estudio con ID interno '.$data['ese_idnoaprobar'];
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_idnoaprobar'];
                            $databit['bit_modulo']="Autorizar ESE";
                            $databit['ese_id']= $data['ese_idnoaprobar'];
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se guardó el registro del ESE correctamente';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                    }
                    else
                    {
                        $answer[0]=-1;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-1;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }

    }

    public function enviaraautorizacionAction()
    {
        $this->view->disable();   
            if($this->request->isAjax())
            {
                $data = $this->request->getPost();
                $estudio=Estudio::findFirstByese_id($data['ese_idenviaraautorizacion']);
                
                // $investigador_reasignado=Usuario::findFirstByusu_id($data['inv_id']);
                if($estudio)
                {

                    if($estudio->ese_estatus==5 || $estudio->ese_estatus==8)
                    {
                        

                    }else{
                        $answer[0]=-1;
                        $answer['titular']='Error';
                        $answer['mensaje']='Error, el estudio ya no esta disponible (estatus cambiado)';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                  
                    $auth = $this->session->get('auth');

                    if($data['com_comentarioenviaraautorizacion']!=''){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario=$data['com_comentarioenviaraautorizacion'];
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_idenviaraautorizacion'];
                        $comentario->ese_estatus= $estudio->ese_estatus;
                        $comentario->com_estatus=2;
                        $comentario->save();
                    }
                    

                    $fecha_y_hora = date("Y-m-d H:i:s");
                    $estudio->ese_estatus=6;
                    $estudio->ese_fechaentregaanalista=$fecha_y_hora;
                    // $estudio->inv_id= $investigador_reasignado->usu_id;
              
                    if($estudio->save())
                    {
                              
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Envió para su autorización el estudio con ID interno '.$data['ese_idenviaraautorizacion'];
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_idenviaraautorizacion'];
                            $databit['bit_modulo']="Tráfico analista";
                            $databit['ese_id']= $data['ese_idenviaraautorizacion'];
                            $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se actualizó el ESE correctamente';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;
                    }
                    else
                    {
                        $answer[0]=-1;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-1;
                    $answer['mensaje']='Error al guardar los datos';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

            }

    }

    public function detallesAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        
        $this->view->disable();
        // if(!$rol->verificar(9,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $answer[0]=-1;
        //     $answer[1]="No tienes permiso para realizar esta acción";
        //     $this->response->setJsonContent($answer);
        //     $this->response->send(); 
        //     return;
        // }
        if($this->request->isAjax()&&$id>0)
        {
            $registro=Estudio::query()
            ->columns('
             ese_id, ese_registro, ese_estatus, CONCAT(ese_nombre, " ", ese_primerapellido, " ", ese_segundoapellido) as ese_nombre,
             emp_nombre, tip_clave, CONCAT(cne_nombre," ",cne_primerapellido, " ", cne_segundoapellido) as contacto,
             ese_empresarecluta,
             tip.tip_id, CONCAT(ver_alias," ",ver_nombre) as verificacion, ese_folioverificacion, ese_centrocosto')
            ->where('ese_id='.$id)
            ->join('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->join('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
            // ->join('Estado','est.est_id=Estudio.est_id','est')
            // ->join('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Verificaciones','ver.ver_id=Estudio.ver_id','ver')
            ->execute();
            if($registro)
            {
                $answer[0]=1;
                $answer[1]=$registro[0];

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

    public function regresar_estatusAction()
    {
        $this->view->disable();
        $answer =array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $estudio = Estudio::findFirstByese_id($data['ese_id_regresar_estatus']);
            
            if($estudio)
            {
                $regresoautorizacion=0;
                if($estudio->ese_estatus==6){
                    $regresoautorizacion=1;
                }

                if($estudio->ese_estatus==6 && empty($data['com_comentario__regresar_estatus']) ){
                    
                    $answer[0]='1';
                    $answer['titular']='AVISO';
                    $answer['mensaje']="COMENTARIO OBLIGATORIO";
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                if($estudio->ValidarSiEsAutoEstudioConEstatusValidoParaRegresar()){
                    
                    $answer[0]=-2;
                    $answer['titular']='Advertencia';
                    $answer['mensaje']='No puedes regresar este estudio porque es autoestudio con un estatus no valido para regresar';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
               


                $auth = $this->session->get('auth');
                $estudio_respuesta= $estudio->RegresarEstatus($auth);

                if(!empty($data['com_comentario__regresar_estatus'])){
                    $comentario= new Comentarioese();
                    $comentario->com_comentario=$data['com_comentario__regresar_estatus'];
                    $comentario->usu_id=$auth['id'];
                    $comentario->ese_id=$data['ese_id_regresar_estatus'];
                    $comentario->com_estatus=2;
                    $comentario->ese_estatus=$estudio->ese_estatus;
                    $comentario->com_regresoautoriza=$regresoautorizacion;
                    $comentario->save();
                }else{
                    if($regresoautorizacion==1){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario='null';
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_id_regresar_estatus'];
                        $comentario->com_estatus=2;
                        $comentario->ese_estatus=$estudio->ese_estatus;
                        $comentario->com_regresoautoriza=$regresoautorizacion;
                        $comentario->save();
                    }
                }
               
                if(($estudio_respuesta[0]) )
                 {
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']=$estudio_respuesta[1];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$data['ese_id_regresar_estatus'];
                    $databit['bit_modulo']="Estudio";
                    $databit['ese_id']= $data['ese_id_regresar_estatus'];
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]='2';
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se realizó el cambio de estatus correctamente del estudio No.'.$data['ese_id_regresar_estatus'];
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                 }
                 else
                 {
                    $answer[0]='-1';
                    $answer['titular']='ERROR';
                    $answer['mensaje']='Error al cambiar de estatus el estudio No.'.$estudio->ese_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;

                 }
                
            }
            
        }
    }

    public function resumenanalistatablaAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(35,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        $condicion='(ese_estatus=5 or ese_estatus=8 or ese_estatus=2 or ese_estatus=3 ) and Estudio.ana_id='.$id.' and ';
        $condicion.=$this->getEstudios("Estudio.");

        $ESE=Estudio::query()
            ->columns('Estudio.ese_id,ese_estatus ,ese_fechaasiginvestigador, ese_fechaentregainvestigador, ese_registro, ese_fechaasiganalista, ese_solicita, ese_correo, ese_puesto, ese_estatus, ese_nombre,ese_primerapellido ,ese_segundoapellido,
             ana_id, inv_id,ese_fechanacimiento,ese_telefono,ese_celular,
             a.usu_nombre as analista_nombre, a.usu_primerapellido as analista_apellidoP , a.usu_segundoapellido as analista_apellidoM,
             inv.usu_nombre as investigador_nombre, inv.usu_primerapellido as investigador_apellidoP , inv.usu_segundoapellido as investigador_apellidoM,
             emp.emp_alias as empresa_nombre,est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, Estudio.tif_id, aes.aes_estatus, ese_autoestudio
             ')
            ->where($condicion)
            ->leftjoin('Usuario','a.usu_id=Estudio.ana_id','a')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->leftjoin('Autoestudio','aes.ese_id=Estudio.ese_id','aes')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();
    }

    public function resumeninvestigadortablaAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(36,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $condicion='(ese_estatus=2 or ese_estatus=3) and Estudio.inv_id='.$id.' and ';
        $condicion.=$this->getEstudios("Estudio.");

        $ESE=Estudio::query()
        ->columns('Estudio.ese_id,Estudio.ese_autoestudio,Estudio.ese_registro, Estudio.ese_fechaasiginvestigador, Estudio.ese_estatus,Estudio.ese_transporte, Estudio.ese_nombre, Estudio.ese_primerapellido, Estudio.ese_segundoapellido, 
                emp.emp_alias as empresa_nombre, Estudio.tip_id, mun_nombre, est_nombre, tip_clave,
            CONCAT(inv.usu_nombre," ", inv.usu_primerapellido," ",inv.usu_segundoapellido) as investigador, inv_id,
            CONCAT(ana.usu_nombre," ", ana.usu_primerapellido," ",ana.usu_segundoapellido) as analista, ana_id,
            tra.tra_id,tra.tra_preaprobado,tra.tra_solicitado,tra.tra_destino,tra.tra_origen,tra.tra_comentario, cen_nombre, ese_folioverificacion, Estudio.tif_id
            ,Estudio.mun_id
            ,Estudio.ese_autoestudio,aes.aes_estatus
            ')
            ->where($condicion)
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
            ->leftjoin('Autoestudio','aes.ese_id=Estudio.ese_id','aes')

            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.tra_estatus=1','tra')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();
    }

    public function detalleseditarverificacionAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        
        $this->view->disable();
        if(!$rol->verificar(31,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        if($this->request->isAjax()&&$id>0)
        {
            $registro=Estudio::query()
            ->columns('ese_id, ese_nombre, ese_primerapellido, ese_segundoapellido, emp_id, est_id, mun_id, cne_id, cen_id, ver_id, ese_folioverificacion, tip_id, ese_tippersona, ese_centrocosto,ese_empresarecluta,tif_id')
            ->where('ese_id='.$id)
            ->execute();
            if($registro[0]->tip_id==2)
            {
                $answer[0]=1;
                $answer[1]=$registro[0];

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

    public function editarverificacionAction()
    {
        $answer = array();
        $answer[0] = 1;
        $this->view->disable();

        if ($this->request->isAjax()) {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $connection = $this->db;

            $connection->begin();

            try {
                $estudio = new Estudio();
                if(!$this->numerovalidoInputValido($data['est_ideditarver'])){
                    throw new \Exception('Falta el campo estado...');
                }
            
                $idestudio = $estudio->EditarVerificacion($data, $auth['id']);

                if ($idestudio != 0) {
                    $bitacora = new Bitacora();
                    $databit['bit_descripcion'] = "Editó un estudio con folio interno: " . $idestudio;
                    $databit['usu_id'] = $auth['id'];
                    $databit['bit_tablaid'] = $idestudio;
                    $databit['bit_modulo'] = "Editar estudio";
                    $databit['ese_id'] = $idestudio;
                    $bitacora->NuevoRegistro($databit);

                    $answer[0] = 1;
                    $answer[1] = $idestudio;

                    $connection->commit();
                } else {
                    $connection->rollback();
                    $answer[0] = 0;
                }
            } catch (\Exception $e) {
                $connection->rollback();
                $answer[0] = -1;
                error_log("ERROR AL detalleseditarverificacionAction ".$e->getMessage());
            }

            $this->response->setJsonContent($answer);
            $this->response->send();
        }
    }


    //esta funcion obtiene todos los datos de un estudio  y los devuelve por ajax
    public function get_ajax_datos_estudio_especificoAction($id=0){
      
      

        // $this->view->disable();
        // $answer=array();
        if($this->request->isAjax())
        {

            $result = [];
            $subs = Estudio::findFirstByese_id($id);
            if ($subs) {
                $result = $subs->toArray();
            }
            return $this->response->setJsonContent($result);

        }else{
            return http_response_code(400);
        }


      

    }
    //esta funcion obtiene todos los datos de un estudio  y los devuelve por ajax
    public function get_ajax_datos_estudio_empresa_especificoAction($id=0){
            // $this->view->disable();
            // $answer=array();
            if($this->request->isAjax())
            {
                $data_ese= Estudio::query()
                ->columns("  
                CONCAT(Estudio.ese_nombre,' ', Estudio.ese_primerapellido,' ', Estudio.ese_segundoapellido) as ese_nombre,
                Estudio.ese_estatus,
                Estudio.ana_id,
                Estudio.inv_id,
                Estudio.ese_honorario,
                Estudio.est_id,
                Estudio.mun_id,
                Estudio.tip_id,
                mun.mun_nombre,
                est.est_nombre,
                inv.usu_correo as inv_correo,
                CONCAT(inv.usu_nombre,' ', inv.usu_primerapellido,' ', inv.usu_segundoapellido) as inv_nombre,
                Estudio.inv_id,
                inv.est_id as inv_est_id,
                inv.mun_id as inv_mun_id,
                Estudio.ese_id,emp.emp_nombre,emp.emp_alias")
                ->where('ese_id='.$id)
                ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
                ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
                ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
                ->limit('1')
                ->execute();
                if ($data_ese) {
                    $result = $data_ese->toArray();
                }
                return $this->response->setJsonContent($result);
    
            }else{
                return http_response_code(400);
            }
    
    }

    public function detalleseditarsocioeconomicoAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        
        $this->view->disable();
        if(!$rol->verificar(31,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        if($this->request->isAjax()&&$id>0)
        {
            $registro=Estudio::query()
            ->columns('ese_id, ese_nombre, ese_primerapellido,
             ese_segundoapellido, emp_id, est_id, mun_id,
            cne_id,ese_empresarecluta,cne_id, 
             ese_centrocosto, tip_id, ese_tippersona,cen_id,tif_id
             ')
            ->where('ese_id='.$id)
            ->execute();
            if($registro[0]->tip_id==1 || $registro[0]->tip_id==3 || $registro[0]->tip_id==5)
            {
                $answer[0]=1;
                $answer[1]=$registro[0];

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

    public function editarsocioeconomicoAction(){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            
            $estudio=new Estudio();
            $idestudio=$estudio->EditarSocioeconomico($data, $auth['id']);
            
            if($idestudio!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Editó un estudio con folio interno: ".$idestudio;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Editar estudio";
                $databit['ese_id']= $idestudio;
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                $answer[1]=$idestudio;
            }
            else
                $answer[0]=0;
            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function detalleseditarsupervivenciaAction($id){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        
        $this->view->disable();
        if(!$rol->verificar(31,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        if($this->request->isAjax()&&$id>0)
        {
            $registro=Estudio::query()
            ->columns('ese_id, ese_nombre, ese_primerapellido,ese_empresarecluta, ese_segundoapellido, emp_id, est_id, mun_id, cne_id, cen_id, tip_id, ese_tippersona, ese_folioverificacion, ese_centrocosto,tif_id')
            ->where('ese_id='.$id)
            ->execute();
            if($registro[0]->tip_id==4)
            {
                $answer[0]=1;
                $answer[1]=$registro[0];

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

    public function editarsupervivenciaAction(){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            
            $estudio=new Estudio();
            
            $idestudio=$estudio->EditarSupervivencia($data, $auth['id']);
            
            if($idestudio!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Editó un estudio con folio interno: ".$idestudio;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Editar estudio";
                $databit['ese_id']= $idestudio;
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                $answer[1]=$idestudio;
            }
            else
                $answer[0]=0;
            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function  ajax_setasignaranalista_en_trafico_investigadorAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {

                $auth = $this->session->get('auth');
                $data = $this->request->getPost();
             
              //  return json_encode($data);
                if($data['ana_id']==-2){
                    $answer[0]=-1;
                    $answer['titular']='ANALISTA SIN SELECCIONAR';
                    $answer['mensaje']='El analista no ha sido seleccionado, por favor seleccione un analista...';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }


                $estudio=Estudio::findFirstByese_id($data['ese_id']);
                $analista_asignado=Usuario::findFirstByusu_id($data['ana_id']);
                if($estudio &&  $analista_asignado)
                {       
               
                 
                    if($estudio->inv_id==$data['ana_id']){
                        $answer[0]=-1;
                        $answer['titular']='INVESTIGADOR COMO ANALISTA';
                        $answer['mensaje']='El investigador del estudio no puede ser el mismo que el analista...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }

                    if($estudio->ana_id!=null){
                        $answer[0]=-2;
                        $answer['titular']='ANALISTA YA ESTÁ  ASIGNADO';
                        $answer['mensaje']='Un analista ya ha sido asignado previamente a este estudio(si quiere cambiar de analista este estudio debe ir a la función reasignar analista)...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                    


                    if($data['com_comentario']!=''){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario=$data['com_comentario'];
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_id'];
                        $comentario->ese_estatus= $estudio->ese_estatus;
                        $comentario->com_estatus=2;
                        $comentario->save();
                    }
                    
                    $fecha_y_hora = date("Y-m-d H:i:s");      
                    $estudio->ana_id= $analista_asignado->usu_id;
                    $estudio->ese_fechaasiganalista=$fecha_y_hora;
              
                    if($estudio->save())
                    {
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Se asignó el estudio socioeconómico en tráfico investigador con ID '.$data['ese_id'].' interno del sistema,al analista con ID interno del sistema '.$analista_asignado->usu_id.' con el nombre de '.$analista_asignado->usu_nombre.' '.$analista_asignado->usu_primerapellido.' '. $analista_asignado->usu_segundoapellido.'';
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_id'];
                            $databit['bit_modulo']="Asignar analista en tráfico investigador";
                            $databit['ese_id']= $data['ese_id'];
                            $bitacora->NuevoRegistro($databit);
                       
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se asignó el ESE correctamente';
        
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return; 
                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['mensaje']='Error al guardar los datos, no se encontraron concidencias en los campos ingresados...';
                   
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

        }else{
            return http_response_code(400);
        }



    }

    public function ajax_get_detalles_analista_asignadoAction($ese_id){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
           $ese= Estudio::query()
            ->columns("ese_id,ese_estatus,ana_id,date_format(ese_fechaasiganalista,'%d/%m/%Y - %H:%i:%s') as ese_fechaasiganalista
            ,   CONCAT(ana.usu_nombre,' ', ana.usu_primerapellido,' ',ana.usu_segundoapellido) as analista, ana_id
            ")
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
            ->where('ese_id='.$ese_id)
            ->execute();


            $answer[0]=2;
            $answer['titular']='ok';
            $answer['data']=$ese;
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
          

        }else{
            return http_response_code(400);
        }




    }

    /**
     * ajax_re_asignaranalista_en_trafico_investigadorAction [ Sirve para cambiar de analista en un estudio, los estus en los que funciona son
     * Trafico inv y trafico analista, se agrega una validacion para saber en cual de los dos estus se hizo la reasignacion de analista
     * ]
     * @param boolean $esta_en_trafico_analista[1=si, indica que hizo el cambio de analista en trafico analista,0= indica que hizo el cambio en trafico investigador]
     * @return json $answer 
     */


    public function  ajax_re_asignaranalista_en_trafico_investigadorAction($esta_en_trafico_analista=0){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
                $mensaje_bitacora='';
                $ese_max_estatus=4;
                $mensaje_extra_exito='';
                if($esta_en_trafico_analista==1){
                    $mensaje_bitacora='Re-asignó el estudio socioeconómico en tráfico analista con ID ';
                    $ese_max_estatus=5;
                    $mensaje_extra_exito=' en tráfico analista';

                }else{
                    $mensaje_bitacora='Re-asignó el estudio socioeconómico en tráfico investigador con ID ';
                    $mensaje_extra_exito=' en tráfico investigador';

                }

                $auth = $this->session->get('auth');
                $data = $this->request->getPost();
             
              //  return json_encode($data);
                if($data['ana_id']==-2 || $data['ana_id']==null || $data['ana_id']==''){
                    $answer[0]=-1;
                    $answer['titular']='ANALISTA SIN SELECCIONAR';
                    $answer['mensaje']='El analista no ha sido seleccionado, por favor seleccione un analista...';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }


                $estudio=Estudio::findFirstByese_id($data['ese_id']);
                $analista_asignado=Usuario::findFirstByusu_id($data['ana_id']);
                if($estudio &&  $analista_asignado)
                {    
                    if($estudio->ese_estatus>$ese_max_estatus ||  $estudio->ese_estatus<=1){
                        $answer[0]=-1;
                        $answer['mensaje']='El estudio ya no está disponible(cambio de estatus).#'. $ese_max_estatus.'#'.$estudio->ese_estatus;
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                    
                    if($estudio->ana_id==null){
                        $answer[0]=-1;
                        $answer['mensaje']='El estudio no tiene asignado un analista(el estudio se ha cambiado de estatus)...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                    if($estudio->inv_id==$data['ana_id']){
                        $answer[0]=-1;
                        $answer['titular']='INVESTIGADOR COMO ANALISTA';
                        $answer['mensaje']='El investigador del estudio no puede ser el mismo que el analista...';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                    if($data['com_comentario']!=''){
                        $comentario= new Comentarioese();
                        $comentario->com_comentario=$data['com_comentario'];
                        $comentario->usu_id=$auth['id'];
                        $comentario->ese_id=$data['ese_id'];
                        $comentario->ese_estatus= $estudio->ese_estatus;
                        $comentario->com_estatus=2;
                        $comentario->save();
                    }
                    
                    $fecha_y_hora = date("Y-m-d H:i:s");      
                    $estudio->ana_id= $analista_asignado->usu_id;
                    $estudio->ese_fechaasiganalista=$fecha_y_hora;
              
                    if($estudio->save())
                    {
                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= $mensaje_bitacora.$data['ese_id'].' interno del sistema. El analista al que fue re-asignado tiene por ID '.$analista_asignado->usu_id;
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$data['ese_id'];
                            $databit['bit_modulo']="Re-asignar analista en tráfico investigador";
                            $databit['ese_id']= $data['ese_id'];
                            $bitacora->NuevoRegistro($databit);
                       
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se re-asignó el ESE correctamente '.$mensaje_extra_exito;
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return; 
                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['mensaje']='Error al guardar los datos';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;
                    }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['mensaje']='Error al guardar los datos, no se encontraron concidencias en los campos ingresados...';
                   
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }

        }else{
            return http_response_code(400);
        }


    }


    public function ajax_set_sin_analistaAction($ese_id){

        $this->view->disable();
        $answer=array();
        $answer['titular']='ERROR';

        if($this->request->isAjax() and $ese_id!=0 and is_numeric($ese_id))
        {

            $data = $this->request->getPost();
            $estudio=Estudio::findFirstByese_id($ese_id);
            if($estudio){
                if($estudio->ana_id==null){
                    $answer[0]=-1;
                    $answer['mensaje']='El estudio no tiene asignado un analista(el estudio se ha cambiado de estatus)...';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }


            $respuesta_modelo_desasignar=$estudio->desAsignarAnalistaEstablecido();
            if( $respuesta_modelo_desasignar['estado']){

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Desasigno el analista con ID interno '.$respuesta_modelo_desasignar['ana_id_anterior'].' de estudio  No. '.$respuesta_modelo_desasignar['ese_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$estudio->ese_id;
                $databit['bit_modulo']="Desasignar analista";
                $databit['ese_id']= $estudio->ese_id;
                $bitacora->NuevoRegistro($databit);

                
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se desasigno el analista con ID interno '.$respuesta_modelo_desasignar['ana_id_anterior'].' de estudio  No. '.$respuesta_modelo_desasignar['ese_id'];
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }else{
                $answer[0]=-2;
                $answer['mensaje']='ERROR AL PROCESAR DATOS';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
            }

            }else{   
                $answer[0]=-2;
                $answer['mensaje']='No esta disponible este estudio...';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }


        }else{
            return http_response_code(400);
        }
    }

    public function ajax_honorario_actualizarAction($ese_id){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $ese_id!=0 and is_numeric($ese_id))
        {

            $data = $this->request->getPost();
            $estudio=Estudio::findFirstByese_id($ese_id);
            if($estudio){
                if($estudio->ese_honorario==null){
                    $answer[0]=-1;
                    $answer['mensaje']='El estudio no tiene asignado un honorario...';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }


            $respuesta_modelo_actualizar_honorario=$estudio->actualizarHonorario($data);
            if( $respuesta_modelo_actualizar_honorario['estado']){

                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Actualizo honorario de estudio el cual tenía  un honorario de '.$respuesta_modelo_actualizar_honorario['honorario_anterior'].' y ahora el monto en honorario es de '.$respuesta_modelo_actualizar_honorario['honorario_actual'].'';
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$estudio->ese_id;
                $databit['bit_modulo']="Actualizar Honorario (Soporte)";
                $databit['ese_id']= $estudio->ese_id;
                $bitacora->NuevoRegistro($databit);

                
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se actualizó el honorario estudio  No. '.$respuesta_modelo_actualizar_honorario['ese_id'];
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }else{
                $answer[0]=-2;
                $answer['mensaje']='ERROR AL PROCESAR DATOS';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
            }

            }else{   
                $answer[0]=-2;
                $answer['mensaje']='No esta disponible este estudio...';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
        }
    }
      //esta funcion obtiene todos los datos de un estudio  pero en especifico los datos de calificacion y los devuelve por ajax
      public function get_ajax_datos_calificacionAction($id=0){
        // $this->view->disable();
        // $answer=array();
        if($this->request->isAjax())
        {
            $data_ese= Estudio::query()
            ->columns("  
            CONCAT(Estudio.ese_nombre,' ', Estudio.ese_primerapellido,' ', Estudio.ese_segundoapellido) as ese_nombre,
            CONCAT(inv.usu_nombre,' ', inv.usu_primerapellido,' ', inv.usu_segundoapellido) as inv_nombre,
            CONCAT(ana.usu_nombre,' ', ana.usu_primerapellido,' ', ana.usu_segundoapellido) as ana_nombre,
            CONCAT(usu_valida.usu_nombre,' ', usu_valida.usu_primerapellido,' ', usu_valida.usu_segundoapellido) as usu_valida_nombre,

            Estudio.ese_estatus,
            Estudio.ana_id,
            Estudio.inv_id,
            emp.emp_nombre,
            daf.daf_calificacion,
            daf.cal_id,

            bie.bie_calificacion,
            dae.dae_calificacion,
            dae.dae_calificacion,
            dgf.dgf_calificacion,
            sel.sel_calificacion,
            sep.sep_calificacion,
            DATE_FORMAT(ese_fechaentregacliente, ' %d-%m-%Y %H:%i') AS  ese_fechaentregacliente,
            Estudio.usu_idvalida,
            sie.sie_calificacion,
            Estudio.tif_id,
            sie.sie_calificacion,
            cop.cop_calificacion,
            ans.ans_calificacion,
            ess.ess_calificacion,
            agf.agf_calificacion,
            emp.emp_alias")
            ->where('Estudio.ese_id='.$id)
            
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id and emp.emp_estatus=2','emp')
            ->leftjoin('Datofinal','daf.ese_id=Estudio.ese_id and daf.daf_estatus=2','daf')
            ->leftjoin('Datocomprobatorio','cop.ese_id=Estudio.ese_id and cop.cop_estatus=2','cop')
            ->leftjoin('Antecedentesocial','ans.ese_id=Estudio.ese_id and ans.ans_estatus=2','ans')
            ->leftjoin('Estadosalud','ess.ese_id=Estudio.ese_id and ess.ess_estatus=2','ess')
            ->leftjoin('Bieninmueble','bie.ese_id=Estudio.ese_id and bie.bie_estatus=2','bie')
            ->leftjoin('Datoescolar','dae.ese_id=Estudio.ese_id and dae.dae_estatus=2','dae')
            ->leftjoin('Datogrupofamiliar','dgf.ese_id=Estudio.ese_id and dgf.dgf_estatus=2','dgf')
            ->leftjoin('Datovivienda','dav.ese_id=Estudio.ese_id and dav.dav_estatus=2','dav')
            ->leftjoin('Seccionlaboral','sel.ese_id=Estudio.ese_id and sel.sel_estatus=2','sel')
            ->leftjoin('Seccionpersonal','sep.ese_id=Estudio.ese_id and sep.sep_estatus=2','sep')
            ->leftjoin('Situacioneconomica','sie.ese_id=Estudio.ese_id and sie.sie_estatus=2','sie')
            ->leftjoin('Referenciavecinal','rev.sep_id=sep.sep_id and rev.rev_estatus=2','rev')
            ->leftjoin('Referencialaboral','rel.sel_id=sel.sel_id and rel.rel_estatus=2','rel')
            ->leftjoin('Referenciapersonal','rep.sep_id=sep.sep_id and rep.rep_estatus=2','rep')
            ->leftjoin('Antecedentegrupofamiliar','agf.ese_id=Estudio.ese_id and agf.agf_estatus=2','agf')
            
            ->leftjoin('Usuario','usu_valida.usu_id=Estudio.usu_idvalida','usu_valida')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id ','ana')
            ->limit('1')
            ->execute();
            if ($data_ese) {
                $result = $data_ese->toArray();
            }
            return $this->response->setJsonContent($result);



        }else{
            return http_response_code(400);
        }

    


      

    }

    public function ajax_setreasignarinvestigadorAction()
    {
        $this->view->disable();
        $answer=array();
        $mensaje_bitacora='';
        $mensaje_final="";
        $connection = $this->db;
        $connection->begin();
        #error_log("init");
        try {
                if(!$this->request->isAjax())
                throw new \Exception('Formato incorrecto de solicitud...');
            
                $data = $this->request->getPost();


                if(empty($data) || !isset($data['ese_id'])) 
                    throw new \Exception('El campo ese_id no está presente en la solicitud...');
                
                $estudio=Estudio::findFirstByese_id($data['ese_id']);
                $auth = $this->session->get('auth');
                if(!$estudio)
                throw new \Exception('No se encontró un estudio asociado al ID asignado...');

               # $estatus_no_permitidos=[];
                if($estudio->ese_estatus!=2)
                throw new \Exception('Ya no está disponible este estudio (estatus -2)...');

                $respuesta_modelo_regresar_estatus= $estudio->RegresarEstatus($auth);
                
                if($respuesta_modelo_regresar_estatus[0]!=true){
                    throw new \Exception('Error al cambiar de estatus el estudio No.'.$estudio->ese_id);
                    error_log(print_r($respuesta_modelo_regresar_estatus,true));
                }

                $respuesta_modelo_asignar_investigador= $estudio->setAsignarInvestigador($auth,$data);

                if($respuesta_modelo_asignar_investigador["estatus"]==-2){
                    throw new \Exception('Error al asignar investigador No.'.$estudio->ese_id);
                    error_log(print_r($respuesta_modelo_asignar_investigador,true));
                }elseif($respuesta_modelo_asignar_investigador["estatus"]==-1){
                    $connection->rollback();
                    $answer['estatus'] = -1;
                    $answer['mensaje'] = $respuesta_modelo_asignar_investigador["mensaje"];
                    $answer['titular'] = $respuesta_modelo_asignar_investigador["titular"];
                    error_log(print_r($respuesta_modelo_asignar_investigador,true));
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;
                }
                $mensaje_final = "Se reasignó el estudio " . $estudio->ese_id;

                if (!empty(trim($respuesta_modelo_asignar_investigador['mensaje_correo']))) {
                    $mensaje_final .= " - " . $respuesta_modelo_asignar_investigador['mensaje_correo'];
                }
                $connection->commit();
                $answer['estatus'] = 2;
                $answer['mensaje'] = $mensaje_final;
                $answer['titular'] = "Éxito";
        } catch (Exception $e) {
            $connection->rollback();
            $answer['estatus'] = -2;
            $answer['mensaje'] = "error";
            $answer['titular'] = "error";
            error_log("Error en ajax_setreasignarinvestigadorAction: " . $e->getMessage());
        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;

       
    }
}