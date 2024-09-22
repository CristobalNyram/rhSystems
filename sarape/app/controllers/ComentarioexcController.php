<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class ComentarioexcController extends ControllerBase
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
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Comentarioexc::find(array(
            "com_estatus=2"
            ));
        }
        else
        {
            $condicion='com_estatus=2 and exc_id='.$id;

            if($rol->verificar(42,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los comentarios propios
                $condicion.=' and usu_id='.$auth['id'];

        	$archivo=new Builder();
	        $archivo=$archivo
	        ->addFrom('Comentarioexc','com')
	        ->orderBy('com.com_fecharegistro DESC')
            ->where($condicion)
	        ->getQuery()
	        ->execute();

            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consultó los comentarios del expediente con ID interno: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;

            $databit['bit_modulo']="Comentarios expediente";
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
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$archivo = Comentarioexc::find(array(
            "com_estatus=2"
            ));
        }
        else
        {
            $condicion='com_estatus=2 and exc_id='.$id;
        	$archivo=new Builder();
	        $archivo=$archivo
	        ->addFrom('Comentarioexc','com')
	        ->orderBy('com.com_fecharegistro DESC')
            ->where($condicion)
	        ->getQuery()
	        ->execute();
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consultó los comentarios del estudio con ID interno: ".$id;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            //$databit['ese_id']=$id;
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
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
        	$exc=Expedientecan::findFirstByexc_id($data['exc_id']);
            $comentario= new Comentarioexc();
            
            $comentario->com_comentario= $data['comentario_nuevo'];
            $comentario->com_estatus= 2;
            $comentario->usu_id= $auth['id'];
            $comentario->exc_id= $data['exc_id'];
            $comentario->vista = isset($data['com_vista']) ?  $data['com_vista']:$comentario->getVistaTexto($exc->exc_estatus);
            $comentario->exc_estatus= $exc->exc_estatus;
            
            if($comentario->save())
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Agregó un comentario en el expediente candidato  con ID interno: ".$data['exc_id'];
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=0;
                $databit['bit_modulo']="Comentarios expediente can";
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                $answer[2]=$data['exc_id'];   
            }
            else
                $answer[0]=0;
        }
        else
        $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

    public function tabla_seguimientoAction($id=0)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion_sql="";
        $mensaje_bitacora="";
        $data = $this->request->getPost();
        $this->view->mensaje ="";

        try {
            $condicion_sql.="c.com_estatus=2 and com_seguimiento=1 ";
          //  error_log($id);
            if($id!=0)
                $condicion_sql.=" AND c.exc_id=$id";
            if($data["vista"]!=""){
               /// error_log($data["vista"]);
                $condicion_sql.=" AND c.exc_estatus=".$data["vista"];
            }else{
                 throw new Exception("FALTA UN PARÁMETRO -VISTA-");
                
            }

            $auth = $this->session->get('auth');
            $comentario = new Builder();
            $comentario = $comentario
                ->columns(array('c.com_id, c.com_comentario, CONCAT_WS(" ", usu_nombre, usu_primerapellido,usu_segundoapellido) as nombre, com_fecharegistro'))
                ->addFrom('Comentarioexc', 'c')
                ->join('Usuario', 'c.usu_id = u.usu_id', 'u');

            $comentario = $comentario->where($condicion_sql)->getQuery()->execute();

            $data_bit=[
                'bit_descripcion'=>'Consultó comentarios del exc_id'.$id." ".$mensaje_bitacora,
                'bit_tablaid'=>0,
                'bit_modulo'=>'Comentarios seguimiento',
                'vac_id'=>0,
                'bit_accion'=>4,
            ];

            $this->bitacora_registro($data_bit,$auth);
            $this->view->page = $comentario;
        } catch (\Exception $e) {

            $this->view->page = [];
            $this->view->mensaje = $e->getMessage();

            error_log( "Se produjo una excepción: " . $e->getMessage());
        }
    }
}