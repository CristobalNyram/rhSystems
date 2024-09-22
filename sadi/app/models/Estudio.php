<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
use PSpell\Config;

/**
 * Modelo de la tabla estudio
 */
class Estudio extends Model
{   

    protected $controllerBase;

    public function initialize()
    {
        $this->controllerBase = new ControllerBase();
    }

 
    public function getEstatusDetail($estatus)
    {
        switch($estatus)
        {   
            case -2:
            return "CANCELADO";
            break;

            case 1:
            return "INICIAL";
            break;

            case 2:
            return "EN CAMPO";
            break;

            case 3:
            return "EN CAMPO (REASIGNADO)";
            break;

            case 4:
            return "EN REVISIÓN";
            break;

            case 5:
            return "EN REVISIÓN A";
            break;

            case 6:
            return "VALIDACIÓN";
            break;

            case 7:
            return "APROBADO";
            break;

            case 8:
            return "NO APROBADO";
            break;
        }
    }

    public function getEstatusDetailCliente($estatus)
    {
        switch($estatus)
        {   
            case -2:
            return "CANCELADO";
            break;

            case 1:
            return "INICIAL";
            break;

            case 2:
            return "EN CAMPO";
            break;

            case 3:
            return "EN CAMPO";
            break;

            case 4:
            return "POR ASIGNAR A ANALISTA";
            break;

            case 5:
            return "EN REVISIÓN POR ANALISTA";
            break;

            case 6:
            return "PENDIENTE DE AUTORIZACIÓN";
            break;

            case 7:
            return "ENTREGADO A CLIENTE";
            break;

            case 8:
            return "EN REVISIÓN ANALISTA";
            break;
        }
    }

    public function CrearSocioeconomico($data,$usu_id){
        $registro = new Estudio();
        $registro->ese_puesto= $data['ese_puesto'];
        $registro->ese_estatus=1;
        $registro->ese_nombre= trim($data['ese_nombre']);
        $registro->ese_tippersona= $data['ese_tippersona'];
        if($data['ese_tippersona']==1){
            $registro->ese_primerapellido= trim($data['ese_primerapellido']);
            $registro->ese_segundoapellido= trim($data['ese_segundoapellido']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        if($data['ese_fechanacimiento']!=''){
            $registro->ese_fechanacimiento= $data['ese_fechanacimiento'];
        }
        $registro->ese_curp= $data['ese_curp'];
        $registro->ese_nss= $data['ese_nss'];
        $registro->ese_calle= $data['ese_calle'];
        $registro->ese_numext= $data['ese_numext'];
        $registro->ese_numint= $data['ese_numint'];
        $registro->ese_colonia= $data['ese_colonia'];
        $registro->ese_codpostal= $data['ese_codpostal'];
        $registro->ese_telefono= $data['ese_telefono'];
        $registro->ese_celular= $data['ese_celular'];
        $registro->est_id= $data['est_id'];
        $registro->mun_id=($data['mun_id']==-1?null:$data['mun_id']);
        if($data['ese_finestudios']!=''){
            $registro->ese_finestudios= $data['ese_finestudios'];
        }
        $registro->emp_id= $data['emp_id'];
        if($this->controllerBase->numerovalidoInputValido($data['emp_id'])){
            $emp_obj=new Empresa();
            $gru_id=$emp_obj->getGruId($data['emp_id']);   
            if ($this->controllerBase->numerovalidoInputValido($gru_id)) {
                $registro->gru_id = $gru_id;
            }

        }
        $registro->cne_id= $data['cne_id'];
        // $registro->ese_centrocosto= $data['ese_centrocosto'];
        $registro->cen_id=($data['cen_id']<=-1?null:$data['cen_id']);
        // $registro->cen_id= $data['cen_id'];
        $registro->tip_id= $data['tip_id'];
        $registro->tif_id= $data['tif_id'];
        $registro->ultimo_usuid=$usu_id;
        $registro->usu_idalta=$usu_id;
        $registro->ese_folioverificacion=$data['ese_folioverificacion_eses'];
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];

        
        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

  
    public function CrearVerificacion($data,$usu_id){
        $registro = new Estudio();
        $registro->ese_estatus=1;
        $registro->ese_nombre= trim($data['ese_nombre']);
        $registro->ese_tippersona= $data['ese_tippersona'];
        $registro->ese_folioverificacion= $data['ese_folioverificacion'];
        if($data['ese_tippersona']==1){
            $registro->ese_primerapellido= trim($data['ese_primerapellido']);
            $registro->ese_segundoapellido= trim($data['ese_segundoapellido']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        if($data['ese_fechanacimiento']!=''){
            $registro->ese_fechanacimiento= $data['ese_fechanacimiento'];
        }
        $registro->est_id= $data['est_id'];
        $registro->mun_id= ($data['mun_id']==-1?null:$data['mun_id']);

        $registro->emp_id= $data['emp_id'];

        if($this->controllerBase->numerovalidoInputValido($data['emp_id'])){
            $emp_obj=new Empresa();
            $gru_id=$emp_obj->getGruId($data['emp_id']);   
            if ($this->controllerBase->numerovalidoInputValido($gru_id)) {
                $registro->gru_id = $gru_id;
            }

        }

        $registro->cne_id= $data['cne_id'];
        // $registro->cen_id= $data['cen_id'];
        $registro->cen_id=($data['cen_id']<=-1?null:$data['cen_id']);
        // $registro->ese_centrocosto= $data['ese_centrocosto'];
        $registro->tip_id= $data['tip_id'];
        $registro->tif_id= $data['tif_id'];
        $registro->ver_id= $data['ver_id'];
        $registro->ultimo_usuid=$usu_id;
        $registro->usu_idalta=$usu_id;
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function CrearNegocio($data,$usu_id){
        $registro = new Estudio();
        $registro->ese_estatus=1;
        $registro->ese_nombre= trim($data['ese_nombre']);
        $registro->ese_tippersona= $data['ese_tippersona'];
        $registro->ese_folioverificacion= $data['ese_numerocontrol'];
        if($data['ese_tippersona']==1){
            $registro->ese_primerapellido= trim($data['ese_primerapellido']);
            $registro->ese_segundoapellido=trim($data['ese_segundoapellido']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        if($data['ese_fechanacimiento']!=''){
            $registro->ese_fechanacimiento= $data['ese_fechanacimiento'];
        }
        $registro->est_id= $data['est_id'];
        $registro->mun_id=($data['mun_id']==-1?null:$data['mun_id']);
        $registro->emp_id= $data['emp_id'];
        if($this->controllerBase->numerovalidoInputValido($data['emp_id'])){
            $emp_obj=new Empresa();
            $gru_id=$emp_obj->getGruId($data['emp_id']);   
            if ($this->controllerBase->numerovalidoInputValido($gru_id)) {
                $registro->gru_id = $gru_id;
            }

        }
        $registro->cne_id= $data['cne_id'];
        $registro->cen_id=($data['cen_id']<=-1?null:$data['cen_id']);
        // $registro->ese_centrocosto= $data['ese_centrocosto'];
        // $registro->cen_id= $data['cen_id'];
        $registro->tip_id= $data['tip_id'];
        $registro->tif_id= $data['tif_id'];

        // $registro->ver_id= $data['ver_id'];
        $registro->ultimo_usuid=$usu_id;
        $registro->usu_idalta=$usu_id;
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];


        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function CrearSupervivencia($data,$usu_id){
        $registro = new Estudio();
        $registro->ese_estatus=1;
        $registro->ese_nombre= trim($data['ese_nombre']);
        $registro->ese_tippersona= $data['ese_tippersona'];
        $registro->ese_folioverificacion= $data['ese_numerocontrol'];
        if($data['ese_tippersona']==1){
            $registro->ese_primerapellido= trim($data['ese_primerapellido']);
            $registro->ese_segundoapellido=trim($data['ese_segundoapellido']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        if($data['ese_fechanacimiento']!=''){
            $registro->ese_fechanacimiento= $data['ese_fechanacimiento'];
        }
        $registro->est_id= $data['est_id'];
        $registro->mun_id=($data['mun_id']==-1?null:$data['mun_id']);
        $registro->emp_id= $data['emp_id'];
        if($this->controllerBase->numerovalidoInputValido($data['emp_id'])){
            $emp_obj=new Empresa();
            $gru_id=$emp_obj->getGruId($data['emp_id']);   
            if ($this->controllerBase->numerovalidoInputValido($gru_id)) {
                $registro->gru_id = $gru_id;
            }

        }
        
        $registro->cne_id= $data['cne_id'];
        $registro->cen_id=($data['cen_id']<=-1?null:$data['cen_id']);
        // $registro->ese_centrocosto= $data['ese_centrocosto'];
        // $registro->cen_id= $data['cen_id'];
        $registro->tip_id= $data['tip_id'];
        $registro->tif_id= $data['tif_id'];
        // $registro->ver_id= $data['ver_id'];
        $registro->ultimo_usuid=$usu_id;
        $registro->usu_idalta=$usu_id;
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

        /**[RegresarEstatus REGRESAR ESTATUS actualiza el campo ese_estatus de la tabla ESTUDIO ]
         * @param[ninguno pero utiliza un objeto de ESTUDIO]
         * @return [boolean=>true[tuvo exito ] or false[fallo al hacer los cambios] ][string=>'Es un mensaje que indica lo que se realizo ']
         */
    public function RegresarEstatus($auth)
    {   
        $respuesta=-1;
        $mensaje='No puedes regresar de estatus este estudio.';  
         if(($this->ese_estatus>=-2) && ($this->ese_estatus<=7))
         {
            if($this->ese_estatus ==-2)
            {
                $mensaje='Se ha cambiado el estudio No.'.$this->ese_id.' de estatus CANCELAR a estatus '.$this->getEstatusDetail($this->ese_precancelar);
            }
            else
            {
                $mensaje='Se ha cambiado el estudio No.'.$this->ese_id.'de estatus '.$this->getEstatusDetail($this->ese_estatus).' a estatus '.$this->getEstatusDetail($this->ese_estatus-1);
            }  
            switch ($this->ese_estatus) {
                case    -2:

                    $this->ese_fechacancelacion=null;
                    $this->usu_idcancela=null;
                    $estatus_recuperar=$this->ese_precancelar;
                    $this->ese_estatus=$estatus_recuperar;

                    if($estatus_recuperar<=3){ 
                        $cita=new Cita();              
                        $respuesta_modelo_buscar_cita =$cita->BuscarCitaCancelada($this->ese_id);
                        if( $respuesta_modelo_buscar_cita['estado']){
                            $respuesta_modelo_finalizar_cita= $cita->ReActivarCita($respuesta_modelo_buscar_cita['cit_id'],$auth);
                        }
                    }
                    if($estatus_recuperar>=4){ 
                        $cita=new Cita();              
                        $respuesta_modelo_buscar_cita =$cita->BuscarCitaCancelada($this->ese_id);
                        if( $respuesta_modelo_buscar_cita['estado']){
                            $respuesta_modelo_finalizar_cita= $cita->FinalizarCita($respuesta_modelo_buscar_cita['cit_id'],$auth);
                        }
                    }

                    if($this->ese_autoestudio==1){
                        $respuesta_modelo_regresar_aes= $this->ValidarEstatusACambiarAutoEstudio($this->ese_id,$estatus_recuperar);
                    }

                    #archivos de cancelacion inicio
                    $obj_estcancelado=new Estcancelado();              
                    $respuesta_modelo_crear_actualizar_estcancelado= $obj_estcancelado->DesativarRegistro($this->ese_id,$auth);
                    #archivos de cancelacion inicio

                    $respuesta= $this->save();

                   
                    break;
                case    2:
                case    3:
                    $this->ese_fechaasiginvestigador=null;
                    $this->ese_honorario=null;

                    //$this->ana_id=null;
                    //$this->ese_fechaasiganalista=null;
                        if($this->ese_transporte==2)
                        {
                            $transporte =new Transporte();
                            $respuesta_modelo_buscar_tra=  $transporte->buscarTransporteSolicitado($this->ese_id);
                            if($respuesta_modelo_buscar_tra['estado']){
                                $transporte->desActivarTransporte($respuesta_modelo_buscar_tra['tra_id']);
                            }
                           
                        }                    
                    $this->ese_transporte=1;
                    $this->ese_estatus=1;
                    $this->inv_id=null;
                    
                    $respuesta= $this->update();
                    break;
                case    4:
              
                    
                    $this->ese_estatus=2;
                    $this->ese_fechaentregainvestigador=null;    
                    $this->ana_id=null;
                    $this->ese_fechaasiganalista=null;  
                    if ($this->ese_transporte==2) {
                        $transporte= Transporte::findFirst(array('tra_estatus > 0 and ese_id='.$this->ese_id));
                
                        $transporte->tra_estatus=1;

                    
                        $transporte->update();
                    }
                        $cita=new Cita();
                        $respuesta_modelo_buscar_cita =$cita->BuscarCitaFinalizada($this->ese_id);
                        if( $respuesta_modelo_buscar_cita['estado']){
                            $respuesta_modelo_finalizar_cita= $cita->ReActivarCita($respuesta_modelo_buscar_cita['cit_id'],$auth);

                        }

                    if($this->ese_autoestudio==1){
                        $respuesta_modelo_regresar_aes= $this->ReActiviarAutoestudioParaContestar($this->ese_id);

                    }
                  
                     $respuesta= $this->save();

                    break;

                case    5:
                    $this->ese_estatus=4;
                    $this->ese_fechaasiganalista=null;
                    $this->ana_id=null;
                    $respuesta= $this->save();

                    break;

                case    6:
                    $this->ese_estatus=5;
                    $this->ese_fechaentregaanalista=null;
                    $respuesta= $this->save();
                    break;
                case     7:
                    $this->ese_estatus=6;
                    $this->usu_idvalida=null;
                  //  $this->ese_fechaentregacliente=null;
                    $this->ese_visita=1;
                    $respuesta= $this->save();
                     break;
            }
         }


        return [$respuesta,$mensaje]; 
         
    }

    public function EditarVerificacion($data,$usu_id){
        // $registro = new Estudio();
        $registro= Estudio::findFirstByese_id( $data['ese_ideditarver']);
        $registro->ese_nombre= trim($data['ese_nombreeditarver']);
        $registro->ese_tippersona= $data['tip_personaeditarver'];
        $registro->ese_folioverificacion= $data['ese_folioverificacioneditarver'];
        if($data['tip_personaeditarver']==1){
            $registro->ese_primerapellido=trim($data['ese_primerapellidoeditarver']);
            $registro->ese_segundoapellido=trim($data['ese_segundoapellidoeditarver']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        $registro->est_id= $data['est_ideditarver'];
        $registro->mun_id= ($data['mun_ideditarver']==-1?null:$data['mun_ideditarver']);
        $registro->emp_id= $data['emp_ideditarver'];
        $registro->cne_id= $data['cne_ideditarver'];
        //$registro->ese_centrocosto= $data['ese_centrocostoeditarver'];
         $registro->cen_id= ($data['ese_centrocostoeditarver']<=-1?null:$data['ese_centrocostoeditarver']);
        $registro->ver_id= $data['ver_ideditarver'];
        $registro->ultimo_usuid=$usu_id;
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function  getEstatusBanderaColor($estatus)
    {

        switch($estatus)
        {   
            case -2:
            return "badge-danger";
            break;

            case 1:
            return "badge-primary";
            break;

            case 2:
            return "badge-warning";
            break;

            case 3:
            return "badge-warning";
            break;

            case 4:
            return "badge-light";
            break;

            case 5:
            return "badge-light";
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

    public function ActualizarRegistroEseDatoComprobatorio($data)
    {
        $this->ese_fechanacimiento=($data['ese_fechanacimiento']!=''?$data['ese_fechanacimiento']:null);
        $this->ese_lugarnacimiento=$data['ese_lugarnacimiento'];
        $this->ese_edad=($data['ese_edad']==''?null:$data['ese_edad']);
        $this->ese_nombre=trim($data['ese_nombre']);
        $this->ese_primerapellido=trim($data['ese_primerapellido']);
        $this->ese_segundoapellido=trim($data['ese_segundoapellido']);
        $this->est_id=$data['est_id'];
        $this->mun_id=($data['mun_id']==-1?null:$data['mun_id']);
        $this->ese_sexo=$data['ese_sexo'];
        $this->ese_calle=$data['ese_calle'];
        $this->ese_numext=$data['ese_numext'];
        $this->ese_numint=$data['ese_numint'];
        $this->ese_colonia=$data['ese_colonia'];
        $this->ese_codpostal=$data['ese_codpostal'];
        $this->ese_celular=$data['ese_celular'];
        $this->ese_telefono=$data['ese_telefono'];
        $this->ese_entrecalles=$data['ese_entrecalles'];
        $this->ese_puesto=$data['ese_puesto'];
        $this->niv_id=($data['niv_id_eses']==-1?null:$data['niv_id_eses']);
        $this->ese_nss=$data['ese_nss'];
        $this->ese_curp=$data['ese_curp'];

        $this->esc_id=($data['esc_id_eses']==-1?null:$data['esc_id_eses']);

        
        if( $this->update())
         return   $respuesta=['estado'=>2,'ese_id'=>$this->ese_id];
        else
        return $respuesta=['estado'=>-2];

        
    }
    public function ActualizarRegistroEseDatoComprobatorio_formato_gabencognv($data)
    {
        $this->ese_fechanacimiento=($data['ese_fechanacimiento']!=''?$data['ese_fechanacimiento']:null);
        $this->ese_lugarnacimiento=$data['ese_lugarnacimiento'];
        $this->ese_edad=($data['ese_edad']==''?null:$data['ese_edad']);

        $this->ese_nombre=trim($data['ese_nombre']);
        $this->ese_primerapellido=trim($data['ese_primerapellido']);
        $this->ese_segundoapellido=trim($data['ese_segundoapellido']);

        $this->est_id=$data['est_id'];
        $this->mun_id=($data['mun_id']==-1?null:$data['mun_id']);

        $this->ese_sexo=$data['ese_sexo'];
        $this->ese_calle=$data['ese_calle'];
        $this->ese_numext=$data['ese_numext'];
        $this->ese_numint=$data['ese_numint'];
        $this->ese_colonia=$data['ese_colonia'];
        $this->ese_codpostal=$data['ese_codpostal'];
        $this->ese_celular=$data['ese_celular'];
        $this->ese_telefono=$data['ese_telefono'];
        $this->ese_entrecalles=$data['ese_entrecalles'];
        $this->ese_puesto=$data['ese_puesto'];
        $this->niv_id=($data['niv_id_eses']==-1?null:$data['niv_id_eses']);
        $this->ese_nss=$data['ese_nss'];
        $this->ese_curp=$data['ese_curp'];

        $this->esc_id=($data['esc_id_eses']==-1?null:$data['esc_id_eses']);
        $this->ese_familiarempresa=$data['ese_familiarempresa'];

        
        if( $this->update())
         return   $respuesta=['estado'=>2,'ese_id'=>$this->ese_id];
        else
        return $respuesta=['estado'=>-2];

        
    }

    
    
    public function EditarSocioeconomico($data,$usu_id){
        // $registro = new Estudio();
        $registro= Estudio::findFirstByese_id( $data['ese_ideditarese']);
        $registro->ese_nombre= trim($data['ese_nombreeditarese']);
        $registro->ese_tippersona= $data['tip_personaeditarese'];
        if($data['tip_personaeditarese']==1){
            $registro->ese_primerapellido= trim($data['ese_primerapellidoeditarese']);
            $registro->ese_segundoapellido=trim($data['ese_segundoapellidoeditarese']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        $registro->est_id= $data['est_ideditarese'];
        $registro->mun_id= ($data['mun_ideditarese']==-1?null:$data['mun_ideditarese']);
        $registro->emp_id= $data['emp_ideditarese'];
        $registro->cne_id= $data['cne_ideditarese'];
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];

        //$registro->ese_centrocosto= $data['ese_centrocostoeditarese'];
         $registro->cen_id= ($data['ese_centrocostoeditarese']<=-1?null:$data['ese_centrocostoeditarese']);
        $registro->ultimo_usuid=$usu_id;
        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function EditarSupervivencia($data,$usu_id){
        $registro= Estudio::findFirstByese_id( $data['ese_ideditarsup']);
        $registro->ese_nombre= trim($data['ese_nombreeditarsup']);
        $registro->ese_tippersona= $data['tip_personaeditarsup'];
        if($data['tip_personaeditarsup']==1){
            $registro->ese_primerapellido= trim($data['ese_primerapellidoeditarsup']);
            $registro->ese_segundoapellido= trim($data['ese_segundoapellidoeditarsup']);
        }else{
            $registro->ese_primerapellido= '';
            $registro->ese_segundoapellido= '';
        }
        $registro->est_id= $data['est_ideditarsup'];
        $registro->mun_id= ($data['mun_ideditarsup']==-1?null:$data['mun_ideditarsup']);
        $registro->emp_id= $data['emp_ideditarsup'];
        $registro->cne_id= $data['cne_ideditarsup'];
        $registro->cen_id=($data['ese_centrocostoeditarsup']<=-1?null:$data['ese_centrocostoeditarsup']);
        // $registro->cen_id= $data['cen_ideditarsup'];
        $registro->ese_folioverificacion= $data['ese_folioverificacioneditarsup'];
        $registro->ese_empresarecluta=$data['ese_empresarecluta'];


        $registro->ultimo_usuid=$usu_id;
        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }


    public function ActualizarRegistroFormatoTruper($data,$permiso_califacion)
    {
     

        $this->ese_nombre=trim($data['ese_nombre']);
        $this->ese_primerapellido=trim($data['ese_primerapellido']);
        $this->ese_segundoapellido=trim($data['ese_segundoapellido']);

        $this->ese_edad=($data['ese_edad']==''?null:$data['ese_edad']);
        $this->ese_fechanacimiento=($data['ese_fechanacimiento']!=''?$data['ese_fechanacimiento']:null);
        $this->ese_lugarnacimiento=$data['ese_lugarnacimiento'];


        $this->ese_puesto=$data['ese_puesto'];
        $this->ese_area=$data['ese_area'];

        $this->est_id=$data['est_id'];
        $this->mun_id=($data['mun_id']==-1?null:$data['mun_id']);
        $this->ese_sexo=$data['ese_sexo'];


        $this->ese_calle=$data['ese_calle'];
        $this->ese_numext=$data['ese_numext'];
        $this->ese_numint=$data['ese_numint'];
        $this->ese_colonia=$data['ese_colonia'];
        $this->ese_codpostal=$data['ese_codpostal'];
        $this->ese_referenciaubicacion=$data['ese_referenciaubicacion'];


        $this->ese_celular=$data['ese_celular'];
        $this->ese_telefono=$data['ese_telefono'];
        $this->ese_telefonorecado=$data['ese_telefonorecado'];

        $this->ese_entrecalles=$data['ese_entrecalles'];
        
        $this->ese_callenorte=$data['ese_callenorte'];
        $this->ese_callesur=$data['ese_callesur'];
        $this->ese_calleeste=$data['ese_calleeste'];
        $this->ese_calleoeste=$data['ese_calleoeste'];

        // $this->ese_curp=$data['ese_curp'];
        // $this->ese_nss=$data['ese_nss'];

        $this->ese_fechavisita=($data['ese_fechavisita']==null) ?   null : $data['ese_fechavisita'];
        $this->ese_ubicacioncasa=(!isset($data['ese_ubicacioncasa'])) ? null : $data['ese_ubicacioncasa'];
        //$this->ese_calificacion=$data['ese_calificacion'];

        
        

        // $this->ese_nss=$data['ese_nss'];
        // $this->ese_curp=$data['ese_curp'];

        $this->esc_id=($data['esc_id_eses']==-1?null:$data['esc_id_eses']);

        
        if( $this->update())
         return   $respuesta=['estado'=>2,'ese_id'=>$this->ese_id];
        else
        return $respuesta=['estado'=>-2];

    }


    public function formatoEseTruperDatosCliente($ese_id,$estudio_data,$empresa_data,$qr, $qrfolio="", $qrfecha=""){
        $reporte= new PdfReporteTruper();
        $html=$reporte->datoscliente_pagina_14;


        $contacto_emp= new Contactoemp();        
        $contacto_emp=$contacto_emp->get_contactoempresa_activa($estudio_data->cne_id);


        if($contacto_emp!=null){

            $html=str_replace("#ese_cliente-nombre#",trim('TRUPER'),$html);

            $html=str_replace("#ese_cliente-contacto#",trim($contacto_emp->cne_nombre.' '.$contacto_emp->cne_primerapellido.' '.$contacto_emp->cne_segundoapellido),$html);
            $html=str_replace("#ese_cliente-domicilio#",trim('CALLE D 31A MODELO DE ECHEGARAY, NAUCALPAN DE JUÁREZ, MEX.'),$html);
            $html=str_replace("#ese_cliente-telefono#",trim($contacto_emp->cne_tel),$html);
            $html=str_replace("#ese_cliente-ext#",trim($contacto_emp->cne_ext),$html);
            $html=str_replace("#ese_cliente-puesto#",trim($contacto_emp->cne_puesto),$html);
            $html=str_replace("#ese_cliente-correo#",trim($contacto_emp->cne_correo),$html);

        }else{
            $html=str_replace("#ese_cliente-nombre#",'',$html);
            $html=str_replace("#ese_cliente-domicilio#",'',$html);
            $html=str_replace("#ese_cliente-contacto#",'',$html);
            $html=str_replace("#ese_cliente-telefono#",'',$html);
            $html=str_replace("#ese_cliente-ext#",'',$html);
            $html=str_replace("#ese_cliente-puesto#",'',$html);
            $html=str_replace("#ese_cliente-correo#",'',$html);

        }


       

        $html=str_replace("#ese_emp_investigadora-razonsocial#",'SOLUCIONES IDEALES EN PERSONAL SELECCIONADO',$html);
        $html=str_replace("#ese_emp_investigadora-domiciliosical#",'PIAXTLA #6-2 LA PAZ, PUEBLA CP 72160',$html);
        $html=str_replace("#ese_emp_investigadora-telefono#",trim('222 296 6585 '),$html);
        $html=str_replace("#ese_emp_investigadora-email#",trim('estudios@sips.mx'),$html);

        $html=str_replace("#qr#",basename('temp/'.$qr),$html);
        $html=str_replace("#folioqr#",$qrfolio,$html);
        $html=str_replace("#fechaqr#",$qrfecha,$html);
        $html=str_replace("#ese_emp_investigadora-sello#",trim(basename('images/sips_documento.png')),$html);
        $html=str_replace("#ese_emp_investigadora-firma#",trim(basename('images/firma.jpg')),$html);


        return $html;
    }


    public function get_nombrecompletocandidato(){

        return $this->ese_nombre.' '.$this->ese_primerapellido.' '.$this->ese_segundoapellido;

    }
    
    public function get_nombre(){
        return $this->ese_nombre;

    }
    public function ActualizarImssCurp($data){

        $this->ese_nss=$data['cop_imssfolio'];
        $this->ese_curp=$data['cop_curpfolio'];

        if( $this->update())
            return   $respuesta=['estado'=>2,'ese_id'=>$this->ese_id];
         else

             return $respuesta=['estado'=>-2];


    }

  
    public function ValidarSiEsAutoEstudioConEstatusValidoParaRegresar(){
     
        if($this->ese_autoestudio==1 &&  ($this->ese_estatus==3 || $this->ese_estatus==2 )){
            return  true;
        }else{
            return  false;
        }

    }

    public function ValidarSiEsAutoEstudioConEstatusValidoParaRegresar_Vista($aes_activo,$ese_estatus){
     
        if($aes_activo!=1 &&  ($ese_estatus!=3 || $ese_estatus!=2 )){
            return  true;
        }else{
            return  false;
        }

    }

    public function ValidarSiEsAutoEstudio_Vista($ese_autoestudio){

        if($ese_autoestudio==1)
            return  true;
        else
            return  false;
        
    }


    public function EnviarATraficoAnalista($ese_id){

        $fecha_y_hora = date("Y-m-d H:i:s");

        $estudio=Estudio::findFirstByese_id($ese_id);
        $estudio->ese_fechaentregainvestigador=$fecha_y_hora;

        if($estudio->ana_id==null){
            $estudio->ese_estatus=4;

        }else{
            $estudio->ese_estatus=5;

        }

        if($estudio->update()){
            return ['estado'=>true,'ese_id'=>$ese_id];
        }else{
            return ['estado'=>false,'ese_id'=>$ese_id];

        }


    }
    public function CancelarAutoestudioAsociado(){
        $answer=[];

        $aes=new Autoestudio();
        $respuesta_modelo_busqueda= $aes->BuscarRegistroActivoByese_id($this->ese_id);


         if($respuesta_modelo_busqueda['estado']){
            $aes_activo=Autoestudio::findFirstByaes_id($respuesta_modelo_busqueda['aes_id']);
            $respuesta_modelo_cancelar_aes= $aes_activo->CancelarAES();
            $answer['estado']=true;
            $answer['titular']='ok';
            $answer['mensaje_extra']=$respuesta_modelo_cancelar_aes['mensaje'];


        }else{
            $answer['estado']=false;
            $answer['titular']='no hay registros asociados a este ese';
            $answer['titular']='no hay registros asociados a este ese';
            $answer['mensaje_extra']='';

        }


        return $answer;



    }

    public function ReActiviarAutoestudioParaContestar($ese_id,$es_cancelado=0){
        $aes=new Autoestudio();

        if($es_cancelado){
            $respuesta_modelo_busqueda= $aes->BuscarRegistroCanceladoByese_id($ese_id);

        }else{
            $respuesta_modelo_busqueda= $aes->BuscarRegistroActivoByese_id($ese_id);

        }

        if($respuesta_modelo_busqueda['estado']){

            $aes_activo=Autoestudio::findFirstByaes_id($respuesta_modelo_busqueda['aes_id']);
            $respuesta_modelo_reactivar= $aes_activo->ReActivarContestado();


        }
       

    }


    public function ReActiviarAutoestudioEnviado($ese_id,$es_cancelado=0){

        $aes=new Autoestudio();

          if($es_cancelado){
            $respuesta_modelo_busqueda= $aes->BuscarRegistroCanceladoByese_id($ese_id);

        }else{
            $respuesta_modelo_busqueda= $aes->BuscarRegistroActivoByese_id($ese_id);

        }



        if($respuesta_modelo_busqueda['estado']){

            $aes_activo=Autoestudio::findFirstByaes_id($respuesta_modelo_busqueda['aes_id']);
            $respuesta_modelo_reactivar= $aes_activo->ReActivarEnviado();


        }
    }

    public function ValidarEstatusACambiarAutoEstudio($ese_id,$ese_estatus){

        if($ese_estatus==2 || $ese_estatus == 3){
            $this->ReActiviarAutoestudioParaContestar($ese_id,1);
        }
        if($ese_estatus==4 ||  $ese_estatus == 5){
            $this->ReActiviarAutoestudioEnviado($ese_id,1);


        }

    }

    public function GetDatosInvAnaEse($ese_id=0){
        $answer=[];
        $ese_data=Estudio::query()
        ->columns('ese_id, ese_nombre, ese_primerapellido, ese_segundoapellido, emp_id, est_id, mun_id, cne_id, ese_centrocosto, tip_id, ese_tippersona,cen_id')
        ->where('ese_id='.$ese_id)
        ->leftjoin('Empresa','emp.emp_id=Estudio.emp_id','emp')
        ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
        ->join('Estado','est.est_id=Estudio.est_id','est')
        ->leftjoin('Municipio','mun.mun_id=Estudio.mun_id','mun')
        ->leftjoin('Centrocosto','cen.cen_id=Estudio.cen_id','cen')
        ->join('Tipoestudio','tip.tip_id=Estudio.tip_id','tip')
        ->limit(1)
        ->execute();

        if(count($ese_data)>0){
            $answer['estado']=true;
            $answer['data']=$ese_data;


        }else{
            $answer['estado']=false;

        }

        return $answer;


    }
   

    public function desAsignarAnalistaEstablecido(){
        $anterior_analista= $this->ana_id;
        $this->ana_id=null;
        $this->ese_fechaasiganalista=null;
        if( $this->update())
         return   $respuesta=['estado'=>true,'ese_id'=>$this->ese_id,'ana_id_anterior'=> $anterior_analista];
        else
         return $respuesta=['estado'=>false];
    }

    public function actualizarHonorario($data){
        $ese_honorario_anterior= $this->ese_honorario;
        $this->ese_honorario=$data['ese_honorario'];

        if( $this->update())
         return   $respuesta=['estado'=>true,
         'ese_id'=>$this->ese_id,
         'honorario_actual'=>$this->ese_honorario,
         'honorario_anterior'=>$ese_honorario_anterior,

        ];
        else
         return $respuesta=['estado'=>false];
    }
    public function getTipoPersona($valor)
    {
        $valor = (int)$valor; 
    
        switch ($valor) {
            case 1:
                $answer = "FISICA";
                break;
            case 2:
                $answer = "MORAL";
                break;
            default:
                $answer = "";
        }
    
        return $answer;
    }

    public function setAsignarInvestigador($auth, $data) {
        $response = [
            'estatus' => -2,
            'mensaje' => 'error',
            'mensaje_correo' => '',
            'titular' => 'error'
        ];
        $fecha_y_hora = date("Y-m-d H:i:s");
        $ese_id_utilizando = $data['ese_id'];
        $registro = Estudio::findFirstByese_id($data['ese_id']);
    
        if ($registro->ese_estatus != 1) {
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = "intentó asignar uno ya asignado ";
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = $registro->ese_id;
            $databit['bit_modulo'] = "ASIGNAR INVESTIGADOR";
            $databit['ese_id'] = $registro->ese_id;
            $bitacora->NuevoRegistro($databit);
    
            $response['estatus'] = -1;
            $response['titular'] = 'AVISO';
            $response['mensaje'] = 'No se puede realizar la acción solicitada, el estudio previamente fue cambiado, recargue la página para actualizar información #estado' . $registro->ese_estatus . ' ESE ID ' . $registro->ese_id;
            $response['id'] = $registro->ese_id;
            return $response;
        }
    
        $registro->inv_id = $data['inv_id'];
        $registro->ese_estatus = 2;
        $registro->ese_fechaasiginvestigador = $fecha_y_hora;
    
        if ($data['ese_transporte_estatus_val'] == 2) {
            $usuarioinvestigador = Usuario::findFirstByusu_id($data['inv_id']);
            if ($usuarioinvestigador->usu_transporte != 1) { //si el investigador no tiene permisos para que se le asigne transporte
                $response['estatus'] = -1;
                $response['titular'] = 'ERROR';
                $response['mensaje'] = 'El investigador no tiene permisos para que se le asigne transporte.';
                $response['id'] = $registro->ese_id;
                return $response;
            }
    
            $rol = Rol::findFirstByrol_id($auth['rol_id']);
            if ($data['tra_preaprobado'] > $rol->rol_traaprobar) {
                $response['estatus'] = -1;
                $response['titular'] = 'ERROR';
                $response['mensaje'] = 'El monto pre-aprobado supera al permitido para tu rol.';
                $response['id'] = $registro->ese_id;
                return $response;
            }
    
            $registro->ese_transporte = 2;
            $trasporte = new Transporte();
            $trasporte->tra_preaprobado = $data['tra_preaprobado'];
            $trasporte->ese_id = $ese_id_utilizando;
            $trasporte->investigadorusu_id = $data['inv_id'];
            $trasporte->asignausu_id = $auth['id'];
            $trasporte->tra_estatus = 1;
            $trasporte->tra_comentarioadmin = $data['tra_comentario_admin'];
    
            if ($trasporte->save()) {
                $bitacora = new Bitacora();
                $databit['bit_descripcion'] = 'Agregó transporte con la cantidad $' . $data['tra_preaprobado'] . ' preaprobado al estudio con ID interno ' . $registro->ese_id;
                $databit['usu_id'] = $auth['id'];
                $databit['bit_tablaid'] = $trasporte->tra_id;
                $databit['bit_modulo'] = "Transporte";
                $databit['ese_id'] = $registro->ese_id;
                $bitacora->NuevoRegistro($databit);
    
                $comentario = new Comentarioese();
                $comentario->com_comentario = $databit['bit_descripcion'];
                $comentario->com_estatus = 2;
                $comentario->usu_id = $auth['id'];
                $comentario->ese_id = $registro->ese_id;
                $comentario->ese_estatus = 1;
                $comentario->save();
            }
        } else {
            $registro->ese_transporte = 1;
        }
    
        if ($registro->save()) {
            $usuario = Usuario::findFirstByusu_id($data['inv_id']);
            $nombre = $usuario->usu_nombre . " " . $usuario->usu_primerapellido . " " . $usuario->usu_segundoapellido;
            $bitacora = new Bitacora();
            $databit['bit_descripcion'] = "Asignó investigador: " . $nombre . " al estudio con folio interno: " . $registro->ese_id;
            $databit['usu_id'] = $auth['id'];
            $databit['bit_tablaid'] = $registro->ese_id;
            $databit['bit_modulo'] = "Asignar investigador";
            $databit['ese_id'] = $registro->ese_id;
            $bitacora->NuevoRegistro($databit);
    
            $comentario = new Comentarioese();
            $comentario->com_comentario = $databit['bit_descripcion'];
            $comentario->com_estatus = 2;
            $comentario->usu_id = $auth['id'];
            $comentario->ese_id = $registro->ese_id;
            $comentario->ese_estatus = 1;
            $comentario->save();
    
            $response['mensaje'] = 'Investigador asignado correctamente';
            if ($registro->tip_id == 1 || $registro->tip_id == 3 || $registro->tip_id == 5) {
                $configuracion_obj=new Configuracion();
                $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();

                if($enviar_correo_estatus==1){      

                    $correo = new ServicioCorreo();
                    $mensaje = $correo->notificaasiginves;
                    $mensaje = str_replace("#id#", trim($registro->ese_id), $mensaje);
                    $mensaje = str_replace("#nombre#", trim(implode(" ", array($registro->ese_nombre, $registro->ese_primerapellido, $registro->ese_segundoapellido))), $mensaje);
        
                    $empresamodel = new Empresa();
                    $mensaje = str_replace("#empresa#", $empresamodel->getAlias($registro->emp_id), $mensaje);
                    $estadomodel = new Estado();
                    $mensaje = str_replace("#estado#", $estadomodel->getNombre($registro->est_id), $mensaje);
                    $municipiomodel = new Municipio();
                    $mensaje = str_replace("#municipio#", $municipiomodel->getNombre($registro->mun_id), $mensaje);
                    $mensaje = str_replace("#colonia#", trim($registro->ese_colonia), $mensaje);
                    $mensaje = str_replace("#calle#", trim($registro->ese_calle), $mensaje);
                    $mensaje = str_replace("#numero#", trim($registro->ese_numext), $mensaje);
                    $mensaje = str_replace("#telefono#", trim($registro->ese_telefono), $mensaje);
                    $mensaje = str_replace("#celular#", trim($registro->ese_celular), $mensaje);
        
                    $envio = $correo->notificarasignacioninv($nombre, $usuario->usu_correo, $mensaje);
                    if ($envio == 1) {
                    $response['mensaje'] = 'Investigador asignado y correo de notificación entregado exitosamente.';
                    $response['mensaje_correo'] = 'Correo de notificación entregado exitosamente.';

                    } else {
                        $response['mensaje'] = 'Investigador asignado correctamente. Error al entregar correo de notificación.';
                        $response['mensaje_correo'] = 'Error al entregar correo de notificación.';

                    }
                }else{
                    $response['mensaje']='Investigador asignado correctamente. El envío de correos esta desactivado. Comuníquese con un administrador.';
                    $response['mensaje_correo'] = 'El envío de correos esta desactivado. Comuníquese con un administrador.';

                }
            }
            $response['titular'] = 'Éxito';
            $response['estatus'] = 2;
            $response['id'] = $registro->ese_id;
        } else {
            $response['estatus'] = -2;
        
        }
    
        return $response;
    }
    
    
}