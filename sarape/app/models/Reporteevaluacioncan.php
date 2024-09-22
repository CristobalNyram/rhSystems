<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo del PDF reporte evaluación /reporte/reporte_evaluacion_candidato/
 */
class Reporteevaluacioncan extends Model
{
    public function datosPersonales($html,$data){
        $answer=[];
        $html_nuevo=$html;
        $html_nuevo=str_replace("#empresa#",trim($data->emp_nombre),$html_nuevo);
        $html_nuevo=str_replace("#candidato#",trim($data->can_nombre),$html_nuevo);
        $html_nuevo=str_replace("#ejecutivo#",trim($data->exc_eje_nombre),$html_nuevo);
        $html_nuevo=str_replace("#vacante#",trim($data->cav_nombre),$html_nuevo);
        if (isset($data->cit_fecha) && ($data->cit_fecha !== "" && $data->cit_fecha !== null)) {
            $fecha_entrevista = date("d/m/Y", strtotime($data->cit_fecha));
            $html_nuevo = str_replace("#fechadeentrevista#", $fecha_entrevista, $html_nuevo);
        } else {
            $html_nuevo = str_replace("#fechadeentrevista#", "", $html_nuevo);
        }
        
        $answer["html"]= $html_nuevo;
        return $answer;
    }


    public function valoracionExpLab($html,$data){

        $answer=[];
        $html_nuevo=$html;
     
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_puestosimilar,$id="exp_pusto_sim_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_estabilidalaboral,$id="cit_estabilidalaboral_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_responsabilidad,$id="cit_responsabilidad_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_concimientostec,$id="cit_concimientostec_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_acordeasueldoofrecido,$id="cit_acordeasueldoofrecido_");
        $promedios = array(
           $data->cit_puestosimilar,
           $data->cit_estabilidalaboral,
           $data->cit_responsabilidad,
           $data->cit_concimientostec,
           $data->cit_acordeasueldoofrecido
        );
        
        $html_nuevo=str_replace("#valoracion_media#",trim($this->calcularPromedio($promedios)),$html_nuevo);

        $answer["html"]= $html_nuevo;
        return $answer;
    }

    public function valoracionEnt($html,$data){
        $answer=[];
        $html_nuevo=$html;
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_presentacionapariencia,$id="cit_presentacionapariencia_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_puntualidad,$id="cit_puntualidad_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_disponibilidad,$id="cit_disponibilidad_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->cit_proactivo,$id="cit_proactivo_");

        $promedios = array(
            $data->cit_presentacionapariencia,
            $data->cit_puntualidad,
            $data->cit_disponibilidad,
            $data->cit_proactivo
         );

        $html_nuevo=str_replace("#valoracion_media#",trim($this->calcularPromedio($promedios)),$html_nuevo);
        $answer["html"]= $html_nuevo;
        return $answer;
    }
    public function valoracionAdicional($html,$data){
        $answer=[];
        $html_nuevo=$html;
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->psi_calificacion,$id="psi_calificacion_");
        $html_nuevo = $this->reemplazarX($html_nuevo, $data->sel_calificacion,$id="sel_calificacion_");
        $promedios = array(
            $data->psi_calificacion,
            $data->sel_calificacion,
         );
         $html_nuevo=str_replace("#valoracion_media#",trim($this->calcularPromedio($promedios)),$html_nuevo);

        $answer["html"]= $html_nuevo;
        return $answer;
    }


    public function valoracionObservaciones($html,$data){
        $answer=[];
        $html_nuevo=$html;
        $html_comentarios="";
        $observaciones = array(
            nl2br($data->cit_observaciones),
            nl2br($data->psi_observacion),
            nl2br($data->ent_observacion),
        );

        $html_comentarios = $this->generarObservacionesHTMLJunto($observaciones);
        $html_nuevo=str_replace("#observaciones_all#",trim($html_comentarios),$html_nuevo);
        $answer["html"]= $html_nuevo;
        return $answer;
    }
    function generarObservacionesHTML($observaciones) {
        $base_tr = '
        <tr>
            <td id="datosFP1" style="font-size: 7pt; height: 14pt;  text-align: justify;"  colspan="10" >
        
            </td>
        </tr>
        <tr>
            <td id="datosFP1" style="font-size: 7pt;  text-align: justify;"  colspan="10" >
            #content#
            </td>
        </tr>';
        
        $html_comentarios = '';
        foreach ($observaciones as $observacion) {
            if ($observacion != null) {
                $tr_agregar = str_replace("#content#", trim(strtoupper($observacion)), $base_tr);
                $html_comentarios .= $tr_agregar;
            }
        }
        
        return $html_comentarios;
    }
    function generarObservacionesHTMLJunto($observaciones) {
        $base_tr = '
        <tr>
        <td id="datosFP1" style="font-size: 7pt; height: 14pt;  text-align: justify;"  colspan="10" >
      
        </td>
        </tr>
        <tr style=" text-align: justify;"  class="justify">
            <td id="datosFP1" class="justify" style="font-size: 8pt;overflow-wrap: break-word; word-wrap: break-word; text-align: justify;"  colspan="10" >
            #content#
            </td>
        </tr>';
        $html_comentarios = '';
        $comentarios="";
        foreach ($observaciones as $observacion) {
            if ($observacion != null) {
                $comentarios .="<br>" .$observacion;
            }
        }
        $html_comentarios = str_replace("#content#", trim(strtoupper("<p  style='text-align: justify; font-size:8pt;'  class='justify'>".$comentarios."</p>")), $base_tr);
        return $html_comentarios;
    }
    function reemplazarX($html, $valor,$id) {
        // Reemplazo dinámico de los valores "#exp_pusto_sim_X#"
        for ($i = 1; $i <= 5; $i++) {
            $reemplazo = ($valor == $i) ? 'X' : '';
            $html = str_replace("#$id$i#", $reemplazo, $html);
        }
    
        // Reemplazo para el caso "#exp_pusto_sim_na#"
        $reemplazo_na = ($valor == 'N/A') ? 'X' : '';
        $html = str_replace("#".$id."na#", $reemplazo_na, $html);
        return $html;
    }
    function calcularPromedio($valores) {
        // Verificar que el array no esté vacío
        if (empty($valores)) {
            return 0;
        }
        // Convertir los valores "-1" o "N/A" a 0
        foreach ($valores as &$valor) {
            if ($valor === '-1' || strtoupper($valor) === 'N/A') {
                $valor = 0;
            }
        }
        // Calcular la suma de los valores
        $suma = array_sum($valores);
        // Calcular el promedio
        $promedio = $suma / count($valores);   
        return $promedio;
    }
    

}