<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class DatogrupofamiliardetallesController extends ControllerBase
{

    public function ajax_get_detalleAction($dgd_id=0)
    {
        $this->view->disable();
        $answer=array();

        if ($dgd_id!=0 && is_numeric($dgd_id)) {
            $subs = Datogrupofamiliardetalles::findFirst(array(
                'dgd_id='.$dgd_id,
                'dgd_estatus=2'));

                if ($subs->dgd_estatus==2) {
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

    public function viven_tabla_truperAction($id=0){

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $datogrupofamiliardetalles=new Builder();
            $datogrupofamiliardetalles=$datogrupofamiliardetalles
            ->addFrom('Datogrupofamiliardetalles','dgd')
            ->where('dgd_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $datogrupofamiliardetalles=new Builder();
                $datogrupofamiliardetalles=$datogrupofamiliardetalles
              /*  ->columns(array('
                    dgd.dgd_id, dgd.dgd_nombre 
                    ,dgd.dgd_edad ,dgd.dgd_parentesco 
                    ,dgd.dgd_viveusted ,dgd.esc_id ,dgd.niv_id, e.esc_nombre
                    ,n.niv_nombre, dgd.dgd_viveusted
                    ,dgd.dgd_ocupacion,dgd.dgd_puesto
                    ,dgd.dgd_empresa,dgd.dgd_telefono
                    ,dgd.dgd_estatucontacto,dgd.dgd_telefono

                    '))*/
                ->addFrom('Datogrupofamiliardetalles','dgd')
                ->where('dgf_id='.$id.' and dgd_estatus=2 and dgd_viveusted>=0')

                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de grupo familiar que viven o no viven con el candidato y que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Dato grupo familiar detalles";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$datogrupofamiliardetalles;
        $this->view->ObejectoNivelEstudio=new Nivelestudio();
        $this->view->ObejectoDatoGrupoFamiliar=new Datogrupofamiliardetalles();

    }

    public function trabajancompania_tabla_truperAction($id=0){

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $datogrupofamiliardetalles=new Builder();
            $datogrupofamiliardetalles=$datogrupofamiliardetalles
            ->addFrom('Datogrupofamiliardetalles','dgd')
            ->where('dgd_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $datogrupofamiliardetalles=new Builder();
                $datogrupofamiliardetalles=$datogrupofamiliardetalles
                // ->columns(
                //     array('
                //     dgd.dgd_id, dgd.dgd_nombre 
                //    ,dgd.dgd_parentesco ,dgd.dgd_puesto 
                //    ,dgd.dgd_area ,dgd.dgd_telefono
                //    '))
                ->addFrom('Datogrupofamiliardetalles','dgd')
                ->where('dgf_id='.$id.' and dgd_estatus=2 and dgd_trabajanenlacompania=1')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de grupo familiar que trabajan en la compañia y tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Dato grupo familiar detalles";
        $bitacora->NuevoRegistro($databit);

            
        $this->view->ObejectoDatoGrupoFamiliar=new Datogrupofamiliardetalles();

        $this->view->page=$datogrupofamiliardetalles;
     
    }

    public function negociootrabajoen_tabla_truperAction($id=0){

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $datogrupofamiliardetalles=new Builder();
            $datogrupofamiliardetalles=$datogrupofamiliardetalles
            ->addFrom('Datogrupofamiliardetalles','dgd')
            ->where('dgd_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $datogrupofamiliardetalles=new Builder();
                $datogrupofamiliardetalles=$datogrupofamiliardetalles
                /*->columns(
                array('
                      dgd.dgd_id, dgd.dgd_nombre 
                     ,dgd.dgd_parentesco ,dgd.dgd_puesto 
                     ,dgd.dgd_area ,dgd.dgd_telefono
                     '))*/
                ->addFrom('Datogrupofamiliardetalles','dgd')
                ->where('dgf_id='.$id.' and dgd_estatus=2 and dgd_trabajaotienenegocio=1')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de grupo familiar de familiares que tienen negocio o trabajan en el el rubro FERRETERO que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Dato grupo familiar detalles";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$datogrupofamiliardetalles;
        $this->view->ObejectoDatoGrupoFamiliar=new Datogrupofamiliardetalles();

    }

    public function ajax_get_data_selects_estatucscontactoAction(){
        
            $this->view->disable();
            $answer=[];
            if($this->request->isAjax()){
                                    $modelo= new Datogrupofamiliardetalles();
                                    $answer['estatuscontacto_data']=$modelo->dgd_estatucontacto_selects_values;           
                                    $this->response->setJsonContent($answer);
                                    $this->response->send(); 
                                    return;    
            }     
            else{
                return http_response_code(400);
            } 
    }

    public function crear_vivecon_formatotruperAction(){


        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $nuevoRegistro = new Datogrupofamiliardetalles();
            $respuesta_modelo = $nuevoRegistro->NuevoRegistroViveConFormatoTruper($data);
                            if($respuesta_modelo['estado']==2)
                             {
                           

                                $auth = $this->session->get('auth');            
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Registro una nueva referencia familiar de vive con o no vive con el candidato, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['dgd_id'];
                                $databit['bit_modulo']="Datos de grupo familiar detalle";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente';
                                $answer['dgf_id']=$respuesta_modelo['dgf_id'];

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

    }

    public function actualizar_vivecon_formatotruperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $dgd_id=$data['dgd_id'];
                $BuscardatosDatogrupofamiliardetalles =Datogrupofamiliardetalles::findFirstBydgd_id($dgd_id);

                if($BuscardatosDatogrupofamiliardetalles->dgd_estatus!=-2)
                {

                    $respuesta_modelo = $BuscardatosDatogrupofamiliardetalles->ActualizarRegistroViveConFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia familiar de familiar vive o no vive con el candidato, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['dgd_id'];
                                    $databit['bit_modulo']="Datos de grupo familiar detalle";
                                    $bitacora->NuevoRegistro($databit);
                                    
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente';
                                    $answer['dgf_id']=$respuesta_modelo['dgf_id'];
                                    
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


    public function crear_trabajancompania_formatotruperAction(){


        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $nuevoRegistro = new Datogrupofamiliardetalles();
            $respuesta_modelo = $nuevoRegistro->NuevoRegistroViveConFormatoTrabajanCompaniaTruper($data);
                            if($respuesta_modelo['estado']==2)
                             {
                           

                                $auth = $this->session->get('auth');            
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Registro una nueva referencia familiar que trabaja en la misma empresa del candadidato, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['dgd_id'];
                                $databit['bit_modulo']="Datos de grupo familiar detalle";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente';
                                $answer['dgf_id']=$respuesta_modelo['dgf_id'];

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

    }


    public function actualizar_trabacompania_formatotruperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $dgd_id=$data['dgd_id'];
                $BuscardatosDatogrupofamiliardetalles =Datogrupofamiliardetalles::findFirstBydgd_id($dgd_id);

                if($BuscardatosDatogrupofamiliardetalles->dgd_estatus!=-2)
                {

                    $respuesta_modelo = $BuscardatosDatogrupofamiliardetalles->ActualizarRegistroTrabajanCompaniaTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia familiar de familiar que trabaja en la misma empresa del candidato, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['dgd_id'];
                                    $databit['bit_modulo']="Datos de grupo familiar detalle";
                                    $bitacora->NuevoRegistro($databit);
                                    
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente';
                                    $answer['dgf_id']=$respuesta_modelo['dgf_id'];
                                    
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

    public function crear_negociootrabajoen_formatotruperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $nuevoRegistro = new Datogrupofamiliardetalles();
            $respuesta_modelo = $nuevoRegistro->NuevoRegistroNegociOTrabajoEnTruper($data);
                            if($respuesta_modelo['estado']==2)
                             {
                           

                                $auth = $this->session->get('auth');            
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Registro una nueva referencia familiar que trabajá en el rubro FERRETERO o tiene empresa en el rubro, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['dgd_id'];
                                $databit['bit_modulo']="Datos de grupo familiar detalle";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente';
                                $answer['dgf_id']=$respuesta_modelo['dgf_id'];

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

    }


    public function actualizar_negociootrabajoen_formatotruperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $dgd_id=$data['dgd_id'];
                $BuscardatosDatogrupofamiliardetalles =Datogrupofamiliardetalles::findFirstBydgd_id($dgd_id);

                if($BuscardatosDatogrupofamiliardetalles->dgd_estatus!=-2)
                {

                    $respuesta_modelo = $BuscardatosDatogrupofamiliardetalles->ActualizarRegistroNegociOTrabajoEnTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia familiar que trabaja en el rubro FERRETERO o que tiene negocio, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['dgd_id'];
                                    $databit['bit_modulo']="Datos de grupo familiar detalle";
                                    $bitacora->NuevoRegistro($databit);
                                    
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente';
                                    $answer['dgf_id']=$respuesta_modelo['dgf_id'];
                                    
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

    public function ajax_get_data_parentesco_formatotruperAction(){

        $this->view->disable();
        $answer=[];
        if($this->request->isAjax()){

                                $modelo= new Datogrupofamiliardetalles();
                                $answer['parentesco_data']=$modelo->dgd_parentesto_formatotruper;
                                
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
        }     
        else{
            return http_response_code(400);
        } 
    }

    public function ajax_get_data_ocupacion_formatotruperAction(){

        $this->view->disable();
        $answer=[];
        if($this->request->isAjax()){

                                $modelo= new Datogrupofamiliardetalles();
                                $answer['ocupacion_data']=$modelo->ocupacion_formatotruper;
                                
                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
        }     
        else{
            return http_response_code(400);
        } 
    }

  
}
