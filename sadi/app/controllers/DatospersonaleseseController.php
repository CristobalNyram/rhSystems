<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class DatospersonaleseseController extends ControllerBase
{


    public function ajax_set_update_formato_truperAction()
    {
      
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {



            $data = $this->request->getPost();
            $ese_data=$data['ese'];
            $datos_ese_datos_personales_buscar =Estudio::findFirstByese_id($ese_data['ese_id']);
            
        

            
            if($datos_ese_datos_personales_buscar)
            {
                if(!$datos_ese_datos_personales_buscar->ese_estatus>0)
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='El registro ya no está disponible, ha sido eliminado anteriormente.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
                }

                        $auth = $this->session->get('auth');
                        $rol = new Rol();
                        $permisocalificacion=0;
                        if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                        {
                            $permisocalificacion=1;  
                        }
                        $respuesta_modelo = $datos_ese_datos_personales_buscar->ActualizarRegistroFormatoTruper($ese_data,$permisocalificacion);
                        if($respuesta_modelo['estado']==2){

                            $auth = $this->session->get('auth');

                            $bitacora= new Bitacora();
                            $databit['bit_descripcion']= 'Actualizó los datos personales del estudio número '.$ese_data['ese_id'].'.';
                            $databit['usu_id']=$auth['id'];
                            $databit['bit_tablaid']=$ese_data['ese_id'];
                            $databit['ese_id']=$ese_data['ese_id'];
                            $databit['bit_modulo']="Datos personales ESE TRUPER";
                            $bitacora->NuevoRegistro($databit);
                            
                            $answer[0]=2;
                            $answer['titular']='Éxito';
                            $answer['mensaje']='Se actualizaron los datos correctamente';
                            $answer['ese_id']=$ese_data['ese_id'];

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


            }else{
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No se encontro un registro con el ID '.$ese_data['ese_id'].' de la tabla de ESES.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    
            }
          
        }

    }
    
}