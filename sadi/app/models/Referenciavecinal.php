<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Bieninmuebledetalles
 */
class Referenciavecinal extends Model
{
    public function NuevoRegistro($data){
        $registro_rev= new Referenciavecinal();
        $registro_rev->rev_nombre=trim($data['rev_nombre_crear']);
        $registro_rev->rev_tiempo=$data['rev_tiempo_crear'];
        $registro_rev->rev_domicilio=$data['rev_domicilio_crear'];
        $registro_rev->rev_telefono=$data['rev_telefono_crear'];
        $registro_rev->rev_conceptocandidato=  $data['rev_conceptocandidato_crear'] ;
        $registro_rev->rev_conceptofamilia=  $data['rev_conceptofamilia_crear'] ;
        $registro_rev->rev_trabaja= $data['rev_trabaja_crear'] ;
        $registro_rev->rev_hijos=   $data['rev_hijos_crear'] ;
        $registro_rev->esc_id=   $data['rev_esc_id_crear'] ;
        $registro_rev->rev_estatus=   2 ;

        $registro_rev->rev_notas=   $data['rev_notas_crear'] ;
        $registro_rev->sep_id=   $data['rev_sep_id'] ;


        
        if($registro_rev->save()){
            return  $repuesta=['estado'=>2,'rev_id'=> $registro_rev->rev_id,'sep_id'=> $registro_rev->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }

    public function ActualizarRegistro($data){
        // $registro_rev= new Referenciavecinal();
        $this->rev_nombre=trim($data['rev_nombre_editar']);
        $this->rev_tiempo=$data['rev_tiempo_editar'];
        $this->rev_domicilio=$data['rev_domicilio_editar'];
        $this->rev_telefono=$data['rev_telefono_editar'];
        $this->rev_conceptocandidato=  $data['rev_conceptocandidato_editar'] ;
        $this->rev_conceptofamilia=  $data['rev_conceptofamilia_editar'] ;
        $this->rev_trabaja= $data['rev_trabaja_editar'] ;
        $this->rev_hijos=   $data['rev_hijos_editar'] ;
        // $this->esc_id=   $data['esc_id_editar'] ;
        $this->rev_notas=   $data['rev_notas_editar'] ;
        $this->esc_id=   $data['rev_esc_id_editar'] ;

        $this->rev_estatus=   2 ;


        
        if($this->save()){
            return  $repuesta=['estado'=>2,'rev_id'=> $this->rev_id,'sep_id'=> $this->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }

    public function getSiNo($valor)
    {
        switch ($valor){
            case "0":
                return "NO";
            case "1":
                return "SI";
            default:
                return "";
        }

    }


    public function NuevoRegistroFormatoTruper($data){

        $registro_rev= new Referenciavecinal();
        $registro_rev->rev_nombre=trim($data['rev_nombre']);
        $registro_rev->rev_edad=$data['rev_edad'];
        $registro_rev->rev_telefono=$data['rev_telefono'];
        $registro_rev->rev_domicilio=$data['rev_domicilio'];
        $registro_rev->rev_tiempo=  $data['rev_tiempo'] ;
        $registro_rev->rev_comoloconocio=  $data['rev_comoloconocio'] ;
        $registro_rev->rev_conocesudomicilio= $data['rev_conocesudomicilio'] ;
        $registro_rev->rev_conocesuestadocivil=   $data['rev_conocesuestadocivil'] ;
        $registro_rev->rev_conocesuempleo=   $data['rev_conocesuempleo'] ;
        $registro_rev->rev_lorecomienda=   $data['rev_lorecomienda'] ;

        

        $registro_rev->rev_conocesupasatiempos=   $data['rev_conocesupasatiempos'] ;
        $registro_rev->rev_conceptodeelella=   $data['rev_conceptodeelella'] ;
        $registro_rev->rev_notas=   $data['rev_notas'] ;
        $registro_rev->sep_id=   $data['sep_id'] ;

       
        
        $registro_rev->rev_estatus=   2 ;



        
        if($registro_rev->save()){
            return  $repuesta=['estado'=>2,'rev_id'=> $registro_rev->rev_id,'sep_id'=> $registro_rev->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }



    public function ActualizarRegistroFormatoTruper($data){

        $this->rev_nombre=trim($data['rev_nombre']);
        $this->rev_edad=$data['rev_edad'];
        $this->rev_telefono=$data['rev_telefono'];
        $this->rev_domicilio=$data['rev_domicilio'];
        $this->rev_tiempo=  $data['rev_tiempo'] ;
        $this->rev_comoloconocio=  $data['rev_comoloconocio'] ;
        $this->rev_conocesudomicilio= $data['rev_conocesudomicilio'] ;
        $this->rev_conocesuestadocivil=   $data['rev_conocesuestadocivil'] ;
        $this->rev_conocesuempleo=   $data['rev_conocesuempleo'] ;
        $this->rev_lorecomienda=   $data['rev_lorecomienda'] ;

        

        $this->rev_conocesupasatiempos=   $data['rev_conocesupasatiempos'] ;
        $this->rev_conceptodeelella=   $data['rev_conceptodeelella'] ;
        $this->rev_notas=   $data['rev_notas'] ;
       


        
        if($this->update()){
            return  $repuesta=['estado'=>2,'rev_id'=> $this->rev_id,'sep_id'=> $this->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }

}