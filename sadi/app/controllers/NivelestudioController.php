<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class NivelestudioController extends ControllerBase
{
    public function get_ajax_nivelestudiosAction($categoria=0)
    {
        $condicion='niv_estatus=2';


        switch ($categoria) {
            //traer registro de formatotruper
            case '1':
                $condicion.=' and  niv_truper=2';
                break;
            default:
        
            //trae registros de formato ese sips
            case '0':
                $condicion.=" and  niv_esesips=2 ";
                break;      
        }
    

     
        $result = [];
        $subs=new Builder();
            $subs=$subs
            ->addFrom('Nivelestudio','n')
            ->where($condicion)
            ->orderBy('niv_orden asc')
            ->getQuery()
            ->execute();
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
    
}