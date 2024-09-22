<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
class ArchivocancelacionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Archivo');
        parent::initialize();
    }
    public function tablaAction($ese_id=0, $eca_id=0,$eca_id_obliga= 1)
    {
        try {
                $rol = new Rol();
                $auth = $this->session->get('auth');
                $condicion_extra_sql='a.acc_estatus = 2';

                if(!$rol->verificar(97,$auth['rol_id'])){$this->response->redirect('errors/errorpermiso');return;}

                if($ese_id!=0 && is_numeric($ese_id)){$condicion_extra_sql.=" AND a.ese_id=".$ese_id;}

                if($eca_id!=0 && is_numeric($eca_id)){$condicion_extra_sql.=" AND a.eca_id=".$eca_id;}
                elseif($eca_id_obliga==1){$this->view->page = array();die();} #para evitar que se muestren registros con solo el ese_id
            
                $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
                    $archivo = new Builder();
                    $archivo = $archivo
                        ->columns(array('a.acc_id, a.acc_nombre'))
                        ->addFrom('Archivocancelacion', 'a')
                        ->where($condicion_extra_sql)
                        ->getQuery()
                        ->execute();
                $auth = $this->session->get('auth');
                $bitacora= new Bitacora();
                $databit['bit_descripcion']= "Consultó los archivos de cancelación del estudio con clave interna: ".$ese_id." con el folio de cancelación ".$eca_id;
                $databit['usu_id']=$auth['id'];
                $databit['bit_tablaid']=$ese_id;
                $databit['bit_modulo']="Archivos cancelación";
                $databit['ese_id']= $ese_id;
                $bitacora->NuevoRegistro($databit);
                $this->view->page=$archivo;
                $this->view->objArchivo=new Archivocancelacion();
            }catch (\Exception $e) {
                    $this->view->page = array();
                    error_log($e->getMessage());
            }
    }
 
}