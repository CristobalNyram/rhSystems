<?php
use Phalcon\Crypt;

class RepresentanteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Representante');
        parent::initialize();
        
    }

    public function buseditarAction($clave=0)
    {
        $answer=array();
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $representante=Representante::findFirstByrep_id($clave);
            if($representante)
            {
                $answer[0]=1;
                $answer[1]=$representante->rep_nombre;
                $answer[2]=$representante->rep_primerapellido;
                $answer[3]=$representante->rep_segundoapellido;
            }
            else
            {
                $answer[0]=-1;    
            }
            
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        
    }

    public function editarAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $data = $this->request->getPost();
            $representante=Representante::findFirstByrep_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            if($representante)
            {
                // echo $trabajador->tra_nombre;
                $representante->rep_nombre=$data["rep_nombre"];
                $representante->rep_primerapellido=$data["rep_primerapellido"];
                $representante->rep_segundoapellido=$data["rep_segundoapellido"];
                if($representante->save())
                {
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Editó el representante con id ".$clave;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$clave;

                    $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                }
                else
                {
                    $answer[0]=0;
                    // $this->db->rollback();
                }

            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function crearAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $representante= new Representante();

            $representante->rep_nombre=$data["rep_nombrec"];
            $representante->rep_primerapellido=$data["rep_primerapellidoc"];
            $representante->rep_segundoapellido=$data["rep_segundoapellidoc"];
            $representante->rep_tipo=$data["tipocrear"];

            if($representante->save())
            {
                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Creó un representante";
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $bitacora->NuevoRegistro($databit);

                $empresa=Empresa::findFirstByemp_id($data["emp_idcrear"]);
                if($data["tipocrear"]==1)
                {
                    $empresa->rep_idlegal=$representante->rep_id;
                }else
                    $empresa->rep_idtra=$representante->rep_id;
                
                if($empresa->save()){
                    $answer[0]=1;
                }else
                    $answer[0]=0;             
            }
            else
            {
                $answer[0]=0;
                // $this->db->rollback();
            }
            

            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function crearcentroAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $representante= new Representante();

            $representante->rep_nombre=$data["rep_nombrec"];
            $representante->rep_primerapellido=$data["rep_primerapellidoc"];
            $representante->rep_segundoapellido=$data["rep_segundoapellidoc"];
            $representante->rep_tipo=$data["tipocrear"];

            if($representante->save())
            {
                $centro=Centrotrabajo::findFirstBycen_id($data["cen_idcrear"]);
                if($data["tipocrear"]==1)
                {
                    $centro->rep_idlegal=$representante->rep_id;
                }else
                    $centro->rep_idtra=$representante->rep_id;
                
                if($centro->save()){

                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Asignó un representante al centro de trabajo ".$data["cen_idcrear"];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$data["cen_idcrear"];
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=1;
                }else
                    $answer[0]=0;             
            }
            else
            {
                $answer[0]=0;
                // $this->db->rollback();
            }
            

            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    

    


    /**
     * [eliminarAction Elimina (estatus=-1) un registro de la tabla pais]
     * @param        []
     * @return []    []
     */
    public function eliminarAction($id,$tipo)
    {
        // $are = new Areatematica();
        $auth = $this->session->get('auth');
        // if(!$are->verificar(40,$auth['pue_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $empresa = Empresa::findFirstByemp_id($id);
        if (!$empresa) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        if($tipo==1)
        {
            $empresa->rep_idlegal = null;
        }
        if($tipo==2)
        {
            $empresa->rep_idtra = null;
        }
        
        if ($empresa->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function eliminarcentroAction($id,$tipo)
    {
        
        $auth = $this->session->get('auth');
       
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        $centro = Centrotrabajo::findFirstBycen_id($id);
        if (!$centro) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
            
        }
        if($tipo==1)
        {
            $centro->rep_idlegal = null;
        }
        if($tipo==2)
        {
            $centro->rep_idtra = null;
        }
        
        if ($centro->save() == false) {
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }

        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Eliminó el representante del centro de trabajo".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $bitacora->NuevoRegistro($databit);

        $answer[0]=1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

}