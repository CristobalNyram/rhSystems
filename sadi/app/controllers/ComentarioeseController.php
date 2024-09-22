<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class ComentarioeseController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Comentario');
        parent::initialize();
    }
    
    public function tabla_visualizarAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(16,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Comentarioese::find(array(
            "com_estatus=2"
            ));
        }
        else
        {
            $condicion='com_estatus=2 and ese_id='.$id;

            if($rol->verificar(42,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los comentarios propios
            {
                $condicion.=' and usu_id='.$auth['id'];

            }

        	$archivo=new Builder();
	        $archivo=$archivo
	        ->addFrom('Comentarioese','com')
	        ->orderBy('com.com_fecharegistro DESC')
            ->where($condicion)
	        ->getQuery()
	        ->execute();

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consultó los comentarios del estudio con ID interno: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['ese_id']=$id;

            $databit['bit_modulo']="Comentarios estudios";
            $bitacora->NuevoRegistro($databit);
        	// $recibo = Recibo::find(array(
         //    "rec_estatus<=3 and pol_id=".$id." and rec_estatus>=1"
         //    ));
            
        }
        // $this->view->porpagar=$porpagar;
        $this->user = new Usuario();
        $this->view->user = $this->user;
        $this->view->page=$archivo;
    }

    public function tablaAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(16,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Comentarioese::find(array(
            "com_estatus=2"
            ));
        }
        else
        {
            $condicion='com_estatus=2 and ese_id='.$id;

            if($rol->verificar(42,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los comentarios propios
            {
                $condicion.=' and usu_id='.$auth['id'];

            }

        	$archivo=new Builder();
	        $archivo=$archivo
	        ->addFrom('Comentarioese','com')
	        ->orderBy('com.com_fecharegistro DESC')
            ->where($condicion)
	        ->getQuery()
	        ->execute();

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consultó los comentarios del estudio con ID interno: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['ese_id']=$id;

            $databit['bit_modulo']="Comentarios estudios";
            $bitacora->NuevoRegistro($databit);
        	// $recibo = Recibo::find(array(
         //    "rec_estatus<=3 and pol_id=".$id." and rec_estatus>=1"
         //    ));
            
        }
        // $this->view->porpagar=$porpagar;
        $this->user = new Usuario();
        $this->view->user = $this->user;
        $this->view->page=$archivo;
    }

    public function crearAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        // 
        if(!$rol->verificar(17,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->view->disable();
            // $this->response->redirect('index/errorpermiso');
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer);
            $this->response->send(); 
            return;
        }
        // $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
        	$estudio=Estudio::findFirstByese_id($data['ese_idcomentario']);
        	// $auth = $this->session->get('auth');
            
            $comentario= new Comentarioese();
            $comentario->com_comentario= $data['comentario_nuevo'];
            $comentario->com_estatus= 2;
            $comentario->usu_id= $auth['id'];
            $comentario->ese_id= $data['ese_idcomentario'];
            $comentario->ese_estatus= $estudio->ese_estatus;
            
            if($comentario->save())
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó un comentario en el estudio con ID interno: ".$data['ese_idcomentario'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Comentarios estudios";
                $databit['ese_id']=$data['ese_idcomentario'];

                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                $answer[2]=$data['ese_idcomentario'];
            }
            else
                $answer[0]=0;
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }


}