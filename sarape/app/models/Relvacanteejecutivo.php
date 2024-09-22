<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
use Phalcon\Di;

/**
 * Modelo del relación entre ejecutivo y vacante ="VACANTES COMPARTIDAS"
 */
class Relvacanteejecutivo extends Model
{
    public function compartirVacante($vac_id,$vac_eje_id,$data=[],$auth=[],$actualizar_eliminado_no_marcados=false){
        $answer=[];
        $answer["estado"]=2;
        $answer["titular"]="NO VALIDO PARA CAMBIAR";
        $answer["mensaje"]="NO VALIDO";
        $answer["mensaje_extra_bitacora"]="";
        $fecha_y_hora = date("Y-m-d H:i:s");

        if (isset($data["rve_eje_id"]) && is_array($data["rve_eje_id"]) && count($data["rve_eje_id"]) > 0) {
            $usuIdsString = implode(',', $data["rve_eje_id"]);
        } else {
            // En caso de que $data["rve_eje_id"] sea null o vacío, asignar un valor predeterminado (en este caso, 0)
            $usuIdsString = '0';
            if($actualizar_eliminado_no_marcados){
                $answer["mensaje_extra_bitacora"]="(a ningún ejecutivo sé le compartió) ";

            }else{
                $answer["mensaje_extra_bitacora"]="(a ningún nuevo ejecutivo sé le compartió) ";

            }
        }

         

        //Actualizamos/Creamos los que estan marcados --ini 
        if(isset($data["rve_eje_id"]) && is_array($data["rve_eje_id"]) && count($data["rve_eje_id"]) > 0){
            $answer["mensaje_extra_bitacora"]=" se le compartió a los usuarios con los siguientes folios: ".$usuIdsString;

            foreach ($data["rve_eje_id"] as $usuId) {
                // Verificar si ya existe una fila con las mismas condiciones
                $existe = Relvacanteejecutivo::findFirst([
                    'conditions' => 'vac_id = :vac_id: AND eje_id = :eje_id: AND rve_estatus = 2 AND eje_id <> :vac_eje_id:',
                    'bind' => ['vac_id' => $vac_id, 'eje_id' => $usuId, 'vac_eje_id' => $vac_eje_id],
                ]);
            
                if ($existe) {
                    // Si ya existe una fila, actualiza los valores
                    $existe->vac_estatus = $data["vac_estatus"];
                    $existe->rve_estatus = 2;
                    $existe->usu_idactualizo = $auth["id"]; 
                    $existe->rve_fechaactualizo = $fecha_y_hora; 
                    $existe->update();
                } else {
                    // Si no existe una fila, crea una nueva
                    $nueva = new RelVacanteEjecutivo();
                    $nueva->vac_id = $vac_id;
                    $nueva->eje_id = $usuId; 
                    $nueva->usu_id = $auth["id"]; 
                    $nueva->rve_estatus = $data["vac_estatus"];
                    $nueva->save();
                }
            }
        
        }
        //Actualizamos/Creamos los que estan marcados --fin
        return $answer;
    }

    public function getNombresEjecutivosCompartidos($vac_id) {
        $vac_eje = new Builder();
        $vac_eje = $vac_eje
            ->columns(array(
                'GROUP_CONCAT(CONCAT(eje_vac.usu_nombre, " ", eje_vac.usu_primerapellido, " ", eje_vac.usu_segundoapellido), " ") as nombres_ejecutivos'
            ))
            ->addFrom('Relvacanteejecutivo', 'rve')
            ->leftjoin('Usuario', 'eje_vac.usu_id=rve.eje_id', 'eje_vac')
            ->where('rve.rve_estatus=2 AND rve.vac_id=' . $vac_id);
    
        $resultado = $vac_eje->getQuery()->execute();

        $nombres_ejecutivos = $resultado[0]->nombres_ejecutivos;
            
        $nombres_ejecutivos = rtrim($nombres_ejecutivos, ', ');
            
        return ($nombres_ejecutivos !== null && trim($nombres_ejecutivos) !== "") ? $nombres_ejecutivos . "." : "";
    }

    public function getEjecutivoTieneVacCompartida($vac_id,$eje_id){
        $answer["estado"]=2;
        $tiene_relacion=0;
        $condicion_sql='vac_id = '.$vac_id.' AND eje_id  = '.$eje_id.' AND rve_estatus=2';
        $builder = new Builder();
        $builder->addFrom('Relvacanteejecutivo')
                ->where($condicion_sql);
        $subs = $builder->getQuery()->execute();
        $answer["numero_vac_rel"]= $subs->count();
        if($subs->count() > 0){
            $tiene_relacion=1;
        }
        $answer["tiene_vac_rel"] =$tiene_relacion;
        $answer["data"] = $subs;
        return $answer;
    }
}