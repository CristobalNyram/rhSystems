<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;


/**
 * Modelo de la tabla automovil
 */
class Api extends Model
{
    public function BuscarCURP($id,$id_user)
    {
        $estudio=Estudio::findFirstByese_id($id);

        if($estudio->ese_apicurp!=0){
            $answer[0]=-1;
            $answer[1]="La CURP de este estudio ya fue consultada previamente.";
            return $answer;
        }
        
        $curp = mb_strtoupper($estudio->ese_curp, "UTF-8");
        $pattern = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
        $validacionRegex = preg_match($pattern, $curp);
        if ($validacionRegex === 0) {
            $valida="El CURP ({$curp}) no cumple con la estructura válida. Revise el CURP e intente nuevamente.";
            $answer[0]=-1;
            $answer[1]=$valida;
            return $answer;
        }

        $opciones = array(
            'http'=>array(
                'method'  => 'POST',
                'header'  => "Content-type: application/json\r\n" .
                            "X-API-KEY: 0f60ef412edf50195a130ace7a3472878a0eceaac00295a9\r\n",
                'content' => '{
                    "type": "validation",
                    "validation": {
                        "curp": "'.$curp.'"
                    }
                }',
                'ignore_errors' => true
            )
          );
          
        $contexto = stream_context_create($opciones);
        // Abre el fichero usando las cabeceras HTTP establecidas arriba
        $fichero = file_get_contents('https://consultaunica.mx/api/v2/curp', true, $contexto);
        $json = json_decode($fichero,true);

        if(array_key_exists('message', $json)){
            $answer[0]=-1;
            $answer[1]=json_encode($json['message']);
            return $answer;
        }

        if(array_key_exists('documentUrl', $json)){
            $file_name = basename($json['documentUrl']);
            $date= new DateTime();
            if (file_put_contents('archivos/'.$date->format('Y-m-d-H-i-s').'-'.$file_name, file_get_contents($json['documentUrl'])))
            {
                $documento= new Archivo();
                $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
                $data1['arc_estatus']=2;
                $data1['ese_id']=$id;
                $data1['cat_id']=25;
                
                if($documento->NuevoRegistro($data1)==true)
                {   
                    $estudio->ese_apicurp=1;
                    $estudio->save();
                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Descargó el CURP. Archivo: ".$data1['arc_nombre']." al estudio con clave ".$id;
                    $databit['usu_id']=$id_user;
                    $databit['bit_tablaid']=$id;
                    $databit['bit_modulo']="API CURP";
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=1;
                    return $answer;
                }
            }
            else
            {
                $answer[0]=-1;
                $answer[1]="Ocurrió un error inesperado al descargar el archivo de semanas cotizadas.";
                return $answer;
            }
            $answer[0]=-1;
            $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (nofnd)";
            return $answer;
        }
        $answer[0]=-1;
        $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (endea)";
        return $answer;
    }
    
    public function BuscarPoderJudicial($id,$id_user)
    {
        $estudio=Estudio::findFirstByese_id($id);

        if($estudio->ese_apijudicial!=0){
            $answer[0]=-1;
            $answer[1]="La consulta de este estudio ya fue solicitada previamente.";
            return $answer;
        }
        
        $curp = mb_strtoupper($estudio->ese_curp, "UTF-8");
        $pattern = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
        $validacionRegex = preg_match($pattern, $curp);
        if ($validacionRegex === 0) {
            $valida="El CURP ({$curp}) no cumple con la estructura válida. Revise el CURP e intente nuevamente.";
            $answer[0]=-1;
            $answer[1]=$valida;
            return $answer;
        }

        $opciones = array(
            'http'=>array(
                'method'  => 'POST',
                'header'  => "Content-type: application/json\r\n" .
                            "Authorization: Basic: PREP:d51a1b1b-39b846d8-94e0f784-70515c10-f823\r\n",
                'content' => '{
                    "CURP": "'.$curp.'"
                }',
                'ignore_errors' => true
            )
          );
          
        $contexto = stream_context_create($opciones);
        // Abre el fichero usando las cabeceras HTTP establecidas arriba
        $fichero = file_get_contents('https://services.xira.app/poderjudicial', true, $contexto);
        $json = json_decode($fichero,true);

        if(array_key_exists('Response', $json)){

            $nuevojson=$json['Response'];
            if(array_key_exists('info', $nuevojson)){
                $answer[0]=-1;
                $answer[1]=json_encode($nuevojson['info']);
                return $answer;
            }
            if(array_key_exists('message', $nuevojson)){
                $answer[0]=-1;
                $answer[1]=json_encode($nuevojson['message']);
                return $answer;
            }
            if(array_key_exists('image', $nuevojson)){
                $file_name = basename($nuevojson['NombreArchivo']);
                $date= new DateTime();


                $data=base64_decode($nuevojson['image']);
                $file = 'archivos/'.$date->format('Y-m-d-H-i-s').'-'.$file_name;

                $success = file_put_contents($file, $data);

                $documento= new Archivo();
                $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
                $data1['arc_estatus']=2;
                $data1['ese_id']=$id;
                $data1['cat_id']=26;

                if($documento->NuevoRegistro($data1)==true)
                {   
                    $estudio->ese_apijudicial=1;
                    $estudio->save();
                    
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Descargó el reporte de Poder Judicial. Archivo: ".$date->format('Y-m-d-H-i-s').'-'.$file_name." al estudio con clave ".$id;
                    $databit['usu_id']=$id_user;
                    $databit['bit_tablaid']=$id;
                    $databit['bit_modulo']="API Judicial";
                    $bitacora->NuevoRegistro($databit);

                    $answer[0]=1;
                    return $answer;
                }

                // $answer[0]=1;
                // $answer[1]=json_encode($nuevojson['image']);
                // return $answer;
            }
            
        }

        // if(array_key_exists('documentUrl', $json)){
        //     $file_name = basename($json['documentUrl']);
        //     $date= new DateTime();
        //     if (file_put_contents('archivos/'.$date->format('Y-m-d-H-i-s').'-'.$file_name, file_get_contents($json['documentUrl'])))
        //     {
        //         $documento= new Archivo();
        //         $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
        //         $data1['arc_estatus']=2;
        //         $data1['ese_id']=$id;
        //         $data1['cat_id']=25;
                
        //         if($documento->NuevoRegistro($data1)==true)
        //         {   
        //             $estudio->ese_apicurp=1;
        //             $estudio->save();
                    
        //             $bitacora= new Bitacora();
        //             $databit['bit_descripcion']= "Descargó el CURP. Archivo: ".$data1['arc_nombre']." al estudio con clave ".$id;
        //             $databit['usu_id']=$id_user;
        //             $databit['bit_tablaid']=$id;
        //             $databit['bit_modulo']="API CURP";
        //             $bitacora->NuevoRegistro($databit);

        //             $answer[0]=1;
        //             return $answer;
        //         }
        //     }
        //     else
        //     {
        //         $answer[0]=-1;
        //         $answer[1]="Ocurrió un error inesperado al descargar el archivo de semanas cotizadas.";
        //         return $answer;
        //     }
        //     $answer[0]=-1;
        //     $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (nofnd)";
        //     return $answer;
        // }
        $answer[0]=-1;
        $answer[1]="Ocurrió un error inesperado. Intente de nuevo. (nofnd)";
        return $answer;
    }
}
