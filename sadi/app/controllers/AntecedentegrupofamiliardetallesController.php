<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class AntecedentegrupofamiliardetallesController extends ControllerBase
{
    public function eliminarAction($agd_id=0)
    {

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $agd_id!=0 and is_numeric($agd_id))
        {
            $buscar_agd=Antecedentegrupofamiliardetalles::findFirst(array("agd_id = '$agd_id'","agd_estatus ='2'"));
            if($buscar_agd->agd_estatus==2)
            {
                $buscar_agd->agd_estatus=-2;

                    if($buscar_agd->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó el detalle de antecedentes de grupo familiar con clave interna '.$buscar_agd->agd_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_agd->agd_id;
                        $databit['bit_modulo']="Antecedentes grupo familiar detalles.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_agd->agd_id;
                        $answer['agf_id']= $buscar_agd->agf_id;
                        $answer['agd_id']= $buscar_agd->agd_id;
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

    public function actualizarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $agd_id=$data['agd_id_editar'];
                $buscar_agd =Antecedentegrupofamiliardetalles::findFirstByagd_id($agd_id);

                if($buscar_agd->agd_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_agd->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó un antecedente laboral familiar, los datos del antecedente laboral familiar pertenece a clave de registro: '.$respuesta_modelo['agd_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['agd_id'];
                                    $databit['bit_modulo']="Antecedente grupo familiar detalles";
                                    $bitacora->NuevoRegistro($databit);
                                    
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente';
                                    $answer['agd_id']=$respuesta_modelo['agd_id'];
                                    $answer['agf_id']=$respuesta_modelo['agf_id'];

                                    
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    
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

    public function ajax_get_detalleAction($agd_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($agd_id!=0 && is_numeric($agd_id)) {
            $subs = Antecedentegrupofamiliardetalles::findFirst(array(
                'agd_id='.$agd_id,
                'agd_estatus=2'));

                if ($subs->agd_estatus==2) {
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