<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla  configuracion*/
class Configuracion extends Model
{

    public $con_id;
    public $con_nombre;
    public $con_texto;
    public $con_fechaini;
    public $con_fechafin;
    public $con_estatus;
    public $solicitar_datos_participante=1;
    public $campos_a_solicitar_folio=['fol_nombre', 'fol_primerapellido', 'fol_segundoapellido','fol_area',  'emp_id'];
    public $campos_a_solicitar_folio_a_guardar=['fol_nombre', 'fol_primerapellido', 'fol_segundoapellido', 'fol_correo', 'fol_area', 'fol_puesto', 'emp_id'];

    public function estatusConfiguracionFechaLimite()
    {
            return $estatusConfiguracionFechaLimite= Configuracion::findFirstBycon_id(1);   
    }
   

    public function validacionFechaDeContestarCuestionarios()
    {   
        $fechaDeHoy=new DateTime(date('Y-m-d'));
        $estatus= Configuracion::findFirstBycon_id(1); 
        $fechaFinDeCuestionario = new DateTime($estatus->con_fechafin);
        $fechaFinDeCuestionario->setTime(23, 59, 59); // Establecer la hora a 23:59:59
        
        $fechaIncioDeCuesionario = new DateTime($estatus->con_fechaini);
        if($fechaDeHoy>$fechaIncioDeCuesionario && $fechaDeHoy<$fechaFinDeCuestionario)
        {
            return true; 
        }
        {
            return false;

        }

     
 
    }

    public function estatusConfiguracionAnuncio($idConfiguracion)
    {
         $estatusConfiguracionAnuncio= Configuracion::findFirstBycon_id($idConfiguracion);  
         return $estatusConfiguracion=[
                                            'con_nombre'=>$estatusConfiguracionAnuncio->con_nombre,
                                            'con_texto'=>nl2br($estatusConfiguracionAnuncio->con_texto),
                                            'con_id'=>nl2br($estatusConfiguracionAnuncio->con_id),

                                            'con_texto_edit'=>$estatusConfiguracionAnuncio->con_texto,
         ];
    }
    public function actualizarConfiguracionAnuncio($con_nombre_edit,$idConfiguracion)
    {
         $ConfiguracionAnuncio= Configuracion::findFirstBycon_id($idConfiguracion);//aqui tiene el ID dos por que corresponde a el registro numero dos
         $ConfiguracionAnuncio->con_texto=$con_nombre_edit;
         if($ConfiguracionAnuncio->save()) 
         {
             return   '1';
                
         }
      
                
    }

    public function  getCamposASolicitar(){

        return $this->campos_a_solicitar_folio;
    }
    public function getCamposAGuardarParticipante(){
        
        return $this->campos_a_solicitar_folio_a_guardar;

    }
}