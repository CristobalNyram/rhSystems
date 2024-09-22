<?php
use \Phalcon\Config\Adapter\Ini as ConfigIni;
/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SituacioneconomicaController extends ControllerBase
{
    public function crear_automaticoAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && is_numeric($ese_id))
        {
            $buscarEseId=Situacioneconomica::findFirst(array(
                "ese_id = '$ese_id'",
                'sie_estatus=2'
            ));

            if($buscarEseId==false)
            {
                $nuevo_sie= new Situacioneconomica();
                $nuevo_sie->sie_estatus=2;
                $nuevo_sie->ese_id=$ese_id;

                if($nuevo_sie->save())
                {
                    $answer[0]=2;
                    $answer['ese_id']=$ese_id;
                    $answer['sie_id']=$nuevo_sie->sie_id;
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;   
                }
                else
                {
                    $answer[0]=0;
                    $answer['titulo']='ERROR';
                    $answer['mensaje']='Error al generar los datos.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;   

                }
            }
            else
            {
                $answer[0]=0;
                $answer['titulo']='ERROR';
                $answer['mensaje']='Error al generar los datos.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
           
        }

    }
    public function ajax_get_detalleAction($ese_id=0)
    {
        $this->view->disable();
        $result = [];

         if ($ese_id!=0 && is_numeric($ese_id)) {
                 $subs = Situacioneconomica::findFirst(array(
                     'ese_id='.$ese_id,
                     'sie_estatus=2'));

                 if ($subs) {
                    $result = $subs->toArray();
                 }
         }
        
        return $this->response->setJsonContent($result);
    }
    public function ajax_set_updateAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
        {
            $data = $this->request->getPost();
           

            $sie_registro= Situacioneconomica::findFirst(array(
                "ese_id = '$ese_id'",
                'sie_estatus=2',
            ));

                if($sie_registro)
                {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion=0;
                    if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisocalificacion=1;  
                    }
               
                   
                    $respuesta_modelo= $sie_registro->ActualizarRegistro($data,$permisocalificacion);


                            if( $respuesta_modelo['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de situación economica del registro con clave interna:'.$respuesta_modelo['sie_id'].' del estudio No. '.$respuesta_modelo['ese_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['sie_id'];
                                $databit['bit_modulo']="Situación economica";
                                $databit['ese_id']= $sie_registro->ese_id;
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$respuesta_modelo['ese_id'];
                                $answer['sie_id']=$respuesta_modelo['sie_id'];
                              
                               
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }
                            else
                            {
                                
                                $answer[0]=-2;
                                $answer['titular']='Error';
                                $answer['mensaje']='No se procesaron los datos correctamente.';
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }

                }
                else
                {
                    
                }
        }

        
    }

    public function ajax_get_detalle_formato_truperAction($ese_id){


        $answer=[];
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $modelo_sie= new Situacioneconomica();
            $modelo_sef=new Situacioneconomicafamiliar();

            $respuesta_modelo_sie=$modelo_sie->encontrar_o_crear($ese_id);
            $respuesta_modelo_sef=$modelo_sef->encontrar_o_crear($ese_id);

            $answer['data_sie']=$respuesta_modelo_sie;
            $answer['data_sef']=$respuesta_modelo_sef;

            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;    


            

        }

    }

    public function ajax_set_update_formato_truperAction($ese_id ){
        $this->view->disable();
        $answer=array();
        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
        {
            $data = $this->request->getPost();
           
            $auth = $this->session->get('auth');

            $sie_registro= Situacioneconomica::findFirst(array(
                "ese_id = '$ese_id'",
                'sie_estatus=2',
            ));

            $sef_registro= Situacioneconomicafamiliar::findFirst(array(
                "ese_id = '$ese_id'",
                'sef_estatus=2',
            ));

                if($sie_registro and  $sef_registro)
                {
                   
               
                   
                    $respuesta_modelo= $sie_registro->ActualizarRegistroFormatoTruper($data,0);
                   $respuesta_modelo_sef= $sef_registro->ActualizarRegistroFormatoTruper($data,0);


                            if( $respuesta_modelo['estado']==2 && $respuesta_modelo_sef['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de situación economica del registro con clave interna:'.$respuesta_modelo['sie_id'].' del estudio No. '.$respuesta_modelo['ese_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['sie_id'];
                                $databit['ese_id']= $sie_registro->ese_id;
                                $databit['bit_modulo']="Situación economica";
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$respuesta_modelo['ese_id'];
                                $answer['sie_id']=$respuesta_modelo['sie_id'];
                              
                               
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }
                            else
                            {
                                
                                $answer[0]=-2;
                                $answer['titular']='Error';
                                $answer['mensaje']='No se procesaron los datos correctamente.';
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }

                }
                else
                {
                    
                }
        }
    }


    public function ajax_get_total_ingresos_familiar_formatotruperAction($ese_id){


        $this->view->disable();
        $answer=array();
        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
        {


            $registro= Situacioneconomicafamiliar::findFirst(array(
                "ese_id = '$ese_id'",
                'sef_estatus=2',
            ));
            $sie=new Situacioneconomicaingresos();

    
             $total = $sie->getTotalIngresosEspecificoFamiliaresIngresos($registro->sef_id);
    
             $data = $this->request->getPost();
             $total_ingreso_fam=$data['total_ingresos_familiar'];

            return  json_encode($total+$total_ingreso_fam);


        }else{
            return http_response_code(400);

        }
      
    }

    public function ajax_get_total_ingresos_candidato_formatotruperAction($ese_id){


        $this->view->disable();
        $answer=array();
        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
        {


            $registro= Situacioneconomica::findFirst(array(
                "ese_id = '$ese_id'",
                'sie_estatus=2',
            ));
            $sie=new Situacioneconomicaingresos();

    
             $total = $sie->getTotalIngresosEspecificoCandidatoIngresos($registro->sie_id);
    
             $data = $this->request->getPost();
             $total_sueldo=$data['total_ingreso_sueldo'];

            return  json_encode($total+$total_sueldo);


        }else{
            return http_response_code(400);

        }
      
    }

}