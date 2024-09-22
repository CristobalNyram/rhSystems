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

    public function ajax_categoriasAction($tipo_archivo=0)
    {
        $result = [];
        // $auth = $this->session->get('auth');
        // $id_usuario = $auth['id'];
        switch ($tipo_archivo) {
            case 'truper':
                $subs = Categoria::query()
                        ->where("cat_estatus=2 and cat_truper=2")
                        ->execute();

                break;

            case 'truperVentas':
                    $subs = Categoria::query()
                            ->where("cat_estatus=2 and cat_truperventas=2")
                            ->execute();

                    break;

            case 'ese':
                    $subs = Categoria::query()
                            ->where("cat_estatus=2 and cat_ese=2")
                            ->execute();

                    break;
            case 'gabinete':
                    $subs = Categoria::query()
                            ->where("cat_estatus=2 and cat_gabinete=2")
                            ->execute();

                    break;
            default:

                $subs = Categoria::find(array(
                    "cat_estatus=2","order"=>"cat_nombre"
                    ));
                break;
        }


       

        if ($subs) {
            $result = $subs->toArray();
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
