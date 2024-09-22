<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

use \Phalcon\Config\Adapter\Ini as ConfigIni;

require "mpdf/index.php";

class EvaluaciontruperController extends ControllerBase
{

    public function ajax_get_create_detalleAction($ese_id){

        $answer=array();
        $answer['estado']=-2;

        $this->view->disable();
        if($this->request->isAjax() && is_numeric($ese_id)   && $ese_id!='')
        {

            $modelo_evt=new Evaluaciontruper();
    
            $respuesta_modelo_evt=$modelo_evt->encontrar_o_crear($ese_id);
        
            $answer['data_evt']=$respuesta_modelo_evt;
            $answer['estado']=2;

        }
        $this->response->setJsonContent($answer);
        $this->response->send();
        return;

    }

    public function actualizar_formato_truperAction($ese_id){

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
               
                $buscar_evt=Evaluaciontruper::findFirstByese_id($ese_id);

                if($buscar_evt->evt_estatus!=-2)
                {
                    $auth = $this->session->get('auth');
                
                    $respuesta_modelo = $buscar_evt->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una evaluación truper con la clave interna del registro '.$respuesta_modelo['evt_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['evt_id'];
                                    $databit['bit_modulo']="Evaluación truper";
                                    $databit['ese_id']=$respuesta_modelo['ese_id'];
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['evt_id']=$respuesta_modelo['evt_id'];
                                    $answer['ese_id']=$respuesta_modelo['ese_id'];


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
}