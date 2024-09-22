<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla 
 */
class Seccionlaboral extends Model
{
    public function getAdiccion($id){
        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SI";
            default:
                return "";
        }
    }

    public function escala($html,$campo,$valor){
        switch ($valor){
            case 1:
                $html=str_replace("#".$campo."1#","X",$html);
                $html=str_replace("#".$campo."2#","",$html);
                $html=str_replace("#".$campo."3#","",$html);
                $html=str_replace("#".$campo."4#","",$html);
                break;
            case 2:
                $html=str_replace("#".$campo."1#","",$html);
                $html=str_replace("#".$campo."2#","X",$html);
                $html=str_replace("#".$campo."3#","",$html);
                $html=str_replace("#".$campo."4#","",$html);
                break;
            case 3:
                $html=str_replace("#".$campo."1#","",$html);
                $html=str_replace("#".$campo."2#","",$html);
                $html=str_replace("#".$campo."3#","X",$html);
                $html=str_replace("#".$campo."4#","",$html);
                break;
            case 4:
                $html=str_replace("#".$campo."1#","",$html);
                $html=str_replace("#".$campo."2#","",$html);
                $html=str_replace("#".$campo."3#","",$html);
                $html=str_replace("#".$campo."4#","X",$html);
                break;
            default:
                $html=str_replace("#".$campo."1#","",$html);
                $html=str_replace("#".$campo."2#","",$html);
                $html=str_replace("#".$campo."3#","",$html);
                $html=str_replace("#".$campo."4#","",$html);
                break;
        }
        return $html;
    }

    public function empleosocultos($html, $valor){
        switch ($valor){
            case "0":
                $html=str_replace("#sel_empleosocultos0#","X",$html);
                $html=str_replace("#sel_empleosocultos1#","",$html);
                break;
            case "1":
                $html=str_replace("#sel_empleosocultos0#","",$html);
                $html=str_replace("#sel_empleosocultos1#","X",$html);
                break;
            default:
                $html=str_replace("#sel_empleosocultos0#","",$html);
                $html=str_replace("#sel_empleosocultos1#","",$html);
                // break;
        }
        return $html;
    }

    public function formatoeses(){
        $reporte= new PdfReporte();
        $html=$reporte->referenciaslaboralescabecera;
        
        return $html;
    }

    public function formatoesesreferenciaslaborales($referencialaboral,$empleo){
        $reporte= new PdfReporte();
        $html=$reporte->referencialaboral;
        if($empleo==0){
            $html=str_replace("#numempleo#",trim('ÚLTIMO EMPLEO'),$html);
        }else{
            $html=str_replace("#numempleo#",trim('EMPLEO ANTERIOR'),$html);
        }
        $html=str_replace("#rel_candidatoempresa#",trim($referencialaboral->rel_candidatoempresa),$html);
        $html=str_replace("#rel_candidatodomicilio#",trim($referencialaboral->rel_candidatodomicilio),$html);
        $html=str_replace("#rel_candidatojefe#",trim($referencialaboral->rel_candidatojefe),$html);
        $html=str_replace("#rel_candidatotelefono#",trim($referencialaboral->rel_candidatotelefono),$html);
        $html=str_replace("#rel_candidatopuestoinicial#",trim($referencialaboral->rel_candidatopuestoinicial),$html);
        $html=str_replace("#rel_candidatopuestofinal#",trim($referencialaboral->rel_candidatopuestofinal),$html);
        $html=str_replace("#rel_candidatoingreso#",trim($referencialaboral->rel_candidatoingreso),$html);
        $html=str_replace("#rel_candidatosalida#",trim($referencialaboral->rel_candidatosalida),$html);
        $html=str_replace("#rel_candidatosueldoinicial#",trim($referencialaboral->rel_candidatosueldoinicial),$html);
        $html=str_replace("#rel_candidatosueldofinal#",trim($referencialaboral->rel_candidatosueldofinal),$html);
        $html=str_replace("#rel_candidatoseparacion#",trim($referencialaboral->rel_candidatoseparacion),$html);
        $html=str_replace("#rel_candidatoincapacidad#",trim($referencialaboral->rel_candidatoincapacidad),$html);
        $html=str_replace("#rel_candidatodemanda#",trim($referencialaboral->rel_candidatodemanda),$html);
        $html=str_replace("#rel_candidatorecomendable#",trim($referencialaboral->rel_candidatorecomendable),$html);
        $html=str_replace("#rel_rhempresa#",trim($referencialaboral->rel_rhempresa),$html);
        $html=str_replace("#rel_rhdomicilio#",trim($referencialaboral->rel_rhdomicilio),$html);
        $html=str_replace("#rel_rhjefe#",trim($referencialaboral->rel_rhjefe),$html);
        $html=str_replace("#rel_rhtelefono#",trim($referencialaboral->rel_rhtelefono),$html);
        $html=str_replace("#rel_rhpuestoinicial#",trim($referencialaboral->rel_rhpuestoinicial),$html);
        $html=str_replace("#rel_rhpuestofinal#",trim($referencialaboral->rel_rhpuestofinal),$html);
        $html=str_replace("#rel_rhingreso#",trim($referencialaboral->rel_rhingreso),$html);
        $html=str_replace("#rel_rhsalida#",trim($referencialaboral->rel_rhsalida),$html);
        $html=str_replace("#rel_rhsueldoinicial#",trim($referencialaboral->rel_rhsueldoinicial),$html);
        $html=str_replace("#rel_rhsueldofinal#",trim($referencialaboral->rel_rhsueldofinal),$html);
        $html=str_replace("#rel_rhseparacion#",trim($referencialaboral->rel_rhseparacion),$html);
        $html=str_replace("#rel_rhincapacidad#",trim($referencialaboral->rel_rhincapacidad),$html);
        $html=str_replace("#rel_rhdemanda#",trim($referencialaboral->rel_rhdemanda),$html);
        $html=str_replace("#rel_rhrecomendable#",trim($referencialaboral->rel_rhrecomendable),$html);

        $html=str_replace("#rel_notas#",trim($referencialaboral->rel_notas),$html);

        $html=$this->escala($html,'rel_calidad',$referencialaboral->rel_calidad);
        $html=$this->escala($html,'rel_responsabilidad',$referencialaboral->rel_responsabilidad);
        $html=$this->escala($html,'rel_relaciones',$referencialaboral->rel_relaciones);
        $html=$this->escala($html,'rel_honradez',$referencialaboral->rel_honradez);
        $html=$this->escala($html,'rel_asistencia',$referencialaboral->rel_asistencia);
        $html=$this->escala($html,'rel_puntualidad',$referencialaboral->rel_puntualidad);
        $html=$this->escala($html,'rel_iniciativa',$referencialaboral->rel_iniciativa);

        $html=str_replace("#rel_adicciones#",$this->getAdiccion($referencialaboral->rel_adicciones),$html);
            
        return $html;
    }

    public function formatoesesperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto){
        $reporte= new PdfReporte();
        $html=$reporte->periodoinactivo;

        $detalles=count($periodoinactivo);

        for ($i=0; $i <= 2; $i++) {
            if($i<$detalles){
                $html=str_replace("#per_motivo".$i."#",trim($periodoinactivo[$i]->per_motivo),$html);
                $html=str_replace("#per_fecha".$i."#",trim($periodoinactivo[$i]->per_fecha),$html);
            }else{
                $html=str_replace("#per_motivo".$i."#"," ",$html);
                $html=str_replace("#per_fecha".$i."#"," ",$html);
            }
        }
        $html=$this->empleosocultos($html, $seccionlaboral->sel_empleosocultos);
       
        $html=str_replace("#epl_registros_dinamicos#",$this->empleosocultosRegistros($empleooculto,$seccionlaboral->sel_empleosocultos),$html);

        $html=str_replace("#sel_notas#",trim($seccionlaboral->sel_notas),$html);
        
        return $html;
    }
    public function ActualizarRegistro($data,$permisoCalificacion=0,$permiso_71=0,$permiso_80=0)
    {

        if($permiso_71==1)
        {
            $this->sel_notas=$data['sel_notas'];
   

        }
       
        if($permiso_80==1)
        {
            $this->sel_empleosocultos=$data['sel_empleosocultos'];
   

        }
       

        if($permisoCalificacion==1)
        {
            $this->sel_calificacion=$data['sel_calificacion'];

        }

        if($this->update())
        {
            return  $respuesta=['estado'=>2,'ese_id'=> $this->ese_id,'sel_id'=>$this->sel_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

    public function formatogabtubos(){
        $reporte= new PdfReporteGabineteTubos();
        $html=$reporte->referenciaslaboralescabecera;
        
        return $html;
    }

    public function formatogabtubosreferenciaslaborales($referencialaboral,$empleo){
        $reporte= new PdfReporteGabineteTubos();
        $html=$reporte->referencialaboral;
        if($empleo==0){
            $html=str_replace("#numempleo#",trim('ÚLTIMO EMPLEO'),$html);
        }else{
            $html=str_replace("#numempleo#",trim('EMPLEO ANTERIOR'),$html);
        }
        $html=str_replace("#rel_candidatoempresa#",trim($referencialaboral->rel_candidatoempresa),$html);
        $html=str_replace("#rel_candidatodomicilio#",trim($referencialaboral->rel_candidatodomicilio),$html);
        $html=str_replace("#rel_candidatojefe#",trim($referencialaboral->rel_candidatojefe),$html);
        $html=str_replace("#rel_candidatotelefono#",trim($referencialaboral->rel_candidatotelefono),$html);
        $html=str_replace("#rel_candidatopuestoinicial#",trim($referencialaboral->rel_candidatopuestoinicial),$html);
        $html=str_replace("#rel_candidatopuestofinal#",trim($referencialaboral->rel_candidatopuestofinal),$html);
        $html=str_replace("#rel_candidatoingreso#",trim($referencialaboral->rel_candidatoingreso),$html);
        $html=str_replace("#rel_candidatosalida#",trim($referencialaboral->rel_candidatosalida),$html);
        $html=str_replace("#rel_candidatosueldoinicial#",trim($referencialaboral->rel_candidatosueldoinicial),$html);
        $html=str_replace("#rel_candidatosueldofinal#",trim($referencialaboral->rel_candidatosueldofinal),$html);
        $html=str_replace("#rel_candidatoseparacion#",trim($referencialaboral->rel_candidatoseparacion),$html);
        $html=str_replace("#rel_candidatoincapacidad#",trim($referencialaboral->rel_candidatoincapacidad),$html);
        $html=str_replace("#rel_candidatodemanda#",trim($referencialaboral->rel_candidatodemanda),$html);
        $html=str_replace("#rel_candidatorecomendable#",trim($referencialaboral->rel_candidatorecomendable),$html);
        $html=str_replace("#rel_rhempresa#",trim($referencialaboral->rel_rhempresa),$html);
        $html=str_replace("#rel_rhdomicilio#",trim($referencialaboral->rel_rhdomicilio),$html);
        $html=str_replace("#rel_rhjefe#",trim($referencialaboral->rel_rhjefe),$html);
        $html=str_replace("#rel_rhtelefono#",trim($referencialaboral->rel_rhtelefono),$html);
        $html=str_replace("#rel_rhpuestoinicial#",trim($referencialaboral->rel_rhpuestoinicial),$html);
        $html=str_replace("#rel_rhpuestofinal#",trim($referencialaboral->rel_rhpuestofinal),$html);
        $html=str_replace("#rel_rhingreso#",trim($referencialaboral->rel_rhingreso),$html);
        $html=str_replace("#rel_rhsalida#",trim($referencialaboral->rel_rhsalida),$html);
        $html=str_replace("#rel_rhsueldoinicial#",trim($referencialaboral->rel_rhsueldoinicial),$html);
        $html=str_replace("#rel_rhsueldofinal#",trim($referencialaboral->rel_rhsueldofinal),$html);
        $html=str_replace("#rel_rhseparacion#",trim($referencialaboral->rel_rhseparacion),$html);
        $html=str_replace("#rel_rhincapacidad#",trim($referencialaboral->rel_rhincapacidad),$html);
        $html=str_replace("#rel_rhdemanda#",trim($referencialaboral->rel_rhdemanda),$html);
        $html=str_replace("#rel_rhrecomendable#",trim($referencialaboral->rel_rhrecomendable),$html);
        $html=str_replace("#rel_notas#",trim($referencialaboral->rel_notas),$html);

        $html=$this->escala($html,'rel_calidad',$referencialaboral->rel_calidad);
        $html=$this->escala($html,'rel_responsabilidad',$referencialaboral->rel_responsabilidad);
        $html=$this->escala($html,'rel_relaciones',$referencialaboral->rel_relaciones);
        $html=$this->escala($html,'rel_honradez',$referencialaboral->rel_honradez);
        $html=$this->escala($html,'rel_asistencia',$referencialaboral->rel_asistencia);
        $html=$this->escala($html,'rel_puntualidad',$referencialaboral->rel_puntualidad);
        $html=$this->escala($html,'rel_iniciativa',$referencialaboral->rel_iniciativa);

        $html=str_replace("#rel_adicciones#",$this->getAdiccion($referencialaboral->rel_adicciones),$html);
            
        return $html;
    }

    public function formatogabtubosperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto=[]){
        $reporte= new PdfReporteGabineteTubos();
        $html=$reporte->periodoinactivo;

        $detalles=count($periodoinactivo);

        for ($i=0; $i <= 2; $i++) {
            if($i<$detalles){
                $html=str_replace("#per_motivo".$i."#",trim($periodoinactivo[$i]->per_motivo),$html);
                $html=str_replace("#per_fecha".$i."#",trim($periodoinactivo[$i]->per_fecha),$html);
            }else{
                $html=str_replace("#per_motivo".$i."#"," ",$html);
                $html=str_replace("#per_fecha".$i."#"," ",$html);
            }
        }
        $html=$this->empleosocultos($html, $seccionlaboral->sel_empleosocultos);
        $html=str_replace("#epl_registros_dinamicos#",$this->empleosocultosRegistros($empleooculto,$seccionlaboral->sel_empleosocultos),$html);

        $html=str_replace("#sel_notas#",trim($seccionlaboral->sel_notas),$html);
        
        return $html;
    }

    public function formatogabencognv(){
        $reporte= new PdfReporteGabineteEncognv();
        $html=$reporte->referenciaslaboralescabecera;
        
        return $html;
    }

    public function formatogabencognvreferenciaslaborales($referencialaboral,$empleo){
        $reporte= new PdfReporteGabineteEncognv();
        $html=$reporte->referencialaboral;
        if($empleo==0){
            $html=str_replace("#numempleo#",trim('ÚLTIMO EMPLEO'),$html);
        }else{
            $html=str_replace("#numempleo#",trim('EMPLEO ANTERIOR'),$html);
        }
        $html=str_replace("#rel_candidatoempresa#",trim($referencialaboral->rel_candidatoempresa),$html);
        $html=str_replace("#rel_candidatodomicilio#",trim($referencialaboral->rel_candidatodomicilio),$html);
        $html=str_replace("#rel_candidatojefe#",trim($referencialaboral->rel_candidatojefe),$html);
        $html=str_replace("#rel_candidatotelefono#",trim($referencialaboral->rel_candidatotelefono),$html);
        $html=str_replace("#rel_candidatopuestoinicial#",trim($referencialaboral->rel_candidatopuestoinicial),$html);
        $html=str_replace("#rel_candidatopuestofinal#",trim($referencialaboral->rel_candidatopuestofinal),$html);
        $html=str_replace("#rel_candidatoingreso#",trim($referencialaboral->rel_candidatoingreso),$html);
        $html=str_replace("#rel_candidatosalida#",trim($referencialaboral->rel_candidatosalida),$html);
        $html=str_replace("#rel_candidatosueldoinicial#",trim($referencialaboral->rel_candidatosueldoinicial),$html);
        $html=str_replace("#rel_candidatosueldofinal#",trim($referencialaboral->rel_candidatosueldofinal),$html);
        $html=str_replace("#rel_candidatoseparacion#",trim($referencialaboral->rel_candidatoseparacion),$html);
        $html=str_replace("#rel_candidatoincapacidad#",trim($referencialaboral->rel_candidatoincapacidad),$html);
        $html=str_replace("#rel_candidatodemanda#",trim($referencialaboral->rel_candidatodemanda),$html);
        $html=str_replace("#rel_candidatorecomendable#",trim($referencialaboral->rel_candidatorecomendable),$html);
        $html=str_replace("#rel_rhempresa#",trim($referencialaboral->rel_rhempresa),$html);
        $html=str_replace("#rel_rhdomicilio#",trim($referencialaboral->rel_rhdomicilio),$html);
        $html=str_replace("#rel_rhjefe#",trim($referencialaboral->rel_rhjefe),$html);
        $html=str_replace("#rel_rhtelefono#",trim($referencialaboral->rel_rhtelefono),$html);
        $html=str_replace("#rel_rhpuestoinicial#",trim($referencialaboral->rel_rhpuestoinicial),$html);
        $html=str_replace("#rel_rhpuestofinal#",trim($referencialaboral->rel_rhpuestofinal),$html);
        $html=str_replace("#rel_rhingreso#",trim($referencialaboral->rel_rhingreso),$html);
        $html=str_replace("#rel_rhsalida#",trim($referencialaboral->rel_rhsalida),$html);
        $html=str_replace("#rel_rhsueldoinicial#",trim($referencialaboral->rel_rhsueldoinicial),$html);
        $html=str_replace("#rel_rhsueldofinal#",trim($referencialaboral->rel_rhsueldofinal),$html);
        $html=str_replace("#rel_rhseparacion#",trim($referencialaboral->rel_rhseparacion),$html);
        $html=str_replace("#rel_rhincapacidad#",trim($referencialaboral->rel_rhincapacidad),$html);
        $html=str_replace("#rel_rhdemanda#",trim($referencialaboral->rel_rhdemanda),$html);
        $html=str_replace("#rel_rhrecomendable#",trim($referencialaboral->rel_rhrecomendable),$html);
        $html=str_replace("#rel_notas#",trim($referencialaboral->rel_notas),$html);

        $html=$this->escala($html,'rel_calidad',$referencialaboral->rel_calidad);
        $html=$this->escala($html,'rel_responsabilidad',$referencialaboral->rel_responsabilidad);
        $html=$this->escala($html,'rel_relaciones',$referencialaboral->rel_relaciones);
        $html=$this->escala($html,'rel_honradez',$referencialaboral->rel_honradez);
        $html=$this->escala($html,'rel_asistencia',$referencialaboral->rel_asistencia);
        $html=$this->escala($html,'rel_puntualidad',$referencialaboral->rel_puntualidad);
        $html=$this->escala($html,'rel_iniciativa',$referencialaboral->rel_iniciativa);

        $html=str_replace("#rel_adicciones#",$this->getAdiccion($referencialaboral->rel_adicciones),$html);
            
        return $html;
    }

    public function formatogabencognvperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto){
        $reporte= new PdfReporteGabineteEncognv();
        $html=$reporte->periodoinactivo;

        $detalles=count($periodoinactivo);

        for ($i=0; $i <= 2; $i++) {
            if($i<$detalles){
                $html=str_replace("#per_motivo".$i."#",trim($periodoinactivo[$i]->per_motivo),$html);
                $html=str_replace("#per_fecha".$i."#",trim($periodoinactivo[$i]->per_fecha),$html);
            }else{
                $html=str_replace("#per_motivo".$i."#"," ",$html);
                $html=str_replace("#per_fecha".$i."#"," ",$html);
            }
        }
        $html=$this->empleosocultos($html, $seccionlaboral->sel_empleosocultos);
       
        $html=str_replace("#epl_registros_dinamicos#",$this->empleosocultosRegistros($empleooculto,$seccionlaboral->sel_empleosocultos),$html);

        $html=str_replace("#sel_notas#",trim($seccionlaboral->sel_notas),$html);
        $html=str_replace("#firma#",basename('images/firmas/firma.jpg'),$html);
        
        return $html;
    }

    public function formatogabsips(){
        $reporte= new PdfReporteGabineteSips();
        $html=$reporte->referenciaslaboralescabecera;
        
        return $html;
    }

    public function formatogabsipsreferenciaslaborales($referencialaboral,$empleo){
        $reporte= new PdfReporteGabineteSips();
        $html=$reporte->referencialaboral;
        if($empleo==0){
            $html=str_replace("#numempleo#",trim('ÚLTIMO EMPLEO'),$html);
        }else{
            $html=str_replace("#numempleo#",trim('EMPLEO ANTERIOR'),$html);
        }
        $html=str_replace("#rel_candidatoempresa#",trim($referencialaboral->rel_candidatoempresa),$html);
        $html=str_replace("#rel_candidatodomicilio#",trim($referencialaboral->rel_candidatodomicilio),$html);
        $html=str_replace("#rel_candidatojefe#",trim($referencialaboral->rel_candidatojefe),$html);
        $html=str_replace("#rel_candidatotelefono#",trim($referencialaboral->rel_candidatotelefono),$html);
        $html=str_replace("#rel_candidatopuestoinicial#",trim($referencialaboral->rel_candidatopuestoinicial),$html);
        $html=str_replace("#rel_candidatopuestofinal#",trim($referencialaboral->rel_candidatopuestofinal),$html);
        $html=str_replace("#rel_candidatoingreso#",trim($referencialaboral->rel_candidatoingreso),$html);
        $html=str_replace("#rel_candidatosalida#",trim($referencialaboral->rel_candidatosalida),$html);
        $html=str_replace("#rel_candidatosueldoinicial#",trim($referencialaboral->rel_candidatosueldoinicial),$html);
        $html=str_replace("#rel_candidatosueldofinal#",trim($referencialaboral->rel_candidatosueldofinal),$html);
        $html=str_replace("#rel_candidatoseparacion#",trim($referencialaboral->rel_candidatoseparacion),$html);
        $html=str_replace("#rel_candidatoincapacidad#",trim($referencialaboral->rel_candidatoincapacidad),$html);
        $html=str_replace("#rel_candidatodemanda#",trim($referencialaboral->rel_candidatodemanda),$html);
        $html=str_replace("#rel_candidatorecomendable#",trim($referencialaboral->rel_candidatorecomendable),$html);
        $html=str_replace("#rel_rhempresa#",trim($referencialaboral->rel_rhempresa),$html);
        $html=str_replace("#rel_rhdomicilio#",trim($referencialaboral->rel_rhdomicilio),$html);
        $html=str_replace("#rel_rhjefe#",trim($referencialaboral->rel_rhjefe),$html);
        $html=str_replace("#rel_rhtelefono#",trim($referencialaboral->rel_rhtelefono),$html);
        $html=str_replace("#rel_rhpuestoinicial#",trim($referencialaboral->rel_rhpuestoinicial),$html);
        $html=str_replace("#rel_rhpuestofinal#",trim($referencialaboral->rel_rhpuestofinal),$html);
        $html=str_replace("#rel_rhingreso#",trim($referencialaboral->rel_rhingreso),$html);
        $html=str_replace("#rel_rhsalida#",trim($referencialaboral->rel_rhsalida),$html);
        $html=str_replace("#rel_rhsueldoinicial#",trim($referencialaboral->rel_rhsueldoinicial),$html);
        $html=str_replace("#rel_rhsueldofinal#",trim($referencialaboral->rel_rhsueldofinal),$html);
        $html=str_replace("#rel_rhseparacion#",trim($referencialaboral->rel_rhseparacion),$html);
        $html=str_replace("#rel_rhincapacidad#",trim($referencialaboral->rel_rhincapacidad),$html);
        $html=str_replace("#rel_rhdemanda#",trim($referencialaboral->rel_rhdemanda),$html);
        $html=str_replace("#rel_rhrecomendable#",trim($referencialaboral->rel_rhrecomendable),$html);
        $html=str_replace("#rel_notas#",trim($referencialaboral->rel_notas),$html);

        $html=$this->escala($html,'rel_calidad',$referencialaboral->rel_calidad);
        $html=$this->escala($html,'rel_responsabilidad',$referencialaboral->rel_responsabilidad);
        $html=$this->escala($html,'rel_relaciones',$referencialaboral->rel_relaciones);
        $html=$this->escala($html,'rel_honradez',$referencialaboral->rel_honradez);
        $html=$this->escala($html,'rel_asistencia',$referencialaboral->rel_asistencia);
        $html=$this->escala($html,'rel_puntualidad',$referencialaboral->rel_puntualidad);
        $html=$this->escala($html,'rel_iniciativa',$referencialaboral->rel_iniciativa);

        $html=str_replace("#rel_adicciones#",$this->getAdiccion($referencialaboral->rel_adicciones),$html);
            
        return $html;
    }

    public function formatogabsipsperiodosinactivos($periodoinactivo, $seccionlaboral,$empleooculto){
        $reporte= new PdfReporteGabineteSips();
        $html=$reporte->periodoinactivo;

        $detalles=count($periodoinactivo);

        for ($i=0; $i <= 2; $i++) {
            if($i<$detalles){
                $html=str_replace("#per_motivo".$i."#",trim($periodoinactivo[$i]->per_motivo),$html);
                $html=str_replace("#per_fecha".$i."#",trim($periodoinactivo[$i]->per_fecha),$html);
            }else{
                $html=str_replace("#per_motivo".$i."#"," ",$html);
                $html=str_replace("#per_fecha".$i."#"," ",$html);
            }
        }
        $html=$this->empleosocultos($html, $seccionlaboral->sel_empleosocultos);
        $html=str_replace("#epl_registros_dinamicos#",$this->empleosocultosRegistros($empleooculto,$seccionlaboral->sel_empleosocultos),$html);

        $html=str_replace("#sel_notas#",trim($seccionlaboral->sel_notas),$html);
        $html=str_replace("#firma#",basename('images/firmas/firma.jpg'),$html);
        
        return $html;
    }
    public function crearRegistroAutomatico($ese_id){
        $nuevo_registro_seccion_laboral=new Seccionlaboral();
        $nuevo_registro_seccion_laboral->ese_id=$ese_id;
        $nuevo_registro_seccion_laboral->sel_estatus=2;
        
        if($nuevo_registro_seccion_laboral->save()){
            return ['estado'=>2,'mensaje'=>'ok','ese_id'=>$nuevo_registro_seccion_laboral->ese_id,'sel_id'=>$nuevo_registro_seccion_laboral->sel_id];

        }else{
            return ['estado'=>-2,'mensaje'=>'error'];
        }

    }


    public function empleosocultosRegistros($data,$empleos_ocultos_si_no){
        $html_retornar='';
     
    

     
        if(count($data)>0 && $empleos_ocultos_si_no==1){
            
                for ($i=0; $i <= 4 ; $i++) { 
                    if (isset($data[$i])) {
                        $tabla_nueva='
                        <table style="font-family:Montserrat,sans-serif;  width:100%" class="tableDatos">
                                <tbody>
                                    <tr >
                                        <th style="font-size: 10px;text-align:center; width:26%; ">Empleo oculto '.($i+1).'</th>
                                        <th style="font-size: 10px;text-align:center; width:37%">DATOS PROPORCIONADOS POR R.H.</th>
                                    </tr>   
                                    <tr style="background-color:#CCE4ED">
                                        <td style="font-size: 10px; color:#044B7B">NOMBRE DE LA EMPRESA</td>
                                        <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_empresa.'</td>
                                    </tr>   
                                    <tr>
                                        <td style="font-size: 10px; color:#044B7Bx">TELÉFONO</td>
                                        <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_telefono.'</td>
                                    </tr>   
                                    <tr style="background-color:#CCE4ED">
                                        <td style="font-size: 10px; color:#044B7B; background-color:#CCE4ED">FECHA INGRESO</td>
                                        <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_fechaingreso.'</td>
                                    </tr>   
                                    <tr>
                                        <td style="font-size: 10px; color:#044B7B">FECHA SALIDA</td>
                                        <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_fechasalida.'</td>
                                    </tr>   
                                    <tr style="background-color:#CCE4ED">
                                        <td style="font-size: 10px;color:#044B7B;background-color:#CCE4ED">¿HUBO DEMANDA  O PLÁTICAS CONCILIATORIAS
                                        <br>
                                        EN LA SEPARACIÓN DEL EMPLEO?</td>
                                        <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_demanda.'</td>
                                    </tr>   
                                 
                                    <tr style="background-color:white">
                                        <td style="font-size: 10px;color:#044B7B;background-color:white">MOTIVO DE SEPARACIÓN</td>
                                        <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_motivoseparacion.'</td>
                                    </tr>

                                    <tr style="background-color:#CCE4ED">

                                          <td style="font-size: 10px;color:#044B7B;background-color:#CCE4ED">RECOMENDABLE</td>
                                          <td style="font-size: 10px;text-align:center">'.$data[$i]->epl_recomendable.'</td>
                                     </tr>
                            
                                </tbody>
                        </table>
                        
                        <br>

                        ';

                        $espacio_extra='';

                        if($i==0){
                        $espacio_extra='
                        <br>
                        <br>';
                        }
                        $tabla_nueva.=$espacio_extra;
                        $html_retornar.=$tabla_nueva;
                    } 
                  
                }


        }

       
     
        return $html_retornar;

    }

    public function formatogabencognvreferenciaslaborales_V2_Responsive($referencialaboral,$empleo,$mpdf,$habilitarSaltoAutomatico=1){
        $reporte= new PdfReporteGabineteEncognv();
        $html_para_imprimir="";
        $default_font_size_px_commentario=12;
        $rel_notas_height_size="auto";
        $html_completo=$reporte->array_referencialaboral;
        $html_referencias_lab=$html_completo["referencias_lab"];
        $html_referencias_comentario=$html_completo["comentario"];
        $html_referencias_escala_desempenio=$html_completo["escala_desempenio"];

        if($empleo==0){$html_referencias_lab=str_replace("#numempleo#",trim('ÚLTIMO EMPLEO'),$html_referencias_lab); }
        else{$html_referencias_lab=str_replace("#numempleo#",trim('EMPLEO ANTERIOR'),$html_referencias_lab);}
        
        if($empleo==1){$mpdf->AddPage();}

        $html_referencias_lab=str_replace("#rel_candidatoempresa#",trim($referencialaboral->rel_candidatoempresa),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatodomicilio#",trim($referencialaboral->rel_candidatodomicilio),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatoempresa#",trim($referencialaboral->rel_candidatoempresa),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatodomicilio#",trim($referencialaboral->rel_candidatodomicilio),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatojefe#",trim($referencialaboral->rel_candidatojefe),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatotelefono#",trim($referencialaboral->rel_candidatotelefono),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatopuestoinicial#",trim($referencialaboral->rel_candidatopuestoinicial),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatopuestofinal#",trim($referencialaboral->rel_candidatopuestofinal),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatoingreso#",trim($referencialaboral->rel_candidatoingreso),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatosalida#",trim($referencialaboral->rel_candidatosalida),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatosueldoinicial#",trim($referencialaboral->rel_candidatosueldoinicial),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatosueldofinal#",trim($referencialaboral->rel_candidatosueldofinal),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatoseparacion#",trim($referencialaboral->rel_candidatoseparacion),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatoincapacidad#",trim($referencialaboral->rel_candidatoincapacidad),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatodemanda#",trim($referencialaboral->rel_candidatodemanda),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_candidatorecomendable#",trim($referencialaboral->rel_candidatorecomendable),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhempresa#",trim($referencialaboral->rel_rhempresa),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhdomicilio#",trim($referencialaboral->rel_rhdomicilio),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhjefe#",trim($referencialaboral->rel_rhjefe),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhtelefono#",trim($referencialaboral->rel_rhtelefono),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhpuestoinicial#",trim($referencialaboral->rel_rhpuestoinicial),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhpuestofinal#",trim($referencialaboral->rel_rhpuestofinal),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhingreso#",trim($referencialaboral->rel_rhingreso),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhsalida#",trim($referencialaboral->rel_rhsalida),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhsueldoinicial#",trim($referencialaboral->rel_rhsueldoinicial),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhsueldofinal#",trim($referencialaboral->rel_rhsueldofinal),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhseparacion#",trim($referencialaboral->rel_rhseparacion),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhincapacidad#",trim($referencialaboral->rel_rhincapacidad),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhdemanda#",trim($referencialaboral->rel_rhdemanda),$html_referencias_lab);
        $html_referencias_lab=str_replace("#rel_rhrecomendable#",trim($referencialaboral->rel_rhrecomendable),$html_referencias_lab);
        
        $cabe_en_pagina_referencia_lab = MpdfHelper::html_cabe_en_pagina($html_referencias_lab, $mpdf);
        if ($habilitarSaltoAutomatico==1) {
            if (!$cabe_en_pagina_referencia_lab) $mpdf->AddPage();
        }
        $mpdf->WriteHTML($html_referencias_lab);
        $longitud_rel_notas = strlen($referencialaboral->rel_notas);
        switch ($longitud_rel_notas) {
            case ($longitud_rel_notas >= 370 && $longitud_rel_notas < 470):
                // $default_font_size_px_commentario=11;
                break;
            case ($longitud_rel_notas >= 570 && $longitud_rel_notas < 800):
                    // $default_font_size_px_commentario=10;
                    break;
            case ($longitud_rel_notas ==0):
                        $rel_notas_height_size="30px";
                    break;
            
        }
        
        $html_referencias_comentario=str_replace("#rel_notas#",trim($referencialaboral->rel_notas),$html_referencias_comentario);
        $html_referencias_comentario=str_replace("#style_in_linea_rel_notas#",trim($reporte->calcularFontSizeComentarioNotaDinamico($referencialaboral->rel_notas,11.5)),$html_referencias_comentario);
        $html_referencias_comentario=str_replace("#rel_notas_height_size#",trim($rel_notas_height_size),$html_referencias_comentario);

        $cabe_en_pagina_html_referencias_comentario= MpdfHelper::html_cabe_en_pagina($html_referencias_comentario, $mpdf);
        if ($habilitarSaltoAutomatico==1) {
            if (!$cabe_en_pagina_html_referencias_comentario) $mpdf->AddPage();
        }
        $mpdf->WriteHTML($html_referencias_comentario);

        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_calidad',$referencialaboral->rel_calidad);
        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_responsabilidad',$referencialaboral->rel_responsabilidad);
        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_relaciones',$referencialaboral->rel_relaciones);
        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_honradez',$referencialaboral->rel_honradez);
        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_asistencia',$referencialaboral->rel_asistencia);
        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_puntualidad',$referencialaboral->rel_puntualidad);
        $html_referencias_escala_desempenio=$this->escala($html_referencias_escala_desempenio,'rel_iniciativa',$referencialaboral->rel_iniciativa);
        $html_referencias_escala_desempenio=str_replace("#rel_adicciones#",$this->getAdiccion($referencialaboral->rel_adicciones),$html_referencias_escala_desempenio);

        $html_referencias_escala_desempenio=str_replace("#rel_notas#",trim($referencialaboral->rel_notas),$html_referencias_escala_desempenio);
        $cabe_en_pagina_html_referencias_escala_desempenio= MpdfHelper::html_cabe_en_pagina($html_referencias_escala_desempenio, $mpdf,0);
        
        if ($habilitarSaltoAutomatico==1) {
            // error_log("update");
            if (!$cabe_en_pagina_html_referencias_escala_desempenio) $mpdf->AddPage();
        }
        $mpdf->WriteHTML($html_referencias_escala_desempenio);
    
       # $html_para_imprimir=$html_referencias_lab;
        return $html_para_imprimir;
    }

}