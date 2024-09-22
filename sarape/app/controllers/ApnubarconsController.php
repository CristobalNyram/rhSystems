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

        // print_r($data['estatus']);
        // return;
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


            $ruta = 'archivosexc/'.$registro->exc_id.'/'; 
            // Validar si la carpeta no existe y luego crearla
            if (!file_exists($ruta)) {
                if (!mkdir($ruta, 0777, true)) {
                    error_log("No se pudo crear la ruta de archivo");
                } 
            }

            $file_name = basename($data['nombre']).'.pdf';
            $b64=str_replace("\/","/", $data['documento']);
            $bin = base64_decode($b64, true);
            $date= new DateTime();
            if (file_put_contents($ruta.$date->format('Y-m-d-H-i-s').'-'.$file_name, $bin))
            {
                $documento= new Archivo();
                // echo "File downloaded successfully";
                $data1['arc_nombre']=$date->format('Y-m-d-H-i-s').'-'.$file_name;
                $data1['arc_estatus']=2;
                $data1['exc_id']=$registro->exc_id;
                $data1['cat_id']=4;
                    
                if($documento->NuevoRegistro($data1)==true)
                {   
                    // $estudio->ese_apiimss=1;
                    // $estudio->save();
                    $auth = $this->session->get('auth');
                    $data_bit=[
                        'bit_descripcion'=>"Descargó las semanas cotizadas. Archivo: ".$date->format('Y-m-d-H-i-s').'-'.$file_name." al expediente con clave ".$registro->exc_id,
                        'bit_tablaid'=>$registro->exc_id,
                        'bit_modulo'=>"Semanas cotizadas",
                        'vac_id'=>$registro->vac_id,
                        'bit_accion'=>1,
                    ];
                    $this->bitacora_registro($data_bit,$auth);
                }
            }
            else
            {
               
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

            $expedientecan=Expedientecan::findFirstByese_id($registro->exc_id);
            
            $comentario= new Comentarioexc();
            $comentario->com_comentario= "Registro automático. Hubo un error al consultar las semanas cotizadas por el siguiente motivo: ".$data['mensaje']." Corrija e intente de nuevo.";
            $comentario->com_estatus= 2;
            $comentario->usu_id= $registro->usu_id;
            $comentario->exc_id= $registro->exc_id;
            $comentario->exc_estatus= $expedientecan->exc_estatus;
            $comentario->vista="general";
            $comentario->save();

            $expedientecan->exc_apiimss=0;
            $expedientecan->save();
        }
                
    }
}