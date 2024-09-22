<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
// use Phalcon\Http\ResponseInterface;

class CorreoController extends ReporteController
{
    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(55,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
        }

        $this->tag->setTitle('Dashboard');

    }

    /*
    * @param $id_ese_ =id del estudio sin encriptar  $formato =formato del estudio 
    */
    public function correoeseAction($id_ese_, $formato){
        $this->view->disable();
        $id_ese=$this->encriiptarId($id_ese_);
        if($formato==1){
            $retorno= $this->formatoesesAction($id_ese,1);
        }elseif($formato==5){
            $retorno= $this->formatogabtubosAction($id_ese,1);
        }elseif($formato==6){
            $retorno= $this->formatoencognvAction($id_ese,1);
        }elseif($formato==7){
            $retorno= $this->formatoargosAction($id_ese,1);
        }
        

        if($retorno=='error'){
            $answer2[0]=-1;
            $answer2[1]="Hubo un error al generar el reporte PDF.";
            $this->response->setJsonContent($answer2);
            $this->response->send();
            return; 
        }

        $answer2=array();
        $answer2[0]=1;
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(15,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer2);
            $this->response->send(); 
            return;
        }
        $id=$auth['id'];
        
        $answer2[0]=0;
        $this->view->disable();
        $estudio=Estudio::query()
            ->columns('ese_id, CONCAT(cne_nombre, " ", cne_primerapellido, " ", cne_segundoapellido) as cne_nombre, emp.emp_id, cne_correo, cne_copiaenvio, CONCAT(ese_nombre, " ", ese_primerapellido, " ", ese_segundoapellido) as candidato')
            ->where('ese_id='.$id_ese_)
            ->join('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->join('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
            ->execute();

        $configuracion_obj=new Configuracion();
        $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
        if($enviar_correo_estatus==1){   
            $correo= new ServicioCorreo();
            $enviado=0;
            if($enviado==0){
                if($correo->enviarformatoese($estudio[0]->cne_nombre, $estudio[0]->cne_correo, $retorno, $estudio[0]->candidato, $estudio[0]->cne_copiaenvio)==1){
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Envió un correo del estudio ".$id_ese_;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$id_ese_;
                    $databit['bit_modulo']="Correo";
                    $bitacora->NuevoRegistro($databit);
                    
                    $enviado++;
                    $answer2[0]=1;
                    $this->response->setJsonContent($answer2);
                    $this->response->send();
                    return;
                }
            }
        }else {
            $answer2[0]=-1;
            $answer2[1].="El envío de correos esta desactivado. Comuníquese con un administrador";
        }
        $this->response->setJsonContent($answer2);
        $this->response->send(); 
        return;
    }

    public function correotruperAction($id_ese_,$formato){
        $this->view->disable();
        $retorno='';
        $id_ese=$this->encriiptarId($id_ese_);
        if($formato==9 || $formato==11){
            $retorno= $this->formatotruperAction($id_ese,1);
        }
        if($formato==10){
            $retorno= $this->formatotruper_ventasAction($id_ese,1);
        }
        // $retorno= $this->formatoesesAction($id_ese,1);

        if($retorno=='error'){
            $answer2[0]=-1;
            $answer2[1]="Hubo un error al generar el reporte PDF.";
            $this->response->setJsonContent($answer2);
            $this->response->send();
            return; 
        }

        $answer2=array();
        $answer2[0]=1;
        
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(15,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $answer[0]=-1;
            $answer[1]="No tienes permiso para realizar esta acción";
            $this->response->setJsonContent($answer2);
            $this->response->send(); 
            return;
        }
        $id=$auth['id'];
        
        $answer2[0]=0;
        $this->view->disable();
        $estudio=Estudio::query()
            ->columns('ese_id, CONCAT(cne_nombre, " ", cne_primerapellido, " ", cne_segundoapellido) as cne_nombre, emp.emp_id, cne_correo, cne_copiaenvio, CONCAT(ese_nombre, " ", ese_primerapellido, " ", ese_segundoapellido) as candidato')
            ->where('ese_id='.$id_ese_)
            ->join('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->join('Contactoemp','cne.cne_id=Estudio.cne_id','cne')
            ->execute();

        $configuracion_obj=new Configuracion();
        $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
        if($enviar_correo_estatus==1){

            $correo= new ServicioCorreo();
            $enviado=0;
            if($enviado==0){
                if($correo->enviarformatoese($estudio[0]->cne_nombre, $estudio[0]->cne_correo, $retorno, $estudio[0]->candidato, $estudio[0]->cne_copiaenvio)==1){
                    $auth = $this->session->get('auth');
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Envió un correo del estudio ".$id_ese_;
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$id_ese_;
                    $databit['bit_modulo']="Correo";
                    $bitacora->NuevoRegistro($databit);
                    
                    $enviado++;
                    $answer2[0]=1;
                    $this->response->setJsonContent($answer2);
                    $this->response->send();
                    return;
                }
            }

        }else {
            $answer2[0]=-1;
            $answer2[1].="El envío de correos esta desactivado. Comuníquese con un administrador";
        }
       
        $this->response->setJsonContent($answer2);
        $this->response->send(); 
        return;
    }
}