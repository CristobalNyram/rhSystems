<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class CitaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Cita');
        parent::initialize();
    }

     /**
     * [get_ajax_detalleAction manda datos en JSON de un registro en especifico de la tabla cita]
     * @param   int [cit_id]
     * @return array[registro de cita]
     */
    public function ajax_get_detalleAction($cit_id=0){

        if($this->request->isAjax())
        {
            $result = [];
            $subs = Cita::findFirstBycit_id($cit_id);
            if ($subs) {
                $result = $subs->toArray();
            }
            return $this->response->setJsonContent($result);

        }else{
            return http_response_code(400);
        }

    }

     /**
     * [tabla_generalAction Muestra los registros  en estatus 1(actual) 2 reagenda 3 finalizada  de acorde
     * a un ese_id de la tabla cita]
     * @param  int [$ese_id]
     * @return array [array de cada uno de los registros]   
     */
    public function tabla_generalAction($ese_id=0)
    {
        if($ese_id!=0 && is_numeric($ese_id)){
            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $cita = Cita::query()
                    ->columns([        
                    "DATE_FORMAT(Cita.cit_hora, '%h:%i %p') AS cit_hora",'Cita.ese_id','Cita.ese_id','Cita.cit_fecha','Cita.cit_id','Cita.cit_estatus','Cita.cit_comentario', 'CONCAT(u.usu_nombre, " ", u.usu_primerapellido, " ", u.usu_segundoapellido) AS usu_nombre'])
                    ->leftJoin('Usuario', 'u.usu_id = Cita.usu_id', 'u')
                    ->where("Cita.cit_estatus >= 0 AND Cita.ese_id = :ese_id:")
                    ->bind(['ese_id' => $ese_id])
                    ->orderBy('Cita.cit_id DESC') // Ordenar por cit_id de forma descendente
                    ->execute();


            $this->view->page=$cita;
            $this->view->obj_cita=new Cita();
            $date= new DateTime();
            $hoy=$date->format('Y-m-d');
            $this->view->hoy=$hoy;

        }else
            $this->view->page='ERROR';

       
    }

    
    public function agendarAction()
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            $data = $this->request->getPost();

            $cit= new Cita() ;
            $auth = $this->session->get('auth');

            $respuesta_modelo= $cit->NuevoRegistro($data,$auth);

                if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');

                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Agendo una cita  con clave interna del registro  '.$respuesta_modelo['cit_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['cit_id'];
                    $databit['bit_modulo']="Cita";
                    $bitacora->NuevoRegistro($databit);
                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se guardaron los datos correctamente de la cita .';
                    $answer['cit_id']=$respuesta_modelo['cit_id'];
                    $answer['ese_id']=$respuesta_modelo['ese_id'];            
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


               

         
        }else{
            return http_response_code(400);

        }

    }

    public function agregar_comentarioAction($cit_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){
            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $registro_cit = Cita::findFirstBycit_id($cit_id);
            if($registro_cit==false){
                return http_response_code(400);

            }

            $respuesta_modelo= $registro_cit->AgregarComentario($data,$auth);

                if($respuesta_modelo['estado']==2)
                {
                    $auth = $this->session->get('auth');

                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Agregó un comentario al registro que tiene clave interna  No. '.$respuesta_modelo['cit_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['cit_id'];
                    $databit['bit_modulo']="Cita";
                    $bitacora->NuevoRegistro($databit);
                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se guardó correctamente los datos del comentario.';
                    $answer['cit_id']=$respuesta_modelo['cit_id'];
                    $answer['ese_id']=$respuesta_modelo['ese_id'];            
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


               

         
        }else{
            return http_response_code(400);

        }

    }

 /**
     * [re_agendarAction cambia de estatus 1 un registro y crea un nuevo registro con estatus 2
     *]
     * @param  int [$cit_id]
     * @return array [array datos de estatus de proceso, info acerca del registro]   
     */
    public function re_agendarAction($cit_id=0)
    {
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()){

            $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $registro_cit = Cita::findFirstBycit_id($cit_id);
            $cita_nueva =new Cita();
            if($registro_cit==false){
                return http_response_code(400);

            }
            if($registro_cit->cit_estatus==2 || $registro_cit->cit_estatus==3){
                $answer[0]=-1;
                $answer['titular']='ADVERTENCIA';
                $answer['mensaje']='No se pudieron procesar los datos porque la cita a cambiado de estatus.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;              }

            $data_cambiar_estatus=$data['data_cita_anterior'];

            $respuesta_modelo= $registro_cit->CambiarEstatusAReAgendada($data_cambiar_estatus,$auth);
            $respuesta_modelo_nueva_cita= $cita_nueva->NuevoRegistro($data,$auth);

                if($respuesta_modelo['estado']==2 && $respuesta_modelo_nueva_cita['estado']==2)
                {
                    $auth = $this->session->get('auth');

                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= 'Reagendo una cita No. '.$respuesta_modelo['cit_id'];
                    $databit['usu_id']=$auth['id'];
                    $databit['bit_tablaid']=$respuesta_modelo['cit_id'];
                    $databit['bit_modulo']="Cita";
                    $bitacora->NuevoRegistro($databit);
                
                    $answer[0]=2;
                    $answer['titular']='Éxito';
                    $answer['mensaje']='Se guardó correctamente los datos de la nueva cita.';
                    $answer['cit_id']=$respuesta_modelo['cit_id'];
                    $answer['ese_id']=$respuesta_modelo['ese_id'];            
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


               

         
        }else{
            return http_response_code(400);

        }

    }

    public function agenda_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(84,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

    public function agenda_tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');

        $condicion='';
        if($rol->verificar(9,$auth['rol_id'])) //con esto tiene el permiso de ver todos los ESES
        {
            $condicion='';
        }
        if($rol->verificar(10,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los ESES asignados
        {
            $condicion='inv_id='.$auth['id'].' and ';
        }

        $condicion.=$this->getEstudios("Estudio.");

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $ESE=Cita::query()
            ->columns('cit_id, DATE_FORMAT(Cita.cit_hora, "%h:%i %p") AS cit_hora, Cita.cit_fecha, Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_primerapellido, Estudio.ese_segundoapellido, 
                      emp.emp_alias as empresa_nombre, Estudio.tip_id, mun_nombre, est_nombre, tip_clave,
                       CONCAT(inv.usu_nombre," ", inv.usu_primerapellido," ",inv.usu_segundoapellido) as investigador,
                       cen_nombre, Estudio.tif_id, Estudio.mun_id, Cita.cit_estatus, Cita.cit_comentario')
            ->where($condicion.' and (cit_estatus=1 or cit_estatus=2) and ese_estatus=2')
            ->join('Estudio','Estudio.ese_id=Cita.ese_id')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();      
     
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $date= new DateTime();
        $hoy=$date->format('Y-m-d');

        $this->view->hoy=$hoy;
        
        $this->view->obj_cita=new Cita();
    }

    public function ajax_get_count_registroAction($ese_id=0){
        
        $this->view->disable();
        $answer=array();

        if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax()){
         $cita = Cita::query()
                    ->columns([        
                    "DATE_FORMAT(Cita.cit_hora, '%h:%i %p') AS cit_hora",'Cita.ese_id','Cita.ese_id','Cita.cit_fecha','Cita.cit_id','Cita.cit_estatus','Cita.cit_comentario', 'CONCAT(u.usu_nombre, " ", u.usu_primerapellido, " ", u.usu_segundoapellido) AS usu_nombre'])
                    ->leftJoin('Usuario', 'u.usu_id = Cita.usu_id', 'u')
                    ->where("Cita.cit_estatus >= 0 AND Cita.ese_id = :ese_id:")
                    ->bind(['ese_id' => $ese_id])
                    ->orderBy('Cita.cit_id DESC') // Ordenar por cit_id de forma descendente
              
                    ->execute();
        $answer['count_data']=count($cita);
         return $this->response->setJsonContent($answer);

         

        }else
          return http_response_code(400);

    }
}