<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Bieninmuebledetalles
 */
class Referenciapersonal extends Model
{
    public function NuevoRegistro($data){
        $registro_rep= new Referenciapersonal();
        $registro_rep->rep_nombre=trim($data['rep_nombre_crear']);
        $registro_rep->rep_tiempo=$data['rep_tiempo_crear'];
        $registro_rep->rep_callenumero=$data['rep_callenumero_crear'];
        $registro_rep->rep_colonia=$data['rep_colonia_crear'];
        $registro_rep->rep_telefono=  $data['rep_telefono_crear'] ;
        $registro_rep->rep_codpostal=  $data['rep_codpostal_crear'] ;

        $registro_rep->rep_notas=   $data['rep_notas_crear'] ;
        $registro_rep->sep_id=   $data['rep_sep_id'] ;
        $registro_rep->rep_estatus=   2 ;


        
        if($registro_rep->save()){
            return  $repuesta=['estado'=>2,'rep_id'=> $registro_rep->rep_id,'sep_id'=> $registro_rep->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }

    public function ActualizarRegistro($data){
        $this->rep_nombre=trim($data['rep_nombre_editar']);
        $this->rep_tiempo=$data['rep_tiempo_editar'];
        $this->rep_callenumero=$data['rep_callenumero_editar'];
        $this->rep_colonia=$data['rep_colonia_editar'];
        $this->rep_telefono=  $data['rep_telefono_editar'] ;
        $this->rep_codpostal=  $data['rep_codpostal_editar'] ;
        $this->rep_notas=   $data['rep_notas_editar'] ;
        // $this->sep_id=   $data['rep_sep_id'] ;
        // $this->rep_estatus=   2 ;


        
        if($this->save()){
            return  $repuesta=['estado'=>2,'rep_id'=> $this->rep_id,'sep_id'=> $this->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }
    public function altaEstudioNuevoRegistro($data,$sep_id){
        $registro_rep= new Referenciapersonal();
        $registro_rep->rep_nombre=trim($data['rep_nombre_crear']);
        $registro_rep->rep_tiempo=$data['rep_tiempo_crear'];
        $registro_rep->rep_callenumero=$data['rep_callenumero_crear'];
        $registro_rep->rep_colonia=$data['rep_colonia_crear'];
        $registro_rep->rep_telefono=  $data['rep_telefono_crear'] ;
        $registro_rep->rep_codpostal=  $data['rep_codpostal_crear'] ;
        $registro_rep->rep_notas=   $data['rep_notas_crear'] ;
        $registro_rep->sep_id=$sep_id;
        $registro_rep->rep_estatus=   2 ;
        
        if($registro_rep->save()){
            return  $repuesta=['estado'=>2,'rep_id'=> $registro_rep->rep_id,'sep_id'=> $registro_rep->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }

    public function NuevoRegistroFormatoTruper($data){

        $registro_rep= new Referenciapersonal();
        $registro_rep->rep_nombre=trim($data['rep_nombre']);
        $registro_rep->rep_tiempo=$data['rep_tiempo'];
        $registro_rep->rep_edad=  $data['rep_edad'] ;
        $registro_rep->rep_telefono=  $data['rep_telefono'] ;

        $registro_rep->rep_lorecomienda=  $data['rep_lorecomienda'] ;
        $registro_rep->rep_direccioncompleta=  $data['rep_direccioncompleta'] ;
        $registro_rep->rep_ocupacion=  $data['rep_ocupacion'] ;
        $registro_rep->rep_empresatrabaja=  $data['rep_empresatrabaja'] ;

        
        

        $registro_rep->rep_conceptocomopersona=  $data['rep_conceptocomopersona'] ;
        $registro_rep->rep_pasatiempos=  $data['rep_pasatiempos'] ;
        $registro_rep->rep_conocedonhatrabajado=  $data['rep_conocedonhatrabajado'] ;
        $registro_rep->rep_estadocivil=  $data['rep_estadocivil'] ;
        $registro_rep->rep_conocesudomicilio=  $data['rep_conocesudomicilio'] ;
        $registro_rep->rep_comoloconocio=  $data['rep_comoloconocio'] ;




        $registro_rep->rep_notas=   $data['rep_notas'] ;
        $registro_rep->sep_id= $data['sep_id'] ;
        $registro_rep->rep_estatus=   2 ;


        
        if($registro_rep->save()){
            return  $repuesta=['estado'=>2,'rep_id'=> $registro_rep->rep_id,'sep_id'=> $registro_rep->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }


    public function ActualizarRegistroFormatoTruper($data){

        $this->rep_nombre=trim($data['rep_nombre']);
        $this->rep_tiempo=$data['rep_tiempo'];
        $this->rep_edad=  $data['rep_edad'] ;
        $this->rep_telefono=  $data['rep_telefono'] ;

        $this->rep_lorecomienda=  $data['rep_lorecomienda'] ;
        $this->rep_direccioncompleta=  $data['rep_direccioncompleta'] ;
        $this->rep_ocupacion=  $data['rep_ocupacion'] ;
        $this->rep_empresatrabaja=  $data['rep_empresatrabaja'] ;

        
        

        $this->rep_conceptocomopersona=  $data['rep_conceptocomopersona'] ;
        $this->rep_pasatiempos=  $data['rep_pasatiempos'] ;
        $this->rep_conocedonhatrabajado=  $data['rep_conocedonhatrabajado'] ;
        $this->rep_estadocivil=  $data['rep_estadocivil'] ;
        $this->rep_conocesudomicilio=  $data['rep_conocesudomicilio'] ;
        $this->rep_comoloconocio=  $data['rep_comoloconocio'] ;


        

        $this->rep_notas=   $data['rep_notas'] ;
 

        
        if($this->update()){
            return  $repuesta=['estado'=>2,'rep_id'=> $this->rep_id,'sep_id'=> $this->sep_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }

}