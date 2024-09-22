<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class BitacoraController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Bitácora');
        parent::initialize();
    }

    /**
     * [indexAction Index para la tabla departamento]
     * @param        []
     * @return []    []
     */
    public function indexAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(3,$auth['rol_id']))
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;   
        }

        $indexusu=-1;
        
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $usuario=Usuario::find("usu_estatus=2");

        if($this->request->isPost())
        {  
            try {
                $data = $this->request->getPost();
                $fecha_fin=$data["fecha_fin"];
                $fecha_ini=$data["fecha_ini"];
                $condicion='Bitacora.bit_estatus=2';
                $indexusu=$data["usu_id"];     

                if($data["usu_id"]!=-1)
                    $condicion.=" and Bitacora.usu_id=".$data["usu_id"];
                if($data["fecha_ini"]!="")
                    $condicion.=" and bit_fecharegistro>='".$data["fecha_ini"]."'";
                if($data["fecha_fin"]!="")
                    $condicion.=" and bit_fecharegistro<='".$data["fecha_fin"]." 23:59:59'";
                
                $datos=[];
                    
                $datos=Bitacora::query()
                ->columns("Bitacora.bit_id,usu_nombre,usu_primerapellido,usu_segundoapellido,DATE_FORMAT(bit_fecharegistro,'%d/%m/%Y %H:%i') as bit_fecharegistro,bit_descripcion,bit_modulo")
                ->join('Usuario','u.usu_id=Bitacora.usu_id','u')
                ->where($condicion)
                ->execute();
            }catch (\Exception $e) {
                error_log(print_r($e));
                error_log($e->getMessage());
                $this->flash->error("Ocurrió un error al consultar los registros de bitácora.");
                $this->response->redirect('index/panel');
                $this->view->disable();       
            }   
        }
        
        $this->view->indexusu=$indexusu;
        $this->view->usuario=$usuario;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;
        return;
    }
}