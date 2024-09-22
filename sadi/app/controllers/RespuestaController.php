<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use \Phalcon\Config\Adapter\Ini as ConfigIni;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class RespuestaController extends ControllerBase
{

    public function guardar_calidadservicioAction($enc_id=0){

        $answers=[];
        $this->view->disable();
        if($this->request->isAjax() && $enc_id!=0){
            $data = $this->request->getPost();



            $auth = $this->session->get('auth');

            $enc=Encuesta::findFirstByenc_id($enc_id);
            $enc->setContestado($auth['id']);

            
            //preg 1
            $res_1=new Respuesta();
            $res_1->res_estatus=2;

            $res_1->pre_id=1;
            $res_1->opc_id=$data['opcion_preg_1_servicio_calida'];
            $res_1->enc_id=$enc_id;
            $res_1->save();

             //preg 2
             $res_2=new Respuesta();
             $res_2->res_estatus=2;

             $res_2->pre_id=2;
             $res_2->opc_id=$data['opcion_preg_2_servicio_calida'];
             $res_2->enc_id=$enc_id;
             $res_2->save();

              //preg 3
             $res_3=new Respuesta();
             $res_3->res_estatus=2;

             $res_3->pre_id=3;
             $res_3->opc_id=$data['opcion_preg_3_servicio_calida'];
             $res_3->enc_id=$enc_id;
             $res_3->save();


            //preg 4
            $res_4=new Respuesta();
            $res_4->res_estatus=2;

             $res_4->pre_id=4;
             $res_4->opc_id=$data['opcion_preg_4_servicio_calida'];
             $res_4->enc_id=$enc_id;
             $res_4->save();

             //preg 5
             $res_5=new Respuesta();
             $res_5->res_estatus=2;

             $res_5->pre_id=5;
             $res_5->opc_id=$data['opcion_preg_5_servicio_calida'];
             $res_5->enc_id=$enc_id;
             $res_5->save();


            //preg 6
             $res_6=new Respuesta();
             $res_6->res_estatus=2;

             $res_6->pre_id=6;
             $res_6->opc_id=$data['opcion_preg_6_servicio_calida'];
             $res_6->enc_id=$enc_id;
             $res_6->save();

        

            //preg 7
            $res_7=new Respuesta();
            $res_7->res_estatus=2;

            $res_7->pre_id=7;
            $res_7->opc_id=$data['opcion_preg_7_servicio_calida'];
            $res_7->enc_id=$enc_id;
            $res_7->save();

            //preg 7.1
            $res_7_1=new Respuesta();
            $res_7_1->res_estatus=2;

            $res_7_1->pre_id=8;
            $res_7_1->res_texto=$data['comentario_preg_7_1_servicio_calida'];
            $res_7_1->opc_id=0;
            $res_7_1->enc_id=$enc_id;
            $res_7_1->save();

            //preg 8
            $res_8=new Respuesta();
            $res_8->res_estatus=2;

            $res_8->pre_id=9;
            $res_8->opc_id=$data['opcion_preg_8_servicio_calida'];
            $res_8->enc_id=$enc_id;
            $res_8->save();

            //preg 8.1
            $res_8_1=new Respuesta();
            $res_8_1->res_estatus=2;

            $res_8_1->pre_id=10;
            $res_8_1->res_texto=$data['comentario_preg_8_1_servicio_calida'];
            $res_8_1->opc_id=0;
            $res_8_1->enc_id=$enc_id;
            $res_8_1->save();


            //preg 9
            $res_9=new Respuesta();
            $res_9->res_estatus=2;

            $res_9->pre_id=11;
            $res_9->opc_id=$data['opcion_preg_9_servicio_calida'];
            $res_9->enc_id=$enc_id;
            $res_9->save();
           
            //preg 10
            $res_10=new Respuesta();
            $res_10->res_estatus=2;

            $res_10->pre_id=12;
            $res_10->opc_id=$data['opcion_preg_10_servicio_calida'];
            $res_10->enc_id=$enc_id;
            $res_10->save();


            //preg 11
            $res_11=new Respuesta();
            $res_11->res_estatus=2;

            $res_11->pre_id=13;
            $res_11->opc_id=$data['opcion_preg_11_servicio_calida'];
            $res_11->enc_id=$enc_id;
            $res_11->save();

              //preg 12

              $res_12=new Respuesta();
              $res_12->res_estatus=2;

              $res_12->pre_id=14;
              $res_12->opc_id=$data['opcion_preg_12_servicio_calida'];
              $res_12->enc_id=$enc_id;
              $res_12->save();
         
            //preg 12


            //12.1
                $res_12_1=new Respuesta();
                $res_12_1->res_estatus=2;

                $res_12_1->pre_id=15;
                $res_12_1->res_texto=$data['comentario_preg_12_1_servicio_calida'];
                $res_12_1->opc_id=0;
                $res_12_1->enc_id=$enc_id;
                $res_12_1->save();

             //preg 13
             $res_13=new Respuesta();
             $res_13->res_estatus=2;

             $res_13->pre_id=16;
             $res_13->opc_id=$data['opcion_preg_13_servicio_calida'];
             $res_13->enc_id=$enc_id;
             $res_13->save();

               //preg 14
               $res_14=new Respuesta();
               $res_14->res_estatus=2;

               $res_14->pre_id=17;
               $res_14->opc_id=$data['opcion_preg_14_servicio_calida'];
               $res_14->enc_id=$enc_id;
               $res_14->save();

            //preg 15
               $res_15=new Respuesta();
               $res_15->res_estatus=2;

               $res_15->pre_id=18;
               $res_15->opc_id=$data['opcion_preg_15_servicio_calida'];
               $res_15->enc_id=$enc_id;
               $res_15->save();

             //preg 15.1
             $res_15_1=new Respuesta();

             $res_15_1->pre_id=19;
             $res_15_1->res_estatus=2;

             $res_15_1->res_texto=$data['comentario_preg_15_1_servicio_calida'];
             $res_15_1->opc_id=0;
             $res_15_1->enc_id=$enc_id;
             $res_15_1->save();
             

            //preg 16
               $res_16=new Respuesta();
               $res_16->pre_id=20;
               $res_16->res_estatus=2;

               $res_16->opc_id=$data['opcion_preg_16_servicio_calida'];
               $res_16->enc_id=$enc_id;
               $res_16->save();
            //preg 17
               $res_17=new Respuesta();
               $res_17->pre_id=21;
               $res_17->res_estatus=2;

               $res_17->opc_id=isset($data['opcion_preg_17_servicio_calida']) ? $data['opcion_preg_17_servicio_calida'] : 0;
               $res_17->enc_id=$enc_id;
               $res_17->save();

            //preg 17.1
             $res_17_1=new Respuesta();

             $res_17_1->pre_id=22;
             $res_17_1->res_estatus=2;

             $res_17_1->res_texto=$data['comentario_preg_17_1_servicio_calida'];
             $res_17_1->opc_id=0;
             $res_17_1->enc_id=$enc_id;
             $res_17_1->save(); 

            //preg 18
               $res_18=new Respuesta();

               $res_18->pre_id=23;
               $res_18->res_estatus=2;
               $res_18->opc_id=0;
               $res_18->res_texto=$data['comentario_preg_18_servicio_calida'];
               $res_18->enc_id=$enc_id;
               $res_18->save();


           

               $bitacora= new Bitacora();
               $databit['bit_descripcion']= 'Contestó una encuesta el candidato relacionado al ESE con ID interno '.$enc->ese_id;
               $databit['usu_id']=$auth['id'];
               $databit['bit_tablaid']=$enc->enc_id;
               $databit['ese_id']= $enc->ese_id;
               $databit['bit_modulo']="Encuesta";
               $bitacora->NuevoRegistro($databit);
          
               $answer['estado']=2;
               $answer['titular']='Éxito';
               $answer['mensaje']='Se realizó el envio de la encuesta correctamente';
               $this->response->setJsonContent($answer);
               $this->response->send(); 
               return;

            $this->response->setJsonContent($data);
            $this->response->send(); 
            return;


        }else{
            return http_response_code(400);

        }

    }
}
