
<?php
use \Phalcon\Config\Adapter\Ini as ConfigIni;
/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{

        public function ajax_get_total_ingresos_familia_formatotruperAction($ese_id){

            
            $this->view->disable();
            $answer=array();
            if($ese_id!=0 && is_numeric($ese_id) && $this->request->isAjax())
            {


                $sef_registro= Situacioneconomicafamiliar::findFirst(array(
                    "ese_id = '$ese_id'",
                    'sef_estatus=2',
                ));
        
                $total = $sef_registro->getTotalIngresosEspecificoFamiliaresIngresos($sef_registro->sie_id);
        
                return  $total;


            }else{
                return http_response_code(400);

            }

        }
}