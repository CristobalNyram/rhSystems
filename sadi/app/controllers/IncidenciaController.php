<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class IncidenciaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Incidencia');
        parent::initialize();
    }

    public function incidenciaformularioAction($estudio, $formulario)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();

        $incidencia=new Builder();
        $incidencia=$incidencia
            ->columns(array('inc_id, inc_texto'))
            ->addFrom('Incidencia','i')
            ->where('inc_estatus=2 and for_id='.$formulario)
            ->getQuery()
            ->execute();

        $incidenciaestudio=new Builder();
        $incidenciaestudio=$incidenciaestudio
            ->columns(array('ine_id, inc_id'))
            ->addFrom('Incidenciaestudio','i')
            ->where('ine_estatus=2 and ese_id='.$estudio)
            ->getQuery()
            ->execute();

        if(count($incidencia)>0)
        {
            $datos=[];
            for($x=0;$x<count($incidencia);$x++){
                $bandera=0;
                $object = new stdClass();
                for($y=0;$y<count($incidenciaestudio);$y++){
                    
                    if($incidencia[$x]->inc_id==$incidenciaestudio[$y]->inc_id)
                    {
                        $object->checked = 'checked';
                        $bandera=1;
                        break;
                    }
                }
                if($bandera==0){
                    $object->checked = ' ';
                    // array_push($datos,$incidencia[$x]);
                }
                $object->inc_id = $incidencia[$x]->inc_id;
                $object->inc_texto = $incidencia[$x]->inc_texto;

                array_push($datos,$object);
            }
            $answer[0]=1;
            $answer[1]=$datos;
        }

        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

    public function registrarincidenciaAction($incidencia, $formulario, $estudio, $check){
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            // $data = $this->request->getPost();
            $auth = $this->session->get('auth');
            $rol = new Rol();
            $permisocalificacion=0;
            if(!$rol->verificar(46,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
            {
                $answer[0]=-1;
                $answer[1]="No tienes permiso para realizar esta acción";
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;  
            }
            
            $data['inc_id']=$incidencia;
            $data['ese_id']=$estudio;
            $valor='';
            ($check == true) ? $valor=1 :  $valor=0;
            $data['check']=$valor;

            $reg=new Incidencia();
            $id=$reg->GuardarInformacion($data, $auth['id']);
        

            if($id!=0)
            {
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Actualizó una incidencia";
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$data['inc_id'];
                $databit['ese_id']=$data['ese_id'];
                $databit['bit_modulo']="Incidencia";
                $bitacora->NuevoRegistro($databit);

                $answer[0]=1;
                // $answer[1]=$id;
            }
            else
                $answer[0]=0;
            // }
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    
    public function reporte_indexAction()
    {
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(47,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

    }
    public function reporte_tablaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Buscó datos de incidencias.';


        $auth = $this->session->get('auth');
        if(!$rol->verificar(47,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $condicion='ine_estatus=2';
            
            if($data['ine_fechainicial'] != '')
            {
                $descripcion_bitacora=' Filtro fecha inicial: '.$data['ine_fechainicial'];
                $condicion.=" and ine_registro >= '".$data['ine_fechainicial']."'";
            }

            if($data['ine_fechafinal'] != '')
            {
                $descripcion_bitacora=' Filtro fecha final: '.$data['ine_fechafinal'];
                $condicion.=" and ine_registro <= '".$data['ine_fechafinal']." 23:59:59'";
            }
                    
            //consulta incio
            $registros=Incidenciaestudio::query()
            ->columns("Incidenciaestudio.inc_id, CONCAT(e.ese_nombre,' ', e.ese_primerapellido,' ', e.ese_segundoapellido) as candidato, emp_nombre, ine_registro as fecharegistro, CONCAT(inves.usu_nombre,' ', inves.usu_primerapellido,' ', inves.usu_segundoapellido) as investigador, CONCAT(ana.usu_nombre,' ', ana.usu_primerapellido,' ', ana.usu_segundoapellido) as analista, Incidenciaestudio.ese_id, inc_texto
                        ")
            ->join('Incidencia','Incidenciaestudio.inc_id=i.inc_id','i')
            ->join('Estudio','Incidenciaestudio.ese_id=e.ese_id','e')
            ->join('Empresa','e.emp_id=emp.emp_id','emp')
            ->leftjoin('Usuario','inves.usu_id=e.inv_id','inves')
            ->join('Usuario','ana.usu_id=Incidenciaestudio.usu_id','ana')
            ->where($condicion)
            ->execute();

            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Reportes de incidencia";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
        }
        $this->usuario = new Usuario(); 
        // $this->empresa =new Empresa();
        // $this->reporte =new Reporte();

        // $this->view->estudiomodel = new Estudio();

        $this->view->usuario = $this->usuario;
        // $this->view->reporte= $this->reporte;

        $this->view->fechainicio= $data['ine_fechainicial'];
        $this->view->fechafin= $data['ine_fechafinal'];
        $this->view->page=$registros;

    }
}