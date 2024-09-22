<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class BitacoraController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Bitacora');
        parent::initialize();
        // $this->view->gmenu=2;
        // $rol = new Rol();
        // $auth = $this->session->get('auth');
        // if(!$rol->verificar(8,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
        
    }

    /**
     * [indexAction Index para la tabla departamento]
     * @param        []
     * @return []    []
     */
     public function indexAction(){
        $indexusu=-1;
        
        $fecha_ini="";
        $fecha_fin="";
        $condicion="";
        $datos=[];

        $usuario=Usuario::find("usu_estatus=2");
        

        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $fecha_fin=$data["fecha_fin"];
            $fecha_ini=$data["fecha_ini"];
            $condicion='Bitacora.bit_estatus=2';
            // $indexestatus=$data["ofa_estatus"];
            $indexusu=$data["usu_id"];
            

            if($data["usu_id"]!=-1)
                $condicion.=" and Bitacora.usu_id=".$data["usu_id"];
            if($data["fecha_ini"]!="")
                $condicion.=" and bit_fecharegistro>='".$data["fecha_ini"]."'";
            if($data["fecha_fin"]!="")
                $condicion.=" and bit_fecharegistro<='".$data["fecha_fin"]."'";
            
            $datos=[];
             
            $datos=Bitacora::query()
            ->columns("Bitacora.bit_id,usu_nombre,usu_primerapellido,usu_segundoapellido,DATE_FORMAT(bit_fecharegistro,'%d/%m/%Y %H:%i') as bit_fecharegistro,bit_descripcion")
            ->join('Usuario','u.usu_id=Bitacora.usu_id','u')
            ->where($condicion)
            ->execute();
            
            

        }

        $this->view->indexusu=$indexusu;
        $this->view->usuario=$usuario;
        $this->view->fechaini=$fecha_ini;
        $this->view->fechafin=$fecha_fin;
        $this->view->datos=$datos;

    }
}