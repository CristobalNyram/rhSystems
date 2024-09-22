<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "mpdf/index.php";

class ClienteController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Cliente');
        parent::initialize();
    }

    private function __verificarSesionCorrecta(){
        $auth = $this->session->get('auth');
        if(!array_key_exists('autoestudio',$auth)){
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica. -AES");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }
    }

    public function indexAction()
    {
    	$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    public function index1Action()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(82,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
    }

	public function tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(82,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $usuario=Usuario::findFirstByusu_id($auth['id']);
        $registros=new Builder();
                $registros=$registros
                ->columns(array('ese_id, concat_ws(" ", ese_nombre,ese_primerapellido, ese_segundoapellido) as nombre, est_nombre, mun_nombre, ese_estatus, ese_registro, ese_fechaentregacliente'))
                ->addFrom('Estudio','e')
                ->join('Estado','est.est_id=e.est_id','est')
                ->leftjoin('Municipio','m.mun_id=e.mun_id','m')
                ->where('ese_estatus>0 and emp_id='.$usuario->emp_id)
                // ->orderBy('rec_serierecibo asc')
                ->getQuery()
                ->execute();
        $this->estudio = new Estudio();
        $this->view->estudio = $this->estudio;
        $this->view->estudios=$registros;
    }

    public function trafico_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
    }

    public function trafico_tablaAction()
    {
        // $rol = new Rol();
        $auth = $this->session->get('auth');
        $condicion='';

        $condicion.=$this->getEstudiosCliente();
        
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $ESE=Estudio::query()
            ->columns('Estudio.ese_id,Estudio.ese_autoestudio,aes.aes_estatus  ,Estudio.ese_registro, Estudio.ese_fechaasiginvestigador, Estudio.ese_estatus,Estudio.ese_transporte, Estudio.ese_nombre, Estudio.ese_primerapellido, Estudio.ese_segundoapellido, 
                      emp.emp_alias as empresa_nombre, Estudio.tip_id, mun_nombre, est_nombre, tip_clave,
                       CONCAT(inv.usu_nombre," ", inv.usu_primerapellido," ",inv.usu_segundoapellido) as investigador, inv_id,
                       tra.tra_id,tra.tra_preaprobado,tra.tra_solicitado,tra.tra_destino,tra.tra_origen,tra.tra_comentario, cen_nombre, ese_folioverificacion, Estudio.tif_id
                       ,Estudio.mun_id, ana_id
                       ')
            ->where($condicion.' and (ese_estatus=2 or ese_estatus=3)')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Autoestudio','aes.ese_id=Estudio.ese_id','aes')
            ->leftjoin('Usuario','ana.usu_id=Estudio.ana_id','ana')
            ->leftjoin('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Transporte','tra.ese_id=Estudio.ese_id and tra.tra_estatus=1','tra')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            // ->leftjoin('Negocio','neg.neg_id=emp.neg_id','neg')
            ->execute();     
     
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $date= new DateTime();
        $hoy=$date->format('Y-m-d');
        $tresdias = $this->resDias($hoy,3);
        $seisdias = $this->resDias($hoy,8);

        $this->view->tresdias=$tresdias;
        $this->view->seisdias=$seisdias;

    }

    public function asiginv_indexAction()
    {
    }
    
    public function asiginv_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion='ese_estatus=1 and ';
        $condicion.=$this->getEstudiosCliente();

            $ESE=Estudio::query()
            ->columns('ese_id, Estudio.mun_id, ese_registro, ese_estatus, ese_nombre, ese_primerapellido, ese_segundoapellido, emp.emp_alias as empresa_nombre, Estudio.tip_id, mun_nombre, est_nombre, tip_clave, tip.tip_id, ese_folioverificacion, Estudio.tif_id, cen_nombre')
            ->where($condicion)
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $fecha = date("d/m/Y");
        $this->view->fechahoy=$fecha;
    }

    public function asigana_indexAction()
    {
    }

    public function asigana_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $condicion='ese_estatus=4 and ';
        $condicion.=$this->getEstudiosCliente();
        
        $ESE=Estudio::query()
        ->columns('ese_id, ese_solicita, ese_fechaasiginvestigador, ese_fechaentregainvestigador, ese_estatus, ese_nombre,ese_primerapellido, ese_segundoapellido, ana_id, inv_id, ese_registro,
         inv.usu_nombre as investigador_nombre, inv.usu_primerapellido as investigador_apellidoP , inv.usu_segundoapellido as investigador_apellidoM,
         emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id
         ')
        ->where($condicion)
        ->join('Usuario','inv.usu_id=Estudio.inv_id','inv')
        ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
        ->join('Estado','est.est_id=Estudio.est_id','est')
        ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
        ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
        ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
        ->execute();
              
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

    }

    public function traficoanalista_indexAction()
    {
        $auth = $this->session->get('auth');
        $bitacora= new Bitacoracliente();
        $databit['bic_descripcion']= "Ingresó a módulo de Tráfico analista";
        $databit['cli_id']=$auth['id'];
        $databit['bic_tablaid']=0;
        $databit['bic_modulo']="Tráfico analista";
        $bitacora->NuevoRegistro($databit);
    }

    public function traficoanalista_tablaAction()
    {
        $auth = $this->session->get('auth');
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        if($this->request->isPost())
        {
            $data = $this->request->getPost();

            $descripcion="Realizó una búsqueda en consulta";
            $condicion='(ese_estatus=5 or ese_estatus=8 or ese_estatus=2 or ese_estatus=3 and ana_id!=null)';

            $condicion.=' and '.$this->getEstudiosCliente();
            $ESE=Estudio::query()
            ->columns('Estudio.ese_id, ese_fechaasiginvestigador, ese_fechaentregainvestigador, ese_registro, ese_fechaasiganalista, ese_solicita, ese_correo, ese_puesto, ese_estatus, ese_nombre,ese_primerapellido ,ese_segundoapellido,
             ana_id, inv_id,ese_fechanacimiento,ese_telefono,ese_celular,
             a.usu_nombre as analista_nombre, a.usu_primerapellido as analista_apellidoP , a.usu_segundoapellido as analista_apellidoM,
             inv.usu_nombre as investigador_nombre, inv.usu_primerapellido as investigador_apellidoP , inv.usu_segundoapellido as investigador_apellidoM,
             emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id,
             aes.aes_estatus, ese_autoestudio
             ')
            ->where($condicion)
            ->join('Usuario','a.usu_id=Estudio.ana_id','a')
            ->join('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Autoestudio','aes.ese_id=Estudio.ese_id','aes')

            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();
        }
      
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();

        $date= new DateTime();
        $hoy=$date->format('Y-m-d');
        $undia = $this->resDias($hoy,1);
        $dosdias = $this->resDias($hoy,2);

        $this->view->undia=$undia;
        $this->view->dosdias=$dosdias;
    }

    public function autorizacion_indexAction()
    {
        $auth = $this->session->get('auth');
        $bitacora= new Bitacoracliente();
        $databit['bic_descripcion']= "Ingresó a módulo de Autorización ESES";
        $databit['cli_id']=$auth['id'];
        $databit['bic_tablaid']=0;
        $databit['bic_modulo']="Autorización";
        $bitacora->NuevoRegistro($databit);
    }

    public function autorizacion_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $condicion='ese_estatus=6 and';
        $condicion.=$this->getEstudiosCliente();
            $ESE=Estudio::query()
            ->columns('ese_id, ese_registro, ese_estatus, ese_nombre, ese_primerapellido, ese_segundoapellido, ana_id, inv_id, emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id
             ')
            ->where($condicion)
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();
        $this->view->usuariomodel = new Usuario();
    }

    public function historial_indexAction()
    {
        $auth = $this->session->get('auth');
        $bitacora= new Bitacoracliente();
        $databit['bic_descripcion']= "Ingresó a módulo de Historial";
        $databit['cli_id']=$auth['id'];
        $databit['bic_tablaid']=0;
        $databit['bic_modulo']="Historial";
        $bitacora->NuevoRegistro($databit);
    }

    public function historial_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $date= new DateTime();
        $hoy=$date->format('Y-m-d');
        $seismeses = $this->resDiasexactos($hoy,180);

        $condicion='ese_estatus=7 and ese_fechaentregacliente>="'.$seismeses.'" and';
        $condicion.=$this->getEstudiosCliente();
            $ESE=Estudio::query()
            ->columns('ese_id, ese_registro, ese_fechaentregacliente, ese_estatus, ese_nombre, ese_primerapellido, ese_segundoapellido, ana_id, inv_id, emp.emp_alias as empresa_nombre, est_nombre, mun_nombre, tip_clave, cen_nombre, Estudio.tip_id, ese_folioverificacion, Estudio.tif_id
             ')
            ->where($condicion)
            ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->join('Estado','est.est_id=Estudio.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
            ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
            ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
            ->execute();
        
        $this->view->estudio=$ESE;
        $this->view->estudiomodel = new Estudio();
        $this->view->usuariomodel = new Usuario();
    }

    public function agenda_indexAction()
    {
    }

    public function agenda_tablaAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        $condicion='';
        // $condicion='';
        // if($rol->verificar(9,$auth['rol_id'])) //con esto tiene el permiso de ver todos los ESES
        // {
        //     $condicion='';
        // }
        // if($rol->verificar(10,$auth['rol_id'])) ///con esto le damos la funcionalidad de que solo vea los ESES asignados
        // {
        //     $condicion='inv_id='.$auth['id'].' and ';
        // }

        // $condicion.=$this->getEstudios("Estudio.");
        $condicion.=$this->getEstudiosCliente("Estudio.");

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
}