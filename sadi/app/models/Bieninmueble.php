<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla sitaucion economica
 */
class Bieninmueble extends Model
{
    public function formatoeses($bieninmueble, $bieninmuebledetalles,$bieninmueble_automovil){
        $reporte= new PdfReporte();
        $html=$reporte->bieninmueble;
        $html=str_replace("#bie_notasfamiliares#",trim($bieninmueble->bie_notasfamiliares),$html);
        ($bieninmueble->bie_agua == '1') ? $html=str_replace("#bie_agua#",'X',$html) :  $html=str_replace("#bie_agua#",'',$html);
        ($bieninmueble->bie_drenaje == '1') ? $html=str_replace("#bie_drenaje#",'X',$html) :  $html=str_replace("#bie_drenaje#",'',$html);
        ($bieninmueble->bie_pavimento == '1') ? $html=str_replace("#bie_pavimento#",'X',$html) :  $html=str_replace("#bie_pavimento#",'',$html);
        ($bieninmueble->bie_electricidad == '1') ? $html=str_replace("#bie_electricidad#",'X',$html) :  $html=str_replace("#bie_electricidad#",'',$html);
        ($bieninmueble->bie_escuela == '1') ? $html=str_replace("#bie_escuela#",'X',$html) :  $html=str_replace("#bie_escuela#",'',$html);

        switch ($bieninmueble->bie_nivelzona){
            case 1:
                $html=str_replace("#bie_nivelzonaalto#",'X',$html);
                $html=str_replace("#bie_nivelzonamedioalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedio#",'',$html);
                $html=str_replace("#bie_nivelzonamediobajo#",'',$html);
                $html=str_replace("#bie_nivelzonabajo#",'',$html);
                break;
            case 2:
                $html=str_replace("#bie_nivelzonaalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedioalto#",'X',$html);
                $html=str_replace("#bie_nivelzonamedio#",'',$html);
                $html=str_replace("#bie_nivelzonamediobajo#",'',$html);
                $html=str_replace("#bie_nivelzonabajo#",'',$html);
                break;
            case 3:
                $html=str_replace("#bie_nivelzonaalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedioalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedio#",'X',$html);
                $html=str_replace("#bie_nivelzonamediobajo#",'',$html);
                $html=str_replace("#bie_nivelzonabajo#",'',$html);
                break;
            case 4:
                $html=str_replace("#bie_nivelzonaalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedioalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedio#",'',$html);
                $html=str_replace("#bie_nivelzonamediobajo#",'X',$html);
                $html=str_replace("#bie_nivelzonabajo#",'',$html);
                break;
            case 5:
                $html=str_replace("#bie_nivelzonaalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedioalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedio#",'',$html);
                $html=str_replace("#bie_nivelzonamediobajo#",'',$html);
                $html=str_replace("#bie_nivelzonabajo#",'X',$html);
                break;
            default:
                $html=str_replace("#bie_nivelzonaalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedioalto#",'',$html);
                $html=str_replace("#bie_nivelzonamedio#",'',$html);
                $html=str_replace("#bie_nivelzonamediobajo#",'',$html);
                $html=str_replace("#bie_nivelzonabajo#",'',$html);
                break;
        }

        switch ($bieninmueble->bie_tipo){
            case 1:
                $html=str_replace("#bie_tipocasa#",'X',$html);
                $html=str_replace("#bie_tipoduplex#",'',$html);
                $html=str_replace("#bie_tipodepto#",'',$html);
                $html=str_replace("#bie_tipocondominio#",'',$html);
                $html=str_replace("#bie_tipootro#",'',$html);
                break;
            case 2:
                $html=str_replace("#bie_tipocasa#",'',$html);
                $html=str_replace("#bie_tipoduplex#",'X',$html);
                $html=str_replace("#bie_tipodepto#",'',$html);
                $html=str_replace("#bie_tipocondominio#",'',$html);
                $html=str_replace("#bie_tipootro#",'',$html);
                break;
            case 3:
                $html=str_replace("#bie_tipocasa#",'',$html);
                $html=str_replace("#bie_tipoduplex#",'',$html);
                $html=str_replace("#bie_tipodepto#",'X',$html);
                $html=str_replace("#bie_tipocondominio#",'',$html);
                $html=str_replace("#bie_tipootro#",'',$html);
                break;
            case 4:
                $html=str_replace("#bie_tipocasa#",'',$html);
                $html=str_replace("#bie_tipoduplex#",'',$html);
                $html=str_replace("#bie_tipodepto#",'',$html);
                $html=str_replace("#bie_tipocondominio#",'X',$html);
                $html=str_replace("#bie_tipootro#",'',$html);
                break;
            case 5:
                $html=str_replace("#bie_tipocasa#",'',$html);
                $html=str_replace("#bie_tipoduplex#",'',$html);
                $html=str_replace("#bie_tipodepto#",'',$html);
                $html=str_replace("#bie_tipocondominio#",'',$html);
                $html=str_replace("#bie_tipootro#",'X',$html);
                break;
            default:
                $html=str_replace("#bie_tipocasa#",'',$html);
                $html=str_replace("#bie_tipoduplex#",'',$html);
                $html=str_replace("#bie_tipodepto#",'',$html);
                $html=str_replace("#bie_tipocondominio#",'',$html);
                $html=str_replace("#bie_tipootro#",'',$html);
                break;
        }

        switch ($bieninmueble->bie_regimen){
            case 1:
                $html=str_replace("#bie_regimenpropia#",'X',$html);
                $html=str_replace("#bie_regimenrentada#",'',$html);
                $html=str_replace("#bie_regimenhipotecaria#",'',$html);
                $html=str_replace("#bie_regimenprestada#",'',$html);
                $html=str_replace("#bie_regimenprovisional#",'',$html);
                break;
            case 2:
                $html=str_replace("#bie_regimenpropia#",'',$html);
                $html=str_replace("#bie_regimenrentada#",'X',$html);
                $html=str_replace("#bie_regimenhipotecaria#",'',$html);
                $html=str_replace("#bie_regimenprestada#",'',$html);
                $html=str_replace("#bie_regimenprovisional#",'',$html);
                break;
            case 3:
                $html=str_replace("#bie_regimenpropia#",'',$html);
                $html=str_replace("#bie_regimenrentada#",'',$html);
                $html=str_replace("#bie_regimenhipotecaria#",'X',$html);
                $html=str_replace("#bie_regimenprestada#",'',$html);
                $html=str_replace("#bie_regimenprovisional#",'',$html);
                break;
            case 4:
                $html=str_replace("#bie_regimenpropia#",'',$html);
                $html=str_replace("#bie_regimenrentada#",'',$html);
                $html=str_replace("#bie_regimenhipotecaria#",'',$html);
                $html=str_replace("#bie_regimenprestada#",'X',$html);
                $html=str_replace("#bie_regimenprovisional#",'',$html);
                break;
            case 5:
                $html=str_replace("#bie_regimenpropia#",'',$html);
                $html=str_replace("#bie_regimenrentada#",'',$html);
                $html=str_replace("#bie_regimenhipotecaria#",'',$html);
                $html=str_replace("#bie_regimenprestada#",'',$html);
                $html=str_replace("#bie_regimenprovisional#",'X',$html);
                break;
            default:
                $html=str_replace("#bie_regimenpropia#",'',$html);
                $html=str_replace("#bie_regimenrentada#",'',$html);
                $html=str_replace("#bie_regimenhipotecaria#",'',$html);
                $html=str_replace("#bie_regimenprestada#",'',$html);
                $html=str_replace("#bie_regimenprovisional#",'',$html);
                break;
        }

        switch ($bieninmueble->bie_mobilario){
            case 1:
                $html=str_replace("#bie_mobilarioexcelente#",'X',$html);
                $html=str_replace("#bie_mobilariobueno#",'',$html);
                $html=str_replace("#bie_mobilarioregular#",'',$html);
                $html=str_replace("#bie_mobilariomalo#",'',$html);
                $html=str_replace("#bie_mobilariosuficiente#",'',$html);
                break;
            case 2:
                $html=str_replace("#bie_mobilarioexcelente#",'',$html);
                $html=str_replace("#bie_mobilariobueno#",'X',$html);
                $html=str_replace("#bie_mobilarioregular#",'',$html);
                $html=str_replace("#bie_mobilariomalo#",'',$html);
                $html=str_replace("#bie_mobilariosuficiente#",'',$html);
                break;
            case 3:
                $html=str_replace("#bie_mobilarioexcelente#",'',$html);
                $html=str_replace("#bie_mobilariobueno#",'',$html);
                $html=str_replace("#bie_mobilarioregular#",'X',$html);
                $html=str_replace("#bie_mobilariomalo#",'',$html);
                $html=str_replace("#bie_mobilariosuficiente#",'',$html);
                break;
            case 4:
                $html=str_replace("#bie_mobilarioexcelente#",'',$html);
                $html=str_replace("#bie_mobilariobueno#",'',$html);
                $html=str_replace("#bie_mobilarioregular#",'',$html);
                $html=str_replace("#bie_mobilariomalo#",'X',$html);
                $html=str_replace("#bie_mobilariosuficiente#",'',$html);
                break;
            case 5:
                $html=str_replace("#bie_mobilarioexcelente#",'',$html);
                $html=str_replace("#bie_mobilariobueno#",'',$html);
                $html=str_replace("#bie_mobilarioregular#",'',$html);
                $html=str_replace("#bie_mobilariomalo#",'',$html);
                $html=str_replace("#bie_mobilariosuficiente#",'X',$html);
                break;
            default:
                $html=str_replace("#bie_mobilarioexcelente#",'',$html);
                $html=str_replace("#bie_mobilariobueno#",'',$html);
                $html=str_replace("#bie_mobilarioregular#",'',$html);
                $html=str_replace("#bie_mobilariomalo#",'',$html);
                $html=str_replace("#bie_mobilariosuficiente#",'',$html);
                break;
        }

        $html=str_replace("#bie_recamaras#",trim($bieninmueble->bie_recamaras),$html);
        $html=str_replace("#bie_banos#",trim($bieninmueble->bie_banos),$html);
        $html=str_replace("#bie_sala#",trim($bieninmueble->bie_sala),$html);
        $html=str_replace("#bie_comedor#",trim($bieninmueble->bie_comedor),$html);
        $html=str_replace("#bie_garaje#",trim($bieninmueble->bie_garaje),$html);

        $html=str_replace("#bie_habitaranos#",trim($bieninmueble->bie_habitaranos),$html);
        $html=str_replace("#bie_habitarmeses#",trim($bieninmueble->bie_habitarmeses),$html);
        // $html=str_replace("#bie_habitardias#",trim($bieninmueble->bie_habitardias),$html);

        $html=str_replace("#bie_domicilioanterior#",trim($bieninmueble->bie_domicilioanterior),$html);
        $html=str_replace("#bie_notasvivienda#",trim($bieninmueble->bie_notasvivienda),$html);

        $detalles=count($bieninmuebledetalles);

        for ($i=0; $i <= 6; $i++) {
            if($i<$detalles){
                $html=str_replace("#bid_nombre".$i."#",trim($bieninmuebledetalles[$i]->bid_nombre),$html);
                $html=str_replace("#bid_ubicacion".$i."#",trim($bieninmuebledetalles[$i]->bid_ubicacion),$html);
                $html=str_replace("#bid_valor".$i."#",$bieninmuebledetalles[$i]->bid_valor,$html);
            }else{
                $html=str_replace("#bid_nombre".$i."#"," ",$html);
                $html=str_replace("#bid_ubicacion".$i."#"," ",$html);
                $html=str_replace("#bid_valor".$i."#"," ",$html);
            }
        }

        $detalles_automovil=count($bieninmueble_automovil);
        $objecto_automovil=new Automovil();
        for ($i=0; $i <= 5; $i++) {
            if($i<$detalles_automovil){
                $html=str_replace("#aut_tipo".$i."#",trim($objecto_automovil->get_nombre_tipo_automovil($bieninmueble_automovil[$i]->aut_tipo)),$html);
                $html=str_replace("#aut_marca".$i."#",trim($bieninmueble_automovil[$i]->aut_marca),$html);
                $html=str_replace("#aut_modelo".$i."#",$bieninmueble_automovil[$i]->aut_modelo,$html);
                $html=str_replace("#aut_anio".$i."#",$bieninmueble_automovil[$i]->aut_anio,$html);
                $html=str_replace("#aut_valor".$i."#",$bieninmueble_automovil[$i]->aut_valor,$html);
                // $html=str_replace("#aut_valor".$i."#","$ ".number_format($bieninmueble_automovil[$i]->aut_valor, 2, '.', ','),$html);

                

            }else{
                $html=str_replace("#aut_tipo".$i."#"," ",$html);
                $html=str_replace("#aut_marca".$i."#"," ",$html);
                $html=str_replace("#aut_modelo".$i."#"," ",$html);
                $html=str_replace("#aut_anio".$i."#"," ",$html);
                $html=str_replace("#aut_valor".$i."#"," ",$html);

            }
        }


        //archivos adjuntados
       

        
        return $html;

    }

    public function ActualizarRegistro($data,$permisoCalificacion)
    {   
        

        $this->bie_notasfamiliares=$data['bie_notasfamiliares'];
        $this->bie_agua =$data['bie_agua'];
        $this->bie_drenaje=$data['bie_drenaje'];
        $this->bie_pavimento=$data['bie_pavimento'];
        $this->bie_electricidad=$data['bie_electricidad'];
        $this->bie_escuela=$data['bie_escuela'];
        $this->bie_nivelzona=$data['bie_nivelzona'];
        $this->bie_tipo=$data['bie_tipo'];
        $this->bie_regimen=$data['bie_regimen'];
        $this->bie_mobilario=$data['bie_mobilario'];
        $this->bie_recamaras=$data['bie_recamaras'];

        $this->bie_banos=$data['bie_banos'];
        $this->bie_sala=$data['bie_sala'];
        $this->bie_comedor=$data['bie_comedor'];
        $this->bie_garaje=$data['bie_garaje'];

        $this->bie_habitaranos=$data['bie_habitaranos'];
        $this->bie_habitarmeses=$data['bie_habitarmeses'];
        // $this->bie_habitardias=$data['bie_habitardias'];

        $this->bie_domicilioanterior=$data['bie_domicilioanterior'];
        $this->bie_notasvivienda=$data['bie_notasvivienda'];

        if($permisoCalificacion==1)
        {
            $this->bie_calificacion=$data['bie_calificacion'];

        }


        if($this->update())
        {
            return  $respuesta=['estado'=>2,'ese_id'=> $this->ese_id,'bie_id'=>$this->bie_id];

        }
        else
        {
            return  $respuesta=['estado'=>-2];

        }
    }

    public function crearAutomaticoOTraerExistente($ese_id){

        $answer=[];
        
        $bieninmueble_ese_activo=Bieninmueble::query()->where("ese_id=".$ese_id.' and bie_estatus = 2') ->execute(); 
        // $bieninmueble_ese_activo=Bieninmueble::findFirst(["ese_id = '$ese_id'","bie_estatus = '2'"]);

        if(count($bieninmueble_ese_activo)>0){
            
            $answer['bie_id']=$bieninmueble_ese_activo[0]->bie_id;
            $answer['ese_id']=$bieninmueble_ese_activo[0]->ese_id;
            $answer['data']=$bieninmueble_ese_activo[0];

            $answer['estado']=2;
            $answer['titular']='ok';
            $answer['mensaje']='se encontro';


            
        }else{
            $bieninmueble_crear= new Bieninmueble();
            $bieninmueble_crear->ese_id=$ese_id;
            $bieninmueble_crear->bie_estatus=2;

            if($bieninmueble_crear->save()){

                $answer['bie_id']=$bieninmueble_crear->bie_id;
                $answer['ese_id']=$bieninmueble_crear->ese_id;
                $answer['data']=$bieninmueble_crear;

                $answer['estado']=2;
                $answer['titular']='ok';
                $answer['mensaje']='se creo';


            }else{
          
                $answer['estado']=-2;
                $answer['mensaje']='error';
            }



        }

        return $answer;


    }

    public function formatoEseTruper($databieninmueble, $data_antecedentesocial, $automoviles, $bieninmuebledetalles,$ese_id){
        $reporte= new PdfReporteTruper();
        $formato_pdf=new FormatotruperPDF();


        $html=$reporte->afilacionespropiedades_pagina_8;
        
        $html=str_replace("#ans_tiempolibre#",$data_antecedentesocial->ans_tiempolibre,$html);
        $html=str_replace("#ans_tiempolibre-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_antecedentesocial->ans_tiempolibre), $html);

        $html=str_replace("#ans_clubsocial#",$this->getSiNo($data_antecedentesocial->ans_clubsocial),$html);
        $html=str_replace("#ans_clubsocial-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_clubsocial), $html);

        $html=str_replace("#ans_clubsocialnombre#",$data_antecedentesocial->ans_clubsocialnombre,$html);
        $html=str_replace("#ans_clubsocialnombre-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_antecedentesocial->ans_clubsocialnombre), $html);

        
        $html=str_replace("#ans_deportepractica#",$this->getSiNo($data_antecedentesocial->ans_deportepractica),$html);
        $html=str_replace("#ans_deportepractica-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_deportepractica), $html);

        $html=str_replace("#ans_deporte#",$data_antecedentesocial->ans_deporte,$html);
        $html=str_replace("#ans_deporte-style_bg#",$formato_pdf->verificar_si_es_vacio_td($data_antecedentesocial->ans_deporte), $html);

        $model_antecedente= new Antecedentesocial();
        $html=str_replace("#ans_deportefrecuencia#",$model_antecedente->get_frecuencia_practica_deporte_formatotruper($data_antecedentesocial->ans_deportefrecuencia),$html);
        $html=str_replace("#ans_deportefrecuencia-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_deportefrecuencia), $html);

        $html=str_replace("#ans_religion#",$model_antecedente->get_religion_profesa_formatotruper($data_antecedentesocial->ans_religion),$html);
        $html=str_replace("#ans_religion-style_bg#",$formato_pdf->verificar_si_es_vacio_select($data_antecedentesocial->ans_religion), $html);


        if(count($bieninmuebledetalles)>0){
            $html=str_replace("#color-bieninmueble#",'',$html);
            $html=str_replace("#bieninmueble#",count($bieninmuebledetalles),$html);
        }else{
            $html=str_replace("#color-bieninmueble#",'yellow',$html);
            $html=str_replace("#bieninmueble#",'',$html);
            $html=str_replace("#antiguedadinmueble0#",'NINGUNO',$html);
        }

        $detalles=count($bieninmuebledetalles);
        $model_detalles= new Bieninmuebledetalles();
        for ($i=0; $i <= 6; $i++) {
            if($i<$detalles){
                $html=str_replace("#bieninmueble".$i."#",$model_detalles->getNombreBienInmueble_FormatoTruper(trim($bieninmuebledetalles[$i]->bid_nombre)),$html);
                $html=str_replace("#bieninmueble".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_select($bieninmuebledetalles[$i]->bid_nombre), $html);

                $html=str_replace("#valorinmueble".$i."#",trim($bieninmuebledetalles[$i]->bid_valor),$html);
                $html=str_replace("#valorinmueble".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td($bieninmuebledetalles[$i]->bid_valor), $html);

                $html=str_replace("#antiguedadinmueble".$i."#",trim($bieninmuebledetalles[$i]->bid_antiguedad), $html);
                $html=str_replace("#antiguedadinmueble".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td($bieninmuebledetalles[$i]->bid_antiguedad), $html);


                $html=str_replace("#bieninmuebletexto".$i."#",'Bien:',$html);
                
                $html=str_replace("#valorinmuebletexto".$i."#",'Valor:',$html);
                $html=str_replace("#antiguedadinmuebletexto".$i."#",'Antigüedad:',$html);

                $html=str_replace("#color-bieninmuebletd".$i."#",'#FF6600',$html);
            }else{
                $html=str_replace("#bieninmueble".$i."#"," ",$html);
                // $html=str_replace("#bieninmueble".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

                $html=str_replace("#valorinmueble".$i."#"," ",$html);
                // $html=str_replace("#valorinmueble".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

                $html=str_replace("#antiguedadinmueble".$i."#"," ",$html);
                // $html=str_replace("#antiguedadinmueble".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);


                $html=str_replace("#bieninmuebletexto".$i."#",'',$html);
                $html=str_replace("#valorinmuebletexto".$i."#",'',$html);
                $html=str_replace("#antiguedadinmuebletexto".$i."#",'',$html);

                $html=str_replace("#color-bieninmuebletd".$i."#",'#FFFFFF',$html);
            }
        }

        if(count($automoviles)>0){
            $html=str_replace("#color-auto#",'',$html);
            $html=str_replace("#auto#",count($automoviles),$html);
        }else{
            $html=str_replace("#color-auto#",'yellow',$html);
            $html=str_replace("#auto#",'',$html);
            $html=str_replace("#modeloauto0#",'NINGUNO',$html);
        }

        $model_auto= new Automovil();
        $detalles=count($automoviles);
        for ($i=0; $i <= 5; $i++) {
            if($i<$detalles){
                $html=str_replace("#bienauto".$i."#",$model_auto->get_nombre_tipo_automovil_formatotruper(trim($automoviles[$i]->aut_tipo)),$html);
                $html=str_replace("#bienauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_select($automoviles[$i]->aut_tipo), $html);

                $html=str_replace("#valorauto".$i."#",trim($automoviles[$i]->aut_valor),$html);
                $html=str_replace("#valorauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td($automoviles[$i]->aut_valor), $html);

                $html=str_replace("#modeloauto".$i."#",trim($automoviles[$i]->aut_anio),$html);
                $html=str_replace("#modeloauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td($automoviles[$i]->aut_anio), $html);

                $html=str_replace("#marcaauto".$i."#",trim($automoviles[$i]->aut_marca),$html);
                $html=str_replace("#marcaauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td($automoviles[$i]->aut_marca), $html);


                $html=str_replace("#bienautotexto".$i."#",'Bien:',$html);
                $html=str_replace("#valorautotexto".$i."#",'Valor:',$html);
                $html=str_replace("#modeloautotexto".$i."#",'Modelo (Año):',$html);
                $html=str_replace("#marcaautotexto".$i."#",'Marca:',$html);

                $html=str_replace("#color-bienautotd".$i."#",'#FF6600',$html);
            }else{
                $html=str_replace("#bienauto".$i."#",'',$html);
                // $html=str_replace("#bienauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

                $html=str_replace("#valorauto".$i."#",'',$html);
                // $html=str_replace("#valorauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

                $html=str_replace("#modeloauto".$i."#",'',$html);
                // $html=str_replace("#modeloauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

                $html=str_replace("#marcaauto".$i."#",'',$html);
                // $html=str_replace("#marcaauto".$i."-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);


                $html=str_replace("#bienautotexto".$i."#",'',$html);
                $html=str_replace("#valorautotexto".$i."#",'',$html);
                $html=str_replace("#modeloautotexto".$i."#",'',$html);
                $html=str_replace("#marcaautotexto".$i."#",'',$html);

                $html=str_replace("#color-bienautotd".$i."#",'#FFFFFF',$html);
            }
        }
        

        return $html;
    }
    
    public function getSiNo($id){
        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SÍ";
            default:
                return "";
        }
    }

}