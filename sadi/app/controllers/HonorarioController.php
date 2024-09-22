<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class HonorarioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Honorarios');
        parent::initialize();
        
    }

    public function tablaAction($id=0)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(21,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
            return;
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // $porpagar=0;
        if($id==0)
        {
        	$honorarios = Usuariotipoest::find(array(
            "ute_estatus=2"
            ));
        }
        else
        {
        	$honorarios=new Builder();
	        $honorarios=$honorarios
	        ->columns(array('u.ute_id, tip_nombre, ute_honorario,ute_honorario2,ute_honorario3 ,usu_id'))
	        ->addFrom('Usuariotipoest','u')
	        // ->join('Curso','c.cur_id=cuo.cur_id','c')
	        ->join('Tipoestudio','t.tip_id=u.tip_id','t')
	        ->where('ute_estatus=2 and usu_id='.$id)
	        // ->orderBy('rec_serierecibo asc')
	        ->getQuery()
	        ->execute();
        	// $recibo = Recibo::find(array(
         //    "rec_estatus<=3 and pol_id=".$id." and rec_estatus>=1"
         //    ));
            
        }

        // $curso=Cuootorgado::findFirstBycuo_id($id);
        $auth = $this->session->get('auth');
        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Consultó los honorarios del usuario con clave interna: ".$id;
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=$id;
        $databit['bit_modulo']="Honorarios";
        $bitacora->NuevoRegistro($databit);
        $this->view->page=$honorarios;
    }

    public function ajax_asigtipoAction($id)
    {
        $result = [];
        $datos=[];
        $subs = Tipoestudio::find(array(
            "tip_estatus=2","order"=>"tip_nombre"
            ));
        if ($subs) {
            $asignados = Usuariotipoest::find(array(
            "ute_estatus=2 and usu_id=".$id));

            for($x=0;$x<count($subs);$x++){
                $bandera=0;
                for($y=0;$y<count($asignados);$y++){
                    if($subs[$x]->tip_id==$asignados[$y]->tip_id)
                    {
                        $bandera=1;
                        break;
                    }
                }
                if($bandera==0){
                    array_push($datos,$subs[$x]);
                }
            }
        }
        return $this->response->setJsonContent($datos);
    }

    public function detallestipoestudioAction($clave=0)
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        
        if($this->request->isAjax()&&$clave>0)
        {
            $honorarios=Tipoestudio::findFirstBytip_id($clave);
            if($honorarios)
            {
                $answer[0]=1;
                $answer[1]=$honorarios;
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

    public function nuevoAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $asignados = Usuariotipoest::find(array(
            "ute_estatus=2 and usu_id=".$data['usu_idhonorario']." and tip_id=".$data['tip_id']));
            
            if(count($asignados)>0){
                $answer[0]=0;
                $answer[1]='Ya fue asignado el tipo de estudio al usuario previamente.';
                // return false;
            }
            else{
                
                $auth = $this->session->get('auth');
               
                $usuariotipo = new Usuariotipoest();
                $res_tipo_estudio= $usuariotipo->NuevoRegistro($data,$data['usu_idhonorario'], $auth['id']);
         
                
              
                if($res_tipo_estudio['respuesta']>0)
                {
                    $idtabla=$res_tipo_estudio['ute_id'];
                    $tipo=Tipoestudio::findFirstBytip_id($data['tip_id']);
                    $usuario=new Usuario();
                    $nombreusuario= $usuario->getNombre($data['usu_idhonorario']);
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Asignó el tipo de estudio: ".$tipo->tip_nombre." al usuario: ".$nombreusuario;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$idtabla;
                    $databit['bit_modulo']="Honorarios";
                    $bitacora->NuevoRegistro($databit);
                    $answer[0]=1;
                    $answer[2]=$data['usu_idhonorario'];
                    $answer[3]=$nombreusuario;
                }
                else
                    $answer[0]=0;
            }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 

    }

    public function eliminarAction($id)
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $answer=array();
        // $answer[0]=1;
        // 
        if(!$rol->verificar(21,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
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
        $answer[0]=0;
        $this->view->disable();
        $honorario=Usuariotipoest::findFirstByute_id($id);
        if($honorario){
            $honorario->ute_estatus=-1;
            
            if($honorario->save()) {
                $answer[0]=1;

                $auth = $this->session->get('auth');
                $usuario=new Usuario();
                $nombreusuario= $usuario->getNombre($honorario->usu_id);
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Eliminó el honorario con ID interno: ".$id." del usuario: ".$nombreusuario;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$id;
                $databit['bit_modulo']="Honorarios";
                $bitacora->NuevoRegistro($databit);

                $answer[1]=$nombreusuario;

                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }
        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }
    
    /*
    Esta función es para obtener todos los tipos de estudios
    */
    public function ajax_get_listaAction()
    {
        $this->view->disable();
        if($this->request->isAjax())
        {
            $result = [];
            $datos=[];
            $subs = Tipoestudio::find(array(
                "tip_estatus=2","order"=>"tip_nombre"
                ));
        
            
                for($x=0;$x<count($subs);$x++){
                
                        array_push($datos,$subs[$x]);
                    
                }
            
            return $this->response->setJsonContent($datos);
        }

    }



}