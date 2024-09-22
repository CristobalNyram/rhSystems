<?php
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\User\Component\Encriptarparametros;

class HelperController extends ControllerBase
{
    public function ajax_get_datos_selects_vacAction(){
        $this->view->disable();
        $answer = array();
        $data_post = $this->request->getPost();
        $vac_obj=new Vacante();
        $ocu = Ocupacion::find("ocu_estatus = 2");
        $emp = Empresa::query()
                    ->columns('Empresa.emp_id,Empresa.emp_estatus,CONCAT(Empresa.emp_nombre, " (",  Empresa.emp_alias," )" ) as emp_nombre')
                    ->where("Empresa.emp_estatus = 2")
                    ->execute();

        $esc = Estadocivil::find("esc_estatus = 2");
        $sex = Sexo::find("sex_estatus = 2");
        $gra = Gradoescolar::find("gra_estatus = 2");
        $tie = Tipoempleo::find("tie_estatus = 2");
        $tip = Tipovacante::find("tip_estatus = 2");
        $est = Estado::find("est_estatus = 2");
        $esc = Estadocivil::find("esc_estatus = 2");
        $eje = Usuario::find(
            [
                "columns" => "CONCAT(usu_nombre, ' ', usu_primerapellido, ' ', usu_segundoapellido) AS usu_nombre, usu_id",
                "conditions" => "usu_estatus = 2",
            ]
        );
        
        $cav = Catvacante::find("cav_estatus = 2");
        $gen = Generacion::find("gen_estatus = 2");
        $pre = Prestacion::find("pre_estatus = 2");
        $data = [
            'ocupacion' => $ocu,
            'empresa' => $emp,
            'estadocivil' => $esc,
            'sexo' => $sex,
            'gradoescolar' => $gra,
            'tipoempleo' => $tie,
            'tipovacante' => $tip,
            'estado' => $est,
            'ejecutivo' => $eje,
            'catvacante' => $cav,
            'estadocivil' => $esc,
            'generacion' => $gen,
            'prestacion' => $pre,
        ];
    
        foreach ($data as $key => $value) {
            if ($value) {
                $answer['data'][$key] = $value->toArray();
            }
        }
        $exclude_values_estatus = [];
        if (array_key_exists('vac_estatus', $data_post)) {
            if($data_post["vac_estatus"]==1){//para estatus en espera 
                $exclude_values_estatus = array(-2,3);
            }
            elseif ($data_post["vac_estatus"]==2) {///para estatus en proceso
                $exclude_values_estatus = array(-2,1);
            }
            elseif ($data_post["vac_estatus"]==5) {//garantia
                $exclude_values_estatus = array(-2,1,2,6);
            }
            elseif ($data_post["vac_estatus"]==4) {//stand by
                $exclude_values_estatus = array(-2,1,3);
            }
            $answer['data_vac'] =array_diff_key($vac_obj->estatusTextoArray, array_flip($exclude_values_estatus));           
        } 
        return $this->response->setJsonContent($answer);
    }


    public function sacar_promedioAction(){
        $this->view->disable();
        $answer = array();
        $data = $this->request->getPost();
        $answer["promedio"]= $data["suma"]/$data["numero"];
        return $this->response->setJsonContent($answer);
    }

    public function ajax_tipopagosAction(){
        $this->view->disable();
        $answer['estado']=-2;
        $answer['mensaje']='error';
        $answer['data']=[];
        try {
                $condicion_sql='tpg_estatus = 2';
                $registros = new Builder();
                $registros=$registros;
                $registros=$registros
                    ->addFrom('Tipopago')
                    ->where($condicion_sql)
                    ->getQuery()
                    ->execute();
                $data = $registros;
                $answer['estado']=2;
                $answer['mensaje']='ok';
                $answer['data']=$data;
            } catch (\Exception $e) {
                    $answer[0] = -2;
                    $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }
                
        $this->response->setJsonContent($answer);
        $this->response->send();
    }

    public function get_encript_idAction($id=0){
        $this->view->disable();
        $answer['estado']=-2;
        $answer['mensaje']='error';
        $answer['titular']='error';
        $answer['data']="";
            try {
                $answer["data"]=$this->encriiptarId($id);
                $answer['estado']=2;
                $answer['mensaje']='ok';
                $answer['titular']='ok';

            } catch (\Exception $e) {
                    $answer[0] = -2;
                    $answer['mensaje'] = 'Error: ' . $e->getMessage();
            }
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
}