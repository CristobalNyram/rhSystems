<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class CategoriavacController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Categoria vacante');
        parent::initialize();
    }

    public function ajax_categoriasAction($tipo_archivo = 0)
    {
        $result = [];
        $data = $this->request->getPost();
        $condicion_sql="ctv_estatus = 2 ";
        try {
            if($data["vista"]!="")
                $condicion_sql.=" AND ctv_vista LIKE '%".$data["vista"]."%' ";
            else
                throw new Exception("FALTA UN PARÁMETRO -VISTA-");
            

            $subs = new Builder();
            $subs->addFrom('Categoriavac')
                 ->where($condicion_sql)
                 ->orderBy('ctv_nombre');
            $result = $subs->getQuery()->execute();

        } catch (\Exception $e) {
            error_log(print_r($data));
            error_log($e->getMessage());
            $result = [];
        }

        return $this->response->setJsonContent($result);
    }


    public function ajax_getinfoAction($id)
    {
        $answer=array();
        $answer[0]=0;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            // $centro= new Centrotrabajo();
            $categoria = Categoriavac::findFirstByctv_id($id);
            // $centro->emp_id= $data['emp_idcrear'];
            // $centro->cen_ubicacion= $data['cen_ubicacionc'];
            if($categoria)
            {  
                $answer[0]=1;
                $answer[1]=$categoria->ctv_tipo;
                $answer[2]=$categoria->ctv_multiple;
                $answer[3]=$categoria->ctv_especificaciones;
                $answer["size"]=$categoria->ctv_tamano;
                $answer["file_limit"]=$categoria->ctv_numarc;

            }
            else
                $answer[0]=0;
        }
        else
            $answer[0]=0;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

}
