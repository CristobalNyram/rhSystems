<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class DatoviviendaController extends ControllerBase
{


    public function ajax_set_update_formato_truperAction($ese_id)
    {

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();  
            $auth = $this->session->get('auth');
            $rol = new Rol();
            $permisocalificacion=0;
            if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $permisocalificacion=1;  
            }

            $datoViviendaBuscar=Datovivienda::query()
            ->where('ese_id='.$ese_id.' and dav_estatus = 2')
            ->execute();

       

            if($datoViviendaBuscar[0]){
                    $respuesta_modelo= $datoViviendaBuscar[0]->ActualizarRegistro($data,$permisocalificacion);
            }else{
                    $modelo_dato_vivienda= new Datovivienda();
                    $respuesta_modelo= $modelo_dato_vivienda->NuevoRegistro($data,$permisocalificacion);
            }


            if($respuesta_modelo['estado']==2)
            {

                $bitacora= new Bitacora();
                $databit['bit_descripcion']=$respuesta_modelo['mensaje_bitacora'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['dav_id'];
                $databit['ese_id']=$respuesta_modelo['ese_id'];
                $databit['bit_modulo']="Datos de vivienda";
                $bitacora->NuevoRegistro($databit);
                
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente';
                $answer['ese_id']=$respuesta_modelo['ese_id'];
                $answer['dav_id']=$respuesta_modelo['dav_id'];
                $answer['actualizo']=0;

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='ERROR';
                $answer['mensaje']='No se actualizaron los datos correctamente';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }


          
           
        }

    }

    public function ajax_get_detalleAction($ese_id=0){
        if($this->request->isAjax())
        {
            $answer=[];
            $answer['estatus']=-2;

            $result = [];
            $subs = Datovivienda::findFirstByese_id($ese_id);

            if ($subs) {
 
                $result = $subs->toArray();
                $answer['data']= $result;
                $answer['estatus']=2;
             

            }
            return $this->response->setJsonContent($answer);

        }else{
            return http_response_code(400);
        }

    }

    public function ajax_crear_automaticoAction($ese_id=0){

        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && $this->request->isAjax())
        {
                            $modelo= new Datovivienda();
                            $repuesta_modelo= $modelo->registro_automatico($ese_id);
                            
                            if($repuesta_modelo['estado']==2)
                            {   
        
                                
                                $answer[0]=2;
                                $answer['ese_id']=$repuesta_modelo['ese_id'];
                                $answer['dav_id']=$repuesta_modelo['dav_id'];
                                

                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }
                            else
                            {
                                $answer[0]=0;
                                $answer['ese_id']=0;
                                $answer['dav_id']=0;
                                

                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
                            }
                
        }     
        else{
            return http_response_code(400);
    
        }       

    }


    public function ajax_get_data_selects_dinamicosAction(){

        $this->view->disable();
        $answer=[];
        if($this->request->isAjax()){
                                $modelo= new Datovivienda();
                                $answer['antiguedad_data']=$modelo->antiguedad_select_values;
                                $answer['zona_data']=$modelo->zona_select_values;
                                $answer['clase_social_data']=$modelo->clase_social_select_values;
                                $answer['vivienda_data']=$modelo->vivienda_select_values;
                                $answer['inmueble_data']=$modelo->inmueble_select_values;
                                $answer['formatovivienda_data']=$modelo->formatovivienda_select_values;
                                $answer['niveles_data']=$modelo->niveles_select_values;
                                $answer['apariencia_data']=$modelo->apariencia_select_values;
                                $answer['estadomobiliario_data']=$modelo->estadomobiliario_select_values;
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
        }     
        else{
            return http_response_code(400);
        } 
    }




}