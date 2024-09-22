<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require_once("tinify/vendor/autoload.php");
\Tinify\setKey("wvMw7Jxtk9nN4CHBCbBVKBQLw0MNll2c");

class ApnubarconsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Controlador apis');
        parent::initialize();
    }

    public function apnubarimssconsAction()
    {
        $this->view->disable();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        $registro=Imssapi::findFirstByims_codigoValidacion($data['codigoValidacion']);
        $estatus=$data['estatus'];
        // $registro = new Imssapi();
        $registro->ims_estatus=$estatus;
        $registro->ims_claveMensaje=$data['claveMensaje'];
        // $registro->ims_codigoValidacion=$data['codigoValidacion'];
        if($estatus=="OK"){
            $registro->ims_nombre=$data['nombre'];
            $registro->ims_semanasCotizadas=$data['semanasCotizadas']['semanasCotizadas'];
            $registro->ims_semanasReintegradas=$data['semanasCotizadas']['semanasReintegradas'];
            $registro->ims_semanasDescontadas=$data['semanasCotizadas']['semanasDescontadas'];
            $jsonString = json_encode($data);
            $registro->ims_json=$jsonString;
            $registro->save();
            $idimss=$registro->ims_id;

            $file_name = basename($data['nombre']).'.pdf';
            $b64=str_replace("\/","/", $data['documento']);
            $bin = base64_decode($b64, true);
            $date= new DateTime();
            if (file_put_contents('archivos/'.$date->format('Y-m-d-H-i-s').'-'.$file_name, $bin))
            {
                $documento= new Archivo();
                // echo "File downloaded successfully";
                $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
                $data1['arc_estatus']=2;
                $data1['ese_id']=$registro->ese_id;
                $data1['cat_id']=15;
                    
                if($documento->NuevoRegistro($data1)==true)
                {   
                    $bitacora= new Bitacora();
                    $databit['bit_descripcion']= "Descargó las semanas cotizadas. Archivo: ".$data1['arc_nombre']." al estudio con clave ".$registro->ese_id;
                    $databit['usu_id']=$registro->usu_id;
                    $databit['bit_tablaid']=$registro->ese_id;
                    $databit['bit_modulo']="Semanas cotizadas";
                    $databit['ese_id']= $registro->ese_id;
                    $bitacora->NuevoRegistro($databit);
                }
            }
            else
            {
                // $answer[0]=-1;
                // $answer[1]="Ocurrió un error inesperado al descargar el archivo de semanas cotizadas.";
                // $this->response->setJsonContent($answer);
                // $this->response->send(); 
                // return;
            }

            $longitud=count($data['historialLaboral']);
            // echo $longitud;
            for($i=0; $i<$longitud; $i++){
                $historial = new Historiallaboral();
                $historial->hil_fechaAlta=$data['historialLaboral'][$i]['fechaAlta'];
                $historial->hil_fechaBaja=$data['historialLaboral'][$i]['fechaBaja'];
                $historial->hil_salarioBaseCotizacion=$data['historialLaboral'][$i]['salarioBaseCotizacion'];
                $historial->hil_entidadFederativa=$data['historialLaboral'][$i]['entidadFederativa'];
                $historial->hil_nombrePatron=$data['historialLaboral'][$i]['nombrePatron'];
                $historial->hil_registroPatronal=$data['historialLaboral'][$i]['registroPatronal'];
                $historial->ims_id=$idimss;
                $historial->save();
            }
        }
        else {
            $registro->ims_mensaje=$data['mensaje'];
            $registro->save();

            $estudio=Estudio::findFirstByese_id($registro->ese_id);
            
            $comentario= new Comentarioese();
            $comentario->com_comentario= "Registro automático. Hubo un error al consultar las semanas cotizadas por el siguiente motivo: ".$data['mensaje']." Corrija e intente de nuevo.";
            $comentario->com_estatus= 2;
            $comentario->usu_id= $registro->usu_id;
            $comentario->ese_id= $registro->ese_id;
            $comentario->ese_estatus= $estudio->ese_estatus;
            $comentario->save();

            $estudio->ese_apiimss=0;
            $estudio->save();
        }      
    }

    public function apnubarimssconsPRUEBANUBARIUMAction() //primera estructura de descarga de información de semanas cotizadas
    {
        $this->view->disable();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // print_r($data['estatus']);
        // return;
        
        $estatus=$data['estatus'];
        $registro = new Imssapi();
        $registro->ims_estatus=$estatus;
        $registro->ims_claveMensaje=$data['claveMensaje'];
        $registro->ims_codigoValidacion=$data['codigoValidacion'];
        if($estatus=="OK"){
            $registro->ims_nombre=$data['nombre'];
            $registro->ims_semanasCotizadas=$data['semanasCotizadas']['semanasCotizadas'];
            $registro->ims_semanasReintegradas=$data['semanasCotizadas']['semanasReintegradas'];
            $registro->ims_semanasDescontadas=$data['semanasCotizadas']['semanasDescontadas'];
            $jsonString = json_encode($data);
            $registro->ims_json=$jsonString;
            $registro->save();
            $id=$registro->ims_id;
            $longitud=count($data['historialLaboral']);
            // echo $longitud;
            for($i=0; $i<$longitud; $i++){
                $historial = new Historiallaboral();
                $historial->hil_fechaAlta=$data['historialLaboral'][$i]['fechaAlta'];
                $historial->hil_fechaBaja=$data['historialLaboral'][$i]['fechaBaja'];
                $historial->hil_salarioBaseCotizacion=$data['historialLaboral'][$i]['salarioBaseCotizacion'];
                $historial->hil_entidadFederativa=$data['historialLaboral'][$i]['entidadFederativa'];
                $historial->hil_nombrePatron=$data['historialLaboral'][$i]['nombrePatron'];
                $historial->hil_registroPatronal=$data['historialLaboral'][$i]['registroPatronal'];
                $historial->ims_id=$id;
                $historial->save();
            }
            

        }
        else {
            $registro->ims_mensaje=$data['mensaje'];
            $registro->save();
        }
                
    }
}