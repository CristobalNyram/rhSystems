<?php

use Phalcon\Mvc\Model\Query\Builder;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SituacioneconomicaingresosController extends ControllerBase
{
    public function crearAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $sei= new Situacioneconomicaingresos() ;
         
            $respuesta_modelo= $sei->NuevoRegistro($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia de ingreso la clave interna del registro '.$respuesta_modelo['sei_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['sei_id'];
                $databit['bit_modulo']="Situación economica ingresos";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sei_id']=$respuesta_modelo['sei_id'];
                $answer['sie_id']=$respuesta_modelo['sie_id'];

                $sie_consula=new Situacioneconomicaingresos();
                $answer['sie_totalingresos']= $sie_consula->getTotalIngresosEspecificoMasOtrosIngresos($respuesta_modelo['sie_id']);
                $respuesta_modelo_set_update = $sie_consula->setUpdateIngresoEseEspecifico($respuesta_modelo['sie_id'], $answer['sie_totalingresos']);
                if($respuesta_modelo_set_update['estado']==2)
                {
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se pudieron procesar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                    
                }


               

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
        }

    }
    public function actualizarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $sei_id=$data['sei_id_editar'];
                $buscar_sei=Situacioneconomicaingresos::findFirstBysei_id($sei_id);

                if($buscar_sei->sei_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_sei->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia de ingreso la clave interna del registro '.$respuesta_modelo['sei_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['sei_id'];
                                    $databit['bit_modulo']="Situación economica ingresos";
                                    $bitacora->NuevoRegistro($databit);
                                   

                                    $sie_consula=new Situacioneconomicaingresos();
                                    $answer['sie_totalingresos']= $sie_consula->getTotalIngresosEspecificoMasOtrosIngresos($buscar_sei->sie_id);

                                    $respuesta_modelo_set_update = $sie_consula->setUpdateIngresoEseEspecifico($buscar_sei->sie_id, $answer['sie_totalingresos']);
                                    
                                    if($respuesta_modelo_set_update['estado']==2)
                                    {
                                        $answer[0]=2;
                                        $answer['titular']='Éxito';
                                        $answer['mensaje']='Se actualizaron los datos correctamente.';
                                        $answer['sei_id']=$respuesta_modelo['sei_id'];
                                        $answer['sie_id']=$respuesta_modelo['sie_id'];    
                                        $this->response->setJsonContent($answer);
                                        $this->response->send(); 
                                        return;    
                                    }
                                    else
                                    {
                                        $answer[0]=-2;
                                        $answer['titular']='ERROR';
                                        $answer['mensaje']='No se pudieron procesar los datos.';
                                        $this->response->setJsonContent($answer);
                                        $this->response->send(); 
                                        return;    
                                        
                                    }
                                    
                                   
                                }
                                else
                                {
                                    $answer[0]=-2;
                                    $answer['titular']='ERROR';
                                    $answer['mensaje']='No se procesaron los datos correctamente';
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    

                                }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
        
    }
    public function eliminarAction($sei_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $sei_id!=0 and is_numeric($sei_id))
        {
            $buscar_sei=Situacioneconomicaingresos::findFirst($sei_id);
            if($buscar_sei->sei_estatus==2)
            {
                $buscar_sei->sei_estatus=-2;

                    if($buscar_sei->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó la referencia de ingreso que tenia por clave interna: '.$buscar_sei->sei_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_sei->sei_id;
                        $databit['bit_modulo']="Antecedentes grupo familiar detalles.";
                        $bitacora->NuevoRegistro($databit);

       
                     
                        $sie_consula=new Situacioneconomicaingresos();

                        $respuesta_modelo_set_update = $sie_consula->setUpdateBorrarUnIngresoEseEspecifico($buscar_sei->sie_id,$buscar_sei->sei_aportacion);
                                    
                        if($respuesta_modelo_set_update['estado']==2)
                        {
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se actualizaron los datos correctamente.';
                            $answer['sei_id']= $buscar_sei->sei_id;
                            $answer['sie_id']= $buscar_sei->sie_id;    
                            $answer['sie_totalingresos']= $respuesta_modelo_set_update['sie_totalingresos'];    
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;    
                        }
                        else
                        {
                            $answer[0]=-2;
                            $answer['titular']='ERROR';
                            $answer['mensaje']='No se pudieron procesar los datos.';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;    
                            
                        }

                        


                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;  

                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='No se pudieron procesar los datos.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;    
                        
                    }
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            
        }
        
    }
    public function tablaAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $situacioneconomicaingresos=new Builder();
            $situacioneconomicaingresos=$situacioneconomicaingresos
            ->addFrom('Situacioneconomicaingresos','sei')
            ->where('sei_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $situacioneconomicaingresos=new Builder();
                $situacioneconomicaingresos=$situacioneconomicaingresos
                ->addFrom('Situacioneconomicaingresos','sei')
                ->where('sie_id='.$id.' and sei_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias de ingresos familiares que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Situación economica ingresos;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$situacioneconomicaingresos;
        
    }
    public function RegistroAutomaticoCargado($data,$ese_id)
    {

    }

    public function ajax_get_detalleAction($sei_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($sei_id!=0 && is_numeric($sei_id)) {
            $subs = Situacioneconomicaingresos::findFirst(array(
                'sei_id='.$sei_id,
                'sei_estatus=2'));

                if ($subs->sei_estatus==2) {
                    $answer[0]=2;
                    $answer['data']= $result = $subs->toArray();
                    $answer['titular']='OK';
                    $answer['mensaje']='OK';
                   
                }
                else{
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                    return;    
                }
                
            
        }
        else{
            
            $answer[0]=-2;
            $answer['titular']='NO DISPONIBLE';
            $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
            return;    
        }
       
        return $this->response->setJsonContent($answer);

    }

    public function ajax_get_total_ingreso_eseAction($sie_id){
        $this->view->disable();
        $answer=array();

        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

                    $sie=new Situacioneconomicaingresos();
                    $sie_modelo= $sie->getTotalIngresosEspecifico($sie_id);

                    if($data['monto_manuntencion']>= 0){
                        $sie=new Situacioneconomicaingresos();
                        $sie_modelo= $sie->getTotalIngresosEspecifico($sie_id);
                        $answer[0]=2;
                        $answer['total_ingresos']= $sie_modelo;
                        $answer['suma_ingresos_manuntencion']= $sie_modelo+$data['monto_manuntencion'];
                        $answer['titular']='OK';
                        $answer['mensaje']='OK';
                        return $this->response->setJsonContent($answer);
                    }else{
                       
                        $answer[0]=-1;
                        $answer['titular']='DATOS INCORRECTOS';
                        $answer['mensaje']='NO SE PERMITEN NÚMEROS  NEGATIVOS.';
                        $answer['total_ingresos']= $sie_modelo;

                        return $this->response->setJsonContent($answer);

                    }

                  


        }else{
            return http_response_code(400);

        }
       
       
    }

    public function tabla_truper_ingresoscandidatoAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $situacioneconomicaingresos=new Builder();
            $situacioneconomicaingresos=$situacioneconomicaingresos
            ->addFrom('Situacioneconomicaingresos','sei')
            ->where('sei_estatus=2 and  sei_candidato=1')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $situacioneconomicaingresos=new Builder();
                $situacioneconomicaingresos=$situacioneconomicaingresos
                ->addFrom('Situacioneconomicaingresos','sei')
                ->where('sie_id='.$id.' and sei_estatus=2  and sei_candidato=1')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias de ingresos familiares que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Situación economica ingresos;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$situacioneconomicaingresos;
        
    }

    public function tabla_truper_ingresosfamiliaresAction($id=0)
    {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $situacioneconomicaingresos=new Builder();
            $situacioneconomicaingresos=$situacioneconomicaingresos
            ->addFrom('Situacioneconomicaingresos','sei')
            ->where('sei_estatus=2 and sei_candidato=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $situacioneconomicaingresos=new Builder();
                $situacioneconomicaingresos=$situacioneconomicaingresos
                ->addFrom('Situacioneconomicaingresos','sei')
                ->where('sef_id='.$id.' and sei_estatus=2 and sei_candidato=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias de ingresos familiares que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Situación economica ingresos;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$situacioneconomicaingresos;
        
    }


    public function crear_formato_truperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $sei= new Situacioneconomicaingresos() ;
         
            $respuesta_modelo= $sei->NuevoRegistroCandidatoFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia de ingreso la clave interna del registro '.$respuesta_modelo['sei_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['sei_id'];
                $databit['bit_modulo']="Situación economica ingresos";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sei_id']=$respuesta_modelo['sei_id'];
                $answer['sie_id']=$respuesta_modelo['sie_id'];

                $sie_consula=new Situacioneconomicaingresos();
                $answer['sie_totalingresos']= $sie_consula->getTotalIngresosEspecificoCandidatoIngresos($respuesta_modelo['sie_id']);
                $respuesta_modelo_set_update = $sie_consula->setUpdateIngresoEseEspecificoCandidatoFormatoTruper($respuesta_modelo['sie_id'], $answer['sie_totalingresos']);

                if($respuesta_modelo_set_update['estado']==2)
                {
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se pudieron procesar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                    
                }


               

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
        }
    }


    public function crear_familiar_formato_truperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $sei= new Situacioneconomicaingresos() ;
         
            $respuesta_modelo= $sei->NuevoRegistroFamiliarFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia de ingreso  familiar, la clave interna del registro '.$respuesta_modelo['sei_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['sei_id'];
                $databit['bit_modulo']="Situación economica ingresos";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sef_id']=$respuesta_modelo['sef_id'];
                $answer['sei_id']=$respuesta_modelo['sei_id'];


                $sei_consulta=new Situacioneconomicaingresos();
                $answer['sef_totalingresos']= $sei_consulta->getTotalIngresosEspecificoFamiliaresIngresos($respuesta_modelo['sef_id']);
                $respuesta_modelo_set_update = $sei_consulta->setUpdateIngresoEseEspecificoTotalIngresoFamiliar($respuesta_modelo['sef_id'], $answer['sef_totalingresos']);
                $answer['sef_totalingresos']=$respuesta_modelo_set_update['sef_totalingresos'];
                if($respuesta_modelo_set_update['estado']==2)
                {
                   
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return; 
                
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se pudieron procesar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                    
                }


               

            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se pudieron procesar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
        }
    }


     public function eliminarIngresoFamiliarAction($sef_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $sef_id!=0 and is_numeric($sef_id))
        {
            $buscar_sef=Situacioneconomicaingresos::findFirst($sef_id);
            if($buscar_sef->sei_estatus==2)
            {
                $buscar_sef->sei_estatus=-2;

                    if($buscar_sef->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó la referencia de ingreso que tenia por clave interna: '.$buscar_sef->sef_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_sef->sei_id;
                        $databit['bit_modulo']="Situación economica ingreso";
                        $bitacora->NuevoRegistro($databit);

       
                     
                        $sef_consulta=new Situacioneconomicaingresos();

                        $respuesta_modelo_set_update = $sef_consulta->setUpdateBorrarUnIngresoFamiliarEseEspecifico($buscar_sef->sef_id,$buscar_sef->sei_aportacion);
                                    
                        if($respuesta_modelo_set_update['estado']==2)
                        {
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se actualizaron los datos correctamente.';
                            $answer['sei_id']= $buscar_sef->sei_id;
                            $answer['sef_id']= $buscar_sef->sef_id;    
                            $answer['sef_totalingresos']= $respuesta_modelo_set_update['sef_totalingresos'];    
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;    
                        }
                        else
                        {
                            $answer[0]=-2;
                            $answer['titular']='ERROR';
                            $answer['mensaje']='No se pudieron procesar los datos.';
                            $this->response->setJsonContent($answer);
                            $this->response->send(); 
                            return;    
                            
                        }

                        


                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;  

                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='No se pudieron procesar los datos.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;    
                        
                    }
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            
        }
        
    }

    public function actualizar_candidato_formato_truperAction(){


        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $sei_id=$data['sei_id'];
                $buscar_sei=Situacioneconomicaingresos::findFirstBysei_id($sei_id);

                if($buscar_sei->sei_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_sei->ActualizarRegistroCandidatoFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia de ingreso la clave interna del registro'.$respuesta_modelo['sei_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['sei_id'];
                                    $databit['bit_modulo']="Situación economica ingresos";
                                    $bitacora->NuevoRegistro($databit);
                                   

                                    $sie_consula=new Situacioneconomicaingresos();

                                    $answer['sie_totalingresos']= $sie_consula->getTotalIngresosEspecificoCandidatoIngresos($buscar_sei->sie_id);
                                    $respuesta_modelo_set_update = $sie_consula->setUpdateIngresoEseEspecificoCandidatoFormatoTruper($buscar_sei->sie_id, $answer['sie_totalingresos']);

                                    if($respuesta_modelo_set_update['estado']==2)
                                    {
                                        $answer[0]=2;
                                        $answer['titular']='Éxito';
                                        $answer['mensaje']='Se actualizaron los datos correctamente.';
                                        $answer['sei_id']=$respuesta_modelo['sei_id'];
                                        $answer['sie_id']=$respuesta_modelo['sie_id'];    
                                        $this->response->setJsonContent($answer);
                                        $this->response->send(); 
                                        return;    
                                    }
                                    else
                                    {
                                        $answer[0]=-2;
                                        $answer['titular']='ERROR';
                                        $answer['mensaje']='No se pudieron procesar los datos.';
                                        $this->response->setJsonContent($answer);
                                        $this->response->send(); 
                                        return;    
                                        
                                    }
                                    
                                   
                                }
                                else
                                {
                                    $answer[0]=-2;
                                    $answer['titular']='ERROR';
                                    $answer['mensaje']='No se procesaron los datos correctamente';
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    

                                }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
        
    }

    public function actualizar_familiar_formato_truperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $sei_id=$data['sei_id'];
                $buscar_sei=Situacioneconomicaingresos::findFirstBysei_id($sei_id);

                if($buscar_sei->sei_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_sei->ActualizarRegistroFamiliarFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia de ingreso la clave interna del registro '.$respuesta_modelo['sei_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['sei_id'];
                                    $databit['bit_modulo']="Situación economica ingresos";
                                    $bitacora->NuevoRegistro($databit);
                                   

                                
                                    $sei_consulta=new Situacioneconomicaingresos();
                                    $answer['sef_totalingresos']= $sei_consulta->getTotalIngresosEspecificoFamiliaresIngresos($buscar_sei->sef_id);
                                    $respuesta_modelo_set_update = $sei_consulta->setUpdateIngresoEseEspecificoTotalIngresoFamiliar($buscar_sei->sef_id, $answer['sef_totalingresos']);
                                    $answer['sef_totalingresos']=$respuesta_modelo_set_update['sef_totalingresos'];

                                    if($respuesta_modelo_set_update['estado']==2)
                                    {
                                        $answer[0]=2;
                                        $answer['titular']='Éxito';
                                        $answer['mensaje']='Se actualizaron los datos correctamente.';
                                        $answer['sei_id']=$respuesta_modelo['sei_id'];
                                        $answer['sef_id']=$respuesta_modelo['sef_id'];    
                                        $this->response->setJsonContent($answer);
                                        $this->response->send(); 
                                        return;    
                                    }
                                    else
                                    {
                                        $answer[0]=-2;
                                        $answer['titular']='ERROR';
                                        $answer['mensaje']='No se pudieron procesar los datos.';
                                        $this->response->setJsonContent($answer);
                                        $this->response->send(); 
                                        return;    
                                        
                                    }
                                    
                                   
                                }
                                else
                                {
                                    $answer[0]=-2;
                                    $answer['titular']='ERROR';
                                    $answer['mensaje']='No se procesaron los datos correctamente';
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    

                                }
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='NO DISPONIBLE';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
    }


}