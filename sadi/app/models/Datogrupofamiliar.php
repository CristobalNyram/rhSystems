<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 *
 *  Modelo de la tabla puesto
 * 
 */
class Datogrupofamiliar extends Model
{
    public function NuevoRegistro($datos,$ese_id,$permisocalificacion)
    {
        $nuevoRegistroDatoGrupoFamiliar = new Datogrupofamiliar();
        $nuevoRegistroDatoGrupoFamiliar->dgf_matrimoniopadres =$datos['dgf_matrimoniopadres'];
        $nuevoRegistroDatoGrupoFamiliar->ese_id =$ese_id;
        $nuevoRegistroDatoGrupoFamiliar->dgf_estatus =2;

        if($permisocalificacion==1)
        {
            $calificacion= ($datos['dgf_calificacion']>=1)?$datos['dgf_calificacion']:null;
            $nuevoRegistroDatoGrupoFamiliar->dgf_calificacion= $calificacion;

        }
        

        if ($nuevoRegistroDatoGrupoFamiliar->save()) {
            return  $repuesta=['estado'=>2,'dgf_id'=>$nuevoRegistroDatoGrupoFamiliar->dgf_id,'ese_id'=> $nuevoRegistroDatoGrupoFamiliar->ese_id];
        }
        else
        {
            return  $repuesta=['estado'=>0,];

        }
        
    }

    public function ActualizarRegistro($datos,$permisocalificacion)
    {
        if($permisocalificacion==1)
        {
        $calificacion= ($datos['dgf_calificacion']>=1)?$datos['dgf_calificacion']:null;
        $this->dgf_calificacion= $calificacion;

        }
        $this->dgf_matrimoniopadres=$datos['dgf_matrimoniopadres'];
        $this->dgf_estatus=2;


        if($this->save())
        {
            return  $repuesta=['estado'=>2,'dgf_id'=>$this->dgf_id,'ese_id'=> $this->ese_id];

        }
        else
        {
            return  $repuesta=['estado'=>0,];

        }

    }

    public function getVive($id){
        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SÍ";
            default:
                return "";
        }
    }

    public function formatoeses($datogrupofamiliar,$datogrupofamiliardetalles_vive_con,$datogrupofamiliardetalles_NO_vive_con)
    {
        $reporte= new PdfReporte();
        $html=$reporte->datogrupofamiliar_formato_separado;
        $html=str_replace("#dgf_matrimoniopadres#",trim($datogrupofamiliar->dgf_matrimoniopadres),$html);
        $detalles_vive_con=count($datogrupofamiliardetalles_vive_con);
        $detalles_NO_vive_con=count($datogrupofamiliardetalles_NO_vive_con);

        $estadocivil= new Estadocivil();
        $nivelestudio= new Nivelestudio();
 
        //validamos que existan registros de detalles de grupo familiar que vivan con el candidato
        if($detalles_vive_con==0){
            $html=str_replace("#style_tabla_vive_con_el_candidato","display:none;",$html);

        }else{
            $html=str_replace("#style_tabla_vive_con_el_candidato","display:block;",$html);

        }
        
        //validamos que existan registros de detalles de grupo familiar que NO vivan con el candidato

        if($detalles_NO_vive_con==0){
            $html=str_replace("#style_tabla_no_vive_con_el_candidato","display:none;",$html);

        }else{
            $html=str_replace("#style_tabla_no_vive_con_el_candidato","display:block;",$html);

        }

        //Pintamos las columnas 
        for ($i=0; $i <= 5; $i++) {
            if($i<$detalles_vive_con){

           
                    if($datogrupofamiliardetalles_vive_con[$i]->dgd_viveusted==1){

                        $html=str_replace("#dgd_nombre".$i."#",trim($datogrupofamiliardetalles_vive_con[$i]->dgd_nombre),$html);
                        $html=str_replace("#dgd_parentesco".$i."#",trim($datogrupofamiliardetalles_vive_con[$i]->dgd_parentesco),$html); 
                        $html=str_replace("#dgd_edad".$i."#",trim($datogrupofamiliardetalles_vive_con[$i]->dgd_edad),$html);
                        $html=str_replace("#esc_id".$i."#",$estadocivil->getNombreEstadoCivil($datogrupofamiliardetalles_vive_con[$i]->esc_id),$html);
                        $html=str_replace("#niv_id".$i."#",$nivelestudio->getNombreNivelEstudio($datogrupofamiliardetalles_vive_con[$i]->niv_id),$html);
                    }    
              
              //  $html=str_replace("#dgd_viveusted".$i."#",$this->getVive($datogrupofamiliardetalles[$i]->dgd_viveusted),$html);  
            }else{
                
                $html=str_replace("#dgd_nombre".$i."#"," ",$html);
                $html=str_replace("#dgd_parentesco".$i."#"," ",$html);
                $html=str_replace("#dgd_edad".$i."#"," ",$html);
                $html=str_replace("#esc_id".$i."#"," ",$html);
                $html=str_replace("#niv_id".$i."#"," ",$html);
                $html=str_replace("#dgd_viveusted".$i."#"," ",$html);

      
                
            }
            if($i<$detalles_NO_vive_con){

        

                    $html=str_replace("#dgd_nombre_no_vive_con".$i."#",trim($datogrupofamiliardetalles_NO_vive_con[$i]->dgd_nombre),$html);
                    $html=str_replace("#dgd_parentesco_no_vive_con".$i."#",trim($datogrupofamiliardetalles_NO_vive_con[$i]->dgd_parentesco),$html); 
                    $html=str_replace("#dgd_edad_no_vive_con".$i."#",trim($datogrupofamiliardetalles_NO_vive_con[$i]->dgd_edad),$html);
                    $html=str_replace("#esc_id_no_vive_con".$i."#",$estadocivil->getNombreEstadoCivil($datogrupofamiliardetalles_NO_vive_con[$i]->esc_id),$html);
                    $html=str_replace("#niv_id_no_vive_con".$i."#",$nivelestudio->getNombreNivelEstudio($datogrupofamiliardetalles_NO_vive_con[$i]->niv_id),$html);
             
          
          //  $html=str_replace("#dgd_viveusted".$i."#",$this->getVive($datogrupofamiliardetalles[$i]->dgd_viveusted),$html);  
            }else{
                
                $html=str_replace("#dgd_nombre_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#dgd_parentesco_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#dgd_edad_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#esc_id_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#niv_id_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#dgd_viveusted_no_vive_con".$i."#"," ",$html);

    
                
            }
        
        }
        
        return $html;
    }

    public function formatogabtubos($datogrupofamiliar,$datogrupofamiliardetalles_vive_con,$datogrupofamiliardetalles_NO_vive_con)
    {
        $reporte= new PdfReporteGabineteTubos();
        $html=$reporte->datogrupofamiliar;
        $html=str_replace("#dgf_matrimoniopadres#",trim($datogrupofamiliar->dgf_matrimoniopadres),$html);
        $detalles_vive_con=count($datogrupofamiliardetalles_vive_con);
        $detalles_NO_vive_con=count($datogrupofamiliardetalles_NO_vive_con);

        $estadocivil= new Estadocivil();
        $nivelestudio= new Nivelestudio();

           //validamos que existan registros de detalles de grupo familiar que vivan con el candidato
        if($detalles_vive_con==0){
            $html=str_replace("#style_tabla_vive_con_el_candidato","display:none;",$html);

        }else{
            $html=str_replace("#style_tabla_vive_con_el_candidato","display:block;",$html);

        }
        
        //validamos que existan registros de detalles de grupo familiar que NO vivan con el candidato

        if($detalles_NO_vive_con==0){
            $html=str_replace("#style_tabla_no_vive_con_el_candidato","display:none;",$html);

        }else{
            $html=str_replace("#style_tabla_no_vive_con_el_candidato","display:block;",$html);

        }

        for ($i=0; $i <= 5; $i++) {
            if($i<$detalles_vive_con){
                $html=str_replace("#dgd_nombre".$i."#",trim($datogrupofamiliardetalles_vive_con[$i]->dgd_nombre),$html);
                $html=str_replace("#dgd_parentesco".$i."#",trim($datogrupofamiliardetalles_vive_con[$i]->dgd_parentesco),$html);
                $html=str_replace("#dgd_edad".$i."#",trim($datogrupofamiliardetalles_vive_con[$i]->dgd_edad),$html);
                $html=str_replace("#esc_id".$i."#",$estadocivil->getNombreEstadoCivil($datogrupofamiliardetalles_vive_con[$i]->esc_id),$html);
                $html=str_replace("#niv_id".$i."#",$nivelestudio->getNombreNivelEstudio($datogrupofamiliardetalles_vive_con[$i]->niv_id),$html);
                $html=str_replace("#dgd_viveusted".$i."#",$this->getVive($datogrupofamiliardetalles_vive_con[$i]->dgd_viveusted),$html);
            }else{
                $html=str_replace("#dgd_nombre".$i."#"," ",$html);
                $html=str_replace("#dgd_parentesco".$i."#"," ",$html);
                $html=str_replace("#dgd_edad".$i."#"," ",$html);
                $html=str_replace("#esc_id".$i."#"," ",$html);
                $html=str_replace("#niv_id".$i."#"," ",$html);
                $html=str_replace("#dgd_viveusted".$i."#"," ",$html);
            }



            
            if($i<$detalles_NO_vive_con){

        

                    $html=str_replace("#dgd_nombre_no_vive_con".$i."#",trim($datogrupofamiliardetalles_NO_vive_con[$i]->dgd_nombre),$html);
                    $html=str_replace("#dgd_parentesco_no_vive_con".$i."#",trim($datogrupofamiliardetalles_NO_vive_con[$i]->dgd_parentesco),$html); 
                    $html=str_replace("#dgd_edad_no_vive_con".$i."#",trim($datogrupofamiliardetalles_NO_vive_con[$i]->dgd_edad),$html);
                    $html=str_replace("#esc_id_no_vive_con".$i."#",$estadocivil->getNombreEstadoCivil($datogrupofamiliardetalles_NO_vive_con[$i]->esc_id),$html);
                    $html=str_replace("#niv_id_no_vive_con".$i."#",$nivelestudio->getNombreNivelEstudio($datogrupofamiliardetalles_NO_vive_con[$i]->niv_id),$html);
             
          
          //  $html=str_replace("#dgd_viveusted".$i."#",$this->getVive($datogrupofamiliardetalles[$i]->dgd_viveusted),$html);  
            }else{
                
                $html=str_replace("#dgd_nombre_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#dgd_parentesco_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#dgd_edad_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#esc_id_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#niv_id_no_vive_con".$i."#"," ",$html);
                $html=str_replace("#dgd_viveusted_no_vive_con".$i."#"," ",$html);

    
                
            }


        }
        
        return $html;
    }

    public function ActualizarRegistroFormatoTruper($data,$permisocalificacion){

        $this->dgf_comentario=$data['dgf_comentario'];

        if($this->save())
        {
            return  $repuesta=['estado'=>2,'dgf_id'=>$this->dgf_id,'ese_id'=> $this->ese_id];
        }
        else
        {
            return  $repuesta=['estado'=>0,];
        }
       


   
    }

 

}