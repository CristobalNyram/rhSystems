<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Vacante
 */
class Vacante extends Model
{
    public $estatus_en_espera=1;
    public $estatus_proceso=2;
    public $estatus_fin=3;
    public $estatus_stand_by=3;
    public $estatus_garantia=5;


    /**
     * Crea una nueva vacante general.
     *
     * @param array $data Los datos de la vacante a crear.
     *                    - vac_numero: El número de la vacante.
     *                    - emp_id: El ID de la empresa.
     *                    - tip_id: El ID del tipo de vacante.
     *                    - cne_id: El ID del campo de estudio.
     *                    - est_id: El ID del estado.
     *                    - mun_id: El ID del municipio.
     *                    - cav_id: El ID del campo de actividad.
     *                    - gen_id: El ID del género.
     *                    - esc_id: El ID de la escolaridad.
     *                    - gra_id: El ID del grado académico.
     *                    - eje_id: El ID del eje ocupacional.
     *                    - sex_id: El ID del sexo.
     *                    - vac_edadmin: La edad mínima requerida.
     *                    - vac_edadmax: La edad máxima requerida.
     *                    - vac_idioma: El idioma requerido.
     *                    - vac_nivelidioma: El nivel de idioma requerido.
     *                    - vac_otroidioma: Otro idioma requerido.
     *                    - vac_horario: El horario de trabajo.
     *                    - vac_conceptotecnico: El concepto técnico.
     *                    - vac_habilidad: Las habilidades requeridas.
     *                    - vac_funcionprincipal: La función principal.
     *                    - vac_experiencia: La experiencia requerida.
     *                    - vac_observaciones: Observaciones de la vacante.
     *                    - vac_escolaridadespecificar: Especificaciones de la escolaridad.
     *                    - tie_id: El ID del tipo de empresa.
     *                    - cen_id: El ID del centro de trabajo.
     * @param array $auth_data Los datos de autenticación.
     *                         - id: El ID del usuario autenticado.
     * @return array El resultado de la función.
     *               - estado: El estado de la operación. (2 para éxito, -2 para error)
     *               - mensaje: El mensaje asociado al resultado.
     *               - vac_id: El ID de la vacante creada en caso de éxito.
     */

    public function NuevoGeneral($data,$auth_data){
        $answer['estado']=-2;
        $answer['mensaje']='';

        $registro_vac=new Vacante();
        $registro_vac->vac_numero=$data['vac_numero'];
        $registro_vac->emp_id=$data['emp_id'];
        $registro_vac->tip_id=$data['tip_id'];
        $registro_vac->vac_numero=$data['vac_numero'];
        $registro_vac->vac_garantia=$data['vac_garantia'];
        $registro_vac->cne_id=$data['cne_id'];
        $registro_vac->est_id=$data['est_id'];
        $registro_vac->mun_id=$data['mun_id'];
        $registro_vac->cav_id=$data['cav_id'];
        $registro_vac->gen_id=$data['gen_id'];
        $registro_vac->esc_id=$data['esc_id'];
        $registro_vac->gra_id=$data['gra_id'];
        $registro_vac->eje_id=$data['eje_id'];
        $registro_vac->sex_id=$data['sex_id'];
        $registro_vac->vac_edadmin=$data['vac_edadmin'];
        $registro_vac->vac_sueldomax=$data['vac_sueldomax'];
        $registro_vac->vac_sueldomin=$data['vac_sueldomin'];
        $registro_vac->vac_escolaridadespecificar=$data['vac_escolaridadespecificar'];
        $registro_vac->vac_edadmax=$data['vac_edadmax'];
        $registro_vac->vac_idioma=$data['vac_idioma'];
        $registro_vac->vac_nivelidioma=$data['vac_nivelidioma'];
        $registro_vac->vac_otroidioma=$data['vac_otroidioma'];
        $registro_vac->vac_horario=$data['vac_horario'];
        $registro_vac->vac_conceptotecnico = trim($data['vac_conceptotecnico']);
        $registro_vac->vac_habilidad = trim($data['vac_habilidad']);
        $registro_vac->vac_funcionprincipal = trim($data['vac_funcionprincipal']);
        $registro_vac->vac_experiencia = trim($data['vac_experiencia']);
        $registro_vac->vac_observaciones = trim($data['vac_observaciones']);
        $registro_vac->vac_escolaridadespecificar = trim($data['vac_escolaridadespecificar']);        
        $registro_vac->tie_id=$data['tie_id'];
        $registro_vac->cen_id=$data['cen_id'];
        $registro_vac->cne_id=$data['cne_id'];
        $registro_vac->pre_id=$data['pre_id'];
        //campos  para tipo de empleo eventual
        $registro_vac->vac_tiempomeses=$data['vac_tiempomeses'];
        $registro_vac->tpg_id=$data['tpg_id'];
        $registro_vac->vac_privacidad=$data['vac_privacidad'];

        $registro_vac->usu_idalta=$auth_data['id'];
        $registro_vac->vac_estatus=1;

        if($registro_vac->save()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['vac_id']=$registro_vac->vac_id;
        
        }else{
            $answer['estado']=-2;
            $answer['mensaje']='Error al subir los datos de la vacante';
        }

        return $answer;
    }
    /**
     * Actualiza los datos generales de una vacante.
     *
     * @param array $data Los datos de la vacante a actualizar.
     *                    - est_id: El ID del estado.
     *                    - emp_id: El ID de la empresa.
     *                    - tip_id: El ID del tipo de vacante.
     *                    - mun_id: El ID del municipio.
     *                    - cav_id: El ID del campo de actividad.
     *                    - gen_id: El ID del género.
     *                    - esc_id: El ID de la escolaridad.
     *                    - gra_id: El ID del grado académico.
     *                    - eje_id: El ID del eje ocupacional.
     *                    - sex_id: El ID del sexo.
     *                    - vac_edadmin: La edad mínima requerida.
     *                    - vac_edadmax: La edad máxima requerida.
     *                    - vac_idioma: El idioma requerido.
     *                    - vac_nivelidioma: El nivel de idioma requerido.
     *                    - vac_otroidioma: Otro idioma requerido.
     *                    - vac_horario: El horario de trabajo.
     *                    - vac_conceptotecnico: El concepto técnico.
     *                    - vac_habilidad: Las habilidades requeridas.
     *                    - vac_funcionprincipal: La función principal.
     *                    - vac_experiencia: La experiencia requerida.
     *                    - vac_observaciones: Observaciones de la vacante.
     *                    - vac_escolaridadespecificar: Especificaciones de la escolaridad.
     *                    - tie_id: El ID del tipo de empresa.
     *                    - cne_id: El ID del campo de estudio.
     *                    - cen_id: El ID del centro de trabajo.
     * @param array $auth_data Los datos de autenticación.
     *                         - id: El ID del usuario autenticado.
     * @return array El resultado de la función.
     *               - estado: El estado de la operación. (2 para éxito, -2 para error)
     *               - mensaje: El mensaje asociado al resultado.
     *               - vac_id: El ID de la vacante actualizada en caso de éxito.
     */
    public function ActualizarGeneral($data,$auth_data,$permiso_cambiar_estatus=0,$permiso_cambiar_vac_numero=0,$eje_id_no_tiene_vac_compartida=false){
                $answer['estado']=-2;
                $answer['mensaje']='';
                $fecha_y_hora = date("Y-m-d H:i:s");
                $answer['vac_id']=$this->vac_id;
                $answer['mensaje_extra_bitacora']='';
                $answer['mensaje_extra_json']='';
        try {

                $this->usu_ultimomodifico=$auth_data['id'];
                $this->vac_actualizacion=$fecha_y_hora;
            // $this->vac_numero=$data['vac_numero'];
                $this->est_id=$data['est_id'];
                $this->emp_id=$data['emp_id'];
                $this->tip_id=$data['tip_id'];
                $this->mun_id=$data['mun_id'];
                $this->cav_id=$data['cav_id'];
                $this->gen_id=$data['gen_id'];
                $this->esc_id=$data['esc_id'];
                $this->gra_id=$data['gra_id'];
                if ($data['eje_id']!=$this->eje_id && $eje_id_no_tiene_vac_compartida==0) {
                    $this->eje_id=$data['eje_id'];
                }
                $this->sex_id=$data['sex_id'];
                $this->vac_edadmin=$data['vac_edadmin'];
                $this->vac_edadmax=$data['vac_edadmax'];
                $this->vac_sueldomax=$data['vac_sueldomax'];
                $this->vac_sueldomin=$data['vac_sueldomin'];
                $this->vac_idioma=$data['vac_idioma'];
                $this->vac_nivelidioma=$data['vac_nivelidioma'];
                $this->vac_otroidioma=$data['vac_otroidioma'];
                $this->vac_horario=$data['vac_horario'];
                $this->vac_conceptotecnico = trim($data['vac_conceptotecnico']);
                $this->vac_habilidad = trim($data['vac_habilidad']);
                $this->vac_funcionprincipal = trim($data['vac_funcionprincipal']);
                $this->vac_experiencia = trim($data['vac_experiencia']);
                $this->vac_observaciones = trim($data['vac_observaciones']);
                $this->vac_escolaridadespecificar = trim($data['vac_escolaridadespecificar']);                
                $this->tie_id=$data['tie_id'];
                $this->cne_id=$data['cne_id'];
                $this->cen_id=$data['cen_id'];
                $this->pre_id=$data['pre_id'];
                $this->tpg_id=$data['tpg_id'];
                $this->vac_privacidad=$data['vac_privacidad'];
                $this->vac_tiempomeses=$data['vac_tiempomeses'];
                $this->vac_garantia=$data['vac_garantia'];

                
                //EDITAR NUMERO DE ESPACIOS VACANTE INICIO
                $CAMBIAR_ESTATUS_VAC=1;
                $CAMBIAR_ESTATUS_VAC_PARA_MANDAR_FIN_POR_NUMERO_FAC=0;
                $APLICA_CAMBIO_DE_ESTATUS_AUTOMATICO = true; // Indica si aplica el cambio automático
                $VAC_ESTATUS_ANTERIOR = $this->vac_estatus; // Estatus que tenía
                $VAC_ESTATUS_ACTUAL = $data['vac_estatus']; // Estatus al que se va a actualizar
                
                // Verificar condiciones para NO aplicar el cambio automático de estatus
                if (
                    ($VAC_ESTATUS_ANTERIOR == "5" && $VAC_ESTATUS_ACTUAL == "4")
                    ||
                    ($VAC_ESTATUS_ANTERIOR == "2" && $VAC_ESTATUS_ACTUAL == "5")
                    ||
                    ($VAC_ESTATUS_ANTERIOR == "2" && $VAC_ESTATUS_ACTUAL == "4")
                    ||
                    ($VAC_ESTATUS_ANTERIOR == "4" && $VAC_ESTATUS_ACTUAL == "4")
                    ||
                    ($VAC_ESTATUS_ANTERIOR == "5" && $VAC_ESTATUS_ACTUAL == "5")
                )
                {
                    $APLICA_CAMBIO_DE_ESTATUS_AUTOMATICO = false;
                }

                if($permiso_cambiar_vac_numero==1){//valida que si tiene el permiso
                    if (isset($data['vac_numero']) && $data['vac_numero'] > 0) {
                        if($this->vac_estatus!=3){///valida que NO este en estatus fin
                            
                            if($this->vac_numero != $data['vac_numero']){//valida que el numero de vac no sea al mismo que la actualizacion
                                $this->vac_numeroanterior = $this->vac_numero; 
                                $this->vac_numerofechaactualizar = $fecha_y_hora; 
                            }
                          
                            $respuesta_modelo_conteo_facturados_exc=$this->getExpedientesRelacionadosVacanteFacturados($this->vac_id);

                            if(
                            ($respuesta_modelo_conteo_facturados_exc>=$data['vac_numero'] )
                            &&
                            $APLICA_CAMBIO_DE_ESTATUS_AUTOMATICO
                            ){
                                $CAMBIAR_ESTATUS_VAC=0;
                                $CAMBIAR_ESTATUS_VAC_PARA_MANDAR_FIN_POR_NUMERO_FAC=1;
                                $this->vac_estatusanterior = $this->vac_estatus ;
                                $this->vac_estatus =3;
                                $answer['mensaje_extra_json'].=', el número de vacantes a la que se actualizó es '.$data['vac_numero'].' y coincidió con el número de vacantes ya facturadas  '.$respuesta_modelo_conteo_facturados_exc.', la vacante ha cambiado a estatus FIN ';
                                $answer['mensaje_extra_bitacora'].=', se cambió de estatus porque el número de vacantes actualizado coincidía con el número de vacantes facturadas';

                            }
                          
                            $this->vac_numero = $data['vac_numero'];
                        }
                    }
            
                } 
                //EDITAR NUMERO DE ESPACIOS VACANTE FIN


                //CAMBIAR ESTATUS INICIO 
                if($CAMBIAR_ESTATUS_VAC==1){
                    if($permiso_cambiar_estatus==1){//validamos que tengamos el permiso
                     
                        if (isset($data['vac_estatus']) && $data['vac_estatus'] > 0){//validamos que este seteado y que sea un estatus real
                            if($this->vac_estatus != $data['vac_estatus']){//valida que el numero de vac no sea al mismo que la actualizacion
                          
                                // if($this->vac_estatus==5){//validar que no este en estatus de garantía
                                if(false){//validar que no este en estatus de garantía
                                    // error_log("NO SE PUEDE MOVER UN ESTATUS VACANTE QUE ESTA EN GARANTIA");-->se quito la validacion de garantia
                                }else{
                                    $answer['mensaje_extra_bitacora'].= ', actualizó el estatus de la vacante el estatus, estatus al que se actualiza '.$this->getEstatusTexto($data['vac_estatus']).' estatus anterior '.$this->getEstatusTexto($this->vac_estatus);
                                    $this->vac_estatusanterior = $this->vac_estatus;
                                    $this->vac_estatus = $data['vac_estatus'];

                                }
                              
                            }
                         
                        }
                        
                    }
                }
            
         
                //CAMBIAR ESTATUS FIN


                if($this->update()){
                    $answer['estado']=2;
                    $answer['mensaje']='ok';
                }else{
                    $answer['estado']=-2;
                    $answer['mensaje']='error';
                }

        } catch (Exception $e) {
            $answer['estado'] = -1;
            $answer['mensaje'] = 'Error: ' . $e->getMessage();
        }
        
        return $answer;
    }
    /**
     * Obtiene el texto correspondiente al estatus proporcionado.
     *
     * @param int $estatus El estatus para el cual se desea obtener el texto.
     * @return string El texto correspondiente al estatus. Devuelve una cadena de texto.
     */
    public $estatusTextoArray = array(
        -2 => "CANCELADO",
        1 => "EN ESPERA",
        2 => "EN PROCESO",
        3 => "FIN",
        4 => "STAND BY",
        5 => "GARANTÍA",
    );
 
    public function getEstatusTexto($estatus)
    {
        switch($estatus)
        {   
            case -2:
            return "ELIMINADO";
            break;
            case -1:
            return "CANCELADO";
            break;
            case 1:
            return "EN ESPERA";
            break;

            case 2:
            return "EN PROCESO";
            break;

            case 3:
            return "FIN";
            break;

            case 4:
            return "STAND BY";
            break;

            case 5:
            return "GARANTÍA";
            break;

            case -1:
            return "CANCELADA";
            break;
                
            case -2:
            return "ELIMINADO";
            break;
            
            default:
            return "";
            break;
        }
    }

    /**
     * Obtiene el color de la bandera de estatus correspondiente.
     *
     * @param int $estatus El estatus para el cual se desea obtener el color de la bandera.
     * @return string El color de la bandera correspondiente al estatus. Devuelve una clase CSS para aplicar el color.
     */
    public function  getEstatusBanderaColor($estatus)
    {

        switch($estatus)
        {   
            case -2:
            return "badge-danger badge-vac-eliminado";
            break;
            case -1:
            return "badge-danger badge-vac-cancelado";
            break;

            case 1:
            return "badge-primary badge-vac-espera";
            break;

            case 2:
            return "badge-warning badge-vac-proceso";
            break;

            case 3:
            return "badge-success badge-vac-fin";
            break;

            case 4:
            return "badge-light badge-vac-stand-by";
            break;

            case 5:
            return "badge-danger badge-vac-gar";
            break;

            case 6:
            return "badge-dark";
            break;

            case 7:
            return "badge-success";
            break;

            case 8:
            return "badge-danger";
            break;
        }
    }

    public function CambiarEstatusPorPrimerCitaCandidato($vac_id=0){
        //error_log("vac id ".$vac_id );

        $answer=[];
        $answer["estado"]=1;
        $answer["mensaje"]="normal";
        $fecha_y_hora = date("Y-m-d H:i:s");
        $condicion_sql="exc.vac_id=".$vac_id;
        $cita_en_vacante = Vacante::query()
                    ->leftjoin('Expedientecan','exc.vac_id=Vacante.vac_id','exc');

        $cita_en_vacante=$cita_en_vacante->where($condicion_sql)->execute();

        $vacante=Vacante::findFirstByvac_id($vac_id);

        if(!count($cita_en_vacante)>0){
            //error_log("no encontro expediente en la vac");

            $vacante=Vacante::findFirstByvac_id($vac_id);
            if($vacante){
              //  error_log("encontro la vac");

                $vacante->vac_estatus=2;
                $vacante->vac_actualizacion=$fecha_y_hora;
                if($vacante->update()){
                    $answer["estado"]=2;
                    $answer["mensaje"]="OK";
                    $answer["descripcion"]=" se actualizó vacante al estatus 2, ya que es la primera cita asignada";

                }

            }
        }elseif ($vacante->vac_estatus==1) {
            $vacante->vac_estatus=2;
                $vacante->vac_actualizacion=$fecha_y_hora;
                if($vacante->update()){
                    $answer["estado"]=2;
                    $answer["mensaje"]="OK";
                    $answer["descripcion"]=" se actualizó vacante al estatus 2, ya que el estatus era 1";

                }
        }


        return $answer;

    }

    public function getVacantesDisponibles($vac_id=0){

    }
    public function getExpedientesRelacionadosVacante($vac_id=0){
        $condicion_sql='vac_id = '.$vac_id.' AND exc_estatus > 0';

        $builder = new Builder();
        $builder->addFrom('Expedientecan')
                ->where($condicion_sql);

        $subs = $builder->getQuery()->execute();

        return $subs->count();

       
    }
    public function validarDisponibilidadFacturacion($vac_id){

        $vacante_obj = Vacante::findFirstByvac_id($vac_id);
        $answer["estado"]=-2;
        $answer["mensaje"]="NO HAY ESPACIOS DISPONIBLES EN LA VACANTE, YA SE CUBRIERON LOS ESPACIOS DISPONIBLES <br> DE LA VACANTE  NO. ".$vac_id;
        $answer["titular"]="HAY ESPACIOS";

        //condicion personalizada en base al vac_estatus-INI
        $condicion_sql='Facturacion.vac_estatus='.$vacante_obj->vac_estatus.' AND Facturacion.fat_estatus=2 AND exc.vac_id = '.$vac_id;
        $builder_exc = new Builder();
        $builder_exc->addFrom('Facturacion')
                    ->leftjoin('Expedientecan','exc.exc_id=Facturacion.exc_id','exc')
                    ->where($condicion_sql);
        $subs_exc = $builder_exc->getQuery()->execute();
        //condicion personalizada en base al vac_estatus-FIN

        $answer["count_exc"]=$subs_exc->count();
        $answer["count_vac"]=$vacante_obj->vac_numero;
        
        if (!($subs_exc->count() >= $vacante_obj->vac_numero)) {
            $answer["estado"]=2;
            $answer["mensaje"]="HAY ESPACIOS";
            $answer["titular"]="OK";

        }else{
            $answer["mensaje"].= '<br> No. de expedientes '.$answer["count_exc"].'- No. de vacantes '. $answer["count_vac"];
        }

        return $answer;

    }


    public function mandarAFacturacionSiSuperoLimite($vac_id){

        $answer["estado"]=-1;
        $answer["mensaje"]="AVISO";
        $answer["titular"]="AVISO";

        $vacante_obj = Vacante::findFirstByvac_id($vac_id);
        $respuesta_modelo_vac=$this->validarDisponibilidadFacturacion($vac_id);
        if($vacante_obj->vac_estatus!=3){

            if($respuesta_modelo_vac["estado"]==-2){
                $vacante_obj->vac_fechafin= date("Y-m-d H:i:s");
                $vacante_obj->vac_estatusanterior=$vacante_obj->vac_estatus;
                $vacante_obj->vac_estatus=3;
                if($vacante_obj->update()){
                    $answer["estado"]=2;
                    $answer["mensaje"]="se mandó a fin la vacante con folio ".$vacante_obj->vac_id;

                }else{
                    $answer["estado"]=-2;
                }
            }

        }else{
            $answer["estado"]=-2;
            $answer["mensaje"]="La vacante se encuentra en el estatus ".$this->getEstatusTexto(3)." de la vacante No. ".$vac_id;


        }
        
        return $answer;

    }

    //Esta funcion sirve para validar si la vacante esta en fin y en caso de de querer reactivar la 
    public function ActualizarSiEsEstatusFin($vac_id=0,$auth_data,$mandar_garantia=0){
        try {
            $answer["estado"] = -2;
            $answer["mensaje"] = "ok";
            $vacante_obj = Vacante::findFirstByvac_id($vac_id);
            if ($vacante_obj) {
                if ($vacante_obj->vac_estatus == 3) {//en caso de que la vacante ya este en fin
                    $vacante_obj->vac_estatusanterior = $vacante_obj->vac_estatus;
                    if($mandar_garantia==1){
                        $vacante_obj->vac_estatus = 5;

                    }
                    $vacante_obj->vac_fechareactivoproceso = date("Y-m-d H:i:s");
                    $vacante_obj->usu_idreactivoproceso = $auth_data['id'];
        
                    if ($vacante_obj->update()) {
                        $answer["estado"] = 2;
                        $answer["mensaje"] = "ok";
                    } else {
                        throw new Exception("Error al actualizar la vacante: " . print_r($vacante_obj->getMessages())   );

                    }
                } else {
                   
                  
                    $answer["estado"] = 2;
                    $answer["mensaje"] = "No se reactivó ninguna vacante";
                }
            }
        } catch (Exception $e) {
            $answer["estado"] = -2;
            $answer["mensaje"] = "Error: " . $e->getMessage();
            error_log( $answer["mensaje"]);
        }

        return $answer;
    }

    public function getExpedientesRelacionadosVacanteFacturados($vac_id=0){
        $condicion_sql='exc.vac_id = '.$vac_id.' AND exc.exc_estatus = 6 AND fat.vac_estatus<>5';
        $builder = new Builder();
        $builder->addFrom('Expedientecan',"exc")
                 ->leftjoin('Facturacion','fat.exc_id=exc.exc_id','fat')
                ->where($condicion_sql);
        $subs = $builder->getQuery()->execute();
        return $subs->count();
    }

    public function getExpedientesRelacionadosVacanteGarantia($vac_id=0){
        $condicion_sql='(exc.vac_id = '.$vac_id.' AND exc.exc_estatus = 7 ) OR (exc.vac_id = '.$vac_id.' AND fat.vac_estatus = 5 AND fat.fat_estatus=2) ';
        $builder = new Builder();
        $builder->addFrom('Expedientecan','exc')
                ->leftjoin('Facturacion','fat.exc_id=exc.exc_id','fat')
                ->where($condicion_sql);
        $subs = $builder->getQuery()->execute();
        return $subs->count();
    }

    

    public function ValidarLimiteFacturacionVacNumero($data,$auth_data){
        $answer=[];
        $answer['estado']=-2;
        $answer['mensaje']='';
        $vac_id=$this->vac_id;
        $vac_numero_actual=$this->vac_numero;
        $vac_numero_editar=$data["vac_numero"];
        $answer['vac_id']=$vac_id;
        $answer['vac_numero_actual']=$vac_numero_actual;

        ///validamos es mismo al que de por si esta cargado
        if($vac_numero_actual!=$data["vac_numero"]){

            $condicion_sql='vac_id = '.$vac_id.' AND exc_estatus =6';
            $builder = new Builder();
            $builder->addFrom('Expedientecan')
                    ->where($condicion_sql);
            $subs_exc_fat = $builder->getQuery()->execute();
            
            if( $data["vac_numero"] < $subs_exc_fat->count()){
                $answer['estado']=-1;
                $answer['mensaje']='No puedes colocar un número menor en el No. vacantes porque hay '.$subs_exc_fat->count().' expedientes ya facturados';
                $answer['vac_exc_fat']=$subs_exc_fat->count();
                $answer['vac_numero_editar']=$data["vac_numero"];
            }else{
                $answer['estado']=2;
                $answer['mensaje']='OK';
                $answer['vac_exc_fat']=$subs_exc_fat->count();
                $answer['vac_numero_editar']=$data["vac_numero"];
            }

        }else{
            $answer['estado']=2;
            $answer['mensaje']='No hay actualización';

        }

        return $answer;
    }

    public function ActualizarVacNoGeneral($data,$auth_data){
        $answer=[];
        $answer["estado"]=1;
        $answer["mensaje"]="normal";
        $fecha_y_hora = date("Y-m-d H:i:s");
        $vac_numero_anterior=$this->vac_numero;
        $this->vac_numero = $data['vac_numero'];
        $this->vac_numerofechaactualizar = $fecha_y_hora ;
        $this->usu_idmodificvacnumero = $auth_data["id"] ;

        if($this->update()){
            $answer["estado"]=2;
            $answer["vac_id"]=$this->vac_id;
            $answer["vac_numero_anterior"]=$vac_numero_anterior;
            $answer["vac_numero"]=$this->vac_numero;

            $answer["mensaje"]="actualizó datos de la capacidad de la vacante antes tenía ".$vac_numero_anterior." ahora se le asignó ".$this->vac_numero;
        }else{
            $answer["estado"]=-2;

        }
        
        return $answer;
    }

    public function CancelarVacante($auth_data){
        $answer=[];
        $answer["estado"]=1;
        $answer["mensaje"]="normal";
        $fecha_y_hora = date("Y-m-d H:i:s");

        $this->vac_fechacancelacion = $fecha_y_hora ;
       // $this->vac_actualizacion = $fecha_y_hora ;
        $this->vac_estatusanterior = $this->vac_estatus;
        $this->vac_estatus = -1;
        $this->usu_idcancelo = $auth_data["id"];

        if($this->update()){
            $answer["estado"]=2;
            $answer["vac_id"]=$this->vac_id;
            $answer["vac_estatusanterior"]= $this->vac_estatusanterior;
            $answer["vac_estaus_actual"]= $this->vac_estatus;
            $answer["mensaje"]="se canceló la vacante que tenía estatus ".$this->getEstatusTexto( $this->vac_estatusanterior);
            $answer["mensaje_estatus"]=" tenía estatus ".$this->getEstatusTexto( $this->vac_estatusanterior);

        }else{
            $answer["estado"]=-2;

        }
        
        return $answer;
    }


    public function getExpedientesEstatusCancelado($vac_id=0){
        $answer=[];
        $answer["estado"]=2;
        $answer["mensaje"]="ok";
        $answer["data"]=[];

        $regs = new Builder();
        $regs->addFrom('Expedientecan','exc');
        $regs_main=$regs;
        $regs_exc_estatus_11=$regs_main;
        $regs_exc_estatus_12=$regs_main;
        $regs_exc_estatus_13=$regs_main;
        $regs_exc_estatus_14=$regs_main;

        $regs_exc_estatus_21=$regs_main;
        $regs_exc_estatus_31=$regs_main;
        $regs_exc_estatus_41=$regs_main;
        $regs_exc_estatus_42=$regs_main;
        $regs_exc_estatus_43=$regs_main;
        $regs_exc_estatus_51=$regs_main;

        $answer["data"]["exc_estatus_11"]= $regs_exc_estatus_11->where('exc.exc_estatus=11 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_12"]= $regs_exc_estatus_12->where('exc.exc_estatus=12 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_13"]= $regs_exc_estatus_13->where('exc.exc_estatus=13 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_14"]= $regs_exc_estatus_14->where('exc.exc_estatus=14 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_21"]= $regs_exc_estatus_21->where('exc.exc_estatus=21 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_31"]= $regs_exc_estatus_31->where('exc.exc_estatus=31 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_41"]= $regs_exc_estatus_41->where('exc.exc_estatus=41 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_42"]= $regs_exc_estatus_42->where('exc.exc_estatus=42 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_43"]= $regs_exc_estatus_43->where('exc.exc_estatus=43 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();
        $answer["data"]["exc_estatus_51"]= $regs_exc_estatus_51->where('exc.exc_estatus=51 AND exc.vac_id='.$vac_id)->getQuery()->execute()->count();

    
        return $answer;
    }
    public function validarEstatusVacante($vac_id=0,$exc_estatus=0){
        $answer=[];
        $answer["estado"]=2;
        $answer["mensaje"]="ok";
        $answer["data"]=[];

        $vacante_obj = Vacante::findFirstByvac_id($vac_id);
        $estatus = $vacante_obj->vac_estatus;
        $estatus_permitidos = [-2, -1, 4];
        
        if (in_array($estatus, $estatus_permitidos) && $exc_estatus==6) {
            $answer["estado"]=-1;
            $answer["mensaje"]="La vacante no está disponible para facturación, el estatus de la vacante está  en ".$vacante_obj->getEstatusTexto($vacante_obj->vac_estatus);
        }

        return $answer;
    }

    public function validarEstatusVacanteExpReactivar(){
        $answer=[];
        $answer["estado"]=-2;
        $answer["mensaje"]="ok";
        $answer["data"]=[];
        $estatus_no_permitidos = [-2, -1,3];
        
        if (in_array($this->vac_estatus,$estatus_no_permitidos)) {
            $answer["estado"]=-1;
            $answer["mensaje"]="No se puede realizar el movimiento porque la vacante está:  ".$this->getEstatusTexto($this->vac_estatus);
        }else{
            $answer["estado"]=2;

        }

        return $answer;
    }

    public function cambiarEstatusPrevioFacturacion($auth=[]){
        $answer["estado"]=-2;
        $answer["mensaje"]="NO SE PUDO REALIZAR EL CAMBIO DE ESTATUS ANTERIOR EN VAC CON ESTATUS ".$this->getEstatusTexto($this->vac_estatus).' CON ID '.$this->vac_id;
        $answer["titular"]="ERROR";

        $lista_estatus_vac_permitidos_cambiar_estatus=[3];
        $lista_estatus_vac_permitidos_realizar_accion_regresar_fac=[5,4,2];
        $estatus_previo_nuevo= $this->vac_estatusanterior;
        $estatus_actual_viejo= $this->vac_estatus;

         if(in_array($this->vac_estatus, $lista_estatus_vac_permitidos_cambiar_estatus)){
           
            $this->vac_estatusanterior = $estatus_actual_viejo;
            $this->vac_estatus = $estatus_previo_nuevo;
            $this->usu_ultimomodifico = $auth["id"];

            if($this->update()){
                $answer["estado"]=2;
                $answer["mensaje"]="se cambió de estatus la vacante con ID ".$this->vac_id." tenía  el estatus ".$this->getEstatusTexto($estatus_actual_viejo).' ahora se le asignó el estatus '.$this->getEstatusTexto($estatus_previo_nuevo);
                $answer["titular"]="OK";
            }

         }
         if(in_array($this->vac_estatus, $lista_estatus_vac_permitidos_realizar_accion_regresar_fac)){
            $answer["mensaje"]="SE REALIZA LA ACCION PERO SIN CAMBIO DE ESTATUS DE VAC EL ESTATUS ACTUAL DE LA VACANTES ".$this->getEstatusTexto($estatus_actual_viejo).' con ID '.$this->vac_id;
            $answer["estado"]=2;

         }

            

          
        return $answer;
    }
    public function getTextoPrivacidad($value)
    {
       switch ($value) {
        case '1':
            return "PÚBLICA";
            break;
        case '2':
            return "PRIVADA";
            break;
        default:
            return "";
            break;
       }

     }

     public function MandarGarantia($auth){
        $answer["estado"]=-2;
        $answer["mensaje"]="ERROR AL MANDAR GARANTÍA";
        $answer["titular"]="ERROR";

        $estatus_previo= $this->vac_estatus;
        $estatus_actual=5;
   
        $this->vac_estatusanterior = $estatus_previo;
        $this->vac_estatus = $estatus_actual;
        $this->usu_ultimomodifico = $auth["id"];

        if($this->update()){
            $answer["estado"]=2;
            $answer["mensaje"]="OK";
            $answer["titular"]="OK";
            $answer["mensaje_extra_bitacora"]=", tenía estatus ".$this->getEstatusTexto($estatus_previo);
            $answer["mensaje_extra_json"]=", tenía estatus ".$this->getEstatusTexto($estatus_previo);
        }else{
            $answer["estado"]=-2;
        }
        
        return $answer;

     }


     public function validarEstatusVacante_MandaFacturacion($vac_id=0){
        $vacante_obj = Vacante::findFirstByvac_id($vac_id);
        $answer=[];
        $answer["estado"]=-2;
        $answer["titular"]="ESTATUS NO VÁLIDO PARA FACTURACIÓN";
        $answer["mensaje"]="La vacante no está disponible para facturación, el estatus de la vacante está  en ".$vacante_obj->getEstatusTexto($vacante_obj->vac_estatus);

        $estatus = $vacante_obj->vac_estatus;
        $estatus_permitidos = [2,5];
        
        if (in_array($estatus, $estatus_permitidos)) {
            $answer["estado"]=2;
            $answer["mensaje"]="OK";
            $answer["titular"]="OK";

        }

        return $answer;
    }

    public function getAllDetalleVac($vac_id){
        $registro = Vacante::query()
        ->columns('
                Vacante.vac_id,
                Vacante.tip_id,
                Vacante.cav_id,
                Vacante.vac_numero,
                Vacante.emp_id,
                Vacante.est_id,
                Vacante.mun_id,
                Vacante.gen_id,
                Vacante.esc_id,
                Vacante.gra_id,
                Vacante.eje_id,
                Vacante.sex_id,
                Vacante.vac_edadmin,
                Vacante.vac_edadmax,
                Vacante.vac_sueldomax,
                Vacante.vac_sueldomin,
                Vacante.vac_idioma,
                Vacante.vac_nivelidioma,
                Vacante.vac_otroidioma,
                Vacante.vac_horario,
                Vacante.vac_conceptotecnico,
                Vacante.vac_habilidad,
                Vacante.vac_funcionprincipal,
                Vacante.vac_experiencia,
                Vacante.vac_observaciones,
                Vacante.usu_ultimomodifico,
                Vacante.vac_estatus,
                Vacante.vac_escolaridadespecificar,
                Vacante.vac_id,
                emp.emp_nombre,
                Vacante.cen_id,
                Vacante.cne_id,
                Vacante.tie_id,
                Vacante.vac_privacidad,
                Vacante.pre_id,
                Vacante.vac_numero,
                Vacante.vac_garantia,

                Vacante.vac_tiempomeses,
                Vacante.tpg_id,
                tpg.tpg_nombre,
                sex.sex_nombre,
                est.est_nombre,
                mun.mun_nombre,
                gen.gen_nombre,
                CONCAT(eje.usu_nombre," ", eje.usu_primerapellido," ",eje.usu_segundoapellido) as eje_nombre,
                tie.tie_nombre,
                esc.esc_nombre,
                gra.gra_nombre,
                eje.usu_nombre,
                pre.pre_nombre,
                cen.cen_nombre,

                cne.cne_nombre,
                CONCAT(cne.cne_nombre," ", cne.cne_primerapellido," ",cne.cne_segundoapellido) as cne_nombre_completo,
                cne.cne_puesto,
                cne.cne_tel,
                cne.cne_correo,
                cne.cne_celular,

                tip.tip_nombre,
                cav.cav_nombre
            ')
            ->where('vac_id=' . $vac_id)
            ->leftjoin('Empresa','emp.emp_id=Vacante.emp_id','emp')
            ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
            ->leftjoin('Tipovacante','tip.tip_id=Vacante.tip_id','tip')
           // ->leftjoin('Sexo','sex.sex_id=Vacante.sex_id','sex')
            ->leftjoin('Estado','est.est_id=Vacante.est_id','est')
            ->leftjoin('Municipio','mun.mun_id=Vacante.mun_id','mun')
            ->leftjoin('Generacion','gen.gen_id=Vacante.gen_id','gen')
            ->leftjoin('Tipoempleo','tie.tie_id=Vacante.tie_id','tie')
            ->leftjoin('Estadocivil','esc.esc_id=Vacante.esc_id','esc')
            ->leftjoin('Gradoescolar','gra.gra_id=Vacante.gra_id','gra')
            ->leftjoin('Usuario','eje.usu_id=Vacante.eje_id','eje')
            ->leftjoin('Prestacion','pre.pre_id=Vacante.pre_id','pre')
            ->leftjoin('Centrocosto','cen.cen_id=Vacante.cen_id','cen')
            ->leftjoin('Contactoemp','cne.cne_id=Vacante.cne_id','cne')
            ->leftjoin('Tipopago','tpg.tpg_id=Vacante.tpg_id','tpg')
            ->leftjoin('Catvacante','cav.cav_id=Vacante.cav_id','cav')
            ->execute();

            return $registro[0];
    }

    public function MandarProceso($auth){
        $answer["estado"]=-2;
        $answer["mensaje"]="ERROR AL MANDAR PROCESO";
        $answer["titular"]="ERROR";

        $estatus_previo= $this->vac_estatus;
        $estatus_actual=2;
   
        $this->vac_estatusanterior = $estatus_previo;
        $this->vac_estatus = $estatus_actual;
        $this->usu_ultimomodifico = $auth["id"];

        if($this->update()){
            $answer["estado"]=2;
            $answer["mensaje"]="OK";
            $answer["titular"]="OK";
            $answer["mensaje_extra_bitacora"]=", tenía estatus ".$this->getEstatusTexto($estatus_previo);
            $answer["mensaje_extra_json"]=", tenía estatus ".$this->getEstatusTexto($estatus_previo);
        }else{
            $answer["estado"]=-2;
        }
        
        return $answer;

    }


 
}