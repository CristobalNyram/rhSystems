<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

class CategoriaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Categoria');
        parent::initialize();
        
    }

    public function ajax_categoriasAction($tipo_archivo = 0)
    {
        $result = [];
        $data = $this->request->getPost();
        $condicion_sql="cat_estatus = 2";
        
        try {
            if($data["vista"]!=""){
                $condicion_sql.=" AND cat_vista LIKE '%".$data["vista"]."%' ";
            }else{
                throw new Exception("FALTA UN PARÁMETRO -VISTA-");
                
            }
            $subs = new Builder();
            $subs->addFrom('Categoria')
                 ->where($condicion_sql)
                 ->orderBy('cat_nombre');

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
            $categoria = Categoria::findFirstBycat_id($id);
            // $centro->emp_id= $data['emp_idcrear'];
            // $centro->cen_ubicacion= $data['cen_ubicacionc'];
            if($categoria)
            {  
                $answer[0]=1;
                $answer[1]=$categoria->cat_tipo;
                $answer[2]=$categoria->cat_multiple;
                $answer[3]=$categoria->cat_especificaciones;
                $answer["size"]=$categoria->cat_tamano;
                $answer["file_limit"]=$categoria->cat_numarc;
                
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
