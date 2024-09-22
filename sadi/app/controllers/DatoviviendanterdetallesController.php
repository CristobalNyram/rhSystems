<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class DatoviviendanterdetallesController extends ControllerBase
{


    public function ajax_get_detalleAction($id){
        
        $this->view->disable();
        $result = [];

         if ($id!=0 && is_numeric($id)) {
                 $subs = Datoviviendanterdetalles::find(array(
                     'dva_id='.$id,
                     'dva_estatus=2'));

                 if ($subs) {
                    $result = $subs->toArray();
                 }
         }
        
        return $this->response->setJsonContent($result);
    }

    public function crear_formato_truperAction(){
        $this->view->disable();
        $answer=array();


        if ($this->request->isAjax()) {


            $data = $this->request->getPost();
     
            $nuevoRegistro = new Datoviviendanterdetalles();
            $respuesta_modelo = $nuevoRegistro->NuevoRegistro($data);


                            if($respuesta_modelo['estado']==2)
                             {
                           

                                $auth = $this->session->get('auth');            
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Registro un nuevo dato de vivienda, la clave de registro es: '.$respuesta_modelo['dva_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['dva_id'];
                                $databit['bit_modulo']="Datos de grupo familiar detalle";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente';
                                $answer['dav_id']=$respuesta_modelo['dav_id'];
                                $answer['dva_id']=$respuesta_modelo['dva_id'];


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

        }else{
            return http_response_code(400);

        }
    }

    public function tabla_truperAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $Datoviviendanterdetalles=new Builder();
            $Datoviviendanterdetalles=$Datoviviendanterdetalles
            ->addFrom('Datoviviendanterdetalles','dva')
            ->where('dgd_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $Datoviviendanterdetalles=new Builder();
                $Datoviviendanterdetalles=$Datoviviendanterdetalles
                ->addFrom('Datoviviendanterdetalles','dva')
                ->where('dav_id='.$id.' and dva_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de dato vivienda anterior que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Dato vivienda anterior";
        $bitacora->NuevoRegistro($databit);

            
        $this->view->object_datoviviendaanter=new Datoviviendanterdetalles();
        $this->view->object_datovivienda=new Datovivienda();

        $this->view->page=$Datoviviendanterdetalles;
    
    }

    public function eliminarAction($dva_id=0)
    {

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $dva_id!=0)
        {
                $dva =Datoviviendanterdetalles::findFirst( [
                    "dva_id = '$dva_id'",
                    "dva_estatus = '2'",
                ]);
                 $dva->dva_estatus='-2';
                if($dva->update())
                {
                                $auth = $this->session->get('auth');

                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Eliminó un Dato vivienda anterior detalles con clave interna '.$dva->dva_id;
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$dva->dva_id;
                                $databit['bit_modulo']="Dato vivienda anterior detalles.";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se eliminaron los datos correctamente del registro con ID '.$dva->dva_id;
                                $answer['dva_id']=$dva->dva_id;
                                $answer['dav_id']=$dva->dav_id;

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


    public function actualizar_formato_truperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $dva_id=$data['dva_id'];
                $buscar_datovivienda_anter =Datoviviendanterdetalles::findFirstBydva_id($dva_id);

                if($buscar_datovivienda_anter->dva_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_datovivienda_anter->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó datos de vivienda anterior, los datos  corresponden a la clave de registro es: '.$respuesta_modelo['dva_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['dva_id'];
                                    $databit['bit_modulo']="Datos vivienda anterior";
                                    $bitacora->NuevoRegistro($databit);
                                    
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente';
                                    $answer['dva_id']=$respuesta_modelo['dva_id'];
                                    $answer['dav_id']=$respuesta_modelo['dav_id'];

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
                    $answer['titular']='ERROR';
                    $answer['mensaje']='NO ESTA DISPONIBLE ESTE REGISTRO.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;    

                }

        }
       
    }

   

}