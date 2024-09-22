<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;

class EstadocivilController extends ControllerBase
{
    public function get_ajax_estadocivilAction($categoria=0)
    {
        $condicion='esc_estatus=2';


        switch ($categoria) {
            //traer registro de formatotruper
            case '1':
                $condicion.=' and  esc_truper=2';
                break;
            default:
        
            //trae registros de formato ese sips
            case '0':
                $condicion.=" and  esc_esesips=2 ";
                break;      
        }
    

     
        $result = [];
        $subs=new Builder();
            $subs=$subs
            ->addFrom('Estadocivil','e')
            ->where($condicion)
            ->getQuery()
            ->execute();



   
        if ($subs) {
            $result = $subs->toArray();
        }
        return $this->response->setJsonContent($result);
    }
    
}