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

  

    public function getTodasCalificaciones(){
        return $this->califaciones_sel;
    }

    /**
     * Reemplaza marcadores específicos en una cadena HTML con "X" basado en el valor proporcionado.
     *
     * @param string $html La cadena HTML en la que se realizarán los reemplazos.
     * @param string $campo El identificador de campo utilizado para crear marcadores.
     * @param int $valor El valor que determina cuál marcador se reemplazará con "X" (1, 2, 3 o 4).
     *
     * @return string La cadena HTML modificada después de realizar los reemplazos.
     */
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


  
    public function ActualizarRegistro($data,$permiso_notas=0,$permiso_empleos=0,$permisoCalificacion=0,$permiso_solicitar_aux=0)
    {
        $respuesta["estado"]=2;
        if($permiso_notas==1)
        {
            $this->sel_notas=$data['sel_notas'];
        }
       
        if($permiso_empleos==1)
        {
            $this->sel_empleosocultos=$data['sel_empleosocultos'];
        }


        if($permiso_solicitar_aux==1)
        {
            $this->sel_necesitoauxiliar=$data['sel_necesitoauxiliar'];
            $this->usu_idauxiliar=$data['usu_idauxiliar'];
    
        }
     
        
        if($permisoCalificacion==1)
        {
            $this->sel_calificacion=$data['sel_calificacion'];
        }

        if($this->update())
            return  $respuesta=['estado'=>2,'exc_id'=> $this->exc_id,'sel_id'=>$this->sel_id];
       
    }


    public function datosPersonales_Reporte($html,$data){
    
        $answer=[];
        $html_nuevo=$html;
        $html_nuevo=str_replace("#nombre_completo#",trim($data->can_nombre),$html_nuevo);
        $html_nuevo=str_replace("#empresa#",trim($data->emp_nombre),$html_nuevo);
        $html_nuevo=str_replace("#puesto#",trim($data->cav_nombre),$html_nuevo);
     
     
        $answer["html"]= $html_nuevo;
        return $answer;
    }
    public function referenciasLaborales_Reporte($html,$data,$empleo){ 
        $answer=[];
        $html_nuevo=$html;
        if($empleo==0){
            $html_nuevo=str_replace("#numempleo#",trim('ÚLTIMO EMPLEO'),$html_nuevo);
        }else{
            $html_nuevo=str_replace("#numempleo#",trim('EMPLEO ANTERIOR'),$html_nuevo);
        } 
        $html_nuevo=str_replace("#rel_candidatoempresa#",trim($data->rel_candidatoempresa),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatodomicilio#",trim($data->rel_candidatodomicilio),$html_nuevo);

        $html_nuevo=str_replace("#rel_candidatojefe#",trim($data->rel_candidatojefe),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatotelefono#",trim($data->rel_candidatotelefono),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatopuestoinicial#",trim($data->rel_candidatopuestoinicial),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatopuestofinal#",trim($data->rel_candidatopuestofinal),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatoingreso#",trim($data->rel_candidatoingreso),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatosalida#",trim($data->rel_candidatosalida),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatosueldoinicial#",trim($data->rel_candidatosueldoinicial),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatosueldofinal#",trim($data->rel_candidatosueldofinal),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatoseparacion#",trim($data->rel_candidatoseparacion),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatoincapacidad#",trim($data->rel_candidatoincapacidad),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatodemanda#",trim($data->rel_candidatodemanda),$html_nuevo);
        $html_nuevo=str_replace("#rel_candidatorecomendable#",trim($data->rel_candidatorecomendable),$html_nuevo);

        $html_nuevo=str_replace("#rel_rhempresa#",trim($data->rel_rhempresa),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhdomicilio#",trim($data->rel_rhdomicilio),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhjefe#",trim($data->rel_rhjefe),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhtelefono#",trim($data->rel_rhtelefono),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhpuestoinicial#",trim($data->rel_rhpuestoinicial),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhpuestofinal#",trim($data->rel_rhpuestofinal),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhingreso#",trim($data->rel_rhingreso),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhsalida#",trim($data->rel_rhsalida),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhsueldoinicial#",trim($data->rel_rhsueldoinicial),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhsueldofinal#",trim($data->rel_rhsueldofinal),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhseparacion#",trim($data->rel_rhseparacion),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhincapacidad#",trim($data->rel_rhincapacidad),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhdemanda#",trim($data->rel_rhdemanda),$html_nuevo);
        $html_nuevo=str_replace("#rel_rhrecomendable#",trim($data->rel_rhrecomendable),$html_nuevo);
        $html_nuevo=str_replace("#rel_notas#",trim($data->rel_notas),$html_nuevo);

        $html_nuevo=$this->escala($html_nuevo,'rel_calidad',$data->rel_calidad);
        $html_nuevo=$this->escala($html_nuevo,'rel_responsabilidad',$data->rel_responsabilidad);
        $html_nuevo=$this->escala($html_nuevo,'rel_relaciones',$data->rel_relaciones);
        $html_nuevo=$this->escala($html_nuevo,'rel_honradez',$data->rel_honradez);
        $html_nuevo=$this->escala($html_nuevo,'rel_asistencia',$data->rel_asistencia);
        $html_nuevo=$this->escala($html_nuevo,'rel_puntualidad',$data->rel_puntualidad);
        $html_nuevo=$this->escala($html_nuevo,'rel_iniciativa',$data->rel_iniciativa);
        $html_nuevo=str_replace("#rel_adicciones#",$this->getAdiccion($data->rel_adicciones),$html_nuevo);
        $answer["html"]= $html_nuevo;
        return $answer;
    }


 
    public function escalaDesempenio_Reporte($html,$data){
     
        setlocale(LC_TIME, 'es_ES');

        $answer=[];
      
        $answer["html"]= $html_nuevo;
        return $answer;
    }

    public function periodoInactividadEmpleosOcultosPeriodoInactividad_Reporte($html,$data,$data_empleooculto,$data_periodoinactivo){

        setlocale(LC_TIME, 'es_ES');
        

        $answer=[];
        $html_nuevo=$html;

        $html_nuevo=str_replace("#epl_registros_dinamicos#",$this->empleosocultosRegistros($data_empleooculto,$data->sel_empleosocultos),$html_nuevo);
        $html_nuevo=$this->formatoesesperiodosinactivosRegistroDinamicos($data_periodoinactivo, $html_nuevo);

        $html_nuevo=$this->empleosocultos($html_nuevo, $data->sel_empleosocultos);//realiza el check de si o no
        $html_nuevo=str_replace("#sel_notas#",trim($data->sel_notas),$html_nuevo);
        $answer["html"]= $html_nuevo;
        return $answer;
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

    public function formatoesesperiodosinactivos($periodoinactivo, $html){
       
     

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
       

        
        return $html;
    }
    
    public function formatoesesperiodosinactivosRegistroDinamicos($periodoinactivo, $html ){
        
        $detalles=count($periodoinactivo);
      
        $html_rows = '';

       
        for ($i = 0; $i <= $detalles; $i++) {
            if($i<$detalles){
                $html_rows .= '<tr>';
            
               
                if ($i === 0) {
                    $html_rows .= '<td style="font-size: 10px;text-align:center; "></td>';
                    $html_rows .= '<td style="font-size: 10px">PERIODOS DE INACTIVIDAD</td>';
                } else {
                    $html_rows .= '<td style="font-size: 10px;text-align:center; "></td>';
                    $html_rows .= '<td style="font-size: 10px;text-align:center; "></td>';
                }
            
                
                $motivo = ($i < $detalles) ? trim($periodoinactivo[$i]->per_motivo) : ' ';
                $fecha = ($i < $detalles) ? trim($periodoinactivo[$i]->per_fecha) : ' ';
                $html_rows .= '<td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;">' . $motivo . '</td>';
                $html_rows .= '<td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;">' . $fecha . '</td>';
                $html_rows .= '<td style="font-size: 10px;text-align:center; "></td>';
                
                $html_rows .= '</tr>';
            }
           
        }

        if($detalles==0){
            $html_rows .= '<tr>';
            $html_rows .= '<td style="font-size: 10px;text-align:center; "></td>';
            $html_rows .= '<td style="font-size: 10px">PERIODOS DE INACTIVIDAD</td>';
            $html_rows .= '<td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;"></td>';
            $html_rows .= '<td colspan="2" style="height:20px; font-size: 10px;background-color:#CCE4ED;text-align:center;"></td>';
            $html_rows .= '<td style="font-size: 10px;text-align:center; "></td>';
            $html_rows .= '</tr>';
        }

        
      
        
        $html=str_replace("#per_registros_dinamicos#",$html_rows,$html);


        
        return $html;
    }

    
}