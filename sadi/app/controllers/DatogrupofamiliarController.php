<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";


class DatogrupofamiliarController extends ControllerBase
{
    public function ajax_get_detalleAction($id=0)
    {
        $this->view->disable();
        $result = [];
        $answer['estatus']=-2;

         if ($id!=0 && is_numeric($id)) {
                 $subs = Datogrupofamiliar::find(array(
                     'ese_id='.$id,
                     'dgf_estatus=2'));

                 if ($subs) {
                  
                    $answer['estatus']=2;
                    $result = $subs->toArray();
                 }
         }
        
        return $this->response->setJsonContent($result,$answer);
    }

    public function ajax_set_updateAction($id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $datosGrupoFamiliarBuscar =Datogrupofamiliar::find(array(
                    'ese_id='.$id,
                    'dgf_estatus=2'
                    ));
            if(empty($datosGrupoFamiliarBuscar[0]))
            {
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion=0;
                if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion=1;  
                }
                
                $nuevoRegistro=new Datogrupofamiliar();
                $repuesta_modelo =  $nuevoRegistro->NuevoRegistro($data,$id,$permisocalificacion);
                            if($repuesta_modelo['estado']==2)
                            {
                                $auth = $this->session->get('auth');

                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Se crearon nuevos datos de grupo familiar del estudio número '.$id.' el ID interno de datos de grupo familiar es '.$repuesta_modelo['dgf_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$repuesta_modelo['dgf_id'];
                                $databit['ese_id']=$id;
                                $databit['bit_modulo']="Datos de grupo familiar";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente';
                                $answer['ese_id']=$repuesta_modelo['ese_id'];
                                $answer['dgf_id']=$repuesta_modelo['dgf_id'];
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
            else
            {
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion=0;
                if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion=1;  
                }

                $actualizarRegistro= Datogrupofamiliar::findFirstByese_id($id);
                $repuesta_modelo =  $actualizarRegistro->ActualizarRegistro($data,$permisocalificacion);
                
            
                    if($repuesta_modelo['estado']==2)
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Actualizó los datos de grupo familiar del estudio número '.$id.' el ID  interno de datos de grupo familiar es '.$repuesta_modelo['dgf_id'];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$repuesta_modelo['dgf_id'];
                        $databit['bit_modulo']="Datos de grupo  familiar";
                        $databit['ese_id']=$id;
                        $bitacora->NuevoRegistro($databit);
                        
                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se actualizaron los datos correctamente';
                        $answer['ese_id']=$repuesta_modelo['dgf_id'];;
                        $answer['actualizo']=2;

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
    }
    public function tablaAction($id=0)
    {
   
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
                ->columns(array('dgd.dgd_id, dgd.dgd_nombre ,dgd.dgd_edad ,dgd.dgd_parentesco ,dgd.dgd_viveusted ,dgd.esc_id ,dgd.niv_id, e.esc_nombre, n.niv_nombre, dgd.dgd_viveusted'))
                ->addFrom('Datogrupofamiliardetalles','dgd')
                ->join('Estadocivil','e.esc_id=dgd.esc_id','e')
                ->join('Nivelestudio','n.niv_id=dgd.niv_id','n')
                ->where('dgf_id='.$id.' and dgd_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de grupo familiar que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Dato grupo familiar detalles";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$datogrupofamiliardetalles;
        $this->view->ObejectoNivelEstudio=new Nivelestudio();
        $this->view->ObejectoEstadoCivil=new Estadocivil();
     
    }
    public function eliminar_dgdAction($dgd_id=0)
    {

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $dgd_id!=0)
        {
                $dgd =Datogrupofamiliardetalles::findFirst( [
                    "dgd_id = '$dgd_id'",
                    "dgd_estatus = '2'",
                ]);
                 $dgd->dgd_estatus='-2';
                if($dgd->update())
                {
                                $auth = $this->session->get('auth');

                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Eliminó el detalle de grupo familiar con clave interna '.$dgd->dgd_id;
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$dgd->dgf_id;
                                $databit['bit_modulo']="Dato grupo familiar detalles.";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se eliminaron los datos correctamente del registro con ID '.$dgd->dgd_id;
                                $answer['dgf_id']=$dgd->dgf_id;

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
    public function actualizar_dgdAction()
    {

                $this->view->disable();
                $answer=array();
                if($this->request->isAjax())
                {
                  
                        $data = $this->request->getPost();
                        $dgd_id=$data['dgd_dgd_id_editar'];
                        $BuscardatosDatogrupofamiliardetalles =Datogrupofamiliardetalles::findFirstBydgd_id($dgd_id);

                        if($BuscardatosDatogrupofamiliardetalles->dgd_estatus!=-2)
                        {

                            $respuesta_modelo = $BuscardatosDatogrupofamiliardetalles->ActualizarRegistro($data);
                                        if($respuesta_modelo['estado']==2)
                                        {
                                    
                                        
                                            $auth = $this->session->get('auth');            
                                            $bitacora= new Bitacora();
                                            $databit['bit_descripcion']= 'Editó una referencia familiar, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
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
    public function crear_dgdAction()
    {

        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $nuevoRegistro = new Datogrupofamiliardetalles();
            $respuesta_modelo = $nuevoRegistro->NuevoRegistro($data);
                            if($respuesta_modelo['estado']==2)
                             {
                           

                                $auth = $this->session->get('auth');            
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Registro una nueva referencia familiar, los datos de la referencia familiar la clave de registro es: '.$respuesta_modelo['dgd_id'];
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
    public function crear_automatico_dgfAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();

        if($ese_id!=0)
        {
             
                            $registro_automatico= new Datogrupofamiliar();
                            $registro_automatico->ese_id=$ese_id;
                            $registro_automatico->dgf_calificacion=null;
                            $registro_automatico->dgf_matrimoniopadres=null;

                            $registro_automatico->dgf_estatus=2;
                            
                            if($registro_automatico->save())
                            {   
        
                                
                                $answer[0]=2;
                                $answer['ese_id']=$registro_automatico->ese_id;
                                $answer['dgf_id']=$registro_automatico->dgf_id;
                                

                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    

                            }
                            else
                            {
                                $answer[0]=0;
                                $answer['ese_id']=$registro_automatico->ese_id;
                                $answer['dgf_id']=$registro_automatico->dgf_id;
                                

                                $this->response->setJsonContent($answer);
                                $this->response->send(); 
                                return;    
                            }
                
        }            
    }

    public function crear_registro_automatico_otras_tablasAction($ese_id)
    {
        
        $this->view->disable();
        $answer=array();

            if($this->request->isAjax())
            {
                $estudio= Estudio::findFirstByese_id($ese_id);

                if(true)
                {
                    $data = $this->request->getPost();
               
                    //antecedentes de grupo familiar
                    $modelo_antecedentes_grupofa= new Antecedentegrupofamiliardetalles();
                    $repuesta_modelo_adgf =$modelo_antecedentes_grupofa->RegistroAutomaticoCargado($data,$ese_id);
                
                    
                     // situacion eco ingresos
                     $modelo_sei= new Situacioneconomicaingresos();
                     $repuesta_modelo_sei =$modelo_sei->RegistroAutomaticoCargado($data,$ese_id);
                   
                    //bienes inmuebles
                    $modelo_bid= new Bieninmuebledetalles();
                    $repuesta_modelo_bid =$modelo_bid->RegistroAutomaticoCargado($data,$ese_id);
                 
                   

                    if($repuesta_modelo_bid['estado']==2 && $repuesta_modelo_sei['estado']==2 && $repuesta_modelo_adgf['estado']==2)
                    {

                        $auth = $this->session->get('auth');            
                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Realizo registros automaticos  a otras tablas.';
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$ese_id;
                        $databit['bit_modulo']="Datos de grupo familiar detalle -registro automatico";
                        $bitacora->NuevoRegistro($databit);
                        
                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se guardaron los datos automáticos correctamente';
                 

                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;    

                    }
                
                }
                else
                {
                    $answer[0]=-2;
                    $answer['titular']='ERROR';
                    $answer['mensaje']='No esta disponible este estudio.';
                    $this->response->setJsonContent($answer);
                    $this->response->send(); 
                    return;   
                }
                
            }



    }
    
    public function tablagabtubosAction($id=0)
    {
   
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
                ->columns(array('dgd.dgd_id, dgd.dgd_nombre ,dgd.dgd_edad ,dgd.dgd_parentesco ,dgd.dgd_viveusted ,dgd.esc_id ,dgd.niv_id, e.esc_nombre, n.niv_nombre, dgd.dgd_viveusted'))
                ->addFrom('Datogrupofamiliardetalles','dgd')
                ->join('Estadocivil','e.esc_id=dgd.esc_id','e')
                ->join('Nivelestudio','n.niv_id=dgd.niv_id','n')
                ->where('dgf_id='.$id.' and dgd_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de grupo familiar que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Dato grupo familiar detalles";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$datogrupofamiliardetalles;
        $this->view->ObejectoNivelEstudio=new Nivelestudio();
        $this->view->ObejectoEstadoCivil=new Estadocivil();
     
    }

    public function ajax_set_update_formato_truperAction($ese_id=0){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $datosGrupoFamiliarBuscar =Datogrupofamiliar::find(array(
                    'ese_id='.$ese_id,
                    'dgf_estatus=2'
                    ));
            if(empty($datosGrupoFamiliarBuscar[0]))
            {
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion=0;
                if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion=1;  
                }
                
                $nuevoRegistro=new Datogrupofamiliar();
                $repuesta_modelo =  $nuevoRegistro->NuevoRegistro($data,$ese_id,$permisocalificacion);
                            if($repuesta_modelo['estado']==2)
                            {
                                $auth = $this->session->get('auth');

                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Se crearon nuevos datos de grupo familiar del estudio número '.$ese_id.' el ID interno de datos de grupo familiar es '.$repuesta_modelo['dgf_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$repuesta_modelo['dgf_id'];
                                $databit['bit_modulo']="Datos de grupo familiar";
                                $bitacora->NuevoRegistro($databit);
                                
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente';
                                $answer['ese_id']=$repuesta_modelo['ese_id'];
                                $answer['dgf_id']=$repuesta_modelo['dgf_id'];
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
            else
            {
                $auth = $this->session->get('auth');
                $rol = new Rol();
                $permisocalificacion=0;
                if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                {
                    $permisocalificacion=1;  
                }

                $actualizarRegistro= Datogrupofamiliar::findFirstByese_id($id);
                $repuesta_modelo =  $actualizarRegistro->ActualizarRegistro($data,$permisocalificacion);
                
            
                    if($repuesta_modelo['estado']==2)
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Actualizó los datos de grupo familiar del estudio número '.$ese_id.' el ID  interno de datos de grupo familiar es '.$repuesta_modelo['dgf_id'];
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$repuesta_modelo['dgf_id'];
                        $databit['bit_modulo']="Datos de grupo  familiar";
                        $bitacora->NuevoRegistro($databit);
                        
                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se actualizaron los datos correctamente';
                        $answer['ese_id']=$repuesta_modelo['dgf_id'];;
                        $answer['actualizo']=2;

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

    }


    public function actualizar_formato_truperAction($id){


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

            $actualizarRegistro= Datogrupofamiliar::findFirstByese_id($id);
            $repuesta_modelo =  $actualizarRegistro->ActualizarRegistroFormatoTruper($data,$permisocalificacion);
            
    
            if($repuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Actualizó los datos de grupo familiar del estudio número '.$id.' el ID  interno de datos de grupo familiar es '.$repuesta_modelo['dgf_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$repuesta_modelo['dgf_id'];
                $databit['bit_modulo']="Datos de grupo  familiar";
                $bitacora->NuevoRegistro($databit);
                
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se actualizaron los datos correctamente';
                $answer['ese_id']=$repuesta_modelo['dgf_id'];;
                $answer['actualizo']=2;

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


    
   
}
