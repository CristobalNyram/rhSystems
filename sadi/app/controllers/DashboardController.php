<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class DashboardController extends ControllerBase
{
    public function indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(55,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->response->redirect('errors/errorpermiso');
        }

        $bitacora= new Bitacora();
        $databit['bit_descripcion']= "Ingresó a módulo de Dashboard";
        $databit['usu_id']=$auth['id'];
        $databit['bit_tablaid']=0;
        $databit['bit_modulo']="Dashboard";
        $bitacora->NuevoRegistro($databit);

        $this->tag->setTitle('Dashboard');

    }
    public function ajax_estudios_trafico_investigadorAction(){
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
            
            $eses_cancelados=Estudio::query()
            ->columns('Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_precancelar, Estudio.ese_estatus,Estudio.ese_fechacancelacion')
            ->where("Estudio.ese_estatus=2 and Estudio.ese_fechaasiginvestigador >= '$fecha_hace_8_dias'")
            ->execute();
    
            $this->response->setJsonContent($eses_cancelados);
            $this->response->send();
        }else{
              return http_response_code(400);
        }   

    }

    public function ajax_estudios_canceladosAction(){
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
            
            $eses_cancelados=Estudio::query()
            ->columns('Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_precancelar, Estudio.ese_estatus,Estudio.ese_fechacancelacion')
            ->where("Estudio.ese_estatus=-2 and Estudio.ese_fechacancelacion >= '$fecha_hace_8_dias'")
            ->execute();
    
            $this->response->setJsonContent($eses_cancelados);
            $this->response->send();
        }else{
              return http_response_code(400);
        }   

       
    }
    
    public function ajax_estudios_aprobadosAction(){
        
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
              $eses_aprobados=Estudio::query()
            ->columns('Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_precancelar, Estudio.ese_estatus,Estudio.ese_fechaentregacliente')
            ->where("Estudio.ese_estatus=7 and Estudio.ese_fechaentregacliente >= '$fecha_hace_8_dias'")
            ->execute();

            $this->response->setJsonContent($eses_aprobados);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_estudios_altaAction(){
        
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
              $eses_aprobados=Estudio::query()
            ->columns('Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_precancelar, Estudio.ese_estatus,Estudio.ese_fechaentregacliente')
            ->where("Estudio.ese_estatus=1 and Estudio.ese_registro >= '$fecha_hace_8_dias' ")
            ->execute();

            $this->response->setJsonContent($eses_aprobados);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }
    public function ajax_estudios_trafico_analistaAction(){
        
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
              $eses_aprobados=Estudio::query()
            ->columns('Estudio.ese_id, Estudio.ese_nombre, Estudio.ese_precancelar, Estudio.ese_estatus,Estudio.ese_fechaentregacliente')
            ->where("Estudio.ese_estatus=5 and Estudio.ese_fechaasiganalista >= '$fecha_hace_8_dias' ")
            ->execute();

            $this->response->setJsonContent($eses_aprobados);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_estudios_transporte_aprobadosAction(){
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
              $tra_aprobados=Transporte::query()
            ->columns('Transporte.tra_id,Transporte.ese_id, Transporte.tra_aprobado, Transporte.tra_fechaaprobado, Transporte.tra_origen,Transporte.tra_destino')
            ->where("Transporte.tra_estatus=3 and Transporte.tra_fechaaprobado >= '$fecha_hace_8_dias' ")
            ->execute();

            $this->response->setJsonContent($tra_aprobados);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }
    public function ajax_get_total_transporte_aprobadosAction(){
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
            
              $tra_aprobados_total=Transporte::sum([
                'column'     => 'tra_aprobado',
                'conditions' => "tra_estatus = 3 and tra_fechaaprobado >= '$fecha_hace_8_dias'",
              ]);

            $this->response->setJsonContent($tra_aprobados_total);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_get_detalle_general_esesAction(){
        $this->view->disable();

        if($this->request->isAjax())
        {

            $answer=[];            
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 

                /*
                $eses_detalle=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where("  (Estudio.ese_estatus=1 and Estudio.ese_registro >= '$fecha_hace_8_dias') 
                        or (Estudio.ese_estatus=5 and Estudio.ese_fechaasiganalista >= '$fecha_hace_8_dias') 
                        or (Estudio.ese_estatus=6 and Estudio.ese_fechaentregaanalista >= '$fecha_hace_8_dias')
                        or (Estudio.ese_estatus=4 and Estudio.ese_fechaentregainvestigador >= '$fecha_hace_8_dias')
                        or (Estudio.ese_estatus=7 and Estudio.ese_fechaentregacliente >= '$fecha_hace_8_dias')
                        or (Estudio.ese_estatus=-2 and Estudio.ese_fechacancelacion >= '$fecha_hace_8_dias')
                        or (Estudio.ese_estatus=2 and Estudio.ese_fechaasiginvestigador >= '$fecha_hace_8_dias')
                        or (Estudio.ese_estatus=3 and Estudio.ese_fechaasiginvestigador >= '$fecha_hace_8_dias')
                        ")
                ->groupBy('ese_estatus')
                ->execute();*/

            $eses_cancelados_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=-2 and Estudio.ese_fechacancelacion >= '$fecha_hace_8_dias'")
                ->execute();
            $eses_asignar_inv_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=1 and Estudio.ese_registro >= '$fecha_hace_8_dias'")
                ->execute();

            $eses_tra_inv_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=2 or Estudio.ese_estatus=3  and Estudio.ese_fechaasiginvestigador >= '$fecha_hace_8_dias'")
                ->execute();

            $eses_asignar_analista_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=4 and Estudio.ese_fechaentregainvestigador >= '$fecha_hace_8_dias'")
                ->execute();

            $eses_tra_analista_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=5 and Estudio.ese_fechaasiganalista >= '$fecha_hace_8_dias'")
                ->execute();
            $eses_validacion_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=6 and Estudio.ese_fechaentregaanalista >= '$fecha_hace_8_dias'")
                ->execute();

            $eses_aprobado_count=Estudio::query()
                ->columns('COUNT(Estudio.ese_id) AS numero_de_registros,ese_estatus')
                ->where(" Estudio.ese_estatus=7 and Estudio.ese_fechaentregacliente >= '$fecha_hace_8_dias'")
                ->execute();

            $answer['ese_cancelados']['no_registros']=$eses_cancelados_count[0]['numero_de_registros'];
            $answer['ese_asig_inv']['no_registros']=$eses_asignar_inv_count[0]['numero_de_registros'];
            $answer['ese_tra_inv']['no_registros']=$eses_tra_inv_count[0]['numero_de_registros'];
            $answer['ese_asig_ana']['no_registros']=$eses_asignar_analista_count[0]['numero_de_registros'];
            $answer['ese_tra_ana']['no_registros']=$eses_tra_analista_count[0]['numero_de_registros'];
            $answer['ese_validacion']['no_registros']=$eses_validacion_count[0]['numero_de_registros'];
            $answer['ese_aprobados']['no_registros']=$eses_aprobado_count[0]['numero_de_registros'];

            $answer['eses_total']['no_registros']=(
                                                    $answer['ese_cancelados']['no_registros']
                                                    +$answer['ese_asig_inv']['no_registros']
                                                    +$answer['ese_tra_inv']['no_registros']
                                                    +$answer['ese_asig_ana']['no_registros']
                                                    +$answer['ese_tra_ana']['no_registros']
                                                    +$answer['ese_validacion']['no_registros']
                                                    +$answer['ese_aprobados']['no_registros']

                                                );

            $this->response->setJsonContent($answer);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_get_reporte_alta_aprobado_cancealdosAction(){
        $this->view->disable();

        if($this->request->isAjax())
        {
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
            
              $tra_aprobados_total=Transporte::sum([
                'column'     => 'tra_aprobado',
                'conditions' => "tra_estatus = 3 and tra_fechaaprobado >= '$fecha_hace_8_dias'",
              ]);

            $this->response->setJsonContent($tra_aprobados_total);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_get_reporte_alta_aprobado_cancelados_esesAction($fecha_hace_8_dias=''){
        $this->view->disable();

        if($this->request->isAjax())
        {

            $answer=[];
            $fecha_actual= date('d-m-Y');
            
            if($fecha_hace_8_dias==''){
                $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 

            }
        
  

            $this->response->setJsonContent($answer);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_get_cuenta_estudiosAction(){
          
        $this->view->disable();
        $answer=[];

        if($this->request->isAjax())
        {

            $auth = $this->session->get('auth');
            $request = $this->request->getPost();

            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consulto datos de cuenta de tipos de ESES de la fecha ".$request["ese_registro_fechainicial"]." hasta ".$request["ese_registro_fechafinal"];
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Dashboard";
            $bitacora->NuevoRegistro($databit);


            $condicion="and Estudio.ese_fechaentregacliente>='".$request["ese_registro_fechainicial"]." 00:00:01 ' and   Estudio.ese_fechaentregacliente<= '".$request["ese_registro_fechafinal"]." 23:59:59 ' " ;
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
         


            // ontener datos de acorde al tip_id
            $data= $this->modelsManager->createBuilder()
            ->columns([
                'Estudio.tip_id',
                'tip.tip_nombre',
                'COUNT(Estudio.tip_id) as contador'
            ])
            ->from('Estudio')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->where('Estudio.ese_estatus=7 '.$condicion)
            ->groupBy('Estudio.tip_id')
            ->getQuery()
            ->execute();

            $total= $this->modelsManager->createBuilder()
            ->columns([
                'Estudio.tip_id',
                'tip.tip_nombre',
                'COUNT(Estudio.tip_id) as contador'
            ])
            ->from('Estudio')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->where('Estudio.ese_estatus=7 '.$condicion)
            ->getQuery()
            ->execute();



            $answer['data']=$data;
            $answer['request']=$request;
            $answer['total']=$total[0]->contador;
            $answer['estatus']=2;
            $answer['mensaje']='ok';
            $answer['titular']='ok';


            $this->response->setJsonContent($answer);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

    public function ajax_get_cuenta_altaAction(){
          
        $this->view->disable();
        $answer=[];

        if($this->request->isAjax())
        {
            $auth = $this->session->get('auth');
            $request = $this->request->getPost();
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consulto datos  ESE datos de alta desde  la fecha ".$request["ese_registro_fechainicial"]." hasta ".$request["ese_registro_fechafinal"];
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Dashboard";
            $bitacora->NuevoRegistro($databit);


            $condicion="Estudio.ese_registro>='".$request["ese_registro_fechainicial"]." 00:00:01 ' and   Estudio.ese_registro<= '".$request["ese_registro_fechafinal"]." 23:59:59 ' " ;
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
        
            $data= $this->modelsManager->createBuilder()
            ->columns([
                'Estudio.tip_id',
                'tip.tip_nombre',

                'COUNT(Estudio.tip_id) as contador'
            ])
            ->from('Estudio')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->where($condicion)
            ->groupBy('Estudio.tip_id')
            ->getQuery()
            ->execute();

            $total= $this->modelsManager->createBuilder()
            ->columns([
                'Estudio.tip_id',
                'tip.tip_nombre',

                'COUNT(Estudio.tip_id) as contador'
            ])
            ->from('Estudio')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->where($condicion)
            ->getQuery()
            ->execute();
          
            

            $answer['data']=$data;
            $answer['request']=$request;
            $answer['condicion']=$condicion;
            $answer['total']=$total[0]->contador;

            $answer['estatus']=2;
            $answer['mensaje']='ok';
            $answer['titular']='ok';




            $this->response->setJsonContent($answer);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }


    public function ajax_get_cuenta_analista_entregadosAction(){
          
        $this->view->disable();
        $answer=[];

        if($this->request->isAjax())
        {
            $request = $this->request->getPost();
            $auth = $this->session->get('auth');

            $bitacora= new Bitacora();
            $databit['bit_descripcion']= "Consulto datos  ESE entregados por analista desde  ".$request["ese_registro_fechainicial"]." hasta ".$request["ese_registro_fechafinal"];
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Dashboard";
            $bitacora->NuevoRegistro($databit);


            $condicion="and Estudio.ese_fechaentregacliente>='".$request["ese_registro_fechainicial"]." 00:00:01 ' and   Estudio.ese_fechaentregacliente<= '".$request["ese_registro_fechafinal"]." 23:59:59 ' " ;
            $fecha_actual= date('d-m-Y');
            $fecha_hace_8_dias =$this->resDiasexactos($fecha_actual,8); 
        
            $data= $this->modelsManager->createBuilder()
            ->columns([
                "CONCAT(usu.usu_nombre, ' ', usu.usu_primerapellido, ' ', usu.usu_segundoapellido) as usu_nombre",
                'COUNT(Estudio.ana_id) as contador'

            ])
            ->from('Estudio')
            // ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->join('Usuario','usu.usu_id=Estudio.ana_id','usu')
            ->where('Estudio.ese_estatus=7 '.$condicion)
            ->groupBy('Estudio.ana_id')
            ->getQuery()
            ->execute();

            $total= $this->modelsManager->createBuilder()
            ->columns([
                "CONCAT(usu.usu_nombre, ' ', usu.usu_primerapellido, ' ', usu.usu_segundoapellido) as usu_nombre",
                'COUNT(Estudio.ana_id) as contador'

            ])
            ->from('Estudio')
            // ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->join('Usuario','usu.usu_id=Estudio.ana_id','usu')
            ->where('Estudio.ese_estatus=7 '.$condicion)
            ->getQuery()
            ->execute();




            $answer['data']=$data;
            $answer['request']=$request;
            $answer['total']=$total[0]->contador;
            //  $answer['total']=$total;

            $answer['estatus']=2;
            $answer['mensaje']='ok';
            $answer['titular']='ok';




            $this->response->setJsonContent($answer);
            $this->response->send();
        }else{
            return http_response_code(400);

        }
    }

}