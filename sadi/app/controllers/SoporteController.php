<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Query;
use Phalcon\Di;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

require "mpdf/index.php";

class SoporteController extends ControllerBase
{
    public $enc_version_generar="2024_enero";
    
    public function initialize()
    {
        $this->tag->setTitle('Soporte');
        parent::initialize();
    }

    private function __getTipoSesionRedireccionarCerrarSesion(){


        $auth = $this->session->get('auth');

        if(array_key_exists('autoestudio',$auth)){

          return  $this->url->get('autoestudio/index');
        }else{
          return  $this->url->get('');

        }
    }

    public function verificasesionAction()
    {
        
        $this->view->disable();
        $answer=array();
        $auth = $this->session->get('auth');
        // $answer['url_actual']=$this->request->getURI();

        if($auth){
            $answer['estado']=1;

        }else{
            $answer['estado']=0;

        }
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

    public function generarencuestaAction(){
        $this->view->disable();
        $ini='2024-03-01';
        $fin='2024-03-31';
        $enc_obj=new Encuesta();
        $contador=new Builder();
	        $contador=$contador
	        ->columns(array('COUNT(inv_id) AS contador, inv_id'))
	        ->addFrom('Estudio','e')
	        ->where('ese_fechaentregacliente>="'.$ini.' 00:00:00" and ese_fechaentregacliente<="'.$fin.' 23:59:59" and (tip_id=1 or tip_id=5) and ese_estatus=7 and inv_id<>172 and emp_id<>168')
	        ->groupBy('inv_id')
	        ->getQuery()
	        ->execute();

        $suma=0;
        
        for($i=0; $i<count($contador); $i++){
            $limit=0;
            // $result = [];
            if ($contador[$i]->contador < 0) {
                $limit=0;
            }
            else if ($contador[$i]->contador>0 && $contador[$i]->contador <= 3){
                $limit=1;
            }
            else if ($contador[$i]->contador>=4 && $contador[$i]->contador <= 6) {
                $limit=2;
            }
            else if ($contador[$i]->contador>=7 && $contador[$i]->contador <= 9) {
                $limit=3;
            }
            else if($contador[$i]->contador>=10){
                $limit=5;
            }

            $container = Di::getDefault();
            $query     = new Query(
                'select ese_id, ese_fechaentregacliente from Estudio where ese_fechaentregacliente>="'.$ini.' 00:00:00" and ese_fechaentregacliente<="'.$fin.' 23:59:59" and (tip_id=1 or tip_id=5) and ese_estatus=7 and emp_id<>168 and inv_id='.$contador[$i]->inv_id.' order by rand() limit '.$limit,
                $container
            );
            $invoices = $query->execute();

            for($j=0; $j<count($invoices); $j++){
                $estudio=Estudio::findFirstByese_id($invoices[$j]->ese_id);
                $estudio->ese_encuesta= 1;
                $estudio->save();
                
                $encuesta= new Encuesta();
                $encuesta->enc_estatus= 2;
                $encuesta->ese_id= $invoices[$j]->ese_id;
                $encuesta->enc_fechaentregacliente= $invoices[$j]->ese_fechaentregacliente;
                $encuesta->enc_version=$enc_obj->enc_version_activa;
                $encuesta->save();

            }
        }
        return ;
    }

    public function transporte_indexAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(83,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }        
    }

    public function transporte_tablaAction(){

        // $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Buscó datos para asignar transporte.';

        $auth = $this->session->get('auth');
        if(!$rol->verificar(83,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $mensaje='';
        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $condicion='ese_estatus>0';
            $descripcion_bitacora="Para la búsqueda se agregaron las siguientes condiciones";

            if($data['ese_id'] != '')
            {
                // $datetime = new DateTime($data['ese_fechainicial']);
                $descripcion_bitacora.=', id de estudio: '. $data['ese_id'];
                $condicion.=" and ese_id = ".$data['ese_id'];
            }else{
                $registros=[];
                $this->view->mensaje="Debe colocar el id del estudio a buscar.";
                $this->view->page=$registros;
                return;
            }

            $registros=Estudio::query()
            ->columns("concat_ws(' ', inv.usu_nombre, inv.usu_primerapellido, inv.usu_segundoapellido) as investigador, DATE_FORMAT(ese_fechaentregacliente,'%Y-%m-%d') as ese_fechaentregacliente, ese_estatus, ese_id, inv_id")
            ->where($condicion)
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->execute();

            if(count($registros)<=0){
                $registros=[];
                $this->view->mensaje="No se encontró el registro del ID proporcionado.";
                $this->view->page=$registros;
                return;
            }

            if($registros[0]->ese_estatus!=7){
                $registros=[];
                $this->view->mensaje="No se puede asignar al estudio porque aún no ha sido entregado.";
                $this->view->page=$registros;
                return;
            }
            
            $date= new DateTime();
            $hoy=$date->format('Y-m-d');

            $dia_semana = date('w', strtotime($hoy));
            switch($dia_semana){
                case 0:
                    $resta= 6;
                    break;
                case 1:
                    $resta= 7;
                    break;
                case 2:
                    $resta= 8;
                    break;
                case 3:
                    $resta= 9;
                    break;
                case 4:
                    $resta= 3;
                    break;
                case 5:
                    $resta= 4;
                    break;
                case 6:
                    $resta= 5;
                    break;
            }    
            $fecha = $this->resDias($hoy,$resta);

            $fecha_actual = strtotime($fecha);
            $fecha_entrada = strtotime($registros[0]->ese_fechaentregacliente);

            if($fecha_entrada >= $fecha_actual)
            {
                $mensaje='';
            }else{
                $registros=[];
                $mensaje='El ID proporcionado ya no esta en fecha de asignación posible.';
            }

            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Asignar transporte (Soporte)";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
        }
        $this->view->mensaje=$mensaje;
        $this->view->page=$registros;
    }

    public function correopruebaAction(){
        $configuracion_obj=new Configuracion();
        $enviar_correo_estatus=$configuracion_obj->getEstatusEnvioCorreosSistema();
        if($enviar_correo_estatus==1){
            $correo= new ServicioCorreo();
            $correo->enviarprueba("jesus@sips.mx","prueba","prueba");
        }
      
    }
    public function limpiarcachevoltAction(){


        $auth = $this->session->get('auth');
        if(!$rol->verificar(83,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }
        $this->setCacheLimipia();
        ///bitacora inicio
           $auth = $this->session->get('auth');
           $bitacora= new Bitacora();
           $databit['bit_descripcion']= 'Limpio cache de todo el sistema';
           $databit['usu_id']=$auth['id'];
           $databit['bit_tablaid']=0;
           $databit['bit_modulo']="Limpiar cache (Soporte)";
           $bitacora->NuevoRegistro($databit);
        //bitacora fin
    }
    
    public function honorario_pagos_eseAction()
    {
        try {
            $this->db->begin(); // Inicia una transacción de base de datos
            $errorFlag = false; // Bandera para indicar si se produjo algún error
    
            $eseData = Estudio::query()
                ->where('ese_estatus >= 4 AND ese_honorario IS NULL')
                ->execute();
    
            if (empty($eseData)) {
                echo "No se encontraron estudios que cumplan con los criterios.";
                die(); // Detiene la ejecución del código
            }
    
            foreach ($eseData as $eseItem) {
                $ese = Estudio::findFirstByese_id($eseItem->ese_id);
    
                if (!$ese) {
                    $this->db->rollback(); // Revierte la transacción
                    echo "No se encontró el estudio con ese_id: " . $eseItem->ese_id;
                    die(); // Detiene la ejecución del código
                }
    
                $usuarioTipoEstData = Usuariotipoest::query()
                    ->where('usu_id = :usu_id: AND tip_id = :tip_id: AND ute_estatus = 2')
                    ->limit(1)
                    ->bind([
                        'usu_id' => $ese->inv_id,
                        'tip_id' => $ese->tip_id
                    ])
                    ->execute();
    
                if (count($usuarioTipoEstData) > 0) {
                    $ese->ese_honorario = $usuarioTipoEstData[0]->ute_honorario;
                    if (!$ese->save()) {
                        $errorFlag = true; // Se produjo un error al guardar el estudio
                    }
                } else {
                    $this->db->rollback(); // Revierte la transacción
                    $errorMessage = "No se encontró un honorario para el estudio con ese_id: " . $eseItem->ese_id . ", inv_id: " . $ese->inv_id . " con tip_id " . $ese->tip_id;
                    echo $errorMessage;
                    die(); // Detiene la ejecución del código
                }
            }
    
            if (!$errorFlag) {
                $this->db->commit(); // Confirma la transacción
                $this->flash->success("Actualización exitosa");
                $this->view->disable();
                return;
            } else {
                $this->db->rollback(); // Revierte la transacción
                $this->flash->error('Ocurrió un error al editar el registro');
            }
        } catch (\Throwable $th) {
            $this->db->rollback(); // Revierte la transacción
            echo "Error al actualizar: " . $th->getMessage();
            die(); // Detiene la ejecución del código
        }
    }

     public function estudio_indexAction(){
        $rol = new Rol();
        $auth = $this->session->get('auth');
        if(!$rol->verificar(88,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }        
    }

    public function estudio_tablaAction(){
        
        // $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $rol = new Rol();
        $datos=[];
        $condicion='';
        $descripcion_bitacora='Buscó datos para asignar transporte.';

        $auth = $this->session->get('auth');
        if(!$rol->verificar(88,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        {
            $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
            $this->response->redirect('index/panel');
            $this->view->disable();
            return;
        }

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $mensaje='';
        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            $condicion='ese_estatus>0';
            $descripcion_bitacora="Para la búsqueda se agregaron las siguientes condiciones";

            if($data['ese_id'] != '')
            {
                // $datetime = new DateTime($data['ese_fechainicial']);
                $descripcion_bitacora.=', id de estudio: '. $data['ese_id'];
                $condicion.=" AND  ese_id = ".$data['ese_id']." AND ese_honorario IS NOT NULL ";
            }else{
                $registros=[];
                $this->view->mensaje="Debe colocar el id del estudio a buscar.";
                $this->view->page=$registros;
                return;
            }

            $registros=Estudio::query()
            ->columns("concat_ws(' ', inv.usu_nombre, inv.usu_primerapellido, inv.usu_segundoapellido) as investigador, DATE_FORMAT(ese_fechaentregacliente,'%Y-%m-%d') as ese_fechaentregacliente, ese_estatus, ese_id, inv_id")
            ->where($condicion)
            ->leftjoin('Usuario','inv.usu_id=Estudio.inv_id','inv')
            ->execute();

            if(count($registros)<=0){
                $registros=[];
                $this->view->mensaje="No se encontró el registro del ID proporcionado.";
                $this->view->page=$registros;
                return;
            }



           


            if($registros[0]->ese_fechaentregacliente!=null){//si existe fecha de eentrega entonces aplicamos una validacion
                // Creamos una instancia de la clase DateTime para obtener la fecha y hora actual
                $date = new DateTime();

                // Obtenemos la fecha actual en el formato 'Y-m-d' (Año-mes-día)
                $hoy = $date->format('Y-m-d');

                // Obtenemos el día de la semana de la fecha actual (0: domingo, 1: lunes, ..., 6: sábado)
                $dia_semana = date('w', strtotime($hoy));

                // Asignamos un valor a la variable $resta según el día de la semana
                switch ($dia_semana) {
                    case 0:
                        $resta = 6;
                        break;
                    case 1:
                        $resta = 7;
                        break;
                    case 2:
                        $resta = 8;
                        break;
                    case 3:
                        $resta = 9;
                        break;
                    case 4:
                        $resta = 3;
                        break;
                    case 5:
                        $resta = 4;
                        break;
                    case 6:
                        $resta = 5;
                        break;
                }

                // Llamamos a la función resDias() pasando la fecha actual ($hoy) y $resta como argumentos
                $fecha = $this->resDias($hoy, $resta);

                // Convertimos la fecha devuelta por resDias() en un formato de tiempo Unix
                $fecha_actual = strtotime($fecha);

                // Supongamos que la fecha de entrega del primer elemento en el array $registros es '2023-06-10'
                $fecha_entrada = strtotime($registros[0]->ese_fechaentregacliente);


                if($fecha_entrada >= $fecha_actual)
                {
                    $mensaje='';
                }else{
                    $registros=[];
                    $mensaje='El ID proporcionado ya no esta en fecha de asignación posible.';
                }
            }



            ///bitacora inicio
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= $descripcion_bitacora;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=0;
            $databit['bit_modulo']="Editar Honorario (Soporte)";
            $bitacora->NuevoRegistro($databit);
            //bitacora fin
        }
        $this->view->mensaje=$mensaje;
        $this->view->page=$registros;
    }

    
    public function set_update_gruid_cal_idAction()
    {
        $this->view->disable();

        $condicion = "";
    
        #grupo 1 =gru_id
        #tip_id=1,2,3,4,5,6,7,8
        #$tif_id_gru_id_1 = [1, 2, 3, 4, 5, 6, 7, 8];

        $tif_id_gru_id_1 = [1, 3, 5, 6, 7, 8];
        $gru_id_1 = 1;
        $cal_tip_id_gru_id_1 = [9, 10, 11];
    
        #grupo 2 =gru_id
        #tip_id=9,10,11
        $tif_id_gru_id_2 = [9, 10, 11];
        $gru_id_2 = 2;
    
        $contador_de_registros = 0;
        $contador_de_registros_daf = 0;
    
        // Iniciar una transacción
        $this->db->begin();
    
        try {
            # BUSCAR TODOS LOS ESTUDIOS
            $registros = Estudio::query()->execute();
            $total_registros = count($registros);
    
            // Recorrer los registros
            for ($i = 0; $i < $total_registros; $i++) {
                $registro = $registros[$i];
                $actualizo_ese = 0;
    
                if (in_array($registro->tif_id, $tif_id_gru_id_1)) {
                    $registro->gru_id = $gru_id_1;
                    $actualizo_ese = 1;
                } elseif (in_array($registro->tif_id, $tif_id_gru_id_2)) {
                    $registro->gru_id = $gru_id_2;
                    $actualizo_ese = 1;
                }
    
                if ($registro->update()) {
                    if ($actualizo_ese) {
                        $contador_de_registros++;
                    }
    
                    $registros_daf = Datofinal::find([
                        "conditions" => "ese_id = :ese_id:",
                        "bind" => [
                            "ese_id" => $registro->ese_id
                        ]
                    ]);
    
                    if (count($registros_daf) > 0) {
                        foreach ($registros_daf as $registro_daf) {
                            $actualizo_daf = 0;
    
                            if ($registro->gru_id == 1) {
                                switch ($registro_daf->daf_calificacion) {
                                    case '1':
                                        $registro_daf->cal_id = 1;
                                        break;
                                    case '2':
                                        $registro_daf->cal_id = 2;
                                        break;
                                    case '3':
                                        $registro_daf->cal_id = 3;
                                        break;
                                    case '4':
                                        $registro_daf->cal_id = 4;
                                        break;
                                    default:
                                        $registro_daf->cal_id = -1;
                                         break;
                                }
                                $actualizo_daf = 1;
                            } elseif ($registro->gru_id == 2) {
                                switch ($registro_daf->daf_calificacion) {
                                    case '1':
                                        $registro_daf->cal_id = 5;
                                        break;
                                    case '2':
                                        $registro_daf->cal_id = 6;
                                        break;
                                    case '3':
                                        $registro_daf->cal_id = 7;
                                        break;
                                    case '4':
                                        $registro_daf->cal_id = 8;
                                        break;
                                    default:
                                            $registro_daf->cal_id = -1;
                                        break;
                                }
                                $actualizo_daf = 1;
                            }
    
                            // Actualizar el registro de datos finales y contar
                            if ($registro_daf->update()) {
                                if ($actualizo_daf) {
                                    $contador_de_registros_daf++;
                                }
                            } else {
                                throw new Exception("Error en la actualizacion del daf " . $registro_daf->daf_id, 1);
                            }
                        }
                    }
                } else {
                    throw new Exception("Error en la actualizacion del ese " . $registro->ese_id, 1);
                }
            }
    
            // Confirmar los cambios si todo está bien
            $this->db->commit();
    
            // Aquí tienes el total de registros actualizados
            echo "Total de registros actualizados de tif gruid ese  : " . $contador_de_registros . " y un total de dafs " . $contador_de_registros_daf;
            error_log("Total de registros actualizados de tif gruid ese  : " . $contador_de_registros . " y un total de dafs " . $contador_de_registros_daf);
    
            # OBTENER EL TIPO DE ESTUDIO
        } catch (\Exception $e) {
            $this->db->rollback();
            echo "Error al actualizar los registros: " . $e->getMessage();
            error_log("ERROR EN ".$e->getMessage());
            die();
        }
    }
    
    
    

    
}