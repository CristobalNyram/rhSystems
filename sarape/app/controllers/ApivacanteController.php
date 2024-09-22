<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Di;
use Phalcon\Mvc\Model\Query;


class ApivacanteController extends ControllerBase
{

    private $__TOKEN_API="S_eyJ_I_hbG_P_ci_S_OiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.T3z0SkdHPUUqGd1KRpBoOpIdW3v6pRmZqGzXNLOeD20";
    public $list_sitios_web_permitidos=[
        "www.sips.mx",
    ];
    public function initialize()
    {
        $this->tag->setTitle('Vacante ');
        parent::initialize();
    }

    public function get_vigentes_landingAction(){
        $answer = [];
        $answer["titular"] = "ERORR";
        $answer["data"] = [];
        $limit=0;

        $this->view->disable();
        try {

        if (true) {
               // if ($this->request->isAjax()) {

                $data = $this->request->getPost();
                if (empty($data) || !array_key_exists("token", $data) || $data["token"] != $this->__TOKEN_API) 
                   throw new Exception("Petición no tiene el formato correcto #TK#");
                
                if (isset($data["limit"]) && filter_var($data["limit"], FILTER_VALIDATE_INT) !== false && $data["limit"] > 0) {
                    $limit = $data["limit"];
                }

                $estatus_vac = [1, 2, 5];
                $condicion_sql_vac = "vac.vac_estatus IN (" . implode(",", $estatus_vac) . ")";
                $vacantes = new Builder();
                $vacantes = $vacantes
                ->columns(array('
                    est.est_nombre AS estado,
                    mun.mun_nombre AS municipio,
                    ANY_VALUE(eje.usu_correo) AS ejecutivo,
                    cav.cav_nombre AS vacante,
                    IFNULL(NULLIF(vac.vac_sueldomin, ""), "00.00") AS sueldo,
                    ANY_VALUE(vac.vac_fecharegistro)  as fecha

                '))
                ->addFrom('Vacante', 'vac')
                ->leftjoin('Estado','est.est_id=vac.est_id','est')
                ->leftjoin('Municipio','mun.mun_id=vac.mun_id','mun')
                ->leftjoin('Usuario','eje.usu_id=vac.eje_id','eje')
                ->leftjoin('Catvacante','cav.cav_id=vac.cav_id','cav');
        
            
                $vacantes = $vacantes->where($condicion_sql_vac)
                ->groupBy(['est_nombre', 'mun_nombre', 'cav_nombre', 'vac_sueldomin']);

                if($limit!=0)
                    $vacantes = $vacantes->limit($limit);
                

                $regs = $vacantes->orderBy('fecha ASC')
                    // ->groupBy('estado, municipio, vacante, sueldo')
                    ->getQuery()->execute();
                $answer["data"]= $regs;

                if(count($vacantes)>0){
                    $answer["estado"] =2;
                    $answer["titular"] ='OK';
                    $answer["mensaje"] ='OK';
                }else{
                    $answer["estado"] =1;
                    $answer["titular"] ='NO HAY INFO';
                    $answer["mensaje"] ='NO HAY INFO';
                }
                $equipo_so="";
                if (isset($_SERVER["HTTP_SEC_CH_UA_PLATFORM"])) {
                    $equipo_so = $_SERVER["HTTP_SEC_CH_UA_PLATFORM"];
                } else {
                    $equipo_so = "DESCONOCIDO"; 
                }
                $data_bit=[
                    'bit_descripcion'=>'Consultó las vacantes que se tienen disponibles, la IP del usuario es '.$this->obtenerIP().' y su sistema operativo es '.$equipo_so,
                    'bit_tablaid'=>0,
                    'bit_modulo'=>"Vacante API",
                    'vac_id'=>0,
                    'bit_accion'=>2,
                ];
                $authF['id'] = 0;
                $this->bitacora_registro($data_bit,$authF);
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;


            }else{
                throw new Exception("Petición no tiene el formato correcto");
            }
            
        } catch (\Exception $e) {
            $answer["estado"] = -2;
            $answer['mensaje'] = 'ERROR EN API';
            $data_bit = [
                'bit_descripcion'=>'ERROR OBTENER DETALLES LA API VACANTES VIGENTES: '.$e->getMessage(),
                'bit_tablaid' => 0,
                'bit_modulo' => "ERROR ",
                'vac_id' => 0,
                'bit_accion' => 4,
            ];
            $this->bitacora_registro_ERROR($data_bit,$e);
        }

        $this->response->setJsonContent($answer);
        $this->response->send();
        return;
    }
}