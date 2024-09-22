<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class AntecedentegrupofamiliarController extends ControllerBase
{
    public function ajax_get_detalleAction($id=0)
    {
        $this->view->disable();
        $result = [];

         if ($id!=0 && is_numeric($id)) {
                 $subs = Antecedentegrupofamiliar::findFirst(array(
                     'ese_id='.$id,
                     'agf_estatus=2'));

                 if ($subs) {
                    $result = $subs->toArray();
                 }
         }
        
        return $this->response->setJsonContent($result);
    }
    public function crear_automatico_agfAction ($ese_id=0)
    {
        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && is_numeric($ese_id))
        {
            $buscarEseId=Antecedentegrupofamiliar::findFirst(array(
                "ese_id = '$ese_id'",
                'agf_estatus=2'
            ));

            if($buscarEseId==false)
            {
                $nuevo_agf= new Antecedentegrupofamiliar();
                $nuevo_agf->agf_estatus=2;
                $nuevo_agf->ese_id=$ese_id;

                if($nuevo_agf->save())
                {
                    $answer[0]=2;
                    $answer['ese_id']=$ese_id;
                    $answer['agf_id']=$nuevo_agf->agf_id;
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


    public function ajax_set_updateAction($ese_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
        {
            $data = $this->request->getPost();
           

            $agf_registro= Antecedentegrupofamiliar::findFirst(array(
                "ese_id = '$ese_id'",
                'agf_estatus=2',
            ));

                if($agf_registro)
                {
                    $auth = $this->session->get('auth');
                    $rol = new Rol();
                    $permisocalificacion=0;
                    if($rol->verificar(40,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
                    {
                        $permisocalificacion=1;  
                    }
               
                   
                    $respuesta_modelo= $agf_registro->ActualizarRegistro($data,$permisocalificacion);


                            if( $respuesta_modelo['estado']==2)
                            {
                               
                                $bitacora= new Bitacora();
                                $databit['bit_descripcion']= 'Guardó los datos de antecedentes de grupo familiar del registro con clave interna:'.$respuesta_modelo['agf_id'].' del estudio No. '.$respuesta_modelo['ese_id'];
                                $databit['usu_id']=$auth['id'];
                                $databit['bit_tablaid']=$respuesta_modelo['agf_id'];
                                $databit['bit_modulo']="Antecedente grupo familiar";
                                $databit['ese_id']= $respuesta_modelo['ese_id'];
                                $bitacora->NuevoRegistro($databit);
                               
                                $answer[0]=2;
                                $answer['titular']='Éxito';
                                $answer['mensaje']='Se guardaron los datos correctamente.';
                                $answer['ese_id']=$respuesta_modelo['ese_id'];
                                $answer['agf_id']=$respuesta_modelo['agf_id'];
                              
                               
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
    
    

    public function tabla_agfAction($id=0)
    {
   
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($id==0)
        {
            $antecedentegrupofamiliardetalles=new Builder();
            $antecedentegrupofamiliardetalles=$antecedentegrupofamiliardetalles
            ->addFrom('Antecedentegrupofamiliardetalles','agd')
            ->where('agd_estatus=2')
            ->getQuery()
            ->execute();
        }
        else
        {
    
                $antecedentegrupofamiliardetalles=new Builder();
                $antecedentegrupofamiliardetalles=$antecedentegrupofamiliardetalles
                ->addFrom('Antecedentegrupofamiliardetalles','agd')
                ->where('agf_id='.$id.' and agd_estatus=2')
                ->getQuery()
                ->execute();
        }
        
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los detalles de antecedentes de grupo familiar que tiene por clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Antecedente grupo familiar detalles";
        $bitacora->NuevoRegistro($databit);

            
        
        $this->view->page=$antecedentegrupofamiliardetalles;
       
     
    }
    public function crear_agdAction()
    {
        
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $agfd= new Antecedentegrupofamiliardetalles ;
            $respuesta_modelo= $agfd->NuevoRegistro($data);

            if($respuesta_modelo['estado']==2)
            {
                $auth = $this->session->get('auth');

                
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= 'Registró una referencia familiar laboral con la clave interna No.'.$respuesta_modelo['agd_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$respuesta_modelo['agd_id'];
                $databit['bit_modulo']="Antecedente grupo familiar detalle";
                $bitacora->NuevoRegistro($databit);
               
                $answer[0]=2;
                $answer['titular']='Éxito';
                $answer['mensaje']='Se guardaron los datos correctamente.';
                $answer['agf_id']=$respuesta_modelo['agf_id'];
                $answer['agd_id']=$respuesta_modelo['agd_id'];
            
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    

            }
            else
            {

            }
            return json_encode($data);
        }
    }

}