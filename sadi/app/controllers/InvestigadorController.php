<?php
use Phalcon\Crypt;
use Intervention\Image\ImageManager;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Dispatcher;

class InvestigadorController extends UsuarioController
{
    public function initialize()
    {
        $this->tag->setTitle('Investigador');
        parent::initialize();
        
    }
    
    public function ajax_getall_cercanos_rutaAction($tip_id = 0, $est_id = 0,$mun_id=0,$inv_id=0) {
        $answer=[];
        $answer["estado"]=-2;
        $answer["titular"]="error";
        $answer["mensaje"]="error";
        $answer["data"]=[];
        $this->view->disable();

        try {
            $condicion = 'usu_estatus = 2 AND r.men_id = 8 AND rrm_estatus = 1 AND ut.ute_estatus = 2 AND ut.tip_id = ' . $tip_id;
            if ($inv_id != null && $inv_id > 0) {
                $condicion .= " AND u.usu_id != $inv_id";
            }
            
            $subs = new Builder();
            $subs = $subs
                ->columns(array('u.usu_id'
                    ,'u.est_id', 'u.mun_id', 'est.est_nombre'
                    ,'u.usu_celular', 'u.usu_telefono', 'u.usu_correo'
                    ,'u.usu_adicional'
                    , 'mun.mun_nombre', 'CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre'
                    , 'usu_transporte'))
                ->addFrom('Usuario', 'u')
                ->join('Relrolmenu', 'r.rol_id=u.rol_id', 'r')
                ->join('Usuariotipoest', 'u.usu_id=ut.usu_id', 'ut')
                ->leftjoin('Estado', 'u.est_id=est.est_id', 'est')
                ->leftjoin('Municipio', 'u.mun_id=mun.mun_id', 'mun')
                ->where($condicion);
    
          
    
            $subs = $subs
                ->orderBy('est.est_id')
                ->getQuery()
                ->execute();
    
            if ($subs) {
                $answer["titular"]="ok";
                $answer["mensaje"]="ok";
                $answer["estado"]=2;
                $answer["data"]= $subs->toArray();
            }
    
            return $this->response->setJsonContent($answer);
        } catch (\Exception $e) {
            $answer["mensaje"]=$e->getMessage();

            error_log("Errro en ajax_getall_cercanos_rutaAction:".$e->getMessage());
            return $this->response->setJsonContent($answer);
        }
    }
    
    
    
}
