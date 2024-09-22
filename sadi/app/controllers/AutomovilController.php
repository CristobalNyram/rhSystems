<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

use \Phalcon\Config\Adapter\Ini as ConfigIni;

require "mpdf/index.php";

class AutomovilController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Automovil');
        parent::initialize();
       
    }

    public function crearAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            $data = $this->request->getPost();

            $aut= new Automovil() ;
         
            $respuesta_modelo= $aut->NuevoRegistro($data);

                if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');

                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Registró un automóvil con clave interna del registro  '.$respuesta_modelo['aut_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['aut_id'];
                    $databit['bit_modulo']="Automóvil";
                    $bitacora->NuevoRegistro($databit);
                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se guardaron los datos correctamente.';
                    $answer['bie_id']=$respuesta_modelo['bie_id'];
                    $answer['aut_id']=$respuesta_modelo['aut_id'];            
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


               

         
        }else{
            return http_response_code(400);

        }

    }

    public function actualizarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $aut_id=$data['aut_id_editar'];
                $buscar_aut =Automovil::findFirstByaut_id($aut_id);

                if($buscar_aut->aut_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_aut->ActualizarRegistro($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó un automóvil, los datos del automóvil que tiene la clave de registro: '.$respuesta_modelo['aut_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['aut_id'];
                                    $databit['bit_modulo']="Automóvil";
                                    $bitacora->NuevoRegistro($databit);
                                    
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente';
                                    $answer['bie_id']=$respuesta_modelo['bie_id'];
                                    $answer['aut_id']=$respuesta_modelo['aut_id'];

                                    
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


    public function eliminarAction($aut_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $aut_id!=0 and is_numeric($aut_id))
        {
            $buscar_aut=Automovil::findFirst($aut_id);
            if($buscar_aut->aut_estatus==2)
            {
                $buscar_aut->aut_estatus=-2;

                    if($buscar_aut->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó el registro de automóvil que tenia por clave interna: '.$buscar_aut->aut_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_aut->aut_id;
                        $databit['bit_modulo']="Automóvil.";
                        $bitacora->NuevoRegistro($databit);

                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se eliminaron los datos correctamente del registro con ID '.$buscar_aut->aut_id.' .';
                            $answer['aut_id']= $buscar_aut->aut_id;
                            $answer['bie_id']= $buscar_aut->bie_id;    
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
            $automovil=new Builder();
            $automovil=$automovil
            ->addFrom('Automovil','aut')
            ->where('aut_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $automovil=new Builder();
                $automovil=$automovil
                ->addFrom('Automovil','aut')
                ->where('bie_id='.$id.' and aut_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de la tabla de automovil que tiene el ID de bienes inmuebles : ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Bienes inmuebles - automovil;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$automovil;
        $this->view->objectoAutomovil=new Automovil();

    }

    
    public function ajax_get_detalleAction($aut_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($aut_id!=0 && is_numeric($aut_id)) {
            $subs = Automovil::findFirst(array(
                'aut_id='.$aut_id,
                'aut_estatus=2'));

                if ($subs->aut_estatus==2) {
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

    public function ajax_get_data_tipo_autoAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            
            $automovil= new Automovil();
            $answer[0]=2;
            $answer['data']=$automovil->get_data_tipo_automovil();
            $answer['titular']='OK';
            $answer['mensaje']='OK';
            return $this->response->setJsonContent($answer);

        }else{
            return http_response_code(400);

        }

    }
    public function ajax_get_data_tipo_auto_formatotruperAction(){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            
            $automovil= new Automovil();
            $answer[0]=2;
            $answer['data']=$automovil->get_data_tipo_automovil_formatotruper();
            $answer['titular']='OK';
            $answer['mensaje']='OK';
            return $this->response->setJsonContent($answer);

        }else{
            return http_response_code(400);

        }

    }

    public function tabla_truperAction($id){
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $automovil=new Builder();
            $automovil=$automovil
            ->addFrom('Automovil','aut')
            ->where('aut_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $automovil=new Builder();
                $automovil=$automovil
                ->addFrom('Automovil','aut')
                ->where('bie_id='.$id.' and aut_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de la tabla de automovil que tiene el ID de bienes inmuebles : ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Bienes inmuebles - automovil;";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$automovil;
        $this->view->objectoAutomovil=new Automovil();

    }

    
}