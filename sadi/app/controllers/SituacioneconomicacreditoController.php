<?php

use Phalcon\Mvc\Model\Query\Builder;

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SituacioneconomicacreditoController extends ControllerBase
{
    public function crearAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $sec= new Situacioneconomicacredito() ;
            
    
            $respuesta_modelo= $sec->NuevoRegistro($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia de crédito la clave interna del registro '.$respuesta_modelo['sec_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['sec_id'];
                $databit['bit_modulo']="Situación economica crédito";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['sec_id']=$respuesta_modelo['sec_id'];
                $answer['sie_id']=$respuesta_modelo['sie_id'];

            
                $answer['sie_creditos_total'] = $sec->getTotalCreditosEspecifico($answer['sie_id'] );
                $respuesta_modelo_set_update = $sec->setUpdateCreditoEseEspecifico($answer['sie_id'],  $answer['sie_creditos_total'] );    

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
    public function actualizarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $sec_id=$data['sec_id_editar'];
                $buscar_sec=Situacioneconomicacredito::findFirstBysec_id($sec_id);

                if($buscar_sec->sec_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_sec->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia de crédito la clave interna del registro '.$respuesta_modelo['sec_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['sec_id'];
                                    $databit['bit_modulo']="Situación economica ingresos";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['sec_id']=$respuesta_modelo['sec_id'];
                                    $answer['sie_id']=$respuesta_modelo['sie_id'];
                                    
                                
                                            $answer['sie_creditos_total'] = $buscar_sec->getTotalCreditosEspecifico($answer['sie_id'] );
                                            $respuesta_modelo_set_update = $buscar_sec->setUpdateCreditoEseEspecifico($answer['sie_id'],  $answer['sie_creditos_total'] );    

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
    public function eliminarAction($sec_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $sec_id!=0 and is_numeric($sec_id))
        {
            $buscar_sec=Situacioneconomicacredito::findFirst($sec_id);
            if($buscar_sec->sec_estatus==2)
            {
                $buscar_sec->sec_estatus=-2;

                    if($buscar_sec->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó la referencia de crédito que tenia por clave interna: '.$buscar_sec->sec_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_sec->sec_id;
                        $databit['bit_modulo']="Antecedentes grupo familiar crédito.";
                        $bitacora->NuevoRegistro($databit);


                        
                        $sec_obj=new Situacioneconomicacredito();
                        $answer['sie_creditos_total'] = $sec_obj->getTotalCreditosEspecifico( $buscar_sec->sie_id );
                        $respuesta_modelo_set_update = $sec_obj->setUpdateCreditoEseEspecifico( $buscar_sec->sie_id,  $answer['sie_creditos_total'] );    
                        if($respuesta_modelo_set_update['estado']==2)
                        {
                           
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_sec->sec_id;
                                    $answer['sec_id']= $buscar_sec->sec_id;
                                    $answer['sie_id']= $buscar_sec->sie_id;
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
            $situacioneconomicacredito=new Builder();
            $situacioneconomicacredito=$situacioneconomicacredito
            ->addFrom('Situacioneconomicacredito','sec')
            ->where('sec_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $situacioneconomicacredito=new Builder();
                $situacioneconomicacredito=$situacioneconomicacredito
                ->addFrom('Situacioneconomicacredito','sec')
                ->where('sie_id='.$id.' and sec_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= 'Consulto los datos de la tabla, situación económica';
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Situación economica créditos;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$situacioneconomicacredito;
        
    }

    public function ajax_get_detalleAction($sec_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($sec_id!=0 && is_numeric($sec_id)) {
            $subs = Situacioneconomicacredito::findFirst(array(
                'sec_id='.$sec_id,
                'sec_estatus=2'));

                if ($subs->sec_estatus==2) {
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
}