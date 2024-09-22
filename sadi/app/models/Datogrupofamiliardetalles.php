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
class Datogrupofamiliardetalles extends Model
{
    public $dgd_estatucontacto_selects_values=[
        1=>'SÍ',
        2=>'NO INFORMÓ',
        3=>'NO CONTESTA',
        4=>'NO EXISTE',
        5=>'NO DISPONIBLE',
        6=>'MANDA A BUZÓN',
        7=>'EQUIVOCADO',
        8=>'NO APLICA',
    ];

    public $dgd_parentesto_formatotruper=[
        1=>'PADRE',
        2=>'MADRE',
        3=>'HERMANO(A)',
        4=>'ESPOSA (O)',
        5=>'CÓNYUGE',
        6=>'HIJO (A)',
        7=>'HIJASTRO (A)',
        8=>'SOBRINO  (A)' ,
        9=>'PADRASTRO',
        10=>'CUÑADO (A)',
        11=>'SÓLO O C / AMIGOS ',
        12=>'TIO  (A)' ,
        13=>'UNIÓN  LIBRE' ,
        14=>'ABUELO (A)' ,
        15=>'PRIMO (A)' ,
        16=>'MADRASTRA' ,
        17=>'SUEGRO (A)'


    ];

    public $ocupacion_formatotruper=[
        1=>'TRABAJA',
        2=>'DESEMPLEADO',
        3=>'AMA DE CASA',
        4=>'ESTUDIANTE',
        5=>'PENSIONADO',
        6=>'JUBILADO',
        7=>'DISCAPACITADO',
        8=>'NO APLICA',
        9=>'COMERCIANTE',
        10=>'EMPLEADO'

    ];

    public function getOcupacionFormatoTruper($id){
        if(array_key_exists($id, $this->ocupacion_formatotruper) ){
            return  $this->ocupacion_formatotruper[$id];

        }else{
            return '';

        }
    }
    public function NuevoRegistro($data){
        $registro= new Datogrupofamiliardetalles();
        $registro->dgd_nombre=trim($data['dgd_nombre_crear']);
        $registro->dgd_parentesco=$data['dgd_parentesco_crear'];
        $registro->dgd_edad=$data['dgd_edad_crear'];
        $registro->esc_id=$data['dgd_esc_id_crear'];
        $registro->niv_id=  $data['dgd_niv_id_crear'] ;
        $registro->dgd_viveusted= ($data['dgd_viveusted_crear'] ==-1)? null: $data['dgd_viveusted_crear'];
        $registro->dgf_id=$data['dgd_dgf_id'];
        $registro->dgd_estatus=2;

        if($registro->save()){
            return  $repuesta=['estado'=>2,'dgf_id'=> $registro->dgf_id,'dgd_id'=> $registro->dgd_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }



    }

    public function ActualizarRegistro($data){
        $this->dgd_nombre=trim($data['dgd_nombre_editar']);
        $this->dgd_parentesco=$data['dgd_parentesco_editar'];
        $this->dgd_edad=$data['dgd_edad_editar'];
        $this->esc_id=  $data['dgd_esc_id_editar'];
        $this->niv_id=  $data['dgd_niv_id_editar'] ;
        $this->dgd_viveusted=  $data['dgd_viveusted_editar'];

        if($this->save()){
            return  $respuesta=['estado'=>2,'dgf_id'=> $this->dgf_id,'dgd_id'=>$this->dgd_id];
        }       
        else
        {
            return  $respuesta=['estado'=>-2];
        }

        

    }

   
    public function getSiNoViveConElCandidato($id){

        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SÍ";
            default:
                return "";
        }

    }

    public function getNombreEstatusContacto($id){
        if($id<=0 || $id>=9){
            return '';
        }else{
           return  $this->dgd_estatucontacto_selects_values[$id];
        }

    }
    public function getParentesto_formatotruper($id){
        if(array_key_exists($id, $this->dgd_parentesto_formatotruper) ){
            return  $this->dgd_parentesto_formatotruper[$id];

        }else{
            return '';

        }

    }

    public function NuevoRegistroViveConFormatoTruper($data){
        $registro= new Datogrupofamiliardetalles();

        $registro->dgd_nombre=trim($data['dgd_nombre']);
        $registro->dgd_parentesco=$data['dgd_parentesco'];
        $registro->dgd_edad=$data['dgd_edad'];
        // $registro->esc_id=$data['dgd_esc_id'];
        $registro->niv_id=  $data['niv_id'] ;
        $registro->dgd_viveusted= ($data['dgd_viveusted'] ==-1)? null: $data['dgd_viveusted'];
        $registro->dgd_ocupacion=$data['dgd_ocupacion'];
        $registro->dgd_puesto=$data['dgd_puesto'];
        $registro->dgd_empresa=$data['dgd_empresa'];
        $registro->dgd_telefono=$data['dgd_telefono'];
        $registro->dgd_estatucontacto= ($data['dgd_estatucontacto'] ==-1)? null: $data['dgd_estatucontacto'] ;

        $registro->dgf_id=$data['dgf_id'];
        $registro->dgd_estatus=2;

        if($registro->save()){
            return  $repuesta=['estado'=>2,'dgf_id'=> $registro->dgf_id,'dgd_id'=> $registro->dgd_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }
    public function ActualizarRegistroViveConFormatoTruper($data){


        $this->dgd_nombre=trim($data['dgd_nombre']);
        $this->dgd_parentesco=$data['dgd_parentesco'];
        $this->dgd_edad=$data['dgd_edad'];
        // $registro->esc_id=$data['dgd_esc_id'];
        $this->niv_id=  $data['niv_id'] ;
        $this->dgd_viveusted= ($data['dgd_viveusted'] ==-1)? null: $data['dgd_viveusted'];
        $this->dgd_ocupacion=$data['dgd_ocupacion'];
        $this->dgd_puesto=$data['dgd_puesto'];
        $this->dgd_empresa=$data['dgd_empresa'];
        $this->dgd_telefono=$data['dgd_telefono'];
        $this->dgd_puesto=$data['dgd_puesto'];

        $this->dgd_estatucontacto= ($data['dgd_estatucontacto'] ==-1)? null: $data['dgd_estatucontacto'] ;
        $this->dgd_estatus=2;

        if($this->save()){
            return  $repuesta=['estado'=>2,'dgf_id'=> $this->dgf_id,'dgd_id'=> $this->dgd_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }

    }

    public function NuevoRegistroViveConFormatoTrabajanCompaniaTruper($data){

        $registro= new Datogrupofamiliardetalles();

        $registro->dgd_nombre=trim($data['dgd_nombre']);
        $registro->dgd_parentesco=$data['dgd_parentesco'];
        $registro->dgd_puesto=$data['dgd_puesto'];
        $registro->dgd_telefono=$data['dgd_telefono'];
        $registro->dgd_area=$data['dgd_area'] ;

        $registro->dgf_id=$data['dgf_id'];
        $registro->dgd_estatus=2;
        $registro->dgd_trabajanenlacompania=1;


        if($registro->save()){
            return  $repuesta=['estado'=>2,'dgf_id'=> $registro->dgf_id,'dgd_id'=> $registro->dgd_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }

    public function ActualizarRegistroTrabajanCompaniaTruper($data){

        
        $this->dgd_nombre=trim($data['dgd_nombre']);
        $this->dgd_parentesco=$data['dgd_parentesco'];
        $this->dgd_puesto=$data['dgd_puesto'];
        $this->dgd_telefono=$data['dgd_telefono'];
        $this->dgd_area=$data['dgd_area'] ;

        if($this->save()){
            return  $respuesta=['estado'=>2,'dgf_id'=> $this->dgf_id,'dgd_id'=> $this->dgd_id];
        }       
        else
        {
            return  $respuesta=['estado'=>-2];
        }
    }

    public function NuevoRegistroNegociOTrabajoEnTruper($data){
        $registro= new Datogrupofamiliardetalles();

        $registro->dgd_nombre=trim($data['dgd_nombre']);
        $registro->dgd_parentesco=$data['dgd_parentesco'];
        $registro->dgd_puesto=$data['dgd_puesto'];
        $registro->dgd_telefono=$data['dgd_telefono'];
        $registro->dgd_empresa=$data['dgd_empresa'] ;

        $registro->dgf_id=$data['dgf_id'];
        $registro->dgd_estatus=2;
        $registro->dgd_trabajaotienenegocio=1;
        if($registro->save()){
            return  $repuesta=['estado'=>2,'dgf_id'=> $registro->dgf_id,'dgd_id'=> $registro->dgd_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }

    public function ActualizarRegistroNegociOTrabajoEnTruper($data){
        

        $this->dgd_nombre=trim($data['dgd_nombre']);
        $this->dgd_parentesco=trim($data['dgd_parentesco']);
        $this->dgd_puesto=trim($data['dgd_puesto']);
        $this->dgd_telefono=$data['dgd_telefono'];
        $this->dgd_empresa=$data['dgd_empresa'] ;

        if($this->save()){
            return  $repuesta=['estado'=>2,'dgf_id'=> $this->dgf_id,'dgd_id'=> $this->dgd_id];
        }       
        else
        {
            return  $repuesta=['estado'=>-2];
        }
    }


    public function formatoEseTruper($data_principal,$ese_id){
        $reporte= new PdfReporteTruper();
        $obj_nivel_estudios=new Nivelestudio();

        $html=$reporte->datosfamiliares_pagina_5;


        $familiares_directo_vive_detalles=Datogrupofamiliardetalles::query()
        ->where('dgf_id='.$data_principal->dgf_id.' and dgd_estatus=2 and dgd_viveusted=1')
        ->execute();

        $familiares_directo__no_vive_detalles=Datogrupofamiliardetalles::query()
        ->where('dgf_id='.$data_principal->dgf_id.' and dgd_estatus=2 and dgd_viveusted=0')
        ->execute();

        $familiares_direct_negocio_detalles=Datogrupofamiliardetalles::query()
        ->where('dgf_id='.$data_principal->dgf_id.' and dgd_estatus=2 and dgd_trabajaotienenegocio=1')
        ->execute();
        
        $familiares_direct_trabajan_detalles=Datogrupofamiliardetalles::query()
        ->where('dgf_id='.$data_principal->dgf_id.' and dgd_estatus=2 and dgd_trabajanenlacompania=1')
        ->execute();

    
       $rows_agregar_familiares_viven='';
       $rows_agregar_familiares_negocio='';
       $rows_agregar_familiares_trabajan='';

       $rows_agregar_familiares_no_viven='';

 
        for ($i=0; $i <= 7; $i++) {
        
       
            if($i<count($familiares_directo_vive_detalles)){
                $row='  <tr>
                <td colspan="2" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; ">'.$familiares_directo_vive_detalles[$i]->dgd_nombre.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; ">'.$familiares_directo_vive_detalles[$i]->dgd_edad.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  ">'.$this->getParentesto_formatotruper($familiares_directo_vive_detalles[$i]->dgd_parentesco).'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; ">'.$obj_nivel_estudios->getNombreNivelEstudio($familiares_directo_vive_detalles[$i]->niv_id).'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  ">'.$this->getOcupacionFormatoTruper($familiares_directo_vive_detalles[$i]->dgd_ocupacion).'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; ">'.$familiares_directo_vive_detalles[$i]->dgd_puesto.'</td>
                <td colspan="2" class="td_text_format"  style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; ">'.$familiares_directo_vive_detalles[$i]->dgd_empresa.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;   text-align: start;">'.$familiares_directo_vive_detalles[$i]->dgd_telefono.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; ">'.$this->getNombreEstatusContacto($familiares_directo_vive_detalles[$i]->dgd_estatucontacto).'</td>
                </tr>';
             
            }else{
                $row='  
                <tr>
                <td colspan="2" class="td_text_format"  style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="2" class="td_text_format"  style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; background-color:#D9D9D9"></td>
                </tr>';
            }

           $rows_agregar_familiares_viven.=$row;

        }

     

        for ($i_no=0; $i_no <= 7; $i_no++) {
        
       
            if($i_no<count($familiares_directo__no_vive_detalles)){
                $row_no_vive_con='
                <tr>
                <td colspan="2" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; ">'.$familiares_directo__no_vive_detalles[$i_no]->dgd_nombre.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;   text-align: start; ">'.$familiares_directo__no_vive_detalles[$i_no]->dgd_edad.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; ">'.$this->getParentesto_formatotruper($familiares_directo__no_vive_detalles[$i_no]->dgd_parentesco).'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  ">'.$obj_nivel_estudios->getNombreNivelEstudio($familiares_directo__no_vive_detalles[$i_no]->niv_id).'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; ">'.$this->getOcupacionFormatoTruper($familiares_directo__no_vive_detalles[$i_no]->dgd_ocupacion).'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start;">'.$familiares_directo__no_vive_detalles[$i_no]->dgd_puesto.'</td>
                <td colspan="2" class="td_text_format"  style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start;">'.$familiares_directo__no_vive_detalles[$i_no]->dgd_empresa.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;  text-align: start; ">'.$familiares_directo__no_vive_detalles[$i_no]->dgd_telefono.'</td>
                <td colspan="1" class="td_text_format" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8; ">'.$this->getNombreEstatusContacto($familiares_directo__no_vive_detalles[$i_no]->dgd_estatucontacto).'</td>
                </tr>';
             
            }else{
               
                $row_no_vive_con='
                <tr>
                <td colspan="2" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="2" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                <td colspan="1" style="height:27px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11; background-color:#D9D9D9"></td>
                </tr>';
            }

           $rows_agregar_familiares_no_viven.=$row_no_vive_con;

        }



        for ($i=0; $i <= 2; $i++) {
        
       
            if($i<count($familiares_direct_negocio_detalles)){
                $row_negocios='
                   <tr>
                    <td colspan="3" class="td_text_format"  style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;  text-align: start; font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_negocio_detalles[$i]->dgd_nombre.'</td>
                    <td colspan="2"  class="td_text_format" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center; font-weight:bold;background-color:#FFFFFF">'.$this->getParentesto_formatotruper($familiares_direct_negocio_detalles[$i]->dgd_parentesco).'</td>
                    <td colspan="2" class="td_text_format"  style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;  text-align: start; font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_negocio_detalles[$i]->dgd_puesto.'</td>
                    <td colspan="2"  class="td_text_format" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;  text-align: start; font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_negocio_detalles[$i]->dgd_empresa.'</td>
                    <td colspan="2"  class="td_text_format" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;  text-align: start; font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_negocio_detalles[$i]->dgd_telefono.'</td>
                </tr>
                ';
            
             
            }else{
                $row_negocios='
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                  </tr>
                ';
            
            }

           $rows_agregar_familiares_negocio.=$row_negocios;

        }
      

        for ($i=0; $i <= 2; $i++) {
        
       
            if($i<count($familiares_direct_trabajan_detalles)){
                $row_trabajar='
                   <tr>
                    <td colspan="3"  class="td_text_format" style="  text-align: start; height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_trabajan_detalles[$i]->dgd_nombre.'</td>
                    <td colspan="2"  class="td_text_format" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;text-align:center;font-weight:bold;background-color:#FFFFFF">'.$this->getParentesto_formatotruper($familiares_direct_trabajan_detalles[$i]->dgd_parentesco).'</td>
                    <td colspan="2" class="td_text_format"  style=" text-align: start; height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_trabajan_detalles[$i]->dgd_puesto.'</td>
                    <td colspan="2" class="td_text_format" style=" text-align: start; height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_trabajan_detalles[$i]->dgd_area.'</td>
                    <td colspan="2"  class="td_text_format" style="  text-align: start; height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:8;font-weight:bold;background-color:#FFFFFF">'.$familiares_direct_trabajan_detalles[$i]->dgd_telefono.'</td>
                </tr>
                ';
            
             
            }else{
                $row_trabajar='
                <tr>
                <td colspan="3" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                <td colspan="2" style="height:20px;border: 1px solid #FF6600;font-family:Calibri, sans-serif;font-size:11;text-align:center;font-weight:bold;background-color:#D9D9D9"></td>
                  </tr>
                ';
            
            }

           $rows_agregar_familiares_trabajan.=$row_trabajar;

        }
      
   
    
        $html=str_replace("#filas_familiares_viven#",$rows_agregar_familiares_viven,$html);
        $html=str_replace("#filas_familiares_negocio#",$rows_agregar_familiares_negocio,$html);
        $html=str_replace("#filas_familiares_trabajan_compania#",$rows_agregar_familiares_trabajan,$html);

        $html=str_replace("#filas_familiares_no_vive#",$rows_agregar_familiares_no_viven,$html);

        return $html;

    }
}