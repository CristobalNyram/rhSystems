<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Datofinal extends Model
{
    private $obj_calificacion_final;
    
    function onConstruct()
    {
     $this->obj_calificacion_final=new Calificacionfinal();
    }

    public function GuardarInformacion($data,$usu_id){
        $subs = Datofinal::find(array(
                'ese_id='.$data['ese_id'],
                'daf_estatus=2'));
        if(count($subs)>0){
            $registro = Datofinal::findFirstBydaf_id($subs[0]->daf_id);
        }else{
            $registro = new Datofinal();
        }
        
        $registro->ese_id= $data['ese_id'];
        $registro->daf_estatus=2;
        $registro->daf_notafinal=trim($data['daf_notafinal']);
        $registro->cal_id=trim($data['cal_id']);
        $registro->daf_calificacion=$data['daf_calificacion'];

        if($registro->save())
        {
            return $registro->ese_id;
        }else{
            return 0;
        }
    }

    public function GuardarInformacionFormatoTruper($data,$usu_id){

          $subs = Datofinal::find(array(
            'ese_id='.$data['ese_id'],
            'daf_estatus=2'));
            if(count($subs)>0){
                $registro = Datofinal::findFirstBydaf_id($subs[0]->daf_id);
            }else{
                $registro = new Datofinal();
            }
            
            $registro->ese_id= $data['ese_id'];
            $registro->daf_estatus=2;
            $registro->daf_calificacion=trim($data['daf_calificacion']);
            $registro->cal_id=trim($data['cal_id']);
            if($registro->save())
            {
                return $registro->ese_id;
            }else{
                return 0;
            }
    }

    public function getCalificacion($cal_id){

        $obj_cal= $this->obj_calificacion_final;
        $cal_texto= $obj_cal->getCalificacionTexto($cal_id);
        return $cal_texto;
        // switch ($cal_id){
        //     case "1":
        //         return "APTO";
        //     case "2":
        //         return "NO APTO";
        //     case "3":
        //         return "APTO CON RESERVAS ";
        //     case "4":
        //         return "SIN CALIFICACIÓN";
        //     default:
        //         return "";
        // }
    }

    public function getCalificacionFormatosTruper($cal_id){
        $obj_cal= $this->obj_calificacion_final;
        $cal_texto= $obj_cal->getCalificacionTexto($cal_id);
        return $cal_texto;
        // switch ($cal_id){
        //     case "1":
        //         return "NO-RECOMENDABLE";
        //     case "2":
        //         return "RECOMENDABLE CON RESERVAS";
        //     case "3":
        //         return "RECOMENDABLE";
        //     case "4":
        //         return "SIN CALIFICACIÓN";
        //     default:
        //         return "";
        // }
    }

    /**
     * Obtener la calificación general según una calificación y un arreglo de datos de ESE.
     *
     * @param mixed $calificacion La calificación a evaluar.
     * @param array $ese_array_data El arreglo de datos de ESE.
     * @return string La calificación general obtenida.
     */
    public function getCalificacionGeneral($calificacion,$ese_array_data){
    
        if($calificacion=='' || $calificacion==null ||$calificacion<=0)
        return 'SIN REGISTRO';

        //   switch ($ese_array_data['tif_id']) {
        //     case '11':
        //     case '10':
        //     case '10':
        //     case '9':
        //         return $this->getCalificacionFormatosTruper($calificacion);
        //         break;

        //     case '1':
        //     case '5':
        //     case '6':
        //     case '7':
        //     case '8':
        //         break;
            
        //     default:
        //         return 'SIN REGISTRO';
        
        //         break;
        return $this->getCalificacion($calificacion);

    }

    public function getEstatusBanderaEse($calificacion){
        $obj_cal= $this->obj_calificacion_final;
        $cal_css= $obj_cal->getCalificacionStyle($calificacion);
        return $cal_css;
        // switch($calificacion)
        // {   
        //     case '':
        //     return "";
        //     break;

        //     case 1:
        //     return "badge-success";
        //     break;

        //     case 2:
        //     return "badge-danger";
        //     break;

        //     case 3:
        //     return "badge-warning";
        //     break;
            
        //     default:
        //     return '';

          
        // }
    }
    public function getEstatusBanderaTruper($calificacion){

        $obj_cal= $this->obj_calificacion_final;
        $cal_css= $obj_cal->getCalificacionStyle($calificacion);
        return $cal_css;
        // switch($calificacion)
        // {   
        //     case '':
        //     return "";
        //     break;

        //     case 1:
        //     return "badge-danger";
        //     break;

        //     case 2:
        //     return "badge-warning";
        //     break;

        //     case 3:
        //     return "badge-success";
        //     break;
            
        //     default:
        //     return '';
          
        // }
    }
    /**
     * Obtener el estatus de la bandera Truper según una calificación.
     *
     * @param mixed $calificacion La calificación a evaluar.
     * @return string La clase de CSS correspondiente al estatus de la bandera.
     */
    public function  getEstatusBanderaColorGeneral($calificacion,$ese_array_data)
    {

        

        switch ($ese_array_data['tif_id']) {
            case '11':
            case '10':
            case '10':
            case '9':
                return $this->getEstatusBanderaTruper($calificacion);
                break;
    
            case '1':
            case '5':
            case '6':
            case '7':
            case '8':
                return $this->getEstatusBanderaEse($calificacion);
                break;
            
            default:
                return '';
           
                break;
        }
    }

}