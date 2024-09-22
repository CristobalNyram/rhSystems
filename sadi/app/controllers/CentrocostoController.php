<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class CentrocostoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Centro de costo');
        parent::initialize();
    }

	public function tablaAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$centro = Centrocosto::find(array(
            "cen_estatus=2"
            ));
        }
        else
        {
        	$centro=new Builder();
	        $centro=$centro
	        ->addFrom('Centrocosto','c')
	        ->where('cen_estatus=2 and emp_id='.$id)
	        ->getQuery()
	        ->execute();
        }
        // $this->view->porpagar=$porpagar;
        $this->view->page=$centro;
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
            $centro=Centrocosto::findFirstBycen_id($clave);
            if($centro)
            {
                $answer[0]=1;
                $answer[1]=$centro->cen_id;
                $answer[2]=$centro->cen_nombre;
                $answer[3]=$centro->cen_clave;
                $answer[4]=$centro->cen_correo;
                $answer[5]=$centro->cen_tel;
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
            $contacto=Centrocosto::findFirstBycen_id($clave);
            // $this->db->begin();
            // $data = $this->request->getPost();
            if($contacto)
            {
                // echo $trabajador->tra_nombre;
                $contacto->cen_clave=$data["cen_claveeditar"];
                $contacto->cen_nombre=$data["cen_nombreeditar"];
                $contacto->cen_correo=$data["cen_correoeditar"];
                $contacto->cen_tel=$data["cen_teleditar"];                
                
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
            $centro= new Centrocosto();
            $centro->emp_id= $data['emp_idcrearcentro'];
            $centro->cen_nombre= $data['cen_nombre'];
            $centro->cen_tel= $data['cen_tel'];
            $centro->cen_clave= $data['cen_clave'];
            $centro->cen_correo= $data['cen_correo'];
            $centro->cen_estatus= 2;

            if($centro->save())
            {
                $answer[0]=1;
                $answer[2]=$data['emp_idcrearcentro'];
            }
            else
                $answer[0]=0;
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function ajax_centrosAction($id)
    {
        $result = [];
        $subs = Centrocosto::find(array(
            "cen_estatus=2 and emp_id=".$id
            ));
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
}