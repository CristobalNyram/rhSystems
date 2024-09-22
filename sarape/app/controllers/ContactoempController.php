<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class ContactoempController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Contacto empresa');
        parent::initialize();
    }

	public function tablaAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$contacto = Contactoemp::find(array(
            "cne_estatus=2"
            ));
        }
        else
        {
        	$contacto=new Builder();
	        $contacto=$contacto
	        // ->columns(array('c.cur_nombre'))
	        ->addFrom('Contactoemp','c')
	        // ->join('Curso','c.cur_id=cuo.cur_id','c')
	        // ->join('Empresa','e.emp_id=cuo.emp_id','e')
	        ->where('cne_estatus=2 and emp_id='.$id)
	        // ->orderBy('rec_serierecibo asc')
	        ->getQuery()
	        ->execute();
        	
            
        }
        // $this->view->porpagar=$porpagar;
        $this->view->page=$contacto;
    }
    
    // public function tabladetallescontactoAction($id=0)
    // {
    //     $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    //     // $porpagar=0;
    //     if($id==0)
    //     {
    //         $contacto = Contactocli::find(array(
    //         "cnc_estatus<=2 and cnc_estatus>=1"
    //         ));
    //     }
    //     else
    //     {
    //         $contacto=new Builder();
    //         $contacto=$contacto
    //         // ->columns(array('c.cur_nombre'))
    //         ->addFrom('Contactocli','c')
    //         // ->join('Curso','c.cur_id=cuo.cur_id','c')
    //         // ->join('Empresa','e.emp_id=cuo.emp_id','e')
    //         ->where('cnc_estatus<=2  and cnc_estatus>=1 and cli_id='.$id)
    //         // ->orderBy('rec_serierecibo asc')
    //         ->getQuery()
    //         ->execute();
            
            
    //     }
    //     // $this->view->porpagar=$porpagar;
    //     $this->view->page=$contacto;
    // }

    public function buseditarAction($clave=0)
    {
        $answer=array();
        $this->view->disable();
        if($this->request->isAjax()&&$clave>0)
        {
            $contacto=Contactoemp::findFirstBycne_id($clave);
            if($contacto)
            {
                $answer[0]=1;
                $answer[1]=$contacto->cne_id;
                $answer[2]=$contacto->cne_nombre;
                $answer[3]=$contacto->cne_primerapellido;
                $answer[4]=$contacto->cne_segundoapellido;
                $answer[5]=$contacto->cne_puesto;
                $answer[6]=$contacto->cne_celular;
                $answer[7]=$contacto->cne_tel;
                $answer[8]=$contacto->cne_ext;
                $answer[9]=$contacto->cne_correo;
                $answer[10]=$contacto->cne_copiaenvio;
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
            $contacto=Contactoemp::findFirstBycne_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            if($contacto)
            {
                // echo $trabajador->tra_nombre;
                $contacto->cne_nombre=$data["cne_nombreeditar"];
                $contacto->cne_primerapellido=$data["cne_primerapellidoeditar"];
                $contacto->cne_segundoapellido=$data["cne_segundoapellidoeditar"];
                $contacto->cne_puesto=$data["cne_puestoeditar"];
                $contacto->cne_celular=$data["cne_celulareditar"];
                $contacto->cne_tel=$data["cne_teleditar"];
                $contacto->cne_ext=$data["cne_exteditar"];
                $contacto->cne_correo=$data["cne_correoeditar"];
                $contacto->cne_copiaenvio=$data["cne_copiaenvioeditar"];
                
                if($contacto->save())
                {
                    $answer[0]=1;
                    $answer[2]=$contacto->emp_id;
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
            $contacto= new Contactoemp();
            $contacto->emp_id= $data['emp_idcrear'];
            $contacto->cne_nombre= $data['cne_nombre'];
            $contacto->cne_primerapellido= $data['cne_primerapellido'];
            $contacto->cne_segundoapellido= $data['cne_segundoapellido'];
            $contacto->cne_puesto= $data['cne_puesto'];
            $contacto->cne_celular= $data['cne_celular'];
            $contacto->cne_tel= $data['cne_tel'];
            $contacto->cne_ext= $data['cne_ext'];
            $contacto->cne_correo= $data['cne_correo'];
            $contacto->cne_copiaenvio=$data["cne_copiaenvio"];
            $contacto->cne_estatus= 2;

            if($contacto->save())
            {
                $answer[0]=1;
                $answer[2]=$data['emp_idcrear'];
            }
            else
                $answer[0]=0;
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;


    }

    public function ajax_contactosAction($id)
    {
        $result = [];
        $subs = Contactoemp::find(array(
            "cne_estatus=2 and emp_id=".$id
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }

    public function ajax_get_detalle_unoAction($id=1)
    {
        $result = [];
        $subs = Contactoemp::find(array(
            "cne_estatus=2 and cne_id=".$id
            ));
            
        if ($subs) 
            $result = $subs->toArray();
        

        return $this->response->setJsonContent($result);
        die();
    }
}