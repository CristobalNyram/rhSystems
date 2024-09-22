<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;
use Phalcon\Di;

/**
 * Modelo de la tabla puesto
 */
class Soporte extends Model
{
    public function GenerarEncuesta($enc_id) // recibe el id de la encuesta que no será contestada
    {
        $encuesta=Encuesta::findFirstByenc_id($enc_id);
        $estudioc=Estudio::findFirstByese_id($encuesta->ese_id);

        $month_start = new datetime($encuesta->enc_fechaentregacliente); 
        $month_start->modify('first day of this month');
        $ini= $month_start->format('Y-m-d');

        $month_end = new datetime($encuesta->enc_fechaentregacliente); 
        $month_end->modify('last day of this month');
        $fin= $month_end->format('Y-m-d');

        $container = Di::getDefault();
        $query     = new Query(
            'select ese_id, ese_fechaentregacliente from Estudio where ese_fechaentregacliente>="'.$ini.' 00:00:00" and ese_fechaentregacliente<="'.$fin.' 23:59:59" and (tip_id=1 or tip_id=5) and ese_encuesta=0 and ese_estatus=7 and emp_id<>168 and inv_id='.$estudioc->inv_id.' order by rand() limit 1',
            $container
        );
        $invoices = $query->execute();

        if(count($invoices)>0){
            $estudio=Estudio::findFirstByese_id($invoices[0]->ese_id);
            $estudio->ese_encuesta=1;
            $estudio->save();

            $encuesta= new Encuesta();
            $encuesta->enc_estatus= 2;
            $encuesta->enc_version=$encuesta->enc_version_activa;
            $encuesta->ese_id= $invoices[0]->ese_id;
            $encuesta->enc_fechaentregacliente= $invoices[0]->ese_fechaentregacliente;
            $encuesta->save();

            return "Sustituido por el estudio: ".$invoices[0]->ese_id;
        }
        return 'No se encontró estudio para sustituir.';

    }

    public function honorario_pagos_eseAction(){

        try {
            $this->db->begin();
    
      
            $this->db->commit();
 
            $this->db->rollback();
        } catch (\Throwable $th) {
             echo $th;
            die();
        }

            
    }

}