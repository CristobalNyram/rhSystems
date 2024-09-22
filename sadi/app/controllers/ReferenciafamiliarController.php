
<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";




class ReferenciafamiliarController extends ControllerBase
{

    public function eliminarAction($ref_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax() and $ref_id!=0 and is_numeric($ref_id))
        {
            $buscar_ref=Referenciafamiliar::findFirst($ref_id);
            if($buscar_ref->ref_estatus==2)
            {
                $buscar_ref->ref_estatus=-2;

                    if($buscar_ref->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= 'Eliminó una referencia familiar que tenía por clave interna: '.$buscar_ref->ref_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_ref->ref_id;
                        $databit['bit_modulo']="Referencia familiar.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se borraron los datos exitosamente del registro que tenía el ID '.$buscar_ref->ref_id;
                        $answer['ref_id']= $buscar_ref->ref_id;
                        $answer['sep_id']= $buscar_ref->sep_id;
                 
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

    public function tabla_truperAction($id){
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $referenciafamiliar=new Builder();
            $referenciafamiliar=$referenciafamiliar
            ->addFrom('Referenciafamiliar','ref')
            ->where('ref_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $referenciafamiliar=new Builder();
                $referenciafamiliar=$referenciafamiliar
                ->addFrom('Referenciafamiliar','ref')
                ->where('sep_id='.$id.' and ref_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de referencias familiares que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Referencia familiar;";
        $bitacora->NuevoRegistro($databit);

            
        $this->view->obj_seccion_personal =new Seccionpersonal();

        $this->view->page=$referenciafamiliar;
    }

    public function crear_formato_truperAction(){


        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $ref= new Referenciafamiliar() ;
         
            $respuesta_modelo= $ref->NuevoRegistroFormatoTruper($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia familiar la clave interna del registro '.$respuesta_modelo['ref_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['ref_id'];
                $databit['bit_modulo']="Referencia familiar";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['ref_id']=$respuesta_modelo['ref_id'];
                $answer['sep_id']=$respuesta_modelo['sep_id'];


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
    }


    public function ajax_get_detalleAction($ref_id=0){
        $this->view->disable();
        $answer=array();

        if ($ref_id!=0 && is_numeric($ref_id)) {
            $subs = Referenciafamiliar::findFirst(array(
                'ref_id='.$ref_id,
                'ref_estatus=2'));

                if ($subs->ref_estatus==2) {
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


    public function actualizar_formato_truperAction(){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
          
                $data = $this->request->getPost();
                $ref_id=$data['ref_id'];
                $buscar_ref=Referenciafamiliar::findFirst($ref_id);

                if($buscar_ref->ref_estatus!=-2)
                {

                    $respuesta_modelo = $buscar_ref->ActualizarRegistroFormatoTruper($data);
                                if($respuesta_modelo['estado']==2)
                                {
                            
                                
                                    $auth = $this->session->get('auth');            
                                    $bitacora= new Bitacora();
                                    $databit['bit_descripcion']= 'Editó una referencia familiar con la clave interna  del registro '.$respuesta_modelo['ref_id'];
                                    $databit['usu_id']=$auth['id'];
                                    $databit['bit_tablaid']=$respuesta_modelo['ref_id'];
                                    $databit['bit_modulo']="Referencia familiar";
                                    $bitacora->NuevoRegistro($databit);
                                   
                                    $answer[0]=2;
                                    $answer['titular']='Éxito';
                                    $answer['mensaje']='Se actualizaron los datos correctamente.';
                                    $answer['ref_id']=$respuesta_modelo['ref_id'];
                                    $answer['sep_id']=$respuesta_modelo['sep_id'];


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